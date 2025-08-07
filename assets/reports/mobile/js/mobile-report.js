/**
 * Modern Agent - Mobile Report JavaScript Framework
 * 
 * Provides touch navigation, interactive charts, PWA functionality,
 * and responsive behavior for mobile property reports.
 * 
 * @version 1.0.0
 * @author Modern Agent Development Team
 * @since January 2024
 */

class MobileReport {
    constructor() {
        this.currentSection = 'overview';
        this.touchStartX = 0;
        this.touchStartY = 0;
        this.isScrolling = false;
        this.charts = {};
        this.analytics = {
            startTime: Date.now(),
            sectionsViewed: new Set(['overview']),
            interactions: 0
        };
        
        // Bind methods to maintain context
        this.handleTouchStart = this.handleTouchStart.bind(this);
        this.handleTouchMove = this.handleTouchMove.bind(this);
        this.handleTouchEnd = this.handleTouchEnd.bind(this);
        this.handleResize = this.handleResize.bind(this);
        
        this.init();
    }
    
    /**
     * Initialize all mobile report functionality
     */
    init() {
        console.log('🚀 Initializing Mobile Report...');
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this._setupComponents());
        } else {
            this._setupComponents();
        }
    }
    
    /**
     * Set up all component functionality
     * @private
     */
    _setupComponents() {
        try {
            // Core functionality
            this.setupNavigation();
            this.setupTouchGestures();
            this.setupCharts();
            this.setupAnalytics();
            this.setupPWA();
            this.setupAccessibility();
            
            // UI enhancements
            this.hideLoadingScreen();
            this.setupLazyLoading();
            this.setupErrorHandling();
            
            // Event listeners
            window.addEventListener('resize', this.handleResize);
            window.addEventListener('orientationchange', () => {
                setTimeout(this.handleResize, 100);
            });
            
            console.log('✅ Mobile Report initialized successfully');
            
        } catch (error) {
            console.error('❌ Error initializing Mobile Report:', error);
            this.showError('Failed to load report. Please refresh the page.');
        }
    }
    
    /**
     * Hide loading screen with smooth transition
     */
    hideLoadingScreen() {
        const loadingScreen = document.getElementById('loading-screen');
        const mobileReport = document.getElementById('mobile-report');
        
        if (loadingScreen && mobileReport) {
            setTimeout(() => {
                loadingScreen.classList.add('fade-out');
                mobileReport.classList.add('loaded');
                
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                }, 500);
            }, 1200); // Show loading for at least 1.2 seconds
        }
    }
    
    /**
     * Set up tab navigation and URL hash handling
     */
    setupNavigation() {
        // Tab click handlers
        document.querySelectorAll('.nav-tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                const targetSection = e.target.closest('.nav-tab').dataset.section;
                if (targetSection) {
                    this.showSection(targetSection);
                    this.trackInteraction('tab_click', { section: targetSection });
                }
            });
        });
        
        // URL hash navigation
        window.addEventListener('hashchange', () => {
            const section = window.location.hash.substr(1) || 'overview';
            this.showSection(section, false); // Don't update URL again
        });
        
        // Initialize from URL hash
        const initialSection = window.location.hash.substr(1) || 'overview';
        this.showSection(initialSection, false);
        
        console.log('✅ Navigation setup complete');
    }
    
    /**
     * Show specific report section
     * @param {string} sectionId - Section ID to show
     * @param {boolean} updateUrl - Whether to update URL hash
     */
    showSection(sectionId, updateUrl = true) {
        const validSections = ['overview', 'comparables', 'market', 'neighborhood', 'insights'];
        
        if (!validSections.includes(sectionId)) {
            console.warn(`Invalid section: ${sectionId}`);
            return;
        }
        
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
            if (updateUrl) {
                history.replaceState(null, null, `#${sectionId}`);
            }
            
            // Trigger section-specific actions
            this.onSectionChange(sectionId);
            
            // Track analytics
            this.analytics.sectionsViewed.add(sectionId);
            
            // Scroll to top of content
            const reportContent = document.querySelector('.report-content');
            if (reportContent) {
                reportContent.scrollTop = 0;
            }
        }
    }
    
    /**
     * Handle section change events
     * @param {string} sectionId - New section ID
     */
    onSectionChange(sectionId) {
        // Refresh charts when section becomes visible
        if (sectionId === 'comparables' && this.charts.priceChart) {
            setTimeout(() => {
                Object.values(this.charts).forEach(chart => {
                    if (chart && chart.resize) {
                        chart.resize();
                    }
                });
            }, 100);
        }
        
        // Trigger lazy loading for section
        this.loadSectionAssets(sectionId);
        
        // Analytics tracking
        if (typeof gtag !== 'undefined') {
            gtag('event', 'section_view', {
                'section_name': sectionId,
                'report_id': this.getReportId()
            });
        }
        
        console.log(`📍 Section changed to: ${sectionId}`);
    }
    
    /**
     * Set up touch gesture handling
     */
    setupTouchGestures() {
        const reportContent = document.querySelector('.report-content');
        
        if (!reportContent) return;
        
        // Check if Hammer.js is available
        if (typeof Hammer !== 'undefined') {
            this.setupHammerGestures(reportContent);
        } else {
            // Fallback to basic touch events
            this.setupBasicTouchGestures(reportContent);
        }
        
        console.log('✅ Touch gestures setup complete');
    }
    
    /**
     * Set up Hammer.js gestures (if available)
     * @param {Element} element - Element to attach gestures to
     */
    setupHammerGestures(element) {
        const hammer = new Hammer(element);
        
        // Configure recognizers
        hammer.get('swipe').set({ direction: Hammer.DIRECTION_ALL });
        hammer.get('pinch').set({ enable: true });
        
        // Swipe between sections
        hammer.on('swipeleft', () => this.nextSection());
        hammer.on('swiperight', () => this.previousSection());
        
        // Pinch to zoom on charts
        hammer.on('pinch', (e) => {
            const chartContainer = e.target.closest('.chart-container');
            if (chartContainer) {
                const scale = Math.max(0.5, Math.min(3, e.scale));
                const canvas = chartContainer.querySelector('canvas');
                if (canvas) {
                    canvas.style.transform = `scale(${scale})`;
                    canvas.style.transformOrigin = 'center';
                }
            }
        });
        
        // Reset zoom on pinch end
        hammer.on('pinchend', (e) => {
            const chartContainer = e.target.closest('.chart-container');
            if (chartContainer) {
                const canvas = chartContainer.querySelector('canvas');
                if (canvas) {
                    canvas.style.transform = '';
                }
            }
        });
        
        console.log('✅ Hammer.js gestures configured');
    }
    
    /**
     * Set up basic touch gestures (fallback)
     * @param {Element} element - Element to attach gestures to
     */
    setupBasicTouchGestures(element) {
        element.addEventListener('touchstart', this.handleTouchStart, { passive: true });
        element.addEventListener('touchmove', this.handleTouchMove, { passive: true });
        element.addEventListener('touchend', this.handleTouchEnd, { passive: true });
        
        console.log('✅ Basic touch gestures configured');
    }
    
    /**
     * Handle touch start events
     * @param {TouchEvent} e - Touch event
     */
    handleTouchStart(e) {
        this.touchStartX = e.touches[0].clientX;
        this.touchStartY = e.touches[0].clientY;
        this.isScrolling = false;
    }
    
    /**
     * Handle touch move events
     * @param {TouchEvent} e - Touch event
     */
    handleTouchMove(e) {
        if (!this.touchStartX || !this.touchStartY) return;
        
        const deltaX = e.touches[0].clientX - this.touchStartX;
        const deltaY = e.touches[0].clientY - this.touchStartY;
        
        // Determine if this is a horizontal swipe or vertical scroll
        if (Math.abs(deltaY) > Math.abs(deltaX)) {
            this.isScrolling = true;
        }
    }
    
    /**
     * Handle touch end events
     * @param {TouchEvent} e - Touch event
     */
    handleTouchEnd(e) {
        if (!this.touchStartX || !this.touchStartY || this.isScrolling) {
            this.touchStartX = 0;
            this.touchStartY = 0;
            this.isScrolling = false;
            return;
        }
        
        const deltaX = e.changedTouches[0].clientX - this.touchStartX;
        const threshold = 100; // Minimum distance for swipe
        
        if (Math.abs(deltaX) > threshold) {
            if (deltaX > 0) {
                this.previousSection();
            } else {
                this.nextSection();
            }
            
            this.trackInteraction('swipe', { 
                direction: deltaX > 0 ? 'right' : 'left',
                distance: Math.abs(deltaX)
            });
        }
        
        this.touchStartX = 0;
        this.touchStartY = 0;
        this.isScrolling = false;
    }
    
    /**
     * Navigate to next section
     */
    nextSection() {
        const sections = ['overview', 'comparables', 'market', 'neighborhood', 'insights'];
        const currentIndex = sections.indexOf(this.currentSection);
        if (currentIndex < sections.length - 1) {
            this.showSection(sections[currentIndex + 1]);
        }
    }
    
    /**
     * Navigate to previous section
     */
    previousSection() {
        const sections = ['overview', 'comparables', 'market', 'neighborhood', 'insights'];
        const currentIndex = sections.indexOf(this.currentSection);
        if (currentIndex > 0) {
            this.showSection(sections[currentIndex - 1]);
        }
    }
    
    /**
     * Set up interactive charts
     */
    setupCharts() {
        // Only initialize charts if Chart.js is available
        if (typeof Chart === 'undefined') {
            console.warn('Chart.js not available - charts will not be interactive');
            return;
        }
        
        // Set up Chart.js defaults
        Chart.defaults.responsive = true;
        Chart.defaults.maintainAspectRatio = false;
        Chart.defaults.plugins.legend.display = false;
        
        // Initialize charts when their sections become visible
        this.initializePriceChart();
        this.initializeTrendChart();
        
        console.log('✅ Charts setup complete');
    }
    
    /**
     * Initialize price comparison chart
     */
    initializePriceChart() {
        const canvas = document.getElementById('priceComparisonChart');
        if (!canvas) return;
        
        // Get chart data from data attributes or global variables
        const chartData = this.getChartData('price');
        
        if (chartData) {
            const ctx = canvas.getContext('2d');
            this.charts.priceChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: (context) => `$${context.parsed.y.toLocaleString()}`
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: (value) => `$${value.toLocaleString()}`
                            }
                        },
                        x: {
                            ticks: {
                                maxRotation: 45,
                                minRotation: 0
                            }
                        }
                    },
                    onClick: (event, elements) => {
                        if (elements.length > 0) {
                            const index = elements[0].index;
                            this.highlightComparable(index);
                            this.trackInteraction('chart_click', { 
                                chart: 'price',
                                index: index 
                            });
                        }
                    }
                }
            });
        }
    }
    
    /**
     * Initialize trend chart
     */
    initializeTrendChart() {
        const canvas = document.getElementById('trendChart');
        if (!canvas) return;
        
        const chartData = this.getChartData('trend');
        
        if (chartData) {
            const ctx = canvas.getContext('2d');
            this.charts.trendChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }
    
    /**
     * Get chart data from various sources
     * @param {string} chartType - Type of chart data to retrieve
     * @returns {Object|null} Chart data object
     */
    getChartData(chartType) {
        // Try to get data from global variables first
        if (typeof window.chartData !== 'undefined' && window.chartData[chartType]) {
            return window.chartData[chartType];
        }
        
        // Try to get data from data attributes
        const dataElement = document.querySelector(`[data-chart="${chartType}"]`);
        if (dataElement) {
            try {
                return JSON.parse(dataElement.dataset.chartData);
            } catch (e) {
                console.warn(`Invalid chart data for ${chartType}:`, e);
            }
        }
        
        return null;
    }
    
    /**
     * Highlight a comparable property
     * @param {number} index - Index of comparable to highlight
     */
    highlightComparable(index) {
        // Remove existing highlights
        document.querySelectorAll('.comparable-card').forEach(card => {
            card.classList.remove('highlighted');
        });
        
        // Highlight the selected card
        const targetCard = document.querySelector(`[data-index="${index}"]`);
        if (targetCard) {
            targetCard.classList.add('highlighted');
            targetCard.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        }
    }
    
    /**
     * Set up Progressive Web App functionality
     */
    setupPWA() {
        // Service Worker registration
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/assets/reports/mobile/sw.js')
                .then(registration => {
                    console.log('✅ Service Worker registered:', registration);
                })
                .catch(error => {
                    console.warn('⚠️ Service Worker registration failed:', error);
                });
        }
        
        // Install prompt handling
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            this.showInstallPrompt(deferredPrompt);
        });
        
        // Track app installation
        window.addEventListener('appinstalled', () => {
            console.log('✅ App installed');
            this.trackInteraction('app_installed');
        });
        
        console.log('✅ PWA setup complete');
    }
    
    /**
     * Show app installation prompt
     * @param {Event} deferredPrompt - Deferred install prompt event
     */
    showInstallPrompt(deferredPrompt) {
        const installBanner = document.createElement('div');
        installBanner.className = 'install-banner';
        installBanner.innerHTML = `
            <div class="install-content">
                <i class="fas fa-download"></i>
                <span>Add this report to your home screen for easy access</span>
                <button class="install-btn">Install</button>
                <button class="dismiss-btn" aria-label="Dismiss">&times;</button>
            </div>
        `;
        
        // Add styles
        installBanner.style.cssText = `
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            background: var(--theme-color);
            color: white;
            padding: 1rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            z-index: var(--z-fixed);
            animation: slideInUp 0.3s ease-out;
        `;
        
        document.body.appendChild(installBanner);
        
        // Handle install button click
        installBanner.querySelector('.install-btn').addEventListener('click', () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    console.log('Install prompt result:', choiceResult.outcome);
                    this.trackInteraction('install_prompt', { 
                        outcome: choiceResult.outcome 
                    });
                    deferredPrompt = null;
                    installBanner.remove();
                });
            }
        });
        
        // Handle dismiss button click
        installBanner.querySelector('.dismiss-btn').addEventListener('click', () => {
            installBanner.remove();
            this.trackInteraction('install_prompt_dismissed');
        });
        
        // Auto-dismiss after 10 seconds
        setTimeout(() => {
            if (installBanner.parentNode) {
                installBanner.remove();
            }
        }, 10000);
    }
    
    /**
     * Set up accessibility features
     */
    setupAccessibility() {
        // Keyboard navigation for tabs
        document.querySelectorAll('.nav-tab').forEach((tab, index, tabs) => {
            tab.addEventListener('keydown', (e) => {
                let targetIndex;
                
                switch (e.key) {
                    case 'ArrowLeft':
                        e.preventDefault();
                        targetIndex = index > 0 ? index - 1 : tabs.length - 1;
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        targetIndex = index < tabs.length - 1 ? index + 1 : 0;
                        break;
                    case 'Home':
                        e.preventDefault();
                        targetIndex = 0;
                        break;
                    case 'End':
                        e.preventDefault();
                        targetIndex = tabs.length - 1;
                        break;
                    default:
                        return;
                }
                
                tabs[targetIndex].focus();
                tabs[targetIndex].click();
            });
        });
        
        // ARIA live region for section changes
        const liveRegion = document.createElement('div');
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.className = 'visually-hidden';
        liveRegion.id = 'section-announcer';
        document.body.appendChild(liveRegion);
        
        console.log('✅ Accessibility setup complete');
    }
    
    /**
     * Set up analytics tracking
     */
    setupAnalytics() {
        // Track page view
        this.trackInteraction('page_view', {
            report_id: this.getReportId(),
            user_agent: navigator.userAgent,
            timestamp: new Date().toISOString()
        });
        
        // Track visibility changes
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.trackInteraction('page_hidden');
            } else {
                this.trackInteraction('page_visible');
            }
        });
        
        // Track session end on page unload
        window.addEventListener('beforeunload', () => {
            this.endSession();
        });
        
        console.log('✅ Analytics setup complete');
    }
    
    /**
     * Set up lazy loading for images and content
     */
    setupLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
        
        console.log('✅ Lazy loading setup complete');
    }
    
    /**
     * Set up error handling
     */
    setupErrorHandling() {
        window.addEventListener('error', (e) => {
            console.error('JavaScript error:', e.error);
            this.trackInteraction('javascript_error', {
                message: e.message,
                filename: e.filename,
                line: e.lineno
            });
        });
        
        window.addEventListener('unhandledrejection', (e) => {
            console.error('Unhandled promise rejection:', e.reason);
            this.trackInteraction('promise_rejection', {
                reason: e.reason?.toString()
            });
        });
    }
    
    /**
     * Handle window resize events
     */
    handleResize() {
        // Resize charts
        Object.values(this.charts).forEach(chart => {
            if (chart && chart.resize) {
                chart.resize();
            }
        });
        
        // Update viewport height for mobile browsers
        const vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
    }
    
    /**
     * Load assets for a specific section
     * @param {string} sectionId - Section ID
     */
    loadSectionAssets(sectionId) {
        // Implement lazy loading of section-specific assets
        const section = document.getElementById(sectionId);
        if (!section) return;
        
        // Load images
        const images = section.querySelectorAll('img[data-src]');
        images.forEach(img => {
            if (!img.src) {
                img.src = img.dataset.src;
            }
        });
    }
    
    /**
     * Track user interactions for analytics
     * @param {string} event - Event name
     * @param {Object} data - Additional event data
     */
    trackInteraction(event, data = {}) {
        this.analytics.interactions++;
        
        const eventData = {
            event,
            timestamp: new Date().toISOString(),
            section: this.currentSection,
            report_id: this.getReportId(),
            session_duration: Date.now() - this.analytics.startTime,
            ...data
        };
        
        // Send to Google Analytics if available
        if (typeof gtag !== 'undefined') {
            gtag('event', event, eventData);
        }
        
        // Send to custom analytics endpoint if available
        if (window.analyticsEndpoint) {
            fetch(window.analyticsEndpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(eventData)
            }).catch(err => console.warn('Analytics error:', err));
        }
        
        console.log('📊 Tracked:', event, eventData);
    }
    
    /**
     * End user session and send final analytics
     */
    endSession() {
        const sessionData = {
            duration: Date.now() - this.analytics.startTime,
            sections_viewed: Array.from(this.analytics.sectionsViewed),
            total_interactions: this.analytics.interactions,
            final_section: this.currentSection
        };
        
        this.trackInteraction('session_end', sessionData);
        
        // Send beacon for reliable delivery
        if (navigator.sendBeacon && window.analyticsEndpoint) {
            navigator.sendBeacon(
                window.analyticsEndpoint, 
                JSON.stringify({
                    event: 'session_end',
                    ...sessionData
                })
            );
        }
    }
    
    /**
     * Get current report ID
     * @returns {string} Report ID
     */
    getReportId() {
        return document.querySelector('[data-report-id]')?.dataset.reportId || 'unknown';
    }
    
    /**
     * Show error message to user
     * @param {string} message - Error message
     */
    showError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-banner';
        errorDiv.innerHTML = `
            <div class="error-content">
                <i class="fas fa-exclamation-triangle"></i>
                <span>${message}</span>
                <button class="error-dismiss" onclick="this.parentElement.parentElement.remove()">
                    &times;
                </button>
            </div>
        `;
        
        errorDiv.style.cssText = `
            position: fixed;
            top: 20px;
            left: 20px;
            right: 20px;
            background: #dc3545;
            color: white;
            padding: 1rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            z-index: var(--z-fixed);
        `;
        
        document.body.appendChild(errorDiv);
        
        setTimeout(() => {
            if (errorDiv.parentNode) {
                errorDiv.remove();
            }
        }, 5000);
    }
}

// Global utility functions for backward compatibility
window.openFullscreenMap = function() {
    const mapImage = document.querySelector('.map-image');
    if (mapImage && mapImage.requestFullscreen) {
        mapImage.requestFullscreen().catch(err => {
            console.warn('Fullscreen failed:', err);
        });
    }
};

window.highlightComparable = function(index) {
    if (window.mobileReport) {
        window.mobileReport.highlightComparable(index);
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.mobileReport = new MobileReport();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = MobileReport;
}

// Add CSS for dynamic elements
const dynamicStyles = document.createElement('style');
dynamicStyles.textContent = `
    .install-banner .install-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .install-banner .install-content i {
        font-size: 1.5rem;
    }
    
    .install-banner .install-content span {
        flex: 1;
        font-size: 0.9rem;
    }
    
    .install-btn, .dismiss-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    
    .install-btn:hover, .dismiss-btn:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
    .dismiss-btn {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        font-size: 1.2rem;
    }
    
    .error-banner .error-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .error-dismiss {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    @keyframes slideInUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
`;

document.head.appendChild(dynamicStyles);