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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/english/seller/2/style.css") ?>">

    <style type="text/css">
        .small_big,
        .box_title,
        .pricing_buttons li a.btn_price {
            color:
                <?php echo $theme ?>
            ;
        }

        .map_content h2:after,
        .table_title:after,
        .questionnaire li span,
        .avg_block .number,
        .thanks_block {
            background:
                <?php echo $theme ?>
            ;
        }

        .orange_line {
            border-color:
                <?php echo $theme ?>
            ;
        }

        .ui-slider .ui-slider-handle,
        .ui-slider-horizontal .ui-slider-range {
            /*height: 1em;
            width: 1em;
            border-radius: 50px;*/
            background-color:
                <?php echo $theme ?>
            ;
            border-color:
                <?php echo $theme ?>
            ;
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

?>

    <?php
$pageList = array_map(function ($val) {
    if ($val > 19) {
        return $val + 3;
    }
    if ($val > 2) {
        return $val + 2;
    }
    return $val;
}, $pageList);

// $pdfPages
$skip_pages = [3, 4, 22];
for ($i = 1; $i <= 25; $i++) {
    // if(in_array($i, $pdfPages) || true)
    // {
    if (!in_array($i, $pageList)) {
        continue;
    }
    // if(in_array($i, $skip_pages) || (!empty($seller_cma) && $i > 10)) {
    //     continue;
    // }
    $report_id = $i;

    $data = array();

    if ($i == 8 || $i == 9) {

        $comparable = isset($areaSalesAnalysis['comparable']) && !empty($areaSalesAnalysis['comparable']) ? $areaSalesAnalysis['comparable'] : array();

        if (isset($comparable) && !empty($comparable)) {
            // $comparable_chunk = array_chunk($comparable, 4, true);

            list($comparable_1, $comparable_2) = array_chunk($comparable, 4, true);

            if ($i == 8 && (isset($comparable_1) && !empty($comparable_1))) {
                $data['comparables'] = $comparable_1;
            }

            if ($i == 9 && (isset($comparable_2) && !empty($comparable_2))) {
                $data['comparables'] = $comparable_2;
                $report_id = 8;
            }
        }
        // $report_id = $i + 2;
        // $this->load->view('reports/english/seller/2/pages/' . $report_id, $data);

    } elseif ($i == 10) {
        $data = $rangeOfSales;
        // $this->load->view('reports/english/seller/2/pages/11', $data);
    }

    if ($i < 25 || ($i == 25 && isset($ai_summary))) {
        $this->load->view('reports/english/seller/2/pages/' . $report_id, $data);
    }
    // if ($i == 1) {
    //     $this->load->view('reports/english/seller/2/pages/1', $data);
    // $this->load->view('reports/english/seller/2/pages/2', $data);
    // $this->load->view('reports/english/seller/2/pages/3', $data);

    // } else {
    // $report_id = $i + 2;
    // }
    // }
}

?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"
        type="text/javascript"></script>



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