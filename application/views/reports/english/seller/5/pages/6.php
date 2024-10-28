<style>
    .page6_pdf_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding-bottom: 20px;
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
        font-family: 'BebasNeue Book';
        font-size: 65px;
        line-height: 60px;
        color: #152270;
        text-align: center;
    }
    .page6-title span{
        font-family: "Bebas Neue", sans-serif;
        color: #d79547;
    }
    .page6_pdf_header p {
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
        padding: 8px 20px;
        color: #fff;
        background-size: 80%;
        background-position-x: -100%;
        background-repeat: no-repeat;
    }
    .property-tile.blue  .page6-property-name{
        background-image:  url(<?php echo base_url("assets/reports/english/seller/5/img/blue-pattern.png"); ?>);
        background-color: #152170;
    }
    .property-tile.orange  .page6-property-name{
        background-image:  url(<?php echo base_url("assets/reports/english/seller/5/img/yellow-pattern.png"); ?>);
        background-color: #d79547;
    }
    .property-tile.blue .sale-price b {
        color: #d79547;
    }
    .property-tile.orange .sale-price b {
        color: #152170;
    }
    .page6-property-name .page6-address {
        font-size: 18px;
        font-weight: 600;
    }
    .sale-price {
        font-size: 14px;
    }
    .page6-property-name .page6-address img {
        width: 16px;
        vertical-align: middle;
        margin-right: 5px;
    }
    .sale-price b{
        font-family: 'BebasNeue Regular';
        font-size: 28px;
        margin-left: 20px;
    }
    .page6-grid > .col-6:first-child .property-tile{
        margin-right: 2px;
    }
    .page6-grid > .col-6:last-child .property-tile{
        margin-left: 2px;
    }
    .property-tile{
        padding: 12px;
    }
    .property-tile.blue{
        background-color: #e9eaf2
    }
    .property-tile.orange{
        background-color: #f2f0ed
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
        padding: 5px 0;
    }
    table {
        width: 100%;
        color: #000;
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
    .page6-grid .property-tile .img-fluid {
        height: 152px;
        width: 100%;
    }
    .page6-body-margin {
        margin: 40px 20px 0px;
    }
</style>

<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="page6_pdf_header">
            <div class="page6-title">SALES <span>COMPARABLES</span></div>
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
                    <div class="property-tile blue">
                    <?php if (!empty($value['img'])) {?>
                                <img src="<?php echo $value['img']; ?>" alt="<?php echo $value['Address']; ?>" class="img-fluid">
                        <?php } else {?>
                                <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=14&size=180x100&maptype=roadmap&markers=color:0x<?php echo str_replace("#", "", $theme) ?>%7C<?php echo $value['Latitude'] . ',' . $value['Longitude']; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg"  class="img-fluid">
                        <?php }?>
                        <!-- <img src="<?php echo base_url("assets/reports/english/seller/5/img/home1.png"); ?>" class="img-fluid" alt=""> -->
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/5/img/location-pin.png"); ?>" alt=""> <?php echo isset($value['Address']) && !empty($value['Address']) ? $value['Address'] : '-'; ?></div>
                            <div class="sale-price" style="margin-left: 28px;">Sale Price <b><?php echo isset($value['Price']) && !empty($value['Price']) ? $value['Price'] : '-'; ?></b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br><?php echo isset($value['Date']) && !empty($value['Date']) ? $value['Date'] : '-'; ?>
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
        echo isset($value['Baths']) && !empty($value['Baths']) ? '/' . $value['Baths'] : '-'; ?>
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
            </div>
        </div>

    </div>
</div>
