<!DOCTYPE html>
<html lang="en">

<head>

    <title>Document</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/english/seller/5/css/style.css") ?>">
    <style type="text/css">
        .ui-slider-horizontal .ui-slider-range {
            background:
                <?php echo $theme ?>
            ;
            !important;
        }

        .ui-state-default,
        .ui-widget-content .ui-state-default,
        .ui-widget-header .ui-state-default,
        .ui-slider-handle .ui-state-default .ui-corner-all {
            border: 1px solid
                <?php echo $theme ?>
            ;
            !important;
            background:
                <?php echo $theme ?>
            ;
            !important;
        }
        #slider {
            margin: 35px 0px;
        }
        .price-range-min,
        .price-range-max {
            position: absolute;
            top: -20px; /* Adjust to position above slider */
        }
        .price-range-both {
            display: none;
        }
        /* Offset left handle label slightly left */
        .ui-slider-handle:first-child .price-range-min {
            left: -10px;
        }

        /* Offset right handle label slightly right */
        .ui-slider-handle:last-child .price-range-max {
            right: -10px;
        }
    </style>
    <style type="text/css" media="print">
    .page_container
    {
        /* page-break-after: always;
        page-break-inside: avoid; */
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
// echo "<pre>";
// print_r($areaSalesAnalysis);die;
foreach ($areaSalesAnalysis['comparable'] as $key => $cpmrebl) {
    if ($key > 8) {
        break;
    }
    $rangeOfSales['avaiProperty']++;
    $buildingArea = ($cpmrebl['SquareFeet']) ? $cpmrebl['SquareFeet'] : 0;
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

?>

<?php
// $pageList = array_map(function ($val) {
//     if ($val > 19) {
//         return $val + 3;
//     }
//     if ($val > 2) {
//         return $val + 2;
//     }
//     return $val;
// }, $pageList);
for ($i = 1; $i <= 9; $i++) {
    if (!in_array($i, $pageList)) {
        continue;
    }
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
                $report_id = 7;
            }
        }

    } elseif ($i == 8) {
        $data = $rangeOfSales;
    }
    if ($i < 9 || ($i == 9 && isset($ai_summary))) {
        $this->load->view('reports/english/seller/5/pages/' . $report_id, $data);
    }
}

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>

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
        min: <?php echo $_sliderStartPoint ?>,
        max: <?php echo $_sliderEndPoint ?>,
        values: [<?php echo $_priceMinRange; ?>, <?php echo $_priceMaxRange; ?>],

        slide: function (event, ui) {
            $('.ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[0] + 'K');
            $('.ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[1]) + 'K';
            $('.price-range-both').html('<i>$' + ui.values[0] + ' - </i>$' + ui.values[1] + 'K');

            if (ui.values[0] == ui.values[1]) {
                $('.price-range-both i').css('display', 'none');
            } else {
                $('.price-range-both i').css('display', 'inline');
            }

            if (collision($('.price-range-min'), $('.price-range-max')) == true) {
                $('.price-range-min, .price-range-max').css('opacity', '0');
                $('.price-range-both').css('display', 'block');
            }
            else {
                $('.price-range-min, .price-range-max').css('opacity', '1');
                $('.price-range-both').css('display', 'none');
            }
        }
    });

    var _minValue = $('#slider').slider('values', 0);
    var _maxValue = $('#slider').slider('values', 1);

    if (_maxValue > 1000) {
        _maxValue = _maxValue / 1000 + 'M';
    } else {
        _maxValue += 'K';
    }
    if (_minValue > 1000) {
        _minValue = _minValue / 1000 + 'M';
    } else {
        _minValue += 'K';
    }
    $('.ui-slider-range').append('<span class="price-range-both value"><i>$' + $('#slider').slider('values', 0) + ' - </i>' + $('#slider').slider('values', 1) + 'k' + '</span>');

    $('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + _minValue + '</span>');

    $('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + _maxValue + '</span>');
</script>
</body>

</html>