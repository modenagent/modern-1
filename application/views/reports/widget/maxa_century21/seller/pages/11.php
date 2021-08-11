<page class="pdf8">
        <div class="resume_title">MY RESUME</div>
        <div class="resume_card">
            <div>
                <div class="achivement_title">
                    <span>5</span> AWARDS
                </div>
                <ul class="award_list">
                    <li>Award 1 2018</li>
                    <li>Award 2 2019</li>
                    <li>Award 3 2020</li>
                    <li>Award 4 2021</li>
                    <li>Award 5 2021</li>
                </ul>
                <div class="achivement_title">
                    <span>7</span> YEARS
                </div>  
                <div class="achivement_title">
                    <b>$100,000,000+</b> volume
                </div>
            </div>
            <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/century21.png" alt="century21" class="century21"></a>
            <?php
            if(!empty($user['profile_image']) && $user['profile_image'] != 'no') {?>

            <img src="<?php echo base_url().$user['profile_image']; ?>" alt="myprofile" class="myprofile_img">
            <?php }
            ?>
            <!-- <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/myprofile.png" alt="myprofile" class="myprofile_img"> -->
        </div>
        <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/c21_watermark_white.png" alt="c21-watermark" class="img-fluid">
    </page>