<?php
list($r, $g, $b) = sscanf($theme, "#%02x%02x%02x");
?>
<!DOCTYPE html>
<html lang="en">
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
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: url(img/hero.png) no-repeat;
            background-size: cover;
            padding: 40px 0;
            height: 240px;
            background-position: center;
            text-align: center;
        }
        .pacific_logo {
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            width: 230px;
        }
        .pdf_header h1 {
            font-size: 70px;
            color: #fff;
            margin: 20px 0;
            line-height: 60px;
            font-weight: 400;
            text-align: center;
        }
        .red_text {
            color: #e52c1a;
            font-size: 20px;
        }
        .overview_text{
            font-size: 32px;
            font-weight: 500;
            color: #fff;
        }
        .santa_monica {
            font-size: 32px;
            font-weight: 700;
            color: #f26a2a;
            margin-top: 20px;
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
            top: 290px;
            bottom: 1.2in;
            left: 0;
            right: 0;
        }
        .listing-grid{
            margin-bottom: 40px;
        }
        .grid::after{
            display: table;
            content: '';
            width: 100%;
        }
        .grid > .col-3 {
            float: left;
            width: 25%;
            text-align: center;
        }
        .grid > .col-6 {
            float: left;
            width: 50%;
        }
        .listing-grid > div img {
            width: 90px;
        }
        .listing-grid h4 {
            margin: 0;
            color: #2c2e35;
            font-size: 16px;
            text-align: center;
            font-weight: 400;
        }
        .count {
            font-size: 30px;
            font-weight: 900;
            color: #e52c1a;
            text-align: center;
            line-height: 48px;
            font-family: 'Poppins', sans-serif;
            margin: 20px 0 5px;
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
            color: #2c2e35;
            font-size: 20px;
            margin-top: 30px;
            font-weight: 400;
        }
        .contact-detail{
            color: #2c2e35;
            line-height: 22px;
        }
        .contact-detail a {
            color: #2c2e35;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }
        .sales-price {
            float: right;
            color: #717171;
            font-weight: 400;
            font-family: Arial;
            text-align: right;
            line-height: 26px;
            font-size: 20px;
            margin-top: 35px;
        }
        .avg-sale {
            color: #2c2e35;
            font-size: 20px;
            text-align: center;
        }
        .avg-sale-price {
            font-size: 50px;
            text-align: center;
            font-weight: 900;
            color: #e52c1a;
            margin-bottom: 30px;
        }
        .home-worth {
            font-size: 20px;
            font-weight: 700;
            color: #2c2e35;
            margin-bottom: 5px;
        }
        .body-text {
            font-family: calibri;
            color: #2c2e35;
            margin-top: 0;
        }
        .max-w-350{
            max-width: 350px;
        }
        .barcode-img{
            width: 130px;
        }
        .barcode-text {
            margin-top: 35px;
        }
        .border-top {
            border-top: 3px solid #2c2e35;
            padding-top: 32px;
            margin-top: 25px;
            text-align: right;
        }
        .border-top .pr-20{
            padding-right: 20px;
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
    $dataForReport['zipCode'] = $property->PropertyProfile->SiteZip;
    $dataForReport['_comparables'] = $_areaSalesAnalysis;
    $dataForReport['rangeOfSales'] = $rangeOfSales;
    $dataForReport['partner'] = $partner;

    $this->load->view('reports/english/marketUpdate/4/pages/1', $dataForReport);

endif;
?>

</html>