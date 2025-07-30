<!-- Property Overview Section -->
<div class="property-overview">
    
    <!-- Hero Image Section -->
    <div class="hero-image-container">
        <?php if (!empty($propertyImages) && is_array($propertyImages)): ?>
            <!-- Image Carousel for Multiple Images -->
            <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($propertyImages as $index => $image): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <img src="<?php echo htmlspecialchars($image['url']); ?>" 
                                 class="d-block w-100 property-img" 
                                 alt="Property Image <?php echo $index + 1; ?>"
                                 loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if (count($propertyImages) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    
                    <!-- Image Counter -->
                    <div class="image-counter">
                        <span id="current-image">1</span> / <?php echo count($propertyImages); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <!-- Placeholder Image -->
            <div class="placeholder-image">
                <i class="fas fa-home"></i>
                <p>No property image available</p>
            </div>
        <?php endif; ?>
        
        <!-- Hero Overlay with Property Info -->
        <div class="hero-overlay">
            <h1 class="property-address">
                <?php echo htmlspecialchars($property->PropertyProfile->SiteAddress ?? 'Property Address Not Available'); ?>
            </h1>
            <div class="property-price">
                <?php 
                $price = $property->PropertyProfile->LastSalePrice ?? $property->PropertyProfile->EstimatedValue ?? 0;
                echo $price ? '$' . number_format($price) : 'Price Not Available';
                ?>
            </div>
            <div class="property-status">
                <span class="badge bg-success">
                    <?php echo ucfirst($property->PropertyProfile->PropertyType ?? 'Residential'); ?>
                </span>
            </div>
        </div>
    </div>
    
    <!-- Quick Facts Grid -->
    <div class="property-facts-grid">
        <div class="fact-card">
            <i class="fas fa-bed"></i>
            <div class="fact-content">
                <span class="fact-label">Bedrooms</span>
                <span class="fact-value"><?php echo $property->PropertyProfile->Bedrooms ?? 'N/A'; ?></span>
            </div>
        </div>
        
        <div class="fact-card">
            <i class="fas fa-bath"></i>
            <div class="fact-content">
                <span class="fact-label">Bathrooms</span>
                <span class="fact-value"><?php echo $property->PropertyProfile->Bathrooms ?? 'N/A'; ?></span>
            </div>
        </div>
        
        <div class="fact-card">
            <i class="fas fa-ruler-combined"></i>
            <div class="fact-content">
                <span class="fact-label">Living Area</span>
                <span class="fact-value">
                    <?php 
                    $area = $property->PropertyProfile->BuildingArea ?? $property->PropertyProfile->LivingArea ?? 0;
                    echo $area ? number_format($area) . ' sq ft' : 'N/A';
                    ?>
                </span>
            </div>
        </div>
        
        <div class="fact-card">
            <i class="fas fa-calendar-alt"></i>
            <div class="fact-content">
                <span class="fact-label">Year Built</span>
                <span class="fact-value"><?php echo $property->PropertyProfile->YearBuilt ?? 'N/A'; ?></span>
            </div>
        </div>
        
        <div class="fact-card">
            <i class="fas fa-expand-arrows-alt"></i>
            <div class="fact-content">
                <span class="fact-label">Lot Size</span>
                <span class="fact-value">
                    <?php 
                    $lotSize = $property->PropertyProfile->LotSize ?? 0;
                    echo $lotSize ? number_format($lotSize, 2) . ' acres' : 'N/A';
                    ?>
                </span>
            </div>
        </div>
        
        <div class="fact-card">
            <i class="fas fa-dollar-sign"></i>
            <div class="fact-content">
                <span class="fact-label">Price/Sq Ft</span>
                <span class="fact-value">
                    <?php 
                    $price = $property->PropertyProfile->LastSalePrice ?? 0;
                    $area = $property->PropertyProfile->BuildingArea ?? 0;
                    if ($price && $area) {
                        echo '$' . number_format($price / $area, 0);
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </span>
            </div>
        </div>
    </div>
    
    <!-- Interactive Map Section -->
    <div class="map-section">
        <h3>Property Location</h3>
        <div class="map-container">
            <div class="interactive-map">
                <?php if (!empty($mapUrl)): ?>
                    <img src="<?php echo htmlspecialchars($mapUrl); ?>" 
                         alt="Property Location Map" 
                         class="map-image"
                         loading="lazy">
                    <div class="map-overlay">
                        <button class="btn btn-sm btn-light map-fullscreen-btn" onclick="openFullscreenMap()">
                            <i class="fas fa-expand"></i> View Full Map
                        </button>
                    </div>
                <?php else: ?>
                    <div class="map-placeholder">
                        <i class="fas fa-map"></i>
                        <p>Map not available</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Property Details Expandable Section -->
    <div class="expandable-section">
        <button class="expand-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#propertyDetails" aria-expanded="false">
            <span>Property Details</span>
            <i class="fas fa-chevron-down"></i>
        </button>
        <div class="collapse" id="propertyDetails">
            <div class="details-content">
                <div class="row g-3">
                    
                    <!-- Basic Information -->
                    <div class="col-12">
                        <h5>Basic Information</h5>
                    </div>
                    <div class="col-6">
                        <strong>Property Type:</strong><br>
                        <?php echo $property->PropertyProfile->PropertyType ?? 'Not specified'; ?>
                    </div>
                    <div class="col-6">
                        <strong>Property Style:</strong><br>
                        <?php echo $property->PropertyProfile->PropertyStyle ?? 'Not specified'; ?>
                    </div>
                    <div class="col-6">
                        <strong>Stories:</strong><br>
                        <?php echo $property->PropertyProfile->Stories ?? 'Not specified'; ?>
                    </div>
                    <div class="col-6">
                        <strong>Parking:</strong><br>
                        <?php echo $property->PropertyProfile->ParkingSpaces ?? 'Not specified'; ?>
                    </div>
                    
                    <!-- Additional Features -->
                    <?php if (!empty($property->PropertyProfile->Features)): ?>
                    <div class="col-12 mt-3">
                        <h5>Features</h5>
                        <div class="features-list">
                            <?php 
                            $features = is_array($property->PropertyProfile->Features) 
                                      ? $property->PropertyProfile->Features 
                                      : explode(',', $property->PropertyProfile->Features);
                            foreach ($features as $feature): 
                            ?>
                                <span class="badge bg-secondary me-1 mb-1"><?php echo trim(htmlspecialchars($feature)); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="action-buttons">
        <button class="btn btn-primary" onclick="shareReport()">
            <i class="fas fa-share-alt"></i> Share Report
        </button>
        <button class="btn btn-outline-primary" onclick="downloadReport()">
            <i class="fas fa-download"></i> Download PDF
        </button>
        <button class="btn btn-outline-secondary" onclick="printReport()">
            <i class="fas fa-print"></i> Print
        </button>
    </div>
    
</div>

<!-- Component-specific JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image carousel counter update
    const carousel = document.getElementById('propertyCarousel');
    if (carousel) {
        carousel.addEventListener('slide.bs.carousel', function(event) {
            const counter = document.getElementById('current-image');
            if (counter) {
                counter.textContent = event.to + 1;
            }
        });
    }
    
    // Expand/collapse animation
    const expandToggles = document.querySelectorAll('.expand-toggle');
    expandToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const icon = this.querySelector('i');
            const target = document.querySelector(this.dataset.bsTarget);
            
            if (target.classList.contains('show')) {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            } else {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            }
        });
    });
    
    // Touch gestures for image carousel
    if (carousel && typeof Hammer !== 'undefined') {
        const hammer = new Hammer(carousel);
        hammer.on('swipeleft', function() {
            bootstrap.Carousel.getInstance(carousel).next();
        });
        hammer.on('swiperight', function() {
            bootstrap.Carousel.getInstance(carousel).prev();
        });
    }
});

// Global functions for action buttons
function openFullscreenMap() {
    const mapImage = document.querySelector('.map-image');
    if (mapImage && mapImage.requestFullscreen) {
        mapImage.requestFullscreen();
    }
}

function shareReport() {
    if (navigator.share) {
        navigator.share({
            title: 'Property Report',
            text: 'Check out this property report',
            url: window.location.href
        });
    } else {
        // Fallback to share modal
        const shareModal = document.getElementById('shareModal');
        if (shareModal) {
            new bootstrap.Modal(shareModal).show();
        }
    }
}

function downloadReport() {
    // Trigger PDF download
    const reportId = window.MobileReportConfig?.reportId;
    if (reportId) {
        window.open(`${window.MobileReportConfig.baseUrl}api/reports/download/${reportId}`, '_blank');
    }
}

function printReport() {
    window.print();
}
</script>

<!-- Accessibility enhancements -->
<div class="sr-only" aria-live="polite" id="overview-announcements"></div> 