<?php
/**
 * Property Overview Component
 * 
 * Mobile-optimized property overview with hero image, 
 * key details grid, and interactive map
 */

// Extract property data safely
$address = isset($property->PropertyProfile->SiteAddress) ? $property->PropertyProfile->SiteAddress : 'Unknown Address';
$city = isset($property->PropertyProfile->SiteCity) ? $property->PropertyProfile->SiteCity : '';
$state = isset($property->PropertyProfile->SiteState) ? $property->PropertyProfile->SiteState : '';
$zip = isset($property->PropertyProfile->SiteZip) ? $property->PropertyProfile->SiteZip : '';
$price = isset($property->PropertyProfile->LastSalePrice) ? $property->PropertyProfile->LastSalePrice : 'N/A';
$bedrooms = isset($property->PropertyProfile->Bedrooms) ? $property->PropertyProfile->Bedrooms : 'N/A';
$bathrooms = isset($property->PropertyProfile->Bathrooms) ? $property->PropertyProfile->Bathrooms : 'N/A';
$sqft = isset($property->PropertyProfile->BuildingArea) ? number_format($property->PropertyProfile->BuildingArea) : 'N/A';
$year_built = isset($property->PropertyProfile->YearBuilt) ? $property->PropertyProfile->YearBuilt : 'N/A';
$lot_size = isset($property->PropertyProfile->LotSize) ? $property->PropertyProfile->LotSize : 'N/A';

// Format price
$formatted_price = 'N/A';
if ($price !== 'N/A' && is_numeric($price)) {
    $formatted_price = '$' . number_format($price);
}

// Property image URL (fallback to placeholder)
$property_image = isset($property->PropertyProfile->PropertyImage) ? 
    $property->PropertyProfile->PropertyImage : 
    base_url('assets/reports/mobile/images/property-placeholder.jpg');

// Map URL
$latitude = isset($property->PropertyProfile->Latitude) ? $property->PropertyProfile->Latitude : '';
$longitude = isset($property->PropertyProfile->Longitude) ? $property->PropertyProfile->Longitude : '';
$theme_color = str_replace('#', '', $theme);

$map_url = '';
if ($latitude && $longitude) {
    $map_url = "https://maps.googleapis.com/maps/api/staticmap?" .
               "size=800x400&zoom=15&maptype=roadmap&" .
               "center={$latitude},{$longitude}&" .
               "markers=color:0x{$theme_color}|{$latitude},{$longitude}&" .
               "key=" . (getenv('GOOGLE_MAPS_API_KEY') ?: 'demo_key');
}
?>

<div class="property-overview">
    
    <!-- Hero Section -->
    <div class="hero-section">
        <?php if ($property_image): ?>
            <img src="<?php echo $property_image; ?>" 
                 alt="Property at <?php echo $address; ?>" 
                 class="hero-image"
                 onerror="this.src='<?php echo base_url('assets/reports/mobile/images/property-placeholder.jpg'); ?>'">
        <?php else: ?>
            <div class="hero-placeholder">
                <i class="fas fa-home"></i>
            </div>
        <?php endif; ?>
        
        <div class="hero-overlay">
            <h2 class="property-address"><?php echo htmlspecialchars($address); ?></h2>
            <?php if ($city || $state || $zip): ?>
                <p class="property-location">
                    <?php echo htmlspecialchars($city . ($city && ($state || $zip) ? ', ' : '') . $state . ($state && $zip ? ' ' : '') . $zip); ?>
                </p>
            <?php endif; ?>
            <div class="property-price"><?php echo $formatted_price; ?></div>
        </div>
    </div>
    
    <!-- Property Details Grid -->
    <div class="property-details-grid">
        
        <div class="detail-card">
            <i class="fas fa-bed"></i>
            <span class="detail-label">Bedrooms</span>
            <span class="detail-value"><?php echo $bedrooms; ?></span>
        </div>
        
        <div class="detail-card">
            <i class="fas fa-bath"></i>
            <span class="detail-label">Bathrooms</span>
            <span class="detail-value"><?php echo $bathrooms; ?></span>
        </div>
        
        <div class="detail-card">
            <i class="fas fa-ruler-combined"></i>
            <span class="detail-label">Square Feet</span>
            <span class="detail-value"><?php echo $sqft; ?></span>
        </div>
        
        <div class="detail-card">
            <i class="fas fa-calendar-alt"></i>
            <span class="detail-label">Year Built</span>
            <span class="detail-value"><?php echo $year_built; ?></span>
        </div>
        
        <?php if ($lot_size !== 'N/A'): ?>
        <div class="detail-card">
            <i class="fas fa-expand-arrows-alt"></i>
            <span class="detail-label">Lot Size</span>
            <span class="detail-value"><?php echo $lot_size; ?> acres</span>
        </div>
        <?php endif; ?>
        
        <?php if (isset($property->PropertyProfile->PropertyType)): ?>
        <div class="detail-card">
            <i class="fas fa-home"></i>
            <span class="detail-label">Property Type</span>
            <span class="detail-value"><?php echo htmlspecialchars($property->PropertyProfile->PropertyType); ?></span>
        </div>
        <?php endif; ?>
        
    </div>
    
    <!-- Interactive Map -->
    <?php if ($map_url): ?>
    <div class="map-section">
        <h3 class="section-title">
            <i class="fas fa-map-marker-alt"></i>
            Location
        </h3>
        
        <div class="map-container">
            <img src="<?php echo $map_url; ?>" 
                 alt="Property location map" 
                 class="map-image"
                 onclick="openFullscreenMap()">
            
            <div class="map-overlay">
                <button class="map-fullscreen-btn" 
                        onclick="openFullscreenMap()" 
                        aria-label="View full map">
                    <i class="fas fa-expand"></i>
                    <span>Full Map</span>
                </button>
            </div>
        </div>
        
        <!-- Map Actions -->
        <div class="map-actions" style="margin-top: 1rem; display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <?php if ($latitude && $longitude): ?>
            <a href="https://www.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>" 
               target="_blank" 
               class="map-action-btn">
                <i class="fas fa-external-link-alt"></i>
                Google Maps
            </a>
            <a href="https://maps.apple.com/?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>" 
               target="_blank" 
               class="map-action-btn">
                <i class="fas fa-map"></i>
                Apple Maps
            </a>
            <a href="https://www.waze.com/ul?ll=<?php echo $latitude; ?>%2C<?php echo $longitude; ?>&navigate=yes" 
               target="_blank" 
               class="map-action-btn">
                <i class="fas fa-route"></i>
                Waze
            </a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Property Description -->
    <?php if (isset($property->PropertyProfile->Description) && !empty($property->PropertyProfile->Description)): ?>
    <div class="description-section">
        <h3 class="section-title">
            <i class="fas fa-align-left"></i>
            Property Description
        </h3>
        
        <div class="description-content">
            <p><?php echo nl2br(htmlspecialchars($property->PropertyProfile->Description)); ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Additional Property Features -->
    <?php if (isset($property->PropertyProfile->Features) || isset($property->PropertyProfile->Amenities)): ?>
    <div class="features-section">
        <h3 class="section-title">
            <i class="fas fa-star"></i>
            Features & Amenities
        </h3>
        
        <div class="features-grid">
            <?php 
            $features = [];
            if (isset($property->PropertyProfile->Features)) {
                $features = array_merge($features, explode(',', $property->PropertyProfile->Features));
            }
            if (isset($property->PropertyProfile->Amenities)) {
                $features = array_merge($features, explode(',', $property->PropertyProfile->Amenities));
            }
            
            foreach (array_slice($features, 0, 8) as $feature): // Limit to 8 features
                $feature = trim($feature);
                if (!empty($feature)):
            ?>
            <div class="feature-item">
                <i class="fas fa-check-circle"></i>
                <span><?php echo htmlspecialchars($feature); ?></span>
            </div>
            <?php 
                endif;
            endforeach; 
            ?>
        </div>
    </div>
    <?php endif; ?>
    
</div>

<!-- Additional CSS for map actions -->
<style>
.map-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: var(--theme-color);
    color: white;
    text-decoration: none;
    border-radius: var(--radius);
    font-size: 0.875rem;
    font-weight: 500;
    transition: all var(--transition);
}

.map-action-btn:hover {
    background: var(--theme-color-dark);
    transform: translateY(-1px);
    color: white;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.75rem;
    margin-top: 1rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: var(--card-background);
    border: 1px solid var(--border-light);
    border-radius: var(--radius);
    font-size: 0.875rem;
}

.feature-item i {
    color: var(--theme-color);
    font-size: 1rem;
}

.description-content {
    background: var(--card-background);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    margin-top: 1rem;
    line-height: 1.6;
}

.property-location {
    margin: 0.5rem 0;
    opacity: 0.9;
    font-size: 0.9rem;
}

@media (max-width: 480px) {
    .map-actions {
        justify-content: center;
    }
    
    .map-action-btn {
        flex: 1;
        justify-content: center;
        min-width: 0;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// Enhanced fullscreen map function
function openFullscreenMap() {
    const mapImage = document.querySelector('.map-image');
    
    if (mapImage) {
        // Try to use fullscreen API first
        if (mapImage.requestFullscreen) {
            mapImage.requestFullscreen().catch(() => {
                // Fallback: open in new window
                openMapInNewWindow();
            });
        } else if (mapImage.webkitRequestFullscreen) {
            mapImage.webkitRequestFullscreen();
        } else if (mapImage.msRequestFullscreen) {
            mapImage.msRequestFullscreen();
        } else {
            // Fallback for browsers without fullscreen support
            openMapInNewWindow();
        }
    }
}

function openMapInNewWindow() {
    <?php if ($latitude && $longitude): ?>
    const mapUrl = `https://www.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&z=15`;
    window.open(mapUrl, '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes');
    <?php endif; ?>
}
</script>