<page class="pdf12">
    <?php
        $heading = isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value']) ? $report_content_data['title']['value'] : 'Pricing Correctly';
    ?>
    <h1 class="main_title top_title"><?php echo $heading; ?></h1>
    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="bordered_img">
    <?php
        $sub_heading = isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value']) ? $report_content_data['sub_title']['value'] : 'Selling Faster by Setting the Right Price';
    ?>
    <h4 class="mt-0 sub_title"><?php echo $sub_heading; ?></h4>
    <?php
        $content = isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value']) ? $report_content_data['content']['value'] : 'At any given time, there are plenty of buyers in the market looking for newly listed properties. As your agent, I want to make sure to help you attract as many buyers as possible. One thing that can hinder this is setting the price too high. The key to getting your home sold as quickly as possible is to price it correctly from day 1. Many sellers have the tendency to want to list their home at a higher sales price than advised because they hope to increase their profit or they assume that buyers always make low off ers so it’s good to start high';
    ?>
    <p class="text-justify"><?php echo $content; ?></p>
    <div class="mt-40 pricing-img" style="background: url(<?php echo base_url().'assets/reports/english/seller/images/12/pricing.png'; ?>) no-repeat; background-size: contain;"></div>
    
    <div class="d-flex mt-30 steps">
        <div class="col-50 responsive-100">
            <?php
                $para_1_title = isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value']) ? $report_content_data['paragraph_1_title']['value'] : '1. On Market Longer';
            ?>
            <h4><?php echo $para_1_title; ?></h4>
            <?php
                $para_1_content = isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value']) ? nl2br($report_content_data['paragraph_1_content']['value']) : 'Properties that are over priced tend to stay on the market significantly longer than those that are priced to sell.';
            ?>
            <p><?php echo $para_1_content; ?></p>
            <?php
                $para_2_title = isset($report_content_data['paragraph_2_title']['value']) && !empty($report_content_data['paragraph_2_title']['value']) ? $report_content_data['paragraph_2_title']['value'] : '2. Price Reduction';
            ?>
            <h4><?php echo $para_2_title; ?></h4>
            <?php
                $para_2_content = isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value']) ? nl2br($report_content_data['paragraph_2_content']['value']) : 'Overpriced properties will most certainly need to do at least 1 price reduction to regenerate interest in your property.';
            ?>
            <p><?php echo $para_2_content; ?></p>
        </div> 
        <div class="col-50 responsive-100">
            <?php
                $para_3_title = isset($report_content_data['paragraph_3_title']['value']) && !empty($report_content_data['paragraph_3_title']['value']) ? $report_content_data['paragraph_3_title']['value'] : '3. Lost Time';
            ?>
            <h4><?php echo $para_3_title; ?></h4>
            <?php
                $para_3_content = isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value']) ? nl2br($report_content_data['paragraph_3_content']['value']) : 'Time lost in waiting for an offer can be time spent accepting offers, conducting inspections & opening escrow.';
            ?>
            <p><?php echo $para_3_content; ?></p>
            <?php
                $para_4_title = isset($report_content_data['paragraph_4_title']['value']) && !empty($report_content_data['paragraph_4_title']['value']) ? $report_content_data['paragraph_4_title']['value'] : '4. Stigma Developed';
            ?>
            <h4><?php echo $para_4_title; ?></h4>
            <?php
                $para_4_content = isset($report_content_data['paragraph_4_content']['value']) && !empty($report_content_data['paragraph_4_content']['value']) ? nl2br($report_content_data['paragraph_4_content']['value']) : 'As buyers see the property advertised over and over again, they will start wondering if there’s something wrong with it.';
            ?>
            <p><?php echo $para_4_content; ?></p>
        </div>
    </div>
</page>