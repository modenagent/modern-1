<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupon_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL ^ E_NOTICE);
    }

    public function get_coupon_count($postData)
    {
        $this->db->select("count(coupon_id_pk) as count");

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("( coupon_code LIKE '%".$value."%' 
                OR coupon_name LIKE '%".$value."%'
                OR coupons_applied_cnt LIKE '%".$value."%'
                OR coupon_amt LIKE '%".$value."%'
                 )", NULL, FALSE);
        }

        $query = $this->db->get('lp_coupon_mst');
        $data = $query->row_array();
        return $data['count'];
    }

    public function get_coupon_data($columns, $postData)
    {
        $order = $columns[$postData['order'][0]['column']];
        $dir = $postData['order'][0]['dir'];

        $this->db->select("coupon_id_pk, coupon_code, coupon_name, start_date, end_date, coupons_applied_cnt, coupon_amt");

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("( coupon_code LIKE '%".$value."%' 
                OR coupon_name LIKE '%".$value."%'
                OR coupons_applied_cnt LIKE '%".$value."%'
                OR coupon_amt LIKE '%".$value."%'
                 )", NULL, FALSE);
        }
        
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        } else {
            $this->db->limit(10, $postData['start']);
        }
        $this->db->order_by($order, $dir);

        $query = $this->db->get('lp_coupon_mst');
        return $query->result_array();
    }
}
?>