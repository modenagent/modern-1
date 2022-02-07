<div class="container">
	<div class="section page4">
	
			<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/english/seller/images/4/bg.jpg")?>" alt="">
		

			<div class="textBlock-wrapper">
				<div class="textBlock">
					<h1 class="underline-white">Aerial View</h1>
					<p>
						This is an aerial view of the neighborhood in which you prospective property is located.
						This will give you the opportunity to get a birds eye view of any local parks, major streets,
						& highways.
					</p>	
				</div>
			
				<div class="textBlock">
					<h1 class="underline-white">Why a 1/4-Mile Radius</h1>
					<p>
						A quarter mile radius has proven to yield that best results when it comes to properties that best match yours.<br/><br/>
					</p>	
				</div>
                            <div class="full-img" style="margin-left:-11.5%;">
                                <img src="https://maps.googleapis.com/maps/api/staticmap?size=864x430&zoom=15&maptype=roadmap&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:0x<?php echo str_replace("#", "",$theme) ?>|<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg" alt="" style="width:100%;"  />
                            </div>
			</div> 

                        

	</div>
</div>
