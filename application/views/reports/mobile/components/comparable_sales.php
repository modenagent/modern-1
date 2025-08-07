<?php
/**
 * Comparable Sales Component
 * 
 * Interactive charts and comparable property listings
 * optimized for mobile touch interaction
 */

// Safely extract comparable sales data
$comparables = isset($areaSalesAnalysis['comparable']) ? $areaSalesAnalysis['comparable'] : [];
$subject_price = isset($property->PropertyProfile->LastSalePrice) ? 
    (int)str_replace(['$', ','], '', $property->PropertyProfile->LastSalePrice) : 0;
?>

<div class="comparables-section">
    
    <!-- Section Header -->
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-chart-bar"></i>
            Comparable Sales Analysis
        </h2>
        <p class="section-subtitle">
            Recent sales of similar properties in the area
        </p>
    </div>
    
    <!-- Interactive Price Chart -->
    <?php if ($interactive_charts && !empty($comparables)): ?>
    <div class="chart-container">
        <h3 class="chart-title">Sale Price Comparison</h3>
        <div class="chart-hint">
            <i class="fas fa-hand-pointer"></i>
            Tap bars to highlight
        </div>
        <div class="chart-wrapper">
            <canvas id="priceComparisonChart" 
                    class="chart-canvas"
                    aria-label="Price comparison chart showing subject property vs comparable sales">
            </canvas>
            <div class="chart-loading">Loading chart...</div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Market Statistics Summary -->
    <?php if (!empty($comparables)): ?>
    <div class="stats-summary">
        <h3 class="stats-title">Market Statistics</h3>
        <div class="stats-grid">
            
            <?php
            // Calculate statistics
            $prices = array_column($comparables, 'PriceRate');
            $prices = array_filter($prices, 'is_numeric');
            
            if (!empty($prices)):
                $min_price = min($prices);
                $max_price = max($prices);
                $avg_price = array_sum($prices) / count($prices);
                
                // Calculate median
                sort($prices);
                $count = count($prices);
                $median_price = $count % 2 == 0 ? 
                    ($prices[$count/2 - 1] + $prices[$count/2]) / 2 : 
                    $prices[floor($count/2)];
            ?>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Lowest Sale</div>
                    <div class="stat-value">$<?php echo number_format($min_price); ?></div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-arrow-up"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Highest Sale</div>
                    <div class="stat-value">$<?php echo number_format($max_price); ?></div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Average Sale</div>
                    <div class="stat-value">$<?php echo number_format($avg_price); ?></div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Median Sale</div>
                    <div class="stat-value">$<?php echo number_format($median_price); ?></div>
                </div>
            </div>
            
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Comparable Properties List -->
    <?php if (!empty($comparables)): ?>
    <div class="comparables-list">
        <h3 class="list-title">
            <i class="fas fa-list"></i>
            Comparable Properties (<?php echo count($comparables); ?>)
        </h3>
        
        <?php foreach($comparables as $index => $comp): ?>
        <div class="comparable-card" 
             data-index="<?php echo $index; ?>"
             onclick="highlightComparable(<?php echo $index + 1; ?>)"
             tabindex="0"
             role="button"
             aria-label="View details for comparable property at <?php echo htmlspecialchars($comp['Address'] ?? 'Unknown Address'); ?>">
            
            <div class="comp-header">
                <h4 class="comp-address">
                    <?php echo htmlspecialchars($comp['Address'] ?? 'Unknown Address'); ?>
                </h4>
                <?php if (isset($comp['Distance'])): ?>
                <span class="comp-distance">
                    <?php echo number_format($comp['Distance'], 1); ?> mi
                </span>
                <?php endif; ?>
            </div>
            
            <div class="comp-main-info">
                <div class="comp-price">
                    <?php 
                    $price = isset($comp['PriceRate']) ? $comp['PriceRate'] : (isset($comp['SalesPrice']) ? $comp['SalesPrice'] : 0);
                    echo '$' . number_format($price);
                    ?>
                </div>
                
                <div class="comp-specs">
                    <?php if (isset($comp['Beds'])): ?>
                    <span class="comp-spec">
                        <i class="fas fa-bed"></i>
                        <?php echo $comp['Beds']; ?> bed<?php echo $comp['Beds'] != 1 ? 's' : ''; ?>
                    </span>
                    <?php endif; ?>
                    
                    <?php if (isset($comp['Baths'])): ?>
                    <span class="comp-spec">
                        <i class="fas fa-bath"></i>
                        <?php echo $comp['Baths']; ?> bath<?php echo $comp['Baths'] != 1 ? 's' : ''; ?>
                    </span>
                    <?php endif; ?>
                    
                    <?php if (isset($comp['SquareFeet']) || isset($comp['BuildingArea'])): ?>
                    <span class="comp-spec">
                        <i class="fas fa-ruler-combined"></i>
                        <?php 
                        $sqft = isset($comp['SquareFeet']) ? $comp['SquareFeet'] : $comp['BuildingArea'];
                        echo number_format($sqft); 
                        ?> sq ft
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="comp-secondary-info">
                <?php if (isset($comp['Date']) || isset($comp['SalesDate'])): ?>
                <div class="comp-date">
                    <i class="fas fa-calendar-alt"></i>
                    Sold: <?php 
                    $date = isset($comp['Date']) ? $comp['Date'] : $comp['SalesDate'];
                    echo date('M j, Y', strtotime($date));
                    ?>
                </div>
                <?php endif; ?>
                
                <?php if (isset($comp['PricePerSQFT']) || (isset($price) && isset($sqft) && $sqft > 0)): ?>
                <div class="comp-psf">
                    <i class="fas fa-dollar-sign"></i>
                    <?php 
                    $psf = isset($comp['PricePerSQFT']) ? $comp['PricePerSQFT'] : ($price / $sqft);
                    echo '$' . number_format($psf, 0);
                    ?>/sq ft
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Comparison Indicators -->
            <div class="comp-indicators">
                <?php if ($subject_price > 0 && isset($price)): ?>
                    <?php 
                    $price_diff = (($price - $subject_price) / $subject_price) * 100;
                    $indicator_class = $price_diff > 5 ? 'higher' : ($price_diff < -5 ? 'lower' : 'similar');
                    ?>
                    <span class="price-indicator <?php echo $indicator_class; ?>">
                        <?php if ($price_diff > 5): ?>
                            <i class="fas fa-arrow-up"></i> +<?php echo number_format($price_diff, 1); ?>%
                        <?php elseif ($price_diff < -5): ?>
                            <i class="fas fa-arrow-down"></i> <?php echo number_format($price_diff, 1); ?>%
                        <?php else: ?>
                            <i class="fas fa-equals"></i> Similar
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>
            
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    
    <!-- No Comparables Message -->
    <div class="no-data-message">
        <div class="no-data-icon">
            <i class="fas fa-search"></i>
        </div>
        <h3>No Comparable Sales Found</h3>
        <p>There are currently no recent comparable sales available for this property area.</p>
    </div>
    
    <?php endif; ?>
    
</div>

<!-- Component-specific CSS -->
<style>
.section-header {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.section-subtitle {
    color: var(--text-secondary);
    font-size: var(--font-size-sm);
    margin: var(--spacing-sm) 0 0;
}

.stats-summary {
    margin-bottom: var(--spacing-xl);
}

.stats-title {
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: var(--spacing-lg);
    text-align: center;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--spacing-md);
}

.stat-card {
    background: var(--card-background);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    transition: all var(--transition);
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    border-color: var(--theme-color);
}

.stat-icon {
    width: 3rem;
    height: 3rem;
    background: var(--theme-color-light);
    color: var(--theme-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.stat-content {
    flex: 1;
}

.stat-label {
    font-size: var(--font-size-sm);
    color: var(--text-secondary);
    font-weight: 500;
    margin-bottom: var(--spacing-xs);
}

.stat-value {
    font-size: var(--font-size-lg);
    font-weight: 700;
    color: var(--text-primary);
}

.list-title {
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: var(--spacing-lg);
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.comp-main-info {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--spacing-md);
    gap: var(--spacing-md);
}

.comp-specs {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-xs);
    align-items: flex-end;
}

.comp-spec {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    color: var(--text-secondary);
    font-size: var(--font-size-sm);
    font-weight: 500;
}

.comp-spec i {
    color: var(--theme-color);
    width: 1rem;
    text-align: center;
}

.comp-secondary-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-sm);
    gap: var(--spacing-sm);
}

.comp-date, .comp-psf {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    color: var(--text-muted);
    font-size: var(--font-size-sm);
}

.comp-indicators {
    display: flex;
    justify-content: flex-end;
}

.price-indicator {
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--radius);
    font-size: var(--font-size-xs);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.price-indicator.higher {
    background: #fef2f2;
    color: #dc2626;
}

.price-indicator.lower {
    background: #f0fdf4;
    color: #16a34a;
}

.price-indicator.similar {
    background: var(--theme-color-light);
    color: var(--theme-color);
}

.no-data-message {
    text-align: center;
    padding: var(--spacing-xxl);
    background: var(--card-background);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
}

.no-data-icon {
    width: 4rem;
    height: 4rem;
    background: var(--theme-color-light);
    color: var(--theme-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto var(--spacing-lg);
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .comp-main-info {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-sm);
    }
    
    .comp-specs {
        align-items: flex-start;
        flex-direction: row;
        flex-wrap: wrap;
    }
    
    .comp-secondary-info {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-xs);
    }
}

@media (min-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}
</style>

<?php if ($interactive_charts && !empty($comparables)): ?>
<script>
// Initialize price comparison chart when this section loads
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('priceComparisonChart');
    if (ctx && typeof Chart !== 'undefined' && window.chartData) {
        const chart = new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: window.chartData.price,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
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
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        window.highlightComparable(index);
                    }
                }
            }
        });
        
        // Hide loading indicator
        const loading = ctx.parentElement.querySelector('.chart-loading');
        if (loading) {
            loading.style.display = 'none';
        }
        
        // Store chart reference for later use
        window.priceChart = chart;
    }
});
</script>
<?php endif; ?>