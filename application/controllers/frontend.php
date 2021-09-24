<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
// require APPPATH.'/libraries/REST_Controller.php';
class Frontend extends CI_Controller
{
   // Initialize Constructor Here
    function __construct() 
    {
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('user_model');
    }


    function getmonths()
    {
            for ($i = 1; $i <= 12; $i++) {
                $months[] = date("m/d/Y", strtotime( date( 'Y-m-01' )." -$i months"));
            }
            echo '<pre>';
            print_r($months);
            echo '</pre>';
    }


    function gencaptcha()
    {
            $this->load->helper('captcha');
            create_image();
            $this->load->library('session');
            echo '<img src="'.base_url('assets/captcha/image'.$this->session->userdata('timestamp')).'.png">';
    }

    function genpdf()
    {
            $this->load->library('mpdf');
            $mpdf=new mPDF('','Letter','','',0,0,0,0); 
  
            $html = $this->load->view('pdf_template','',true);

            $mpdf->SetFooter('<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color:red;"><tr><td bg="red" ><table width="89%" border="0" cellspacing="0" cellpadding="15" style="" align="center"><tr><td align="left" width="50%" bgcolor="red" style="color:#fff;"><strong >Listing Proposal</strong> <p>&nbsp; </p>sdfdsfsd dsfds</td><td align="right" bgcolor="red" style="color:#fff; margin-right:150px;">Page {PAGENO}</td></tr></table></td></tr></table>');

            $mpdf->WriteHTML($html);
            $pdfFileName = 'temp/'.uniqid().time().'.pdf';
            $mpdf->Output($pdfFileName,'F'); 
            $this->load->view('pdf_template');
    }

    function sendmail()
    {
        $config = Array(
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.gmail.com',
    'smtp_port' => 465,
    'smtp_user' => 'info@modernagent.io',
    'smtp_pass' => 'admin#123',
    'mailtype'  => 'html', 
    'charset'   => 'iso-8859-1'
);

$this->load->library('email');

$this->email->from("info@modernagent.io", "Jerry");
$this->email->to('info@modernagent.io'); 
$this->email->subject("Email Testing");
$this->email->message('Testing the email class.');  

$result = $this->email->send();
var_dump($result);
echo $this->email->print_debugger();die;
            $this->load->helper('sendemail');
            $res = send_email('info@modernagent.io','noreply','info@modernagent.io','Email Testing','Testing the email class.');
            var_dump($res);die;
    }


    // frontend view
    public function index2()
    {
            $data['title'] = "Farming Flyers";

            $data['category'] = $this->base_model->all_records('lp_category_mst'); 
            // new flyers
            $data['newFlyers1'] = $this->base_model->getNewFlyer('lp_product_mst','4','0');
            $data['newFlyers2'] = $this->base_model->getNewFlyer('lp_product_mst','4','4');
            $data['newFlyers3'] = $this->base_model->getNewFlyer('lp_product_mst','4','8');

            $data['mostFlyers1'] = $this->base_model->getNewFlyer2('lp_product_mst','4','0');
            $data['mostFlyers2'] = $this->base_model->getNewFlyer2('lp_product_mst','4','4');
            $data['mostFlyers3'] = $this->base_model->getNewFlyer2('lp_product_mst','4','8');

            $data['bestFlyers1'] = $this->base_model->getNewFlyer3('lp_product_mst','4','0');
            $data['bestFlyers2'] = $this->base_model->getNewFlyer3('lp_product_mst','4','4');
            $data['bestFlyers3'] = $this->base_model->getNewFlyer3('lp_product_mst','4','8');

            $this->load->view('frontend/header',$data);
            $this->load->view('frontend/index',$data);
            $this->load->view('frontend/footer',$data);    
    }

   // frontend view
    public function index()
    {
        if (defined('CI_REQUEST') && CI_REQUEST == 'external')
        {
            return;
        }
            if($this->session->userdata('userid')){
                redirect(base_url().'user/dashboard');
            }
            $data['title'] = "Farming Flyers";
            
            $this->load->library('session');

            $data['category'] = $this->base_model->all_records('lp_category_mst'); 

            // new flyers
            $data['newFlyers1'] = $this->base_model->getNewFlyer('lp_product_mst','4','0');
            $data['newFlyers2'] = $this->base_model->getNewFlyer('lp_product_mst','4','4');
            $data['newFlyers3'] = $this->base_model->getNewFlyer('lp_product_mst','4','8');

            $data['mostFlyers1'] = $this->base_model->getNewFlyer2('lp_product_mst','4','0');
            $data['mostFlyers2'] = $this->base_model->getNewFlyer2('lp_product_mst','4','4');
            $data['mostFlyers3'] = $this->base_model->getNewFlyer2('lp_product_mst','4','8');

            $data['bestFlyers1'] = $this->base_model->getNewFlyer3('lp_product_mst','4','0');
            $data['bestFlyers2'] = $this->base_model->getNewFlyer3('lp_product_mst','4','4');
            $data['bestFlyers3'] = $this->base_model->getNewFlyer3('lp_product_mst','4','8');
            $data['body_class'] = "home-all"; 

            $this->load->model('package_model');
            $packages = $this->package_model->get_all_packages_price();
            $data['report_price'] = $packages['reports'];
            $data['monthly_price'] = $packages['monthly'];

            $this->load->view('frontend/header',$data);
            $this->load->view('frontend/index',$data);
            $this->load->view('frontend/footer',$data);
    }



    function change_captcha(){
            $this->load->helper('captcha');
            create_image();
            $this->load->library('session');
            echo json_encode(array('status'=>'success','timestamp'=>$this->session->userdata('timestamp')));
    }
    
    public function contactreq(){
            $this->load->library('session');
            $this->load->helper('form');
            if(isset($_GET['flag'])){
                if($this->session->userdata('captcha_string'.$this->input->get('flag'))==$this->input->get('captcha')){
                    $this->load->model('base_model');
                    $data = array(
                                    'name'=>$this->input->get('senderName'),
                                    'email'=>$this->input->get('senderEmail'),
                                    'message'=>$this->input->get('message')
                                  );
                    $this->base_model->insert_one_row('contactus',$data);
                    echo json_encode(  array('status' =>'success' ,'msg'=>'Thanks, Your request submitted. We will get back to your shortly!' ));
                }else{
                    echo json_encode(  array('status' =>'failed' ,'msg'=>'Invalid Characters Please reenter captcha image characters!' ));
                }
            }
            else{
                echo json_encode(  array('status' =>'failed' ,'msg'=>'Invalid request parameters' ));
            }
    }


    // frontend view
    public function login()
    { 
            if($this->session->userdata('userid')){
                redirect(base_url().'user/dashboard');
            }
            
            // load form helper and validation library
            $this->load->helper('form');
            $this->load->library('form_validation');

            // set validation rules
            $this->form_validation->set_rules('uemail', 'Email', 'required');
            $this->form_validation->set_rules('upass', 'Password', 'required'); 

            if ($this->form_validation->run() == false) { 
                // validation not ok, send validation errors to the view
                $this->load->view('frontend/header');
                $this->load->view('frontend/login');
                $this->load->view('frontend/footer');
            } else { 
                //die("Depreicated. Post request is being handeled from auth controller");
                redirect(base_url().'user/dashboard');
            }
    }

      // frontend view
    public function register()
    {
            if($this->session->userdata('userid')){
                redirect('user/dashboard');
            }

             // load form helper and validation library
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_message('is_unique', 'This %s already exists');
            $this->form_validation->set_message('check_refcode', 'Invalid %s');
            $data['err_message'] ='';
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
              
            if($this->form_validation->run()) { 
                // set variables from the form
                $ref_code = $this->input->post('ref_code');
                if($ref_code==''){
                    $parentId = (int)$this->input->post('parent_id');
                } else {
                    $parentId = (int)str_ireplace("REF", "", $ref_code);
                }
                $parentId = isset($parentId)?$parentId:0;
                $encrypted_password = password_hash($this->input->post('user_pass'),PASSWORD_DEFAULT);
                $user = array(
                    'password' => $encrypted_password,
                    'first_name' => $this->input->post('fname'),
                    'last_name' => $this->input->post('lname'),
                    'email'=>$this->input->post('uemail'),
                    'phone' => $this->input->post('uphone'),
                    'parent_id' => $parentId,
                    'company_logo'=>  '',
                    'company_phone'=>  '',
                    'company_suite' => '',
                    'company_state' => '',
                    'user_credits' => 0,
                    'company_name'=>  $this->input->post('cname'),
                    'company_add' => $this->input->post('caddress'),
                    'company_city' => $this->input->post('ccity'),
                    'comapny_zip' => $this->input->post('czipcode'),
                    'registered_date' => date('Y-m-d H:i:s', time()),
                    'is_active' => 'Y',
                );
                $resp = $this->base_model->insert_one_row('lp_user_mst', $user);
                if($resp){
                    $lastId = $this->base_model->get_last_insert_id();
                    $this->session->set_userdata('userid', $lastId);
                    $userName = $this->input->post('fname').' '.$this->input->post('lname');
                    $name = 'Administrator';
                    $message = $this->load->view('mails/registration_success','',true);
                    
                    $send = $this->base_model->queue_mail($this->input->post('uemail'),'Modern Agent Registration',$message);
                    $doSubscribe = $this->input->post('do_subscribe');
                    if($doSubscribe){
                        redirect(site_url('user/myaccount#tabs-5'));
                        exit;
                    }else {
                        redirect(site_url('user/dashboard'));
                        exit;
                    } 
                }else{
                    $data['err_message'] = !isset($data['err_message'])?$data['err_message']:'Insert faild.';
                }              
            }
            $this->load->view('frontend/header');
            $this->load->view('frontend/register', $data);
            $this->load->view('frontend/footer');
    }

    // flyer list   
    public function flyerlist()
    {
            if($_POST["type"] == "flyerlist"){                

                $config["base_url"] = base_url() . "frontend/flyerlist";
                $config["total_rows"] = $this->base_model->record_count('lp_product_mst');
                $config["per_page"] = 18;
                $config["uri_segment"] = 3;

                $this->pagination->initialize($config);

                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $category = ($this->uri->segment(4)) ? $this->uri->segment(4) : '0';

                $myflyers = $this->base_model->flyers_list2($config["per_page"], $page, $category); 

                $flyerlist = '';          
                //$flyerlist .='<div>';
                foreach ($myflyers as $flyer) {
                    $flyerlist .='<div class=" portfolio-item filter-web '.$flyer->category_id_fk.'">
                                    <div  class="thumbnail">
                                      <div class="thumb-cover">
                                        <img src="'.site_url().$flyer->product_image.'">
                                      </div>
                                    </div>                                          
                                    <div class="row cap-head">

                                      <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" >
                                        <b class="itsd">'.$flyer->product_name.'</b>
                                      </div>
                                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                                        <a href="javascript:;" class="btn btn-xs"><i class="fa fa-heart-o"></i></a>
                                      </div>
                                    </div>
                                  </div>';
                }
                $flyerlist .='<!--<script src="'.site_url().'assets/js/isotope.pkgd.min.js"></script>-->
                              <!--<script src="'.site_url().'assets/js/jquery.isotope.min.js"></script>
                              <script src="'.site_url().'assets/js/main.js"></script>-->
                              ';

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
    }

    // flyer list   
    public function pagination($start=0,$category=0)
    {      
            $config["base_url"] = "";
            $config["total_rows"] = $this->base_model->flyers_list2_count(18, $start,$category);
            $config["per_page"] = 18;
            $config["uri_segment"] = 3;
            $config['full_tag_open'] = "<ul class='pagination pagination-small'>";
            $config['full_tag_close'] ="</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $config['anchor_class'] = 'class="pagination_link"';

            $this->pagination->initialize($config);

            echo $this->pagination->create_links();
    }

    // about us page view
    public function aboutus()
    {
            $data['title'] = "About Us";
            $this->load->view('frontend/header_static',$data);
            $this->load->view('frontend/about');
            $this->load->view('frontend/footer');
    }
    // how it works page view
    public function howitworks()
    {
            $data['title'] = "How it works";
            $this->load->view('frontend/header_static',$data);
            $this->load->view('frontend/howitworks');
            $this->load->view('frontend/footer');
    }
    // super simple pricing
    public function simplepricing()
    {
            $data['title'] = "Super Simple Pricing";
            $this->load->view('frontend/header_static',$data);
            $this->load->view('frontend/simplepricing');
            $this->load->view('frontend/footer');
    }
    // FAQ
    public function faq()
    {
            $data['title'] = "FAQ";
            $this->load->view('frontend/header_static',$data);
            $this->load->view('frontend/faq');
            $this->load->view('frontend/footer');
    }
    // contact us
    public function contactus()
    {
            $data['title'] = "Contact Us";
            $this->load->view('frontend/header_static',$data);
            $this->load->view('frontend/contactus');
            $this->load->view('frontend/footer');
    }
    
    function check_refcode($ref_code){
        if($ref_code=='') return true;//Allow blank ref code
        $parentId = (int)str_ireplace("REF", "", $ref_code);
        return $this->base_model->check_existent("lp_user_mst",array('user_id_pk'=>$parentId));
    }
    public function affiliate_program()
    {
            if($this->session->userdata('userid')){
                redirect(base_url().'user/dashboard');
            }
            $data['title'] = "Farming Flyers";
            $this->load->library('session');
            
            $this->load->view('frontend/header',$data);
            $this->load->view('frontend/affiliate_program',$data);
            $this->load->view('frontend/footer',$data);
    }
    public function release_notes()
    {
            if($this->session->userdata('userid')){
                redirect(base_url().'user/dashboard');
            }
            $data['title'] = "Farming Flyers";
            $this->load->library('session');
            
            $this->load->view('frontend/header',$data);
            $this->load->view('frontend/release_notes',$data);
            $this->load->view('frontend/footer',$data);
    }
    // frontend view
    public function quick_pdf($code ='')
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
            $data['title'] = "Moder Agent";
            $data['code'] = $code;
            
            $this->load->library('session');

            $this->load->view('frontend/header_cma',$data);
            $this->load->view('frontend/quick_pdf',$data);
            $this->load->view('frontend/footer_cma',$data);
    }
    public function cma_widget(){        
        $requestData = $this->input->get();
        if(array_key_exists('callback', $requestData )){
            $html=$this->load->view('frontend/quick_pdf',array('isWidget' => 1),true);
            $data['html'] = $html;
            header('Content-Type: text/javascript; charset=utf8');
            header('Access-Control-Allow-Origin: http://localhost/mylistingpitch');
            header('Access-Control-Max-Age: 3628800');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

            $callback = $requestData['callback'];
            echo $callback.'('.json_encode($data).');';
        }else{
            $html=$this->load->view('frontend/quick_pdf',array(),true);
            $data['html'] = $html;
            // normal JSON string or show an error
            header('Content-Type: application/json; charset=utf8');
            $data = json_encode("ERROR: you must pass a callback parameter");
            echo $data;
        }
        exit;
        
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
    private function _cust_info_by_id($customerId){
        $this->load->library('stripe');
        $stripe = new Stripe( NULL );
        try{
            $response = json_decode($stripe->customer_info($customerId));
        }catch(Exception $e){
        }
        if(isset($response) && isset($response->id)) {
            $plans = $stripe->fetchPlansData($response->subscriptions);
            if($plans){
                return $plans[0];
            }
        } 
        return false;
        
    }

    public function remove_old_files()
    {
        die;
        $path = FCPATH.'assets/reports/widget/images/featured/temp/*';
        $files = glob($path);
        $now   = time();
        $before_2_days = (60 * 60 * 24 * 2);

        $this->load->model('widget_report_dynamic_data_model');
        $images_array = array();
        $page_contents = $this->widget_report_dynamic_data_model->get_all();
        foreach ($page_contents as $page_content) {
            $temp_data = @unserialize($page_content->data);
            if($temp_data && count($temp_data)) {
                foreach ($temp_data as $temp_key => $temp_value) {
                    $check_key = $temp_key;
                    $check_val = $temp_value;
                    if(is_array($temp_value) || is_object($temp_value)) {
                        foreach ($temp_value as $temp_key1 => $temp_value1) {
                            if(is_array($temp_value1) || is_object($temp_value1)) {
                                foreach ($temp_value1 as $temp_key2 => $temp_value2) {
                                    $check_key = $temp_key2;
                                    $check_val = $temp_value2;
                                    if (strpos($check_key, 'image') !== false && !empty($check_val)) {
                                        $images_array[]=basename($check_val);
                                    }
                                }
                            }
                            else {
                                $check_key = $temp_key;
                                $check_val = $temp_value;
                                if (strpos($check_key, 'image') !== false && !empty($check_val)) {
                                        $images_array[]=basename($check_val);
                                    }
                            }
                            
                        }
                    }
                    elseif (strpos($check_key, 'image') !== false && !empty($check_val)) {
                        $images_array[]=basename($check_val);
                    }
                }
            }
        }
        foreach ($files as $file) {
            if (is_file($file)) {
              if ($now - filemtime($file) >= $before_2_days && !in_array(basename($file), $images_array)) { // 
                unlink($file);
                echo '<br/>File deleted : '.$file;
              }
            }
        }
    }
}
?>