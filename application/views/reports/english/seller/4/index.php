<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/english/seller/4/style.css") ?>">

    <style type="text/css" media="print">
    .page_container
    {
        page-break-after: always;
        page-break-inside: avoid;
    }
</style>
</head>

<body>
    <?php
$report_dir_name = 'maxa_dawn_cordiner';
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
    $buildingArea = ($cpmrebl['BuildingArea']) ? $cpmrebl['BuildingArea'] : 0;
    $bed = ($cpmrebl['Beds']) ? $cpmrebl['Beds'] : 0;
    $baths = ($cpmrebl['Baths']) ? $cpmrebl['Baths'] : 0;
    // $rangeOfSales['sQFootage'] += $cpmrebl['BuildingArea'];
    $rangeOfSales['sQFootage'] += str_replace(',', '', $buildingArea);
    $rangeOfSales['avgNoOfBeds'] += $bed;
    $rangeOfSales['avgNoOfBaths'] += $baths;
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

for ($i = 1; $i <= 7; $i++) {
    $report_id = $i;

    $data = array();

    if ($i == 6 || $i == 7) {

        $comparable = isset($areaSalesAnalysis['comparable']) && !empty($areaSalesAnalysis['comparable']) ? $areaSalesAnalysis['comparable'] : array();

        if (isset($comparable) && !empty($comparable)) {
            list($comparable_1, $comparable_2) = array_chunk($comparable, 4, true);

            if ($i == 6 && (isset($comparable_1) && !empty($comparable_1))) {
                $data['comparables'] = $comparable_1;
            }

            if ($i == 7 && (isset($comparable_2) && !empty($comparable_2))) {
                $data['comparables'] = $comparable_2;
                $report_id = 8;
            }
        }

    } elseif ($i == 8) {
        $data = $rangeOfSales;
    }

    $this->load->view('reports/english/seller/4/pages/' . $report_id, $data);
}
?>

<?php

?>

</body>

</html>