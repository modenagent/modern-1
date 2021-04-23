<page class="pdf17">
    <div class="content_area">
        <div class="d-flex mt-60">
            <div class="col-50">
                <?php
                    $para_1_title = isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value']) ? $report_content_data['paragraph_1_title']['value'] : 'Establish a Price';
                ?>
                <h4 class="crimson mt-0"><?php echo $para_1_title; ?></h4>
                <?php
                    $para_1_content = isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value']) ? $report_content_data['paragraph_1_content']['value'] : 'If everything goes well, a buyer and (most often the agent who represents them) will present your agent with an offer.';
                ?>
                <p class="f14 w80">
                    <?php echo $para_1_content; ?>
                </p>
                <img src="<?php echo base_url().'assets/reports/english/seller/images/16/arrow.png'; ?>" alt="arrow" class="my-20">
            </div>
            <div class="col-50">
                <div class="msg_box">
                    <?php
                        $para_2_title = isset($report_content_data['paragraph_2_title']['value']) && !empty($report_content_data['paragraph_2_title']['value']) ? $report_content_data['paragraph_2_title']['value'] : 'Strategic Pricing';
                    ?>
                    
                    <h4 class="crimson mt-0"><?php echo $para_2_title; ?></h4>
                    <?php
                        $para_2_content = isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value']) ? $report_content_data['paragraph_2_content']['value'] : 'Your agent will present the benefi ts and risks of each offer. You will have the opportunity to either accept or counter any offer based on it’s merits.';
                    ?>
                    <p>
                        <?php echo $para_2_content; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-50">
                <?php
                    $para_3_title = isset($report_content_data['paragraph_3_title']['value']) && !empty($report_content_data['paragraph_3_title']['value']) ? $report_content_data['paragraph_3_title']['value'] : 'Under Contract';
                ?>
                <h4 class="crimson mt-0"><?php echo $para_3_title; ?></h4>
                <?php
                    $para_3_content = isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value']) ? $report_content_data['paragraph_3_content']['value'] : 'At this point you and the buyer have agreed to all of the terms of the offer and both parties have signed the agreements.';
                ?>
                <p class="f14 w80"><?php echo $para_3_content; ?></p>
                <img src="<?php echo base_url().'assets/reports/english/seller/images/16/arrow.png'; ?>" alt="arrow" class="my-20">
            </div>
            <div class="col-50">
                <img src="<?php echo base_url().'assets/reports/english/seller/images/17/contact.png'; ?>" alt="" class="img-fluid icons">
            </div>
        </div>
        <div class="d-flex">
            <div class="col-50">
                <?php
                    $para_4_title = isset($report_content_data['paragraph_4_title']['value']) && !empty($report_content_data['paragraph_4_title']['value']) ? $report_content_data['paragraph_4_title']['value'] : 'Final Details';
                ?>
                <h4 class="crimson mt-0"><?php echo $para_4_title; ?></h4>
                <?php
                    $para_4_content = isset($report_content_data['paragraph_4_content']['value']) && !empty($report_content_data['paragraph_4_content']['value']) ? $report_content_data['paragraph_4_content']['value'] : 'While under contract, the buyer will work with their mortgage provider to fi nalize the loan and perform other due diligence.';
                ?>
                <p class="f14 w80"><?php echo $para_4_content; ?></p>
                <img src="<?php echo base_url().'assets/reports/english/seller/images/16/arrow.png'; ?>" alt="arrow" class="my-20">
            </div>
            <div class="col-50">
                <div class="msg_box">
                    <?php
                        $para_5_title = isset($report_content_data['paragraph_5_title']['value']) && !empty($report_content_data['paragraph_5_title']['value']) ? $report_content_data['paragraph_5_title']['value'] : 'Inspection';
                    ?>
                    <h4 class="crimson mt-0"><?php echo $para_5_title; ?></h4>
                    <?php
                        $para_5_content = isset($report_content_data['paragraph_5_content']['value']) && !empty($report_content_data['paragraph_5_content']['value']) ? $report_content_data['paragraph_5_content']['value'] : 'The buyer will usually perform a physical inspection of the home. They may even ask you to make certain repairs. Your agent will explain all of your options regarding the inspection.';
                    ?>
                    <p><?php echo $para_5_content; ?></p>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-50">
                <?php
                    $para_6_title = isset($report_content_data['paragraph_6_title']['value']) && !empty($report_content_data['paragraph_6_title']['value']) ? $report_content_data['paragraph_6_title']['value'] : 'Closing';
                ?>
                <h4 class="crimson mt-0"><?php echo $para_6_title; ?></h4>
                <?php
                    $para_6_content = isset($report_content_data['paragraph_6_content']['value']) && !empty($report_content_data['paragraph_6_content']['value']) ? $report_content_data['paragraph_6_content']['value'] : 'This is the transfer of funds and ownership. Depending on when the buyer moves into the home, you will need to be all packed up and ready to move.';
                ?>
                <p class="f14 w80"><?php echo $para_6_content; ?></p>
            </div>
            <div class="col-50">
                <img src="<?php echo base_url().'assets/reports/english/seller/images/17/secure.png'; ?>" alt="secure" class="img-fluid icons">
            </div>
        </div>
        <?php
            $heading = isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value']) ? $report_content_data['title']['value'] : 'The Sellers Road-map';
        ?>
        <div class="table_title mt-30"><?php echo $heading; ?></div>
        <?php
            $sub_heading = isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value']) ? $report_content_data['sub_title']['value'] : 'Meet With a Real\n\nEstate Professional';
        ?>
        <div class="success_text"><?php echo $sub_heading; ?></div>
    </div>
</page>