    <page class="pdf28">
        <h2 class="big_title">
            SOCIAL<br> MEDIA
        </h2>
        <ul class="social_media_icons">
            <li><a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/IG.jpg" alt="IG"></a></li>
            <li><a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/FB.jpg" alt="FB"></a></li>
            <li><a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/YT.jpg" alt="YT"></a></li>
            <li><a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/Twitter.jpg" alt="Twitter"></a></li>
            <li><a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/IN.jpg" alt="IN"></a></li>
        </ul>
        <div class="gray_block">
            <h3>
                FIND THE RIGHT BUYER
            </h3>
            <p class="w70">
                <?php
                if(!empty($page['social_intro_txt'])): ?>
                    <?php echo nl2br($page['social_intro_txt']); ?>
                <?php else: ?>
                Millions of people use social media channels like
                Facebook®, Twitter®, YouTube®, and lnstagram®
                daily. As your agent, I will utilize my strong Social
                Media presence to promote your property listing to
                a wide audience, in the right area at the right time.
                <?php endif;?>
            </p>
            <p class="mt-80">
                <?php
                if($fromcma && empty($page['social_txt1'])) {
                    $page['social_txt1'] = '2100';
                }
                if(!empty($page['social_txt1'])): ?>
                <span><?php echo number_format($page['social_txt1']); ?></span> followers on Instagram
                <?php endif; ?>
            </p>
            <p>
                <?php
                if($fromcma && empty($page['social_txt2'])) {
                    $page['social_txt2'] = '87';
                }
                if(!empty($page['social_txt2'])): ?>
                <span><?php echo number_format($page['social_txt2']); ?></span> average reach on Instagram
                <?php endif; ?>
            </p>
            <p>
                <?php
                if($fromcma && empty($page['social_txt3'])) {
                    $page['social_txt3'] = '2100';
                }
                if(!empty($page['social_txt3'])): ?>
                <span><?php echo number_format($page['social_txt3']); ?></span> followers on  Facebook
                <?php endif; ?>
            </p>
            <p>
                <?php
                if($fromcma && empty($page['social_txt4'])) {
                    $page['social_txt4'] = '2100';
                }
                if(!empty($page['social_txt4'])): ?> 
                <span><?php echo number_format($page['social_txt4']); ?></span> followers on Twitter
                <?php endif; ?>
            </p>
            <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/big_c21.png" alt="big_c21" class="c21_logo_bottom_right">
        </div>
    </page>