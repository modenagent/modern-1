    <page class="pdf10 p-0">
        <div class="map_content">
            <h2 class="small_big">RANGE OF SALES <span>BASED ON RECENT COMPARABLE SALES</span></h2>
        </div>
        <img src="https://maps.googleapis.com/maps/api/staticmap?size=800x440&zoom=15&maptype=roadmap&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:0xbeaf86|<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg" alt="map2"  class="img-fluid d-block" style="margin:auto">
        <div class="map_content">
            <ul class="stats">
                <li>
                    <span><?php echo isset($avaiProperty) && !empty($avaiProperty) ? round($avaiProperty) : 0; ?></span>
                    Total Comps
                </li>
                <li>
                    <span><?php echo isset($sQFootage) && !empty($sQFootage) ? round($sQFootage) : 0; ?></span>
                    Avg. Soft
                </li>
                <li>
                    <span><?php echo isset($avgNoOfBeds) && !empty($avgNoOfBeds) ? round($avgNoOfBeds) : 0; ?></span>
                    Avg. # Beds
                </li>
                <li>
                    <span><?php echo isset($avgNoOfBaths) && !empty($avgNoOfBaths) ? round($avgNoOfBaths) : 0; ?></span>
                    Avg. # Baths
                </li>
            </ul>
            <!-- <img src="assets/range_bar.png" alt="range" class="img-fluid mx-auto"> -->
            <div id="slider"></div>
            <p class="mt-30">
                Above are the average property details for homes that are close in proximity to yours
                AND have been sold within the last 12-months. The range represents the low AND
                the high sales price for the properties that were sold in the last 12-months. Only the
                properties that closely match yours were used. The factors that were analyzed were
                Square Footage, No. Of Beds, No. of Baths, & Lot Size.
            </p>     
        </div>
    </page>