<page class="pdf19">
    <?php
        $heading = isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value']) ? $report_content_data['title']['value'] : 'A Promise to My Clients';
    ?>
    <h1 class="main_title top_title"><?php echo $heading; ?></h1>
    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="bordered_img">
    <div class="d-flex">
        <div class="col-12">
            <?php
                $sub_heading = isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value']) ? $report_content_data['sub_title']['value'] : 'My Duties to You';
            ?>
            <h4 class="mt-0 sub_title"><?php echo $sub_heading; ?></h4>
            <?php 
                $content = isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value']) ? nl2br($report_content_data['content']['value']) : 'As your real estate agent, in addition to any duties or commitments set forth in our listing agreement, my fiduciary duties to you include but are not limited to:';
            ?>
            <p class="f14">
                <?php echo $content; ?>
            </p>
        </div>
    </div>
    <div class="d-flex">    
        <div class="col-12">
            <?php
                $point_1_title = isset($report_content_data['point_1_title']['value']) && !empty($report_content_data['point_1_title']['value']) ? nl2br($report_content_data['point_1_title']['value']) : 'Loyalty';
            ?>
            <h4 class="crimson"><?php echo $point_1_title; ?></h4>
            <?php
                $point_1_content = isset($report_content_data['point_1_content']['value']) && !empty($report_content_data['point_1_content']['value']) ? nl2br($report_content_data['point_1_content']['value']) : 'Loyalty is my fi rst and foremost duty to you. This means that I must act with your best interest in mind, to the exclusion of all other interests including my own';
            ?>
            <p class="f14"><?php echo $point_1_content; ?></p>
            <?php
                $point_2_title = isset($report_content_data['point_2_title']['value']) && !empty($report_content_data['point_2_title']['value']) ? nl2br($report_content_data['point_2_title']['value']) : 'Confidentiality';
            ?>
            <h4 class="crimson"><?php echo $point_2_title; ?></h4>
            <?php
                $point_2_content = isset($report_content_data['point_2_content']['value']) && !empty($report_content_data['point_2_content']['value']) ? nl2br($report_content_data['point_2_content']['value']) : 'As your agent, I am obligated to safeguard your confidence and secrets. I therefore, must keep confi dential any information that might weaken your bargaining position if it were revealed.';
            ?>
            <p class="f14"><?php echo $point_2_content; ?></p>
            <?php
                $point_3_title = isset($report_content_data['point_3_title']['value']) && !empty($report_content_data['point_3_title']['value']) ? nl2br($report_content_data['point_3_title']['value']) : 'Disclosure';
            ?>
            <h4 class="crimson"><?php echo $point_3_title; ?></h4>

            <?php
                $point_3_content = isset($report_content_data['point_3_content']['value']) && !empty($report_content_data['point_3_content']['value']) ? nl2br($report_content_data['point_3_content']['value']) : 'As your agent, I am responsible to disclose to you, all relevant and material information that I know might affect your ability to obtain the highest price and best terms in the sale of your property';
            ?>
            <p class="f14"><?php echo $point_3_content; ?></p>

            <?php
                $point_4_title = isset($report_content_data['point_4_title']['value']) && !empty($report_content_data['point_4_title']['value']) ? nl2br($report_content_data['point_4_title']['value']) : 'Obedience';
            ?>
            <h4 class="crimson"><?php echo $point_4_title; ?></h4>
            <?php
                $point_4_content = isset($report_content_data['point_4_content']['value']) && !empty($report_content_data['point_4_content']['value']) ? nl2br($report_content_data['point_4_content']['value']) : 'As your agent, I am bound to obey promptly and efficiently all lawful instructions that you give me pertaining to the sale of your property.';
            ?>
            <p class="f14"><?php echo $point_4_content; ?></p>
            <?php
                $point_5_title = isset($report_content_data['point_5_title']['value']) && !empty($report_content_data['point_5_title']['value']) ? nl2br($report_content_data['point_5_title']['value']) : 'Reasonable Car & Diligence';
            ?>
            <h4 class="crimson"><?php echo $point_5_title; ?></h4>

            <?php
                $point_5_content = isset($report_content_data['point_5_content']['value']) && !empty($report_content_data['point_5_content']['value']) ? nl2br($report_content_data['point_5_content']['value']) : 'To assist you in your real estate transaction, the standard of care expected of me, by you, should be that of a competent real estate professional.';
            ?>
            <p class="f14"><?php echo $point_5_content; ?></p>
            <?php
                $point_6_title = isset($report_content_data['point_6_title']['value']) && !empty($report_content_data['point_6_title']['value']) ? nl2br($report_content_data['point_6_title']['value']) : 'Accounting';
            ?>
            <h4 class="crimson"><?php echo $point_6_title; ?></h4>
            <?php
                $point_6_content = isset($report_content_data['point_6_content']['value']) && !empty($report_content_data['point_6_content']['value']) ? nl2br($report_content_data['point_6_content']['value']) : 'As your realtor, I am bound to safeguard any money, deeds, or other documents you entrust to me, related to your real estate transaction.';
            ?>
            <p class="f14"><?php echo $point_6_content; ?></p>
        </div>
    </div>
</page>