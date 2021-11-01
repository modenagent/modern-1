<?php defined('BASEPATH') OR exit('No direct script access allowed');
require 'Twilio/autoload.php';
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Auth extends REST_Controller
{
    function __construct()
    {
        // Construct our parent class
        parent::__construct();      
 		$this->load->library('phpmailer');  
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
        // remember me code
        if ( $this->input->post( 'rememberme' ) )
            $this->config->set_item('sess_expire_on_close', '0');
    }

    // Login rest api
    public function userlogin_post()
    {
        if(!$this->post('uemail') || !$this->post('upass')){
            $this->response(NULL, 400);
        }
        $tableName = "lp_user_mst";
        $user = $this->base_model->get_login_data($tableName,$this->post('uemail'),$this->post('upass')); 

        if($user){
            // user login
            if ($user->is_active == 'Y') {
                $newdata = array(
                    'userid'    => $user->user_id_pk,
                    'username'  => ucfirst($user->first_name).' '.ucfirst($user->last_name),
                    'user_email' => $user->email,
                    'logged_in' => TRUE
                    );
                $sessionData = $this->session->set_userdata($newdata);
                $resp = array(
                    "status"=>"success",
                    "msg"=>"login successful",
                    "data"=>$newdata
                    );
                    if($this->get('callback')){
                        echo $this->post('callback')."(".json_encode($resp).")";
                    }else{
                        $this->response($resp, 200);
                    }
                }else{
                    $resp = array(
                        "status"=>"error",
                        "msg"=>"Your account has been deactivated."
                        );
                    if($this->post('callback')){
                        echo $this->post('callback')."(".json_encode($resp).")";
                    }else{
                        $this->response($resp, 200);
                    }
                }         
        } else {
            $resp = array(
                "status"=>"error",
                "msg"=>"Wrong Email or Password"
                );
            if($this->post('callback')){
                echo $this->post('callback')."(".json_encode($resp).")";
            }else{
                $this->response($resp, 200);
            }
        }
    }

    // user register api
    public function userregister_post()
    {

        $table = "lp_user_mst";
        $email = $this->post('uemail');
        $where = array('email'=> $email);
        $resultCheck = $this->base_model->check_existent($table,$where);
        if(!$resultCheck){

            $uname = $this->post('uname');
            $where = array('user_name'=> $uname);
            $resultCheck = $this->base_model->check_existent($table,$where);
            if ($resultCheck) {
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Username already exists.'
                );
                if($this->get('callback')){
                    echo $this->get('callback')."(".json_encode($resp).")";
                }else{
                    $this->response($resp, 200);
                }
            }

            $roleId = $this->get('role_id')?$this->get('role_id'):$this->post('role_id');
            if(!isset($roleId) || !is_numeric($roleId) ) {
                $roleId = 4;
            }
            $ref_code = $this->post('ref_code');
            $parentId = str_ireplace("REF", "", $ref_code);
            if($ref_code!=''){
                $parentId = (int)$parentId;
                $resultCheck = $this->base_model->check_existent($table,array('user_id_pk'=>$parentId));
                if(!$resultCheck) {
                    $resp = array(
                        'status'=>'error',
                        'msg'=>'Invalid Referral Code.'
                        );
                    if($this->get('callback')){
                        echo $this->get('callback')."(".json_encode($resp).")";
                    }else{
                        $this->response($resp, 200);
                    }
                }
            } else {
                $parentId = (int)$this->get('parent_id')?(int)$this->get('parent_id'):(int)$this->post('parent_id');
            }
            $password = $this->post('user_pass')?$this->post('user_pass'):$this->post('upass');
            $encrypted_password = password_hash($password,PASSWORD_DEFAULT);
            $user = array(
                'password' => $encrypted_password,
                'user_name' => $this->post('uname'),
                'first_name' => $this->post('fname'),
                'last_name' => $this->post('lname'),
                'email'=>$this->post('uemail'),
                'phone' => $this->post('uphone'),
                'parent_id' => $parentId,
                'role_id_fk' => (int)$roleId,
                'license_no'=>  $this->post('ulicence'),
                'company_name'=>  $this->post('cname'),
                'company_add' => $this->post('caddress'),
                'company_city' => $this->post('ccity'),
                'comapny_zip' => $this->post('czipcode'),
                'company_logo' => '',
                'company_phone' => '',
                'company_suite' => '',
                'company_state' => '',
                'user_credits' => '0',
                'registered_date' => date('Y-m-d H:i:s', time()),
                'is_active' => 'Y',
            );
            if(!empty($this->post('company_url'))) {
                $user['company_url'] = $this->post('company_url');
            }
            if(!empty($this->post('cma_url'))) {
                $user['cma_url'] = $this->post('cma_url');
            }
            $resp = $this->base_model->insert_one_row('lp_user_mst', $user);
            if($resp){
                if($this->get('backend')){
                    $resp = array(
                        'status'=>'success',
                        'msg'=>'User added successfully.'
                    );
                    if($this->get('callback')){
                        echo $this->get('callback')."(".json_encode($resp).")";
                        exit;
                    }else{
                        $this->response($resp, 200);
                        exit;
                    }
                }
                $lastId = $this->base_model->get_last_insert_id();
                $newdata = array(
                    'userid'    => $lastId,
                    'username'  => ucfirst($this->post('fname')).' '.ucfirst($this->post('lname')),
                    'user_email'     => $this->post('uemail'),
                    'logged_in' => TRUE
                    );
                $sessionData = $this->session->set_userdata($newdata);
                $userName = $this->input->post('fname').' '.$this->input->post('lname');
                $name = 'Administrator';
                $mail_data = array();
                $mail_data['email'] = $this->input->post('uemail');
                $mail_data['first_name'] = $this->input->post('fname');
                $mail_data['last_name'] = $this->input->post('lname');
                $mail_data['phone'] = $this->input->post('uphone');
                $message = $this->load->view('mails/registration_success',$mail_data,true);

                $send = $this->base_model->queue_mail($this->input->post('uemail'),'Modern Agent Registration',$message);
                $response = array(
                    'status'=>'success',
                    'msg'=>'User added successfully.'
                );
                if($this->get('callback')){
                    echo $this->get('callback')."(".json_encode($response).")";
                    exit;
                }else{
                    $this->response($response, 200);
                    exit;
                }
                
            }
            else{
                $resp = array(
                    'status'=>'error',
                    'msg'=>'User could not be added.'
                );
                if($this->get('callback')){
                    echo $this->get('callback')."(".json_encode($resp).")";
                }else{
                    $this->response($resp, 200);
                }
            }
            
            
            
        } else {
            $resp = array(
                'status'=>'error',
                'msg'=>'User Email Address already exists.'
            );
            if($this->get('callback')){
                echo $this->get('callback')."(".json_encode($resp).")";
            }else{
                $this->response($resp, 200);
            }
        }       
    }
    // ramdon string function
    private function generateRandomString() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
    }
    // forgot password api 
    public function userforgotpass_post()
    {
        $data = array(
            'email'=>$this->post('uemail')
        );
        $table = "lp_user_mst";
        $result = $this->base_model->get_record_by_id($table, $data);
        
        if($result){            
            $userId = $result->user_id_pk;
            $userName =  $result->first_name;
            $pemail = $result->email;
            $mobileNumber = clean_phone($result->phone);
            $random_password = $this->generateRandomString();
            $data = array(
                'password' => password_hash($random_password,PASSWORD_DEFAULT)
            );
            $where = array(
                'user_id_pk' => $userId
            );

            $result2 = $this->base_model->update_record_by_id($table,$data,$where);


            $env_mode = 'devlopment'; //Set default value
            if(!empty(!$_ENV['ENV_MODE'])) {
                $env_mode = $_ENV['ENV_MODE'];
            }
            if(strtolower($env_mode) == 'production') {
                
                // send sms until we have the mail running 
                // Your Account SID and Auth Token from twilio.com/console
                $sid = 'AC29e21e9430aaac14af1cc7da1b01a57e';
                $token = 'd33346194bc839d2c495c6b35c2c5a64';
                $client = new Client($sid, $token);

                // Use the client to do fun stuff like send text messages!
                $smsText = "Your New Password is: {$random_password}. \n Regards, \n Modern Agent Team";
                try {
                $smsRes = $client->messages->create(
                    // the number you'd like to send the message to
                    '+1'.$mobileNumber,
                    array(
                        // A Twilio phone number you purchased at twilio.com/console
                        'from' => '+14243519064',
                        // the body of the text message you'd like to send
                        'body' => $smsText
                    )
                );
                } catch (Exception $e){
                    // var_dump($e);
                    echo json_encode(array("status"=>"failed",'msg'=>'SMS could not be sent on this number.',"sms"=>$smsText));
                    exit();
                }
            }
            

            if($result2){
                $name = 'Administrator';
                $message ='<table cellpadding="0" cellspacing="0" border="0"  width="100%" style="" >
                              <tr>
                                <td style="padding:0 20px; font-family:Montserrat; padding-top:100px;">
                                    <table width="100%" cellpadding="5">
                                        <tr>
                                            <td style="text-align:center;"><img src="https://gallery.mailchimp.com/b10d88eb10799345e0303a43d/images/cd5747f7-7929-4386-acc5-7f74a816fc10.png" width="400px" style="padding:10px;" /></td>
                                           
                                        </tr>    

                                    </table>
                                </td>    
                              </tr>
                              
                              <tr>
                                    <td style=" padding:5px 20px;">
                                        <table width="90%" cellpadding="10" cellspacing="0" style="font-size:13px; margin:0 auto; text-align:center; font-family:Helvetica; color:#666666; background:#ffffff;">
                                                <tr><td style="color: #000; font-weight: bold;font-family:Montserrat; padding-bottom:40px;"><span style="font-size: 26px;">Temporary Password</span></td></tr>
                                                <tr>                    
                                                <td>
                                                <table cellpadding="10" cellspacing="0" width="100%" style="font-size:14px; text-align:center; font-family:Helvetica; color:#666666; margin-top:-15px;">
                                                   <tr>  
                                                       <td style="font-size:12px; text-align:center; color:#000; https://gallery.mailchimp.com/b10d88eb10799345e0303a43d/images/cd5747f7-7929-4386-acc5-7f74a816fc10.png">Forgot your password? Not a problem we got your back. We have created a temporary password <br>that you can use.  You can change this at anytime by going to your account settings.</td>
                                                   </tr>
                                                   <tr><td style="padding-bottom:20px;">Your New Password is: <strong>'.$random_password.'</strong><br><br></td></tr>
                                                   <tr>
                                                    <td>
                                                      <a href="'.site_url().'" style="background:#000000; padding:10px 100px; border-radius:0px; text-decoration:none; color:#fff; font-size:20px; outline:none; font-weight:bold; font-family:Montserrat;">Log in</a>
                                                    </td>
                                                </tr>
                                                    <tr>
                                                  <td style="font-size:12px; text-align:center; line-height:20px;">Warm Regards,<br>
                                                    Modern Agent Team <br>
                                                    <a href="#" style="color:#666;">'.site_url().'</a></td>
                                                  <td></td>
                                                </tr>
                                               </table>
                                               </td>
                                           </tr>
                                    </table>
                                </td>
                              </tr>
                              
                        <!--     <tr>
                                <td>
                                    <table width="90%" cellspacing="5" cellpadding="5" style=" font-size:11px; font-family:Helvetica; color:#999; padding:0px; margin: auto">
                                        <tr>
                                          <td>
                                            <a href="javascript:;" style="color:#999; border-right:1px solid #999; padding:0px 15px;">Privacy</a>
                                            <a href="javascript:;" style="color:#999; border-right:1px solid #999; padding:0px 15px;">About us</a>
                                            <a href="javascript:;" style="color:#999; padding:0 15px;">FAQ</a>
                                          </td>
                                          <td>&copy; 2015 - All Rights Reserved.</td>
                                            
                                        </tr>
                                    </table>
                                 </td>
                              </tr> -->
                              </tr>
                            </table>';
		        $send = $this->base_model->queue_mail($pemail,'Modern Agent Reset Password',$message);					
                
                if($send){
                    $resp = array(
                        'status'=>'success',
                        'msg'=>'Password has been sent to your registered email.'
                    );
                    if($this->get('callback')){
                        echo $this->get('callback')."(".json_encode($resp).")";
                    }else{
                        $this->response($resp, 200);
                    }
                }else{
                    $resp = array(
                        'status'=>'error',
                        'msg'=>'Reset password could not be sent. Please try again.'
                    );
                    if($this->get('callback')){
                        echo $this->get('callback')."(".json_encode($resp).")";
                    }else{
                        $this->response($resp, 200);
                    }
                }
            }
        }else{
            $resp = array(
                'status'=>'error',
                'msg'=>'Email does not exists.'
            );
            if($this->get('callback')){
                echo $this->get('callback')."(".json_encode($resp).")";
            }else{
                $this->response($resp, 200);
            }
        }
        
    }
    // reset password api
    public function resetpassword_get()
    {
        // abondoned  
    }   
    // change password
    public function changepassword_get()
    {

            $userId = $this->get('userid');
            $oldPassword = $this->get('oldpassword');
            $newPassword = $this->get('newpassword');
            $confirmPassword = $this->get('confirmpassword');
            $where = array('password' => $oldPassword);
            $resultCheck = $this->base_model->check_existent('att_user_mst',$where);
            if($resultCheck){
                if(!empty($newPassword) && !empty($confirmPassword) && ($newPassword == $confirmPassword)) {
                    $data = array(
                        'password'=>$newPassword
                    );
                    $where = array(
                        'user_id_pk'=>$userId
                    );
                    $result2 = $this->base_model->update_record_by_id('att_user_mst',$data,$where);
                    if($result2){
                        $resp = array(
                            'status'=>'success',
                            'msg'=>'Password updated successfully.'
                        );
                        echo $this->get('callback')."(".json_encode($resp).")";
                    }else{
                        $resp = array(
                            'status'=>'error',
                            'msg'=>'Password could not be updated.'
                        );
                        echo $this->get('callback')."(".json_encode($resp).")";
                    }
                }else{
                    $resp = array(
                        'status'=>'error',
                        'msg'=>'Password does not match.'
                    );
                    echo $this->get('callback')."(".json_encode($resp).")";
                }
            }else{
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Old password is invalid.'
                );

                 echo $this->get('callback')."(".json_encode($resp).")";
            }

        
    }
    // logout api
    public function logout_get()
    {
            $this->session->sess_destroy();
            $resp = array(
                'status'=>'success',
                'msg'=>'Logout successfully.'
            );
            if($this->get('callback')){
                echo $this->get('callback')."(".json_encode($resp).")";
            }else{
                $this->response($resp, 200);
            }
            
//        }
    }
}