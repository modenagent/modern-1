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
	
    public function upload_file($type = ''){
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
        $reportTemplates = $this->base_model->all_records('lp_report_templates');  
        $data['reportTemplates'] = $reportTemplates;
        $default_color['seller'] = $default_color['buyer'] = $default_color['mu'] = null;
        $default_sub_type['seller'] = $default_sub_type['buyer'] = $default_sub_type['mu'] = 1;
        if(is_array($data['reportTemplates']) && count($data['reportTemplates'])) {
          $default_color['seller'] = $default_color['buyer'] = $default_color['mu'] = $data['reportTemplates'][0]->template_color;
        }
        $this->load->model('package_model');
        $packages_all = $this->package_model->get_many_by(['title !='=>'']);
        $packages = array();
        foreach ($packages_all as $packages_all_key => $packages_all_value) {
          $packages[$packages_all_value->package] =  ['val'=>number_format(floatval($packages_all_value->price), 2),'title'=>$packages_all_value->title,'active'=>0,'referral_status'=>$packages_all_value->refferral_status];
        }
        
        $this->load->model('user_package_subscription_model');
        $current_plans=  $this->user_package_subscription_model->with('package')->get_many_by(['user_id'=>$this->session->userdata('userid')]);
        $this->load->library('Stripe_lib');
        $stripe = new Stripe_lib();
        $active_all = false;
        foreach ($current_plans as $current_plan) {
          $check_sub = $stripe->getSubscription($current_plan->sub_id);
          
          if($check_sub && $check_sub->status == 'active') {
            if(isset($packages[$current_plan->package->package]['active'])) {
              $packages[$current_plan->package->package]['active'] = 1;
            }
          }
        }
        
        $data['packages'] = $packages;
        $data['report_price'] = $this->package_model->get_reports_price();

        $this->load->model('user_default_templates_model');

        $theme_data = $data['theme_data'] = $this->user_default_templates_model->with('theme_color_obj')->get_many_by('user_id',$userId);
        if($theme_data) {
          foreach ($theme_data as $theme_data_val) {
            if($theme_data_val->theme_type == 'marketUpdate') {
              $theme_data_val->theme_type = 'mu';
            }
              $default_color[$theme_data_val->theme_type] = $theme_data_val->theme_color_obj->template_color;
              $default_sub_type[$theme_data_val->theme_type] = $theme_data_val->theme_sub_type;
          }
        }

        $data['default_color'] = $default_color;
        $data['default_sub_type'] = $default_sub_type;
        // $this->load->helper('captcha');
        // create_image();
        $this->load->view('user/header', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('user/footer');
      }else{
        // else redirect to frontend login
        redirect('frontend/login');
      }
    }
    public function createPaymentIntent()
    {
      $post_data = json_decode(file_get_contents('php://input'));
      $reponse_array = [
        'status'=>false,
        'message'=>'Something went wrong'
      ];
      if(!$post_data || empty($post_data->pkg_id)) {
        $reponse_array['message']='Invalid data';
        echo json_encode($reponse_array);exit();
      }
      $pkg_name = $post_data->pkg_id;
      $coupon_id = $post_data->coupon_id;
      $this->load->model('package_model');
      $packages_value = $this->package_model->get_by(['package'=>$pkg_name]);
      $coupon_amount = 0;
      if($coupon_id > 0) {
        $this->load->model('coupon_model');
        $coupon_obj = $this->coupon_model->get($coupon_id);
        if($coupon_obj) {
          $coupon_amount = (float)$coupon_obj->coupon_amt;
        }

      }
      if($packages_value && $packages_value->price > $coupon_amount) {
        $final_value = $packages_value->price - $coupon_amount;
        $this->load->library('Stripe_lib'); 
        $stripe = new Stripe_lib();
        $payment_obj = $stripe->createPaymentIntent($final_value,$packages_value->title);
        if($payment_obj && !empty($payment_obj->client_secret)) {
          $reponse_array = [
            'status'=>true,
            'clientSecret'=>$payment_obj->client_secret
          ];
        }

      }
      echo json_encode($reponse_array); 
    }
    public function get_stripe_session() {
      $pkg_name = $this->input->post('pkg_name');
      $coupon_id = $this->input->post('coupon_id');
      $coupon_amount = 0;
      if($coupon_id > 0) {
        $this->load->model('coupon_model');
        $coupon_obj = $this->coupon_model->get($coupon_id);
        if($coupon_obj) {
          $coupon_amount = (float)$coupon_obj->coupon_amt;
        }
        else {
          $coupon_id = 0;
        }

      }
      else {
        $coupon_id = 0;
      }
      $this->load->model('package_model');
      $packages_all_value = $this->package_model->get_by(['package'=>$pkg_name]);
      $return_response['session_id'] = '';
      if($packages_all_value) {
        $this->load->library('Stripe_lib');
        $stripe = new Stripe_lib();
          $product_created = false;
          if(!empty($packages_all_value->stripe_product_id)) {
            
            $product_obj = $stripe->getSubscriptionProduct($packages_all_value->stripe_product_id);
            if($product_obj && $product_obj->active) {
              $product_created = true;
              $product_id = $packages_all_value->stripe_product_id;
            }
          }

          if($product_created == false) {
            $stripe_response = $stripe->createSubscriptionPrice($packages_all_value->title,$packages_all_value->price_per_month);
            $update_package = array();
            $update_package['stripe_product_id'] = $stripe_response['product_id'];
            $update_package['stripe_price_id'] = $stripe_response['price_id'];
            $this->package_model->update($packages_all_value->id,$update_package);
            $product_id = $stripe_response['stripe_product_id'];
          }

          
          $url = base_url('user/recentlp').'?id='.$this->session->userdata('project_id');
          if($pkg_name == 'registry') {
            $url = base_url('user/guests').'?id='.$this->session->userdata('project_id');
          }
          // $url = base_url('');
          //Modify Value
          $payment_value = $packages_all_value->price;
          $ref_id = $this->session->userdata('project_id').'_'.$coupon_id;

          if($coupon_id > 0 && $coupon_amount > 0) {
            $payment_value = $payment_value - $coupon_amount;
          } 

          $stripeSession = $stripe->createSession($product_id,$payment_value,$ref_id,$url);
          $return_response['session_id'] = $stripeSession->id;
        }
        echo json_encode($return_response);
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
                $action .= ' <ul class="list-inline m-0"><li class="list-inline-item"><a href="'.base_url().$report['report_path'].'" download target="_blank"><img src="'.base_url().'assets/new_site/img/cloud-computing.svg" class="w20" alt="..."></a></li>
                <li class="list-inline-item"><a href="javascript:void(0);" target="_blank" data-bs-toggle="modal" data-bs-target="#forward-report" title="Forward" data-id="'.$report['project_id_pk'].'"><img src="'.base_url().'assets/new_site/img/email.svg" alt="..." class="w20"></a></li>
                <li style="opacity:0.7;" class="list-inline-item"><a href="javascript:void(0);" target="_blank" data-bs-toggle="modal" data-bs-target="#sms-report" title="Send SMS" data-id="'.$report['project_id_pk'].'"><img src="'.base_url().'assets/new_site/img/sms.svg" alt="..." class="w20"></a></li>
                <li class="list-inline-item"><a href="javascript:void(0);" onclick="delete_lp(\''.$report['project_id_pk'].'\', \'1\')"><img src="'.base_url().'assets/new_site/img/clear.svg" alt="..."></a></li></ul>';
                
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

    public function getGuestsListing($for_guest=0)
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
            $recordsTotal = $this->user_model->user_reports_count($userId, $_POST,1,$for_guest);
            $result = $this->user_model->user_reports_data($userId, $columns, $_POST,1,$for_guest);

            $i = $_POST['start'];
            $data = [];
            foreach($result as $report) {
                $i++;
                $reportDate = date("m/d/Y", strtotime($report['project_date']));

                $action = '';
                // $action .= ' <a href="'.base_url().$report['report_path'].'" download target="_blank"><i data-toggle="tooltip" title="Download" class="icon icon-download"></i></a>
                // <a href="javascript:void(0);" target="_blank" data-toggle="modal" data-target="#forward-report" title="Forward" data-id="'.$report['project_id_pk'].'"><i data-toggle="tooltip" title="Email" class="icon icon-share"  ></i></a>
                // <a href="javascript:void(0);" onclick="delete_lp(\''.$report['project_id_pk'].'\', \'1\')"><i data-toggle="tooltip" title="Delete" class="icon icon-remove-circle"></i></a>';
                if($for_guest == 0) {

                  $action = '<ul class="list-inline m-0"><li class="list-inline-item"> <a class="download_'.$report['project_id_pk'].'" href="'.base_url().$report['report_path'].'" download target="_blank"><img src="'.base_url().'assets/new_site/img/cloud-computing.svg" class="w20" alt="..."></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0);" class="copy_url" data-url="'.base_url("registry/guest/{$report['unique_key']}").'"><i data-bs-toggle="tooltip" title="Copy URL" class="copy-tile"><img src="'.base_url().'assets/new_site/img/copy.svg" class="w20" alt="..."></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0);" onclick="delete_lp(\''.$report['project_id_pk'].'\', \'2\')"><img src="'.base_url().'assets/new_site/img/clear.svg" class="w20" alt="..."></a></li></ul>';

                  $data[] = [
                      $reportDate, 
                      $report['project_name'], 
                      base_url("registry/guest/{$report['unique_key']}") , 
                      $action
                  ];
                }
                else {
                  $data[] = [
                      $reportDate,
                      $report['project_name'], 
                      $report['guest_name'], 
                      $report['guest_phone'], 
                      $report['guest_email'], 
                      // $action
                  ];
                }
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


    // all listings
    public function recentlp(){
      // show only when the user is logged in
      if($this->session->userdata('userid')){
        $data['current'] = "recentlp";
        $data['title'] = "Recent Lp's";
        $this->load->helper('captcha');
        create_image();  
        $userId = $this->session->userdata('userid');
        if(!empty($_GET['id']) && !empty($_GET['status']) && $_GET['status']=='success') {
          //check if payment webhook called or not
          $listing_obj = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk' => $_GET['id']));
          $wait_count = 0;

          if($listing_obj && $listing_obj->is_active == 'N') {
            do{
              sleep(2);
              $listing_obj = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk' => $_GET['id']));
              if($listing_obj->is_active == 'Y' || $wait_count >= 5) {
                break;
              }
              $wait_count ++;

            }while(true);
            
          }

        }
        $this->load->view('user/header',$data);
        $this->load->view('user/all_listings',$data);
        $this->load->view('user/footer');
      }else{
        // else redirect to frontend login
        redirect('frontend/login');
      }
    }
    // all listings of registry
    public function guests(){
      // show only when the user is logged in
      if($this->session->userdata('userid')){
        $data['current'] = "guests";
        $data['title'] = "Registry";
        $this->load->helper('captcha');
        create_image();  
        $userId = $this->session->userdata('userid');
        if(!empty($_GET['id']) && !empty($_GET['status']) && $_GET['status']=='success') {
          //check if payment webhook called or not
          $listing_obj = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk' => $_GET['id']));
          $wait_count = 0;

          if($listing_obj && $listing_obj->is_active == 'N') {
            do{
              sleep(2);
              $listing_obj = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk' => $_GET['id']));
              if($listing_obj->is_active == 'Y' || $wait_count >= 5) {
                break;
              }
              $wait_count ++;

            }while(true);
            
          }

        }
        $this->load->view('user/header',$data);
        $this->load->view('user/guests/all_listings',$data);
        // $this->load->view('user/footer');
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
                $action .= '<ul class="list-inline m-0"><li class="list-inline-item"><a href="'.base_url().$lead['report_path'].'" download target="_blank"><img src="'.base_url().'assets/new_site/img/cloud-computing.svg" class="w20" alt="..."></a></li></ul>';
                
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

    // My Account
    public function myaccount($active_tab = ''){
      $data['current'] = "myaccount";
      $data['title'] = "My Account";
      if($this->session->userdata('userid')){
        $user_id = $this->session->userdata('userid');
          $this->load->helper('captcha');
          create_image();
          $this->load->model('package_model');
          $this->load->library('Stripe_lib');
          $stripe = new Stripe_lib();
          $packages = $this->package_model->get_many_by(['title !='=>'','is_active'=>1]);

          foreach ($packages as $package_key=>&$package) {
            //Check if product & Price created on stripe
            $price_created = false;
            if(!empty($package->stripe_price_id)) {
              $price_obj = $stripe->getSubscriptionPrice($package->stripe_price_id);
              $product_obj = $stripe->getSubscriptionProduct($package->stripe_product_id);
              if($price_obj && $product_obj->active) {
                //check price object amount if not matched then update price
                if(floatval($package->price_per_month) != (floatval($price_obj->unit_amount_decimal)/100) || !($price_obj->active)) {
                  $price_resp = $stripe->updateSubscriptionPrice($package->stripe_product_id,$package->price_per_month);
                  $update_package['stripe_price_id'] = $price_resp['price_id'];
                  $this->package_model->update($package->id,$update_package);
                  $package->stripe_price_id = $price_resp['price_id'];
                }
                $price_created = true;
              }
            }

            if(!($price_created)) {
              $stripe_response = $stripe->createSubscriptionPrice($package->title,$package->price_per_month);
              $update_package = array();
              $update_package['stripe_product_id'] = $stripe_response['product_id'];
              $update_package['stripe_price_id'] = $stripe_response['price_id'];
              $this->package_model->update($package->id,$update_package);
              $package->stripe_price_id = $stripe_response['price_id'];
              $package->stripe_product_id = $stripe_response['stripe_product_id'];
            }
          }

          $data['packages'] = $packages;
          $data['agentInfo'] = $this->base_model->get_record_by_id('lp_user_mst',
                                                                    array(
                                                                      'user_id_pk'=>$this->session->userdata('userid')
                                                                    ));
          $data['reportTemplates'] = $this->base_model->all_records('lp_report_templates');
          $this->load->model('user_package_subscription_model');

          

          $current_plans=  $this->user_package_subscription_model->with('package')->get_many_by(['user_id'=>$this->session->userdata('userid')]);
          // var_dump($current_plans);die;
           $active_plans = array();
          $cancel_plans = array();
          $active_all = false;
          foreach ($current_plans as $current_plan) {
            $check_sub = $stripe->getSubscription($current_plan->sub_id);
            // var_dump($check_sub);
            if($check_sub && $check_sub->status == 'active') {
              $active_plans[$current_plan->package_id] = $current_plan;
              if($current_plan->package && $current_plan->package->package == 'all') {
                $active_all = true;
              }
              if($check_sub->cancel_at) {
                $cancel_plans[$current_plan->package_id] = date('d/m/y',$check_sub->cancel_at);
              }
              
            }
          }

          $data['active_plans'] = $active_plans;
          $data['cancel_plans'] = $cancel_plans;
          $data['active_all'] = $active_all;



          $customer_created = false;
          $check_customer = $data['agentInfo'];
          $userId = $check_customer->user_id_pk;
          if(!empty($check_customer->stripe_user_id)) {
            $customer_obj = $stripe->getCustomer($check_customer->stripe_user_id);
            if($customer_obj) {
              $customer_id = $check_customer->stripe_user_id;
              $customer_created = true;
            }
            
          }
          if(!($customer_created)) {

            $customer_data = [
              'email'=>$check_customer->email,
              'name'=>$this->session->userdata('username'),
            ];

            $customer_response = $stripe->createCustomer($customer_data);
            $customer_id = $customer_response->id;
            //Update user table with stripe Id
            $this->base_model->update_record_by_id('lp_user_mst',array('stripe_user_id'=>$customer_id),array('user_id_pk'=>$userId));
          }

          // var_dump($active_plans);die;

          $this->load->model('user_default_templates_model');

          $data['theme_data'] = $this->user_default_templates_model->get_many_by('user_id',$user_id);
          $data['customer_id'] = $customer_id;


          //RETS API
          $this->load->model('user_rets_api_details_model');
          $rets_api_data = $this->user_rets_api_details_model->get_by('user_id',$userId);
          $data['rets_api_data'] = (object)$rets_api_data;
          //Check for active content
          $valid_tabs = [
            'login','agent','company','theme','membership','retsapi'
          ];
          if($active_tab == '' ||  !in_array($active_tab, $valid_tabs)) {
            $active_tab = 'login';
          }
          $data['active_tab'] = $active_tab;
          
          // print_r($data['agentInfo']);
          $this->load->view('user/header', $data);
          $this->load->view('user/myaccount', $data);
          $this->load->view('user/footer');
      }else{
        redirect('frontend/index');
      }
    }
    public function saveRetsDetails()
    {
      $userId = $this->session->userdata('userid');
      if($userId){

        $postData = $this->input->post();
        // $this->encryption->initialize(array('driver' => 'openssl'));
        $rets_user = $this->input->post('rets_user');
        $rets_password = $this->input->post('rets_password');

        //Validate credentials
        $this->load->library('rets');
        $rets = new Rets();
        $result = $rets->callSimplyRets($rets_user,$rets_password);
        $decoded_result = json_decode($result,true);
        if(!empty($decoded_result['error'])) {
          //Error
          $this->session->set_flashdata('error', $decoded_result['error']);
          redirect('user/myaccount/retsapi');
          exit();

        }
        

        $ciphertext = openssl_encrypt($rets_password,"AES-128-ECB",$this->config->item('encryption_key'));

        $this->load->model('user_rets_api_details_model');
        $data = array();
        $data['user_id']=$userId;
        $check_data = $this->user_rets_api_details_model->get_by($data);
        if($check_data && !empty($check_data->id)) {
          $update_data = array();
          $update_data['user_name'] = $rets_user;
          $update_data['user_password'] = $ciphertext;
          $this->user_rets_api_details_model->update($check_data->id,$update_data);
        } else {
          $data['user_name'] = $rets_user;
          $data['user_password'] = $ciphertext;
          $this->user_rets_api_details_model->insert($data);
        }
        $this->session->set_flashdata('success', 'Data stored succsessfully');
        redirect('user/myaccount/retsapi');
      }else{
        redirect('frontend/login');
      }


      // var_dump($postData);
    }
    public function getPreviews()
    {
      $data = array();
      $data['type']=$this->input->post('theme_type');
      $data['sub_type']=$this->input->post('theme_sub_type');
      $this->load->view('user/theme/index',$data);
    }
    public function saveTheme()
    {
      $return_data['status'] = '';
      $return_data['message'] = '';
      $theme_type = $this->input->post('theme_type');
      $theme_sub_type = $this->input->post('theme_sub_type');
      $theme_color = $this->input->post('theme_color');
      $userId = $this->session->userdata('userid');
      $this->load->model('user_default_templates_model');
      //Check existence
      $data['user_id']=$userId;
      $data['theme_type']=$theme_type;
      $check_data = $this->user_default_templates_model->get_by($data);
      if($check_data && !empty($check_data->id)) {
        $update_data['theme_sub_type'] = $theme_sub_type;
        $update_data['theme_color'] = $theme_color;
        $this->user_default_templates_model->update($check_data->id,$update_data);
        $return_data['status'] = 'success';
        $return_data['message'] = 'Default theme Changed.';
      }
      else {
        $data['theme_sub_type'] = $theme_sub_type;
        $data['theme_color'] = $theme_color;
        $this->user_default_templates_model->insert($data);
        $return_data['status'] = 'success';
        $return_data['message'] = 'Default theme Saved.';
      }
      echo json_encode($return_data);

    }
    public function createSubscription(){

      $userId = $this->session->userdata('userid');
      $reponse_array = [
        'status'=>false,
        'message'=>'Something went wrong'
      ];
      if(!($userId)) {
        echo json_encode($reponse_array);exit();
      }
      $this->load->library('Stripe_lib');
      $this->load->model('package_model');
      $stripe = new Stripe_lib();
      $userId = $this->session->userdata('userid');
      $post_data = json_decode(file_get_contents('php://input'));
      if(!$post_data || empty($post_data->priceId) || empty($post_data->customerId) /*|| empty($post_data->paymentMethodId)*/) {
        $reponse_array['message']='Invalid data';
        echo json_encode($reponse_array);exit();
      }
      $stripe_price_id = $post_data->priceId;

      $package = $this->package_model->get_by('stripe_price_id',$stripe_price_id);
      $stripe_price_id = '';
      if(!$package) {
        $reponse_array['message']='Invalid Package';
        echo json_encode($reponse_array);exit();
        
      }
      //Check if product & Price created on stripe
      $stripe_price_id = $package->stripe_price_id;
      
      // Check if customer exist in stripe
      
      $customer_id = $post_data->customerId;
      
      // $stripe->setPaymentMethod($customer_id,$post_data->paymentMethodId);

      $subscription_response = $stripe->createSubscription($customer_id,$stripe_price_id);
      if($subscription_response && !empty($subscription_response->id)) {

        $this->load->model('user_package_subscription_model');

        $subscription_data = array(
          'sub_id' => $subscription_response->id,
          'user_id' => $userId,
          'package_id' => $package->id,
          'amount' => floatval(($subscription_response->plan->amount_decimal)/100),
          'interval' => $subscription_response->plan->interval,
          'is_live' => $subscription_response->livemode,

        );
        $this->user_package_subscription_model->insert($subscription_data);
        $reponse_array = [
          'subscriptionId' => $subscription_response->id,
          'clientSecret' => $subscription_response->latest_invoice->payment_intent->client_secret
        ];
        $reponse_array['status'] = true;
        //If user subscribed for All then cancel other subscription
        if($package->package == 'all') {
          // $this->load->model('user_package_subscription_model');
          $current_plans=  $this->user_package_subscription_model->with('package')->get_many_by(['user_id'=>$userId]);
          // $this->load->library('Stripe_lib');
          $stripe = new Stripe_lib();
          $active_all = false;
          foreach ($current_plans as $current_plan) {
            $check_sub = $stripe->getSubscription($current_plan->sub_id);
            
            if($check_sub && $check_sub->status == 'active') {
              $resp = $stripe->cancelSubscription($current_plan->sub_id);
              // if(isset($packages[$current_plan->package->package]['active'])) {
              //   $packages[$current_plan->package->package]['active'] = 1;
              // }
            }
          }
        }
      }
      echo json_encode($reponse_array);exit(); 
      
    }
    public function checkWebhook()
    {

      
      $this->load->library('Stripe_lib');
      $stripe = new Stripe_lib();
      $subscription = $stripe->checkWebhook();
      // $myfile = fopen("stripe_log_file.txt", "w") or die("Unable to open file!");
      
      // fwrite($myfile, $subscription);
      
      // fclose($myfile);
      // die;
      if($subscription) {
        if($subscription->subscription) {

          $check_sub = $stripe->getSubscription($subscription->subscription);
          if($check_sub->status == 'active') {

            $this->load->model('user_package_subscription_model');
            $explode_ref = explode('_', $subscription->client_reference_id);
            if(count($explode_ref) > 1) {
              $check_entry = $this->user_package_subscription_model->get_by('sub_id', $subscription->subscription);
              if(!($check_entry)) {

                $subscription_data = array(
                  'sub_id' => $subscription->subscription,
                  'user_id' => $explode_ref[0],
                  'package_id' => $explode_ref[1],
                  'amount' => floatval(($subscription->amount_total)/100),
                  'interval' => 'month',
                  'is_live' => $subscription->livemode,

                );
                $this->user_package_subscription_model->insert($subscription_data);

              }
              
            }
          }
        }
        else {
          $ref_id_str = $subscription->client_reference_id;
          if($ref_id_str) {
            $ref_id_array = explode('_', $ref_id_str);
            $ref_id = $ref_id_array[0];
            $coupon_id = 0;
            if(count($ref_id_array)>1) {

              $coupon_id = $ref_id_array[1];

            }
            $listing_obj = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk' => $ref_id));
            $check_entry = $this->base_model->get_record_by_id('lp_my_cart',array('txn_id' => $subscription->id));
            if($listing_obj && !($check_entry)) {
              $coupon_amount = 0;
              if($coupon_id>0) {
                $this->load->model('coupon_model');
                $coupon_obj = $this->coupon_model->get($coupon_id);
                if($coupon_obj) {
                  $coupon_amount = (float)$coupon_obj->coupon_amt;
                }
                else {
                  $coupon_id = 0;
                }
              }

              $lp_cart_data = array(
                        'user_id_fk' => $listing_obj->user_id_fk,
                        'paid_on' => date('Y-m-d'),
                        'txn_id' => $subscription->id,
                        'is_success' => 'Y',
                        'total_amount' => ((($subscription->amount_total)/100)+$coupon_amount),
                        
                        'coupon_id_fk' => $coupon_id,
                        'project_id_fk' => $ref_id
                      );
              $users = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $listing_obj->user_id_fk));

              $result = $this->base_model->insert_one_row('lp_my_cart',$lp_cart_data);
              if($result) {
                $lastId = $this->base_model->get_last_insert_id();
                $invoice_no = $this->generateInvoice($listing_obj->user_id_fk); 

                $lp_invoice_data = array(
                  'invoice_num' => 'INV'.$invoice_no,
                  'cart_id_fk' => $lastId,
                  'user_id_fk' => $listing_obj->user_id_fk,
                  'invoice_amount' => ((($subscription->amount_total)/100)+$coupon_amount),
                  'invoice_to' => $users[0]['first_name'],
                  'invoice_addr' => $users[0]['city'],
                  'order_amount' => ($subscription->amount_total)/100,
                  'coupon_amount' => $coupon_amount,
                  );
                $result2 = $this->base_model->insert_one_row('lp_invoices',$lp_invoice_data);

                $this->gen_invoice($this->base_model->get_last_insert_id(),$lastId,$listing_obj->user_id_fk,$ref_id);

                $updateProject = array('is_active'=>'Y');
                $this->base_model->update_record_by_id('lp_my_listing',$updateProject,array('project_id_pk'=>$ref_id));
                if($coupon_id>0) {
                  $this->base_model->add_coupon_redeem_log($coupon_id,$listing_obj->user_id_fk,$ref_id);
                }
              }

            }
          }
              
        }
      }
      
    }
    public function cancel_subscribe(){
      $this->load->library('Stripe_lib');
      $stripe = new Stripe_lib();
      $this->load->model('user_package_subscription_model');
      $sub_id = $this->input->post('sub_id');
      $sub_obj = $this->user_package_subscription_model->get($sub_id);
      if($sub_obj) {
        $sub_obj_id = $sub_obj->sub_id;
        $resp = $stripe->cancelSubscription($sub_obj_id);
        if($resp) {
          $this->session->set_flashdata('success', "Subscription cancelled.");

          redirect('user/myaccount/membership');
        }
        else {
          // echo "Error";
        }
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

    
    // user password update
    public function update_password()
    {
        $userId = $data['user_id'] = $this->session->userdata('userid'); 
        if($userId) {  
            
            $result = $this->base_model->get_record_by_id('lp_user_mst' , array('email'=>$_POST['email']));

            $password = $_POST['old_password'];
            if($_POST['new_password'] != $_POST['confirm_password']) {
              $resp = array('status'=>'failed', 'message'=>'Confirm password should be same as new password!');
            }
            else {

              if($result && password_verify($password,$result->password)){
                $encrypted_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $this->base_model->update_record_by_id('lp_user_mst', array('password'=>$encrypted_password), array('user_id_pk'=>$result->user_id_pk));
                $resp = array('status'=>'success', 'message'=>'Updated successfully');
              }else{
                $resp = array('status'=>'failed', 'message'=>'Your current password invalid please enter a valid password!');
              }
            }
        }else{
          $resp = array('status'=>'failed', 'message'=>'unauthrized access!');
        }             

        echo json_encode($resp);
    }

     public function gen_invoice($inv,$cart_id,$userId='',$project_id=''){
      if($userId == '') {
        $userId = $data['user_id'] = $this->session->userdata('userid');
      }
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
          // $invoice_data['total'] = $total_amount;
          $invoice_data['total'] = $invoice_data['total_amount'] - $invoice_data['discount_amount'];
          // my flyer data
          if($project_id = '') {
            $project_id = $this->session->userdata('project_id');
          }
          $myflyers = $data['myflyers'] = $this->base_model->get_record_result_array('lp_my_listing', array('user_id_fk'=>$userId, 'project_id_pk'=>$project_id));
          
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
    public function generateInvoice($user_id = '') {
      if($user_id == '') {
        $user_id = $this->session->userdata('userid');
      }
		  $invoice_no = $user_id.'-'.time();
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

          $desc = 'Modern Agent Paymemnt';
          $canprocess_payment = true;
          if(!$byPassPayment) {
            $canprocess_payment = false;
            $payment_id = $this->input->post('payment_intent_id');
            try{
              //check payment intent valid or not
              $this->load->library('Stripe_lib');
              $stripe = new Stripe_lib();
              $payment_obj = $stripe->getPaymentIntent($payment_id);
              if($payment_obj && $payment_obj->status == 'succeeded') {
                $canprocess_payment = true;
              }
              // $response = json_decode($stripe->charge_card($amount, $card, $desc));     
            }catch(Exception $e){
            }
          }
          // if the request is coming from the widget then we directly get the file link
          if(isset($_POST['widgetType'])){
             $data = array(
                        'user_id_fk' => $userId,
                        'paid_on' => date('Y-m-d'),
                        'txn_id' => '',
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
          }elseif($byPassPayment || $canprocess_payment) {
              $data = array(
                        'user_id_fk' => $userId,
                        'paid_on' => date('Y-m-d'),
                        'txn_id' => $payment_id,
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

                $_project = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk' => $this->session->userdata('project_id')));
                if($_project && trim($_project->report_type) == 'registry') {
                  $this->session->set_flashdata('project_id', $_project->project_id_pk);
                  redirect(base_url('user/guests').'?id='.$this->session->userdata('project_id'));
                }
                else {

                  redirect(base_url().'index.php?/user/recentlp?id='.$this->session->userdata('project_id'));
                }

              }
          } else {
            if($this->input->is_ajax_request()){
                echo json_encode(array("status"=>"failed","msg"=>"failed to craete PDF"));
                exit();
            }
            $response = array('error'=>'Invalid request');
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
        else if($from == 2) {
          redirect(base_url('user/guests'));
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
        // var_dump($listingData);die;
        $data = array();
        $data['address'] = $listingData->property_address;
        $data['report_url'] =base_url($listingData->report_path);

        $message = $this->load->view('mails/download_report',$data,TRUE);
        
        
        $this->base_model->queue_mail($email,'Report',$message,array($listingData->report_path),$ccTo);
        
        $this->session->set_flashdata('success', "Report sent successfully.");
        redirect('user/recentlp');
        exit;
    }

    public function sms_report(){
        $contact_number = $this->input->post('sms_to');
        $projectId = $this->input->post('sms_report_id');

        $listingData = $this->base_model->get_record_by_id('lp_my_listing',array('project_id_pk'=>$projectId));
        $reportLink = base_url($listingData->report_path);
                    
        // Your Account SID and Auth Token from twilio.com/console
          $sid = 'AC29e21e9430aaac14af1cc7da1b01a57e';
          $token = 'd33346194bc839d2c495c6b35c2c5a64';
          $client = new Client($sid, $token);

          // Use the client to do fun stuff like send text messages!
          $smsText = "You can can download report by clicking this url. {$reportLink}";
          // echo $smsText;die;
          try {
            $smsRes = $client->messages->create(
              // the number you'd like to send the message to
              '+1'.$contact_number,
              array(
                  // A Twilio phone number you purchased at twilio.com/console
                  'from' => '+14243519064',
                  // the body of the text message you'd like to send
                  'body' => $smsText
              )
            );
          } catch (Exception $e){
            echo $e->getMessage();die;
              $this->session->set_flashdata('error', "SMS could not be sent on this number.");
              redirect('user/recentlp');
              
          }
        // $message = ;
        // $this->base_model->queue_mail($email,'Report',$message,array($listingData->report_path),$ccTo);
        
        $this->session->set_flashdata('success', "SMS sent successfully.");
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
                redirect('user/myaccount/membership');
                exit;
            }
        }
        $this->session->set_flashdata('error', 'Cound not unsubscribe you. Please try again or contact support.');
        redirect('user/myaccount/membership');
        exit;
    }
    function preview($reportType='', $language='', $page=0) 
    {
        if ($this->session->userdata('userid')) {
            $is_enterprise_user = is_enterprise_user();
            if ($is_enterprise_user) {
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
                echo "Permission Denied.";
                exit();    
            }
        } else {
            echo "You are logged out. Please login";
            exit();
        }
    }

    function show_pdf_preview($reportType='', $language='', $page=0)
    {
        if ($this->session->userdata('userid')) {
            $is_enterprise_user = is_enterprise_user();
            if (!$is_enterprise_user) {
                redirect('frontend/index');
            }
            $reportType = strtolower($reportType);
            if (!in_array($reportType, ['buyer','seller'])) {
                echo "Valid report type is required";exit();
            }
            $language = strtolower($language);
            if (!in_array($language, ['english','spanish'])) {
                echo "Valid language is required";exit();
            }
            if ($page!='all') {
                if (!is_numeric($page)) {
                    echo "Page no should be numeric";exit();
                } else if ($page > 19 || $page < 9) {
                    echo "Page does not exits";exit();
                }
            }
            
            $userId = $this->session->userdata('userid');

            $startPage = $endPage = $page;
            if ($page == 'all') {
                $startPage = 9;
                $endPage = 19;
            } 

            $html = '';
            for ($pageCounter=$startPage;$pageCounter<=$endPage;$pageCounter++) {
                $data['report_content_data'] = $this->prepare_user_report_data($userId, $reportType, $language, $pageCounter);

                // For preview default theme color it BLACK 
                $data['theme'] = '#000'; 
                $data['is_pdf_preview'] = true;

                $html .= $this->load->view('reports/'.$language.'/'.$reportType.'/previews/header', $data, true);
                $html .= $this->load->view('reports/'.$language.'/'.$reportType.'/previews/'.$pageCounter, $data, true);
                $html .= $this->load->view('reports/'.$language.'/'.$reportType.'/previews/footer', $data, true);
            }

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
          $is_enterprise_user = is_enterprise_user();
          if ($is_enterprise_user) {
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
        } else {
            redirect('frontend/index');
        }
    }

    function get_user_report_data() 
    {
        if ($this->session->userdata('userid')) {
            $is_enterprise_user = is_enterprise_user();
            if ($is_enterprise_user) {
                $reportType = $this->input->post('type');
                $language = $this->input->post('language');
                $page = $this->input->post('page');
                $userId = $this->session->userdata('userid');

                $finalData = $this->prepare_user_report_data($userId, $reportType, $language, $page);
                $result = ['result'=>'success', 'data'=>$finalData];
                echo json_encode($result);
                exit();
            } else {
                $result = ['result'=>'error', 'message'=>'Permission Denied', 'data'=>[]];
                echo json_encode($result);
                exit();       
            }
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

            $is_enterprise_user = is_enterprise_user();
            if (!$is_enterprise_user) {
                $result = ['result'=>'error', 'message'=>'Permission Denied.', 'data'=>[]];
                echo json_encode($result);
                exit();   
            }

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


    public function generate_qr_code($uniqid = '',$size=6,$custom_bg_color=null,$custom_color = null)
    {
      if(empty($uniqid) && !empty($_GET['url'])) {
        $qr_link = urldecode($_GET['url']);
      }
      else {
        $qr_link = base_url('registry/guest/'.$uniqid);
      }
      $this->load->library('phpqrcode/qrlib');
      $custom_bg_color = json_decode(urldecode($custom_bg_color));
      $custom_color = json_decode(urldecode($custom_color));
      // var_dump($custom_bg_color);die;
      if(is_array($custom_bg_color) && count($custom_bg_color) == 3) {
        QRimage::$custom_bg_color = $custom_bg_color;        
      }
      if(is_array($custom_color) && count($custom_color) == 3) {
        QRimage::$custom_color = $custom_color;        
      }
      $image = QRcode::png($qr_link,false,QR_ECLEVEL_L,$size,4);
    }

    public function testPaymentIntent($payment_id='')
    {

      echo base_url("user/generate_qr_code/1234/6/".urlencode(json_encode([183,220,65]))."/".urlencode(json_encode([255,255,255])));
      die;

      $payment_id = 'pi_1JIuW8SGHshxlum8wBSrQZsL';
      $this->load->library('Stripe_lib');
        $stripe = new Stripe_lib();
        $data = $stripe->getPaymentIntent($payment_id);
        var_dump($data->status);
    }


   // Class ends here
}
?>