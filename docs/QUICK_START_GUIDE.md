# Modern Agent Repository - Quick Start Guide for AI Agents & Developers

## 🚀 **Welcome to Modern Agent**

Modern Agent is a sophisticated real estate report generation system that creates professional PDF reports using external APIs, AI analysis, and multiple PDF generation engines. This guide will help AI agents and developers quickly understand and work with the system.

## 📋 **What Modern Agent Does**

### **Core Functionality**
- **Real Estate Report Generation**: Creates professional PDF reports for real estate agents
- **External Data Integration**: Fetches property data from SiteX Data API and geographic APIs
- **AI-Powered Analysis**: Uses GPT-4 to generate market insights and analysis
- **Multi-Engine PDF Generation**: Primary (wkhtmltopdf), backup (DomPDF), and alternative (mPDF) engines
- **Branded Customization**: Agent logos, themes, and personalized styling
- **Multiple Distribution Methods**: API responses, direct downloads, email delivery

### **Target Users**
- **Real Estate Agents**: Generate branded property reports for clients
- **Real Estate Platforms**: Integrate report generation via API
- **Property Management Companies**: Bulk report generation
- **MLS Systems**: Automated report creation for listings

## 🏗️ **System Architecture Overview**

```
┌─────────────────┐    ┌──────────────────┐    ┌─────────────────┐
│   External APIs │ -> │  Data Processing │ -> │ PDF Generation  │
│  - SiteX Data   │    │  - Statistics    │    │ - wkhtmltopdf   │
│  - Map APIs     │    │  - AI Analysis   │    │ - DomPDF        │
│  - OpenAI GPT-4 │    │  - Templates     │    │ - mPDF          │
└─────────────────┘    └──────────────────┘    └─────────────────┘
          │                      │                       │
          v                      v                       v
┌─────────────────┐    ┌──────────────────┐    ┌─────────────────┐
│   Input Data    │    │ HTML Generation  │    │   Distribution  │
│ - Property Info │    │ - Dynamic Content│    │ - Database      │
│ - User Branding │    │ - Maps & Charts  │    │ - File Storage  │
│ - Configuration │    │ - QR Codes       │    │ - API Response  │
└─────────────────┘    └──────────────────┘    └─────────────────┘
```

## 📁 **Project Structure**

```
modern-1/
├── application/                    # CodeIgniter application
│   ├── controllers/               # Request handlers
│   │   ├── api/                  # API endpoints
│   │   │   ├── Auth.php         # ✅ Mobile authentication API
│   │   │   ├── Reports.php      # ✅ Reports management API  
│   │   │   ├── Html_reports.php # ✅ Mobile HTML reports API
│   │   │   └── report.php       # Legacy report generation API
│   │   ├── user.php             # User management
│   │   └── admin.php            # Administrative functions
│   ├── libraries/               # Core business logic
│   │   ├── Reports.php          # MAIN REPORT ENGINE (1,851 lines)
│   │   ├── Pdf.php              # mPDF wrapper
│   │   └── dompdf_gen.php       # DomPDF implementation
│   ├── models/                  # Database interactions
│   ├── views/                   # HTML templates
│   │   └── reports/             # Report templates
│   │       └── mobile/          # ✅ Mobile HTML templates
│   │           ├── report_template.php      # Main mobile template
│   │           └── components/              # Modular components
│   │               ├── property_overview.php
│   │               ├── comparable_sales.php
│   │               ├── ai_insights.php
│   │               └── footer.php
│   └── helpers/                 # Utility functions
├── assets/                      # Static assets
│   ├── css/                    # Existing CSS
│   ├── js/                     # Existing JavaScript
│   └── reports/mobile/         # ✅ Mobile-specific assets
│       ├── css/mobile.css      # Mobile CSS framework
│       ├── js/mobile-report.js # Mobile JavaScript engine
│       ├── manifest.json       # PWA manifest
│       └── sw.js              # Service worker
├── database/migrations/         # ✅ Database migrations
│   └── 001_mobile_and_api_features.sql
├── pdf/                        # PDF generation tools
│   └── wkhtmltopdf-master/     # Primary PDF engine
├── temp/                       # Generated reports storage
├── cache/                      # Performance caching
├── docs/                       # ✅ Comprehensive documentation
│   ├── MOBILE_APP_COMPREHENSIVE_GUIDE.md    # 110+ page mobile guide
│   ├── MOBILE_TECHNICAL_SPECIFICATIONS.md  # Technical specs
│   ├── IMPLEMENTATION_PROGRESS.md          # Updated progress
│   └── API_INTEGRATION_GUIDE.md           # Updated API docs
├── api_test_browser.html       # ✅ Browser testing interface
├── test_api_endpoints.php      # ✅ CLI testing script
├── create_test_user.php        # ✅ User creation utility
└── DEVELOPMENT_SETUP_GUIDE.md  # ✅ Setup documentation
```

## 🔧 **Key Technologies**

### **Backend Stack**
- **PHP 7.4+** with **CodeIgniter 3.x** framework
- **MySQL** database for data persistence
- **Composer** for dependency management

### **PDF Generation**
- **Knp Snappy** + **wkhtmltopdf** (primary)
- **DomPDF** (backup with optimizations)
- **mPDF** (alternative engine)

### **External Integrations**
- **SiteX Data API** - Property information
- **OpenAI GPT-4** - AI market analysis
- **Google Maps API** - Location and mapping
- **RETS APIs** - MLS integration

### **Mobile & PWA Stack**
- **Responsive HTML5** - Mobile-optimized templates
- **Chart.js** - Interactive data visualizations
- **Hammer.js** - Touch gesture support
- **Service Workers** - Offline PWA capabilities
- **FlutterFlow** - No-code mobile app development

## 🎯 **Core Components**

### **1. Main Report Engine (`application/libraries/Reports.php`)**
```php
class Reports {
    // Primary entry point for report generation
    public function getPropertyData($callFromApi = 0, $reportData = [])
    
    // PDF generation coordination
    public function preparePdf($reportLang, $data, $presentationType, $siteAddress)
    
    // AI analysis integration
    public function ai_request($prompt, $data = [])
    
    // External API communication
    public function make_request($http_method, $endpoint, $body_params = '')
}
```

### **2. API Controller (`application/controllers/api/report.php`)**
```php
class Report extends CI_Controller {
    // Main API endpoint for external integrations
    public function generateReport()
    
    // Token-based authentication
    private function validateToken($token)
    
    // Parameter validation and sanitization
    private function validateParams($params)
}
```

### **3. PDF Libraries**
```php
// Primary: Knp Snappy + wkhtmltopdf
use Knp\Snappy\Pdf;
$snappy = new Pdf($wkhtmltopdfPath);

// Backup: DomPDF with optimizations
$dompdf = new DOMPDF();

// Alternative: mPDF
$mpdf = new mPDF();
```

## 🚀 **Quick Setup**

### **1. Environment Setup**
```bash
# Clone repository
git clone https://github.com/your-org/modern-agent.git
cd modern-agent

# Install dependencies
composer install

# Set up environment variables
cp .env.example .env
# Edit .env with your API keys and database credentials
```

### **2. Required Environment Variables**
```env
# Database
DB_HOST=localhost
DB_NAME=modern_agent
DB_USER=your_db_user
DB_PASS=your_db_password

# External APIs
CHAT_GPT_API_KEY=your_openai_api_key
CHAT_GPT_URL=https://api.openai.com/v1/chat/completions
RETS_API_USERNAME=your_rets_username
RETS_API_PASSWORD=your_rets_password
RETS_API_ENDPOINT=https://rets.api.endpoint.com

# PDF Generation
WKHTMLTOPDF_PATH=/usr/local/bin/wkhtmltopdf
QPDF_PATH=/usr/local/bin/qpdf
```

### **3. Database Setup**
```bash
# Run migrations
vendor/bin/phinx migrate

# Seed initial data (optional)
vendor/bin/phinx seed:run
```

## 📡 **API Usage**

### **Generate Report Endpoint**
```http
POST /api/report/generateReport
Content-Type: application/json

{
    "token": "your_api_token",
    "report187": "https://api.sitexdata.com/187/{GUID}.asmx/GetXML?...",
    "report111": "https://api.map-data.com/111/{GUID}.asmx/GetXML?...",
    "user": {
        "fullname": "Agent Name",
        "email": "agent@example.com",
        "phone": "(555) 123-4567",
        "company_logo": "https://example.com/logo.png"
    },
    "presentation": "seller",
    "theme": "#0f0f0f",
    "selected_pages": "[\"1\",\"2\",\"3\",\"4\",\"5\"]"
}
```

### **Response Format**
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

## 🔄 **Development Workflow**

### **1. Understanding Data Flow**
```php
// 1. Fetch external data
$property_data = simplexml_load_file($sitex_api_url);
$map_data = simplexml_load_file($map_api_url);

// 2. Process and analyze
$statistics = calculateMarketStatistics($property_data);
$ai_insights = ai_request($market_analysis_prompt);

// 3. Generate HTML template
$html = $CI->load->view('reports/seller/template', $data, true);

// 4. Convert to PDF
$pdf = $snappy->getOutputFromHtml($html, $options);

// 5. Store and respond
file_put_contents($filename, $pdf);
return ['status' => true, 'reportLink' => $download_url];
```

### **2. Adding New Features**

#### **Add New Report Type**
```php
// 1. Create template in application/views/reports/english/{type}/
// 2. Add logic in Reports.php getPropertyData()
if ($presentation_type == 'your_new_type') {
    // Custom processing logic
    $data['special_field'] = processSpecialData($property_data);
}

// 3. Update template selection in preparePdf()
$valid_types = ['seller', 'buyer', 'registry', 'your_new_type'];
```

#### **Add New External API**
```php
// 1. Add to Reports.php
public function fetchNewAPIData($property_id) {
    $api_url = "https://new-api.com/data/{$property_id}";
    $response = file_get_contents($api_url);
    return json_decode($response, true);
}

// 2. Integrate in getPropertyData()
$new_data = $this->fetchNewAPIData($property_id);
$data['new_feature'] = $new_data;
```

#### **Customize PDF Templates**
```php
// 1. Copy existing template
cp application/views/reports/english/seller/4/ application/views/reports/english/seller/custom/

// 2. Modify HTML/CSS in custom template files
// 3. Update theme selection logic
if ($theme_id == 'custom') {
    $template_path = 'reports/english/seller/custom/';
}
```

## 🔍 **Debugging & Troubleshooting**

### **Common Issues**

#### **PDF Generation Fails**
```php
// Check wkhtmltopdf path
$path = shell_exec('which wkhtmltopdf');
echo "wkhtmltopdf path: " . $path;

// Validate HTML before conversion
file_put_contents('debug.html', $html);
// Open debug.html in browser to check rendering

// Check memory and timeout
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 300);
```

#### **External API Timeouts**
```php
// Add error handling
try {
    $data = simplexml_load_file($api_url);
} catch (Exception $e) {
    error_log("API fetch failed: " . $e->getMessage());
    // Implement fallback or cached data
}

// Set curl timeouts
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
```

#### **AI Analysis Issues**
```php
// Validate API key and endpoint
$headers = [
    'Authorization: Bearer ' . $_ENV['CHAT_GPT_API_KEY'],
    'Content-Type: application/json'
];

// Handle API rate limits
if (strpos($response, 'rate_limit_exceeded') !== false) {
    sleep(60); // Wait and retry
    return $this->ai_request($prompt, $data);
}
```

### **Development Tools**

#### **Enable Debug Mode**
```php
// In index.php
define('ENVIRONMENT', 'development');

// In Reports.php
if (ENVIRONMENT == 'development') {
    error_log("Processing data: " . print_r($data, true));
    file_put_contents('debug_output.html', $html);
}
```

#### **Performance Monitoring**
```php
// Track execution time
$start_time = microtime(true);
// ... processing ...
$execution_time = microtime(true) - $start_time;
error_log("Report generation took: {$execution_time} seconds");

// Monitor memory usage
$memory_peak = memory_get_peak_usage(true);
error_log("Peak memory usage: " . round($memory_peak/1024/1024, 2) . "MB");
```

## 🧪 **Testing**

### **Unit Testing**
```php
// Test data processing
$test_data = loadSampleXML();
$result = Reports::processPropertyData($test_data);
assert($result['comparable_count'] > 0);

// Test PDF generation
$html = '<html><body>Test PDF</body></html>';
$pdf = $snappy->getOutputFromHtml($html);
assert(strlen($pdf) > 1000); // Basic size check
```

### **Integration Testing**
```bash
# Test API endpoint
curl -X POST https://your-domain.com/api/report/generateReport \
  -H "Content-Type: application/json" \
  -d @test_request.json

# Validate response
jq '.status' response.json  # Should return true
```

## 📊 **Performance Guidelines**

### **Optimization Best Practices**
- **Memory Management**: Set `memory_limit` to 512MB for complex reports
- **Execution Time**: Allow 300 seconds for complete processing
- **Caching**: Cache external API responses for 1 hour
- **Template Optimization**: Remove unnecessary HTML elements
- **Error Handling**: Implement graceful degradation for failed APIs

### **Monitoring Metrics**
- **Generation Time**: Target < 30 seconds total
- **Memory Usage**: Stay under 400MB peak
- **API Response Time**: External APIs < 10 seconds
- **PDF Size**: Typical range 2-15MB
- **Success Rate**: Target > 95% successful generations

## 🔐 **Security Considerations**

### **Input Validation**
```php
// Validate all external inputs
$clean_address = $CI->db->escape_str($property_address);
$valid_theme = preg_match('/^#[0-9a-fA-F]{6}$/', $theme);

// Sanitize file paths
$safe_filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
```

### **API Security**
```php
// Token-based authentication
function validateToken($token) {
    return hash_equals($expected_token, $token);
}

// Rate limiting
if (getUserRequestCount($user_id) > 100) {
    http_response_code(429);
    exit('Rate limit exceeded');
}
```

## 📱 **Mobile Development Quick Start**

### **Current Status: 95% Complete - Ready for Production**
✅ **All Components Built**: Database, APIs, mobile templates, PWA features  
✅ **Complete Documentation**: 10+ comprehensive guides (500+ pages)  
✅ **Testing Tools**: Browser and CLI testing interfaces ready  
✅ **FlutterFlow Ready**: All specifications and guides prepared  

### **Immediate Next Steps (Day 1)**

#### **1. Database Setup**
```bash
# Execute the migration script
mysql -u [username] -p [database_name] < database/migrations/001_mobile_and_api_features.sql

# Verify new columns exist
mysql -u [username] -p [database_name] -e "DESCRIBE lp_user_mst;" | grep api_token
```

#### **2. Test Complete System**
```bash
# Method 1: Browser Testing Interface (Recommended)
http://localhost/modern-1/api_test_browser.html

# Method 2: Command Line Testing (if PHP available)
php test_api_endpoints.php
```

#### **3. Verify Mobile Features**
- ✅ Create test user via browser interface
- ✅ Test authentication API (login, token refresh, logout)  
- ✅ Test reports management API (list, details, sharing)
- ✅ Generate mobile HTML report with PWA features
- ✅ Test responsive design and touch interactions

### **Mobile Development Workflow (Day 2-7)**

#### **FlutterFlow Integration**
1. **Read Complete Guide**: [`docs/MOBILE_APP_COMPREHENSIVE_GUIDE.md`](./MOBILE_APP_COMPREHENSIVE_GUIDE.md) (110+ pages)
2. **Technical Specifications**: [`docs/MOBILE_TECHNICAL_SPECIFICATIONS.md`](./MOBILE_TECHNICAL_SPECIFICATIONS.md)
3. **API Integration**: [`docs/API_INTEGRATION_GUIDE.md`](./API_INTEGRATION_GUIDE.md) (updated with mobile endpoints)
4. **Implementation Progress**: [`docs/IMPLEMENTATION_PROGRESS.md`](./IMPLEMENTATION_PROGRESS.md)

#### **Key Mobile Files Created**
```
✅ Database Migration: database/migrations/001_mobile_and_api_features.sql
✅ API Controllers:
   - application/controllers/api/Auth.php (authentication)
   - application/controllers/api/Reports.php (enhanced)
   - application/controllers/api/Html_reports.php (mobile HTML)
✅ Mobile Templates:
   - application/views/reports/mobile/report_template.php
   - application/views/reports/mobile/components/* (all components)
✅ Mobile Assets:
   - assets/reports/mobile/css/mobile.css (responsive framework)
   - assets/reports/mobile/js/mobile-report.js (touch & PWA)
   - assets/reports/mobile/manifest.json (PWA manifest)
   - assets/reports/mobile/sw.js (service worker)
✅ Testing Tools:
   - api_test_browser.html (comprehensive testing interface)
   - test_api_endpoints.php (CLI testing)
   - create_test_user.php (user creation)
✅ Documentation:
   - DEVELOPMENT_SETUP_GUIDE.md (environment setup)
   - All mobile guides and specifications
```

### **Mobile API Endpoints Ready**

#### **Authentication APIs**
```bash
POST /api/auth/login          # Get API token
POST /api/auth/refreshToken   # Refresh token  
GET  /api/auth/validate       # Validate token
POST /api/auth/logout         # Invalidate token
```

#### **Reports Management APIs**  
```bash
GET  /api/reports/getUserReports           # List user reports
GET  /api/reports/getReportDetails/{id}    # Report details
POST /api/reports/generateShareToken/{id}  # Create share token
```

#### **Mobile HTML Reports APIs**
```bash
GET /api/htmlReports/getHtmlReport/{id}     # Mobile HTML report
GET /api/htmlReports/shareHtmlReport/{token} # Public access (no auth)
```

### **FlutterFlow Development Guide**
1. **Create New Project**: Use FlutterFlow's visual builder
2. **Import API Endpoints**: Copy from updated API documentation
3. **Build Screens**: Login, Dashboard, Report Viewer (WebView)
4. **Test Integration**: Connect to your APIs and test functionality
5. **Deploy**: Export to Flutter or publish directly

**🎯 Everything is ready for FlutterFlow integration - no additional backend work needed!**

## 📚 **Resources**

### **📱 NEW Mobile Documentation**
- [**Mobile App Comprehensive Guide**](./MOBILE_APP_COMPREHENSIVE_GUIDE.md) - 110+ page complete guide
- [**Mobile Technical Specifications**](./MOBILE_TECHNICAL_SPECIFICATIONS.md) - Detailed technical specs
- [**Updated Implementation Progress**](./IMPLEMENTATION_PROGRESS.md) - Current 95% completion status
- [**Updated API Integration Guide**](./API_INTEGRATION_GUIDE.md) - Mobile endpoints included
- [**Development Setup Guide**](../DEVELOPMENT_SETUP_GUIDE.md) - Environment setup

### **Original Documentation**
- [Complete Codebase Analysis](./CODEBASE_ANALYSIS.md)
- [Data Flow Analysis](./DATA_FLOW_ANALYSIS.md)
- [HTML-to-PDF Process](./HTML_TO_PDF_PROCESS.md)
- [Cleanup Guide](./CLEANUP_UNUSED_DEPRECATED.md)

### **External Documentation**
- [CodeIgniter 3.x Documentation](https://codeigniter.com/userguide3/)
- [Knp Snappy GitHub](https://github.com/KnpLabs/snappy)
- [wkhtmltopdf Documentation](https://wkhtmltopdf.org/docs.html)
- [OpenAI API Documentation](https://platform.openai.com/docs)

### **Support**
- **Repository Issues**: Create detailed bug reports with logs
- **Feature Requests**: Provide use cases and implementation ideas
- **Security Issues**: Report privately to security@your-domain.com

This quick start guide provides everything needed to understand, develop, and extend the Modern Agent system efficiently. 