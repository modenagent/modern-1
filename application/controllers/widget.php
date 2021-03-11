<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Widget extends CI_Controller {
    
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        // $this->user_id = 82;   
        $widget_url = $_ENV['WIDGET_DOMAIN'];
        // header("Access-Control-Allow-Origin: $widget_url");
        header("Access-Control-Allow-Origin:*");


        require_once(FCPATH .'simplesaml/lib/_autoload.php');
        $session = SimpleSAML_Session::getSessionFromRequest();

        if(!empty($_SESSION['userdata']) && !($this->session->userdata('userid'))) {

            $sessionData = $this->session->set_userdata($_SESSION['userdata']);

        }
        if(!($this->session->userdata('userid')) ) {

            echo "Access denied, you are not authorized to use this widget.";
            return;
        }
        else {
            $this->user_id = $this->session->userdata('userid');          
        }       
    }

    public function index()
    {
    	if(isset($this->user_id) && !empty($this->user_id))
    	{
    		// $userInfo = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $this->user_id));

            $tableName = "lp_user_mst";
            $user = $this->base_model->get_login_data_from_id( $tableName,'user_id_pk', $this->user_id);
            $user_info = (array) $user; 
            if(isset($user_info) && !empty($user_info))
            {
                if ($user_info['is_active'] == 'Y') 
                {
	              	$user_data = array(
		              	'userid'    => $user_info['user_id_pk'],
		              	'username'    => ucfirst($user_info['first_name']).' '.ucfirst($user_info['last_name']),
		                'user_email'    => $user_info['email'],
		              	'logged_in'    => TRUE,
	              	);

                  	$session_data = $this->session->set_userdata($user_data);
                }

                $data['title'] = "Widget";
                $data['user_id'] = $user->user_id_pk;
                $data['user_name'] = isset($user->user_name) && !empty($user->user_name) ? $user->user_name : '';
                $data['users'] = (array) $user;
                echo "<pre>ddd"; print_r($user); exit;
              $data['topReports'] = $this->base_model->get_all_record_by_id('lp_my_listing', array('user_id_fk' => $userId),'project_date','desc');
              $data['reports'] = $this->base_model->get_all_record_by_id('lp_my_listing', 
                                              array(
                                                  'user_id_fk' => $userId,
                                                  'is_active' => 'Y'
                                              ),
                                              'project_date','desc'
                                            );
              }

    	}
    	else
    	{

    	}
    }

    public function getWidgetData()
    {
        $user_id = $this->user_id;
        if(isset($user_id) && !empty($user_id))
        {
            $tableName = "lp_user_mst";
            $user = $this->base_model->get_login_data_from_id( $tableName,'user_id_pk', $user_id);

            $data['user'] = $data['agentInfo'] = $user_info = (array) $user;

            if(isset($user_info) && !empty($user_info))
            {
                if ($user_info['is_active'] == 'Y') 
                {
                    $user_data = array(
                        'userid'    => $user_info['user_id_pk'],
                        'username'    => ucfirst($user_info['first_name']).' '.ucfirst($user_info['last_name']),
                        'user_email'    => $user_info['email'],
                        'logged_in'    => TRUE,
                    );

                    $session_data = $this->session->set_userdata($user_data);
                }

                $data['title'] = "Widget";
                $data['user_id'] = $user_id = $user_info['user_id_pk'];
                $data['user_name'] = isset($user_info['user_name']) && !empty($user_info['user_name']) ? $user_info['user_name'] : '';
                $data['salesRep'] = array();
                if(isset($user_info['parent_id']) && !empty($user_info['parent_id']))
                {
                    $parent_id = $user_info['parent_id'];
                    $sales_rep_info = $this->base_model->get_record_by_id('lp_user_mst', array('user_id_pk'=>$parent_id));
                    $data['salesRep'] = (array) $sales_rep_info;
                    // $company_id = isset($data['salesRep']['parent_id']) && !empty($data['salesRep']['parent_id']) ? $data['salesRep']['parent_id'] : '';

                    // $company_info = $this->base_model->get_record_by_id('lp_user_mst', array('user_id_pk'=>$company_id));
                    $company_info = $sales_rep_info;
                    
                    $data['company'] = (array) $sales_rep_info;
                }
                
                $data['reports'] = $this->base_model->get_all_record_by_id ('lp_my_listing',  
                        array(
                                'user_id_fk' => $user_id,
                                'is_active' => 'Y'
                            ),
                            'project_date','desc'
                );

                // $data['reportTemplates'] = $this->base_model->all_records('lp_report_templates');  
                $this->load->model('package_model');
                $data['report_price'] = $this->package_model->get_reports_price();

                $data['reportTemplates'] = $this->base_model->all_records('lp_seller_report_templates');
                
                // $html = $this->load->view('user/dashboard_widget', $data, true);
                $this->load->view('user/dashboard_widget', $data);
                // $result['res'] = $html;

                // header('Content-Type: text/javascript; charset=utf8');
                // header('Access-Control-Allow-Origin: http://localhost/mylistingpitch');
                // header('Access-Control-Max-Age: 3628800');
                // header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');              
                
            }
        }
        else
        {
            // header('Content-Type: application/json; charset=utf8');
            // $result['res'] = 'ERROR: Access denied, you are not authorized to use this widget.';
            echo 'ERROR: Access denied, you are not authorized to use this widget.';
            // echo json_encode($data);
        }
        // echo json_encode($result); exit;
    }

    public function getWidgetPropertyData()
    {
        $msg = "Unknown error while trying to generate report pdf for user account ".$this->session->userdata('user_email');
        try {
            $response = $this->reports->getPropertyDataForWidget();
            if(isset($response['status']) && $response['status']===false){
                $msg = $response['msg'];
            }
        } catch (Exception $e){
            $response = false;
            $msg = $e->getMessage();
        }
        if($response['status']){
            echo json_encode(array('status'=>'success'));
        } else {
            $this->base_model->queue_mail("info@modernagent.io",'Urgent! Error occured while generating PDF',$msg,null,'info@modernagent.io');
            $responseArray = ['status'=>'fail','msg'=>$msg];
            if (isset($response['showError']) && ($response['showError']==true||$response['showError']=='true')){
                $responseArray['showError'] = true;
            }
            echo json_encode($responseArray);
        }
    }

    public function getPDF(){
      echo "<pre>"; print_r($_POST); exit;
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

                $this->gen_invoice($this->base_model->get_last_insert_id(),$lastId);

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

                $this->gen_invoice($this->base_model->get_last_insert_id(),$lastId);

                $updateProject = array('is_active'=>'Y');
                $this->base_model->update_record_by_id('lp_my_listing',$updateProject,array('project_id_pk'=>$this->session->userdata('project_id')));
                $couponId = $this->input->post('coupon_id');
                if($couponId!='')
                  $this->base_model->add_coupon_redeem_log($couponId,$userId,$this->session->userdata('project_id'));
                if($this->input->is_ajax_request()){
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
}