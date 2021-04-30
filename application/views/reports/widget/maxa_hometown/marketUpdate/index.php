<!DOCTYPE html>
<html lang="en">
<head>
    <title>Market Update</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Open+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/style.css") ?>">

</head>

<?php
            $availableCompareAble = sizeof($areaSalesAnalysis['comparable']);
            $rangeOfSales['avaiProperty'] = 0;
            $rangeOfSales['sQFootage']=0;
            $rangeOfSales['avgNoOfBeds'] = 0;
            $rangeOfSales['avgNoOfBaths'] = 0;
            $minRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
            $maxRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
            foreach ($areaSalesAnalysis['comparable'] as $key => $cpmrebl) {
                if($key>8){
                    break;
                }
                $rangeOfSales['avaiProperty']++;
                $rangeOfSales['sQFootage']+=$cpmrebl['BuildingArea'];
                $rangeOfSales['avgNoOfBeds']+=$cpmrebl['Beds'];
                $rangeOfSales['avgNoOfBaths'] +=$cpmrebl['Baths'];
                if($minRange> $cpmrebl['PriceRate']){
                    $maxRange= $cpmrebl['PriceRate'];
                }

                if($maxRange< $cpmrebl['PriceRate']){
                    $maxRange= $cpmrebl['PriceRate'];
                }
            }
            $rangeOfSales['sQFootage'] = $rangeOfSales['sQFootage']/$rangeOfSales['avaiProperty'];
            $rangeOfSales['avgNoOfBeds'] = $rangeOfSales['avgNoOfBeds']/$rangeOfSales['avaiProperty'];
            $rangeOfSales['avgNoOfBaths'] = $rangeOfSales['avgNoOfBaths']/$rangeOfSales['avaiProperty'];

            $no_of_pages =0 ;
            
            $no_of_pages =intval($availableCompareAble/3) ;
            if(($no_of_pages*3)<$availableCompareAble){
              $no_of_pages++;
            }
            if($no_of_pages>3){
              $no_of_pages=3;
            }else{

            }  
            $no_of_pages+=5;
            
            $_priceMinRange = round($areaSalesAnalysis['priceMinRange']);
            $_priceMaxRange = round($areaSalesAnalysis['priceMaxRange']);
            $rangeDiff= (int)$_priceMaxRange - (int)$_priceMinRange;
            $_sliderStartPoint = (int)$_priceMinRange - round($rangeDiff/8);
            $_sliderEndPoint = (int)$_priceMaxRange + round($rangeDiff/8);

            if(sizeof($areaSalesAnalysis['comparable'])>0):
                $avaiProperty = 0; 
                $areaSalesAnalysisChunk = $_areaSalesAnalysis = $areaSalesAnalysis['comparable'];
                $dataForReport['zipCode'] = $property->PropertyProfile->SiteZip;
                $dataForReport['_comparables'] = $_areaSalesAnalysis;
                $dataForReport['rangeOfSales'] = $rangeOfSales;
                $dataForReport['partner'] = $partner;
                
                $this->load->view('reports/widget/'.$report_dir_name.'/marketUpdate/pages/1',$dataForReport);
            else:
                $_areaSalesAnalysis = array(
                                        "0" => array( 
                                            "index" => '0',
                                            "Date" => '7/3/2017',
                                            "Price" => '$465000',
                                            "PriceRate" => 465000, 
                                            "PricePerSQFT" => 591,
                                            "TotalRooms" => 0,
                                            "Address" => '1436 5th St La Verne',
                                            "Distance" => 0.09,
                                            "Beds" => 2,
                                            "SquareFeet" => 786,
                                            "BuildingArea" => 786,
                                            "Baths" => 1,
                                            "Bedrooms" => 2,
                                            "Year" => 1949,
                                            "LotSize" => 6342, 
                                            "Latitude" => 34.105028,
                                            "Longitude" => -117.780541,
                                            "Pool" => No 
                                        ),
                                        "1" => array( 
                                            "index" => '0',
                                            "Date" => '7/3/2017',
                                            "Price" => '$465000',
                                            "PriceRate" => 465000, 
                                            "PricePerSQFT" => 591,
                                            "TotalRooms" => 0,
                                            "Address" => '1436 5th St La Verne',
                                            "Distance" => 0.09,
                                            "Beds" => 2,
                                            "SquareFeet" => 786,
                                            "BuildingArea" => 786,
                                            "Baths" => 1,
                                            "Bedrooms" => 2,
                                            "Year" => 1949,
                                            "LotSize" => 6342, 
                                            "Latitude" => 34.105028,
                                            "Longitude" => -117.780541,
                                            "Pool" => No 
                                        ),
                                        "2" => array( 
                                            "index" => '0',
                                            "Date" => '7/3/2017',
                                            "Price" => '$465000',
                                            "PriceRate" => 465000, 
                                            "PricePerSQFT" => 591,
                                            "TotalRooms" => 0,
                                            "Address" => '1436 5th St La Verne',
                                            "Distance" => 0.09,
                                            "Beds" => 2,
                                            "SquareFeet" => 786,
                                            "BuildingArea" => 786,
                                            "Baths" => 1,
                                            "Bedrooms" => 2,
                                            "Year" => 1949,
                                            "LotSize" => 6342, 
                                            "Latitude" => 34.105028,
                                            "Longitude" => -117.780541,
                                            "Pool" => No 
                                        ),
                                        "3" => array( 
                                            "index" => '0',
                                            "Date" => '7/3/2017',
                                            "Price" => '$465000',
                                            "PriceRate" => 465000, 
                                            "PricePerSQFT" => 591,
                                            "TotalRooms" => 0,
                                            "Address" => '1436 5th St La Verne',
                                            "Distance" => 0.09,
                                            "Beds" => 2,
                                            "SquareFeet" => 786,
                                            "BuildingArea" => 786,
                                            "Baths" => 1,
                                            "Bedrooms" => 2,
                                            "Year" => 1949,
                                            "LotSize" => 6342, 
                                            "Latitude" => 34.105028,
                                            "Longitude" => -117.780541,
                                            "Pool" => No 
                                        ),
                                        "4" => array( 
                                            "index" => '0',
                                            "Date" => '7/3/2017',
                                            "Price" => '$465000',
                                            "PriceRate" => 465000, 
                                            "PricePerSQFT" => 591,
                                            "TotalRooms" => 0,
                                            "Address" => '1436 5th St La Verne',
                                            "Distance" => 0.09,
                                            "Beds" => 2,
                                            "SquareFeet" => 786,
                                            "BuildingArea" => 786,
                                            "Baths" => 1,
                                            "Bedrooms" => 2,
                                            "Year" => 1949,
                                            "LotSize" => 6342, 
                                            "Latitude" => 34.105028,
                                            "Longitude" => -117.780541,
                                            "Pool" => No 
                                        ),
                                        "5" => array( 
                                            "index" => '0',
                                            "Date" => '7/3/2017',
                                            "Price" => '$465000',
                                            "PriceRate" => 465000, 
                                            "PricePerSQFT" => 591,
                                            "TotalRooms" => 0,
                                            "Address" => '1436 5th St La Verne',
                                            "Distance" => 0.09,
                                            "Beds" => 2,
                                            "SquareFeet" => 786,
                                            "BuildingArea" => 786,
                                            "Baths" => 1,
                                            "Bedrooms" => 2,
                                            "Year" => 1949,
                                            "LotSize" => 6342, 
                                            "Latitude" => 34.105028,
                                            "Longitude" => -117.780541,
                                            "Pool" => No 
                                        ),
                                        "6" => array( 
                                            "index" => '0',
                                            "Date" => '7/3/2017',
                                            "Price" => '$465000',
                                            "PriceRate" => 465000, 
                                            "PricePerSQFT" => 591,
                                            "TotalRooms" => 0,
                                            "Address" => '1436 5th St La Verne',
                                            "Distance" => 0.09,
                                            "Beds" => 2,
                                            "SquareFeet" => 786,
                                            "BuildingArea" => 786,
                                            "Baths" => 1,
                                            "Bedrooms" => 2,
                                            "Year" => 1949,
                                            "LotSize" => 6342, 
                                            "Latitude" => 34.105028,
                                            "Longitude" => -117.780541,
                                            "Pool" => No 
                                        ),
                                        "7" => array( 
                                            "index" => '0',
                                            "Date" => '7/3/2017',
                                            "Price" => '$465000',
                                            "PriceRate" => 465000, 
                                            "PricePerSQFT" => 591,
                                            "TotalRooms" => 0,
                                            "Address" => '1436 5th St La Verne',
                                            "Distance" => 0.09,
                                            "Beds" => 2,
                                            "SquareFeet" => 786,
                                            "BuildingArea" => 786,
                                            "Baths" => 1,
                                            "Bedrooms" => 2,
                                            "Year" => 1949,
                                            "LotSize" => 6342, 
                                            "Latitude" => 34.105028,
                                            "Longitude" => -117.780541,
                                            "Pool" => No 
                                        ),
                                    );

                $dataForReport['zipCode'] = 222690;
                $dataForReport['_comparables'] = $_areaSalesAnalysis;
                $dataForReport['rangeOfSales'] = array();
                $dataForReport['partner'] = array();
                $dataForReport['user'] = array(
                                            "profile_image"=>"assets/images/pg1-client-1.png",
                                            "fullname"=>"ZOE HERNANDEZ",
                                            "title"=>"REALTOR",
                                            "phone"=>"1234567890",
                                            "email"=>"info@modernagent.io",
                                            "licenceno"=> "012354421",
                                            "company_logo"=>"assets/images/sign.png",
                                            "companyname"=> "LP",
                                            "street"=>"LP",
                                            "city"=>"LP",
                                            "zip"=>"12345",
                                            "state"=>"CA"
                                        );
                $this->load->view('reports/english/marketUpdate/widget_pages/16',$dataForReport);
            endif;
        ?>

</html>