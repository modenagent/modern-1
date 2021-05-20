<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Admin extends CI_Controller
{

    public $dbConn = false;
    //    Initialize Constructor Here
    function __construct()
    {
        parent::__construct();
        // remember me code
        if ( $this->input->post( 'rememberme' ) )
            $this->config->set_item('sess_expire_on_close', '0');
        $this->load->library('role_lib');
        $this->dbConn = $this->db->conn_id;
        
    }
    //    Admin login View Function
    public function index()
    {

        $data['title'] = "Admin";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            redirect('admin/dashboard',$data);
        }else{
            $cookie_domain    = !empty($_ENV['MAIN_DOMAIN']) ? '.'.$_ENV['MAIN_DOMAIN']:"";
            
            if($cookie_domain != "") {

                $cookie = array(
                    'name'   => 'ci_session',
                    'value'  => '',
                    'expire' => time() - 100,
                    'domain' => $cookie_domain ,
                    'prefix' => 'ma_'
                    );
                 
                delete_cookie($cookie);
            }
            $this->load->view('admin/index',$data);
        }
    }
    // admin login
    public function adminlogin()
    {
        if($_POST){
            $this->form_validation->set_error_delimiters('<span class="error1">', '</span>');
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if($this->form_validation->run() == FALSE){
                $this->session->set_userdata("SuccessMessage", '<div class="alert alert-warning">Please correct all errors</div>');
                redirect('admin/index');
            } else {

                $postedArr = $this->security->xss_clean($_POST);
                $username = mysqli_real_escape_string($this->dbConn,$postedArr['username']);
                $password = mysqli_real_escape_string($this->dbConn,$postedArr['password']);
                $tableName = "lp_user_mst";
                $admin = $this->admin_model->get_admin_login_data( $tableName,$username,$password );

                if($admin){

                    if ($admin->is_active == 'Y') {

                        // admin login
                        $newdata = array(
                            'adminid'    => $admin->user_id_pk,
                            'username'  => $admin->user_name,
                            'email'     => $admin->email,
                            'role_id'     => $admin->role_id_fk,
                            'name'      => $admin->first_name . ' ' . $admin->last_name,
                            'logged_in' => TRUE
                        );
                        $sessionData = $this->session->set_userdata($newdata);
                        $this->role_lib->set_access_paths($admin->role_id_fk);
                        $resp = array(
                            "status"=>"admin_success",
                            "msg"=>"login successful"
                        );
                        echo json_encode($resp);

                    } else {

                        $resp = array(
                            "status"=>"error",
                            "msg"=>"Your account has been deactivated."
                        );
                        echo json_encode($resp);

                    }
                } else {
                    $resp = array(
                        "status"=>"error",
                        "msg"=>"Wrong user Name or Password"
                    );
                    echo json_encode($resp);
                }
            }
        }
    }
    // logout
    public function logout()
    {
        $adminId = $this->session->userdata('adminid');
        if($adminId){
            $this->session->unset_userdata('adminid');
            $this->session->sess_destroy();
            redirect('admin/index');
        }

    }

    /* use for forget password */
    public function forget_password()
    {
        if ($_POST) {
            $email = $this->input->post('email');
            $admin_details = $this->admin_model->is_admin_exists($email);

            if (!empty($admin_details)) {
                $isActive = $admin_details['is_active'];
                if (strtoupper($isActive) == 'N') {
                    $resp = array(
                        'status'=>'error',
                        'msg'=>'Your account has been deactivated.'
                    );
                    echo json_encode($resp);
                    exit();
                }

                $userId = $admin_details['user_id_pk'];
                $userName = $admin_details['first_name'] . ' ' . $admin_details['last_name'];
                $pemail = $admin_details['email'];
                $random_password = generateRandomString();
                $table = "lp_user_mst";
                $data = array(
                    'password' => password_hash($random_password,PASSWORD_DEFAULT)
                );
                $where = array(
                    'user_id_pk' => $userId
                );
                $result2 = $this->base_model->update_record_by_id($table,$data,$where);
                if($result2){
                    $name = 'Administrator';
                    $message = <<<MSG
                            Hi $userName,
                                         Please login with your new password.

                                         $random_password 

                             Regards,
                             ModernAgent
MSG;
                    
                    $send = $this->base_model->queue_mail($pemail,'ModernAgent Reset Password',$message);
                    $resp = array(
                        'status'=>'success',
                        'msg'=>'Password has been sent to your registered email.'
                    );
                    echo json_encode($resp);
                }
            } else{
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Email does not exists.'
                );
                echo json_encode($resp);
            }
        }
    }
    // admin dashboard
    public function dashboard()
    {
        $data['title'] = "Dashboard";

        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        $adminId = $this->session->userdata('adminid');
        if($adminId){
            $data['user_name'] = $this->admin_model->getUsername($adminId);
            $this->load->view('admin/header',$data);
            $this->load->view('admin/dashboard');
            $this->load->view('admin/footer');
        }else{
            redirect('admin/index');
        }
    }
    // Get active users
    public function getActiveUser()
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            // $_hasAccess = $this->_hasAccess('user_count');
            if(!hasAccess('user_count')) {
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Access Denied!'
                );
                echo json_encode($resp);
                exit();
            }

            if(isset($_POST["user_role_id"])){
                
                $user_role_id = $_POST["user_role_id"];
                $roleId = $this->session->userdata('role_id');
                $user_count = $this->base_model->countusers('is_active','Y',$roleId,$adminId,$user_role_id);
                $resp = array('status' => 'success', 'active_user' => $user_count->count_user );
                echo json_encode($resp);
            }else{
                $resp = array('status' => 'error', 'msg' => 'Invalid Request.' );
                echo json_encode($resp);
            }

        }else{
            redirect('admin/index'); 
        }
    }
    // get number of flyers created
    public function getReportsCount()
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            
            if(!hasAccess('flyer_count')) {
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Access Denied!'
                );
                echo json_encode($resp);
                exit();
            }
            
            $roleId = $this->session->userdata('role_id');
            $count = $this->base_model->countreports($roleId,$adminId);
            $resp = array('status' => 'success', 'count' => $count->count_reports);
            echo json_encode($resp);
            
        }else{
            $resp = array('status' => 'error', 'msg' => 'Invalid Request.' );
            echo json_encode($resp);
        }
    }
    // get new sign up
    public function getNewSignUp(){
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST["type"] == "new_signup"){
                $currentDate = date('Y-m-d');
                $roleId = $this->session->userdata('role_id');
                $new_user_count = $this->base_model->count_new_signup($adminId,$roleId);


                $resp = array('status' => 'success', 'new_user' => $new_user_count->count_user );
                echo json_encode($resp);
            }else{
                $resp = array('status' => 'error', 'msg' => 'Invalid Request.' );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }
    }

    public function getNumOfOnlineUsers(){
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST["type"] == "number_of_online_users"){
                $roleId = $this->session->userdata('role_id');
                $num_of_online_users = $this->base_model->count_online_users($roleId,$adminId);
                $resp = array('status' => 'success', 'num_of_online_users' => $num_of_online_users);
                echo json_encode($resp);
            }else{
                $resp = array('status' => 'error', 'msg' => 'Invalid Request.' );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }
    }

    // get cancelation
    public function getcancellation()
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST["type"] == "new_signup"){
                $_isAdmin = $this->role_lib->is_admin();

                $currentDate = date('Y-m-d');

                if($_isAdmin) {
                    $new_user_count = $this->base_model->count_new_users('lp_user_mst','registered_date',$currentDate);
                } else {
                    $new_user_count = $this->base_model->count_new_users('lp_user_mst','registered_date',$currentDate,$adminId);
                }
                $resp = array('status' => 'success', 'new_user' => $new_user_count->count_user );
                echo json_encode($resp);
            }else{
                $resp = array('status' => 'error', 'msg' => 'Invalid Request.' );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }
    }
    // Admin get password
    public function get_password()
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $old = $this->admin_model->get_password($adminId);
            $resp = array('status' => 'success' , 'data' =>  $old[0]['password'] );
            echo json_encode($resp);
        }
    }
    // admin password update
    public function update_password()
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');



        if($adminId) {
            $result = $this->base_model->get_record_by_id('lp_user_mst' , array('user_id_pk'=>$adminId));

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
        }
        else {
             $resp = array('status'=>'failed', 'message'=>'Invalid Authentication!');
        }

        echo json_encode($resp);

    }
    // verify
    public function verify($id)
    {
        if($this->session->userdata('admin_email'))
        {
            $this->admin_model->verify($id);
            redirect('admin/shopping_centers');
        }
        else
        {
            redirect('admin/index');
        }

    }
    //
    public function unverify($id)
    {
        if($this->session->userdata('admin_email'))
        {
            $this->admin_model->unverify($id);
            redirect('admin/shopping_centers');
        }
        else
        {
            redirect('admin/index');
        }

    }
    // manage user
    public function manage_user()
    {
        hasAccess('view_all_user');
        // die;
        $data['title'] = "Manage Users";
        $data['add_title'] = "Create User";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $data['newUserRoleId'] = 4;
            $data['refferalCode'] = "REF".$adminId;
            $_isAdmin = $this->role_lib->is_admin();
            $_isManager = $this->role_lib->is_manager_l1();
            $this->load->model('role_model');
            $data['user_role'] = '';
            $data['add_form'] = 'end_user';
            if($_isAdmin) {
                $data['parents'] = $this->role_model->get_sales_reps(null, 'Y');    
                $data['choose'] = 'Sales Rep';
            } else if($_isManager) {
                $data['parents'] = $this->role_model->get_sales_reps($adminId, 'Y');    
                $data['choose'] = 'Sales Rep';
            }
            $companies = array();
            if(isset($data['parents'])) {
                foreach($data['parents'] as $_company){
                    $companies[$_company['user_id_pk']]['cadd'] = $_company['company_add'];
                    $companies[$_company['user_id_pk']]['cname'] = $_company['company_name'];
                }
            }
            $data['companies'] = json_encode($companies);
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_user',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }

    }

    // transaction
    public function transaction()
    {
        hasAccess('transaction');
        $data['title'] = "Manage Transaction";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $data['users'] = $this->admin_model->manage_user();
            $this->load->view('admin/header',$data);
            $this->load->view('admin/transaction',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }

    }
    // invoice page
    public function invoice($uid)
    {
        $data['title'] = "invoice";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            //$data['user_invoices'] = $this->admin_model->user_invoices($uid);
            $data['user_invoice'] = $this->admin_model->get_invoice($uid);
            $this->load->view('admin/header',$data);
            $this->load->view('admin/invoice',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }

    }
    // order history list view
    public function transactionlist()
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){

            $this->load->library('role_lib');
            $roleId = $this->session->userdata('role_id');

            $columns = [
                'invoice_date', 
                'invoice_num',
                'report_type',
                'property_address',
                'invoice_to',
                's_first_name', 
                'action'                      
            ];      
            
            $recordsTotal = $this->base_model->user_invoice_count($roleId, $adminId, $_POST);
            $result = $this->base_model->user_invoice_data($roleId, $adminId, $columns, $_POST);

            $i = $_POST['start'];
            $data = [];
            foreach($result as $transaction) {
                $i++;
                $invoiceDate = date("F j, Y", strtotime($transaction['invoice_date']));

                $action = '';
                if(!is_null($transaction['report_path'])) {
                    $action .= ' <a title="Download Report" class="btn btn-success btn-xs admin-ml-5" href="'.base_url().$transaction['report_path'].'" target="_blank" data-toggle="tooltip" data-title="Download Report"><i class="fa fa-download"></i></a>';
                }
                if(!is_null($transaction['invoice_pdf'])) {

                    if (file_exists($transaction['invoice_pdf'])) {
                        $action .= ' <a title="Download Inovice" class="btn btn-success btn-xs admin-ml-5" href="'.base_url().$transaction['invoice_pdf'].'" target="_blank" data-toggle="tooltip" data-title="Download Inovice"><i class="fa fa-download"></i></a>';
                    } else {
                        $invoice_generate_url = site_url().'/admin/download_invoice/'.$transaction['invoice_num'].'/'.$transaction['user_id_fk'];
                        $action .= ' <a title="Download Inovice" class="btn btn-success btn-xs admin-ml-5" href="'.$invoice_generate_url.'" target="_blank" data-toggle="tooltip" data-title="Download Inovice"><i class="fa fa-download"></i></a>';
                    }
                }
                                    
                $action .=' <a href="'.site_url().'?/admin/invoice/'.$transaction['invoice_num'].'" class="btn btn-info btn-xs admin-ml-5" data-toggle="tooltip" data-title="View detail"><i class="fa fa-eye"></i></a>';

                $data[] = [
                    $invoiceDate, 
                    $transaction['invoice_num'], 
                    $transaction['report_type'], 
                    $transaction['property_address'], 
                    $transaction['invoice_to'], 
                    $transaction['s_first_name'] . ' ' . $transaction['s_last_name'], 
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
    // manage site content
    public function manage_contents()
    {
        $data['title'] = "Manage Content";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $data['users'] = $this->admin_model->manage_user();
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_contents',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }

    }
    // userlist view
    public function userlist_view()
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId && $_POST["type"] == "userlist") {

            $this->load->library('role_lib');

            $columns = [
                'first_name', 
                'email',
                'company_name',
                'registered_date',
                'action'                      
            ];  

            $roleId = $this->input->post('role_id');
            //echo "rold id".$roleId;exit();
            $_isAdmin = $this->role_lib->is_admin();
            if($_isAdmin) {
                $recordsTotal = $this->admin_model->manage_user_count(null, $roleId, $_POST);
                $result = $this->admin_model->manage_user_data(null, $roleId, $columns, $_POST);
            } else {
                $recordsTotal = $this->admin_model->manage_user_count($adminId, $roleId, $_POST);
                $result = $this->admin_model->manage_user_data($adminId, $roleId, $columns, $_POST);
            }

            $i = $_POST['start'];
            $data = [];
            foreach($result as $user) {
                $i++;
                $registeredDate = date("F j, Y", strtotime($user['registered_date']));

                $action = '<a class="btn btn-xs btn-info user_del admin-ml-5" href="'.site_url('admin/profile/'.$user['user_id_pk']).'" data-toggle="tooltip"data-title="View detail"><i class="fa fa-eye"></i></a>';
                
                if($this->role_lib->has_access('edit_user_info')){
                    $action .= '<a class="btn btn-xs btn-warning user_del admin-ml-5" href="'.site_url('admin/profile_edit/'.$user['user_id_pk']).'" data-toggle="tooltip" data-title="Edit"><i class="fa fa-edit"></i></a>';
                }
                    
                if($this->role_lib->has_access('del_user')) {
                    $action .= '<a class="btn btn-xs btn-danger user_del admin-ml-5" href="javascript:void(0);" onclick="deleteuser('.$user['user_id_pk'].');" data-toggle="tooltip" data-title="Delete"><i class="fa fa-times"></i></a>';
                }

                if($this->role_lib->has_access('deactive_user')) {
                    if($user['is_active'] == 'N') {
                        $action .= '<a class="btn btn-xs btn-success admin-ml-5" href="javascript:void(0);" onclick="verifyuser('.$user['user_id_pk'].');" data-toggle="tooltip" data-title="Active"><i class="fa fa-check-circle"></i></a>';
                    } else {
                        $action .= '<a class="btn btn-xs btn-warning admin-ml-5" href="javascript:void(0);" onclick="unverifyuser('.$user['user_id_pk'].');" data-toggle="tooltip" data-title="De-active"><i class="fa fa-ban"></i></a>';
                    }
                }

                $data[] = [
                    $user['first_name'] . ' ' . $user['last_name'], 
                    $user['email'],
                    $user['company_name'],
                    $registeredDate, 
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
    // delete user
    public function deleteuser($id)
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $delResult = $this->admin_model->deleteuser($id);
            if($delResult){
                $resp = array('status' => 'success', 'msg' => 'User deleted successfully.' );
                echo json_encode($resp);
            }
        }
        else{
            redirect('admin/index');
        }
    }
    // verify user
    public function verifyuser($id)
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $verifyResult = $this->admin_model->verifyuser($id);
            if($verifyResult){
                $resp = array('status' => 'success', 'msg' => 'User activated successfully.' );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }

    }
    // inactive user 
    public function unverifyuser($id)
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $unverifyResult = $this->admin_model->unverifyuser($id);
            if($unverifyResult){
                $resp = array('status' => 'success', 'msg' => 'User inactivated successfully.' );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }

    }

    // user detail view page
    public function profile($uid)
    {
        $data['title'] = "Profile View";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');    
        $adminDetails = $this->base_model->get_record_by_id('lp_user_mst',array('user_id_pk' => $adminId));
        if($adminDetails){

            $user = $this->base_model->get_record_by_id('lp_user_mst',array('user_id_pk' => $uid));
            if (empty($user)) {
                redirect('admin/index');
            }

            $having_access = $this->admin_model->having_user_access($uid, $adminId, $adminDetails->role_id_fk, $user->role_id_fk);
            if (!$having_access) {
                redirect('admin/index');
            }

            $this->load->library('stripe');
            // Create the library object
            $stripe = new Stripe( null );
            $data['subscription_data'] = $stripe->is_subscribed($uid);
            $data['users'] = $this->base_model->get_record_by_id('lp_user_mst',array('user_id_pk' => $uid));
            $this->load->view('admin/header',$data);
            $this->load->view('admin/profile',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }

    }
    // user profile edit view  
    public function profile_edit($uid)
    {
        hasAccess('edit_user_info');
        $data['title'] = "Profile Edit";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $data['user'] = $this->base_model->get_record_by_id('lp_user_mst',array('user_id_pk' => $uid));
            $this->_isCreator($data['user'],'admin/manage_user','parent_id');
            $data['roles'] = $this->base_model->all_records('lp_role');
            $_isAdmin = $this->role_lib->is_admin();

            if($data['user']->role_id_fk == 2 || $data['user']->role_id_fk == 3) {

                $get_sso_record = $this->base_model->get_all_record_by_in('lp_idps','company_id',$uid);
                if($get_sso_record && is_array($get_sso_record) && count($get_sso_record)) {
                    $get_sso_record = $get_sso_record;
                }
                else {
                    //Insert record

                    $data_ins = array();
                    $unique_id = generate_sso_token($uid);
                    $data_ins['unique_id'] = $unique_id;
                    $data_ins['company_id'] = $uid;
                    $data_ins['metadata_url'] = '';
                    $data_ins['idp'] = '';

                    $result = $this->base_model->insert_one_row('lp_idps',$data_ins);

                    $get_sso_record = $this->base_model->get_all_record_by_in('lp_idps','company_id',$uid);
                    if($get_sso_record && is_array($get_sso_record) && count($get_sso_record)) {
                        $get_sso_record = $get_sso_record;
                    }

                }
                $data['sso_records'] = $get_sso_record;
            }


            if($_isAdmin && $data['user']->role_id_fk == 3) {
                $this->load->model('role_model');
                $data['parents'] = $this->role_model->get_companies();    
                $data['parent_label'] = 'Signed up under(Company)';
            } else if($_isAdmin && $data['user']->role_id_fk == 4) {
                $this->load->model('role_model');
                $data['parents'] = $this->role_model->get_sales_reps();    
                $data['parent_label'] = 'Signed up under(Sales Rep)';
            }
            $this->load->view('admin/header',$data);
            $this->load->view('admin/profile_edit',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }

    }
    // prifile edit    
    public function user_edit()
    {
        $this->load->model('user_model');
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST){
                $postedArr = $this->security->xss_clean($_POST);

                $uid = mysqli_real_escape_string($this->dbConn, $postedArr['userid']);
                $fname = mysqli_real_escape_string($this->dbConn, $postedArr['fname']);
                $lname = mysqli_real_escape_string($this->dbConn, $postedArr['lname']);
                $email = mysqli_real_escape_string($this->dbConn, $postedArr['email']);
                // USER NAME CAN NOT BE CHANGED ONCE CREATED
                //$username = mysqli_real_escape_string($this->dbConn, $postedArr['username']);
                $phone = mysqli_real_escape_string($this->dbConn, $postedArr['phone']);
                $license = mysqli_real_escape_string($this->dbConn, $postedArr['license']);
                $cname = mysqli_real_escape_string($this->dbConn, $postedArr['cname']);

                $cadd = mysqli_real_escape_string($this->dbConn, $postedArr['cadd']);
                if(isset($postedArr['ccity'])){
                    $ccity = mysqli_real_escape_string($this->dbConn, $postedArr['ccity']);
                }
                if(isset($postedArr['czip'])){
                    $czip = mysqli_real_escape_string($this->dbConn, $postedArr['czip']);
                }
                if(isset($postedArr['cstate'])){
                    $cstate = mysqli_real_escape_string($this->dbConn, $postedArr['cstate']);
                }
                if(isset($postedArr['curl'])){
                    $curl = mysqli_real_escape_string($this->dbConn, $postedArr['curl']);
                }
                if(isset($postedArr['cma_url'])){
                    $cma_url = mysqli_real_escape_string($this->dbConn, $postedArr['cma_url']);
                }
                if(isset($postedArr['use_rets_api'])){
                    $use_rets_api = mysqli_real_escape_string($this->dbConn, $postedArr['use_rets_api']);
                }
                if(isset($postedArr['report_dir_name'])){
                    $report_dir_name = mysqli_real_escape_string($this->dbConn, $postedArr['report_dir_name']);
                }
                if(isset($postedArr['widget_bg_color'])){
                    $widget_bg_color = mysqli_real_escape_string($this->dbConn, $postedArr['widget_bg_color']);
                }
                
                $roleId = (!empty($this->input->post('role_id')))?$this->input->post('role_id'):4;
                $parentId = (!empty($this->input->post('parent_id')))?$this->input->post('parent_id'):0;
                $enterpriseFlag = (!empty($this->input->post('enterprise_flag')))?$this->input->post('enterprise_flag'):0;

                $referralCode = '';
                if (!empty($parentId)) {
                    $parent_user_details = $this->base_model->get_record_by_id('lp_user_mst', ['user_id_pk'=>$parentId], ['user_id_pk', 'role_id_fk', 'company_name', 'company_add']);
                    if (!empty($parent_user_details)) {
                        if($this->role_lib->is_sales_rep($parent_user_details->role_id_fk) && $roleId == '4') {
                            $referralCode = (!empty($this->input->post('ref_code')))?$this->input->post('ref_code'):$this->user_model->setRefCode($uid);
                        }

                        //If Sales Reprensentative
                        // if ($roleId == '3') {
                        //     // $cname = $parent_user_details->company_name;
                        //     // $cadd = $parent_user_details->company_add;
                        // }
                    }
                }
                

                $table = "lp_user_mst";
                $data = array(
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'email'=> $email,
                    'phone'=>  $phone,
                    'license_no' => $license,
                    'company_name' => $cname,
                    'company_add' => $cadd,
                    'is_enterprise_user' => $enterpriseFlag,
                );
                if(isset($ccity)){
                    $data['company_city'] = $ccity;
                }
                if(isset($cstate)){
                    $data['company_state'] = $cstate;
                }
                if(isset($czip)) {
                    $data['comapny_zip'] = $czip;
                }
                if(isset($curl)) {
                    $data['company_url'] = $curl;
                }
                if(isset($cma_url)) {
                    $data['cma_url'] = $cma_url;
                }
                $data['use_rets_api'] = 0;
                if(isset($use_rets_api) && $use_rets_api == 1) {
                    $data['use_rets_api'] = 1;

                }
                if(isset($report_dir_name)) {
                    $data['report_dir_name'] = $report_dir_name;
                }
                if(isset($widget_bg_color)) {
                    $data['widget_bg_color'] = $widget_bg_color;
                }
                $resultCheck = false;
                // USER NAME CAN NOT BE CHANGED ONCE CREATED
                // if($username!='') {
                //     $resultCheck = $this->base_model->check_existent($table,array("user_name = '$username' && user_id_pk!="=>$uid));
                //     $data['user_name'] = $username;
                // }
                // if($resultCheck) {
                //     $resp = array(
                //         'status'=>'error',
                //         'msg'=>'Username taken.'
                //         );
                //     echo json_encode($resp);
                //     exit;
                // }
                $resultCheck = $this->base_model->check_existent($table,array("email = '$email' && user_id_pk!="=>$uid));
                if($resultCheck) {
                    $resp = array(
                        'status'=>'error',
                        'msg'=>'Email address already exists.'
                        );
                    echo json_encode($resp);
                    exit;
                }
                if(isset($roleId)) {
                    $data['role_id_fk'] = $roleId;
                }
                if(isset($parentId)) {
                    $data['parent_id'] = $parentId;
                }
                if(isset($referralCode) && $referralCode!='') {
                    $data['ref_code'] = $referralCode;
                }
                $where = array(
                    'user_id_pk' => $uid
                );

                $result = $this->base_model->update_record_by_id($table,$data,$where);
                $resp = array(
                    "status" => "success",
                    "msg" => "Updated successfully."
                );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }
    }

    public function get_unique_code()
    {
        $uid = $this->input->post('uid');
        $unique_id = generate_sso_token($uid);
        $return_data['status'] = true;
        $return_data['unique_id'] = $unique_id;
        echo json_encode($return_data);
        return;


    }

    public function sso_edit()
    {
        // echo "<pre>";
        // print_r($this->input->post());die;
        $data_update = array(); 
        
        //get existing ids
        $where_comp['company_id'] = $this->input->post('company_id');
        $existing_reords = $this->base_model->get_all_record_by_id('lp_idps',$where_comp);
        $existing_ids = array();

        if($existing_reords && is_array($existing_reords) && count($existing_reords)) {
            foreach ($existing_reords as $existing_reord) {
                $existing_ids[$existing_reord->id] = $existing_reord->id;
            }
        }
        // $data_update['metadata_url'] = $this->input->post('metadata_url');
        $form_data = $this->input->post('data');

        foreach ($form_data as $data) {

            $sso = $data['sso'];

            // $fields = $data['fields'];
            $fields = $data['field'];

            if(!empty($sso['metadata_url'])) {

                
                    $data_update['metadata_url'] = $sso['metadata_url'];
                    $data_update['idp'] = $sso['idp'];
                    $data_update['unique_id'] = $sso['unique_id'];
                    $data_update['email'] = $fields['email']; 
                    $data_update['first_name'] = $fields['first_name']; 
                    $data_update['last_name'] = $fields['last_name']; 
                    $data_update['phone'] = $fields['phone']; 
                    // $data_update['sales_rep'] = $fields['sales_rep']; 
                    $data_update['username'] = $fields['username']; 
                    $data_update['image'] = $fields['image']; 

                    if(!empty($sso['sso_id'])) { //Update
                         $where = array(
                            'id' => $sso['sso_id']
                        );
                         if(isset($existing_ids[$sso['sso_id']])) {
                            unset($existing_ids[$sso['sso_id']]);
                         }
                        $result = $this->base_model->update_record_by_id('lp_idps',$data_update,$where);
                    }
                    else { //insert
                        $data_update['company_id'] = $this->input->post('company_id');
                        $result = $this->base_model->insert_one_row('lp_idps',$data_update);
                    }
                
            }
        }

        //Remove additional data
        if(count($existing_ids)) {
            foreach ($existing_ids as $existing_id) {
                $where_delete['id'] = $existing_id;
                $result = $this->base_model->delete_record_by_id('lp_idps',$where_delete);
            }
        }

        $company_id = $this->input->post('company_id');

       

        if($result){
            //Call saml to configure record
            file_get_contents(base_url('simplesaml/module.php/cron/cron.php?key=BaPwi12emND&tag=hourly'));
            // Set flash data
            $this->session->set_flashdata('success', 'Record updated');
            redirect("admin/profile_edit/".$company_id);
        
            
        }else{
            $this->session->set_flashdata('error', 'Record not updated');
            redirect("admin/profile_edit/".$company_id);
        }
    }

    public function user_order_history($userId) 
    {
        hasAccess('order_history');
        $data['title'] = "Manage User Orders";
        $data['userId'] = $userId;

        $this->load->model('user_model');
        $user_details = $this->user_model->getUserDetailsByPermission($userId, ['user.user_id_pk', 'user.first_name', 'user.last_name']);

        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if ($adminId && $user_details) {
            $data['userDetails'] = $user_details;

            $this->load->view('admin/header',$data);
            $this->load->view('admin/user_order_history',$data);
            $this->load->view('admin/footer',$data);
        } else {
            redirect('admin/index');
        }
    }

    // order history list view
    public function user_order_history_list_view()
    {
        // $this->_hasAccess('order_history');
        if(!hasAccess('order_history')) {
            $resp = array(
                'status'=>'error',
                'msg'=>'Access Denied!'
            );
            echo json_encode($resp);
            exit();
        }
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        $roleId = $this->session->userdata('role_id');
        $userId = $this->input->post('user_id');
        if($adminId && $userId) {

            $columns = [
                'id',
                'invoice_date', 
                'invoice_num',
                'invoice_to',
                'invoice_amount',
                'is_success',
                'action'
            ];

            $recordsTotal = $this->admin_model->user_invoice_count($userId, $roleId, $adminId, $_POST);
            $result = $this->admin_model->user_invoice_data($userId, $roleId, $adminId, $columns, $_POST);

            $i = $_POST['start'];
            $data = [];
            foreach ($result as $invoice) {
                $i++;

                $invoiceDate = date("F j, Y", strtotime($invoice['invoice_date']));

                $flag = '';
                if($invoice['is_success']=="Y"){
                    $flag = "Success";
                }else{
                    $flag  = "Failed";
                }

                $action = '';
                if (!empty($invoice['report_path'])) {
                    $action .='<a class="btn btn-success btn-xs admin-ml-5" title="Download Report" href="'.base_url($invoice['report_path']).'" target="_blank"  data-toggle="tooltip" data-title="Download Report"><i class="fa fa-download"></i></a>';
                } else {
                    $action .='<a class="btn btn-success btn-xs admin-ml-5" title="Download Report" href="javascript:void(0)" data-toggle="tooltip" data-title="Download Report" onclick="alert(\'Not Available\')" ><i class="fa fa-download"></i></a>';
                }
                if (!empty($invoice['invoice_pdf'])) {
                    if (file_exists($invoice['invoice_pdf'])) {
                        $action .='<a class="btn btn-success btn-xs admin-ml-5" title="Download Invoice" href="'.base_url($invoice['invoice_pdf']).'" target="_blank"  data-toggle="tooltip" data-title="Download Invoice"><i class="fa fa-download"></i></a>';
                    } else {
                        $invoice_generate_url = site_url().'/admin/download_invoice/'.$invoice['invoice_num'].'/'.$invoice['user_id_fk'];
                        $action .='<a class="btn btn-success btn-xs admin-ml-5" title="Download Invoice" href="'.$invoice_generate_url.'" target="_blank"  data-toggle="tooltip" data-title="Download Invoice"><i class="fa fa-download"></i></a>';
                    }
                } else {
                    $action .='<a class="btn btn-success btn-xs admin-ml-5" title="Download Invoice" href="javascript:void(0)" data-toggle="tooltip" data-title="Download Invoice" onclick="alert(\'Not Available\')" ><i class="fa fa-download"></i></a>';
                }
                $action .='<a href="'.site_url('/admin/invoice/'.$invoice['invoice_num']).'" class="btn btn-info btn-xs admin-ml-5" data-toggle="tooltip" data-title="View detail"><i class="fa fa-eye"></i></a>';


                $data[] = [
                    $i,
                    $invoiceDate,
                    $invoice['invoice_num'],
                    $invoice['invoice_to'],
                    '$'.number_format($invoice['invoice_amount'],2),
                    $flag,
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
                "data" => [],
            );    
            echo json_encode($output);
        }
    }

    // Order history page
    public function order_history()
    {
        hasAccess('order_history');
        $data['title'] = "Manage Orders";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $this->load->view('admin/header',$data);
            $this->load->view('admin/order_history',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }
    }
    // order history list view
    public function orderhistorylist_view()
    {
        // $this->_hasAccess('order_history');
        if(!hasAccess('order_history')) {
            $resp = array(
                'status'=>'error',
                'msg'=>'Access Denied!'
            );
            echo json_encode($resp);
            exit();
        }
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        $roleId = $this->session->userdata('role_id');

        if($adminId && $_POST["type"] == "orderhistory") {

            $columns = [
                'id',
                'first_name', 
                'is_active',
                'total_invoices',
                'action'
            ];

            $recordsTotal = $this->admin_model->user_order_count($roleId, $adminId, $_POST);
            $result = $this->admin_model->user_order_data($roleId, $adminId, $columns, $_POST);

            $i = $_POST['start'];
            $data = [];
            foreach($result as $user) {
                $i++;
                $action =' <a target="_blank" href="'.site_url().'?/admin/user_order_history/'.$user['user_id_pk'].'" class="btn btn-info btn-xs admin-ml-5" data-toggle="tooltip" data-title="View Orders"><i class="fa fa-eye"></i></a>';

                $flag = '';
                $status = $user['is_active'];
                if ($status == "Y") {
                    $flag = "Active";
                } else {
                    $flag = "Inactive";
                }

                $data[] = [
                    $i,
                    $user['first_name'] . ' ' . $user['last_name'], 
                    $flag, 
                    $user['total_invoices'], 
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
                "data" => [],
            );    
            echo json_encode($output);
        }
    }
    // Manage products view
    public function manage_product()
    {
        /**
         * Die added because left bar navigation link of admin/manage_product was commented
         */
        die();
        $data['title'] = "Manage Products";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            
            $table = "lp_category_mst";
            $data['category'] = $this->base_model->all_records($table);
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_product',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }
    }
    // Manage products view
    public function flyer_add()
    {
        /**
         * Die added because left bar navigation link of admin/manage_product was commented
         */
        die();
        $data['title'] = "Flyer Add";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            
            $table = "lp_category_mst";
            $data['category'] = $this->base_model->all_records($table);
            $this->load->view('admin/header',$data);
            $this->load->view('admin/flyer_add',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }
    }
    // Manage products view
    public function flyer_add2()
    {
        /**
         * Die added because left bar navigation link of admin/manage_product was commented
         */
        die();
        $data['title'] = "Flyer Add";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            
            $table = "lp_category_mst";
            $data['category'] = $this->base_model->all_records($table);
            $this->load->view('admin/header',$data);
            $this->load->view('admin/flyer-workshop',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }
    }
    // product edit view
    public function manage_product_edit($id)
    {
        /**
         * Die added because left bar navigation link of admin/manage_product was commented
         */
        die();
        $data['title'] = "Edit Products";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $data['products'] = $this->admin_model->manage_product_edit($id);
            $table = "lp_category_mst";
            $data['category'] = $this->base_model->all_records($table);
            $this->load->view('admin/header',$data);
            
            $this->load->view('admin/flyer_add',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }
    }
    // product detail view
    public function manage_product_view($id)
    {
        /**
         * Die added because left bar navigation link of admin/manage_product was commented
         */
        die();
        $data['title'] = "View Products";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $data['products'] = $this->base_model->get_record_by_id('lp_product_mst',array('product_id_pk' => $id));
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_product_view',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }
    }
    // product add
    public function product_add()
    {
        /**
         * Die added because left bar navigation link of admin/manage_product was commented
         */
        die();
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST){
                $postedArr = $this->security->xss_clean($_POST);
                $category_id = mysqli_real_escape_string($this->dbConn, $postedArr['cname']);
                $product_name = mysqli_real_escape_string($this->dbConn, $postedArr['pname']);
                $added_date = mysqli_real_escape_string($this->dbConn, $postedArr['adddate']);
                $prod_desc = mysqli_real_escape_string($this->dbConn, $postedArr['dname']);
                if($added_date == ""){
                    $product_date = date('Y-m-d');
                }else{
                    $product_date = date('Y-m-d', strtotime($added_date));
                }
                
                $product_content = $_POST['flyer_html'];
                
                // image upload
                $status = "";
                $msg = "";
                $fileuri='';
                $file_element_name = 'fileToUpload';
                if ($status != "error"){

                    $config['upload_path'] = './assets/uploads/product_img/';
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
                        $uploadedFolderPath = 'assets/uploads/product_img/';
                        // insert row
                        if($status == "success"){
                            // product add
                            $data2 = array(
                                'product_name' => $product_name,
                                'product_image' => $uploadedFolderPath.$fileuri,
                                'product_content' =>  $product_content,
                                'is_active' => 'Y',
                                'active_from' => $product_date,
                                'category_id_fk' => $category_id,
                                'product_desc' => $prod_desc
                            );
                            $result = $this->base_model->insert_one_row('lp_product_mst',$data2);
                            if($result){
                                
                                $resp = array("status"=>"success","msg"=>"Product added successfully.");
                                echo json_encode($resp);
                                
                            }else{
                                $resp = array("status"=>"error","msg"=>"Product could not be added.");
                                echo json_encode($resp);
                            }

                        }
                        
                    }
                }
            }
        }else{
            redirect('admin/index');
        }
    }
    // product edit
    public function product_edit()
    {
        /**
         * Die added because left bar navigation link of admin/manage_product was commented
         */
        die();
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){

            if($_POST){
                $postedArr = $this->security->xss_clean($_POST);
                $pid = mysqli_real_escape_string($this->dbConn, $postedArr['pid']);
                $category_id = mysqli_real_escape_string($this->dbConn, $postedArr['cname']);
                $product_name = mysqli_real_escape_string($this->dbConn, $postedArr['pname']);
                $added_date = mysqli_real_escape_string($this->dbConn, $postedArr['adddate']);
                $prod_desc = mysqli_real_escape_string($this->dbConn, $postedArr['dname']);
                $product_date = date('Y-m-d', strtotime($added_date));
                
                $product_content = $_POST['flyer_html'];
                $fileset = $_FILES['fileToUpload']['name'];
                if($fileset != ""){
                    // image upload
                    $status = "";
                    $msg = "";
                    $fileuri='';
                    $file_element_name = 'fileToUpload';
                    if ($status != "error"){
                        $config['upload_path'] = './assets/uploads/product_img/';
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
                            $uploadedFolderPath = 'assets/uploads/product_img/';
                            // update row
                            if($status == "success"){
                                // product update
                                $data2 = array(
                                    'product_name' => $product_name,
                                    'product_image' => $uploadedFolderPath.$fileuri,
                                    'product_content' =>  $product_content,
                                    'is_active' => 'Y',
                                    'active_from' => $product_date,
                                    'category_id_fk' => $category_id,
                                    'product_desc' => $prod_desc
                                );
                                $where = array(
                                    'product_id_pk' => $pid
                                );
                                $getImgUrl = $this->base_model->get_record_by_id('lp_product_mst', array('product_id_pk'=>$pid));
                                @unlink($getImgUrl->product_image);
                                $result = $this->base_model->update_record_by_id('lp_product_mst',$data2,$where);
                                if($result){
                                    
                                    $resp = array("status"=>"success","msg"=>"Product edited successfully.");
                                    echo json_encode($resp);
                                    
                                }else{
                                    $resp = array("status"=>"error","msg"=>"Product could not be edited.");
                                    echo json_encode($resp);
                                }

                            }
                            
                        }
                    }


                }else{

                    $data2 = array(
                        'product_name' => $product_name,
                        'product_content' =>  $product_content,
                        'is_active' => 'Y',
                        'active_from' => $product_date,
                        'category_id_fk' => $category_id,
                        'product_desc' => $prod_desc
                    );
                    $where = array(
                        'product_id_pk' => $pid
                    );
                    $result = $this->base_model->update_record_by_id('lp_product_mst',$data2,$where);
                    if($result){
                        $resp = array("status"=>"success","msg"=>"Product edited successfully.");
                        echo json_encode($resp);
                    }else{
                        $resp = array("status"=>"error","msg"=>"Product could not be edited.");
                        echo json_encode($resp);
                    }
                }
            }

        }else{
            redirect('admin/index');
        }
    }
    // product list view
    public function productlist_view()
    {
        /**
         * Die added because left bar navigation link of admin/manage_product was commented
         */
        die();
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST["type"] == "productlist"){
                $table = "lp_product_mst"; 
                $product = $this->admin_model->manage_product();
                // table table-hover table-bordered
                $prodlist_table ='<table class="" id="prod-table">
                              <thead>
                                <tr>  
                                    <!--<th class="col-md-1">Sr. no.</th>-->
                                    <th  class="col-md-2" >Product Name</th>
                                    <th  class="col-md-2" >Category Name</th>
                                    <th  class="col-md-3" >Product Image</th>
                                    <th  class="col-md-2" >Added Date</th>
                                    <th  class="col-md-2" >Actions</th>
                                </tr>
                              </thead>
                              <tbody>';
                $i = 1;
                foreach($product as $info)   {
                    $prodlist_table .= '<tr>';
                    $prodlist_table .= '<!--<td  class="text-right">'.$i.'</td>-->
                                    <td>'.$info->product_name.'</td>
                                    <td>'.$info->category_name.'</td>
                                    <td><img src="'.site_url().$info->product_image.'" width="40px" height="40px" ></td>
                                    <td>'.date("F j, Y", strtotime($info->active_from)).'</td>';
                    $prodlist_table .= '<td>
                                    <div class="text-right">
                                      <a class="btn btn-xs btn-info" href="'.site_url().'?/admin/manage_product_view/'.$info->product_id_pk.'" data-toggle="tooltip" data-title="View detail"><i class="fa fa-eye"></i></a> 
                                      <a class="btn btn-xs btn-warning" href="'.site_url().'?/admin/manage_product_edit/'.$info->product_id_pk.'" data-toggle="tooltip" data-title="Edit"><i class="fa fa-edit"></i></a>
                                      <a class="btn btn-xs btn-danger" href="javascript:;" onclick="deleteproduct('.$info->product_id_pk.');" data-toggle="tooltip" data-title="Delete"><i class="fa fa-times"></i></a> ';
                    if($info->is_active == 'N'){
                        $prodlist_table .= '<a class="btn btn-xs btn-success" href="javascript:;" onclick="verifyproduct('.$info->product_id_pk.');" data-toggle="tooltip" data-title="Active"><i class="fa fa-check-circle"></i></a>';
                    } else {
                        $prodlist_table .= '<a class="btn btn-xs btn-warning" href="javascript:;" onclick="unverifyproduct('.$info->product_id_pk.');" data-toggle="tooltip" data-title="Deactive"><i class="fa fa-ban"></i></a>';
                    }
                    $prodlist_table .= '</div>
                                  </td>';
                    $prodlist_table .= '</tr>';
                    $i++;
                }
                $prodlist_table .= '</tbody>
                            </table>';

                $resp = array('status' => 'success', 'prodlist_table' => $prodlist_table );
                echo json_encode($resp);

            }else{
                $resp = array('status' => 'error', 'msg' => 'Invalid Request.' );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }
    }
    // delete product
    public function deleteproduct($id)
    {
        /**
         * Die added because left bar navigation link of admin/manage_product was commented
         */
        die();
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){

            $delResult = $this->admin_model->delete_prod_cat($id);
            if($delResult){
                $delResult2 = $this->admin_model->deleteproduct($id);
                if($delResult2){
                    $resp = array('status' => 'success', 'msg' => 'Product deleted successfully.' );
                    echo json_encode($resp);
                }
            }else{
                $resp = array('status' => 'error', 'msg' => 'Product could not be deleted.' );
                echo json_encode($resp);
            }
        }
        else{
            redirect('admin/index');
        }

    }
    // actice product
    public function verifyproduct($id)
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $verifyResult = $this->admin_model->verifyproduct($id);
            if($verifyResult){
                $resp = array('status' => 'success', 'msg' => 'Product activated successfully.' );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }

    }
    // inactive product 
    public function unverifyproduct($id)
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $unverifyResult = $this->admin_model->unverifyproduct($id);
            if($unverifyResult){
                $resp = array('status' => 'success', 'msg' => 'Product inactivated successfully.' );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }

    }
    // manage category
    public function manage_category()
    {
        /**
         * Die added because left bar navigation link of admin/manage_category was commented
         */
        die();
        $data['title'] = "Manage Category";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $table = "lp_category_mst";
            $data['parent_cat'] = $this->base_model->all_records($table);
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_category',$data);
            $this->load->view('admin/footer');
        }else{
            redirect('admin/index');
        }
    }
    //
    public function category_edit_view($cid)
    {
        /**
         * Die added because left bar navigation link of admin/manage_category was commented
         */
        die();
        $data['title'] = "Manage Category";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            // show category dropdown
            $table = "lp_category_mst";
            $data['parent_cat'] = $this->base_model->all_records($table);
            // fetch category by id
            $data['category'] = $this->base_model->get_record_by_id($table,array('category_id_pk' => $cid));
            $this->load->view('admin/header',$data);
            $this->load->view('admin/category_edit_view',$data);
            $this->load->view('admin/footer');
        }else{
            redirect('admin/index');
        }
    }
    // categorylist view
    public function categorylist_view()
    {
        /**
         * Die added because left bar navigation link of admin/manage_category was commented
         */
        die();
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST["type"] == "categorylist"){
                $table = "lp_category_mst";
                $category = $this->base_model->all_records($table);
                // table table-hover table-bordered 
                $categoryTable ='<table class="" id="categorylist">
                              <thead>
                                <tr>          
                                  <th class="col-md-1">Sr. no.</th>
                                  <th class="col-md-9" >Name</th>                                  
                                  <th class="col-md-2">Actions</th>
                                </tr>
                              </thead>
                              <tbody>';
                $i = 1;
                foreach($category as $info)   {
                    $categoryTable .= '<tr>
                                  <td class="text-right">'.$i.'</td>
                                  <td>'.$info->category_name.'</td>                                 
                                  <td>
                                    <div class="text-right">
                                      <!--<a class="btn btn-xs btn-info" href="javascript:;" onclick="info_cat('.$info->category_id_pk.');" data-toggle="tooltip" data-title="View detail"><i class="fa fa-eye"></i></a>-->
                                      <a class="btn btn-xs btn-warning" href="'.site_url('admin/category_edit_view/'.$info->category_id_pk).'" data-toggle="tooltip" data-title="Edit"><i class="fa fa-edit"></i></a>
                                      <a class="btn btn-xs btn-danger" href="javascript:;" onclick="delete_cat('.$info->category_id_pk.');" data-toggle="tooltip" data-title="Delete"><i class="fa fa-times"></i></a> ';
                    $categoryTable .= '</div>
                                  </td>
                                </tr>';
                    $i++;
                }
                $categoryTable .= '</tbody>
                            </table>';

                $resp = array('status' => 'success', 'categorylist_table' => $categoryTable );
                echo json_encode($resp);
            }else{
                $resp = array('status' => 'error', 'msg' => 'Invalid Request.' );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }

    }
    // delete category
    public function delete_cat($id){
        /**
         * Die added because left bar navigation link of admin/manage_category was commented
         */
        die();
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $table = "lp_category_mst";
            $where = array(
                "parent_category" => $id
            );
            $resultCheck = $this->base_model->check_existent($table,$where);
            if(!$resultCheck){
                $where1 = array(
                    "category_id_pk" => $id
                );
                $delResult = $this->base_model->delete_record_by_id($table,$where1);
                if($delResult){
                    $resp = array('status' => 'success', 'msg' => 'Category deleted successfully.' );
                    echo json_encode($resp);
                }
            }else{
                $resp = array(
                    'status'=>'cat_error',
                    'msg'=>'Category used as Parent category.'
                );
                echo json_encode($resp);
            }

        }
        else{
            redirect('admin/index');
        }
    }
    // category add
    public function category_add()
    {
        /**
         * Die added because left bar navigation link of admin/manage_category was commented
         */
        die();
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST){
                $postedArr = $this->security->xss_clean($_POST);
                $cat_name = mysqli_real_escape_string($this->dbConn, $postedArr['cat_name']);
                $parent_cat = mysqli_real_escape_string($this->dbConn, $postedArr['parent_cat']);
                $table = "lp_category_mst";
                $where = array('category_name'=> $cat_name);
                $resultCheck = $this->base_model->check_existent($table,$where);
                if(!$resultCheck){
                    $data = array(
                        'category_name' => $cat_name,
                        'parent_category' => $parent_cat
                    );
                    $result = $this->base_model->insert_one_row( $table, $data );
                    if($result){
                        $resp = array(
                            'status'=>'success',
                            'msg'=>'Category added successfully.'
                        );
                        echo json_encode($resp);
                    }
                }else{
                    $resp = array(
                        'status'=>'error',
                        'msg'=>'Category already exists.'
                    );
                    echo json_encode($resp);
                }
            }else{
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Category add error.'
                );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }
    }
    // category edit
    public function category_edit()
    {
        /**
         * Die added because left bar navigation link of admin/manage_category was commented
         */
        die();
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST){
                $postedArr = $this->security->xss_clean($_POST);

                $cat_id = mysqli_real_escape_string($this->dbConn, $postedArr['catid']);
                $cat_name = mysqli_real_escape_string($this->dbConn, $postedArr['cat_name']);
                $parent_cat = mysqli_real_escape_string($this->dbConn, $postedArr['parent_cat']);

                $table = "lp_category_mst";
                // check if category name is changed
                $data['category'] = $this->base_model->get_record_by_id($table,array('category_id_pk' => $cat_id));
                if($data['category']->category_name != $cat_name ){

                    $where = array('category_name'=> $cat_name);
                    $resultCheck = $this->base_model->check_existent($table,$where);
                    if(!$resultCheck){
                        $data = array(
                            'category_name' => $cat_name,
                            'parent_category' => $parent_cat
                        );
                        $where2 = array(
                            'category_id_pk' => $cat_id
                        );
                        $result = $this->base_model->update_record_by_id($table, $data, $where2);
                        if($result){
                            $resp = array(
                                'status'=>'success',
                                'msg'=>'Category edited successfully.'
                            );
                            echo json_encode($resp);
                        }
                    }else{
                        $resp = array(
                            'status'=>'error',
                            'msg'=>'Category already exists.'
                        );
                        echo json_encode($resp);
                    }

                }else{
                    $data = array(
                        'parent_category' => $parent_cat
                    );
                    $where2 = array(
                        'category_id_pk' => $cat_id
                    );
                    $result = $this->base_model->update_record_by_id($table, $data, $where2);
                    if($result){
                        $resp = array(
                            'status'=>'success',
                            'msg'=>'Category edited successfully.'
                        );
                        echo json_encode($resp);
                    }
                }
            }else{
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Category edit error.'
                );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }
    }
    // manage coupons
    public function manage_coupon()
    {
        hasAccess('manage_coupon');
        $data['title'] = "Manage Coupons";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            // $data['orders'] = $this->admin_model->view_orders();
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_coupon',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }
    }
    // manage coupon edit
    public function manage_coupon_edit($cid)
    {
        hasAccess('manage_coupon');
        $data['title'] = "Manage Coupons";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $data['coupon'] = $this->base_model->get_record_by_id('lp_coupon_mst',array('coupon_id_pk' => $cid));
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_coupon_edit',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }
    }
    // manage coupon edit
    public function manage_coupon_view($cid)
    {
        hasAccess('manage_coupon');
        $data['title'] = "Manage Coupons";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $data['coupon'] = $this->base_model->get_record_by_id('lp_coupon_mst',array('coupon_id_pk' => $cid));
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_coupon_view',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }
    }
    // coupon add
    public function coupon_add()
    {
        if(!hasAccess('manage_coupon')) {
            $resp = array(
                'status'=>'error',
                'msg'=>'Access Denied!'
            );
            echo json_encode($resp);
            exit();
        }
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST){

                $postedArr = $this->security->xss_clean($_POST);

                $coupon_name = mysqli_real_escape_string($this->dbConn, $postedArr['coupon_name']);
                $coupon_code = mysqli_real_escape_string($this->dbConn, $postedArr['coupon_code']);
                $coupon_amt = mysqli_real_escape_string($this->dbConn, $postedArr['coupon_amt']);
                $coupon_des = mysqli_real_escape_string($this->dbConn, $postedArr['coupon_des']);
                $startdate = mysqli_real_escape_string($this->dbConn, $postedArr['startdate']);
                $s_date = date('Y-m-d', strtotime($startdate));
                $enddate = mysqli_real_escape_string($this->dbConn, $postedArr['enddate']);
                $e_date = date('Y-m-d', strtotime($enddate));

                if ($e_date<$s_date) {
                    $resp = array(
                        'status'=>'error',
                        'msg'=>'Coupon start date can not greater than end date.'
                    );
                    echo json_encode($resp);
                    exit();
                }

                $table = "lp_coupon_mst";
                $where = array('coupon_code'=> $coupon_code);
                $resultCheck = $this->base_model->check_existent($table,$where);
                if(!$resultCheck){
                    $data = array(
                        'coupon_code' => $coupon_code,
                        'coupon_name' => $coupon_name,
                        'coupon_descr' => $coupon_des,
                        'start_date' => $s_date,
                        'end_date' => $e_date,
                        'coupon_amt' =>  $coupon_amt
                    );
                    $result = $this->base_model->insert_one_row($table,$data);
                    if($result){
                        $resp = array(
                            'status'=>'success',
                            'msg'=>'Coupon added successfully.'
                        );
                        echo json_encode($resp);
                    }
                }else{
                    $resp = array(
                        'status'=>'error',
                        'msg'=>'Coupon already exists.'
                    );
                    echo json_encode($resp);
                }
            }else{
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Coupon add error.'
                );
                echo json_encode($resp);
            }
        }else{
            redirect(site_url_url('admin'));
        }
    }
    // coupon edit
    public function coupon_edit()
    {
        if(!hasAccess('manage_coupon')) {
            $resp = array(
                'status'=>'error',
                'msg'=>'Access Denied!'
            );
            echo json_encode($resp);
            exit();
        }
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST){

                $postedArr = $this->security->xss_clean($_POST);

                $coupon_id = mysqli_real_escape_string($this->dbConn, $postedArr['cid']);
                $coupon_name = mysqli_real_escape_string($this->dbConn, $postedArr['coupon_name']);
                $coupon_code = mysqli_real_escape_string($this->dbConn, $postedArr['coupon_code']);
                $coupon_amt = mysqli_real_escape_string($this->dbConn, $postedArr['coupon_amt']);
                $coupon_des = mysqli_real_escape_string($this->dbConn, $postedArr['coupon_des']);
                $startdate = mysqli_real_escape_string($this->dbConn, $postedArr['startdate']);
                $s_date = date('Y-m-d', strtotime($startdate));
                $enddate = mysqli_real_escape_string($this->dbConn, $postedArr['enddate']);
                $e_date = date('Y-m-d', strtotime($enddate));

                if ($e_date<$s_date) {
                    $resp = array(
                        'status'=>'error',
                        'msg'=>'Coupon start date can not greater than end date.'
                    );
                    echo json_encode($resp);
                    exit();
                }

                $table = "lp_coupon_mst";
                $data = array(
                    'coupon_code' => $coupon_code,
                    'coupon_name' => $coupon_name,
                    'coupon_descr' => $coupon_des,
                    'start_date' => $s_date,
                    'end_date' => $e_date,
                    'coupon_amt' =>  $coupon_amt
                );
                $where = array('coupon_id_pk'=> $coupon_id);
                $result = $this->base_model->update_record_by_id($table,$data,$where);
                $resp = array(
                    'status'=>'success',
                    'msg'=>'Coupon edited successfully.'
                );
                echo json_encode($resp);
            }else{
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Coupon edit error.'
                );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }
    }
    // couponlist view
    public function couponlist_view()
    {
        if(!hasAccess('manage_coupon')) {
            $resp = array(
                'status'=>'error',
                'msg'=>'Access Denied!'
            );
            echo json_encode($resp);
            exit();
        }
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId && $_POST["type"] == "couponlist") {

            $this->load->model('coupon_model');
            $columns = [
                'id', 
                'coupon_code',
                'coupon_name',
                'start_date',
                'end_date',
                'coupons_applied_cnt',
                'coupon_amt'
            ]; 

            $recordsTotal = $this->coupon_model->get_coupon_count($_POST);
            $result = $this->coupon_model->get_coupon_data($columns, $_POST);

            $i = $_POST['start'];
            $data = [];
            foreach($result as $coupon) {
                $i++;
                $startDate = date("F j, Y", strtotime($coupon['start_date']));
                $endDate = ' - ';
                if (!empty($coupon['end_date'])) {
                    $endDate = date("F j, Y", strtotime($coupon['end_date']));
                }
                
                $action = '<a class="btn btn-xs btn-info admin-ml-5" href="'.site_url('admin/manage_coupon_view/'.$coupon['coupon_id_pk']).'" data-toggle="tooltip" data-title="View detail"><i class="fa fa-eye"></i></a>
                <a class="btn btn-xs btn-warning admin-ml-5" href="'.site_url('admin/manage_coupon_edit/'.$coupon['coupon_id_pk']).'" data-toggle="tooltip" data-title="Edit"><i class="fa fa-edit"></i></a>
                <button class="btn btn-xs btn-danger admin-ml-5" onclick="delete_coupon('.$coupon['coupon_id_pk'].');" data-toggle="tooltip" data-title="Delete"><i class="fa fa-times"></i></button>';
                
                $data[] = [
                    $i,
                    $coupon['coupon_code'], 
                    $coupon['coupon_name'],
                    $startDate,
                    $endDate, 
                    $coupon['coupons_applied_cnt'], 
                    $coupon['coupon_amt'], 
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
    // delete coupon
    public function delete_coupon($id){
        if(!hasAccess('manage_coupon')) {
            $resp = array(
                'status'=>'error',
                'msg'=>'Access Denied!'
            );
            echo json_encode($resp);
            exit();
        }
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            // check if coupon is used
            $table = "lp_my_cart";
            $where = array(
                "coupon_id_fk" => $id
            );
            $resultCheck = $this->base_model->check_existent($table,$where);
            if(!$resultCheck){
                // check if start date
                $table2 = "lp_coupon_mst";
                $where2 = array(
                    'coupon_id_pk' => $id
                );
                $todayDate = date('Y-m-d');
                $getCouponDate = $this->base_model->get_record_by_id($table2,$where2);
                if($todayDate < $getCouponDate->start_date){
                    $delResult = $this->base_model->delete_record_by_id($table2,$where2);
                    if($delResult){
                        $resp = array('status' => 'success', 'msg' => 'Coupon deleted successfully.' );
                        echo json_encode($resp);
                    }
                }else{
                    $resp = array(
                        'status'=>'coupon_start_error',
                        'msg'=>'This Coupon is started.'
                    );
                    echo json_encode($resp);
                }
            }else{
                $resp = array(
                    'status'=>'coupon_error',
                    'msg'=>'This Coupon is used.'
                );
                echo json_encode($resp);
            }
        }
        else{
            redirect('admin/index');
        }
    }
    // manage order
    public function orders()
    {
        $data['title'] = "Manage Orders";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_orders',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }
    }
    // orderlist view
    public function orderlist_view()
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if($_POST["type"] == "orderlist"){
                $table = "lp_invoices";
                $roleId = $this->session->userdata('role_id');
                $order = $this->base_model->order_list($table,$roleId,$adminId);
                $orderTable ='<table class="table table-hover table-bordered">
                              <thead>
                                <tr>          
                                  <th class="col-md-1">Sr. no.</th>
                                  <th class="col-md-3" >Order No.</th> 
                                  <th class="col-md-3" >User Name</th> 
                                  <th class="col-md-3" >Order Amount</th>                                                                       
                                  <th class="col-md-2">Order Date</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>';
                $i = 1;
                foreach($order as $info)   {
                    $orderTable .= '<tr>
                                  <td class="text-right">'.$i.'</td>
                                  <td>'.$info->invoice_num.'</td>                                 
                                  <td>'.$info->first_name.' '.$info->last_name.'</td>
                                  <td class="text-right">'.$info->invoice_amount.'</td>                                 
                                  <td class="text-right">'.$info->invoice_date.'</td>
                                  <td>';
                    if(!is_null($info->invoice_pdf)) {
                        $orderTable .= '<a href="'.base_url($info->invoice_pdf).'" target="_blank" class="btn btn-info btn-block">view Invoice</a>';
                    }
                    $orderTable .= '</td></tr>';
                    $i++;
                }
                $orderTable .= '</tbody>
                            </table>';

                $resp = array('status' => 'success', 'orderlist_table' => $orderTable );
                echo json_encode($resp);
            }else{
                $resp = array('status' => 'error', 'msg' => 'Invalid Request.' );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }

    }

    public function upload_file(){

        $status = "";
        $msg = "";
        $fileuri='';
        $file_element_name = 'fileToUpload';

        if ($status != "error")
        {
            $config['upload_path'] = 'assets/uploads/product_img/';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt';
            $config['max_size']  = 10240;
            $config['encrypt_name'] = TRUE;

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
            }
        }
        if($fileuri!=''){
            echo json_encode(array('status' => $status, 'msg' => $msg,'fileuri'=> base_url().$fileuri ) );
        }else{
            echo json_encode(array('status' => $status, 'msg' => $msg, 'message' =>'file not uploaded'));
        }

    }
    public function manage_companies()
    {
        hasAccess('manage_companies');
        $data['title'] = "Manage Companies";
        $data['add_title'] = "Create Company";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $data['newUserRoleId'] = 2;
            $data['add_form'] = 'company';
            $data['refferalCode'] = "REF".$adminId;
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_user',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }

    }
    /**
     * Manage Companies
     * @auther Avtar Gaur <info@modernagent.io>
     */
    public function manage_sales_reps()
    {
        hasAccess('manage_sales_reps');
        $data['title'] = "Manage Sales Representatives";
        $data['add_title'] = "Create Sales Representative";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $data['newUserRoleId'] = 3;
            $data['refferalCode'] = "REF".$adminId;
            $_isAdmin = $this->role_lib->is_admin();
            $this->load->model('role_model');
            $data['user_role'] = '';
            $data['add_form'] = 'sales_rep';
            if($_isAdmin) {
                $data['parents'] = $this->role_model->get_companies('Y');
                $companies = array();
                foreach($data['parents'] as $_company){
                    $companies[$_company['user_id_pk']]['cadd'] = $_company['company_add'];
                    $companies[$_company['user_id_pk']]['cname'] = $_company['company_name'];
                }
                $data['companies'] = json_encode($companies);
                $data['choose'] = 'Choose Company';
            }
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_sales_rep',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }

    }
    /**
     * Ajax method to get category tree for a product
     * @auther Avtar Gaur <info@modernagent.io>
     */
    public function get_product_categories(){
        if($this->input->is_ajax_request()){
            $productId = $this->input->post('id');
            $this->load->model('category_model');
            $categoryTree = $this->category_model->get_product_category($productId);
            echo json_encode(array('category_tree'=> $categoryTree ));
        }
    }
    /**
     * Check if user has acces to a path. Rediect to dashboard if does not.
     * @param string $path
     * @auther Avtar Gaur <info@modernagent.io>
     */
    // private function _hasAccess($path) {
    //     $hasAccess = $this->role_lib->has_access($path);
    //     if($this->input->is_ajax_request()){
    //         return $hasAccess;
    //     }
    //     if(!$hasAccess) {
    //         $this->session->set_flashdata('error', 'Access denied');
    //         redirect('admin/dashboard');
    //         return;
    //     }
    //     return true;
    // }
    /**
    * Check if user has created the record. Rediect to redirection path given if has not.
    * @param array/object $record
    * @param string $redirectionPath
    * @auther Avtar Gaur <info@modernagent.io>
    */
    private function _isCreator($record, $redirectionPath = 'admin/dashboard',$filterKey = 'created_by_fk') {
        $adminId = $this->session->userdata('adminid');
        $isAdmin = $this->role_lib->is_admin();
        if(!$isAdmin) {
            if(is_array($record)){
                $createdBy = $record[$filterKey];
            } else if (is_object($record)) {
                $createdBy = $record->$filterKey;
            }
            if(!isset($createdBy) || $createdBy != $adminId) {
                //So the logged in user is not creator. Now check if user is parent of the creator
                if(isset($createdBy)) {
                    $query = $this->db->select('parent_id')
                            ->where('user_id_pk',$createdBy)
                            ->get('ff_user_mst');
                    if($query->num_rows()) {
                        $data = $query->row();
                        if($data->parent_id==$adminId)  {
                            return true;
                        }
                    }
                }
                $this->session->set_flashdata('error', 'Access denied');
                redirect($redirectionPath);
                return;
            }
        }
        return true;
    }
    // Get deactive users
    public function getDeactiveUser()
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            if(!hasAccess('deactive_user')) {
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Access Denied!'
                );
                echo json_encode($resp);
                exit();
            }
            if($_POST["type"] == "deactive_user"){
                // countusers($table, $column, $userType)
                $user_role_id = $_POST["user_role_id"];
                $roleId = $this->session->userdata('role_id');
                $user_count = $this->base_model->countusers('is_active','N',$roleId,$adminId,$user_role_id);
                $resp = array('status' => 'success', 'deactive_user' => $user_count->count_user );
                echo json_encode($resp);
            }else{
                $resp = array('status' => 'error', 'msg' => 'Invalid Request.' );
                echo json_encode($resp);
            }

        }else{
            redirect('admin/index');
        }
    }
    public function export_excel(){
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $_isAdmin = $this->role_lib->is_admin();
            if($_isAdmin) {
                $users = $this->admin_model->manage_user(null, 4);
            } else {
                $users = $this->admin_model->manage_user($adminId, 4);
            }

            $this->load->library("excel");
            $object = new PHPExcel();
            $object->setActiveSheetIndex(0);

            $table_columns = array("Name", "Email", "Company", "Company Address", "Company City", "Company Zip", "Creation Date");
            $column = 0;
            foreach ($table_columns as $field) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
            $excel_row = 2;
            foreach($users as $info)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $info->first_name.' '.$info->last_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $info->email);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $info->company_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $info->company_add);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $info->company_city);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $info->company_zip);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date("F j, Y", strtotime($info->registered_date)));
                $excel_row++;
            }

            $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="file.xls"');
            $object_writer->save('php://output');
            exit;
        }else{
            redirect('admin/index');
        }
    }
    public function set_password($uid) {
        $data['title'] = "Profile Edit";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){
            $_isAdmin = $this->role_lib->is_admin();
            if($_isAdmin) {
                $data['user'] = $this->base_model->get_record_by_id('lp_user_mst',array('user_id_pk' => $uid));
                $this->load->view('admin/header',$data);
                $this->load->view('admin/set_password',$data);
                $this->load->view('admin/footer',$data);
            }
        }else{
            redirect('admin/index');
        }        
    }
    public function save_password(){
        $adminId = $this->session->userdata('adminid');
        $_isAdmin = $this->role_lib->is_admin();
        if($_isAdmin) {
            if($this->input->post()){
                $table = "lp_user_mst";
                $data = array(
                    //'password' => password_hash($this->input->post('pass'),PASSWORD_BCRYPT),
                    'password' => password_hash($this->input->post('pass'),PASSWORD_DEFAULT),
                );
                $where = array('user_id_pk'=> $this->input->post('userid'));
                $result = $this->base_model->update_record_by_id($table,$data,$where);
                $resp = array(
                    'status'=>'success',
                    'msg'=>'Password updated successfully.'
                );
                echo json_encode($resp);
            }else{
                $resp = array(
                    'status'=>'error',
                    'msg'=>'Set password error.'
                );
                echo json_encode($resp);
            }
        }else{
            redirect('admin/index');
        }        
    }
    function add_referral_code($userId=null){
        if(is_null($userId)){
            $userId = $this->session->userdata('adminid');
        }
        $referralCode = "";
        if (strlen($userId) < 5) {
            $referralCode = "REF".sprintf("%05d", $userId);
        } else {
            $referralCode = "REF0".$userId;
        }

        $this->admin_model->add_referral_code($referralCode);
    }
    public function subscribe($userId){
        $_isAdmin = $this->role_lib->is_admin();
        if($_isAdmin){
            $this->load->library('stripe');
            // Create the library object
            $stripe = new Stripe( null );
            $data['user_id'] = $userId;
            $data['subscription_data'] = $stripe->is_subscribed($userId);
            try{
                $response = json_decode($stripe->plan_list());
            }catch(Exception $e){
                print_r($e);
            }
            if(isset($response->data)){
                foreach($response->data as $_row){
                    if(strpos($_row->id,'company')){
                        $data['plans'][] = array(
                            'id' =>  $_row->id,
                            'name' => $_row->name,
                            'amount' => $_row->amount/100,//Cent to USD
                            'interval' => $_row->interval
                        );
                    }
                }
            }
            $data['user'] = $this->base_model->get_record_by_id('lp_user_mst',array('user_id_pk' => $userId));

            $this->load->view('admin/header',$data);
            $this->load->view('admin/subscribe',$data);
            $this->load->view('admin/footer',$data);
        }else{
            redirect('admin/index');
        }        
    }
    public function pay_subscription(){
        $this->load->library('stripe');
        // Create the library object
        $stripe = new Stripe( null );
        $userId = $this->input->post('user_id');
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
            if($userId)
                $this->base_model->update_record_by_id('lp_user_mst',array('customer_id'=>$response->id),array('user_id_pk'=>$userId));
            $this->session->set_flashdata('success', 'Subscribed successfully.');
        } else {
            $this->session->set_flashdata('error', "Failed to subscribe.".$response->error->message);
        }
        if($userId)
            redirect('admin/profile/'.$userId);
        else
            redirect('admin/manage_sales_reps');
    }
    //    Manage Leads Page
    public function manage_leads()
    {

        $data['title'] = "Manage Leads";
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if(!$adminId){
            redirect('admin/index',$data);
        }else{
            $this->load->view('admin/header',$data);
            $this->load->view('admin/manage_leads',$data);
            $this->load->view('admin/footer',$data);
        }
    }
    public function leadsview_list()
    {
        $salesRepId = $this->session->userdata('adminid');
        if($salesRepId) {

            $this->load->model('leads_model');
            $columns = [
                'id',
                'phone_number', 
                'first_name',
                'created_at',
            ]; 

            $recordsTotal = $this->leads_model->get_lead_count($salesRepId, $_POST);
            $result = $this->leads_model->get_lead_data($salesRepId, $columns, $_POST);

            $i = $_POST['start'];
            $data = [];
            foreach($result as $lead) {
                $i++;
                $createdDate = date("F j, Y", strtotime($lead['created_at']));
                
                $data[] = [
                    $i,
                    $lead['phone_number'], 
                    $lead['first_name']. ' ' .$lead['last_name'],
                    $createdDate
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

    public function admin_upload_file($userId, $type)
    {
        $status = "";
        $msg = "";
        $fileuri='';
        $file_element_name = 'fileToUpload';

        $user_old_details = $this->base_model->get_record_by_id('lp_user_mst', ['user_id_pk'=>$userId], ['profile_image', 'company_logo']);
        if (empty($user_old_details)) {
            echo json_encode(array('status' => 'error', 'msg' => 'User does not exists', 'message' =>'file not uploaded'));
            exit();
        }

        if ($status != "error")
        {
            $config['upload_path'] = 'assets/images/';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt';
            $config['max_size']  = '2048';
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
                if ($user_old_details) {
                    if ($type == 'profile-image') {
                        $this->base_model->update_record_by_id('lp_user_mst',array('profile_image'=>$fileuri),array('user_id_pk'=>$userId));
                        if ($user_old_details->profile_image != '' && file_exists(FCPATH.'/'.$user_old_details->profile_image)) {
                        $deleted = unlink(FCPATH.'/'.$user_old_details->profile_image);     
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

    public function packages()
    {
        $data['title'] = "Manage Packages";
        $data['admin_id'] = $this->session->userdata('adminid');
        hasAccess('packages');
        $is_admin = $this->role_lib->is_admin();
        if ($is_admin) {

            $this->load->model('package_model');
            $packages = $this->package_model->get_all_packages_price();
            $data['packages'] = $packages;
            $data['report_price'] = $packages['reports'];
            $data['monthly_price'] = $packages['monthly'];

            $this->load->view('admin/header',$data);
            $this->load->view('packages/index',$data);
            $this->load->view('admin/footer',$data);

        } else {
            redirect('admin/dashboard',$data);
        }
    }

    public function update_package()
    {
        $package = $this->input->post('package');
        $price = $this->input->post('price');
        $is_admin = $this->role_lib->is_admin();
        if ($is_admin) {
            $this->load->model('package_model');
            $adminId = $this->session->userdata('adminid');
            $packages = $this->package_model->set_package_price($package, $price, $adminId);
            echo json_encode(array('status' => 'success', 'message' => ucwords($package).' package price updated successfully.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Access Denied'));
        }
    }

    function download_invoice($invoiceNumber, $userId) 
    {
        $adminId = $this->session->userdata('adminid');
        if(!empty($adminId) && !empty($invoiceNumber) && !empty($userId)) {
            $this->load->library('invoice'); 
            $this->invoice->_getInvoice($invoiceNumber, $userId);
        } else {
            echo "Invoice details are required.";
            exit();
        }
    }

//    Class ends here
}
?>
