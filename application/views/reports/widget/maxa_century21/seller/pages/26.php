<page class="social_ad_report">
        
    <div class="d-flex">
        <div class="col-60">
            <h2 class="social_ad_report_title"> SOCIAL AD REPORT </h2>
            <ul class="social_stats">
                <li>
                    <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/reach.png" alt="">
                    REACH
                    <?php
                    if(!empty($page['social_ad_reach'])): ?>
                    <span> <?php echo number_format($page['social_ad_reach']); ?> </span>
                    <?php endif; ?>
                </li>
                <li>
                    <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/impressions.png" alt="">
                    IMPRESSIONS
                    <?php
                    if(!empty($page['social_ad_imp'])): ?>
                    <span> <?php echo number_format($page['social_ad_imp']); ?> </span>
                    <?php endif; ?>
                </li>
                <li>
                    <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/leads.png" alt="">
                    LEADS
                    <?php
                    if(!empty($page['social_ad_leads'])): ?>
                    <span> <?php echo number_format($page['social_ad_leads']); ?> </span>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="social_ad_grid">
        <?php 
        for ($img_tmp=1; $img_tmp <= 7 ; $img_tmp++):
            $img_name =  base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images').'/img'.$img_tmp.'.png';
            $img_field_name = 'social_ad_img_'.$img_tmp;
            if(!empty($page[$img_field_name])):
                $img_name = base_url($page[$img_field_name]);
            endif;

        ?>
            <!-- <a href="#"><img src="<?php echo $img_name; ?>" alt="Image"></a> -->
            <div class="social_ad_imgs" style="background-image: url(<?php echo $img_name; ?>)">
                
            </div>
            <?php if($img_tmp == 2 || $img_tmp == 4) :
                // echo '<br/>';
            endif;
        endfor;
        ?>
        <!-- <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img1.png" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img2.png" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/phone.png" class="mobile_img" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img3.png" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img4.png" alt="img1"></a><br>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img5.png" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img6.png" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img7.png" alt="img1"></a> -->
    </div>
</page>