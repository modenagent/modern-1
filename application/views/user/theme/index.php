<?php
$check_dir = "assets/reports/english/$type/preview/$sub_type/";
$load_dir = FCPATH.$check_dir;

if(is_dir($load_dir)) {

  $images = glob($load_dir . "*.jpg");

  $count_imgs = count($images);

  for ($img_cnt=1; $img_cnt <= $count_imgs ; $img_cnt++) {
    echo '<div class="col-sm-2 cover-item"> <div class="text-center"> <img src="'.base_url().$check_dir.$img_cnt.'.jpg" class="img img-responsive" alt="'.$img_cnt.'"> </div></div>';
  }
}
?>