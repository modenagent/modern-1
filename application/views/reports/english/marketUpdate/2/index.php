<!DOCTYPE html>
<html lang="en">
<head>
    <title>Market Update</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link
        href="https://fonts.googleapis.com/css?family=Crimson+Text:wght@400;600;700&family=Open+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/english/marketUpdate/css/2/style.css") ?>">

    <style type="text/css">
        .orange_footer {
            background: <?php echo $theme ?>;
        }
    </style>
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
                
                // $this->load->view('reports/english/marketUpdate/widget_pages/16',$dataForReport);
                $this->load->view('reports/english/marketUpdate/2/pages/1',$dataForReport);
            
            endif;
        ?>

</html>