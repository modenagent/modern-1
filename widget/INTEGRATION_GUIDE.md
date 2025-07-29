# CMA Widget Integration Guide

This guide provides instructions for embedding the Modern Agent CMA Widget on external websites.

## Quick Start Integration

### Basic Embedding Code

Add the following HTML snippet to your webpage where you want the widget to appear:

```html
<!-- CMA Widget Container -->
<div id="cma-widget-container" style="width: 100%; min-height: 400px;"></div>

<!-- Widget Dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Widget Initialization -->
<script type="text/javascript">
    var app_main_url = "https://YOUR_DOMAIN/widget/getWidgetData";
    
    // Load widget after DOM is ready
    jQuery(document).ready(function() {
        if (typeof loadWidget === 'function') {
            loadWidget();
        }
    });
    
    function loadWidget() {
        jQuery.ajax({
            url: app_main_url,
            type: "GET",
            xhrFields: { 
                withCredentials: true 
            },
            success: function (response) {
                try {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'error') {
                        jQuery('#cma-widget-container').html(jsonResponse.html);
                    } else {
                        jQuery('#cma-widget-container').html(response);
                    }
                } catch (e) {
                    jQuery('#cma-widget-container').html(response);
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
            }
        });
    }
</script>
```

### Advanced Integration with External Script

For a cleaner integration, you can use the external widget script:

```html
<!-- CMA Widget Container -->
<div id="cma-widget-container"></div>

<!-- Widget Script with Configuration -->
<script type="text/javascript">
    var app_main_url = "https://YOUR_DOMAIN/widget/getWidgetData";
</script>
<script type="text/javascript" src="https://YOUR_DOMAIN/widget/cma.js"></script>
```

## Configuration Parameters

### Required Parameters

- **app_main_url**: The endpoint URL for widget data
  - Format: `https://YOUR_DOMAIN/widget/getWidgetData`
  - Required for all implementations

### Authentication Parameters

The widget requires proper authentication configuration. Contact your administrator for:

- **site_id**: Unique identifier for your organization
- **company**: Company identifier (if applicable)

### URL Format Examples

```
# Basic widget URL
https://YOUR_DOMAIN/widget/widget.php?site_id=YOUR_SITE_ID

# With company parameter
https://YOUR_DOMAIN/widget/widget.php?site_id=YOUR_SITE_ID&company=YOUR_COMPANY
```

## Styling and Customization

### Container Styling

The widget container can be styled using CSS:

```css
#cma-widget-container {
    width: 100%;
    min-height: 400px;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 0;
    overflow: hidden;
}
```

### Responsive Design

For mobile responsiveness, add viewport meta tag and responsive styles:

```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```

```css
@media (max-width: 768px) {
    #cma-widget-container {
        min-height: 300px;
    }
}
```

## Required Dependencies

### JavaScript Libraries

The widget requires the following JavaScript libraries to be loaded:

1. **jQuery** (minimum version 1.9.1)
   ```html
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   ```

2. **Bootstrap** (for styling)
   ```html
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   ```

### CSS Dependencies

The widget may require additional CSS files for proper styling:

```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
```

## Error Handling

The widget includes built-in error handling for common scenarios:

### Authentication Errors
- **Invalid site_id**: Displays configuration error message
- **Unauthenticated user**: Shows login required message
- **Company association errors**: Displays access denied message

### Network Errors
- **AJAX failures**: Shows network error message with retry option
- **Timeout issues**: Displays timeout error with instructions

### Custom Error Handling

You can customize error handling by modifying the error callback:

```javascript
error: function(xhr, ajaxOptions, thrownError){
    // Custom error handling logic
    console.error('Widget error:', thrownError);
    
    // Display custom error message
    jQuery('#cma-widget-container').html(
        '<div class="alert alert-danger">Custom error message</div>'
    );
}
```

## Security Considerations

### Cross-Origin Requests

The widget supports cross-origin requests with proper CORS headers. Ensure your domain is whitelisted in the widget configuration.

### Authentication

The widget uses cookie-based authentication with cross-domain support. Ensure proper SSL/TLS configuration for secure cookie transmission.

## Troubleshooting

### Common Issues

1. **Widget not loading**
   - Check if jQuery is loaded before the widget script
   - Verify the `app_main_url` configuration
   - Check browser console for JavaScript errors

2. **Authentication errors**
   - Verify `site_id` parameter is correct
   - Ensure user is properly authenticated
   - Check company association settings

3. **Styling issues**
   - Verify CSS dependencies are loaded
   - Check for CSS conflicts with existing styles
   - Ensure container has proper dimensions

### Debug Mode

Enable debug mode by adding console logging:

```javascript
// Add to widget loading function
console.log('Loading widget from:', app_main_url);
console.log('Widget response:', response);
```

## Support and Maintenance

### Version Updates

Widget updates are handled automatically through the hosted script. No action required for embedded widgets using external script references.

### Monitoring

Monitor widget performance using:
- Browser developer tools
- Network tab for AJAX requests
- Console for error messages

### Contact Support

For technical support or configuration assistance:
- Contact: your-support-email@domain.com
- Documentation: Link to additional documentation
- Issue tracking: Link to support system

## Examples

### Complete Integration Example

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMA Widget Example</title>
    
    <!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        .widget-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        #cma-widget-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            min-height: 500px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="widget-wrapper">
        <h1>CMA Widget Demo</h1>
        <div id="cma-widget-container"></div>
    </div>
    
    <!-- JavaScript Dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Widget Configuration -->
    <script type="text/javascript">
        var app_main_url = "https://YOUR_DOMAIN/widget/getWidgetData";
    </script>
    <script type="text/javascript" src="https://YOUR_DOMAIN/widget/cma.js"></script>
</body>
</html>
```

### WordPress Integration

For WordPress sites, add to your theme's functions.php:

```php
function add_cma_widget_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('cma-widget', 'https://YOUR_DOMAIN/widget/cma.js', array('jquery'), '1.0', true);
    wp_localize_script('cma-widget', 'cma_config', array(
        'app_main_url' => 'https://YOUR_DOMAIN/widget/getWidgetData'
    ));
}
add_action('wp_enqueue_scripts', 'add_cma_widget_scripts');
```

---

*Last updated: [Current Date]*
*Version: 1.0*