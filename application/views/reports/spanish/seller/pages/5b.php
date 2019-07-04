<div class="container">
	<div class="section page5">
	
		<header>
			<h2 class="underline title-bold">Análisis del Área de Venta</h2>
			<p>Ventas en los últimos 12 meses</p>
		</header>

        <div style="padding-top:50px;">

            <div class="row">

                <div class="col-sm-12">

                    <div class="full-img"><img src="https://chart.googleapis.com/chart?cht=bvs&chd=t:<?php echo $areaSalesAnalysis['chart']['series']; ?>&chs=700x400&chl=<?php echo $areaSalesAnalysis['chart']['date']; ?>&chbh=40,30,45&chco=<?php echo $areaSalesAnalysis['chart']['color']; ?>&chds=a&chxt=y" alt="" style="margin:auto; width:100%; height:5.15in;" /></div>

               </div>
            </div>

        </div>

		<div class="table-wrapper"  style="margin-top:100px;padding-bottom: 75px;">
			
			<table class="table sales-table-top">
				
				<thead class="monthly-table">
					
					<tr>
						<th>Visión de Ventas Mensuales</th>
		
						<th>piq</th>
			   
						<th>bajo</th>
					
    					<th>medio</th>
							    
						<th>alto</th>
				
					</tr>
			    </thead>
				

				<tbody class="data-space">
					
					<tr>
						<td>distancia</td>
					    <td>0</td>
					    <td><?php echo $areaSalesAnalysis['areaMinRadius']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaMedianRadius']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaMaxRadius']; ?></td>
					</tr>

					<tr>
						<td>área de resid</td>
					    <td><?php echo $areaSalesAnalysis['areaLivingArea']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLivingAreaLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLivingAreaMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLivingAreaHigh']; ?></td>
					</tr>

					<tr>
						<td>precio por pie</td>
					    <td>$<?php echo $areaSalesAnalysis['areaPriceFoot']; ?></td>
					    <td>$<?php echo $areaSalesAnalysis['areaPriceFootLow']; ?></td>
					    <td>$<?php echo $areaSalesAnalysis['areaPriceFootMedian']; ?></td>
					    <td>$<?php echo $areaSalesAnalysis['areaPriceFootHigh']; ?></td>
					</tr>

					<tr>
						<td>año de construcción</td>
					    <td><?php echo $areaSalesAnalysis['areaYear']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaYearMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaYearHigh']; ?></td>
					</tr>

					<tr>
						<td>tam. de lote</td>
					    <td><?php echo $areaSalesAnalysis['areaLotSize']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLotSizeLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLotSizeMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLotSizeHigh']; ?></td>
					</tr>

					<tr>
						<td>baños</td>
					    <td><?php echo $areaSalesAnalysis['areaBedrooms']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBedroomsLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBedroomsMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBedroomsHigh']; ?></td>
					</tr>

					<tr>
						<td>plantas:</td>
					    <td><?php echo $areaSalesAnalysis['areaBaths']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBathsLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBathsMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBathsHigh']; ?></td>
					</tr>

					<tr>
						<td>pisos</td>
					    <td><?php echo $areaSalesAnalysis['stories']; ?></td>
					    <td><?php echo $areaSalesAnalysis['stories']; ?></td>
					    <td><?php echo $areaSalesAnalysis['stories']; ?></td>
					    <td><?php echo $areaSalesAnalysis['stories']; ?></td>
					</tr>
                                        <tr>
						<td>piscina</td>
					    <td><?php echo $areaSalesAnalysis['propertyPool']; ?></td>
					    <td><?php echo $areaSalesAnalysis['propertyPoolLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['propertyPoolMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['propertyPoolHign']; ?></td>
					</tr>
				</tbody>
                
                <thead class="monthly-table2">
					
					<tr>
                                            <th>precio de venta </th>
                                            <th><?php echo ($areaSalesAnalysis['propertySalePrice']  != '')?"$".$areaSalesAnalysis['propertySalePrice']:''; ?></th>
					    <th>$<?php echo trim($areaSalesAnalysis['propertySalePriceLow']); ?></th>
					    <th>$<?php echo trim($areaSalesAnalysis['propertySalePriceMedian']); ?></th>
					    <th>$<?php echo trim($areaSalesAnalysis['propertySalePriceLowHigh']); ?></th>
					</tr>
			    </thead>
				

			</table>	

	</div>

</div>

</div>
