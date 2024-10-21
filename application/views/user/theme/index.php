<?php
$check_dir = "assets/reports/english/$type/preview/$sub_type/";
$load_dir = FCPATH . $check_dir;

if (is_dir($load_dir)) {
    if ($type != 'marketUpdate') {
        $images = glob($load_dir . "*.jpg");

        $count_imgs = count($images);

        for ($img_cnt = 1; $img_cnt <= $count_imgs; $img_cnt++) {
            // echo '<div class="col-sm-2 cover-item"> <div class="text-center"> <img src="'.base_url().$check_dir.$img_cnt.'.jpg" class="img img-responsive" alt="'.$img_cnt.'"> </div></div>';
            ?>
    <div class="col-lg-3 col-md-6">
      <?php if ($displayCheckbox) {?>
        <input type="checkbox" <?php if ($img_cnt <= 8) {echo 'checked';}?>  class="page-checkbox" id="page-<?php echo $img_cnt; ?>" value="<?php echo $img_cnt; ?>" name="pageNumber[]">
      <?php }?>
      <label class="theme_bg text-center" for="page-<?php echo $img_cnt; ?>">
        <img src="<?php echo base_url() . $check_dir . $img_cnt . '.jpg'; ?>" alt="..." class="img-fluid">
        <h5><?php echo 'Page ' . $img_cnt; ?></h5>
      </label>
    </div>
    <?php
}
    } else {
        for ($mu_i = 1; $mu_i <= 7; $mu_i++) {?>
  <div class="col-lg-3 col-md-6 market-update-wrapper">
      <input type="radio" <?php if ($mu_i == $sub_type) {echo 'checked';}?>  class="mu_radio marketupdate_theme_select" id="mu_page_<?php echo $mu_i; ?>" value="<?php echo $mu_i; ?>" name="cover_mu">

    <label class="theme_bg text-center" for="mu_page_<?php echo $mu_i; ?>">
      <img src="<?php echo base_url("assets/reports/english/marketUpdate/preview/{$mu_i}.jpg"); ?>" alt="..." class="img-fluid">
      <h5><?php echo 'Theme - ' . $mu_i; ?></h5>
    </label>
  </div>

<?php }
    }
}

?>
