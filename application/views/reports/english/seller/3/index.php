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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/english/seller/3/style.css") ?>">
    <style type="text/css">        
        .ui-slider-horizontal .ui-slider-range{
            background: <?php echo $theme ?>; !important;
        }
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-slider-handle .ui-state-default .ui-corner-all{
            border: 1px solid <?php echo $theme ?>; !important;
            background: <?php echo $theme ?>; !important;
        }
        .number_round,.btn_sale,.avg_block .number,.pdf16,.pdf17 {
            background: <?php echo $theme ?>;
        }
        .footer {
            background: rgba(<?php echo "$r,$g,$b" ?>, 0.7);
        }
        .main_title,.pricing_buttons li a.btn_price {
            color: <?php echo $theme ?>;
        }
        .pdf6 {
          background: -webkit-gradient(linear, left top, left bottom, from(rgba(<?php echo "$r,$g,$b" ?>, 0.801)), to(rgba(<?php echo "$r,$g,$b" ?>, 0.801)));
          background: -o-linear-gradient(rgba(<?php echo "$r,$g,$b" ?>, 0.801), rgba(<?php echo "$r,$g,$b" ?>, 0.801));
          background: linear-gradient(rgba(<?php echo "$r,$g,$b" ?>, 0.801), rgba(<?php echo "$r,$g,$b" ?>, 0.801));
          background-size: cover;
          background-position: center;
        }
        .we_reach:before {
          background: -webkit-gradient(linear,left bottom, left top,from(rgba(0, 0, 0, 1)),color-stop(0.65, rgba(<?php echo "$r,$g,$b" ?>, 0.81)));
          background: -o-linear-gradient(bottom,rgba(0, 0, 0, 1) 0%,rgba(<?php echo "$r,$g,$b" ?>, 0.81) 0.65);
          background: linear-gradient(0deg,rgba(0, 0, 0, 1) 0%,rgba(<?php echo "$r,$g,$b" ?>, 0.81) 0.65);
        }
        .pdf4 {
          background: -webkit-gradient(linear, left top, left bottom, from(rgba(<?php echo "$r,$g,$b" ?>, 0.801)), to(rgba(<?php echo "$r,$g,$b" ?>, 0.801)));
          background: -o-linear-gradient(rgba(<?php echo "$r,$g,$b" ?>, 0.801), rgba(<?php echo "$r,$g,$b" ?>, 0.801));
          background: linear-gradient(rgba(<?php echo "$r,$g,$b" ?>, 0.801), rgba(<?php echo "$r,$g,$b" ?>, 0.801));
          background-size: cover;
          background-position: center;
        }
        .pdf16 .main_title {
            color: #fff;
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

    $comparable = array();
    if($use_rets_api == 1)
    {
        $comparable = $mls_comparables;
    }
    else
    {
        $comparable = $areaSalesAnalysis['comparable'];
    }

?> 

<?php

$skip_pages = [2,3];
for ($i=1; $i <= 20 ; $i++) {
    $report_id = $i;
    if (!in_array($i, $pageList)) {
        continue;
    }
    if($i==9 || $i==10) {

        $data = array();


        $comparable = isset($areaSalesAnalysis['comparable']) && !empty($areaSalesAnalysis['comparable']) ? $areaSalesAnalysis['comparable'] : array();

        if(isset($comparable) && !empty($comparable))
        {
           // $comparable_chunk = array_chunk($comparable, 4, true);

            list($comparable_1, $comparable_2) = array_chunk($comparable, 4, true);

            if($i==9 && (isset($comparable_1) && !empty($comparable_1)))
            {
                $data['comparables'] = $comparable_1;
                
            }

            if($i==10 && (isset($comparable_2) && !empty($comparable_2)))
            {
                $data['comparables'] = $comparable_2;
                $report_id = 9;
            }
        }

    }
    else if($i == 11) {
        $data = $rangeOfSales;
    }
    $this->load->view('reports/english/seller/3/pages/'.$report_id,$data);
}

    
    // if(in_array('3', $pdfPages))
    // {
    //     $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/3');
    // }
   

    

    
    // if(in_array('12', $pdfPages))
    // {
    //     $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/12',$customization_pages_data['12']);
    // }
    // if(in_array('13', $pdfPages))
    // {
    //     $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/13',$customization_pages_data['13']);
    // }

    // if(in_array('14', $pdfPages))
    // {
    //     $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/14',$customization_pages_data['14']);
    // }

    // if(in_array('15', $pdfPages))
    // {        
    //     $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/15',$customization_pages_data['15']);
    // }

    // if(in_array('16', $pdfPages))
    // {
    //     $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/16',$customization_pages_data['16']);
    // }

    // if(in_array('17', $pdfPages))
    // {        
    //     $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/17',$customization_pages_data['17']); 
    // }

    // if(in_array('18', $pdfPages))
    // {
    //     $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/18',$customization_pages_data['18']);
    // }

    // if(in_array('19', $pdfPages))
    // {          
    //     $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/19',$customization_pages_data['19']);    
    // }  
    
    // if(in_array('20', $pdfPages))
    // {
    //     $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/20');
    // }
    
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