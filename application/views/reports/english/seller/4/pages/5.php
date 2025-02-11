<style>
    .pdf5_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding-bottom: 20px;
        text-align: left;
        color: #ffff;
        height: 120px;
        padding: 40px 0px;
    }
    .pdf5-body{
        position: absolute;
        top: 120px;
        left: 0;
        right: 0;
    }
    .text-right{
        text-align: right;
    }
    .page5-title {
        font-size: 40px;
        font-weight: 700;
        color: #3fbfb0;
        background: url(<?php echo base_url("assets/reports/english/seller/4/img/title-decoration.png"); ?>) no-repeat;
        background-size: 350px;
        background-position: center right;
        line-height: 50px
    }
    .pdf5_header p {
        font-size: 18px;
        color: #000;
        font-weight: 500;
        margin: 0;
    }
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .table{
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        color: initial;
        font-size: 16px;
    }
    .table tbody td{
        padding: 6px 20px;
        background:#f0f1f7;
        border-top: 2px solid #e6e8f7;
    }
    .table thead th{
        background-color: #152170;
        font-weight: bold;
        font-size: 18px;
        color: #fff;
        padding: 15px 20px;
        text-align: left;
    }
    .table tfoot td{
        background-color: #3fbfb0;
        font-weight: bold;
        font-size: 18px;
        color: #000;
        padding: 10px 20px;
    }
    .ml-20 {
        margin-left: 20px;
    }
    .body-margin {
        margin: 20px 20px 0px;
    }
    /* .page1_table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;

    } */
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="pdf5_header ml-20">
            <div class="page5-title">AREA SALES ANALYSIS</div>
            <p>SALES IN THE PAST 12 MONTHS</p>
        </div>
        <div class="pdf5-body body-margin">
<?php
$series = $areaSalesAnalysis['chart']['series'];
$date = $areaSalesAnalysis['chart']['date'];
$color = $areaSalesAnalysis['chart']['color'];
$chartImageUrl = "https://quickchart.io/chart?cht=bvs&chd=t:$series&chs=620x350&chl=$date&chbh=40,30,45&chco=$color&chds=a&chxt=y";

/** Check chart image exist or not */
$headers = get_headers($chartImageUrl);
$httpStatus = intval(substr($headers[0], 9, 3));

// Check if the HTTP status code indicates success (200 OK)
if ($httpStatus === 200) {?>
    <img src="<?=$chartImageUrl?>"  alt="graph" class="img-fluid mx-auto mt-50 chart-img">
    <!-- <img src="<?php echo base_url("assets/reports/english/seller/5/img/sales-analysis.png"); ?>" class="img-fluid" alt=""> -->
<?php }?>
            <!-- <img src="<?php echo base_url("assets/reports/english/seller/4/img/sales-analysis.png"); ?>" class="img-fluid" alt=""> -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Monthly Sales Overview</th>
                        <th>PIQ</th>
                        <th>Low</th>
                        <th>Medium</th>
                        <th>High</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Distance</td>
                        <td>0</td>
                        <td><?php echo isset($areaSalesAnalysis['areaMinRadius']) && !empty($areaSalesAnalysis['areaMinRadius']) ? $areaSalesAnalysis['areaMinRadius'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaMedianRadius']) && !empty($areaSalesAnalysis['areaMedianRadius']) ? $areaSalesAnalysis['areaMedianRadius'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaMaxRadius']) && !empty($areaSalesAnalysis['areaMaxRadius']) ? $areaSalesAnalysis['areaMaxRadius'] : 0; ?></td>
                    </tr>
                    <tr>
                        <td>Living Area</td>
                        <td><?php echo isset($areaSalesAnalysis['areaLivingArea']) && !empty($areaSalesAnalysis['areaLivingArea']) ? $areaSalesAnalysis['areaLivingArea'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaLivingAreaLow']) && !empty($areaSalesAnalysis['areaLivingAreaLow']) ? $areaSalesAnalysis['areaLivingAreaLow'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaLivingAreaMedian']) && !empty($areaSalesAnalysis['areaLivingAreaMedian']) ? $areaSalesAnalysis['areaLivingAreaMedian'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaLivingAreaHigh']) && !empty($areaSalesAnalysis['areaLivingAreaHigh']) ? $areaSalesAnalysis['areaLivingAreaHigh'] : 0; ?></td>
                    </tr>
                    <tr>
                        <td>Price Per Soft</td>
                        <td><?php echo isset($areaSalesAnalysis['areaPriceFoot']) && !empty($areaSalesAnalysis['areaPriceFoot']) ? '$' . $areaSalesAnalysis['areaPriceFoot'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaPriceFootLow']) && !empty($areaSalesAnalysis['areaPriceFootLow']) ? '$' . $areaSalesAnalysis['areaPriceFootLow'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaPriceFootMedian']) && !empty($areaSalesAnalysis['areaPriceFootMedian']) ? '$' . $areaSalesAnalysis['areaPriceFootMedian'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaPriceFootHigh']) && !empty($areaSalesAnalysis['areaPriceFootHigh']) ? '$' . $areaSalesAnalysis['areaPriceFootHigh'] : 0; ?></td>
                    </tr>
                    <tr>
                        <td>Year Built</td>
                        <td><?php echo isset($areaSalesAnalysis['areaYear']) && !empty($areaSalesAnalysis['areaYear']) ? $areaSalesAnalysis['areaYear'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaYearLow']) && !empty($areaSalesAnalysis['areaYearLow']) ? $areaSalesAnalysis['areaYearLow'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaYearMedian']) && !empty($areaSalesAnalysis['areaYearMedian']) ? $areaSalesAnalysis['areaYearMedian'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaYearHigh']) && !empty($areaSalesAnalysis['areaYearHigh']) ? $areaSalesAnalysis['areaYearHigh'] : 0; ?></td>
                    </tr>
                    <tr>
                        <td>Lot Size</td>
                        <td><?php echo isset($areaSalesAnalysis['areaLotSize']) && !empty($areaSalesAnalysis['areaLotSize']) ? $areaSalesAnalysis['areaLotSize'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaLotSizeLow']) && !empty($areaSalesAnalysis['areaLotSizeLow']) ? $areaSalesAnalysis['areaLotSizeLow'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaLotSizeMedian']) && !empty($areaSalesAnalysis['areaLotSizeMedian']) ? $areaSalesAnalysis['areaLotSizeMedian'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaLotSizeHigh']) && !empty($areaSalesAnalysis['areaLotSizeHigh']) ? $areaSalesAnalysis['areaLotSizeHigh'] : 0; ?></td>
                    </tr>
                    <tr>
                        <td>Bedrooms</td>
                        <td><?php echo isset($areaSalesAnalysis['areaBedrooms']) && !empty($areaSalesAnalysis['areaBedrooms']) ? $areaSalesAnalysis['areaBedrooms'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaBedroomsLow']) && !empty($areaSalesAnalysis['areaBedroomsLow']) ? $areaSalesAnalysis['areaBedroomsLow'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaBedroomsMedian']) && !empty($areaSalesAnalysis['areaBedroomsMedian']) ? $areaSalesAnalysis['areaBedroomsMedian'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaBedroomsHigh']) && !empty($areaSalesAnalysis['areaBedroomsHigh']) ? $areaSalesAnalysis['areaBedroomsHigh'] : 0; ?></td>
                    </tr>
                    <tr>
                        <td>Baths</td>
                        <td><?php echo isset($areaSalesAnalysis['areaBaths']) && !empty($areaSalesAnalysis['areaBaths']) ? $areaSalesAnalysis['areaBaths'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaBathsLow']) && !empty($areaSalesAnalysis['areaBathsLow']) ? $areaSalesAnalysis['areaBathsLow'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaBathsMedian']) && !empty($areaSalesAnalysis['areaBathsMedian']) ? $areaSalesAnalysis['areaBathsMedian'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['areaBathsHigh']) && !empty($areaSalesAnalysis['areaBathsHigh']) ? $areaSalesAnalysis['areaBathsHigh'] : 0; ?></td>
                    </tr>
                    <tr>
                        <td>Stories</td>
                        <td><?php echo isset($areaSalesAnalysis['stories']) && !empty($areaSalesAnalysis['stories']) ? $areaSalesAnalysis['stories'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['stories']) && !empty($areaSalesAnalysis['stories']) ? $areaSalesAnalysis['stories'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['stories']) && !empty($areaSalesAnalysis['stories']) ? $areaSalesAnalysis['stories'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['stories']) && !empty($areaSalesAnalysis['stories']) ? $areaSalesAnalysis['stories'] : 0; ?></td>
                    </tr>
                    <tr>
                        <td>Pools</td>
                        <td><?php echo isset($areaSalesAnalysis['propertyPool']) && !empty($areaSalesAnalysis['propertyPool']) ? $areaSalesAnalysis['propertyPool'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['propertyPoolLow']) && !empty($areaSalesAnalysis['propertyPoolLow']) ? $areaSalesAnalysis['propertyPoolLow'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['propertyPoolMedian']) && !empty($areaSalesAnalysis['propertyPoolMedian']) ? $areaSalesAnalysis['propertyPoolMedian'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['propertyPoolHign']) && !empty($areaSalesAnalysis['propertyPoolHign']) ? $areaSalesAnalysis['propertyPoolHign'] : 0; ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                    <td>Sales Price</td>
                        <td><?php echo isset($areaSalesAnalysis['propertySalePrice']) && !empty($areaSalesAnalysis['propertySalePrice']) ? '$' . $areaSalesAnalysis['propertySalePrice'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['propertySalePriceLow']) && !empty($areaSalesAnalysis['propertySalePriceLow']) ? '$' . $areaSalesAnalysis['propertySalePriceLow'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['propertySalePriceMedian']) && !empty($areaSalesAnalysis['propertySalePriceMedian']) ? '$' . $areaSalesAnalysis['propertySalePriceMedian'] : 0; ?></td>
                        <td><?php echo isset($areaSalesAnalysis['propertySalePriceLowHigh']) && !empty($areaSalesAnalysis['propertySalePriceLowHigh']) ? '$' . $areaSalesAnalysis['propertySalePriceLowHigh'] : 0; ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
