<page class="pdf2">
    <!-- <div class="d-flex">
        <div class="col-12"> -->
            <h1 class="main_title top_title">Meet Your Agent</h1>
        <!-- </div>
    </div> -->
    <div class="d-flex mt-30">
        <div class="col-60">
            <div class="d-flex">
                <?php 
                    if($user['profile_image'] != '' && $user['profile_image'] != 'no')
                    {
                ?>  
                        <div class="col-60 profile_pic" style="background:url(<?php echo base_url().$user['profile_image']; ?>) no-repeat;background-size: contain;background-position: 20px;height: 230px;"></div>
                <?php
                    }
                    else { ?>
                        <div class="col-60 profile_pic" style="background-size: contain;background-position: 20px;"></div>
                    <?php }
                ?>
                <div class="signature vertical_sign col-40">
                    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="img-fluid">
                    
                    <?php 
                        if(isset($user['fullname']) && !empty($user['fullname']))
                        {
                    ?>
                            <h2 class="profile_name">
                                <?php echo $user['fullname']; ?>
                            </h2>
                    <?php
                        }
                    ?>
                    
                    <?php 
                        if(isset($user['title']) && !empty($user['title']))
                        {
                    ?>
                            <p class="profile_title">
                                <?php echo $user['title']; ?>
                            </p>
                    <?php
                        }
                    ?>

                    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="img-fluid">
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
                            <a href="mailto:<?php echo $user['email']; ?>" class="contact_info mt-20">
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
        </div>
        <?php 
            if(isset($bio) && !empty($bio))
            {
        ?>
                <div class="col-40">
                    <p class="text-justify mt-0"><?php echo trim($bio); ?></p>
                </div>
        <?php
            }
        ?>
        
    </div>

    <div class="d-flex mt-30 pad">
        <?php
            if(isset($testimonials) && !empty($testimonials))
            {
                list($upper_testimonial, $lower_testimonial) = array_chunk($testimonials, ceil(count($testimonials) / 2));
                
                if(isset($upper_testimonial) && !empty($upper_testimonial))
                {
            ?>
                    <div class="col-50">
                    <?php

                        foreach ($upper_testimonial as $key => $value) 
                        {
                    ?>
                            <div class="feedback">
                                <p> <?php echo trim($value['content']); ?></p>
                                <div class="username"><?php echo $value['name']; ?> <img src="<?php echo base_url().'assets/reports/english/seller/images/2/rating.png'; ?>" alt="rating" class="rating"></div>
                            </div>
                    <?php
                        }
                    ?>
                    </div>
                <?php
                }

                if(isset($lower_testimonial) && !empty($lower_testimonial))
                {
            ?>
                    <div class="col-50">
                    <?php

                        foreach ($lower_testimonial as $k => $v) 
                        {
                    ?>
                            <div class="feedback">
                                <p> <?php echo trim($v['content']); ?></p>
                                <div class="username"><?php echo $v['name']; ?> <img src="<?php echo base_url().'assets/reports/english/seller/images/2/rating.png'; ?>" alt="rating" class="rating"></div>
                            </div>
                    <?php
                        }
                    ?>
                    </div>
                <?php
                }
            }
            else
            {
        ?>
                <div class="username">No Testimonials Found.</div>
        <?php
            }
        ?>
    </div>
</page>