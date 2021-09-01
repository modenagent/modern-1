    <page class="pdf32">
        <a href="https://century21award.com/"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/century_big.png" alt="century_big" class="img-fluid d-block mx-auto mt-170" width="600"></a>
        <div class="mt-100 profile_detail">
            <div class="name"><?php echo (!empty($user['first_name']) || !empty($user['last_name'])) ?  $user['first_name'].' '.$user['last_name']  : (!empty($user['fullname']) ?  $user['fullname'] : '-'); ?></div>
            REALTOR®<br><br>
            <!-- DRE# 01266573<br> -->
           <?php 
            if(isset($user['mobile']) && !empty($user['mobile'])) {
            ?>
            <a href="tel:<?php echo $user['mobile']; ?>"><?php echo $user['mobile']; ?></a><br>
            <?php }
            elseif(isset($user['phone']) && !empty($user['phone'])) {
            ?>
            <a href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></a><br>
            <?php }?>
            <?php 
            if(isset($user['email']) && !empty($user['email'])) {
            ?>
            <a href="mailto:<?php echo $user['email']; ?>" class="d-block mt-40"><?php echo $user['email']; ?></a><br>
            <?php }?>
           <a href="https://century21award.com/" class="d-block mt-100 web_link">www.century21award.com</a>
        </div>
    </page>