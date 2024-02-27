<body>
    <div class="page_container">
        <div class="pdf_page size_letter">
            <div class="pdf_header">
                <div class="red_text">APRIL 2024</div>
                <h1>MARKET UPDATE</h1>
                <div class="red_text">ZIPCODE <?php echo $zipCode; ?></div>
                <?php if (!empty($user['company_logo']) && is_file(FCPATH . '/' . $user['company_logo'])): ?>
                    <img src="<?php echo base_url() . $user['company_logo']; ?>" alt="companyname" border="0" class="pacific_logo" alt="company logo">
                <?php endif;?>
                <!-- <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/images/sign-white.png'); ?> " class="pacific_logo" alt="sign-white"> -->
            </div>
            <div class="pdf_body">
                <div class="grid listing-grid">
                    <div class="col-4">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/listing.png'); ?>" alt="listing">
                        <div class="count">45</div>
                        <h4>New Listings</h4>
                    </div>
                    <div class="col-4">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/listing.png'); ?>" alt="listing">
                        <div class="count">45</div>
                        <h4>New Listings</h4>
                    </div>
                    <div class="col-4">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/listing.png'); ?>" alt="listing">
                        <div class="count">45</div>
                        <h4>New Listings</h4>
                    </div>
                </div>
                <div class="grid listing-grid">
                    <div class="col-4">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/listing.png'); ?>" alt="listing">
                        <div class="count">45</div>
                        <h4>New Listings</h4>
                    </div>
                    <div class="col-4">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/listing.png'); ?>" alt="listing">
                        <div class="count">45</div>
                        <h4>New Listings</h4>
                    </div>
                    <div class="col-4">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/listing.png'); ?>" alt="listing">
                        <div class="count">45</div>
                        <h4>New Listings</h4>
                    </div>
                </div>
                <div class="grid listing-grid no-border">
                    <div class="col-4">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/listing.png'); ?>" alt="listing">
                        <div class="count">45</div>
                        <h4>New Listings</h4>
                    </div>
                    <div class="col-4">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/listing.png'); ?>" alt="listing">
                        <div class="count">45</div>
                        <h4>New Listings</h4>
                    </div>
                    <div class="col-4">
                        <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/listing.png'); ?>" alt="listing">
                        <div class="count">45</div>
                        <h4>New Listings</h4>
                    </div>
                </div>
                <p class="body-text">
                    Unlock Your Home’s Hidden Value! Scan this QR code now to discover the current market value of your
                    property. Get the insights you need to make informed decisions. Don’t miss out on potential opportunities
                    know your home’s worth today!”
                </p>
            </div>
            <div class="pdf_footer">
                <div class="grid footer-margin">
                    <div class="col-6">
                        <div class="media-object">
                            <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/images/ZoeNoelleSmall.png'); ?> " alt="">
                            <div>
                                <?php if (isset($user['fullname']) && !empty($user['fullname'])) {?>
                                    <div class="zoe-name">
                                        <?php echo $user['fullname']; ?>
                                    </div>
                                <?php }?>
                                <div class="contact-detail">
                                    <?php if (isset($user['licenceno']) && !empty($user['licenceno'])) {?>
                                        <?php echo $user['licenceno']; ?>
                                    <?php }?>
                                    <br>
                                    <?php if (isset($user['phone']) && !empty($user['phone'])) {?>
                                        <a class="tel_number" href="tel:<?php echo $user['phone']; ?>">
                                            <span><?php echo $user['phone']; ?></span>
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
