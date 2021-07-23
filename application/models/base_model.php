<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_model extends CI_Model
{
    /* load constructors */
    public function __construct()
    {
            parent::__construct();
            // error_reporting(E_ALL ^ E_NOTICE);
    }
    /* check data existence in tables */
    public function check_existent($table,$where)
    {
            $query = $this->db->get_where($table,$where);
            if($query->num_rows()>0){            
                return TRUE;
            } else {               
                return FALSE;
            }
    }

    function order_list($table,$roleId,$adminId){
        $this->load->library('role_lib');
        $sql = "SELECT * FROM {$table} main join lp_user_mst as usr on main.user_id_fk=usr.user_id_pk";
        if($this->role_lib->is_sales_rep($roleId)) {
            $sql.=" and usr.parent_id = ".$adminId;
        } else if($this->role_lib->is_manager_l1($roleId)){
            $sql = "SELECT * FROM {$table} as main join lp_user_mst as usr on main.user_id_fk=usr.user_id_pk
                    join lp_user_mst as s on s.user_id_pk=usr.parent_id
                    WHERE s.parent_id=".$adminId;
        }
        
        $query = $this->db->query($sql);
            return $query->result();
    }
    /* Get Last 10 reports */
    

    /*  get recrod count */
    public function record_count($table)
    {
            return $this->db->count_all($table);
    }

    /*  get recrod count */
    public function record_count2($table, $category )
    {   
            if($category!=0){
                $this->db->where('category_id_fk', $category);
            }
            return $this->db->count_all($table);
    }


    /* insert data into table */
    public function insert_one_row($table,$data)
    {
            return $this->db->insert($table,$data);
    }
    /* insert multiple row in one time */
    public function insert_multiple_row($table,$data) 
    {
            return $this->db->insert_batch($table,$data); 
    }
    /* get max record with alias */
    public function get_max_record_withalias($table,$columname,$alias)
    {
            $this->db->select_max($columname,$alias);
            $query=$this->db->get($table);
            return $query->row(); 
    }
    /*  retrun only one row */
    public function get_record_by_id($table,$data, $fields='')  
    {
        $columns = '*';
        if (!empty($fields)) {
            if (is_array($fields)) {
                $columns = implode(',', $fields);
            } else {
                $columns = $fields;
            }
        } else {
            $columns = '*';
        }
        $this->db->select($columns);
        $query = $this->db->get_where($table,$data);
        // echo $this->db->last_query(); die();
        return $query->row();
    }
    /* get all record by condition; returns only one row */
    public function get_all_record_by_condition($table,$data)
    {
            $query = $this->db->get_where($table,$data);
            // echo $this->db->last_query();
            return $query->result();
    }
    // result array
    public function get_record_result_array($table,$data, $fields='')
    {
        $columns = '*';
        if (!empty($fields)) {
            if (is_array($fields)) {
                $columns = implode(',', $fields);
            } else {
                $columns = $fields;
            }
        } else {
            $columns = '*';
        }
        $this->db->select($columns);
        $query = $this->db->get_where($table,$data);
        return $query->result_array();
    }
    // result array
    public function get_record_result_array_by($table,$data,$column,$order="asc")
    {
        $this->db->from($table);
        $this->db->where($data);
        $this->db->order_by($column, $order);
        $query = $this->db->get();
        return $query->result_array();
    }
    /* get only email from nsf_user table */
    public function getUserEmail($id = null)
    {
            $this->db->select('user_name,primary_email');
            $this->db->from('nsf_user');
            $this->db->where('user_id_pk', $id);           
            return $this->db->get()->result();
    }
    /* LOGIN WITH USERNAME OR EMAIL AND PASSWORD; retruns only one row */
    public function get_login_data($table,$login,$password)
    {
            /* get data from user table */
            $where['email'] = $login;
            $row = $this->db->get_where($table,$where)->row();
            
            // $row = $result->row();

            if($row) {
                if(password_verify($password,$row->password)) {
                    return $row;
                }
                else {
                    return false;
                }
            }
            return false;
    }
     /* LOGIN WITH userId retruns only one row */
    public function get_login_data_from_id($table, $column, $userId)
    {
            /* get data from user table */
            $res = $this->db->query("SELECT * FROM $table WHERE $column=$userId");
            return $res->row();
    }
    public function login($email,$password)
    {
            $this->db->select('user_id_pk');
            $this->db->where('email',$email);
            $this->db->where('password', $password);
            $query = $this->db->get('lp_user_mst');
            if($query == NULL) return '';
            return $query->row()->user_id_pk;
    }
    public function is_expired($table,$login,$password)
    {
            $expiry_date = date('Y-m-d H:i:s', time());
            $res = $this->db->query("SELECT * FROM $table WHERE primary_email='".$login."' and user_password='".$password."' and expiry_date >= '".$expiry_date."' ");
            $getRec = $res->num_rows();
            if($getRec < 1){
                $where = array(
                    'primary_email' => $login,
                    'user_password' => $password
                );
                $this->update_record_by_id($table, array('is_active'=>'N'), $where);
                return 1;
            }else{
                return 0;
            }        
    }
    /* retrun only one or many record  */
    public function get_all_record_by_id($table,$where,$column_name=null,$ordery_by=null)
    {
            if(!empty($column_name)&&!empty($ordery_by)){
                   $this->db->order_by($column_name,$ordery_by);
            }
            $query=$this->db->get_where($table,$where);
            return $query->result();
    }
    /* get last inserted id */ 
    public function get_last_insert_id()
    {
            return $this->db->insert_id(); 
    }
    /* update record by id */
    public function update_record_by_id($table,$data,$where)
    { 
            $query = $this->db->update($table,$data,$where);
            return $this->db->affected_rows();
    }
    /* update record by id with conditions */
    public function update_record_by_id1($table,$data,$where)
    {
            $this->db->update($table,$data,$where);
            return $this->db->affected_rows(); 
    }   
    /* count all rows from table */
    public function countrow($table)
    {
            return $this->db->count_all($table);
    }
    /* count all rows from table with conditions */
    public function countrows($table)
    {
            $this->db->where('usertype','user');
            $this->db->or_where('usertype','c_admin');
            return $this->db->count_all($table);
    }
    /* function for count only users */
    public function countusers($column, $userType,$roleId,$adminId,$user_role_id)
    {
        $this->load->library('role_lib');
        $sql = "SELECT COUNT(user_id_pk) AS count_user FROM lp_user_mst WHERE $column = '".$userType."' and role_id_fk={$user_role_id}";
        if($this->role_lib->is_sales_rep($roleId)) {
            $sql.=" and parent_id = ".$adminId;
        } else if($this->role_lib->is_manager_l1($roleId)){
            $sql = "SELECT COUNT(main.user_id_pk) AS count_user 
                    FROM lp_user_mst as main
                    join lp_user_mst as s on s.user_id_pk=main.parent_id
                    WHERE main.$column = '".$userType."' and main.role_id_fk = '".$user_role_id."' and s.parent_id=".$adminId." and main.role_id_fk=4";
        }
        $countResult = $this->db->query($sql);
        return $countResult->row();
    }
    public function countreports($roleId,$adminId)
    {
        $this->load->library('role_lib');
        $sql = "SELECT COUNT(main.project_id_pk) AS count_reports FROM lp_my_listing as main "
                . " join lp_my_cart as c on c.project_id_fk=main.project_id_pk join lp_invoices as inv on c.cart_id_pk=inv.cart_id_fk ";
        if($this->role_lib->is_admin($roleId)) {
            $sql.=" WHERE c.is_success='Y'";
        }elseif($this->role_lib->is_sales_rep($roleId)) {
            $sql.=" join lp_user_mst as e on e.user_id_pk=main.user_id_fk WHERE e.parent_id={$adminId} and c.is_success='Y'";
        } else if($this->role_lib->is_manager_l1($roleId)){
            $sql.=" join lp_user_mst as e on e.user_id_pk=main.user_id_fk
                    join lp_user_mst as s on s.user_id_pk=e.parent_id
                    WHERE s.parent_id={$adminId} and c.is_success='Y'";
        }
        $countResult = $this->db->query($sql);
        return $countResult->row();
    }
    public function count_new_users($table, $column, $userType,$adminId = null)
    {
        if(!is_null($adminId)) {
            $countResult = $this->db->query("SELECT COUNT( * ) AS count_user FROM $table WHERE $column >= '".$userType." AND parent_id = ".$adminId);
        } else {
            $countResult = $this->db->query("SELECT COUNT( * ) AS count_user FROM $table WHERE $column >= '".$userType."'");
        }
        return $countResult->row();
    }
    public function count_new_signup($adminId=null,$roleId=null){
        $this->load->library('role_lib');
        $sql = "SELECT COUNT(*) AS count_user FROM lp_user_mst WHERE registered_date > DATE_SUB(NOW(), INTERVAL 30 DAY) and role_id_fk=4 ";
        if($this->role_lib->is_sales_rep($roleId)) {
            $sql.=" and parent_id = ".$adminId;
        } else if($this->role_lib->is_manager_l1($roleId)){
            $sql = "SELECT COUNT(main.user_id_pk) AS count_user 
                    FROM lp_user_mst as main
                    join lp_user_mst as s on s.user_id_pk=main.parent_id
                    WHERE main.registered_date > DATE_SUB(NOW(), INTERVAL 30 DAY) and s.parent_id=".$adminId." and main.role_id_fk=4";
        }
        $countResult = $this->db->query($sql);
        return $countResult->row();
    }
    
    public function count_online_users($roleId=null,$adminId=null){
        $loggedIn = $this->db->query("SELECT user_data FROM ci_sessions where user_data!=''");
        $userIds = array();
        foreach ($loggedIn->result() as $info) {
            $userData = unserialize($info->user_data);
            if(isset($userData['userid'])) {
                $userIds[] = $userData['userid'];
            }
        }
        if(is_null($roleId)) {
            return count($userIds);
        }
        else if(!empty($userIds)){
            $this->load->library('role_lib');
            $sql = "SELECT COUNT(*) AS count_user FROM lp_user_mst WHERE user_id_pk in (".implode(",", $userIds).") ";
            if($this->role_lib->is_sales_rep($roleId)) {
                $sql.=" and parent_id = ".$adminId;
            } else if($this->role_lib->is_manager_l1($roleId)){
                $sql = "SELECT COUNT(main.user_id_pk) AS count_user 
                        FROM lp_user_mst as main
                        join lp_user_mst as s on s.user_id_pk=main.parent_id
                        WHERE main.user_id_pk in (".implode(",", $userIds).")  and s.parent_id=".$adminId;
            }
            $countResult = $this->db->query($sql);
            return $countResult->row()->count_user;
        }
        else {
            return 0;
        }
    }
    
    /* count row by ids */
    public function count_row_by_ids($table,$param)
    {
            $query = $this->db->count_all($table,$param);
            return $query;
    }
    /* count rows by id with conditions */                  
    public function count_row_by_id($table=null,$where_column=null,$user_id=null)
    {
            $res = $this->db->query("SELECT COUNT( * ) AS count_task FROM  $table WHERE $where_column = $user_id and is_active = 'Y'");
            return $res->result();
    }
    /* count join rows by id */             
    public function count_join_row_by_id($user_id=null)
    {
            $res = $this->db->query("SELECT COUNT( * ) AS replied_count FROM nsf_support_ticket WHERE user_id_fk = $user_id AND is_replied = 'Y' AND is_read = 'N' ");
            if($res){
                return $res->result();
            } 
            else {
                return false;
            }                
    }
    /* count all parent member */
    public function count_rows_by_id($uid)
    {
            $res = $this->db->query("SELECT COUNT( * ) AS member_count FROM lp_user_mst WHERE parent_id = $uid");
            if($res){
                return $res->result();
            } 
            else {
                return false;
            }                
    }
    // get new flyers
    public function getNewFlyer($table,$limit,$offset)
    {
            $query = $this->db->get($table, $limit, $offset);
            $this->db->order_by("active_from", "desc");
            return $query->result();
    }
    // get most flyers
    public function getNewFlyer2($table,$limit,$offset)
    {
            $query = $this->db->get($table,$limit,$offset);
            $this->db->order_by("total_favs", "desc");
            return $query->result();
    }
    // get best buy flyers
    public function getNewFlyer3($table,$limit,$offset)
    {
            $this->db->order_by("total_purchase", "desc");
            $query = $this->db->get($table,$limit,$offset);
            return $query->result();
    }
    // get order inoive and cart detail
    public function my_order($inv)
    {
            $result = $this->db->query("SELECT 
                        f . *,
                        (select 
                                is_success
                            from
                                lp_my_cart
                            where
                                lp_my_cart.cart_id_pk = f.cart_id_fk) as is_success
                    FROM
                        lp_invoices f
                    where
                        invoice_id_pk = $inv;");
            // echo $this->db->last_query();
            return $result->result();
    }
    // my category
    
    public function my_category($pid)
    {

            $result = $this->db->query("select 
                                            category_name
                                        from
                                            lp_category_mst
                                        where
                                            category_id_pk = (select 
                                                    category_id_fk
                                                from
                                                    lp_product_mst
                                                where
                                                    product_id_pk = '$pid')");
            return $result->row();
    }
    // get my fav flyer
    public function getFavFlyer($uid)
    {
            $this->db->select('*');
            $this->db->from('lp_product_mst');
            $this->db->join('lp_my_favourites','lp_product_mst.product_id_pk = lp_my_favourites.product_id_ck','left'); 
            $where=array('lp_product_mst.is_active'=>'Y','lp_my_favourites.user_id_ck'=>$uid);
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result();
    }   


    /* pagination data */
    public function get_pagination_data($table,$limit='10',$offset='0')
    {
            return $this->db->get($table,$limit,$offset); 
    }
    /* get pagination data for all users */
    public function get_pagination_datas_for_all_users($table,$limit='10',$offset='0')
    {
            $this->db->where('usertype','user');
            $this->db->or_where('usertype','c_admin');
            return $this->db->get($table,$limit,$offset); 
    }
    /* get all records from table */
    public function all_records($mytable)
    {
            $query = $this->db->get($mytable);
            return $query->result();
    } 

    /* get all records from table */
    public function all_records_order_by($mytable,$column,$by='ASC')
    {
            $sqlQuery = " SELECT ffi.*, ffmf.report_path FROM lp_invoices ffi,lp_my_cart ffmc,lp_my_listing ffmf where ffmf.project_id_pk = ffmc.project_id_fk and ffmc.cart_id_pk = ffi.cart_id_fk order by ffi.invoice_id_pk; ";
            $query = $this->db->query($sqlQuery);
            return $query->result();
    }

    /* get all records by in query */           
    public function get_all_record_by_in($table,$colum,$wherein)
    {
            $this->db->where_in($colum,$wherein);
            $res=$this->db->get($table);
            return $res->result();
    }
    /* delete all records by id */
    public function delete_record_by_id($table,$where)
    {
            $query = $this->db->delete($table,$where);
            return $query;
    }
    /* delete all records by conditions */
    public function delete_record_by_id1($table,$where,$managerid1)
    {
            $this->db->where_in('userid',$where);
            $this->db->where('managerid',$managerid1);
            $this->db->delete($table); 
    }
    /* get users record from three tables using join*/
    public function getUserRecords()
    {
            $this->db->select('*');
            $this->db->from('nsf_user');
            $this->db->join('nsf_user_subscription','nsf_user.user_id_pk = nsf_user_subscription.user_id_fk','left');
            $this->db->join('nsf_subscription_transaction','nsf_user.user_id_pk = nsf_subscription_transaction.user_id_fk','left');
            $this->db->join('nsf_subscription_mst','nsf_user_subscription.subscription_type_id_fk = nsf_subscription_mst.subscription_type_id_pk','left');
            $where=array('nsf_user.user_role'=>'subscriber','nsf_user.is_active'=>'Y');
            $this->db->where($where);
            $this->db->group_by("user_id_pk"); 
            $query = $this->db->get();
            return $query->result();
    }   
    /* get records of user by id */
    public function get_user_details($uid = NULL)
    {
            $query = $this->db->query("select 
                um.user_id_pk as uid,
                um.username as uname,
                um.first_name as fname,
                um.last_name as lname,
                um.primary_email as pemial,
                sm.school_id_pk as sid,
                sm.school_name as sname,
                sc.class_id_pk as cid,
                sc.class_name as cname,
                ss . *
            from
                att_user_mst as um,
                att_school_mst as sm,
                att_school_class as sc,
                att_school_student as ss
            where
                um.user_id_pk = ss.student_id_ck
                    and sm.school_id_pk = ss.school_id_ck
                    and sc.class_id_pk = ss.class_id_fk
            and um.user_id_pk = $uid ");
            return $query->row();
    }      
    // user model
    // get user password by email
    public function get_password_by_email($email)
    {
            $this->db->select('password');
            $this->db->where('email',$email);
            $query = $this->db->get('lp_user_mst');
            if($query == NULL) return '';
            return $query->row()->password;
    }
    // update user password
    public function update_password($data,$userId)
    {
            $data = array(
                "password" => $data
                );
            $this->db->where('user_id_pk',$userId);
            $query = $this->db->update('lp_user_mst',$data); 
            return $query;       
    }
    // get flyer records from flyer table and my cart table
    public function get_flyers($uid)
    {
            $query = $this->db->query("
                        SELECT * FROM lp_my_flyers f left join lp_my_cart fmc on f.project_id_pk = fmc.project_id_fk where f.user_id_fk = $uid order by updated_on desc
                    ");

            return $query->result();
    }
   // 
    public function flyers_list()
    {
            $query = $this->db->query("
                        SELECT * FROM lp_product_mst f order by active_from desc limit 0,18
                    ");

            return $query->result();
    }

    // 
    public function flyers_list2($limit, $start,$category)
    {
            $sqlQuery = "SELECT * FROM lp_product_mst f  ";
            if($category=='0'){

            }
            else{
                $sqlQuery .= " where  category_id_fk='".$category."' ";
            }
            $sqlQuery .= " order by active_from desc limit ".$start.",".$limit;
            $query = $this->db->query($sqlQuery);

            return $query->result();
    }
    public function flyers_list2_count($limit, $start,$category)
    {
            $sqlQuery = "SELECT * FROM lp_product_mst f  ";
            if($category=='0'){

            }else{
                $sqlQuery .= " where  category_id_fk='".$category."' ";
            }
            $sqlQuery .= " order by active_from desc ";
            $query = $this->db->query($sqlQuery);

            return $query->num_rows();
    }

    public function user_invoice_count($roleId, $adminId, $postData)
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

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("( inv.invoice_num LIKE '%".$value."%' 
                OR lp.report_type LIKE '%".$value."%'
                OR lp.property_address LIKE '%".$value."%'
                OR inv.invoice_to LIKE '%".$value."%'
                OR CONCAT(TRIM(s.first_name), ' ', TRIM(s.last_name)) LIKE '%".$value."%'
                 )", NULL, FALSE);
        }

        $query = $this->db->get('lp_invoices inv');
        $data = $query->row_array();
        return $data['count'];
    }

    public function user_invoice_data($roleId, $adminId, $columns, $postData)
    {
        $order = $columns[$postData['order'][0]['column']];
        $dir = $postData['order'][0]['dir'];

        $this->db->select("inv.*,lp.report_path,lp.report_type,s.first_name as s_first_name,s.last_name as s_last_name,cart.is_success,lp.property_address");
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
        
        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("( inv.invoice_num LIKE '%".$value."%' 
                OR lp.report_type LIKE '%".$value."%'
                OR lp.property_address LIKE '%".$value."%'
                OR inv.invoice_to LIKE '%".$value."%'
                OR CONCAT(TRIM(s.first_name), ' ', TRIM(s.last_name)) LIKE '%".$value."%'
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
    
    // 
    public function user_invoice($roleId,$adminId)
    {
        $this->db->select("inv.*,lp.report_path,lp.report_type,s.first_name as s_first_name,s.last_name as s_last_name,cart.is_success,lp.property_address");
        $this->db->join('lp_user_mst user', 'user.user_id_pk=inv.user_id_fk');
        $this->db->join('lp_my_cart cart', 'cart.cart_id_pk=inv.cart_id_fk','left');
        $this->db->join('lp_my_listing lp', 'cart.project_id_fk=lp.project_id_pk','left');
        $this->load->library('role_lib');
        if($this->role_lib->is_admin($roleId)) {
            $this->db->join('lp_user_mst s', 's.user_id_pk=user.parent_id and s.role_id_fk=3','left');
        } else if($this->role_lib->is_manager_l1($roleId)){
            $this->db->join('lp_user_mst s', 's.user_id_pk=user.parent_id and s.role_id_fk=3');
            $this->db->where('s.parent_id',$adminId);
        } else if($this->role_lib->is_sales_rep($roleId)){
            $this->db->join('lp_user_mst s', 's.user_id_pk=user.parent_id');
            $this->db->where('s.user_id_pk',$adminId);
        }
        
        $this->db->order_by('inv.invoice_date','DESC');
        $query = $this->db->get('lp_invoices inv');
        return $query->result();
    }
    /**
     * Queue mails for cron
     * @access public
     * @param string $email_id Email Address
     * @param string $subject Email Subject
     * @param string $content Email Body
     * @param array $attachments  File attachments
     * @return null
     */
    public function queue_mail($email,$subject,$content,$attachments=null,$ccTo=null)
    {
        $data = array(
            'email_address'=>$email,
            'cc_to'=>$ccTo,
            'subject' => $subject,
            'content' => $content,
            
            );
        if(!is_null($attachments)) {
            $data['attachments']=json_encode($attachments,JSON_UNESCAPED_SLASHES);
        }
        return $this->db->insert('lp_mail_cron',$data);
    }
    public function add_coupon_redeem_log($couponId,$userId,$projectId){
        $this->db->set('coupons_applied_cnt', '`coupons_applied_cnt`+1', FALSE);
        $this->db->where('coupon_id_pk', $couponId);
        $this->db->update('lp_coupon_mst');
        
        //Insert if new
        $data = array(
            'coupon_id_fk'=> $couponId,
            'user_id'=> $userId,
        );
        // $query = $this->db->where($data)->get('lp_coupon_redeem_log');
        // $logData = $query->row();
         $data['redeem_count'] = 1;$data['created_at'] = date("Y-m-d H:m:s");
           $this->db->insert('lp_coupon_redeem_log',$data);
           $_logId = $this->db->insert_id();
           if($_logId){
              $this->add_coupon_redeem_log_history($_logId,$projectId); 
           }
        // if(empty($logData)){
          
        // } else {
        //    $this->db->set('redeem_count', '`redeem_count`+1', FALSE);
        //    $this->db->where('id',$logData->id);
        //    $res = $this->db->update('lp_coupon_redeem_log');
        //    if($res){
        //        $this->add_coupon_redeem_log_history($logData->id,$projectId);
        //    }
        // }
    }
    private function add_coupon_redeem_log_history($redeem_log_id,$projectId){
        $this->db->select('project_id_pk,report_type,project_name,property_address')->where('project_id_pk',$projectId);
        $query = $this->db->get('lp_my_listing');
        $projectData = $query->row();
        $data = array(
            'redeem_log_id'=>$redeem_log_id,
            'project_id_fk'=>$projectData->project_id_pk,
            'report_type'=>$projectData->report_type,
            'project_name'=>$projectData->project_name,
            'property_address'=>$projectData->property_address,
            );
        
        
        $this->db->insert('lp_coupon_redeem_log_history',$data);
    }


}
?>
