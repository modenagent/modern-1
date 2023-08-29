<page class="pdf24">
    <h1 class="report_title">&nbsp;</h1>
    <!-- <img src='<?php echo base_url($user["company_logo"]); ?>' alt="company-logo" class="mx-auto z9 top-logo"> -->
    <img src="https://i.ibb.co/5K2mcTx/resort.png" alt="resort"  class="w100 hero_img">
    <div class="footer vertical-align">
        <div class="more_info">For more information, please contact me.</div>
        <div class="d-flex vertical-align">
            <div class="signature horizontal_sign vertical-align">
                    <?php 
                        if($user['profile_image'] != '' && $user['profile_image'] != 'no')
                        {
                    ?>  
                            <img src="<?php echo base_url().$user['profile_image']; ?>" alt="<?php echo $user['fullname']; ?>" class="profile_img">
                    <?php
                        }
                    ?>
                <div class="res-text-center">
                    <?php 
                    if(!empty($user['fullname'])) {
                    ?>
                        <div class="profile_name"><?php echo $user['fullname']; ?></div>
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
                    <?php /*
                    if(isset($user['mobile']) && !empty($user['mobile'])) {
                    ?>
                    <a class="contact_info mt-2" href="tel:<?php echo $user['mobile']; ?>"><?php echo $user['mobile']; ?></a>
                    <?php } */ ?>
                    <?php 
                        if(isset($user['email']) && !empty($user['email'])) {
                    ?>
                    <a href="mailto:<?php echo $user['email']; ?>" class="contact_info"><?php echo $user['email']; ?></a>
                    <?php } ?>
                    <!-- <a href="https://dawncordiner.com" target="_blank" class="contact_info"><b>dawncordiner.com</b></a> -->
                </div>
            </div>
            <div class="logo res-text-center res-pos-relative signature-wrap">
                <div class="">
                    <img src='<?php echo base_url($user["company_logo"]); ?>' alt="company-logo" border="0">
                    <div class="auth">AUTHENTICITY ABOVE ALL.</div>
                    <div class="info_policy">This is not intended to solicit currently listed properties.<br>
                        This information is deemed reliable, but not guaranteed.</div>
                </div>
                <!-- <img src="https://i.ibb.co/ccL7P0K/soldera.png" alt="soldera" class="smaller_img">
                <img src="https://i.ibb.co/VQSTyxQ/footer-icons.png" alt="footer-icons" class="mini_icon"> -->
            </div>
        </div>
    </div>
    <p class="mini_text res-pos-relative res-pos-auto">
        This material is intended as informational only and not as a solicitation. All information contained has been provided
        by the Realtor and even where intended to be reliable is in no case
        a guarantee to accuracy of the information contained including but not limited to condition, lot size, square footage,
        or other features of the property. All of this information should be
        independently verified by personal inspection and by hiring the appropriate professionals.
    </p>
</page>