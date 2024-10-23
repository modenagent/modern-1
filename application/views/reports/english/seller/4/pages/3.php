<style>
    .pdf_page3_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding: 30px 40px;
        text-align: left;
        color: #ffff;
    }
    .pdf_page3_header p{
        margin-bottom: 40px;
        margin-top: 10px;
        color: #ffff;
    }
    .page3-title {
        font-size: 35px;
        font-weight: 700;
        color: #3fbfb0;
    }
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <img src="<?php echo base_url("assets/reports/english/seller/4/img/bg.png"); ?>" alt="" class="img-fluid">
        <div class="pdf_page3_header">
            <div class="page3-title">AERIAL VIEW</div>
            <p>
                This is an aerial view of the neighborhood in which you prospective <br>
                property is located. This will give you the opportunity to get a birds eye  <br>
                view of any local parks, major streets, & highways.
            </p>
            <div class="page3-title">WHY A 1/4-MILE RADIUS</div>
            <p>
                A quarter mile radius has proven to yield that best results <br>
                when it comes to properties that best match yours.
            </p>
            <img style="width: 100%;" src="https://maps.googleapis.com/maps/api/staticmap?size=864x350&zoom=15&maptype=roadmap&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:0x<?php echo str_replace("#", "", $theme) ?>|<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg" alt="map" class="img-fluid">
            <!-- <img src="<?php echo base_url("assets/reports/english/seller/4/img/location.png"); ?>" class="img-fluid" alt=""> -->
        </div>
    </div>
</div>
