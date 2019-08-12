(function() {

// Localize jQuery variable
var jQuery;
var libCount = 0;

/******** Load jQuery if not present *********/
if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.4.2') {
    var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src",
        "https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js");
    var script_map = document.createElement('script');
    script_map.setAttribute("type","text/javascript");
    script_map.setAttribute("src",
        "https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyDQQthVgLzHIRTyLS1WGP2spIshpD28n8M");
    var script_jui = document.createElement('script');
    script_jui.setAttribute("type","text/javascript");
    script_jui.setAttribute("src",
        "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js");
    if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
              scriptLoadHandler();
          }
      };
    } else { // Other browsers
              script_tag.onload = scriptLoadHandler;
    }
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_map);
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_jui);
} else {
    // The jQuery version on the window is the one we want to use
    jQuery = window.jQuery;
    main();
}

/******** Called once jQuery has loaded ******/
function scriptLoadHandler() {
    // Restore $ and window.jQuery to their previous values and store the
    // new jQuery in our local jQuery variable
//    var script_tag = document.createElement('script');
//    script_tag.setAttribute("type","text/javascript");
//    script_tag.setAttribute("src",
//        "https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyDQQthVgLzHIRTyLS1WGP2spIshpD28n8M");
    jQuery = window.jQuery.noConflict(true);
    // Call our main function
    main(); 
}

/******** Our main function ********/
function main() { 
    jQuery(document).ready(function($) { 
        /******* Load CSS *******/
//        var css_link = $("<link>", { 
//            rel: "stylesheet", 
//            type: "text/css", 
//            href: "style.css" 
//        });
//        css_link.appendTo('head'); 
        /******* Load HTML *******/
        //var base_url = "https://modernagent.io/beta";
        var base_url = "https://modernagent.localhost.com";
        var custom_css = "<style>#cma-widget-container {background: url("+base_url+"/assets/images-2/home/->ReplaceImage<-) no-repeat 0 0;background-attachment: scroll; background-color:black; background-size: auto auto;background-size: cover;background-attachment: fixed;}</style>";
         //custom_css.appendTo('head');
        // $('head').append(custom_css);
        var jsonp_url = base_url+"/user/dashboard_widget?callback=dashboard_widget&ac_id=82";
        $.getJSON(jsonp_url, function(data) {
            //console.log(data.html);
            //console.log("hello");
            console.log(data);
          $('#cma-widget-container').html(custom_css+data.html);
        });
    });
}

})(); // We call our anonymous function immediately