<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Widget extends CI_Controller {
    
    private $user_id;

    public function __construct()
    {
        parent::__construct();
         
        $widget_url = $_ENV['WIDGET_DOMAIN'];
        
        // $this->session->unset_userdata('userid');die;
        
        if(!($this->session->userdata('userid')) ) {

          if($this->uri->uri_string() != 'widget/setAuth'){

            $user_id = $this->setAuth();
            // $user_id = 1606;
            if($user_id) {

              $this->user_id = $user_id;

              $user_data = array(
                    'userid'    => $user_id,
                    'logged_in'    => TRUE,
                  );

              $session_data = $this->session->set_userdata($user_data);
            }
            else {
              echo "Access denied, you are not authorized to use this widget.";
              die;
            }
            // exit();
          } 
             
        }
        else {
            $this->user_id = $this->session->userdata('userid');          
        }       
    }

    public function setAuth()
    {
      
      $this->load->helper('cookie');
      $sso_user_token = get_cookie('sso_user_token',true);
      if(!empty($sso_user_token)) {
          $user_id = getUserIdByToken($sso_user_token);
          if($user_id) {
            $user = $this->base_model->get_login_data_from_id( 'lp_user_mst','user_id_pk', $user_id);
            $user_info = (array) $user;

            if(isset($user_info) && !empty($user_info))
            {
                
                  $user_data = array(
                    'userid'    => $user_info['user_id_pk'],
                    'username'    => ucfirst($user_info['first_name']).' '.ucfirst($user_info['last_name']),
                    'user_email'    => $user_info['email'],
                    'logged_in'    => TRUE,
                  );

                    $session_data = $this->session->set_userdata($user_data);
                }


              // redirect('widget/getWidgetData');
              // exit;
                return $user_info['user_id_pk'];

          }
        // echo $url;die;


      }
      // echo "Access denied, you are not authorized to use this widget.";
      return false;
      // die;
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
                $data['cma_url'] = $user_info['cma_url'];
                $data['report_dir_name'] = $user_info['report_dir_name'];
                $data['widget_bg_color'] = $user_info['widget_bg_color'];
                $data['featured_homes'] = array();
                $data['testimonials'] = array();

                $data['testimonials'] = $this->base_model->all_records('lp_testimonial');

                if(isset($user_info['parent_id']) && !empty($user_info['parent_id']))
                {
                    $parent_id = $user_info['parent_id'];
                    $sales_rep_info = $this->base_model->get_record_by_id('lp_user_mst', array('user_id_pk'=>$parent_id));
                    $data['salesRep'] = (array) $sales_rep_info;
                    // $company_id = isset($data['salesRep']['parent_id']) && !empty($data['salesRep']['parent_id']) ? $data['salesRep']['parent_id'] : '';

                    // $company_info = $this->base_model->get_record_by_id('lp_user_mst', array('user_id_pk'=>$company_id));
                    $company_info = $sales_rep_info;

                    
                    $data['company'] = (array) $sales_rep_info;
                    if(!empty($sales_rep_info->cma_url)) {
                      $data['cma_url'] = $sales_rep_info->cma_url;
                    }

                    if($sales_rep_info->role_id_fk == 3) {
                        $data['report_dir_name'] = $sales_rep_info->report_dir_name;
                        $data['widget_bg_color'] = $sales_rep_info->widget_bg_color;
                        if($sales_rep_info->use_featured_home) {

                          /*Featured section*/
                          $data['featured_homes'] = $this->base_model->all_records('lp_featured_home');
                          /*Featured section*/
                        }
                    }
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

                /* leads */
                $this->load->model('user_model');
                $data['leads'] =  $this->user_model->get_leads($user_id);
                $data['ref_code'] = $this->user_model->has_ref_code($user_id);
                /* leads */
                $data['page_contents'] = array();
                /*Report Dynamic  content*/
                $this->load->model('widget_report_dynamic_data_model');
                $page_contents = $this->widget_report_dynamic_data_model->get_many_by('user_id',$user_id);
                if($page_contents) {
                  foreach ($page_contents as $page_content) {
                    if($page_content->report_type == 'seller') {
                      $data['page_contents']['seller'] = unserialize($page_content->data);
                    }
                    else if($page_content->report_type == 'buyer') {
                      $data['page_contents']['buyer'] = unserialize($page_content->data);
                    }
                  }
                }


                /*Report Dynamic  content*/
                
                

                $this->load->view('user/dashboard_widget', $data);
                              
                
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
            echo json_encode(array('status'=>'success','project_id'=>$response['project_id']));
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
      $userId = $data['user_id'] = $this->session->userdata('userid');
      if(true || $userId){
        if(!$userId){
          $userId = $this->input->post('user-id');
        }

        $project_id = $this->session->userdata('project_id');
        if (!$project_id) {
          // die('Project id not found');
          $project_id = $this->input->post('project_id');
        }

        $users = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));

        if($_POST){
          // $this->load->library('stripe');

          // Create the library object
         // $stripe = new Stripe(null);

          // $amt = $_POST['amount'];

          $couponId = $this->input->post('coupon_id');
          if (empty($couponId)) {$couponId = 0; }
          $couponAmount = $this->input->post('coupon_amount');
        //  $orderAmount = $this->input->post('order_amount');
          if (empty($couponAmount)) { $couponAmount = 0; }
         // if (empty($orderAmount)) { $orderAmount = 0; }

          $byPassPayment = false;
          if($amt<=0){
            $byPassPayment = true;
          }
          // $amount = 100 * $amt;

          // $card = $_POST['stripeToken'];

          /*$desc = 'Modern Agent Paymemnt';
          if(!$byPassPayment) {
            try{
              $response = json_decode($stripe->charge_card($amount, $card, $desc));     
            }catch(Exception $e){
            }
          }*/
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
                        'project_id_fk' => $project_id
                      );

              $result = $this->base_model->insert_one_row('lp_my_cart',$data);

              if($result){
                $lastId = $this->base_model->get_last_insert_id();
      
                /*$invoice_no = $this->generateInvoice(); 
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
                $result2 = $this->base_model->insert_one_row('lp_invoices',$data2);*/

                // $this->gen_invoice($this->base_model->get_last_insert_id(),$lastId);

                $updateProject = array('is_active'=>'Y');
                $this->base_model->update_record_by_id('lp_my_listing',$updateProject,array('project_id_pk'=>$project_id));
                $couponId = $this->input->post('coupon_id');
                if($couponId!='')
                  $this->base_model->add_coupon_redeem_log($couponId,$userId,$project_id);

                $_project = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk' => $project_id));
                
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
                        'project_id_fk' => $project_id
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
                $this->base_model->update_record_by_id('lp_my_listing',$updateProject,array('project_id_pk'=>$project_id));
                $couponId = $this->input->post('coupon_id');
                if($couponId!='')
                  $this->base_model->add_coupon_redeem_log($couponId,$userId,$project_id);
                if($this->input->is_ajax_request()){
                    //Save Data in leads
                    $phoneNumber = $this->input->post('phone_number');
                    $leadData = array(
                        'phone_number'=>$phoneNumber,
                        'user_id_fk'=>$userId,
                        'project_id_fk'=>$project_id
                    );
                    $this->load->model('user_model');
                    $this->user_model->add_lead($leadData);
                    $_project = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk' => $project_id));
                    
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
                redirect(base_url().'index.php?/user/recentlp?id='.$project_id);
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

    public function getRetsApiComparablesData($simply_rets=1)
    {
        if(isset($_POST) && !empty($_POST) && $simply_rets)
        {
            $address = $this->input->post('address');
            $query = array('q' => $address);
            $result = $this->reports->make_request('GET', 'properties', json_encode($query));
            $response = json_decode($result,TRUE);

            if(isset($response) && !empty($response))
            {
                $properties = $sorted = $all = array();

                foreach ($response as $key => $value) 
                {
                	if($key <= 7)
                	{
                		$sorted[$value['mlsId']] = array(
	                        'address' => $value['address']['full'].' '.$value['address']['city'],
	                        'price' => $value['listPrice']
	                    );
                	}
                	else
                	{
                		$all[$value['mlsId']] = array(
	                        'address' => $value['address']['full'].' '.$value['address']['city'],
	                        'price' => $value['listPrice']
	                    );
                	}
                    
                    
                }
            }
            $properties['all'] = $all;
            $properties['sorted'] = $sorted;
            
            echo json_encode($properties);
        }
        elseif($simply_rets ==0 && !empty($this->input->post('city'))){

          $this->load->library('rets');
          $rets = new Rets();
          $response = $rets->searchData($this->input->post('city'));

          if(isset($response) && !empty($response))
          {
              $properties = $sorted = $all = array();

              foreach ($response as $key => $value) 
              {
                if($key <= 7)
                {
                  $sorted[$value['mlsId']] = array(
                        'address' => $value['address'].' '.$value['city'],
                        'price' => $value['price']
                    );
                }
                else
                {
                  $all[$value['mlsId']] = array(
                        'address' => $value['address'].' '.$value['city'],
                        'price' => $value['price']
                    );
                }
                  
                  
              }
          }
          $properties['all'] = $all;
          $properties['sorted'] = $sorted;
          echo json_encode($properties);

        }
    }

    public function getRetsApiDataByMlsId($mlsId = null,$simply_rets=1)
    {
        if(!empty($mlsId) && $simply_rets)
        {

            $mlsId=urldecode($mlsId);
            // $mlsId = $mlsId;
            $query = array();
            $result = $this->reports->make_request('GET', 'properties/'.$mlsId);
            $response = json_decode($result,TRUE);

            
            if(isset($response) && !empty($response))
            {
                $properties = $sorted = $all = array();

                
                  if(!empty($response['mlsId'])) {

                  $sorted[$response['mlsId']] = array(
                        'address' => $response['address']['full'].' '.$response['address']['city'],
                        'price' => $response['listPrice']
                    );
                  }
                  
                
            }
            if(count($sorted) == 0) {
              
              // $query = array('q' => $mlsId);
              $result = $this->reports->make_request('GET', 'properties?q='.$mlsId);
              $response = json_decode($result,TRUE);

              if(isset($response) && !empty($response))
              {
                  $properties = $sorted = $all = array();

                  foreach ($response as $key => $value) 
                  {
                    if($key <= 7)
                    {
                      $sorted[$value['mlsId']] = array(
                            'address' => $value['address']['full'].' '.$value['address']['city'],
                            'price' => $value['listPrice']
                        );
                    }
                    else
                    {
                      $all[$value['mlsId']] = array(
                            'address' => $value['address']['full'].' '.$value['address']['city'],
                            'price' => $value['listPrice']
                        );
                    }
                      
                      
                  }
              }
            }
            $properties['all'] = $all;
            $properties['sorted'] = $sorted;
            
            echo json_encode($properties);
        }
        elseif(!empty($mlsId) && $simply_rets == 0){
          $mlsId=urldecode($mlsId);
          $this->load->library('rets');
          $rets = new Rets();
          $response = $rets->searchData($mlsId,1);

          if(isset($response) && !empty($response))
          {
              $properties = $sorted = $all = array();

              foreach ($response as $key => $value) 
              {
                if($key <= 7)
                {
                  $sorted[$value['mlsId']] = array(
                        'address' => $value['address'].' '.$value['city'],
                        'price' => $value['price']
                    );
                }
                else
                {
                  $all[$value['mlsId']] = array(
                        'address' => $value['address'].' '.$value['city'],
                        'price' => $value['price']
                    );
                }
                  
                  
              }
          }
          $properties['all'] = $all;
          $properties['sorted'] = $sorted;
          echo json_encode($properties);
        }
    }  

    public function delete_lp($lpid = -1, $from){
      if($lpid){
        $data = array(  'is_active' =>'N'   );
        $where = array('project_id_pk' => $lpid );
        $this->base_model->update_record_by_id('lp_my_listing', $data, $where);
        if($from == 0){
          redirect('widget/getWidgetData');
        }else if($from == 1){
          redirect('widget/getWidgetData?tab=list');
        }
      } 
    }

    public function upload_image($type='')
    {
      $data = array();
      $data['status'] = true; 
      $data['file'] = '';

      $dir_to_upload = 'assets/reports/widget/images/featured/temp/';

      if ( ! is_dir(FCPATH.$dir_to_upload)) {
        mkdir(FCPATH.$dir_to_upload,0777);
      }

      $config['upload_path'] = './'.$dir_to_upload;
      $config['allowed_types'] = '*';
      $config['max_size'] = '1024';
      if(!empty($this->input->post('max_size')) && $this->input->post('max_size') > 0 ) {
        $config['max_size'] = $this->input->post('max_size');
      }
      

      $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload('file'))
      {

        $data['error'] = strip_tags($this->upload->display_errors());

        $data['status'] = false; 
        
      }
      else
      {
        $uploaded_data = $this->upload->data();

        $data['file'] = $dir_to_upload.$uploaded_data['file_name'];
      }
      echo json_encode($data);
    }


    public function latest_report_html($report_type='buyer') {
      //
      $report_demo = base_url('assets/property/demo.xml');
      $report_type = trim(strtolower($report_type));
      if($report_type == 'seller') {
        $report_type='seller';
      }elseif($report_type == 'marketupdate') {
        $report_type='marketUpdate';
      }
      else {
        $report_type='buyer';
      }

      $user = $this->base_model->get_login_data_from_id( 'lp_user_mst','user_id_pk', $this->user_id);
      // var_dump($user);die;


      $_POST['report187']=$report_demo;
      $_POST['user']['profile_image']=$user->profile_image;
      $_POST['user_image']='';
      $_POST['user']['fullname']=$user->first_name.' '.$user->last_name;
      $_POST['user']['title']=$user->title;
      $_POST['user']['phone']=$user->phone;
      $_POST['user']['email']=$user->email;
      $_POST['user']['licenceno']=$user->license_no;
      $_POST['presentation']=$report_type;
      $_POST['user']['company_logo']='';
      $_POST['company_image']='';
      $_POST['user']['companyname']=$user->company_name;
      $_POST['user']['street']='1235 K St';
      $_POST['user']['city']='San Diego';
      $_POST['user']['zip']='92101';
      $_POST['user']['state']='CA';
      $_POST['testimonials']='["Excellent. They walked me through the entire home selling process. From the list of things to repair, the importance of staging and daily contact once the for sale sign went up.","As a first time home buyer he was very patient with all of our questions and took time to explain the process every step of the way. Always willing to show us any property we were interested at a time the worked best for our schedules. Overall very friendly and helpful. I am so glad he was able to help us find our first home with very little stress, I will definitely be recommending him to family and friends.","Showed us a bunch of homes for months until we found the right one. Gave us a ton of contacts to help us throughout the process. And even now after the home has already been closed on he is still helping with any problems or questions we have. Extremely helpful and knowledgeable in any facet of home buying/owning.","They were a great team and extremely helpful with selling my house quickly. I was able to do everything online with them. They facilitated repairs and getting rid of things in the house. This was so helpful since I live out of the area."]';
      $_POST['testimonials_name']='["Richard & Susan","Lance & Amanda"," Allison & Eli","Mario & Courtney"]';
      $_POST['bio']='Ad renatuasta, con vignonferor horum in dem morunt. Scibull atiam. Uli, conlostil ta iti, quod di sentem mum, sentesimis?Patis etili, quo aperfi nia viricii speriore noverem eretius cus, vis etemquem dent? Ici ine audees parbemus, consulistra consis. Aritra acre faciendius et? que furi tum non. Tion cus periate ctatemolut laute quam as ea coribearum quam, autate si tem quiae porrundionet quas etur sequatur moloreperum sequost.';
      $_POST['pdfID']='';
      $_POST['pdfPages']=implode(',', range(1,40)) ;
      $_POST['showpartner']='undefined';
      $_POST['showpartner']='on';
      $_POST['custom_comps']='["0","1","2","6","7","8","9","10"]';
      $_POST['use_rets_api']=0;
      $_POST['print_html']=1;
      if(isset($_GET['action']) && $_GET['action']='pdf') {
        $_POST['print_html']=0;
      }
      $response = $this->reports->getPropertyDataForWidget();
}

}