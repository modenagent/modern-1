<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

class Coupon extends CI_Controller {
	// constructor
	public function __construct()
	{
		parent::__construct();		
	}

	public function apply_coupon($userId = NULL){
        if($userId == NULL)
		  $userId = $this->session->userdata('userid');
        
		$this->load->model('base_model');
		$coupon_code = $this->input->get('code');
		if(empty($coupon_code)){
                    echo json_encode(array('status'=>'failed', 'message'=>'Please enter a valid coupon code'));
		}else{
			//$result = $this->base_model->get_record_by_id('lp_coupon_mst',array('coupon_code'=>$coupon_code));
                    if(strpos($coupon_code,'REF')!==false) {
                        //Quickly Get REF Code coupon. If not available then create
                        $resultCheck = $this->base_model->check_existent("lp_coupon_mst",array('coupon_code'=>$coupon_code));
                        if(!$resultCheck){//Create this coupon code if valid parent ID given
                            $parentId = (int)str_ireplace("REF", "", $coupon_code);
                            $validParentId = $this->base_model->check_existent("lp_user_mst",array('user_id_pk'=>$parentId,'role_id_fk'=>3));
                            if($validParentId){
                                $this->load->model('admin_model');
                                $this->admin_model->add_referral_code($coupon_code);
                            } else {
                               echo json_encode(array('status'=>'failed', 'message'=>'Please enter a valid coupon code'));	
                               exit;
                            }
                        }
                    }
                    $sql = "SELECT c.*,log.redeem_count from lp_coupon_mst as c 
                            LEFT JOIN lp_coupon_redeem_log as log ON log.coupon_id_fk = c.coupon_id_pk AND log.user_id={$userId} AND year(log.created_at) = year(curdate()) AND month(log.created_at) = month(curdate())
                            WHERE c.coupon_code = '{$coupon_code}' 
                            GROUP BY c.coupon_code
                            HAVING (c.end_date >= '".date("Y-m-d")."' OR c.end_date IS NULL)
                            AND (c.limit_user = 0 OR log.redeem_count IS NULL OR c.limit_user > count(log.redeem_count)) ";
                    $sql1 = "SELECT c.*,log.redeem_count from lp_coupon_mst as c 
                            LEFT JOIN lp_coupon_redeem_log as log ON log.coupon_id_fk = c.coupon_id_pk AND year(log.created_at) = year(curdate()) AND month(log.created_at) = month(curdate())
                            WHERE c.coupon_code = '{$coupon_code}' 
                            GROUP BY c.coupon_code
                            HAVING (c.end_date >= '".date("Y-m-d")."' OR c.end_date IS NULL)
                            AND (c.limit_all = 0 OR log.redeem_count IS NULL OR c.limit_all > count(log.redeem_count)) ";
                    $query = $this->db->query($sql);
                    $result = $query->row();
                    $query1 = $this->db->query($sql1);
                    $result1 = $query1->row();
                    if($result && $result1){
                            // DO NOT SET coupon_id TO SESSION
                            //$this->load->library('session');
                            //$this->session->set_userdata('coupon_id',$result->coupon_id_pk);
                            echo json_encode(array('status'=>'success', 'message'=>'Coupon code is validated','coupon_id'=>$result->coupon_id_pk, 'discount'=>$result->coupon_amt));
                    }else{
                            echo json_encode(array('status'=>'failed', 'message'=>'Please enter a valid coupon code'));	
                    }
		}

	}

}

?>