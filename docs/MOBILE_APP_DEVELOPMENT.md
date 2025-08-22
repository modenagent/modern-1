# Modern Agent - Mobile App Development Guide

**Last updated:** December 2024

## 📋 **Overview**

This guide provides complete documentation for creating a mobile app using FlutterFlow that integrates with the Modern Agent platform. The app will serve as an extension of the main site for viewing reports, requesting new reports, and sharing reports.

## 🎯 **App Requirements**

### **Core Functionality**
- **View Reports**: Display user's generated reports
- **Request New Reports**: Form to generate new property reports
- **Share Reports**: Generate shareable links for reports
- **User Authentication**: Secure login using existing token system

### **Technical Requirements**
- **Platform**: FlutterFlow (no-code/low-code)
- **Backend**: Existing Modern Agent API endpoints
- **Processing**: All done by main site (no local processing)
- **Authentication**: Token-based API authentication

## 🔧 **Existing API Infrastructure**

### **✅ Available Endpoints**

#### **Report Generation API**
```http
POST /api/report/generateReport
Content-Type: application/json
Authorization: Bearer {user_token}

{
    "token": "user_api_token",
    "report187": "https://api.sitexdata.com/187/{GUID}.asmx/GetXML?...",
    "report111": "https://api.map-data.com/111/{GUID}.asmx/GetXML?...",
    "user": {
        "fullname": "Agent Name",
        "email": "agent@example.com",
        "phone": "(555) 123-4567",
        "company_logo": "https://example.com/logo.png"
    },
    "presentation": "seller|buyer|registry",
    "theme": "#0f0f0f",
    "selected_pages": "[\"1\",\"2\",\"3\",\"4\",\"5\"]"
}
```

**Response:**
```json
{
    "status": true,
    "reportLink": "https://your-domain.com/temp/property_report_abc123.pdf",
    "project_id": 12345,
    "property_address": "123 Main St, City, State 12345",
    "report_type": "seller",
    "generated_at": "2024-01-15 14:30:25"
}
```

## 🆕 **Required New API Endpoints**

### **1. User Report History**
```php
// File: application/controllers/api/reports.php
<?php
class Reports extends CI_Controller {
    
    public function getUserReports() {
        $token = $this->input->get_request_header('Authorization', TRUE);
        $userId = $this->validateToken($token);
        
        if (!$userId) {
            return $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Invalid token']));
        }
        
        $page = $this->input->get('page') ?: 1;
        $limit = $this->input->get('limit') ?: 20;
        $offset = ($page - 1) * $limit;
        
        // Get user reports from database
        $this->db->select('project_id_pk, project_name, property_address, 
                          report_type, project_date, report_path, property_owner');
        $this->db->from('lp_my_listing');
        $this->db->where('user_id_fk', $userId);
        $this->db->where('is_active', 'Y');
        $this->db->order_by('project_date', 'DESC');
        $this->db->limit($limit, $offset);
        
        $reports = $this->db->get()->result_array();
        
        // Get total count for pagination
        $this->db->select('COUNT(*) as total');
        $this->db->from('lp_my_listing');
        $this->db->where('user_id_fk', $userId);
        $this->db->where('is_active', 'Y');
        $totalCount = $this->db->get()->row()->total;
        
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'reports' => $reports,
                'pagination' => [
                    'current_page' => (int)$page,
                    'total_pages' => ceil($totalCount / $limit),
                    'total_reports' => (int)$totalCount,
                    'per_page' => (int)$limit
                ]
            ]));
    }
    
    public function getReportDetails($reportId) {
        $token = $this->input->get_request_header('Authorization', TRUE);
        $userId = $this->validateToken($token);
        
        if (!$userId) {
            return $this->output->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Invalid token']));
        }
        
        // Get specific report details
        $this->db->select('*');
        $this->db->from('lp_my_listing');
        $this->db->where('project_id_pk', $reportId);
        $this->db->where('user_id_fk', $userId);
        
        $report = $this->db->get()->row_array();
        
        if (!$report) {
            return $this->output->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Report not found']));
        }
        
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'report' => $report
            ]));
    }
    
    public function shareReport($reportId) {
        $token = $this->input->get_request_header('Authorization', TRUE);
        $userId = $this->validateToken($token);
        
        if (!$userId) {
            return $this->output->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Invalid token']));
        }
        
        // Generate share token
        $shareToken = bin2hex(random_bytes(32));
        $expiryDate = date('Y-m-d H:i:s', strtotime('+30 days'));
        
        // Update report with share token
        $updateData = [
            'share_token' => $shareToken,
            'share_expiry' => $expiryDate,
            'is_public' => 1
        ];
        
        $this->db->where('project_id_pk', $reportId);
        $this->db->where('user_id_fk', $userId);
        $this->db->update('lp_my_listing', $updateData);
        
        if ($this->db->affected_rows() === 0) {
            return $this->output->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Report not found']));
        }
        
        $shareLink = base_url("shared/report/{$shareToken}");
        
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'share_link' => $shareLink,
                'expires_at' => $expiryDate
            ]));
    }
    
    private function validateToken($token) {
        // Remove 'Bearer ' prefix if present
        $token = str_replace('Bearer ', '', $token);
        
        // Validate token and return user ID
        $this->db->select('user_id_pk');
        $this->db->from('lp_user_mst');
        $this->db->where('api_token', $token);
        $this->db->where('token_expiry >', date('Y-m-d H:i:s'));
        
        $user = $this->db->get()->row();
        return $user ? $user->user_id_pk : false;
    }
}
?>
```

### **2. Authentication API**
```php
// File: application/controllers/api/auth.php
<?php
class Auth extends CI_Controller {
    
    public function login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        if (!$email || !$password) {
            return $this->output->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Email and password required']));
        }
        
        // Validate credentials
        $this->db->select('user_id_pk, first_name, last_name, email, company_name, profile_image');
        $this->db->from('lp_user_mst');
        $this->db->where('email', $email);
        $this->db->where('password', md5($password)); // Update to use proper hashing
        
        $user = $this->db->get()->row_array();
        
        if (!$user) {
            return $this->output->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Invalid credentials']));
        }
        
        // Generate API token
        $apiToken = bin2hex(random_bytes(32));
        $tokenExpiry = date('Y-m-d H:i:s', strtotime('+30 days'));
        
        // Update user with API token
        $this->db->where('user_id_pk', $user['user_id_pk']);
        $this->db->update('lp_user_mst', [
            'api_token' => $apiToken,
            'token_expiry' => $tokenExpiry
        ]);
        
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'user' => $user,
                'token' => $apiToken,
                'expires_at' => $tokenExpiry
            ]));
    }
    
    public function refreshToken() {
        $token = $this->input->get_request_header('Authorization', TRUE);
        $token = str_replace('Bearer ', '', $token);
        
        // Validate existing token
        $this->db->select('user_id_pk');
        $this->db->from('lp_user_mst');
        $this->db->where('api_token', $token);
        
        $user = $this->db->get()->row();
        
        if (!$user) {
            return $this->output->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Invalid token']));
        }
        
        // Generate new token
        $newToken = bin2hex(random_bytes(32));
        $tokenExpiry = date('Y-m-d H:i:s', strtotime('+30 days'));
        
        $this->db->where('user_id_pk', $user->user_id_pk);
        $this->db->update('lp_user_mst', [
            'api_token' => $newToken,
            'token_expiry' => $tokenExpiry
        ]);
        
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'token' => $newToken,
                'expires_at' => $tokenExpiry
            ]));
    }
}
?>
```

## 📱 **FlutterFlow Implementation**

### **App Structure**
```
Modern Agent Mobile App
├── Authentication
│   ├── Login Screen
│   ├── Token Management
│   └── User Profile
├── Reports
│   ├── Reports List
│   ├── Report Details
│   ├── Report Viewer (PDF/HTML)
│   └── Share Options
├── New Report
│   ├── Property Search
│   ├── Report Configuration
│   └── Generation Status
└── Settings
    ├── User Preferences
    ├── Theme Selection
    └── Logout
```

### **API Integration in FlutterFlow**

#### **1. Authentication Flow**
```dart
// Login API Call Configuration
Action: API Call
Method: POST
URL: https://your-domain.com/api/auth/login
Headers: 
  Content-Type: application/json
Body:
{
  "email": "[email_field]",
  "password": "[password_field]"
}

// Store token in app state
Action: Update App State
Variable: userToken
Value: [api_response.token]

Action: Update App State  
Variable: userData
Value: [api_response.user]
```

#### **2. Reports List API**
```dart
// Get User Reports
Action: API Call
Method: GET
URL: https://your-domain.com/api/reports/getUserReports?page=1&limit=20
Headers:
  Authorization: Bearer [userToken]
  Content-Type: application/json

// Display in List View
Widget: ListView Builder
Data Source: [api_response.reports]
```

#### **3. Report Generation API**
```dart
// Generate New Report
Action: API Call
Method: POST
URL: https://your-domain.com/api/report/generateReport
Headers:
  Authorization: Bearer [userToken]
  Content-Type: application/json
Body:
{
  "token": "[userToken]",
  "report187": "[property_data_url]",
  "report111": "[map_data_url]",
  "user": {
    "fullname": "[userData.first_name] [userData.last_name]",
    "email": "[userData.email]",
    "phone": "[userData.phone]",
    "company_logo": "[userData.company_logo]"
  },
  "presentation": "[selected_report_type]",
  "theme": "[selected_theme]",
  "selected_pages": "[selected_pages_json]"
}
```

### **Screen Designs**

#### **Reports List Screen**
```dart
// Widget Configuration
App Bar:
  Title: "My Reports"
  Actions: [Search Icon, Filter Icon]

Body: 
  RefreshIndicator:
    child: ListView.builder(
      itemBuilder: ReportCard(
        title: report.project_name,
        address: report.property_address,
        date: report.project_date,
        type: report.report_type,
        onTap: NavigateToReportDetails
      )
    )

Floating Action Button:
  Icon: Add
  onPressed: NavigateToNewReport
```

#### **Report Details Screen**
```dart
// Widget Configuration
App Bar:
  Title: report.project_name
  Actions: [Share Icon, Download Icon]

Body:
  Column(
    children: [
      PropertyInfoCard(),
      ActionButtons(
        ViewPDF(), ViewHTML(), ShareReport()
      ),
      ReportMetadata()
    ]
  )
```

#### **New Report Screen**
```dart
// Widget Configuration
Form:
  PropertyAddressField,
  ReportTypeDropdown(seller, buyer, registry),
  ThemeColorPicker,
  PageSelectionCheckboxes,
  SubmitButton(
    onPressed: CallGenerateReportAPI
  )

Progress Indicator:
  Show during API call
  Display generation status
```

### **Database Schema Updates**

```sql
-- Add mobile app support columns
ALTER TABLE lp_user_mst ADD COLUMN api_token VARCHAR(64) NULL;
ALTER TABLE lp_user_mst ADD COLUMN token_expiry DATETIME NULL;

-- Add sharing support columns  
ALTER TABLE lp_my_listing ADD COLUMN share_token VARCHAR(64) NULL;
ALTER TABLE lp_my_listing ADD COLUMN share_expiry DATETIME NULL;
ALTER TABLE lp_my_listing ADD COLUMN is_public TINYINT DEFAULT 0;

-- Add indexes for performance
CREATE INDEX idx_api_token ON lp_user_mst(api_token);
CREATE INDEX idx_share_token ON lp_my_listing(share_token);
CREATE INDEX idx_user_reports ON lp_my_listing(user_id_fk, is_active, project_date);
```

## 🔄 **Implementation Steps**

### **Phase 1: Backend API Development (Week 1)**
1. **Create new API controllers:**
   - `application/controllers/api/reports.php`
   - `application/controllers/api/auth.php`

2. **Update database schema:**
   - Add API token fields
   - Add sharing fields
   - Create indexes

3. **Test API endpoints:**
   - Use Postman or similar tool
   - Verify authentication flow
   - Test all CRUD operations

### **Phase 2: FlutterFlow App Development (Week 2-3)**
1. **Create app structure:**
   - Set up screens and navigation
   - Configure API integrations
   - Design UI components

2. **Implement authentication:**
   - Login/logout flow
   - Token storage and management
   - User profile management

3. **Build core features:**
   - Reports list with pagination
   - Report viewing (PDF/HTML)
   - New report generation
   - Sharing functionality

### **Phase 3: Testing & Optimization (Week 4)**
1. **Comprehensive testing:**
   - API integration testing
   - User flow testing
   - Performance optimization

2. **Security review:**
   - Token validation
   - API rate limiting
   - Data encryption

3. **Deployment preparation:**
   - App store submission
   - User documentation
   - Support documentation

## 🌐 **Live Device Testing with Tunneling**

### **Overview**
During development, you'll need to test your FlutterFlow app on real devices while connecting to your local development server. Tunneling services create secure public URLs that forward requests to your local Modern Agent instance.

### **ngrok Setup (Recommended)**

#### **Installation**
```bash
# macOS (Homebrew)
brew install ngrok/ngrok/ngrok

# Windows (Chocolatey)
choco install ngrok

# Linux (Snap)
sudo snap install ngrok

# Or download from: https://ngrok.com/download
```

#### **Authentication**
```bash
# Sign up at https://ngrok.com and get your auth token
ngrok config add-authtoken YOUR_AUTH_TOKEN_HERE
```

#### **Basic Usage**
```bash
# Expose local Modern Agent server (assuming port 80/8080)
ngrok http 80

# For HTTPS only (recommended for API testing)
ngrok http --scheme=https 80

# Custom subdomain (requires paid plan)
ngrok http --subdomain=my-modern-agent 80
```

#### **Example Output**
```
ngrok by @inconshreveable

Session Status                online
Account                       user@example.com (Plan: Free)
Version                       3.1.0
Region                        United States (us)
Latency                       45ms
Web Interface                 http://127.0.0.1:4040
Forwarding                    https://abc123.ngrok.io -> http://localhost:80

Connections                   ttl     opn     rt1     rt5     p50     p90
                              0       0       0.00    0.00    0.00    0.00
```

#### **FlutterFlow Configuration**
In your FlutterFlow app, update API base URLs:
```
Development Base URL: https://abc123.ngrok.io
API Endpoints:
- Login: https://abc123.ngrok.io/api/auth/login
- Generate Report: https://abc123.ngrok.io/api/report/generateReport
- Get Reports: https://abc123.ngrok.io/api/reports/getUserReports
```

### **Cloudflare Tunnel Setup**

#### **Installation**
```bash
# Download cloudflared
# macOS
brew install cloudflare/cloudflare/cloudflared

# Windows
winget install --id Cloudflare.cloudflared

# Linux
wget https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-amd64.deb
sudo dpkg -i cloudflared-linux-amd64.deb
```

#### **Quick Tunnel (No Account Required)**
```bash
# Create temporary tunnel
cloudflared tunnel --url http://localhost:80

# Example output:
# Your quick Tunnel has been created! Visit it at (it may take some time to be reachable):
# https://random-words-1234.trycloudflare.com
```

#### **Named Tunnel (Persistent)**
```bash
# Login to Cloudflare
cloudflared tunnel login

# Create tunnel
cloudflared tunnel create modern-agent-dev

# Configure tunnel (create config.yml)
cat > ~/.cloudflared/config.yml << EOF
tunnel: modern-agent-dev
credentials-file: ~/.cloudflared/YOUR_TUNNEL_ID.json

ingress:
  - hostname: modern-agent-dev.yourdomain.com
    service: http://localhost:80
  - service: http_status:404
EOF

# Run tunnel
cloudflared tunnel run modern-agent-dev
```

### **Development Workflow**

#### **1. Start Local Development Server**
```bash
# Start your local Modern Agent server
php -S localhost:80 -t /path/to/modern-agent

# Or using Apache/Nginx
sudo systemctl start apache2
```

#### **2. Start Tunnel**
```bash
# Terminal 1: Start ngrok
ngrok http 80

# Or Cloudflare Tunnel
cloudflared tunnel --url http://localhost:80
```

#### **3. Update FlutterFlow**
1. Copy the public URL from tunnel output
2. Update API base URL in FlutterFlow
3. Test API endpoints in FlutterFlow's API tester

#### **4. Test on Device**
1. Preview app in FlutterFlow
2. Use "Test on Device" feature
3. App will connect to your local server via tunnel

### **Security Considerations**

#### **ngrok Security**
```bash
# Add basic auth to protect your tunnel
ngrok http 80 --basic-auth="username:password"

# Restrict to specific IPs (paid feature)
ngrok http 80 --cidr-allow="192.168.1.0/24"

# Use custom domain (paid feature)
ngrok http 80 --hostname="dev.yourdomain.com"
```

#### **Environment Variables for Tunneling**
```env
# Add to your .env file
TUNNEL_MODE=development
ALLOWED_ORIGINS=https://abc123.ngrok.io,https://random-words-1234.trycloudflare.com
CORS_ENABLED=true
DEBUG_MODE=true
```

#### **PHP CORS Configuration**
```php
// Add to your API controllers for development
if ($_ENV['TUNNEL_MODE'] === 'development') {
    $allowed_origins = explode(',', $_ENV['ALLOWED_ORIGINS']);
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
    
    if (in_array($origin, $allowed_origins)) {
        header("Access-Control-Allow-Origin: $origin");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
    }
}
```

### **Testing Checklist**

#### **API Connectivity**
- [ ] Login endpoint works via tunnel
- [ ] Report generation API responds correctly
- [ ] File uploads work (if applicable)
- [ ] Authentication tokens are properly handled
- [ ] CORS headers are set correctly

#### **FlutterFlow Integration**
- [ ] API calls succeed from FlutterFlow preview
- [ ] Error handling works correctly
- [ ] Loading states display properly
- [ ] Data parsing works as expected
- [ ] Navigation flows work end-to-end

#### **Device Testing**
- [ ] App works on iOS simulator/device
- [ ] App works on Android emulator/device
- [ ] Network requests succeed on mobile data
- [ ] App handles network interruptions gracefully
- [ ] Performance is acceptable on real devices

### **Troubleshooting**

#### **Common ngrok Issues**
```bash
# Issue: "tunnel session failed"
# Solution: Check auth token
ngrok config add-authtoken YOUR_TOKEN

# Issue: "tunnel not found"
# Solution: Restart ngrok
pkill ngrok && ngrok http 80

# Issue: CORS errors
# Solution: Add proper headers in PHP
```

#### **Common Cloudflare Issues**
```bash
# Issue: "tunnel credentials not found"
# Solution: Re-authenticate
cloudflared tunnel login

# Issue: "service unavailable"
# Solution: Check local server is running
curl http://localhost:80

# Issue: DNS resolution
# Solution: Wait 2-3 minutes for DNS propagation
```

#### **FlutterFlow Issues**
- **API calls fail**: Check tunnel URL is correct and accessible
- **Authentication errors**: Verify token format and headers
- **CORS errors**: Ensure proper CORS headers in PHP
- **Timeout errors**: Increase timeout in FlutterFlow API settings

### **Production Considerations**

#### **Before Going Live**
1. **Remove tunnel URLs** from FlutterFlow
2. **Update to production API URLs**
3. **Disable debug/development modes**
4. **Remove CORS development headers**
5. **Test with production SSL certificates**

#### **Environment Switching**
```dart
// FlutterFlow custom code for environment switching
String getApiBaseUrl() {
  if (kDebugMode) {
    return 'https://abc123.ngrok.io'; // Development tunnel
  } else {
    return 'https://api.yourdomain.com'; // Production API
  }
}
```

## 📊 **Error Handling & Edge Cases**

### **API Error Responses**
```json
// Authentication Error
{
  "status": false,
  "error": "Invalid token",
  "code": 401
}

// Validation Error
{
  "status": false,
  "error": "Missing required parameters",
  "code": 400,
  "details": ["report187 is required", "user.email is required"]
}

// Server Error
{
  "status": false,
  "error": "Internal server error",
  "code": 500,
  "message": "PDF generation failed"
}
```

### **FlutterFlow Error Handling**
```dart
// API Call Error Handling
if (api_response.status == false) {
  showSnackBar(api_response.error);
  return;
}

// Network Error Handling
try {
  // API call
} catch (e) {
  showDialog("Network error. Please check your connection.");
}

// Token Expiry Handling
if (api_response.code == 401) {
  navigateToLogin();
  clearUserData();
}
```

## 🚀 **Success Metrics**

### **Performance Targets**
- **App Launch Time**: < 3 seconds
- **API Response Time**: < 5 seconds
- **Report Generation**: < 30 seconds
- **Report Loading**: < 2 seconds

### **User Experience Goals**
- **Intuitive Navigation**: 95% task completion rate
- **Fast Report Access**: 3 taps to view any report
- **Reliable Sharing**: 99% share link success rate
- **Offline Capability**: View downloaded reports offline

This comprehensive documentation ensures the next AI agent can seamlessly continue mobile app development with all necessary technical details, code examples, and implementation guidance. 