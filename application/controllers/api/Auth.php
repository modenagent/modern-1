<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modern Agent Authentication API Controller
 * 
 * Handles authentication for mobile apps and external API integrations
 * Provides token-based authentication with secure token management
 * 
 * @package ModernAgent
 * @subpackage API
 * @version 1.0.0
 * @author Modern Agent Development Team
 */
class Auth extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        
        // Load required libraries and helpers
        $this->load->database();
        $this->load->helper(['url', 'security']);
        $this->load->library(['form_validation', 'session']);
        
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
     * User Login - Generate API Token
     * 
     * POST /api/auth/login
     * Body: {"email": "user@example.com", "password": "password"}
     * 
     * @return JSON response with user data and API token
     */
    public function login() {
        try {
            // Only allow POST requests
            if ($this->input->method() !== 'post') {
                return $this->_send_error('Method not allowed', 405);
            }

            // Get JSON input
            $input = json_decode($this->input->raw_input_stream, true);
            
            if (!$input) {
                return $this->_send_error('Invalid JSON input', 400);
            }

            $email = trim($input['email'] ?? '');
            $password = trim($input['password'] ?? '');

            // Validate required fields
            if (empty($email) || empty($password)) {
                return $this->_send_error('Email and password are required', 400, [
                    'email' => empty($email) ? 'Email is required' : null,
                    'password' => empty($password) ? 'Password is required' : null
                ]);
            }

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->_send_error('Invalid email format', 400);
            }

            // Authenticate user credentials
            $user = $this->_authenticate_user($email, $password);
            
            if (!$user) {
                // Log failed login attempt
                log_message('warning', "Failed login attempt for email: {$email} from IP: " . $this->input->ip_address());
                return $this->_send_error('Invalid credentials', 401);
            }

            // Generate API token
            $token_data = $this->_generate_api_token($user['user_id_pk']);
            
            if (!$token_data) {
                return $this->_send_error('Failed to generate authentication token', 500);
            }

            // Prepare user data (remove sensitive information)
            $user_data = [
                'user_id_pk' => $user['user_id_pk'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'company_name' => $user['company_name'] ?? '',
                'profile_image' => $user['profile_image'] ?? '',
                'phone' => $user['phone'] ?? '',
                'title' => $user['title'] ?? ''
            ];

            // Log successful login
            log_message('info', "Successful API login for user ID: {$user['user_id_pk']} from IP: " . $this->input->ip_address());

            // Return success response
            return $this->_send_response([
                'status' => true,
                'message' => 'Login successful',
                'user' => $user_data,
                'token' => $token_data['token'],
                'expires_at' => $token_data['expires_at']
            ]);

        } catch (Exception $e) {
            log_message('error', "Login API error: " . $e->getMessage());
            return $this->_send_error('Internal server error', 500);
        }
    }

    /**
     * Refresh API Token
     * 
     * POST /api/auth/refreshToken
     * Headers: Authorization: Bearer {current_token}
     * 
     * @return JSON response with new token
     */
    public function refreshToken() {
        try {
            // Only allow POST requests
            if ($this->input->method() !== 'post') {
                return $this->_send_error('Method not allowed', 405);
            }

            // Validate current token
            $user_id = $this->_validate_api_token();
            
            if (!$user_id) {
                return $this->_send_error('Invalid or expired token', 401);
            }

            // Generate new token
            $token_data = $this->_generate_api_token($user_id);
            
            if (!$token_data) {
                return $this->_send_error('Failed to generate new token', 500);
            }

            // Log token refresh
            log_message('info', "API token refreshed for user ID: {$user_id} from IP: " . $this->input->ip_address());

            // Return new token
            return $this->_send_response([
                'status' => true,
                'message' => 'Token refreshed successfully',
                'token' => $token_data['token'],
                'expires_at' => $token_data['expires_at']
            ]);

        } catch (Exception $e) {
            log_message('error', "Token refresh API error: " . $e->getMessage());
            return $this->_send_error('Internal server error', 500);
        }
    }

    /**
     * Logout - Invalidate API Token
     * 
     * POST /api/auth/logout
     * Headers: Authorization: Bearer {token}
     * 
     * @return JSON response confirming logout
     */
    public function logout() {
        try {
            // Only allow POST requests
            if ($this->input->method() !== 'post') {
                return $this->_send_error('Method not allowed', 405);
            }

            // Get current token
            $token = $this->_get_authorization_token();
            
            if (!$token) {
                return $this->_send_error('No token provided', 401);
            }

            // Invalidate token by setting expiry to past
            $this->db->where('api_token', $token);
            $this->db->update('lp_user_mst', [
                'token_expiry' => date('Y-m-d H:i:s', strtotime('-1 hour'))
            ]);

            if ($this->db->affected_rows() === 0) {
                return $this->_send_error('Token not found', 404);
            }

            // Log logout
            log_message('info', "API logout for token: " . substr($token, 0, 8) . "... from IP: " . $this->input->ip_address());

            return $this->_send_response([
                'status' => true,
                'message' => 'Logout successful'
            ]);

        } catch (Exception $e) {
            log_message('error', "Logout API error: " . $e->getMessage());
            return $this->_send_error('Internal server error', 500);
        }
    }

    /**
     * Validate Token (for testing/debugging)
     * 
     * GET /api/auth/validate
     * Headers: Authorization: Bearer {token}
     * 
     * @return JSON response with token validity
     */
    public function validate() {
        try {
            // Only allow GET requests
            if ($this->input->method() !== 'get') {
                return $this->_send_error('Method not allowed', 405);
            }

            $user_id = $this->_validate_api_token();
            
            if (!$user_id) {
                return $this->_send_error('Invalid or expired token', 401);
            }

            // Get user information
            $this->db->select('user_id_pk, first_name, last_name, email, token_expiry');
            $this->db->from('lp_user_mst');
            $this->db->where('user_id_pk', $user_id);
            $user = $this->db->get()->row_array();

            if (!$user) {
                return $this->_send_error('User not found', 404);
            }

            return $this->_send_response([
                'status' => true,
                'message' => 'Token is valid',
                'user_id' => $user['user_id_pk'],
                'email' => $user['email'],
                'expires_at' => $user['token_expiry']
            ]);

        } catch (Exception $e) {
            log_message('error', "Token validation API error: " . $e->getMessage());
            return $this->_send_error('Internal server error', 500);
        }
    }

    // ==========================================
    // PRIVATE HELPER METHODS
    // ==========================================

    /**
     * Authenticate user credentials
     * 
     * @param string $email User email
     * @param string $password User password
     * @return array|false User data or false if invalid
     */
    private function _authenticate_user($email, $password) {
        $this->db->select('user_id_pk, first_name, last_name, email, password, company_name, profile_image, phone, title');
        $this->db->from('lp_user_mst');
        $this->db->where('email', $email);
        $this->db->where('is_active', 'Y'); // Only active users
        $user = $this->db->get()->row_array();

        if (!$user) {
            return false;
        }

        // Verify password (assuming MD5 for existing system)
        // TODO: Upgrade to password_hash() and password_verify() for better security
        if (md5($password) !== $user['password']) {
            return false;
        }

        return $user;
    }

    /**
     * Generate new API token for user
     * 
     * @param int $user_id User ID
     * @return array|false Token data or false if failed
     */
    private function _generate_api_token($user_id) {
        // Generate secure random token
        $token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', strtotime('+30 days'));

        // Update user with new token
        $this->db->where('user_id_pk', $user_id);
        $update_result = $this->db->update('lp_user_mst', [
            'api_token' => $token,
            'token_expiry' => $expires_at
        ]);

        if (!$update_result) {
            return false;
        }

        return [
            'token' => $token,
            'expires_at' => $expires_at
        ];
    }

    /**
     * Validate API token from Authorization header
     * 
     * @return int|false User ID if valid, false if invalid
     */
    private function _validate_api_token() {
        $token = $this->_get_authorization_token();
        
        if (!$token) {
            return false;
        }

        // Look up token in database
        $this->db->select('user_id_pk, token_expiry');
        $this->db->from('lp_user_mst');
        $this->db->where('api_token', $token);
        $this->db->where('token_expiry >', date('Y-m-d H:i:s')); // Token not expired
        $this->db->where('is_active', 'Y'); // User is active
        $user = $this->db->get()->row_array();

        if (!$user) {
            return false;
        }

        return $user['user_id_pk'];
    }

    /**
     * Extract token from Authorization header
     * 
     * @return string|false Token or false if not found
     */
    private function _get_authorization_token() {
        $auth_header = $this->input->get_request_header('Authorization', true);
        
        if (!$auth_header) {
            return false;
        }

        // Remove 'Bearer ' prefix
        if (strpos($auth_header, 'Bearer ') === 0) {
            return substr($auth_header, 7);
        }

        return $auth_header;
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

/* End of file Auth.php */
/* Location: ./application/controllers/api/Auth.php */ 