
$(document).ready(function() {

    var isNewSearch=false;
    jQuery(".loaders").css({"opacity": "0","display":"none"});
    jQuery(".loader-back").animate({"opacity": "1","display":"block"});
    $('.buttonNext').addClass("buttonDisabled");
    $('.pma-table').hide();
    $('.file-change').hide();
    $('#search-btn').on('click', getAddress);
    $('.js-run-pma-button').hide();

    $('#run-pma-form').submit(function(){
        console.log(reportData);
        console.log("Submittting run-pma-form");
        return false;
    });

    autoComplete();
    dataObj = {};
    // create dialog to plug in realtor info prior to generating report
    // $('.progress-bar').progressbar({
    //     value: false
    // });
    // $('.progress-bar').hide();
    // $('#run-pma-dialog').dialog({
    //     autoOpen: false,
    //     height: 610,
    //     width: 580,
    //     resizable: false,
    //     draggable: false,
    //     closeOnEscape: true,
    //     position: ['center', 80],
    //     modal: true
    // });
    // $(".ui-dialog-titlebar").hide();
    // $(".ui-widget-overlay").on("click", function() {
    //     $('#run-pma-dialog').dialog("close");
    // });
    pdfID = '';
    firstModal = true;
    $(document).on('click', '.js-run-pma-button', function() {
        $('#run-pma-dialog').dialog('open');
        pdfID = makeID();
    });
    // $('.recent-listings tr').hide();
    // $('.file-change').on('click', changeFile);
    reportXML = '';
    comparableData = [];
    all_comp = [];
    sorted_comp = [];
    reportData = {};
    getSordrtedProperties = false;
    // dataTransfer('no');
    apnInfo = {};
    // $(document).on('click', '.js-run-apn-button', apnData);
    activeRequest = false;
    pmaRes = {};

    $('#paynow').click(function(){
        $('.loader1').show();
        $('.loader1').removeClass('hidden');
        $('.backwrap').show();
        $('.backwrap').removeClass('hidden');
        isPdfGenerated();
    }); 
});


function isPdfGenerated(){
    setTimeout(function(){
        if(activeRequest && !pdfGenerated){
            isPdfGenerated();
        } else if(! pdfGenerated){
            $('.loader1').hide();
            $('.backwrap').hide();
            $('#apply-coupan-alert').html("We did not process your payment as PDF Generation failed. Our team is looking into the matter. Please try again in a bit.").removeClass('alert-success').addClass('alert-danger').show();
            $('.loader1').hide();
            $('.backwrap').hide();
        }else {
            $('#payment-form').submit();
        }
    },1000);
}

var xhr;
var activeRequest = false;
var pdfGenerated = false;
function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
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
        .done(function(response) {
            var dropData = $.parseJSON(response);
            console.log(dropData[0]);
            console.log(dropData[1]);
            var realtors = dropData[0];
            var companies = dropData[1];
            realtors = realtors.sort();
            companies = companies.sort();
            textDropdown(realtors, '#lp-realtor-name');
            textDropdown(companies, '#lp-realtor-company');
        })
        .fail(function() {})
}

// Get archived company and agent dropdown info for customized info form
function textDropdown(dropArray, id) {
    console.log(dropArray);
    var $input = $(id).autocomplete({
        source: dropArray,
        minLength: 0,
        select: function(e, ui) {
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
            .click(function() {
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
        .done(function(response) {
            console.log(response)
            populateData(response);

        })
        .fail(function() {})
}


// populate customized info form based on previously used agent or company
function populateData(response) {
    var formItems = $.parseJSON(response);
    console.log(formItems);
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

    //$('#lp-realtor-picture').val(agentpic);

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
    $(this).hide()
    console.log(event)
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
    // $('#run-pma-dialog').dialog('close');
    // $('.progress-bar').progressbar("option", "value", false);
    // $('.progress-bar').show();
    // reportData.rep = $('#lp-rep-name option:selected').val();
    if (agentPath) {
        reportData.agentPath = agentPath;
    }
    if (logoPath) {
        reportData.logoPath = logoPath;
    }
    // recordFormData();
    var query = $.param(reportData);
    var formData = $('#run-pma-form').serialize();
    query += '&' + formData;    

    query += '&' + 'pdfID=' + pdfID;
    query +="&showpartner="+$('input.add-partner:checked').val();
    if($('#addNewPartner').css('display')=='none'){
        query += '&' + 'showpartner=off';
    }else{
        query += '&' + 'showpartner=on';
    }
    query += '&' + 'theme=' + rgb2hex($('.custom-checkbox:checked').val());		//this line comment by vijay 
    // query += '&' + 'report_lang=' + $("select[name='report_lang']").val();
    query += '&' + 'custom_comps=' + JSON.stringify($('#pre-selected-options').val());
    //console.log(query);
    if(activeRequest){
        activeRequest=false;
        xhr.abort();
    }
    console.log(query); 
    // return;
    activeRequest=true;
    var errorMsg = "PDF Generation failed. Our team is looking into the matter. Please try again in a bit.";

    xhr = $.ajax({
        url: base_url+'index.php?/lp/getPropertyData',
        type: 'POST',
        data: query
    })
        .done(function(response) {
            console.log(response);
            var obj = JSON.parse(response);
            console.log(obj);
            try {
                var obj = JSON.parse(response);
                if(obj.status=='success'){
                    pdfGenerated = true;
                    pmaRes =  {status:"success"};
                }
            } catch (e) {
                //return false;
            }
            if(!pdfGenerated){
                $('#apply-coupan-alert').html(errorMsg).removeClass('alert-success').addClass('alert-danger').show();
                setTimeout(() => {
                    //SET TIME OUT because its add static error message from footer.php SO update exact error message after 1 second.
                    if (obj.msg != '') {
                        if (typeof obj.showError !== 'undefined' && (obj.showError==true || obj.showError=='true')) { 
                            $('#apply-coupan-alert').html(obj.msg).removeClass('alert-success').addClass('alert-danger').show();
                        }
                    }
                }, 1000);
                $('.btn-checkout').hide();
                $('.btn-lp.pay').hide();
                if (obj.msg != '') {
                    // Error Message passed to CMA response.
                    pmaRes =  {status:"failed",msg:obj.msg};
                } else {
                    pmaRes =  {status:"failed",msg:errorMsg};
                }
            }
            // returnReport();
            activeRequest=false;
            // $('#step-4 .loader1').addClass('hidden');
            // $('#step-4 .backwrap').addClass('hidden');
        })
        .fail(function() {
            $('#apply-coupan-alert').html(errorMsg).removeClass('alert-success').addClass('alert-danger').show();
            $('.btn-checkout').hide();
            $('.btn-lp.pay').hide();
            pmaRes =  {status:"failed",msg:errorMsg};
            //$('.pma-error').text('PDF Generation failed. Please try again.');
        })
        .always(function() {
            activeRequest = false;
        });


}

// compiles data from customized info form to send to database for future reports that use same company or agent 
function recordFormData() {
    var query = $('#run-pma-form').serialize();
    query += '&lp-realtor-picture=' + reportData.agentPath;
    query += '&lp-realtor-logo=' + reportData.logoPath;
    console.log(query);
    $.ajax({
        url: 'lp/store-form.php',
        type: 'POST',
        data: query
    })
        .done(function(response) {
            console.log(response);
        })
        .fail(function() {})
}


function returnReport() {
    //event.preventDefault();
    // $('#searchbox').val('');
    // $('#searchboxcity').val('');
    // $('.progress-bar').hide(); // hide the loading bar
    var pdfLink = 'lp/files/listings/' + reportData.address + ' ' + pdfID + '.pdf'; // create link for PDF report
    console.log("return report", pdfLink);
    reportData.link = pdfLink;
    dataTransfer('yes');
}

// send report link and info to database
function dataTransfer(status) {
    var query = $.param(reportData);
    query += '&dataUpdate=' + status;
    console.log(query);
    $.ajax({
        url: 'lp/lp-data.php',
        type: 'POST',
        data: query
    })
        .done(function(response) {
            console.log(response)
            updateTally(response);
        })
        .fail(function() {
            $('.pma-error').text('Problem updating database');
        })
}


// update tally of total reports ran and total cost (net and per agent)
function updateTally(tallies) {
    tallyData = $.parseJSON(tallies);
    $('.pma-total h5').text(tallyData.total);
    $('.accrued-cost h5').text(tallyData.cost);
    console.log(tallyData);
    $('.rep-table tr').each(function() {
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
    isNewSearch=true;
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
        if(state!==''){
            locale += ', '+state;
        } else {
            locale += ', CA' // if locale is city rather than zip, add in state
        }
    }
    neighbourhood = $('#neighbourhood').val();
    neighbourhood = $.trim(neighbourhood);
    if (isNaN(neighbourhood[0])) {
        if(state!==''){
            neighbourhood += ', '+state;
        } else {
            neighbourhood += ', CA' // if neighbourhood is city rather than zip, add in state
        }
    }
    data(address, locale,neighbourhood,false);
}


// compile data for API query
function data(address, locale,neighbourhood,retry) {
    dataObj.Address = address;
    dataObj.LastLine = locale.toString();
    dataObj.ClientReference = '<CustCompFilter><SQFT>0.20</SQFT><Radius>0.75</Radius></CustCompFilter>';
    dataObj.OwnerName = '';
    compileRequest(dataObj,neighbourhood,retry);
}



// create url for API request
function compileRequest(dataObj,neighbourhood,retry) {
    // var request = 'http://api.sitexdata.com/sitexapi/sitexapi.asmx/AddressSearch?';
    var request ='http://api.sitexdata.com/sitexapi/sitexapi.asmx/AddressSearch?'
    if(retry){
        dataObj.LastLine = neighbourhood.toString();
        console.log(dataObj.LastLine);
    }
    request += $.param(dataObj);
    runQueries(request,dataObj,neighbourhood,retry);
}

// run api query 
function runQueries(request,dataObj,neighbourhood,retry) {
    //console.log(request);
    //console.log(base_url+'index.php?/lp/getSearchResults');
    $.ajax({
        url: base_url+'index.php?/lp/getSearchResults?',
        // url: 'http://cardbanana.net/demo/jerry/lp/lp/lp/proxy.php',
        data: {
            requrl: request + '&reportType=187'
        },
        dataType: 'xml'
    })
        .done(function(response, textStatus, jqXHR) {
            var responseStatus = $(response).find('StatusCode').text();
            console.log(responseStatus);
            // $('.progress-bar').hide();
            $("#search-btn").parents("form").find(".search-loader").addClass("hidden");
            
            if (responseStatus == 'MM') {
                multipleResults(response);
                $("#search-btn").parents("form").find("table").removeClass("hidden");
                $(".buttonNext").removeClass("buttonDisabled");
            } else if (responseStatus != 'OK') {
                if(!retry){
                    $("#search-btn").parents("form").find(".search-loader").removeClass("hidden");
                    data(dataObj.Address,dataObj.LastLine,neighbourhood,true);
                }else {
                    displayError(responseStatus);
                }
            } else {
                compileXmlUrls(response, '187');
                get187();
                // listResults(response);
                if(isNewSearch){
                    multipleResults(response);
                }
                $("#search-btn").parents("form").find("table").removeClass("hidden");
                $(".buttonNext").removeClass("buttonDisabled");
            }
        })
        .fail(function(err) {
            $('.pma-error').text('Unsuccessful Request');
            $(".buttonNext").addClass("buttonDisabled");
        });
}

// gets 187 for client-side parsing
function get187() {
    console.log('running 187',reportData.report187)
    if(!getSordrtedProperties){
        getSordrtedProperties = true;
        $.ajax({
            type: "GET",
            // url: "lp/xmlproxy.php",
            url: base_url+'index.php?/lp/getSearchResults?',
            data: {
                requrl: reportData.report187,
            },
            dataType: "xml",
            success: function(xml) {
                reportXML = xml;
                parse187();
            },
            error: function() {
                console.log("An error occurred while processing XML file.");
            }
        });
    } else {
        activeRequest=true;
        $.ajax({
            type: "GET",
            url: base_url+'index.php?/lp/getSearchResults?',
            data: {
                requrl: reportData.report187,
                getsortedresults: getSordrtedProperties
            },
            dataType: "json",
            success: function(data) {
                all_comp = data.all;
                sorted_comp = data.sorted;
                $('#pre-selected-options').html('');
                $('#comparable-pre-selected-options').html('');
                // $('#available-comparables-market-update tbody').html('');

                $.each(all_comp, function(i, item) {                    
                    $('#pre-selected-options').append($('<option>', {
                        value: item.index,
                        text: item.Address+" ("+item.Price+")"
                    }));

                    $('#comparable-pre-selected-options').append($('<option>', {
                        value: item.index,
                        text: item.Address+" ("+item.Price+")"
                    }));
                    
                    // $('#available-comparables-market-update tbody').append('<tr><td>'+item.Address+" ("+item.Price+")"+'</td></tr>');
                });
                
               // $('#comparables-market-update tbody').html('');
                $.each(sorted_comp, function(i, item) {
                    $('#pre-selected-options').append($('<option>', {
                        value: item.index,
                        text: item.Address+" ("+item.Price+")",
                        selected: 'selected'
                    }));

                    $('#comparable-pre-selected-options').append($('<option>', {
                        value: item.index,
                        text: item.Address+" ("+item.Price+")",
                        selected: 'selected'
                    }));
                    
                    /*$('#comparables-market-update tbody').append('<tr><td>'+item.Address+" ("+item.Price+")"+'</td></tr>');*/
                });
                if($('#comparable-pre-selected-options').length)
                {
                    $('#comparable-pre-selected-options').multiSelect({
                        selectableHeader: "<div class='multiselect-header2'>Available Comparables</div>",
                        selectionHeader: "<div class='multiselect-header'>Comparables You Want To Use</div>",
                    });
                }
                activeRequest=false;
            },
            error: function() {
                console.log("An error occurred while processing data");
                activeRequest=false;
                alert("An error occurred while processing data. Please refresh Page");
            }
        });
    }
}


function parse187() {
    console.log('success')
    var ownerNamePrimary = $(reportXML).find("PropertyProfile").find("PrimaryOwnerName").text();
    var ownerNameSecondary = $(reportXML).find("PropertyProfile").find("SecondaryOwnerName").text();
    if(ownerNamePrimary.indexOf(';') !== -1)
      {
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
//    var comparables = $(reportXML).find("ComparableSalesReport").find("ComparableSales").find("ComparableSale");
//    for(var i=0;i<comparables.length;i++){
//        //console.log($(comparables[i]).find("SiteAddress").text().+' '+.$(comparables[i]).find("SiteCity").text());
//        comparableData.push($(comparables[i]).find("SiteAddress").text()+' '+$(comparables[i]).find("SiteCity").text());
//    }
//    console.log(comparableData);
//    console.log("I AM Called");
}

// run query for plat map report 
function getPlat() {
    var request = 'http://api.sitexdata.com/sitexapi/sitexapi.asmx/AddressSearch?';
    request += $.param(dataObj);
    $.ajax({
        url: base_url+'index.php?/lp/getSearchResults?',
        // url: 'http://cardbanana.net/demo/jerry/lp/lp/lp/proxy.php',
        data: {
            requrl: request + '?&reportType=111'
        },
        dataType: 'xml'
    })
        .done(function(response, textStatus, jqXHR) {
            console.log(response);
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

    $('#lp_invoice .desc h3').html(address+','+ city+',' +state + ','+ zip);
    addResultToRepData(address, city, state, zip, apn)
    // $('.result-apn').text(apn);
    // $('.result-address').text(address);
    // $('.result-city').text(city);
    // $('.js-run-pma-button').show();
    getDropItems();
}

// record report 187 URL 
function compileXmlUrls(response, report) {
    // get the url for each report
    reportUrl = $(response).find('ReportURL').text();
    reportData.report187 = reportUrl;
}

// list multiple APNs returned in address query
function multipleResults(response) { //console.log(response);
    $('.search-result table > tbody').html('');
    $(response).find('Locations').children('Location').each(function(i) {
        var address = $(this).find('Address').text();
        var unitNumber = $(this).find('UnitNumber').text();
        apn = $(this).find('APN').text();
        apnInfo[apn] = {}
        var city = $(this).find('City').text();
        var state = $(this).find('State').text();
        var zip = $(this).find('ZIP').text();
        //var owner = $(this).find('PrimaryOwnerName').text();
        apnInfo[apn]['fips'] = $(this).find('FIPS').text();
        console.log('fips1= ' + apnInfo[apn]['fips']);
        $('.search-result table > tbody').append('<tr><td><span class="result-apn"></span></td><td><span class="result-unitNumber"></span></td><td><span class="result-address"></span></td><td><span class="result-owner"></span></td><td><span class="result-city"></span></td><td><a href="javascript:;" class="btn btn-sm btn-default" onclick="apnData(this)">Choose</a></td></tr>');
        $('.search-result table > tbody').find('tr').eq(i).find('.result-apn').text(apn);
        $('.search-result table > tbody').find('tr').eq(i).find('.result-unitNumber').text(unitNumber);
        $('.search-result table > tbody').find('tr').eq(i).find('.result-address').text(address);
        //$('.search-result table > tbody').find('tr').eq(i).find('.result-owner').text(address);
        $('.search-result table > tbody').find('tr').eq(i).find('.result-city').text(city);
        // $('.js-run-apn-button').show();
    });
    $('input[type="checkbox"], input[type="radio"]').iCheck({
      checkboxClass: 'icheckbox_minimal-grey',
      radioClass: 'icheckbox_minimal-grey',
      increaseArea: '20%' // optional
    });

    // $('[name=selected_apn]')
    // .on('ifChecked', function(event){
    //   // alert(event.type + ' callback');
    //     // console.log($('[name=selected_apn]:checked').val(),event);
    //     // console.log($(event.target.parentNode).closest('tr').find('.result-apn').text());
    //     apnData(event.target.parentNode);
    // })
    // .change(function(){
    //     // apnData($('.custom-checkbox:checked'));
    // });
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

// compile data for APN search
function apnData(e) {

    // event.preventDefault ? event.preventDefault() : event.returnValue = false;
    // $('.progress-bar').progrlessbar("option", "value", false);
    // $('.progress-bar').show(); // show loading bar
    setTimeout(function(){
        jQuery('.buttonNext').click();
    },400);
    
    isNewSearch=false;
    console.log($(e).closest('tr').find('.result-apn').text());
    $('#lp_invoice .desc').html('<h3>'+$(e).closest('tr').find('.result-address').text()+'</h3>' + $(e).closest('tr').find('.result-apn').text()+ ' ' +$(e).closest('tr').find('.result-address').text()+' ' +$(e).closest('tr').find('.result-city').text());
    var apn = $(e).closest('tr').find('.result-apn').text();
    var fips = apnInfo[apn]['fips'];
    console.log('fips2= ' + fips);
    dataObj = {};
    dataObj.apn = apn;
    dataObj.FIPS = fips;
    dataObj.ClientReference = '<CustCompFilter><SQFT>0.20</SQFT><Radius>0.75</Radius></CustCompFilter>';

    // $('.result-table > tbody').html('');
    // $('.result-table > tbody').hide();
    // $('.result-table > tbody').append('<tr><td><span class="result-apn"></span></td><td><span class="result-address"></span></td><td><span class="result-city"></span></td><td><a class="button blueButton js-run-pma-button" href="#">Run Listing</a></td></tr>');
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
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
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
        setTimeout(function() {
            $('#searchbox').val(place.name);
        }, 25); // just display street address
        for (var i = 0; i < place.address_components.length; i++) {
            //for (var j = 0; j < place.address_components[i].types.length; j++) {
                if (place.address_components[i].types[0] === ("locality") && place.address_components[i].types.length>1 && place.address_components[i].types[1] === ("political")) { //administrative_area_level_1
                    var city = place.address_components[i].long_name;
                    $('#searchboxcity').val(city);
                } else if (place.address_components[i].types[0] === ("administrative_area_level_1") && place.address_components[i].types.length>1 && place.address_components[i].types[1] === ("political")) { //administrative_area_level_1
                    var state = place.address_components[i].short_name;
                    $('#state').val(state);
                } else if (place.address_components[i].types[0] === "neighborhood"  && place.address_components[i].types.length>1 && place.address_components[i].types[1] === ("political")) { //administrative_area_level_1) {
                    var neighborhood = place.address_components[i].long_name;
                    $('#neighbourhood').val(neighborhood);
                }
            //}
        }
    });
}

function widgetRunPMA(agentPath, logoPath) {
    firstModal = false;
    // $('#run-pma-dialog').dialog('close');
    // $('.progress-bar').progressbar("option", "value", false);
    // $('.progress-bar').show();
    // reportData.rep = $('#lp-rep-name option:selected').val();
    if (agentPath) {
        reportData.agentPath = agentPath;
    }
    if (logoPath) {
        reportData.logoPath = logoPath;
    }
    // recordFormData();
    var query = $.param(reportData);
    var formData = $('#run-pma-form').serialize();
    query += '&' + formData;    

    var testimonials = [];
    testimonials.push($("#testimonial-1").val());
    testimonials.push($("#testimonial-2").val());
    testimonials.push($("#testimonial-3").val());
    testimonials.push($("#testimonial-4").val());
    
    query += '&testimonials=' + JSON.stringify(testimonials);

    var testimonials_name = [];
    testimonials_name.push($("#testimonial-name-1").val());
    testimonials_name.push($("#testimonial-name-2").val());
    testimonials_name.push($("#testimonial-name-3").val());
    testimonials_name.push($("#testimonial-name-4").val());
    
    query += '&testimonials_name=' + JSON.stringify(testimonials_name);
    var bio = $("#agent-bio").val();
    query += '&bio=' + bio;
    query += '&' + 'pdfID=' + pdfID;
    var pages = $('#pdf_pages').val();
    query += '&' + 'pdfPages=' + pages;
    query +="&showpartner="+$('input.add-partner:checked').val();
    if($('#addNewPartner').css('display')=='none'){
        query += '&' + 'showpartner=off';
    }else{
        query += '&' + 'showpartner=on';
    }
   
    query += '&' + 'custom_comps=' + JSON.stringify($('#pre-selected-options').val());
    
    if($('#comparable-pre-selected-options').length)
    {
        query += '&' + 'comparable_custom_comps=' + JSON.stringify($('#comparable-pre-selected-options').val());
    }

    query += '&' + 'use_rets_api=' + use_rets_api;
    console.log(query);
    
    //console.log(query);
    if(activeRequest){
        activeRequest=false;
        xhr.abort();
    }
    console.log(query); 
    // return;
    activeRequest=true;
    var errorMsg = "PDF Generation failed. Our team is looking into the matter. Please try again in a bit.";

    xhr = $.ajax({
        url: base_url+'widget/getWidgetPropertyData',
        type: 'POST',
        data: query
    })
        .done(function(response) {
            console.log(response);
            var obj = JSON.parse(response);
            console.log(obj);
            try {
                var obj = JSON.parse(response);
                if(obj.status=='success'){
                    pdfGenerated = true;
                    pmaRes =  {status:"success"};
                }
            } catch (e) {
                //return false;
            }
            if(!pdfGenerated){
                $('#apply-coupan-alert').html(errorMsg).removeClass('alert-success').addClass('alert-danger').show();
                setTimeout(() => {
                    //SET TIME OUT because its add static error message from footer.php SO update exact error message after 1 second.
                    if (obj.msg != '') {
                        if (typeof obj.showError !== 'undefined' && (obj.showError==true || obj.showError=='true')) { 
                            $('#apply-coupan-alert').html(obj.msg).removeClass('alert-success').addClass('alert-danger').show();
                        }
                    }
                }, 1000);
                $('.btn-checkout').hide();
                $('.btn-lp.pay').hide();
                if (obj.msg != '') {
                    // Error Message passed to CMA response.
                    pmaRes =  {status:"failed",msg:obj.msg};
                } else {
                    pmaRes =  {status:"failed",msg:errorMsg};
                }
            }
            // returnReport();
            activeRequest=false;
            // $('#step-4 .loader1').addClass('hidden');
            // $('#step-4 .backwrap').addClass('hidden');
            $('.loader1').hide();
            $('.backwrap').hide();
        })
        .fail(function() {
            $('#apply-coupan-alert').html(errorMsg).removeClass('alert-success').addClass('alert-danger').show();
            $('.btn-checkout').hide();
            $('.btn-lp.pay').hide();
            pmaRes =  {status:"failed",msg:errorMsg};
            //$('.pma-error').text('PDF Generation failed. Please try again.');
            $('.loader1').hide();
            $('.backwrap').hide();
        })
        .always(function() {
            activeRequest = false;
        });
        

}

function getRetsApiComparables(address) 
{
    $.ajax({
        url: base_url+'widget/getRetsApiComparablesData',
        type: 'POST',
        data: {address:address}
    })
        .done(function(response) {
            var data = JSON.parse(response);
            all_comp = data.all;
            sorted_comp = data.sorted;
            $('#pre-selected-options').html('');
            $.each(all_comp, function(i, item) {
                $('#pre-selected-options').append($('<option>', {
                    value: i,
                    text: item.address +" ("+item.price+")"
                }));
            });
            
            $.each(sorted_comp, function(i, item) {
                $('#pre-selected-options').append($('<option>', {
                    value: i,
                    text: item.address +" ("+item.price+")",
                    selected: 'selected'
                }));
            });           
        })
        .fail(function() {            
        })
        .always(function() {
        });
}