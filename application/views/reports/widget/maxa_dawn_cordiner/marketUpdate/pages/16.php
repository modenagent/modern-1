<body>
    <page class="p-0 market_update">
        <div class="header">
            <img src="https://i.ibb.co/4823bQX/logo.png" alt="logo" class="logo">

            <h1>MARKET UPDATE <span>ZIPCODE: <?php echo $zipCode; ?></span></h1>
        </div>

        <div class="hero">
            <div class="hero_caption">
                <div class="d-flex">
                    <div class="col-60">
                        <p>
                            To receive your complimentary sales report via
                            text message, enter the Modern Agent code:
                        </p>
                    </div>
                    <div class="col-40">
                        <ul class="list-inline">
                            <?php 
                            if(empty($cma_url)):
                                $cma_url = "https://modernagent.io/cma";
                            endif;
                            $cma_url_display = preg_replace("(^https?://)", "", $cma_url );
                             ?>
                            <li class="mb-2"><a href="https://modernagent.io/cma"><img src="https://i.ibb.co/5KWxJxL/world.png" alt="WWW">
                                    <?php echo $cma_url_display; ?></a></li>
                            <li><a href="https://modernagent.io/cma"><img src="https://i.ibb.co/jWYqWyd/keyboard.png" alt="Code"><p><span>ENTER CODE:</span><br><?php echo $user['ref_code']; ?></p></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-50">
            <table class="table_transparent">
                <tr>
                    <th>PROPERTY ADDRESS</th>
                    <th>SALE PRICE</th>
                    <th>SQFT</th>
                    <th>BEDS</th>
                    <th>BATHS</th>
                </tr>
                <?php if(sizeof($_comparables)>0): ?>
                    <?php $avaiProperty = 0; $i = 1; ?>
                    <?php foreach ($_comparables as $key => $item): ?>
                        <?php 
                            if($key>8){
                                break;
                            }
                        ?>
                            <tr>
                                <td>
                                    <?php echo $item['Address']; ?>
                                </td>
                                <td>
                                    <?php echo $item['Price']; ?>
                                </td>
                                <td>
                                    <?php echo $item['SquareFeet']; ?>
                                </td>
                                <td>
                                    <?php echo $item['Beds']; ?>
                                </td>
                                <td>
                                    <?php echo $item['Baths']; ?>
                                </td>
                            </tr>
                        <?php $avaiProperty++; $i++; ?>
                    <?php endforeach;?>
                <?php endif; ?>
            </table>
        </div>

        <div class="footer">
            <div class="more_info">For more information, please contact me.</div>
            <div class="d-flex m-0">
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
                        <div class="profile_title">&nbsp;</div>
                        <?php 
                            if(isset($user['phone']) && !empty($user['phone']))
                            {
                        ?>
                                <a class="contact_info mt-2" href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?>
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
                    </div>
                </div>
                <div class="logo">
                    <div class="mr-90 text-right">
                        <div class="visit_us">Visit us online at 
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
                        <div class="address"><?php echo $user['company_add']; ?> <br><?php echo $user['company_city']; ?> <?php echo $user['company_state']; ?> <?php echo $user['company_zip']; ?></div>
                        <div class="licensed">Licensed in Oregon & Washington</div>
                    </div>
                    <div class="smaller_img">
                        <img src="https://i.ibb.co/yRKhwzj/Soldera-Gray-Txt-FINE-OUTLINE.png" alt="soldera">
                        <p class="copyright">Soldera Properties, Inc</p>
                    </div>
                    <img src="https://i.ibb.co/VQSTyxQ/footer-icons.png" alt="footer-icons" class="mini_icon">
                </div>
            </div>
            <p class="copyright">This is not intended to solicit currently listed properties. This information is deemed reliable, but not guaranteed.</p>
        </div>
        <div class="orange_footer">
            <?php 
                if(isset($user['website']) && !empty($user['website']))
                {
                    $parsed_url  = parse_url($user['website']);

                    $website = isset($parse_url['scheme']) && !empty($parse_url['scheme']) ? $parse_url['scheme'] : 'javascript:void(0);';
            ?>
                    <a href="<?php echo $website; ?>" target="_blank">
                        <?php echo $user['website']; ?>
                    </a>
            <?php
                }
            ?>
            AUTHENTICITY ABOVE ALL.
        </div>
    </page>
</body>