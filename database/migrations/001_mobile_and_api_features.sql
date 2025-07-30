-- Modern Agent - Mobile App and API Features Migration
-- Version: 1.0.0
-- Date: January 2024
-- Description: Adds support for mobile apps, API authentication, report sharing, and HTML reports

-- ================================
-- 1. API AUTHENTICATION SUPPORT
-- ================================

-- Add API token support to user table
ALTER TABLE lp_user_mst ADD COLUMN api_token VARCHAR(64) NULL COMMENT 'API authentication token for mobile/external access';
ALTER TABLE lp_user_mst ADD COLUMN token_expiry DATETIME NULL COMMENT 'API token expiration timestamp';

-- ================================
-- 2. REPORT SHARING CAPABILITIES
-- ================================

-- Add sharing features to reports table
ALTER TABLE lp_my_listing ADD COLUMN share_token VARCHAR(64) NULL COMMENT 'Public sharing token for report access';
ALTER TABLE lp_my_listing ADD COLUMN share_expiry DATETIME NULL COMMENT 'Share token expiration timestamp';
ALTER TABLE lp_my_listing ADD COLUMN is_public TINYINT DEFAULT 0 COMMENT 'Whether report is publicly shareable (0=private, 1=public)';

-- ================================
-- 3. HTML VERSION SUPPORT
-- ================================

-- Add HTML report support
ALTER TABLE lp_my_listing ADD COLUMN html_version VARCHAR(255) NULL COMMENT 'Path to HTML version of the report';
ALTER TABLE lp_my_listing ADD COLUMN html_generated_at DATETIME NULL COMMENT 'Timestamp when HTML version was generated';
ALTER TABLE lp_my_listing ADD COLUMN mobile_optimized TINYINT DEFAULT 0 COMMENT 'Whether report has mobile optimization (0=no, 1=yes)';
ALTER TABLE lp_my_listing ADD COLUMN interactive_charts TINYINT DEFAULT 1 COMMENT 'Whether to include interactive charts in HTML (0=no, 1=yes)';

-- ================================
-- 4. PWA AND MOBILE SUPPORT
-- ================================

-- Add Progressive Web App support
ALTER TABLE lp_user_mst ADD COLUMN pwa_enabled TINYINT DEFAULT 1 COMMENT 'Whether user has PWA features enabled (0=disabled, 1=enabled)';
ALTER TABLE lp_user_mst ADD COLUMN offline_reports TINYINT DEFAULT 0 COMMENT 'Whether user can access reports offline (0=no, 1=yes)';

-- ================================
-- 5. MOBILE ANALYTICS TABLE
-- ================================

-- Create mobile session tracking table
CREATE TABLE lp_mobile_sessions (
    session_id VARCHAR(64) PRIMARY KEY COMMENT 'Unique session identifier',
    user_id_fk INT NULL COMMENT 'Foreign key to lp_user_mst.user_id_pk',
    report_id_fk INT NULL COMMENT 'Foreign key to lp_my_listing.project_id_pk',
    device_info TEXT NULL COMMENT 'JSON string with device information (OS, browser, screen size)',
    session_start DATETIME NOT NULL COMMENT 'Session start timestamp',
    session_end DATETIME NULL COMMENT 'Session end timestamp',
    sections_viewed TEXT NULL COMMENT 'Comma-separated list of report sections viewed',
    interactions_count INT DEFAULT 0 COMMENT 'Number of user interactions during session',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation timestamp',
    
    -- Foreign key constraints
    FOREIGN KEY (user_id_fk) REFERENCES lp_user_mst(user_id_pk) ON DELETE SET NULL,
    FOREIGN KEY (report_id_fk) REFERENCES lp_my_listing(project_id_pk) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Mobile app session tracking and analytics';

-- ================================
-- 6. PERFORMANCE INDEXES
-- ================================

-- API authentication indexes
CREATE INDEX idx_api_token ON lp_user_mst(api_token) COMMENT 'Fast lookup for API token authentication';
CREATE INDEX idx_token_expiry ON lp_user_mst(token_expiry) COMMENT 'Cleanup expired tokens efficiently';

-- Report sharing indexes
CREATE INDEX idx_share_token ON lp_my_listing(share_token) COMMENT 'Fast lookup for shared report access';
CREATE INDEX idx_share_expiry ON lp_my_listing(share_expiry) COMMENT 'Cleanup expired share links';
CREATE INDEX idx_public_reports ON lp_my_listing(is_public, share_expiry) COMMENT 'Find active public reports';

-- Report management indexes
CREATE INDEX idx_user_reports ON lp_my_listing(user_id_fk, is_active, project_date) COMMENT 'User report listing with date sorting';
CREATE INDEX idx_html_version ON lp_my_listing(html_version) COMMENT 'Find reports with HTML versions';
CREATE INDEX idx_mobile_optimized ON lp_my_listing(mobile_optimized, user_id_fk) COMMENT 'Find mobile-optimized reports';

-- Mobile analytics indexes
CREATE INDEX idx_mobile_sessions_user ON lp_mobile_sessions(user_id_fk, session_start) COMMENT 'User session history';
CREATE INDEX idx_mobile_sessions_report ON lp_mobile_sessions(report_id_fk, session_start) COMMENT 'Report access analytics';
CREATE INDEX idx_mobile_sessions_date ON lp_mobile_sessions(session_start) COMMENT 'Time-based analytics queries';

-- ================================
-- 7. DATA INTEGRITY CHECKS
-- ================================

-- Ensure share tokens are unique when not null
ALTER TABLE lp_my_listing ADD UNIQUE KEY unique_share_token (share_token);

-- Ensure API tokens are unique when not null  
ALTER TABLE lp_user_mst ADD UNIQUE KEY unique_api_token (api_token);

-- ================================
-- 8. DEFAULT DATA SETUP
-- ================================

-- Enable PWA features for all existing users
UPDATE lp_user_mst SET pwa_enabled = 1 WHERE pwa_enabled IS NULL;

-- Enable interactive charts for all existing reports
UPDATE lp_my_listing SET interactive_charts = 1 WHERE interactive_charts IS NULL;

-- ================================
-- MIGRATION VERIFICATION
-- ================================

-- Verify tables exist and have expected columns
SELECT 
    'lp_user_mst' as table_name,
    COUNT(*) as total_columns,
    SUM(CASE WHEN COLUMN_NAME IN ('api_token', 'token_expiry', 'pwa_enabled', 'offline_reports') THEN 1 ELSE 0 END) as new_columns
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_NAME = 'lp_user_mst' AND TABLE_SCHEMA = DATABASE()

UNION ALL

SELECT 
    'lp_my_listing' as table_name,
    COUNT(*) as total_columns,
    SUM(CASE WHEN COLUMN_NAME IN ('share_token', 'share_expiry', 'is_public', 'html_version', 'html_generated_at', 'mobile_optimized', 'interactive_charts') THEN 1 ELSE 0 END) as new_columns
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_NAME = 'lp_my_listing' AND TABLE_SCHEMA = DATABASE()

UNION ALL

SELECT 
    'lp_mobile_sessions' as table_name,
    COUNT(*) as total_columns,
    CASE WHEN COUNT(*) >= 9 THEN COUNT(*) ELSE 0 END as new_columns
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_NAME = 'lp_mobile_sessions' AND TABLE_SCHEMA = DATABASE();

-- Show indexes created
SELECT 
    TABLE_NAME,
    INDEX_NAME,
    COLUMN_NAME,
    INDEX_COMMENT
FROM INFORMATION_SCHEMA.STATISTICS 
WHERE TABLE_SCHEMA = DATABASE() 
    AND INDEX_NAME LIKE 'idx_%'
    AND TABLE_NAME IN ('lp_user_mst', 'lp_my_listing', 'lp_mobile_sessions')
ORDER BY TABLE_NAME, INDEX_NAME, SEQ_IN_INDEX;

-- ================================
-- ROLLBACK SCRIPT (IF NEEDED)
-- ================================

/*
-- UNCOMMENT TO ROLLBACK CHANGES

-- Drop mobile sessions table
DROP TABLE IF EXISTS lp_mobile_sessions;

-- Remove indexes
DROP INDEX IF EXISTS idx_api_token ON lp_user_mst;
DROP INDEX IF EXISTS idx_token_expiry ON lp_user_mst;
DROP INDEX IF EXISTS idx_share_token ON lp_my_listing;
DROP INDEX IF EXISTS idx_share_expiry ON lp_my_listing;
DROP INDEX IF EXISTS idx_public_reports ON lp_my_listing;
DROP INDEX IF EXISTS idx_user_reports ON lp_my_listing;
DROP INDEX IF EXISTS idx_html_version ON lp_my_listing;
DROP INDEX IF EXISTS idx_mobile_optimized ON lp_my_listing;
DROP INDEX IF EXISTS unique_share_token ON lp_my_listing;
DROP INDEX IF EXISTS unique_api_token ON lp_user_mst;

-- Remove columns from lp_my_listing
ALTER TABLE lp_my_listing 
    DROP COLUMN IF EXISTS share_token,
    DROP COLUMN IF EXISTS share_expiry,
    DROP COLUMN IF EXISTS is_public,
    DROP COLUMN IF EXISTS html_version,
    DROP COLUMN IF EXISTS html_generated_at,
    DROP COLUMN IF EXISTS mobile_optimized,
    DROP COLUMN IF EXISTS interactive_charts;

-- Remove columns from lp_user_mst
ALTER TABLE lp_user_mst 
    DROP COLUMN IF EXISTS api_token,
    DROP COLUMN IF EXISTS token_expiry,
    DROP COLUMN IF EXISTS pwa_enabled,
    DROP COLUMN IF EXISTS offline_reports;
*/

-- ================================
-- MIGRATION COMPLETE
-- ================================

SELECT 'Migration completed successfully! Mobile app and API features are now available.' as status; 