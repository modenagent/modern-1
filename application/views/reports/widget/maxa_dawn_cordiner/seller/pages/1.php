<?php
$site_address = $property->PropertyProfile->SiteAddress;

$city = ucwords(strtolower($property->PropertyProfile->SiteCity));
$state = strtoupper($property->PropertyProfile->SiteState);
$zip = strtoupper($property->PropertyProfile->SiteZip);
?>
<page>
    <h1 class="report_title">Sellers Report</h1>
    <img src='<?php echo base_url("assets/reports/widget/$report_dir_name/images/black_logo.png"); ?>' alt="black-logo" class="mx-auto z9">
    <img src='<?php echo base_url("assets/reports/widget/$report_dir_name/images/hero.png"); ?>' alt="hero" class="w100 hero_img">
    <div class="main_title">
        <?php if(!empty($site_address)) {echo $site_address.', ';} ?>
        <?php if(!empty($city)) {echo $city.', ';} ?>
        <?php if(!empty($state)) {echo $state.', ';} ?>
        <?php if(!empty($zip)) {echo $zip;} ?>
    </div>
    <hr>
    <div class="footer">
        <div class="more_info">For more information, please contact me.</div>
        <div class="d-flex">
            <div class="signature horizontal_sign">

                    <?php 
                        if($user['profile_image'] != '' && $user['profile_image'] != 'no')
                        {
                    ?>  
                            <img src="<?php echo base_url().$user['profile_image']; ?>" alt="<?php echo $user['fullname']; ?>" class="profile_img">
                    <?php
                        }
                    ?>

                    
                <div>
                    <?php 
                    if(!empty($user['first_name']) || !empty($user['last_name'])) {
                    ?>
                        <div class="profile_name"><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></div>
                    <?php } ?>
                    <?php 
                    if(isset($user['title']) && !empty($user['title'])) {
                    ?>
                        <div class="profile_title"><?php echo $user['title']; ?></div>
                    <?php } ?>
                    <!-- <div class="profile_title"><small>Licensed in Oregon & Washington</small></div> -->
                    <?php 
                    if(isset($user['phone']) && !empty($user['phone'])) {
                    ?>
                    <a class="contact_info mt-2" href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></a>
                    <?php } ?>
                    <?php 
                    if(isset($user['mobile']) && !empty($user['mobile'])) {
                    ?>
                    <a class="contact_info mt-2" href="tel:<?php echo $user['mobile']; ?>"><?php echo $user['mobile']; ?></a>
                    <?php } ?>
                    <?php 
                        if(isset($user['email']) && !empty($user['email'])) {
                    ?>
                    <a href="mailto:<?php echo $user['email']; ?>" class="contact_info"><?php echo $user['email']; ?></a>
                    <?php } ?>
                    <a href="https://dawncordiner.com" target="_blank" class="contact_info"><b>dawncordiner.com</b></a>
                </div>
            </div>
            <div class="logo">
                <div class="mr-90">
                    <img src='<?php echo base_url("assets/reports/widget/$report_dir_name/images/white_logo.png"); ?>' alt="white-logo" border="0">
                    <div class="auth">AUTHENTICITY ABOVE ALL.</div>
                    <div class="info_policy">This is not intended to solicit currently listed properties.<br>
                        This information is deemed reliable, but not guaranteed.</div>
                </div>
                <img src='<?php echo base_url("assets/reports/widget/$report_dir_name/images/soldera.png"); ?>' alt="soldera" class="smaller_img">
            </div>
        </div>
    </div>
</page>