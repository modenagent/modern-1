<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // error_reporting(E_ALL ^ E_NOTICE);
    }
    
    public function get_all_packages_price()
    {
        $packages = [];
        $sql = "SELECT package, price FROM lp_packages";
        $result = $this->db->query($sql);
        if ($result->num_rows()>0) {
            $data = $result->result_array();
            foreach($data as $row) {
                $packages[$row['package']] = $row['price'];
            }
        }
        return $packages;
    }

    public function get_reports_price()
    {
        $sql = "SELECT price FROM lp_packages WHERE package = 'reports'";
        $result = $this->db->query($sql);
        $data = $result->row_array();
        return $data['price'];
    }

    public function get_monthly_price()
    {
        $sql = "SELECT price FROM lp_packages WHERE package = 'monthly'";
        $result = $this->db->query($sql);
        $data = $result->row_array();
        return $data['price'];
    }

    public function set_package_price($package, $price, $userId)
    {
        $update_sql = "UPDATE lp_packages 
            SET price=?, updated_at=?, updated_by=? 
            WHERE package=?";
        $this->db->query($update_sql, [$price, date('Y-m-d H:i:s'), $userId, $package]);
    }
}