<body>
    <page class="market_update">
            <div class="market_update_hero">
                <h1>Market Update <span>Zip Code: <?php echo $zipCode; ?></span></h1> 
                <div class="d-flex mt-30">
                    <div class="col-50">
                        <h2>Curious about what
                        your home can sell
                        for FREE?</h2>
                        <p class="infor-line">
                            To receive your complimentary sales report via text message, scan the QR code with your smart phone.
                        </p>
                    </div>
                    <div class="col-50">
                        
                        <div class="qr-code-container">
                            <?php
                            $url = urlencode(base_url("cma/".$user['ref_code']));
                            list($r, $g, $b) = sscanf($theme, "#%02x%02x%02x");
                            $rgb_color_front =  urlencode(json_encode(array($r,$g,$b)));
                            $rgb_color_back =  urlencode(json_encode(array(255,255,255)));
                            $image = base_url("user/generate_qr_code/0/5/$rgb_color_back/$rgb_color_front?url=".$url);
                            ?>
                            <img src="<?php echo $image; ?>">
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>

            <div class="market_update_table">
                <table>

                    <tr>
                        <th>PROPERTY ADDRESS</th>
                        <th>SALE PRICE</th>
                        <th>SQFT</th>
                        <th>BEDS</th>
                        <th>BATHS</th>
                    </tr>
                    <?php
                        // if($use_rets_api == 1)
                        // {
                        //     $_comparables = $mls_comparables;
                        // }
                        
                    ?>
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
                        </div>
                    </div>
                    <div class="logo">
                        <?php if(!empty($user['company_logo']) && is_file(FCPATH.'/'.$user['company_logo'])) : ?>
                            <img src="<?php echo base_url().$user['company_logo']; ?>" alt="companyname" border="0">
                        <?php endif; ?>
                        <p class="copyright">This is not intended to solicit currently listed properties. This information is deemed reliable, but not guaranteed.</p>
                        <!-- <img src="<?php echo base_url().'assets/reports/english/seller/images/1/white-logo.png'; ?>" alt="white-logo" border="0"> -->
                    </div>
                </div>
            </div>
    </page>
</body>