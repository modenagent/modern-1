<body>
    <page class="p-0 market_update">
        <div class="header">
            <div class="logo_container">
                <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/big-c21.png" alt="logo" class="logo">
            </div>

            <h1>MARKET UPDATE <span>ZIPCODE:<?php echo $zipCode; ?></span></h1>
        </div>
        <div class="hero">
            <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/hero.png" alt="hero" class="img_fluid">
            <div class="hero_caption">
                <div class="d-flex">
                    <div class="col-60">
                        <p>
                            <?php 
                            if(empty($cma_url)):
                                $cma_url = "https://modernagent.io/cma";
                            endif;
                            $cma_url_display = preg_replace("(^https?://)", "", $cma_url );
                             ?>
                            To receive a free home comparison price analysis<br>
                            via text message, go to <a href="<?php echo $cma_url;?>" target="_blank"><?php $cma_url_display; ?></a><br>
                            and enter my reference code.
                        </p>
                    </div>
                    <div class="col-40">
                        <ul class="list-inline">
                            <li class="mb-2"><a href="<?php echo $cma_url;?>"  target="_blank"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/world.png" alt="WWW">
                                    <?php echo strtoupper($cma_url_display); ?></a></li>
                            <li><a href="#"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/keyboard.png" alt="Code"><span>ENTER CODE:</span><br><?php echo $user['ref_code']; ?></a></li>
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
                            if($key>=8){
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
                    <?php
                    if($user['profile_image'] != '' && $user['profile_image'] != 'no') {?>

                    <img src="<?php echo base_url().$user['profile_image']; ?>" alt="..." class="profile_img">
                    <?php }
                    ?>
                    <div>
                        <div class="profile_name"><?php echo (!empty($user['first_name']) || !empty($user['last_name'])) ?  $user['first_name'].' '.$user['last_name']  : (!empty($user['fullname']) ?  $user['fullname'] : '-'); ?>
                        </div>
                        <div class="profile_title"><?php if(isset($user['title']) && !empty($user['title'])) {echo $user['title'];}?></div>
                        <!-- <a href="#" class="contact_info mt-3">DRE# 000000</a> -->
                        <?php 
                        if(isset($user['mobile']) && !empty($user['mobile'])) {
                        ?>
                        <a class="contact_info" href="tel:<?php echo $user['mobile']; ?>"><?php echo $user['mobile']; ?></a><br>
                        <?php }
                        elseif(isset($user['phone']) && !empty($user['phone'])) {
                        ?>
                        <a class="contact_info" href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></a><br>
                        <?php }?>

                        <?php 
                        if(isset($user['email']) && !empty($user['email'])) {
                        ?>
                        <a class="contact_info" href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a><br>
                        <?php }?>

                    </div>
                </div>
                <div class="logo">
                    <div class="text-right">
                        <a href="https://century21award.com" target="_blank"><img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/c21-award.png" alt="c21-award"></a>
                        <div class="visit_us">Visit us online at <a href="https://century21award.com" target="_blank">century21award.com</a></div>
                        <div class="address"><?php echo $user['company_add']; ?> <br><?php echo $user['company_city'].' ,'; ?><?php echo $user['company_state']; ?> <?php echo $user['company_zip']; ?></div>
                        <img src="<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/'.$presentation_type.'/images');?>/footer-icon.png" alt="footer-icons" class="mini_icon">
                    </div>
                </div>
            </div>         
            <p class="copyright">This is not intended to solicit currently listed properties. This information is deemed reliable, but not guaranteed.</p>
        </div>
        <div class="orange_footer">
            <div class="d-flex">
                <div class="col-65">
                    <a href="https://century21award.com/" target="_blank">century21award.com</a>
                </div>
                <div class="col-35" >
                    <span>EXPERIENCE THE DIFFERENCE</span>
                </div>
            </div>
        </div>
    </page>
</body>
