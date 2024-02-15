<style>
    .myaccount_tabs .nav li {
        width: 50%;
    }
    .input-margin {
        margin: 0 auto;
    }

    #retsForm .form-control, #blackKnightParamsForm .form-control {
        appearance: auto;
    }

</style>
<!-- My Account section -->
<section class="myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="main_title">Adjust Parameters</h1>
          <!-- <p class="subline">Below you can update the following: Agent info, company info, set a default theme, and update your login info.</p> -->
      </div>
    </div>
    <div class="myaccount_tabs">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php if ($active_tab == 'black_knight') {echo 'active';}?>" id="black_knight-tab" data-bs-toggle="tab" href="#black_knight" role="tab" aria-controls="black_knight" aria-selected="true">
                    <b>Adjust Past Sales</b>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php if ($active_tab == 'rets') {echo 'active';}?>" id="rets-tab" data-bs-toggle="tab" href="#rets" role="tab" aria-controls="rets" aria-selected="true">
                    <b>Adjust Currently Listed.</b>
                </a>
            </li>
        </ul>
        <div class="loader1 hidden lp-loader1-myaccount"><img src="<?php echo base_url(); ?>assets/images/gears.gif"></div>
            <div class="backwrap hidden"></div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade <?php if ($active_tab == 'black_knight') {echo 'show active';}?>" id="black_knight" role="tabpanel" aria-labelledby="black_knight-tab">
                        <div class="tab_white_box">
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success! </strong>
                                    <?php echo $this->session->flashdata('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif;?>
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Error! </strong>
                                    <?php echo $this->session->flashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif;?>
                            <h2 class="mini_title">Adjust Parameters</h2>

                            <div class="agent_info_form">
                                <form id="blackKnightParamsForm"  action="<?php echo base_url('user/saveAdjustmentParams') ?>" method="post">
                                    <input type="text" class="hidden" id="req_type" name="req_type" value="black_knight" />
                                    <div class="row">
                                        <div class="col-md-8 input-margin">
                                            <label for="exampleInputEmail1">Radius</label>
                                            <select class="form-control" id="radius" placeholder="Radius" name="black_knight_radius">
                                                <?php foreach ($radiusAdjustment as $key => $val): ?>
                                                <option <?=(!empty($parameters) && !empty($parameters->black_knight_radius) && $key == $parameters->black_knight_radius) ? 'selected' : ''?> value="<?=$key?>" placeholder="Square Feets"><?=$val?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 input-margin">
                                            <label for="exampleInputEmail1">Square Feets</label>
                                            <select class="form-control" id="sqft" name="black_knight_sqft">
                                                <?php foreach ($sqft as $key => $val): ?>
                                                <option <?=(!empty($parameters) && !empty($parameters->black_knight_sqft) && $key == $parameters->black_knight_sqft) ? 'selected' : ''?> value="<?=$key?>" placeholder="Square Feets"><?=$val?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 input-margin">
                                            <label for="exampleInputEmail1">Baths</label>
                                            <input class="form-control" type="number" onkeydown="if(event.key==='.'){event.preventDefault();}" id="baths" name="black_knight_baths" value="<?=$parameters->black_knight_baths?>"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 input-margin">
                                            <label for="exampleInputEmail1">Bedrooms</label>
                                            <input class="form-control" type="number" onkeydown="if(event.key==='.'){event.preventDefault();}" id="bedrooms" name="black_knight_beds" value="<?=$parameters->black_knight_beds?>"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-lp save" id="" value="Save" />
                                            <div class="alert alert-success" style="display:none"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade <?php if ($active_tab == 'rets') {echo 'show active';}?>" id="rets" role="tabpanel" aria-labelledby="rets-tab">
                        <div class="tab_white_box">
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success! </strong>
                                    <?php echo $this->session->flashdata('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif;?>
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Error! </strong>
                                    <?php echo $this->session->flashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif;?>
                            <h2 class="mini_title">Adjust Parameters</h2>

                            <div class="agent_info_form">
                                <form id="retsForm"  action="<?php echo base_url('user/saveAdjustmentParams') ?>" method="post">
                                    <input type="text" class="hidden" id="req_type" name="req_type" value="rets" />
                                    <div class="row">
                                        <div class="col-md-8 input-margin">
                                            <label for="exampleInputEmail1">Radius</label>
                                            <select class="form-control" id="radius" placeholder="Radius" name="rets_radius">
                                                <?php foreach ($radiusAdjustment as $key => $val): ?>
                                                <option <?=(!empty($parameters) && !empty($parameters->rets_radius) && $key == $parameters->rets_radius) ? 'selected' : ''?> value="<?=$key?>" ><?=$val?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 input-margin">
                                            <label for="exampleInputEmail1">Square Feets</label>
                                            <select class="form-control" id="sqft" name="rets_sqft">
                                                <?php foreach ($sqft as $key => $val): ?>
                                                <option <?=(!empty($parameters) && !empty($parameters->rets_sqft) && $key == $parameters->rets_sqft) ? 'selected' : ''?> value="<?=$key?>" placeholder="Square Feets"><?=$val?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8 input-margin">
                                            <label for="exampleInputEmail1">Baths</label>
                                            <input class="form-control" type="number" onkeydown="if(event.key==='.'){event.preventDefault();}" id="baths" name="rets_baths" value="<?=$parameters->rets_baths?>"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 input-margin">
                                            <label for="exampleInputEmail1">Bedrooms</label>
                                            <input class="form-control" type="number" onkeydown="if(event.key==='.'){event.preventDefault();}" id="bedrooms" name="rets_beds" value="<?=$parameters->rets_beds?>"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-lp save" id="" value="Save" />
                                            <div class="alert alert-success" style="display:none"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
<!-- My Account section -->
