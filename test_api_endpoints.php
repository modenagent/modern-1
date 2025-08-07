<?php
/**
 * Modern Agent API Endpoint Testing Script
 * 
 * This script tests the following API endpoints:
 * - Authentication API (login, token validation, logout)
 * - Reports Management API (getUserReports, getReportDetails, generateShareToken)
 * - HTML Reports API (getHtmlReport, shareHtmlReport)
 * 
 * Usage: 
 * - Command line: php test_api_endpoints.php
 * - Browser: http://localhost/test_api_endpoints.php
 */

// Configuration
$base_url = isset($_SERVER['HTTP_HOST']) ? 
    'http://' . $_SERVER['HTTP_HOST'] . '/' : 
    'http://localhost/';

// Test user credentials (update with valid test credentials)
$test_email = 'test@example.com';
$test_password = 'testpassword';

// Color output for terminal
function colorOutput($text, $color = 'white') {
    $colors = [
        'red' => "\033[31m",
        'green' => "\033[32m",
        'yellow' => "\033[33m",
        'blue' => "\033[34m",
        'white' => "\033[37m",
        'reset' => "\033[0m"
    ];
    
    if (php_sapi_name() === 'cli') {
        return ($colors[$color] ?? $colors['white']) . $text . $colors['reset'];
    }
    return $text;
}

// Test results storage
$test_results = [];
$auth_token = null;

/**
 * Make HTTP request
 */
function makeRequest($url, $method = 'GET', $data = null, $headers = []) {
    $ch = curl_init();
    
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => array_merge([
            'Content-Type: application/json',
            'Accept: application/json'
        ], $headers),
        CURLOPT_SSL_VERIFYPEER => false
    ]);
    
    if ($data && ($method === 'POST' || $method === 'PUT')) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    return [
        'http_code' => $http_code,
        'response' => $response,
        'error' => $error,
        'data' => json_decode($response, true)
    ];
}

/**
 * Log test result
 */
function logTest($test_name, $passed, $message = '', $data = null) {
    global $test_results;
    
    $result = [
        'test' => $test_name,
        'passed' => $passed,
        'message' => $message,
        'data' => $data,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    $test_results[] = $result;
    
    $status = $passed ? colorOutput('PASS', 'green') : colorOutput('FAIL', 'red');
    $output = "[$status] $test_name";
    if ($message) {
        $output .= " - $message";
    }
    
    echo $output . "\n";
    
    return $result;
}

/**
 * Test Authentication API
 */
function testAuthenticationAPI($base_url, $test_email, $test_password) {
    global $auth_token;
    
    echo colorOutput("\n=== Testing Authentication API ===\n", 'blue');
    
    // Test 1: Login with valid credentials
    $login_url = $base_url . 'api/auth/login';
    $login_data = [
        'email' => $test_email,
        'password' => $test_password
    ];
    
    $response = makeRequest($login_url, 'POST', $login_data);
    
    if ($response['http_code'] === 200 && isset($response['data']['success']) && $response['data']['success']) {
        $auth_token = $response['data']['data']['token'] ?? null;
        logTest('Authentication Login', true, 'Successfully logged in and received token');
    } else {
        logTest('Authentication Login', false, 'Failed to login: ' . ($response['data']['message'] ?? 'Unknown error'));
        return false;
    }
    
    // Test 2: Test invalid credentials
    $invalid_login_data = [
        'email' => 'invalid@example.com',
        'password' => 'wrongpassword'
    ];
    
    $response = makeRequest($login_url, 'POST', $invalid_login_data);
    
    if ($response['http_code'] === 401) {
        logTest('Authentication Invalid Credentials', true, 'Correctly rejected invalid credentials');
    } else {
        logTest('Authentication Invalid Credentials', false, 'Should have rejected invalid credentials');
    }
    
    // Test 3: Test token validation (via protected endpoint)
    if ($auth_token) {
        $reports_url = $base_url . 'api/reports/getUserReports';
        $headers = ['Authorization: Bearer ' . $auth_token];
        
        $response = makeRequest($reports_url, 'GET', null, $headers);
        
        if ($response['http_code'] === 200) {
            logTest('Token Validation', true, 'Token is valid and accepted');
        } else {
            logTest('Token Validation', false, 'Token validation failed: HTTP ' . $response['http_code']);
        }
    }
    
    return true;
}

/**
 * Test Reports Management API
 */
function testReportsAPI($base_url, $auth_token) {
    echo colorOutput("\n=== Testing Reports Management API ===\n", 'blue');
    
    if (!$auth_token) {
        logTest('Reports API Setup', false, 'No authentication token available');
        return false;
    }
    
    $headers = ['Authorization: Bearer ' . $auth_token];
    
    // Test 1: Get user reports
    $reports_url = $base_url . 'api/reports/getUserReports';
    $response = makeRequest($reports_url, 'GET', null, $headers);
    
    if ($response['http_code'] === 200 && isset($response['data']['success'])) {
        $reports_count = count($response['data']['data']['reports'] ?? []);
        logTest('Get User Reports', true, "Successfully retrieved $reports_count reports");
        
        // Store first report ID for further testing
        $reports = $response['data']['data']['reports'] ?? [];
        $first_report_id = !empty($reports) ? $reports[0]['project_id_pk'] : null;
        
        // Test 2: Get report details (if we have a report)
        if ($first_report_id) {
            $report_detail_url = $base_url . 'api/reports/getReportDetails/' . $first_report_id;
            $response = makeRequest($report_detail_url, 'GET', null, $headers);
            
            if ($response['http_code'] === 200) {
                logTest('Get Report Details', true, 'Successfully retrieved report details');
            } else {
                logTest('Get Report Details', false, 'Failed to get report details: HTTP ' . $response['http_code']);
            }
            
            // Test 3: Generate share token
            $share_url = $base_url . 'api/reports/generateShareToken/' . $first_report_id;
            $response = makeRequest($share_url, 'POST', null, $headers);
            
            if ($response['http_code'] === 200) {
                logTest('Generate Share Token', true, 'Successfully generated share token');
            } else {
                logTest('Generate Share Token', false, 'Failed to generate share token: HTTP ' . $response['http_code']);
            }
        } else {
            logTest('Report Details Test', false, 'No reports available for testing');
        }
    } else {
        logTest('Get User Reports', false, 'Failed to retrieve reports: HTTP ' . $response['http_code']);
    }
}

/**
 * Test HTML Reports API
 */
function testHtmlReportsAPI($base_url, $auth_token) {
    echo colorOutput("\n=== Testing HTML Reports API ===\n", 'blue');
    
    if (!$auth_token) {
        logTest('HTML Reports API Setup', false, 'No authentication token available');
        return false;
    }
    
    $headers = ['Authorization: Bearer ' . $auth_token];
    
    // First, get a report ID to test with
    $reports_url = $base_url . 'api/reports/getUserReports?limit=1';
    $response = makeRequest($reports_url, 'GET', null, $headers);
    
    if ($response['http_code'] === 200 && !empty($response['data']['data']['reports'])) {
        $report_id = $response['data']['data']['reports'][0]['project_id_pk'];
        
        // Test 1: Get HTML report
        $html_url = $base_url . 'api/htmlReports/getHtmlReport/' . $report_id;
        $response = makeRequest($html_url, 'GET', null, $headers);
        
        if ($response['http_code'] === 200) {
            logTest('Get HTML Report', true, 'Successfully retrieved HTML report');
        } else {
            logTest('Get HTML Report', false, 'Failed to get HTML report: HTTP ' . $response['http_code']);
        }
        
        // Test 2: Test share functionality (if we can generate a share token)
        $share_token_url = $base_url . 'api/reports/generateShareToken/' . $report_id;
        $token_response = makeRequest($share_token_url, 'POST', null, $headers);
        
        if ($token_response['http_code'] === 200 && isset($token_response['data']['data']['share_token'])) {
            $share_token = $token_response['data']['data']['share_token'];
            $share_url = $base_url . 'api/htmlReports/shareHtmlReport/' . $share_token;
            
            $response = makeRequest($share_url, 'GET');
            
            if ($response['http_code'] === 200) {
                logTest('Share HTML Report', true, 'Successfully accessed shared HTML report');
            } else {
                logTest('Share HTML Report', false, 'Failed to access shared report: HTTP ' . $response['http_code']);
            }
        } else {
            logTest('Share HTML Report', false, 'Could not generate share token for testing');
        }
    } else {
        logTest('HTML Reports API', false, 'No reports available for testing HTML functionality');
    }
}

/**
 * Test API Error Handling
 */
function testErrorHandling($base_url) {
    echo colorOutput("\n=== Testing Error Handling ===\n", 'blue');
    
    // Test 1: Invalid endpoint
    $invalid_url = $base_url . 'api/nonexistent/endpoint';
    $response = makeRequest($invalid_url, 'GET');
    
    if ($response['http_code'] === 404) {
        logTest('404 Error Handling', true, 'Correctly returned 404 for invalid endpoint');
    } else {
        logTest('404 Error Handling', false, 'Should return 404 for invalid endpoint');
    }
    
    // Test 2: Missing authentication
    $protected_url = $base_url . 'api/reports/getUserReports';
    $response = makeRequest($protected_url, 'GET');
    
    if ($response['http_code'] === 401) {
        logTest('Authentication Required', true, 'Correctly rejected unauthenticated request');
    } else {
        logTest('Authentication Required', false, 'Should require authentication');
    }
    
    // Test 3: Invalid JSON
    $login_url = $base_url . 'api/auth/login';
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $login_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => 'invalid json',
        CURLOPT_HTTPHEADER => ['Content-Type: application/json']
    ]);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code === 400) {
        logTest('Invalid JSON Handling', true, 'Correctly rejected invalid JSON');
    } else {
        logTest('Invalid JSON Handling', false, 'Should reject invalid JSON with 400 error');
    }
}

/**
 * Display test summary
 */
function displaySummary($test_results) {
    echo colorOutput("\n=== Test Summary ===\n", 'blue');
    
    $total_tests = count($test_results);
    $passed_tests = count(array_filter($test_results, function($result) {
        return $result['passed'];
    }));
    $failed_tests = $total_tests - $passed_tests;
    
    echo "Total Tests: $total_tests\n";
    echo colorOutput("Passed: $passed_tests", 'green') . "\n";
    
    if ($failed_tests > 0) {
        echo colorOutput("Failed: $failed_tests", 'red') . "\n";
        
        echo "\nFailed Tests:\n";
        foreach ($test_results as $result) {
            if (!$result['passed']) {
                echo colorOutput("- {$result['test']}: {$result['message']}", 'red') . "\n";
            }
        }
    }
    
    $success_rate = round(($passed_tests / $total_tests) * 100, 1);
    echo "\nSuccess Rate: {$success_rate}%\n";
    
    if ($success_rate >= 80) {
        echo colorOutput("Overall Status: GOOD", 'green') . "\n";
    } elseif ($success_rate >= 60) {
        echo colorOutput("Overall Status: NEEDS ATTENTION", 'yellow') . "\n";
    } else {
        echo colorOutput("Overall Status: CRITICAL", 'red') . "\n";
    }
}

// Main execution
echo colorOutput("Modern Agent API Testing Started\n", 'blue');
echo "Base URL: $base_url\n";
echo "Test Email: $test_email\n\n";

// Run tests
testAuthenticationAPI($base_url, $test_email, $test_password);
testReportsAPI($base_url, $auth_token);
testHtmlReportsAPI($base_url, $auth_token);
testErrorHandling($base_url);

// Display results
displaySummary($test_results);

// Save results to file
$results_file = 'test_results_' . date('Y-m-d_H-i-s') . '.json';
file_put_contents($results_file, json_encode([
    'timestamp' => date('Y-m-d H:i:s'),
    'base_url' => $base_url,
    'test_email' => $test_email,
    'summary' => [
        'total' => count($test_results),
        'passed' => count(array_filter($test_results, function($r) { return $r['passed']; })),
        'failed' => count(array_filter($test_results, function($r) { return !$r['passed']; }))
    ],
    'results' => $test_results
], JSON_PRETTY_PRINT));

echo "\nDetailed results saved to: $results_file\n";
?>