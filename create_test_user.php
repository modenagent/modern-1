<?php
/**
 * Create Test User Script
 * 
 * This script creates a test user for API testing purposes
 */

// Get the base URL
$base_url = isset($_SERVER['HTTP_HOST']) ? 
    'http://' . $_SERVER['HTTP_HOST'] . '/' : 
    'http://localhost/';

echo "Creating test user for API testing...\n";
echo "Base URL: $base_url\n\n";

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
            'Content-Type: application/x-www-form-urlencoded'
        ], $headers),
        CURLOPT_SSL_VERIFYPEER => false
    ]);
    
    if ($data && ($method === 'POST' || $method === 'PUT')) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
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

// Test user data
$test_user_data = [
    'uname' => 'testuser',
    'fname' => 'Test',
    'lname' => 'User',
    'uemail' => 'test@example.com',
    'uphone' => '555-123-4567',
    'user_pass' => 'testpassword',
    'role_id' => 4, // Default role
    'cname' => 'Test Real Estate Company',
    'caddress' => '123 Test Street',
    'ccity' => 'Test City',
    'czipcode' => '12345',
    'ulicence' => 'TEST123456'
];

echo "Creating user with the following details:\n";
echo "- Name: {$test_user_data['fname']} {$test_user_data['lname']}\n";
echo "- Email: {$test_user_data['uemail']}\n";
echo "- Username: {$test_user_data['uname']}\n";
echo "- Company: {$test_user_data['cname']}\n\n";

// Register the user
$register_url = $base_url . 'auth/userregister';
$response = makeRequest($register_url, 'POST', $test_user_data);

echo "Registration Response:\n";
echo "HTTP Code: {$response['http_code']}\n";
echo "Response: {$response['response']}\n";

if ($response['data']) {
    if (isset($response['data']['status']) && $response['data']['status'] === 'success') {
        echo "\n✅ SUCCESS: Test user created successfully!\n";
        echo "You can now use these credentials for testing:\n";
        echo "Email: {$test_user_data['uemail']}\n";
        echo "Password: {$test_user_data['user_pass']}\n";
    } else {
        echo "\n❌ ERROR: " . ($response['data']['msg'] ?? 'Unknown error') . "\n";
        
        if (strpos($response['data']['msg'] ?? '', 'already exists') !== false) {
            echo "\n💡 The test user already exists. You can use these credentials:\n";
            echo "Email: {$test_user_data['uemail']}\n";
            echo "Password: {$test_user_data['user_pass']}\n";
        }
    }
} else {
    echo "\n❌ ERROR: Invalid response from server\n";
    if ($response['error']) {
        echo "cURL Error: {$response['error']}\n";
    }
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "You can now run the API tests with:\n";
echo "php test_api_endpoints.php\n";
echo str_repeat("=", 50) . "\n";
?>