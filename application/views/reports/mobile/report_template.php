<?php
/**
 * Modern Agent - Mobile Report Template
 * 
 * Main template for mobile-optimized property reports with:
 * - Responsive design and touch navigation
 * - Interactive charts and PWA capabilities
 * - Offline support and analytics tracking
 * 
 * @version 1.0.0
 * @author Modern Agent Development Team
 * @since January 2024
 */

// Set default theme if not provided
$theme = isset($theme) ? $theme : '#007bff';
$report_id = isset($report_id) ? $report_id : 'unknown';
$mobile_optimized = isset($mobile_optimized) ? $mobile_optimized : true;
$interactive_charts = isset($interactive_charts) ? $interactive_charts : true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, maximum-scale=3.0">
    <meta name="theme-color" content="<?php echo $theme; ?>">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Property Report">
    
    <!-- Page Title -->
    <title><?php echo isset($property->PropertyProfile->SiteAddress) ? $property->PropertyProfile->SiteAddress : 'Property Report'; ?> - Modern Agent</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Interactive property report with market analysis, comparable sales, and AI-powered insights">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="<?php echo base_url('assets/reports/mobile/manifest.json'); ?>">
    
    <!-- Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/reports/mobile/images/icon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/reports/mobile/images/icon-16x16.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/reports/mobile/images/apple-touch-icon.png'); ?>">
    
    <!-- CSS Libraries -->
    <link rel="preload" href="<?php echo base_url('assets/reports/mobile/css/mobile.css'); ?>" as="style">
    <link rel="stylesheet" href="<?php echo base_url('assets/reports/mobile/css/mobile.css'); ?>">
    
    <!-- External CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    
    <!-- Dynamic Theme Styles -->
    <style>
        :root {
            --theme-color: <?php echo $theme; ?>;
            --theme-color-light: <?php echo $theme; ?>20;
            --theme-color-dark: <?php echo $theme; ?>dd;
        }
    </style>
    
    <!-- Preload Critical JavaScript -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js" as="script">
    <?php if ($interactive_charts): ?>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" as="script">
    <?php endif; ?>
</head>
<body data-report-id="<?php echo $report_id; ?>" data-theme="<?php echo $theme; ?>">
    
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="spinner"></div>
        <div class="loading-text">Loading Property Report...</div>
    </div>
    
    <!-- Mobile Report Container -->
    <div id="mobile-report" class="mobile-report" style="display: none;">
        
        <!-- Header Section -->
        <header class="report-header">
            <h1 class="report-title">
                <?php echo isset($property->PropertyProfile->SiteAddress) ? $property->PropertyProfile->SiteAddress : 'Property Report'; ?>
            </h1>
            <p class="report-subtitle">
                <?php 
                if (isset($property->PropertyProfile)) {
                    echo $property->PropertyProfile->SiteCity . ', ' . $property->PropertyProfile->SiteState . ' ' . $property->PropertyProfile->SiteZip;
                } else {
                    echo 'Generated on ' . date('F j, Y');
                }
                ?>
            </p>
            
            <div class="header-actions">
                <button class="header-btn" onclick="window.print()">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="header-btn" onclick="shareReport()">
                    <i class="fas fa-share"></i> Share
                </button>
            </div>
        </header>
        
        <!-- Navigation Tabs -->
        <nav class="nav-tabs" role="tablist">
            <button class="nav-tab active" data-section="overview" role="tab" aria-selected="true" aria-controls="overview">
                <i class="fas fa-home"></i>
                <span>Overview</span>
            </button>
            <button class="nav-tab" data-section="comparables" role="tab" aria-selected="false" aria-controls="comparables">
                <i class="fas fa-chart-bar"></i>
                <span>Comparables</span>
            </button>
            <button class="nav-tab" data-section="market" role="tab" aria-selected="false" aria-controls="market">
                <i class="fas fa-trend-up"></i>
                <span>Market</span>
            </button>
            <button class="nav-tab" data-section="neighborhood" role="tab" aria-selected="false" aria-controls="neighborhood">
                <i class="fas fa-map-marker-alt"></i>
                <span>Area</span>
            </button>
            <button class="nav-tab" data-section="insights" role="tab" aria-selected="false" aria-controls="insights">
                <i class="fas fa-lightbulb"></i>
                <span>AI Insights</span>
            </button>
        </nav>
        
        <!-- Content Sections -->
        <main class="report-content">
            
            <!-- Property Overview Section -->
            <section id="overview" class="content-section active" role="tabpanel" aria-labelledby="overview-tab">
                <?php $this->load->view('reports/mobile/components/property_overview', get_defined_vars()); ?>
            </section>
            
            <!-- Comparable Sales Section -->
            <section id="comparables" class="content-section" role="tabpanel" aria-labelledby="comparables-tab">
                <?php $this->load->view('reports/mobile/components/comparable_sales', get_defined_vars()); ?>
            </section>
            
            <!-- Market Analysis Section -->
            <section id="market" class="content-section" role="tabpanel" aria-labelledby="market-tab">
                <?php $this->load->view('reports/mobile/components/market_analysis', get_defined_vars()); ?>
            </section>
            
            <!-- Neighborhood Section -->
            <section id="neighborhood" class="content-section" role="tabpanel" aria-labelledby="neighborhood-tab">
                <?php $this->load->view('reports/mobile/components/neighborhood_info', get_defined_vars()); ?>
            </section>
            
            <!-- AI Insights Section -->
            <section id="insights" class="content-section" role="tabpanel" aria-labelledby="insights-tab">
                <?php $this->load->view('reports/mobile/components/ai_insights', get_defined_vars()); ?>
            </section>
            
        </main>
        
        <!-- Footer -->
        <footer class="report-footer">
            <?php $this->load->view('reports/mobile/components/footer', get_defined_vars()); ?>
        </footer>
        
        <!-- Swipe Indicator -->
        <div class="swipe-indicator">
            <i class="fas fa-arrows-alt-h"></i>
            Swipe or tap to navigate
        </div>
        
    </div>
    
    <!-- ARIA Live Region for Screen Readers -->
    <div id="section-announcer" class="visually-hidden" aria-live="polite" aria-atomic="true"></div>
    
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>
    <?php if ($interactive_charts): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    <?php endif; ?>
    
    <!-- Chart Data -->
    <?php if (isset($areaSalesAnalysis) && $interactive_charts): ?>
    <script>
        // Global chart data for JavaScript
        window.chartData = {
            price: {
                labels: [
                    'Subject Property',
                    <?php if (isset($areaSalesAnalysis['comparable'])): ?>
                    <?php foreach($areaSalesAnalysis['comparable'] as $comp): ?>
                    '<?php echo substr($comp['Address'] ?? 'Unknown', 0, 20); ?>...',
                    <?php endforeach; ?>
                    <?php endif; ?>
                ],
                datasets: [{
                    label: 'Sale Price',
                    data: [
                        <?php echo isset($property->PropertyProfile->LastSalePrice) ? (int)str_replace(['$', ','], '', $property->PropertyProfile->LastSalePrice) : 0; ?>,
                        <?php if (isset($areaSalesAnalysis['comparable'])): ?>
                        <?php foreach($areaSalesAnalysis['comparable'] as $comp): ?>
                        <?php echo isset($comp['PriceRate']) ? (int)$comp['PriceRate'] : 0; ?>,
                        <?php endforeach; ?>
                        <?php endif; ?>
                    ],
                    backgroundColor: [
                        'var(--theme-color)',
                        <?php if (isset($areaSalesAnalysis['comparable'])): ?>
                        <?php foreach($areaSalesAnalysis['comparable'] as $comp): ?>
                        'var(--theme-color-light)',
                        <?php endforeach; ?>
                        <?php endif; ?>
                    ],
                    borderColor: 'var(--theme-color-dark)',
                    borderWidth: 2
                }]
            }
        };
        
        // Report metadata
        window.reportData = {
            id: '<?php echo $report_id; ?>',
            theme: '<?php echo $theme; ?>',
            mobile_optimized: <?php echo $mobile_optimized ? 'true' : 'false'; ?>,
            interactive_charts: <?php echo $interactive_charts ? 'true' : 'false'; ?>
        };
    </script>
    <?php endif; ?>
    
    <!-- Main Mobile Report JavaScript -->
    <script src="<?php echo base_url('assets/reports/mobile/js/mobile-report.js'); ?>"></script>
    
    <!-- Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('<?php echo base_url('assets/reports/mobile/sw.js'); ?>')
                .then(registration => {
                    console.log('SW registered: ', registration);
                })
                .catch(registrationError => {
                    console.log('SW registration failed: ', registrationError);
                });
        }
        
        // Share function
        function shareReport() {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    text: 'Property Report - <?php echo isset($property->PropertyProfile->SiteAddress) ? $property->PropertyProfile->SiteAddress : 'Property'; ?>',
                    url: window.location.href
                }).catch(err => console.log('Error sharing:', err));
            } else {
                // Fallback: copy URL to clipboard
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Report link copied to clipboard!');
                }).catch(() => {
                    // Final fallback: show URL
                    prompt('Copy this link to share:', window.location.href);
                });
            }
        }
    </script>
    
    <!-- Analytics (if Google Analytics is available) -->
    <?php if (isset($google_analytics_id)): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $google_analytics_id; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo $google_analytics_id; ?>', {
            page_title: 'Mobile Property Report',
            page_location: window.location.href,
            custom_map: {
                'custom_parameter_1': 'report_id',
                'custom_parameter_2': 'property_address'
            },
            report_id: '<?php echo $report_id; ?>',
            property_address: '<?php echo isset($property->PropertyProfile->SiteAddress) ? $property->PropertyProfile->SiteAddress : 'Unknown'; ?>'
        });
    </script>
    <?php endif; ?>
    
</body>
</html>