<div class="container">
        <page class="pdf1">
            <div class="header">                
                <img src="<?php echo base_url().'assets/reports/english/seller/images/1/light-house.png' ?>" alt="light-house" border="0">
                <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png' ?>" alt="line" border="0">
                <div class="text">
                    <h1>Sellers Report</h1>
                    <p><?php echo $property->PropertyProfile->SiteAddress ; ?>,</p>
                    <p><?php echo $property->PropertyProfile->SiteCity; ?>, <?php echo $property->PropertyProfile->SiteState ; ?> <?php echo $property->PropertyProfile->SiteZip; ?></p>
                </div>
            </div>
            <div class="body">
                <img src="<?php echo base_url().'assets/reports/english/seller/images/1/architecture-modern-residence6.jpg' ?>" alt="architecture-modern-residence6" class="img-fluid d-block">
                <div class="footer">
                    <div class="d-flex">
                        <div class="signature horizontal_sign">
                            $user['profile_image'] != '' && $user['profile_image'] != 'no'
                            <?php 
                                if($user['profile_image'] != '' && $user['profile_image'] != 'no')
                                {
                            ?>  
                                    <img src="<?php if($callFromApi == 1) echo $user['profile_image']; else echo base_url().$user['profile_image']; ?>" alt="<?php echo $user['fullname']; ?>" class="profile_img">
                            <?php
                                }
                            ?>
                            
                            <div>
                                <div class="profile_name"><?php echo $user['fullname']; ?></div>
                                <div class="profile_title"><?php echo $user['title']; ?></div>
                                <!-- <a class="tel_number" href="tel:000.000.0000">O <span>000.000.0000</span></a> -->
                                <a class="tel_number" href="tel:<?php echo $user['phone']; ?>">M <span><?php echo $user['phone']; ?></span></a>
                                <a href="mailto:<?php echo $user['email']; ?>" class="contact_info"><?php echo $user['email']; ?></a>
                                <!-- <a href="https://domain.com" class="contact_info">domain.com</a> -->
                            </div>
                        </div>
                        <div class="logo">
                            <img src="<?php echo base_url().'assets/reports/english/seller/images/1/white-logo.png' ?>" alt="white-logo" border="0">
                        </div>
                    </div>
                </div>                
            </div>
        </page>
    </div>