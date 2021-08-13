<div class="config-page-modals c21-modals">
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
                                <input type="hidden" name="page[cover_image]" class="more-page-config config_file_value" value = "" />
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div>Current Image Preview</div>
                                <div class="cover_image_preview" style="background-image: url(<?php echo base_url('assets/reports/widget/'.$report_dir_name.'/seller/images');?>/new.png);">
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
                      <textarea name="page[cover_letter]" id="cover_letter" class="form-control more-page-config">Dear Sir/Madam:

Thank you very much for giving me the opportunity to present the enclosed proposal to market your home. I appreciate the time you spent with me reviewing the features of your home and outlining your financial goals and time considerations.

You will receive competent and professional service when you select me and CENTURY 21 Award to represent you. We have represented many families in this area concluding transactions that realize maximum value in a reasonable time. I hope you will select me as your agent in this very important transaction.

This proposal includes a comprehensive market analysis that will assist us in determining the market value and pricing of your home. I hope the information included on me and CENTURY 21 Award will confirm that I am best qualified to market your home.</textarea>
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
                <div class="row">
                    <div class="col-md-12">
                      <label for="portfolio_txt">Change Portfolio Text</label>
                      <textarea name="page[portfolio_txt]" id="portfolio_txt" class="form-control more-page-config">With over $500 million in sales closed, I have the knowledge and experience to list your home.

I have had the pleasure of working with some of San Diego County's most beautiful homes. A first impression is everything in this world, especially in real estate. With my marketing plan, I bring in some of the best photographers in the business to shoot my listings. This will ensure that your home is shown with an elegant and luxurious look. 

Take a look at my most notable sales in San Diego:
</textarea>
                    </div>
                </div>
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
                                <input type="text" class="form-control more-page-config" name="page[resume_award_no]" id="resume_award_no" value="5">
                              </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-4" for="resume_award_list">Award List</label>
                              <div class="col-sm-8">
                                <textarea class="form-control more-page-config" name="page[resume_award_list]" id="resume_award_list" style="height: 150px;">Award 1 2018
Award 2 2019
Award 3 2020
Award 4 2021
Award 5 2021</textarea>
                              </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-4" for="resume_years_no">Number Of Years</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control more-page-config" name="page[resume_years_no]" id="resume_years_no" value="7">
                              </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-4" for="resume_volume">Volume</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control more-page-config" name="page[resume_volume]" id="resume_volume" value="$100,000,000+">
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
</div>
<style type="text/css">
    .c21-txt-modal textarea {
        height: 400px;
        width: 100%;
    }
    .cover_image_preview {
        height: 300px;
        background-repeat: no-repeat;
        background-size: contain;
    }
    #cma-widget-container #conf-resume-text .form-group input {
        letter-spacing: initial;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
    }
</style>