<body>
    <page class="p-0 market_update">
        <div class="header-main">
            <div class="header">
                <!-- <img src="https://i.ibb.co/4823bQX/logo.png" alt="logo" class="logo"> -->

                <h1>MARKET UPDATE <span>ZIPCODE: <?php echo $zipCode; ?></span></h1>
            </div>

            <div class="hero">
                <div class="hero_caption">
                    <div class="image-inner">

                        <div class="qr-code-container">
                            <?php
$url = urlencode(base_url("cma/" . $user['ref_code']));
list($r, $g, $b) = sscanf("$theme", "#%02x%02x%02x");
$rgb_color_front = urlencode(json_encode(array($r, $g, $b)));
$rgb_color_back = urlencode(json_encode(array(255, 255, 255)));
$image = base_url("user/generate_qr_code/0/5/$rgb_color_back/$rgb_color_front?url=" . $url);
?>
                            <img src="<?php echo $image; ?>">

                        </div>
                        <div class="">
                            <p>
                                Scan above QR code to receive your complimentary sales report via text message
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="p-50">
            <table class="table_transparent">
                <tr>
                    <th>PROPERTY ADDRESS</th>
                    <th>SOLD FOR</th>
                    <th>SQFT</th>
                    <th>BEDS</th>
                    <th>BATHS</th>
                </tr>
                <?php if (sizeof($_comparables) > 0): ?>
                    <?php $avaiProperty = 0;
$i = 1;?>
                    <?php foreach ($_comparables as $key => $item): ?>
                        <?php
if ($key >= 8) {
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
                        <?php $avaiProperty++;
$i++;?>
                    <?php endforeach;?>
                <?php endif;?>
            </table>
        </div>

        <div class="footer">
            <div class="more_info">For more information, please contact me.</div>
            <div class="d-flex m-0">
                <div class="signature horizontal_sign">

                    <img src="<?php if ($callFromApi == 1) {
    echo $user['profile_image'];
} else {
    echo base_url() . $user['profile_image'];
}
?>" alt="<?php echo $user['fullname']; ?>" class="profile_img">
                    <div>
                        <?php
if (isset($user['fullname']) && !empty($user['fullname'])) {
    ?>
                                <div class="profile_name">
                                    <?php echo $user['fullname']; ?>
                                </div>
                        <?php
}
?>

                        <?php
if (isset($user['title']) && !empty($user['title'])) {
    ?>
                                <div class="profile_title">
                                    <?php echo $user['title']; ?>
                                </div>
                        <?php
}
?>
                        <div class="profile_title">&nbsp;</div>
                        <?php
if (isset($user['phone']) && !empty($user['phone'])) {
    ?>
                                <a class="contact_info mt-2" href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?>
                                </a>
                        <?php
}
?>

                        <?php
if (isset($user['email']) && !empty($user['email'])) {
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

                        <?php
$parsed_url = $_ENV['APP_URL'];

$company_display_url = preg_replace("(^https?://)", "", $parsed_url);
?>
                            <!-- <div class="visit_us">Visit us online at
                                <a href="<?php echo $parsed_url; ?>" target="_blank"class="contact_info">
                                    <?php echo $company_display_url; ?>
                                </a>
                            </div> -->

                        <div class="address"><?php echo $user['street']; ?> <br><?php echo $user['company_city']; ?> <?php echo $user['city']; ?> <?php echo $user['zip']; ?></div>
                        <!-- <div class="licensed">Licensed in Oregon & Washington</div> -->
                    </div>
                    <div class="smaller_img">
                        <img src="<?php echo base_url() . $user['company_logo']; ?>" alt="companyname">
                        <!-- <p class="copyright"><?php echo $user['companyname']; ?></p> -->
                    </div>
                    <img src="https://i.ibb.co/VQSTyxQ/footer-icons.png" alt="footer-icons" class="mini_icon">
                </div>
            </div>
            <p class="copyright">This is not intended to solicit currently listed properties. This information is deemed reliable, but not guaranteed.</p>
        </div>
        <div class="orange_footer">
            <?php
if (isset($user['company_url']) && !empty($user['company_url'])) {
    $parsed_url = parse_url($user['company_url']);

    $company_url = isset($parse_url['scheme']) && !empty($parse_url['scheme']) ? $parse_url['scheme'] : 'javascript:void(0);';
    ?>
                    <a href="<?php echo $company_url; ?>" target="_blank">
                        <?php echo $user['company_url']; ?>
                    </a>
            <?php
}
?>
            AUTHENTICITY ABOVE ALL.
        </div>
    </page>
</body>