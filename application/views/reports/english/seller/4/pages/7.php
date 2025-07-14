<style>
    .pdf6_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        /* padding-bottom: 20px; */
        text-align: left;
        color: #ffff;
        height: 120px;
        padding: 40px 0px 20px;
    }
    .pdf-body{
        position: absolute;
        top: 120px;
        left: 0;
        right: 0;
    }
    .text-right{
        text-align: right;
    }
    .page6-title {
        font-size: 40px;
        font-weight: 700;
        color: #3fbfb0;
        background: url(<?php echo base_url("assets/reports/english/seller/4/img/title-decoration.png"); ?>) no-repeat;
        background-size: 350px;
        background-position: center right;
        line-height: 50px
    }
    .pdf6_header p {
        font-size: 18px;
        color: #000;
        font-weight: 500;
        margin: 0;
    }
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .page6-property-name {
        background-color: #152170;
        padding: 10px 10px;
        color: #fff;
        text-align: center;
    }
    .page6-property-name .page6-address {
        font-size: 20px;
        font-weight: 600;
        text-align: center;
    }
    .page6-property-name .page6-address img {
        width: 16px;
        vertical-align: middle;
        margin-right: 5px;
    }
    .sale-price b{
        color: #3fbfb0;
        font-size: 24px;
        margin-left: 20px;
    }
    .page6-grid > .col-6:first-child .property-tile{
        margin-right: 10px;
    }
    .page6-grid > .col-6:last-child .property-tile{
        margin-left: 10px;
    }
    .page6-grid::after{
        display: table;
        content: '';
        width: 100%;
    }
    .page6-grid > .col-6 {
        float: left;
        width: 50%;
    }
    .page6-property-detail {
        background: #04081d;
        padding: 5px 15px;
    }
    table {
        width: 100%;
        color: #fff;
        font-size: 12px;
        border-collapse: collapse;
    }
    table td {
        padding: 8px 5px;
        font-weight: 500;
    }
    table tr:first-child td {
        border-bottom: 1px solid #23252f;
    }
    .mt-20{
        margin-top: 20px;
    }
    .ml-20 {
        margin-left: 20px;
    }
    .page6-body-margin {
        margin: 0px 20px;
    }
    .page6-grid .property-tile .img-fluid {
        max-height: 215px;
        width: 100%;
    }

</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="pdf6_header ml-20">
            <div class="page6-title">SALES COMPARABLES</div>
            <p>PROPERTIES THAT HAVE RECENTLY SOLD</p>
        </div>
        <div class="pdf-body page6-body-margin">
            <div class="page6-grid">
            <?php
if (isset($comparables) && !empty($comparables)) {
    $count = 0;

    foreach ($comparables as $key => $value) {
        if ($key > 8) {
            break;
        }
        ?>
                <div class="col-6 <?php echo ($count > 1) ? 'mt-20' : '' ?> ">
                    <div class="property-tile">
                        <!-- <img src="<?php echo base_url("assets/reports/english/seller/4/img/location-tile.png"); ?>" class="img-fluid" alt=""> -->
                        <?php if (!empty($value['img'])) {?>
                                <img src="<?php echo $value['img']; ?>" alt="<?php echo $value['Address']; ?>" class="img-fluid">
                        <?php } else {?>
                                <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=14&size=180x100&maptype=roadmap&markers=color:0x<?php echo str_replace("#", "", $theme) ?>%7C<?php echo $value['Latitude'] . ',' . $value['Longitude']; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg"  class="img-fluid">
                        <?php }?>
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/4/img/location-pin.png"); ?>" alt=""> <?php echo isset($value['Address']) && !empty($value['Address']) ? $value['Address'] : '-'; ?></div>
                            <div class="sale-price" style="margin-left: 4px;">Sale Price <b><?php echo isset($value['Price']) && !empty($value['Price']) ? $value['Price'] : '-'; ?></b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Days on Market<br><?php echo isset($value['DaysOnMarket']) && !empty($value['DaysOnMarket']) ? $value['DaysOnMarket'] : '-'; ?>
                                    </td>
                                    <td>
                                        Dist<br> <?php echo isset($value['Distance']) && !empty($value['Distance']) ? $value['Distance'] : '-'; ?>
                                    </td>
                                    <td>
                                        Sq.ft<br> <?php echo isset($value['SquareFeet']) && !empty($value['SquareFeet']) ? $value['SquareFeet'] : '-'; ?>
                                    </td>
                                    <td>
                                        $/Sqft<br> <?php echo isset($value['PricePerSQFT']) && !empty($value['PricePerSQFT']) ? '$' . $value['PricePerSQFT'] : '-'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br> <?php echo isset($value['Beds']) && !empty($value['Beds']) ? $value['Beds'] : '-';
        echo isset($value['Baths']) && !empty($value['Baths']) ? ' / ' . $value['Baths'] : '-'; ?>
                                    </td>
                                    <td>
                                        Year Bit<br> <?php echo isset($value['Year']) && !empty($value['Year']) ? $value['Year'] : '-'; ?>
                                    </td>
                                    <td>
                                        Lot Area<br> <?php echo isset($value['LotSize']) && !empty($value['LotSize']) ? $value['LotSize'] : '-'; ?>
                                    </td>
                                    <td>
                                        Pool<br>Association,<br> <?php echo isset($value['Pool']) && !empty($value['Pool']) ? $value['Pool'] : '-'; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
$count++;
    }
} else {
    ?>
    <div class="d-flex">
        <div class="col-12">
            <h4 class="m-0 sub_title">No Comparables Found.</h4>
        </div>
    </div>
    <?php
}
?>
                <!-- <div class="col-6">
                    <div class="property-tile">
                        <img src="<?php echo base_url("assets/reports/english/seller/4/img/location-tile.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/4/img/location-pin.png"); ?>" alt=""> 1507 2ND ST LA VERNE</div>
                            <div class="sale-price" style="margin-left: 30px;">Sale Price <b>$635,000</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>3/15/2023
                                    </td>
                                    <td>
                                        Dist<br>0.24
                                    </td>
                                    <td>
                                        Sq.ft<br>912
                                    </td>
                                    <td>
                                        $/Sqft<br>$696
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>3/1
                                    </td>
                                    <td>
                                        Year Bit<br>1953
                                    </td>
                                    <td>
                                        Lot Area<br>7,435
                                    </td>
                                    <td>
                                        Pool<br>No
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- <div class="grid mt-20">
                <div class="col-6">
                    <div class="property-tile">
                        <img src="<?php echo base_url("assets/reports/english/seller/4/img/location-tile.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/4/img/location-pin.png"); ?>" alt=""> 1845 WALNUT ST LA VERNE</div>
                            <div class="sale-price" style="margin-left: 6px;">Sale Price <b>$470,000</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>4/25/2022
                                    </td>
                                    <td>
                                        Dist<br>0.58
                                    </td>
                                    <td>
                                        Sq.ft<br>770
                                    </td>
                                    <td>
                                        $/Sqft<br>$610
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>3/1
                                    </td>
                                    <td>
                                        Year Bit<br>1924
                                    </td>
                                    <td>
                                        Lot Area<br>7,446
                                    </td>
                                    <td>
                                        Pool<br>No
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="property-tile">
                        <img src="<?php echo base_url("assets/reports/english/seller/4/img/location-tile.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/4/img/location-pin.png"); ?>" alt=""> 1848 1ST ST LA VERNE</div>
                            <div class="sale-price" style="margin-left: 30px;">Sale Price <b>$590,000</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>4/8/2022
                                    </td>
                                    <td>
                                        Dist<br>0.54
                                    </td>
                                    <td>
                                        Sq.ft<br>698
                                    </td>
                                    <td>
                                        $/Sqft<br>$845
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>1/1
                                    </td>
                                    <td>
                                        Year Bit<br>1910
                                    </td>
                                    <td>
                                        Lot Area<br>4,917
                                    </td>
                                    <td>
                                        Pool<br>No
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
