<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
require 'Twilio/autoload.php';
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;
// stripe library
require APPPATH.'/libraries/Stripe.php';
require 'vendor/autoload.php';

use Knp\Snappy\Pdf;

class User extends CI_Controller
{
   // Initialize Constructor Here
    function __construct() {
        parent::__construct();        
 		$this->load->library('phpmailer');		
   
    }
    //    ramdon string function
    private function generateRandomString() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
    }
	
	public function email_test(){
		echo 'calling herre ';
		$this->load->library('phpmailer');
		$from_name = 'noreply';
		$from_mail = 'info@modernagent.io';
		$replyto = 'info@modernagent.io';
		$message = 'This is dummy message here'; 
		$subject = 'test email';
		$filename = 'dummy.pdf';
		echo $file = base_url().'application/'.$filename;
		
		$this->load->helper('sendemail');
		
		send_email('noreply@modernagent.io','No Reply', $replyto, $subject, $message, array($file));
	}
	
    public function upload_file($type){
       $status = "";
       $msg = "";
       $fileuri='';
       $file_element_name = 'fileToUpload';
        
       $userId = $this->session->userdata('userid'); 
       if ($status != "error")
       {
          $config['upload_path'] = 'assets/images/';
          $config['allowed_types'] = 'gif|jpg|png|doc|txt';
          $config['max_size']  = 2048;

          if ($type == '') {
            $config['encrypt_name'] = TRUE;
          } else if ($type == 'profile-image') {
            $new_name = 'user_'.$userId.'_'.time().rand(10,100000);
            $config['file_name'] = $new_name;
          } else if ($type == 'company-image') {
            $new_name = 'user_company_'.$userId.'_'.time().rand(10,100000);
            $config['file_name'] = $new_name;
          }
     
          $this->load->library('upload', $config);
     
          if (!$this->upload->do_upload($file_element_name))
          {
             $status = 'error';
             $msg = $this->upload->display_errors('', '');
          }
          else
          {
             $data = $this->upload->data();
             $status = "success";
             $msg = "File successfully uploaded";
             $fileuri=  $config['upload_path'].$data['file_name'];

              if ($userId) {
                $user_old_details = $this->base_model->get_record_by_id('lp_user_mst', ['user_id_pk'=>$userId], ['profile_image', 'company_logo']);
                if ($type == 'profile-image') {
                  $this->base_model->update_record_by_id('lp_user_mst',array('profile_image'=>$fileuri),array('user_id_pk'=>$userId));
                  if ($user_old_details->profile_image != '' && file_exists(FCPATH.'/'.$user_old_details->profile_image)) {
                    $deleted = unlink(FCPATH.'/'.$user_old_details->profile_image);     
                  }
                } else if ($type == 'company-image') {
                  $this->base_model->update_record_by_id('lp_user_mst',array('company_logo'=>$fileuri),array('user_id_pk'=>$userId));
                  if ($user_old_details->company_logo != '' && file_exists(FCPATH.'/'.$user_old_details->company_logo)) {
                    $deleted = unlink(FCPATH.'/'.$user_old_details->company_logo); 
                  }
                }
              }
          }
       }
       if($fileuri!=''){
           echo json_encode(array('status' => $status, 'msg' => $msg,'fileuri'=>$fileuri ) );
       }else{
           echo json_encode(array('status' => $status, 'msg' => $msg, 'message' =>'file not uploaded'));
       }
       
    }

    public function getSvg($pid,$fid){
      $condition = array('product_id_pk'=>$pid);
      $result = $this->base_model->get_all_record_by_condition('lp_product_mst', $condition);
      echo $result[0]->product_content;
    }


    public function logout(){
        die("Method depricated. Moved to auth controller");
      $this->session->sess_destroy();
      redirect(site_url());
    }

    // dashboard widget for he user
    public function dashboard_widget(){        
      $requestData = $this->input->get();
      if(array_key_exists('callback', $requestData )){
          if($requestData['callback'] == 'dashboard_widget'){
            if($requestData['ac_id']){
              // getting the current user Info
              $userInfo = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $requestData['ac_id']));

              $tableName = "lp_user_mst";
              $user = $this->base_model->get_login_data_from_id( $tableName,'user_id_pk', $requestData['ac_id']); 
              if($user){
                // user login
                if ($user->is_active == 'Y') {
                  $newdata = array(
                    'userid'    => $user->user_id_pk,
                    'username'  => ucfirst($user->first_name).' '.ucfirst($user->last_name),
                    'user_email'     => $user->email,
                    'logged_in' => TRUE
                  );
                  $sessionData = $this->session->set_userdata($newdata);
                }
              }

              if(!empty($userInfo)){
                $userDetails = $userInfo[0];
              }
              $userId = $userDetails['user_id_pk'];
              $data['title'] = "Dashboard";
              $data['current'] = "dashboard";
              $userId = $data['user_id'] = $userDetails['user_id_pk'];
              $userName = $data['user_name'] = $userDetails['user_name'];
              
              $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
              $data['topReports'] = $this->base_model->get_all_record_by_id('lp_my_listing', array('user_id_fk' => $userId),'project_date','desc');
              $data['reports'] = $this->base_model->get_all_record_by_id('lp_my_listing', 
                                              array(
                                                  'user_id_fk' => $userId,
                                                  'is_active' => 'Y'
                                              ),
                                              'project_date','desc'
                                            );

              $data['agentInfo'] = $this->base_model->get_record_by_id('lp_user_mst',
                                      array(
                                        'user_id_pk'=>$userId
                                  ));
              $data['reportTemplates'] = $this->base_model->all_records('lp_report_templates');  
              $this->load->model('package_model');
              $data['report_price'] = $this->package_model->get_reports_price();
              $html = $this->load->view('user/dashboard_widget', $data, true);
              

              
              $newData['html'] = $html;

              header('Content-Type: text/javascript; charset=utf8');
              header('Access-Control-Allow-Origin: http://localhost/mylistingpitch');
              header('Access-Control-Max-Age: 3628800');
              header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

              
              echo json_encode($newData);
            }else{
              // normal JSON string or show an error
              header('Content-Type: application/json; charset=utf8');
              $data['html'] = 'ERROR: Access denied, you are not authorized to use this widget.';
              echo json_encode($data);
            }
          }else{
            // normal JSON string or show an error
            header('Content-Type: application/json; charset=utf8');
            $data['html'] = 'ERROR: The widget type is not comprehensible.';
            echo json_encode($data);
          }
      }else{
          // normal JSON string or show an error
          header('Content-Type: application/json; charset=utf8');
          $data['html'] = 'ERROR: The widget is not configured properly.';
          echo json_encode($data);
      }
    }

    // User dashboard view
    public function dashboard(){
      // show only when the user is logged in
      if($this->session->userdata('userid')){
        $data['title'] = "Dashboard";
        $data['current'] = "dashboard";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        
        $userName = $data['user_name'] = $this->session->userdata('username');
        
        $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
        $data['topReports'] = $this->base_model->get_all_record_by_id('lp_my_listing', array('user_id_fk' => $userId),'project_date','desc');
        $data['reports'] = $this->base_model->get_all_record_by_id('lp_my_listing', 
                                        array(
                                            'user_id_fk' => $this->session->userdata('userid'),
                                            'is_active' => 'Y'
                                        ),
                                        'project_date','desc'
                                      );

        $data['agentInfo'] = $this->base_model->get_record_by_id('lp_user_mst',
                                array(
                                  'user_id_pk'=>$this->session->userdata('userid')
                            ));
        $data['reportTemplates'] = $this->base_model->all_records('lp_report_templates');  

        $this->load->model('package_model');
        $data['report_price'] = $this->package_model->get_reports_price();

        $this->load->helper('captcha');
        create_image();
        $this->load->view('user/header', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('user/footer');
      }else{
        // else redirect to frontend login
        redirect('frontend/login');
      }
    }

    public function getReportsListing()
    {
        $userId = $this->session->userdata('userid');
        if ($userId) {
            $columns = [
                'project_date', 
                'project_id_pk',
                'project_name',
                'report_type',
                'action'                      
            ];      
            $this->load->model('user_model');
            $recordsTotal = $this->user_model->user_reports_count($userId, $_POST);
            $result = $this->user_model->user_reports_data($userId, $columns, $_POST);

            $i = $_POST['start'];
            $data = [];
            foreach($result as $report) {
                $i++;
                $reportDate = date("m/d/Y", strtotime($report['project_date']));

                $action = '';
                $action .= ' <a href="'.base_url().$report['report_path'].'" download target="_blank"><i data-toggle="tooltip" title="Download" class="icon icon-download"></i></a>
                <a href="javascript:void(0);" target="_blank" data-toggle="modal" data-target="#forward-report" title="Forward" data-id="'.$report['project_id_pk'].'"><i data-toggle="tooltip" title="Email" class="icon icon-share"  ></i></a>
                <a href="javascript:void(0);" onclick="delete_lp(\''.$report['project_id_pk'].'\', \'1\')"><i data-toggle="tooltip" title="Delete" class="icon icon-remove-circle"></i></a>';
                
                $data[] = [
                    $reportDate, 
                    $report['project_id_pk'] . '-' . $report['property_owner'], 
                    $report['project_name'], 
                    ucfirst($report['report_type']), 
                    $action
                ];
            }
            
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsTotal,
                "data" => $data,
            );    
            echo json_encode($output);
        } else {
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );    
            echo json_encode($output);
        }
    }

    public function getPartners(){
      
      if($this->session->userdata('userid')){

        $this->load->model('base_model');
        $user_partners = $this->base_model->get_all_record_by_condition('lp_partner_details',array('user_id_fk'=>$this->session->userdata('userid')));
        echo json_encode($user_partners);
      }else{
        echo json_encode(array('status'=>'failed','message'=>'unauthrized access'));
      }
    }


    // How to
    public function howto(){
      $data['current'] = "howto";
      if($this->session->userdata('userid')){
          $this->load->helper('captcha');
          create_image();
          $this->load->view('user/header', $data);
          $this->load->view('user/howto', $data);
          $this->load->view('user/footer');
      }else{
        redirect('frontend/index');
      }
    }


    // all listings
    public function recentlp(){
      // show only when the user is logged in
      if($this->session->userdata('userid')){
        $data['current'] = "recentlp";
        $data['title'] = "Recent Lp's";
        $this->load->helper('captcha');
        create_image();  
        $this->load->view('user/header',$data);
        $this->load->view('user/all_listings',$data);
        $this->load->view('user/footer');
      }else{
        // else redirect to frontend login
        redirect('frontend/login');
      }
    }
    // all leads
    public function leads(){
      // show only when the user is logged in
        $userId = $this->session->userdata('userid');
      if($userId){
        $data['current'] = "leads";
        $data['title'] = "My Leads";
        $this->load->model('user_model');
        $data['ref_code'] = $this->user_model->has_ref_code($userId);
        $data['leads'] = $this->user_model->get_leads($userId);
        $this->load->view('user/header',$data);
        $this->load->view('user/leads',$data);
        $this->load->view('user/footer');
      }else{
        // else redirect to frontend login
        redirect('frontend/login');
      }
    }

    public function getLeadListing()
    {
        $userId = $this->session->userdata('userid');
        if ($userId) {
            $columns = [
                'created_at', 
                'phone_number',
                'project_id_pk',
                'project_name',
                'report_type',
                'action'                      
            ];      
            $this->load->model('user_model');
            $recordsTotal = $this->user_model->get_leads_count($userId, $_POST);
            $result = $this->user_model->get_leads_data($userId, $columns, $_POST);

            $i = $_POST['start'];
            $data = [];
            foreach($result as $lead) {
                $i++;
                $leadDate = date("m/d/Y", strtotime($lead['created_at']));

                $action = '';
                $action .= '<a href="'.base_url().$lead['report_path'].'" download target="_blank"><i data-toggle="tooltip" title="Download" class="icon icon-download"></i></a>';
                
                $data[] = [
                    $leadDate, 
                    $lead['phone_number'], 
                    $lead['project_id_pk'] . '-' . $lead['property_owner'], 
                    $lead['project_name'], 
                    ucfirst($lead['report_type']), 
                    $action
                ];
            }
            
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsTotal,
                "data" => $data,
            );    
            echo json_encode($output);
        } else {
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );    
            echo json_encode($output);
        }
    }

    // all leads
    public function flyers(){
      // show only when the user is logged in
        $userId = $this->session->userdata('userid');
      if($userId){
        $data['current'] = "flyers";
        $data['title'] = "Flyers";
        
        $this->load->model('user_model');
        
        $this->load->view('user/header',$data);
        $this->load->view('user/flyers',$data);
        $this->load->view('user/footer');
      }else{
        // else redirect to frontend login
        redirect('frontend/login');
      }
    }

    // My Account
    public function myaccount(){
      $data['current'] = "myaccount";
      $data['title'] = "My Account";
      if($this->session->userdata('userid')){
          $this->load->helper('captcha');
          create_image();
          $data['agentInfo'] = $this->base_model->get_record_by_id('lp_user_mst',
                                                                    array(
                                                                      'user_id_pk'=>$this->session->userdata('userid')
                                                                    ));
          $data['reportTemplates'] = $this->base_model->all_records('lp_report_templates');  
          $this->load->library('stripe');
          $stripe = new Stripe(null);
          try{
              $response = json_decode($stripe->plan_info('prem_lp_user'));
          }catch(Exception $e){
              print_r($e);
          }
          if(isset($response->id)){
              $data['plan']['id'] = $response->id;
              $data['plan']['name'] = $response->name;
              $data['plan']['amount'] = $response->amount;
              $data['plan']['interval'] = $response->interval;
          }
          // print_r($data['agentInfo']);
          $this->load->view('user/header', $data);
          $this->load->view('user/myaccount', $data);
          $this->load->view('user/footer');
      }else{
        redirect('frontend/index');
      }
    }
    public function pay_subscription(){
        $userId = $this->session->userdata('userid');
        $this->load->library('stripe');
        $stripe = new Stripe( null );
        $card = $this->input->post('stripeToken');
        $email = $this->input->post('email');
        $plan = $this->input->post('plan_id');
        $desc = 'Subscription Payment';
        try{
            $response = json_decode($stripe->customer_create( $card, $email, $desc, $plan));
        }catch(Exception $e){
            print_r($e);
        }
        if($response->id) {
            $this->base_model->update_record_by_id('lp_user_mst',array('customer_id'=>$response->id),array('user_id_pk'=>$userId));
            $plans = $this->fetchPlansData($response->subscriptions);
            echo json_encode(array('status'=>true,'data'=>$plans[0],'message'=>"Subscribed successfully"));
        } else {
            echo json_encode(array('status'=>false,'message'=>"Failed to subscribe."));
        }
    }


    public function update_defaulttheme(){
      if($this->session->userdata('userid')){

        
        $theme=$_POST['theme'];


          $data = array(
                          'default_template' =>$theme 
                        );
          $where = array(
                                'user_id_pk' => $this->session->userdata('userid')
                                );
          $this->base_model->update_record_by_id('lp_user_mst',$data,$where);
          echo json_encode(array('status'=>'success','message'=>'Agent information updated successfully!'));
        // }

      }else{
        echo json_encode(array('status'=>'failed','message'=>'unauthrized access'));
      }      
    }

    public function update_agentinfo(){
      if($this->session->userdata('userid')){

        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $profile_image=$_POST['profile_image'];
        $website = $_POST['website'];
        $license = $_POST['license'];
        $title = $_POST['title'];
        
          $data = array(
                          'first_name' =>$first_name ,
                          'last_name' =>$last_name ,
                          'email' =>$email ,
                          'phone' =>$phone ,
                          'profile_image' =>$profile_image , 
                          'website' =>$website,
                          'license_no'=>$license,
                          'title' =>$title 
                        );
          $where = array(
                                'user_id_pk' => $this->session->userdata('userid')
                                );
          $this->base_model->update_record_by_id('lp_user_mst',$data,$where);
          echo json_encode(array('status'=>'success','message'=>'Agent information updated successfully!'));
        

      }else{
        echo json_encode(array('status'=>'failed','message'=>'unauthrized access'));
      }      
    }


    public function update_copmpanyinfo(){
      if($this->session->userdata('userid')){

        $company_name=$_POST['company_name'];
        $company_add=$_POST['company_add'];
        $company_city=$_POST['company_city'];
        $comapny_zip=$_POST['comapny_zip'];
        $company_state=$_POST['company_state'];
        $company_phone = $_POST['company_phone'];
        $company_logo = $_POST['company_logo'];
        
          $data = array(
                          'company_name' =>$company_name ,
                          'company_add' =>$company_add ,
                          'company_city' =>$company_city ,
                          'comapny_zip' =>$comapny_zip ,
                          'company_state' =>$company_state , 
                          'company_phone' =>$company_phone ,
                          'company_logo' => $company_logo
                        );
          $where = array(
                                'user_id_pk' => $this->session->userdata('userid')
                                );
          $this->base_model->update_record_by_id('lp_user_mst',$data,$where);
          echo json_encode(array('status'=>'success','message'=>'Company information updated successfully!'));
        

      }else{
        echo json_encode(array('status'=>'failed','message'=>'unauthrized access'));
      }      
    }


    public function update_billinginfo(){
      if($this->session->userdata('userid')){

        $billing_name=$_POST['billing_name'];
        $billing_cvv_code=$_POST['billing_cvv_code'];
        $billing_creadit_card_no=$_POST['billing_creadit_card_no'];
        $billing_zipcode=$_POST['billing_zipcode'];
        
          $data = array(
                          'billing_name' =>$billing_name ,
                          'billing_cvv_code' =>$billing_cvv_code ,
                          'billing_creadit_card_no' =>$billing_creadit_card_no ,
                          'billing_zipcode' =>$billing_zipcode 
                        );
          $where = array(
                                'user_id_pk' => $this->session->userdata('userid')
                                );
          $this->base_model->update_record_by_id('lp_user_mst',$data,$where);
          echo json_encode(array('status'=>'success','message'=>'Billing information updated successfully!'));
        

      }else{
        echo json_encode(array('status'=>'failed','message'=>'unauthrized access'));
      }      
    }



    // Billing History
    public function billing(){
      if($this->session->userdata('userid')){
		 $data['current'] = "billing";

          $this->load->model('dashboard_model');
          $this->load->helper('captcha');
          create_image();
          $data['billings'] = $this->dashboard_model->getBillingHistory($this->session->userdata('userid'));
          $this->load->view('user/header', $data);
          $this->load->view('user/billing-history', $data);
          $this->load->view('user/footer');
      }else{
        redirect('frontend/index');
      }
    }

    public function getBillingHistory()
    {
        $userId = $this->session->userdata('userid');
        if ($userId) {
            $columns = [
                'invoice_date', 
                'invoice_amount',
                'property_address',
                'property_apn',
                'action'                      
            ];      
            $this->load->model('dashboard_model');
            $recordsTotal = $this->dashboard_model->get_billing_history_count($userId, $_POST);
            $result = $this->dashboard_model->get_billing_history_data($userId, $columns, $_POST);

            $i = $_POST['start'];
            $data = [];
            foreach($result as $bill) {
                $i++;
                $billDate = date("m/d/Y", strtotime($bill['invoice_date']));

                $action = '';
                if (!empty($bill['invoice_pdf'])) {
                  if (file_exists($bill['invoice_pdf'])) {
                    $action = '<a href="'.base_url().$bill['invoice_pdf'].'" class="btn btn-lp receipt" target="_blank">Print Receipt</a>';
                  } else {
                    $invoice_generate_url = site_url().'/user/download_invoice/'.$bill['invoice_num'].'/'.$bill['user_id_fk'];
                    $action = '<a href="'.$invoice_generate_url.'" class="btn btn-lp receipt" target="_blank">Print Receipt</a>';
                  }
                } 

                $data[] = [
                    $billDate, 
                    '$'.number_format($bill['invoice_amount'], 2),
                    $bill['property_address'], 
                    $bill['property_apn'], 
                    $action
                ];
            }
            
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsTotal,
                "data" => $data,
            );    
            echo json_encode($output);
        } else {
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );    
            echo json_encode($output);
        }
    }

    // User account view
    public function account()
    {
        $data['title'] = "Account";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($this->session->userdata('userid')){
          $this->load->helper('captcha');
          create_image();
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $data['members'] = $this->base_model->count_rows_by_id($userId);          
          $this->load->view('user/header', $data);
          $this->load->view('user/account', $data);
          $this->load->view('user/footer');
        }else{
          redirect('frontend/index');
        }
    }
    // my favorites
    public function favorite()
    {
      $data['title'] = "My Favorites";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($this->session->userdata('userid')){
          $this->load->helper('captcha');
          create_image();
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $data['members'] = $this->base_model->count_rows_by_id($userId);          
          $this->load->view('user/header', $data);
          $this->load->view('user/myfavorites', $data);
          $this->load->view('user/footer');
        }else{
          redirect('frontend/index');
        }
    }
    // agent info edit
    public function agent_info_edit()
    {
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
            if($_POST){ 
              
                $postedArr = $this->security->xss_clean($_POST);
                $userid = mysql_real_escape_string($postedArr['userid']);
                $fname = mysql_real_escape_string($postedArr['fname']);
                $lname = mysql_real_escape_string($postedArr['lname']);
                $ulicence = mysql_real_escape_string($postedArr['ulicence']);
                $uemail = mysql_real_escape_string($postedArr['uemail']);
                $uphone = mysql_real_escape_string($postedArr['uphone']);
                $fileset = $_FILES['fileToUpload']['name'];
                if($fileset != ""){
                    // image upload
                    $status = "";
                    $msg = "";
                    $fileuri='';
                    $file_element_name = 'fileToUpload';
                    if ($status != "error"){
                       $config['upload_path'] = './assets/uploads/agent_img/';
                       $config['allowed_types'] = 'gif|jpg|png';
                       $config['max_size']  = 10240;
                       $config['encrypt_name'] = TRUE;
                       $this->load->library('upload', $config);
                       if (!$this->upload->do_upload($file_element_name)){
                          $status = 'error';
                          $msg = $this->upload->display_errors('', '');
                       }else{
                          $data = $this->upload->data();
                          $status = "success";
                          $msg = "File successfully uploaded";
                          $fileuri= $data['file_name'];
                          $uploadedFolderPath = 'assets/uploads/agent_img/';
                          // update row
                          if($status == "success"){
                            // agent update
                            $data2 = array(
                                'first_name' => $fname,                
                                'last_name' => $lname,                
                                'email'=>$uemail,
                                'mobile'=>  $uphone,                
                                'license_no' => $ulicence,
                                'profile_image' => $uploadedFolderPath.$fileuri                                
                            );
                            $where = array(
                                'user_id_pk' => $userid
                                );
                            // get old agent image
                            $getImgUrl = $this->base_model->get_record_by_id('lp_user_mst', array('user_id_pk'=>$userid));
                            // delete old image
                            @unlink($getImgUrl->profile_image);
                                
                            $result = $this->base_model->update_record_by_id('lp_user_mst',$data2,$where); 
                            if($result){  
                                $resp = array("status"=>"success","msg"=>"Agent info edited successfully.","profile_image" => $uploadedFolderPath.$fileuri);
                                echo json_encode($resp);
                            }else{
                                $resp = array("status"=>"error","msg"=>"Agent info could not be edited.");
                                echo json_encode($resp);
                            }
                          }
                       }
                   }
                }else{
                    $data2 = array(
                        'first_name' => $fname,                
                        'last_name' => $lname,                
                        'email'=>$uemail,
                        'mobile'=>  $uphone,                
                        'license_no' => $ulicence                              
                    );
                    $where = array(
                        'user_id_pk' => $userid
                        );                  
                    $result = $this->base_model->update_record_by_id('lp_user_mst',$data2,$where); 
                    if($result){
                      $getImgUrl = $this->base_model->get_record_by_id('lp_user_mst', array('user_id_pk'=>$userid));
                        $resp = array("status"=>"success","msg"=>"Agent info edited successfully.","profile_image" => $getImgUrl->profile_image);
                        echo json_encode($resp);                       
                    }else{
                        $resp = array("status"=>"error","msg"=>"Agent info could not be edited.");
                        echo json_encode($resp);
                    }
                } 
            }
        }else{
           redirect('frontend/index');
        }
    }
    // company info edit
    public function company_info_edit()
    {
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
            if($_POST){ 
                $postedArr = $this->security->xss_clean($_POST);
                $userid = mysql_real_escape_string($postedArr['userid']);
                $cname = mysql_real_escape_string($postedArr['cname']);
                $cadd = mysql_real_escape_string($postedArr['cadd']);
                $suiteno = mysql_real_escape_string($postedArr['suiteno']);
                $ccity = mysql_real_escape_string($postedArr['ccity']);
                $companystate = mysql_real_escape_string($postedArr['companystate']);
                $czip = mysql_real_escape_string($postedArr['czip']);
                $phoneno = mysql_real_escape_string($postedArr['phoneno']);
                $fileset = $_FILES['fileToUpload']['name'];
                if($fileset != ""){
                    // image upload
                    $status = "";
                    $msg = "";
                    $fileuri='';
                    $file_element_name = 'fileToUpload';
                    if ($status != "error"){
                       $config['upload_path'] = './assets/uploads/agent_company_logo/';
                       $config['allowed_types'] = 'gif|jpg|png';
                       $config['max_size']  = 10240;
                       $config['encrypt_name'] = TRUE;
                       $this->load->library('upload', $config);
                       if (!$this->upload->do_upload($file_element_name)){
                          $status = 'error';
                          $msg = $this->upload->display_errors('', '');
                       }else{
                          $data = $this->upload->data();
                          $status = "success";
                          $msg = "File successfully uploaded";
                          $fileuri= $data['file_name'];
                          $uploadedFolderPath = 'assets/uploads/agent_company_logo/';
                          // update row
                          if($status == "success"){
                            // agent update
                            $data2 = array(
                                'company_name' => $cname,                
                                'company_add' => $cadd,                
                                'company_suite'=>$suiteno,
                                'company_city'=>  $ccity,    
                                'company_state'=>  $companystate,  
                                'comapny_zip'=>  $czip,              
                                'company_phone' => $phoneno,
                                'company_logo' => $uploadedFolderPath.$fileuri                                
                            );
                            $where = array(
                                'user_id_pk' => $userid
                                );
                            // get old agent image
                            $getImgUrl = $this->base_model->get_record_by_id('lp_user_mst', array('user_id_pk'=>$userid));
                            // delete old image
                            @unlink($getImgUrl->company_logo);
                               
                            $result = $this->base_model->update_record_by_id('lp_user_mst',$data2,$where); 
                            if($result){  
                                $resp = array("status"=>"success","msg"=>"Company info edited successfully.");
                                echo json_encode($resp);
                            }else{
                                $resp = array("status"=>"error","msg"=>"Company info could not be edited.");
                                echo json_encode($resp);
                            }
                          }
                       }
                   }
                }else{
                    $data2 = array(
                        'company_name' => $cname,                
                        'company_add' => $cadd,                
                        'company_suite'=>$suiteno,
                        'company_city'=>  $ccity,    
                        'company_state'=>  $companystate,  
                        'comapny_zip'=>  $czip,              
                        'company_phone' => $phoneno                               
                    );
                    $where = array(
                        'user_id_pk' => $userid
                        );                  
                    $result = $this->base_model->update_record_by_id('lp_user_mst',$data2,$where); 
                    if($result){
                        $resp = array("status"=>"success","msg"=>"Company info edited successfully.");
                        echo json_encode($resp);                       
                    }else{
                        $resp = array("status"=>"error","msg"=>"Company info could not be edited.");
                        echo json_encode($resp);
                    }
                } 
            }
        }else{
           redirect('frontend/index');
        }
    }
    // user old password
    public function get_password()
    {
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
            $old = $this->base_model->get_password($userId);
            $resp = array('status' => 'success' , 'data' =>  $old[0]['password'] );
            echo json_encode($resp);
        }  
    }
    // user password update
    public function update_password()
    {
        $userId = $data['user_id'] = $this->session->userdata('userid'); 
        if($userId) {  
            
            $result = $this->base_model->get_record_by_id('lp_user_mst' , array('email'=>$_POST['email'], 'password'=>$_POST['old_password']));
            
            if($result){
              $this->base_model->update_record_by_id('lp_user_mst', array('password'=>$_POST['new_password']), array('user_id_pk'=>$result->user_id_pk));
              $resp = array('status'=>'success', 'message'=>'Updated successfully');
            }else{
              $resp = array('status'=>'failed', 'message'=>'Your current password invalid please enter a valid password!');
            }
        }else{
          $resp = array('status'=>'failed', 'message'=>'unauthrized access!');
        }             

        echo json_encode($resp);
    }
    // agent member add function
    public function agent_member_add()
    {
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
            if($_POST){ 
                $postedArr = $this->security->xss_clean($_POST);
                
                $userid = mysql_real_escape_string($postedArr['userid']);
                $fname = mysql_real_escape_string($postedArr['fname']);
                $lname = mysql_real_escape_string($postedArr['lname']);
                $licence = mysql_real_escape_string($postedArr['licenseno']);
                $email = mysql_real_escape_string($postedArr['email']);
                $mobile = mysql_real_escape_string($postedArr['mobileno']);  
                $random_password = $this->generateRandomString(); 
                // check parent id exist
                $table = "lp_user_mst";
                $where = array( 'parent_id' => $userid );
                $resultCheck = $this->base_model->check_existent($table,$where);
                if(!$resultCheck){
                  // check 
                  $where2 = array('email'=> $email);
                  $resultCheck2 = $this->base_model->check_existent($table,$where2);
                  if(!$resultCheck2){
                    // image upload
                    $status = "";
                    $msg = "";
                    $fileuri='';
                    $file_element_name = 'fileToUpload';
                    if ($status != "error"){

                       $config['upload_path'] = './assets/uploads/agent_img/';
                       $config['allowed_types'] = 'gif|jpg|png';
                       $config['max_size']  = 10240;
                       $config['encrypt_name'] = TRUE;

                       $this->load->library('upload', $config);

                       if (!$this->upload->do_upload($file_element_name)){
                          $status = 'error';
                          $msg = $this->upload->display_errors('', '');
                       }else{
                          $data = $this->upload->data();
                          $status = "success";
                          $msg = "File successfully uploaded";
                          $fileuri= $data['file_name'];
                          $uploadedFolderPath = 'assets/uploads/agent_img/';
                          // member add
                          $getUser = $this->base_model->get_record_by_id('lp_user_mst', array('user_id_pk'=>$userid));

                            $data2 = array(
                                'first_name' => $fname,                
                                'last_name' => $lname,                
                                'email'=>$email,
                                'password' => $random_password,
                                'mobile'=>  $mobile,                
                                'license_no' => $licence,
                                'profile_image' => $uploadedFolderPath.$fileuri,
                                'parent_id' => $userid,
                                // company info
                                'company_name' => $getUser->company_name,                
                                'company_add' => $getUser->company_add,                
                                'company_suite'=>$getUser->company_suite,
                                'company_city'=>  $getUser->company_city,    
                                'company_state'=>  $getUser->company_state,  
                                'comapny_zip'=>  $getUser->comapny_zip,              
                                'company_phone' => $getUser->company_phone,
                                'company_logo' => $getUser->company_logo  
                            );
							
							
                           
                            if($result){  
                                $resp = array("status"=>"success","msg"=>"Agent Member added successfully.");
								echo json_encode($resp);
                            }else{
                                $resp = array("status"=>"error","msg"=>"Agent Member could not be edited.");
                                echo json_encode($resp);
                            }                        
                       }
                   }else{
                    $resp = array(
                          'status'=>'error',
                          'msg'=>'File upload error.'
                      );
                      echo json_encode($resp);
                   }
                   // file error
                  }else{
                    $resp = array(
                        'status'=>'error',
                        'msg'=>'Member email already exists.'
                    );
                    echo json_encode($resp);
                  }                  
                }else{
                  $resp = array(
                      'status'=>'error',
                      'msg'=>'Already! You have a member.'
                  );
                  echo json_encode($resp);
                }                    
            } 
            // post ends
        }else{
           redirect('frontend/index');
        }
    }
    // member info edit
    public function member_info_edit()
    {
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
            if($_POST){ 
                $postedArr = $this->security->xss_clean($_POST);
               
                $userid = mysql_real_escape_string($postedArr['userid']);
                $fname = mysql_real_escape_string($postedArr['fname']);
                $lname = mysql_real_escape_string($postedArr['lname']);
                $licenseno = mysql_real_escape_string($postedArr['licenseno']);
                $email = mysql_real_escape_string($postedArr['email']);
                $mobileno = mysql_real_escape_string($postedArr['mobileno']);
                $fileset = $_FILES['fileToUpload']['name'];
                if($fileset != ""){
                    // image upload
                    $status = "";
                    $msg = "";
                    $fileuri='';
                    $file_element_name = 'fileToUpload';
                    if ($status != "error"){
                       $config['upload_path'] = './assets/uploads/agent_img/';
                       $config['allowed_types'] = 'gif|jpg|png';
                       $config['max_size']  = 10240;
                       $config['encrypt_name'] = TRUE;
                       $this->load->library('upload', $config);
                       if (!$this->upload->do_upload($file_element_name)){
                          $status = 'error';
                          $msg = $this->upload->display_errors('', '');
                       }else{
                          $data = $this->upload->data();
                          $status = "success";
                          $msg = "File successfully uploaded";
                          $fileuri= $data['file_name'];
                          $uploadedFolderPath = 'assets/uploads/agent_img/';
                          // update row
                          if($status == "success"){
                            // agent update
                            $data2 = array(
                                'first_name' => $fname,                
                                'last_name' => $lname,                
                                'email'=>$email,
                                'mobile'=>  $mobileno,                
                                'license_no' => $licenseno,
                                'profile_image' => $uploadedFolderPath.$fileuri                                
                            );
                            $where = array(
                                'user_id_pk' => $userid
                                );
                            // get old agent image
                            $getImgUrl = $this->base_model->get_record_by_id('lp_user_mst', array('user_id_pk'=>$userid));
                            // delete old image
                            @unlink($getImgUrl->profile_image);
                            
                            $result = $this->base_model->update_record_by_id('lp_user_mst',$data2,$where); 
                            if($result){  
                                $resp = array("status"=>"success","msg"=>"Agent Member info edited successfully.","profile_image" => $uploadedFolderPath.$fileuri);
                                echo json_encode($resp);
                            }else{
                                $resp = array("status"=>"error","msg"=>"Agent Member info could not be edited.");
                                echo json_encode($resp);
                            }
                          }
                       }
                   }
                }else{
                    $data2 = array(
                        'first_name' => $fname,                
                        'last_name' => $lname,                
                        'email'=>$email,
                        'mobile'=>  $mobileno,                
                        'license_no' => $licenseno                              
                    );
                    $where = array(
                        'user_id_pk' => $userid
                        );                  
                    $result = $this->base_model->update_record_by_id('lp_user_mst',$data2,$where); 
                    if($result){
                      
                        $resp = array("status"=>"success","msg"=>"Agent Member info edited successfully.");
                        echo json_encode($resp);                       
                    }else{
                        $resp = array("status"=>"error","msg"=>"Agent Member info could not be edited.");
                        echo json_encode($resp);
                    }
                } 
            }
        }else{
           redirect('frontend/index');
        }
    }
    // mymember list
    public function mymember()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          if($_POST["type"] == "mymember"){                
                $getMember= $this->base_model->get_record_by_id('lp_user_mst', array('parent_id'=>$userId));                
                if($getMember->parent_id){
                  $mymember ='<table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-md-3">Member Pic</th>
                                        <th class="col-md-3">Member name</th>
                                        <th class="col-md-3">Member email </th>
                                        <th class="col-md-3 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img class="img-responsive" width="100" height="100" src="'.site_url().$getMember->profile_image.'" alt="" title=""/></td>
                                        <td><b class="text-info">'.$getMember->first_name.' '.$getMember->last_name.'</b></td>
                                        <td><b>'.$getMember->email.'</b></td>
                                        <td align="right">
                                          <a href="'.site_url().'user/member_view/'.$getMember->user_id_pk.'" class="btn btn-info "><i class="fa fa-eye"></i> View</a>
                                          <a href="'.site_url().'user/member_edit/'.$getMember->user_id_pk.'" class="btn btn-warning "><i class="fa fa-edit"></i> Edit</a>
                                          <a href="#" onclick="deleteuser('.$getMember->user_id_pk.');" class="btn btn-danger"><i class="fa fa-times"></i> Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>';
                            $resp = array(
                              'status' => 'success', 
                              'mymember' => $mymember 
                              );
                            echo json_encode($resp);
                          }else{
                            $mymember ='<span class="table table-hover">No data</span>';
                            $resp = array(
                              'status' => 'success', 
                              'mymember' => $mymember 
                              );
                            echo json_encode($resp);
                          } 
            }else{
                $resp = array(
                  'status' => 'error', 
                  'msg' => 'Invalid Request.' 
                  );
                echo json_encode($resp);
            } 
        }else{
        redirect('frontend/index');
      }
    }
    // member list view
    public function member_view($mid)
    {
        $data['title'] = "Member view";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($this->session->userdata('userid')){          
          $data['members'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $mid));
          $this->load->view('user/header', $data);
          $this->load->view('user/member_view', $data);
          $this->load->view('user/footer');
        }else{
          redirect('frontend/index');
        }
        
    }
    // member edit view
    public function member_edit($mid)
    {
        $data['title'] = "Member Edit";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($this->session->userdata('userid')){          
          $data['members'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $mid));
          $this->load->view('user/header',$data);
          $this->load->view('user/member_edit',$data);
          $this->load->view('user/footer');
        }else{
          redirect('frontend/index');
        }
        
    }
    // delete user
    public function member_delete($id)
    {
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
            $delResult = $this->admin_model->deleteuser($id); 
            if($delResult){
                $resp = array('status' => 'success', 'msg' => 'User deleted successfully.' );
                echo json_encode($resp);
            }           
        }
        else{
            redirect('frontend/index');
        }
    } 

    
    public function orders()
    {
        $data['title'] = "Orders";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($this->session->userdata('userid')){
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $this->load->view('user/header', $data);
          $this->load->view('user/orders', $data);
          $this->load->view('user/footer');
        }else{
          redirect('frontend/index');
        }
    }
    // User profile
    public function profile()
    {
        $data['title'] = "Profile";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($this->session->userdata('userid')){
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $this->load->view('user/header', $data);
          $this->load->view('user/profile', $data);
          $this->load->view('user/footer');
        }else{
          redirect('frontend/index');
        }
        
    }
    public function mycredits()
    {
        $data['title'] = "My Credits";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $data['users'] = $userCredits = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $data['userCredits'] = $userCredits[0]['user_credits'];
          $this->load->view('user/header', $data);
          $this->load->view('user/mycredits', $data);
          $this->load->view('user/footer', $data);
        }else{
          redirect('frontend/index');
        }        
    }
    // User flyer create
    public function flyer_category($prj_id)
    {
        $data['title'] = "Create flyer";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $data['category'] = $this->base_model->all_records('lp_category_mst'); 
          // project id
          $data['project_id'] = $prj_id;
          $this->load->view('user/header',$data);
          $this->load->view('user/flyer-catogery',$data);
          $this->load->view('user/footer',$data);
        }else{
        redirect('frontend/index');
      }
    }
    // flyer list   
    public function flyerlist()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          if($_POST["type"] == "flyerlist"){     
                $project_id = $_POST["project_id"];  
                $myflyers = $this->base_model->all_records('lp_product_mst'); 

                $flyerlist = '';                
                $flyerlist .='<div id="items" class="list box text-shadow">';
                              foreach ($myflyers as $flyer) {
                                $desc_fl = trim($flyer->product_desc).'';
                                if(empty($desc_fl)){
                                   $desc_fl ='&nbsp;';
                                }
                                
                              $flyerlist .='<div class="col-md-4 list-item box row">
                                <div class="panel panel-default">
                                    <div class="panel-body" style="background :#fbfbfb;">                           
                                        <div class="thumbnail">
                                            <div class="caption">
                                                <h4>'.$flyer->product_name.'</h4>
                                                <p > '.$flyer->product_desc.' </p>
                                                <p>
                                                  <a href="javascript:;" class="btn btn-md btn-warning" rel="tooltip" title="add to favorite" onclick="my_favorite('.$flyer->product_id_pk.');"><i class="fa fa-heart"></i> </a>
                                                  <!--<a href="javascript:;" class=" btn btn-md btn-default" rel="tooltip" title="Select Flyer" onclick="flyer_cart('.$flyer->product_id_pk.','.$project_id.');"><i class="fa fa-check"></i> </a></p>-->
                                                  <a href="'.site_url().'user/flyer_workshop/'.$flyer->product_id_pk.'/'.$project_id.'" class=" btn btn-md btn-default" rel="tooltip" title="Select Flyer" ><i class="fa fa-check"></i> </a></p>
                                            </div>
                                            <div class="img">
                                                <img src="'.site_url().$flyer->product_image.'" alt="" title=""/>
                                            </div>
                                        </div>
                                        <hr>
                                        <center>
                                        <h3 class="panel-title '.$flyer->category_id_fk.'"><b>'.$flyer->product_name.'</b></h3>
                                        <p class="itsd">'.$desc_fl.'</p>                                     
                                      
                                          
                                            <a href="'.site_url().'user/flyer_workshop/'.$flyer->product_id_pk.'/'.$project_id.'" class="btn btn-primary btn-sm"  >Customize Flyer</a>
                                            <!--<button class="btn btn-primary btn-sm pull-right" type="button" onclick="flyer_cart('.$flyer->product_id_pk.','.$project_id.');">Customize Flyer</button>-->
                                            <a href="flyer-workshop.html" class="btn btn-info btn-sm flyers-btn" type="button" rel="tooltip" title="Select Flyer"><i class="fa fa-check"></i> </a>                                                    
                                            <button class="btn btn-sm btn-warning flyers-btn" rel="tooltip" title="add to favorite"><i class="fa fa-heart"></i>  </button>
                                      </center>
                                    </div>
                                </div>
                              </div>';
                               }
                            $flyerlist .='</div>';
                           
                            $resp = array(
                              'status' => 'success', 
                              'flyerlist' => $flyerlist 
                              );
                            echo json_encode($resp);
            }else{
                $resp = array(
                  'status' => 'error', 
                  'msg' => 'Invalid Request.' 
                  );
                echo json_encode($resp);
            } 
        }else{
        redirect('frontend/index');
      }
    }
    // my fav flyer list
    public function myfavflyers()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          if($_POST["type"] == "flyerlist"){     
                $project_id = $_POST["project_id"];
                $myflyers = $this->base_model->getFavFlyer($userId);; 
                $flyerlist = '';                
                $flyerlist .='<div id="items" class="list box text-shadow">';
                              foreach ($myflyers as $flyer) {
                              $flyerlist .='<div class="col-md-4 list-item box row">
                                <div class="panel panel-default">
                                    <div class="panel-body" style="background :#fbfbfb;">                           
                                        <div class="thumbnail">                                            
                                            <div class="img">
                                                <img src="'.site_url().$flyer->product_image.'" alt="" title=""/>
                                            </div>
                                        </div>
                                        <hr>                                   
                                        <h3 class="panel-title"><b>'.$flyer->product_name.'</b></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipis.</p>                                          
                                        <!--<a href="'.site_url().'user/flyer_workshop/'.$flyer->product_id_pk.'/'.$project_id.'" class="btn btn-primary btn-sm"  >Customize Flyer</a>-->
                                        <!--<button class="btn btn-primary btn-sm pull-right" type="button" onclick="flyer_cart('.$flyer->product_id_pk.','.$project_id.');">Customize Flyer</button>-->                                           
                                 
                                    </div>
                                </div>
                              </div>';
                               }
                            $flyerlist .='</div>';                           
                            $resp = array(
                              'status' => 'success', 
                              'flyerlist' => $flyerlist 
                              );
                            echo json_encode($resp);
            }else{
                $resp = array(
                  'status' => 'error', 
                  'msg' => 'Invalid Request.' 
                  );
                echo json_encode($resp);
            } 
        }else{
        redirect('frontend/index');
      }
    }
    // flyer add
    public function flyer_add()
    {
      $data['title'] = "Flyer Add";
      $userId = $data['user_id'] = $this->session->userdata('userid');
      if($userId){
        if($_POST){
          $postedArr = $this->security->xss_clean($_POST);
          $flyerName = mysql_real_escape_string($postedArr['project_name']);
          $projectDate = date('Y-m-d');
          $data = array(
              'project_name' => $flyerName,
              'project_date' => $projectDate,
              'updated_on' => $projectDate,
              'user_id_fk' => $userId,
              'is_draft' => 'Y'             
          );
          $result = $this->base_model->insert_one_row('lp_my_flyers',$data);
          if($result){
            $lastId = $this->base_model->get_last_insert_id(); 
            $project_name = array(
                'project_name' => $flyerName,
                'last_id' => $lastId
                );
            $this->session->set_userdata($project_name);
            $resp = array(
                'status'=>'success',
                'msg'=>'Title added successfully.',
                'last_id'=> $lastId
            );
            echo json_encode($resp);
          }
        }        
      } else {
        redirect('frontend/index');
      }
    }
    // 
    public function flyer_get_data()
    {
      $data['title'] = "Flyer Edit Modal";
      $userId = $data['user_id'] = $this->session->userdata('userid');
      if($userId){
        if($_POST){
          $flyerId = $_POST['fid'];
          $flyers = $this->base_model->get_record_result_array('lp_my_flyers',array('project_id_pk' => $flyerId));
          if($flyers){
              $resp = array("status"=>"success","data"=>$flyers);
              echo json_encode($resp);
          }
        }
      }else{
        redirect('frontend/index');
      }
    }
    // flyer edit
    public function flyer_edit()
    {
      $data['title'] = "Flyer Edit";
      $userId = $data['user_id'] = $this->session->userdata('userid');
      if($userId){
        if($_POST){
          $postedArr = $this->security->xss_clean($_POST);
          $flyerName = mysql_real_escape_string($postedArr['project_edit']);
          $flyerId = mysql_real_escape_string($postedArr['flyer_id']);
          $projectDate = date('Y-m-d');
          $table = "lp_my_flyers";
          $data = array(
              'project_name' => $flyerName,
              'updated_on' => $projectDate       
          );
          $where = array(
              'project_id_pk' => $flyerId
          );          
          $result = $this->base_model->update_record_by_id($table,$data,$where);  
          
            $resp = array(
                'status'=>'success',
                'project_id' => $flyerId, 
                'msg'=>'Title edited successfully.'
            );
            echo json_encode($resp);
          
        }        
      } else {
        redirect('frontend/index');
      }
    }
    // flyer delete   
    public function flyer_delete($fid)
    {
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $where = array(
              'project_id_pk' => $fid
          );  
          $delResult = $this->base_model->delete_record_by_id('lp_my_flyers',$where); 
          if($delResult){
            $resp = array('status' => 'success', 'msg' => 'Flyer deleted successfully.' );
            echo json_encode($resp);
          }           
        }
        else{
            redirect('frontend/index');
        }
    } 
    // flyer download
    public function flyer_download($fid)
    {
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $myFlyer = $this->base_model->get_record_result_array( 'lp_my_flyers', array('project_id_pk' => $fid) );
          $flyerName = $myFlyer[0]['project_name'];
          $flyerPdf = site_url().$myFlyer[0]['flyer_pdf'];          
          // Read the file's contents
          $data = file_get_contents($flyerPdf); 
          $name = $flyerName.'.pdf';
          $download = force_download($name, $data);  
           
        }
        else{
            redirect('frontend/index');
        }
    } 
    // User flyer workshop
    public function flyer_workshop($prod_id,$proj_id)
    {
        $data['title'] = "Flyer Workshop";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          // user record
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          // product selected for customization by id
          $products = $data['products'] = $this->base_model->get_record_result_array('lp_product_mst',array('product_id_pk' => $prod_id));
          $data['productId'] = $prod_id;
          $data['flyerhtml'] = $products[0]['product_content'];
          // category name
          $category = $data['category'] = $this->base_model->my_category($prod_id);
         
          $data['category_name'] = $category->category_name;
          // project name by id
          $myProject = $this->base_model->get_record_result_array( 'lp_my_flyers', array('project_id_pk' => $proj_id) );
          $data['projectId'] = $proj_id;
          $data['project_name'] = $myProject[0]['project_name'];
          $this->load->view('user/header',$data);
          $this->load->view('user/flyer-workshop',$data);
          $this->load->view('user/footer',$data);
        }else{
        redirect('frontend/index');
      }
    }


    // flyer workshop edit
    public function flyer_workshop_edit($proj_id)
    {
        $data['title'] = "Flyer Workshop";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          // user record
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          // product selected for customization by id
          $products = $data['products'] = $this->base_model->get_record_result_array('lp_my_flyers',array('project_id_pk' => $proj_id));
          $prod_id = $data['productId'] = $products[0]['product_id_fk'];
          if(empty($products[0]['flyer_content'])){
          	$testProd = $this->base_model->get_record_result_array('lp_product_mst',array('product_id_pk' => $prod_id));
          	$flayer_prod_html = $testProd[0]['product_content'];
          }else{
          	$flayer_prod_html = $products[0]['flyer_content'];
          }

          $data['flyerhtml'] = $products[0]['flyer_content'];

          $data['project_name'] = $products[0]['project_name'];
          // category name
          $category = $data['category'] = $this->base_model->my_category($prod_id);
         
          $data['category_name'] = $category->category_name;
          // project name by id
          $myProject = $this->base_model->get_record_result_array( 'lp_my_flyers', array('project_id_pk' => $proj_id) );
          $data['projectId'] = $proj_id;
          
          $this->load->view('user/header',$data);
          $this->load->view('user/flyer-workshop-edit.php',$data);
          $this->load->view('user/footer',$data);
        }else{
        redirect('frontend/index');
      }
    }


    // flyer save as draft
    public function draftflyer()
    {
      $data['title'] = "Flyer Draft";
      $userId = $data['user_id'] = $this->session->userdata('userid');
      if($userId){
        if($_POST['type'] == "draftflyer"){
          $prodId = $_POST['prodid'];
          $projId = $_POST['projid'];
          $content = $_POST['content'];
          
          $uri =  substr($_POST['image'],strpos($_POST['image'],",") + 1);
          $file = 'assets/uploads/user_flyer_img/'.uniqid().time().'.png'; 
          file_put_contents($file, base64_decode($uri));

          // update flyer as draft
          $data = array(
            'is_draft' => 'Y',
            'updated_on' => date('Y-m-d'),
            'product_id_fk' => $prodId,
            'flyer_content' => $content,
            'flyer_image' => $file
            );
          $where = array(
            'project_id_pk' => $projId
            );
          $result = $this->base_model->update_record_by_id('lp_my_flyers',$data,$where); 
          if($result){
            $resp = array(
              'status' => 'success',
              'msg' => 'Flyer drafted successfully.'
              );
            echo json_encode($resp);
          }
        }
      }
    }
    // myflyer list
    public function myflyerlist()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          if($_POST["type"] == "myflyerlist"){                
                
                $myflyers = $this->base_model->get_flyers($userId);  
                
                $myflyerlist ='<table class="table table-striped table-hover" id="myflyerlist_dt">
                                <thead>
                                    <tr>
                                        <th class="">Project name</th>
                                        <th class="">Created</th>
                                        <th class="">Modified</th>
                                        <th class="">Preview</th>
                                        <th class="text-right " align="right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                foreach ($myflyers as $myflyer) {
                                  // print_r($myflyer);
                                  // die();
                                  if($myflyer->product_id_fk != NULL){
                                  
                                    $myflyerlist .='<tr>
                                        <td><b>'.$myflyer->project_name.'</b></td>
                                        <!-- <td class="text-primary"><i class="fa fa-calendar"></i> '.date("F j, Y, g:i a", strtotime($myflyer->project_date)).'</td> -->
                                        <td class="text-primary"><i class="fa fa-calendar"></i> '.date("F j, Y", strtotime($myflyer->project_date)).'</td>
                                        <td class="text-info"><i class="fa fa-calendar"></i> '.date("F j, Y", strtotime($myflyer->updated_on)).'</td>
                                        <td>
                                            <a data-toggle="modal" href="#modal-id" onclick="flyer_preview('.$myflyer->project_id_pk.');">

                                                <img width="80" src="'.site_url().$myflyer->flyer_image.'" class="img-responsive img-rounded flyer_'.$myflyer->project_id_pk.'">

                                            </a>
                                        </td>                                        
                                        <td class="text-right">';
                                          if($myflyer->is_draft == 'Y'){ 
                                            $myflyerlist .='<a href="javascript:;" class="btn btn-warning" data-toggle="modal" data-target="#porject-edit" onclick="flyeredit('.$myflyer->project_id_pk.')"><i class="fa fa-edit"></i> Edit</a>';
                                          }
                                            $myflyerlist .='<!--<button type="button" class="btn btn-info"><i class="fa fa-files-o"></i> Clone</button>-->';
                                          if($myflyer->is_success == 'Y'){ 
                                            $myflyerlist .=' <button type="button" class="btn btn-success" onclick="downloadflyer('.$myflyer->project_id_pk.');"><i class="fa fa-download"></i> Download</button>';
                                          }                                            
                                            $myflyerlist .=' <button type="button" class="btn btn-danger" onclick="deleteflyer('.$myflyer->project_id_pk.');"><i class="fa fa-remove"></i> Delete</button> 
                                        </td>
                                    </tr>'; 
                                  }
                                  }

                                $myflyerlist .='</tbody>
                            </table>';
                            $resp = array(
                              'status' => 'success', 
                              'myflyerlist' => $myflyerlist 
                              );
                            echo json_encode($resp);
            }else{
                $resp = array(
                  'status' => 'error', 
                  'msg' => 'Invalid Request.' 
                  );
                echo json_encode($resp);
            } 
        }else{
        redirect('frontend/index');
      }
    }
    // myflyer list
    public function myorders()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          if($_POST["type"] == "myorders"){ 
                $myorders = $this->base_model->get_all_record_by_condition('lp_invoices', array('user_id_fk'=>$userId));  
                         
                $myorders_html ='<table class="table table-striped table-hover" id="myorders_dt">
                                <thead>
                                    <tr>
                                        <th class="">Order No.</th>
                                        <th class="">Order Date</th>
                                        <th class="">Amount</th>                                        
                                        <th class="">Preview</th>                                        
                                    </tr>
                                </thead>
                                <tbody>';
                                foreach ($myorders as $myorder) {
                                  
                                    $myorders_html .='<tr>
                                        <td><b>'.$myorder->invoice_num.'</b></td>
                                        <td class="text-primary">'.date("F j, Y", strtotime($myorder->invoice_date)).'</td>
                                        <td class="text-info">'.$myorder->invoice_amount.'</td>
                                        <td> 
                                        <a class="btn btn-success" href="'.site_url().$myorder->invoice_pdf.'" target="_blank"><i class="fa fa-download"></i> Download</a>
                                        </td>
                                    </tr>'; 
                                  }
                                $myorders_html .='</tbody>
                            </table>';
                            $resp = array(
                              'status' => 'success', 
                              'myorders' => $myorders_html 
                              );
                            echo json_encode($resp);
            }else{
                $resp = array(
                  'status' => 'error', 
                  'msg' => 'Invalid Request.' 
                  );
                echo json_encode($resp);
            } 
        }else{
        redirect('frontend/index');
      }
    }
    // checkout order view page
    public function checkout_order()
    {
      $data['title'] = "Checkout Order";
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $this->load->view('user/header', $data);
          $this->load->view('user/checkout-order', $data);
          $this->load->view('user/footer');
        }else{
           redirect('frontend/index');
        }
    }
    // 
    // checkout order path 2 view page
    public function checkout_order_2()
    {
      $data['title'] = "Checkout Order 2";
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $this->load->view('user/header', $data);
          $this->load->view('user/checkout-order-2', $data);
          $this->load->view('user/footer');
        }else{
           redirect('frontend/index');
        }
    }
    // checkout shipping view page
    public function checkout_shipping()
    {
      $data['title'] = "Checkout Order 2";
       $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          // user info
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          // shipping info
          $data['shippings'] = $this->base_model->get_record_result_array('lp_shipping',array('lp_user_id_fk' => $userId));
          $this->load->view('user/header', $data);
          $this->load->view('user/checkout-shipping', $data);
          $this->load->view('user/footer');
        }else{
           redirect('frontend/index');
        }
    }
    // checkout payment view
    public function checkout_payment()
    {
      $data['title'] = "Checkout";
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $this->load->view('user/header', $data);
          $this->load->view('user/checkout-payment', $data);
          $this->load->view('user/footer');
        }else{
           redirect('frontend/index');
        }
    }
    // checkout payment path b view
    public function checkout_payment_2()
    {
      $data['title'] = "Checkout Payment 2";
       $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $this->load->view('user/header', $data);
          $this->load->view('user/checkout-payment-2', $data);
          $this->load->view('user/footer',$data);
        }else{
           redirect('frontend/index');
        }
    }
    // checkout-deliver
    public function checkout_deliver($inv)
    {
       $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          // user data
          $user = $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $user_name = $user[0]['first_name'].' '.$user[0]['last_name'];
          $user_email = $user[0]['email'];
          // get invoice data
          $invoice = $data['invoices'] = $this->base_model->get_record_result_array('lp_invoices',array('invoice_id_pk'=>$inv,'user_id_fk' => $userId));
          $order_num = $invoice[0]['invoice_num'];
          // get shipping address
          $shipping = $data['shippings'] = $this->base_model->get_record_result_array('lp_shipping',array('lp_user_id_fk' => $userId));
          if($shipping[0]['address']){
            $ship_add = $shipping[0]['address'];
          }else{
            $ship_add = "No address";
          }
          if($shipping[0]['city']){
            $ship_city = $shipping[0]['city'];
          }else{
            $ship_city = "No city";
          }
          if($shipping[0]['zip']){
            $ship_zip =  $shipping[0]['zip'];
          }else{
            $ship_zip = "No zip";
          }
          if($shipping[0]['phone']){
            $ship_phone = $shipping[0]['phone'];
          }else{
            $ship_phone = "No phone";
          }
          if($shipping[0]['first_name']){
            $ship_user_name = $shipping[0]['first_name'].' '.$shipping[0]['last_name'];
          }else{
            $ship_user_name = "No name";
          }
          
          // my flyer data
          $myflyers = $data['myflyers'] = $this->base_model->get_all_record_by_condition('lp_my_flyers', array('user_id_fk'=>$userId));
          // get cart content once here
          foreach ($this->cart->contents() as $items) {                  
            if($items['name'] != "coupon"){
              // print_r($items);
              $myProjectId = $items['options']['project_id']; 
              $myFlyers = $this->base_model->get_record_result_array('lp_my_flyers',array('project_id_pk' => $myProjectId));
              $myPdf[] =  $myFlyers[0]['flyer_pdf'];            
            }
          }
          $name = "Admin";	
          $message = "";
          $message = '<style>@page {background:;}
body {background:;}</style><table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222;" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="">
              <tr>
              <td valign="middle">
                <div>
                <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#fff;" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#2c4c60">
                  <tr>
                    <td height="30">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">
                      <h2 style="margin:0;">Thank you for your order! AAA Test</h2>
                      <div style="font-size:75%; text-transform:uppercase; padding-top:5px;">Your order has been Processed</div>
                    </td>
                  </tr>
                  <tr>
                    <td height="30">&nbsp;</td>
                  </tr>
                </table>
                </div>
              </td>
            </tr>
            <tr>
              <td>
              <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222;" width="100%" cellpadding="10" cellspacing="10" border="0">
                  <tr>
                    <td width="70%" valign="top"><h3 style="margin-top:0;">Dear '.$user_name.',</h3>
Thank you for your order. Below you can find the details of your order. If you ordered printed flyers they usually ship the same day.</td>
                    <td width="30%" valign="top" align="center">
                    <div style="background:#fff; padding:20px; margin-bottom:30px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;">Order number:<br>
                    '.$order_num .'</div>
                    <a href="'.site_url().'" style="background:#e6e4db; cursor:pointer; color:#fff; margin-bottom:30px; text-decoration:none; display:block; padding:15px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;">ACCOUNT LOGIN</a>
                    </td>
                  </tr>
              </table>
              </td>
            </tr>
            <tr>
              <td>
              <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222; margin-bottom:50px;" width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#fff">
                  <tr bgcolor="#e6e4db">
                    <td style="color:#fff;">ORDER DETAILS</td>
                    <td align="right" style="color:#fff;">Price</td>
                    <td align="center" style="color:#fff;">Quantity</td>
                    <td align="right" style="color:#fff;">Subtotal</td>
                  </tr>';
                  $count = 0;   
                  foreach($this->cart->contents() as $items){
                    if($items['name'] != "coupon"){
                      $count = $count + 1;
                      $message .='<tr>
                        <td width="55%" style="border-bottom:1px solid #f4f4f4;">'.$items["name"].'<br>
                          <!--<div style="font-size:75%;">Delivery: <span style="color:#e6e4db;">Sunday nov 14th</span></div>-->
                        </td>
                        <td align="right" width="15%" style="border-bottom:1px solid #f4f4f4;"> $'.$items["price"].' </td>
                        <td align="center" width="15%" style="border-bottom:1px solid #f4f4f4;">'.$items["qty"].'</td>
                        <td align="right" width="15%" style="border-bottom:1px solid #f4f4f4;"> $'.$items["subtotal"].' </td>
                      </tr>'; 
                    }
                  }
              $message .='</table>
              </td>
            </tr>
            <tr>
              <td>
              <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222; margin-bottom:50px;" width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#fff">
                  <tr bgcolor="#e6e4db">
                    <td style="color:#fff;">PAYMENT:</td>
                  </tr>
                  <tr>
                    <td valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" background="" style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222;" >
                      <tr>
                      <td rowspan="5" valign="top" width="60%"> 
                        <!--Payment method: Visa <br>-->
                        You order has been paid.
                      </td>
                      <td style="border-bottom:1px solid #f4f4f4;" width="20%">Delivery costs</td>
                      <td style="border-bottom:1px solid #f4f4f4;" align="right" width="20%"> $0.00 </td>
                      </tr>
                      <tr>
                      <td>Subtotal</td>
                      <td align="right"> $'.$items["subtotal"].' </td>
                      </tr>
                      <tr>
                      <td>Discount</td>
                      <td align="right"> - $0.00 </td>
                      </tr>
                      <!--<tr>
                      <td>Sales Tax</td>
                      <td align="right"> + $0.25 </td>
                      </tr>-->
                      <tr>
                      <td style="border-top:1px solid #f4f4f4;"> Total</td>
                      <td style="border-top:1px solid #f4f4f4;" align="right"> $'.$items["subtotal"].' </td>
                      </tr>
                    </table>
                    </td>
                  </tr>
              </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%">
                  <tr>
                    <td width="49%">
                      <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222; margin-bottom:50px;" width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#fff">
                        <tr bgcolor="#e6e4db">
                          <td style="color:#fff;"> DELIVERY ADDRESS</td>                          
                        </tr>
                        <tr>
                          <td>
                          <div style="padding30px;">
                          '.$ship_add.'<br>
                          '.$ship_city.', '.$ship_zip.'<br>
                          '.$ship_phone.'<br>
                          '.$ship_user_name .'</div> </td>                          
                        </tr>
                      </table>
                    </td>
                    <td width="2%"></td>
                    <td width="49%">
                      <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222; margin-bottom:50px;" width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#fff">
                          <tr bgcolor="#e6e4db">
                            <td style="color:#fff;"> INVOICE ADDRESS</td>
                            
                          </tr>
                          <tr>
                            <td>
                            <div style="padding30px;">
                            '.$ship_add.'<br>
                            '.$ship_city.', '.$ship_zip.'<br>
                            '.$ship_phone.'<br>
                            '.$ship_user_name .'</div> </td>                            
                          </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="">&nbsp;</td>
  </tr>
            <tr>
              <td>Cancel your order? Questions?<br>
              If you need to cancel an order or change the ship address please contact us @ (866)-581-4150. </td>
  </tr>
  <tr>
              <td>&nbsp;</td>
  </tr>
  <tr>
              <td bgcolor="#2d2d2d"><div style="padding:20px; color:#fff; font-size:75%; text-align:center;">&copy; '.date("Y").' FarmingFlyers.com All rights Reserved</div></td>
  </tr>
              </table>';
          // invoice pdf
          $htmlContent = '<html><head></head><body> '.$message.' </body></html>';
          $html = $htmlContent;
		  
		
          // Load library
          $this->load->library('dompdf_gen');
          // Convert to PDF
          $this->dompdf->load_html($html);
          $this->dompdf->set_paper('A4', 'Portrait');
          $this->dompdf->render();
          $output = $this->dompdf->output();
          $pdf_file = 'assets/uploads/user_invoices/'.uniqid().'.pdf';
          file_put_contents($pdf_file, $output);
          $updateData = array(            
            'invoice_pdf' => $pdf_file
            );
          
          $updateFlyerTable = $this->base_model->update_record_by_id('lp_invoices', $updateData,array('invoice_id_pk' => $inv)); 
          // invoice pdf ends
          
          $this->load->helper('sendemail');
          $send = send_email('info@modernagent.io',$name,$user_email,'Your Customize Flyer',$message,$myPdf);

          $this->cart->destroy();
          
          $data['myorders'] = $this->base_model->my_order($inv);          
          $this->load->view('user/header', $data);
          $this->load->view('user/checkout-deliver', $data);
          $this->load->view('user/footer',$data);
        }else{
           redirect('frontend/index');
        }
    }
    // checkout payment view
    public function checkout_deliver_2($inv)
    {
      $data['title'] = "Checkout";
       $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $user = $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          
          $user_name = $user[0]['first_name'].' '.$user[0]['last_name'];
          $user_email = $user[0]['email'];
          // get invoice data
          $invoice = $data['invoices'] = $this->base_model->get_record_result_array('lp_invoices',array('invoice_id_pk'=>$inv,'user_id_fk' => $userId));
          $order_num = $invoice[0]['invoice_num'];
          // get shipping address
          $shipping = $data['shippings'] = $this->base_model->get_record_result_array('lp_shipping',array('lp_user_id_fk' => $userId));
          if($shipping[0]['address']){
            $ship_add = $shipping[0]['address'];
          }else{
            $ship_add = "No address";
          }
          if($shipping[0]['city']){
            $ship_city = $shipping[0]['city'];
          }else{
            $ship_city = "No city";
          }
          if($shipping[0]['zip']){
            $ship_zip =  $shipping[0]['zip'];
          }else{
            $ship_zip = "No zip";
          }
          if($shipping[0]['phone']){
            $ship_phone = $shipping[0]['phone'];
          }else{
            $ship_phone = "No phone";
          }
          if($shipping[0]['first_name']){
            $ship_user_name = $shipping[0]['first_name'].' '.$shipping[0]['last_name'];
          }else{
            $ship_user_name = "No name";
          }

          
          // get cart content once here
          $myPdf=array();
          $data['myFlyers']=array();
          foreach ($this->cart->contents() as $items) {                  
            if($items['name'] != "coupon"){
              
              if(!empty($items['options']['project_id'])){
                $myProjectId = $items['options']['project_id']; 
                $myFlyers = $this->base_model->get_record_result_array('lp_my_flyers',array('project_id_pk' => $myProjectId));
                   
                array_push($myPdf, $myFlyers[0]['flyer_pdf']);
              }
            }
          }
          $name = "Admin";
          $message = "";
          $message = '<style>@page {background:#e6e4db;}
body {background:#e6e4db;}</style><table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222;" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#e6e4db">
              <tr>
              <td valign="middle">
                <div>
                <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#fff;" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#2c4c60">
                  <tr>
                    <td height="30">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">
                      <h2 style="margin:0;">Thank you for your order!</h2>
                      <div style="font-size:75%; text-transform:uppercase; padding-top:5px;">Your order has been Processed</div>
                    </td>
                  </tr>
                  <tr>
                    <td height="30">&nbsp;</td>
                  </tr>
                </table>
                </div>
              </td>
            </tr>
            <tr>
              <td>
              <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222;" width="100%" cellpadding="10" cellspacing="10" border="0">
                  <tr>
                    <td width="70%" valign="top"><h3 style="margin-top:0;">Dear '.$user_name.',</h3>
Thank you for your order. Below you can find the details of your order. If you ordered printed flyers they usually ship the same day.</td>
                    <td width="30%" valign="top" align="center">
                    <div style="background:#fff; padding:20px; margin-bottom:30px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;">Order number:<br>
                    '.$order_num .'</div>
                    <a href="'.site_url().'" style="background:#e6e4db; cursor:pointer; color:#fff; margin-bottom:30px; text-decoration:none; display:block; padding:15px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;">ACCOUNT LOGIN</a>
                    </td>
                  </tr>
              </table>
              </td>
            </tr>
            <tr>
              <td>
              <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222; margin-bottom:50px;" width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#fff">
                  <tr bgcolor="#e6e4db">
                    <td style="color:#fff;">ORDER DETAILS</td>
                    <td align="right" style="color:#fff;">Price</td>
                    <td align="center" style="color:#fff;">Quantity</td>
                    <td align="right" style="color:#fff;">Subtotal</td>
                  </tr>';
                  $count = 0;   
                  foreach ($this->cart->contents() as $item) {
                    
                    if($item['options']['is_flag'] == "cart_item"){
                      $count++;
                    }
                  }                           
                  if($count==0){
                    foreach ($this->cart->contents() as $item) {
                      $data = array(
                        'rowid'   => $item['rowid'],
                        'qty'     => 0
                      );
                      $result = $this->cart->update($data);
                    }
                  }
                  $count = 0;   
                  foreach($this->cart->contents() as $items){
                    if($items['options']['is_flag'] == "cart_item"){
                      if($items['name'] != "coupon"){
                        $count = $count + 1;
                        switch ($items['price']){                           
                                case '11':
                                $qnt = 25;
                                break;  
                                case '18':
                                $qnt = 75;
                                break;                             
                                case '25':
                                $qnt = 100;
                                break;    
                                case '45':
                                $qnt = 200;
                                break;                            
                              }
                        $message .='
                          <tr>
                            <td width="55%" style="border-bottom:1px solid #f4f4f4;">'.$items["name"].'<br>
                          <!--<div style="font-size:75%;">Delivery: <span style="color:#e6e4db;">Sunday nov 14th</span></div>-->
                        </td>
                        <td align="right" width="15%" style="border-bottom:1px solid #f4f4f4;"> $'.$items["price"].' </td>
                        <td align="center" width="15%" style="border-bottom:1px solid #f4f4f4;">'. $qnt.'</td>
                        <td align="right" width="15%" style="border-bottom:1px solid #f4f4f4;"> $'.$items["subtotal"].' </td>
                          </tr>';
                      }
                    }
                  }
              $message .='</table>
              </td>
            </tr>
            <tr>
              <td>
              <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222; margin-bottom:50px;" width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#fff">
                  <tr bgcolor="#e6e4db">
                    <td style="color:#fff;">PAYMENT:</td>
                  </tr>
                  <tr>
                    <td valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" background="" style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222;" >
                      <tr>
                        <td rowspan="5" valign="top" width="60%"> 
                          <!--Payment method: Visa <br>-->
                          You order has been paid.
                        </td>';
                        foreach($this->cart->contents() as $items){
                          
                                              if($items['options']['is_flag'] == "product_detail"){ 
                                              $message .= '<tr>
                                                    <td align="right">'.$items["name"].'</td>
                                                    <td class="text-right" align="right">$ '.$items["price"].'</td>
                                                </tr>';
                                              }elseif($items['options']['is_flag'] == "cart_item"){ 
                                                switch ($items['price']){                           
                                case '11':
                                $qnt = 25;
                                break;  
                                case '18':
                                $qnt = 75;
                                break;                             
                                case '25':
                                $qnt = 100;
                                break;    
                                case '45':
                                $qnt = 200;
                                break;                            
                              }
                                                $message .= '<tr>
                                                    <td align="right">Printing Qty ('.$qnt.')</td>
                                                    <td class="text-right" align="right">$ '.$items['subtotal'].'</td>
                                                </tr>';
                                              }elseif($items['options']['is_flag'] == "product_detail"){
                                                $message .= '<tr>
                                                    <td align="right">'.$items["name"].'</td>
                                                    <td class="text-right" align="right">$ '.$items["price"].'</td>
                                                </tr>
                                                <tr>';
                                              }
                                            }
                      $message .='</tr>
                      
                      <tr>';
                      $message .= '<td align="right" style="border-top:1px solid #f4f4f4;">Total</td>';
                                                    $subtotal = 0; $discount=0;
                                                    foreach($this->cart->contents() as $items){
                            if($items['name'] == "coupon"){
                                        $discount+=$items['subtotal'];
                                      }else{
                                        $subtotal += $items['subtotal'];  
                                      }
                          }
                          $grandtotal = $subtotal-$discount;
                                                    $message .= '<td class="text-right" align="right" style="border-top:1px solid #f4f4f4;"><b>$ '.$grandtotal.'</b></td>

                      
                      </tr>
                    </table>
                    </td>
                  </tr>
              </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%">
                  <tr>
                    <td width="49%">
                      <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222; margin-bottom:50px;" width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#fff">
                  <tr bgcolor="#e6e4db">
                    <td style="color:#fff;"> DELIVERY ADDRESS</td>
                    
                  </tr>
                  <tr>
                    <td>
                    <div style="padding30px;">
                          '.$ship_add.'<br>
                          '.$ship_city.', '.$ship_zip.'<br>
                          '.$ship_phone.'<br>
                          '.$ship_user_name .'</div> </td>  
                    
                  </tr>
              </table>
                    </td>
                    <td width="2%"></td>
                    <td width="49%">
                    <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222; margin-bottom:50px;" width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#fff">
                  <tr bgcolor="#e6e4db">
                    <td style="color:#fff;"> INVOICE ADDRESS</td>
                    
                  </tr>
                  <tr>
                    <td>
                    <div style="padding30px;">
                            '.$ship_add.'<br>
                            '.$ship_city.', '.$ship_zip.'<br>
                            '.$ship_phone.'<br>
                            '.$ship_user_name .'</div> </td>
                    
                  </tr>
              </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td bgcolor="#e6e4db">&nbsp;</td>
  </tr>
            <tr>
              <td>Cancel your order? Questions?<br>
              If you need to cancel an order or change the ship address please contact us @ (866)-581-4150. </td>
  </tr>
  <tr>
              <td>&nbsp;</td>
  </tr>
  <tr>
              <td bgcolor="#2d2d2d"><div style="padding:20px; color:#fff; font-size:75%; text-align:center;">&copy; '.date("Y").' FarmingFlyers.com All rights Reserved</div></td>
  </tr>
              </table>';
          // invoice pdf
          $htmlContent = '<html><head></head><body> '.$message.' </body></html>';
          $html = $htmlContent;
          // Load library
          $this->load->library('dompdf_gen');
          // Convert to PDF
          $this->dompdf->load_html($html);
          $this->dompdf->set_paper('A4', 'Portrait');
          $this->dompdf->render();
          $output = $this->dompdf->output();
          $pdf_file = 'assets/uploads/user_invoices/'.uniqid().'.pdf';
          file_put_contents($pdf_file, $output);
          $updateData = array(            
            'invoice_pdf' => $pdf_file
            );
          
          $updateFlyerTable = $this->base_model->update_record_by_id('lp_invoices', $updateData,array('invoice_id_pk' => $inv)); 
          // invoice pdf ends
          
          $this->load->helper('sendemail');
         
          $send = send_email('info@modernagent.io',$name, $user_email,'Your Customize Flyer', $message, $myPdf);

          $this->cart->destroy();
          
          $data['myorders'] = $this->base_model->my_order($inv);
          $data['myshippings'] = $this->base_model->get_all_record_by_condition('lp_shipping',array("lp_user_id_fk"=>$userId));
          $this->load->view('user/header', $data);
          $this->load->view('user/checkout-deliver-2', $data);
          $this->load->view('user/footer',$data);
        }else{
           redirect('frontend/index');
        }
    }
    // coupon apply
    public function coupon_apply()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $coupon_count = 1;
          $postedArr = $this->security->xss_clean($_POST);
          $coupon_code = mysql_real_escape_string($postedArr["coupon"]);
          // coupon table
          $table = "lp_coupon_mst";
          $where = array(
            'coupon_code' => $coupon_code
            );
          $resultCheck = $this->base_model->check_existent($table,$where);
            if($resultCheck){              
              $getCouponDate = $this->base_model->get_record_by_id($table,$where);              
              $todayDate = date('Y-m-d');
              if( ($todayDate >= $getCouponDate->start_date) && ($todayDate <= $getCouponDate->end_date) ){  
                $coupon_count += $getCouponDate->coupons_applied_cnt;
                $data2 = array(
                   'coupons_applied_cnt' => $coupon_count
                    );
                $where2 = array(
                    'coupon_id_pk' => $getCouponDate->coupon_id_pk
                );
                // cart total
                $old_total = $this->cart->total();
                $new_total = $old_total - $getCouponDate->coupon_amt;
                // 
                $data = array(
                  'id' => $getCouponDate->coupon_id_pk,
                  'name' => "coupon",
                  'price' => $getCouponDate->coupon_amt,
                  'qty' => 1,                  
                );
                // insert into cart
                $result = $this->cart->insert($data);
                
                $subtotal = 0;$discount=0;
                foreach ($this->cart->contents() as $items) {
                  
                  if($items['name'] == "coupon"){
                    $discount+=$items['subtotal'];
                  }else{
                    $subtotal += $items['subtotal'];  
                  }
                }
                
                // cart update
                $result2 = $this->base_model->update_record_by_id($table,$data2,$where2); 
                if($result2){
                    $resp = array(
                      "status"=>"success",
                      "msg"=>"Coupon Applied successfully."
                      );
                    echo json_encode($resp);
                }
              }else{
                $resp = array(
                  'status' => 'error', 
                  'msg' => 'Invalid Coupon.' 
                  );
                echo json_encode($resp);
              }
            }else{
              $resp = array(
                  'status' => 'error', 
                  'msg' => 'Invalid Coupon.' 
                  );
                echo json_encode($resp);
            }
      }else{
        redirect('frontend/index');
      }
    }
    // shipping add controller
    public function shipping_add()
    {
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
            if($_POST){ 
                $postedArr = $this->security->xss_clean($_POST);   

                $ship_id = $postedArr['shipid'];            

                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $company = $_POST['company'];
                $phone = $_POST['phone'];
                $country = $_POST['country']; 
                $city = $_POST['city'];
                $code = $_POST['code'];
                $address = $_POST['address']; 
                $info = $_POST['info']; 

                // check user id exist
                $table = "lp_shipping";
                $where = array( 'lp_user_id_fk' => $userId );
                $resultCheck = $this->base_model->check_existent($table,$where);                
                if(!$resultCheck){
                  $data = array(
                      'lp_user_id_fk' => $userId,
                      'first_name' => $fname,                
                      'last_name' => $lname,                
                      'company'=>$company,                      
                      'phone'=>  $phone,                
                      'country' => $country,
                      'city' => $city,
                      'zip' => $code,
                      'address' => $address,
                      'description' => $info
                  );
                  
                  $result = $this->base_model->insert_one_row('lp_shipping',$data); 
                  if($result){  
                      $resp = array(
                        "status"=>"success",
                        "msg"=>"Shipping added successfully.");
                      echo json_encode($resp);
                  }else{
                      $resp = array(
                        "status"=>"error",
                        "msg"=>"Shipping could not be added.");
                      echo json_encode($resp);
                  }                             
                }else{
                  $data2 = array(                      
                      'first_name' => $fname,                
                      'last_name' => $lname,                
                      'company'=>$company,                      
                      'phone'=>  $phone,                
                      'country' => $country,
                      'city' => $city,
                      'zip' => $code,
                      'address' => $address,
                      'description' => $info                    
                  );
                  
                  $where = array("shipping_id_pk"=>$ship_id); 
                  $result = $this->base_model->update_record_by_id('lp_shipping',$data2,$where);
                  if($result){  
                      $resp = array(
                        "status"=>"success",
                        "msg"=>"Shipping added successfully.");
                      echo json_encode($resp);
                  }else{
                      $resp = array(
                        "status"=>"error",
                        "msg"=>"Shipping could not be added.");
                      echo json_encode($resp);
                  } 
                }                
            } 
            // post ends
        }else{
           redirect('frontend/index');
        }
    }
    // credits counts
    public function creditscount()
    {
       $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          if($_POST["type"] == 'credits_count'){
            $table = "lp_user_mst";
            $where = array(
              'user_id_pk' => $userId
              );
            $getCredits = $this->base_model->get_record_by_id($table,$where); 
            $credits = $getCredits->user_credits;
            $resp = array(
              'status' => 'success',
              'msg' => 'You have credits.', 
              'credits' =>  $credits      
            );
            echo json_encode($resp);
          }
        }
    }
    // add my favorite
    public function my_favorite()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          if($_POST["type"] == 'my_favorite'){
            $product_id = $_POST["pid"];
            $data = array(
              'product_id_ck'=>$product_id,
              'user_id_ck'=>$userId,
              'added_on' => date('Y-m-d')
              );
            $result = $this->base_model->insert_one_row('lp_my_favourites',$data); 
            if($result){ 
              $table = "lp_product_mst";
              $where = array(
                'product_id_pk' => $userId
                );
              $getMyfav = $this->base_model->get_record_by_id($table,$where); 
              $total_fav = $getMyfav->total_favs + 1;
              $data2 = array(
                'total_favs' => $total_fav
                );             
              $this->base_model->update_record_by_id($table,$data2,$where);
              
              $title = "Added favorite";
              $desc = "You have added a flyer into your favorite list.";
              $response = user_trail($userId,$title,$desc);
              
              $resp = array("status"=>"success","msg"=>"Flyer added as favorite.");
              echo json_encode($resp);
            }else{
                $resp = array("status"=>"error","msg"=>"Flyer could not be added as favorite.");
                echo json_encode($resp);
            } 
          }
        }
    }
    // stripe post
    public function stripe_post()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');

        if($userId){
          $user_email = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $email = $user_email[0]['email'];
          if($_POST){

            $this->load->library('stripe');

            $card = $_POST['stripeToken'];

            $desc = 'Subscription Paymemnt';
                
            $plan = "farmingflyer_pro_subs";

            $response = json_decode($this->stripe->customer_create( $card, $email, $desc, $plan ));

            echo "<pre>";
            print_r($response);
            die();

            if ($response->paid) {
                echo "Success";
            } else {
                echo "Failed";
            }
          }

        }

    }

     public function gen_invoice($inv,$cart_id){
      $userId = $data['user_id'] = $this->session->userdata('userid');
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

    function download_invoice($invoiceNumber) 
    {
      $userId = $this->session->userdata('userid');
      if ($userId) {
        $this->load->library('invoice'); 
        $this->invoice->_getInvoice($invoiceNumber, $userId);
      } else {
        echo "Invoice details does not exits.";
        exit();
      } 
    }

    // cart payment
    public function generateInvoice() {
		  $invoice_no = $this->session->userdata('userid').'-'.time();
		  return $invoice_no;
    }
    // stripe post
    public function cart_payment(){
      
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
    // stripe post
    public function cart_payment_2()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $users = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          if($_POST){
            // print_r($_POST);
            // die();

            $this->load->library('stripe');

            $amt = $_POST['amount'];
            $amount = 100 * $amt;

            $card = $_POST['stripeToken'];

            $desc = 'Flyer Paymemnt';


                $response = json_decode($this->stripe->charge_card($amount, $card, $desc));           
                
                if ($response->paid) {
                    echo "Success";  
                    // get coupon id
                    foreach ($this->cart->contents() as $items) {                  
                      
                      if($items['options']['is_flag'] == "cart_item"){
                          if($items['name'] == "coupon"){
                              $couponId = $items['id'];
                              $proj_id = $items['options']['project_id']; 
                            }else{
                              $couponId = NULL;  
                              $proj_id = $items['options']['project_id']; 
                            }
                      }     
                    } 


                    // insert into my cart table
                    $data = array(
                      'user_id_fk' => $userId,
                      'paid_on' => date('Y-m-d'),
                      'txn_id' => $response->id,
                      'is_success' => 'Y',
                      'total_amount' => $amt,
                      'coupon_id_fk' => $couponId,
                      'project_id_fk' => $proj_id

                      );
                    $result = $this->base_model->insert_one_row('lp_my_cart',$data); 
                    if($result){
                      
                      $lastId = $this->base_model->get_last_insert_id();
                      // update mycart table
                        $updateData = array(
                          'is_draft' => 'N'
                          );
                        // print_r($updateData)
                        $updateFlyerTable = $this->base_model->update_record_by_id('lp_my_flyers', $updateData,array('project_id_pk' => $proj_id)); 
                      $data2 = array(
                        'invoice_num' => 'INV'.$this->generateInvoice(),
                        'cart_id_fk' => $lastId,
                        'user_id_fk' => $userId,
                        'invoice_amount' => $amt,
                        'invoice_date' => date('Y-m-d'),
                        'invoice_to' => $users[0]['first_name'],
                        'invoice_addr' => $users[0]['city']
                        );
                      $result2 = $this->base_model->insert_one_row('lp_invoices',$data2);
                      if($result2){
                        $lastId2 = $this->base_model->get_last_insert_id();
                        redirect('user/checkout_deliver_2/'.$lastId2);
                      }
                    }
                } else {
                    
                    $data['title'] = "Dashboard";
                    $userId = $data['user_id'] = $this->session->userdata('userid');
                    $userName = $data['user_name'] = $this->session->userdata('username');
                    
                    $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
                    
                    $this->load->view('user/header', $data);
                    $this->load->view('user/checkout-error',$response);
                    $this->load->view('user/footer');
                    
                    die();
                }
            // }
          }
        }
    }
    // stripe post
    // credits
    public function credits_payment()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          // get user credits
          $users = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
          $userPreCredits = $users[0]['user_credits'];
          
          if($_POST){
            
            $this->load->library('stripe');

            $amt = $_POST['amount'];
            $amount = 100 * $amt;

            $card = $_POST['stripeToken'];

            $desc = 'Credits Paymemnt';

            
                $response = json_decode($this->stripe->charge_card($amount, $card, $desc));           
                
                if ($response->paid) {
                    echo "Success";
                    // update user credit
                    $data = array(                      
                      'user_credits' => $amt + $userPreCredits
                      );
                    $where = array(
                      'user_id_pk' => $userId
                      );
                    $result = $this->base_model->update_record_by_id('lp_user_mst',$data,$where); 
                    redirect('user/mycredits');
                              
                } else {
                    echo "Failed";
                    echo "<pre>";
                    print_r($response);
                    die();
                }
          }
        }
    }
	
	public function delete_lp($lpid = -1, $from){
		if($lpid){
			$data = array(  'is_active' =>'N'   );
			$where = array('project_id_pk' => $lpid );
			$this->base_model->update_record_by_id('lp_my_listing', $data, $where);
			if($from == 0){
				redirect(base_url().'index.php?/user/dashboard');
			}else if($from == 1){
				redirect(base_url().'index.php?/user/recentlp');
			}
		}	
	}
    public function formward_report(){
        $email = $this->input->post('email_to');
        $isCC = $this->input->post('cc');
        $projectId = $this->input->post('project_id');
        $ccTo=null;
        if($isCC) {
            $ccTo = $userdata=$this->session->userdata('user_email');
        }
        $listingData = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk'=>$projectId));
        
        $message = '<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ecf0f1" style="background-color: rgb(236, 240, 241);">
	<tr>
		<td bgcolor="#ecf0f1"align="center" style="background-color: rgb(236, 240, 241); padding-top:30px;">
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" >
				<tr>
					<td width="600" align="center">
						<img src="'.base_url('assets/images-2/logo.png').'"/>
					</td>
				</tr>
				
				
				<tr>
					<td valign="top" width="600" align="center">
						<table width="600">
							<tr>
								<td valign="top" width="420" align="center">
									<table width="420" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
										
										<tr>
											<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(34, 34, 34); line-height: 24px; font-weight: normal;">
												<span style="font-family: \'proxima_nova_rgregular\', Helvetica; font-weight: normal;">Please find attached PDF Report.
												<br><br></span>
											</td>
										</tr>
										<tr>
											<td width="100%" height="10"></td>
										</tr>
									</table>
								</td>
								<td valign="top" width="150" align="center" style="padding-left:20px" >
									<table width="150" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
										<tr>
											<td width="150" bgcolor="#f15d3e"align="center" style="border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background:none; border: 1px solid #55c9e0;">												
												<table width="150" border="0" cellpadding="0" cellspacing="0" align="center">
													<tr>
														<td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
													</tr>
													<tr>
														<td valign="top" width="100%" align="center" style="text-align: center; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: rgb(34, 34, 34); font-weight: bold; line-height: 18px; text-transform: uppercase;" >
															<span style="font-family: \'proxima_novasemibold\', Helvetica; font-weight: normal;"><a href="<?php echo site_url(); ?>" style="text-decoration: none; color: rgb(85, 201, 224);">ACCOUNT LOGIN</a></span>
														</td>
													</tr>
													<tr>
														<td width="100%" height="10" style="font-size: 1px; line-height: 1px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;">&nbsp;</td>
													</tr>
												</table>												
											</td>
										</tr>
									</table>
								</td>
							</tr>							
						</table>						
					</td>
				</tr>
				<tr>
					<td style="line-height:10px;">&nbsp;</td>
				</tr>
				
				<tr>
					<td height="30" style="line-height:20px;">&nbsp;</td>
				</tr>
				<tr>
					<td valign="middle" width="600" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(34, 34, 34); line-height: 24px; font-weight: normal;">
						<span style="font-family: \'proxima_nova_rgregular\', Helvetica; font-weight: normal;">If you have any questions please email us @ info@modernagent.io</span>
					</td>
				</tr>
				<tr>
					<td height="5" style="line-height:5px;">&nbsp;</td>
				</tr>
				<tr>
					<td width="600" border="0" height="60" cellpadding="0" cellspacing="0" align="center" bgcolor="#3e4957"style="border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(62, 73, 87); font-family: Helvetica, Arial, sans-serif; font-size: 13px; color: rgb(255, 255, 255);">
						<span style="font-family: \'proxima_nova_rgregular\', Helvetica; font-weight: normal;">
							<span style="color:#FFFFFF !important;" >&copy; '.date("Y").' ModernAgent.io All rights Reserved</span>
						</span>
					</td>
				</tr>
				<tr>
					<td height="30" style="line-height:35px;">&nbsp;</td>
				</tr>
			</table>	
		</td>
	</tr>
</table>';
        $this->base_model->queue_mail($email,'Report',$message,array($listingData->report_path),$ccTo);
        
        $this->session->set_flashdata('success', "Report sent successfully.");
        redirect('user/recentlp');
        exit;
    } 
    function is_subscribed($planId=null, $userId = NULL){
        if($userId == NULL)
          $userId = $this->session->userdata('userid');

        if($userId){
  
            $this->load->model('user_model');
            $user = $this->base_model->get_record_by_id('lp_user_mst',array('user_id_pk' => $userId));
            $customerId = $user->customer_id;
            
            if(is_null($customerId) || $customerId == ''){
                $res = $this->_cust_info_by_email($user->email);
            } else {
                $res = $this->_cust_info_by_id($customerId);
            }
            //Check if not user than is its company registerd.
            $isCompanyPlan = false;
            if(!$res){
                $this->db->select("com.customer_id,com.email");
                $this->db->join('lp_user_mst sales', 'sales.parent_id=com.user_id_pk');
                $this->db->where('sales.user_id_pk',$user->parent_id);
                $query = $this->db->get('lp_user_mst com');
                $company = $query->row();
                $c_customerId = $company->customer_id;
                
                if(is_null($c_customerId) || $c_customerId == ''){
                    $res = $this->_cust_info_by_email($company->email);
                } else {
                    $res = $this->_cust_info_by_id($c_customerId);
                }
                if($res)
                  $isCompanyPlan = true;
            }
              $refCode = $user->ref_code;
              if(empty($refCode)){//User is subscribed but does not have ref code yet. Then Create one
                  $refCode = $this->user_model->setRefCode($user->user_id_pk);
              }

              //generate token
              $token = generateToken($user->user_id_pk);

              echo json_encode(array('status'=>(bool)$res, 'data'=>$res, 'ref_code'=>$refCode, 'token' => $token,'company_plan'=>$isCompanyPlan));

            exit;
        }
    }
    
    function create_plan(){
        $this->load->library('stripe');

        $stripe = new Stripe(null);
        try{
            $response = json_decode($stripe->plan_create( 'prem_lp_user', 2000, "Premium LP User", "month"));
        }catch(Exception $e){
            echo "Eception";
            print_r($e);
        }
        print_r($response);die;
        
    }
    private function _cust_info_by_id($customerId){
        $this->load->library('stripe');
        $_conf['stripe_key_test_public']         = 'pk_test_JKTfWhEYh9KIUJhJiD1cI0fo';
        $_conf['stripe_key_test_secret']         = 'sk_test_4Rut0MK1S0WKIHQGs0MTaVDL'; 
        $_conf['stripe_key_live_public']         = 'pk_live_kWtXKplBdNqXQMeBWHuHYZDx';
        $_conf['stripe_key_live_secret']         = 'sk_live_W0mSME3cKd2uzqdFv7WBr02p';
        $_conf['stripe_test_mode']               = TRUE;
        $_conf['stripe_verify_ssl']              = FALSE; 
        $stripe = new Stripe( null );
        try{
            $response = json_decode($stripe->customer_info($customerId));
        }catch(Exception $e){
        }
        if(isset($response) && isset($response->id)) {
            $plans = $this->fetchPlansData($response->subscriptions);
            if($plans){
                return $plans[0];
            }
        } 
        return false;
        
    }
    private function _cust_info_by_email($email,$getustomerId = false){
        $userId = $this->session->userdata('userid');
        $this->load->library('stripe');
        $stripe = new Stripe( null );
        try{
            $response = json_decode($stripe->customer_list());
        }catch(Exception $e){
            print_r($e);
        }
        if(isset($response) && isset($response->data)){
            foreach ($response->data as $data){
                if($data->email!=$email){
                    continue;
                }
                $this->base_model->update_record_by_id('lp_user_mst',array('customer_id'=>$data->id),array('user_id_pk'=>$userId));
                if($getustomerId){
                    return $data->id;
                }
                
                $plans = $this->fetchPlansData($data->subscriptions);
                if($plans){
                    return $plans[0];
                }
            }
        }
        return false;
    }
    private function fetchPlansData($stripeResponseSubs,$insertIntoDB = true){
        $this->load->model('user_model');
        $userId = $this->session->userdata('userid');
        foreach($stripeResponseSubs->data as $subs){
            foreach ($subs->items->data as $i=>$item){
                $data = array('plan_id'=>$item->plan->id,'plan_title'=>$item->plan->name,'interval'=>$item->plan->interval,'cancel_at_period_end'=>$subs->cancel_at_period_end,'current_period_end'=>$subs->current_period_end,'current_period_start'=>$subs->current_period_start);
                $data['current_period_end'] = date("M d, Y",$data['current_period_end']);
                $plans[] = $data;
            }
        }
        if(is_array($plans)){
            return $plans;
        }
        return false;
    }
    public function cancel_subscription(){
        $this->load->model('user_model');
        $userId = $this->session->userdata('userid');
        $userData = $this->base_model->get_record_by_id('lp_user_mst',array('user_id_pk'=>$userId));
        $customerId = $userData->customer_id;
        if(is_null($customerId)){
            $customerId = $this->_cust_info_by_email($userData->email);
        }
        if(!is_null($customerId)){
            $this->load->library('stripe');
            // Create the library object
            $stripe = new Stripe(null);
            try{
                $response = json_decode($stripe->customer_unsubscribe($customerId));
            }catch(Exception $e){
                print_r($e);
            }
            if($response->current_period_end){
                $this->session->set_flashdata('success', 'Successfully ended your susbcription cycle.');
                redirect('user/myaccount#tabs-5');
                exit;
            }
        }
        $this->session->set_flashdata('error', 'Cound not unsubscribe you. Please try again or contact support.');
        redirect('user/myaccount#tabs-5');
        exit;
    }
    function api_doc(){
        if($this->session->userdata('userid')){
            $this->load->view('user/header', $data);
            $this->load->view('user/documentations');
            $this->load->view('user/footer');
        }
    }

    public function addMarketUpdateTemplatesInDatabase(){
      $this->load->model('user_model');
      $this->user_model->addMarketUpdateTemplatesInDatabase();
    }

    public function download_flyer(){
        $agentInfo = $this->base_model->get_record_by_id('lp_user_mst',
            array(
              'user_id_pk'=>$this->session->userdata('userid')
        ));
        
        //User does not have ref code yet. Then Create one
        if(empty($agentInfo->ref_code)){
          $this->load->model('user_model');
          $agentInfo->ref_code = $this->user_model->setRefCode($this->session->userdata('userid'));
        }

        $data = array(
                    "fullname"=>$agentInfo->first_name." ".$agentInfo->last_name,
                    "license_no"=>$agentInfo->license_no,
                    "phone"=>$agentInfo->phone,
                    "email"=>$agentInfo->email,
                    "company_name"=>$agentInfo->company_name,
                    "company_logo"=>$agentInfo->company_logo,
                    "profile_image"=>$agentInfo->profile_image,
                    "ref_code"=>$agentInfo->ref_code,
            );

        $data['theme'] = $this->input->get('theme');
        $flyer_html = $this->load->view('user/flyer_template',$data,true);

        $wkhtmltopdfPath =  $this->config->item('wkhtmltopdf_path');
        $zoom =  $this->config->item('wkhtmltopdf_zoom');
        $snappy = new Pdf($wkhtmltopdfPath);
        $options = [
            'margin-top'    => 0,
            'margin-right'  => 0,
            'margin-bottom' => 0,
            'margin-left'   => 0,
            'page-size' => 'Letter', 
            'zoom'          => $zoom,
            'load-error-handling'=>'ignore',
            'load-media-error-handling'=>'ignore'
        ];
        $output = $snappy->getOutputFromHtml($flyer_html, $options,
                    200,
                    array(
                        'Content-Type'          => 'application/pdf',
                        'Content-Disposition'   => 'attachment; filename="report.pdf"'
                    ));
        $pdfFileName = 'report_'.uniqid().'.pdf';
        header('Content-Type: application/pdf');
        header('Content-Length: '.strlen( $output ));
        header('Content-disposition: attachment; filename="' . $pdfFileName . '"');
        echo $output;
    }

    public function twoSide_flyer_download(){
        $agentInfo = $this->base_model->get_record_by_id('lp_user_mst',
            array(
              'user_id_pk'=>$this->session->userdata('userid')
        ));
        $data = array(
                    "fullname"=>$agentInfo->first_name." ".$agentInfo->last_name,
                    "license_no"=>$agentInfo->license_no,
                    "phone"=>$agentInfo->phone,
                    "email"=>$agentInfo->email,
                    "company_name"=>$agentInfo->company_name,
                    "company_logo"=>$agentInfo->company_logo,
                    "profile_image"=>$agentInfo->profile_image,
                    "ref_code"=>$agentInfo->ref_code,
            );
        $data['theme'] = $this->input->get('theme');
        $flyer_html = $this->load->view('user/twoPage_flyer_template2',$data,true);

        $wkhtmltopdfPath =  $this->config->item('wkhtmltopdf_path');
        $zoom =  $this->config->item('wkhtmltopdf_zoom');
        $snappy = new Pdf($wkhtmltopdfPath);
        $options = [
            'margin-top'    => 0,
            'margin-right'  => 0,
            'margin-bottom' => 0,
            'margin-left'   => 0,
            'page-size' => 'A4',
            'orientation' => 'Landscape',
            'zoom'          => $zoom,
            'load-error-handling'=>'ignore',
            'load-media-error-handling'=>'ignore',
        ];
        // -O landscape
        $output = $snappy->getOutputFromHtml($flyer_html, $options,
                    200,
                    array(
                        'Content-Type'          => 'application/pdf',
                        'Content-Disposition'   => 'attachment; filename="report.pdf"'
                    ));
        $pdfFileName = 'Flyer_'.uniqid().'.pdf';
        header('Content-Type: application/pdf');
        header('Content-Length: '.strlen( $output ));
        header('Content-disposition: attachment; filename="' . $pdfFileName . '"');
        echo $output;
    }
  
    function get_random_referral_code() 
    {
        $this->load->model('user_model');
        $ref_code = $this->user_model->getRandomRefCode();
        echo $ref_code;
    }

    function preview($reportType='', $language='', $page=0) 
    {
        if ($this->session->userdata('userid')) {
            $reportType = strtolower($reportType);
            if (!in_array($reportType, ['buyer','seller'])) {
                echo "Valid report type is required";exit();
            }
            $language = strtolower($language);
            if (!in_array($language, ['english','spanish'])) {
                echo "Valid language is required";exit();
            }
            if (!is_numeric($page)) {
                echo "Page no should be numeric";exit();
            } else if ($page > 19 || $page < 9) {
                echo "Page does not exits";exit();
            }

            $userId = $this->session->userdata('userid');
            $data['report_content_data'] = $this->prepare_user_report_data($userId, $reportType, $language, $page);
            $data['is_pdf_preview'] = false;

            /* For preview default theme color it BLACK */
            $data['theme'] = '#000'; 
            $this->load->view('reports/'.$language.'/'.$reportType.'/previews/header', $data);
            $this->load->view('reports/'.$language.'/'.$reportType.'/previews/'.$page, $data);
            $this->load->view('reports/'.$language.'/'.$reportType.'/previews/footer', $data);
        } else {
            echo "You are logged out. Please login";
            exit();
        }
    }

    function show_pdf_preview($reportType='', $language='', $page=0)
    {
        if ($this->session->userdata('userid')) {
            $reportType = strtolower($reportType);
            if (!in_array($reportType, ['buyer','seller'])) {
                echo "Valid report type is required";exit();
            }
            $language = strtolower($language);
            if (!in_array($language, ['english','spanish'])) {
                echo "Valid language is required";exit();
            }
            if (!is_numeric($page)) {
                echo "Page no should be numeric";exit();
            } else if ($page > 19 || $page < 9) {
                echo "Page does not exits";exit();
            }

            $userId = $this->session->userdata('userid');

            $data['report_content_data'] = $this->prepare_user_report_data($userId, $reportType, $language, $page);

            // For preview default theme color it BLACK 
            $data['theme'] = '#000'; 
            $data['is_pdf_preview'] = true;

            $html = '';
            $html .= $this->load->view('reports/'.$language.'/'.$reportType.'/previews/header', $data, true);
            $html .= $this->load->view('reports/'.$language.'/'.$reportType.'/previews/'.$page, $data, true);
            $html .= $this->load->view('reports/'.$language.'/'.$reportType.'/previews/footer', $data, true);

            // DEBUG PURPOSE
            //file_put_contents("tmp1.html", $html);

            $wkhtmltopdfPath =  $this->config->item('wkhtmltopdf_path');
            $zoom = $this->config->item('wkhtmltopdf_zoom_seller');

            // if($turboMode && $presentationType=='seller' && $reportLang=='english'){
            //     $zoom =  $this->config->item('wkhtmltopdf_zoom_seller');
            // } else {
            //     $zoom =  $this->config->item('wkhtmltopdf_zoom');
            // }

            $snappy = new Pdf($wkhtmltopdfPath);
            $options = [
                'margin-top'    => 0,
                'margin-right'  => 0,
                'margin-bottom' => 0,
                'margin-left'   => 0,
                'page-size' => 'Letter', 
                'zoom'          => $zoom,
                'load-error-handling'=>'ignore',
                'load-media-error-handling'=>'ignore'
            ];

            $output = $snappy->getOutputFromHtml($html, $options,
                            200,
                            array(
                                'Content-Type'          => 'application/pdf',
                                'Content-Disposition'   => 'attachment; filename="report.pdf"'
                            ));

            // DEBUG PURPOSE
            // $pdfFileDynamic = 'temp/ztest123.pdf';
            // file_put_contents($pdfFileDynamic, $output);

            header("Content-type:application/pdf");
            header('Content-Length: '.strlen( $output ));
            // IF Download file then used below code
            //header('Content-disposition: attachment; filename="sample'.$page.'.pdf"');
            echo $output;
        } else {
            redirect('frontend/index');
        }
    }

    function customize($report = '', $page='')
    {
        if ($this->session->userdata('userid')) {
            $data['title'] = "Report Customization";
            $data['current'] = "customize";
            $userId = $data['user_id'] = $this->session->userdata('userid');

            $this->load->model('report_model');
            $buyer_pages = $this->report_model->getReportPages('english', 'buyer');
            $seller_pages = $this->report_model->getReportPages('english', 'seller');

            $data['buyer_pages'] = $buyer_pages;
            $data['seller_pages'] = $seller_pages;

            $this->load->view('user/header', $data);
            $this->load->view('user/report_customize', $data);
            $this->load->view('user/footer');
        } else {
            redirect('frontend/index');
        }
    }

    function get_user_report_data() 
    {
        if ($this->session->userdata('userid')) {
            $reportType = $this->input->post('type');
            $language = $this->input->post('language');
            $page = $this->input->post('page');
            $userId = $this->session->userdata('userid');

            $finalData = $this->prepare_user_report_data($userId, $reportType, $language, $page);
            $result = ['result'=>'success', 'data'=>$finalData];
            echo json_encode($result);
            exit();
        } else {
            $result = ['result'=>'error', 'message'=>'You are logged out. Please login.', 'data'=>[]];
            echo json_encode($result);
            exit();   
        }
    }

    private function prepare_user_report_data($userId, $reportType, $language, $page)
    {
        $this->load->model('report_model');
        $data = $this->report_model->prepare_user_report_data($userId, $reportType, $language, $page);
        return $data;
    }

    public function save_user_report_data()
    {
        if ($this->session->userdata('userid')) {
            $reportType = $this->input->post('type');
            $language = $this->input->post('language');
            $page = $this->input->post('page');
            $userId = $this->session->userdata('userid');

            if (empty($reportType) || !in_array($reportType, ['buyer', 'seller'])) {
                $result = ['result'=>'error', 'message'=>'Valid report type is required.', 'data'=>[]];
                echo json_encode($result);
                exit();
            }

            if (empty($language) || !in_array($language, ['english', 'spanish'])) {
                $result = ['result'=>'error', 'message'=>'Valid language is required.', 'data'=>[]];
                echo json_encode($result);
                exit();
            }

            if (empty($page)) {
                $result = ['result'=>'error', 'message'=>'Valid page is required.', 'data'=>[]];
                echo json_encode($result);
                exit();
            }

            $postData = $_POST;
            $reportPostData = [];
            $isvalidated = true;
            $missingValues = [];
            foreach ($postData as $key => $value) {
                if (strpos($key, 'cntrl_') !== false) {
                    $tempKey = str_replace('cntrl_', '', $key);
                    $reportPostData[$tempKey] = $value;
                    if (trim($value) == '') {
                        $isvalidated = false;
                        $label = str_replace('_', ' ', $tempKey);
                        $missingValues[] = ucwords($label);
                    }
                }
            }

            if ($isvalidated == false) {
                $result = ['result'=>'error', 'message'=>'Values are missing for - '.implode(', ', $missingValues), 'data'=>[]];
                echo json_encode($result);
                exit();   
            }

            if (empty($reportPostData)) {
                $result = ['result'=>'error', 'message'=>'No reports data to save.', 'data'=>[]];
                echo json_encode($result);
                exit();   
            }

            $reportDataToSave = [];
            foreach ($reportPostData as $key => $value) {
                $reportDataToSave[$key] = ['value'=>trim($value)];
            }

            $this->load->model('report_model');
            $this->report_model->saveReportPageData($userId, $reportType, $language, $page, $reportDataToSave);

            $result = ['result'=>'success', 'message'=>'Data saved successfully. Please check preview.'];
            echo json_encode($result);
            exit();
        } else {
            $result = ['result'=>'error', 'message'=>'You are logged out. Please login.', 'data'=>[]];
            echo json_encode($result);
            exit();   
        }

    }

   // Class ends here
}
?>