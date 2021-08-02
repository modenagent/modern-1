<page>
    <h1 class="small_big"><span>Neighborhood</span> Stats</h1>
    <div class="d-flex mt-50 gutter-30">    
        <div class="col-50">
            <h4 class="table_title no_line">Female</h4>
            <div class="percentage">
                <?php echo $female_ratio ?>
            </div>
            <h4 class="table_title no_line">Male</h4>
            <div class="percentage">
                <?php echo $male_ratio ?>
            </div>
            <h4 class="table_title no_line">Male To Female Ratio</h4>
            <p class="mt-0 f14 text-justify">
                These figures represent the male to female
                ratio in your neighborhood. The housing census
                is taken every 10 years so depending on the
                time of this report these figures can be slightly
                different.
            </p>
        </div>
        <div class="col-50">
            <img src="<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/images/shutterstock-1395528875.jpg"); ?>" alt="img4" class="img-fluid w100">
            <h4 class="table_title mt-50 no_line">Avg. Household Income</h4>
            <p class="mt-0 f14 text-justify">
                The figure to the right represents the average
                household income within your perspective
                neighborhood. This information is gathered
                from the household census that is taken every
                10 years.
            </p>
        </div>
    </div>
    <div class="neighborhood_stats">
        <ul class="stats">
            <li>
                <img src="<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/images/img7.png"); ?>" alt="Avg. Sale Price">
                Avg. Sale Price<br>$<?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianValue; ?>
            </li>
            <li>
                <img src="<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/images/img8.png"); ?>" alt="Avg. Soft">
                Avg. Soft<br><?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianLivingArea; ?>
            </li>
            <li>
                <img src="<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/images/img9.png"); ?>" alt="Avg. Beds">
                Avg. Beds<br><?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianNumBeds; ?> Beds
            </li>
            <li>
                <img src="<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/images/img10.png"); ?>" alt="Avg. Baths">
                Avg. Baths<br><?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianNumBaths; ?> Baths
            </li>
        </ul>
    </div>
</page>