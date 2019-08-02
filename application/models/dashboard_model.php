<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 ob_start();
 class Dashboard_model extends CI_Model 
 {


    /****************************************/
    public function getBillingHistory($userid){
        $this->db->select('project_id_pk, project_id_pk as project_id, project_name, property_owner, property_address, report_path, property_apn, property_lat, property_lng, total_amount, paid_on,invoice_pdf, invoice_amount, invoice_date');
        $this->db->from('lp_my_listing');
        $this->db->join('lp_my_cart','lp_my_listing.project_id_pk=lp_my_cart.project_id_fk ', "INNER");
        $this->db->join('lp_invoices','lp_my_cart.cart_id_pk=lp_invoices.cart_id_fk and lp_my_cart.user_id_fk=lp_invoices.user_id_fk', "INNER");
        $this->db->where(array('lp_invoices.user_id_fk'=>$userid));
        $this->db->order_by('project_id_pk','desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_billing_history_count($userId, $postData)
    {
        $this->db->select('count(listing.project_id_pk) as count');
        $this->db->from('lp_my_listing listing');
        $this->db->join('lp_my_cart','listing.project_id_pk=lp_my_cart.project_id_fk ', "INNER");
        $this->db->join('lp_invoices','lp_my_cart.cart_id_pk=lp_invoices.cart_id_fk and lp_my_cart.user_id_fk=lp_invoices.user_id_fk', "INNER");
        $this->db->where('lp_invoices.user_id_fk', $userId);
        $this->db->where('listing.is_active', 'Y');

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("(listing.property_address LIKE '%".$value."%' 
                OR listing.property_apn LIKE '%".$value."%'
                )", NULL, FALSE);
        }

        $query = $this->db->get();
        $data = $query->row_array();
        return $data['count'];
    }

    public function get_billing_history_data($userId, $columns, $postData)
    {
        $order = $columns[$postData['order'][0]['column']];
        $dir = $postData['order'][0]['dir'];

        $this->db->select('listing.project_id_pk, listing.project_id_pk as project_id, listing.project_name, listing.property_owner, listing.property_address, listing.report_path, listing.property_apn, listing.property_lat, listing.property_lng, total_amount, paid_on,invoice_pdf, invoice_amount, invoice_date, lp_invoices.invoice_num, lp_invoices.user_id_fk');
        $this->db->from('lp_my_listing listing');
        $this->db->join('lp_my_cart','listing.project_id_pk=lp_my_cart.project_id_fk ', "INNER");
        $this->db->join('lp_invoices','lp_my_cart.cart_id_pk=lp_invoices.cart_id_fk and lp_my_cart.user_id_fk=lp_invoices.user_id_fk', "INNER");
        $this->db->where('lp_invoices.user_id_fk', $userId);
        $this->db->where('listing.is_active', 'Y');

        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $value = trim($postData['search']['value']);
            $value = $this->db->escape($value);
            $value = trim($value,"'");
            $this->db->where("(listing.property_address LIKE '%".$value."%' 
                OR listing.property_apn LIKE '%".$value."%'
                )", NULL, FALSE);
        }

        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        } else {
            $this->db->limit(10, $postData['start']);
        }
        $this->db->order_by($order, $dir);

        $query = $this->db->get();
        return $query->result_array();
    }


    /* Get porfolio data by user id */
    public function getPortfolioPerformanceData($uid)
    {
        $currentDate = date('Y-m-d');        
        $lastDayDate = date('Y-m-d',strtotime($currentDate. "-1 day"));
        
        $preWeekDate = "'".date('Y-m-d',strtotime($lastDayDate. "-7 day"))."'";
        $preFifteenWeekDate = "'".date('Y-m-d',strtotime($lastDayDate. "-15 day"))."'";
        $preMonthDate = "'".date('Y-m-d',strtotime($lastDayDate. "-1 month"))."'";
        $preThreeMonth = "'".date('Y-m-d',strtotime($lastDayDate. "-3 month"))."'"; 
        $preSixMonth = "'".date('Y-m-d',strtotime($lastDayDate. "-6 month"))."'"; 
        $preYear = "'".date('Y-m-d',strtotime($lastDayDate. "-1 year"))."'";
        $allDate;
        
        $this->db->select('*');
        $this->db->from('nsf_portfolio_performance');
        $where=array('user_id_fk'=>$uid);
        $this->db->where($where);
        $this->db->where("performance_date BETWEEN $preWeekDate AND '".$lastDayDate."'");
        $query = $this->db->get();
        return $query->result();
    }
    /*  */
    public function getPortfolioPerformanceData2($uid,$pid = NULL)
    {
        $currentDate = date('Y-m-d');        
        $lastDayDate = "'".date('Y-m-d',strtotime($currentDate. "0 day"))."'";
        $preWeekDate = "'".date('Y-m-d',strtotime($currentDate. "-8 day"))."'";
        
        if($pid){
            $condition = "and portfolio_id_fk = $pid";            
        }else{
            $condition = "";            
        }
        $res = $this->db->query("select 
            *, DATE_FORMAT(nsf_portfolio_performance.performance_date,'%Y-%m-%d') as pdate
            from
            nsf_portfolio_performance            
            where
            user_id_fk = $uid
            $condition
            and DATE_FORMAT(performance_date,'%Y-%m-%d') BETWEEN $preWeekDate AND $lastDayDate            
            ORDER BY DATE_FORMAT(performance_date,'%Y-%m-%d') ");
            return $res->result();
       
    }
    /* get sector data */
    public function getStocksSector($uid,$pid = NULL)
    {
        if($pid){
            $condition = "and nsf_portfolio_stock.portfolio_id_ck = $pid";            
        }else{
            $condition = "";            
        }
        $res = $this->db->query("select 
            sum(nsf_portfolio_stock.amount) as amt_sum, 
            coalesce(sector, 'NONE') as sector_name
            from
            nsf_portfolio_stock,
            nsf_stock
            where
            nsf_portfolio_stock.stock_id_ck = nsf_stock.stock_id_pk
            and nsf_portfolio_stock.user_id_fk = $uid
            $condition
            group by nsf_stock.sector");
            return $res->result();
    }

    public function revenue_sum(){
        $res = $this->db->query("
            SELECT sum(invoice_amount) as inv_amt,date_format(invoice_date,'%d-%b\'%y') as invoice_date2 from lp_invoices where date(invoice_date)>= DATE_SUB(CURDATE(), INTERVAL 20 day) group by invoice_date2
            ");
        return $res->result();
    }
    public function total_revenue($interval){
        if($interval=='day') {
            $startDate = date("Y-m-d", strtotime("-1 day"));
            $endDate = date("Y-m-d", strtotime("+1 day"));
        } else if($interval=='month') {
            $startDate = date("Y-m-t", strtotime("-1 month"));//Last date of prev month
            $endDate = date('Y-m-01', strtotime("+1 month"));//First date of next month
        } else {
            $startDate = date("Y-12-31", strtotime("-1 year"));//Last date of prev year
            $endDate = date('Y-01-01', strtotime("+1 year"));//First date of next year
        }
        $this->load->library('role_lib');
        $this->db->select('sum(main.invoice_amount) as inv_amt');
        //$sql = "SELECT sum(main.invoice_amount) as inv_amt from lp_invoices as main where main.invoice_date>='{$startDate}' and main.invoice_date<='{$endDate}' ";
        if($this->role_lib->is_manager_l1($roleId)){
            $this->db->join('lp_user_mst u', 'u.user_id_pk=main.user_id_fk');
            $this->db->where('u.parent_id',$adminId);
        } else if($this->role_lib->is_sales_rep($roleId)){
            $this->db->join('lp_user_mst u', 'u.user_id_pk=main.user_id_fk');
            $this->db->join('lp_user_mst s', 's.user_id_pk=u.user_id_pk');
            $this->db->where('s.parent_id',$adminId);
        }
        $this->db->where('main.invoice_date >',$startDate);
        $this->db->where('main.invoice_date <',$endDate);
        $query = $this->db->get('lp_invoices as main');
        return $query->row();
    }

    public function revenue_count($roleId,$adminId)
    {
        $this->load->library('role_lib');
        $sql = "SELECT COUNT(main.project_id_pk) as count, date_format(inv.invoice_date,'%d-%b\'%y') as invoice_date2"
                . " FROM lp_my_listing as main "
                . " join lp_my_cart as c on c.project_id_fk=main.project_id_pk"
                . " join lp_invoices as inv on inv.cart_id_fk=c.cart_id_pk";
                
        if($this->role_lib->is_admin($roleId)) {
            $sql.=" WHERE c.is_success='Y'";
        }elseif($this->role_lib->is_sales_rep($roleId)) {
            $sql.=" join lp_user_mst as e on e.user_id_pk=main.user_id_fk WHERE e.parent_id={$adminId} and c.is_success='Y'";
        } else if($this->role_lib->is_manager_l1($roleId)){
            $sql.=" join lp_user_mst as e on e.user_id_pk=main.user_id_fk
                    join lp_user_mst as s on s.user_id_pk=e.parent_id
                    WHERE s.parent_id={$adminId} and c.is_success='Y'";
        }
        $sql .= "and date(inv.invoice_date)>= DATE_SUB(CURDATE(), INTERVAL 20 day)  group by invoice_date2 ";
        $res = $this->db->query($sql);
        return $res->result();
    }
    
    /**
     * Returns Last Invoice Number 
     * @return integer 
     */
    public function getLastInvoiceNumber(){
        $invoiceSeparator = $this->config->item('invoice_separator');
        $invoicePrefix = $this->config->item('invoice_prefix');
        $this->db->select('invoice_num');
        $this->db->where("invoice_num like '".$invoicePrefix.$invoiceSeparator."%'");
        $this->db->order_by('invoice_id_pk','DESC')->limit(1);
        $invoiceRow = $this->db->get('lp_invoices')->row();
        return $invoiceRow->invoice_num;
    }
 }/* class ends here */
 ?>
