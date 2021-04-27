<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;500;600;700&family=Open+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/style.css") ?>">
</head>
<body> 
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

        //Nearby School Data
        $school = array();
        foreach($property->PublicSchoolsReport->Schools->School as $_school) {
            if(!isset($school['elementary']) && (string)$_school->HighestGrade=="Grade 5") {
               $type = 'elementary';
            } else if(!isset($school['middle']) && (string)$_school->HighestGrade=="Grade 8") {
                $type = 'middle';
            } else if(!isset($school['high']) && (string)$_school->HighestGrade=="Grade 12") {
                $type = 'high';
            } else {
                continue;
            }
            $school[$type]['name'] = (string)$_school->SchoolName;
            $school[$type]['distance'] = (string)$_school->Distance;
            $school[$type]['address'] = (string)$_school->SchoolAddress;
            $school[$type]['city'] = (string)$_school->SchoolCity;
            $school[$type]['lowest_grade'] = (string)$_school->LowestGrade;
            $school[$type]['highest_grade'] = (string)$_school->HighestGrade;
            $school[$type]['student_teacher_ratio'] = (string)$_school->StudentTeacherRatio;
            $school[$type]['total_enrolled'] = (string)$_school->TotalEnrolled;
        }
        foreach($property->PrivateSchoolsReport->Schools->School as $_school) {
            if(isset($school['private'])) break;
            $school['private']['name'] = (string)$_school->SchoolName;
            $school['private']['distance'] = (string)$_school->Distance;
            $school['private']['address'] = (string)$_school->SchoolAddress;
            $school['private']['city'] = (string)$_school->SchoolCity;
            $school['private']['lowest_grade'] = (string)$_school->LowestGrade;
            $school['private']['highest_grade'] = (string)$_school->HighestGrade;
            $school['private']['student_teacher_ratio'] = (string)$_school->StudentTeacherRatio;
            $school['private']['total_enrolled'] = (string)$_school->TotalEnrolled;
            if(isset($_school->Affiliation)) $school['private']['affiliation'] = (string)$_school->Affiliation;
            if(isset($_school->Gender)) $school['private']['gender'] = (string)$_school->Gender;
            if(isset($_school->SchoolPhone)) $school['private']['phone'] = (string)$_school->SchoolPhone;
            if(isset($_school->PreschoolMembership) && (int)$_school->PreschoolMembership==0) {
                $school['private']['preschool'] = "Yes";
            } else {
                $school['private']['preschool'] = "No";
            }
        }
        $neighbor = array();
        foreach($property->NeighborhoodDemographics->MedianAge->DemographicsInfoItems->DemoInfoItem as $demoInfo) {
            if((string)$demoInfo->Description=="Male Ratio") {
               $neighbor['male_ratio'] = (string)$demoInfo->ZipTotal;
            } else if((string)$demoInfo->Description=="Female Ratio") {
               $neighbor['female_ratio'] = (string)$demoInfo->ZipTotal;
            } else if(in_array((string)$demoInfo->Description, array(2000,2009,2014))) {
               $neighbor['household_income'] = (string)$demoInfo->ZipTotal;
            }
        }

        for ($i=1; $i <= 24 ; $i++) 
        { 
            if(in_array($i, $pdfPages) || true)
            {
                $report_id = $i;

                $data = array();                
                if($i==6) 
                {
                    $data = $neighbor;
                }
                elseif($i==7) 
                {
                    $data = $school;
                }
                $this->load->view('reports/widget/'.$report_dir_name.'/buyer/pages/'.$report_id,$data);
            }
        }
    ?>
</body>
</html>