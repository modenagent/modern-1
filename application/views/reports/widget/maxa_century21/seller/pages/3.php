<page class="pdf2">
    <a href="#"><img src='<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/images/C21_dark_logo.png");?>' alt="C21" class="profile_pic"></a>
    <div class="signature horizontal_sign mt-50">
        <?php
        if($user['profile_image'] != '' && $user['profile_image'] != 'no') {?>

        <a href="#" class="profile_pic"><img src="<?php echo base_url().$user['profile_image']; ?>" alt="..."></a>
        <?php }
        ?>
        <span class="profile_name"><?php echo (!empty($user['first_name']) || !empty($user['last_name'])) ?  $user['first_name'].' '.$user['last_name']  : (!empty($user['fullname']) ?  $user['fullname'] : '-'); ?></span>
        <!-- Branch Manager<br> -->
        <!-- DRE # 01266573<br> -->
        <?php if(isset($user['title']) && !empty($user['title'])) {echo $user['title'].'<br>';}?>
        CENTURY 21 Award<br>
        1530 Hilton Head Road #201<br>
        El Cajon, CA 92019<br><br>
        <?php 
        if(isset($user['mobile']) && !empty($user['mobile'])) {
        ?>
        P: <a href="tel:<?php echo $user['mobile']; ?>"><?php echo $user['mobile']; ?></a><br>
        <?php }?>
        <?php 
        if(isset($user['email']) && !empty($user['email'])) {
        ?>
        E: <a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a><br>
        <?php }?>
        <!-- Social: @NikkiCoppa<br> -->
        <a href="http://www.century21award.com">www.century21award.com</a>
    </div>
    <div class="profile_intro">
        <div class="profile_intro_data">
        <?php echo nl2br($bio); ?>
        </div>
    </div>
</page>