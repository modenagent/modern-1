<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

ob_start();
// require APPPATH.'/libraries/REST_Controller.php';
class Frontend extends CI_Controller
{
    // Initialize Constructor Here
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
    }

    // frontend view
    public function index()
    {
        if (defined('CI_REQUEST') && CI_REQUEST == 'external') {
            return;
        }
        if ($this->session->userdata('userid')) {
            redirect(base_url() . 'user/dashboard');
        }
        $data['title'] = "Farming Flyers";

        $this->load->library('session');

        $data['body_class'] = "home-all";

        $this->load->model('package_model');

        $package_prices = $this->package_model->get_by('package', 'buyer');
        $data['single_package'] = $package_prices->price_per_month;
        $package_prices = $this->package_model->get_by('package', 'all');
        $data['all_package'] = $package_prices->price_per_month;
        // var_dump($data);
        // die;

        $this->load->view('frontend/header', $data);
        $this->load->view('frontend/index', $data);
        $this->load->view('frontend/footer', $data);
    }

    // frontend view
    public function login()
    {
        if ($this->session->userdata('userid')) {
            redirect(base_url() . 'user/dashboard');
        }

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('uemail', 'Email', 'required');
        $this->form_validation->set_rules('upass', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            // validation not ok, send validation errors to the view
            $this->load->view('frontend/header_login');
            $this->load->view('frontend/login');
            $this->load->view('frontend/footer_login');
        } else {
            //die("Depreicated. Post request is being handeled from auth controller");
            redirect(base_url() . 'user/dashboard');
        }
    }

    public function forgot_password()
    {
        $this->load->view('frontend/header_login');
        $this->load->view('frontend/forgot_password');
        $this->load->view('frontend/footer_login');
    }

    // frontend view
    public function register($package = 0)
    {
        if ($this->session->userdata('userid')) {
            redirect('user/dashboard');
        }

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_message('is_unique', 'This %s already exists');
        $this->form_validation->set_message('check_refcode', 'Invalid %s');
        $data['err_message'] = '';
        // set validation rules
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('ref_code', 'Referral Code', 'trim|callback_check_refcode');
        $this->form_validation->set_rules('cname', 'Company Name', 'trim');
        $this->form_validation->set_rules('caddress', 'Company Address', 'trim');
        $this->form_validation->set_rules('ccity', 'Company City', 'trim');
        $this->form_validation->set_rules('czipcode', 'Company Zipcode', 'trim');
        $this->form_validation->set_rules('uphone', 'Phone no.', 'trim|required|numeric|min_length[10]|max_length[12]');
        $this->form_validation->set_rules('uemail', 'Email Address', 'trim|required|valid_email|is_unique[lp_user_mst.email]');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('user_pass', 'Password', 'required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[user_pass]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run()) {
            // set variables from the form
            $ref_code = $this->input->post('ref_code');
            if ($ref_code == '') {
                $parentId = (int) $this->input->post('parent_id');
            } else {
                $parentId = (int) str_ireplace("REF", "", $ref_code);
            }
            $parentId = isset($parentId) ? $parentId : 0;
            $encrypted_password = password_hash($this->input->post('user_pass'), PASSWORD_DEFAULT);
            $user = array(
                'password' => $encrypted_password,
                'first_name' => $this->input->post('fname'),
                'last_name' => $this->input->post('lname'),
                'email' => $this->input->post('uemail'),
                'phone' => $this->input->post('uphone'),
                'parent_id' => $parentId,
                'company_logo' => '',
                'company_phone' => '',
                'company_suite' => '',
                'company_state' => '',
                'user_credits' => 0,
                'company_name' => $this->input->post('cname'),
                'company_add' => $this->input->post('caddress'),
                'company_city' => $this->input->post('ccity'),
                'comapny_zip' => $this->input->post('czipcode'),
                'registered_date' => date('Y-m-d H:i:s', time()),
                'is_active' => 'Y',
            );
            $resp = $this->base_model->insert_one_row('lp_user_mst', $user);
            if ($resp) {
                $lastId = $this->base_model->get_last_insert_id();
                $this->session->set_userdata('userid', $lastId);
                $userName = $this->input->post('fname') . ' ' . $this->input->post('lname');
                $name = 'Administrator';
                $mail_data = array();
                $mail_data['email'] = $this->input->post('uemail');
                $mail_data['first_name'] = $this->input->post('fname');
                $mail_data['last_name'] = $this->input->post('lname');
                $mail_data['phone'] = $this->input->post('uphone');
                $message = $this->load->view('mails/registration_success', $mail_data, true);

                $send = $this->base_model->queue_mail($this->input->post('uemail'), 'Modern Agent Registration', $message);
                $doSubscribe = $this->input->post('package');
                if ($doSubscribe) {
                    redirect(site_url('user/myaccount/membership'));
                    exit;
                } else {
                    redirect(site_url('user/dashboard'));
                    exit;
                }
            } else {
                $data['err_message'] = !isset($data['err_message']) ? $data['err_message'] : 'Insert faild.';
            }
        }
        $data['package'] = $package;
        $this->load->view('frontend/header_login');
        $this->load->view('frontend/register', $data);
        $this->load->view('frontend/footer_login');
    }

    public function check_refcode($ref_code)
    {
        if ($ref_code == '') {
            return true;
        }
        //Allow blank ref code
        $parentId = (int) str_ireplace("REF", "", $ref_code);
        return $this->base_model->check_existent("lp_user_mst", array('user_id_pk' => $parentId));
    }

    // frontend view
    public function quick_pdf($code = '')
    {
        $this->load->model('params_adjustment_model');
        if ($this->input->post()) {
            $form = $this->input->post('form-name');
            if ($form == 'ref-form') {
                $refCode = $this->input->post('ref_code');
                if ($refCode == '') {
                    die("Blank Code");
                }
                $user = $this->user_model->get_user_by_ref($code);
                if (!is_object($user)) {
                    die("Invalid Code");
                }
                $data['user'] = $user;
            }
        }
        $userId = null;
        if (!empty($code)) {
            $user = $this->user_model->get_user_by_ref($code);
            // print_r($user);die;
            if (!empty($user) && isset($user->agent) && !empty($user->agent)) {
                $data['agent'] = $user->agent;
                $userId = $user->user_id_pk;
            }
        }

        $data['title'] = "Moder Agent";
        $data['code'] = $code;
        $adjustmentParams = $this->params_adjustment_model->get_by('user_id', $user->user_id_pk);

        $data['black_knight_radius'] = $data['rets_radius'] = "0.25";
        $data['black_knight_sqft'] = $data['rets_sqft'] = "0.20";
        $data['black_knight_flag'] = $data['rets_flag'] = 0;
        if ($adjustmentParams) {
            $data['black_knight_radius'] = $adjustmentParams->black_knight_radius ?? "0.25";
            $data['black_knight_sqft'] = $adjustmentParams->black_knight_sqft ?? "0.20";
            $data['rets_radius'] = $adjustmentParams->rets_radius ?? "0.25";
            $data['rets_sqft'] = $adjustmentParams->rets_sqft ?? "0.20";
            $data['black_knight_flag'] = $adjustmentParams->black_knight_flag ?? 0;
            $data['rets_flag'] = $adjustmentParams->rets_flag ?? 0;
        }
        // echo "<pre>";
        // print_r($data);die;
        $this->load->library('session');

        $this->load->view('frontend/header_cma', $data);
        $this->load->view('frontend/quick_pdf', $data);
        $this->load->view('frontend/footer_cma', $data);
    }
    public function cma_widget()
    {
        $requestData = $this->input->get();
        if (array_key_exists('callback', $requestData)) {
            $html = $this->load->view('frontend/quick_pdf', array('isWidget' => 1), true);
            $data['html'] = $html;
            header('Content-Type: text/javascript; charset=utf8');
            header('Access-Control-Allow-Origin: http://localhost/mylistingpitch');
            header('Access-Control-Max-Age: 3628800');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

            $callback = $requestData['callback'];
            echo $callback . '(' . json_encode($data) . ');';
        } else {
            $html = $this->load->view('frontend/quick_pdf', array(), true);
            $data['html'] = $html;
            // normal JSON string or show an error
            header('Content-Type: application/json; charset=utf8');
            $data = json_encode("ERROR: you must pass a callback parameter");
            echo $data;
        }
        exit;

    }
    public function get_user_by_ref()
    {
        $form = $this->input->post('form-name');
        if ($form == 'ref-form') {
            //Checking Valid 10 digit phone number
            $phoneNumber = $this->input->post('phone_number');
            $phoneNumber = str_replace(" ", "", $phoneNumber);
            $phoneNumber = str_replace("-", "", $phoneNumber);
            if (!is_numeric($phoneNumber) || strlen((string) $phoneNumber) !== 10) {
                echo json_encode(array("status" => "failed", "msg" => "Invalid phone number"));
                exit();
            }
            $refCode = $this->input->post('ref_code');
            if ($refCode == '') {
                echo json_encode(array("status" => "failed", "msg" => "Empty referral code submitted"));
                exit();
            }
            $user = $this->user_model->get_user_by_ref($refCode);
            if (!is_object($user)) {
                echo json_encode(array("status" => "failed", "msg" => "Invalid referral code"));
                exit();
            }

            $this->load->model('user_package_subscription_model');
            $current_plans = $this->user_package_subscription_model->with('package')->get_many_by(['user_id' => $user->user_id_pk]);
            $this->load->library('Stripe_lib');
            $stripe = new Stripe_lib();
            $subscribed = 0;
            foreach ($current_plans as $current_plan) {
                $check_sub = $stripe->getSubscription($current_plan->sub_id);

                if ($check_sub && $check_sub->status == 'active') {
                    if (($current_plan->package->package == 'seller' || $current_plan->package->package == 'all')) {
                        $subscribed = 1;
                    }
                }
            }

            $canAvail = false;
            // $method = "";//suscription or coupon code of sales rep
            // if($user->parent_role==3){//User is under some sales rep
            //     $canAvail = true;
            //     if (strlen($user->parent_id) < 5) {
            //         $method = "REF".sprintf("%05d", $user->parent_id);
            //     } else {
            //         $method = "REF0".$user->parent_id;
            //     }

            // } else if($subscribed == 1){
            //         $method = 'subscription';
            //         $canAvail = true;
            // } else if($user->customer_id){
            //     $res = $this->_cust_info_by_id($user->customer_id);
            //     //if subscribed
            //     if($res){
            //         $method = 'subscription';
            //         $canAvail = true;
            //     }
            // }

            // if($canAvail){
            $this->load->model('user_default_templates_model');
            $default_color = 'rgb(0,28,61)';
            $default_sub_type = '1';

            $theme_data = $data['theme_data'] = $this->user_default_templates_model->with('theme_color_obj')->get_many_by(['user_id' => $user->user_id_pk, 'theme_type' => 'seller']);
            if ($theme_data) {
                foreach ($theme_data as $theme_data_val) {
                    $default_color = $theme_data_val->theme_color_obj->template_color;
                    $default_sub_type = $theme_data_val->theme_sub_type;
                }
            }

            $theme = array('default_color' => $default_color, 'default_sub_type' => $default_sub_type);

            echo json_encode(array("status" => "success", "user" => $user, 'method' => '', 'theme' => $theme, 'subscribed' => $subscribed));
            exit();
            // } else {
            //     echo json_encode(array("status"=>"failed","msg"=>"This user can not avail quick PDF feature."));
            //     exit();
            // }

        }

    }
    private function _cust_info_by_id($customerId)
    {
        $this->load->library('stripe');
        $stripe = new Stripe(null);
        try {
            $response = json_decode($stripe->customer_info($customerId));
        } catch (Exception $e) {
        }
        if (isset($response) && isset($response->id)) {
            $plans = $stripe->fetchPlansData($response->subscriptions);
            if ($plans) {
                return $plans[0];
            }
        }
        return false;

    }

    public function remove_old_files()
    {
        die;
        $path = FCPATH . 'assets/reports/widget/images/featured/temp/*';
        $files = glob($path);
        $now = time();
        $before_2_days = (60 * 60 * 24 * 2);

        $this->load->model('widget_report_dynamic_data_model');
        $images_array = array();
        $page_contents = $this->widget_report_dynamic_data_model->get_all();
        foreach ($page_contents as $page_content) {
            $temp_data = @unserialize($page_content->data);
            if ($temp_data && count($temp_data)) {
                foreach ($temp_data as $temp_key => $temp_value) {
                    $check_key = $temp_key;
                    $check_val = $temp_value;
                    if (is_array($temp_value) || is_object($temp_value)) {
                        foreach ($temp_value as $temp_key1 => $temp_value1) {
                            if (is_array($temp_value1) || is_object($temp_value1)) {
                                foreach ($temp_value1 as $temp_key2 => $temp_value2) {
                                    $check_key = $temp_key2;
                                    $check_val = $temp_value2;
                                    if (strpos($check_key, 'image') !== false && !empty($check_val)) {
                                        $images_array[] = basename($check_val);
                                    }
                                }
                            } else {
                                $check_key = $temp_key;
                                $check_val = $temp_value;
                                if (strpos($check_key, 'image') !== false && !empty($check_val)) {
                                    $images_array[] = basename($check_val);
                                }
                            }

                        }
                    } elseif (strpos($check_key, 'image') !== false && !empty($check_val)) {
                        $images_array[] = basename($check_val);
                    }
                }
            }
        }
        foreach ($files as $file) {
            if (is_file($file)) {
                if ($now - filemtime($file) >= $before_2_days && !in_array(basename($file), $images_array)) { //
                    unlink($file);
                    echo '<br/>File deleted : ' . $file;
                }
            }
        }
    }
}
