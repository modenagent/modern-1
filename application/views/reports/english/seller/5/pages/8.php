<style>
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .text-center{
        text-align: center;
    }
    .f13{
        font-size: 13px;
    }
    .mx-auto{
        margin: 0 auto;
    }
    .d-block{
        display: block;
    }
    .page8_pdf_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding-bottom: 20px;
        text-align: left;
        color: #ffff;
        height: 110px;
        padding: 40px 0px;
    }
    .pdf-body{
        position: absolute;
        top: 110px;
        left: 0;
        right: 0;
    }
    .location-map{
        height: 500px;
        width: 100%;
        object-fit: cover;
        object-position: top;
    }
    .page8-page-title {
        font-family: 'BebasNeue Book';
        font-size: 65px;
        line-height: 60px;
        color: #152270;
        text-align: center;
        }
    .page8-page-title span{
        font-family: "Bebas Neue", sans-serif;
        color: #d79547;
        }
    .page8_pdf_header p {
        font-size: 18px;
        color: #000;
        font-weight: 500;
        margin: 0;
    }
    .grid::after{
        display: table;
        content: '';
        width: 100%;
    }
    .grid > .col-3 {
        float: left;
        width: 25%;
    }
    .property-detail {
        background: url(<?php echo base_url("assets/reports/english/seller/5/img/decorator-h.png"); ?>) no-repeat #152170;
        background-size: 65%;
        padding: 20px;
        color: #fff;
        font-weight: 700;
        text-align: center;
        margin-top: 30px;
        margin-bottom: 40px;
        background-position: center;
    }
    .property-detail .number{
        font-size: 84px;
        line-height: 84px;
        font-family: 'BebasNeue Regular';
        color: #d79547;
    }
    .property-detail + img{
        margin-bottom: 40px;
    }
    .page8-body-margin {
        margin: 40px 20px 0px;
    }
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="page8_pdf_header">
            <div class="page8-page-title">RANGE OF <span>SALES</span></div>
        </div>
        <div class="pdf-body page8-body-margin">
        <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=663x350&maptype=satelite&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:0x082147%7C<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg" alt="map" class="img-fluid location-map">
            <!-- <img src="<?php echo base_url("assets/reports/english/seller/5/img/map.png"); ?>" class="img-fluid location-map" alt=""> -->
            <div class="property-detail">
                <div class="grid">
                    <div class="col-3">
                        <div class="number"><?php echo isset($avaiProperty) && !empty($avaiProperty) ? round($avaiProperty) : 0; ?></div>Total Comps
                    </div>
                    <div class="col-3">
                        <div class="number"><?php echo isset($sQFootage) && !empty($sQFootage) ? round($sQFootage) : 0; ?></div>Avg. Sqft</div>
                    <div class="col-3">
                        <div class="number"><?php echo isset($avgNoOfBeds) && !empty($avgNoOfBeds) ? round($avgNoOfBeds) : 0; ?></div>Avg. #Beds
                    </div>
                    <div class="col-3">
                        <div class="number"><?php echo isset($avgNoOfBaths) && !empty($avgNoOfBaths) ? round($avgNoOfBaths) : 0; ?></div>Avg. #Baths
                    </div>
                </div>
            </div>
            <!-- <img src="<?php echo base_url("assets/reports/english/seller/5/img/price-range.png"); ?>" class="img-fluid mx-auto d-block" alt=""> -->
            <div id="slider"></div>
            <p class="text-center f13">
                Above are the average property details for homes that are close in proximity to yours AND have been sold within<br>
                the last 12-months. The range represents the low AND the high sales price for the properties that were sold in the<br>
                last 12-months. Only the properties that closely match yours were used. The factors that were analzyed were<br>
                Square Footage, No. Of Beds, No. of Baths, & Lot Size.
            </p>
        </div>
    </div>
</div>
