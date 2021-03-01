<div class="container">
    <page class="pdf8">
        <h1 class="main_title top_title">Area Sales Analysis</h1>
        <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png' ?>" alt="line" class="bordered_img">
        <div class="d-flex">
            <div class="col-12">
                <h4 class="mt-0 sub_title">Sales in the Past 12 Months</h4>
            </div>
        </div>
        <div class="d-flex mt-20">    
            <div class="col-12">
                <img src="https://chart.googleapis.com/chart?cht=bvs&chd=t:<?php echo $areaSalesAnalysis['chart']['series']; ?>&chs=700x400&chl=<?php echo $areaSalesAnalysis['chart']['date']; ?>&chbh=40,30,45&chco=<?php echo $areaSalesAnalysis['chart']['color']; ?>&chds=a&chxt=y" alt="Area Sales Analysis" class="img-fluid mx-auto w90">
                <table class="mt-60">
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
                            <td>$0</td>
                            <td>$0</td>
                            <td>$0</td>
                            <td>$0</td>
                        </tr>
                        <tr>
                            <td>Year Built</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Lot Size</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Bedrooms</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Baths</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Stories</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Pools</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Sales Price</td>
                            <td>$0</td>
                            <td>$000,000</td>
                            <td>$000,000</td>
                            <td>$000,000</td>
                        </tr>
                    </tfoot>
                </table> 
            </div>
        </div>
    </page>
</div>