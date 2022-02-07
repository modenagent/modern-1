<?php
list($r, $g, $b) = sscanf($theme, "#%02x%02x%02x");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:wght@400;600;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/english/buyer/3/style.css") ?>">
    <style type="text/css">        
        .ui-slider-horizontal .ui-slider-range{
            background: #082147 !important;
        }
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-slider-handle .ui-state-default .ui-corner-all{
            border: 1px solid #082147 !important;
            background: #082147 !important;
        }
        .buyerpdf6 .percentage {
            color: <?php echo $theme ; ?>;
        }
        .blue_box,.height70:before,.buyerpdf13 .blue_bar,.check_box,.monthly_installation ul li {
            background: <?php echo $theme ; ?>;
        }
        .height16:before,.footer {
            background: rgba(<?php echo "$r,$g,$b" ?>,0.8);
        }
        .height8:before {
            background: rgba(<?php echo "$r,$g,$b" ?>,0.6);
        }
        .height6:before {
            background: rgba(<?php echo "$r,$g,$b" ?>,0.4);
        }
        .pdf4 {
            background: -webkit-gradient(
              linear,
              left top,
              left bottom,
              from(rgba(<?php echo "$r,$g,$b" ?>, 0.7)),
              to(rgba(<?php echo "$r,$g,$b" ?>, 0.7))
            ),
            url(<?php echo base_url("assets/reports/english/buyer/3/images/joel-vodell-8-Ogfqvw15-Rg-unsplash.jpg")?>);
          background: -o-linear-gradient(rgba(<?php echo "$r,$g,$b" ?>, 0.7), rgba(<?php echo "$r,$g,$b" ?>, 0.7)),
            url(<?php echo base_url("assets/reports/english/buyer/3/images/joel-vodell-8-Ogfqvw15-Rg-unsplash.jpg")?>);
          background: linear-gradient(rgba(<?php echo "$r,$g,$b" ?>, 0.7), rgba(<?php echo "$r,$g,$b" ?>, 0.7)),
            url(<?php echo base_url("assets/reports/english/buyer/3/images/joel-vodell-8-Ogfqvw15-Rg-unsplash.jpg")?>);
        }
        .pdf6, .neighborhood_stats, .pdf16, .pdf17{
            background: -webkit-gradient(
              linear,
              left top,
              left bottom,
              from(rgba(<?php echo "$r,$g,$b" ?>, 0.7)),
              to(rgba(<?php echo "$r,$g,$b" ?>, 0.7))
            ),
            url(<?php echo base_url("assets/reports/english/buyer/3/images/chuttersnap-u-Zcl28p3m4-unsplash.jpg")?>);
          background: -o-linear-gradient(rgba(<?php echo "$r,$g,$b" ?>, 0.7), rgba(<?php echo "$r,$g,$b" ?>, 0.7)),
            url(<?php echo base_url("assets/reports/english/buyer/3/images/chuttersnap-u-Zcl28p3m4-unsplash.jpg")?>);
          background: linear-gradient(rgba(<?php echo "$r,$g,$b" ?>, 0.7), rgba(<?php echo "$r,$g,$b" ?>, 0.7)),
            url(<?php echo base_url("assets/reports/english/buyer/3/images/chuttersnap-u-Zcl28p3m4-unsplash.jpg")?>);
        }
        .buyerpdf13 .col-20,.ul_border {
            border-color: <?php echo $theme; ?>
        }
        .pdf16 .ul_border, .pdf17 .ul_border {
            border-color: #fff;
        }
    </style>
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


?>
<?php 
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
        } else if(is_numeric((int)$demoInfo->Description) && (int)$demoInfo->Description > 1000) {
               $neighbor['household_income'] = (string)$demoInfo->ZipTotal;
            }
    }

  ?>
<?php
    for ($i=1; $i <= 18 ; $i++) 
    { 
        $report_id = $i;

        $data = array();                
        if($i==6) 
        {
            $data = $neighbor;
        }
        elseif($i==7) 
        {
            $data['school'] = $school;
            // var_dump($data);die;
        }
        $this->load->view('reports/english/buyer/3/pages/'.$report_id,$data);
    }
    
    
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
 


<script>            
    function collision($div1, $div2) 
    {
        var x1 = $div1.offset().left;
        var w1 = 40;
        var r1 = x1 + w1;
        var x2 = $div2.offset().left;
        var w2 = 40;
        var r2 = x2 + w2;

        if (r1 < x2 || x1 > r2) return false;
        return true;

    }
    $('#slider').slider({
        range: true,
        min: <?php echo  $_sliderStartPoint ?>,
        max: <?php echo $_sliderEndPoint ?>,
        values: [ <?php echo $_priceMinRange; ?>, <?php echo $_priceMaxRange; ?> ],

        slide: function(event, ui) {            
            $('.ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[ 0 ]+'K');
            $('.ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[ 1 ])+'K';
            $('.price-range-both').html('<i>$' + ui.values[ 0 ] + ' - </i>$' + ui.values[ 1 ]+'K' );

            if ( ui.values[0] == ui.values[1] ) {
                $('.price-range-both i').css('display', 'none');
            } else {
                $('.price-range-both i').css('display', 'inline');
            }
            
            if (collision($('.price-range-min'), $('.price-range-max')) == true) {
                $('.price-range-min, .price-range-max').css('opacity', '0');    
                $('.price-range-both').css('display', 'block');     
            } 
            else 
            {
                $('.price-range-min, .price-range-max').css('opacity', '1');    
                $('.price-range-both').css('display', 'none');      
            }            
        }
    });

    var _minValue = $('#slider').slider('values', 0 );
    var _maxValue = $('#slider').slider('values', 1 );

    if(_maxValue>1000){
        _maxValue = _maxValue/1000 + 'M';
    } else {
        _maxValue += 'K';
    }
    if(_minValue>1000){
        _minValue = _minValue/1000 + 'M';
    } else {
        _minValue += 'K';
    }
    $('.ui-slider-range').append('<span class="price-range-both value"><i>$' + $('#slider').slider('values', 0 ) + ' - </i>' + $('#slider').slider('values', 1 ) +'k'+ '</span>');

    $('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + _minValue + '</span>');

    $('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + _maxValue + '</span>');
</script>
</body>
</html>
