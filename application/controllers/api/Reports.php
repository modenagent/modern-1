<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modern Agent Reports Management API Controller
 * 
 * Handles report listing, details, sharing, and management for mobile apps
 * Provides comprehensive report management functionality with authentication
 * 
 * @package ModernAgent
 * @subpackage API
 * @version 1.0.0
 * @author Modern Agent Development Team
 */
class Reports extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        
        // Load required libraries and helpers
        $this->load->database();
        $this->load->helper(['url', 'security', 'file']);
        $this->load->library(['form_validation']);
        
        // Set JSON response headers
        $this->output->set_content_type('application/json');
        
        // Enable CORS for external API access
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $this->output->set_header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        
        // Handle preflight OPTIONS requests
        if ($this->input->method() === 'options') {
            $this->output->set_status_header(200);
            return;
        }
    }

    /**
     * Get User Reports with Pagination
     * 
     * GET /api/reports/getUserReports?page=1&limit=20&search=&type=
     * Headers: Authorization: Bearer {token}
     * 
     * @return JSON response with paginated report list
     */
    public function getUserReports() {
        try {
            // Only allow GET requests
            if ($this->input->method() !== 'get') {
                return $this->_send_error('Method not allowed', 405);
            }

            // Validate authentication
            $user_id = $this->_validate_api_token();
            if (!$user_id) {
                return $this->_send_error('Invalid or expired token', 401);
            }

            // Get query parameters
            $page = max(1, (int)$this->input->get('page', 1));
            $limit = min(100, max(1, (int)$this->input->get('limit', 20))); // Max 100 per page
            $search = trim($this->input->get('search', ''));
            $type = trim($this->input->get('type', ''));
            $offset = ($page - 1) * $limit;

            // Build base query
            $this->db->select('
                project_id_pk, 
                project_name, 
                property_address, 
                property_owner,
                report_type, 
                project_date, 
                report_path,
                html_version,
                mobile_optimized,
                is_public,
                share_token,
                share_expiry,
                theme_color
            ');
            $this->db->from('lp_my_listing');
            $this->db->where('user_id_fk', $user_id);
            $this->db->where('is_active', 'Y');

            // Apply search filter
            if (!empty($search)) {
                $this->db->group_start();
                $this->db->like('property_address', $search);
                $this->db->or_like('property_owner', $search);
                $this->db->or_like('project_name', $search);
                $this->db->group_end();
            }

            // Apply type filter
            if (!empty($type) && in_array($type, ['seller', 'buyer', 'registry'])) {
                $this->db->where('report_type', $type);
            }

            // Get total count for pagination
            $total_query = clone $this->db;
            $total_count = $total_query->count_all_results();

            // Apply pagination and ordering
            $this->db->order_by('project_date', 'DESC');
            $this->db->limit($limit, $offset);
            $reports = $this->db->get()->result_array();

            // Process report data
            $processed_reports = [];
            foreach ($reports as $report) {
                $processed_report = [
                    'project_id' => (int)$report['project_id_pk'],
                    'project_name' => $report['project_name'],
                    'property_address' => $report['property_address'],
                    'property_owner' => $report['property_owner'],
                    'report_type' => $report['report_type'],
                    'created_date' => $report['project_date'],
                    'has_pdf' => !empty($report['report_path']) && file_exists($report['report_path']),
                    'has_html' => !empty($report['html_version']),
                    'mobile_optimized' => (bool)$report['mobile_optimized'],
                    'is_shared' => !empty($report['share_token']) && 
                                   !empty($report['share_expiry']) && 
                                   strtotime($report['share_expiry']) > time(),
                    'theme_color' => $report['theme_color'] ?? '#007bff'
                ];

                // Add file sizes if available
                if ($processed_report['has_pdf'] && file_exists($report['report_path'])) {
                    $processed_report['pdf_size'] = $this->_format_file_size(filesize($report['report_path']));
                }

                $processed_reports[] = $processed_report;
            }

            // Pagination metadata
            $total_pages = ceil($total_count / $limit);
            $pagination = [
                'current_page' => $page,
                'total_pages' => $total_pages,
                'total_reports' => (int)$total_count,
                'per_page' => $limit,
                'has_next' => $page < $total_pages,
                'has_previous' => $page > 1
            ];

            return $this->_send_response([
                'status' => true,
                'reports' => $processed_reports,
                'pagination' => $pagination,
                'filters' => [
                    'search' => $search,
                    'type' => $type
                ]
            ]);

        } catch (Exception $e) {
            log_message('error', "Get user reports API error: " . $e->getMessage());
            return $this->_send_error('Internal server error', 500);
        }
    }

    /**
     * Get Detailed Report Information
     * 
     * GET /api/reports/getReportDetails/{reportId}
     * Headers: Authorization: Bearer {token}
     * 
     * @param int $report_id Report ID
     * @return JSON response with detailed report information
     */
    public function getReportDetails($report_id = null) {
        try {
            // Only allow GET requests
            if ($this->input->method() !== 'get') {
                return $this->_send_error('Method not allowed', 405);
            }

            // Validate authentication
            $user_id = $this->_validate_api_token();
            if (!$user_id) {
                return $this->_send_error('Invalid or expired token', 401);
            }

            // Validate report ID
            if (!$report_id || !is_numeric($report_id)) {
                return $this->_send_error('Invalid report ID', 400);
            }

            // Get report details
            $this->db->select('*');
            $this->db->from('lp_my_listing');
            $this->db->where('project_id_pk', $report_id);
            $this->db->where('user_id_fk', $user_id);
            $this->db->where('is_active', 'Y');
            $report = $this->db->get()->row_array();

            if (!$report) {
                return $this->_send_error('Report not found', 404);
            }

            // Process detailed report data
            $detailed_report = [
                'project_id' => (int)$report['project_id_pk'],
                'project_name' => $report['project_name'],
                'property_address' => $report['property_address'],
                'property_owner' => $report['property_owner'],
                'report_type' => $report['report_type'],
                'created_date' => $report['project_date'],
                'theme_color' => $report['theme_color'] ?? '#007bff',
                'selected_pages' => $report['selected_pages'] ?? '[]',
                
                // File information
                'files' => [
                    'pdf' => [
                        'available' => !empty($report['report_path']) && file_exists($report['report_path']),
                        'path' => $report['report_path'],
                        'url' => !empty($report['report_path']) ? base_url($report['report_path']) : null,
                        'size' => null
                    ],
                    'html' => [
                        'available' => !empty($report['html_version']),
                        'path' => $report['html_version'],
                        'mobile_optimized' => (bool)$report['mobile_optimized'],
                        'interactive_charts' => (bool)$report['interactive_charts']
                    ]
                ],
                
                // Sharing information
                'sharing' => [
                    'is_public' => (bool)$report['is_public'],
                    'share_token' => $report['share_token'],
                    'share_expiry' => $report['share_expiry'],
                    'is_active' => !empty($report['share_token']) && 
                                   !empty($report['share_expiry']) && 
                                   strtotime($report['share_expiry']) > time(),
                    'share_url' => null
                ],
                
                // Additional metadata
                'metadata' => [
                    'pdf_data' => $report['pdf_data'] ? json_decode($report['pdf_data'], true) : null,
                    'generation_time' => $report['generation_time'] ?? null,
                    'page_count' => $report['page_count'] ?? null
                ]
            ];

            // Add file sizes
            if ($detailed_report['files']['pdf']['available']) {
                $file_size = filesize($report['report_path']);
                $detailed_report['files']['pdf']['size'] = $this->_format_file_size($file_size);
                $detailed_report['files']['pdf']['size_bytes'] = $file_size;
            }

            // Add share URL if active
            if ($detailed_report['sharing']['is_active']) {
                $detailed_report['sharing']['share_url'] = base_url("shared/report/{$report['share_token']}");
            }

            return $this->_send_response([
                'status' => true,
                'report' => $detailed_report
            ]);

        } catch (Exception $e) {
            log_message('error', "Get report details API error: " . $e->getMessage());
            return $this->_send_error('Internal server error', 500);
        }
    }

    /**
     * Share Report - Generate Public Link
     * 
     * POST /api/reports/shareReport/{reportId}
     * Headers: Authorization: Bearer {token}
     * Body: {"expires_in_days": 30} (optional)
     * 
     * @param int $report_id Report ID
     * @return JSON response with share link
     */
    public function shareReport($report_id = null) {
        try {
            // Only allow POST requests
            if ($this->input->method() !== 'post') {
                return $this->_send_error('Method not allowed', 405);
            }

            // Validate authentication
            $user_id = $this->_validate_api_token();
            if (!$user_id) {
                return $this->_send_error('Invalid or expired token', 401);
            }

            // Validate report ID
            if (!$report_id || !is_numeric($report_id)) {
                return $this->_send_error('Invalid report ID', 400);
            }

            // Get input data
            $input = json_decode($this->input->raw_input_stream, true) ?: [];
            $expires_in_days = max(1, min(365, (int)($input['expires_in_days'] ?? 30))); // 1-365 days

            // Verify report exists and belongs to user
            $this->db->select('project_id_pk, project_name, property_address');
            $this->db->from('lp_my_listing');
            $this->db->where('project_id_pk', $report_id);
            $this->db->where('user_id_fk', $user_id);
            $this->db->where('is_active', 'Y');
            $report = $this->db->get()->row_array();

            if (!$report) {
                return $this->_send_error('Report not found', 404);
            }

            // Generate share token
            $share_token = bin2hex(random_bytes(32));
            $share_expiry = date('Y-m-d H:i:s', strtotime("+{$expires_in_days} days"));

            // Update report with sharing information
            $update_data = [
                'share_token' => $share_token,
                'share_expiry' => $share_expiry,
                'is_public' => 1
            ];

            $this->db->where('project_id_pk', $report_id);
            $this->db->where('user_id_fk', $user_id);
            $update_result = $this->db->update('lp_my_listing', $update_data);

            if (!$update_result) {
                return $this->_send_error('Failed to generate share link', 500);
            }

            // Generate share URLs
            $share_link = base_url("shared/report/{$share_token}");
            $html_share_link = base_url("shared/html/{$share_token}");

            // Log sharing activity
            log_message('info', "Report {$report_id} shared by user {$user_id}, expires: {$share_expiry}");

            return $this->_send_response([
                'status' => true,
                'message' => 'Share link generated successfully',
                'share_data' => [
                    'share_token' => $share_token,
                    'share_link' => $share_link,
                    'html_share_link' => $html_share_link,
                    'expires_at' => $share_expiry,
                    'expires_in_days' => $expires_in_days,
                    'qr_code_url' => base_url("api/reports/qrcode/{$share_token}")
                ],
                'report_info' => [
                    'name' => $report['project_name'],
                    'address' => $report['property_address']
                ]
            ]);

        } catch (Exception $e) {
            log_message('error', "Share report API error: " . $e->getMessage());
            return $this->_send_error('Internal server error', 500);
        }
    }

    /**
     * Revoke Report Share Access
     * 
     * DELETE /api/reports/revokeShare/{reportId}
     * Headers: Authorization: Bearer {token}
     * 
     * @param int $report_id Report ID
     * @return JSON response confirming revocation
     */
    public function revokeShare($report_id = null) {
        try {
            // Only allow DELETE requests
            if ($this->input->method() !== 'delete') {
                return $this->_send_error('Method not allowed', 405);
            }

            // Validate authentication
            $user_id = $this->_validate_api_token();
            if (!$user_id) {
                return $this->_send_error('Invalid or expired token', 401);
            }

            // Validate report ID
            if (!$report_id || !is_numeric($report_id)) {
                return $this->_send_error('Invalid report ID', 400);
            }

            // Revoke sharing by clearing share data
            $update_data = [
                'share_token' => null,
                'share_expiry' => null,
                'is_public' => 0
            ];

            $this->db->where('project_id_pk', $report_id);
            $this->db->where('user_id_fk', $user_id);
            $update_result = $this->db->update('lp_my_listing', $update_data);

            if ($this->db->affected_rows() === 0) {
                return $this->_send_error('Report not found or not shared', 404);
            }

            // Log revocation
            log_message('info', "Share access revoked for report {$report_id} by user {$user_id}");

            return $this->_send_response([
                'status' => true,
                'message' => 'Share access revoked successfully'
            ]);

        } catch (Exception $e) {
            log_message('error', "Revoke share API error: " . $e->getMessage());
            return $this->_send_error('Internal server error', 500);
        }
    }

    /**
     * Generate QR Code for Report Share Link
     * 
     * GET /api/reports/qrcode/{shareToken}
     * 
     * @param string $share_token Share token
     * @return QR code image or JSON error
     */
    public function qrcode($share_token = null) {
        try {
            if (!$share_token) {
                return $this->_send_error('Share token required', 400);
            }

            // Verify share token exists and is valid
            $this->db->select('project_id_pk, property_address, share_expiry');
            $this->db->from('lp_my_listing');
            $this->db->where('share_token', $share_token);
            $this->db->where('share_expiry >', date('Y-m-d H:i:s'));
            $this->db->where('is_public', 1);
            $report = $this->db->get()->row_array();

            if (!$report) {
                return $this->_send_error('Invalid or expired share token', 404);
            }

            $share_url = base_url("shared/report/{$share_token}");

            // Generate QR code (using a simple implementation or library)
            // For now, return a redirect to an external QR code service
            $qr_service_url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($share_url);
            
            // Redirect to QR code image
            redirect($qr_service_url);

        } catch (Exception $e) {
            log_message('error', "QR code generation error: " . $e->getMessage());
            return $this->_send_error('QR code generation failed', 500);
        }
    }

    // ==========================================
    // PRIVATE HELPER METHODS
    // ==========================================

    /**
     * Validate API token from Authorization header
     * 
     * @return int|false User ID if valid, false if invalid
     */
    private function _validate_api_token() {
        $auth_header = $this->input->get_request_header('Authorization', true);
        
        if (!$auth_header) {
            return false;
        }

        // Remove 'Bearer ' prefix
        $token = (strpos($auth_header, 'Bearer ') === 0) ? substr($auth_header, 7) : $auth_header;

        // Look up token in database
        $this->db->select('user_id_pk');
        $this->db->from('lp_user_mst');
        $this->db->where('api_token', $token);
        $this->db->where('token_expiry >', date('Y-m-d H:i:s'));
        $this->db->where('is_active', 'Y');
        $user = $this->db->get()->row_array();

        return $user ? $user['user_id_pk'] : false;
    }

    /**
     * Format file size in human readable format
     * 
     * @param int $bytes File size in bytes
     * @return string Formatted file size
     */
    private function _format_file_size($bytes) {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= (1 << (10 * $pow));
        
        return round($bytes, 1) . ' ' . $units[$pow];
    }

    /**
     * Send JSON success response
     * 
     * @param array $data Response data
     * @param int $status_code HTTP status code
     */
    private function _send_response($data, $status_code = 200) {
        $this->output
            ->set_status_header($status_code)
            ->set_output(json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Send JSON error response
     * 
     * @param string $message Error message
     * @param int $status_code HTTP status code
     * @param array $details Additional error details
     */
    private function _send_error($message, $status_code = 400, $details = null) {
        $response = [
            'status' => false,
            'error' => $message,
            'code' => $status_code,
            'timestamp' => date('c')
        ];

        if ($details) {
            $response['details'] = $details;
        }

        $this->output
            ->set_status_header($status_code)
            ->set_output(json_encode($response, JSON_PRETTY_PRINT));
    }
}

/* End of file Reports.php */
/* Location: ./application/controllers/api/Reports.php */ 