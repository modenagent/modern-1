
$(document).ready(function () {

    var isNewSearch = false;
    jQuery(".loaders").css({ "opacity": "0", "display": "none" });
    jQuery(".loader-back").animate({ "opacity": "1", "display": "block" });
    $('.buttonNext').addClass("buttonDisabled");
    $('.pma-table').hide();
    $('.file-change').hide();
    $('#search-btn').on('click', getAddress);
    $('.js-run-pma-button').hide();

    $('#run-pma-form').submit(function () {
        return false;
    });

    autoComplete();
    dataObj = {};
    pdfID = '';
    firstModal = true;
    $(document).on('click', '.js-run-pma-button', function () {
        $('#run-pma-dialog').dialog('open');
        pdfID = makeID();
    });
    reportXML = '';
    comparableData = [];
    all_comp = [];
    sorted_comp = [];
    reportData = {};
    getSordrtedProperties = false;
    residentialType = null;
    apnInfo = {};
    activeRequest = false;
    pmaRes = {};


    $('#paynow').click(function () {
        $('.loader1').show();
        $('.loader1').removeClass('hidden');
        $('.backwrap').show();
        $('.backwrap').removeClass('hidden');
        isPdfGenerated();
    });

    // $(document).on("click", "#toggle-switch .back .label", function () {
    //     // let $checkbox = $("#property-status");
    //     // console.log('toggle switch', $checkbox.prop("checked"));

    //     // Toggle checkbox state manually
    //     // $checkbox.prop("checked", !$checkbox.prop("checked"));

    //     // Trigger change event
    //     // $checkbox.trigger("change");
    //     get187();
    // });

    $(document).on('change', '#property-status', function () {
        get187();
    });
});

function initateCompSelection() {
    $('#ms-pre-selected-options ul').each(function (idx, li) {
        var cnt_idx = 1;
        $(this).find('li').each(function (idx, li) {
            if ($(this).css('display') != 'none') {
                if (cnt_idx % 2 == 0) {
                    $(this).addClass('multi-select-even');
                }
                else {
                    $(this).removeClass('multi-select-even');
                }
                cnt_idx++;
            }

        });
    });
}
function isPdfGenerated() {
    setTimeout(function () {
        if (activeRequest && !pdfGenerated) {
            isPdfGenerated();
        } else if (!pdfGenerated) {
            $('.loader1').hide();
            $('.backwrap').hide();
            $('#apply-coupan-alert').html("We did not process your payment as PDF Generation failed. Our team is looking into the matter. Please try again in a bit.").removeClass('alert-success').addClass('alert-danger').show();
            $('.loader1').hide();
            $('.backwrap').hide();
        } else {
            $('#payment-form').submit();
        }
    }, 1000);
}



var xhr;
var activeRequest = false;
var pdfGenerated = false;
function toTitleCase(str) {
    return str.replace(/\w\S*/g, function (txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
}

function validateForm() {
    var validTypes = ['jpg', '.peg', 'gif', 'png'];
    var agentFile = $('.js-realtor-picture').val();
    var logoFile = $('.js-realtor-logo').val();
    var agentEnd = agentFile.substr(-3).toLowerCase();
    var logoEnd = logoFile.substr(-3).toLowerCase();
    if (agentFile.length > 0 && $.inArray(agentEnd, validTypes) == -1) {
        $('.js-upload-error-agent').text('Uploaded file does not have a valid image extension.');
        $('.js-upload-error-agent').show();
        $('.js-progress-bar').hide();
        return false;
    }
    if (logoFile.length > 0 && $.inArray(logoEnd, validTypes) == -1) {
        $('.js-upload-error-logo').text('Uploaded file does not have a valid image extension.');
        $('.js-upload-error-logo').show();
        $('.js-progress-bar').hide();
        return false;
    }
    return true;
}

// get list of all previous agents and companies for modal dropdown
function getDropItems() {
    $.ajax({
        url: 'lp/form-data.php',
        type: 'GET',
        data: {
            task: 'fetchItems'
        }
    })
        .done(function (response) {
            var dropData = $.parseJSON(response);
            var realtors = dropData[0];
            var companies = dropData[1];
            realtors = realtors.sort();
            companies = companies.sort();
            textDropdown(realtors, '#lp-realtor-name');
            textDropdown(companies, '#lp-realtor-company');
        })
        .fail(function () { })
}

// Get archived company and agent dropdown info for customized info form
function textDropdown(dropArray, id) {
    var $input = $(id).autocomplete({
        source: dropArray,
        minLength: 0,
        select: function (e, ui) {
            retrieveFormData(id, e, ui);
        }
    }).addClass("ui-widget ui-widget-content ui-corner-left");

    if (firstModal) {
        $("<button type='button'>&nbsp;</button>")
            .attr("tabIndex", -1)
            .attr("title", "Show All Items")
            .insertAfter($input)
            .button({
                icons: {
                    primary: "ui-icon-triangle-1-s"
                },
                text: false
            })
            .removeClass("ui-corner-all")
            .addClass("ui-corner-right ui-button-icon lp-drop-button")
            .click(function () {
                // close if already visible                         
                if ($input.autocomplete("widget").is(":visible")) {
                    $input.autocomplete("close");
                    return;
                }
                $(this).blur();
                $input.autocomplete("search", "");
                $input.focus();
            });
    }
}

// retrieve form data to populate customized info form
function retrieveFormData(id, e, ui) {
    var input = ui.item.value
    if (id == '#lp-realtor-name') {
        data = {
            'task': 'populate',
            'type': 'agent',
            'agent': input
        }
    } else {
        data = {
            'task': 'populate',
            'type': 'company',
            'company': input
        }
    }
    $.ajax({
        url: 'lp/form-data.php',
        type: 'GET',
        data: data
    })
        .done(function (response) {
            populateData(response);

        })
        .fail(function () { })
}


// populate customized info form based on previously used agent or company
function populateData(response) {
    var formItems = $.parseJSON(response);
    var company = formItems.company;
    var agentpic = formItems.agentpic;
    var logo = formItems.logo;
    var address = formItems.address;
    var phone = formItems.phone;
    var dre = formItems.dre;
    var theme = formItems.theme;
    var city = formItems.city;
    var state = formItems.state;
    var zip = formItems.zip;

    $('#lp-realtor-company').val(company);
    $('#lp-realtor-address').val(address);
    $('#lp-realtor-phone').val(phone);
    $('#lp-realtor-dre').val(dre);
    $('#lp-theme').val(theme);
    $('#lp-realtor-city').val(city);
    $('#lp-realtor-state').val(state);
    $('#lp-realtor-zip').val(zip);
    $('.lp-realtor-picture span').html('<img />');
    $('.lp-realtor-logo span').html('<img />');
    if (agentpic && agentpic !== 'undefined') {
        reportData.agentPath = agentpic;
        $('#lp-realtor-picture').hide();
        $('.lp-realtor-picture span').html('<img src="lp/' + agentpic + '" height="30" class="lp-img-preview"/>');
        $('.lp-realtor-picture').find('button').show();
    }
    if (logo && logo !== 'undefined') {
        reportData.logoPath = logo;
        $('#lp-realtor-logo').hide();
        $('.lp-realtor-logo span').html('<img src="lp/' + logo + '" height="30" class="lp-img-preview"/>')
        $('.lp-realtor-logo').find('button').show();
    }
}

// changes back to default display for image upload
function changeFile(event) {
    // event.preventDefault ? event.preventDefault() : event.returnValue = false;
    $(this).siblings().show();
    $(this).siblings('span').html('');
    $(this).hide();
}

// create a dropdown of agents
function makeID() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 4; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
}


// sends customized for info and report URL to backend to generate PDF
function runPMA(agentPath, logoPath) {
    firstModal = false;

    if (agentPath) {
        reportData.agentPath = agentPath;
    }
    if (logoPath) {
        reportData.logoPath = logoPath;
    }
    var req_from = $('#req_from').val();
    var query = $.param(reportData);
    var formData = $('#run-pma-form').serialize();

    query += '&' + formData;

    query += '&' + 'pdfID=' + pdfID;
    query += "&showpartner=" + $('input.add-partner:checked').val();
    if ($('#addNewPartner').css('display') == 'none') {
        query += '&' + 'showpartner=off';
    } else {
        query += '&' + 'showpartner=on';
    }
    query += '&' + 'theme=' + rgb2hex($('.custom-checkbox:checked').val());     //this line comment by vijay 
    // query += '&' + 'report_lang=' + $("select[name='report_lang']").val();
    var selectedPage = [];
    if ($('.page-checkbox:checked').length > 0) {
        $('.page-checkbox:checked').each(function () {
            selectedPage.push($(this).val());
        });
    }
    query += '&' + 'selected_pages=' + JSON.stringify(selectedPage);
    query += '&' + 'pdf_page=' + $('.registry_page:checked').val();
    query += '&' + 'mu_theme=' + $('.mu_radio:checked').val();
    query += '&' + 'seller_theme=' + $('#seller_default_theme').val();
    query += '&' + 'buyer_theme=' + $('.buyer_radio:checked').val();
    if (req_from === 'cma') {
        query += '&' + 'custom_comps=' + JSON.stringify($('#cma-pre-selected-options').val());
    } else {
        query += '&' + 'custom_comps=' + JSON.stringify($('#pre-selected-options').val());
    }
    query += '&' + 'selected_theme=' + rgb2hex($('#report_color').val());
    var subscribe_temp = [];
    var i_index = 0;
    $('.subscribe_temp:checked').each(function () {
        query += '&' + 'subscribe_temp[' + i_index + ']=' + this.value;
        i_index++;
    });

    subscribe_temp

    if (activeRequest) {
        activeRequest = false;
        xhr.abort();
    }
    activeRequest = true;
    var errorMsg = "PDF Generation failed. Our team is looking into the matter. Please try again in a bit.";
    xhr = $.ajax({
        url: base_url + 'lp/getPropertyData',
        type: 'POST',
        data: query
    })
        .done(function (response) {
            var obj = JSON.parse(response);
            manage_checkout_btn();
            try {
                var obj = JSON.parse(response);
                if (obj.status == 'success') {
                    pdfGenerated = true;
                    pmaRes = { status: "success" };
                    if (req_from === 'cma') {
                        $('#payment-form').submit();
                    }
                }
            } catch (e) {
                //return false;
            }
            if (!pdfGenerated) {
                $('#apply-coupan-alert').html(errorMsg).removeClass('alert-success').addClass('alert-danger').show();
                setTimeout(() => {
                    //SET TIME OUT because its add static error message from footer.php SO update exact error message after 1 second.
                    if (obj.msg != '') {
                        if (typeof obj.showError !== 'undefined' && (obj.showError == true || obj.showError == 'true')) {
                            $('#apply-coupan-alert').html(obj.msg).removeClass('alert-success').addClass('alert-danger').show();
                        }
                    }
                }, 1000);
                $('.btn-checkout').hide();
                $('.btn-lp.pay').hide();
                let errMsg = '';
                if (obj.msg != '') {
                    errMsg = errMsg;
                } else {
                    errMsg = errorMsg;
                }
                pmaRes = { status: "failed", msg: errMsg };

                if (req_from === 'cma') {
                    alert(errMsg);
                    location.reload();
                }
            }
            activeRequest = false;
            $('#create-report').removeClass('disabled');
            $('.cma-loader').hide();
        })
        .fail(function () {
            $('#apply-coupan-alert').html(errorMsg).removeClass('alert-success').addClass('alert-danger').show();
            $('.btn-checkout').hide();
            $('.btn-lp.pay').hide();
            pmaRes = { status: "failed", msg: errorMsg };
            if (req_from === 'cma') {
                alert(pmaRes.msg);
                location.reload();
            }
        })
        .always(function () {
            activeRequest = false;
        });


}

// compiles data from customized info form to send to database for future reports that use same company or agent 
function recordFormData() {
    var query = $('#run-pma-form').serialize();
    query += '&lp-realtor-picture=' + reportData.agentPath;
    query += '&lp-realtor-logo=' + reportData.logoPath;
    $.ajax({
        url: 'lp/store-form.php',
        type: 'POST',
        data: query
    })
        .done(function (response) {
            console.log(response);
        })
        .fail(function () { })
}


function returnReport() {
    var pdfLink = 'lp/files/listings/' + reportData.address + ' ' + pdfID + '.pdf'; // create link for PDF report
    reportData.link = pdfLink;
    dataTransfer('yes');
}

// send report link and info to database
function dataTransfer(status) {
    var query = $.param(reportData);
    query += '&dataUpdate=' + status;
    $.ajax({
        url: 'lp/lp-data.php',
        type: 'POST',
        data: query
    })
        .done(function (response) {
            updateTally(response);
        })
        .fail(function () {
            $('.pma-error').text('Problem updating database');
        })
}


// update tally of total reports ran and total cost (net and per agent)
function updateTally(tallies) {
    tallyData = $.parseJSON(tallies);
    $('.pma-total h5').text(tallyData.total);
    $('.accrued-cost h5').text(tallyData.cost);
    $('.rep-table tr').each(function () {
        var pctRep = $(this).find('td:nth-child(1)').text();
        if (tallyData[pctRep]) {
            var repTotal = tallyData[pctRep];
            $(this).find('td:nth-child(2)').text(repTotal);
            var repCost = '$' + (repTotal * .55).toFixed(2);
            $(this).find('td:nth-child(3)').text(repCost);
        }
        $('.row0').show();
        for (i = 1; i <= 5; i++) {
            var j = i.toString();
            if (j in tallyData) {
                var address = tallyData[j][0];
                var city = tallyData[j][2];
                var rep = tallyData[j][3];
                var link = tallyData[j][4];
                var date = tallyData[j][5];
                $('.row' + j).find('td').eq(0).text(date);
                $('.row' + j).find('td').eq(1).text(rep);
                $('.row' + j).find('td').eq(2).text(address);
                $('.row' + j).find('.js-pdf-download').attr("href", link);
                $('.row' + j).show();
            }
        }
    });
}

// format user submitted address
function getAddress() {
    // event.preventDefault ? event.preventDefault() : event.returnValue = false;
    isNewSearch = true;
    address = $('#searchbox').val();
    address = $.trim(address);

    if (address == '') {
        $('#error_searchbox').html('Please search any address.');
        $('#error_searchbox').show();
        return;
    } else {
        $('#error_searchbox').html('');
        $('#error_searchbox').hide();
    }

    $('.pma-error').hide();
    $(this).parents("form").find(".search-result").removeClass("hidden");
    $("#search-btn").parents("form").find("table").addClass("hidden");
    $("#search-btn").parents("form").find(".search-loader").removeClass("hidden");

    locale = $('#searchboxcity').val();
    locale = $.trim(locale);
    state = $('#state').val();
    state = $.trim(state);
    if (isNaN(locale[0])) {
        if (state !== '') {
            locale += ', ' + state;
        } else {
            locale += ', CA' // if locale is city rather than zip, add in state
        }
    }
    neighbourhood = $('#neighbourhood').val();
    neighbourhood = $.trim(neighbourhood);
    if (isNaN(neighbourhood[0])) {
        if (state !== '') {
            neighbourhood += ', ' + state;
        } else {
            neighbourhood += ', CA' // if neighbourhood is city rather than zip, add in state
        }
    }
    data(address, locale, neighbourhood, false);
}


// compile data for API query
function data(address, locale, neighbourhood, retry) {
    dataObj.Address = address;
    dataObj.LastLine = locale.toString();
    dataObj.ClientReference = '<CustCompFilter><SQFT>' + defaultSqft + '</SQFT><Radius>' + defaultRadius + '</Radius></CustCompFilter>';
    dataObj.OwnerName = '';
    compileRequest(dataObj, neighbourhood, retry);
}



// create url for API request
function compileRequest(dataObj, neighbourhood, retry) {
    // var request = 'http://api.sitexdata.com/sitexapi/sitexapi.asmx/AddressSearch?';
    var request = 'http://api.sitexdata.com/sitexapi/sitexapi.asmx/AddressSearch?'
    if (retry) {
        dataObj.LastLine = neighbourhood.toString();
    }
    request += $.param(dataObj);
    runQueries(request, dataObj, neighbourhood, retry);
}

// run api query 
function runQueries(request, dataObj, neighbourhood, retry) {
    $('.loader1').show();
    $('.loader1').removeClass('hidden');
    $('.backwrap').show();
    $('.backwrap').removeClass('hidden');
    $.ajax({
        url: base_url + 'index.php?/lp/getSearchResults?',
        // url: 'http://cardbanana.net/demo/jerry/lp/lp/lp/proxy.php',
        data: {
            requrl: request + '&reportType=187'
        },
        dataType: 'xml'
    })
        .done(function (response, textStatus, jqXHR) {
            var responseStatus = $(response).find('StatusCode').text();
            $("#search-btn").parents("form").find(".search-loader").addClass("hidden");

            if (responseStatus == 'MM') {
                $("#search-btn").parents("form").find("table").removeClass("hidden");
                $(".buttonNext").removeClass("buttonDisabled");
                multipleResults(response);

                $('.loader1').hide();
                $('.loader1').addClass('hidden');
                $('.backwrap').hide();
                $('.backwrap').addClass('hidden');


            } else if (responseStatus != 'OK') {
                if (!retry) {
                    $("#search-btn").parents("form").find(".search-loader").removeClass("hidden");
                    data(dataObj.Address, dataObj.LastLine, neighbourhood, true);


                } else {
                    displayError(responseStatus);
                }

                $('.loader1').hide();
                $('.loader1').addClass('hidden');
                $('.backwrap').hide();
                $('.backwrap').addClass('hidden');

            } else {
                $('.loader1').hide();
                $('.loader1').addClass('hidden');
                $('.backwrap').hide();
                $('.backwrap').addClass('hidden');
                compileXmlUrls(response, '187');
                get187();
                // listResults(response);
                $("#search-btn").parents("form").find("table").removeClass("hidden");
                $(".buttonNext").removeClass("buttonDisabled");
                if (isNewSearch) {
                    multipleResults(response);
                }

            }


        })
        .fail(function (err) {
            $('.pma-error').text('Unsuccessful Request');
            $(".buttonNext").addClass("buttonDisabled");
            $('.loader1').hide();
            $('.loader1').addClass('hidden');
            $('.backwrap').hide();
            $('.backwrap').addClass('hidden');
        });
}

// gets 187 for client-side parsing
function get187() {
    if (!getSordrtedProperties) {
        getSordrtedProperties = true;
        $.ajax({
            type: "GET",
            // url: "lp/xmlproxy.php",
            url: base_url + 'index.php?/lp/getSearchResults?',
            data: {
                requrl: reportData.report187,
            },
            dataType: "xml",
            success: function (xml) {
                reportXML = xml;
                parse187();
            },
            error: function () {
                console.log("An error occurred while processing XML file.");
            }
        });
    } else {
        $('.loader1').show();
        $('.loader1').removeClass('hidden');
        $('.backwrap').show();
        $('.backwrap').removeClass('hidden');
        let propertyType = ($('#property-status').prop('checked') == true) ? 'Active' : 'Closed';
        activeRequest = true;
        let req_from = $('#req_from').val();
        $.ajax({
            type: "GET",
            url: base_url + 'index.php?/lp/getSearchResults?',
            data: {
                requrl: reportData.report187,
                getsortedresults: getSordrtedProperties,
                address: $('#state').val(),
                presentation: $('#wizard #presentation').val(),
                user_id: $("#user-id").val(),
                propertyStatus: propertyType,
                sqft: defaultSqft,
                residentialType: residentialType,
                req_from: req_from

            },
            dataType: "json",
            success: function (data) {
                all_comp = data.all;
                sorted_comp = data.sorted;
                $('.multiselect-header').remove();
                $('#pre-selected-options').html('');
                $('#comparable-pre-selected-options').html('');
                $('#main-prop-lat').val(data.Lat);
                $('#main-prop-long').val(data.Long);
                $('#use_rets').val(data.use_rets);
                // $('#available-comparables-market-update tbody').html('');

                $.each(all_comp, function (i, item) {
                    $('#pre-selected-options, #cma-pre-selected-options').append($('<option>', {
                        value: item.index,
                        text: item.Address + ", Sqft : " + item.SquareFeet + " (" + item.Price + ")"
                    }).attr('data-lat', item.Latitude).attr('data-long', item.Longitude)
                    );

                    $('#comparable-pre-selected-options').append($('<option>', {
                        value: item.index,
                        text: item.Address + ", Sqft : " + item.SquareFeet + " (" + item.Price + ")"
                    }));

                    // $('#available-comparables-market-update tbody').append('<tr><td>'+item.Address+" ("+item.Price+")"+'</td></tr>');
                });

                // $('#comparables-market-update tbody').html('');
                $.each(sorted_comp, function (i, item) {
                    $('#pre-selected-options, #cma-pre-selected-options').append($('<option>', {
                        value: item.index,
                        text: item.Address + ", Sqft : " + item.SquareFeet + " (" + item.Price + ")",
                        selected: 'selected'
                    }).attr('data-lat', item.Latitude).attr('data-long', item.Longitude)
                    );

                    $('#comparable-pre-selected-options').append($('<option>', {
                        value: item.index,
                        text: item.Address + ", Sqft : " + item.SquareFeet + " (" + item.Price + ")",
                        selected: 'selected'
                    }));

                    /*$('#comparables-market-update tbody').append('<tr><td>'+item.Address+" ("+item.Price+")"+'</td></tr>');*/
                });
                if ($('#pre-selected-options').length && ($("#wizard #presentation").val() == "seller" || $("#wizard #presentation").val() == "marketUpdate")) {
                    // $('.buyer-cls').hide();
                    $('#pre-selected-options').multiSelect({
                        selectableHeader: "<div class='multiselect-header'>Available Comparables</div>",
                        selectionHeader: "<div class='multiselect-header'>Comparables You Want To Use</div>",

                        afterInit: function (values) {
                            initateCompSelection();
                        },
                        afterSelect: function (values) {
                            initateCompSelection();
                        },
                        afterDeselect: function (values) {
                            initateCompSelection();
                        }
                    });

                    $('#pre-selected-options').multiSelect('refresh');
                    // if (firstOpen) {
                    // If received list is not greater than min value than set our min value to received list length
                    // var pre_selected_options = $.trim($('#pre-selected-options').html());
                    // if (pre_selected_options!='') {
                    //     if(_min>$('#pre-selected-options').val().length){
                    // _min = $('#pre-selected-options').val().length;
                    //     }
                    // }
                    //     firstOpen = false;
                    // }
                }
                activeRequest = false;
                $('.loader1').hide();
                $('.loader1').addClass('hidden');
                $('.backwrap').hide();
                $('.backwrap').addClass('hidden');
                var req_from = $('#req_from').val();
                if (req_from === 'cma') {
                    $("#cma-tbl-list tbody td a").html("CHOOSE");
                    $("#create-report").show();
                    $("#run-pma-form").show();
                    $('html, body').animate({
                        scrollTop: $("#create-report").offset().top
                    }, 500);
                }
                if (all_comp.length + sorted_comp.length < 4) {
                    $('#changes_req_params_property_search .submit-btn').prop('disabled', false);
                    Notify('Warning', 'Less then 4 comparable found, please change the setting and try again.', 'warning');
                    // if (!data.use_rets && (all_comp.length + sorted_comp.length < 4)) {
                    $('#property_search_model').modal({ backdrop: 'static', keyboard: false })
                    $('#property_search_model').modal('show');
                    $('#changes_req_params_property_search #apn').val(dataObj.apn);
                    // $('#changes_req_params_property_search #property_address').val(dataObj.Address);
                    $('#changes_req_params_property_search select#sqft option[value="' + defaultSqft + '"]').attr("selected", true);
                    $('#changes_req_params_property_search select#radious option[value="' + defaultRadius + '"]').attr("selected", true);
                    // $("#property_search_model").modal("toggle");

                    return false;
                } else {
                    $('#property_search_model').modal('hide');
                }
            },
            error: function () {
                $('.loader1').hide();
                $('.loader1').addClass('hidden');
                $('.backwrap').hide();
                $('.backwrap').addClass('hidden');
                console.log("An error occurred while processing data");
                activeRequest = false;
                alert("An error occurred while processing data. Please refresh Page");
            }
        });
    }
}

$("#changes_req_params_property_search").submit(function (e) {
    $('#changes_req_params_property_search .submit-btn').prop('disabled', true);
    e.preventDefault();
    let apn = $('#changes_req_params_property_search #apn').val();
    defaultSqft = $('#changes_req_params_property_search #sqft').val();
    defaultRadius = $('#changes_req_params_property_search #radious').val();
    dataObj.apn = apn;
    if (defaultBKFlag == 1) {
        dataObj.ClientReference = '<CustCompFilter><SQFT>' + defaultSqft + '</SQFT><Radius>' + defaultRadius + '</Radius></CustCompFilter>';
    }
    getSordrtedProperties = true;
    $('.ms-container').remove();
    compileAPNRequest(dataObj);
});

var isOwnerDetailsFetched = false;
function parse187() {
    var ownerNamePrimary = $(reportXML).find("PropertyProfile").find("PrimaryOwnerName").text();
    var ownerNameSecondary = $(reportXML).find("PropertyProfile").find("SecondaryOwnerName").text();
    residentialType = $(reportXML).find("PropertyProfile").find("PropertyCharacteristics").find("UseCode").text();
    if (ownerNamePrimary.indexOf(';') !== -1) {
        ownerNameSecondary = ownerNamePrimary.substr(ownerNamePrimary.indexOf(";") + 1)
        ownerNamePrimary = ownerNamePrimary.slice(0, ownerNamePrimary.indexOf(";"));
    }
    ownerNamePrimary = $.trim(ownerNamePrimary);
    ownerNameSecondary = $.trim(ownerNameSecondary);
    ownerNamePrimary = toTitleCase(ownerNamePrimary);
    ownerNameSecondary = toTitleCase(ownerNameSecondary);
    ownerNamePrimary = ownerNamePrimary.replace(',', '');
    ownerNameSecondary = ownerNameSecondary.replace(',', '');
    ownerNamePrimaryLast = ownerNamePrimary.split(' ')[0];
    ownerNameSecondaryLast = ownerNameSecondary.split(' ')[0];
    ownerNamePrimary = ownerNamePrimary.substr(ownerNamePrimary.indexOf(" ") + 1) + ' ' + ownerNamePrimaryLast;
    if (ownerNameSecondary) {
        ownerNameSecondary = ' & ' + ownerNameSecondary.substr(ownerNameSecondary.indexOf(" ") + 1) + ' ' + ownerNameSecondaryLast;
    }
    $('.js-lp-seller-name').val(ownerNamePrimary + ownerNameSecondary);
    $('.search-result table .result-owner').html(ownerNamePrimary + ownerNameSecondary);
    isOwnerDetailsFetched = true;
}

// run query for plat map report 
function getPlat() {
    var request = 'http://api.sitexdata.com/sitexapi/sitexapi.asmx/AddressSearch?';
    request += $.param(dataObj);
    $.ajax({
        url: base_url + 'index.php?/lp/getSearchResults?',
        // url: 'http://cardbanana.net/demo/jerry/lp/lp/lp/proxy.php',
        data: {
            requrl: request + '?&reportType=111'
        },
        dataType: 'xml'
    })
        .done(function (response, textStatus, jqXHR) {
            reportUrl = $(response).find('ReportURL').text();
            reportData.report111 = reportUrl;
        });
}

// list info returned from API request
function listResults(response) {
    // display the returned address(es) under search results
    getPlat(address, zip);
    $('.result-table > tbody').show();
    var address = $(response).find('Locations').find('Location').find('Address').text();
    var apn = $(response).find('Locations').find('Location').find('APN').text();
    var city = $(response).find('Locations').find('Location').find('City').text();
    var state = $(response).find('Locations').find('Location').find('State').text();
    var zip = $(response).find('Locations').find('Location').find('ZIP').text();

    $('#lp_invoice .desc h3').html(address + ',' + city + ',' + state + ',' + zip);
    addResultToRepData(address, city, state, zip, apn);
    getDropItems();
}

// record report 187 URL 
function compileXmlUrls(response, report) {
    // get the url for each report
    reportUrl = $(response).find('ReportURL').text();
    reportData.report187 = reportUrl;
}

// list multiple APNs returned in address query
function multipleResults(response) {
    $('.search-result table > tbody').html('');
    $(response).find('Locations').children('Location').each(function (i) {
        var address = $(this).find('Address').text();
        var unitNumber = $(this).find('UnitNumber').text();
        apn = $(this).find('APN').text();
        apnInfo[apn] = {}
        var city = $(this).find('City').text();
        var state = $(this).find('State').text();
        var zip = $(this).find('ZIP').text();
        apnInfo[apn]['fips'] = $(this).find('FIPS').text();
        let presentation = $("#wizard #presentation").val();
        if (presentation == 'marketUpdate') {
            $('.search-result table > tbody').append('<tr><td><span class="result-apn"></span></td><td><span class="result-unitNumber"></span></td><td><span class="result-address"></span></td><td><span class="result-owner"></span></td><td><span class="result-city"></span></td><td><a href="javascript:;" class="btn btn-sm btn-default" onclick="themePreview(this)">Choose</a></td></tr>');
        } else {
            $('.search-result table > tbody').append('<tr><td><span class="result-apn"></span></td><td><span class="result-unitNumber"></span></td><td><span class="result-address"></span></td><td><span class="result-owner"> <strong> Fetching owner details ... </strong></span></td><td><span class="result-city"></span></td><td><a href="javascript:;" class="btn btn-sm btn-default" onclick="apnData(this)">Choose</a></td></tr>');
        }
        $('.search-result table > tbody').find('tr').eq(i).find('.result-apn').text(apn);
        $('.search-result table > tbody').find('tr').eq(i).find('.result-unitNumber').text(unitNumber);
        $('.search-result table > tbody').find('tr').eq(i).find('.result-address').text(address);
        $('.search-result table > tbody').find('tr').eq(i).find('.result-city').text(city);
    });

    if ($(".cma-step-2").length) {
        $(".cma-step-2").hide();
    }
    if ($("#cma-tbl-list").length) {
        $('#cma-tbl-list').DataTable({
            "dom": '<"table_filter"fl>rt<"table_navigation"ip>',
            aaSorting: [],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.childRowImmediate,
                    type: 'none',
                    target: ''
                }
            },
            'columnDefs': [{
                'targets': [5], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }],
            searching: false, paging: false, info: false,
            "initComplete": function () {

            },
            "language": {
                "processing": "<div class='text-center'><i class='fa fa-spinner fa-spin admin-fa-spin ma-font-24'></div>",
                "emptyTable": "<div align='center'>Record(s) not found.</div>"
            },
        });

        $('html, body').animate({
            scrollTop: $("#cma-tbl-list").offset().top
        }, 500);

    }

}

// add info on returned property to reportData object
function addResultToRepData(address, city, state, zip, apn) {
    //address = address.replace('.', '');
    address = address.replace('#', '');
    address = address.replace('/', ' ');
    reportData.address = address;
    reportData.city = city;
    reportData.state = state;
    reportData.zip = zip;
    reportData.apn = apn;
}

function themePreview(e) {
    setTimeout(function () {
        jQuery('.buttonNext').click();
    }, 400);

    isNewSearch = false;
    $('#lp_invoice .desc').html('<h3>' + $(e).closest('tr').find('.result-address').text() + '</h3>' + $(e).closest('tr').find('.result-apn').text() + ' ' + $(e).closest('tr').find('.result-address').text() + ' ' + $(e).closest('tr').find('.result-city').text());
    var apn = $(e).closest('tr').find('.result-apn').text();
    var fips = apnInfo[apn]['fips'];
    dataObj = {};
    dataObj.apn = apn;
    dataObj.FIPS = fips;
    dataObj.ClientReference = '<CustCompFilter><SQFT>' + defaultSqft + '</SQFT><Radius>' + defaultRadius + '</Radius></CustCompFilter>'; //'<CustCompFilter><SQFT>0.20</SQFT><Radius>0.75</Radius></CustCompFilter>';
    // compileAPNRequest(dataObj);
}
// compile data for APN search
function apnData(event) {
    const BUTTON_CLICK_DELAY = 400;
    const ALERT_MESSAGE = "Please wait while we fetch owner details.";
    const DESC_SELECTOR = '#lp_invoice .desc';

    if (!isOwnerDetailsFetched) {
        alert(ALERT_MESSAGE);
        return false;
    }

    setTimeout(() => {
        $('.buttonNext').click();
    }, BUTTON_CLICK_DELAY);

    isNewSearch = false;
    const row = $(event).closest('tr');
    const address = row.find('.result-address').text();
    const apn = row.find('.result-apn').text();
    const city = row.find('.result-city').text();
    const fips = apnInfo[apn]['fips'];

    $(DESC_SELECTOR).html(`<h3>${address}</h3>${apn} ${address} ${city}`);

    dataObj = {
        apn: apn,
        FIPS: fips,
        ClientReference: '<CustCompFilter><SQFT>' + defaultSqft + '</SQFT><Radius>' + defaultRadius + '</Radius></CustCompFilter>'
    };
    compileAPNRequest(dataObj);
}

// complie URL for APN search
function compileAPNRequest(dataobj) {
    var request = 'http://api.sitexdata.com/sitexapi/sitexapi.asmx/ApnSearch?';
    request += $.param(dataObj);
    runQueries(request);
}

// display error returned in API query
function displayError(responseStatus) {
    // determine and display specific error
    var errorDisplay = "";
    switch (responseStatus) {
        case 'NM':
            error = 'No exact match';
            break;
        case 'NC':
            error = 'Out of coverage area';
            break;
        case 'IP':
            error = 'Invalid IP';
            break;
        case 'IK':
            error = 'Invalid key';
            break;
        case 'IR':
            error = 'Invalid report type';
            break;
        case 'IN':
            error = 'Invalid property address. Please try once with Zip Code instead of City.';
            break;
        case 'CR':
            error = 'No credits';
            break;
        case 'NH':
            error = 'Valid address, but no hit';
            break;
        default:
            error = "Error"
    }
    $('.pma-error').text(error);
    $('.pma-error').show();
    $('.buttonNext').addClass("buttonDisabled");
}

// use Google Places API to autocomplete address searches and bias suggestions to California
function autoComplete() {
    var input = document.getElementById('searchbox');
    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(-32.30, 114.8),
        new google.maps.LatLng(-42, 124.24)); // latitude and longitude ranges of California
    var options = {
        componentRestrictions: {
            country: [],
            // country: 'us'
        },
        bounds: defaultBounds
    };
    autocomplete = new google.maps.places.Autocomplete(input, options);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace(); // get address, without city and state
        var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
        /*
        map.setCenter(latlng);
        if(marker){
            marker.setPosition(latlng);
          }else{
             marker = new google.maps.Marker({
                  position: latlng,
                  map: map,
                  // title: 'Hello World!'
              });
          }
          */
        setTimeout(function () {
            $('#searchbox').val(place.name);
        }, 25); // just display street address
        for (var i = 0; i < place.address_components.length; i++) {
            //for (var j = 0; j < place.address_components[i].types.length; j++) {
            if (place.address_components[i].types[0] === ("locality") && place.address_components[i].types.length > 1 && place.address_components[i].types[1] === ("political")) { //administrative_area_level_1
                var city = place.address_components[i].long_name;
                $('#searchboxcity').val(city);
            } else if (place.address_components[i].types[0] === ("administrative_area_level_1") && place.address_components[i].types.length > 1 && place.address_components[i].types[1] === ("political")) { //administrative_area_level_1
                var state = place.address_components[i].short_name;
                $('#state').val(state);
            } else if (place.address_components[i].types[0] === "neighborhood" && place.address_components[i].types.length > 1 && place.address_components[i].types[1] === ("political")) { //administrative_area_level_1) {
                var neighborhood = place.address_components[i].long_name;
                $('#neighbourhood').val(neighborhood);
            }
            //}
        }
    });
}

function widgetRunPMA(agentPath, logoPath) {
    firstModal = false;
    if (agentPath) {
        reportData.agentPath = agentPath;
    }
    if (logoPath) {
        reportData.logoPath = logoPath;
    }
    var query = $.param(reportData);
    var formData = $('#run-pma-form').serialize();
    query += '&' + formData;

    var testimonials = [];
    testimonials.push($("#testimonial-1").val());
    testimonials.push($("#testimonial-2").val());
    testimonials.push($("#testimonial-3").val());
    testimonials.push($("#testimonial-4").val());

    query += '&testimonials=' + encodeURIComponent(JSON.stringify(testimonials));

    var testimonials_name = [];
    testimonials_name.push($("#testimonial-name-1").val());
    testimonials_name.push($("#testimonial-name-2").val());
    testimonials_name.push($("#testimonial-name-3").val());
    testimonials_name.push($("#testimonial-name-4").val());

    query += '&testimonials_name=' + encodeURIComponent(JSON.stringify(testimonials_name));
    var bio = encodeURIComponent($("#agent-bio").val());
    query += '&bio=' + bio;

    var featured_homes = [];
    if ($("#update-featured").length > 0) {
        for (var featured_i = 0; featured_i <= 3; featured_i++) {
            featured_homes[featured_i] = {}
            featured_homes[featured_i].image = $("#featured_" + featured_i + "_image_val").val();
            featured_homes[featured_i].price = $("#featured_" + featured_i + "_price").val();
            featured_homes[featured_i].address = $("#featured_" + featured_i + "_address").val();
            featured_homes[featured_i].city = $("#featured_" + featured_i + "_city").val();
        }

        query += '&featured_homes=' + JSON.stringify(featured_homes);
    }

    query += '&' + 'pdfID=' + pdfID;
    var pages = $('#pdf_pages').val();
    query += '&' + 'pdfPages=' + pages;
    query += "&showpartner=" + $('input.add-partner:checked').val();
    if ($('#addNewPartner').css('display') == 'none') {
        query += '&' + 'showpartner=off';
    } else {
        query += '&' + 'showpartner=on';
    }

    query += '&' + 'custom_comps=' + JSON.stringify($('#pre-selected-options').val());
    var presentation = $("#wizard #presentation").val();
    if ($('#comparable-pre-selected-options').length && presentation == 'marketUpdate') {
        query += '&' + 'comparable_custom_comps=' + JSON.stringify($('#comparable-pre-selected-options').val());
    }
    if (presentation == 'seller') {
        query += '&' + 'use_rets_api=' + use_rets_api;
    }
    // Dynamic contents
    // config-page-modals
    $('.config-page-modals .more-page-config').each(function (i, obj) {
        if ($(this).attr('name') && $(this).attr('name') != "") {
            query += '&' + $(this).attr('name') + "=" + encodeURIComponent($(this).val());

        }
    });

    if (activeRequest && xhr) {
        activeRequest = false;
        xhr.abort();
    }
    // return;
    activeRequest = true;
    var errorMsg = "PDF Generation failed. Our team is looking into the matter. Please try again in a bit.";

    xhr = $.ajax({
        url: base_url + 'widget/getWidgetPropertyData',
        type: 'POST',
        data: query
    })
        .done(function (response) {
            pdfGenerated = false;
            var obj = JSON.parse(response);
            try {
                var obj = JSON.parse(response);
                if (obj.status == 'success') {
                    pdfGenerated = true;
                    pmaRes = { status: "success" };
                    if (obj.project_id) {
                        $("#payment-form #project_id").val(obj.project_id);;
                    }
                }
            } catch (e) {
                //return false;
            }
            if (!pdfGenerated) {
                $('#apply-coupan-alert').html(errorMsg).removeClass('alert-success').addClass('alert-danger').show();
                setTimeout(() => {
                    //SET TIME OUT because its add static error message from footer.php SO update exact error message after 1 second.
                    if (obj.msg != '') {
                        if (typeof obj.showError !== 'undefined' && (obj.showError == true || obj.showError == 'true')) {
                            $('#apply-coupan-alert').html(obj.msg).removeClass('alert-success').addClass('alert-danger').show();
                        }
                    }
                }, 1000);
                $('.btn-checkout').hide();
                $('.btn-lp.pay').hide();
                if (obj.msg != '') {
                    // Error Message passed to CMA response.
                    pmaRes = { status: "failed", msg: obj.msg };
                } else {
                    pmaRes = { status: "failed", msg: errorMsg };
                }
            }

            activeRequest = false;
            $('.loader1').hide();
            $('.backwrap').hide();
        })
        .fail(function () {
            $('#apply-coupan-alert').html(errorMsg).removeClass('alert-success').addClass('alert-danger').show();
            $('.btn-checkout').hide();
            $('.btn-lp.pay').hide();
            pmaRes = { status: "failed", msg: errorMsg };
            $('.loader1').hide();
            $('.backwrap').hide();
        })
        .always(function () {
            activeRequest = false;
        });


}

function getRetsApiComparables(address, is_simply_rets) {
    $('.loader1').show();
    $('.loader1').removeClass('hidden');
    $('.backwrap').show();
    $('.backwrap').removeClass('hidden');
    var search_city = $("#searchboxcity").val();

    $.ajax({
        url: base_url + 'widget/getRetsApiComparablesData/' + is_simply_rets,
        type: 'POST',
        data: { address: address, city: search_city }
    })
        .done(function (response) {
            var data = JSON.parse(response);
            all_comp = data.all;
            sorted_comp = data.sorted;
            $('#pre-selected-options').html('');
            $.each(all_comp, function (i, item) {
                $('#pre-selected-options').append($('<option>', {
                    value: i,
                    text: item.address + " (" + item.price + ")"
                }));
            });

            $.each(sorted_comp, function (i, item) {
                $('#pre-selected-options').append($('<option>', {
                    value: i,
                    text: item.address + " (" + item.price + ")",
                    selected: 'selected'
                }));
            });

            $('.loader1').hide();
            $('.loader1').addClass('hidden');
            $('.backwrap').hide();
            $('.backwrap').addClass('hidden');
        })
        .fail(function () {
        })
        .always(function () {
        });
}

function getRetsApiDataByMlsId(mlsId, is_simply_rets) {
    var dismis_alert = `<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>`;
    if (mlsId == '') {
        var msg = '<div class="alert alert-warning">Please enter mlsId' + dismis_alert + '</div>';
        $("#select-comps .msg-container").html(msg);
        return false;
    }
    if ($("#pre-selected-options option[value='" + mlsId + "']").length > 0) {


        var msg = '<div class="alert alert-warning">This property is already exist in the list' + dismis_alert + '</div>';
        $("#select-comps .msg-container").html(msg);

        return false;
    }
    else {

        $("#select-comps .msg-container").html('');


        $('.loader1').show();
        $('.loader1').removeClass('hidden');
        $('.backwrap').show();
        $('.backwrap').removeClass('hidden');
        $('#mls_search').prop('disabled', true);
        var mlsId_param = encodeURIComponent(mlsId);

        $.ajax({
            url: base_url + 'widget/getRetsApiDataByMlsId/' + mlsId_param + '/' + is_simply_rets,
            type: 'GET',
        })
            .done(function (response) {
                var data = JSON.parse(response);
                all_comp = data.all;
                sorted_comp = data.sorted;
                $("#select-comps .msg-container").html('');
                if ($(sorted_comp).length > 0) {

                    var exist_list = added_in_list = '';

                    $.each(sorted_comp, function (i, item) {



                        if ($("#pre-selected-options option[value='" + i + "']").length > 0) {
                            exist_list += '<div>' + $("#pre-selected-options option[value='" + i + "']").text() + '</div>';
                        }
                        else {

                            $('#pre-selected-options').append($('<option>', {
                                value: i,
                                text: item.address + " (" + item.price + ")",
                                selected: 'selected'
                            }));
                            added_in_list += '<div>' + item.address + '</div>';

                        }


                    });
                    if (added_in_list != '') {

                        var msg = '<div class="alert alert-success"> Following property added in comparables list: ' + dismis_alert + added_in_list + '</div>';
                        $("#select-comps .msg-container").append(msg);
                    }
                    if (exist_list != '') {

                        var msg = '<div class="alert alert-warning"> Following property already exist in the list: ' + dismis_alert + exist_list + '</div>';
                        $("#select-comps .msg-container").append(msg);
                    }
                    $("#pre-selected-options").multiSelect('refresh');
                }
                else {
                    var msg = '<div class="alert alert-warning">No property found with Address Or Mls #  : ' + mlsId + ' ' + dismis_alert + '</div>';
                    $("#select-comps .msg-container").html(msg);

                }



            })
            .fail(function () {
                alert("Something went wrong");
            })
            .always(function () {
                $('.loader1').hide();
                $('.loader1').addClass('hidden');
                $('.backwrap').hide();
                $('.backwrap').addClass('hidden');
                $('#mls_search').prop('disabled', false);

            });
    }

}