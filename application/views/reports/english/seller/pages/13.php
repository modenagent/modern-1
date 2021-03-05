<page class="pdf13">
	<?php
        $heading = isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value']) ? $report_content_data['title']['value'] : 'Average Days on Market';
    ?>
    <h1 class="main_title top_title"><?php echo $heading; ?></h1>
    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="bordered_img">
    <?php
        $sub_heading = isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value']) ? $report_content_data['sub_title']['value'] : 'How Long Will It Take to Sell Your Home';
    ?>
    <h4 class="mt-0 sub_title"><?php echo $sub_heading; ?></h4>
    <div class="d-flex">
        <div class="avg_block">
	        <?php
		        $avg_text = isset($report_content_data['average_days_text']['value']) && !empty($report_content_data['average_days_text']['value']) ? $report_content_data['average_days_text']['value'] : 'Avg. Days on Market';
		    ?>
            <span><?php echo $avg_text; ?></span>
        	<?php
		        $avg_days = isset($report_content_data['average_days']['value']) && !empty($report_content_data['average_days']['value']) ? $report_content_data['average_days']['value'] : '52';
		    ?>
            <div class="number"><?php echo $avg_days; ?></div>
        </div>
        <div class="avg_text">
        	<?php
		        $content = isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value']) ? nl2br($report_content_data['content']['value']) : 'Days on market has a direct correlation with a buyers interest level in your
                property. Depending on the geographic area of your home. The number of days that your home is on the market can vary. Currently the market is in an upswing and the shortage of inventory is leading to homes flying off the market.<br><br>There are a few factors that come into play when attempting to determine how long it will take these factors are';
		    ?>
            <p class="mt-0"><?php echo $content; ?></p>
        </div>
    </div>
    <div class="d-flex mt-20 steps">
        <div class="col-50">
            <?php
                $para_1_title = isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value']) ? $report_content_data['paragraph_1_title']['value'] : 'Market';
            ?>
            <h4><?php echo $para_1_title; ?></h4>
            <?php
                $para_1_content = isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value']) ? nl2br($report_content_data['paragraph_1_content']['value']) : 'Can be a geographic location or type of housing. So if a certain eclectic neighborhood is deemed desirable, that creates demand which will lead to homes being sold quickly.';
            ?>
            <p class="mb-10"><?php echo $para_1_content; ?></p>
            <?php
                $point_1 = isset($report_content_data['point_1']['value']) && !empty($report_content_data['point_1']['value']) ? $report_content_data['point_1']['value'] : 'Days on Market';

                $point_2 = isset($report_content_data['point_2']['value']) && !empty($report_content_data['point_2']['value']) ? $report_content_data['point_2']['value'] : 'Buyer Interest';
            ?>
            <ul>
                <li><?php echo $point_1; ?></li>
                <li><?php echo $point_2; ?></li>
            </ul>
        </div> 
        <div class="col-50">
        	<?php
                $para_2_title = isset($report_content_data['paragraph_2_title']['value']) && !empty($report_content_data['paragraph_2_title']['value']) ? $report_content_data['paragraph_2_title']['value'] : 'Season';
            ?>
            <h4><?php echo $para_2_title; ?></h4>
            <?php
                $para_2_content = isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value']) ? $report_content_data['paragraph_2_content']['value'] : 'When someone is looking to pack up and move they typically would do so in good weather. So if your home is listed during the winter or the rainy season this may add to days on market.';
            ?>
            <p><?php echo $para_2_content; ?></p>
            <?php
                $para_3_title = isset($report_content_data['paragraph_3_title']['value']) && !empty($report_content_data['paragraph_3_title']['value']) ? $report_content_data['paragraph_3_title']['value'] : 'Economy';
            ?>
            <h4><?php echo $para_3_title; ?></h4>
            <?php
                $para_3_content = isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value']) ? $report_content_data['paragraph_3_content']['value'] : 'When interest rates are low the typical median home price tends to rise. During this time motivated buyers take less time to commit to a home which leads to less time on market and quicker sales.';
            ?>
            <p><?php echo $para_3_content; ?></p>
        </div>
    </div>
    <img src="<?php echo base_url().'assets/reports/english/seller/images/13/gray-chart.png'; ?>" alt="gray-chart"  class="img-fluid d-block mt-m-80 grey-chart ">
</page>