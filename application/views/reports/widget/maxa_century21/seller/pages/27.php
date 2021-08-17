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
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img1.png" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img2.png" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/phone.png" class="mobile_img" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img3.png" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img4.png" alt="img1"></a><br>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img5.png" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img6.png" alt="img1"></a>
        <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/img7.png" alt="img1"></a>
    </div>
</page>