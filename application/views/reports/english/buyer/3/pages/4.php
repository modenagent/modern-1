<page class="pdf6">
    <div class="map_content">
        <h2>
            Aerial View
        </h2>
        <p>
            This is an aerial view of the neighborhood in which your
            prospective property is located. This will give you the
            opportunity to get a birds-eye-view of any local parks,
            major streets and highways.
        </p>
        <h2>
            Why a 5-Mile Radius
        </h2>
        <p>
            A five mile radius has proven to yield the best results
            when it comes to properties that match yours.
        </p>
    </div>
    <img src="https://maps.googleapis.com/maps/api/staticmap?size=864x456&zoom=15&maptype=roadmap&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:0x<?php echo str_replace("#", "",$theme) ?>|<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg" alt="map" class="img-fluid d-block">
</page>