<body>
    <page class="market_update">
            <div class="market_update_hero">
                <h1>Market Update <span>Zip Code: <?php echo $zipCode; ?></span></h1> 
                <div class="d-flex mt-130">
                    <div class="col-50">
                        <h2>Curious about what<br>
                        your home can sell<br>
                        for FREE?</h2>
                    </div>
                    <div class="col-50">
                        <ul class="list-inline">
                            <?php 
                            // if(empty($cma_url)):
                                $cma_url = "https://modernagent.io/cma";
                            // endif;
                            $cma_url_display = preg_replace("(^https?://)", "", $cma_url );
                             ?>
                            <li><a href="<?php echo $cma_url; ?>"><img src="<?php echo base_url('assets/reports/english/marketUpdate/images/world.png');?>" alt="WWW"><?php echo $cma_url_display; ?></a></li>
                            <li><a href="<?php echo $cma_url; ?>"><img src="<?php echo base_url('assets/reports/english/marketUpdate/images/keyboard.png');?>" alt="Code">ENTER CODE:<span><?php echo $user['ref_code']; ?></span></a></li>
                        </ul>
                        <p>
                            To receive your complimentary sales report via<br>
                            TEXT MESSAGE.
                        </p>
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
                        <?php if(!empty($user['company_logo']) && is_file(FCPATH.'/'.$user['company_logo'])) : ?>
                            <img src="<?php echo base_url().$user['company_logo']; ?>" alt="companyname" border="0">
                        <?php endif; ?>
                        <!-- <img src="<?php echo base_url().'assets/reports/english/seller/images/1/white-logo.png'; ?>" alt="white-logo" border="0"> -->
                    </div>
                </div>
            </div>
    </page>
</body>