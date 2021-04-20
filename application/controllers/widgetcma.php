<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class WidgetCma extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        // header('Content-Type: text/javascript; charset=utf8');
        $origin = $_SERVER['HTTP_ORIGIN'];
        $allowed_domains = array('https://'.$_ENV['WIDGET_DOMAIN'],'http://'.$_ENV['WIDGET_DOMAIN']);
        if (in_array($origin, $allowed_domains)) {
		    header('Access-Control-Allow-Origin: ' . $origin);
		    header('Access-Control-Allow-Credentials: true');

		}
        $this->load->model('user_model');

    }

    public function index()
    {
    	if($this->input->post()){
            $form = $this->input->post('form-name');
            if($form=='ref-form'){
                $refCode = $this->input->post('ref_code');
                if($refCode==''){
                    die("Blank Code");
                }
                $user = $this->user_model->get_user_by_ref($refCode);
                if(!is_object($user)){
                    die("Invalid Code");
                }
                $data['user'] = $user;
            }
        }
        $data['title'] = "Modern Agent";
        
        $this->load->library('session');

        // $this->load->view('frontend/header_cma',$data);
        $this->load->view('frontend/quick_pdf_widget',$data);
        // $this->load->view('frontend/footer_cma',$data);
    }


    public function get_user_by_ref(){
            $form = $this->input->post('form-name');
            if($form=='ref-form'){
                //Checking Valid 10 digit phone number
                $phoneNumber = $this->input->post('phone_number');
                $phoneNumber = str_replace(" ", "", $phoneNumber);
                $phoneNumber = str_replace("-", "", $phoneNumber);
                if(!is_numeric($phoneNumber) || strlen((string)$phoneNumber) !== 10){
                    echo json_encode(array("status"=>"failed","msg"=>"Invalid phone number"));
                    exit();
                }
                $refCode = $this->input->post('ref_code');
                if($refCode==''){
                    echo json_encode(array("status"=>"failed","msg"=>"Empty referral code submitted"));
                    exit();
                }
                $user = $this->user_model->get_user_by_ref($refCode);
                if(!is_object($user)){
                    echo  json_encode(array("status"=>"failed","msg"=>"Invalid referral code"));
                    exit();
                }
                $canAvail = false;
                $method = "";//suscription or coupon code of sales rep
                if($user->parent_role==3){//User is under some sales rep
                    $canAvail = true;
                    if (strlen($user->parent_id) < 5) {
                        $method = "REF".sprintf("%05d", $user->parent_id);
                    } else {
                        $method = "REF0".$user->parent_id;
                    }
                    
                } else if($user->customer_id){
                    $res = $this->_cust_info_by_id($user->customer_id);
                    //if subscribed
                    if($res){
                        $method = 'subscription';
                        $canAvail = true;
                    }
                }
                if($canAvail){
                    echo json_encode(array("status"=>"success","user"=>$user,'method'=>$method));
                    exit();
                } else {
                    echo json_encode(array("status"=>"failed","msg"=>"This user can not avail quick PDF feature."));
                    exit();
                }
                
            }
        
    }

    // stripe post
    public function cart_payment(){
    	// var_dump($this->session->userdata('userid'));
      
      $userId = $data['user_id'] = $this->session->userdata('userid');
      if(true || $userId){
        if(!$userId){
          $userId = $this->input->post('user-id');
        }

        $users = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));

        if($_POST){
          $this->load->library('stripe');

          // Create the library object
          $stripe = new Stripe(null);

          $amt = $_POST['amount'];

          $couponId = $this->input->post('coupon_id');
          if (empty($couponId)) {$couponId = 0; }
          $couponAmount = $this->input->post('coupon_amount');
          $orderAmount = $this->input->post('order_amount');
          if (empty($couponAmount)) { $couponAmount = 0; }
          if (empty($orderAmount)) { $orderAmount = 0; }

          $byPassPayment = false;
          if($amt<=0){
            $byPassPayment = true;
          }
          $amount = 100 * $amt;

          $card = $_POST['stripeToken'];

          $desc = 'Modern Agent Paymemnt';
          if(!$byPassPayment) {
            try{
              $response = json_decode($stripe->charge_card($amount, $card, $desc));     
            }catch(Exception $e){
            }
          }
          // if the request is coming from the widget then we directly get the file link
          if(isset($_POST['widgetType'])){
             $data = array(
                        'user_id_fk' => $userId,
                        'paid_on' => date('Y-m-d'),
                        'txn_id' => isset($response->id)?$response->id:'',
                        'is_success' => 'Y',
                        'total_amount' => $amt,
                        //'coupon_id_fk' => $this->session->userdata('coupon_id'),
                        'coupon_id_fk' => $couponId,
                        'project_id_fk' => $this->session->userdata('project_id')
                      );

              $result = $this->base_model->insert_one_row('lp_my_cart',$data);

              if($result){
                $lastId = $this->base_model->get_last_insert_id();
      
                $invoice_no = $this->generateInvoice(); 
                $data2 = array(
                  'invoice_num' => 'INV'.$invoice_no,
                  'cart_id_fk' => $lastId,
                  'user_id_fk' => $userId,
                  'invoice_amount' => $amt,
                  'invoice_to' => $users[0]['first_name'],
                  'invoice_addr' => $users[0]['city'],
                  'order_amount' => $orderAmount,
                  'coupon_amount' => $couponAmount
                  );
                $result2 = $this->base_model->insert_one_row('lp_invoices',$data2);

                $this->gen_invoice($this->base_model->get_last_insert_id(),$lastId,$userId);

                $updateProject = array('is_active'=>'Y');
                $this->base_model->update_record_by_id('lp_my_listing',$updateProject,array('project_id_pk'=>$this->session->userdata('project_id')));
                $couponId = $this->input->post('coupon_id');
                if($couponId!='')
                  $this->base_model->add_coupon_redeem_log($couponId,$userId,$this->session->userdata('project_id'));

                $_project = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk' => $this->session->userdata('project_id')));
                
                $reportLink = base_url($_project->report_path);
                
                header('Content-Type: application/json; charset=utf8');
                
                echo json_encode($_project);
              }
          }elseif($byPassPayment || $response->paid) {
              $data = array(
                        'user_id_fk' => $userId,
                        'paid_on' => date('Y-m-d'),
                        'txn_id' => isset($response->id)?$response->id:'',
                        'is_success' => 'Y',
                        'total_amount' => $amt,
                        //'coupon_id_fk' => $this->session->userdata('coupon_id'),
                        'coupon_id_fk' => $couponId,
                        'project_id_fk' => $this->session->userdata('project_id')
                      );

              $result = $this->base_model->insert_one_row('lp_my_cart',$data);

              if($result){
                $lastId = $this->base_model->get_last_insert_id();
		  
                $invoice_no = $this->generateInvoice(); 
                $data2 = array(
                  'invoice_num' => 'INV'.$invoice_no,
                  'cart_id_fk' => $lastId,
                  'user_id_fk' => $userId,
                  'invoice_amount' => $amt,
                  'invoice_to' => $users[0]['first_name'],
                  'invoice_addr' => $users[0]['city'],
                  'order_amount' => $orderAmount,
                  'coupon_amount' => $couponAmount
                  );
                $result2 = $this->base_model->insert_one_row('lp_invoices',$data2);

                $this->gen_invoice($this->base_model->get_last_insert_id(),$lastId,$userId);

                $updateProject = array('is_active'=>'Y');
                $this->base_model->update_record_by_id('lp_my_listing',$updateProject,array('project_id_pk'=>$this->session->userdata('project_id')));
                $couponId = $this->input->post('coupon_id');
                if($couponId!='')
                  $this->base_model->add_coupon_redeem_log($couponId,$userId,$this->session->userdata('project_id'));
                if($this->input->is_ajax_request()){
                	die("IN");
                    //Save Data in leads
                    $phoneNumber = $this->input->post('phone_number');
                    $leadData = array(
                        'phone_number'=>$phoneNumber,
                        'user_id_fk'=>$userId,
                        'project_id_fk'=>$this->session->userdata('project_id')
                    );
                    $this->load->model('user_model');
                    $this->user_model->add_lead($leadData);
                    $_project = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk' => $this->session->userdata('project_id')));
                    
                    $reportLink = base_url($_project->report_path);
                    
                    // Your Account SID and Auth Token from twilio.com/console
                      $sid = 'AC29e21e9430aaac14af1cc7da1b01a57e';
                      $token = 'd33346194bc839d2c495c6b35c2c5a64';
                      $client = new Client($sid, $token);

                      // Use the client to do fun stuff like send text messages!
                      $smsText = "Your report is ready. You can can download it by clicking this url. {$reportLink}";
                      try {
                        $smsRes = $client->messages->create(
                          // the number you'd like to send the message to
                          '+1'.$phoneNumber,
                          array(
                              // A Twilio phone number you purchased at twilio.com/console
                              'from' => '+14243519064',
                              // the body of the text message you'd like to send
                              'body' => $smsText
                          )
                        );
                      } catch (Exception $e){
                          echo json_encode(array("status"=>"failed",'msg'=>'SMS could not be sent on this number.',"sms"=>$smsText));
                          exit();
                      }
                      //alert user about report generated
                      $userPhone = clean_phone($users[0]['phone']);
                      if($userPhone){
                          try {
                              $property_owner = str_replace(';', ' &', $_project->property_owner);
                              $smsText = "Guest user with phone {$phoneNumber} has created report from CMA using your refrence code. Property Details: \n Property Address: $_project->property_address \n Property Owner: $property_owner";

                              $smsRes = $client->messages->create(
                                  // the number you'd like to send the message to
                                  '+1'.$userPhone,
                                  array(
                                      // A Twilio phone number you purchased at twilio.com/console
                                      'from' => '+14243519064',
                                      // the body of the text message you'd like to send
                                      'body' => $smsText
                                  )
                              );
                          } catch (Exception $e){
                              echo json_encode(array("status"=>"failed",'msg'=>'SMS could not be sent on this number.',"sms"=>$smsText));
                              exit();
                          }
                      }
                    echo json_encode(array("status"=>"success","sms"=>$smsText));
                    exit();
                }
                	die("ELSE");

                redirect(base_url().'index.php?/user/recentlp?id='.$this->session->userdata('project_id'));
              }
          } else {
            if($this->input->is_ajax_request()){
                echo json_encode(array("status"=>"failed","msg"=>"failed to craete PDF"));
                exit();
            }
            $data['title'] = "Dashboard";
            $userId = $data['user_id'] = $this->session->userdata('userid');
            $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
            $this->load->view('user/header', $data);
            $this->load->view('user/checkout-error',$response);
            $this->load->view('user/footer');
          }
        }
      }
    }


    // cart payment
    public function generateInvoice() {
		  $invoice_no = $this->session->userdata('userid').'-'.time();
		  return $invoice_no;
    }


    public function gen_invoice($inv,$cart_id,$userId){
      // $userId = $data['user_id'] = $this->session->userdata('userid');
      // var_dump($this->session->userdata('userid'));die;
        if($userId){
			    $invoice_data = array();
          // user data
          $user = $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $user_name = $user[0]['first_name'].' '.$user[0]['last_name'];
          $user_email = $user[0]['email'];
          // get invoice data
          $invoice = $data['invoices'] = $this->base_model->get_record_result_array('lp_invoices',array('invoice_id_pk'=>$inv,'user_id_fk' => $userId));
          $order_num = $invoice[0]['invoice_num'];
          
          $cart = $this->base_model->get_record_result_array('lp_my_cart',array('cart_id_pk'=>$cart_id,'user_id_fk' => $userId));
          $total_amount = $cart[0]['total_amount'];
          //$discount = $this->base_model->get_record_result_array('lp_coupon_mst',array('coupon_id_pk'=>$cart[0]['coupon_id_fk']));
          //$discount_amount = $discount[0]['coupon_amt'];
		      $tax_amount = 0;
          
          $lp_details = $this->base_model->get_record_result_array('lp_my_listing',array('project_id_pk'=>$cart[0]['project_id_fk']));

          //$this->load->model('package_model');
          //$report_price = $this->package_model->get_reports_price();
		  
          $invoice_data['user_name'] = $user_name;
          $invoice_data['order_num'] = $order_num;
          $invoice_data['lp_details'] = $lp_details[0];
          $invoice_data['total_amount'] = $invoice[0]['order_amount'];//$report_price;
          $invoice_data['discount_amount'] = $invoice[0]['coupon_amount'];//$discount_amount;
          $invoice_data['tax_amount'] = $tax_amount;
          $invoice_data['total'] = $total_amount;
          // my flyer data
          $myflyers = $data['myflyers'] = $this->base_model->get_record_result_array('lp_my_listing', array('user_id_fk'=>$userId, 'project_id_pk'=>$this->session->userdata('project_id')));
          
	    	  $pdf_file = 'assets/uploads/user_invoices/'.uniqid().'.pdf';
            
          ob_start();
          $this->load->view('invoice', $invoice_data);
          $content = ob_get_contents();
          ob_clean();
          //echo $content;exit;		
          $this->load->library('mpdf'); 
          $mpdf=new mPDF(); 
          $mpdf=new mPDF('','A4','','',10,10,7);
          $mpdf->WriteHTML($content);
          $mpdf->Output($pdf_file);
		  
          $updateData = array(            
            'invoice_pdf' => $pdf_file
          );
          
          $myPdf=array();
          
          array_push($myPdf, $pdf_file);
          array_push($myPdf, $myflyers[0]['report_path']);
          $this->load->helper('sendemail');
          
          $this->base_model->queue_mail($user_email,'Report is ready',$content,$myPdf);
      

          $updateFlyerTable = $this->base_model->update_record_by_id('lp_invoices', $updateData,array('invoice_id_pk' => $inv)); 

      }
    }

}
