# Modern Agent - External API Integration Guide

## 📋 **Overview**

This comprehensive guide provides everything external platforms need to integrate with the Modern Agent API for automated report generation. The API allows third-party systems to generate professional real estate reports programmatically with full customization options.

## 🎯 **API Capabilities**

### **Core Features**
- **Report Generation**: Create PDF and HTML reports automatically
- **Multiple Report Types**: Seller, buyer, and registry reports
- **Custom Branding**: Agent logos, themes, and styling
- **Real-time Data**: Integration with live property and market data
- **AI Analysis**: Automated market insights powered by GPT-4
- **Secure Authentication**: Token-based API security

### **Use Cases**
- **MLS Systems**: Automated report generation for listings
- **CRM Platforms**: Integrated reporting for real estate agents
- **Property Websites**: On-demand report creation
- **Mobile Apps**: Real estate app report features
- **Lead Generation**: Automated report delivery for prospects

## 🔐 **Authentication System**

### **API Token Authentication**
All API requests require authentication using Bearer tokens in the Authorization header.

#### **Token Request**
```http
POST /api/auth/login
Content-Type: application/json

{
    "email": "agent@example.com",
    "password": "secure_password"
}
```

#### **Response**
```json
{
    "success": true,
    "data": {
        "user": {
            "user_id_pk": 123,
            "first_name": "John",
            "last_name": "Doe",
            "email": "agent@example.com",
            "company_name": "Modern Realty",
            "phone": "+1-555-123-4567",
            "title": "Senior Real Estate Agent"
        },
        "token": "abcd1234567890efgh...",
        "expires_at": "2024-02-15 14:30:25"
    },
    "message": "Login successful"
}
```

#### **Using the Token**
Include the token in all subsequent API requests:
```http
Authorization: Bearer abcd1234567890efgh...
```

### **Enhanced Authentication Endpoints**

#### **Token Refresh**
Refresh an existing token without re-authentication:
```http
POST /api/auth/refreshToken
Authorization: Bearer {current_token}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "token": "new_token_here...",
        "expires_at": "2024-03-15 14:30:25"
    },
    "message": "Token refreshed successfully"
}
```

#### **Token Validation**
Validate a token and get current user information:
```http
GET /api/auth/validate
Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "valid": true,
        "user_id": 123,
        "expires_at": "2024-02-15 14:30:25"
    },
    "message": "Token is valid"
}
```

#### **Logout**
Invalidate the current token:
```http
POST /api/auth/logout
Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "message": "Logged out successfully"
}
```

### **Token Management**
- **Expiry**: Tokens expire after 30 days
- **Refresh**: Use `/api/auth/refreshToken` to get new tokens
- **Storage**: Store tokens securely in your application
- **Scope**: Tokens are user-specific and inherit user permissions
- **Security**: Tokens are cryptographically secure (64-character hex)
- **Automatic Cleanup**: Expired tokens are automatically removed

## 📡 **Report Generation API**

### **Primary Endpoint**
```http
POST /api/report/generateReport
Authorization: Bearer {token}
Content-Type: application/json
```

### **Request Parameters**

#### **Required Parameters**
```json
{
    "token": "string - API authentication token",
    "report187": "string - SiteX Data API URL for property data",
    "report111": "string - Geographic API URL for location data",
    "user": {
        "fullname": "string - Agent full name",
        "email": "string - Agent email address",
        "phone": "string - Agent phone number",
        "company_logo": "string - URL to company logo image"
    },
    "presentation": "string - Report type: seller|buyer|registry"
}
```

#### **Optional Parameters**
```json
{
    "theme": "string - Hex color code (default: #007bff)",
    "selected_pages": "string - JSON array of page numbers to include",
    "report_lang": "string - Language code (default: english)",
    "custom_comps": "string - JSON array of custom comparable properties",
    "showpartner": "string - Include partner agent: on|off",
    "partner": "object - Partner agent information"
}
```

### **Complete Request Example**
```json
{
    "token": "abcd1234567890efgh...",
    "report187": "https://api.sitexdata.com/187/12345-67890.asmx/GetXML?PropertyID=12345&UserID=67890&Password=xyz",
    "report111": "https://api.mapdata.com/111/location.asmx/GetXML?Address=123+Main+St&City=Anytown&State=CA",
    "user": {
        "fullname": "John Doe",
        "email": "john@modernrealty.com",
        "phone": "(555) 123-4567",
        "company_logo": "https://modernrealty.com/logo.png",
        "title": "Senior Real Estate Agent",
        "companyname": "Modern Realty Group"
    },
    "presentation": "seller",
    "theme": "#2E8B57",
    "selected_pages": "[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\"]",
    "report_lang": "english",
    "showpartner": "off"
}
```

### **Response Format**

#### **Successful Response**
```json
{
    "status": true,
    "reportLink": "https://yourdomain.com/temp/123_Main_St_abc123.pdf",
    "project_id": 12345,
    "property_address": "123 Main St, Anytown, CA 12345",
    "report_type": "seller",
    "generated_at": "2024-01-15 14:30:25",
    "file_size": "2.5 MB",
    "page_count": 8
}
```

#### **Error Response**
```json
{
    "status": false,
    "error": "Invalid property data URL",
    "code": 400,
    "details": "The report187 URL returned invalid XML data"
}
```

## 🔍 **Report Management APIs**

### **Get User Reports**
Retrieve a list of previously generated reports.

```http
GET /api/reports/getUserReports?page=1&limit=20
Authorization: Bearer {token}
```

#### **Response**
```json
{
    "status": true,
    "reports": [
        {
            "project_id_pk": 12345,
            "project_name": "Property Report",
            "property_address": "123 Main St, Anytown, CA",
            "report_type": "seller",
            "project_date": "2024-01-15 14:30:25",
            "report_path": "temp/report_12345.pdf",
            "property_owner": "Jane Smith"
        }
    ],
    "pagination": {
        "current_page": 1,
        "total_pages": 5,
        "total_reports": 87,
        "per_page": 20
    }
}
```

### **Get Report Details**
Retrieve detailed information about a specific report.

```http
GET /api/reports/getReportDetails/{reportId}
Authorization: Bearer {token}
```

### **Share Report**
Generate a shareable public link for a report.

```http
POST /api/reports/shareReport/{reportId}
Authorization: Bearer {token}
```

#### **Response**
```json
{
    "status": true,
    "share_link": "https://yourdomain.com/shared/report/xyz789...",
    "expires_at": "2024-02-15 14:30:25"
}
```

## 📱 **Mobile HTML Reports API**

### **Get Mobile HTML Report**
Generate and retrieve a mobile-optimized HTML version of a report for display in mobile apps or browsers.

```http
GET /api/htmlReports/getHtmlReport/{reportId}
Authorization: Bearer {token}
```

#### **Parameters**
- `reportId` (required): The unique identifier of the report

#### **Response**
```json
{
    "success": true,
    "data": {
        "html_url": "https://yourdomain.com/api/htmlReports/getHtmlReport/12345",
        "report_id": 12345,
        "mobile_optimized": true,
        "interactive_charts": true,
        "theme_color": "#007bff",
        "generated_at": "2024-01-15 14:30:25"
    },
    "message": "Mobile HTML report generated successfully"
}
```

#### **Features**
- **Responsive Design**: Optimized for all screen sizes
- **Touch Interactions**: Swipe navigation and pinch-to-zoom
- **Interactive Charts**: Chart.js powered visualizations
- **PWA Support**: Can be installed as app on mobile devices
- **Offline Capability**: Service worker for offline viewing
- **Custom Theming**: Brand colors throughout the interface

#### **Usage in Mobile Apps**
```javascript
// Flutter WebView integration
WebView(
  initialUrl: 'https://yourdomain.com/api/htmlReports/getHtmlReport/12345',
  javascriptMode: JavascriptMode.unrestricted,
  navigationDelegate: (NavigationRequest request) {
    // Handle navigation
    return NavigationDecision.navigate;
  },
)
```

### **Share HTML Report (Public Access)**
Access a shared HTML report using a public share token (no authentication required).

```http
GET /api/htmlReports/shareHtmlReport/{shareToken}
```

#### **Parameters**
- `shareToken` (required): The public share token generated from `/api/reports/shareReport`

#### **Response**
Returns the complete HTML report page with:
- Full mobile-responsive interface
- Interactive charts and navigation
- Branded styling and theming
- PWA capabilities for installation

#### **Example Usage**
```html
<!-- Embed in iframe for web integration -->
<iframe 
    src="https://yourdomain.com/api/htmlReports/shareHtmlReport/xyz789abc123..."
    width="100%" 
    height="600px"
    frameborder="0">
</iframe>
```

### **Mobile HTML Report Features**

#### **Progressive Web App (PWA)**
- **Install Prompts**: "Add to Home Screen" functionality
- **Offline Support**: Cached assets for offline viewing
- **Full-Screen Mode**: Native app-like experience
- **Icon Support**: Custom app icons for various devices

#### **Touch Interactions**
- **Swipe Navigation**: Left/right swipes between sections
- **Pinch-to-Zoom**: Chart and image zooming
- **Touch-Friendly**: 44px minimum touch targets
- **Gesture Feedback**: Visual feedback for all interactions

#### **Interactive Components**
- **Chart Interactions**: Tap to highlight comparable properties
- **Section Navigation**: Smooth transitions between report sections
- **Image Galleries**: Touch-enabled property photo viewing
- **Map Integration**: Interactive property location maps

#### **Responsive Design**
- **Mobile-First**: Optimized for smartphones and tablets
- **Flexible Layouts**: Adapts to any screen size
- **Retina Support**: High-DPI display optimization
- **Dark Mode**: Automatic system theme detection

## 🌐 **Data Source Integration**

### **Property Data Sources**
The API requires property data from external sources. Common integrations include:

#### **SiteX Data API**
```
URL Format: https://api.sitexdata.com/187/{GUID}.asmx/GetXML
Parameters: PropertyID, UserID, Password
Data: Property details, comparable sales, market analysis
```

#### **RETS (Real Estate Transaction Standard)**
```
URL Format: Your RETS login URL with query parameters
Data: MLS property information, photos, details
Authentication: RETS username/password
```

#### **Custom Data Sources**
```xml
<!-- Expected XML format for custom property data -->
<PropertyReport>
    <PropertyProfile>
        <SiteAddress>123 Main Street</SiteAddress>
        <SiteCity>Anytown</SiteCity>
        <SiteState>CA</SiteState>
        <SiteZip>12345</SiteZip>
        <Bedrooms>3</Bedrooms>
        <Bathrooms>2</Bathrooms>
        <BuildingArea>1500</BuildingArea>
        <LotSize>0.25</LotSize>
        <YearBuilt>1995</YearBuilt>
        <LastSalePrice>450000</LastSalePrice>
    </PropertyProfile>
    <ComparableSalesReport>
        <ComparableProperties>
            <ComparableProperty>
                <SiteAddress>456 Oak Avenue</SiteAddress>
                <SalesPrice>425000</SalesPrice>
                <SalesDate>2023-12-15</SalesDate>
                <BuildingArea>1450</BuildingArea>
                <Distance>0.3</Distance>
            </ComparableProperty>
        </ComparableProperties>
    </ComparableSalesReport>
</PropertyReport>
```

## 💻 **Implementation Examples**

### **PHP Implementation**
```php
<?php
class ModernAgentAPI {
    private $baseUrl;
    private $token;
    
    public function __construct($baseUrl, $email, $password) {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->authenticate($email, $password);
    }
    
    private function authenticate($email, $password) {
        $data = [
            'email' => $email,
            'password' => $password
        ];
        
        $response = $this->makeRequest('POST', '/api/auth/login', $data);
        
        if ($response['status']) {
            $this->token = $response['token'];
        } else {
            throw new Exception('Authentication failed: ' . $response['error']);
        }
    }
    
    public function generateReport($propertyDataUrl, $mapDataUrl, $agentInfo, $options = []) {
        $data = [
            'token' => $this->token,
            'report187' => $propertyDataUrl,
            'report111' => $mapDataUrl,
            'user' => $agentInfo,
            'presentation' => $options['presentation'] ?? 'seller',
            'theme' => $options['theme'] ?? '#007bff',
            'selected_pages' => $options['selected_pages'] ?? '["1","2","3","4","5","6","7","8"]'
        ];
        
        return $this->makeRequest('POST', '/api/report/generateReport', $data);
    }
    
    public function getUserReports($page = 1, $limit = 20) {
        $url = "/api/reports/getUserReports?page={$page}&limit={$limit}";
        return $this->makeRequest('GET', $url);
    }
    
    public function shareReport($reportId) {
        return $this->makeRequest('POST', "/api/reports/shareReport/{$reportId}");
    }
    
    private function makeRequest($method, $endpoint, $data = null) {
        $url = $this->baseUrl . $endpoint;
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->token
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data ? json_encode($data) : null,
            CURLOPT_TIMEOUT => 60
        ]);
        
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        
        $decodedResponse = json_decode($response, true);
        
        if ($httpCode >= 400) {
            throw new Exception("API Error {$httpCode}: " . ($decodedResponse['error'] ?? 'Unknown error'));
        }
        
        return $decodedResponse;
    }
}

// Usage Example
try {
    $api = new ModernAgentAPI('https://yourdomain.com', 'agent@example.com', 'password');
    
    $agentInfo = [
        'fullname' => 'John Doe',
        'email' => 'john@realty.com',
        'phone' => '(555) 123-4567',
        'company_logo' => 'https://realty.com/logo.png'
    ];
    
    $options = [
        'presentation' => 'seller',
        'theme' => '#2E8B57'
    ];
    
    $result = $api->generateReport(
        'https://api.sitexdata.com/187/property-123.xml',
        'https://api.mapdata.com/111/location-123.xml',
        $agentInfo,
        $options
    );
    
    if ($result['status']) {
        echo "Report generated: " . $result['reportLink'];
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
```

### **JavaScript/Node.js Implementation**
```javascript
class ModernAgentAPI {
    constructor(baseUrl) {
        this.baseUrl = baseUrl.replace(/\/$/, '');
        this.token = null;
    }
    
    async authenticate(email, password) {
        const response = await this.makeRequest('POST', '/api/auth/login', {
            email,
            password
        });
        
        if (response.status) {
            this.token = response.token;
            return response;
        } else {
            throw new Error(`Authentication failed: ${response.error}`);
        }
    }
    
    async generateReport(propertyDataUrl, mapDataUrl, agentInfo, options = {}) {
        const data = {
            token: this.token,
            report187: propertyDataUrl,
            report111: mapDataUrl,
            user: agentInfo,
            presentation: options.presentation || 'seller',
            theme: options.theme || '#007bff',
            selected_pages: options.selected_pages || '["1","2","3","4","5","6","7","8"]'
        };
        
        return await this.makeRequest('POST', '/api/report/generateReport', data);
    }
    
    async getUserReports(page = 1, limit = 20) {
        const url = `/api/reports/getUserReports?page=${page}&limit=${limit}`;
        return await this.makeRequest('GET', url);
    }
    
    async shareReport(reportId) {
        return await this.makeRequest('POST', `/api/reports/shareReport/${reportId}`);
    }
    
    async makeRequest(method, endpoint, data = null) {
        const url = this.baseUrl + endpoint;
        const headers = {
            'Content-Type': 'application/json'
        };
        
        if (this.token) {
            headers['Authorization'] = `Bearer ${this.token}`;
        }
        
        const config = {
            method,
            headers
        };
        
        if (data && (method === 'POST' || method === 'PUT')) {
            config.body = JSON.stringify(data);
        }
        
        try {
            const response = await fetch(url, config);
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(`API Error ${response.status}: ${result.error || 'Unknown error'}`);
            }
            
            return result;
        } catch (error) {
            throw new Error(`Network error: ${error.message}`);
        }
    }
}

// Usage Example
async function example() {
    try {
        const api = new ModernAgentAPI('https://yourdomain.com');
        
        await api.authenticate('agent@example.com', 'password');
        
        const agentInfo = {
            fullname: 'John Doe',
            email: 'john@realty.com',
            phone: '(555) 123-4567',
            company_logo: 'https://realty.com/logo.png'
        };
        
        const options = {
            presentation: 'seller',
            theme: '#2E8B57'
        };
        
        const result = await api.generateReport(
            'https://api.sitexdata.com/187/property-123.xml',
            'https://api.mapdata.com/111/location-123.xml',
            agentInfo,
            options
        );
        
        if (result.status) {
            console.log('Report generated:', result.reportLink);
        }
        
    } catch (error) {
        console.error('Error:', error.message);
    }
}

// Export for module systems
module.exports = ModernAgentAPI;
```

### **Python Implementation**
```python
import requests
import json
from typing import Dict, Optional, Any

class ModernAgentAPI:
    def __init__(self, base_url: str):
        self.base_url = base_url.rstrip('/')
        self.token = None
        self.session = requests.Session()
    
    def authenticate(self, email: str, password: str) -> Dict[str, Any]:
        """Authenticate with the API and store the token."""
        data = {
            'email': email,
            'password': password
        }
        
        response = self._make_request('POST', '/api/auth/login', data)
        
        if response['status']:
            self.token = response['token']
            self.session.headers.update({
                'Authorization': f'Bearer {self.token}'
            })
            return response
        else:
            raise Exception(f"Authentication failed: {response['error']}")
    
    def generate_report(self, property_data_url: str, map_data_url: str, 
                       agent_info: Dict[str, str], options: Optional[Dict[str, str]] = None) -> Dict[str, Any]:
        """Generate a new report."""
        if not self.token:
            raise Exception("Not authenticated. Call authenticate() first.")
        
        if options is None:
            options = {}
        
        data = {
            'token': self.token,
            'report187': property_data_url,
            'report111': map_data_url,
            'user': agent_info,
            'presentation': options.get('presentation', 'seller'),
            'theme': options.get('theme', '#007bff'),
            'selected_pages': options.get('selected_pages', '["1","2","3","4","5","6","7","8"]')
        }
        
        return self._make_request('POST', '/api/report/generateReport', data)
    
    def get_user_reports(self, page: int = 1, limit: int = 20) -> Dict[str, Any]:
        """Get a list of user's reports."""
        url = f"/api/reports/getUserReports?page={page}&limit={limit}"
        return self._make_request('GET', url)
    
    def share_report(self, report_id: int) -> Dict[str, Any]:
        """Generate a shareable link for a report."""
        return self._make_request('POST', f'/api/reports/shareReport/{report_id}')
    
    def _make_request(self, method: str, endpoint: str, data: Optional[Dict] = None) -> Dict[str, Any]:
        """Make an HTTP request to the API."""
        url = self.base_url + endpoint
        headers = {'Content-Type': 'application/json'}
        
        if self.token and endpoint != '/api/auth/login':
            headers['Authorization'] = f'Bearer {self.token}'
        
        try:
            if method == 'GET':
                response = requests.get(url, headers=headers, timeout=60)
            elif method == 'POST':
                response = requests.post(url, headers=headers, json=data, timeout=60)
            else:
                raise ValueError(f"Unsupported HTTP method: {method}")
            
            response.raise_for_status()
            return response.json()
            
        except requests.exceptions.RequestException as e:
            raise Exception(f"API request failed: {str(e)}")
        except json.JSONDecodeError:
            raise Exception("Invalid JSON response from API")

# Usage Example
if __name__ == "__main__":
    try:
        api = ModernAgentAPI('https://yourdomain.com')
        
        # Authenticate
        auth_result = api.authenticate('agent@example.com', 'password')
        print(f"Authenticated as: {auth_result['user']['email']}")
        
        # Agent information
        agent_info = {
            'fullname': 'John Doe',
            'email': 'john@realty.com',
            'phone': '(555) 123-4567',
            'company_logo': 'https://realty.com/logo.png'
        }
        
        # Report options
        options = {
            'presentation': 'seller',
            'theme': '#2E8B57'
        }
        
        # Generate report
        result = api.generate_report(
            'https://api.sitexdata.com/187/property-123.xml',
            'https://api.mapdata.com/111/location-123.xml',
            agent_info,
            options
        )
        
        if result['status']:
            print(f"Report generated: {result['reportLink']}")
            print(f"Project ID: {result['project_id']}")
        
        # Get user reports
        reports = api.get_user_reports(page=1, limit=10)
        print(f"Found {reports['pagination']['total_reports']} total reports")
        
    except Exception as e:
        print(f"Error: {e}")
```

### **C# Implementation**
```csharp
using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using Newtonsoft.Json;

public class ModernAgentAPI
{
    private readonly HttpClient _httpClient;
    private readonly string _baseUrl;
    private string _token;

    public ModernAgentAPI(string baseUrl)
    {
        _baseUrl = baseUrl.TrimEnd('/');
        _httpClient = new HttpClient();
        _httpClient.DefaultRequestHeaders.Add("User-Agent", "ModernAgent-API-Client/1.0");
    }

    public async Task<AuthResponse> AuthenticateAsync(string email, string password)
    {
        var data = new
        {
            email = email,
            password = password
        };

        var response = await MakeRequestAsync<AuthResponse>("POST", "/api/auth/login", data);
        
        if (response.Status)
        {
            _token = response.Token;
            _httpClient.DefaultRequestHeaders.Authorization = 
                new System.Net.Http.Headers.AuthenticationHeaderValue("Bearer", _token);
        }
        else
        {
            throw new Exception($"Authentication failed: {response.Error}");
        }

        return response;
    }

    public async Task<ReportResponse> GenerateReportAsync(string propertyDataUrl, string mapDataUrl, 
        AgentInfo agentInfo, ReportOptions options = null)
    {
        if (string.IsNullOrEmpty(_token))
            throw new Exception("Not authenticated. Call AuthenticateAsync first.");

        options = options ?? new ReportOptions();

        var data = new
        {
            token = _token,
            report187 = propertyDataUrl,
            report111 = mapDataUrl,
            user = agentInfo,
            presentation = options.Presentation ?? "seller",
            theme = options.Theme ?? "#007bff",
            selected_pages = options.SelectedPages ?? "[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\"]"
        };

        return await MakeRequestAsync<ReportResponse>("POST", "/api/report/generateReport", data);
    }

    public async Task<ReportsListResponse> GetUserReportsAsync(int page = 1, int limit = 20)
    {
        var url = $"/api/reports/getUserReports?page={page}&limit={limit}";
        return await MakeRequestAsync<ReportsListResponse>("GET", url);
    }

    public async Task<ShareResponse> ShareReportAsync(int reportId)
    {
        return await MakeRequestAsync<ShareResponse>("POST", $"/api/reports/shareReport/{reportId}");
    }

    private async Task<T> MakeRequestAsync<T>(string method, string endpoint, object data = null)
    {
        var url = _baseUrl + endpoint;
        HttpResponseMessage response;

        if (method == "GET")
        {
            response = await _httpClient.GetAsync(url);
        }
        else if (method == "POST")
        {
            var json = JsonConvert.SerializeObject(data);
            var content = new StringContent(json, Encoding.UTF8, "application/json");
            response = await _httpClient.PostAsync(url, content);
        }
        else
        {
            throw new ArgumentException($"Unsupported HTTP method: {method}");
        }

        var responseContent = await response.Content.ReadAsStringAsync();

        if (!response.IsSuccessStatusCode)
        {
            var errorResponse = JsonConvert.DeserializeObject<ErrorResponse>(responseContent);
            throw new Exception($"API Error {(int)response.StatusCode}: {errorResponse?.Error ?? "Unknown error"}");
        }

        return JsonConvert.DeserializeObject<T>(responseContent);
    }

    public void Dispose()
    {
        _httpClient?.Dispose();
    }
}

// Data classes
public class AuthResponse
{
    public bool Status { get; set; }
    public UserInfo User { get; set; }
    public string Token { get; set; }
    public string ExpiresAt { get; set; }
    public string Error { get; set; }
}

public class ReportResponse
{
    public bool Status { get; set; }
    public string ReportLink { get; set; }
    public int ProjectId { get; set; }
    public string PropertyAddress { get; set; }
    public string ReportType { get; set; }
    public string GeneratedAt { get; set; }
    public string Error { get; set; }
}

public class AgentInfo
{
    public string Fullname { get; set; }
    public string Email { get; set; }
    public string Phone { get; set; }
    public string CompanyLogo { get; set; }
    public string Title { get; set; }
    public string CompanyName { get; set; }
}

public class ReportOptions
{
    public string Presentation { get; set; }
    public string Theme { get; set; }
    public string SelectedPages { get; set; }
}

// Usage Example
class Program
{
    static async Task Main(string[] args)
    {
        try
        {
            var api = new ModernAgentAPI("https://yourdomain.com");

            // Authenticate
            var authResult = await api.AuthenticateAsync("agent@example.com", "password");
            Console.WriteLine($"Authenticated as: {authResult.User.Email}");

            // Agent information
            var agentInfo = new AgentInfo
            {
                Fullname = "John Doe",
                Email = "john@realty.com",
                Phone = "(555) 123-4567",
                CompanyLogo = "https://realty.com/logo.png"
            };

            // Report options
            var options = new ReportOptions
            {
                Presentation = "seller",
                Theme = "#2E8B57"
            };

            // Generate report
            var result = await api.GenerateReportAsync(
                "https://api.sitexdata.com/187/property-123.xml",
                "https://api.mapdata.com/111/location-123.xml",
                agentInfo,
                options
            );

            if (result.Status)
            {
                Console.WriteLine($"Report generated: {result.ReportLink}");
                Console.WriteLine($"Project ID: {result.ProjectId}");
            }
        }
        catch (Exception ex)
        {
            Console.WriteLine($"Error: {ex.Message}");
        }
    }
}
```

## 📊 **Rate Limiting & Performance**

### **Rate Limits**
- **Authentication**: 10 requests per minute per IP
- **Report Generation**: 30 reports per hour per user
- **Report Retrieval**: 100 requests per minute per user
- **Burst Limits**: 5 concurrent report generations

### **Performance Guidelines**
- **Timeout**: Set request timeouts to 60+ seconds for report generation
- **Retry Logic**: Implement exponential backoff for failed requests
- **Caching**: Cache authentication tokens until expiry
- **Monitoring**: Track API usage and response times

### **Response Times**
- **Authentication**: < 2 seconds
- **Report Generation**: 15-45 seconds (depending on complexity)
- **Report Retrieval**: < 5 seconds
- **Share Link Creation**: < 3 seconds

## 🚨 **Error Handling**

### **HTTP Status Codes**
- **200**: Success
- **400**: Bad Request (invalid parameters)
- **401**: Unauthorized (invalid/expired token)
- **404**: Not Found (report/resource doesn't exist)
- **429**: Too Many Requests (rate limit exceeded)
- **500**: Internal Server Error
- **503**: Service Unavailable (maintenance mode)

### **Error Response Format**
```json
{
    "status": false,
    "error": "Human-readable error message",
    "code": 400,
    "details": "Detailed error information",
    "timestamp": "2024-01-15T14:30:25Z",
    "request_id": "req_abc123"
}
```

### **Common Errors**

#### **Authentication Errors**
```json
{
    "status": false,
    "error": "Invalid credentials",
    "code": 401,
    "details": "The provided email and password combination is incorrect"
}
```

#### **Validation Errors**
```json
{
    "status": false,
    "error": "Missing required parameters",
    "code": 400,
    "details": {
        "report187": "Property data URL is required",
        "user.email": "Agent email is required"
    }
}
```

#### **Rate Limit Errors**
```json
{
    "status": false,
    "error": "Rate limit exceeded",
    "code": 429,
    "details": "Maximum 30 reports per hour exceeded. Try again in 25 minutes.",
    "retry_after": 1500
}
```

## 📈 **Best Practices**

### **Integration Guidelines**
1. **Token Management**: Store tokens securely and refresh before expiry
2. **Error Handling**: Implement comprehensive error handling for all scenarios
3. **Retry Logic**: Use exponential backoff for transient failures
4. **Logging**: Log API requests and responses for debugging
5. **Testing**: Test with various data sources and edge cases

### **Security Considerations**
1. **HTTPS Only**: Always use HTTPS for API communications
2. **Token Storage**: Store API tokens securely (not in client-side code)
3. **Input Validation**: Validate all data before sending to API
4. **Environment Variables**: Store credentials in environment variables
5. **IP Whitelisting**: Consider IP restrictions for enhanced security

### **Performance Optimization**
1. **Connection Pooling**: Reuse HTTP connections when possible
2. **Parallel Processing**: Generate multiple reports concurrently (within limits)
3. **Caching**: Cache frequently accessed data
4. **Compression**: Use gzip compression for large requests
5. **Monitoring**: Track API performance and usage patterns

## 🔧 **Webhook Integration**

### **Webhook Support**
Receive real-time notifications when reports are generated or updated.

#### **Webhook Registration**
```http
POST /api/webhooks/register
Authorization: Bearer {token}
Content-Type: application/json

{
    "url": "https://yourapp.com/webhooks/modern-agent",
    "events": ["report.generated", "report.failed", "report.shared"],
    "secret": "your_webhook_secret"
}
```

#### **Webhook Payload**
```json
{
    "event": "report.generated",
    "timestamp": "2024-01-15T14:30:25Z",
    "data": {
        "project_id": 12345,
        "report_link": "https://yourdomain.com/temp/report_12345.pdf",
        "property_address": "123 Main St, Anytown, CA",
        "report_type": "seller",
        "user_id": 67890
    },
    "signature": "sha256=abc123..."
}
```

## 📋 **Testing & Development**

### **Test Environment**
- **Base URL**: `https://test.yourdomain.com`
- **Test Credentials**: Provided upon request
- **Sample Data**: Test property and map data URLs available
- **Rate Limits**: Relaxed limits for testing

### **Postman Collection**
Download our complete Postman collection:
```
https://yourdomain.com/api/docs/modern-agent-api.postman_collection.json
```

### **SDK Libraries**
Official SDKs available for:
- **PHP**: `composer install modern-agent/api-client`
- **JavaScript**: `npm install @modern-agent/api-client`
- **Python**: `pip install modern-agent-api`
- **C#**: `Install-Package ModernAgent.ApiClient`

## 📞 **Support & Resources**

### **Developer Support**
- **Documentation**: https://yourdomain.com/api/docs
- **Support Email**: api-support@yourdomain.com
- **Developer Forum**: https://community.yourdomain.com
- **Status Page**: https://status.yourdomain.com

### **SLA & Uptime**
- **Availability**: 99.9% uptime guarantee
- **Support Response**: 24 hours for technical issues
- **Maintenance Windows**: Announced 48 hours in advance
- **Emergency Support**: Available for critical issues

### **Pricing & Limits**
- **Free Tier**: 50 reports per month
- **Professional**: $0.50 per report above free tier
- **Enterprise**: Custom pricing for high-volume usage
- **Setup Fee**: One-time $100 integration fee

This comprehensive API integration guide provides everything external platforms need to successfully integrate with the Modern Agent system for automated report generation. 