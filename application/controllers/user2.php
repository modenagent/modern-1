<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
// stripe library
require APPPATH.'/libraries/Stripe.php';

class User extends CI_Controller
{
   // Initialize Constructor Here
    function __construct() {
        parent::__construct();        
    }
    //    ramdon string function
    private function generateRandomString() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
    }


    public function getSvg($pid,$fid){
      $condition = array('product_id_pk'=>$pid);
      $result = $this->base_model->get_all_record_by_condition('ff_product_mst', $condition);
      echo $result[0]->product_content;
    }


    // User dashboard view
    public function dashboard()
    {
        $data['title'] = "Dashboard";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        $userName = $data['user_name'] = $this->session->userdata('username');
        if($this->session->userdata('userid')){
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
          $this->load->view('user/header', $data);
          $this->load->view('user/dashboard', $data);
          $this->load->view('user/footer');
        } else {
          redirect('frontend/index');
        }
        
    }
    // User account view
    public function account()
    {
        $data['title'] = "Account";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($this->session->userdata('userid')){
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
                            $getImgUrl = $this->base_model->get_record_by_id('ff_user_mst', array('user_id_pk'=>$userid));
                            // delete old image
                            @unlink($getImgUrl->profile_image);
                            // die();      
                            $result = $this->base_model->update_record_by_id('ff_user_mst',$data2,$where); 
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
                    $result = $this->base_model->update_record_by_id('ff_user_mst',$data2,$where); 
                    if($result){
                      $getImgUrl = $this->base_model->get_record_by_id('ff_user_mst', array('user_id_pk'=>$userid));
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
                            $getImgUrl = $this->base_model->get_record_by_id('ff_user_mst', array('user_id_pk'=>$userid));
                            // delete old image
                            @unlink($getImgUrl->company_logo);
                            // die();      
                            $result = $this->base_model->update_record_by_id('ff_user_mst',$data2,$where); 
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
                    $result = $this->base_model->update_record_by_id('ff_user_mst',$data2,$where); 
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
            $form_data = $_POST['pass'];
            $result = $this->base_model->update_password($form_data,$userId);           
            if($result == true){
                $resp = array('status' => 'success', 'msg' => 'Pasword updated successfully.' );
                echo json_encode($resp);
            }
        }             
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
                $table = "ff_user_mst";
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
                          $getUser = $this->base_model->get_record_by_id('ff_user_mst', array('user_id_pk'=>$userid));

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
                            $result = $this->base_model->insert_one_row('ff_user_mst',$data2); 
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
                            $getImgUrl = $this->base_model->get_record_by_id('ff_user_mst', array('user_id_pk'=>$userid));
                            // delete old image
                            @unlink($getImgUrl->profile_image);
                            // die();      
                            $result = $this->base_model->update_record_by_id('ff_user_mst',$data2,$where); 
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
                    $result = $this->base_model->update_record_by_id('ff_user_mst',$data2,$where); 
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
                $getMember= $this->base_model->get_record_by_id('ff_user_mst', array('parent_id'=>$userId));                
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
          $data['members'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $mid));
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
          $data['members'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $mid));
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
    // User leads view
    public function leads()
    {
        $data['title'] = "Leads";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($this->session->userdata('userid')){
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
          $this->load->view('user/header', $data);
          $this->load->view('user/leads', $data);
          $this->load->view('user/footer');
        }else{
          redirect('frontend/index');
        }
    }
    //     
    public function orders()
    {
        $data['title'] = "Orders";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        if($this->session->userdata('userid')){
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
          $data['users'] = $userCredits = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
          $data['category'] = $this->base_model->all_records('ff_category_mst'); 
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
                $myflyers = $this->base_model->all_records('ff_product_mst'); 

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
          $result = $this->base_model->insert_one_row('ff_my_flyers',$data);
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
          $flyers = $this->base_model->get_record_result_array('ff_my_flyers',array('project_id_pk' => $flyerId));
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
          $table = "ff_my_flyers";
          $data = array(
              'project_name' => $flyerName,
              // 'project_date' => $projectDate,
              'updated_on' => $projectDate       
          );
          $where = array(
              'project_id_pk' => $flyerId
          );          
          $result = $this->base_model->update_record_by_id($table,$data,$where);  
          // if($result){            
            $resp = array(
                'status'=>'success',
                'project_id' => $flyerId, 
                'msg'=>'Title edited successfully.'
            );
            echo json_encode($resp);
          // }
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
          $delResult = $this->base_model->delete_record_by_id('ff_my_flyers',$where); 
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
          $myFlyer = $this->base_model->get_record_result_array( 'ff_my_flyers', array('project_id_pk' => $fid) );
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
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
          // product selected for customization by id
          $products = $data['products'] = $this->base_model->get_record_result_array('ff_product_mst',array('product_id_pk' => $prod_id));
          $data['productId'] = $prod_id;
          $data['flyerhtml'] = $products[0]['product_content'];
          // category name
          $category = $data['category'] = $this->base_model->my_category($prod_id);
         
          $data['category_name'] = $category->category_name;
          // project name by id
          $myProject = $this->base_model->get_record_result_array( 'ff_my_flyers', array('project_id_pk' => $proj_id) );
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
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
          // product selected for customization by id
          $products = $data['products'] = $this->base_model->get_record_result_array('ff_my_flyers',array('project_id_pk' => $proj_id));
          $prod_id = $data['productId'] = $products[0]['product_id_fk'];
          if(empty($products[0]['flyer_content'])){
          	$testProd = $this->base_model->get_record_result_array('ff_product_mst',array('product_id_pk' => $prod_id));
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
          $myProject = $this->base_model->get_record_result_array( 'ff_my_flyers', array('project_id_pk' => $proj_id) );
          $data['projectId'] = $proj_id;
          // $data['project_name'] = $myProject[0]['project_name'];
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
          $result = $this->base_model->update_record_by_id('ff_my_flyers',$data,$where); 
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
                $myorders = $this->base_model->get_all_record_by_condition('ff_invoices', array('user_id_fk'=>$userId));  
                         
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
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
          // shipping info
          $data['shippings'] = $this->base_model->get_record_result_array('ff_shipping',array('ff_user_id_fk' => $userId));
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
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
          $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
          $user = $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
          $user_name = $user[0]['first_name'].' '.$user[0]['last_name'];
          $user_email = $user[0]['email'];
          // get invoice data
          $invoice = $data['invoices'] = $this->base_model->get_record_result_array('ff_invoices',array('invoice_id_pk'=>$inv,'user_id_fk' => $userId));
          $order_num = $invoice[0]['invoice_num'];
          // get shipping address
          $shipping = $data['shippings'] = $this->base_model->get_record_result_array('ff_shipping',array('ff_user_id_fk' => $userId));
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
          $myflyers = $data['myflyers'] = $this->base_model->get_all_record_by_condition('ff_my_flyers', array('user_id_fk'=>$userId));
          // get cart content once here
          foreach ($this->cart->contents() as $items) {                  
            if($items['name'] != "coupon"){
              // print_r($items);
              $myProjectId = $items['options']['project_id']; 
              $myFlyers = $this->base_model->get_record_result_array('ff_my_flyers',array('project_id_pk' => $myProjectId));
              $myPdf[] =  $myFlyers[0]['flyer_pdf'];            
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
                    <a href="'.site_url().'" style="background:#37bcac; cursor:pointer; color:#fff; margin-bottom:30px; text-decoration:none; display:block; padding:15px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;">ACCOUNT LOGIN</a>
                    </td>
                  </tr>
              </table>
              </td>
            </tr>
            <tr>
              <td>
              <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222; margin-bottom:50px;" width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#fff">
                  <tr bgcolor="#37bcac">
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
                          <!--<div style="font-size:75%;">Delivery: <span style="color:#37bcac;">Sunday nov 14th</span></div>-->
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
                  <tr bgcolor="#37bcac">
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
                        <tr bgcolor="#37bcac">
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
                          <tr bgcolor="#37bcac">
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
              <td bgcolor="#2d2d2d"><div style="padding:20px; color:#fff; font-size:75%; text-align:center;">&copy; 2015 listing-pitch.com All rights Reserved - <a href="javascript:;" style="text-decoration:none; color:#37bcac;">Unsubscribe</a></div></td>
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
          $updateFlyerTable = $this->base_model->update_record_by_id('ff_invoices', $updateData,array('invoice_id_pk' => $inv)); 
          // invoice pdf ends
          
          $this->load->helper('sendemail');
          $send = send_email('info@listing-pitch.com',$name,$user_email,'Your Customize Flyer',$message,$myPdf);

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
          $user = $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
          
          $user_name = $user[0]['first_name'].' '.$user[0]['last_name'];
          $user_email = $user[0]['email'];
          // get invoice data
          $invoice = $data['invoices'] = $this->base_model->get_record_result_array('ff_invoices',array('invoice_id_pk'=>$inv,'user_id_fk' => $userId));
          $order_num = $invoice[0]['invoice_num'];
          // get shipping address
          $shipping = $data['shippings'] = $this->base_model->get_record_result_array('ff_shipping',array('ff_user_id_fk' => $userId));
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
                $myFlyers = $this->base_model->get_record_result_array('ff_my_flyers',array('project_id_pk' => $myProjectId));
                
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
                    <a href="'.site_url().'" style="background:#37bcac; cursor:pointer; color:#fff; margin-bottom:30px; text-decoration:none; display:block; padding:15px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;">ACCOUNT LOGIN</a>
                    </td>
                  </tr>
              </table>
              </td>
            </tr>
            <tr>
              <td>
              <table style="font-family:Arial,sans-serif; font-size:100%; font-weight:300; color:#222; margin-bottom:50px;" width="100%" cellpadding="20" cellspacing="0" border="0" bgcolor="#fff">
                  <tr bgcolor="#37bcac">
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
                          <!--<div style="font-size:75%;">Delivery: <span style="color:#37bcac;">Sunday nov 14th</span></div>-->
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
                  <tr bgcolor="#37bcac">
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
                  <tr bgcolor="#37bcac">
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
                  <tr bgcolor="#37bcac">
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
              <td bgcolor="#2d2d2d"><div style="padding:20px; color:#fff; font-size:75%; text-align:center;">&copy; 2015 listing-pitch.com All rights Reserved - <a href="javascript:;" style="text-decoration:none; color:#37bcac;">Unsubscribe</a></div></td>
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
          
          $updateFlyerTable = $this->base_model->update_record_by_id('ff_invoices', $updateData,array('invoice_id_pk' => $inv)); 
          // invoice pdf ends
          
          $this->load->helper('sendemail');
         
          $send = send_email('info@listing-pitch.com',$name, $user_email,'Your Customize Flyer', $message, $myPdf);

          $this->cart->destroy();
          
          $data['myorders'] = $this->base_model->my_order($inv);
          $data['myshippings'] = $this->base_model->get_all_record_by_condition('ff_shipping',array("ff_user_id_fk"=>$userId));
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
          $table = "ff_coupon_mst";
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
                $table = "ff_shipping";
                $where = array( 'ff_user_id_fk' => $userId );
                $resultCheck = $this->base_model->check_existent($table,$where);                
                if(!$resultCheck){
                  $data = array(
                      'ff_user_id_fk' => $userId,
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
                  
                  $result = $this->base_model->insert_one_row('ff_shipping',$data); 
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
                  $result = $this->base_model->update_record_by_id('ff_shipping',$data2,$where);
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
            $table = "ff_user_mst";
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
            $result = $this->base_model->insert_one_row('ff_my_favourites',$data); 
            if($result){ 
              $table = "ff_product_mst";
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
              // user trail ends
              
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
          $user_email = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
    // cart payment
    private function generateInvoice() {
        return substr(str_shuffle("0123456789"), 0, 3);
    }
    // stripe post
    public function cart_payment()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $users = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
          if($_POST){

            $this->load->library('stripe');

            $config['stripe_key_test_public']         = '';
            $config['stripe_key_test_secret']         = '';
            $config['stripe_key_live_public']         = 'pk_live_Cj6i9W71YJ9494XEcHA63kI5';
            $config['stripe_key_live_secret']         = 'sk_live_KLhxugcuzgdF9DR3LhjsasLh';
            $config['stripe_test_mode']               = FALSE;
            $config['stripe_verify_ssl']              = TRUE;

            // Create the library object
            $stripe = new Stripe( $config );

            $amt = $_POST['amount'];
            $amount = 100 * $amt;

            $card = $_POST['stripeToken'];

            $desc = 'Flyer Paymemnt';
               
               try{

                  $response = json_decode($stripe->charge_card($amount, $card, $desc));           
               }catch(Exception $e){
                  
                  print_r($e);

               }

                if($response->paid) {
                    echo "Success";  
                    // get coupon id
                    foreach ($this->cart->contents() as $items) {                  
                      if($items['name'] == "coupon"){
                        $couponId = $items['id'];
                        $proj_id = $items['options']['project_id'];
                      }else{
                        $proj_id = $items['options']['project_id'];
                        $couponId = NULL;  
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
                    $result = $this->base_model->insert_one_row('ff_my_cart',$data); 
                    if($result){
                      
                      $lastId = $this->base_model->get_last_insert_id();
                      // update mycart table
                        $updateData = array(
                          'is_draft' => 'N'
                          );
                        
                        $updateFlyerTable = $this->base_model->update_record_by_id('ff_my_flyers', $updateData,array('project_id_pk' => $proj_id)); 
                      $data2 = array(
                        'invoice_num' => 'INV'.$this->generateInvoice(),
                        'cart_id_fk' => $lastId,
                        'user_id_fk' => $userId,
                        'invoice_amount' => $amt,
                        'invoice_date' => date('Y-m-d'),
                        'invoice_to' => $users[0]['first_name'],
                        'invoice_addr' => $users[0]['city']
                        );
                      $result2 = $this->base_model->insert_one_row('ff_invoices',$data2);
                      if($result2){
                        $lastId2 = $this->base_model->get_last_insert_id();
                        redirect('user/checkout_deliver/'.$lastId2);
                      }
                    }
                } else {
                    
                    $data['title'] = "Dashboard";
                    $userId = $data['user_id'] = $this->session->userdata('userid');
                    $userName = $data['user_name'] = $this->session->userdata('username');
                    
                    $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
                    
                    $this->load->view('user/header', $data);
                    $this->load->view('user/checkout-error',$response);
                    $this->load->view('user/footer');
                    
                    die();
                }
          }
        }
    }
    // stripe post
    public function cart_payment_2()
    {
      $userId = $data['user_id'] = $this->session->userdata('userid');
        if($userId){
          $users = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
          if($_POST){

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
                    $result = $this->base_model->insert_one_row('ff_my_cart',$data); 
                    if($result){
                      
                      $lastId = $this->base_model->get_last_insert_id();
                      // update mycart table
                        $updateData = array(
                          'is_draft' => 'N'
                          );
                        // print_r($updateData)
                        $updateFlyerTable = $this->base_model->update_record_by_id('ff_my_flyers', $updateData,array('project_id_pk' => $proj_id)); 
                      $data2 = array(
                        'invoice_num' => 'INV'.$this->generateInvoice(),
                        'cart_id_fk' => $lastId,
                        'user_id_fk' => $userId,
                        'invoice_amount' => $amt,
                        'invoice_date' => date('Y-m-d'),
                        'invoice_to' => $users[0]['first_name'],
                        'invoice_addr' => $users[0]['city']
                        );
                      $result2 = $this->base_model->insert_one_row('ff_invoices',$data2);
                      if($result2){
                        $lastId2 = $this->base_model->get_last_insert_id();
                        redirect('user/checkout_deliver_2/'.$lastId2);
                      }
                    }
                } else {
                    
                    $data['title'] = "Dashboard";
                    $userId = $data['user_id'] = $this->session->userdata('userid');
                    $userName = $data['user_name'] = $this->session->userdata('username');
                    
                    $data['users'] = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
                    
                    $this->load->view('user/header', $data);
                    $this->load->view('user/checkout-error',$response);
                    $this->load->view('user/footer');
                    
                    die();
                }
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
          $users = $this->base_model->get_record_result_array('ff_user_mst',array('user_id_pk' => $userId));
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
                    $result = $this->base_model->update_record_by_id('ff_user_mst',$data,$where); 
                    redirect('user/mycredits');
                                  
                } else {
                    echo "Failed";
                    echo "<pre>";
                    print_r($response);
                    die();
                }
            // }
          }
        }
    }
   // Class ends here
}
?>