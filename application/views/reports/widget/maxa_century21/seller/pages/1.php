    <page class="new_pdf1">
        <div class="bg_gray">
            <a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/C21_dark_logo.png" alt="C21" class="c21_logo"></a>
            <h1>
                A HOME SELLER'S GUIDE
            </h1>
            <div class="seller_title">
                PREPARED FOR: <br>
                <!-- SELLER'S NAME  -->
                <?php 
                if(!empty($page['cover_prepared_for'])) {
                    echo $page['cover_prepared_for'];
                }
                else {
                    echo $primary_owner; 
                }
                
                ?>
            </div>
        </div>
        <div class="seller_address">
            <?php
            if(!empty($page['cover_image'])): ?>
                 <img src="<?php echo base_url($page['cover_image']); ?>" alt="seller_image" class="img-fluid">
            
            <?php else : ?>
                <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/new.png" alt="seller_image" class="img-fluid">
            <?php endif; ?>
            <div class="address_block">
                <div class="seller_name"><?php echo (!empty($user['first_name']) || !empty($user['last_name'])) ?  $user['first_name'].' '.$user['last_name']  : (!empty($user['fullname']) ?  $user['fullname'] : '-'); ?></div>
                <address>
                    <?php if(isset($user['title']) && !empty($user['title'])) {echo $user['title'];} ?>
                    <br>
                    <a href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></a>
                    <br>
                    <a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a>
                    <!-- REALTOR®<br>DRE #01266573  <br> <a href="tel:619.274.1426">619.274.1426</a>  <br><a href="mailto:ncoppa@century21award.com">ncoppa@century21award.com</a> -->
                </address>
            </div>
        </div>
    </page>
