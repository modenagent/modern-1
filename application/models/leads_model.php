<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leads_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // error_reporting(E_ALL ^ E_NOTICE);
    }

    public function get_lead_count($salesRepId, $postData)
    {
        $this->db->select("count(lead.id) as count");
        $this->db->join('lp_user_mst as user', 'user.user_id_pk = lead.user_id_fk');
        $this->db->where('user.parent_id', $salesRepId);

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("( phone_number LIKE '%".$value."%' 
                OR CONCAT(TRIM(user.first_name), ' ', TRIM(user.last_name)) LIKE '%".$value."%'
                 )", NULL, FALSE);
        }

        $query = $this->db->get('lp_leads as lead');
        $data = $query->row_array();
        return $data['count'];
    }

    public function get_lead_data($salesRepId, $columns, $postData)
    {
        $order = $columns[$postData['order'][0]['column']];
        $dir = $postData['order'][0]['dir'];

        $this->db->select('lead.id, lead.phone_number, lead.created_at, user.user_id_pk, user.first_name, user.last_name, user.email');
        $this->db->join('lp_user_mst as user', 'user.user_id_pk = lead.user_id_fk');
        $this->db->where('user.parent_id', $salesRepId);

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("( phone_number LIKE '%".$value."%' 
                OR CONCAT(TRIM(user.first_name), ' ', TRIM(user.last_name)) LIKE '%".$value."%'
                 )", NULL, FALSE);
        }
        
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        } else {
            $this->db->limit(10, $postData['start']);
        }
        $this->db->order_by($order, $dir);

        $query = $this->db->get('lp_leads as lead');
        return $query->result_array();
    }
}
?>