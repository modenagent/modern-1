 <page class="pdf20">
    <!-- <img src="<?php echo base_url().'assets/reports/english/buyer/images/18/img18.png';?>" alt="..." class="w100 img18" style="height: 650px"> -->
    <div class="home-content">
    <div class="content">
        <div class="d-flex">
            <div class="signature">
                <img src="<?php if($callFromApi == 1) echo $user['profile_image']; else echo base_url().$user['profile_image']; ?>" alt="<?php echo $user['fullname']; ?>"
                    class="profile_img">
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
                    /*if(isset($user['mobile']) && !empty($user['mobile']))
                    {
                ?>
                        <a class="tel_number" href="tel:<?php echo $user['mobile']; ?>">
                            M <span><?php echo $user['mobile']; ?></span>
                        </a>
                <?php
                    }*/
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
                <div class="ul_border"></div>
            </div>
            <div class="address">
                <?php 
                $site_address = $property->PropertyProfile->SiteAddress;

                $city = ucwords(strtolower($property->PropertyProfile->SiteCity));
                $state = strtoupper($property->PropertyProfile->SiteState);
                $zip = strtoupper($property->PropertyProfile->SiteZip);
            ?>
        
            <?php 
                if(isset($site_address) && !empty($site_address))
                {
            ?>
                    <div class="first_line"><?php echo ucwords(strtolower($site_address)).','; ?></div>    
            <?php
                }
            ?>
                <p class="m-0"><?php echo $city.' ,'.$state.' '.$zip; ?></p>

                
                        <div class="visit_us">
                            Visit Us Online at<br>
                            <a href="<?php echo base_url();?>"><?php echo base_url();?></a>
                        </div>
                

                
            </div>
            <!-- <img src="<?php echo base_url().'assets/reports/english/buyer/images/18//logo-here.png';?>" alt="logo-here" class="logo_here"> -->
        </div>
    </div>
    <div class="footer">
        <div class="d-flex">
            <div class="logo">
                <img src="<?php echo base_url($user["company_logo"]); ?>    " alt="white-logo" border="0">
            </div>
            <div class="copy_right_text">
                This material is intended as informational only and not as a solicitation. All information contained has been provided
                by the
                Realtor and even where intended to be reliable is in no case a guarantee to accuracy of the information contained
                including
                but not limited to condition, lot size, square footage, or other features of the property. All of this information
                should be
                independently verifi ed by personal inspection and by hiring the appropriate professionals.
            </div>
        </div>
    </div>
</div>
</page>