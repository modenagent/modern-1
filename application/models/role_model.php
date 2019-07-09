<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Role management model
 * @author 	 Avtar Gaur <developer.avtargaur@gmail.com>
 */
class Role_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ E_NOTICE);
    }
    /**
     * Get array of access paths for a admin role id
     * @param integer $role_id
     * @return array
     */
    public function get_access_paths($role_id) {
        $this->db->select('func_id_fk');
        $this->db->where('role_id_fk',$role_id);
        $res = $this->db->get('lp_role_func')->result_array();
        $accessPaths = array_column($res, 'func_id_fk');
        return $accessPaths;
    }
    /**
     * Get All manager level 1 users
     * @return array
     */
    public function get_companies($status='') {
        $this->db->select("user_id_pk, first_name, last_name,company_name,company_add");
        $this->db->where('role_id_fk',2);
        if (!empty($status)) {
            $this->db->where('is_active', $status);
        }
        $res = $this->db->get('lp_user_mst')->result_array();
        return $res;
    }
    /**
     * Get All Sales Rep users
     * @param intger $parentId To get Sale Reps under a parent
     * @return array
     */
    public function get_sales_reps($parentId = null, $status='') {
        $this->db->select("user_id_pk, first_name, last_name,company_name,company_add");
        $this->db->where('role_id_fk',3);
        if(!is_null($parentId)){
            $this->db->where('parent_id',$parentId);
        }
        if (!empty($status)) {
            $this->db->where('is_active', $status);
        }
        $res = $this->db->get('lp_user_mst')->result_array();
        return $res;
    }

}