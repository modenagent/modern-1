<?php
$report_seller_data = null;
if(count($page_contents) && !empty($page_contents['seller'])) {
    $report_seller_data = $page_contents['seller'];
}
?>
<div class="config-page-modals c21-modals">
<!-- modal for Featured section -->
<div id="update-featured" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Featured List</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                      <label for="portfolio_txt">Change Portfolio Text</label>
                      <?php
                      $portfolio_txt = "With over $500 million in sales closed, I have the knowledge and experience to list your home.

I have had the pleasure of working with some of San Diego County's most beautiful homes. A first impression is everything in this world, especially in real estate. With my marketing plan, I bring in some of the best photographers in the business to shoot my listings. This will ensure that your home is shown with an elegant and luxurious look. 

Take a look at my most notable sales in San Diego:";
if(!empty($report_seller_data['portfolio_txt'])) {
    $portfolio_txt = $report_seller_data['portfolio_txt'];
}
                      ?>
                      <textarea name="page[portfolio_txt]" id="portfolio_txt" class="form-control more-page-config" style="height: 150px;"><?php echo $portfolio_txt; ?></textarea>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px">
                    <div class="col-sm-12">
                        <label>Featured Content</label>
                    </div>
                </div>
                <div class="row">
                  <?php
                  if(isset($page_contents) && count($page_contents) && !empty($page_contents['seller'])) {
                      $report_seller_data = $page_contents['seller'];
                      if(!empty($report_seller_data['featured_homes'])) {
                        $featured_homes = $report_seller_data['featured_homes'];
                      }
                  }
                  if(count($featured_homes)) {

                  
                  foreach ($featured_homes as $featured_i => $featured_home) { ?>
                     
                    <div class="col-md-6">
                      <div class="featured-div">
                        <label class="featured_img" for="featured_<?php echo $featured_i; ?>_image" style="background: url(<?php echo base_url($featured_home->image) ?>)">
                          <div><span>Change Image</span></div>
                          <input type="hidden" value="<?php echo $featured_home->image ?>" name="featured[<?php echo $featured_i ?>]['image_val']" id="featured_<?php echo $featured_i; ?>_image_val" class="featured_file" data-val="<?php echo $featured_i; ?>"/>
                          <input class="form-control featured_file_input" accept="image/*" type="file" name="featured[<?php echo $featured_i ?>]['image']" id="featured_<?php echo $featured_i; ?>_image" />
                        </label>
                        <div class="featured_inputs">
                        <input class="form-control" value="<?php echo $featured_home->price; ?>" placeholder="Price" type="text" name="featured[<?php echo $featured_i ?>]['price']" id="featured_<?php echo $featured_i; ?>_price" />
                        <input class="form-control" value="<?php echo $featured_home->address; ?>" placeholder="Street address" type="text" name="featured[<?php echo $featured_i ?>]['address']" id="featured_<?php echo $featured_i; ?>_address" />
                        <input class="form-control" value="<?php echo $featured_home->city; ?>" placeholder="City" type="text" name="featured[<?php echo $featured_i ?>]['city']" id="featured_<?php echo $featured_i; ?>_city" />
                        </div>
                      </div>
                    </div>
                  <?php } 
                  }
                  ?>
                    
                    
                </div>


            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal for Featured section -->
<!-- modal for Main Cover Page  -->
<div id="conf-cover-main" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Main Cover Page</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-sm-4" for="cover_prepared_for">Prepared For</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control more-page-config" name="page[cover_prepared_for]" id="cover_prepared_for" value="">
                              </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-4" for="cover_image">Cover Image</label>
                              <div class="col-sm-8">
                                <input type="file" id="cover_image" class="form-control config-file-change"/>
                                <?php
                                $cover_image_preview_val = '';
                                if(!empty($report_seller_data['cover_image']))
                                {
                                    $cover_image_preview_val = base_url($report_seller_data['cover_image']);
                                }?>
                                <input type="hidden" name="page[cover_image]" class="more-page-config config_file_value" value = "<?php echo $cover_image_preview_val;?>" />
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div>Current Image Preview</div>
                                <?php
                                $cover_image_preview = base_url('assets/reports/widget/'.$report_dir_name.'/seller/images/new.png');
                                if(!empty($report_seller_data['cover_image']))
                                {
                                    $cover_image_preview = base_url($report_seller_data['cover_image']);
                                }
                                ?>
                                <div class="widget_image_preview" style="background-image: url(<?php echo $cover_image_preview;?>);">
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default save_additional_data" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal for Main Cover Page  -->

<!-- modal for Cover Letter -->
<div id="conf-cover-letter" class="modal fade c21-txt-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cover Letter</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                      <label for="cover_letter">Change Cover Letter Text</label>
                      <?php
                      $cover_letter = 'Dear Sir/Madam:

Thank you very much for giving me the opportunity to present the enclosed proposal to market your home. I appreciate the time you spent with me reviewing the features of your home and outlining your financial goals and time considerations.

You will receive competent and professional service when you select me and CENTURY 21 Award to represent you. We have represented many families in this area concluding transactions that realize maximum value in a reasonable time. I hope you will select me as your agent in this very important transaction.

This proposal includes a comprehensive market analysis that will assist us in determining the market value and pricing of your home. I hope the information included on me and CENTURY 21 Award will confirm that I am best qualified to market your home.';
if(!empty($report_seller_data['cover_letter'])) {
    $cover_letter = $report_seller_data['cover_letter'];
}
                      ?>
                      <textarea name="page[cover_letter]" id="cover_letter" class="form-control more-page-config"><?php echo $cover_letter; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default save_additional_data" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal for Cover Letter -->

<!-- modal for Portfoio  -->
<div id="conf-portfolio-text" class="modal fade c21-txt-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Portfolio Text</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default save_additional_data" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal for Portfoio  -->

<!-- modal for Resume  -->
<div id="conf-resume-text" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Resume Content</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-sm-4" for="resume_award_no">Number Of Awards</label>
                              <div class="col-sm-8">
                                <?php
                                $resume_award_no = 5;
                                if(!empty($report_seller_data['resume_award_no'])) {
                                    $resume_award_no = $report_seller_data['resume_award_no'];
                                }
                                ?>
                                <input type="text" class="form-control more-page-config" name="page[resume_award_no]" id="resume_award_no" value="<?php echo $resume_award_no;?>">
                              </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-4" for="resume_award_list">Award List</label>
                              <div class="col-sm-8">
                                <?php
                                $resume_award_list = 'Award 1 2018
Award 2 2019
Award 3 2020
Award 4 2021
Award 5 2021';
                                if(!empty($report_seller_data['resume_award_list'])) {
                                    $resume_award_list = $report_seller_data['resume_award_list'];
                                }
                                ?>
                                <textarea class="form-control more-page-config" name="page[resume_award_list]" id="resume_award_list" style="height: 150px;"><?php echo $resume_award_list;?></textarea>
                              </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-4" for="resume_years_no">Number Of Years</label>
                              <div class="col-sm-8">
                                <?php
                                $resume_years_no = 7;
                                if(!empty($report_seller_data['resume_years_no'])) {
                                    $resume_years_no = $report_seller_data['resume_years_no'];
                                }
                                ?>
                                <input type="text" class="form-control more-page-config" name="page[resume_years_no]" id="resume_years_no" value="<?php echo $resume_years_no;?>">
                              </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-4" for="resume_volume">Volume</label>
                              <div class="col-sm-8">
                                <?php
                                $resume_volume = '$100,000,000+';
                                if(!empty($report_seller_data['resume_volume'])) {
                                    $resume_volume = $report_seller_data['resume_volume'];
                                }
                                ?>
                                <input type="text" class="form-control more-page-config" name="page[resume_volume]" id="resume_volume" value="<?php echo $resume_volume;?>">
                              </div>
                        </div>
                      
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default save_additional_data" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal for Resume  -->

<!-- modal for Social Media  -->
<div id="conf-social-media" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Social Media Content</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                            <div class="row form-group">
                                <div class="col-md-12">
                                  <label for="social_intro_txt">Change Intro Text</label>
                                  <?php
                                  $social_intro_txt = "Millions of people use social media channels like Facebook®, Twitter®, YouTube®, and lnstagram® daily. As your agent, I will utilize my strong Social Media presence to promote your property listing to a wide audience, in the right area at the right time.";
                                  if(!empty($report_seller_data['social_intro_txt'])) {
                                    $social_intro_txt = $report_seller_data['social_intro_txt'];
                                    }
                                  ?>
                                  <textarea name="page[social_intro_txt]" id="social_intro_txt" class="form-control more-page-config" style="height: 100px"><?php echo $social_intro_txt; ?></textarea>
                                </div>
                            </div>



                        <div class="row form-group">
                              <div class="col-sm-4">
                                <?php
                                $social_txt1 = '2100';
                                if(!empty($report_seller_data['social_txt1'])) {
                                    $social_txt1 = $report_seller_data['social_txt1'];
                                }
                                ?>
                                <input type="text" class="form-control more-page-config" name="page[social_txt1]" id="social_txt1" value="<?php echo $social_txt1;?>">
                              </div>
                            <label class="col-sm-8" for="social_txt1">followers on Instagram</label>
                        </div>

                        <div class="row form-group">
                              <div class="col-sm-4">
                                <?php
                                $social_txt2 = '87';
                                if(!empty($report_seller_data['social_txt2'])) {
                                    $social_txt2 = $report_seller_data['social_txt2'];
                                }
                                ?>
                                <input type="text" class="form-control more-page-config" name="page[social_txt2]" id="social_txt2" value="<?php echo $social_txt2;?>">
                              </div>
                            <label class="col-sm-8" for="social_txt2">average reach on Instagram</label>
                        </div>

                        <div class="row form-group">
                              <div class="col-sm-4">
                                <?php
                                $social_txt3 = '2100';
                                if(!empty($report_seller_data['social_txt3'])) {
                                    $social_txt3 = $report_seller_data['social_txt3'];
                                }
                                ?>
                                <input type="text" class="form-control more-page-config" name="page[social_txt3]" id="social_txt3" value="<?php echo $social_txt3;?>">
                              </div>
                            <label class="col-sm-8" for="social_txt3">followers on  Facebook</label>
                        </div>

                        <div class="row form-group">
                              <div class="col-sm-4">
                                <?php
                                $social_txt4 = '2100';
                                if(!empty($report_seller_data['social_txt4'])) {
                                    $social_txt4 = $report_seller_data['social_txt4'];
                                }
                                ?>
                                <input type="text" class="form-control more-page-config" name="page[social_txt4]" id="social_txt4" value="<?php echo $social_txt4;?>">
                              </div>
                            <label class="col-sm-8" for="social_txt4">followers on Twitter</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default save_additional_data" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal for Social Media  -->

<!-- modal for Social Ad Report  -->
<div id="conf-social-ad" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Social Ad Report Content</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="socail-ad-title">
                                    <span>Ad Report Text</span> 
                                </div>
                            </div>
                        </div>
                        <div class="row social-ad-text">
                            <div class="col-sm-4 form-group">
                                  <div class="col-sm-6">
                                    <?php
                                    $social_ad_reach = '2100';
                                    if(!empty($report_seller_data['social_ad_reach'])) {
                                        $social_ad_reach = $report_seller_data['social_ad_reach'];
                                    }
                                    ?>
                                    <input type="text" class="form-control more-page-config" name="page[social_ad_reach]" id="social_ad_reach" value="<?php echo $social_ad_reach;?>">
                                  </div>
                                <label class="col-sm-6" for="social_ad_reach">REACH</label>
                            </div>

                            <div class="col-sm-4 form-group">
                                  <div class="col-sm-6">
                                    <?php
                                    $social_ad_imp = '87';
                                    if(!empty($report_seller_data['social_ad_imp'])) {
                                        $social_ad_imp = $report_seller_data['social_ad_imp'];
                                    }
                                    ?>
                                    <input type="text" class="form-control more-page-config" name="page[social_ad_imp]" id="social_ad_imp" value="<?php echo $social_ad_imp;?>">
                                  </div>
                                <label class="col-sm-6" for="social_ad_imp">IMPRESSIONS</label>
                            </div>

                            <div class="col-sm-4 form-group">
                                  <div class="col-sm-6">
                                    <?php
                                    $social_ad_leads = '2100';
                                    if(!empty($report_seller_data['social_ad_leads'])) {
                                        $social_ad_leads = $report_seller_data['social_ad_leads'];
                                    }
                                    ?>
                                    <input type="text" class="form-control more-page-config" name="page[social_ad_leads]" id="social_ad_leads" value="<?php echo $social_ad_leads;?>">
                                  </div>
                                <label class="col-sm-6" for="social_ad_leads">LEADS</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="socail-ad-title">
                                    <span>Ad Report Images</span> 
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <?php for ($img_tmp=1; $img_tmp <=7 ; $img_tmp++) :
                            $img_dynamic_name= 'social_ad_img_'.$img_tmp;
                                ?>

                            <div class="col-sm-4">

                                <div class="img_pre_div"> 
                                    <div class="row"> 

                                <label class="col-sm-4" for="social_ad_img_<?php echo $img_tmp;?>">Image <?php echo $img_tmp; ?></label>
                                  <div class="col-sm-8">
                                    <input type="file" id="social_ad_img_<?php echo $img_tmp;?>" class="form-control config-file-change"/>
                                    <?php
                                    $social_ad_img_1_preview_val = '';
                                    if(!empty($report_seller_data[$img_dynamic_name]))
                                    {
                                        $social_ad_img_1_preview_val = base_url($report_seller_data[$img_dynamic_name]);
                                    }?>
                                    <input type="hidden" name="page[<?php echo $img_dynamic_name; ?>]" class="more-page-config config_file_value" value = "<?php echo $social_ad_img_1_preview_val;?>" />
                                  </div>

                                <div class="col-sm-12"> 
                                
                                <div class="preview_title">Current Image <?php echo $img_tmp; ?> Preview</div>
                                <?php
                                $social_ad_img_1 = base_url('assets/reports/widget/'.$report_dir_name.'/'.'seller'.'/images/img'.$img_tmp.'.png');
                                if(!empty($report_seller_data[$img_dynamic_name]))
                                {
                                    $social_ad_img_1 = base_url($report_seller_data[$img_dynamic_name]);
                                }
                                ?>
                                <div class="widget_image_preview" style="background-image: url(<?php echo $social_ad_img_1;?>);">
                                </div>

                                </div>
                                </div>
                            </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default save_additional_data" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal for Social Ad Report  -->
</div>
<style type="text/css">
    .c21-txt-modal textarea {
        height: 400px;
        width: 100%;
    }
    .widget_image_preview {
        height: 300px;
        background-repeat: no-repeat;
        background-size: contain;
    }
    .social-ad-text label {
        margin-top: 10px;
    }
    #cma-widget-container #conf-resume-text .form-group input {
        letter-spacing: initial;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
    }
    .socail-ad-title {
        margin: 15px;
        font-size: 18px;
        border-bottom: 1px solid;
        padding: 5px;
    }
    .preview_title {
        margin: 15px 0px;
    }
    .img_pre_div {
        border: 1px solid;
        padding: 10px;
        margin-top: 10px;
    }
    .img_pre_div .widget_image_preview {
        height: 150px;
    }
</style>