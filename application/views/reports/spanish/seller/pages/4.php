<div class="container">
	<div class="section page4">
	
			<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/spanish/seller/images/4/bg.jpg")?>" alt="">
		

			<div class="textBlock-wrapper">
				<div class="textBlock">
					<h1 class="underline-white">VISTA AÉREA</h1>
					<p>
						Esta es una vista aérea del vecindario en el que se encuentra la posible propiedad.
Esto le dará la oportunidad de obtener una vista de pájaro de cualquier parque local, calles principales,
y carreteras
					</p>	
				</div>
			
				<div class="textBlock">
					<h1 class="underline-white">1 Milla De Radio</h1>
					<p>
						Un radio de 1 milla da el rango ideal para investigar con exactitud las propiedades que han sido recientemente vendidas y son similares a la suya en lo que respecta al número de habitaciones, baños, sala de estar (pies cuadrados), y el tamaño del lote de la propiedad.
					</p>	
				</div>
                            <div class="full-img" style="margin-left:-11.5%;padding-top:150px;">
                                <img src="https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg=&size=864x350&zoom=15&maptype=roadmap&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:0x1BBB9B|<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada" alt="" style="width:100%;"  />
                            </div>
			</div> 

                        

	</div>
</div>
