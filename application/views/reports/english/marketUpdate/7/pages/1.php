<body>
    <div class="page_container">
        <div class="pdf_page size_letter">
            <div class="pdf_header">
                <h1>HOMES FOR SALE</h1>
                <div class="header-subtext">SURROUNDING: <?php echo $propertyAddress . ',' . $propertyCity . ',' . $propertyState; ?></div>
                <?php if (!empty($user['company_logo']) && is_file(FCPATH . '/' . $user['company_logo'])): ?>
                <img src="<?php echo base_url() . $user['company_logo']; ?>" alt="companyname" border="0" alt="sign-white">
                <?php endif;?>
                <!-- <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/images/sign-white.png'); ?>" class="pacific_logo" alt="sign-white"> -->
            </div>
            <div class="pdf_body">
            <?php if (sizeof($_comparables) > 0): ?>
                        <?php $avaiProperty = 0;
$i = 1;?>
                        <?php foreach ($_comparables as $key => $item): ?>
                            <?php if ($key > 8) {break;}?>
                <div class="grid listing-grid">
                    <div class="col-9">
                        <div class="grid border-bottom">
                            <div class="col-6">
                                <h5 class="count">SALES PRICE</h5>
                                <h4>$<?php echo $item['Price']; ?></h4>
                            </div>
                            <div class="col-6">
                            <p><?php echo $item['Address']; ?><br> <?php echo $item['cityState']; ?></p>
                                <h5>
                                    <?php echo $item['Beds']; ?> BEDS | <?php echo $item['Baths']; ?> BATHS | <?php echo $item['SquareFeet']; ?>SQFT
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <?php if (!empty($item['img'])): ?>
			                	<img src="<?php echo $value['img']; ?>" class="img-fluid" alt="<?php echo $value['Address']; ?>">
                                <img src="<?php echo $value['img']; ?>" class="img-fluid" alt="<?php echo $value['Address']; ?>">
                        <?php else: ?>
			                <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=14&size=180x100&maptype=roadmap&markers=color:0x<?php echo str_replace("#", "", $theme) ?>%7Clabel:O%7C<?php echo $value['Latitude'] . ',' . $value['Longitude']; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg"  class="img-fluid">
                        <?php endif;?>
                    </div>
                </div>
                <?php if ($i === 4): ?>
                    <div style="page-break-after:always"></div>
                <?php endif;?>
                <?php $avaiProperty++;
$i++;?>
                        <?php endforeach;?>
                    <?php endif;?>
                <!-- <div class="grid listing-grid">
                    <div class="col-9">
                        <div class="grid border-bottom">
                            <div class="col-6">
                                <h5 class="count">SALES PRICE</h5>
                                <h4>$589,000</h4>
                            </div>
                            <div class="col-6">
                                <p>12312 Massachussets Blvd.<br> Los Angeles, CA</p>
                                <h5>
                                    4 BEDS | 3 BATHS | 1,890SQFT
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/images/home2.png'); ?>" alt="home1">
                    </div>
                </div>
                <div class="grid listing-grid">
                    <div class="col-9">
                        <div class="grid border-bottom">
                            <div class="col-6">
                                <h5 class="count">SALES PRICE</h5>
                                <h4>$589,000</h4>
                            </div>
                            <div class="col-6">
                                <p>12312 Massachussets Blvd.<br> Los Angeles, CA</p>
                                <h5>
                                    4 BEDS | 3 BATHS | 1,890SQFT
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/images/home3.png'); ?>" alt="home1">
                    </div>
                </div>
                <div class="grid listing-grid">
                    <div class="col-9">
                        <div class="grid border-bottom">
                            <div class="col-6">
                                <h5 class="count">SALES PRICE</h5>
                                <h4>$589,000</h4>
                            </div>
                            <div class="col-6">
                                <p>12312 Massachussets Blvd.<br> Los Angeles, CA</p>
                                <h5>
                                    4 BEDS | 3 BATHS | 1,890SQFT
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/images/home4.png'); ?>" alt="home1">
                    </div>
                </div> -->
                <h4 class="text-right">FIND OUT WHAT YOUR<br>HOME IS WORTH?</h4>
            </div>
            <div class="pdf_footer">
                <div class="grid">
                    <div class="col-6">
                        <div class="media-object">
                            <img src="<?php if ($callFromApi == 1) {echo $user['profile_image'];} else {echo base_url() . $user['profile_image'];}?>" alt="<?php echo $user['fullname']; ?>" class="profile_img">
                            <!-- <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/images/ZoeNoelleSmall.png'); ?>" alt=""> -->
                            <div>
                                <?php if (isset($user['fullname']) && !empty($user['fullname'])) {?>
                                    <div class="zoe-name">
                                        <?php echo $user['fullname']; ?>
                                    </div>
                                <?php }?>
                                <!-- <div class="zoe-name">Zoe Noelle</div> -->
                                <div class="contact-detail">
                                    DRE#2323434<br>
                                    <?php if (isset($user['phone']) && !empty($user['phone'])) {?>
                                        <a class="tel_number" href="tel:<?php echo $user['phone']; ?>">
                                            O <span><?php echo $user['phone']; ?></span>
                                        </a>
                                    <?php }?>
                                    <!-- <a href="tel:(000) 000-0000">(000) 000-0000</a> -->
                                    <!-- <a href="mailto:Zoe@zoenoelle.com">Zoe@zoenoelle.com</a> -->
                                    <?php if (isset($user['email']) && !empty($user['email'])) {?>
                                        <a href="mailto:<?php echo $user['email']; ?>" class="contact_info">
                                            <?php echo $user['email']; ?>
                                        </a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-20">
                        <div class="grid">
                            <div class="col-8">
                                <p class="body-text barcode-text">
                                    <em>
                                        <b>
                                            Scan to view your<br>
                                            home’s value<br>
                                            instantly.
                                        </b>
                                    </em>
                                </p>
                            </div>
                            <div class="col-4 pr-20">
                            <?php
$url = urlencode(base_url("cma/" . $user['ref_code']));
list($r, $g, $b) = sscanf($theme, "#%02x%02x%02x");
$rgb_color_front = urlencode(json_encode(array($r, $g, $b)));
$rgb_color_back = urlencode(json_encode(array(255, 255, 255)));
$image = base_url("user/generate_qr_code/0/5/$rgb_color_back/$rgb_color_front?url=" . $url);
?>
                                <img src="<?php echo $image; ?>"  alt="barcode" class="barcode-img">
                                <!-- <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/barcode.png'); ?>" alt="barcode" class="barcode-img"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
