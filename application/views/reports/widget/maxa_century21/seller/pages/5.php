<page class="pdf8">
        <div class="resume_title">MY RESUME</div>
        <div class="resume_card">
            <div>
                <div class="achivement_title">
                    <?php 
                        if(!empty($page['resume_award_no'])) {
                            echo '<span>'.$page['resume_award_no'].'</span> AWARDS';
                        }
                    ?>
                </div>
                <ul class="award_list">
                    <?php
                    if(!empty($page['resume_award_list'])) {
                            $list_array = explode("\n", $page['resume_award_list']);
                            foreach ($list_array as $list_array_val) {
                                echo '<li>'.$list_array_val.'</li>';
                                # code...
                            }
                        }
                    ?>
                </ul>
                <div class="achivement_title">
                    <?php 
                        if(!empty($page['resume_years_no'])) {
                            echo '<span>'.$page['resume_years_no'].'</span> YEARS';
                        }
                    ?>
                </div>  
                <div class="achivement_title">
                    <?php
                        if(!empty($page['resume_volume'])) {
                            echo '<b>'.$page['resume_volume'].'</b> volume';
                        }
                    ?>
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