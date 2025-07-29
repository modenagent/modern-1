# CMA Widget Maintenance Guide

This document provides guidance for maintaining and troubleshooting the CMA Widget system.

## Architecture Overview

The CMA Widget system consists of:

1. **Frontend Components**:
   - `widget/cma.js` - Main widget script for external embedding
   - `widget/cma.php` - Widget page with dependencies and initialization
   - `widget/cma_test.js` - Test version of the widget script

2. **Backend Components**:
   - `widget/widget.php` - Authentication and user management
   - `application/controllers/widgetcma.php` - Widget data controller

3. **Documentation**:
   - `widget/INTEGRATION_GUIDE.md` - External integration documentation

## Key Improvements Made

### Error Handling
- Replaced all `die()` statements with JSON error responses
- Added comprehensive error messages for different failure scenarios
- Implemented graceful fallback for network failures

### Widget Loading
- Removed blocking redirects that prevented widget embedding
- Added support for both HTML and JSON response formats
- Improved AJAX error handling with user-friendly messages

### Integration Support
- Created comprehensive integration guide
- Added examples for different embedding scenarios
- Included troubleshooting and security considerations

## Common Maintenance Tasks

### 1. Updating Error Messages

Error messages are defined in `widget/widget.php`. To update them:

```php
$error_message = json_encode(array(
    'status' => 'error',
    'message' => 'Your error message',
    'html' => '<div style="...">User-friendly HTML</div>'
));
```

### 2. Adding New Authentication Scenarios

Add new error handling in `widget/widget.php` following the existing pattern:

```php
if ($condition_failed) {
    $error_message = json_encode(array(
        'status' => 'error',
        'message' => 'Brief technical message',
        'html' => '<div style="padding: 20px; text-align: center; color: #e74c3c; font-family: Arial, sans-serif;"><h3>User Title</h3><p>User-friendly explanation.</p></div>'
    ));
    header('Content-Type: application/json');
    echo $error_message;
    exit;
}
```

### 3. Modifying Widget Loading Logic

The widget loading logic is in both `widget/cma.js` and `widget/cma.php`. Keep them synchronized:

```javascript
jQuery.ajax({
    url: app_main_url,
    type: "GET",
    xhrFields: { withCredentials: true },
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
        // Error handling code
    }
});
```

## Troubleshooting

### Widget Not Loading

1. **Check Authentication**:
   - Verify `site_id` parameter is correct
   - Check if user is authenticated in SimpleSAML
   - Review company association settings

2. **Check Network Issues**:
   - Look for CORS errors in browser console
   - Verify widget endpoint is accessible
   - Check SSL/TLS configuration

3. **Check Dependencies**:
   - Ensure jQuery is loaded before widget script
   - Verify all CSS/JS dependencies are accessible
   - Check for JavaScript conflicts

### Error Message Not Displaying

1. **Check Response Format**:
   - Verify error responses are valid JSON
   - Check Content-Type header is set correctly
   - Ensure HTML in error responses is valid

2. **Check JavaScript Errors**:
   - Look for console errors preventing script execution
   - Verify jQuery is available
   - Check for syntax errors in widget script

### Cross-Origin Issues

1. **Check CORS Headers**:
   - Verify `Access-Control-Allow-Origin` is set correctly
   - Check `Access-Control-Allow-Credentials` for cookie auth
   - Review allowed domains in widget controller

2. **Check Cookie Settings**:
   - Verify cookies are set with correct domain
   - Check secure flag for HTTPS sites
   - Review SameSite cookie settings

## Testing

### Manual Testing

1. **Basic Functionality**:
   - Load widget with valid authentication
   - Test with invalid authentication
   - Test network failure scenarios

2. **Error Scenarios**:
   - Missing site_id parameter
   - Invalid company parameter
   - Authentication failures
   - Network timeouts

3. **Cross-Browser Testing**:
   - Test in major browsers (Chrome, Firefox, Safari, Edge)
   - Test on mobile devices
   - Check for JavaScript compatibility issues

### Automated Testing

Create test scripts following the pattern in `/tmp/widget_test_local.html`:

```javascript
// Mock AJAX for testing
jQuery.ajax = function(options) {
    // Simulate different scenarios
    setTimeout(function() {
        if (test_scenario === 'error') {
            options.error({}, 'error', 'Test error');
        } else {
            options.success('Test response');
        }
    }, 100);
};
```

## Security Considerations

### Authentication
- Always validate authentication before serving widget content
- Use secure session management
- Implement proper logout handling

### Cross-Origin Security
- Maintain whitelist of allowed domains
- Use secure cookie settings
- Validate all input parameters

### Error Information
- Don't expose sensitive system information in error messages
- Log detailed errors server-side for debugging
- Provide generic error messages to users

## Performance Optimization

### Caching
- Cache widget content when appropriate
- Use browser caching for static assets
- Implement CDN for external dependencies

### Loading
- Minimize external dependencies
- Use async loading where possible
- Implement loading states for better UX

## Monitoring

### Key Metrics
- Widget load success rate
- Authentication failure rate
- Network error frequency
- User engagement metrics

### Logging
- Log all widget loads and errors
- Track authentication failures
- Monitor performance metrics

### Alerts
- Set up alerts for high error rates
- Monitor authentication system health
- Track widget availability

## Deployment

### Testing Checklist
- [ ] All syntax validation passes
- [ ] Error handling works correctly
- [ ] Cross-browser compatibility verified
- [ ] Authentication scenarios tested
- [ ] Integration guide updated

### Release Process
1. Test changes in development environment
2. Validate all error scenarios
3. Update integration guide if needed
4. Deploy to staging for final testing
5. Deploy to production with monitoring

---

*Last updated: [Current Date]*
*Maintainer: Development Team*