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
                            <li class="mb-2"><a href="https://modernagent.io/cma"><img src="https://i.ibb.co/5KWxJxL/world.png" alt="WWW">
                                    modernagent.io/cma</a></li>
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
                <?php 
                    if(isset($comparables) && !empty($comparables))
                    {
                        $count = 0;

                        foreach ($comparables as $key => $value) 
                        {
                            if($key > 8)
                            {
                                break;
                            }
                ?>
                            <tr>
                                <td><?php echo $value['Address']; ?></td>
                                <td><?php echo $value['Price']; ?></td>
                                <td><?php echo $value['SquareFeet']; ?></td>
                                <td><?php echo $value['Beds']; ?></td>
                                <td><?php echo $value['Baths']; ?></td>
                            </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </div>

        <div class="footer">
            <div class="more_info">For more information, please contact me.</div>
            <div class="d-flex m-0">
                <div class="signature horizontal_sign">
                    <?php 
                        if($user['profile_image'] != '' && $user['profile_image'] != 'no')
                        {
                    ?>
                            <img src="<?php echo base_url().$user['profile_image']; ?>" alt="profile-pic" class="profile_img">
                    <?php
                        }
                    ?>
                    
                    <div>
                        <div class="profile_name"><?php echo $user['fullname']; ?></div>
                        <div class="profile_title"><?php echo $user['title']; ?></div>
                        <div class="profile_title">&nbsp;</div>
                        <a class="contact_info mt-2" href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></a>
                        <a href="mailto:<?php echo $user['email']; ?>" class="contact_info"><?php echo $user['email']; ?></a>
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
                        <div class="address">Address <br>City STATE Zip</div>
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
            <a href="http://dawncordiner.com">dawncordiner.com</a>
            AUTHENTICITY ABOVE ALL.
        </div>
    </page>
</body>