<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends Base_model
{
    public function __construct()
    {
            parent::__construct();
            // error_reporting(E_ALL ^ E_NOTICE);
    }   
    
    public function isExistingUser($email) {
            //Get user password from email.
            $pwd = $this->get_password_by_email($email);
            if('' != $pwd) 
                return true;
            else
                return false;
    }

    public function getUserId($email, $password) {
        return $this->login($email, $password);
    }
    public function savePlaneIfo($userId,$plan){
        $plan['user_id'] = $userId;
        $this->db->insert('lp_user_subscriptions',$plan);
    }
    public function setRefCode($userId){
        $refCode = $this->generateRandomCode();
        $_checkSql = "select count(user_id_pk) as count from lp_user_mst where ref_code='{$refCode}'";
        $_res = $this->db->query($_checkSql);
        if($_res->row()->count){
            $this->setRefCode($userId);
        } else {
            $updateSql = "update lp_user_mst set ref_code='{$refCode}' where user_id_pk={$userId}";
            $this->db->query($updateSql);
        }
        return $refCode;
    }
    public function has_ref_code($userId){
        $this->db->select("u.ref_code,u.customer_id,u.parent_id,p.role_id_fk as parent_role");
        $this->db->join('lp_user_mst as p','p.user_id_pk=u.parent_id','left');
        $this->db->where('u.user_id_pk',$userId);
        $query = $this->db->get('lp_user_mst as u');
        $res = $query->row();
        if($res->parent_role==3 && !$res->ref_code){//Set ref code if user is under sales rep
            return $this->setRefCode($userId);
        } elseif($res->customer_id && !$res->ref_code){//check if user is subscribed
            return $this->setRefCode($userId);
        } elseif($res->ref_code){
            return $res->ref_code;
        } else {
            return false;
        }
    }
    private function generateRandomCode() {
        return substr(str_shuffle("123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    }
    public function get_user_by_ref($refCode){
        $this->db->select("u.*,p.role_id_fk as parent_role");
        $this->db->join('lp_user_mst as p','p.user_id_pk=u.parent_id','left');
        $this->db->where('u.ref_code',$refCode);
        $query = $this->db->get('lp_user_mst as u');
        $user = $query->row();
        if(is_object($user)){
            $user->agent = $this->base_model->get_record_by_id('lp_user_mst',array('user_id_pk'=>$user->user_id_pk));
        }
        return $user;
    }
    /**
     * Add new Lead Data
     */
    public function add_lead($leadData){
        $this->base_model->insert_one_row('lp_leads',$leadData);
    }
    public function get_leads($userId){
        $this->db->select("l.created_at,l.phone_number,proj.*");
        $this->db->join('lp_my_listing as proj','l.project_id_fk=proj.project_id_pk');
        $this->db->where('l.user_id_fk',$userId);
        $query = $this->db->get('lp_leads as l');
        $leads = $query->result();
        return $leads;
    }

    public function get_leads_count($userId, $postData)
    {
        $this->db->select('count(l.id) as count');
        $this->db->join('lp_my_listing as proj','l.project_id_fk=proj.project_id_pk');
        $this->db->where('l.user_id_fk',$userId);

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("(l.phone_number LIKE '%".$value."%' 
                OR CONCAT(TRIM(proj.project_id_pk), '-', TRIM(proj.property_owner)) LIKE '%".$value."%'
                OR proj.project_name LIKE '%".$value."%' 
                OR proj.report_type LIKE '%".$value."%'
                )", NULL, FALSE);
        }

        $query = $this->db->get('lp_leads as l');
        $data = $query->row_array();
        return $data['count'];
    }

    public function get_leads_data($userId, $columns, $postData)
    {
        $order = $columns[$postData['order'][0]['column']];
        $dir = $postData['order'][0]['dir'];

        $this->db->select("l.created_at, l.phone_number, proj.*");
        $this->db->join('lp_my_listing as proj','l.project_id_fk=proj.project_id_pk');
        $this->db->where('l.user_id_fk',$userId);

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("(l.phone_number LIKE '%".$value."%' 
                OR CONCAT(TRIM(proj.project_id_pk), '-', TRIM(proj.property_owner)) LIKE '%".$value."%'
                OR proj.project_name LIKE '%".$value."%'  
                OR proj.report_type LIKE '%".$value."%'
                )", NULL, FALSE);
        }

        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        } else {
            $this->db->limit(10, $postData['start']);
        }
        $this->db->order_by($order, $dir);

        $query = $this->db->get('lp_leads as l');
        return $query->result_array();
    }

    function addMarketUpdateTemplatesInDatabase(){
        $templatesData = $this->db->select('report_templates_id_pk, template_icon')
                                ->get('lp_report_templates')
                                ->result_array();
        $templatesDataStringToArray = json_decode('[{"report_templates_id_pk":"1","template_icon_market":"assets/images/works/theme/Prudential_Blue_Market.png"},{"report_templates_id_pk":"2","template_icon_market":"assets/images/works/theme/Coldwell_Banker_Market.png"},{"report_templates_id_pk":"3","template_icon_market":"assets/images/works/theme/Keller_Williams_Burgundy_Market.png"},{"report_templates_id_pk":"4","template_icon_market":"assets/images/works/theme/Realty_Excutives_Blie_Market.png"},{"report_templates_id_pk":"5","template_icon_market":"assets/images/works/theme/Dilbeck_Green_Market.png"},{"report_templates_id_pk":"6","template_icon_market":"assets/images/works/theme/Modern_Black_Market.png"},{"report_templates_id_pk":"7","template_icon_market":"assets/images/works/theme/Modern_Gray_Market.png"},{"report_templates_id_pk":"8","template_icon_market":"assets/images/works/theme/Modern_Orange_Market.png"},{"report_templates_id_pk":"9","template_icon_market":"assets/images/works/theme/Modern_Teal_Market.png"},{"report_templates_id_pk":"10","template_icon_market":"assets/images/works/theme/Purple_like_Intero_Market.png"},{"report_templates_id_pk":"11","template_icon_market":"assets/images/works/theme/Red_Like_Remax_Market.png"},{"report_templates_id_pk":"12","template_icon_market":"assets/images/works/theme/Teal_Like_Exit_Market.png"},{"report_templates_id_pk":"13","template_icon_market":"assets/images/works/theme/Sotheby_Blue_Market.png"},{"report_templates_id_pk":"14","template_icon_market":"assets/images/works/theme/Realty_World_Red_Market.png"}]', true);
        
        $this->db->update_batch('lp_report_templates', $templatesDataStringToArray, 'report_templates_id_pk');
    }

    function getUserDetails($userId, $fields = [])
    {
        $columns = '*';
        if (!empty($fields)) {
            if (is_array($fields)) {
                $columns = implode(',', $fields);
            } else {
                $columns = $fields;
            }
        }

        $this->db->select($columns);
        $this->db->where('user_id_pk', $userId);
        $query = $this->db->get('lp_user_mst');
        return $result = $query->row_array();
    }

    function getUserDetailsByPermission($userId, $fields = [])
    {
        $columns = '*';
        if (!empty($fields)) {
            if (is_array($fields)) {
                $columns = implode(',', $fields);
            } else {
                $columns = $fields;
            }
        }

        $adminId = $this->session->userdata('adminid');
        $roleId = $this->session->userdata('role_id');

        $this->load->library('role_lib');
        if($this->role_lib->is_admin($roleId)) {
            $this->db->join('lp_user_mst s', 's.user_id_pk=user.parent_id and s.role_id_fk=3','left');
        } else if($this->role_lib->is_manager_l1($roleId)) {
            $this->db->join('lp_user_mst s', 's.user_id_pk=user.parent_id and s.role_id_fk=3');
            $this->db->where('s.parent_id',$adminId);
        } else if($this->role_lib->is_sales_rep($roleId)) {
            $this->db->join('lp_user_mst s', 's.user_id_pk=user.parent_id');
            $this->db->where('s.user_id_pk',$adminId);
        }

        $this->db->select($columns);
        $this->db->where('user.user_id_pk', $userId);
        $query = $this->db->get('lp_user_mst user');
        return $result = $query->row_array();
    }

    public function getRandomRefCode() 
    {
        $refCode = '';
        do {
            $refCode = $this->generateRandomCode();
            $_checkSql = "select count(user_id_pk) as count from lp_user_mst where ref_code='{$refCode}'";
            $_res = $this->db->query($_checkSql);
        } while($_res->row()->count);
        return $refCode;
    }

    public function user_reports_count($userId, $postData)
    {
        $this->db->select("count(project_id_pk) as count");
        $this->db->where('user_id_fk', $userId);
        $this->db->where('is_active', 'Y');

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("( CONCAT(TRIM(project_id_pk), '-', TRIM(property_owner)) LIKE '%".$value."%'
                OR project_name LIKE '%".$value."%' 
                OR report_type LIKE '%".$value."%'
                )", NULL, FALSE);
        }

        $query = $this->db->get('lp_my_listing');
        $data = $query->row_array();
        return $data['count'];
    }

    public function user_reports_data($userId, $columns, $postData)
    {
        $order = $columns[$postData['order'][0]['column']];
        $dir = $postData['order'][0]['dir'];

        $this->db->select("project_id_pk, property_owner, project_name, report_type, project_date, report_path");
        $this->db->where('user_id_fk', $userId);
        $this->db->where('is_active', 'Y');

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("( CONCAT(TRIM(project_id_pk), '-', TRIM(property_owner)) LIKE '%".$value."%'
                OR project_name LIKE '%".$value."%' 
                OR report_type LIKE '%".$value."%'
                )", NULL, FALSE);
        }

        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        } else {
            $this->db->limit(10, $postData['start']);
        }
        $this->db->order_by($order, $dir);

        $query = $this->db->get('lp_my_listing');
        return $query->result_array();
    }

    function getUserDetailsByEmail($emailAddress, $fields = [])
    {
        $columns = '*';
        if (!empty($fields)) {
            if (is_array($fields)) {
                $columns = implode(',', $fields);
            } else {
                $columns = $fields;
            }
        }

        $this->db->select($columns);
        $this->db->where('email', $emailAddress);
        $query = $this->db->get('lp_user_mst');
        return $result = $query->row_array();
    }
}          
?>