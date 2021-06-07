<?php 
$site_address = $property->PropertyProfile->SiteAddress;

$city = ucwords(strtolower($property->PropertyProfile->SiteCity));
$state = strtoupper($property->PropertyProfile->SiteState);
$zip = strtoupper($property->PropertyProfile->SiteZip);
// $site_address ='1234 Main Street';

// $city = 'City';
// $state = 'State';
// $zip = '000000';
?>
<page class="buyerpdf1">
    <h1 class="main_title" style="padding-top:40px;">Buyers Report</h1>
    <img src="https://i.ibb.co/DLbCmth/buyers-report-hero.png" alt="">

    <div class="address_box">
        <b><?php if(!empty($site_address)) {echo $site_address.', ';} ?><?php if(!empty($city)) {echo $city.', ';} ?><?php if(!empty($state)) {echo $state.', ';} ?><?php if(!empty($zip)) {echo $zip.', ';} ?></b>
    <?php echo isset($areaSalesAnalysis['propertySalePrice']) && !empty($areaSalesAnalysis['propertySalePrice']) ? 'Offered for $'.$areaSalesAnalysis['propertySalePrice'] : ''; ?>
    </div>
    <div class="footer">
        <div class="d-flex">
            <div class="signature horizontal_sign">
                <img src="<?php if($callFromApi == 1) echo $user['profile_image']; else echo base_url().$user['profile_image']; ?>" alt="<?php echo $user['fullname']; ?>" class="profile_img">
                <div style="padding: 20px;">
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
