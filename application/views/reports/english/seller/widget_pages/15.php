<page class="pdf15">
    <?php
        $heading = isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value']) ? $report_content_data['title']['value'] : 'Social Proof';
    ?>
    <h1 class="main_title top_title"><?php echo $heading; ?></h1>
    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="bordered_img">
    <?php
        $sub_heading = isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value']) ? $report_content_data['sub_title']['value'] : 'We Have the Technology and the Numbers';
    ?>
    <div class="d-flex">
        <div class="col-12">
            <h4 class="mt-0 sub_title"><?php echo $sub_heading; ?></h4>
            <?php 
                $content = isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value']) ? nl2br($report_content_data['content']['value']) : 'We are able to connect instantly with a worldwide audience, with no worry of timezone or language barriers. It is estimated that there are around 3.48 billion people using social networks across the world in 2021.<br><br>We digitally market international, using social media to reach a list of countries that grows every day.';
            ?>
            <p class="f14"><?php echo $content; ?></p>
        </div>
    </div>
    <div class="d-flex mt-50">    
        <div class="col-50">
            <img src="https://i.ibb.co/TPg7kms/facebook.png" alt="facebook" class="fb_icon">
            <?php
                $para_1_title = isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value']) ? $report_content_data['paragraph_1_title']['value'] : '@hometownerealestate';
            ?>
            <h4 class="crimson"><?php echo $para_1_title; ?></h4>
            <ul class="f14">
                <?php
                    $para_1_point_1_title = isset($report_content_data['paragraph_1_point_1']['value']) && !empty($report_content_data['paragraph_1_point_1']['value']) ? nl2br($report_content_data['paragraph_1_point_1']['value']) : '7,000+ Fans';
                ?>
                <li><?php echo $para_1_point_1_title; ?></li>
                <?php
                    $para_1_point_2_title = isset($report_content_data['paragraph_1_point_2']['value']) && !empty($report_content_data['paragraph_1_point_2']['value']) ? nl2br($report_content_data['paragraph_1_point_2']['value']) : '568,000 Link Clicks a Month';
                ?>
                <li><?php echo $para_1_point_2_title; ?></li>
                <?php
                    $para_1_point_3_title = isset($report_content_data['paragraph_1_point_3']['value']) && !empty($report_content_data['paragraph_1_point_3']['value']) ? nl2br($report_content_data['paragraph_1_point_3']['value']) : '212,000 Impressions Per Month';
                ?>
                <li><?php echo $para_1_point_3_title; ?></li>
                <?php
                    $para_1_point_4_title = isset($report_content_data['paragraph_1_point_4']['value']) && !empty($report_content_data['paragraph_1_point_4']['value']) ? nl2br($report_content_data['paragraph_1_point_4']['value']) : '323 Engaged Users Daily';
                ?>
                <li><?php echo $para_1_point_4_title; ?></li>

                <?php
                    $para_1_point_5_title = isset($report_content_data['paragraph_1_point_5']['value']) && !empty($report_content_data['paragraph_1_point_5']['value']) ? nl2br($report_content_data['paragraph_1_point_5']['value']) : '24 Post Interactions Per Day';
                ?>
                <li><?php echo $para_1_point_5_title; ?></li>
            </ul>
            <img src="<?php echo base_url().'assets/reports/english/seller/images/15/ig.png'; ?>" alt="ig" class="insta_icon">
            <?php
                $para_2_title = isset($report_content_data['paragraph_2_title']['value']) && !empty($report_content_data['paragraph_2_title']['value']) ? $report_content_data['paragraph_2_title']['value'] : '@hometownerealestate';
            ?>
            <h4 class="crimson"><?php echo $para_2_title; ?></h4>
            <ul class="f14">
                <?php
                    $para_2_point_1_title = isset($report_content_data['paragraph_2_point_1']['value']) && !empty($report_content_data['paragraph_2_point_1']['value']) ? nl2br($report_content_data['paragraph_2_point_1']['value']) : '8,000+ Followers';
                ?>
                <li><?php echo $para_2_point_1_title; ?></li>
                <?php
                    $para_2_point_2_title = isset($report_content_data['paragraph_2_point_2']['value']) && !empty($report_content_data['paragraph_2_point_2']['value']) ? nl2br($report_content_data['paragraph_2_point_2']['value']) : '2,400 Impressions Per Month';
                ?>
                <li><?php echo $para_2_point_2_title; ?></li>
                <?php
                    $para_2_point_3_title = isset($report_content_data['paragraph_2_point_3']['value']) && !empty($report_content_data['paragraph_2_point_3']['value']) ? nl2br($report_content_data['paragraph_2_point_3']['value']) : '31% Engagement Rate';
                ?>
                <li><?php echo $para_2_point_3_title; ?></li>
                <?php
                    $para_2_point_4_title = isset($report_content_data['paragraph_2_point_4']['value']) && !empty($report_content_data['paragraph_2_point_4']['value']) ? nl2br($report_content_data['paragraph_2_point_4']['value']) : '13 Post Interactions Per Day';
                ?>
                <li><?php echo $para_2_point_4_title; ?></li>

                <?php
                    $para_2_point_5_title = isset($report_content_data['paragraph_2_point_5']['value']) && !empty($report_content_data['paragraph_2_point_5']['value']) ? nl2br($report_content_data['paragraph_2_point_5']['value']) : 'Global Reach';
                ?>
                <li><?php echo $para_2_point_5_title; ?></li>
            </ul>
            <?php
                $para_3_title = isset($report_content_data['paragraph_3_title']['value']) && !empty($report_content_data['paragraph_3_title']['value']) ? $report_content_data['paragraph_3_title']['value'] : 'Online';
            ?>
            <h4 class="crimson"><?php echo $para_3_title; ?></h4>
            <ul class="f14">
                <?php
                    $para_3_point_1_title = isset($report_content_data['paragraph_3_point_1']['value']) && !empty($report_content_data['paragraph_3_point_1']['value']) ? nl2br($report_content_data['paragraph_3_point_1']['value']) : '30,000 Searching Buyers';
                ?>
                <li><?php echo $para_3_point_1_title; ?></li>
                <?php
                    $para_3_point_2_title = isset($report_content_data['paragraph_3_point_2']['value']) && !empty($report_content_data['paragraph_3_point_2']['value']) ? nl2br($report_content_data['paragraph_3_point_2']['value']) : '7,193 Unique Quarterly Website Visitors';
                ?>
                <li><?php echo $para_3_point_2_title; ?></li>

                <?php
                    $para_3_point_3_title = isset($report_content_data['paragraph_3_point_3']['value']) && !empty($report_content_data['paragraph_3_point_3']['value']) ? nl2br($report_content_data['paragraph_3_point_3']['value']) : '3,400 Page Views a Month';
                ?>
                <li><?php echo $para_3_point_3_title; ?></li>
            </ul> 
        </div>
        <div class="col-50">
            <div class="we_reach">
                <img src="<?php echo base_url().'assets/reports/english/seller/images/4/joel-vodell-8-Ogfqvw15-Rg-unsplash.jpg'; ?>" alt="joel-vodell-8-Ogfqvw15-Rg-unsplash" class="w100">
                <div class="caption">
                    <img src="<?php echo base_url().'assets/reports/english/seller/images/15/wifi.png'; ?>" alt="wifi" class="wifi">
                    <h5>We Reach Over</h5>
                    <h3>1,994,500,000</h3>
                    <h5>People Internationally</h5>
                </div>
            </div>
        </div>
    </div>
</page>