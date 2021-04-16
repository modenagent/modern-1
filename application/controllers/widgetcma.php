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

}
