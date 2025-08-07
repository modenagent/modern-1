<?php
/**
 * Footer Component
 * 
 * Mobile-optimized footer with agent information,
 * sharing options, and report metadata
 */

// Get user/agent information
$agent_name = isset($user['fullname']) ? $user['fullname'] : 'Modern Agent';
$agent_email = isset($user['email']) ? $user['email'] : '';
$agent_phone = isset($user['phone']) ? $user['phone'] : '';
$company_name = isset($user['companyname']) ? $user['companyname'] : '';
$company_logo = isset($user['company_logo']) ? $user['company_logo'] : '';

// Report metadata
$generated_at = isset($generated_at) ? $generated_at : date('Y-m-d H:i:s');
$report_type = isset($presentation) ? ucfirst($presentation) : 'Property';
?>

<div class="report-footer">
    
    <!-- Agent Information Card -->
    <div class="agent-card">
        <div class="agent-header">
            <?php if ($company_logo): ?>
            <img src="<?php echo $company_logo; ?>" 
                 alt="<?php echo htmlspecialchars($company_name ?: $agent_name); ?>" 
                 class="company-logo"
                 onerror="this.style.display='none'">
            <?php endif; ?>
            
            <div class="agent-info">
                <h3 class="agent-name"><?php echo htmlspecialchars($agent_name); ?></h3>
                <?php if ($company_name): ?>
                <p class="company-name"><?php echo htmlspecialchars($company_name); ?></p>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Contact Actions -->
        <div class="contact-actions">
            <?php if ($agent_phone): ?>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', $agent_phone); ?>" 
               class="contact-btn phone-btn">
                <i class="fas fa-phone"></i>
                <span><?php echo htmlspecialchars($agent_phone); ?></span>
            </a>
            <?php endif; ?>
            
            <?php if ($agent_email): ?>
            <a href="mailto:<?php echo htmlspecialchars($agent_email); ?>?subject=Property Report Inquiry" 
               class="contact-btn email-btn">
                <i class="fas fa-envelope"></i>
                <span><?php echo htmlspecialchars($agent_email); ?></span>
            </a>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Report Actions -->
    <div class="report-actions">
        <h4 class="actions-title">
            <i class="fas fa-share-alt"></i>
            Share This Report
        </h4>
        
        <div class="action-buttons">
            <button class="action-btn" onclick="shareReport()" title="Share report">
                <i class="fas fa-share"></i>
                <span>Share</span>
            </button>
            
            <button class="action-btn" onclick="window.print()" title="Print report">
                <i class="fas fa-print"></i>
                <span>Print</span>
            </button>
            
            <button class="action-btn" onclick="downloadReport()" title="Download report">
                <i class="fas fa-download"></i>
                <span>Download</span>
            </button>
            
            <button class="action-btn" onclick="saveToFavorites()" title="Save to favorites">
                <i class="fas fa-heart"></i>
                <span>Save</span>
            </button>
        </div>
    </div>
    
    <!-- Report Metadata -->
    <div class="report-metadata">
        <div class="metadata-grid">
            <div class="metadata-item">
                <i class="fas fa-file-alt"></i>
                <span class="metadata-label">Report Type:</span>
                <span class="metadata-value"><?php echo $report_type; ?> Report</span>
            </div>
            
            <div class="metadata-item">
                <i class="fas fa-calendar-alt"></i>
                <span class="metadata-label">Generated:</span>
                <span class="metadata-value"><?php echo date('M j, Y', strtotime($generated_at)); ?></span>
            </div>
            
            <div class="metadata-item">
                <i class="fas fa-mobile-alt"></i>
                <span class="metadata-label">Version:</span>
                <span class="metadata-value">Mobile Optimized</span>
            </div>
            
            <?php if (isset($report_id)): ?>
            <div class="metadata-item">
                <i class="fas fa-hashtag"></i>
                <span class="metadata-label">Report ID:</span>
                <span class="metadata-value"><?php echo $report_id; ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- QR Code for Easy Sharing -->
    <div class="qr-section">
        <div class="qr-header">
            <i class="fas fa-qrcode"></i>
            <span>Scan to Share</span>
        </div>
        <div class="qr-container">
            <canvas id="qr-canvas" width="120" height="120"></canvas>
            <p class="qr-text">Scan with your phone to access this report</p>
        </div>
    </div>
    
    <!-- Footer Branding -->
    <div class="footer-branding">
        <div class="powered-by">
            <span>Powered by</span>
            <strong>Modern Agent</strong>
        </div>
        <div class="footer-links">
            <a href="#" onclick="showPrivacyPolicy()">Privacy</a>
            <a href="#" onclick="showTerms()">Terms</a>
            <a href="#" onclick="showSupport()">Support</a>
        </div>
    </div>
    
</div>

<style>
.report-footer {
    background: var(--card-background);
    border-top: 1px solid var(--border-color);
    padding: var(--spacing-xl) var(--spacing-md);
    margin-top: var(--spacing-xxl);
}

/* Agent Card */
.agent-card {
    background: var(--background);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    margin-bottom: var(--spacing-xl);
}

.agent-header {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-lg);
}

.company-logo {
    width: 3rem;
    height: 3rem;
    object-fit: contain;
    border-radius: var(--radius);
    background: white;
    padding: var(--spacing-xs);
    border: 1px solid var(--border-light);
}

.agent-info {
    flex: 1;
}

.agent-name {
    margin: 0;
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--text-primary);
}

.company-name {
    margin: var(--spacing-xs) 0 0;
    color: var(--text-secondary);
    font-size: var(--font-size-sm);
}

.contact-actions {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-sm);
}

.contact-btn {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-md);
    background: var(--theme-color);
    color: white;
    text-decoration: none;
    border-radius: var(--radius);
    font-weight: 500;
    transition: all var(--transition);
    font-size: var(--font-size-sm);
}

.contact-btn:hover {
    background: var(--theme-color-dark);
    transform: translateY(-1px);
    color: white;
}

.contact-btn i {
    width: 1.25rem;
    text-align: center;
}

/* Report Actions */
.report-actions {
    margin-bottom: var(--spacing-xl);
}

.actions-title {
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: var(--spacing-lg);
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.action-buttons {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--spacing-sm);
}

.action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--spacing-xs);
    padding: var(--spacing-lg);
    background: var(--background);
    border: 1px solid var(--border-light);
    border-radius: var(--radius);
    color: var(--text-primary);
    font-size: var(--font-size-sm);
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition);
}

.action-btn:hover {
    background: var(--theme-color-light);
    border-color: var(--theme-color);
    color: var(--theme-color);
    transform: translateY(-2px);
}

.action-btn i {
    font-size: 1.25rem;
    color: var(--theme-color);
}

/* Metadata */
.report-metadata {
    background: var(--background);
    border: 1px solid var(--border-light);
    border-radius: var(--radius);
    padding: var(--spacing-lg);
    margin-bottom: var(--spacing-xl);
}

.metadata-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--spacing-md);
}

.metadata-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    font-size: var(--font-size-sm);
}

.metadata-item i {
    color: var(--theme-color);
    width: 1.25rem;
    text-align: center;
}

.metadata-label {
    color: var(--text-secondary);
    font-weight: 500;
}

.metadata-value {
    color: var(--text-primary);
    font-weight: 600;
    margin-left: auto;
}

/* QR Code Section */
.qr-section {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.qr-header {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-sm);
    margin-bottom: var(--spacing-lg);
    font-weight: 600;
    color: var(--text-primary);
}

.qr-container {
    background: white;
    border: 1px solid var(--border-light);
    border-radius: var(--radius);
    padding: var(--spacing-lg);
    display: inline-block;
}

#qr-canvas {
    display: block;
    margin: 0 auto var(--spacing-md);
    border: 1px solid var(--border-light);
}

.qr-text {
    margin: 0;
    color: var(--text-secondary);
    font-size: var(--font-size-xs);
}

/* Footer Branding */
.footer-branding {
    text-align: center;
    padding-top: var(--spacing-lg);
    border-top: 1px solid var(--border-light);
}

.powered-by {
    color: var(--text-secondary);
    font-size: var(--font-size-sm);
    margin-bottom: var(--spacing-sm);
}

.powered-by strong {
    color: var(--theme-color);
    font-weight: 700;
}

.footer-links {
    display: flex;
    justify-content: center;
    gap: var(--spacing-lg);
}

.footer-links a {
    color: var(--text-secondary);
    text-decoration: none;
    font-size: var(--font-size-sm);
    transition: color var(--transition);
}

.footer-links a:hover {
    color: var(--theme-color);
}

/* Responsive Design */
@media (min-width: 480px) {
    .contact-actions {
        flex-direction: row;
    }
    
    .action-buttons {
        grid-template-columns: repeat(4, 1fr);
    }
    
    .metadata-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 320px) {
    .agent-header {
        flex-direction: column;
        text-align: center;
    }
    
    .metadata-item {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-xs);
    }
    
    .metadata-value {
        margin-left: 0;
    }
}
</style>

<script>
// Generate QR Code for current URL
function generateQRCode() {
    const canvas = document.getElementById('qr-canvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const url = window.location.href;
    
    // Simple QR code placeholder (you can integrate a real QR code library)
    ctx.fillStyle = '#333';
    ctx.fillRect(0, 0, 120, 120);
    
    // Add white squares to simulate QR pattern
    ctx.fillStyle = '#fff';
    for (let i = 0; i < 12; i++) {
        for (let j = 0; j < 12; j++) {
            if (Math.random() > 0.5) {
                ctx.fillRect(i * 10, j * 10, 8, 8);
            }
        }
    }
    
    // Add corner markers
    ctx.fillStyle = '#333';
    ctx.fillRect(0, 0, 30, 30);
    ctx.fillRect(90, 0, 30, 30);
    ctx.fillRect(0, 90, 30, 30);
    
    ctx.fillStyle = '#fff';
    ctx.fillRect(5, 5, 20, 20);
    ctx.fillRect(95, 5, 20, 20);
    ctx.fillRect(5, 95, 20, 20);
}

// Action functions
function downloadReport() {
    // Try to trigger PDF download
    window.print();
}

function saveToFavorites() {
    if (localStorage) {
        const reportData = {
            url: window.location.href,
            title: document.title,
            date: new Date().toISOString()
        };
        
        let favorites = JSON.parse(localStorage.getItem('favoriteReports') || '[]');
        favorites.push(reportData);
        localStorage.setItem('favoriteReports', JSON.stringify(favorites));
        
        alert('Report saved to favorites!');
    }
}

function showPrivacyPolicy() {
    alert('Privacy Policy: This report contains confidential property information. Please handle responsibly.');
}

function showTerms() {
    alert('Terms of Use: This report is for informational purposes only and should not be considered as professional advice.');
}

function showSupport() {
    <?php if ($agent_email): ?>
    window.location.href = 'mailto:<?php echo htmlspecialchars($agent_email); ?>?subject=Report Support Request';
    <?php else: ?>
    alert('For support, please contact your real estate agent.');
    <?php endif; ?>
}

// Initialize QR code when page loads
document.addEventListener('DOMContentLoaded', generateQRCode);

// Track footer interactions
document.addEventListener('click', function(e) {
    if (e.target.closest('.contact-btn')) {
        if (window.mobileReport) {
            window.mobileReport.trackInteraction('contact_clicked', {
                type: e.target.closest('.contact-btn').classList.contains('phone-btn') ? 'phone' : 'email'
            });
        }
    }
    
    if (e.target.closest('.action-btn')) {
        if (window.mobileReport) {
            const actionText = e.target.closest('.action-btn').querySelector('span')?.textContent || 'unknown';
            window.mobileReport.trackInteraction('action_clicked', {
                action: actionText.toLowerCase()
            });
        }
    }
});
</script>