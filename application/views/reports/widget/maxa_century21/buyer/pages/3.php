
<body>
    <page class="pdf3">
        <div class="main_title">ABOUT ME</div>
        <div class="d-flex gutter-30 mt-80">
            <div class="col-40">
                <div class="signature horizontal_sign">
                    <?php
                    if($user['profile_image'] != '' && $user['profile_image'] != 'no') {?>
                    <a href="#" class="profile_pic"><img src="<?php echo base_url().$user['profile_image']; ?>" alt="client"></a>
                    <?php }
                    ?>
                    
                    <span class="profile_name"><?php echo (!empty($user['first_name']) || !empty($user['last_name'])) ?  $user['first_name'].' '.$user['last_name']  : (!empty($user['fullname']) ?  $user['fullname'] : '-'); ?></span>
                    <!-- Branch Manager<br>
                    DRE # 01266573<br> -->
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
                    <a href="http://www.century21award.com">www.century21award.com</a>
                    <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/C21_dark_logo.png" alt="C21" class="mt-30 img-fluid">
                </div>
            </div>
            <div class="col-60">
                <div class="profile_intro">
                    Since 2005, I have become one of the most trusted and
                    top-selling real estate agents in all of San Diego County. By
                    recognizing the importance of trust with my clients, I have
                    continued to exceed their expectations year by year. Whether
                    it’s residential or commercial, I am your local expert for all
                    your real estate needs.<br><br>
                    Since 2010, I have ranked amongst the Top 1% in all of
                    CENTURY 21 with an annual average of $70 million in sales
                    volume. I specialize in the unique & exclusive communities of
                    La Jolla, Del Mar, Encinitas, Solana Beach & Rancho Santa Fe.
                    If you’re looking more for the big city look & feel, I can show
                    you our luxury high rises downtown.<br><br>
                    San Diego is my home; I grew up here and graduated
                    from San Diego State University with a bachelor’s in
                    communication. When it comes to real estate, I am always
                    continuing my education by investing my time and money to
                    learn the latest sales, marketing, and negotiation techniques.<br><br>
                    Outside of real estate, I enjoy traveling, cooking, and spending
                    time with my family and friends.
                </div>
            </div>
        </div>
        <div class="copyright">
            <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/footer_icon.png" alt="footer_icon" class="img-fluid">
            © 2021 Century 21 Real Estate LLC. CENTURY 21®, the CENTURY 21 Logo and C21® are registered service marks owned by
            Century 21 Real Estate LLC.
            Century 21 Real Estate LLC fully supports the principles of the Fair Housing Act and the Equal Opportunity Act. Each
            office is independently owned
            and operated. Each independent sales associate and broker is responsible for the specific customized content of this
            presentation.
        </div>
        
    </page>
