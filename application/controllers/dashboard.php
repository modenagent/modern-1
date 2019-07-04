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

    /* dashboard portfolio change */
    public function changePortfolio2()
    {
            if($this->session->userdata('userid')){
                $userId = $data['user_id'] = $this->session->userdata('userid');
                if($_POST){
                    $portfolioId = $_POST['id'];                    
                    if(!empty($portfolioId) && $portfolioId > 0 ){
    
                        $overViewData = $this->base_model->getUsersAllStocks($userId,$portfolioId);
                        $stocklist = $this->base_model->getUserPortfolioStocks1($userId,$portfolioId);
                        $sectorData = $this->dashboard_model->getStocksSector($userId,$portfolioId);                        
                        $portfolioPerData = $this->dashboard_model->getPortfolioPerformanceData2($userId,$portfolioId);//                        
                    } else {
    
                        $overViewData = $this->base_model->getUsersAllStocks($userId);
                        $stocklist = $this->base_model->getUserPortfolioStocks1($userId);
                        $sectorData = $this->dashboard_model->getStocksSector($userId);                        
                        $portfolioPerData = $this->dashboard_model->getPortfolioPerformanceData2($userId);
                    }
                    
                    foreach($stocklist as $stockList){   
                        $stockSym = $stockList->stock_symbol;
                        $overAllGain = $stockList->overall_gain;                            
                        if($overAllGain >= 0){ 
                            $gainorloss = "alert-success";
                            $upDown = "fa fa-arrow-up";
                        }else{
                            $gainorloss = "alert-danger";
                            $upDown = "fa fa-arrow-down";
                        }
                        $overAllGainPer = $stockList->overall_gain_percent;
                        $maxGainer[] = $overAllGain;
                        $maxGainerIndex[$stockList->stock_id_pk]['stock'] = $stockSym;
                        $maxGainerIndex[$stockList->stock_id_pk]['value'] = $overAllGain;
                        $maxGainerIndex[$stockList->stock_id_pk]['per'] = round($overAllGainPer,2);
                        $temp = (max($maxGainer)); 
                        $temp1 = (min($maxGainer)); 
                        foreach($maxGainerIndex as $value){
                            if($value['value'] == $temp ){
                                if($temp>=0){
                                    $val = $value['stock'];
                                    $tmp =  " +".round($temp,2)." ";
                                    $per = "(".round($value['per'],2)." %)";
                                }

                            }
                            if($value['value'] == $temp1 ){
                               if($temp1<=0){
                                   $val1 = $value['stock'];
                                   $tmp1 =  " ".round($temp1,2)." ";
                                   $per1 = "(".round($value['per'],2)." %)";
                               }

                            }
                        }
                    }
                    /* high chart data */
                    $investedAmtData = array();
                    $networthData = array();
                    $profitData = array();
    
                    foreach($portfolioPerData as $portfolioPerDataList){   
                        $per_date = strtotime($portfolioPerDataList->performance_date)*1000;                        
                        array_push($investedAmtData, array($per_date,floatval($portfolioPerDataList->invest_amount) ));
                        array_push($networthData, array($per_date,floatval($portfolioPerDataList->networth)) );
                        array_push($profitData, array($per_date,floatval($portfolioPerDataList->profit)) );                       
                    }                     
                    /* first pie chart data */
                    $invSum = 0;
                    $curSum = 0;
                    $profitSum = 0;
                    $profitPerSum = 0;
                    foreach($stocklist as $stockList){
                        $invSum += $stockList->amount;
                        $curSum += $stockList->current_value;
                        $profitSum += $stockList->current_value - $stockList->amount;
                       if($invSum != 0){
                            $profitPercent = ($profitSum * 100)/$invSum;       
                       }

                    }
                    /* secind pie chart data */
                   $totalAmtSum = 0;
                   foreach($sectorData as $sectorDataList){
                       $totalAmt = $sectorDataList->amt_sum;
                       $totalAmtSum += $totalAmt; 
                       if($totalAmt != 0){
                          $amtPercent = ($totalAmt * 100)/$totalAmtSum;  
                       }

                   }
                    /* overview data */
                    foreach($overViewData as $userportfoliostocks){                        
                        $investedAmount = $userportfoliostocks->amount;
                        $tadaysGain = $userportfoliostocks->today_gain;
                        $todaysGainPercent = $userportfoliostocks->today_gain_percent;
                        $overAllGainValue = $userportfoliostocks->overall_gain;
                        $overAllGainValuePercent = $userportfoliostocks->overall_gain_percent;
                        $netWorth = $userportfoliostocks->total_amount;                        
                        if($overAllGainValue >= 0){ 
                            $dupDown2 = "fa fa-arrow-up";
                             $badge2 = "badge-success";
                        }else{                
                            $dupDown2 = "fa fa-arrow-down";               
                            $badge2 = "badge-danger";
                        }
                        $newOverAllGainValuePercent = round($overAllGainValuePercent,2);                        
                        if($tadaysGain >= 0){ 
                            $dupDown = "fa fa-arrow-up";                
                             $badge = "badge-success";
                        }else{                
                            $dupDown = "fa fa-arrow-down";
                            $badge = "badge-danger";
                        }
                        $newTodaysGainPercent = round($todaysGainPercent,2);
                    }
                    /* ajax success return for overview data*/
                    $stockOverViewHtml = '';
                    $stockOverViewHtml .= '<div class="col-sm-6 col-sm-3 col-md-2">
                        <div class="panel income db mbm">
                          <div class="panel-body badge-info text-center">
                              <h4 class="value">'.round($investedAmount,2).'</h4>
                            <p class="description">Investment</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-sm-3 col-md-2">
                        <div class="panel task db mbm">
                          <div class="panel-body '.$badge.' text-center">
                              <h4 class="value">'.$tadaysGain.' ('.$newTodaysGainPercent.'%) <i class="'.$dupDown.'"></i></h4>
                            <p class="description">Today&acutes Gain</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-sm-3 col-md-2">
                        <div class="panel task db mbm">
                          <div class="panel-body badge-success text-center">                 
                            <h4 class="value">';
                            if($val != '' || $tmp != '' || $per != ''){
                            $stockOverViewHtml .= $val;
                            $stockOverViewHtml .=  $tmp;
                            $stockOverViewHtml .=  $per;
                            }else{
                             $stockOverViewHtml .=  'N/A';	
                            } 
                           $stockOverViewHtml .= '</h4>
                            <p class="description">Max Gainer</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-sm-3 col-md-2">
                        <div class="panel task db mbm">
                          <div class="panel-body badge-danger text-center">
                            <h4 class="value">';
                            if($val1 != '' || $tmp1 != '' || $per1 != ''){
                            $stockOverViewHtml .= $val1;
                            $stockOverViewHtml .=  $tmp1;
                            $stockOverViewHtml .=  $per1;
                            }else{
                             $stockOverViewHtml .=  'N/A';	
                            } 
                           $stockOverViewHtml .= '</h4>
                            <p class="description">Max Looser</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-sm-3 col-md-2">
                        <div class="panel visit db mbm">
                          <div class="panel-body '.$badge2.'  text-center">
                              <h4 class="value">'.number_format($overAllGainValue).' ('.$newOverAllGainValuePercent.'%) <i class="'.$dupDown2.'"></i></h4>
                            <p class="description">Overall Gain</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-sm-3 col-md-2">
                        <div class="panel profit db mbm">
                          <div class="panel-body badge-blue text-center">
                              <h4 class="value">'.number_format($netWorth).'</h4>
                            <p class="description">Overall Networth</p>
                          </div>
                        </div>
                      </div>';                   
                    $stockListTableHtml = '';
                    $stockListTableHtml = '<table class="table table-striped table-bordered table-advanced tb-sticky-header">
                    <thead>
                      <tr class="portfolio-header">
                        <th width="3%">&nbsp;</th>
                        <th>Company</th>
                        <th>Live Price</th>
                        <th>Change</th>
                        <th>Qty</th>
                        <th>Cost Price</th>
                        <th>Inv. Amount</th>
                        <th>Day&#39;s Gain</th>
                        <th>Overall Gain</th>
                        <th>Overall Gain %</th>
                        <th>Current Value</th>
                      </tr>
                    </thead>
                    <tbody id="portfolioTableBody2">';
                    $investedAntHtml = '';
                    $investedAntHtml .= '<span>'.$newInvList.'</span>';
                 /* ends here */
                    /* ajax response */
                    $resp = array(
                        "status"=>"Success",
                        "stockTable"=>$stockChartHtml,
                        "overView"=>$stockOverViewHtml,
                        "invSum"=>$invSum,
                        "curSum"=>$curSum,
                        "profitSum"=>$profitSum,
                        "profitPercent"=>$profitPercent,
                        "invested_amt"=>$investedAmtData,
                        "networth"=>$networthData,
                        "profit"=>$profitData,
                        "stocklist" => $stocklist,
                        "sectorData" => $sectorData                        
                        );
                    echo json_encode($resp);
                }
            }
    }
}
/* class ends here*/