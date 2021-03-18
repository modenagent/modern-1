<?php 
$site_address = $property->PropertyProfile->SiteAddress;

$city = ucwords(strtolower($property->PropertyProfile->SiteCity));
$state = strtoupper($property->PropertyProfile->SiteState);
$zip = strtoupper($property->PropertyProfile->SiteZip);

?>
<page class="buyerpdf1">
    <h1 class="main_title">Buyers Report</h1>
        <div class="d-flex">    
            <div class="col-50">
                <img src="<?php echo base_url().'assets/reports/english/buyer/images/1/img1.png'; ?>" alt="24ad-Traditional" class="img-fluid">
                <ul class="address_offer">
                    <li><span>1234 Main Street,</span><br> City, State 00000</li>
                    <li>Offered for<br> $0,000,000</li>
                </ul>
            </div>
            <div class="col-50">
                <img src="<?php echo base_url().'assets/reports/english/buyer/images/1/img2.png'; ?>" alt="24ad-Traditional" class="img-fluid">
                <ul class="address_offer">
                    <li><span>1234 Main Street,</span><br> City, State 00000</li>
                    <li>Offered for<br> $0,000,000</li>
                </ul>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-50">
                <img src="<?php echo base_url().'assets/reports/english/buyer/images/1/img3.png'; ?>" alt="24ad-Traditional" class="img-fluid">
                <ul class="address_offer">
                    <li><span>1234 Main Street,</span><br> City, State 00000</li>
                    <li>Offered for<br> $0,000,000</li>
                </ul>
            </div>
            <div class="col-50">
                <img src="<?php echo base_url().'assets/reports/english/buyer/images/1/img4.png'; ?>" alt="24ad-Traditional" class="img-fluid">
                <ul class="address_offer">
                    <li><span>1234 Main Street,</span><br> City, State 00000</li>
                    <li>Offered for<br> $0,000,000</li>
                </ul>
            </div>
        </div>
    
    <div class="footer">
        <div class="d-flex">
            <div class="signature horizontal_sign">
                <img src="<?php if($callFromApi == 1) echo $user['profile_image']; else echo base_url().$user['profile_image']; ?>" alt="<?php echo $user['fullname']; ?>" class="profile_img">
                <div>
                    <?php 
                            if(isset($user['fullname']) && !empty($user['fullname']))
                            {
                        ?>
                                <div class="profile_name">
                                    <?php echo $user['fullname']; ?>
                                </div>
                        <?php
                            }
                        ?>
                    <?php 
                            if(isset($user['title']) && !empty($user['title']))
                            {
                        ?>
                                <div class="profile_title">
                                    <?php echo $user['title']; ?>
                                </div>
                        <?php
                            }
                        ?>

                    <?php 
                            if(isset($user['phone']) && !empty($user['phone']))
                            {
                        ?>
                                <a class="tel_number" href="tel:<?php echo $user['phone']; ?>">
                                    O <span><?php echo $user['phone']; ?></span>
                                </a>
                        <?php
                            }
                        ?>

                        <?php 
                            if(isset($user['mobile']) && !empty($user['mobile']))
                            {
                        ?>
                                <a class="tel_number" href="tel:<?php echo $user['mobile']; ?>">
                                    M <span><?php echo $user['mobile']; ?></span>
                                </a>
                        <?php
                            }
                        ?>
                    <?php 
                            if(isset($user['email']) && !empty($user['email']))
                            {
                        ?>
                                <a href="mailto:<?php echo $user['email']; ?>" class="contact_info">
                                    <?php echo $user['email']; ?>
                                </a>
                        <?php
                            }
                        ?>

                        <?php 
                            if(isset($user['website']) && !empty($user['website']))
                            {
                                $parsed_url  = parse_url($user['website']);

                                $website = isset($parse_url['scheme']) && !empty($parse_url['scheme']) ? $parse_url['scheme'] : 'javascript:void(0);';
                        ?>
                                <a href="<?php echo $website; ?>" target="_blank"class="contact_info">
                                    <?php echo $user['website']; ?>
                                </a>
                        <?php
                            }
                        ?>
                </div>
            </div>
            <div class="logo">
                <img src="<?php echo base_url().'assets/reports/english/seller/images/1/white-logo.png'; ?>" alt="white-logo" border="0">
            </div>
        </div>
    </div>

</page>