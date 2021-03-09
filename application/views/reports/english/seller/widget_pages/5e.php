<div class="container">
	<div class="section page5">
	
		<header>
			<h2 class="underline title-bold">Range of Sales</h2>
			<p> BASED ON RECENT COMPARABLE SALES.</p>
		</header>

       <div class="">

       <div class="row">
       
        <div class="col-sm-12">

            <div class="map2" id='map9' style="margin-left:-12%;margin-right: -12%;margin-bottom: 10%;">
                <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=663x350&maptype=satelite&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:0x<?php echo str_replace("#", "",$theme) ?>%7C<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg" alt="" style="width:100%;" />
            </div>
    
	    </div>

</div>
	    
</div>

        <div class="row">
            
          <div class="text-content">

           <div class="col-xs-3">
               
              <div class="text-box text-box1">

              <h3 class="num-text"><?php echo round($avaiProperty); ?></h3>
              <p class="text-uppercase total-text1"> total comps </p>

             </div>
          
           </div>

           <div class="col-xs-3">

            <div class="text-box text-box2">

            <h3 class="num-text"><?php echo round($sQFootage); ?></h3>
            <p class="text-uppercase total-text2"> avg.soft </p>
               
           </div>

       </div>

           <div class="col-xs-3">

            <div class="text-box text-box3">

            <h3 class="num-text"><?php echo round($avgNoOfBeds); ?></h3>
            <p class="text-uppercase total-text3"> avg. # beds </p>
               
           </div>

       </div>

           <div class="col-xs-3">

            <div class="text-box text-box4">

            <h3 class="num-text"><?php echo round($avgNoOfBaths); ?></h3>
            <p class="text-uppercase total-text4"> avg. # baths </p>
               
           </div>

          </div> 

      </div>

        </div>

        <div class="row">

          <div class="col-sm-12">
            
           <div id="slider"> </div> 
          
        <div class="para-def">
            <p class="font-average">
             
            Above are the average property details for homes that are close in proximity to yours AND have been sold within the last 12-months.
            The range represents the low AND the high sales price for the properties that were sold in the last 12-months. Only the properties that closely match yours were used. The factors that were analzyed were Square Footage, No. Of Beds, No. of Baths, & Lot Size.
   
           </p>

           </div>

        </div>


</div>

		<div class="table-wrapper">
	</div>

</div>

</div>
