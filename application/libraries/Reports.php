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

            /* bio */
            $data['bio'] = isset($_POST['bio']) && !empty($_POST['bio']) ? $_POST['bio'] : '';     
            /* bio */ 

            /* testimonials */
            $testimonials = isset($_POST['testimonials']) && !empty($_POST['testimonials']) ? json_decode($_POST['testimonials']) : array();
            $testimonials_name = isset($_POST['testimonials_name']) && !empty($_POST['testimonials_name']) ? json_decode($_POST['testimonials_name']) : array();
            
            if(isset($testimonials) && !empty($testimonials))
            {
                foreach ($testimonials as $key => $value) 
                {

                    if(in_array($key, $testimonials_name))
                    {
                        $name = $testimonials_name[$key];
                    }
                    $data['testimonials'][] = array('content'=>$value, 'name'=>$name);
                }
            }
            echo "<pre>"; print_r($data['testimonials']); exit;            
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
