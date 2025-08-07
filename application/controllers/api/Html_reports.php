<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * HTML Reports API Controller
 * 
 * Generates and serves mobile-optimized HTML versions of PDF reports
 * with interactive charts, touch navigation, and PWA capabilities.
 * 
 * @author Modern Agent Development Team
 * @version 1.0.0
 * @since January 2024
 */
class Html_reports extends CI_Controller {
    
    /**
     * Constructor - Load required libraries and helpers
     */
    public function __construct() {
        parent::__construct();
        
        // Load CodeIgniter libraries
        $this->load->library(['reports', 'user_agent']);
        $this->load->model('base_model');
        $this->load->helper(['url', 'dataapi', 'security']);
        
        // Set JSON response headers
        $this->output->set_content_type('application/json');
        
        // Enable CORS for mobile app access
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        $this->output->set_header('Access-Control-Allow-Headers: Authorization, Content-Type');
        
        // Handle preflight OPTIONS requests
        if ($this->input->method() === 'options') {
            $this->output->set_status_header(200);
            $this->output->_display();
            exit;
        }
    }
    
    /**
     * Get HTML version of a report
     * 
     * @param int $reportId The report ID to retrieve
     * @return void (outputs HTML or JSON error)
     */
    public function getHtmlReport($reportId = null) {
        try {
            // Validate input
            if (!$reportId || !is_numeric($reportId)) {
                return $this->_errorResponse('Invalid report ID', 400);
            }
            
            // Validate authentication token
            $userId = $this->_validateToken();
            if (!$userId) {
                return $this->_errorResponse('Invalid or expired token', 401);
            }
            
            // Get report data from database
            $report = $this->_getReportData($reportId, $userId);
            if (!$report) {
                return $this->_errorResponse('Report not found or access denied', 404);
            }
            
            // Check if HTML version exists and is current
            $htmlContent = $this->_getOrGenerateHtml($report);
            
            if (!$htmlContent) {
                return $this->_errorResponse('Failed to generate HTML report', 500);
            }
            
            // Track mobile session analytics
            $this->_trackMobileSession($userId, $reportId);
            
            // Set HTML response headers
            $this->output->set_content_type('text/html');
            $this->output->set_header('Cache-Control: public, max-age=3600'); // 1 hour cache
            
            // Output HTML content
            $this->output->set_output($htmlContent);
            
        } catch (Exception $e) {
            error_log("HTML Reports API Error: " . $e->getMessage());
            return $this->_errorResponse('Internal server error', 500);
        }
    }
    
    /**
     * Generate mobile HTML from existing report data
     * 
     * @param array $reportData The report data from database
     * @return string HTML content
     */
    public function generateMobileHtml($reportData) {
        try {
            // Reconstruct report data from stored JSON
            $data = json_decode($reportData['pdf_data'], true);
            
            if (!$data) {
                // Fallback: regenerate from basic report info
                $data = $this->_reconstructReportData($reportData);
            }
            
            // Add mobile-specific enhancements
            $data['mobile_optimized'] = true;
            $data['interactive_charts'] = ($reportData['interactive_charts'] == 1);
            $data['report_id'] = $reportData['project_id_pk'];
            $data['generated_at'] = date('Y-m-d H:i:s');
            
            // Detect user agent for optimizations
            $data['is_mobile'] = $this->agent->is_mobile();
            $data['is_tablet'] = $this->agent->is_mobile() && !$this->agent->is_phone();
            $data['user_agent'] = $this->agent->agent_string();
            
            // Load mobile template
            return $this->load->view('reports/mobile/report_template', $data, true);
            
        } catch (Exception $e) {
            error_log("HTML Generation Error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Serve publicly shared HTML report
     * 
     * @param string $shareToken The public sharing token
     * @return void (outputs HTML or 404)
     */
    public function shareHtmlReport($shareToken = null) {
        try {
            // Validate share token
            if (!$shareToken || strlen($shareToken) !== 64) {
                show_404();
                return;
            }
            
            // Get shared report data
            $this->db->select('lp_my_listing.*, lp_user_mst.first_name, lp_user_mst.last_name, lp_user_mst.email');
            $this->db->from('lp_my_listing');
            $this->db->join('lp_user_mst', 'lp_my_listing.user_id_fk = lp_user_mst.user_id_pk');
            $this->db->where('share_token', $shareToken);
            $this->db->where('share_expiry >', date('Y-m-d H:i:s'));
            $this->db->where('is_public', 1);
            
            $report = $this->db->get()->row_array();
            
            if (!$report) {
                show_404();
                return;
            }
            
            // Generate HTML content
            $htmlContent = $this->generateMobileHtml($report);
            
            if (!$htmlContent) {
                show_404();
                return;
            }
            
            // Track anonymous access
            $this->_trackMobileSession(null, $report['project_id_pk'], $shareToken);
            
            // Serve HTML with appropriate headers
            $this->output->set_content_type('text/html');
            $this->output->set_header('Cache-Control: public, max-age=1800'); // 30 minutes
            $this->output->set_header('X-Robots-Tag: noindex, nofollow'); // Prevent search indexing
            $this->output->set_output($htmlContent);
            
        } catch (Exception $e) {
            error_log("Shared HTML Report Error: " . $e->getMessage());
            show_404();
        }
    }
    
    /**
     * Get report performance analytics
     * 
     * @param int $reportId The report ID
     * @return void (outputs JSON)
     */
    public function getAnalytics($reportId = null) {
        try {
            // Validate authentication
            $userId = $this->_validateToken();
            if (!$userId) {
                return $this->_errorResponse('Invalid or expired token', 401);
            }
            
            // Validate report access
            if (!$this->_userOwnsReport($reportId, $userId)) {
                return $this->_errorResponse('Report not found or access denied', 404);
            }
            
            // Get analytics data
            $this->db->select('
                COUNT(*) as total_sessions,
                COUNT(DISTINCT DATE(session_start)) as unique_days,
                AVG(TIMESTAMPDIFF(SECOND, session_start, session_end)) as avg_session_duration,
                SUM(interactions_count) as total_interactions
            ');
            $this->db->from('lp_mobile_sessions');
            $this->db->where('report_id_fk', $reportId);
            $this->db->where('session_start >', date('Y-m-d H:i:s', strtotime('-30 days')));
            
            $analytics = $this->db->get()->row_array();
            
            $this->output->set_output(json_encode([
                'status' => true,
                'analytics' => $analytics,
                'report_id' => $reportId
            ]));
            
        } catch (Exception $e) {
            error_log("Analytics Error: " . $e->getMessage());
            return $this->_errorResponse('Failed to retrieve analytics', 500);
        }
    }
    
    /**
     * Private method to validate API token
     * 
     * @return int|false User ID if valid, false otherwise
     */
    private function _validateToken() {
        $token = $this->input->get_request_header('Authorization', TRUE);
        
        if (!$token) {
            return false;
        }
        
        // Remove 'Bearer ' prefix if present
        $token = str_replace('Bearer ', '', $token);
        
        // Validate token in database
        $this->db->select('user_id_pk');
        $this->db->from('lp_user_mst');
        $this->db->where('api_token', $token);
        $this->db->where('token_expiry >', date('Y-m-d H:i:s'));
        
        $user = $this->db->get()->row();
        return $user ? $user->user_id_pk : false;
    }
    
    /**
     * Get report data with user access validation
     * 
     * @param int $reportId Report ID
     * @param int $userId User ID
     * @return array|false Report data or false
     */
    private function _getReportData($reportId, $userId) {
        $this->db->select('*');
        $this->db->from('lp_my_listing');
        $this->db->where('project_id_pk', $reportId);
        $this->db->where('user_id_fk', $userId);
        $this->db->where('is_active', 'Y');
        
        return $this->db->get()->row_array();
    }
    
    /**
     * Get existing HTML or generate new version
     * 
     * @param array $report Report data
     * @return string|false HTML content or false
     */
    private function _getOrGenerateHtml($report) {
        // Check if HTML version exists and is current
        if (!empty($report['html_version']) && 
            file_exists($report['html_version']) && 
            filemtime($report['html_version']) > strtotime($report['project_date'])) {
            
            return file_get_contents($report['html_version']);
        }
        
        // Generate new HTML version
        $htmlContent = $this->generateMobileHtml($report);
        
        if ($htmlContent) {
            // Create temp/html directory if it doesn't exist
            $htmlDir = 'temp/html/';
            if (!is_dir($htmlDir)) {
                mkdir($htmlDir, 0755, true);
            }
            
            // Save HTML version to file
            $htmlPath = $htmlDir . $report['project_id_pk'] . '_mobile.html';
            file_put_contents($htmlPath, $htmlContent);
            
            // Update database with HTML path
            $this->db->where('project_id_pk', $report['project_id_pk']);
            $this->db->update('lp_my_listing', [
                'html_version' => $htmlPath,
                'html_generated_at' => date('Y-m-d H:i:s'),
                'mobile_optimized' => 1
            ]);
            
            return $htmlContent;
        }
        
        return false;
    }
    
    /**
     * Check if user owns the report
     * 
     * @param int $reportId Report ID
     * @param int $userId User ID
     * @return bool
     */
    private function _userOwnsReport($reportId, $userId) {
        $this->db->select('1');
        $this->db->from('lp_my_listing');
        $this->db->where('project_id_pk', $reportId);
        $this->db->where('user_id_fk', $userId);
        
        return $this->db->get()->num_rows() > 0;
    }
    
    /**
     * Track mobile session for analytics
     * 
     * @param int|null $userId User ID (null for anonymous)
     * @param int $reportId Report ID
     * @param string|null $shareToken Share token for anonymous access
     * @return void
     */
    private function _trackMobileSession($userId, $reportId, $shareToken = null) {
        try {
            $sessionId = bin2hex(random_bytes(32));
            
            $sessionData = [
                'session_id' => $sessionId,
                'user_id_fk' => $userId,
                'report_id_fk' => $reportId,
                'device_info' => json_encode([
                    'user_agent' => $this->agent->agent_string(),
                    'is_mobile' => $this->agent->is_mobile(),
                    'is_tablet' => $this->agent->is_mobile() && !$this->agent->is_phone(),
                    'platform' => $this->agent->platform(),
                    'browser' => $this->agent->browser(),
                    'ip_address' => $this->input->ip_address(),
                    'share_token' => $shareToken
                ]),
                'session_start' => date('Y-m-d H:i:s'),
                'sections_viewed' => 'overview', // Default starting section
                'interactions_count' => 1
            ];
            
            $this->db->insert('lp_mobile_sessions', $sessionData);
            
        } catch (Exception $e) {
            // Log error but don't fail the main request
            error_log("Session tracking error: " . $e->getMessage());
        }
    }
    
    /**
     * Reconstruct report data from basic information
     * 
     * @param array $reportData Basic report data
     * @return array Reconstructed data for template
     */
    private function _reconstructReportData($reportData) {
        return [
            'project_id' => $reportData['project_id_pk'],
            'property_address' => $reportData['property_address'],
            'property_owner' => $reportData['property_owner'],
            'report_type' => $reportData['report_type'],
            'generated_at' => $reportData['project_date'],
            'user' => [
                'fullname' => 'Property Report',
                'email' => '',
                'phone' => ''
            ],
            'theme' => '#007bff',
            'mobile_optimized' => true
        ];
    }
    
    /**
     * Send error response in JSON format
     * 
     * @param string $message Error message
     * @param int $statusCode HTTP status code
     * @return void
     */
    private function _errorResponse($message, $statusCode = 400) {
        $this->output->set_status_header($statusCode);
        $this->output->set_output(json_encode([
            'status' => false,
            'error' => $message,
            'code' => $statusCode,
            'timestamp' => date('Y-m-d\TH:i:s\Z')
        ]));
    }
}

/* End of file Html_reports.php */
/* Location: ./application/controllers/api/Html_reports.php */
?>