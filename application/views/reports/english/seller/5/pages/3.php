<style>
    .page3_pdf_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding: 60px 20px;
        text-align: left;
        color: #ffff;
        background: url(<?php echo base_url("assets/reports/english/seller/5/img/decorator-h.png"); ?>) no-repeat #152170;
        background-size: contain;
        text-align: center;
    }
    .page3_pdf_header p{
        margin-bottom: 40px;
        margin-top: 10px;
    }
    .page3-pdf-body {
        position: absolute;
        left: 0;
        right: 0;
        top: 233px;
        padding-top: 20px;
    }
    .page3-title {
        font-family: 'BebasNeue Book';
        font-size: 60px;
        line-height: 70px;
        color: #fff;
    }
    .page3-title span{
        color: #d79547;
        font-family: "Bebas Neue", sans-serif;
    }
    .text-center{
        text-align: center;
    }
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .d-block{
        display: block;
    }
    .mx-auto
    {
        margin: 0 auto;
    }
    .great-hands{
        position: relative;
        font-size: 22px;
        color: #fff;
        margin-top: 10px;
    }
    .great-hands:before,
    .great-hands:after {
        content: '';
        width: 150px;
        height: 2px;
        background-color: #fff;
        position: absolute;
        margin-left: -170px;
        top: 50%;
        transform: translateY(-50%);
    }
    .great-hands:after {
        right: 82px;
    }
    .grid::after{
        display: table;
        content: '';
        width: 100%;
    }
    .grid > .col-6 {
        float: left;
        width: 50%;
        padding: 20px;
        text-align: center;
        height: 220px;
        margin: 20px 0 40px;
    }
    .col-6:first-child{
        background-color: #ebecf3;
    }
    .col-6:last-child{
        background: #faf2e9;
    }
    .title {
        font-size: 24px;
        font-weight: 700;
        text-align: center;
        color: #152270;
    }
    .title.orange{
        color: #d79547;
    }
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <img src="<?php echo base_url("assets/reports/english/seller/5/img/bg.png"); ?>" alt="" class="img-fluid">
        <div class="page3_pdf_header">
            <div class="page3-title">WELCOME TO <span>OUR FAMILY</span></div>
            <div class="great-hands">YOU ARE IN GREAT HANDS</div>
        </div>
        <div class="page3-pdf-body">
            <img src="<?php echo base_url("assets/reports/english/seller/5/img/divider.png"); ?>" class="img-fluid mx-auto d-block" alt="">
            <div class="grid">
            <div class="col-6">
                <div class="title">AERIAL VIEW</div>
                <p>
                This is an aerial view of the neighborhood in
                which your prospective property is located.
                This will give you the opportunity to get a
                birds-eye-view of any local parks, major
                streets and highways
                </p>
            </div>
            <div class="col-6">
                <div class="title orange">WHY A 1/4-MILE RADIUS</div>
                <p>
                A five mile radius has proven to yield the best
                results when it comes to properties that
                match yours.
                </p>
            </div>
            </div>
            <img style="width: 95%;;margin: 0px 20px;" src="https://maps.googleapis.com/maps/api/staticmap?size=864x350&zoom=15&maptype=roadmap&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:0x<?php echo str_replace("#", "", $theme) ?>|<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg" alt="map" class="img-fluid">
            <!-- <img src="<?php echo base_url("assets/reports/english/seller/5/img/map.png"); ?>" class="img-fluid" alt=""> -->
        </div>
    </div>
</div>
