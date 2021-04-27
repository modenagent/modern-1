<page>
    <h1 class="small_big"><span>Neighborhood</span> Stats</h1>
    <div class="d-flex mt-50 gutter-30">    
        <div class="col-50">
            <h4 class="table_title no_line">Female</h4>
            <div class="percentage">
                <?php echo $female_ratio ?>%
            </div>
            <h4 class="table_title no_line">Male</h4>
            <div class="percentage">
                <?php echo $male_ratio ?>%
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
            <img src="https://i.ibb.co/yh5QBqq/shutterstock-1395528875.jpg" alt="img4" class="img-fluid w100">
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
                <img src="https://i.ibb.co/SJK8mk1/img7.png" alt="img7">
                Avg. Sale Price<br>$<?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianValue; ?>
            </li>
            <li>
                <img src="https://i.ibb.co/q9Rv9vC/img8.png" alt="img8">
                Avg. Soft<br><?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianLivingArea; ?>
            </li>
            <li>
                <img src="https://i.ibb.co/7nhwx09/img9.png" alt="img9">
                Avg. Beds<br><?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianNumBeds; ?> Beds
            </li>
            <li>
                <img src="https://i.ibb.co/fCmbkvZ/img10.png" alt="img10">
                Avg. Baths<br><?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianNumBaths; ?> Baths
            </li>
        </ul>
    </div>
</page>