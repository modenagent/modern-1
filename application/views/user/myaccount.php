
<!-- My Account section -->
<section class="myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="main_title">My Account</h1>
          <p class="subline">Below you can update the following: Agent info, company info, set a default theme, and update your login info.</p>
      </div>
    </div>
    <div class="myaccount_tabs">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link <?php if ($active_tab == 'login') {echo 'active';}?>" id="login-tab" data-bs-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">
            <b>Login info</b>
            Update your info
          </a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link <?php if ($active_tab == 'agent') {echo 'active';}?>" id="agent-tab" data-bs-toggle="tab" href="#agent" role="tab" aria-controls="agent" aria-selected="false">
            <b>Agent Info</b>
            Update your info
          </a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link <?php if ($active_tab == 'company') {echo 'active';}?>" id="company-tab" data-bs-toggle="tab" href="#company" role="tab" aria-controls="company" aria-selected="false">
            <b>Company Info</b>
            Update company info
          </a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link <?php if ($active_tab == 'theme') {echo 'active';}?>" id="theme-tab" data-bs-toggle="tab" href="#theme" role="tab" aria-controls="theme" aria-selected="false">
            <b>Theme Default</b>
            Select a theme
          </a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link <?php if ($active_tab == 'membership') {echo 'active';}?>" id="plan-tab" data-bs-toggle="tab" href="#plan" role="tab" aria-controls="plan" aria-selected="false">
            <b>Membership</b>
            Select a plan
          </a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link <?php if ($active_tab == 'retsapi') {echo 'active';}?>" id="api-tab" data-bs-toggle="tab" href="#retsApi" role="tab" aria-controls="plan" aria-selected="false">
            <b>API</b>
            Simply Rets API
          </a>
        </li>
      </ul>
      <div class="loader1 hidden lp-loader1-myaccount"><img src="<?php echo base_url(); ?>assets/images/gears.gif"></div>
      <div class="backwrap hidden"></div>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade <?php if ($active_tab == 'login') {echo 'show active';}?>" id="login" role="tabpanel" aria-labelledby="login-tab">
          <div class="tab_white_box">
            <h2 class="mini_title">Update Login Info</h2>
            <div class="login_info_form">
              <form id="loginInfoForm">
                <div class="form-group email_field">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control disabled"  name="email" value="<?php echo $agentInfo->email; ?>" placeholder="Email">
                </div>
                <div class="form-group password_field">
                  <label for="exampleInputPassword1">Old Password</label>
                  <input type="password" class="form-control" name="old_password" placeholder="Password">
                </div>
                <div class="form-group password_field">
                  <label for="exampleInputPassword1">New Password</label>
                  <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Password">
                </div>
                <div class="form-group password_field">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm_password" placeholder="Password">
                </div>
                <div class="alert alert-success" style="display:none"></div>
                <button type="submit" class="btn btn-lp save">Save</button>
              </form>
            </div>
          </div>
        </div>

        <div class="tab-pane fade <?php if ($active_tab == 'agent') {echo 'show active';}?>" id="agent" role="tabpanel" aria-labelledby="agent-tab">
          <div class="tab_white_box">
            <h2 class="mini_title">Update Agent Info</h2>
            <div class="leftpic">
                <a href="javascript:;">
                  <?php
if (empty($agentInfo->profile_image)) {
    ?>
                  <i class="icon-camera"></i>
                  <br>
                  Upload Picture
                  <?php
} else {
    ?>
                  <img  src="<?php echo base_url() . $agentInfo->profile_image; ?>" width="100%" >
                  <?php
}
?>
                </a>
                <input type="file"  class="file-type hidden">
            </div>
            <div class="agent_info_form">
              <form id="agentInfoForm" action="#" method="post">
                <input type="text" class="hidden" id="agent_profile_image" name="profile_image" value="<?php echo $agentInfo->profile_image; ?>" name="profile_image" />
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="" name="first_name" placeholder="FIRST NAME" value="<?php echo $agentInfo->first_name; ?>" />
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="" name="last_name" placeholder="LAST NAME"  value="<?php echo $agentInfo->last_name; ?>"  />
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="" name="title" placeholder="TITLE" value="<?php echo $agentInfo->title; ?>"  />
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="" name="phone" placeholder="PHONE" value="<?php echo $agentInfo->phone; ?>"  />
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control disabled" id="" name="email" placeholder="EMAIL"  value="<?php echo $agentInfo->email; ?>" />
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="" name="license" value="<?php echo $agentInfo->license_no; ?>" placeholder="CA BRE#" />
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="" name="website" placeholder="WEB"  value="<?php echo $agentInfo->website; ?>"  />
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
        <div class="tab-pane fade <?php if ($active_tab == 'company') {echo 'show active';}?>" id="company" role="tabpanel" aria-labelledby="company-tab">
          <div class="tab_white_box">
            <h2 class="mini_title">Update Company Info</h2>
            <div class="rightpic">
              <a href="javascript:;">
                <?php
if (empty($agentInfo->company_logo)) {
    ?>
                <i class="icon-camera"></i>
                <br>
                Upload Picture
                <?php
} else {
    ?>
                <img  src="<?php echo base_url() . $agentInfo->company_logo; ?>" width="100%" >
                <?php
}
?>
              </a>
              <input type="file" class="file-type hidden">
            </div>
            <div class="agent_info_form">
              <form id="companyInfoForm"  action="" method="post">
                <input type="text" class="hidden" id="agent_company_logo" name="company_logo" value="<?php echo $agentInfo->company_logo; ?>" name="profile_image" />
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="company_name"  placeholder="COMPANY NAME" value="<?php echo $agentInfo->company_name; ?>"/>
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="company_add" value="<?php echo $agentInfo->company_add; ?>" placeholder="STREET ADDRESS" />
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="company_city" value="<?php echo $agentInfo->company_city; ?>" placeholder="CITY" />
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="comapny_zip" value="<?php echo $agentInfo->comapny_zip; ?>" placeholder="ZIP" />
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="company_state" value="<?php echo $agentInfo->company_state; ?>" placeholder="STATE" />
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="company_phone" value="<?php echo $agentInfo->company_phone; ?>" placeholder="PHONE" />
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
        <div class="tab-pane fade <?php if ($active_tab == 'theme') {echo 'show active';}?>" id="theme" role="tabpanel" aria-labelledby="theme-tab">
          <?php
$default_sub_type = 1;
$default_theme_color = 1;
if ($theme_data) {

    foreach ($theme_data as $key => $theme_data_val) {
        if ($theme_data_val->theme_type == 'buyer') {
            $default_sub_type = $theme_data_val->theme_sub_type;
            $default_theme_color = $theme_data_val->theme_color;
        }
    }
}
?>
          <div class="tab_white_box full_width">
            <div class="row">
              <div class="col-sm-4">
                <h2 class="mini_title">Select Cover Theme</h2>
              </div>
              <div class="col-sm-8">
                <div class="pull-right">
                  <div class="theme_selection_div">

                    <select class="select_theme_type select_change" id="select-theme-type">
                      <option value="buyer" selected="">Buyer</option>
                      <option value="seller">Seller</option>
                      <option value="marketUpdate">Market Update</option>
                    </select>
                  </div>
                  <div class="theme_selection_div">

                    <select class="select_theme select_change" id="select-theme">
                      <?php for ($select_theme_sub_type = 1; $select_theme_sub_type <= 3; $select_theme_sub_type++) {?>
                        <option <?=($select_theme_sub_type == $default_sub_type) ? 'selected' : ''?> value="<?=$select_theme_sub_type?>">Theme <?=$select_theme_sub_type?></option>

                      <?php }?>
                    </select>
                  </div>
                  <div class="theme_selection_div">

                    <select class="select_color" id="select-color">
                      <?php
foreach ($reportTemplates as $key => $report):
?>
                      <option <?=($report->report_templates_id_pk == $default_theme_color) ? 'selected' : ''?> value="<?=$report->report_templates_id_pk?>" style="color: <?=$report->template_color?>"><?=$report->template_name?></option>
                      <?php endforeach;?>
                    </select>
                  </div>

                  <div class="theme_selection_div">
                     <input id="agentDefaultTheme_save" type="button" class="btn btn-lp save" value="Save" />
                  </div>
                </div>
              </div>
            </div>
            <div class="subscribe_notice" style="display: none;"><span class="alert-warning">Please subscribe for <span id="rep_type"></span> to view all themes</span></div>
            <div class="select_theme_form">
              <?php
$data_theme['type'] = 'buyer';
$data_theme['sub_type'] = $default_sub_type;
?>
              <form id="agentDefaultThemeForm" action="#" method="post">
                <div id="preview_pages"  class="row">
                  <?php $this->load->view('user/theme/index', $data_theme);?>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="alert alert-success" style="display:none"></div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="tab-pane fade <?php if ($active_tab == 'membership') {echo 'show active';}?>" id="plan" role="tabpanel" aria-labelledby="plan-tab">
          <?php $this->load->view('user/membership/index');?>
        </div>

        <div class="tab-pane fade <?php if ($active_tab == 'retsapi') {echo 'show active';}?>" id="retsApi" role="tabpanel" aria-labelledby="plan-tab" >
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

            <div class="row">
              <div class="col-sm-12">
                <h2 class="mini_title">Add Your Rets API details</h2>
              </div>
            </div>
            <?php
$show_api_form = false;
if ($active_plans) {
    foreach ($active_plans as $active_plan) {

        if ($active_plan->package && ($active_plan->package->package == 'seller' || $active_plan->package->package == 'all')) {
            $show_api_form = true;
        }

    }
}
if ($show_api_form):
?>
            <div class="agent_info_form">
              <form id="retsApiForm" action="<?php echo base_url('user/saveRetsDetails') ?>" method="post">
                <div class="row">
                  <div class="col-sm-6">
                    <input autocomplete=off placeholder="User Name" type="text" name="rets_user" id="rets_user" class="form-control" required value="<?php echo $rets_api_data->user_name; ?>" >
                  </div>

                  <div class="col-sm-6">
                    <input autocomplete=off placeholder="Password"  type="password" name="rets_password" id="rets_password" class="form-control" required value="<?php echo !empty($rets_api_data->user_password) ? openssl_decrypt($rets_api_data->user_password, "AES-128-ECB", $this->config->item('encryption_key')) : ''; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input type="submit" name="" class="btn btn-lp save">
                  </div>
                </div>
              </form>
            </div>
            <?php
else: ?>
              <div class="row">
                <div class="col-sm-12">
                  <div class="alert alert-warning alert-dismissible fade show">
                    <strong>Warning! </strong>
                    Please Subscribe for "Seller Package" Or "All Package" to enable this feature

                </div>
                </div>
              </div>
            <?php
endif;
?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- My Account section -->
<!-- Modal -->
<div id="cancel-subscription" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form action="<?php echo base_url('user/cancel_subscription'); ?>" method="post" id="forward-report-form">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cancel Subscription</h4>
            </div>
            <div class="modal-body">
                <p>Canceling subscription will not affect you current billing cycle.</p>
                <p>Are you sure you want to cancel your subscription?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-lp external">Yes, Cancel the subscription</button>
            </div>
        </form>
    </div>

  </div>
</div>
<script type="text/javascript">
  default_sub_type_buyer = default_sub_type_seller = default_sub_type_mu = 1;
  default_color_buyer = default_color_seller = default_color_mu = 1;
  active_buyer = active_seller = active_mu = active_all = 0;

  <?php
if ($theme_data) {
    foreach ($theme_data as $key => $theme_data_val) {
        if ($theme_data_val->theme_type == 'buyer') {?>
          default_sub_type_buyer = '<?php echo $theme_data_val->theme_sub_type; ?>';
          default_color_buyer = '<?php echo $theme_data_val->theme_color; ?>';
        <?php
} else if ($theme_data_val->theme_type == 'seller') {?>
          default_sub_type_seller = '<?php echo $theme_data_val->theme_sub_type; ?>';
          default_color_seller = '<?php echo $theme_data_val->theme_color; ?>';
        <?php
} else if ($theme_data_val->theme_type == 'marketUpdate') {?>
          default_sub_type_mu = '<?php echo $theme_data_val->theme_sub_type; ?>';
          default_color_mu = '<?php echo $theme_data_val->theme_color; ?>';
        <?php
}
    }
}

if ($active_plans) {
    foreach ($active_plans as $active_plan) {
        if ($active_plan->package && $active_plan->package->package == 'buyer') {?>
          active_buyer = 1;
        <?php } else if ($active_plan->package && $active_plan->package->package == 'seller') {?>
          active_seller = 1;
        <?php } else if ($active_plan->package && $active_plan->package->package == 'marketupdate') {?>
          active_mu = 1;
        <?php } else if ($active_plan->package && $active_plan->package->package == 'all') {?>
          active_all = 1;
        <?php }
    }
}
?>
</script>