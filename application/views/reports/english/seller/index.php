<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/english/seller/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/english/seller/css/main.css") ?>">
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
<style type="text/css">
    .theme-bg
    {
        background-color: <?php echo $theme ?>;
    }
    .theme-clr
    {
        color: <?php echo $theme ?>;
    }
    .underline::after,.page9a .payment-table .left-col .progress-bar, .page9a .payment-table .right-col .progress-bar,.top-banner-left,.page10 .agreement-col .points li::before{
        background-color: <?php echo $theme ?>;   
    }
    .page6 .page-content .insights .right-insight .gender-block .perc, .page6 .page6-content .insights .right-insight .gender-block .perc,.page7 .two-grid-wrapper .text-block-condensed h2 span p,.page9a .payment-table .left-col .total-amount .dolla-sign, .page9a .payment-table .right-col .total-amount .dolla-sign{
        color: <?php echo $theme ?>;   
    }
    .sales-table-top.table > thead > tr > th{
        border-color: <?php echo $theme ?>;   
    }
    .monthly-table{
        border-bottom-color:<?php echo $theme ?>;   
    }
    .monthly-table2{
        border-top-color:<?php echo $theme ?>;   
    }
    .ui-slider-horizontal .ui-slider-range{
        background: <?php echo $theme ?> !important;
    }
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-slider-handle .ui-state-default .ui-corner-all{
        border: 1px solid <?php echo $theme ?> !important;
        background: <?php echo $theme ?> !important;
    }
</style>   
 <style type="text/css" media="print">
    div.container
    {
        page-break-after: always;
        page-break-inside: avoid;
    }
</style>   

<?php 
    if($partner && count($partner)>1) {
        $this->load->view('reports/english/seller/pages/1');
        $this->load->view('reports/english/seller/pages/1_multiagent');
    } else if($partner && count($partner)==1) {
        $this->load->view('reports/english/seller/pages/1_agent');
    } else {
        $this->load->view('reports/english/seller/pages/1');
    }

    $this->load->view('reports/english/seller/pages/2');    
    $this->load->view('reports/english/seller/pages/4');
    $this->load->view('reports/english/seller/pages/5');
    $this->load->view('reports/english/seller/pages/5b');
    $this->load->view('reports/english/seller/pages/5c');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
 
<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<script>
            
            function collision($div1, $div2) {
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
        
        //
        
    if ( ui.values[0] == ui.values[1] ) {
      $('.price-range-both i').css('display', 'none');
    } else {
      $('.price-range-both i').css('display', 'inline');
    }
        
        //
        
        if (collision($('.price-range-min'), $('.price-range-max')) == true) {
            $('.price-range-min, .price-range-max').css('opacity', '0');    
            $('.price-range-both').css('display', 'block');     
        } else {
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
