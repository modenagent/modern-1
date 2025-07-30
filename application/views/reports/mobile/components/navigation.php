<!-- Mobile Navigation Tabs -->
<div class="nav-tabs-container">
    <nav class="nav-tabs" role="tablist">
        
        <!-- Overview Tab -->
        <button class="nav-tab active" 
                type="button" 
                role="tab" 
                data-section="overview" 
                aria-controls="overview" 
                aria-selected="true">
            <i class="fas fa-home"></i>
            <span>Overview</span>
        </button>
        
        <!-- Comparables Tab -->
        <button class="nav-tab" 
                type="button" 
                role="tab" 
                data-section="comparables" 
                aria-controls="comparables" 
                aria-selected="false">
            <i class="fas fa-chart-bar"></i>
            <span>Comparables</span>
        </button>
        
        <!-- Market Tab -->
        <button class="nav-tab" 
                type="button" 
                role="tab" 
                data-section="market" 
                aria-controls="market" 
                aria-selected="false">
            <i class="fas fa-trending-up"></i>
            <span>Market</span>
        </button>
        
        <!-- Neighborhood Tab -->
        <button class="nav-tab" 
                type="button" 
                role="tab" 
                data-section="neighborhood" 
                aria-controls="neighborhood" 
                aria-selected="false">
            <i class="fas fa-map-marker-alt"></i>
            <span>Area</span>
        </button>
        
        <!-- AI Insights Tab -->
        <button class="nav-tab" 
                type="button" 
                role="tab" 
                data-section="insights" 
                aria-controls="insights" 
                aria-selected="false">
            <i class="fas fa-brain"></i>
            <span>Insights</span>
        </button>
        
    </nav>
</div>

<!-- Navigation Enhancement Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add touch feedback to navigation tabs
    const navTabs = document.querySelectorAll('.nav-tab');
    
    navTabs.forEach(tab => {
        // Add touch start effect
        tab.addEventListener('touchstart', function() {
            this.classList.add('touch-active');
        });
        
        // Remove touch effect
        tab.addEventListener('touchend', function() {
            setTimeout(() => {
                this.classList.remove('touch-active');
            }, 150);
        });
        
        // Handle tab clicks
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            const targetSection = this.dataset.section;
            
            if (window.mobileReport && typeof window.mobileReport.showSection === 'function') {
                window.mobileReport.showSection(targetSection);
            }
        });
    });
    
    // Add keyboard navigation support
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
            const activeTab = document.querySelector('.nav-tab.active');
            if (!activeTab) return;
            
            const tabs = Array.from(document.querySelectorAll('.nav-tab'));
            const currentIndex = tabs.indexOf(activeTab);
            let nextIndex;
            
            if (e.key === 'ArrowLeft') {
                nextIndex = currentIndex > 0 ? currentIndex - 1 : tabs.length - 1;
            } else {
                nextIndex = currentIndex < tabs.length - 1 ? currentIndex + 1 : 0;
            }
            
            tabs[nextIndex].click();
            e.preventDefault();
        }
    });
});
</script> 