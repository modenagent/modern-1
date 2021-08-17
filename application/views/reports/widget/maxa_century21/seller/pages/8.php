    <page class="pdf7"> 
        <div class="gray_title">
            <h2 class="small_big">AREA SALES ANALYSIS <span>SALES IN THE PAST 12 MONTHS</span></h2>
        </div>

        <div class="d-flex">    
            <div class="col-12">
                <img src="https://chart.googleapis.com/chart?cht=bvs&chd=t:<?php echo $areaSalesAnalysis['chart']['series']; ?>&chs=700x400&chl=<?php echo $areaSalesAnalysis['chart']['date']; ?>&chbh=40,30,45&chco=beaf86&chds=a&chxt=y" alt="graph" class="img-fluid mx-auto">
                <table class="mt-60 bar_chart_data">
                    <thead>
                        <tr>
                            <th>Monthly Sales Overview</th>
                            <th>PIQ</th>
                            <th>Low</th>
                            <th>Median</th>
                            <th>High</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Distance</td>
                            <td>0</td>
                            <td><?php echo isset($areaSalesAnalysis['areaMinRadius']) && !empty($areaSalesAnalysis['areaMinRadius']) ? $areaSalesAnalysis['areaMinRadius'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaMedianRadius']) && !empty($areaSalesAnalysis['areaMedianRadius']) ? $areaSalesAnalysis['areaMedianRadius'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaMaxRadius']) && !empty($areaSalesAnalysis['areaMaxRadius']) ? $areaSalesAnalysis['areaMaxRadius'] : 0; ?></td>
                        </tr>
                        <tr>
                            <td>Living Area</td>
                            <td><?php echo isset($areaSalesAnalysis['areaLivingArea']) && !empty($areaSalesAnalysis['areaLivingArea']) ? $areaSalesAnalysis['areaLivingArea'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaLivingAreaLow']) && !empty($areaSalesAnalysis['areaLivingAreaLow']) ? $areaSalesAnalysis['areaLivingAreaLow'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaLivingAreaMedian']) && !empty($areaSalesAnalysis['areaLivingAreaMedian']) ? $areaSalesAnalysis['areaLivingAreaMedian'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaLivingAreaHigh']) && !empty($areaSalesAnalysis['areaLivingAreaHigh']) ? $areaSalesAnalysis['areaLivingAreaHigh'] : 0; ?></td>
                        </tr>
                        <tr>
                            <td>Price Per Soft</td>
                            <td><?php echo isset($areaSalesAnalysis['areaPriceFoot']) && !empty($areaSalesAnalysis['areaPriceFoot']) ? '$'.$areaSalesAnalysis['areaPriceFoot'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaPriceFootLow']) && !empty($areaSalesAnalysis['areaPriceFootLow']) ? '$'.$areaSalesAnalysis['areaPriceFootLow'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaPriceFootMedian']) && !empty($areaSalesAnalysis['areaPriceFootMedian']) ? '$'.$areaSalesAnalysis['areaPriceFootMedian'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaPriceFootHigh']) && !empty($areaSalesAnalysis['areaPriceFootHigh']) ? '$'.$areaSalesAnalysis['areaPriceFootHigh'] : 0; ?></td>
                        </tr>
                        <tr>
                            <td>Year Built</td>
                            <td><?php echo isset($areaSalesAnalysis['areaYear']) && !empty($areaSalesAnalysis['areaYear']) ? $areaSalesAnalysis['areaYear'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaYearLow']) && !empty($areaSalesAnalysis['areaYearLow']) ? $areaSalesAnalysis['areaYearLow'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaYearMedian']) && !empty($areaSalesAnalysis['areaYearMedian']) ? $areaSalesAnalysis['areaYearMedian'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaYearHigh']) && !empty($areaSalesAnalysis['areaYearHigh']) ? $areaSalesAnalysis['areaYearHigh'] : 0; ?></td>
                        </tr>
                        <tr>
                            <td>Lot Size</td>
                            <td><?php echo isset($areaSalesAnalysis['areaLotSize']) && !empty($areaSalesAnalysis['areaLotSize']) ? $areaSalesAnalysis['areaLotSize'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaLotSizeLow']) && !empty($areaSalesAnalysis['areaLotSizeLow']) ? $areaSalesAnalysis['areaLotSizeLow'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaLotSizeMedian']) && !empty($areaSalesAnalysis['areaLotSizeMedian']) ? $areaSalesAnalysis['areaLotSizeMedian'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaLotSizeHigh']) && !empty($areaSalesAnalysis['areaLotSizeHigh']) ? $areaSalesAnalysis['areaLotSizeHigh'] : 0; ?></td>
                        </tr>
                        <tr>
                            <td>Bedrooms</td>
                            <td><?php echo isset($areaSalesAnalysis['areaBedrooms']) && !empty($areaSalesAnalysis['areaBedrooms']) ? $areaSalesAnalysis['areaBedrooms'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaBedroomsLow']) && !empty($areaSalesAnalysis['areaBedroomsLow']) ? $areaSalesAnalysis['areaBedroomsLow'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaBedroomsMedian']) && !empty($areaSalesAnalysis['areaBedroomsMedian']) ? $areaSalesAnalysis['areaBedroomsMedian'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaBedroomsHigh']) && !empty($areaSalesAnalysis['areaBedroomsHigh']) ? $areaSalesAnalysis['areaBedroomsHigh'] : 0; ?></td>
                        </tr>
                        <tr>
                            <td>Baths</td>
                            <td><?php echo isset($areaSalesAnalysis['areaBaths']) && !empty($areaSalesAnalysis['areaBaths']) ? $areaSalesAnalysis['areaBaths'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaBathsLow']) && !empty($areaSalesAnalysis['areaBathsLow']) ? $areaSalesAnalysis['areaBathsLow'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaBathsMedian']) && !empty($areaSalesAnalysis['areaBathsMedian']) ? $areaSalesAnalysis['areaBathsMedian'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['areaBathsHigh']) && !empty($areaSalesAnalysis['areaBathsHigh']) ? $areaSalesAnalysis['areaBathsHigh'] : 0; ?></td>
                        </tr>
                        <tr>
                            <td>Stories</td>
                            <td><?php echo isset($areaSalesAnalysis['stories']) && !empty($areaSalesAnalysis['stories']) ? $areaSalesAnalysis['stories'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['stories']) && !empty($areaSalesAnalysis['stories']) ? $areaSalesAnalysis['stories'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['stories']) && !empty($areaSalesAnalysis['stories']) ? $areaSalesAnalysis['stories'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['stories']) && !empty($areaSalesAnalysis['stories']) ? $areaSalesAnalysis['stories'] : 0; ?></td>
                        </tr>
                        <tr>
                            <td>Pools</td>
                            <td><?php echo isset($areaSalesAnalysis['propertyPool']) && !empty($areaSalesAnalysis['propertyPool']) ? $areaSalesAnalysis['propertyPool'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['propertyPoolLow']) && !empty($areaSalesAnalysis['propertyPoolLow']) ? $areaSalesAnalysis['propertyPoolLow'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['propertyPoolMedian']) && !empty($areaSalesAnalysis['propertyPoolMedian']) ? $areaSalesAnalysis['propertyPoolMedian'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['propertyPoolHign']) && !empty($areaSalesAnalysis['propertyPoolHign']) ? $areaSalesAnalysis['propertyPoolHign'] : 0; ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Sales Price</td>
                            <td><?php echo isset($areaSalesAnalysis['propertySalePrice']) && !empty($areaSalesAnalysis['propertySalePrice']) ? '$'.$areaSalesAnalysis['propertySalePrice'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['propertySalePriceLow']) && !empty($areaSalesAnalysis['propertySalePriceLow']) ? '$'.$areaSalesAnalysis['propertySalePriceLow'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['propertySalePriceMedian']) && !empty($areaSalesAnalysis['propertySalePriceMedian']) ? '$'.$areaSalesAnalysis['propertySalePriceMedian'] : 0; ?></td>
                            <td><?php echo isset($areaSalesAnalysis['propertySalePriceLowHigh']) && !empty($areaSalesAnalysis['propertySalePriceLowHigh']) ? '$'.$areaSalesAnalysis['propertySalePriceLowHigh'] : 0; ?></td>
                        </tr>
                    </tfoot>
                </table> 
            </div>
        </div>
    </page>