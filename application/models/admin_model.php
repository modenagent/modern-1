<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL ^ E_NOTICE);
    }
    /* get admin*/
    public function get_admin_login_data($table,$login,$password)
    {
        /* get data from user table */
        $res = $this->db->query("SELECT * FROM $table WHERE user_name='".$login."' and password='".$password."' and role_id_fk != 4");
        // echo $this->db->last_query(); die();
        return $res->row();

    }
    // Market admin model
    public function login()
    {
        $this->db->where('email',$_POST['email']);
        $this->db->where('password',$_POST['password']);
        $query=$this->db->get('admin');
        return $query->result_array();
    }
    public function update()
    {
        $adta=array(
            'firstname'=>$_POST['fname'],
            'lastname'=>$_POST['lname'],
            'email'=>$_POST['email'],
            'password'=>$_POST['pwd'],
            'displayName'=>$_POST['disp']);
        $this->db->where('id',$_POST['sid']);
        $this->db->update('user',$adta);
    }
    public function updatemob()
    {
        $adta=array(
            'name'=>$_POST['name'],
            'email'=>$_POST['email']);
        $this->db->where('id',$_POST['sid']);
        $this->db->update('mobiledata',$adta);
    }
    // get admin password
    public function get_password($data)
    {
        $this->db->select('password');
        $this->db->where('user_id_pk',$data);
        $query = $this->db->get('lp_user_mst');
        // echo $this->db->last_query(); die();
        return $query->result_array();

    }
    // update admin password
    public function update_password($data,$adminId)
    {
        $data = array(
            "password" => $data
        );
        $this->db->where('user_id_pk',$adminId);
        $query = $this->db->update('lp_user_mst',$data);
        return $query;
    }



    public function get_shop_centertype_list()
    {

        $query=$this->db->get('shopping_center_type');
        return $query->result();
    }

    public function get_countries_list()
    {
        $query=$this->db->get('regions');
        return $query->result();
    }
    public function add_entity()
    {
        $this->db->insert('shopping_center', $_POST);
    }


    public function get_sub_list($id)
    {

        $this->db->select('id,name');
        $this->db->where('region_id', $id);
        $query = $this->db->get('subregions');
        return $query->result();

    }

    public function get_shop_list($id)
    {

        $this->db->select('id,name,city');
        $this->db->where('state', $id);
        $query = $this->db->get('shopping_center');
        return $query->result();

    }



    public function get_shop_center()
    {
        $this->db->select('shopping_center.*,regions.country as country_name ,subregions.name as state_name,shopping_center_type.type_name');
        $this->db->join('regions', 'regions.id = shopping_center.country');
        $this->db->join('subregions', 'subregions.id = shopping_center.state');
        $this->db->join('shopping_center_type', 'shopping_center_type.id = shopping_center.type_id');
        $query = $this->db->get('shopping_center');
        return $query->result();
    }
    public function deleteshopping($id){
        $this->db->where('id',$id);
        $this->db->delete('shopping_center');
    }
    public function verify($id){
        $data=array('verify'=>1);
        $this->db->where('id',$id);
        $this->db->update('shopping_center',$data);
    }
    public function unverify($id){
        $data=array('verify'=>0);
        $this->db->where('id',$id);
        $this->db->update('shopping_center',$data);
    }

    // Get Users
    public function manage_user_count($adminId = null, $roleId = 4, $postData)
    {
        $this->db->select('count(main.user_id_pk) as count');
        if(!is_null($adminId)) {
            $this->load->library('role_lib');
            if($roleId==4 && $this->role_lib->is_manager_l1()) {
                $this->db->join('lp_user_mst as child','child.user_id_pk = main.parent_id','left');
                $this->db->where("(main.parent_id = {$adminId} or child.parent_id = {$adminId}) && main.role_id_fk = {$roleId}");
            } else {
                $this->db->where("main.parent_id = {$adminId} && main.role_id_fk = {$roleId}");
                $this->load->library('role_lib');
            }
        } else {
            $this->db->where('main.role_id_fk',$roleId);
        }

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("(main.company_name LIKE '%".$value."%'
                OR main.email LIKE '%".$value."%'
                OR CONCAT(TRIM(main.first_name), ' ', TRIM(main.last_name)) LIKE '%".$value."%'
                 )", NULL, FALSE);
        }

        $query = $this->db->get('lp_user_mst as main');
        $data = $query->row_array();
        return $data['count'];
    }

    // Get Users
    public function manage_user_data($adminId = null, $roleId = 4, $columns, $postData)
    {
        $order = $columns[$postData['order'][0]['column']];
        $dir = $postData['order'][0]['dir'];

        $this->db->select('main.user_id_pk, main.first_name, main.last_name, main.email, main.company_name, main.registered_date, main.is_active');
        if(!is_null($adminId)) {
            $this->load->library('role_lib');
            if($roleId==4 && $this->role_lib->is_manager_l1()) {
                $this->db->join('lp_user_mst as child','child.user_id_pk = main.parent_id','left');
                $this->db->where("(main.parent_id = {$adminId} or child.parent_id = {$adminId}) && main.role_id_fk = {$roleId}");
            } else {
                $this->db->where("main.parent_id = {$adminId} && main.role_id_fk = {$roleId}");
                $this->load->library('role_lib');
            }
        } else {
            $this->db->where('main.role_id_fk',$roleId);
        }

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("(main.company_name LIKE '%".$value."%'
                OR main.email LIKE '%".$value."%'
                OR CONCAT(TRIM(main.first_name), ' ', TRIM(main.last_name)) LIKE '%".$value."%'
                 )", NULL, FALSE);
        }

        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        } else {
            $this->db->limit(10, $postData['start']);
        }
        $this->db->order_by($order, $dir);

        $query = $this->db->get('lp_user_mst as main');
        return $query->result_array();
    }

    // Get Users
    public function manage_user($adminId = null, $roleId = 4)
    {
        $this->db->select('main.*');
        if(!is_null($adminId)) {
            $this->load->library('role_lib');
            if($roleId==4 && $this->role_lib->is_manager_l1()) {
                $this->db->join('lp_user_mst as child','child.user_id_pk = main.parent_id','left');
                $this->db->where("(main.parent_id = {$adminId} or child.parent_id = {$adminId}) && main.role_id_fk = {$roleId}");
            } else {
                $this->db->where("main.parent_id = {$adminId} && main.role_id_fk = {$roleId}");
                $this->load->library('role_lib');
            }
        } else {
            $this->db->where('main.role_id_fk',$roleId);
        }
        $query = $this->db->get('lp_user_mst as main');
        return $query->result();
    }
    // delete user
    public function deleteuser($id)
    {
        $this->db->where('user_id_pk',$id);
        $query = $this->db->delete('lp_user_mst');
        return $query;
    }
    // active user
    public function verifyuser($id)
    {
        $data = array('is_active'=>'Y');
        $this->db->where('user_id_pk',$id);
        $query = $this->db->update('lp_user_mst',$data);
        return $query;
    }
    // inactive user
    public function unverifyuser($id){
        $data = array('is_active'=>'N');
        $this->db->where('user_id_pk',$id);
        $query = $this->db->update('lp_user_mst',$data);
        return $query;
    }
    // product and category record
    public function manage_product()
    {
        $this->db->select('*');
        $this->db->from('lp_product_mst');
        $this->db->join('lp_category_mst','lp_product_mst.category_id_fk = lp_category_mst.category_id_pk','left outer');
        $this->db->group_by("product_id_pk");
        $query = $this->db->get();
        return $query->result();
    }
    // product and category record edit
    public function manage_product_edit($id)
    {
        $this->db->select('*');
        $this->db->from('lp_product_mst');
        $this->db->join('lp_category_mst','lp_product_mst.category_id_fk = lp_category_mst.category_id_pk','left outer');
        $where=array('lp_product_mst.product_id_pk'=> $id);
        $this->db->where($where);
        $this->db->group_by("product_id_pk");
        $query = $this->db->get();
        return $query->result();
    }
    // delete productlp_product_category
    public function deleteproduct($id)
    {
        $this->db->where('product_id_pk',$id);
        $query = $this->db->delete('lp_product_mst');
        return $query;
    }
    public function delete_prod_cat($id)
    {
        $this->db->where('product_id_ck',$id);
        $query = $this->db->delete('lp_product_category');
        return $query;
    }
    // verify user
    public function verifyproduct($id)
    {
        $data=array('is_active'=>'Y');
        $this->db->where('product_id_pk',$id);
        $query = $this->db->update('lp_product_mst',$data);
        return $query;
    }
    public function unverifyproduct($id)
    {
        $data=array('is_active'=>'N');
        $this->db->where('product_id_pk',$id);
        $query = $this->db->update('lp_product_mst',$data);
        return $query;
    }

    public function user_invoice_count($userId, $roleId, $adminId, $postData)
    {
        $this->db->select("count(inv.invoice_id_pk) as count");
        $this->db->join('lp_user_mst user', 'user.user_id_pk=inv.user_id_fk');
        $this->db->join('lp_my_cart cart', 'cart.cart_id_pk=inv.cart_id_fk','left');
        $this->db->join('lp_my_listing lp', 'cart.project_id_fk=lp.project_id_pk','left');
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

        $this->db->where('inv.user_id_fk', $userId);

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("( inv.invoice_num LIKE '%".$value."%' 
                OR inv.invoice_to LIKE '%".$value."%'
                OR inv.invoice_amount LIKE '%".$value."%'
                 )", NULL, FALSE);
        }

        $query = $this->db->get('lp_invoices inv');
        $data = $query->row_array();
        return $data['count'];
    }

    public function user_invoice_data($userId, $roleId, $adminId, $columns, $postData)
    {
        $order = $columns[$postData['order'][0]['column']];
        $dir = $postData['order'][0]['dir'];

        $this->db->select("inv.invoice_date, inv.invoice_num, inv.invoice_to, inv.invoice_amount, inv.invoice_pdf, lp.report_path,lp.report_type,s.first_name as s_first_name, s.last_name as s_last_name, cart.is_success");
        $this->db->join('lp_user_mst user', 'user.user_id_pk=inv.user_id_fk');
        $this->db->join('lp_my_cart cart', 'cart.cart_id_pk=inv.cart_id_fk', 'left');
        $this->db->join('lp_my_listing lp', 'cart.project_id_fk=lp.project_id_pk', 'left');
        $this->load->library('role_lib');
        if($this->role_lib->is_admin($roleId)) {
            $this->db->join('lp_user_mst s', 's.user_id_pk=user.parent_id and s.role_id_fk=3','left');
        } else if($this->role_lib->is_manager_l1($roleId)) {
            $this->db->join('lp_user_mst s', 's.user_id_pk=user.parent_id and s.role_id_fk=3');
            $this->db->where('s.parent_id', $adminId);
        } else if($this->role_lib->is_sales_rep($roleId)) {
            $this->db->join('lp_user_mst s', 's.user_id_pk=user.parent_id');
            $this->db->where('s.user_id_pk', $adminId);
        }

        $this->db->where('inv.user_id_fk', $userId);
        
        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("( inv.invoice_num LIKE '%".$value."%' 
                OR inv.invoice_to LIKE '%".$value."%'
                OR inv.invoice_amount LIKE '%".$value."%'
                 )", NULL, FALSE);
        }
        
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        } else {
            $this->db->limit(10, $postData['start']);
        }
        $this->db->order_by($order, $dir);

        $query = $this->db->get('lp_invoices inv');
        return $query->result_array();
    }

    // user count
    public function user_order_count($roleId, $adminId, $postData)
    {
        $this->load->library('role_lib');
        $this->db->select('count(e.user_id_pk) as count');
        if($this->role_lib->is_manager_l1($roleId)) {
            $this->db->join('`lp_user_mst` s', 'e.parent_id=s.user_id_pk','left');
            $this->db->where('s.parent_id',$adminId);
        } else if($this->role_lib->is_sales_rep($roleId)) {
            $this->db->where('e.parent_id',$adminId);
        }
        $this->db->where('e.role_id_fk', 4);

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("(CONCAT(TRIM(e.first_name), ' ', TRIM(e.last_name)) LIKE '%".$value."%')", NULL, FALSE);
        }

        $query = $this->db->get('lp_user_mst as e');
        $result = $query->row_array();
        return $result['count'];
    }

    // user order count data
    public function user_order_data($roleId, $adminId, $columns, $postData)
    {
        $this->load->library('role_lib');

        $order = $columns[$postData['order'][0]['column']];
        $dir = $postData['order'][0]['dir'];

        $this->db->select('e.user_id_pk, e.first_name, e.last_name, e.is_active, COUNT(inv.invoice_id_pk) AS total_invoices, SUM(inv.invoice_amount) AS total_amount');
        $this->db->join('lp_invoices inv', 'e.user_id_pk=inv.user_id_fk','left');
        if($this->role_lib->is_manager_l1($roleId)) {
            $this->db->join('`lp_user_mst` s', 'e.parent_id=s.user_id_pk','left');
            $this->db->where('s.parent_id',$adminId);
        } else if($this->role_lib->is_sales_rep($roleId)) {
            $this->db->where('e.parent_id',$adminId);
        }
        $this->db->where('e.role_id_fk', 4);

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("(CONCAT(TRIM(e.first_name), ' ', TRIM(e.last_name)) LIKE '%".$value."%')", NULL, FALSE);
        }

        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        } else {
            $this->db->limit(10, $postData['start']);
        }
        $this->db->order_by($order, $dir);
        
        $this->db->group_by('e.user_id_pk');
        $query = $this->db->get('lp_user_mst as e');
        return $query->result_array();
    }

    // user order
    public function user_order($roleId,$adminId)
    {
        $this->load->library('role_lib');
        $this->db->select('e.*,COUNT(inv.invoice_id_pk) AS total_invoices, SUM(inv.invoice_amount) AS total_amount');
        $this->db->join('lp_invoices inv', 'e.user_id_pk=inv.user_id_fk','left');
        if($this->role_lib->is_manager_l1($roleId)) {
            $this->db->join('`lp_user_mst` s', 'e.parent_id=s.user_id_pk','left');
            $this->db->where('s.parent_id',$adminId);
        } else if($this->role_lib->is_sales_rep($roleId)) {
            $this->db->where('e.parent_id',$adminId);
        }
        $this->db->where('e.role_id_fk',4);
        $this->db->group_by('e.user_id_pk');
        $query = $this->db->get('lp_user_mst as e');
        return $query->result();
        
    }
    // user invoices
    public function user_invoices($uid)
    {
        $result = $this->db->query("select * from  lp_shipping ffs right join lp_invoices ffi on ffs.lp_user_id_fk=ffi.user_id_fk where ffi.invoice_num='".$uid."' order by  ffi.invoice_date");
        return $result->result();
    }

    public function view_orders()
    {
        $this->db->select('orders.*,order_detail.*,registration.first_name,registration.last_name,registration.email_id');
        $this->db->join('order_detail', 'order_detail.orderid = orders.serial','left');
        $this->db->join('registration', 'orders.user_id = registration.user_id','left');
        $this->db->from('orders');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_order_detail($id)
    {
        $this->db->select('orders.*,order_detail.*,registration.first_name,registration.last_name,registration.email_id,customers.*,products.product_name,store_info.store_name');
        $this->db->join('order_detail', 'order_detail.orderid = orders.serial');
        $this->db->join('customers', 'orders.customerid = customers.serial','left');
        $this->db->join('registration', 'orders.user_id = registration.user_id','left');
        $this->db->join('products', 'order_detail.productid = products.product_id','left');
        $this->db->join('store_info', 'products.store_id = store_info.store_id','left');
        $this->db->where('order_detail.orderid',$id);
        $this->db->from('orders');
        $query = $this->db->get();
        return $query->result();

    }

    public function view_order_sales()
    {
        $this->db->select('admin_sales.*,store_info.store_name');
        $this->db->join('store_info', 'admin_sales.store_id = store_info.store_id');
        $this->db->where('pending_amount >', 0);
        $this->db->from('admin_sales');
        $query = $this->db->get();
        return $query->result();
    }


    public function update_image($name)
    {
        $row = array('site_image' => $name );
        $this->db->where('id', '1');
        $this->db->update('admin', $row);
    }

    public function store_types_list()
    {
        $query = $this->db->get('store_type');
        return $query->result();
    }

    public function status_list()
    {
        $query = $this->db->get('shopping_center_status');
        return $query->result();
    }

    public function add_status($name)
    {
        $row = array('status_name' => $name );
        $this->db->insert('shopping_center_status', $row);
    }

    public function delete_status($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('shopping_center_status');
    }

    public function edit_status($data)
    {
        $row = array('status_name' => $data['status_name_edit'] );
        $this->db->where('id', $data['id']);
        $this->db->update('shopping_center_status',$row);
    }

    public function getUsername($id){
        return $this->db->query("SELECT user_name FROM lp_user_mst WHERE user_id_pk=".$id)->row()->user_name;
    }


    public function add_type($name)
    {
        $row = array('type' => $name );
        $this->db->insert('store_type', $row);
    }

    public function delete_type($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('store_type');
    }

    public function edit_type($data)
    {
        $row = array('type' => $data['type_name_edit'] );
        $this->db->where('id', $data['id']);
        $this->db->update('store_type',$row);
    }

    public function product_detail($id)
    {
        $this->db->where('product_id', $id);
        $query = $this->db->get('products');
        return $query->result();
    }

    public function add_to_deals($data)
    {
        $this->db->insert('hot_deals', $data);

    }

    public function view_deals()
    {
        $this->db->select('hot_deals.*,products.product_name,store_info.store_name');
        $this->db->join('products', 'hot_deals.product_id = products.product_id');
        $this->db->join('store_info', 'products.store_id = store_info.store_id');
        $query = $this->db->get('hot_deals');
        return $query->result();
    }
    public function deal_detail($id)
    {
        $this->db->select('hot_deals.*,products.product_name,store_info.store_name');
        $this->db->join('products', 'hot_deals.product_id = products.product_id');
        $this->db->join('store_info', 'products.store_id = store_info.store_id');
        $this->db->where('id', $id);
        $query = $this->db->get('hot_deals');
        return $query->result();
    }

    public function product_edit_deals($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('hot_deals', $data);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }


    public function all_stores()
    {
        $query = $this->db->get("store_info");
        return $query->result();
    }

    public function update_store_of_day()
    {
        $row = array('store_of_day_id' => $_POST['store_id'],
            'video_url' => $_POST['video_url'],
            'front_div' => $_POST['front_div']
        );
        $this->db->where('id', 1);
        $this->db->update('admin', $row);
    }


    public function show_contents()
    {
        $this->db->where('id', 1);
        $query = $this->db->get('admin');
        return $query->result();
    }

    public function update_contents()
    {
        $this->db->where('id', 1);

        $this->db->update('admin',$_POST);

    }
    /**
     * Add coupon if does not existx
     */
    public function add_referral_code($code){
        $this->db->where('coupon_code',$code);
        $query = $this->db->get('lp_coupon_mst');
        $data =  $query->row();
        if(empty($data)){//Create such coupon
            $insertData = array(
                'coupon_code'=>$code,
                'coupon_name'=>$code,
                'coupon_descr'=>"Coupon for rererral program",
                'start_date'=>date("Y-m-d"),
                'end_date'=>null,
                'uses_per_user'=>10,
                'coupon_amt'=>3,
            );
            $this->db->insert('lp_coupon_mst',$insertData);
        }
    }
    /**
     * Get Leads for a sales rep
     */
    public function getLeads($salesRepId){
        $this->db->select('l.*,u.first_name,u.last_name,u.email');
        $this->db->join('lp_user_mst as u', 'u.user_id_pk = l.user_id_fk');
        $this->db->where('u.parent_id', $salesRepId);
        $query = $this->db->get('lp_leads as l');
        return $query->result();
    }

    // Get Users
    public function having_user_access($userId, $adminId, $adminRoleId, $roleId)
    {
        $this->db->select('main.user_id_pk');
        $this->load->library('role_lib');
        if ($adminRoleId == '1') {
            $this->db->where("main.role_id_fk = {$roleId}");
        } else {
            if($roleId==4 && $this->role_lib->is_manager_l1()) {
                $this->db->join('lp_user_mst as child','child.user_id_pk = main.parent_id','left');
                $this->db->where("(main.parent_id = {$adminId} or child.parent_id = {$adminId}) && main.role_id_fk = {$roleId}");
            } else {
                $this->db->where("main.parent_id = {$adminId} && main.role_id_fk = {$roleId}");
            }
        }
        
        $this->db->where("main.user_id_pk = {$userId}");
        $query = $this->db->get('lp_user_mst as main');
        if ($query->num_rows()>0) {
            return true;
        } else {
            return false;
        }
    }

// class ends here
}
?>