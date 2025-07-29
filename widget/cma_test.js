// Updated test version with improved error handling
jQuery(document).ready(function() {
    loadWidget();
});

function loadWidget()
{
    var custom_css = "";

    jQuery.ajax({
        url: app_main_url,
        type: "GET",
        xhrFields: { withCredentials: true },
        crossDomain: true,
        success: function (response) {
            console.log('Widget loaded successfully', response);
            try {
                // Try to parse as JSON first (for error responses)
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.status === 'error') {
                    jQuery('#cma-widget-container').html(jsonResponse.html);
                } else {
                    jQuery('#cma-widget-container').html(custom_css + response);
                }
            } catch (e) {
                // If not JSON, treat as HTML (normal widget content)
                jQuery('#cma-widget-container').html(custom_css + response);
            }
        },
        error: function(xhr, ajaxOptions, thrownError){
            console.error('Widget loading failed:', thrownError);
            var errorMessage = '<div style="padding: 20px; text-align: center; color: #e74c3c; font-family: Arial, sans-serif;">' +
                              '<h3>Widget Loading Error</h3>' +
                              '<p>Unable to load the CMA widget. Please try again later.</p>' +
                              '<p><small>Error: ' + (thrownError || 'Network error') + '</small></p>' +
                              '</div>';
            jQuery('#cma-widget-container').html(errorMessage);
        },
    });
}