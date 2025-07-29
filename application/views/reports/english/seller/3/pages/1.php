<?php
$site_address = $property->PropertyProfile->SiteAddress;

$city = ucwords(strtolower($property->PropertyProfile->SiteCity));
$state = strtoupper($property->PropertyProfile->SiteState);
$zip = strtoupper($property->PropertyProfile->SiteZip);

?>
<page class="pdf1">
    <div class="header">
        <img src="<?php echo base_url($user['company_logo']); ?>" alt="company_logo" border="0" class="company_logo" >
        <img src="<?php echo base_url() . 'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" border="0" class="line_break_img">
        <div class="text">
            <h3>Seller Report</h3>
            <?php
if (isset($site_address) && !empty($site_address)) {
    ?>
                    <p><?php echo ucwords(strtolower($site_address)) . ','; ?></p>
            <?php
}
?>

            <p><?php echo $city . ' ,' . $state . ' ' . $zip; ?></p>
        </div>
    </div>
    <div class="body" style="background-image: url(<?php echo base_url() . 'assets/reports/english/seller/images/1/architecture-modern-residence6.jpg'; ?>)">
        <!-- <img src="" alt="architecture-modern-residence6" class="img-fluid d-block">  -->
        <div class="footer">
            <div class="d-flex">
                <div class="signature horizontal_sign">
                    <?php if ($user['profile_image'] != '' && $user['profile_image'] != 'no') {?>
                        <img src="<?php echo (($callFromApi == 1) ? $user['profile_image'] : (base_url() . $user['profile_image'])); ?>" alt="<?php echo $user['fullname']; ?>" class="profile_img">
                    <?php }?>
                    <div class="profile_details"  style="padding: 10px;">
                        <?php if (isset($user['fullname']) && !empty($user['fullname'])) {?>
                            <div class="profile_name">
                                <?php echo $user['fullname']; ?>
                            </div>
                        <?php }?>

                        <?php if (isset($user['title']) && !empty($user['title'])) {?>
                            <div class="profile_title">
                                <?php echo $user['title']; ?>
                            </div>
                        <?php }?>

                        <?php if (isset($user['phone']) && !empty($user['phone'])) {?>
                                <a class="tel_number" href="tel:<?php echo $user['phone']; ?>">
                                    O <span><?php echo $user['phone']; ?></span>
                                </a>
                        <?php }?>

                        <?php /*
if(isset($user['mobile']) && !empty($user['mobile']))
{
?>
<a class="tel_number" href="tel:<?php echo $user['mobile']; ?>">
M <span><?php echo $user['mobile']; ?></span>
</a>
<?php
} */
?>

                        <?php if (isset($user['email']) && !empty($user['email'])) { ?>
                                <a href="mailto:<?php echo $user['email']; ?>" class="contact_info">
                                    <?php echo $user['email']; ?>
                                </a>
                        <?php } ?>

                        <?php
if (isset($user['website']) && !empty($user['website'])) {
    $parsed_url = parse_url($user['website']);

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
                    <img src="<?php echo base_url($user['company_logo']); ?>" alt="white-logo" border="0">
                </div>
            </div>
        </div>
    </div>
</page>