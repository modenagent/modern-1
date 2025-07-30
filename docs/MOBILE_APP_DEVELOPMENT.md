# Modern Agent - Mobile App Development Guide

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