<style type="text/css">
.truncate {
width: 162px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
}
.theme_selection_div {
    display: inline-block;
    padding: 8px 6px;
    border: 1px solid #fff;
    color: #fff;
    margin: 0px 5px;
}
.theme_selection_div select {
    border: 0;
    background: transparent;
    width: 120px;
}
.theme_selection_div input.btn  {
    border: 0;
    height: initial;
    margin: 0;  
    padding: 0
}
.theme_selection_div select option {
    color: #111;
}
.theme_selection_div input.btn:hover {
    background: none;
    margin: 0;
}
.cover-item.col-sm-2:nth-child(6n+1) {
    clear: left;
}
.cover-item {
  margin-top: 15px;
}
.theme_selection_div select option:disabled {
    color: gray;
}
.subscribe_notice {
  padding: 10px 0px;
}
.subscribe_notice > span {
  padding: 10px;
}
</style>
<!-- My Account section -->
<section id="myaccount">
  <div class="container">
    <h1 class="page-header">My Account</h1>
    <p class="subhead">Below you can update the following: Agent info, company info, set a default theme, and update your login info.</p>
    <p>&nbsp;</p>
    <div id="tabs" style="display:none;">
      <ul>
        <li><a href="#tabs-4">Login info<br />
          <p id="accountupdate">Update your info</p>
        </a>
        </li>
        <li><a href="#tabs-1">Agent Info<br />
          <p id="accountupdate">Update your info</p>
        </a></li>
        <li><a href="#tabs-2">Company Info<br />
          <p id="accountupdate">Update company info</p>
        </a></li>
        <li><a href="#tabs-3">Theme Default<br />
            <p id="accountupdate">Select a theme</p>
          </a>
        </li>
        <li><a href="#tabs-5" id="susb_tab" data-planid="1">Membership<br />
            <p id="accountupdate">Select a plan</p>
          </a>
        </li>
      </ul>
<div class="loader1 hidden lp-loader1-myaccount"><img src="<?php echo base_url(); ?>assets/images/gears.gif"></div>
<div class="backwrap hidden"></div>
<div id="tabs-4" style="z-index:20;">
  <div class="content-inner clearfix">
    <div class="col-md-12">
      <h4>Update Login Info</h4>
      
      <div class="col-md-12 ">
        <form id="loginInfoForm">
          <div class="row">
            <div class=" col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control disabled"  name="email" value="<?php echo $agentInfo->email; ?>" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Old Password</label>
                <input type="password" class="form-control" name="old_password" placeholder="Password">
              </div>
            </div>
            <div c
            .lass=" col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="exampleInputPassword1">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Password">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="alert alert-success" style="display:none"></div>
            </div>
          </div>
          
          <div class="form-group">
            <button type="submit" class="btn btn-lp save pull-right">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <div id="tabs-1" class="sel" style="z-index:20;">
    <div class="content-inner clearfix">
	 <div class="col-md-12">
      <h4>Update Agent Info</h4>
	  </div>
      <div class="col-sm-2">
        <div class="leftpic"> <a href="javascript:;">
          <?php
          if(empty($agentInfo->profile_image)){
          ?>
          <i class="icon-camera"></i>
          <br>
          Upload Picture
          <?php
          }
          else{
          ?>
          <img  src="<?php echo base_url().$agentInfo->profile_image; ?>" width="100%" >
          <?php
          }
          ?>
        </a>
        <input type="file"  class="file-type hidden">
      </div>
    </div>
    <form id="agentInfoForm" action="#" method="post">
      <div class="col-sm-10">
        <div class="row">
          <input type="text" class="hidden" id="agent_profile_image" name="profile_image" value="<?php echo $agentInfo->profile_image; ?>" name="profile_image" />
          <div class="col-xs-6">
            <input type="text" class="form-control" id="" name="first_name" placeholder="FIRST NAME" value="<?php echo $agentInfo->first_name; ?>" />
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" id="" name="last_name" placeholder="LAST NAME"  value="<?php echo $agentInfo->last_name; ?>"  />
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" id="" name="title" placeholder="TITLE" value="<?php echo $agentInfo->title; ?>"  />
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" id="" name="phone" placeholder="PHONE" value="<?php echo $agentInfo->phone; ?>"  />
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control disabled" id="" name="email" placeholder="EMAIL"  value="<?php echo $agentInfo->email; ?>" />
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" id="" name="license" value="<?php echo $agentInfo->license_no;  ?>" placeholder="CA BRE#" />
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" id="" name="website" placeholder="WEB"  value="<?php echo $agentInfo->website; ?>"  />
          </div>
        </div>
      </div>
      <div class="col-md-12 text-right">
        <input type="submit" class="btn btn-lp save" id="" value="Save" />
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-success" style="display:none"></div>
        </div>
      </div>
    </form>
  </div>
</div>
<div id="tabs-2" style="z-index:20;">
  <div class="content-inner clearfix">
   <div class="col-md-12">
      <h4>Update Company Info</h4>
    <div class="col-sm-2">
      <div class="rightpic">
        <a href="javascript:;">
          <?php
          if(empty($agentInfo->company_logo)){
          ?>
          <i class="icon-camera"></i>
          <br>
          Upload Picture
          <?php
          }
          else{
          ?>
          <img  src="<?php echo base_url().$agentInfo->company_logo; ?>" width="100%" >
          <?php
          }
          ?>
        </a>
        <input type="file" class="file-type hidden">
      </div>
    </div>
    <form id="companyInfoForm"  action="" method="post">
      <div class="col-sm-10">
        <div class="row">
          <input type="text" class="hidden" id="agent_company_logo" name="company_logo" value="<?php echo $agentInfo->company_logo; ?>" name="profile_image" />
          <div class="col-xs-6">
            <input type="text" class="form-control" name="company_name"  placeholder="COMPANY NAME" value="<?php echo $agentInfo->company_name; ?>"/>
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" name="company_add" value="<?php echo $agentInfo->company_add; ?>" placeholder="STREET ADDRESS" />
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" name="company_city" value="<?php echo $agentInfo->company_city; ?>" placeholder="CITY" />
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" name="comapny_zip" value="<?php echo $agentInfo->comapny_zip; ?>" placeholder="ZIP" />
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" name="company_state" value="<?php echo $agentInfo->company_state; ?>" placeholder="STATE" />
          </div>
          <div class="col-xs-6">
            <input type="text" class="form-control" name="company_phone" value="<?php echo $agentInfo->company_phone; ?>" placeholder="PHONE" />
          </div>
        </div>
      </div>
      <div class="col-md-12 text-right">
        <input type="submit" class="btn btn-lp save" id="" value="Save" />
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-success" style="display:none"></div>
        </div>
      </div>
    </form>
  </div>
</div>
<div id="tabs-3" style="z-index:20;">
  <div class="content-inner clearfix">
    <div class="col-md-12">
      <div class="row">
        <div class="col-sm-4">
          <?php
          $default_sub_type = 1;
          $default_theme_color = 1;
          if($theme_data){

            foreach ($theme_data as $key => $theme_data_val) {
              if($theme_data_val->theme_type == 'buyer') {
                $default_sub_type = $theme_data_val->theme_sub_type;
                $default_theme_color = $theme_data_val->theme_color;
              }
            }
          }
          ?>
          
          <h4>Select Cover Theme <!--<span class="pull-right">Default Theme:<strong> Blue (Like Prudential)</strong></span>--></h4>
        </div>
        <div class="col-sm-8">
          <div class="theme_selection_div">
            
            <select class="select_theme_type select_change" id="select-theme-type">
              <option value="buyer" selected="">Buyer</option>
              <option value="seller">Seller</option>
              <option value="marketUpdate">Market Update</option>
            </select>
          </div>
          <div class="theme_selection_div">
            
            <select class="select_theme select_change" id="select-theme">
              <?php for ($select_theme_sub_type=1; $select_theme_sub_type <=3 ; $select_theme_sub_type++) {  ?>
                <option <?= ($select_theme_sub_type == $default_sub_type)?'selected' : '' ?> value="<?=$select_theme_sub_type?>">Theme <?=$select_theme_sub_type?></option>
                
              <?php } ?>
            </select>
          </div>
          <div class="theme_selection_div">
            
            <select class="select_color" id="select-color">
              <?php
                foreach ($reportTemplates as $key => $report):
              ?>
              <option <?= ($report->report_templates_id_pk == $default_theme_color)?'selected' : '' ?> value="<?=$report->report_templates_id_pk?>" style="color: <?=$report->template_color?>"><?=$report->template_name?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="theme_selection_div">
             <input id="agentDefaultTheme_save" type="button" class="btn btn-lp save" value="Save" />
          </div>
        </div>
      </div>

      <div class="subscribe_notice" style="display: none;"><span class="alert-warning">Please subscribe for <span id="rep_type"></span> to view all themes</span></div>
        <div id="preview_pages" class="row" style="max-height: 230px;overflow: auto;">
          <?php
          $data_theme['type'] = 'seller';
          $data_theme['sub_type'] = $default_sub_type;
          ?>
          <?php $this->load->view('user/theme/index',$data_theme); ?>
          <?php /*
          foreach ($reportTemplates as $key => $report) {
          ?>
          <div class="col-xs-3 cover-item">
            <input type="radio"
            <?php
            if($report->report_templates_id_pk==$agentInfo->default_template){
            echo 'checked';
            }
            ?>
            class="custom-checkbox" id="pb" value="<?php echo $report->report_templates_id_pk; ?>" name="cover">
            <label class="user-heading alt gray-bg" for="pb">
              <div class="text-center"> <img src="<?php echo base_url().$report->template_icon; ?>" alt="">
                <h1 title="<?php echo $report->template_name; ?>" class="truncate"><?php echo $report->template_name; ?></h1>
              </div>
            </label>
          </div>
          <?php
          } */
          
          ?>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-success" style="display:none"></div>
          </div>
        </div>
      
      <!-- <div class="col-md-12 text-right">
        <input id="agentDefaultTheme" type="button" class="btn btn-lp save" id="" value="Save" />
      </div> -->
    </div>
  </div>
</div>
<div id="tabs-5" style="z-index:20;">
  
  <?php $this->load->view('user/membership/index'); ?>
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
  if($theme_data){
      foreach ($theme_data as $key => $theme_data_val) {
        if($theme_data_val->theme_type == 'buyer') { ?>
          default_sub_type_buyer = '<?php echo $theme_data_val->theme_sub_type ;?>';
          default_color_buyer = '<?php echo $theme_data_val->theme_color;?>';
        <?php
        }
        else if($theme_data_val->theme_type == 'seller') { ?>
          default_sub_type_seller = '<?php echo $theme_data_val->theme_sub_type ;?>';
          default_color_seller = '<?php echo $theme_data_val->theme_color;?>';
        <?php
        }
        else if($theme_data_val->theme_type == 'marketUpdate') { ?>
          default_sub_type_mu = '<?php echo $theme_data_val->theme_sub_type ;?>';
          default_color_mu = '<?php echo $theme_data_val->theme_color;?>';
        <?php
        }
      }
    }

    if($active_plans) {
      foreach($active_plans as $active_plan) {
        if($active_plan->package && $active_plan->package->package == 'buyer') { ?>
          active_buyer = 1;
        <?php }
        else if($active_plan->package && $active_plan->package->package == 'seller') { ?>
          active_seller = 1;
        <?php }
        else if($active_plan->package && $active_plan->package->package == 'marketupdate') { ?>
          active_mu = 1;
        <?php }
        else if($active_plan->package && $active_plan->package->package == 'all') { ?>
          active_all = 1;
        <?php }
      }
    } 
  ?>
</script>