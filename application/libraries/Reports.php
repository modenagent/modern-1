<?php
    /**
     * The Library for the operations related to Report Generation.
     *
     *    
     * Date: Nov 30, 2016
     */
// require 'vendor/autoload.php';

use Knp\Snappy\Pdf;
    class Reports {

        // constructor for the library to initialize the CI object
        public function __construct() {
            // initiating the CI object
            // parent::__construct();
        }
        
        private function _prepareMinMaxComparable($priceRate,&$firstTime,&$minPrice, &$maxPrice,&$tmp_property,&$tmp_lot_size, &$lotSize,&$min_lot_size,&$max_lot_size){
            if($firstTime){
                $minPrice = floatval($priceRate);
                $maxPrice = floatval($priceRate);

                $min_lot_size = $lotSize;
                $max_lot_size = $lotSize;  
                $firstTime = false;
            }
            if($minPrice>floatval($priceRate) ){
                $minPrice = floatval($priceRate);
            }
            if($maxPrice< floatval($priceRate)){
                $maxPrice = floatval($priceRate);
            }

            if($min_lot_size> $lotSize){
                $min_lot_size = $lotSize;
            }
            if($max_lot_size< $lotSize){
                $max_lot_size = $lotSize;
            }

            $tmp_property += $priceRate;         
            $tmp_lot_size += $lotSize;
        }
        
        function getPropertyData($callFromApi = 0, $reportData = array()){
            $CI = & get_instance();
            $errorMsg = "Unexpacted error occured while trying to create ".$_POST['report_lang']." ".$_POST['presentation']." Report PDF for user account ".$CI->session->userdata('user_email');
            // loading the required helper
            $CI->load->helper('dataapi');
            
            // if call is from the API then we give the data after processing on our end
            if($callFromApi == 1){
                $_POST = $reportData;
                $data['callFromApi'] = $callFromApi;
            }

            $rep111 = $_POST['report111'];
            $reportLang = isset($_POST['report_lang']) && !empty($_POST['report_lang']) ? strtolower($_POST['report_lang']) : '';
            $compKeys = json_decode(stripslashes($_POST['custom_comps']));
            $rep111 = urldecode($rep111);
            $report111 = @simplexml_load_file($rep111);
            
            $rep187 = $_POST['report187'];
            $rep187 = urldecode($rep187);
            $report187 = simplexml_load_file($rep187);
            // changes for local version starts here and comment above line => $report187 = simplexml_load_file($rep187);
            // $report187 = simplexml_load_file("sample.xml");
            // changes for local version ends here

            $data['mapinfo'] = $report111;
            $data['property'] = $report187;

            $data['user'] = $_POST['user'];
            if($_POST['user_image'] != ''){
                $data['user']['profile_image'] = $_POST['user_image'];
            }
            if($_POST['company_image'] != ''){
                $data['user']['company_logo'] = $_POST['company_image'];
            }

            if($data['user']['email'] != ''){
                $CI =& get_instance();
                $ref_code = $CI->db->select('ref_code')
                                ->where('email', $data['user']['email'])
                                ->get('lp_user_mst')
                                ->row_array();

                $data['user']['ref_code'] = $ref_code['ref_code'];

                $user_info = $CI->db->select(array('mobile','website'))
                                ->where('email', $data['user']['email'])
                                ->get('lp_user_mst')
                                ->row_array();

                $data['user']['ref_code'] = $ref_code['ref_code'];
                $data['user']['mobile'] = $user_info['mobile'];
                $data['user']['website'] = $user_info['website'];
            }

            $data['partner'] =  array();
            if($_POST['showpartner']=='on'){
                if(isset($_POST['partner']) && !empty($_POST['partner']))
                {
                    foreach ($_POST['partner'] as $_key => $_partner)
                    {
                        foreach ($_partner as $i => $_data){
                        $data['partner'][$i][$_key] = $_data; 
                        }
                    }
                }
                

                if(!empty($data['partner'])){
                    $data['user_id_fk'] = $CI->session->userdata('userid');
                    foreach ($data['partner'] as $_partner){
                        // Currently these partner details in databse are of no use
                        //$CI->base_model->insert_one_row('lp_partner_details',$_partner);
                    }
                }
            }
            $ownerNamePrimary = (string)$report187->PropertyProfile->PrimaryOwnerName;
            $ownerNameSecondary = (string)$report187->PropertyProfile->SecondaryOwnerName;
            if(strpos($ownerNamePrimary,";") !== FALSE){
                $_primeNameArr = explode(";", $ownerNamePrimary);
                $ownerNamePrimary = ucwords(trim($_primeNameArr[0]));
                if($ownerNameSecondary == ''){
                    $ownerNameSecondary = ucwords(trim($_primeNameArr[1]));
                }
            }
            if(strpos($ownerNamePrimary,",") !== FALSE){
                $_primeNameArr = explode(",", $ownerNamePrimary);
                //Setting Last name at last like for HERNANDEZ, GERARDO JOVANNI name will be GERARDO JOVANNI HERNANDEZ
                $ownerNamePrimary = ucwords(trim($_primeNameArr[1])) . ' ' . ucwords(trim($_primeNameArr[0]));
            }
            if(strpos($ownerNameSecondary,",") !== FALSE){
                $_secNameArr = explode(",", $ownerNameSecondary);
                //Setting Last name at last like for HERNANDEZ, GERARDO JOVANNI name will be GERARDO JOVANNI HERNANDEZ
                $ownerNameSecondary = ucwords(trim($_secNameArr[1])) . ' ' . ucwords(trim($_secNameArr[0]));
            }
            $data['primary_owner'] = $ownerNamePrimary;
            $data['secondary_owner'] = $ownerNameSecondary;
            $reportItems['comparable']=array();
            if(true || $_POST['presentation'] == 'seller') {
                $comparableTemp = $this->get_all_properties($report187);
                if(empty($compKeys)){
                    $comparables = $this->sort_properties($report187, $comparableTemp);
                    $reportItems['comparable'] = $comparables['sorted'];
                } else {
                    foreach($comparableTemp as $key => $_property){
                        if(in_array($key, $compKeys)){
                            array_push($reportItems['comparable'],$_property);
                        }
                    }
                }
            }

            if (empty($reportItems['comparable'])) {
                return ["status"=>false, "showError"=>true, "msg"=>"Report can not be generated due to lack of comparable data."];
            }

            $salesAnalysis = $this->sales_analysis($reportItems['comparable']);
            
            $reportItems['priceMinRange'] = round($salesAnalysis['minPrice']/1000,2);
            $reportItems['priceMaxRange'] = round($salesAnalysis['maxPrice']/1000,2);
 
            $propertyYear = (string)$report187->PropertyProfile->PropertyCharacteristics->YearBuilt[0];
            $reportItems['areaYear'] = $propertyYear;
            $reportItems['areaYearLow'] = minMaxArray('Year', 'min', $reportItems['comparable']);
            $reportItems['areaYearMedian'] = minMaxArray('Year', 'median', $reportItems['comparable']);
            $reportItems['areaYearHigh'] = minMaxArray('Year', 'max', $reportItems['comparable']);

            $reportItems['areaBedrooms'] = (string)$report187->PropertyProfile->PropertyCharacteristics->Bedrooms[0];
            $reportItems['areaBedroomsLow'] = minMaxArray('Beds', 'min', $reportItems['comparable']);
            $reportItems['areaBedroomsMedian'] = minMaxArray('Beds', 'median', $reportItems['comparable']);
            $reportItems['areaBedroomsHigh'] = minMaxArray('Beds', 'max', $reportItems['comparable']);

            $reportItems['areaBaths'] = (string)$report187->PropertyProfile->PropertyCharacteristics->Baths[0];
            $reportItems['areaBathsLow'] = minMaxArray('Baths', 'min', $reportItems['comparable']);
            $reportItems['areaBathsMedian'] = minMaxArray('Baths', 'median', $reportItems['comparable']);
            $reportItems['areaBathsHigh'] = minMaxArray('Baths', 'max', $reportItems['comparable']);
            
            $areaLotSize = number_format((string)$report187->PropertyProfile->PropertyCharacteristics->LotSize[0]);
            $areaLotSizeLow = number_format($salesAnalysis['min_lot_size']);             //number_format(minMaxArray('LotSize', 'min', $reportItems['comparable']));
            $areaLotSizeMedian = number_format($salesAnalysis['tmp_lot_size']/count($reportItems['comparable']));            //number_format(minMaxArray('LotSize', 'median', $reportItems['comparable']));
            $areaLotSizeHigh = number_format($salesAnalysis['max_lot_size']);                // number_format(minMaxArray('LotSize', 'max', $reportItems['comparable']));


            $reportItems['areaLotSize'] = $areaLotSize;
            $reportItems['areaLotSizeLow'] = $areaLotSizeLow;
            $reportItems['areaLotSizeMedian'] = $areaLotSizeMedian;
            $reportItems['areaLotSizeHigh'] = $areaLotSizeHigh;


            $areaLivingAreaLow = number_format(minMaxArray('BuildingArea', 'min', $reportItems['comparable']));
            $areaLivingAreaMedian = number_format(minMaxArray('BuildingArea', 'median', $reportItems['comparable']));
            $areaLivingAreaHigh = number_format(minMaxArray('BuildingArea', 'max', $reportItems['comparable']));

            $reportItems['areaLivingArea']   = (string)$report187->PropertyProfile->PropertyCharacteristics->BuildingArea[0];
            $reportItems['areaLivingAreaLow'] = $areaLivingAreaLow;
            $reportItems['areaLivingAreaMedian'] = $areaLivingAreaMedian;
            $reportItems['areaLivingAreaHigh'] = $areaLivingAreaHigh;

            $areaSalePriceLow = number_format((double)$report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMin);
            $areaSalePriceMedian = number_format((double)$report187->ComparableSalesReport->AreaSalesAnalysisInfo->MedianValue);
            $areaSalePriceHigh = number_format((double)$report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMax);

            $reportItems['areaPriceFoot'] = number_format((string)$report187->PropertyProfile->SaleLoanInfo->PricePerSQFT[0]);
            $reportItems['areaPriceFootLow'] = number_format(minMaxArray('PricePerSQFT', 'min', $reportItems['comparable']));
            $reportItems['areaPriceFootMedian'] = number_format(minMaxArray('PricePerSQFT', 'median', $reportItems['comparable']));
            $reportItems['areaPriceFootHigh'] = number_format(minMaxArray('PricePerSQFT', 'max', $reportItems['comparable']));

            $reportItems['areaSalePriceLow'] = dollars($areaSalePriceLow);
            $reportItems['areaSalePriceMedian'] = dollars($areaSalePriceMedian);
            $reportItems['areaSalePriceHigh'] = dollars($areaSalePriceHigh);

            $reportItems['areaTotalRoomsLow'] = minMaxArray('TotalRooms', 'min', $reportItems['comparable']);
            $reportItems['areaTotalRoomsMedian'] = minMaxArray('TotalRooms', 'median', $reportItems['comparable']);
            $reportItems['areaTotalRoomsHigh'] = minMaxArray('TotalRooms', 'max', $reportItems['comparable']);

            $reportItems['stories'] = (string)$report187->PropertyProfile->PropertyCharacteristics->NoOfStories[0];
            $propPool = $report187->PropertyProfile->PropertyCharacteristics->Pool[0];
                if ($propPool != 'Yes') {
                    $propPool = 'No';
                }
            $reportItems['propertyPool'] = number_format((double)$report187->PropertyProfile->PropertyCharacteristics->Pool[0]);
            $reportItems['propertyPoolLow'] = number_format((double)minMaxArray('Pool', 'min', $reportItems['comparable']));
            $reportItems['propertyPoolMedian'] = number_format((double)minMaxArray('Pool', 'median', $reportItems['comparable']));
            $reportItems['propertyPoolHign'] = number_format((double)minMaxArray('Pool', 'max', $reportItems['comparable']));

            $reportItems['propertySalePrice'] = number_format((double)$report187->PropertyProfile->SaleLoanInfo->SalesPrice);
            $reportItems['propertySalePriceLow'] =  number_format($salesAnalysis['minPrice']);       //number_format(minMaxArray('PriceRate', 'min', $reportItems['comparable']));
            $reportItems['propertySalePriceMedian'] =   number_format($salesAnalysis['tmp_property']/9); //number_format(minMaxArray('PriceRate', 'median', $reportItems['comparable']));
            $reportItems['propertySalePriceLowHigh'] =  number_format($salesAnalysis['maxPrice']);   //number_format(minMaxArray('PriceRate', 'max', $reportItems['comparable']));

            $areaSalesChart['series']='';
            $areaSalesChart['date']='';

            $minRadius = minMaxArray('Distance', 'min', $reportItems['comparable']);
            $medianRadius = minMaxArray('Distance', 'median', $reportItems['comparable']);
            $maxRadius = minMaxArray('Distance', 'max', $reportItems['comparable']);
            $reportItems['areaMinRadius'] = $minRadius;
            $reportItems['areaMedianRadius'] = $medianRadius;
            $reportItems['areaMaxRadius'] = $maxRadius;


            $ChartArr = array();
            $tmp2=array();

            $totalMonthsReport=0;       
            foreach ($reportItems['comparable'] as $key => $item) {
                /*****************************************/
                if($key > 8) break;
                $date=date_create($item['Date']);
                $tmepDate = date_format($date,"M'y");
                $months[] = array('date'=>$tmepDate,'value'=>$item['PriceRate']);
            }

            foreach ($months as $key => $itemMonth) {
                if($key<(sizeof($months)-1)){
                    $tmp2['date'].=$itemMonth['date'].'|';
                    $tmp2['series'].=$itemMonth['value'].',';
                }else{
                    $tmp2['date'].=$itemMonth['date'];
                    $tmp2['series'].=$itemMonth['value'];
                }
                if($itemMonth['value']!='_'){
                    $totalMonthsReport++;
                }
                array_push($ChartArr, $tmp2);
            }

            $chart_color = !empty($CI->input->post('theme')) ? str_replace("#", "", $CI->input->post('theme')) : '082147';
            // $tmp2['color'] = str_replace("#", "", $CI->input->post('theme'));
            $tmp2['color'] = $chart_color;
            
            $reportItems['chart']=$tmp2;
            $reportItems['totalMonthsReport'] = $totalMonthsReport;
            $data['areaSalesAnalysis'] = $reportItems;
            $data['theme'] = $CI->input->post('theme');
            
            $PdfGenResponse = $this->preparePdf($reportLang, $data, $_POST['presentation'],$report187->PropertyProfile->SiteAddress);
            $pdfFileName = $PdfGenResponse['pdf_filename'];
            $reportGenerated = $PdfGenResponse['report_generated'];
            $errorMsg = $PdfGenResponse['error_msg'];
                
                // if it is an api call then we get the user id from the token
                if($callFromApi == 1){
                    $currentUserId = getUserIdByToken($reportData['token']);
                }else{
                    $currentUserId = $CI->session->userdata('userid');   
                }
            if($reportGenerated) {
                $insertPdfReport =  array(
                                            'project_name'=>$CI->db->escape_str($report187->PropertyProfile->SiteAddress),
                                            'report_path'=>$pdfFileName,
                                            'user_id_fk'=>  $currentUserId,
                                            'property_owner'=>$CI->db->escape_str($report187->PropertyProfile->PrimaryOwnerName),
                                            'property_address'=>$CI->db->escape_str($report187->PropertyProfile->SiteAddress.', '.$report187->PropertyProfile->SiteCity.' '.$report187->PropertyProfile->SiteState.' '.$report187->PropertyProfile->SiteZip),
                                            'property_apn'=>$CI->db->escape_str($report187->PropertyProfile->APN),
                                            'property_lat'=>$CI->db->escape_str($report187->PropertyProfile->PropertyCharacteristics->Latitude),
                                            'property_lng'=>$CI->db->escape_str($report187->PropertyProfile->PropertyCharacteristics->Longitude),
                                            'report_type'=>$_POST['presentation'],
                                    );

                // if it is an api call then we mark it as active
                if($callFromApi == 1){
                    $insertPdfReport['is_active'] = 'Y';
                }

                $CI->base_model->insert_one_row('lp_my_listing', $insertPdfReport);
                $CI->session->set_userdata('project_id', $CI->base_model->get_last_insert_id());

                // if call is from api then we directly send the report link
                if($callFromApi == 1)
                    return array("status"=>true, 'reportLink' => base_url($pdfFileName));
                else
                    return array("status"=>true);
            } else {
                return array("status"=>false,"msg"=>$errorMsg);
            }
        }

        function get_all_properties($report187){
            $_comparableTemp = array();
            $index = 0;  
            for ($j = 0; $j < sizeof($report187->ComparableSalesReport->ComparableSales->ComparableSale); $j++) {
                // echo $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Proximity[0]. '<= 0.2 <br >';
                // if(sizeof($reportItems['comparableTemp'])<9){
                $proximity_val = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Proximity[0].'';
                $build_area = (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->BuildingArea[0].'';
                if(floatval($proximity_val)<=2 ){ //&& ($minBuildArea<=floatval($build_area)) && ($maxBuildArea>=floatval($build_area)) && $months_diff<=12
                    $i = strval($j + 1);
                    $tmp['index'] = $index++;
                    $tmp['Date'] = formatDate((string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->RecordingDate[0]);
                    $tmp['Price'] = dollars(number_format((string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SalePrice[0]));
                    $tmp['PriceRate'] = (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SalePrice[0];
                    $tmp['PricePerSQFT']=(string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->PricePerSQFT[0];
                    $tmp['TotalRooms']=(string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->TotalRooms[0];

                    $tmp['Address'] = properCase((string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SiteAddress[0].' '.$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SiteCity[0]);
                    $tmp['Distance'] = floatval((string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Proximity[0]) ;
                    $tmp['Beds'] = number_format((string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Bedrooms[0]);
                    $tmp['SquareFeet'] = number_format((string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->BuildingArea[0]);
                    $tmp['BuildingArea'] = (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->BuildingArea[0].'';
                    $tmp['Baths'] = (int)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Baths[0];
                    $tmp['Bedrooms'] = (int)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Bedrooms[0];
                    $tmp['Year'] = (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->YearBuilt[0];
                    $tmp['LotSize'] = number_format((string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->LotSize);
                    $tmp['Latitude'] = (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Latitude;
                    $tmp['Longitude'] = (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Longitude;
                    $tmpPool = (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Pool[0];
                    if ($tmpPool != 'Yes') {
                        $tmpPool = 'No';
                    }           
                    $tmp['Pool']=$tmpPool;
                    //$apn= (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->APN[0].'';
                    array_push($_comparableTemp, $tmp);               
                    //array_push($hasComparable, $apn);
                }
            }
            return $_comparableTemp;
        }
        function sort_properties($report187,$_comparableTemp){
            $_maxLimit = 8;
            $comparable = array();
            // print_r($reportItems['comparableTemp']);

            //********* COmpare ale property Sold in last 12 months ************/
            //COmpare ale property +-20 % of build area
            //$reportItems['comparableTempSold'] = array();
            $date = new DateTime();
            $currentdate = $date->format('m/d/Y');
            // $months_diff  = monthsBetween(formatDate($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->RecordingDate[0]),$currentdate); 
            $minBuildArea = (floatval($report187->PropertyProfile->PropertyCharacteristics->BuildingArea)*80/100);//-20%
            $maxBuildArea = (floatval($report187->PropertyProfile->PropertyCharacteristics->BuildingArea)*120/100);//+20%
            $maxBedrooms = (int)$report187->PropertyProfile->PropertyCharacteristics->Bedrooms+1;//+1
            $minBedrooms = (int)$report187->PropertyProfile->PropertyCharacteristics->Bedrooms-1;//-1
            $maxBaths = (int)$report187->PropertyProfile->PropertyCharacteristics->Baths+1;//+1
            $minBaths = (int)$report187->PropertyProfile->PropertyCharacteristics->Baths-1;//-1
            $maxLotSize = (floatval($report187->PropertyProfile->PropertyCharacteristics->LotSize)*120/100);//+20%
            $minLotSize = (floatval($report187->PropertyProfile->PropertyCharacteristics->LotSize)*20/100);//-20%
            $maxPricePerSQFT = (floatval($report187->PropertyProfile->SaleLoanInfo->PricePerSQFT)*120/100);//+20%
            $minPricePerSQFT = (floatval($report187->PropertyProfile->SaleLoanInfo->PricePerSQFT)*80/100);//+20%
            $count = 0;
            foreach ($_comparableTemp as $key => $compareableProperty) {
                if($count++ > ($_maxLimit-1)) break;
                $months_diff  = monthsBetween($compareableProperty['Date'],$currentdate); 
                $build_area  = floatval(str_replace(",","",$compareableProperty['BuildingArea'])); 
                $bedrooms  = (int)$compareableProperty['Bedrooms'];
                $baths  = (int)$compareableProperty['Baths']; 
                $lotSize  = floatval(str_replace(",","",$compareableProperty['LotSize'])); 
                $pricePerSQFT  = floatval(str_replace(",","",$compareableProperty['PricePerSQFT']));
                if($months_diff<=12 && ($minBuildArea<=$build_area && $maxBuildArea>=$build_area) && ($minBedrooms<=$bedrooms && $maxBedrooms>=$bedrooms) && ($minBaths<=$baths && $maxBaths>=$baths) && 
                        ($minLotSize<=$lotSize && $maxLotSize>=$lotSize) && ($minPricePerSQFT<=$pricePerSQFT && $maxPricePerSQFT>=$pricePerSQFT)){
                    array_push($comparable, $compareableProperty);               
                    unset($_comparableTemp[$key]);
                }
            }
            //If comaparable sales count is not 9 then we need to fill remaning from parent set without any conditions
            $_count = count($comparable);
            //echo "Actual Count:".$countComparables;
            if($_count!=$_maxLimit){
                foreach ($_comparableTemp as $key => $compareableProperty) {
                    $months_diff  = monthsBetween($compareableProperty['Date'],$currentdate); 
                    $build_area  = floatval(str_replace(",","",$compareableProperty['BuildingArea'])); 
                    $bedrooms  = (int)$compareableProperty['Bedrooms'];
                    $baths  = (int)$compareableProperty['Baths']; 
                    $pricePerSQFT  = floatval(str_replace(",","",$compareableProperty['PricePerSQFT'])); 
                    if($months_diff<=12 && ($minBuildArea<=$build_area && $maxBuildArea>=$build_area) && ($minBedrooms<=$bedrooms && $maxBedrooms>=$bedrooms) && ($minBaths<=$baths && $maxBaths>=$baths) && 
                            ($minPricePerSQFT<=$pricePerSQFT && $maxPricePerSQFT>=$pricePerSQFT)){
                        array_push($comparable, $compareableProperty);               
                        unset($_comparableTemp[$key]);
                        if(++$_count == $_maxLimit) break;
                    }
                }
            }
            if($_count!=$_maxLimit){
                foreach ($_comparableTemp as $key => $compareableProperty) {
                    $months_diff  = monthsBetween($compareableProperty['Date'],$currentdate); 
                    $build_area  = floatval(str_replace(",","",$compareableProperty['BuildingArea'])); 
                    $bedrooms  = (int)$compareableProperty['Bedrooms'];
                    $pricePerSQFT  = floatval(str_replace(",","",$compareableProperty['PricePerSQFT'])); 
                    if($months_diff<=12 && ($minBuildArea<=$build_area && $maxBuildArea>=$build_area) && ($minBedrooms<=$bedrooms && $maxBedrooms>=$bedrooms) && ($minPricePerSQFT<=$pricePerSQFT && $maxPricePerSQFT>=$pricePerSQFT)){
                        array_push($comparable, $compareableProperty);               
                        unset($_comparableTemp[$key]);
                        if(++$_count == $_maxLimit) break;
                    }
                }
            }
            if($_count!=$_maxLimit){
                foreach ($_comparableTemp as $key => $compareableProperty) {
                    $months_diff  = monthsBetween($compareableProperty['Date'],$currentdate); 
                    $build_area  = floatval(str_replace(",","",$compareableProperty['BuildingArea'])); 
                    $pricePerSQFT  = floatval(str_replace(",","",$compareableProperty['PricePerSQFT'])); 
                    if($months_diff<=12 && ($minBuildArea<=$build_area && $maxBuildArea>=$build_area) && ($minPricePerSQFT<=$pricePerSQFT && $maxPricePerSQFT>=$pricePerSQFT)){
                        array_push($comparable, $compareableProperty);               
                        unset($_comparableTemp[$key]);
                        if(++$_count == $_maxLimit) break;
                    }
                }
            }
            if($_count!=$_maxLimit){
                foreach ($_comparableTemp as $key => $compareableProperty) {
                    $months_diff  = monthsBetween($compareableProperty['Date'],$currentdate); 
                    $pricePerSQFT  = floatval(str_replace(",","",$compareableProperty['PricePerSQFT'])); 
                    if($months_diff<=12 && ($minPricePerSQFT<=$pricePerSQFT && $maxPricePerSQFT>=$pricePerSQFT)){
                        array_push($comparable, $compareableProperty);               
                        unset($_comparableTemp[$key]);
                        if(++$_count == $_maxLimit) break;
                    }
                }
            }
            if($_count!=$_maxLimit){
                foreach ($_comparableTemp as $key => $compareableProperty) {
                    $months_diff  = monthsBetween($compareableProperty['Date'],$currentdate); 
                    if($months_diff<=12){
                        array_push($comparable, $compareableProperty);               
                        unset($_comparableTemp[$key]);
                        if(++$_count == $_maxLimit) break;
                    }
                }
            }
            if($_count!=$_maxLimit){
                foreach ($_comparableTemp as $key => $compareableProperty) {
                    array_push($comparable, $compareableProperty);               
                    unset($_comparableTemp[$key]);
                    if(++$_count == $_maxLimit) break;
                }
            }
            return array('sorted'=>$comparable,'all'=>$_comparableTemp);
        }
        function sales_analysis($sortedComps){
            $firstTime = true;
            $tmp_property = 0; $min_tmp_price = 0; $max_tmp_price = 0;
            $tmp_lot_size = 0; $min_lot_size = 0; $max_lot_size = 0; $minPrice = $maxPrice = $count = 0;
            foreach ($sortedComps as $compareableProperty) {
                $lotSize  = floatval(str_replace(",","",$compareableProperty['LotSize'])); 
                $this->_prepareMinMaxComparable($compareableProperty['PriceRate'],$firstTime,$minPrice, $maxPrice,$tmp_property,$tmp_lot_size, $lotSize,$min_lot_size,$max_lot_size);
            }
            $result = array('minPrice'=>$minPrice, 'maxPrice'=>$maxPrice,'tmp_property'=>$tmp_property,'min_lot_size'=>$min_lot_size,'max_lot_size'=>$max_lot_size,'tmp_lot_size'=>$tmp_lot_size);
            return $result;
        }
        /**
         * Prepares PDF files from HTML and static pdf pages
         * @param $reportLang string Report Language
         * @param $data array set of report data
         * @param $presentationType string
         * @param $siteAddress string Property Address
         * @return array Generation Status and filepath/error message
         */
        function preparePdf($reportLang,$data,$presentationType,$siteAddress){
            $CI = & get_instance();
            
            if(empty($reportLang)){
                $reportLang = 'english';
            }
            
            //@var $turboMode boolean If true than it uses pre stored static theme pages and using qpdf tool it merge these with dynamic content pdf being gnerated with wkhtmltopdf tool
            $turboMode = false;
            //if(($presentationType=="seller" || $presentationType=="buyer") && $reportLang=='english'){
            if($presentationType=="buyer" && $reportLang=='english'){
                $themeMap = array(
                    //@todo: Set these indexes as unique color code in DB table
                    "coldwell_banker"=>rgb2hex("rgb(0,41,128)"),
                    "keller_williams_burgundy"=>rgb2hex("rgb(180,1,1)"),
                    "dilbeck_green"=>rgb2hex("rgb(0,51,13)"),
                    "modern_black"=>rgb2hex("rgb(15,15,15)"),
                    "modern_gray"=>rgb2hex("rgb(149,165,166)"),
                    "modern_orange"=>rgb2hex("rgb(255,92,57)"),
                    "modern_teal"=>rgb2hex("rgb(27,188,155)"),
                    "prudential_blue"=>rgb2hex("rgb(8,72,135)"),
                    "purple_intero"=>rgb2hex("rgb(122,0,61)"),
                    "realty_excutives_blie"=>rgb2hex("rgb(0,28,61)"),
                    "realty_world_red"=>rgb2hex("rgb(239, 26, 44)"),
                    "red_remax"=>rgb2hex("rgb(180,28,48)"),
                    "sotheby_blue"=>rgb2hex("rgb(0, 35, 73)"),
                    "teal_exit"=>rgb2hex("rgb(0,140,154)"),

                );
                foreach($themeMap as $index=>$_color){
                    if(trim($data['theme'])==$_color){
                        $colorCode = $index;
                    }
                }
                //Finding if there are static pdf pages available for this theme. If found then set $turboMode true.
                $tailFile = "temp/static/{$presentationType}/".$colorCode.'_tail.pdf';
                $contentsFile = "temp/static/{$presentationType}/".$colorCode.'_contents.pdf';
                if(file_exists($tailFile) && filesize($tailFile)>1 && file_exists($contentsFile) && filesize($contentsFile)>1){
                    $turboMode = true;
                }
            }

            /**
             * Start Code to fetch customized text data of user
             */
            $data['user_id_for_report_customization'] = 0;
            if ($data['user']['email'] != '') {
                $CI->load->model('user_model');
                $userInfo = $CI->user_model->getUserDetailsByEmail($data['user']['email'], ['user_id_pk', 'email', 'role_id_fk', 'customer_id', 'ref_code']);
                $data['user_id_for_report_customization'] = $userInfo['user_id_pk'];
            }

            $customization_data = [];
            if ($presentationType=="seller" && !empty($data['user_id_for_report_customization'])) {
                $CI->load->model('report_model');
                $customization_data['9']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 9);
                $customization_data['10']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 10);
                $customization_data['11']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 11);
                $customization_data['12']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 12);
                $customization_data['13']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 13);
                $customization_data['14']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 14);
                $customization_data['15']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 15);
                $customization_data['16']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 16);
                $customization_data['17']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 17);
                $customization_data['18']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 18);
                $customization_data['19']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 19);
            }
            $data['customization_pages_data'] = $customization_data;

            /**
             * END Code to fetch customized text data of user
             */

            if($turboMode){
                $html = $CI->load->view("reports/".$reportLang."/".$presentationType."/dynamic",$data,true);
            } else {
                $html = $CI->load->view("reports/".$reportLang."/".$presentationType."/index",$data,true);
            
            }
            // echo "<pre>"; print_r($html); exit;
            //file_put_contents("tmp.html", $html);
            $wkhtmltopdfPath =  $CI->config->item('wkhtmltopdf_path');
            if($turboMode && $presentationType=='seller' && $reportLang=='english'){
                $zoom =  $CI->config->item('wkhtmltopdf_zoom_seller');    
            } else {
                $zoom =  $CI->config->item('wkhtmltopdf_zoom');
            }
            $snappy = new Pdf($wkhtmltopdfPath);
            //$snappy = new Pdf($this->binaryPath);
            $options = [
                'margin-top'    => 0,
                'margin-right'  => 0,
                'margin-bottom' => 0,
                'margin-left'   => 0,
                'page-size' => 'Letter', 
                'zoom'          => $zoom,
                'load-error-handling'=>'ignore',
                'load-media-error-handling'=>'ignore'
            ];
            $output = $snappy->getOutputFromHtml($html, $options,
                        200,
                        array(
                            'Content-Type'          => 'application/pdf',
                            'Content-Disposition'   => 'attachment; filename="report.pdf"'
                        ));
            $pdfFileName = $pdfFileDynamic = 'temp/'.str_replace(" ", "_", $siteAddress).'_'.md5(time() . rand()).'.pdf';
            file_put_contents($pdfFileDynamic, $output);
            if(filesize($pdfFileDynamic)<10000){// Output pdf should be atleast 100KB of size otherwise some error has occured
                return array( 
                    'report_generated' => false,
                    'error_msg' => "Empty PDF generated while trying to create ".$reportLang." ".$presentationType." Report for user account ".$CI->session->userdata('user_email'),
                    'pdf_filename'=> ''
                );
            }
            if($turboMode){
                $qpdf_path =  $CI->config->item('qpdf_path');
                //Merging Static pdf pages with dynamic pdf pages
                $pdfFileName = 'temp/'.str_replace(" ", "_", $siteAddress).'_'.md5(time() . rand()).'.pdf';
                if($presentationType=="seller"){
                    $res = exec($qpdf_path." {$pdfFileDynamic} --pages {$pdfFileDynamic} 1 {$contentsFile} 1 {$pdfFileDynamic} 2-7 {$tailFile} 1-12 -- {$pdfFileName}");
                } else {
                    $res = exec($qpdf_path." {$pdfFileDynamic} --pages {$pdfFileDynamic} 1 {$contentsFile} 1 {$pdfFileDynamic} 2-6 {$tailFile} 1-13 -- {$pdfFileName}");
                }
                //Removing dynamic as it is not needed any more
                unlink($pdfFileDynamic);
            } /*else {
                $pdfFileName = $pdfFileDynamic;
                //$res = exec("qpdf  {$pdffFileDynamic} --pages {$pdfFileDynamic} 1 temp/S-2.pdf 1 {$pdfFileDynamic} 2-7 temp/S-9-20.pdf 1-12 -- {$pdfFileName}");
            }*/
            return array(
                'report_generated' => true,
                'pdf_filename'=>$pdfFileName,
                'error_msg' => ''
            );
        }

        function getPropertyDataForWidget($reportData = array()){
            $CI = & get_instance();
            $errorMsg = "Unexpacted error occured while trying to create ".$_POST['report_lang']." ".$_POST['presentation']." Report PDF for user account ".$CI->session->userdata('user_email');
            // loading the required helper
            $CI->load->helper('dataapi');
            
            // if call is from the API then we give the data after processing on our end
            /*if($callFromApi == 1){
                $_POST = $reportData;
                $data['callFromApi'] = $callFromApi;
            }*/

            $rep111 = $_POST['report111'];
            $reportLang = isset($_POST['report_lang']) && !empty($_POST['report_lang']) ? strtolower($_POST['report_lang']) : '';
            $compKeys = json_decode(stripslashes($_POST['custom_comps']));
            $rep111 = urldecode($rep111);
            $report111 = @simplexml_load_file($rep111);
            
            $rep187 = $_POST['report187'];
            $rep187 = urldecode($rep187);
            // $report187 = simplexml_load_file($rep187);
            $test_xml = <<<EOT
<?xml version="1.0" encoding="utf-8"?>
<XML187 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://api.sitexdata.com/GetReport">
  <PropertyProfile>
    <PrimaryOwnerName>PATEL, NIRAV N; PATEL, KARISMA H</PrimaryOwnerName>
    <SecondaryOwnerName />
    <MailAddress>1280 N FAIRBURY LN</MailAddress>
    <MailUnit />
    <MailUnitType />
    <MailCity>ANAHEIM</MailCity>
    <MailState>CA</MailState>
    <MailZip>92807</MailZip>
    <MailZip4>2531</MailZip4>
    <OwnerPhoneNum />
    <SiteAddress>1280 N FAIRBURY LN</SiteAddress>
    <SiteUnit />
    <SiteUnitType />
    <SiteCity>ANAHEIM</SiteCity>
    <SiteState>CA</SiteState>
    <SiteZip>92807</SiteZip>
    <SiteZip4>2531</SiteZip4>
    <APN>351-101-79</APN>
    <CensusTract>0218.07</CensusTract>
    <HousingTract>16128</HousingTract>
    <LotNumber>42</LotNumber>
    <TBMPage />
    <TBMGrid />
    <LegalDescriptionInfo>
      <LotCode>42     </LotCode>
      <Block />
      <Section />
      <District />
      <Subdivision />
      <TractNumber>16128     </TractNumber>
      <PhaseNumber />
      <Unit />
      <LandLot />
      <MapRef />
      <SecTwnshipRange />
      <LegalBriefDescription>LOT:42      TR#:16128      N TR 16128 BLK LOT 42 </LegalBriefDescription>
      <CityMuniTwp />
    </LegalDescriptionInfo>
    <PropertyCharacteristics>
      <Bedrooms>5</Bedrooms>
      <YearBuilt>2002</YearBuilt>
      <BuildingArea>2721</BuildingArea>
      <Baths>4</Baths>
      <GarageType>Garage</GarageType>
      <GarageNumCars>2</GarageNumCars>
      <LotSize>5625</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <TotalRooms />
      <Fireplace />
      <NumUnits>0</NumUnits>
      <Zoning />
      <Pool>S</Pool>
      <UseCode>Single Family Residential</UseCode>
      <Basement />
      <Latitude>33.875478</Latitude>
      <Longitude>-117.753316</Longitude>
      <NoOfStories />
      <BuildingStyle />
    </PropertyCharacteristics>
    <SaleLoanInfo>
      <TransferDate>20200810</TransferDate>
      <SellerName>PATEL, NIRAV N; PATEL, KARISMA H</SellerName>
      <SalesPrice>0</SalesPrice>
      <DocumentNumber>2020000390075</DocumentNumber>
      <Book />
      <Page />
      <PricePerSQFT>0</PricePerSQFT>
      <LoanAmount>347000</LoanAmount>
      <LenderName>VICTORIA FINANCIAL CORP</LenderName>
      <TitleCompany>PACIFIC COAST TITLE COMPANY</TitleCompany>
    </SaleLoanInfo>
    <AssessmentTaxInfo>
      <AssessedValue>632593</AssessedValue>
      <PercentImproved>0.6058</PercentImproved>
      <HomeOwnerExemption>H</HomeOwnerExemption>
      <LandValue>249378</LandValue>
      <TaxAmount>7212.4</TaxAmount>
      <TaxRateArea>1-123</TaxRateArea>
      <ImprovementValue>383215</ImprovementValue>
      <TaxAccountID />
      <TaxStatus>Current</TaxStatus>
      <MarketImprovementValue>0</MarketImprovementValue>
      <MarketLandValue>0</MarketLandValue>
      <MarketValue>0</MarketValue>
      <TaxYear>2020</TaxYear>
    </AssessmentTaxInfo>
  </PropertyProfile>
  <Status>OK</Status>
  <PropertyMapURL>https://sitexgis.sitexdata.com/DisplayMap/displaymapv2.aspx?mapstring=nVNBcsMgDPwKHp%2bbQWCMfZSBOLQEMgTHk7ylw9uL03Q6PTRxctNBq5V2V6gzsI4ST7Zo4zDFM3G%2bUimjx52x%2b%2bqYssLqcsh9aZOVw8z5ppOikV3lQn4DkBspOIf2E3UWQlCCJ%2bOtRrJ1IRqvLC7zziEOSJz1Gv%2fM7OQVJwvuZJFo48ghpGhiWIESEl5hY7DQKWcwzphMJDo%2bBnXAKDFkiCF8aHTmrk7X7fpWkndUGLFMvLXf5wDGoVjhzn4OQd%2fW%2bp%2bh3NFSkoLWiwor9Gp68a2yRX9ZYwvnfbnY%2bHTd5%2bBWyMS4eEomBi0IotCV3uL%2biHqN8y385gx9suO05pwX8wKs6Ystsy07JqLsI1uoFIwMZgx%2b0XpFtl5%2fG%2foSjgH%2fSUL5txFP1uGKeLa04c%2bpXu8yl7Ses6C0vmTgtVJ5OtYKM60nlaG2%2b1LtS%2fUF</PropertyMapURL>
  <ComparableSalesReport>
    <ComparableSales>
      <ComparableSale>
        <Proximity>.41</Proximity>
        <Latitude>33.881195</Latitude>
        <Longitude>-117.755299</Longitude>
        <SiteAddress>5550 AVENIDA FLORENCIA</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3522</SiteZip4>
        <RecordingDate>20210323</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>985000</SalePrice>
        <PricePerSQFT>423</PricePerSQFT>
        <BuildingArea>2328</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>4</Bedrooms>
        <Baths>2</Baths>
        <YearBuilt>1982</YearBuilt>
        <LotSize>10320</LotSize>
        <Pool />
        <APN>351-472-16</APN>
        <DocumentNumber>2021000199067</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>31</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 9906</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 468 PG 41-44</MapRef>
        <Buyer1FName>KENNETH</Buyer1FName>
        <Buyer1LName>KLINGAMAN</Buyer1LName>
        <Buyer2FName>BRITTANI THURMAN</Buyer2FName>
        <Buyer2LName>KLINGAMAN</Buyer2LName>
        <Seller1FName>STEVE MITCHELL</Seller1FName>
        <Seller1LName>JONES</Seller1LName>
        <Seller2FName />
        <Seller2LName />
        <LenderName>AXIA FINANCIAL LLC</LenderName>
        <Loan1Amount>822000</Loan1Amount>
        <PID>3673203</PID>
        <AssessmentValue>380556</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.48</Proximity>
        <Latitude>33.878388</Latitude>
        <Longitude>-117.760834</Longitude>
        <SiteAddress>5750 VIA DEL POTRERO</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3549</SiteZip4>
        <RecordingDate>20210316</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>1100000</SalePrice>
        <PricePerSQFT>394</PricePerSQFT>
        <BuildingArea>2791</BuildingArea>
        <TotalRooms>0</TotalRooms>
        <Bedrooms>4</Bedrooms>
        <Baths>3</Baths>
        <YearBuilt>1986</YearBuilt>
        <LotSize>5565</LotSize>
        <Pool>Yes</Pool>
        <APN>351-631-46</APN>
        <DocumentNumber>2021000181360</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>4</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 12475</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 548 PG 29 30</MapRef>
        <Buyer1FName>MICHAEL R</Buyer1FName>
        <Buyer1LName>FLEISCHNER</Buyer1LName>
        <Buyer2FName>RAQUEL R</Buyer2FName>
        <Buyer2LName>FLEISCHNER</Buyer2LName>
        <Seller1FName>JOHN P</Seller1FName>
        <Seller1LName>MURPHY III</Seller1LName>
        <Seller2FName>THERESA A</Seller2FName>
        <Seller2LName>MURPHY</Seller2LName>
        <LenderName>UNITED WHOLESALE MORTGAGE</LenderName>
        <Loan1Amount>700000</Loan1Amount>
        <PID>3669455</PID>
        <AssessmentValue>489552</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.38</Proximity>
        <Latitude>33.880704</Latitude>
        <Longitude>-117.755629</Longitude>
        <SiteAddress>5571 AVENIDA FLORENCIA</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3524</SiteZip4>
        <RecordingDate>20210315</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>995000</SalePrice>
        <PricePerSQFT>391</PricePerSQFT>
        <BuildingArea>2542</BuildingArea>
        <TotalRooms>9</TotalRooms>
        <Bedrooms>5</Bedrooms>
        <Baths>3</Baths>
        <YearBuilt>1982</YearBuilt>
        <LotSize>9600</LotSize>
        <Pool>Yes</Pool>
        <APN>351-472-13</APN>
        <DocumentNumber>2021000177408</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>28</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 9906</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 468 PG 35-40</MapRef>
        <Buyer1FName>AHSAN</Buyer1FName>
        <Buyer1LName>SOHEL</Buyer1LName>
        <Buyer2FName />
        <Buyer2LName />
        <Seller1FName>THOMAS A</Seller1FName>
        <Seller1LName>COLLINS</Seller1LName>
        <Seller2FName />
        <Seller2LName />
        <LenderName>KEY BANK NA</LenderName>
        <Loan1Amount>796000</Loan1Amount>
        <PID>3669030</PID>
        <AssessmentValue>947128</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.48</Proximity>
        <Latitude>33.882442</Latitude>
        <Longitude>-117.752869</Longitude>
        <SiteAddress>21750 CLEARWATER DR</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3704</SiteZip4>
        <RecordingDate>20210311</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>991000</SalePrice>
        <PricePerSQFT>448</PricePerSQFT>
        <BuildingArea>2212</BuildingArea>
        <TotalRooms>7</TotalRooms>
        <Bedrooms>3</Bedrooms>
        <Baths>2</Baths>
        <YearBuilt>1985</YearBuilt>
        <LotSize>10125</LotSize>
        <Pool>Yes</Pool>
        <APN>351-594-06</APN>
        <DocumentNumber>2021000168936</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>46</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 12010</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 524 PG 13-19</MapRef>
        <Buyer1FName>LYLE</Buyer1FName>
        <Buyer1LName>STONE</Buyer1LName>
        <Buyer2FName>TAMMIE</Buyer2FName>
        <Buyer2LName>DUDLEY</Buyer2LName>
        <Seller1FName>BRIAN HENRY</Seller1FName>
        <Seller1LName>ASCIAK</Seller1LName>
        <Seller2FName>KAMALA SUE</Seller2FName>
        <Seller2LName>ASCIAK</Seller2LName>
        <LenderName>COMMERCE HOME MORTGAGE LLC</LenderName>
        <Loan1Amount>743250</Loan1Amount>
        <PID>3667425</PID>
        <AssessmentValue>885428</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.17</Proximity>
        <Latitude>33.873517</Latitude>
        <Longitude>-117.754972</Longitude>
        <SiteAddress>8120 E BROOKDALE LN</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>ANAHEIM</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92807</SiteZip>
        <SiteZip4>2526</SiteZip4>
        <RecordingDate>20210310</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>870000</SalePrice>
        <PricePerSQFT>319</PricePerSQFT>
        <BuildingArea>2721</BuildingArea>
        <TotalRooms>0</TotalRooms>
        <Bedrooms>4</Bedrooms>
        <Baths>4</Baths>
        <YearBuilt>2001</YearBuilt>
        <LotSize>4881</LotSize>
        <Pool />
        <APN>351-871-04</APN>
        <DocumentNumber>2021000167620</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>4</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
        <SubdivisionName>TRACT NO 16128</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 824 PG 1-8</MapRef>
        <Buyer1FName>JOSEPH ASENCION</Buyer1FName>
        <Buyer1LName>BARRERA</Buyer1LName>
        <Buyer2FName />
        <Buyer2LName />
        <Seller1FName>BESSIE</Seller1FName>
        <Seller1LName>PAYAN</Seller1LName>
        <Seller2FName />
        <Seller2LName />
        <LenderName>HOME POINT FINANCIAL CORPORATION</LenderName>
        <Loan1Amount>645000</Loan1Amount>
        <PID>3667291</PID>
        <AssessmentValue>800000</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.75</Proximity>
        <Latitude>33.877429</Latitude>
        <Longitude>-117.766118</Longitude>
        <SiteAddress>5967 JACARANDA LN</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3327</SiteZip4>
        <RecordingDate>20210126</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>995000</SalePrice>
        <PricePerSQFT>370</PricePerSQFT>
        <BuildingArea>2688</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>2</Bedrooms>
        <Baths>2</Baths>
        <YearBuilt>1980</YearBuilt>
        <LotSize>8250</LotSize>
        <Pool />
        <APN>351-151-27</APN>
        <DocumentNumber>2021000055630</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>44</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 9542</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 424 PG 7-10</MapRef>
        <Buyer1FName>MICHAEL</Buyer1FName>
        <Buyer1LName>KIRCHMANN II</Buyer1LName>
        <Buyer2FName />
        <Buyer2LName />
        <Seller1FName>IAN PAUL</Seller1FName>
        <Seller1LName>HICKS</Seller1LName>
        <Seller2FName>JANET MARION</Seller2FName>
        <Seller2LName>HICKS</Seller2LName>
        <LenderName>UNITED FINANCE INC</LenderName>
        <Loan1Amount>548000</Loan1Amount>
        <AddSellers>
          <AddSeller>
            <AdditionalInfo>
              <FirstName />
              <LastName>HICKS FAMILY TRUST</LastName>
            </AdditionalInfo>
          </AddSeller>
        </AddSellers>
        <PID>3644714</PID>
        <AssessmentValue>547423</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.44</Proximity>
        <Latitude>33.873363</Latitude>
        <Longitude>-117.760503</Longitude>
        <SiteAddress>1231 N LYNWOOD DR</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>ANAHEIM</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92807</SiteZip>
        <SiteZip4>2518</SiteZip4>
        <RecordingDate>20201217</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>858000</SalePrice>
        <PricePerSQFT>360</PricePerSQFT>
        <BuildingArea>2379</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>4</Bedrooms>
        <Baths>2</Baths>
        <YearBuilt>1980</YearBuilt>
        <LotSize>6050</LotSize>
        <Pool />
        <APN>351-051-32</APN>
        <DocumentNumber>2020000746426</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>4</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
        <SubdivisionName>TRACT NO 9172</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 438 PG 47 48</MapRef>
        <Buyer1FName>WHINKLER</Buyer1FName>
        <Buyer1LName>ZAMORA JR</Buyer1LName>
        <Buyer2FName>ELIZABETH ANITA</Buyer2FName>
        <Buyer2LName>ORNELAS</Buyer2LName>
        <Seller1FName>VINCENT</Seller1FName>
        <Seller1LName>WAYNE</Seller1LName>
        <Seller2FName />
        <Seller2LName />
        <LenderName>FAIRWAY INDEPENDENT MORTGAGE CORP</LenderName>
        <Loan1Amount>686400</Loan1Amount>
        <PID>3628065</PID>
        <AssessmentValue>828240</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.58</Proximity>
        <Latitude>33.883909</Latitude>
        <Longitude>-117.752814</Longitude>
        <SiteAddress>21760 TODD AVE</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3723</SiteZip4>
        <RecordingDate>20201201</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>1060000</SalePrice>
        <PricePerSQFT>462</PricePerSQFT>
        <BuildingArea>2292</BuildingArea>
        <TotalRooms>0</TotalRooms>
        <Bedrooms>4</Bedrooms>
        <Baths>3</Baths>
        <YearBuilt>1987</YearBuilt>
        <LotSize>10400</LotSize>
        <Pool>Yes</Pool>
        <APN>351-692-07</APN>
        <DocumentNumber>2020000702406</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>12</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 12020</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 538 PG 42-48</MapRef>
        <Buyer1FName>IAN T</Buyer1FName>
        <Buyer1LName>JUSTINIANI</Buyer1LName>
        <Buyer2FName>JILLL K</Buyer2FName>
        <Buyer2LName>JUSTINIANI</Buyer2LName>
        <Seller1FName>CHARLES</Seller1FName>
        <Seller1LName>RAZO</Seller1LName>
        <Seller2FName>SHANNON</Seller2FName>
        <Seller2LName>EVANS</Seller2LName>
        <LenderName>UNITED WHOLESALE MORTGAGE</LenderName>
        <Loan1Amount>765000</Loan1Amount>
        <PID>3620365</PID>
        <AssessmentValue>941562</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.75</Proximity>
        <Latitude>33.882407</Latitude>
        <Longitude>-117.763306</Longitude>
        <SiteAddress>5495 VIA DIANZA</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>2528</SiteZip4>
        <RecordingDate>20201103</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>1250000</SalePrice>
        <PricePerSQFT>470</PricePerSQFT>
        <BuildingArea>2654</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>4</Bedrooms>
        <Baths>3</Baths>
        <YearBuilt>1978</YearBuilt>
        <LotSize>10624</LotSize>
        <Pool>Yes</Pool>
        <APN>351-173-02</APN>
        <DocumentNumber>2020000630206</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>52</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 9957</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 424 PG 39-43</MapRef>
        <Buyer1FName>LILIAN</Buyer1FName>
        <Buyer1LName>LEE</Buyer1LName>
        <Buyer2FName />
        <Buyer2LName />
        <Seller1FName>ROBERT A</Seller1FName>
        <Seller1LName>PAGE</Seller1LName>
        <Seller2FName>SHEILA J</Seller2FName>
        <Seller2LName>PAGE</Seller2LName>
        <LenderName>FINANCE OF AMERICA MORTGAGE LLC</LenderName>
        <Loan1Amount>765000</Loan1Amount>
        <PID>3607234</PID>
        <AssessmentValue>567550</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.75</Proximity>
        <Latitude>33.883998</Latitude>
        <Longitude>-117.745259</Longitude>
        <SiteAddress>5339 BRENTWOOD PL</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>2728</SiteZip4>
        <RecordingDate>20201029</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>1500000</SalePrice>
        <PricePerSQFT>541</PricePerSQFT>
        <BuildingArea>2769</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>3</Bedrooms>
        <Baths>2</Baths>
        <YearBuilt>1983</YearBuilt>
        <LotSize>17500</LotSize>
        <Pool>Pool/Spa</Pool>
        <APN>352-092-06</APN>
        <DocumentNumber>2020000617569</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>6</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 10504</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 462 PG 10-22</MapRef>
        <Buyer1FName>MICHAEL J</Buyer1FName>
        <Buyer1LName>ROTHANS</Buyer1LName>
        <Buyer2FName>LISA M</Buyer2FName>
        <Buyer2LName>ROTHANS</Buyer2LName>
        <Seller1FName>JERRY</Seller1FName>
        <Seller1LName>BRAKEBILL</Seller1LName>
        <Seller2FName>KIM R</Seller2FName>
        <Seller2LName>BRAKEBILL</Seller2LName>
        <LenderName>WELLS FARGO BANK NA</LenderName>
        <Loan1Amount>1160000</Loan1Amount>
        <AddBuyers>
          <AddBuyer>
            <AdditionalInfo>
              <FirstName />
              <LastName>ROTHANS FAMILY TRUST</LastName>
            </AdditionalInfo>
          </AddBuyer>
        </AddBuyers>
        <AddSellers>
          <AddSeller>
            <AdditionalInfo>
              <FirstName />
              <LastName>JERRY AND KIM R BRAKEBILL FAMILY TRUST</LastName>
            </AdditionalInfo>
          </AddSeller>
        </AddSellers>
        <PID>3608650</PID>
        <AssessmentValue>885113</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.09</Proximity>
        <Latitude>33.874238</Latitude>
        <Longitude>-117.752629</Longitude>
        <SiteAddress>8235 E BROOKDALE LN</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>ANAHEIM</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92807</SiteZip>
        <SiteZip4>2529</SiteZip4>
        <RecordingDate>20200916</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>931500</SalePrice>
        <PricePerSQFT>297</PricePerSQFT>
        <BuildingArea>3130</BuildingArea>
        <TotalRooms>0</TotalRooms>
        <Bedrooms>5</Bedrooms>
        <Baths>4</Baths>
        <YearBuilt>2001</YearBuilt>
        <LotSize>5052</LotSize>
        <Pool />
        <APN>351-871-46</APN>
        <DocumentNumber>2020000497645</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>68</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
        <SubdivisionName>TRACT NO 16128</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 824 PG 1-8</MapRef>
        <Buyer1FName>LINA ZHAN</Buyer1FName>
        <Buyer1LName>RAGLAND</Buyer1LName>
        <Buyer2FName />
        <Buyer2LName />
        <Seller1FName>VANNIN</Seller1FName>
        <Seller1LName>GALE</Seller1LName>
        <Seller2FName>PATRICIA</Seller2FName>
        <Seller2LName>GALE</Seller2LName>
        <LenderName />
        <Loan1Amount>0</Loan1Amount>
        <PID>3584497</PID>
        <AssessmentValue>628979</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.31</Proximity>
        <Latitude>33.878798</Latitude>
        <Longitude>-117.756869</Longitude>
        <SiteAddress>21615 CALLE DELGADO</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3531</SiteZip4>
        <RecordingDate>20200828</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>1090000</SalePrice>
        <PricePerSQFT>379</PricePerSQFT>
        <BuildingArea>2874</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>4</Bedrooms>
        <Baths>3</Baths>
        <YearBuilt>1981</YearBuilt>
        <LotSize>7500</LotSize>
        <Pool>Pool/Spa</Pool>
        <APN>351-463-02</APN>
        <DocumentNumber>2020000448125</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>10</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 10305</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 468 PG 35-40</MapRef>
        <Buyer1FName>RAMONA</Buyer1FName>
        <Buyer1LName>BURGOS BOYD</Buyer1LName>
        <Buyer2FName>LETICIA</Buyer2FName>
        <Buyer2LName>BURGOS BOYD</Buyer2LName>
        <Seller1FName>JOSEPH A</Seller1FName>
        <Seller1LName>BALDO</Seller1LName>
        <Seller2FName>BARBARA A</Seller2FName>
        <Seller2LName>BALDO</Seller2LName>
        <LenderName>UNITED WHOLESALE MORTGAGE</LenderName>
        <Loan1Amount>765000</Loan1Amount>
        <AddSellers>
          <AddSeller>
            <AdditionalInfo>
              <FirstName />
              <LastName>BALDO FAMILY TRUST</LastName>
            </AdditionalInfo>
          </AddSeller>
        </AddSellers>
        <PID>3578608</PID>
        <AssessmentValue>441781</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.34</Proximity>
        <Latitude>33.879824</Latitude>
        <Longitude>-117.756103</Longitude>
        <SiteAddress>5610 AVENIDA ANTIGUA</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3503</SiteZip4>
        <RecordingDate>20200824</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>940000</SalePrice>
        <PricePerSQFT>369</PricePerSQFT>
        <BuildingArea>2542</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>5</Bedrooms>
        <Baths>3</Baths>
        <YearBuilt>1981</YearBuilt>
        <LotSize>7500</LotSize>
        <Pool>Yes</Pool>
        <APN>351-463-09</APN>
        <DocumentNumber>2020000432012</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>17</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT 10305</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 468 PG 35-40</MapRef>
        <Buyer1FName>STEVEN JAMES</Buyer1FName>
        <Buyer1LName>WHITMAN</Buyer1LName>
        <Buyer2FName>ALICIA MARIE</Buyer2FName>
        <Buyer2LName>WHITMAN</Buyer2LName>
        <Seller1FName>HAROLD</Seller1FName>
        <Seller1LName>ELDRED</Seller1LName>
        <Seller2FName>JEAN</Seller2FName>
        <Seller2LName>ELDRED</Seller2LName>
        <LenderName>UNITED WHOLESALE MORTGAGE</LenderName>
        <Loan1Amount>752000</Loan1Amount>
        <PID>3575886</PID>
        <AssessmentValue>708504</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.38</Proximity>
        <Latitude>33.880704</Latitude>
        <Longitude>-117.755629</Longitude>
        <SiteAddress>5571 AVENIDA FLORENCIA</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3524</SiteZip4>
        <RecordingDate>20200807</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>675000</SalePrice>
        <PricePerSQFT>265</PricePerSQFT>
        <BuildingArea>2542</BuildingArea>
        <TotalRooms>9</TotalRooms>
        <Bedrooms>5</Bedrooms>
        <Baths>3</Baths>
        <YearBuilt>1982</YearBuilt>
        <LotSize>9600</LotSize>
        <Pool>Yes</Pool>
        <APN>351-472-13</APN>
        <DocumentNumber>2020000389014</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>28</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 9906</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 468 PG 35-40</MapRef>
        <Buyer1FName>THOMAS A</Buyer1FName>
        <Buyer1LName>COLLINS</Buyer1LName>
        <Buyer2FName />
        <Buyer2LName />
        <Seller1FName />
        <Seller1LName>WESTMOR INVESTMENTS</Seller1LName>
        <Seller2FName />
        <Seller2LName />
        <LenderName>CELEBRITY HOME LOANS LLC</LenderName>
        <Loan1Amount>509500</Loan1Amount>
        <PID>3569016</PID>
        <AssessmentValue>947128</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.65</Proximity>
        <Latitude>33.873071</Latitude>
        <Longitude>-117.7642</Longitude>
        <SiteAddress>1249 N WILLET CIR</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>ANAHEIM</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92807</SiteZip>
        <SiteZip4>2426</SiteZip4>
        <RecordingDate>20200807</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>800000</SalePrice>
        <PricePerSQFT>344</PricePerSQFT>
        <BuildingArea>2320</BuildingArea>
        <TotalRooms>5</TotalRooms>
        <Bedrooms>3</Bedrooms>
        <Baths>3</Baths>
        <YearBuilt>1975</YearBuilt>
        <LotSize>5450</LotSize>
        <Pool>Pool/Spa</Pool>
        <APN>351-061-45</APN>
        <DocumentNumber>2020000389582</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>6</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
        <SubdivisionName>TRACT NO 7417</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 351 PG 9-11</MapRef>
        <Buyer1FName>NICHOLAS J</Buyer1FName>
        <Buyer1LName>SIMMONS</Buyer1LName>
        <Buyer2FName>COURTNEY CAITLIN</Buyer2FName>
        <Buyer2LName>SIMMONS</Buyer2LName>
        <Seller1FName>MATTHEW J</Seller1FName>
        <Seller1LName>KIRKENDALL</Seller1LName>
        <Seller2FName>CORINNE N</Seller2FName>
        <Seller2LName>KIRKENDALL</Seller2LName>
        <LenderName>UNITED WHOLESALE MORTGAGE</LenderName>
        <Loan1Amount>640000</Loan1Amount>
        <PID>3569089</PID>
        <AssessmentValue>784788</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.74</Proximity>
        <Latitude>33.874583</Latitude>
        <Longitude>-117.766254</Longitude>
        <SiteAddress>20752 BEGONIA DR</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3300</SiteZip4>
        <RecordingDate>20200707</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>765000</SalePrice>
        <PricePerSQFT>307</PricePerSQFT>
        <BuildingArea>2491</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>3</Bedrooms>
        <Baths>2</Baths>
        <YearBuilt>1978</YearBuilt>
        <LotSize>8850</LotSize>
        <Pool />
        <APN>351-143-03</APN>
        <DocumentNumber>2020000320326</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>3</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 9542</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 424 PG 7-10</MapRef>
        <Buyer1FName>PHILLIP</Buyer1FName>
        <Buyer1LName>SANTANGELO</Buyer1LName>
        <Buyer2FName>ERIN</Buyer2FName>
        <Buyer2LName>SANTANGELO</Buyer2LName>
        <Seller1FName>DAVID L</Seller1FName>
        <Seller1LName>BROOKS</Seller1LName>
        <Seller2FName />
        <Seller2LName>THE BROOKS RISLEY FAMILY TRUST</Seller2LName>
        <LenderName>QUICKEN LOANS INC</LenderName>
        <Loan1Amount>688500</Loan1Amount>
        <PID>3557038</PID>
        <AssessmentValue>360921</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.41</Proximity>
        <Latitude>33.881195</Latitude>
        <Longitude>-117.755299</Longitude>
        <SiteAddress>5550 AVENIDA FLORENCIA</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3522</SiteZip4>
        <RecordingDate>20200625</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>885000</SalePrice>
        <PricePerSQFT>380</PricePerSQFT>
        <BuildingArea>2328</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>4</Bedrooms>
        <Baths>2</Baths>
        <YearBuilt>1982</YearBuilt>
        <LotSize>10320</LotSize>
        <Pool />
        <APN>351-472-16</APN>
        <DocumentNumber>2020000297075</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>31</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 9906</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 468 PG 35-40</MapRef>
        <Buyer1FName>STEVE MITCHELL</Buyer1FName>
        <Buyer1LName>JONES</Buyer1LName>
        <Buyer2FName />
        <Buyer2LName />
        <Seller1FName>DANIEL THOMAS</Seller1FName>
        <Seller1LName>VINCENT</Seller1LName>
        <Seller2FName>MARY ANN</Seller2FName>
        <Seller2LName>VINCENT</Seller2LName>
        <LenderName>FAIRWAY INDEPENDENT MORTGAGE CORP</LenderName>
        <Loan1Amount>741790</Loan1Amount>
        <AddSellers>
          <AddSeller>
            <AdditionalInfo>
              <FirstName />
              <LastName>DANIEL T &amp; MARY ANN VINCENT FAMILY TRUST</LastName>
            </AdditionalInfo>
          </AddSeller>
        </AddSellers>
        <PID>3552494</PID>
        <AssessmentValue>380556</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.27</Proximity>
        <Latitude>33.878679</Latitude>
        <Longitude>-117.756039</Longitude>
        <SiteAddress>5700 AVENIDA FLORENCIA</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3523</SiteZip4>
        <RecordingDate>20200318</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>950000</SalePrice>
        <PricePerSQFT>373</PricePerSQFT>
        <BuildingArea>2542</BuildingArea>
        <TotalRooms>9</TotalRooms>
        <Bedrooms>5</Bedrooms>
        <Baths>3</Baths>
        <YearBuilt>1981</YearBuilt>
        <LotSize>7950</LotSize>
        <Pool>Pool/Spa</Pool>
        <APN>351-464-10</APN>
        <DocumentNumber>2020000123078</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>41</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 10305</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 468 PG 35-40</MapRef>
        <Buyer1FName>SETH</Buyer1FName>
        <Buyer1LName>DUMOUCHEL</Buyer1LName>
        <Buyer2FName>MAUREEN</Buyer2FName>
        <Buyer2LName>DUMOUCHEL</Buyer2LName>
        <Seller1FName>JOHN C</Seller1FName>
        <Seller1LName>GARDNER</Seller1LName>
        <Seller2FName>LEANNE</Seller2FName>
        <Seller2LName>GARDNER</Seller2LName>
        <LenderName>FIRST REPUBLIC BANK</LenderName>
        <Loan1Amount>712500</Loan1Amount>
        <AddSellers>
          <AddSeller>
            <AdditionalInfo>
              <FirstName />
              <LastName>JOHN C GARDNER AND LEANNE FAMILY TRUST</LastName>
            </AdditionalInfo>
          </AddSeller>
        </AddSellers>
        <PID>3530090</PID>
        <AssessmentValue>652888</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.39</Proximity>
        <Latitude>33.878478</Latitude>
        <Longitude>-117.759049</Longitude>
        <SiteAddress>21395 VIA DEL GAVILAN</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3545</SiteZip4>
        <RecordingDate>20200310</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>810000</SalePrice>
        <PricePerSQFT>367</PricePerSQFT>
        <BuildingArea>2206</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>4</Bedrooms>
        <Baths>2</Baths>
        <YearBuilt>1985</YearBuilt>
        <LotSize>4770</LotSize>
        <Pool>Spa Only</Pool>
        <APN>351-633-10</APN>
        <DocumentNumber>2020000105520</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>22</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 11848</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 526 PG 31-33</MapRef>
        <Buyer1FName>SHAUN</Buyer1FName>
        <Buyer1LName>PICHLER</Buyer1LName>
        <Buyer2FName>TAITIAN</Buyer2FName>
        <Buyer2LName>PANG</Buyer2LName>
        <Seller1FName>SETH</Seller1FName>
        <Seller1LName>DUMOUCHEL</Seller1LName>
        <Seller2FName>MAUREEN</Seller2FName>
        <Seller2LName>DUMOUCHEL</Seller2LName>
        <LenderName>SIERRA PACIFIC MORTGAGE CO INC</LenderName>
        <Loan1Amount>510000</Loan1Amount>
        <AddSellers>
          <AddSeller>
            <AdditionalInfo>
              <FirstName />
              <LastName>SETH &amp; MAUREEN DUMOUCHEL LIV TR 2018</LastName>
            </AdditionalInfo>
          </AddSeller>
        </AddSellers>
        <PID>3521824</PID>
        <AssessmentValue>658365</AssessmentValue>
      </ComparableSale>
      <ComparableSale>
        <Proximity>.27</Proximity>
        <Latitude>33.876611</Latitude>
        <Longitude>-117.757869</Longitude>
        <SiteAddress>6043 AVENIDA ANTIGUA</SiteAddress>
        <SiteUnit />
        <SiteUnitType />
        <SiteCity>YORBA LINDA</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>92887</SiteZip>
        <SiteZip4>3513</SiteZip4>
        <RecordingDate>20200226</RecordingDate>
        <PriceCode>R</PriceCode>
        <SalePrice>830000</SalePrice>
        <PricePerSQFT>356</PricePerSQFT>
        <BuildingArea>2328</BuildingArea>
        <TotalRooms>8</TotalRooms>
        <Bedrooms>4</Bedrooms>
        <Baths>2</Baths>
        <YearBuilt>1979</YearBuilt>
        <LotSize>7500</LotSize>
        <Pool />
        <APN>351-251-02</APN>
        <DocumentNumber>2020000082166</DocumentNumber>
        <DocumentType>Grant Deed</DocumentType>
        <UseCodeDescription>Single Family Residential</UseCodeDescription>
        <LotCode />
        <LotNumber>37</LotNumber>
        <Block />
        <Section />
        <District />
        <LandLot />
        <Unit />
        <CityMuniTwp>YORBA LINDA</CityMuniTwp>
        <SubdivisionName>TRACT NO 10304</SubdivisionName>
        <PhaseNumber />
        <TractNumber />
        <LegalBriefDescription />
        <SecTwpRngMer />
        <MapRef>MB 447 PG 22-25</MapRef>
        <Buyer1FName>ANTHONY</Buyer1FName>
        <Buyer1LName>PECORARO</Buyer1LName>
        <Buyer2FName />
        <Buyer2LName />
        <Seller1FName>SCOTT A</Seller1FName>
        <Seller1LName>RUSSIE</Seller1LName>
        <Seller2FName>MELISA M</Seller2FName>
        <Seller2LName>RUSSIE</Seller2LName>
        <LenderName>UNITED WHOLESALE MORTGAGE</LenderName>
        <Loan1Amount>673296</Loan1Amount>
        <PID>3516558</PID>
        <AssessmentValue>447239</AssessmentValue>
      </ComparableSale>
    </ComparableSales>
    <AreaSalesAnalysisInfo>
      <TotalAreaSales>20</TotalAreaSales>
      <MedianLotSize>8100</MedianLotSize>
      <MedianLivingArea>2542</MedianLivingArea>
      <PriceRangeMin>675000</PriceRangeMin>
      <PriceRangeMax>1500000</PriceRangeMax>
      <MedianValue>945000</MedianValue>
      <MedianNumBeds>4</MedianNumBeds>
      <MedianNumBaths>3</MedianNumBaths>
      <MedianYearBuilt>1982</MedianYearBuilt>
      <AgeRangeMin>20</AgeRangeMin>
      <AgeRangeMax>46</AgeRangeMax>
      <MedianAge>39</MedianAge>
    </AreaSalesAnalysisInfo>
    <SortFlag>2</SortFlag>
  </ComparableSalesReport>
  <TransferHistory>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20210318</RecordingDate>
      <ContractDate />
      <DocumentNumber>2021000189038</DocumentNumber>
      <DocumentType>Substitution of Trustee and Full Reconveyance</DocumentType>
      <DocumentTypeCode>SB</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>PATEL,KARISMA H;PATEL,NIRAV N</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20200810</RecordingDate>
        <RecorderDocumentNumber>2020000390076</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>VICTORIA FINANCIAL CORP</LenderName>
      </OriginalLoans>
      <CurrentLender>NATIONWIDE TITLE CLEARING, INC.</CurrentLender>
      <EffectiveDate>20210318</EffectiveDate>
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>347000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20200827</RecordingDate>
      <ContractDate />
      <DocumentNumber>2020000441086</DocumentNumber>
      <DocumentType>Full Release with Legal Description</DocumentType>
      <DocumentTypeCode>FL</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>PATEL,KARISMA H;PATEL,NIRAV N</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20130109</RecordingDate>
        <RecorderDocumentNumber>2013000015318</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>VICTORIA FINANCIAL CORP</LenderName>
      </OriginalLoans>
      <CurrentLender>FIRST AMERICAN TITLE INSURANCE COMPANY</CurrentLender>
      <EffectiveDate>20200826</EffectiveDate>
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>422000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Conventional</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision>TRACT NO 16128</Subdivision>
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MB 824 PG 1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20200810</RecordingDate>
      <ContractDate />
      <DocumentNumber>2020000390076</DocumentNumber>
      <DocumentType>Conventional</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>347000</Loan1Amount>
      <MortDoc />
      <LenderName>VICTORIA FINANCIAL CORP</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>PATEL, NIRAV N; PATEL, KARISMA H</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>CR</BuyerVesting>
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision>TRACT NO 16128</Subdivision>
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MB 824 PG 1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>1</TypeCD>
      <RecordingDate>20200810</RecordingDate>
      <ContractDate>20200722</ContractDate>
      <DocumentNumber>2020000390075</DocumentNumber>
      <DocumentType>Intra-family Transfer or Dissolution</DocumentType>
      <DocumentTypeCode>IT</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc>2020000390076</MortDoc>
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>PATEL, NIRAV N; PATEL, KARISMA H</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>CR</BuyerVesting>
      <BuyerID />
      <SellerName>PATEL, NIRAV N; PATEL, KARISMA H</SellerName>
      <SellerID />
      <SalePrice>0</SalePrice>
      <SalePriceCode />
      <SaleType>Transfer Tax on doc. indicated as EXEMPT</SaleType>
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20130207</RecordingDate>
      <ContractDate />
      <DocumentNumber>2013000082033</DocumentNumber>
      <DocumentType>Substitution of Trustee and Full Reconveyance</DocumentType>
      <DocumentTypeCode>SB</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>NIRAV N PATEL</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20120801</RecordingDate>
        <RecorderDocumentNumber>2012000439297</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>VICTORIA FINANCIAL CORP</LenderName>
      </OriginalLoans>
      <CurrentLender>MERS, INC</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>426000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Conventional</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber />
        <Block>42</Block>
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20130109</RecordingDate>
      <ContractDate>20130102</ContractDate>
      <DocumentNumber>2013000015318</DocumentNumber>
      <DocumentType>Conventional</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>422000</Loan1Amount>
      <MortDoc />
      <LenderName>VICTORIA FINANCIAL CORP</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>PATEL, NIRAV N; PATEL, KARISHMA H</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>RS</BuyerVesting>
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20120824</RecordingDate>
      <ContractDate />
      <DocumentNumber>2012000490257</DocumentNumber>
      <DocumentType>Substitution of Trustee and Full Reconveyance</DocumentType>
      <DocumentTypeCode>SB</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>NIRAV N PATEL</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20111220</RecordingDate>
        <RecorderDocumentNumber>2011000663769</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>VICTORIA FINANCIAL CORP</LenderName>
      </OriginalLoans>
      <CurrentLender>MERS, INC AS NOMINEE FOR VICTORIA FINAICIAL CORP , ITS SUCCESSORS AND  ASSIGNS</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>430000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Conventional</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20120801</RecordingDate>
      <ContractDate>20120725</ContractDate>
      <DocumentNumber>2012000439297</DocumentNumber>
      <DocumentType>Conventional</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>426000</Loan1Amount>
      <MortDoc />
      <LenderName>VICTORIA FINANCIAL CORP</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>PATEL, NIRAV N; PATEL, KARISMA</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>CR</BuyerVesting>
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20120125</RecordingDate>
      <ContractDate />
      <DocumentNumber>2012000043087</DocumentNumber>
      <DocumentType>Release of Mortgage</DocumentType>
      <DocumentTypeCode>RM</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>NIRAV N PATEL</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20110726</RecordingDate>
        <RecorderDocumentNumber>2011000362705</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>CITIBANK NA</LenderName>
      </OriginalLoans>
      <CurrentLender>VERDUGO TRUSTEE SERVICE CORPORATION AS TRUSTEE</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>432000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Conventional</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20111220</RecordingDate>
      <ContractDate>20111213</ContractDate>
      <DocumentNumber>2011000663769</DocumentNumber>
      <DocumentType>Conventional</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>430000</Loan1Amount>
      <MortDoc />
      <LenderName>VICTORIA FINANCIAL CORP</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>PATEL, NIRAV N; PATEL, KARISMA</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>CR</BuyerVesting>
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20110909</RecordingDate>
      <ContractDate />
      <DocumentNumber>2011000447099</DocumentNumber>
      <DocumentType>Release of Mortgage</DocumentType>
      <DocumentTypeCode>RM</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>NIRAV N PATEL</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20110419</RecordingDate>
        <RecorderDocumentNumber>2011000199663</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>CITIMORTGAGE INC</LenderName>
      </OriginalLoans>
      <CurrentLender>VERDUGO TRUSTEE SERVICE CORPORATION AS TRUSTEE</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>432000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Conventional</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20110726</RecordingDate>
      <ContractDate>20110722</ContractDate>
      <DocumentNumber>2011000362705</DocumentNumber>
      <DocumentType>Conventional</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>432000</Loan1Amount>
      <MortDoc />
      <LenderName>CITIBANK NA</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>PATEL, NIRAV N; PATEL, KARISMA</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>CR</BuyerVesting>
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20110614</RecordingDate>
      <ContractDate />
      <DocumentNumber>2011000289337</DocumentNumber>
      <DocumentType>Full Release with Legal Description</DocumentType>
      <DocumentTypeCode>FL</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>JOHN SCHLARBAUM</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20061120</RecordingDate>
        <RecorderDocumentNumber>2006000781526</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>HOME LOAN SPECIALISTS INC</LenderName>
      </OriginalLoans>
      <CurrentLender>ONEWEST BANK,FSB AS SUCCESSOR IN INTEREST TO HOME LOAN SPEICALISTS INC</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>189500</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20110603</RecordingDate>
      <ContractDate />
      <DocumentNumber>2011000275148</DocumentNumber>
      <DocumentType>Substitution of Trustee and Full Reconveyance</DocumentType>
      <DocumentTypeCode>SB</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>JOHN SCHLARBAUM</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20061120</RecordingDate>
        <RecorderDocumentNumber>2006000781526</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>HOME LOAN SPECIALISTS INC</LenderName>
      </OriginalLoans>
      <CurrentLender>ONEWEST BANK FSB</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>189500</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20110512</RecordingDate>
      <ContractDate />
      <DocumentNumber>2011000237702</DocumentNumber>
      <DocumentType>Release of Mortgage</DocumentType>
      <DocumentTypeCode>RM</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>JOHN SCHLARBAUM</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20060118</RecordingDate>
        <RecorderDocumentNumber>2006000038811</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>WORLD SAVINGS BANK FSB</LenderName>
      </OriginalLoans>
      <CurrentLender>WELLS FARGO BANK, N.A. AS TRUSTEE</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>625000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>4</TypeCD>
      <RecordingDate>20110429</RecordingDate>
      <ContractDate>20110422</ContractDate>
      <DocumentNumber>2011000217730</DocumentNumber>
      <DocumentType>Notice of Rescission</DocumentType>
      <DocumentTypeCode>NR</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName />
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20110425</RecordingDate>
      <ContractDate />
      <DocumentNumber>2011000206543</DocumentNumber>
      <DocumentType>Substitution of Trustee and Full Reconveyance</DocumentType>
      <DocumentTypeCode>SB</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>RUBEN GARZA</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20070104</RecordingDate>
        <RecorderDocumentNumber>2007000005556</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>JOHN SCHLARBAUM</LenderName>
      </OriginalLoans>
      <CurrentLender>JOHN SCHLRBAUM</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>910000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Conventional</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MP824 PG1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20110419</RecordingDate>
      <ContractDate />
      <DocumentNumber>2011000199663</DocumentNumber>
      <DocumentType>Conventional</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>432000</Loan1Amount>
      <MortDoc />
      <LenderName>CITIMORTGAGE INC</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>PATEL, NIRAV N; PATEL, KARISMA</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>CR</BuyerVesting>
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MP824 PG1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>1</TypeCD>
      <RecordingDate>20110419</RecordingDate>
      <ContractDate>20110308</ContractDate>
      <DocumentNumber>2011000199662</DocumentNumber>
      <DocumentType>Grant Deed</DocumentType>
      <DocumentTypeCode>GD</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc>2011000199663</MortDoc>
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>PATEL, NIRAV N; PATEL, KARISMA</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>CR</BuyerVesting>
      <BuyerID />
      <SellerName>SCHLARBAUM, JOHN</SellerName>
      <SellerID />
      <SalePrice>540000</SalePrice>
      <SalePriceCode />
      <SaleType>Full-Computed from Transfer Tax</SaleType>
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MP824 PG1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM HILLS</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>1</TypeCD>
      <RecordingDate>20110419</RecordingDate>
      <ContractDate>20110321</ContractDate>
      <DocumentNumber>2011000199661</DocumentNumber>
      <DocumentType>Intra-family Transfer or Dissolution</DocumentType>
      <DocumentTypeCode>IT</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>MM</BuyerVesting>
      <BuyerID />
      <SellerName>SCHARBAUM, MONICA</SellerName>
      <SellerID />
      <SalePrice>0</SalePrice>
      <SalePriceCode />
      <SaleType>Transfer Tax on doc. indicated as EXEMPT</SaleType>
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>3</TypeCD>
      <RecordingDate>20100722</RecordingDate>
      <ContractDate />
      <DocumentNumber />
      <DocumentType>Notice of Trustee's Sale</DocumentType>
      <DocumentTypeCode>NTS</DocumentTypeCode>
      <Book>0</Book>
      <Page>0</Page>
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName />
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber>0</RecorderBookNumber>
        <RecorderPageNumber>0</RecorderPageNumber>
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MP824 PG1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM HILLS</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>1</TypeCD>
      <RecordingDate>20100608</RecordingDate>
      <ContractDate>20100525</ContractDate>
      <DocumentNumber>2010000268063</DocumentNumber>
      <DocumentType>Grant Deed</DocumentType>
      <DocumentTypeCode>GD</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>MM</BuyerVesting>
      <BuyerID />
      <SellerName>GARZA, RUBEN</SellerName>
      <SellerID />
      <SalePrice>0</SalePrice>
      <SalePriceCode />
      <SaleType>Transfer Tax on doc. indicated as EXEMPT</SaleType>
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>3</TypeCD>
      <RecordingDate>20100603</RecordingDate>
      <ContractDate>20100526</ContractDate>
      <DocumentNumber>2010000260410</DocumentNumber>
      <DocumentType>Notice of Sale</DocumentType>
      <DocumentTypeCode>NS</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName />
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20060118</RecordingDate>
        <RecorderDocumentNumber>2006000038811</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>625000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>2</TypeCD>
      <RecordingDate>20091221</RecordingDate>
      <ContractDate />
      <DocumentNumber>2009000682232</DocumentNumber>
      <DocumentType>Notice of Default</DocumentType>
      <DocumentTypeCode>ND</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName />
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20060118</RecordingDate>
        <RecorderDocumentNumber>2006000038811</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>WORLD SAVINGS BANK FSB</LenderName>
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>625000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>6</TypeCD>
      <RecordingDate>20070515</RecordingDate>
      <ContractDate />
      <DocumentNumber>2007000313998</DocumentNumber>
      <DocumentType>Assignment of Mortgage</DocumentType>
      <DocumentTypeCode>AM</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>JOHN SCHLARBAUM</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20061120</RecordingDate>
        <RecorderDocumentNumber>2006000781526</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>HOME LOAN SPECIALISTS INC</LenderName>
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName>HOME LOAN SPECIALISTS, INC., A CALIFORNIA CORPORATION</AssignorName>
      <AssigneeName>INDYMAC BANK, F.S.B.</AssigneeName>
      <OriginalLoanAmount>189500</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Seller take-back</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MP824 PG1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20070104</RecordingDate>
      <ContractDate />
      <DocumentNumber>2007000005556</DocumentNumber>
      <DocumentType>Seller take-back</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>910000</Loan1Amount>
      <MortDoc />
      <LenderName>JOHN SCHLARBAUM</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>GARZA, RUBEN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>MM</BuyerVesting>
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MP824 PG1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>1</TypeCD>
      <RecordingDate>20070104</RecordingDate>
      <ContractDate>20061219</ContractDate>
      <DocumentNumber>2007000005555</DocumentNumber>
      <DocumentType>Intra-family Transfer or Dissolution</DocumentType>
      <DocumentTypeCode>IT</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>GARZA, RUBEN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>MM</BuyerVesting>
      <BuyerID />
      <SellerName>GARZA, CHARLENE ANNE</SellerName>
      <SellerID />
      <SalePrice>0</SalePrice>
      <SalePriceCode />
      <SaleType>Non-Arms Length Transfer</SaleType>
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MP824 PG1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>1</TypeCD>
      <RecordingDate>20070104</RecordingDate>
      <ContractDate>20061219</ContractDate>
      <DocumentNumber>2007000005554</DocumentNumber>
      <DocumentType>Grant Deed</DocumentType>
      <DocumentTypeCode>GD</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc>2007000005556</MortDoc>
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>GARZA, RUBEN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>MM</BuyerVesting>
      <BuyerID />
      <SellerName>SCHLARBAUM, JOHN</SellerName>
      <SellerID />
      <SalePrice>45500</SalePrice>
      <SalePriceCode />
      <SaleType>Full-Computed from Transfer Tax</SaleType>
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20061229</RecordingDate>
      <ContractDate />
      <DocumentNumber>2006000873652</DocumentNumber>
      <DocumentType>Release of Mortgage</DocumentType>
      <DocumentTypeCode>RM</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>JOHN A SCHLARBAUM</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20061027</RecordingDate>
        <RecorderDocumentNumber>2006000725824</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>WELLS FARGO BANK NA</LenderName>
      </OriginalLoans>
      <CurrentLender>AMERICAN SECURITIES COMPANY AS TRUSTEE</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>50000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20061208</RecordingDate>
      <ContractDate />
      <DocumentNumber>2006000822413</DocumentNumber>
      <DocumentType>Release of Mortgage</DocumentType>
      <DocumentTypeCode>RM</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>JOHN SCHLARBAUM</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20060816</RecordingDate>
        <RecorderDocumentNumber>2006000548500</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>WORLD SAVINGS BANK FSB</LenderName>
      </OriginalLoans>
      <CurrentLender>GOLDEN WEST SAVINGS ASSOCIATION SERVICE CO AS TRUSTEE</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>20000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Credit Line</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20061120</RecordingDate>
      <ContractDate>20061107</ContractDate>
      <DocumentNumber>2006000781526</DocumentNumber>
      <DocumentType>Credit Line</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>189500</Loan1Amount>
      <MortDoc />
      <LenderName>HOME LOAN SPECIALISTS INC</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>MM</BuyerVesting>
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency>Monthly</RateChangeFrequency>
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Credit Line</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20061027</RecordingDate>
      <ContractDate>20060929</ContractDate>
      <DocumentNumber>2006000725824</DocumentNumber>
      <DocumentType>Credit Line</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>50000</Loan1Amount>
      <MortDoc />
      <LenderName>WELLS FARGO BANK NA</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN A; SCHLARBAUM, MONICA</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency>Monthly</RateChangeFrequency>
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Credit Line</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20060816</RecordingDate>
      <ContractDate>20060722</ContractDate>
      <DocumentNumber>2006000548500</DocumentNumber>
      <DocumentType>Credit Line</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>20000</Loan1Amount>
      <MortDoc />
      <LenderName>WORLD SAVINGS BANK FSB</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN; SCHLARBAUM, MONICA</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency>Monthly</RateChangeFrequency>
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber />
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber />
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef />
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp />
      </LegalDescriptionInfo>
      <TypeCD>7</TypeCD>
      <RecordingDate>20060209</RecordingDate>
      <ContractDate />
      <DocumentNumber>2006000091297</DocumentNumber>
      <DocumentType>Release of Mortgage</DocumentType>
      <DocumentTypeCode>RM</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc />
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>JOHN SCHLARBAUM</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate>20050526</RecordingDate>
        <RecorderDocumentNumber>2005000404509</RecorderDocumentNumber>
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName>WORLD SAVINGS BANK FSB</LenderName>
      </OriginalLoans>
      <CurrentLender>GOLDEN WEST SAVINGS ASSOCIATION SERVICE CO AS TRUSTEE</CurrentLender>
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount>35000</OriginalLoanAmount>
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Stand Alone First</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20060118</RecordingDate>
      <ContractDate>20060109</ContractDate>
      <DocumentNumber>2006000038811</DocumentNumber>
      <DocumentType>Stand Alone First</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>625000</Loan1Amount>
      <MortDoc />
      <LenderName>WORLD SAVINGS BANK FSB</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>MM</BuyerVesting>
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Credit Line</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20050526</RecordingDate>
      <ContractDate>20050517</ContractDate>
      <DocumentNumber>2005000404509</DocumentNumber>
      <DocumentType>Credit Line</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>35000</Loan1Amount>
      <MortDoc />
      <LenderName>WORLD SAVINGS BANK FSB</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency>Monthly</RateChangeFrequency>
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Stand Alone First</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20041130</RecordingDate>
      <ContractDate>20041118</ContractDate>
      <DocumentNumber>2004001061680</DocumentNumber>
      <DocumentType>Stand Alone First</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>505000</Loan1Amount>
      <MortDoc />
      <LenderName>WORLD SAVINGS BANK FSB</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Credit Line</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20040301</RecordingDate>
      <ContractDate>20040220</ContractDate>
      <DocumentNumber>2004000159075</DocumentNumber>
      <DocumentType>Credit Line</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>63600</Loan1Amount>
      <MortDoc />
      <LenderName>WORLD SAVINGS BANK FSB</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency>Monthly</RateChangeFrequency>
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Stand Alone First</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>0</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20030722</RecordingDate>
      <ContractDate>20030714</ContractDate>
      <DocumentNumber>2003000866657</DocumentNumber>
      <DocumentType>Stand Alone First</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>416250</Loan1Amount>
      <MortDoc />
      <LenderName>WORLD SAVINGS BANK FSB</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting />
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type>Stand Alone First</Loan1Type>
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MP824 PG1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>0</TypeCD>
      <RecordingDate>20020829</RecordingDate>
      <ContractDate />
      <DocumentNumber>20020728717</DocumentNumber>
      <DocumentType>Stand Alone First</DocumentType>
      <DocumentTypeCode />
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount>373774</Loan1Amount>
      <MortDoc />
      <LenderName>WORLD SVGS BANK FSB</LenderName>
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>MM</BuyerVesting>
      <BuyerID />
      <SellerName />
      <SellerID />
      <SalePrice />
      <SalePriceCode />
      <SaleType />
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
    <TransferWithDefault>
      <Loan1Type />
      <LegalDescriptionInfo>
        <LotNumber>42</LotNumber>
        <Block />
        <Section />
        <District />
        <Subdivision />
        <TractNumber>16128</TractNumber>
        <PhaseNumber />
        <Unit />
        <LandLot />
        <MapRef>MP824 PG1-8</MapRef>
        <SecTwnshipRange />
        <LegalBriefDescription />
        <CityMuniTwp>ANAHEIM</CityMuniTwp>
      </LegalDescriptionInfo>
      <TypeCD>1</TypeCD>
      <RecordingDate>20020829</RecordingDate>
      <ContractDate>20020807</ContractDate>
      <DocumentNumber>20020728716</DocumentNumber>
      <DocumentType>Grant Deed</DocumentType>
      <DocumentTypeCode>GD</DocumentTypeCode>
      <Book />
      <Page />
      <MultiAPN />
      <Loan1DueDate />
      <Loan1Amount />
      <MortDoc>20020728717</MortDoc>
      <LenderName />
      <LenderType />
      <TypeFinancing />
      <Loan1Rate />
      <Loan2Amount />
      <BuyerName>SCHLARBAUM, JOHN</BuyerName>
      <BuyerMailCareOfName />
      <BuyerMailUnit />
      <BuyerMailUnitType />
      <BuyerMailAddress />
      <BuyerMailCity />
      <BuyerMailState />
      <BuyerMailZip />
      <BuyerMailZip4 />
      <BuyerVesting>MM</BuyerVesting>
      <BuyerID />
      <SellerName>D R HORTON LOS ANGELES HOLDING CO INC</SellerName>
      <SellerID />
      <SalePrice>463000</SalePrice>
      <SalePriceCode />
      <SaleType>Full-Computed from Transfer Tax</SaleType>
      <TrustorName />
      <TrusteeName />
      <ContactName />
      <ContactAttentionto />
      <ContactAddress />
      <ContactUnit />
      <ContactCity />
      <ContactState />
      <ContactZip />
      <ContactZip4 />
      <CaseNumber />
      <LoanAmount />
      <LoanDoc />
      <LoanDate />
      <TrusteePhone />
      <TrusteeSaleNumber />
      <TrusteeAddress />
      <TrusteeUnit />
      <TrusteeCity />
      <TrusteeState />
      <TrusteeZip />
      <TrusteeZip4 />
      <AuctionDate />
      <AuctionTime />
      <AuctionLocation />
      <AuctionCity />
      <AuctionMinimumBidAmount />
      <InterestRate />
      <FixedStepRider />
      <AdjRateIndex />
      <ChangeIndex />
      <RateChangeFrequency />
      <FirstChangeDate />
      <IntRateNotGreater />
      <IntRateNotLess />
      <InterestOnlyPeriod />
      <PrepaymentPenaltyRider />
      <PrepaymentPenaltyRiderTerm />
      <OriginalLoans>
        <ContractDate />
        <RecordingDate />
        <RecorderDocumentNumber />
        <RecorderBookNumber />
        <RecorderPageNumber />
        <LenderName />
      </OriginalLoans>
      <CurrentLender />
      <EffectiveDate />
      <AssignorName />
      <AssigneeName />
      <OriginalLoanAmount />
    </TransferWithDefault>
  </TransferHistory>
  <Neighborhood>
    <Neighbor>
      <OwnerName>PATEL, NIRAV N; PATEL, KARISMA H</OwnerName>
      <SiteAddress>1280 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-79</APN>
      <Phone />
      <BuildingArea>2721</BuildingArea>
      <Bedrooms>5</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5625</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>OGISAKA JAMES H</OwnerName>
      <SiteAddress>1284 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-80</APN>
      <Phone>7144852366</Phone>
      <BuildingArea>3478</BuildingArea>
      <Bedrooms>6</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5484</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>NANGIA SUMEET &amp; CHARU</OwnerName>
      <SiteAddress>1274 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-78</APN>
      <Phone />
      <BuildingArea>3478</BuildingArea>
      <Bedrooms>6</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5625</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>WILKINSON KEITH S TR</OwnerName>
      <SiteAddress>1270 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-77</APN>
      <Phone />
      <BuildingArea>3130</BuildingArea>
      <Bedrooms>5</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5625</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>MOINUDDIN SYED OMAR &amp; SADIA</OwnerName>
      <SiteAddress>1290 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-81</APN>
      <Phone />
      <BuildingArea>2905</BuildingArea>
      <Bedrooms>5</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5670</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>CATALANO CHRIS &amp; BRIDGET</OwnerName>
      <SiteAddress>8297 E KINGSDALE LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-871-31</APN>
      <Phone />
      <BuildingArea>3092</BuildingArea>
      <Bedrooms>4</Bedrooms>
      <Baths>3</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>10284</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>ARELLANO, ALVIN; ARELLANO, JANICE MENDOZA</OwnerName>
      <SiteAddress>8287 E KINGSDALE LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-871-30</APN>
      <Phone />
      <BuildingArea>3478</BuildingArea>
      <Bedrooms>6</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5787</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>NGUYEN KHANH LE &amp; HOANG THUC QUYEN</OwnerName>
      <SiteAddress>1264 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-76</APN>
      <Phone />
      <BuildingArea>3286</BuildingArea>
      <Bedrooms>5</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5625</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>HARKEY DENNIS D TR; DENNIS AND SUSAN HARKEY FAMILY TR</OwnerName>
      <SiteAddress>1275 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-64</APN>
      <Phone />
      <BuildingArea>3478</BuildingArea>
      <Bedrooms>6</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5128</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>NASSAR RHONDA</OwnerName>
      <SiteAddress>1281 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-63</APN>
      <Phone>7148723313</Phone>
      <BuildingArea>3092</BuildingArea>
      <Bedrooms>5</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5128</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>SHAH JEEGAR D &amp; RIMA J</OwnerName>
      <SiteAddress>1271 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-65</APN>
      <Phone />
      <BuildingArea>2721</BuildingArea>
      <Bedrooms>5</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5128</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>SHAH NILESH M &amp; KALINDI N</OwnerName>
      <SiteAddress>1285 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-62</APN>
      <Phone />
      <BuildingArea>3286</BuildingArea>
      <Bedrooms>5</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5129</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>QUEN JAMES S &amp; MARY S Y</OwnerName>
      <SiteAddress>1265 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-66</APN>
      <Phone />
      <BuildingArea>3286</BuildingArea>
      <Bedrooms>5</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5128</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>CARR, ADAM D; CARR, GEORGINA M</OwnerName>
      <SiteAddress>8277 E KINGSDALE LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-871-29</APN>
      <Phone />
      <BuildingArea>2905</BuildingArea>
      <Bedrooms>4</Bedrooms>
      <Baths>3</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>6173</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
    <Neighbor>
      <OwnerName>WHITE TIMOTHY B &amp; MELISSA A</OwnerName>
      <SiteAddress>1260 N FAIRBURY LN</SiteAddress>
      <SiteUnit />
      <SiteUnitType />
      <SiteCity>ANAHEIM</SiteCity>
      <SiteState>CA</SiteState>
      <SiteZip>92807</SiteZip>
      <APN>351-101-75</APN>
      <Phone>7145018221</Phone>
      <BuildingArea>2721</BuildingArea>
      <Bedrooms>5</Bedrooms>
      <Baths>4</Baths>
      <YearBuilt>2002</YearBuilt>
      <LotSize>5625</LotSize>
      <LotSizeUnits>SF</LotSizeUnits>
      <GarageType>G</GarageType>
    </Neighbor>
  </Neighborhood>
  <SubjectValueInfo>
    <OwnerName>PATEL NIRAV N &amp; KARISMA</OwnerName>
    <Unit />
    <Address>1280 N FAIRBURY LN</Address>
    <City>ANAHEIM</City>
    <State>CA</State>
    <Zip>92807</Zip>
    <Zip4>2531</Zip4>
    <APN>351-101-79</APN>
    <CountyName>ORANGE</CountyName>
    <FIPS>06059</FIPS>
  </SubjectValueInfo>
  <NeighborhoodDemographics>
    <Population>
      <DemographicsInfoItems>
        <DemoInfoItem>
          <Description>2000</Description>
          <ZipTotal>36,145</ZipTotal>
          <NationalTotal>281,421,906</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>2009</Description>
          <ZipTotal>37,392</ZipTotal>
          <NationalTotal>309,731,508</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>2014</Description>
          <ZipTotal>38,324</ZipTotal>
          <NationalTotal>324,062,684</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>Growth Rate</Description>
          <ZipTotal>0.4 %</ZipTotal>
          <NationalTotal>1.0 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>Growth Centile</Description>
          <ZipTotal>30.0 %</ZipTotal>
          <NationalTotal />
        </DemoInfoItem>
      </DemographicsInfoItems>
      <SubjectZip>92807</SubjectZip>
    </Population>
    <Household>
      <DemographicsInfoItems>
        <DemoInfoItem>
          <Description>2000</Description>
          <ZipTotal>12,517</ZipTotal>
          <NationalTotal>105,480,101</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>2009</Description>
          <ZipTotal>12,715</ZipTotal>
          <NationalTotal>116,523,156</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>2014</Description>
          <ZipTotal>12,932</ZipTotal>
          <NationalTotal>122,109,448</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>Household Growth Rate</Description>
          <ZipTotal>0.2 %</ZipTotal>
          <NationalTotal>1.1 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>Average Household Size</Description>
          <ZipTotal>2.9</ZipTotal>
          <NationalTotal>2.6</NationalTotal>
        </DemoInfoItem>
      </DemographicsInfoItems>
      <SubjectZip>92807</SubjectZip>
    </Household>
    <Family>
      <DemographicsInfoItems>
        <DemoInfoItem>
          <Description>2000</Description>
          <ZipTotal>9,879</ZipTotal>
          <NationalTotal>71,787,347</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>2009</Description>
          <ZipTotal>10,071</ZipTotal>
          <NationalTotal>77,956,117</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>Family Growth Rate</Description>
          <ZipTotal>0.2 %</ZipTotal>
          <NationalTotal>0.9 %</NationalTotal>
        </DemoInfoItem>
      </DemographicsInfoItems>
      <SubjectZip>92807</SubjectZip>
    </Family>
    <AgeDistribution>
      <DemographicsInfoItems>
        <DemoInfoItem>
          <Description>0-4</Description>
          <ZipTotal>5.6 %</ZipTotal>
          <NationalTotal>6.8 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>5-9</Description>
          <ZipTotal>5.8 %</ZipTotal>
          <NationalTotal>6.7 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>10-14</Description>
          <ZipTotal>6.4 %</ZipTotal>
          <NationalTotal>6.6 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>15-19</Description>
          <ZipTotal>6.5 %</ZipTotal>
          <NationalTotal>7.1 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>20-24</Description>
          <ZipTotal>5.1 %</ZipTotal>
          <NationalTotal>6.9 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>25-44</Description>
          <ZipTotal>25.5 %</ZipTotal>
          <NationalTotal>27.0 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>45-64</Description>
          <ZipTotal>31.3 %</ZipTotal>
          <NationalTotal>26.0 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>65-84</Description>
          <ZipTotal>12.2 %</ZipTotal>
          <NationalTotal>10.9 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>85+</Description>
          <ZipTotal>1.6 %</ZipTotal>
          <NationalTotal>1.9 %</NationalTotal>
        </DemoInfoItem>
      </DemographicsInfoItems>
      <SubjectZip>92807</SubjectZip>
    </AgeDistribution>
    <MedianAge>
      <DemographicsInfoItems>
        <DemoInfoItem>
          <Description>2009</Description>
          <ZipTotal>41.7</ZipTotal>
          <NationalTotal>36.9</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>Male Ratio</Description>
          <ZipTotal>48.8 %</ZipTotal>
          <NationalTotal>49.2 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>Female Ratio</Description>
          <ZipTotal>51.2 %</ZipTotal>
          <NationalTotal>50.8 %</NationalTotal>
        </DemoInfoItem>
      </DemographicsInfoItems>
      <SubjectZip>92807</SubjectZip>
    </MedianAge>
    <HouseholdIncome>
      <DemographicsInfoItems>
        <DemoInfoItem>
          <Description>% &lt; $25K</Description>
          <ZipTotal>6.6 %</ZipTotal>
          <NationalTotal>20.9 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>% $25K-50K</Description>
          <ZipTotal>10.9 %</ZipTotal>
          <NationalTotal>24.4 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>% $50K-100K</Description>
          <ZipTotal>32.1 %</ZipTotal>
          <NationalTotal>35.3 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>% $100K-150K</Description>
          <ZipTotal>23.9 %</ZipTotal>
          <NationalTotal>11.7 %</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>% &gt;$150K</Description>
          <ZipTotal>26.5 %</ZipTotal>
          <NationalTotal>7.6 %</NationalTotal>
        </DemoInfoItem>
      </DemographicsInfoItems>
      <SubjectZip>92807</SubjectZip>
    </HouseholdIncome>
    <MedianHouseholdIncome>
      <DemographicsInfoItems>
        <DemoInfoItem>
          <Description>2009</Description>
          <ZipTotal>$100,648.00</ZipTotal>
          <NationalTotal>$54,719.00</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>2014</Description>
          <ZipTotal>$106,095.00</ZipTotal>
          <NationalTotal>$56,938.00</NationalTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>Per Capita Income</Description>
          <ZipTotal>$42,876.00</ZipTotal>
          <NationalTotal>$27,277.00</NationalTotal>
        </DemoInfoItem>
      </DemographicsInfoItems>
      <SubjectZip>92807</SubjectZip>
    </MedianHouseholdIncome>
    <HouseholdIncomeCentile>
      <DemographicsInfoItems>
        <DemoInfoItem>
          <Description>National</Description>
          <ZipTotal>97.0 %</ZipTotal>
        </DemoInfoItem>
        <DemoInfoItem>
          <Description>State</Description>
          <ZipTotal>91.0 %</ZipTotal>
        </DemoInfoItem>
      </DemographicsInfoItems>
      <SubjectZip>92807</SubjectZip>
    </HouseholdIncomeCentile>
  </NeighborhoodDemographics>
  <PublicSchoolsReport>
    <Schools>
      <School>
        <SchoolName>Travis Ranch</SchoolName>
        <Distance>.77</Distance>
        <SchoolAddress>5200 Via de la Escuela</SchoolAddress>
        <SchoolCity>Yorba Linda</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92887</SchoolZip>
        <SchoolZip4>2887</SchoolZip4>
        <SchoolPhone>714-777-0584</SchoolPhone>
        <LowestGrade>Kindergarten</LowestGrade>
        <HighestGrade>Grade 8</HighestGrade>
        <StudentTeacherRatio>1:23.1</StudentTeacherRatio>
        <Administrators>78</Administrators>
        <KindergartenMembership>69</KindergartenMembership>
        <Grade1Membership>103</Grade1Membership>
        <Grade2Membership>99</Grade2Membership>
        <Grade3Membership>101</Grade3Membership>
        <Grade4Membership>114</Grade4Membership>
        <Grade5Membership>121</Grade5Membership>
        <Grade6Membership>291</Grade6Membership>
        <Grade7Membership>329</Grade7Membership>
        <Grade8Membership>382</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>1,609</TotalEnrolled>
        <APIDecile>9</APIDecile>
      </School>
      <School>
        <SchoolName>Woodsboro Elementary</SchoolName>
        <Distance>1.13</Distance>
        <SchoolAddress>7575 E. Woodsboro Ave.</SchoolAddress>
        <SchoolCity>Anaheim</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92807</SchoolZip>
        <SchoolZip4>2807</SchoolZip4>
        <SchoolPhone>714-970-2474</SchoolPhone>
        <LowestGrade>Kindergarten</LowestGrade>
        <HighestGrade>Grade 6</HighestGrade>
        <StudentTeacherRatio>1:21.9</StudentTeacherRatio>
        <Administrators>29</Administrators>
        <KindergartenMembership>58</KindergartenMembership>
        <Grade1Membership>66</Grade1Membership>
        <Grade2Membership>65</Grade2Membership>
        <Grade3Membership>83</Grade3Membership>
        <Grade4Membership>89</Grade4Membership>
        <Grade5Membership>84</Grade5Membership>
        <Grade6Membership>129</Grade6Membership>
        <Grade7Membership>0</Grade7Membership>
        <Grade8Membership>0</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>574</TotalEnrolled>
        <APIDecile>9</APIDecile>
      </School>
      <School>
        <SchoolName>El Rancho Middle</SchoolName>
        <Distance>1.26</Distance>
        <SchoolAddress>181 S. Del Giorgio</SchoolAddress>
        <SchoolCity>Anaheim</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92807</SchoolZip>
        <SchoolZip4>2807</SchoolZip4>
        <SchoolPhone>714-997-6238</SchoolPhone>
        <LowestGrade>Grade 7</LowestGrade>
        <HighestGrade>Grade 8</HighestGrade>
        <StudentTeacherRatio>1:25.6</StudentTeacherRatio>
        <Administrators>49</Administrators>
        <KindergartenMembership>0</KindergartenMembership>
        <Grade1Membership>0</Grade1Membership>
        <Grade2Membership>0</Grade2Membership>
        <Grade3Membership>0</Grade3Membership>
        <Grade4Membership>0</Grade4Membership>
        <Grade5Membership>0</Grade5Membership>
        <Grade6Membership>0</Grade6Membership>
        <Grade7Membership>597</Grade7Membership>
        <Grade8Membership>507</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>1,104</TotalEnrolled>
        <APIDecile>9</APIDecile>
      </School>
      <School>
        <SchoolName>Canyon High</SchoolName>
        <Distance>2.75</Distance>
        <SchoolAddress>220 S. Imperial Hwy.</SchoolAddress>
        <SchoolCity>Anaheim</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92807</SchoolZip>
        <SchoolZip4>2807</SchoolZip4>
        <SchoolPhone>714-532-8000</SchoolPhone>
        <LowestGrade>Grade 9</LowestGrade>
        <HighestGrade>Grade 12</HighestGrade>
        <StudentTeacherRatio>1:25.6</StudentTeacherRatio>
        <Administrators>98</Administrators>
        <KindergartenMembership>0</KindergartenMembership>
        <Grade1Membership>0</Grade1Membership>
        <Grade2Membership>0</Grade2Membership>
        <Grade3Membership>0</Grade3Membership>
        <Grade4Membership>0</Grade4Membership>
        <Grade5Membership>0</Grade5Membership>
        <Grade6Membership>0</Grade6Membership>
        <Grade7Membership>0</Grade7Membership>
        <Grade8Membership>0</Grade8Membership>
        <Grade9Membership>546</Grade9Membership>
        <Grade10Membership>615</Grade10Membership>
        <Grade11Membership>588</Grade11Membership>
        <Grade12Membership>521</Grade12Membership>
        <TotalEnrolled>2,270</TotalEnrolled>
        <APIDecile>9</APIDecile>
      </School>
    </Schools>
    <SchoolDistrict>
      <DistrictName>ORANGE UNIFIED</DistrictName>
      <DistrictAddress>PO BOX 11022</DistrictAddress>
      <DistrictCity>ORANGE</DistrictCity>
      <DistrictState>CA</DistrictState>
      <DistrictZip>92867</DistrictZip>
      <DistrictZip4 />
      <DistrictPhone>714-628-4000</DistrictPhone>
      <GradeSpan>KG-12</GradeSpan>
      <StudentTeacherRatio>21.9:1</StudentTeacherRatio>
      <TotalEnrollment>30,901</TotalEnrollment>
      <NumOfGraduates>N/A</NumOfGraduates>
      <NumOfTeachers>1411.5</NumOfTeachers>
      <NumOfTeachersAids>255</NumOfTeachersAids>
      <NumOfGuidanceCounselors>33.3</NumOfGuidanceCounselors>
      <NumOfAdministrators>60</NumOfAdministrators>
      <NumOfSchools>42</NumOfSchools>
    </SchoolDistrict>
  </PublicSchoolsReport>
  <PrivateSchoolsReport>
    <Schools>
      <School>
        <Affiliation>Roman Catholic</Affiliation>
        <Gender>Coed</Gender>
        <SchoolName>ST FRANCIS OF ASSISI SCHOOL</SchoolName>
        <Distance>.51</Distance>
        <SchoolAddress>5330 EASTSIDE CIRCLE</SchoolAddress>
        <SchoolCity>YORBA LINDA</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92887</SchoolZip>
        <SchoolZip4>2743</SchoolZip4>
        <SchoolPhone>714-695-3700</SchoolPhone>
        <LowestGrade>Prekindergarten</LowestGrade>
        <HighestGrade>Grade 8</HighestGrade>
        <StudentTeacherRatio>1:21.1</StudentTeacherRatio>
        <Administrators>24.9</Administrators>
        <PreschoolMembership>42</PreschoolMembership>
        <KindergartenMembership>61</KindergartenMembership>
        <Grade1Membership>64</Grade1Membership>
        <Grade2Membership>61</Grade2Membership>
        <Grade3Membership>64</Grade3Membership>
        <Grade4Membership>64</Grade4Membership>
        <Grade5Membership>57</Grade5Membership>
        <Grade6Membership>56</Grade6Membership>
        <Grade7Membership>54</Grade7Membership>
        <Grade8Membership>45</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>568</TotalEnrolled>
      </School>
      <School>
        <Affiliation>Nonsectarian</Affiliation>
        <Gender>Coed</Gender>
        <SchoolName>KID'S VIEW PRESCHOOL KINDERGARTEN &amp; DAYCARE</SchoolName>
        <Distance>.53</Distance>
        <SchoolAddress>22210 LA PALMA AVENUE</SchoolAddress>
        <SchoolCity>YORBA LINDA</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92887</SchoolZip>
        <SchoolZip4>3813</SchoolZip4>
        <SchoolPhone>714-694-1008</SchoolPhone>
        <LowestGrade>Kindergarten</LowestGrade>
        <HighestGrade>Kindergarten</HighestGrade>
        <StudentTeacherRatio>1:12.0</StudentTeacherRatio>
        <Administrators>1</Administrators>
        <PreschoolMembership>0</PreschoolMembership>
        <KindergartenMembership>12</KindergartenMembership>
        <Grade1Membership>0</Grade1Membership>
        <Grade2Membership>0</Grade2Membership>
        <Grade3Membership>0</Grade3Membership>
        <Grade4Membership>0</Grade4Membership>
        <Grade5Membership>0</Grade5Membership>
        <Grade6Membership>0</Grade6Membership>
        <Grade7Membership>0</Grade7Membership>
        <Grade8Membership>0</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>12</TotalEnrolled>
      </School>
      <School>
        <Affiliation>Nonsectarian</Affiliation>
        <Gender>Coed</Gender>
        <SchoolName>HILLSBOROUGH SCHOOL</SchoolName>
        <Distance>1.06</Distance>
        <SchoolAddress>191 S OLD SPRINGS ROAD</SchoolAddress>
        <SchoolCity>ANAHEIM HILLS</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92808</SchoolZip>
        <SchoolZip4>1247</SchoolZip4>
        <SchoolPhone>714-998-9030</SchoolPhone>
        <LowestGrade>Prekindergarten</LowestGrade>
        <HighestGrade>Grade 8</HighestGrade>
        <StudentTeacherRatio>1:10.9</StudentTeacherRatio>
        <Administrators>14.5</Administrators>
        <PreschoolMembership>54</PreschoolMembership>
        <KindergartenMembership>40</KindergartenMembership>
        <Grade1Membership>26</Grade1Membership>
        <Grade2Membership>14</Grade2Membership>
        <Grade3Membership>14</Grade3Membership>
        <Grade4Membership>15</Grade4Membership>
        <Grade5Membership>15</Grade5Membership>
        <Grade6Membership>7</Grade6Membership>
        <Grade7Membership>10</Grade7Membership>
        <Grade8Membership>17</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>212</TotalEnrolled>
      </School>
      <School>
        <Affiliation>Nonsectarian</Affiliation>
        <Gender>Coed</Gender>
        <SchoolName>CHILDREN'S CANYON</SchoolName>
        <Distance>1.30</Distance>
        <SchoolAddress>781 S WEIR CANYON ROAD</SchoolAddress>
        <SchoolCity>ANAHEIM</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92808</SchoolZip>
        <SchoolZip4>1965</SchoolZip4>
        <SchoolPhone>714-974-1365</SchoolPhone>
        <LowestGrade>Prekindergarten</LowestGrade>
        <HighestGrade>Kindergarten</HighestGrade>
        <StudentTeacherRatio>1:7.5</StudentTeacherRatio>
        <Administrators>2</Administrators>
        <PreschoolMembership>15</PreschoolMembership>
        <KindergartenMembership>15</KindergartenMembership>
        <Grade1Membership>0</Grade1Membership>
        <Grade2Membership>0</Grade2Membership>
        <Grade3Membership>0</Grade3Membership>
        <Grade4Membership>0</Grade4Membership>
        <Grade5Membership>0</Grade5Membership>
        <Grade6Membership>0</Grade6Membership>
        <Grade7Membership>0</Grade7Membership>
        <Grade8Membership>0</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>30</TotalEnrolled>
      </School>
      <School>
        <Affiliation>Nonsectarian</Affiliation>
        <Gender>Coed</Gender>
        <SchoolName>IVYCREST MONTESSORI PRIVATE SCHOOL</SchoolName>
        <Distance>1.51</Distance>
        <SchoolAddress>6555 FAIRMONT BLVD</SchoolAddress>
        <SchoolCity>YORBA LINDA</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92886</SchoolZip>
        <SchoolZip4>6629</SchoolZip4>
        <SchoolPhone>714-777-2511</SchoolPhone>
        <LowestGrade>Prekindergarten</LowestGrade>
        <HighestGrade>Kindergarten</HighestGrade>
        <StudentTeacherRatio>N/A</StudentTeacherRatio>
        <Administrators>N/A</Administrators>
        <PreschoolMembership>45</PreschoolMembership>
        <KindergartenMembership>17</KindergartenMembership>
        <Grade1Membership>0</Grade1Membership>
        <Grade2Membership>0</Grade2Membership>
        <Grade3Membership>0</Grade3Membership>
        <Grade4Membership>0</Grade4Membership>
        <Grade5Membership>0</Grade5Membership>
        <Grade6Membership>0</Grade6Membership>
        <Grade7Membership>0</Grade7Membership>
        <Grade8Membership>0</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>62</TotalEnrolled>
      </School>
      <School>
        <Affiliation>Nonsectarian</Affiliation>
        <Gender>Coed</Gender>
        <SchoolName>ANAHEIM HILLS MONTESSORI</SchoolName>
        <Distance>1.68</Distance>
        <SchoolAddress>6274 E SANTA ANA CANYON ROAD</SchoolAddress>
        <SchoolCity>ANAHEIM</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92807</SchoolZip>
        <SchoolZip4>2303</SchoolZip4>
        <SchoolPhone>714-283-5858</SchoolPhone>
        <LowestGrade>Kindergarten</LowestGrade>
        <HighestGrade>Grade 3</HighestGrade>
        <StudentTeacherRatio>1:15.0</StudentTeacherRatio>
        <Administrators>4</Administrators>
        <PreschoolMembership>0</PreschoolMembership>
        <KindergartenMembership>30</KindergartenMembership>
        <Grade1Membership>15</Grade1Membership>
        <Grade2Membership>10</Grade2Membership>
        <Grade3Membership>5</Grade3Membership>
        <Grade4Membership>0</Grade4Membership>
        <Grade5Membership>0</Grade5Membership>
        <Grade6Membership>0</Grade6Membership>
        <Grade7Membership>0</Grade7Membership>
        <Grade8Membership>0</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>60</TotalEnrolled>
      </School>
      <School>
        <Affiliation>Nonsectarian</Affiliation>
        <Gender>Coed</Gender>
        <SchoolName>CALIFORNIA PRE-SCHOOL &amp; KINDERGARTEN</SchoolName>
        <Distance>1.88</Distance>
        <SchoolAddress>19901 YORBA LINDA BLVD</SchoolAddress>
        <SchoolCity>YORBA LINDA</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92886</SchoolZip>
        <SchoolZip4>2901</SchoolZip4>
        <SchoolPhone>714-970-2311</SchoolPhone>
        <LowestGrade>Prekindergarten</LowestGrade>
        <HighestGrade>Kindergarten</HighestGrade>
        <StudentTeacherRatio>1:8.8</StudentTeacherRatio>
        <Administrators>1.6</Administrators>
        <PreschoolMembership>90</PreschoolMembership>
        <KindergartenMembership>14</KindergartenMembership>
        <Grade1Membership>0</Grade1Membership>
        <Grade2Membership>0</Grade2Membership>
        <Grade3Membership>0</Grade3Membership>
        <Grade4Membership>0</Grade4Membership>
        <Grade5Membership>0</Grade5Membership>
        <Grade6Membership>0</Grade6Membership>
        <Grade7Membership>0</Grade7Membership>
        <Grade8Membership>0</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>104</TotalEnrolled>
      </School>
      <School>
        <Affiliation>Lutheran Church - Missouri Synod</Affiliation>
        <Gender>Coed</Gender>
        <SchoolName>HEPHATHA LUTHERAN SCHOOL</SchoolName>
        <Distance>2.17</Distance>
        <SchoolAddress>5900 E SANTA ANA CANYON ROAD</SchoolAddress>
        <SchoolCity>ANAHEIM</SchoolCity>
        <SchoolState>CA</SchoolState>
        <SchoolZip>92807</SchoolZip>
        <SchoolZip4>3201</SchoolZip4>
        <SchoolPhone>714-637-4022</SchoolPhone>
        <LowestGrade>Prekindergarten</LowestGrade>
        <HighestGrade>Grade 8</HighestGrade>
        <StudentTeacherRatio>1:17.5</StudentTeacherRatio>
        <Administrators>10.3</Administrators>
        <PreschoolMembership>200</PreschoolMembership>
        <KindergartenMembership>23</KindergartenMembership>
        <Grade1Membership>13</Grade1Membership>
        <Grade2Membership>26</Grade2Membership>
        <Grade3Membership>20</Grade3Membership>
        <Grade4Membership>24</Grade4Membership>
        <Grade5Membership>16</Grade5Membership>
        <Grade6Membership>24</Grade6Membership>
        <Grade7Membership>19</Grade7Membership>
        <Grade8Membership>15</Grade8Membership>
        <Grade9Membership>0</Grade9Membership>
        <Grade10Membership>0</Grade10Membership>
        <Grade11Membership>0</Grade11Membership>
        <Grade12Membership>0</Grade12Membership>
        <TotalEnrolled>380</TotalEnrolled>
      </School>
    </Schools>
  </PrivateSchoolsReport>
</XML187>
EOT;

            $report187 = simplexml_load_string($test_xml);
            // changes for local version starts here and comment above line => $report187 = simplexml_load_file($rep187);
            // $report187 = simplexml_load_file("sample.xml");
            // changes for local version ends here

            // var_dump($rep187);die;

            $data['mapinfo'] = $report111;
            $data['property'] = $report187;

            $data['user'] = $_POST['user'];
            if($_POST['user_image'] != ''){
                $data['user']['profile_image'] = $_POST['user_image'];
            }
            if($_POST['company_image'] != ''){
                $data['user']['company_logo'] = $_POST['company_image'];
            }

            if($data['user']['email'] != ''){
                $CI =& get_instance();
                $ref_code = $CI->db->select('ref_code')
                                ->where('email', $data['user']['email'])
                                ->get('lp_user_mst')
                                ->row_array();

                $data['user']['ref_code'] = $ref_code['ref_code'];

                $user_info = $CI->db->select(array('mobile','website'))
                                ->where('email', $data['user']['email'])
                                ->get('lp_user_mst')
                                ->row_array();

                $data['user']['ref_code'] = $ref_code['ref_code'];
                $data['user']['mobile'] = $user_info['mobile'];
                $data['user']['website'] = $user_info['website'];
            }

            $data['partner'] =  array();
            if($_POST['showpartner']=='on'){
                if(isset($_POST['partner']) && !empty($_POST['partner']))
                {
                    foreach ($_POST['partner'] as $_key => $_partner)
                    {
                        foreach ($_partner as $i => $_data){
                        $data['partner'][$i][$_key] = $_data; 
                        }
                    }
                }
                

                if(!empty($data['partner'])){
                    $data['user_id_fk'] = $CI->session->userdata('userid');
                    foreach ($data['partner'] as $_partner){
                        // Currently these partner details in databse are of no use
                        //$CI->base_model->insert_one_row('lp_partner_details',$_partner);
                    }
                }
            }
            $ownerNamePrimary = (string)$report187->PropertyProfile->PrimaryOwnerName;
            $ownerNameSecondary = (string)$report187->PropertyProfile->SecondaryOwnerName;
            if(strpos($ownerNamePrimary,";") !== FALSE){
                $_primeNameArr = explode(";", $ownerNamePrimary);
                $ownerNamePrimary = ucwords(trim($_primeNameArr[0]));
                if($ownerNameSecondary == ''){
                    $ownerNameSecondary = ucwords(trim($_primeNameArr[1]));
                }
            }
            if(strpos($ownerNamePrimary,",") !== FALSE){
                $_primeNameArr = explode(",", $ownerNamePrimary);
                //Setting Last name at last like for HERNANDEZ, GERARDO JOVANNI name will be GERARDO JOVANNI HERNANDEZ
                $ownerNamePrimary = ucwords(trim($_primeNameArr[1])) . ' ' . ucwords(trim($_primeNameArr[0]));
            }
            if(strpos($ownerNameSecondary,",") !== FALSE){
                $_secNameArr = explode(",", $ownerNameSecondary);
                //Setting Last name at last like for HERNANDEZ, GERARDO JOVANNI name will be GERARDO JOVANNI HERNANDEZ
                $ownerNameSecondary = ucwords(trim($_secNameArr[1])) . ' ' . ucwords(trim($_secNameArr[0]));
            }
            $data['primary_owner'] = $ownerNamePrimary;
            $data['secondary_owner'] = $ownerNameSecondary;
            $reportItems['comparable']=array();
            if(true || $_POST['presentation'] == 'seller') {
                $comparableTemp = $this->get_all_properties($report187);
                if(empty($compKeys)){
                    $comparables = $this->sort_properties($report187, $comparableTemp);
                    $reportItems['comparable'] = $comparables['sorted'];
                } else {
                    foreach($comparableTemp as $key => $_property){
                        if(in_array($key, $compKeys)){
                            array_push($reportItems['comparable'],$_property);
                        }
                    }
                }
            }

            if (empty($reportItems['comparable'])) {
                return ["status"=>false, "showError"=>true, "msg"=>"Report can not be generated due to lack of comparable data."];
            }

            $salesAnalysis = $this->sales_analysis($reportItems['comparable']);
            
            $reportItems['priceMinRange'] = round($salesAnalysis['minPrice']/1000,2);
            $reportItems['priceMaxRange'] = round($salesAnalysis['maxPrice']/1000,2);
 
            $propertyYear = (string)$report187->PropertyProfile->PropertyCharacteristics->YearBuilt[0];
            $reportItems['areaYear'] = $propertyYear;
            $reportItems['areaYearLow'] = minMaxArray('Year', 'min', $reportItems['comparable']);
            $reportItems['areaYearMedian'] = minMaxArray('Year', 'median', $reportItems['comparable']);
            $reportItems['areaYearHigh'] = minMaxArray('Year', 'max', $reportItems['comparable']);

            $reportItems['areaBedrooms'] = (string)$report187->PropertyProfile->PropertyCharacteristics->Bedrooms[0];
            $reportItems['areaBedroomsLow'] = minMaxArray('Beds', 'min', $reportItems['comparable']);
            $reportItems['areaBedroomsMedian'] = minMaxArray('Beds', 'median', $reportItems['comparable']);
            $reportItems['areaBedroomsHigh'] = minMaxArray('Beds', 'max', $reportItems['comparable']);

            $reportItems['areaBaths'] = (string)$report187->PropertyProfile->PropertyCharacteristics->Baths[0];
            $reportItems['areaBathsLow'] = minMaxArray('Baths', 'min', $reportItems['comparable']);
            $reportItems['areaBathsMedian'] = minMaxArray('Baths', 'median', $reportItems['comparable']);
            $reportItems['areaBathsHigh'] = minMaxArray('Baths', 'max', $reportItems['comparable']);
            
            $areaLotSize = number_format((string)$report187->PropertyProfile->PropertyCharacteristics->LotSize[0]);
            $areaLotSizeLow = number_format($salesAnalysis['min_lot_size']);             //number_format(minMaxArray('LotSize', 'min', $reportItems['comparable']));
            $areaLotSizeMedian = number_format($salesAnalysis['tmp_lot_size']/count($reportItems['comparable']));            //number_format(minMaxArray('LotSize', 'median', $reportItems['comparable']));
            $areaLotSizeHigh = number_format($salesAnalysis['max_lot_size']);                // number_format(minMaxArray('LotSize', 'max', $reportItems['comparable']));


            $reportItems['areaLotSize'] = $areaLotSize;
            $reportItems['areaLotSizeLow'] = $areaLotSizeLow;
            $reportItems['areaLotSizeMedian'] = $areaLotSizeMedian;
            $reportItems['areaLotSizeHigh'] = $areaLotSizeHigh;


            $areaLivingAreaLow = number_format(minMaxArray('BuildingArea', 'min', $reportItems['comparable']));
            $areaLivingAreaMedian = number_format(minMaxArray('BuildingArea', 'median', $reportItems['comparable']));
            $areaLivingAreaHigh = number_format(minMaxArray('BuildingArea', 'max', $reportItems['comparable']));

            $reportItems['areaLivingArea']   = (string)$report187->PropertyProfile->PropertyCharacteristics->BuildingArea[0];
            $reportItems['areaLivingAreaLow'] = $areaLivingAreaLow;
            $reportItems['areaLivingAreaMedian'] = $areaLivingAreaMedian;
            $reportItems['areaLivingAreaHigh'] = $areaLivingAreaHigh;

            $areaSalePriceLow = number_format((double)$report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMin);
            $areaSalePriceMedian = number_format((double)$report187->ComparableSalesReport->AreaSalesAnalysisInfo->MedianValue);
            $areaSalePriceHigh = number_format((double)$report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMax);

            $reportItems['areaPriceFoot'] = number_format((string)$report187->PropertyProfile->SaleLoanInfo->PricePerSQFT[0]);
            $reportItems['areaPriceFootLow'] = number_format(minMaxArray('PricePerSQFT', 'min', $reportItems['comparable']));
            $reportItems['areaPriceFootMedian'] = number_format(minMaxArray('PricePerSQFT', 'median', $reportItems['comparable']));
            $reportItems['areaPriceFootHigh'] = number_format(minMaxArray('PricePerSQFT', 'max', $reportItems['comparable']));

            $reportItems['areaSalePriceLow'] = dollars($areaSalePriceLow);
            $reportItems['areaSalePriceMedian'] = dollars($areaSalePriceMedian);
            $reportItems['areaSalePriceHigh'] = dollars($areaSalePriceHigh);

            $reportItems['areaTotalRoomsLow'] = minMaxArray('TotalRooms', 'min', $reportItems['comparable']);
            $reportItems['areaTotalRoomsMedian'] = minMaxArray('TotalRooms', 'median', $reportItems['comparable']);
            $reportItems['areaTotalRoomsHigh'] = minMaxArray('TotalRooms', 'max', $reportItems['comparable']);

            $reportItems['stories'] = (string)$report187->PropertyProfile->PropertyCharacteristics->NoOfStories[0];
            $propPool = $report187->PropertyProfile->PropertyCharacteristics->Pool[0];
                if ($propPool != 'Yes') {
                    $propPool = 'No';
                }
            $reportItems['propertyPool'] = number_format((double)$report187->PropertyProfile->PropertyCharacteristics->Pool[0]);
            $reportItems['propertyPoolLow'] = number_format((double)minMaxArray('Pool', 'min', $reportItems['comparable']));
            $reportItems['propertyPoolMedian'] = number_format((double)minMaxArray('Pool', 'median', $reportItems['comparable']));
            $reportItems['propertyPoolHign'] = number_format((double)minMaxArray('Pool', 'max', $reportItems['comparable']));

            $reportItems['propertySalePrice'] = number_format((double)$report187->PropertyProfile->SaleLoanInfo->SalesPrice);
            $reportItems['propertySalePriceLow'] =  number_format($salesAnalysis['minPrice']);       //number_format(minMaxArray('PriceRate', 'min', $reportItems['comparable']));
            $reportItems['propertySalePriceMedian'] =   number_format($salesAnalysis['tmp_property']/9); //number_format(minMaxArray('PriceRate', 'median', $reportItems['comparable']));
            $reportItems['propertySalePriceLowHigh'] =  number_format($salesAnalysis['maxPrice']);   //number_format(minMaxArray('PriceRate', 'max', $reportItems['comparable']));

            $areaSalesChart['series']='';
            $areaSalesChart['date']='';

            $minRadius = minMaxArray('Distance', 'min', $reportItems['comparable']);
            $medianRadius = minMaxArray('Distance', 'median', $reportItems['comparable']);
            $maxRadius = minMaxArray('Distance', 'max', $reportItems['comparable']);
            $reportItems['areaMinRadius'] = $minRadius;
            $reportItems['areaMedianRadius'] = $medianRadius;
            $reportItems['areaMaxRadius'] = $maxRadius;


            $ChartArr = array();
            $tmp2=array();

            $totalMonthsReport=0;       
            foreach ($reportItems['comparable'] as $key => $item) {
                /*****************************************/
                if($key > 8) break;
                $date=date_create($item['Date']);
                $tmepDate = date_format($date,"M'y");
                $months[] = array('date'=>$tmepDate,'value'=>$item['PriceRate']);
            }

            foreach ($months as $key => $itemMonth) {
                if($key<(sizeof($months)-1)){
                    $tmp2['date'].=$itemMonth['date'].'|';
                    $tmp2['series'].=$itemMonth['value'].',';
                }else{
                    $tmp2['date'].=$itemMonth['date'];
                    $tmp2['series'].=$itemMonth['value'];
                }
                if($itemMonth['value']!='_'){
                    $totalMonthsReport++;
                }
                array_push($ChartArr, $tmp2);
            }

            $chart_color = !empty($CI->input->post('theme')) ? str_replace("#", "", $CI->input->post('theme')) : '082147';
            // $tmp2['color'] = str_replace("#", "", $CI->input->post('theme'));
            $tmp2['color'] = $chart_color;
            
            $reportItems['chart']=$tmp2;
            $reportItems['totalMonthsReport'] = $totalMonthsReport;
            $data['areaSalesAnalysis'] = $reportItems;
            $data['theme'] = $CI->input->post('theme');

            /* bio */
            $data['bio'] = isset($_POST['bio']) && !empty($_POST['bio']) ? $_POST['bio'] : '';     
            /* bio */ 

            /* testimonials */
            $testimonials = isset($_POST['testimonials']) && !empty($_POST['testimonials']) ? json_decode($_POST['testimonials']) : array();
            $testimonials_name = isset($_POST['testimonials_name']) && !empty($_POST['testimonials_name']) ? json_decode($_POST['testimonials_name']) : array();
            
            if(isset($testimonials) && !empty($testimonials))
            {
                foreach ($testimonials as $t_key => $t_value) 
                {
                    $name = '';
                    if(array_key_exists($t_key, $testimonials_name))
                    {
                        $name = $testimonials_name[$t_key];
                    }
                    $data['testimonials'][] = array('content'=>$t_value, 'name'=>$name);
                }
            }            
            /* testimonials */

            $data['pdfPages'] = isset($_POST['pdfPages']) && !empty($_POST['pdfPages']) ? explode(',', $_POST['pdfPages']): array(); 
            
            $PdfGenResponse = $this->prepareWidgetPdf($reportLang, $data, $_POST['presentation'],$report187->PropertyProfile->SiteAddress);
            $pdfFileName = $PdfGenResponse['pdf_filename'];
            $reportGenerated = $PdfGenResponse['report_generated'];
            $errorMsg = $PdfGenResponse['error_msg'];
                
                // if it is an api call then we get the user id from the token
                if($callFromApi == 1){
                    $currentUserId = getUserIdByToken($reportData['token']);
                }else{
                    $currentUserId = $CI->session->userdata('userid');   
                }
            if($reportGenerated) {
                $insertPdfReport =  array(
                                            'project_name'=>$CI->db->escape_str($report187->PropertyProfile->SiteAddress),
                                            'report_path'=>$pdfFileName,
                                            'user_id_fk'=>  $currentUserId,
                                            'property_owner'=>$CI->db->escape_str($report187->PropertyProfile->PrimaryOwnerName),
                                            'property_address'=>$CI->db->escape_str($report187->PropertyProfile->SiteAddress.', '.$report187->PropertyProfile->SiteCity.' '.$report187->PropertyProfile->SiteState.' '.$report187->PropertyProfile->SiteZip),
                                            'property_apn'=>$CI->db->escape_str($report187->PropertyProfile->APN),
                                            'property_lat'=>$CI->db->escape_str($report187->PropertyProfile->PropertyCharacteristics->Latitude),
                                            'property_lng'=>$CI->db->escape_str($report187->PropertyProfile->PropertyCharacteristics->Longitude),
                                            'report_type'=>$_POST['presentation'],
                                    );

                // if it is an api call then we mark it as active
                if($callFromApi == 1){
                    $insertPdfReport['is_active'] = 'Y';
                }

                $CI->base_model->insert_one_row('lp_my_listing', $insertPdfReport);
                $CI->session->set_userdata('project_id', $CI->base_model->get_last_insert_id());

                // if call is from api then we directly send the report link
                if($callFromApi == 1)
                    return array("status"=>true, 'reportLink' => base_url($pdfFileName));
                else
                    return array("status"=>true);
            } else {
                return array("status"=>false,"msg"=>$errorMsg);
            }
        }

        function prepareWidgetPdf($reportLang,$data,$presentationType,$siteAddress){
            $CI = & get_instance();
            
            if(empty($reportLang)){
                $reportLang = 'english';
            }
            
            //@var $turboMode boolean If true than it uses pre stored static theme pages and using qpdf tool it merge these with dynamic content pdf being gnerated with wkhtmltopdf tool
            $turboMode = false;
            /**
             * Start Code to fetch customized text data of user
             */
            $data['user_id_for_report_customization'] = 0;
            if ($data['user']['email'] != '') {
                $CI->load->model('user_model');
                $userInfo = $CI->user_model->getUserDetailsByEmail($data['user']['email'], ['user_id_pk', 'email', 'role_id_fk', 'customer_id', 'ref_code']);
                $data['user_id_for_report_customization'] = $userInfo['user_id_pk'];
            }

            $customization_data = [];
            if ($presentationType=="seller" && !empty($data['user_id_for_report_customization'])) {
                $CI->load->model('report_model');
                $customization_data['12']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 12);
                $customization_data['13']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 13);
                $customization_data['14']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 14);
                $customization_data['15']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 15);
                $customization_data['16']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 16);
                $customization_data['17']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 17);
                $customization_data['18']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 18);
                $customization_data['19']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 19);
            }
            
            $data['customization_pages_data'] = $customization_data;

            /**
             * END Code to fetch customized text data of user
             */

            if($turboMode){
                $html = $CI->load->view("reports/".$reportLang."/".$presentationType."/dynamic",$data,true);
            } else {
                $html = $CI->load->view("reports/".$reportLang."/".$presentationType."/widget_index",$data,true);
            
            }
            
            //file_put_contents("tmp.html", $html);
            $wkhtmltopdfPath =  $CI->config->item('wkhtmltopdf_path');
            if($turboMode && $presentationType=='seller' && $reportLang=='english'){
                $zoom =  $CI->config->item('wkhtmltopdf_zoom_seller');    
            } else {
                $zoom =  $CI->config->item('wkhtmltopdf_zoom');
            }
            $snappy = new Pdf($wkhtmltopdfPath);
            //$snappy = new Pdf($this->binaryPath);
            $options = [
                'margin-top'    => 0,
                'margin-right'  => 0,
                'margin-bottom' => 0,
                'margin-left'   => 0,
                'page-size' => 'Letter', 
                'zoom'          => $zoom,
                'load-error-handling'=>'ignore',
                'load-media-error-handling'=>'ignore'
            ];
            $output = $snappy->getOutputFromHtml($html, $options,
                        200,
                        array(
                            'Content-Type'          => 'application/pdf',
                            'Content-Disposition'   => 'attachment; filename="report.pdf"'
                        ));
            $pdfFileName = $pdfFileDynamic = 'temp/'.str_replace(" ", "_", $siteAddress).'_'.md5(time() . rand()).'.pdf';
            file_put_contents($pdfFileDynamic, $output);
            if(filesize($pdfFileDynamic)<10000){// Output pdf should be atleast 100KB of size otherwise some error has occured
                return array( 
                    'report_generated' => false,
                    'error_msg' => "Empty PDF generated while trying to create ".$reportLang." ".$presentationType." Report for user account ".$CI->session->userdata('user_email'),
                    'pdf_filename'=> ''
                );
            }
            if($turboMode){
                $qpdf_path =  $CI->config->item('qpdf_path');
                //Merging Static pdf pages with dynamic pdf pages
                $pdfFileName = 'temp/'.str_replace(" ", "_", $siteAddress).'_'.md5(time() . rand()).'.pdf';
                if($presentationType=="seller"){
                    $res = exec($qpdf_path." {$pdfFileDynamic} --pages {$pdfFileDynamic} 1 {$contentsFile} 1 {$pdfFileDynamic} 2-7 {$tailFile} 1-12 -- {$pdfFileName}");
                } else {
                    $res = exec($qpdf_path." {$pdfFileDynamic} --pages {$pdfFileDynamic} 1 {$contentsFile} 1 {$pdfFileDynamic} 2-6 {$tailFile} 1-13 -- {$pdfFileName}");
                }
                //Removing dynamic as it is not needed any more
                unlink($pdfFileDynamic);
            } /*else {
                $pdfFileName = $pdfFileDynamic;
                //$res = exec("qpdf  {$pdffFileDynamic} --pages {$pdfFileDynamic} 1 temp/S-2.pdf 1 {$pdfFileDynamic} 2-7 temp/S-9-20.pdf 1-12 -- {$pdfFileName}");
            }*/
            return array(
                'report_generated' => true,
                'pdf_filename'=>$pdfFileName,
                'error_msg' => ''
            );
        }
    }
?>
