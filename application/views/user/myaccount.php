<style type="text/css">
.truncate {
width: 162px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
}
</style>
<!-- My Account section -->
<section id="myaccount">
  <div class="container">
    <h1 class="page-header">My Account</h1>
    <p class="subhead">Below you can update the following: Agent info, company info, set a default theme, and update your login info.</p>
    <p>&nbsp;</p>
    <div id="tabs">
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
        <li><a href="#tabs-5" id="susb_tab" data-planid="<?php echo $plan['id']; ?>">Membership<br />
            <p id="accountupdate">Select a plan</p>
          </a>
        </li>
      </ul>
<div class="loader1 hidden"><img src="<?php echo base_url(); ?>assets/images/gears.gif"></div>
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
            <div class=" col-sm-6 col-md-6 col-lg-6">
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
      <h4>Select Cover Theme <!--<span class="pull-right">Default Theme:<strong> Blue (Like Prudential)</strong></span>--></h4>
      <form id="agentDefaultThemeForm" action="#" method="post">
        <div class="cover-list row">
          <?php
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
          }
          ?>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-success" style="display:none"></div>
          </div>
        </div>
      </form>
      <div class="col-md-12 text-right">
        <input id="agentDefaultTheme" type="button" class="btn btn-lp save" id="" value="Save" />
      </div>
    </div>
  </div>
</div>
<div id="tabs-5" style="z-index:20;">
  <div class="content-inner clearfix" style="vertical-align:top;">
    <div class="col-md-12">
        <h4 style="margin-bottom:10px; padding-top:25px;">Membership Plan</h4>
        <div id="subscribed-wrap" style="display:none;">
            <div class="col-sm-12"><label>Your are subscribed to the <span class="plan-title">info.plan_title</span> plan(<span class="plan-interval">info.interval</span>ly) and your current period ends on <span class="plan-ends">info.current_period_end</span>.</label></div>
            <div class="col-sm-12 recurring-billing" style="display:none;">
                <label>You will be auto charged for next billing cycle on <span class="plan-ends"></span>.</label>
                <div class="col-md-12 text-center" id="cancelBtnWrap">
                    <a href="#" class="btn btn-lp" target="_blank" data-toggle="modal" data-target="#cancel-subscription">Cancel Subscription</a>
                </div>
            </div>
        </div>
        <div id="subscriptionForm-wraper"  style="display:none;" class="col-sm-12">
            <form id="subscriptionForm" action="#" method="post">
                <span class="payment-errors"></span>
                <span class="payment-success"></span>
                <div class="form-group">
                    <label style="padding-left:0;">Subscribe to $<?php echo floor($plan['amount']/100)." ". $plan['name']."(".ucwords($plan['interval'])."ly)"; ?></label>
                    <input type="hidden" name="cc" value="<?php echo $plan['id']; ?>">
                </div>
                <input type="hidden"  data-stripe="plan_id" name="plan_id" value="<?php echo $plan['id']; ?>" /> 
                <input type="hidden"  data-stripe="email" name="email" value="<?php echo $agentInfo->email; ?>" /> 
                <script
                  src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                  data-key="pk_live_kWtXKplBdNqXQMeBWHuHYZDx"
                  data-amount="<?php echo $plan['amount'] ?>"
                  data-name="modernagent.io"
                  data-description="<?php echo $plan['name']." (".ucwords($plan['interval'])."ly)" ?>"
                  data-email="<?php echo $agentInfo->email; ?>"
                  data-image="<?php echo base_url('assets/images/favicon-32x32.png') ?>"
                  data-locale="auto"
                  data-zip-code="false">
                </script>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="alert alert-success" style="display:none"></div>
                  </div>
              </div>
            </form>
        </div>
        <div id="ref-code-wrap" style="font-weight:bold;color:#FFF;<?php echo (!$agentInfo->ref_code)?"display:none;":""; ?>">
            Your unique referral code: <span id="ref-code"><?php echo $agentInfo->ref_code; ?></span>
        </div>
        <div id="api-token-wrap" style="font-weight:bold;color:#FFF;display:none;">
            Your API Token: <span id="api-token-code"></span>
        </div>
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