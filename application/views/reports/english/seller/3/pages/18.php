<page class="pdf18">
    <?php
        $heading = isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value']) ? $report_content_data['title']['value'] : 'Analyze & Optimize';
    ?>
    <h1 class="main_title top_title"><?php echo $heading; ?></h1>
    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="bordered_img">
    <div class="d-flex">
        <div class="col-12">
            <?php
                $sub_heading = isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value']) ? $report_content_data['sub_title']['value'] : 'Review Selling Price';
            ?>
            <h4 class="mt-0 sub_title"><?php echo $sub_heading; ?></h4>
            <?php 
                $content = isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value']) ? nl2br($report_content_data['content']['value']) : 'When your property first hits the market the entire audience which consists of realtors, prospective buyers, and sellers all place eyes on your listing. They all make rapid judgments as to it\'s price, current condition, and location. How they first perceive it will determine the viewing activity over the next few weeks. If we receive no viewings initially, we are facing the possibility that that market as a whole is rejecting the value proposition of your listing. Our solution? Reduce the price.\n\nReducing the price of your home is never an easy call but often times is a necessity one that might need to be made in order to get your home sold. Many homeowners feel that they are giving up hard earned equity that has been gained. In reality, a slight reduction can help avoid problems down the line. The question is, When is the best time? From the time the property is first placed on the market the rule of thumb is 30-45 days.';
            ?>
            <p class="f14"><?php echo $content; ?></p>
        </div>
    </div>
    <div class="d-flex mt-20">    
        <div class="col-12">
            <?php
                $table_1_title = isset($report_content_data['table_1_title']['value']) && !empty($report_content_data['table_1_title']['value']) ? $report_content_data['table_1_title']['value'] : 'At Listing Time';
            ?>
            <h4 class="table_title"><?php echo $table_1_title; ?></h4>
            <table>
                <tr>
                    <td>Home A</td>
                    <td>Home B</td>
                    <td>Jane & Joe</td>
                    <td>Home D</td>
                    <td>Home E</td>
                </tr>
                <tr>
                    <td>$368,000</td>
                    <td>$349,000</td>
                    <td>$345,000</td>
                    <td>$341,000</td>
                    <td>$333,000</td>
                </tr>
            </table>
            <?php
                $table_2_title = isset($report_content_data['table_2_title']['value']) && !empty($report_content_data['table_2_title']['value']) ? $report_content_data['table_2_title']['value'] : 'After Price Reduction';
            ?> 
            <h4 class="table_title"><?php echo $table_2_title; ?></h4>
            <table>
                <tr>
                    <td>Home A</td>
                    <td>Home B</td>
                    <td>Jane & Joe</td>
                    <td>Home D</td>
                    <td>Home E</td>
                    <td>Home F</td>
                </tr>
                <tr>
                    <td>Expired</td>
                    <td>$339,000<span>Reduced <br>& Sold</span></td>
                    <td>$345,000</td>
                    <td>$341,000<span>Sold</span></td>
                    <td>$333,000<span>Sold</span></td>
                    <td>$332,500<span>Just Added</span></td>
                </tr>
            </table>
            <?php
                $footer_content = isset($report_content_data['footer_content']['value']) && !empty($report_content_data['footer_content']['value']) ? $report_content_data['footer_content']['value'] : 'Joe and Jane went from being very competitively priced to being the highest property in their price range. From a buyer\'s perspective, their home now offers the worst value proposition in the marketplace.';
            ?>
            <p class="f14"><?php echo $footer_content; ?></p>
            <ul class="home_list">
                <li><img src="<?php echo base_url().'assets/reports/english/seller/images/18/home.png'; ?>" alt="home" border="0"></li>
                <li><img src="<?php echo base_url().'assets/reports/english/seller/images/18/home.png'; ?>" alt="home" border="0"></li>
                <li><img src="<?php echo base_url().'assets/reports/english/seller/images/18/home.png'; ?>" alt="home" border="0"></li>
                <li><img src="<?php echo base_url().'assets/reports/english/seller/images/18/home.png'; ?>" alt="home" border="0"></li>
                <li><img src="<?php echo base_url().'assets/reports/english/seller/images/18/home.png'; ?>" alt="home" border="0"></li>
                <li><img src="<?php echo base_url().'assets/reports/english/seller/images/18/home.png'; ?>" alt="home" border="0"></li>
            </ul>
        </div>
    </div>
</page>