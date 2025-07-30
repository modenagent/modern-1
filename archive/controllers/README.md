# Archive Directory - Controllers

This directory contains controllers that were moved during the cleanup process on [current date].

## Files Archived

### `user2.php` 
- **Original Location**: `application/controllers/user2.php`
- **Size**: 2,229 lines
- **Reason for Archival**: Alternative user controller with different payment processing and feature set
- **Contains**: Stripe integration, different dashboard functionality, specialized user management
- **Status**: May contain unique features not present in main user controller

### `lp2.php`
- **Original Location**: `application/controllers/lp2.php` 
- **Size**: 362 lines
- **Reason for Archival**: Alternative landing page controller with simplified report generation
- **Contains**: Basic property data processing, comparable sales analysis
- **Status**: May be used for specific workflows or widget integrations

## Restoration Instructions

If any of these files need to be restored:

1. Copy the file back to `application/controllers/`
2. Test functionality in staging environment
3. Update routing if necessary
4. Check for any dependency conflicts

## Review Date

These files should be reviewed after 6 months to determine if they can be permanently deleted. 