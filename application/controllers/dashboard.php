<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Dashboard extends CI_Controller {
    
    public function __construct()
    {
            parent::__construct();            
    }
    /* Data */
    public function index()
    {
            // abandoned
            $adminId = $data['admin_id'] = $this->session->userdata('adminid');
            if($adminId){
                redirect(base_url().'dashboard');
            }else{
                $this->load->view('user/header');
                $this->load->view('user/dashboard');
                $this->load->view('user/footer');
            }
    } 
    /* dashboard revenue chart */
    public function revenue()
    {
            $adminId = $data['admin_id'] = $this->session->userdata('adminid');
            if($adminId){                
                if($_POST){
                    if($_POST["type"] == "revenue_chart"){
                      $revenueData = $this->dashboard_model->revenue_sum();
                      
                      /* high chart data */
                      $invAmtData = array();
                      $invDateData = array();                   
                      foreach($revenueData as $revenueDataList){                                                 
                          array_push($invAmtData, floatval($revenueDataList->inv_amt) );
                          array_push($invDateData, $revenueDataList->invoice_date2 );                                                
                      }        


                      $resp = array(
                        "status"=>"success",
                        "inv_amt" => $invAmtData,
                        "inv_date" => $invDateData                 
                        );
                      echo json_encode($resp);
                    }

                }
            }else{
                $this->load->view('admin/index');
            }
    }
    /* dashboard revenue chart */
    public function total_revenue()
    {
        $adminId = $data['admin_id'] = $this->session->userdata('adminid');
        if($adminId){                
            if($_POST){
                $interval = $_POST['interval'];
                $roleId = $this->session->userdata('role_id');
                $revenueData = $this->dashboard_model->total_revenue($interval,$adminId,$roleId);
                $resp = array(
                  "status"=>"success",
                  "inv_amt" => floatval($revenueData->inv_amt),
                  );
                echo json_encode($resp);
            }
        }else{
            $this->load->view('admin/index');
        }
    }
    // 
    public function order()
    {
            $adminId = $data['admin_id'] = $this->session->userdata('adminid');
            if($adminId){                
                if($_POST){
                    if($_POST["type"] == "order_chart"){
                      $roleId = $this->session->userdata('role_id');
                      $revenueData = $this->dashboard_model->revenue_count($roleId,$adminId);
                      
                      /* high chart data */
                      $invAmtData = array();
                      $invDateData = array();                   
                      foreach($revenueData as $revenueDataList){                                                 
                          array_push($invAmtData, floatval($revenueDataList->count) );
                          array_push($invDateData, $revenueDataList->invoice_date2 );                                                
                      } 
                      $resp = array(
                        "status"=>"success",
                        "inv_amt" => $invAmtData,
                        "inv_date" => $invDateData                 
                        );
                      echo json_encode($resp);
                    }

                }
            }else{
                $this->load->view('admin/index');
            }
    }

}
/* class ends here*/