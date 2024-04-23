<div class="container">
	<div class="section page5">

		<header>
			<h2 class="underline title-bold">Area Sales Analysis</h2>
			<p>Sales in the past 12 months</p>
		</header>

        <div style="padding-top:50px;">

            <div class="row">

                <div class="col-sm-12">

				<?php
$series = $areaSalesAnalysis['chart']['series'];
$date = $areaSalesAnalysis['chart']['date'];
$color = $areaSalesAnalysis['chart']['color'];
$chartImageUrl = "https://quickchart.io/chart?cht=bvs&chd=t:$series&chs=620x350&chl=$date&chbh=40,30,45&chco=$color&chds=a&chxt=y";

/** Check chart image exist or not */
$headers = get_headers($chartImageUrl);
$httpStatus = intval(substr($headers[0], 9, 3));

// Check if the HTTP status code indicates success (200 OK)
if ($httpStatus === 200) {?>
    <img src="<?=$chartImageUrl?>"  alt="graph" style="margin:auto; width:100%; height:5.15in;">
<?php }?>
						<!-- Google chart image api deprecated so we have implemented quickchart.io as an alternative  -->
						<!-- <img src="https://chart.googleapis.com/chart?cht=bvs&chd=t:<?php echo $areaSalesAnalysis['chart']['series']; ?>&chs=620x350&chl=<?php echo $areaSalesAnalysis['chart']['date']; ?>&chbh=40,30,45&chco=<?php echo $areaSalesAnalysis['chart']['color']; ?>&chds=a&chxt=y" alt="" style="margin:auto; width:100%; height:5.15in;" /> -->
					</div>
            </div>

        </div>

		<div class="table-wrapper"  style="margin-top:100px;padding-bottom: 75px;">

			<table class="table sales-table-top">

				<thead class="monthly-table">

					<tr>
						<th>monthly sales overview </th>

						<th>piq</th>

						<th>low</th>

    					<th>median</th>

						<th>high</th>

					</tr>
			    </thead>


				<tbody class="data-space">

					<tr>
						<td>distance</td>
					    <td>0</td>
					    <td><?php echo $areaSalesAnalysis['areaMinRadius']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaMedianRadius']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaMaxRadius']; ?></td>
					</tr>

					<tr>
						<td>living area</td>
					    <td><?php echo $areaSalesAnalysis['areaLivingArea']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLivingAreaLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLivingAreaMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLivingAreaHigh']; ?></td>
					</tr>

					<tr>
						<td>price per soft</td>
					    <td>$<?php echo $areaSalesAnalysis['areaPriceFoot']; ?></td>
					    <td>$<?php echo $areaSalesAnalysis['areaPriceFootLow']; ?></td>
					    <td>$<?php echo $areaSalesAnalysis['areaPriceFootMedian']; ?></td>
					    <td>$<?php echo $areaSalesAnalysis['areaPriceFootHigh']; ?></td>
					</tr>

					<tr>
						<td>year bulit</td>
					    <td><?php echo $areaSalesAnalysis['areaYear']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaYearMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaYearHigh']; ?></td>
					</tr>

					<tr>
						<td>lot size</td>
					    <td><?php echo $areaSalesAnalysis['areaLotSize']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLotSizeLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLotSizeMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaLotSizeHigh']; ?></td>
					</tr>

					<tr>
						<td>bedrooms</td>
					    <td><?php echo $areaSalesAnalysis['areaBedrooms']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBedroomsLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBedroomsMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBedroomsHigh']; ?></td>
					</tr>

					<tr>
						<td>baths</td>
					    <td><?php echo $areaSalesAnalysis['areaBaths']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBathsLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBathsMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['areaBathsHigh']; ?></td>
					</tr>

					<tr>
						<td>stories</td>
					    <td><?php echo $areaSalesAnalysis['stories']; ?></td>
					    <td><?php echo $areaSalesAnalysis['stories']; ?></td>
					    <td><?php echo $areaSalesAnalysis['stories']; ?></td>
					    <td><?php echo $areaSalesAnalysis['stories']; ?></td>
					</tr>
                                        <tr>
						<td>pool</td>
					    <td><?php echo $areaSalesAnalysis['propertyPool']; ?></td>
					    <td><?php echo $areaSalesAnalysis['propertyPoolLow']; ?></td>
					    <td><?php echo $areaSalesAnalysis['propertyPoolMedian']; ?></td>
					    <td><?php echo $areaSalesAnalysis['propertyPoolHign']; ?></td>
					</tr>
				</tbody>

                <thead class="monthly-table2">

					<tr>
                                            <th>Sales price </th>
                                            <th><?php echo ($areaSalesAnalysis['propertySalePrice'] != '') ? "$" . $areaSalesAnalysis['propertySalePrice'] : ''; ?></th>
					    <th>$<?php echo trim($areaSalesAnalysis['propertySalePriceLow']); ?></th>
					    <th>$<?php echo trim($areaSalesAnalysis['propertySalePriceMedian']); ?></th>
					    <th>$<?php echo trim($areaSalesAnalysis['propertySalePriceLowHigh']); ?></th>
					</tr>
			    </thead>


			</table>

		<!-- </div> --> <!-- .table-wrapper -->

	</div>

</div>
</div>
