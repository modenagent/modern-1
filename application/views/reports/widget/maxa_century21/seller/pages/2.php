<?php
$site_address = $property->PropertyProfile->SiteAddress;
$site_unit_type = $property->PropertyProfile->SiteUnitType;
$site_unit_number = $property->PropertyProfile->SiteUnit;

// var_dump($user);die;
?>
    <page class="p-0 pdf1">
        <div class="d-flex h100 no_gutter">
            <div class="col-50 bg_gray p-50 h100">
                <h1>
                    A
                    RELENTLESS
                    REAL
                    ESTATE
                    SERVICE
                    PLAN
                </h1>
                <div class="signature vertical_sign">
                    <?php
                    /*
                    if($user['profile_image'] != '' && $user['profile_image'] != 'no') {?>

                    <img src="<?php echo base_url().$user['profile_image']; ?>" alt="..." class="profile_pic">
                    <?php 
                } */
                    ?>
                    PREPARED BY: <br><br>
                    <span class="profile_name"><?php echo (!empty($user['first_name']) || !empty($user['last_name'])) ?  $user['first_name'].' '.$user['last_name']  : (!empty($user['fullname']) ?  $user['fullname'] : '-'); ?>
                    </span>
                    <?php if(isset($user['title']) && !empty($user['title'])) {echo $user['title'].'<br>';}?>
                    <!-- DRE # 01266573<br> -->
                    CENTURY 21 Award<br>
                    1530 Hilton Head Road #201<br>
                    El Cajon, CA 92019<br><br>
                    <?php 
                    if(isset($user['mobile']) && !empty($user['mobile'])) {
                    ?>
                    P: <a href="tel:<?php echo $user['mobile']; ?>"><?php echo $user['mobile']; ?></a><br>
                    <?php }
                    elseif(isset($user['phone']) && !empty($user['phone'])) {
                    ?>
                    P: <a href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></a><br>
                    <?php }?>
                    <?php 
                    if(isset($user['email']) && !empty($user['email'])) {
                    ?>
                    E: <a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a><br>
                    <?php }?>
                    <!-- Social: @NikkiCoppa<br> -->
                    <a href="http://www.century21award.com">www.century21award.com</a>
                </div>
                <div class="copyright">
                    <p>© 2020 Century 21 Real Estate LLC. CENTURY 21®, the CENTURY 21 Logo and C21® are
                    registered service marks owned by Century 21 Real Estate LLC. Century 21 Real Estate LLC
                    fully supports the principles of the Fair Housing Act and the Equal Opportunity Act. Each
                    office is independently owned and operated. Each independent sales associate and broker
                    is responsible for the specific customized content of this presentation</p>
                    <a href="#"><img src='<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/images");?>/footer_icon.png' alt="footer_icon"></a>
                </div>
            </div>
            <div class="col-50 p-50 ">
                <a href="#"><img src='<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/images");?>/C21_logo.png' alt="C21" class="mt-15"></a>
                <div class="cover_letter">
                    <div class="subject">
                        FOR THE PROPERTY LOCATED AT:
                        <span><?php if(!empty($site_address)) {echo $site_unit_type.$site_unit_number.' '.$site_address;} ?></span>
                    </div>
                    <div class="letter_body">
                        <div class="letter_body_data">
                        <?php 
                            if(!empty($page['cover_letter'])) {
                                echo nl2br($page['cover_letter']);
                            }
                        ?>
                        </div>
                        <br>
                        Very truly yours,
                        <div class="letter_signature">
                            <?php echo (!empty($user['first_name']) || !empty($user['last_name'])) ?  $user['first_name'].' '.$user['last_name']  : (!empty($user['fullname']) ?  $user['fullname'] : '-'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </page>