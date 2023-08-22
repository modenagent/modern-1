<page class="pdf16">
    <?php
        $heading = isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value']) ? $report_content_data['title']['value'] : 'The Sellers Road-map';
    ?>
    <h1 class="main_title top_title"><?php echo $heading; ?></h1>
    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="bordered_img">
    <!-- <div class="content_area">
        <div class="d-flex mt-60">
            <div class="col-50">
                <?php
                    $sub_heading = isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value']) ? $report_content_data['sub_title']['value'] : 'Meet With a Real\n\nEstate Professional';
                ?>
                <h4 class="crimson mt-0"><?php echo $sub_heading; ?></h4>
                <?php 
                    $content = isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value']) ? nl2br($report_content_data['content']['value']) : 'There’s no commitment required on your part for the initial meeting. It will be educational and help you identify your next steps.';
                ?>
                <p class="f14 w80"><?php echo $content; ?></p>
                <img src="<?php echo base_url().'assets/reports/english/seller/images/16/arrow.png'; ?>" alt="arrow" class="my-20">
            </div>
            <div class="col-50">
                <img src="<?php echo base_url().'assets/reports/english/seller/images/16/user.png'; ?>" alt="user" class="img-fluid icons">
            </div>
        </div>
        <div class="d-flex">
            <div class="col-50">
                <?php
                    $para_1_title = isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value']) ? $report_content_data['paragraph_1_title']['value'] : 'Establish a Price';
                ?>
                <h4 class="crimson mt-0"><?php echo $para_1_title; ?></h4>
                <?php
                    $para_1_content = isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value']) ? $report_content_data['paragraph_1_content']['value'] : 'Your agent will provide a market analysis, which will help you set an asking price.';
                ?>
                <p class="f14 w80"><?php echo $para_1_content; ?></p>
                <img src="<?php echo base_url().'assets/reports/english/seller/images/16/arrow.png'; ?>" alt="arrow" class="my-20">
            </div>
            <div class="col-50">
                <div class="msg_box">
                    <?php
                        $para_2_title = isset($report_content_data['paragraph_2_title']['value']) && !empty($report_content_data['paragraph_2_title']['value']) ? $report_content_data['paragraph_2_title']['value'] : 'Strategic Pricing';
                    ?>
                    <h4 class="crimson mt-0"><?php echo $para_2_title; ?></h4>
                    <?php
                        $para_2_content = isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value']) ? $report_content_data['paragraph_2_content']['value'] : 'As difficult as it may be, it’s important to review the market analysis and consider your home price objectively.';
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
                    $para_3_title = isset($report_content_data['paragraph_3_title']['value']) && !empty($report_content_data['paragraph_3_title']['value']) ? $report_content_data['paragraph_3_title']['value'] : 'Prepare Your Home';
                ?>
                <h4 class="crimson mt-0"><?php echo $para_3_title; ?></h4>
                <?php
                    $para_3_content = isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value']) ? $report_content_data['paragraph_3_content']['value'] : 'View your home through the eyes of the buyer and ask yourself what you’d expect. Your agent will off er some useful suggestions.';
                ?>
                <p class="f14 w80"><?php echo $para_3_content; ?></p>
                <img src="<?php echo base_url().'assets/reports/english/seller/images/16/arrow.png'; ?>" alt="arrow" class="my-20">
            </div>
            <div class="col-50">
                <img src="<?php echo base_url().'assets/reports/english/seller/images/16/msg.png'; ?>" alt="msg" border="0" class="img-fluid icons">
            </div>
        </div>
        <div class="d-flex">
            <div class="col-50">
                <?php
                    $para_4_title = isset($report_content_data['paragraph_4_title']['value']) && !empty($report_content_data['paragraph_4_title']['value']) ? $report_content_data['paragraph_4_title']['value'] : 'List It For Sale';
                ?>
                <h4 class="crimson mt-0"><?php echo $para_4_title; ?></h4>
                <?php
                    $para_4_content = isset($report_content_data['paragraph_4_content']['value']) && !empty($report_content_data['paragraph_4_content']['value']) ? $report_content_data['paragraph_4_content']['value'] : 'When everything is in place your agent will put your home on the open market. It’s critical you make it as easy as possible for potential buyers to view your home.';
                ?>
                <p class="f14 w80"><?php echo $para_4_content; ?></p>
            </div>
            <div class="col-50">
                <div class="msg_box">
                    <?php
                        $para_5_title = isset($report_content_data['paragraph_5_title']['value']) && !empty($report_content_data['paragraph_5_title']['value']) ? $report_content_data['paragraph_5_title']['value'] : 'Showings';
                    ?>
                    <h4 class="crimson mt-0"><?php echo $para_5_title; ?></h4>
                    <?php
                        $para_5_content = isset($report_content_data['paragraph_5_content']['value']) && !empty($report_content_data['paragraph_5_content']['value']) ? $report_content_data['paragraph_5_content']['value'] : 'Potential buyers may ask to see your home on short notice. It’s best if you can accommodate these requests, you never want to miss a potential sale.';
                    ?>
                    <p><?php echo $para_5_content; ?></p>
                </div>
            </div>
        </div>
    </div>    -->
    <div class="content_area">
        <div class="d-flex mt-60">
            <div class="col-50 responsive-100 res-dis-none mar-ver-15">
                <h4 class="crimson mt-0">Meet With a Real <br>Estate Professional</h4>
                <p class="f14 w80">
                    There’s no commitment required
                    on your part for the initial
                    meeting. It will be educational
                    and help you identify your next
                    steps.
                </p>
                <img src="<?php echo base_url();?>assets/reports/english/seller/images/down-arrow.png" alt="arrow" class="my-20 res-dis-none">
            </div>
            <div class="col-50 responsive-100 res-dis-none mar-ver-15">
                <img src="<?php echo base_url();?>assets/reports/english/seller/images/proffesional.png" alt="user" class="img-fluid icons">
            </div>
        </div>
        <div class="d-flex pos-rel">
            <div class="connection-line res-dis-none"></div>
            <div class="col-50 responsive-100 mar-ver-15">
                <h4 class="crimson mt-0">Establish a Price <span class="connection-circel res-dis-none"></span></h4>
                <p class="f14 w80">
                    Your agent will provide a market
                    analysis, which will help you set
                    an asking price.
                </p>
                <img src="<?php echo base_url();?>assets/reports/english/seller/images/down-arrow.png" alt="arrow" class="my-20 res-dis-none">
            </div>
            <div class="col-50 responsive-100 mar-ver-15">
                <div class="msg_box">
                    <h4 class="crimson mt-0">Strategic Pricing</h4>
                    <p>
                        As diffi cult as it may be, it’s
                        important to review the market
                        analysis and consider your home
                        price objectively.
                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-50 responsive-100 mar-ver-15">
                <h4 class="crimson mt-0">Prepare Your Home</h4>
                <p class="f14 w80">
                    View your home through the eyes of the buyer and ask yourself what you’d expect. Your agent will off er some useful
                    suggestions.
                </p>
                <img src="<?php echo base_url();?>assets/reports/english/seller/images/down-arrow.png" alt="arrow" class="my-20 res-dis-none">
            </div>
            <div class="col-50 responsive-100 mar-ver-15">
                <img src="<?php echo base_url();?>assets/reports/english/seller/images/chat.png" alt="msg" border="0" class="img-fluid icons">
            </div>
        </div>
        <div class="d-flex pos-rel">
            <div class="connection-line"></div>
            <div class="col-50 responsive-100 mar-ver-15">
                <h4 class="crimson mt-0">List It For Sale <span class="connection-circel res-dis-none"></span> </h4>
                <p class="f14 w80">
                    When everything is in place your
                    agent will put your home on the
                    open market. It’s critical you make
                    it as easy as possible for potential
                    buyers to view your home.
                </p>
            </div>
            <div class="col-50 responsive-100 mar-ver-15">
                <div class="msg_box">
                    <h4 class="crimson mt-0">Showings</h4>
                    <p>
                        Potential buyers may ask to see
                        your home on short notice. It’s best
                        if you can accommodate these
                        requests, you never want to miss a
                        potential sale.
                    </p>
                </div>
            </div>
        </div>
    </div>

</page>