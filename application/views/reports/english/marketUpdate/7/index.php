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
            width: 100%;
            top: 0;
            left: 0;
            right: 0;
            background: #2b2e34;
            background-size: cover;
            padding: 40px 40px;
            height: 140px;
            background-position: center;
        }
        .pacific_logo {
            position: absolute;
            right: 40px;
            top: 25%;
            /* transform: translateY(-50%);
            width: 150px; */
            max-height: 80px;
        }
        .pdf_header h1 {
            font-size: 50px;
            font-weight: 900;
            color: #fff;
            line-height: 40px;
            margin: 0 0 5px;
        }
        .header-subtext {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            font-family: 'calibri';
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
        .pdf_footer .grid {
            margin: 0px 0px 30px 40px;
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
            top: 170px;
            bottom: 1.2in;
            left: 0;
            right: 0;
            margin: 20px;
        }
        .grid::after{
            display: table;
            content: '';
            width: 100%;
        }
        .grid > .col-4 {
            float: left;
            width: 33.33%;
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
            padding: 30px 0;
        }
        .grid > .col-6 {
            float: left;
            width: 50%;
        }
        .grid > .col-5 {
            float: left;
            width: 40%;
            margin-left: 20px;
        }
        .grid > div:last-child {
            border-right: 0;
        }
        .grid.no-border > div{
            border-bottom: 0;
        }
        .listing-grid > div img {
            width: 100%;
        }
        .listing-grid p {
            margin-top: 0;
            margin-bottom: 25px;
            /* font-size: 18px; */
        }
        .listing-grid {
            font-family: 'calibri';
            color: #2c2e35;
            margin-bottom: 15px;
        }
        .listing-grid h4 {
            margin: 0;
            font-size: 28px;
            font-weight: 900;
            font-family: 'Montserrat', sans-serif;
        }
        .listing-grid h5 {
            font-size: 14px;
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
        .barcode-img{
            width: 100px;
        }
        .barcode-text {
            margin-top: 20px !important;
            text-align: right !important;
            padding-right: 20px;
        }
        .body-text {
            font-family: calibri;
            color: #2c2e35;
            margin: 30px auto;
            text-align: center;
            max-width: 720px;
        }
        .text-right{
            text-align: right;
        }
        .mt-20{
            margin-top: 20px;
        }

    </style>
</head>

<?php
// $availableCompareAble = sizeof($areaSalesAnalysis['comparable']);
// $rangeOfSales['avaiProperty'] = 0;
// $rangeOfSales['sQFootage'] = 0;
// $rangeOfSales['avgNoOfBeds'] = 0;
// $rangeOfSales['avgNoOfBaths'] = 0;
// $minRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
// $maxRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
// foreach ($areaSalesAnalysis['comparable'] as $key => $cpmrebl) {
//     if ($key > 8) {
//         break;
//     }
//     $rangeOfSales['avaiProperty']++;
//     $rangeOfSales['sQFootage'] += $cpmrebl['BuildingArea'];
//     $rangeOfSales['avgNoOfBeds'] += $cpmrebl['Beds'];
//     $rangeOfSales['avgNoOfBaths'] += $cpmrebl['Baths'];
//     if ($minRange > $cpmrebl['PriceRate']) {
//         $maxRange = $cpmrebl['PriceRate'];
//     }

//     if ($maxRange < $cpmrebl['PriceRate']) {
//         $maxRange = $cpmrebl['PriceRate'];
//     }
// }
// $rangeOfSales['sQFootage'] = $rangeOfSales['sQFootage'] / $rangeOfSales['avaiProperty'];
// $rangeOfSales['avgNoOfBeds'] = $rangeOfSales['avgNoOfBeds'] / $rangeOfSales['avaiProperty'];
// $rangeOfSales['avgNoOfBaths'] = $rangeOfSales['avgNoOfBaths'] / $rangeOfSales['avaiProperty'];

// $no_of_pages = 0;

// $no_of_pages = intval($availableCompareAble / 3);
// if (($no_of_pages * 3) < $availableCompareAble) {
//     $no_of_pages++;
// }
// if ($no_of_pages > 3) {
//     $no_of_pages = 3;
// } else {

// }
// $no_of_pages += 5;

// $_priceMinRange = round($areaSalesAnalysis['priceMinRange']);
// $_priceMaxRange = round($areaSalesAnalysis['priceMaxRange']);
// $rangeDiff = (int) $_priceMaxRange - (int) $_priceMinRange;
// $_sliderStartPoint = (int) $_priceMinRange - round($rangeDiff / 8);
// $_sliderEndPoint = (int) $_priceMaxRange + round($rangeDiff / 8);

if (sizeof($areaSalesAnalysis['comparable']) > 0):
    $avaiProperty = 0;
    $areaSalesAnalysisChunk = $_areaSalesAnalysis = $areaSalesAnalysis['comparable'];
    $dataForReport['propertyAddress'] = $property->PropertyProfile->SiteAddress;
    $dataForReport['propertyCity'] = $property->PropertyProfile->SiteCity;
    $dataForReport['propertyState'] = $property->PropertyProfile->SiteState;
    $dataForReport['zipCode'] = $property->PropertyProfile->SiteZip;
    $dataForReport['_comparables'] = $_areaSalesAnalysis;
    $dataForReport['_comparablesChunk'] = array_chunk($_areaSalesAnalysis, 4);
    // $dataForReport['rangeOfSales'] = $rangeOfSales;
    // $dataForReport['partner'] = $partner;

    $this->load->view('reports/english/marketUpdate/7/pages/2', $dataForReport);

endif;
?>

</html>