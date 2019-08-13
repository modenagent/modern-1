<!-- My Account section -->
<section id="report_customize">
    <!-- <div class="container"> -->
        <div class="loader1 hidden lp-loader1-myaccount"><img src="<?php echo base_url(); ?>assets/images/gears.gif"></div>
        <div class="backwrap hidden"></div>
        <h1 class="page-header">Report Customization</h1>
        <p class="subhead">User can customize report content.</p>
        <ul class="nav nav-tabs">
            <li id="buyer_tab" role="presentation" class="active"><a data-toggle="tab" href="#buyer_content">Buyer</a></li>
            <li id="seller_tab" role="presentation"><a data-toggle="tab" href="#seller_content">Seller</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active row content" id="buyer_content">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        Language: 
                        <select id="buyer_language" class="form-control">
                            <option value="english">English</option>
                            <option value="spanish">Spanish</option>
                        </select>
                    </div>
                    <div class="col-sm-9">
                        Pages: 
                        <select id="buyer_pages" class="form-control">
                        <?php
                        if (isset($buyer_pages['pages']) && !empty($buyer_pages['pages'])) {
                            foreach ($buyer_pages['pages'] as $key => $value) {
                                echo "<option value='".$value['no']."''>Page-".$value['no']." - ".$value['title']."</option>";
                            }
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <hr class="hr-primary" />
                    <div id="buyer_error" class="pma-error col-sm-12 alert alert-danger" style="display: none;"></div>
                    <div class="col-sm-3" id="buyer_form_div">
                        &nbsp;
                    </div>
                    <div class="col-sm-9">
                        <iframe id="buyer_iframe" src="" style="width: 100%; height:1500px;"></iframe> 
                        <br/>
                        <button id="buyer_pdf_preview_btn" style="display:none;" type="button" class="btn lp-datatable-custom-btn lp-ml-5 lp-mb-5" onclick="preview_pdf('buyer')">Preview PDF</button>
                        <button id="buyer_pdf_preview_all_btn" style="display:none;" type="button" class="btn lp-datatable-custom-btn lp-ml-5 lp-mb-5" onclick="preview_pdf_all('buyer')">Preview PDF All Pages</button>
                    </div>
                </div>
            </div>
            <div id="seller_content" class="row content tab-pane fade">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        Language: 
                        <select id="seller_language" class="form-control">
                            <option value="english">English</option>
                            <option value="spanish">Spanish</option>
                        </select>
                    </div>
                    <div class="col-sm-9">
                        Pages: 
                        <select id="seller_pages" class="form-control">
                        <?php
                        if (isset($seller_pages['pages']) && !empty($seller_pages['pages'])) {
                            foreach ($seller_pages['pages'] as $key => $value) {
                                echo "<option value='".$value['no']."''>Page-".$value['no']." - ".$value['title']."</option>";
                            }
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <hr class="hr-primary" />
                    <div id="seller_error" class="pma-error col-sm-12 alert alert-danger" style="display: none;"></div>
                    <div class="col-sm-3" id="seller_form_div">
                    &nbsp;    
                    </div>
                    <div class="col-sm-9">
                        <iframe id="seller_iframe" src="" style="width: 100%; height:1500px;"></iframe> 
                        <br/>
                        <button id="seller_pdf_preview_btn" style="display:none;" type="button" class="btn lp-datatable-custom-btn lp-ml-5 lp-mb-5" onclick="preview_pdf('seller')">Preview PDF</button>
                        <button id="seller_pdf_preview_all_btn" style="display:none;" type="button" class="btn lp-datatable-custom-btn lp-ml-5 lp-mb-5" onclick="preview_pdf_all('seller')">Preview PDF All Pages</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
</section>
<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var buyer_report_link = '<?php echo base_url(); ?>'+'user/preview/buyer/';
var seller_report_link = '<?php echo base_url(); ?>'+'user/preview/seller/';
$( document ).ready(function() {
    $( "#buyer_pages" ).change(function() {
        load_iframe('buyer');
    });
    $( "#seller_pages" ).change(function() {
        load_iframe('seller');
    });
    $( "#buyer_language" ).change(function() {
        load_iframe('buyer');
    });
    $( "#seller_language" ).change(function() {
        load_iframe('seller');
    });

    load_iframe('buyer');
    load_iframe('seller');
});

function preview_pdf(type)
{
    var language = $('#'+type+'_language').val();
    var page = $('#'+type+'_pages').val();
    var final_report_link = '';

    var buyer_preview_link = '<?php echo base_url(); ?>'+'user/show_pdf_preview/buyer/';
    var seller_preview_link = '<?php echo base_url(); ?>'+'user/show_pdf_preview/seller/';

    if ($.trim(language) == '' || $.trim(page) == '' || $.trim(type) == '') {
        return false;
    }

    if (type=='buyer') {
        final_report_link = buyer_preview_link+language+'/'+page;
    } else {
        final_report_link = seller_preview_link+language+'/'+page;
    }

     window.open(final_report_link, '_blank');
}

function preview_pdf_all(type)
{
    var language = $('#'+type+'_language').val();
    var final_report_link = '';

    var buyer_preview_link = '<?php echo base_url(); ?>'+'user/show_pdf_preview/buyer/';
    var seller_preview_link = '<?php echo base_url(); ?>'+'user/show_pdf_preview/seller/';

    if ($.trim(language) == '' || $.trim(type) == '') {
        return false;
    }

    if (type=='buyer') {
        final_report_link = buyer_preview_link+language+'/all';
    } else {
        final_report_link = seller_preview_link+language+'/all';
    }

     window.open(final_report_link, '_blank');
}

function load_iframe(type)
{
    var language = $('#'+type+'_language').val();
    var page = $('#'+type+'_pages').val();
    var final_report_link = '';

    if ($.trim(language) == '' || $.trim(page) == '' || $.trim(type) == '') {
        return false;
    }

    if (type=='buyer') {
        final_report_link = buyer_report_link+language+'/'+page;
    } else {
        final_report_link = seller_report_link+language+'/'+page;
    }
    var iframe = document.getElementById(type+'_iframe');
    iframe.src = final_report_link;

    var get_report_data_url = base_url+'user/get_user_report_data';
    var report_type = type;
    $('#'+report_type+'_pdf_preview_btn').hide();
    $('#'+report_type+'_pdf_preview_all_btn').hide();
    showLoader();
    $.ajax({
        url: get_report_data_url,
        method: 'POST',
        dataType: "json",
        data: {
            type: report_type,
            page: page,
            language: language
        },
        success: function (resp) {
            hideLoader();
            if (resp.result == 'error') {
                $('#'+report_type+'_error').html(resp.message).show();
                $('html, body').animate({
                    'scrollTop' : $('#'+report_type+'_error').position().top
                });

                var errorMessage = resp.message;
                if(errorMessage.indexOf('login') != -1){
                    setTimeout(function(){ 
                        location.reload(true);
                    }, 4000);
                }
                return false;
            }

            var controls = resp.data;
            $('#'+type+'_form_div').html('');
            var form_id = 'frm_'+report_type+'_'+language+'_'+page;
            var form_content = '';
            $.each(controls, function( index, value ) {
                var label = index;
                label = label.split('_').join(' ');
                label = toTitleCase(label);
                var keyId = 'cntrl_'+index;
                if ($.trim(value.type) == 'number') {
                    form_content += '<div class="form-group"><label for="'+keyId+'">'+label+'</label><input autocomplete="off" value="'+value.value+'" maxlength="'+value.limit+'" type="text" class="form-control numeric" id="'+keyId+'" name="'+keyId+'" placeholder="'+label+'" onchange="countChar(this)" onkeyup="countChar(this)" onkeypress="countChar(this)"><div id="'+keyId+'_charNum"></div></div>';
                } else if ($.trim(value.type) == 'text') {
                    form_content += '<div class="form-group"><label for="'+keyId+'">'+label+'</label><input autocomplete="off" value="'+value.value+'" maxlength="'+value.limit+'" type="text" class="form-control" id="'+keyId+'" name="'+keyId+'" placeholder="'+label+'" onchange="countChar(this)" onkeyup="countChar(this)" onkeypress="countChar(this)"><div id="'+keyId+'_charNum"></div></div>';
                } else {
                    form_content += '<div class="form-group"><label for="'+keyId+'">'+label+'</label><textarea autocomplete="off" maxlength="'+value.limit+'" class="form-control" id="'+keyId+'" name="'+keyId+'" rows="3" placeholder="'+label+'" onchange="countChar(this)" onkeyup="countChar(this)"  onkeypress="countChar(this)" >'+value.value+'</textarea><div id="'+keyId+'_charNum"></div></div>';
                }
            });

            if (form_content!='') {
                form_content += '<button type="submit" class="btn lp-datatable-custom-btn lp-ml-5 lp-mb-5">Save & Preview</button>';
                $('#'+report_type+'_pdf_preview_btn').show();
                $('#'+report_type+'_pdf_preview_all_btn').show();
            }
            $('#'+type+'_form_div').append('<form id="'+form_id+'" name="'+form_id+'">'+form_content+'</form>');

            $('.numeric').on('input', function (event) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            /**
             * Start applying validation 
             */
            var rules_set={};
            var messages_set={};
            $('#'+form_id).find('input').each(function(){
                var name=$(this).attr('name');
                var maxlength = $(this).attr('maxlength');
                rules_set[name]={required: true, maxlength: maxlength};

                var namelabel = name.replace("cntrl_", "");
                namelabel = namelabel.split('_').join(' ');
                namelabel = toTitleCase(namelabel);
                messages_set[name] = { required: namelabel+' is required.' };

                countChar(this);
            });
            $('#'+form_id).find('textarea').each(function(){
                var name=$(this).attr('name');
                var maxlength = $(this).attr('maxlength');
                rules_set[name]={required: true, maxlength: maxlength};

                var namelabel = name.replace("cntrl_", "");
                namelabel = namelabel.split('_').join(' ');
                namelabel = toTitleCase(namelabel);
                messages_set[name] = { required: namelabel+' is required.' };

                countChar(this);
            });
            /**
             * End applying validation 
             */
            
            $("#"+form_id).validate({
                rules: rules_set,
                messages: messages_set,
                submitHandler: function (form) {
                    save_report_content_data(form_id, 'seller');
                    return false;
                }
            });
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {  
        }
    });
}

function save_report_content_data(formId, reportType)
{
    var language = $('#'+reportType+'_language').val();
    var page = $('#'+reportType+'_pages').val();
    var final_report_link = '';
    if (reportType == 'seller') {
        final_report_link = seller_report_link;
    } else {
        final_report_link = buyer_report_link;
    }
    final_report_link = final_report_link+language+'/'+page;

    var save_report_data_url = base_url+'user/save_user_report_data';

    var data = $('#'+formId).serialize();
    data += "&type=" + reportType + "&page=" + page + "&language=" + language;
    showLoader();
    $.ajax({
        url: save_report_data_url,
        method: 'POST',
        dataType: "json",
        data: data,
        success: function (resp) {
            hideLoader();
            if (resp.result == 'success') {
                $('#'+reportType+'_error').html(resp.message).show();
            } else {
                $('#'+reportType+'_error').html(resp.message).show();
            }

            $('html, body').animate({
                'scrollTop' : $('#'+reportType+'_error').position().top
            });
            setTimeout(function(){ 
                $('#'+reportType+'_error').html('').hide();
            }, 4000);

            var errorMessage = resp.message;
            if (resp.result == 'error') {
                if(errorMessage.indexOf('login') != -1){
                    setTimeout(function(){ 
                        location.reload(true);
                    }, 4000);
                }
            }

            trimAllInputValues(formId);

            var iframe = document.getElementById(reportType+'_iframe');
            iframe.src = final_report_link;
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {  
        }
    });
}

function trimAllInputValues(formId)
{
    $('#'+formId).find('input').each(function(){
        $(this).val( $.trim($(this).val()) );
        countChar(this);
    });
    $('#'+formId).find('textarea').each(function(){
        $(this).val( $.trim($(this).val()) );
        countChar(this);
    });
}

function toTitleCase(str) {
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}

function countChar(obj) 
{
    console.log('event triggers');
    var controlId = $(obj).attr('id');
    var maxLength = $(obj).attr('maxlength');
    var len = $(obj).val().length;
    var charCounterId = controlId+'_charNum';

    if (len > maxLength) {
        $(obj).val( $(obj).val().substring(0, maxLength) );
        $('#'+charCounterId).html(maxLength+" out of "+maxLength);
    } else {
        $('#'+charCounterId).html(len+" out of "+maxLength);
    }
}

function showLoader()
{
    $('.loader1').show();
    $('.loader1').removeClass('hidden');
    $('.backwrap').show();
    $('.backwrap').removeClass('hidden');
}

function hideLoader()
{
    $('.loader1').hide();
    $('.loader1').addClass('hidden');
    $('.backwrap').hide();
    $('.backwrap').addClass('hidden');
}

</script>
<style type="text/css">
    #report_customize .nav li {
        margin-right: 0px !important;
    }
    #report_customize .nav>li {
        padding: 0px !important;
    }
    #report_customize .nav>li>a {
        line-height: 1.42857143 !important;
        padding: 10px 15px !important;
    }
</style>
<!-- My Account section -->