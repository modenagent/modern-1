<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/style.css") ?>">
    <style type="text/css">        
        .ui-slider-horizontal .ui-slider-range{
            background: #082147 !important;
        }
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-slider-handle .ui-state-default .ui-corner-all{
            border: 1px solid #082147 !important;
            background: #082147 !important;
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
echo "<pre>"; print_r($fromcma);
echo "<pre>"; print_r($report_dir_name);
echo "<pre>"; print_r("here"); exit;
    if(isset($fromcma) && $fromcma == 1) {
        $pdfPages = range(1, 20);
    }

    if(in_array('1', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/1');
    }
    if(in_array('2', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/2');
    }
    if(in_array('3', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/3');
    }
    if(in_array('4', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/4');
    }
    if(in_array('5', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/5');
    }
    if(in_array('6', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/6');
    }
    if(in_array('7', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/7');
    }
    if(in_array('8', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/8');
    }
    echo "<pre>"; print_r("here"); exit;
    
    if($use_rets_api == 1)
    {
        $comparable = isset($mls_comparables) && !empty($mls_comparables) ? $mls_comparables : array();
    }
    else
    {
        $comparable = isset($areaSalesAnalysis['comparable']) && !empty($areaSalesAnalysis['comparable']) ? $areaSalesAnalysis['comparable'] : array();
    }
    echo "<pre>"; print_r($comparable); exit;

    if(isset($comparable) && !empty($comparable))
    {
       // $comparable_chunk = array_chunk($comparable, 4, true);

        list($comparable_1, $comparable_2) = array_chunk($comparable, 4, true);
echo "<pre>"; print_r(); exit;
        if(in_array('9', $pdfPages) && (isset($comparable_1) && !empty($comparable_1)))
        {
            $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/9',array('comparables'=>$comparable_1,'use_rets_api'=$use_rets_api));
        }

        if(in_array('10', $pdfPages) && (isset($comparable_2) && !empty($comparable_2)))
        {
            $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/9',array('comparables'=>$comparable_2,'use_rets_api'=$use_rets_api)); //10
        }
    }

    if(in_array('11', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/11',$rangeOfSales);
    }
    if(in_array('12', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/12',$customization_pages_data['12']);
    }
    if(in_array('13', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/13',$customization_pages_data['13']);
    }

    if(in_array('14', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/14',$customization_pages_data['14']);
    }

    if(in_array('15', $pdfPages))
    {        
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/15',$customization_pages_data['15']);
    }

    if(in_array('16', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/16',$customization_pages_data['16']);
    }

    if(in_array('17', $pdfPages))
    {        
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/17',$customization_pages_data['17']); 
    }

    if(in_array('18', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/18',$customization_pages_data['18']);
    }

    if(in_array('19', $pdfPages))
    {          
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/19',$customization_pages_data['19']);    
    }  
    
    if(in_array('20', $pdfPages))
    {
        $this->load->view('reports/widget/'.$report_dir_name.'/seller/pages/20');
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
