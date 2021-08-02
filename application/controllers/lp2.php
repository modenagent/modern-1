<?php


class Lp extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function getSearchResults(){
		$request = $_GET['requrl'];
		$request .= '&key=' . getSitexKey();
		$file = file_get_contents($request);
		echo $file;
	}


	function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi') {
	     $theta = $longitude1 - $longitude2;
	     $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
	     $distance = acos($distance);
	     $distance = rad2deg($distance);
	     $distance = $distance * 60 * 1.1515; switch($unit) {
	          case 'Mi': break; case 'Km' : $distance = $distance * 1.609344;
	     }
	     return (round($distance,2));
	}

	function getPropertyData(){
		$rep111 = $_POST['report111'];
		$rep111 = urldecode($rep111);
		$report111 = simplexml_load_file($rep111);
		
		$rep187 = $_POST['report187'];
		$rep187 = urldecode($rep187);
		$report187 = simplexml_load_file($rep187);

		$data['mapinfo'] = $report111;
		$data['property'] = $report187;

		$data['user'] = $_POST['user'];
		$this->load->library('session');
		$data['partner'] =  array();
		if($_POST['showpartner']=='on'){
			$data['partner'] = $_POST['partner'];
			$data['user_id_fk'] = $this->session->userdata('userid');
			$this->load->model('base_model');
			$this->base_model->insert_one_row('lp_partner_details',$data['partner']);
		}

		$this->load->helper('dataapi');

		$hasComparable = array();

		for ($j = 0; $j < sizeof($report187->ComparableSalesReport->ComparableSales->ComparableSale); $j++) {

			if(sizeof($reportItems['comparable'])<9){

				$proximity_val = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Proximity[0].'';
				if(floatval($proximity_val)<=2){
					$i = strval($j + 1);
					$tmp['Date'] = formatDate($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->RecordingDate[0]);
					$tmp['Price'] = dollars(number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SalePrice[0]));
					$tmp['PriceRate'] = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SalePrice[0];

					$tmp['Address'] = properCase($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SiteAddress[0].' '.$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SiteCity[0]);
					$tmp['Distance'] = floatval($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Proximity[0]) ;
					$tmp['Beds'] = number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Bedrooms[0]);
					$tmp['SquareFeet'] = number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->BuildingArea[0]);
					$tmp['Baths'] = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Baths[0];
					$tmp['Year'] = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->YearBuilt[0];
					$tmp['LotSize'] = number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->LotSize);
					$tmp['Latitude'] = number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Latitude);
					$tmp['Longitude'] = number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Longitude);
					$tmpPool = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Pool[0];
					if ($tmpPool != 'Yes') {
						$tmpPool = 'No';
					}			
					$tmp['Pool']=$tmpPool;
					$apn= $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->APN[0].'';
					array_push($reportItems['comparable'], $tmp);				
					array_push($hasComparable, $apn);
				}	
			}

			


		}

		usort($reportItems['comparable'], 'sortDistance');



		if(sizeof($reportItems['comparable'])<9){

			$newCompareAble = array();	
			

			//**** Adding compareable properties to sort based on date ***********
			for ($j = 0; $j < sizeof($report187->ComparableSalesReport->ComparableSales->ComparableSale); $j++) {
				$apn = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->APN[0].'';
				if(!in_array($apn, $hasComparable)){
					
					$i = strval($j + 1);
					$tmp['Date'] = formatDate($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->RecordingDate[0]);
					$tmp['Price'] = dollars(number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SalePrice[0]));
					$tmp['PriceRate'] = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SalePrice[0];

					$tmp['Address'] = properCase($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SiteAddress[0].' '.$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SiteCity[0]);
					$tmp['Distance'] = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Proximity[0];
					$tmp['Beds'] = number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Bedrooms[0]);
					$tmp['SquareFeet'] = number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->BuildingArea[0]);
					$tmp['Baths'] = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Baths[0];
					$tmp['Year'] = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->YearBuilt[0];
					$tmp['LotSize'] = number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->LotSize);
					$tmp['Latitude'] = number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Latitude);
					$tmp['Longitude'] = number_format($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Longitude);
					$tmpPool = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Pool[0];
					if ($tmpPool != 'Yes') {
						$tmpPool = 'No';
					}			
					$tmp['Pool']=$tmpPool;
					array_push($newCompareAble, $tmp);	
				}
			}
			
			//****** Sorting compareable proerties based on last sale ************
			usort($newCompareAble, 'sortproperty');

			foreach ($newCompareAble as $key => $value) {
				if(sizeof($reportItems['comparable'])<9){
					array_push($reportItems['comparable'], $value);
				}
			}
		}

		
		foreach ($reportItems['comparable'] as $key => $row) {
		    if($key==0){
				$minPrice = floatval($row['PriceRate']);
				$maxPrice = floatval($row['PriceRate']);
			}

			if($minPrice>floatval($row['PriceRate']) ){
				$minPrice = floatval($row['PriceRate']);
			}

			if($maxPrice<floatval($row['PriceRate'])){
				$maxPrice = floatval($row['PriceRate']);
			}
		   
		}

		$reportItems['priceMinRange'] = round(($minPrice - ($minPrice*5/100))/1000,2);
		$reportItems['priceMaxRange'] = round(($maxPrice + ($maxPrice*5/100))/1000,2);

		
		$reportItems['areaYearLow'] = minMax('YearBuilt', 'min', $report187);
		$reportItems['areaYearMedian'] = minMax('YearBuilt', 'median', $report187);
		$reportItems['areaYearHigh'] = minMax('YearBuilt', 'max', $report187);

		$reportItems['areaBedroomsLow'] = minMax('Bedrooms', 'min', $report187);
		$reportItems['areaBedroomsMedian'] = minMax('Bedrooms', 'median', $report187);
		$reportItems['areaBedroomsHigh'] = minMax('Bedrooms', 'max', $report187);

		$reportItems['areaBathsLow'] = minMax('Baths', 'min', $report187);
		$reportItems['areaBathsMedian'] = minMax('Baths', 'median', $report187);
		$reportItems['areaBathsHigh'] = minMax('Baths', 'max', $report187);

		$areaLotSizeLow = number_format(minMax('LotSize', 'min', $report187));
		$areaLotSizeMedian = number_format(minMax('LotSize', 'median', $report187));
		$areaLotSizeHigh = number_format(minMax('LotSize', 'max', $report187));

		$reportItems['areaLotSizeLow'] = $areaLotSizeLow;
		$reportItems['areaLotSizeMedian'] = $areaLotSizeMedian;
		$reportItems['areaLotSizeHigh'] = $areaLotSizeHigh;


		$areaLivingAreaLow = number_format(minMax('BuildingArea', 'min', $report187));
		$areaLivingAreaMedian = number_format(minMax('BuildingArea', 'median', $report187));
		$areaLivingAreaHigh = number_format(minMax('BuildingArea', 'max', $report187));

		$reportItems['areaLivingArea']	 = $report187->PropertyProfile->PropertyCharacteristics->BuildingArea;
		$reportItems['areaLivingAreaLow'] = $areaLivingAreaLow;
		$reportItems['areaLivingAreaMedian'] = $areaLivingAreaMedian;
		$reportItems['areaLivingAreaHigh'] = $areaLivingAreaHigh;

		$areaSalePriceLow = number_format($report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMin);
		$areaSalePriceMedian = number_format($report187->ComparableSalesReport->AreaSalesAnalysisInfo->MedianValue);
		$areaSalePriceHigh = number_format($report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMax);

		$reportItems['areaPriceFootLow'] = number_format(minMax('PricePerSQFT', 'min', $report187));
		$reportItems['areaPriceFootMedian'] = number_format(minMax('PricePerSQFT', 'median', $report187));
		$reportItems['areaPriceFootHigh'] = number_format(minMax('PricePerSQFT', 'max', $report187));

		$reportItems['areaSalePriceLow'] = dollars($areaSalePriceLow);
		$reportItems['areaSalePriceMedian'] = dollars($areaSalePriceMedian);
		$reportItems['areaSalePriceHigh'] = dollars($areaSalePriceHigh);

		$reportItems['areaTotalRoomsLow'] = minMax('TotalRooms', 'min', $report187);
		$reportItems['areaTotalRoomsMedian'] = minMax('TotalRooms', 'median', $report187);
		$reportItems['areaTotalRoomsHigh'] = minMax('TotalRooms', 'max', $report187);

		$reportItems['stories'] = $report187->PropertyProfile->PropertyCharacteristics->NoOfStories[0];
		$propPool = $report187->PropertyProfile->PropertyCharacteristics->Pool[0];
			if ($propPool != 'Yes') {
				$propPool = 'No';
			}
		$reportItems['propertyPool'] = number_format($report187->PropertyProfile->PropertyCharacteristics->Pool[0]);
		$reportItems['propertyPoolLow'] = number_format(minMax('Pool', 'min', $report187));
		$reportItems['propertyPoolMedian'] = number_format(minMax('Pool', 'median', $report187));
		$reportItems['propertyPoolHign'] = number_format(minMax('Pool', 'max', $report187));

		$reportItems['propertySalePrice'] = number_format($report187->PropertyProfile->PropertyCharacteristics->SalePrice);
		$reportItems['propertySalePriceLow'] = number_format(minMax('SalePrice', 'min', $report187));
		$reportItems['propertySalePriceMedian'] = number_format(minMax('SalePrice', 'median', $report187));
		$reportItems['propertySalePriceLowHigh'] = number_format(minMax('SalePrice', 'max', $report187));

		$reportItems['comparable']=array();

		$areaSalesChart['series']='';
		$areaSalesChart['date']='';

		$minRadius = minMax('Proximity', 'min', $report187);
		$medianRadius = minMax('Proximity', 'median', $report187);
		$maxRadius = minMax('Proximity', 'max', $report187);
		$reportItems['areaMinRadius'] = $minRadius;
		$reportItems['areaMedianRadius'] = $medianRadius;
		$reportItems['areaMaxRadius'] = $maxRadius;

		$reportItems['areaYear'] = $report187->PropertyProfile->PropertyCharacteristics->YearBuilt;
		$reportItems['areaYearLow'] = minMax('YearBuilt', 'min', $report187);
		$reportItems['areaYearMedian'] = minMax('YearBuilt', 'median', $report187);
		$reportItems['areaYearHigh'] = minMax('YearBuilt', 'max', $report187);

		$reportItems['areaBedrooms'] = $report187->PropertyProfile->PropertyCharacteristics->Bedrooms;
		$reportItems['areaBedroomsLow'] = minMax('Bedrooms', 'min', $report187);
		$reportItems['areaBedroomsMedian'] = minMax('Bedrooms', 'median', $report187);
		$reportItems['areaBedroomsHigh'] = minMax('Bedrooms', 'max', $report187);

		$reportItems['areaBaths']	=$report187->PropertyProfile->PropertyCharacteristics->Bedrooms;
		$reportItems['areaBathsLow'] = minMax('Baths', 'min', $report187);
		$reportItems['areaBathsMedian'] = minMax('Baths', 'median', $report187);
		$reportItems['areaBathsHigh'] = minMax('Baths', 'max', $report187);

		$areaLotSizeLow = number_format(minMax('LotSize', 'min', $report187));
		$areaLotSizeMedian = number_format(minMax('LotSize', 'median', $report187));
		$areaLotSizeHigh = number_format(minMax('LotSize', 'max', $report187));

		$reportItems['areaLotSize']  	= number_format($report187->PropertyProfile->PropertyCharacteristics->LotSize);
		$reportItems['areaLotSizeLow'] = $areaLotSizeLow;
		$reportItems['areaLotSizeMedian'] = $areaLotSizeMedian;
		$reportItems['areaLotSizeHigh'] = $areaLotSizeHigh;

		$areaLivingAreaLow = number_format(minMax('BuildingArea', 'min', $report187));
		$areaLivingAreaMedian = number_format(minMax('BuildingArea', 'median', $report187));
		$areaLivingAreaHigh = number_format(minMax('BuildingArea', 'max', $report187));

		$reportItems['areaLivingAreaLow'] = $areaLivingAreaLow;
		$reportItems['areaLivingAreaMedian'] = $areaLivingAreaMedian;
		$reportItems['areaLivingAreaHigh'] = $areaLivingAreaHigh;

		$areaSalePriceLow = number_format($report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMin);
		$areaSalePriceMedian = number_format($report187->ComparableSalesReport->AreaSalesAnalysisInfo->MedianValue);
		$areaSalePriceHigh = number_format($report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMax);


		


		$reportItems['areaPriceFoot'] = number_format($report187->PropertyProfile->PropertyCharacteristics->PricePerSQFT);
		$reportItems['areaPriceFootLow'] = number_format(minMax('PricePerSQFT', 'min', $report187));
		$reportItems['areaPriceFootMedian'] = number_format(minMax('PricePerSQFT', 'median', $report187));
		$reportItems['areaPriceFootHigh'] = number_format(minMax('PricePerSQFT', 'max', $report187));

		$reportItems['areaSalePriceLow'] = dollars($areaSalePriceLow);
		$reportItems['areaSalePriceMedian'] = dollars($areaSalePriceMedian);
		$reportItems['areaSalePriceHigh'] = dollars($areaSalePriceHigh);

		$reportItems['areaTotalRoomsLow'] = minMax('TotalRooms', 'min', $report187);
		$reportItems['areaTotalRoomsMedian'] = minMax('TotalRooms', 'median', $report187);
		$reportItems['areaTotalRoomsHigh'] = minMax('TotalRooms', 'max', $report187);

		$ChartArr = array();
		$tmp2=array();
		for ($i = 1; $i <= 12; $i++) {
	          
	          $months[] = array('date'=>date("M'y", strtotime( date( 'Y-m-01' )." -$i months")),'value'=>'_') ;
	    }

	  	$totalMonthsReport=0;		
		foreach ($reportItems['comparable'] as $key => $item) {
			/*****************************************/
			$date=date_create($item['Date']);
			$tmepDate = date_format($date,"M'y");
			foreach ($months as $key2 => $itemMonth) {
			 	if($itemMonth['date']==$tmepDate){	 		
			 		$months[$key2]['value'] = $item['PriceRate'];
			 	}
			}
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

		
		$tmp2['color'] = str_replace("#", "", $this->input->post('theme'));
		$reportItems['chart']=$tmp2;
		$reportItems['totalMonthsReport'] = $totalMonthsReport;
		$data['areaSalesAnalysis'] = $reportItems;

		$html = $this->load->view("pdf_template",$data,true);

		$html=str_replace("f15d3e", str_replace('#','',$this->input->post('theme')), $html);		
		file_put_contents("tmp.html", $html);
		$this->load->library('mpdf');
	    
	    $mpdf=new mPDF('','Letter','','',0,0,0,0);

	    $mpdf->WriteHTML($html);
	    $pdfFileName = 'temp/'.$report187->PropertyProfile->SiteAddress.'_'.uniqid().'.pdf';
	    $mpdf->Output($pdfFileName,'F'); 

	    $insertPdfReport = 	array(
	      							'project_name'=>mysql_real_escape_string($report187->PropertyProfile->SiteAddress),
	      							'report_path'=>$pdfFileName,
	      							'user_id_fk'=>$this->session->userdata('userid'),
	      							'property_owner'=>mysql_real_escape_string($report187->PropertyProfile->PrimaryOwnerName),
	      							'property_address'=>mysql_real_escape_string($report187->PropertyProfile->SiteAddress.''.$report187->PropertyProfile->SiteCity.''.$report187->PropertyProfile->SiteState.''.$report187->PropertyProfile->SiteZip),
	      							'property_apn'=>mysql_real_escape_string($report187->PropertyProfile->APN),
	      							'property_lat'=>mysql_real_escape_string($report187->PropertyProfile->PropertyCharacteristics->Latitude),
	      							'property_lng'=>mysql_real_escape_string($report187->PropertyProfile->PropertyCharacteristics->Longitude)
	      					);

	    $this->base_model->insert_one_row('lp_my_listing', $insertPdfReport);
	    $this->session->set_userdata('project_id', $this->base_model->get_last_insert_id());
      	
		echo json_encode(array('status'=>'success'));
	}

	function getReportResults(){

		header('Content-type: application/xml');
		echo file_get_contents($_GET['requrl']);
	}

}


?>