
    <page class="pdf1">
        <div class="hero">
            <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/hero.png" alt="hero" class="img-fluid">
            <h1>
                A HOME BUYER'S<br>
                GUIDE
            </h1>
            <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/big_c21.png" alt="C21" class="logo_top_right">
        </div>

        <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/C21_dark_logo.png" alt="C21" class="C21_dark_logo">

        <div class="signature vertical_sign">
            <span class="profile_name"><?php echo (!empty($user['first_name']) || !empty($user['last_name'])) ?  $user['first_name'].' '.$user['last_name']  : (!empty($user['fullname']) ?  $user['fullname'] : '-'); ?></span>
            <!-- Branch Manager<br>
            DRE # 01266573<br> -->
            <?php if(isset($user['title']) && !empty($user['title'])) {echo $user['title'].'<br>';}?>
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
            <a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a>
            <?php }?>
        </div>
    </page>
