<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.min.css") ?>">
<h2> Test Reports</h2>
<h4>You can check <a href="<?php echo base_url('tmp.html'); ?>">here</a> last created pdf's html saved just before report generation.</h4>
<h4>Note: this generated html may not look as in final pdf.</h4>
<form method="post">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xs-12 col-lg-6 col-md-6">
              <h2><strong>Agent:</strong> Enter Info</h2>
              <div class="row">
                <div class="col-md-3">
                  <div class="leftpic"> 
                    <a href="javascript:;">
                      <img src="<?php echo base_url($agentInfo->profile_image) ?>" width="100%">
                    </a>
                    <input class="file-type hidden" type="file">
                    <input id="fileimage" class="hidden file-path" name="user[profile_image]" value="<?php echo $agentInfo->profile_image ?>" type="text">
                  </div>
                </div>
                <div class="col-md-9">
                  <input class="form-control" name="user[fullname]" id="" placeholder="Name" value="<?php echo $agentInfo->first_name . " " . $agentInfo->last_name ?>" type="text">
                  <input class="form-control" name="user[title]" id="" placeholder="Title" value="<?php echo $agentInfo->title ?>" type="text">
                  <input class="form-control" name="user[phone]" id="" placeholder="Phone" value="<?php echo $agentInfo->phone ?>" type="text">
                  <input class="form-control" name="user[email]" id="" placeholder="Email" value="<?php echo $agentInfo->email ?>" type="text">
                  <input class="form-control" name="user[licenceno]" id="" placeholder="CA BRE#" value="<?php echo $agentInfo->license_no ?>" type="text">
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-lg-6 col-md-6">
              <h2><strong>Company:</strong> Enter Info</h2>
              <div class="row">
                <div class="col-md-3">
                  <div class="rightpic"> <a href="javascript:;">
                                                            <img src="<?php echo base_url($agentInfo->company_logo) ?>" width="100%">
                                                          </a>
                  <input class="file-type hidden" type="file">
                  <input class="hidden file-path" name="user[company_logo]" value="<?php echo $agentInfo->company_logo ?>" type="text">
                </div>
              </div>
              <div class="col-md-9">
                <input class="form-control" name="user[companyname]" id="" placeholder="Company Name" value="<?php echo $agentInfo->company_name ?>" type="text">
                <input class="form-control" name="user[street]" id="" placeholder="Street Address" value="<?php echo $agentInfo->company_add ?>" type="text">
                <input class="form-control" name="user[city]" id="" placeholder="City" value="<?php echo $agentInfo->company_city ?>" type="text">
                <input class="form-control" name="user[zip]" id="" placeholder="ZIP" value="<?php echo $agentInfo->comapny_zip ?>" type="text">
                <input class="form-control" name="user[state]" id="" placeholder="State" value="<?php echo $agentInfo->company_state ?>" type="text">
              </div>
            </div>
        </div>
    </div>
    <div class="clearfix">
    <p></p>
    </div>
    <div class="clearfix">
    <p></p>
    </div>


</div>
    <select name="presentation">
        <option value="seller">Sellers Report</option>
        <option value="buyer">Buyers Report</option>
    </select><br/>
    <select name="report_lang">
        <option value="english">English</option>
        <option value="spanish">Spanish</option>
    </select>
    <input type="hidden" name="theme" value="#1BBB9B">

    <input type="submit">
</form>
