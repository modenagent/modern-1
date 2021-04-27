<page class="p-0">
    <div class="map_content">
        <h1 class="report_title">BUYER’S REPORT</h1>
        <img src="https://i.ibb.co/gvR0JTV/black-logo.png" alt="black-logo" class="mx-auto z9">
    </div>
    <div class="d-flex no_gutter mmt-90">    
        <div class="col-50">
            <img src="https://i.ibb.co/GFW5Mn0/shutterstock-666248572.jpg" alt="24ad-Traditional" class="img-fluid cat_img">
            <ul class="address_offer">
                <li>1234 Main Street,<br> City, State 00000</li>
                <li>Oﬀered for<br> $0,000,000</a></li>
            </ul>
        </div>
        <div class="col-50">
            <img src="https://i.ibb.co/dtT1Yy5/webaliser-TPTXZd9m-Oo-unsplash.jpg" alt="24ad-Traditional" class="img-fluid cat_img">
            <ul class="address_offer">
                <li>1234 Main Street,<br> City, State 00000</li>
                <li>Oﬀered for<br> $0,000,000</a></li>
            </ul>
        </div>
    </div>
    <div class="d-flex no_gutter">
        <div class="col-50">
            <img src="https://i.ibb.co/Kw6TyW7/shutterstock-472326997.jpg" alt="24ad-Traditional" class="img-fluid cat_img">
            <ul class="address_offer">
                <li>1234 Main Street,<br> City, State 00000</li>
                <li>Oﬀered for<br> $0,000,000</a></li>
            </ul>
        </div>
        <div class="col-50">
            <img src="https://i.ibb.co/6PNWyBH/shutterstock-1116862508.jpg" alt="24ad-Traditional" class="img-fluid cat_img">
            <ul class="address_offer">
                <li>1234 Main Street,<br> City, State 00000</li>
                <li>Oﬀered for<br> $0,000,000</a></li>
            </ul>
        </div>
    </div>
    <div class="map_content pt-0">
        <hr>
        <div class="footer">
            <div class="more_info">For more information, please contact me.</div>
            <div class="d-flex ">
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

                        <!-- <div class="profile_title"><small>Licensed in Oregon & Washington</small></div> -->
                        <a class="contact_info mt-2" href="tel:000.000.0000">000.000.0000</a>
                        <?php 
                            if(isset($user['mobile']) && !empty($user['mobile']))
                            {
                        ?>
                                <a class="contact_info mt-2" href="tel:<?php echo $user['mobile']; ?>"><?php echo $user['mobile']; ?>
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
                                    <b><?php echo $user['website']; ?></b>
                                </a>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="logo">
                    <div class="mr-90">
                        <img src="https://i.ibb.co/7n222qk/white-logo.png" alt="white-logo" border="0">
                        <div class="auth">AUTHENTICITY ABOVE ALL.</div>
                        <div class="info_policy">This is not intended to solicit currently listed properties.<br>
                            This information is deemed reliable, but not guaranteed.</div>
                    </div>
                    <img src="https://i.ibb.co/ccL7P0K/soldera.png" alt="soldera" class="smaller_img">
                </div>
            </div>
        </div>
    </div>
</page>