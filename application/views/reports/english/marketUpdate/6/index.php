<?php
list($r, $g, $b) = sscanf($theme, "#%02x%02x%02x");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
        }
        *{
            box-sizing: border-box;
        }
        .size_a4 { width: 8.3in; height: 11.7in; }
        .size_letter { width: 8.5in; height: 11in; }
        .size_executive { width: 7.25in; height: 10.5in; }
        .pdf_page {
            margin: 0 auto;
            box-sizing: border-box;
            background-color: #fff;
            color: #333;
            position: relative;
        }
        .pdf_header {
            top: 0;
            background: #2b2e34;
            padding: 15px;
            height: 100%;
            position: absolute;
            left: 0;
            bottom: 0;
            width: 200px;
        }
        .pacific_logo {
            width: 150px;
            display: block;
            margin: 30px auto 0;
            max-height: 80px;
        }
        .pdf_header h1 {
            font-size: 50px;
            font-weight: 900;
            color: #fff;
            line-height: 40px;
            margin: 0 0 5px;
        }
        .pdf_header h4 {
            color: #fff;
            padding: 30px 0;
            border-top: 2px solid #fff;
            border-bottom: 2px solid #fff;
            margin: 30px 0;
        }
        img.profile-pic {
            width: 140px;
            margin: 30px auto;
            display: block;
        }
        .pdf_footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding-top: 10px;
            text-align: left;
            font-size: 16px;
        }
        .pdf_footer .grid > .col-4
        {
            border: 0;
            padding: 0;
            text-align: center;
        }
        .pdf_footer .grid > .col-8 {
            border: 0;
            padding: 0;
        }
        .pdf_footer p{
            margin: 0;
        }
        .page_text{
            float: right;
        }
        .page_title{
            float: left;
        }
        .pdf_body {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 215px;
            right: 0;
            padding: 50px 0;
        }
        .pdf_body h1 {
            font-size: 50px;
            font-weight: 900;
            color: #2b2e34;
            line-height: 40px;
            margin: 0 0 5px;
        }
        .header-subtext {
            color: #2b2e34;
            font-size: 16px;
            font-weight: 700;
            font-family: 'calibri';
            border-bottom: 2px solid;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }
        .grid::after{
            display: table;
            content: '';
            width: 100%;
        }
        .grid > .col-4 {
            float: left;
            width: 33.33%;
            padding-left: 7px;
            padding-right: 7px;
        }
        .grid > .col-8 {
            float: left;
            width: 66.67%;
        }
        .grid > .col-3  {
            float: left;
            width: 25%;
        }
        .grid > .col-9 {
            float: left;
            width: 75%;
            padding: 0 15px 0 0;
        }
        .border-bottom {
            border-bottom: 2px solid;
            padding: 0 0 15px;
            margin-bottom: 15px;
        }
        .grid > .col-6 {
            float: left;
            width: 50%;
        }
        .grid > div:last-child {
            border-right: 0;
        }
        .grid.no-border > div{
            border-bottom: 0;
        }
        .listing-grid > div img {
            width: 100%;
            height: 130px;
        }
        .listing-grid p {
            margin-top: 15px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .listing-grid {
            font-family: 'calibri';
            color: #2c2e35;
            margin-bottom: 15px;
            margin-left: -7px;
            margin-right: -7px;
        }
        .listing-grid h4 {
            margin: 0;
            font-size: 24px;
            font-weight: 900;
            font-family: 'Montserrat', sans-serif;
        }
        .listing-grid h5 {
            font-size: 12px;
            font-weight: 700;
            line-height: 20px;
            font-family: 'calibri';
            margin: 5px 0 0;
        }
        .media-object img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #8dc9ff;
            margin-right: 15px;
        }
        .media-object > *{
            float: left;
        }
        .zoe-name {
            color: #fff;
            font-size: 20px;
            margin-top: 30px;
            font-weight: 700;
        }
        .contact-detail {
            color: #fff;
            line-height: 22px;
        }
        .contact-detail a {
            color: #fff;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }
        .barcode-img {
            width: 100px;
            margin: 0 auto;
            display: block;
        }
        .barcode-text {
            text-align: center;
            font-family: calibri;
            color: #fff;
            margin: 0 0 30px;
        }
    </style>
</head>

<?php
$availableCompareAble = sizeof($areaSalesAnalysis['comparable']);
$rangeOfSales['avaiProperty'] = 0;
$rangeOfSales['sQFootage'] = 0;
$rangeOfSales['avgNoOfBeds'] = 0;
$rangeOfSales['avgNoOfBaths'] = 0;
$minRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
$maxRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
foreach ($areaSalesAnalysis['comparable'] as $key => $cpmrebl) {
    if ($key > 8) {
        break;
    }
    $rangeOfSales['avaiProperty']++;
    $rangeOfSales['sQFootage'] += $cpmrebl['BuildingArea'];
    $rangeOfSales['avgNoOfBeds'] += $cpmrebl['Beds'];
    $rangeOfSales['avgNoOfBaths'] += $cpmrebl['Baths'];
    if ($minRange > $cpmrebl['PriceRate']) {
        $maxRange = $cpmrebl['PriceRate'];
    }

    if ($maxRange < $cpmrebl['PriceRate']) {
        $maxRange = $cpmrebl['PriceRate'];
    }
}
$rangeOfSales['sQFootage'] = $rangeOfSales['sQFootage'] / $rangeOfSales['avaiProperty'];
$rangeOfSales['avgNoOfBeds'] = $rangeOfSales['avgNoOfBeds'] / $rangeOfSales['avaiProperty'];
$rangeOfSales['avgNoOfBaths'] = $rangeOfSales['avgNoOfBaths'] / $rangeOfSales['avaiProperty'];

$no_of_pages = 0;

$no_of_pages = intval($availableCompareAble / 3);
if (($no_of_pages * 3) < $availableCompareAble) {
    $no_of_pages++;
}
if ($no_of_pages > 3) {
    $no_of_pages = 3;
} else {

}
$no_of_pages += 5;

$_priceMinRange = round($areaSalesAnalysis['priceMinRange']);
$_priceMaxRange = round($areaSalesAnalysis['priceMaxRange']);
$rangeDiff = (int) $_priceMaxRange - (int) $_priceMinRange;
$_sliderStartPoint = (int) $_priceMinRange - round($rangeDiff / 8);
$_sliderEndPoint = (int) $_priceMaxRange + round($rangeDiff / 8);

if (sizeof($areaSalesAnalysis['comparable']) > 0):
    $avaiProperty = 0;
    $areaSalesAnalysisChunk = $_areaSalesAnalysis = $areaSalesAnalysis['comparable'];
    $dataForReport['propertyAddress'] = $property->PropertyProfile->SiteAddress;
    $dataForReport['propertyCity'] = $property->PropertyProfile->SiteCity;
    $dataForReport['propertyState'] = $property->PropertyProfile->SiteState;
    $dataForReport['zipCode'] = $property->PropertyProfile->SiteZip;
    $dataForReport['_comparables'] = $_areaSalesAnalysis;
    $dataForReport['_comparablesChunk'] = array_chunk($_areaSalesAnalysis, 3);
    $dataForReport['rangeOfSales'] = $rangeOfSales;
    $dataForReport['partner'] = $partner;

    $this->load->view('reports/english/marketUpdate/6/pages/1', $dataForReport);

endif;
?>

</html>