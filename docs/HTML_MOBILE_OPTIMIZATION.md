# Modern Agent - HTML Mobile Optimization Guide

## 📋 **Overview**

This guide provides complete documentation for creating mobile-optimized HTML versions of reports with interactive elements, replacing static PDF views on mobile devices. The HTML reports will feature responsive design, interactive charts, and touch-friendly navigation.

## 🎯 **Mobile Optimization Goals**

### **User Experience Improvements**
- **Responsive Design**: Optimized for iPhone/iPad viewing
- **Interactive Charts**: Touch-enabled bar graphs and data visualization
- **Fast Loading**: Optimized performance for mobile networks
- **Touch Navigation**: Swipe, tap, and pinch-to-zoom functionality
- **Offline Capability**: Downloadable for offline viewing

### **Technical Requirements**
- **Progressive Web App**: PWA capabilities for app-like experience
- **Responsive CSS**: Mobile-first design approach
- **Interactive JavaScript**: Chart.js, D3.js integration
- **Touch Gestures**: Swipe navigation between sections
- **Caching**: Service worker for offline functionality

## 🔧 **Current HTML Infrastructure Analysis**

### **✅ Existing HTML Templates**
Your system already generates HTML before PDF conversion:

```php
// File: application/views/reports/english/buyer/dynamic.php
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <!-- Existing dynamic content generation -->
    <?php 
    // Property data processing
    // School information
    // Comparable sales analysis
    ?>
</body>
</html>
```

**Current Capabilities:**
- ✅ Responsive meta tags already present
- ✅ Bootstrap CSS framework integrated
- ✅ Dynamic theme color injection
- ✅ Property data processing logic
- ✅ School and demographic information
- ✅ Comparable sales analysis

### **Areas for Mobile Enhancement**
- **CSS Optimization**: Better mobile layouts
- **Interactive Elements**: Replace static content with interactive components
- **Touch Navigation**: Implement swipeable sections
- **Performance**: Optimize loading and rendering

## 🆕 **New Mobile HTML API Endpoint**

### **HTML Report Generation Controller**
```php
// File: application/controllers/api/html_reports.php
<?php
class Html_reports extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('reports');
        $this->load->helper(['url', 'dataapi']);
    }
    
    public function getHtmlReport($reportId) {
        // Validate token
        $token = $this->input->get_request_header('Authorization', TRUE);
        $userId = $this->validateToken($token);
        
        if (!$userId) {
            return $this->output->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Invalid token']));
        }
        
        // Get report data from database
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
        
        // Check if HTML version exists and is current
        if (!empty($report['html_version']) && filemtime($report['html_version']) > strtotime($report['project_date'])) {
            $htmlContent = file_get_contents($report['html_version']);
        } else {
            // Generate new HTML version
            $htmlContent = $this->generateMobileHtml($report);
            
            // Save HTML version to file
            $htmlPath = 'temp/html/' . $reportId . '_mobile.html';
            file_put_contents($htmlPath, $htmlContent);
            
            // Update database with HTML path
            $this->db->where('project_id_pk', $reportId);
            $this->db->update('lp_my_listing', ['html_version' => $htmlPath]);
        }
        
        return $this->output
            ->set_content_type('text/html')
            ->set_output($htmlContent);
    }
    
    public function generateMobileHtml($reportData) {
        // Reconstruct report data from stored JSON or regenerate
        $data = json_decode($reportData['pdf_data'], true);
        
        // Load mobile-optimized template
        return $this->load->view('reports/mobile/report_template', $data, true);
    }
    
    public function shareHtmlReport($shareToken) {
        // Public access via share token
        $this->db->select('lp_my_listing.*, lp_user_mst.first_name, lp_user_mst.last_name');
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
        
        // Generate and serve HTML
        $htmlContent = $this->generateMobileHtml($report);
        
        $this->output
            ->set_content_type('text/html')
            ->set_output($htmlContent);
    }
    
    private function validateToken($token) {
        $token = str_replace('Bearer ', '', $token);
        
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

## 📱 **Mobile-Optimized HTML Templates**

### **Main Template Structure**
```php
<!-- File: application/views/reports/mobile/report_template.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, maximum-scale=3.0">
    <meta name="theme-color" content="<?php echo $theme; ?>">
    <title><?php echo $property->PropertyProfile->SiteAddress; ?> - Property Report</title>
    
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo base_url('assets/reports/mobile/css/mobile.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="<?php echo base_url('assets/reports/mobile/manifest.json'); ?>">
    
    <!-- iOS Meta Tags -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Property Report">
    
    <style>
        :root {
            --theme-color: <?php echo $theme; ?>;
            --theme-color-light: <?php echo $theme; ?>20;
            --theme-color-dark: <?php echo $theme; ?>dd;
        }
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="spinner"></div>
        <p>Loading Property Report...</p>
    </div>
    
    <!-- Mobile Report Container -->
    <div id="mobile-report" class="mobile-report" style="display: none;">
        
        <!-- Header Section -->
        <?php $this->load->view('reports/mobile/components/header', $data); ?>
        
        <!-- Navigation Tabs -->
        <?php $this->load->view('reports/mobile/components/navigation', $data); ?>
        
        <!-- Content Sections -->
        <div class="report-content">
            
            <!-- Property Overview -->
            <section id="overview" class="content-section active">
                <?php $this->load->view('reports/mobile/components/property_overview', $data); ?>
            </section>
            
            <!-- Comparable Sales -->
            <section id="comparables" class="content-section">
                <?php $this->load->view('reports/mobile/components/comparable_sales', $data); ?>
            </section>
            
            <!-- Market Analysis -->
            <section id="market" class="content-section">
                <?php $this->load->view('reports/mobile/components/market_analysis', $data); ?>
            </section>
            
            <!-- Neighborhood -->
            <section id="neighborhood" class="content-section">
                <?php $this->load->view('reports/mobile/components/neighborhood_info', $data); ?>
            </section>
            
            <!-- AI Insights -->
            <section id="insights" class="content-section">
                <?php $this->load->view('reports/mobile/components/ai_insights', $data); ?>
            </section>
            
        </div>
        
        <!-- Footer -->
        <?php $this->load->view('reports/mobile/components/footer', $data); ?>
        
    </div>
    
    <!-- JavaScript -->
    <script src="<?php echo base_url('assets/reports/mobile/js/mobile-report.js'); ?>"></script>
    
    <!-- Service Worker for PWA -->
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('<?php echo base_url('assets/reports/mobile/sw.js'); ?>');
        }
    </script>
</body>
</html>
```

### **Interactive Components**

#### **Property Overview Component**
```php
<!-- File: application/views/reports/mobile/components/property_overview.php -->
<div class="property-overview">
    <div class="hero-image">
        <img src="<?php echo $property_image; ?>" alt="Property Image" class="property-img">
        <div class="hero-overlay">
            <h1 class="property-address"><?php echo $property->PropertyProfile->SiteAddress; ?></h1>
            <div class="property-price"><?php echo dollars($property->PropertyProfile->LastSalePrice); ?></div>
        </div>
    </div>
    
    <div class="property-details-grid">
        <div class="detail-card">
            <i class="fas fa-bed"></i>
            <span class="label">Bedrooms</span>
            <span class="value"><?php echo $property->PropertyProfile->Bedrooms; ?></span>
        </div>
        <div class="detail-card">
            <i class="fas fa-bath"></i>
            <span class="label">Bathrooms</span>
            <span class="value"><?php echo $property->PropertyProfile->Bathrooms; ?></span>
        </div>
        <div class="detail-card">
            <i class="fas fa-ruler-combined"></i>
            <span class="label">Sq Ft</span>
            <span class="value"><?php echo number_format($property->PropertyProfile->BuildingArea); ?></span>
        </div>
        <div class="detail-card">
            <i class="fas fa-calendar"></i>
            <span class="label">Year Built</span>
            <span class="value"><?php echo $property->PropertyProfile->YearBuilt; ?></span>
        </div>
    </div>
    
    <!-- Interactive Map -->
    <div class="map-container">
        <div id="property-map" class="interactive-map">
            <img src="<?php echo $mapUrl; ?>" alt="Property Location" class="map-image">
            <div class="map-overlay">
                <button class="map-fullscreen-btn" onclick="openFullscreenMap()">
                    <i class="fas fa-expand"></i> View Full Map
                </button>
            </div>
        </div>
    </div>
</div>
```

#### **Interactive Charts Component**
```php
<!-- File: application/views/reports/mobile/components/comparable_sales.php -->
<div class="comparable-sales">
    <h2>Comparable Sales Analysis</h2>
    
    <!-- Interactive Price Chart -->
    <div class="chart-container">
        <canvas id="priceComparisonChart" width="400" height="300"></canvas>
    </div>
    
    <!-- Comparable Properties List -->
    <div class="comparables-list">
        <?php foreach($areaSalesAnalysis['comparable'] as $index => $comp): ?>
        <div class="comparable-card" data-index="<?php echo $index; ?>">
            <div class="comp-header">
                <h3><?php echo $comp['Address']; ?></h3>
                <span class="distance"><?php echo $comp['Distance']; ?> mi</span>
            </div>
            <div class="comp-details">
                <div class="comp-price"><?php echo $comp['Price']; ?></div>
                <div class="comp-specs">
                    <span><?php echo $comp['Beds']; ?> bed</span>
                    <span><?php echo $comp['Baths']; ?> bath</span>
                    <span><?php echo number_format($comp['SquareFeet']); ?> sq ft</span>
                </div>
                <div class="comp-date">Sold: <?php echo $comp['Date']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Price per Square Foot Chart -->
    <div class="chart-container">
        <h3>Price per Square Foot Comparison</h3>
        <canvas id="pricePerSqftChart" width="400" height="250"></canvas>
    </div>
</div>

<script>
// Price Comparison Chart
const priceCtx = document.getElementById('priceComparisonChart').getContext('2d');
const priceChart = new Chart(priceCtx, {
    type: 'bar',
    data: {
        labels: [
            'Subject Property',
            <?php foreach($areaSalesAnalysis['comparable'] as $comp): ?>
            '<?php echo substr($comp['Address'], 0, 20); ?>...',
            <?php endforeach; ?>
        ],
        datasets: [{
            label: 'Sale Price',
            data: [
                <?php echo str_replace(['$', ','], '', $property->PropertyProfile->LastSalePrice); ?>,
                <?php foreach($areaSalesAnalysis['comparable'] as $comp): ?>
                <?php echo $comp['PriceRate']; ?>,
                <?php endforeach; ?>
            ],
            backgroundColor: [
                'var(--theme-color)',
                <?php foreach($areaSalesAnalysis['comparable'] as $comp): ?>
                'var(--theme-color-light)',
                <?php endforeach; ?>
            ],
            borderColor: 'var(--theme-color-dark)',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return '$' + context.parsed.y.toLocaleString();
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return '$' + value.toLocaleString();
                    }
                }
            },
            x: {
                ticks: {
                    maxRotation: 45,
                    minRotation: 0
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        },
        onClick: function(event, elements) {
            if (elements.length > 0) {
                const index = elements[0].index;
                highlightComparable(index);
            }
        }
    }
});

// Price per Sq Ft Chart
const sqftCtx = document.getElementById('pricePerSqftChart').getContext('2d');
const sqftChart = new Chart(sqftCtx, {
    type: 'line',
    data: {
        labels: [
            <?php foreach($areaSalesAnalysis['comparable'] as $comp): ?>
            '<?php echo $comp['Distance']; ?> mi',
            <?php endforeach; ?>
        ],
        datasets: [{
            label: 'Price per Sq Ft',
            data: [
                <?php foreach($areaSalesAnalysis['comparable'] as $comp): ?>
                <?php echo round($comp['PriceRate'] / $comp['SquareFeet'], 2); ?>,
                <?php endforeach; ?>
            ],
            borderColor: 'var(--theme-color)',
            backgroundColor: 'var(--theme-color-light)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return '$' + value;
                    }
                }
            }
        }
    }
});

function highlightComparable(index) {
    // Highlight corresponding comparable card
    document.querySelectorAll('.comparable-card').forEach((card, i) => {
        card.classList.toggle('highlighted', i === index - 1);
    });
    
    // Scroll to highlighted card
    if (index > 0) {
        const card = document.querySelector(`[data-index="${index - 1}"]`);
        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}
</script>
```

## 🎨 **Mobile-Optimized CSS**

### **Responsive Styles**
```css
/* File: assets/reports/mobile/css/mobile.css */

/* CSS Variables for Dynamic Theming */
:root {
    --theme-color: #007bff;
    --theme-color-light: rgba(0, 123, 255, 0.1);
    --theme-color-dark: rgba(0, 123, 255, 0.8);
    --text-primary: #333;
    --text-secondary: #666;
    --background: #f8f9fa;
    --card-background: #ffffff;
    --border-color: #dee2e6;
    --shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Base Styles */
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: var(--text-primary);
    background-color: var(--background);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Loading Screen */
.loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: linear-gradient(135deg, var(--theme-color), var(--theme-color-dark));
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    z-index: 9999;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 20px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Mobile Report Container */
.mobile-report {
    min-height: 100vh;
    padding-bottom: 60px; /* Space for footer */
}

/* Header */
.report-header {
    background: linear-gradient(135deg, var(--theme-color), var(--theme-color-dark));
    color: white;
    padding: 20px 15px;
    text-align: center;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: var(--shadow);
}

.report-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
}

.report-subtitle {
    margin: 5px 0 0;
    opacity: 0.9;
    font-size: 0.9rem;
}

/* Navigation Tabs */
.nav-tabs {
    display: flex;
    background: white;
    border-bottom: 1px solid var(--border-color);
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    position: sticky;
    top: 80px; /* Below header */
    z-index: 99;
}

.nav-tab {
    flex: 1;
    min-width: 100px;
    padding: 15px 10px;
    text-align: center;
    background: none;
    border: none;
    color: var(--text-secondary);
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.nav-tab.active {
    color: var(--theme-color);
    border-bottom: 3px solid var(--theme-color);
    background: var(--theme-color-light);
}

.nav-tab:hover {
    background: var(--theme-color-light);
}

/* Content Sections */
.report-content {
    padding: 20px 15px;
}

.content-section {
    display: none;
    animation: fadeIn 0.3s ease-in-out;
}

.content-section.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Property Overview */
.property-overview {
    margin-bottom: 30px;
}

.hero-image {
    position: relative;
    width: 100%;
    height: 250px;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: var(--shadow);
}

.property-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
    color: white;
    padding: 20px;
}

.property-address {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.property-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #4CAF50;
}

/* Property Details Grid */
.property-details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-bottom: 25px;
}

.detail-card {
    background: var(--card-background);
    padding: 20px;
    border-radius: 12px;
    box-shadow: var(--shadow);
    text-align: center;
    transition: transform 0.2s ease;
}

.detail-card:hover {
    transform: translateY(-2px);
}

.detail-card i {
    font-size: 2rem;
    color: var(--theme-color);
    margin-bottom: 10px;
}

.detail-card .label {
    display: block;
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.detail-card .value {
    display: block;
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-primary);
}

/* Chart Containers */
.chart-container {
    background: var(--card-background);
    padding: 20px;
    border-radius: 12px;
    box-shadow: var(--shadow);
    margin-bottom: 25px;
    position: relative;
    height: 350px;
}

.chart-container h3 {
    margin: 0 0 20px;
    color: var(--text-primary);
    font-size: 1.1rem;
    text-align: center;
}

.chart-container canvas {
    max-width: 100%;
    height: auto !important;
}

/* Comparable Cards */
.comparables-list {
    margin: 25px 0;
}

.comparable-card {
    background: var(--card-background);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    cursor: pointer;
}

.comparable-card:hover,
.comparable-card.highlighted {
    border-color: var(--theme-color);
    box-shadow: 0 4px 20px var(--theme-color-light);
    transform: translateY(-2px);
}

.comp-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.comp-header h3 {
    margin: 0;
    font-size: 1.1rem;
    color: var(--text-primary);
    flex: 1;
}

.distance {
    background: var(--theme-color-light);
    color: var(--theme-color);
    padding: 4px 8px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.comp-price {
    font-size: 1.3rem;
    font-weight: 700;
    color: #4CAF50;
    margin-bottom: 10px;
}

.comp-specs {
    display: flex;
    gap: 15px;
    margin-bottom: 8px;
}

.comp-specs span {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.comp-date {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

/* Interactive Map */
.map-container {
    margin: 25px 0;
}

.interactive-map {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow);
}

.map-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.map-overlay {
    position: absolute;
    top: 10px;
    right: 10px;
}

.map-fullscreen-btn {
    background: var(--theme-color);
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    cursor: pointer;
    box-shadow: var(--shadow);
}

/* Touch Gestures */
.swipe-indicator {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    color: var(--text-secondary);
    font-size: 0.8rem;
}

.swipe-indicator i {
    margin: 0 5px;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

/* Responsive Design */
@media (max-width: 480px) {
    .property-details-grid {
        grid-template-columns: 1fr;
    }
    
    .nav-tab {
        font-size: 0.8rem;
        padding: 12px 8px;
    }
    
    .chart-container {
        padding: 15px;
        height: 300px;
    }
    
    .comp-specs {
        flex-direction: column;
        gap: 5px;
    }
}

@media (min-width: 768px) {
    .mobile-report {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .property-details-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
    :root {
        --text-primary: #ffffff;
        --text-secondary: #cccccc;
        --background: #1a1a1a;
        --card-background: #2a2a2a;
        --border-color: #444444;
        --shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }
}

/* Print Styles */
@media print {
    .nav-tabs,
    .map-fullscreen-btn,
    .swipe-indicator {
        display: none !important;
    }
    
    .content-section {
        display: block !important;
        page-break-inside: avoid;
    }
    
    .chart-container {
        page-break-inside: avoid;
    }
}
```

## 🔧 **JavaScript Interactivity**

### **Mobile Report Controller**
```javascript
// File: assets/reports/mobile/js/mobile-report.js

class MobileReport {
    constructor() {
        this.currentSection = 'overview';
        this.touchStartX = 0;
        this.touchStartY = 0;
        this.init();
    }
    
    init() {
        this.setupNavigation();
        this.setupTouchGestures();
        this.setupCharts();
        this.hideLoadingScreen();
        this.setupPWA();
    }
    
    hideLoadingScreen() {
        setTimeout(() => {
            document.getElementById('loading-screen').style.display = 'none';
            document.getElementById('mobile-report').style.display = 'block';
        }, 1500);
    }
    
    setupNavigation() {
        // Tab navigation
        document.querySelectorAll('.nav-tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                const targetSection = e.target.dataset.section;
                this.showSection(targetSection);
            });
        });
        
        // URL hash navigation
        window.addEventListener('hashchange', () => {
            const section = window.location.hash.substr(1) || 'overview';
            this.showSection(section);
        });
    }
    
    showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.content-section').forEach(section => {
            section.classList.remove('active');
        });
        
        // Remove active class from all tabs
        document.querySelectorAll('.nav-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Show target section
        const targetSection = document.getElementById(sectionId);
        const targetTab = document.querySelector(`[data-section="${sectionId}"]`);
        
        if (targetSection && targetTab) {
            targetSection.classList.add('active');
            targetTab.classList.add('active');
            this.currentSection = sectionId;
            
            // Update URL hash
            history.replaceState(null, null, `#${sectionId}`);
            
            // Trigger section-specific actions
            this.onSectionChange(sectionId);
        }
    }
    
    onSectionChange(sectionId) {
        // Refresh charts when section becomes visible
        if (sectionId === 'comparables' && window.priceChart) {
            setTimeout(() => {
                window.priceChart.resize();
                window.sqftChart.resize();
            }, 100);
        }
        
        // Analytics tracking
        if (typeof gtag !== 'undefined') {
            gtag('event', 'section_view', {
                'section_name': sectionId
            });
        }
    }
    
    setupTouchGestures() {
        const reportContent = document.querySelector('.report-content');
        const hammer = new Hammer(reportContent);
        
        // Swipe between sections
        hammer.on('swipeleft', () => {
            this.nextSection();
        });
        
        hammer.on('swiperight', () => {
            this.previousSection();
        });
        
        // Pinch to zoom on charts
        hammer.get('pinch').set({ enable: true });
        hammer.on('pinch', (e) => {
            if (e.target.closest('.chart-container')) {
                const scale = Math.max(0.5, Math.min(3, e.scale));
                e.target.style.transform = `scale(${scale})`;
            }
        });
    }
    
    nextSection() {
        const sections = ['overview', 'comparables', 'market', 'neighborhood', 'insights'];
        const currentIndex = sections.indexOf(this.currentSection);
        if (currentIndex < sections.length - 1) {
            this.showSection(sections[currentIndex + 1]);
        }
    }
    
    previousSection() {
        const sections = ['overview', 'comparables', 'market', 'neighborhood', 'insights'];
        const currentIndex = sections.indexOf(this.currentSection);
        if (currentIndex > 0) {
            this.showSection(sections[currentIndex - 1]);
        }
    }
    
    setupPWA() {
        // Service Worker registration
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/assets/reports/mobile/sw.js')
                .then(registration => {
                    console.log('SW registered: ', registration);
                })
                .catch(registrationError => {
                    console.log('SW registration failed: ', registrationError);
                });
        }
        
        // Add to home screen prompt
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            this.showInstallPrompt();
        });
    }
    
    showInstallPrompt() {
        const installBanner = document.createElement('div');
        installBanner.className = 'install-banner';
        installBanner.innerHTML = `
            <div class="install-content">
                <span>Add this report to your home screen for easy access</span>
                <button class="install-btn">Install</button>
                <button class="dismiss-btn">×</button>
            </div>
        `;
        
        document.body.appendChild(installBanner);
        
        installBanner.querySelector('.install-btn').addEventListener('click', () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    deferredPrompt = null;
                    installBanner.remove();
                });
            }
        });
        
        installBanner.querySelector('.dismiss-btn').addEventListener('click', () => {
            installBanner.remove();
        });
    }
}

// Global functions for chart interactions
function openFullscreenMap() {
    const mapImage = document.querySelector('.map-image');
    if (mapImage.requestFullscreen) {
        mapImage.requestFullscreen();
    } else if (mapImage.webkitRequestFullscreen) {
        mapImage.webkitRequestFullscreen();
    } else if (mapImage.msRequestFullscreen) {
        mapImage.msRequestFullscreen();
    }
}

function highlightComparable(index) {
    document.querySelectorAll('.comparable-card').forEach((card, i) => {
        card.classList.toggle('highlighted', i === index - 1);
    });
    
    if (index > 0) {
        const card = document.querySelector(`[data-index="${index - 1}"]`);
        if (card) {
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.mobileReport = new MobileReport();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = MobileReport;
}
```

## 📊 **Database Schema Updates**

```sql
-- Add HTML version support to reports table
ALTER TABLE lp_my_listing ADD COLUMN html_version VARCHAR(255) NULL;
ALTER TABLE lp_my_listing ADD COLUMN html_generated_at DATETIME NULL;

-- Add mobile optimization flags
ALTER TABLE lp_my_listing ADD COLUMN mobile_optimized TINYINT DEFAULT 0;
ALTER TABLE lp_my_listing ADD COLUMN interactive_charts TINYINT DEFAULT 1;

-- Add PWA support fields
ALTER TABLE lp_user_mst ADD COLUMN pwa_enabled TINYINT DEFAULT 1;
ALTER TABLE lp_user_mst ADD COLUMN offline_reports TINYINT DEFAULT 0;

-- Create mobile sessions table for analytics
CREATE TABLE lp_mobile_sessions (
    session_id VARCHAR(64) PRIMARY KEY,
    user_id_fk INT,
    report_id_fk INT,
    device_info TEXT,
    session_start DATETIME,
    session_end DATETIME,
    sections_viewed TEXT,
    interactions_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id_fk) REFERENCES lp_user_mst(user_id_pk),
    FOREIGN KEY (report_id_fk) REFERENCES lp_my_listing(project_id_pk)
);

-- Add indexes for performance
CREATE INDEX idx_html_version ON lp_my_listing(html_version);
CREATE INDEX idx_mobile_optimized ON lp_my_listing(mobile_optimized);
CREATE INDEX idx_mobile_sessions_user ON lp_mobile_sessions(user_id_fk);
CREATE INDEX idx_mobile_sessions_report ON lp_mobile_sessions(report_id_fk);
```

## 🚀 **Implementation Roadmap**

### **Phase 1: Core HTML Infrastructure (Week 1)**
1. **Create mobile HTML controller**
2. **Build responsive template structure**
3. **Implement basic navigation**
4. **Add database schema updates**

### **Phase 2: Interactive Components (Week 2)**
1. **Implement Chart.js integration**
2. **Add touch gesture support**
3. **Create swipeable sections**
4. **Optimize for iOS/Android**

### **Phase 3: PWA Features (Week 3)**
1. **Add service worker for offline support**
2. **Implement app manifest**
3. **Add install prompts**
4. **Enable push notifications**

### **Phase 4: Performance & Testing (Week 4)**
1. **Optimize loading performance**
2. **Test across devices and browsers**
3. **Implement analytics tracking**
4. **Deploy and monitor**

This comprehensive documentation provides everything needed to create beautiful, interactive HTML reports optimized for mobile devices, complete with charts, animations, and PWA capabilities. 