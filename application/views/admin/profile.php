<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Generate CSRF token
$csrf_token = hash('sha256', uniqid() . time());

// Template data for admin base
$template_data = array(
    'title' => 'User Profile',
    'csrf_token' => $csrf_token,
    'breadcrumbs' => array(
        array('title' => 'Dashboard', 'url' => site_url('admin/dashboard')),
        array('title' => 'User Profile', 'url' => '')
    ),
    'additional_css' => array(),
    'additional_js' => array()
);

// Helper function for role-specific back URL
function getRoleBackUrl($roleId) {
    switch ($roleId) {
        case '1': return site_url('admin/manage_admin_user');
        case '2': return site_url('admin/manage_companies');
        case '3': return site_url('admin/manage_sales_reps');
        case '4': return site_url('admin/manage_user');
        default: return site_url('admin/dashboard');
    }
}

// Secure user data with proper escaping
$safe_user = array(
    'first_name' => htmlspecialchars($users->first_name ?? '', ENT_QUOTES, 'UTF-8'),
    'last_name' => htmlspecialchars($users->last_name ?? '', ENT_QUOTES, 'UTF-8'),
    'email' => htmlspecialchars($users->email ?? '', ENT_QUOTES, 'UTF-8'),
    'phone' => htmlspecialchars($users->phone ?? '', ENT_QUOTES, 'UTF-8'),
    'user_name' => htmlspecialchars($users->user_name ?? '', ENT_QUOTES, 'UTF-8'),
    'license_no' => htmlspecialchars($users->license_no ?? '', ENT_QUOTES, 'UTF-8'),
    'company_name' => htmlspecialchars($users->company_name ?? '', ENT_QUOTES, 'UTF-8'),
    'company_add' => htmlspecialchars($users->company_add ?? '', ENT_QUOTES, 'UTF-8'),
    'role_id_fk' => (int)($users->role_id_fk ?? 0),
    'is_active' => $users->is_active ?? 'N',
    'user_id_pk' => (int)($users->user_id_pk ?? 0)
);

// Profile image handling with validation
$profile_image = 'assets/img/user.jpg'; // Default image
if (!empty($users->profile_image) && file_exists($users->profile_image)) {
    $profile_image = htmlspecialchars($users->profile_image, ENT_QUOTES, 'UTF-8');
}

// Capture the profile content
ob_start();
?>

<div class="admin-page">
    <!-- Page Header -->
    <header class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">
                <i class="fa fa-user" aria-hidden="true"></i>
                User Profile
            </h1>
            <p class="page-description">View detailed user information and subscription status</p>
        </div>
        <div class="page-actions">
            <a href="<?php echo getRoleBackUrl($safe_user['role_id_fk']); ?>" class="btn btn-secondary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back to List
            </a>
            <a href="<?php echo site_url('admin/edit_user/' . $safe_user['user_id_pk']); ?>" class="btn btn-primary">
                <i class="fa fa-edit" aria-hidden="true"></i>
                Edit Profile
            </a>
        </div>
    </header>

    <!-- Profile Content -->
    <section class="content-section">
        <div class="profile-container">
            <!-- Profile Sidebar -->
            <aside class="profile-sidebar" role="complementary">
                <div class="profile-card">
                    <div class="profile-avatar">
                        <img src="<?php echo base_url($profile_image); ?>" 
                             alt="Profile picture of <?php echo $safe_user['first_name'] . ' ' . $safe_user['last_name']; ?>"
                             class="avatar-img"
                             loading="lazy">
                        
                        <!-- Image Upload Button (if editable) -->
                        <button type="button" class="avatar-edit-btn" aria-label="Change profile picture">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </button>
                    </div>
                    
                    <div class="profile-identity">
                        <h2 class="profile-name">
                            <?php echo ucfirst($safe_user['first_name']) . ' ' . ucfirst($safe_user['last_name']); ?>
                        </h2>
                        <p class="profile-username">@<?php echo $safe_user['user_name']; ?></p>
                        
                        <div class="profile-status">
                            <?php if ($safe_user['is_active'] === 'Y'): ?>
                                <span class="status-badge status-active" aria-label="User is active">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                    Active
                                </span>
                            <?php else: ?>
                                <span class="status-badge status-inactive" aria-label="User is inactive">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    Inactive
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Profile Details -->
            <main class="profile-main" role="main">
                <!-- Personal Information -->
                <section class="info-section" aria-labelledby="personal-info-heading">
                    <header class="section-header">
                        <h3 id="personal-info-heading" class="section-title">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            Personal Information
                        </h3>
                    </header>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <dt class="info-label">Full Name</dt>
                            <dd class="info-value">
                                <?php echo ucfirst($safe_user['first_name']) . ' ' . ucfirst($safe_user['last_name']); ?>
                            </dd>
                        </div>
                        
                        <div class="info-item">
                            <dt class="info-label">Email Address</dt>
                            <dd class="info-value">
                                <a href="mailto:<?php echo $safe_user['email']; ?>" 
                                   class="email-link"
                                   aria-label="Send email to <?php echo $safe_user['email']; ?>">
                                    <?php echo $safe_user['email']; ?>
                                </a>
                            </dd>
                        </div>
                        
                        <div class="info-item">
                            <dt class="info-label">Phone Number</dt>
                            <dd class="info-value">
                                <?php if (!empty($safe_user['phone'])): ?>
                                    <a href="tel:<?php echo $safe_user['phone']; ?>" 
                                       class="phone-link"
                                       aria-label="Call <?php echo $safe_user['phone']; ?>">
                                        <?php echo $safe_user['phone']; ?>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">Not provided</span>
                                <?php endif; ?>
                            </dd>
                        </div>
                        
                        <div class="info-item">
                            <dt class="info-label">Username</dt>
                            <dd class="info-value"><?php echo $safe_user['user_name']; ?></dd>
                        </div>
                    </div>
                </section>

                <!-- Professional Information (if not admin) -->
                <?php if ($safe_user['role_id_fk'] != 1): ?>
                <section class="info-section" aria-labelledby="professional-info-heading">
                    <header class="section-header">
                        <h3 id="professional-info-heading" class="section-title">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            Professional Information
                        </h3>
                    </header>
                    
                    <div class="info-grid">
                        <?php if (!empty($safe_user['license_no'])): ?>
                        <div class="info-item">
                            <dt class="info-label">License Number</dt>
                            <dd class="info-value"><?php echo $safe_user['license_no']; ?></dd>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($safe_user['company_name'])): ?>
                        <div class="info-item">
                            <dt class="info-label">Company Name</dt>
                            <dd class="info-value"><?php echo $safe_user['company_name']; ?></dd>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($safe_user['company_add'])): ?>
                        <div class="info-item">
                            <dt class="info-label">Company Address</dt>
                            <dd class="info-value"><?php echo $safe_user['company_add']; ?></dd>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Referral Code (if sales rep) -->
                        <?php if ($this->role_lib->is_sales_rep($safe_user['role_id_fk']) && isset($ref_code_obj)): ?>
                        <div class="info-item">
                            <dt class="info-label">Referral Code</dt>
                            <dd class="info-value">
                                <code class="referral-code">
                                    <?php echo htmlspecialchars($ref_code_obj->coupon_code ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                </code>
                                <button type="button" 
                                        class="btn btn-sm btn-secondary copy-btn"
                                        data-copy-text="<?php echo htmlspecialchars($ref_code_obj->coupon_code ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                        aria-label="Copy referral code">
                                    <i class="fa fa-copy" aria-hidden="true"></i>
                                </button>
                            </dd>
                        </div>
                        <?php endif; ?>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Subscription Information -->
                <?php if (isset($subscription_data) && $subscription_data || $this->role_lib->is_manager_l1($safe_user['role_id_fk'])): ?>
                <section class="info-section" aria-labelledby="subscription-info-heading">
                    <header class="section-header">
                        <h3 id="subscription-info-heading" class="section-title">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            Subscription Information
                        </h3>
                    </header>
                    
                    <?php if (isset($subscription_data) && $subscription_data): ?>
                    <div class="subscription-card active">
                        <div class="subscription-header">
                            <h4 class="subscription-plan">
                                <?php echo htmlspecialchars($subscription_data['plan_title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                            </h4>
                            <span class="subscription-badge">Active</span>
                        </div>
                        
                        <div class="subscription-details">
                            <div class="detail-item">
                                <span class="detail-label">Billing Cycle</span>
                                <span class="detail-value">
                                    <?php echo htmlspecialchars($subscription_data['interval'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </div>
                            
                            <div class="detail-item">
                                <span class="detail-label">Current Period Ends</span>
                                <span class="detail-value">
                                    <time datetime="<?php echo date('Y-m-d', $subscription_data['current_period_end'] ?? time()); ?>">
                                        <?php echo date("M d, Y", $subscription_data['current_period_end'] ?? time()); ?>
                                    </time>
                                </span>
                            </div>
                            
                            <div class="detail-item">
                                <span class="detail-label">Auto-Renewal</span>
                                <span class="detail-value">
                                    <?php if (isset($data['cancel_at_period_end']) && $data['cancel_at_period_end']): ?>
                                        <span class="text-warning">
                                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            Disabled
                                        </span>
                                    <?php else: ?>
                                        <span class="text-success">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            Enabled
                                        </span>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <?php elseif ($this->role_lib->is_sales_rep($safe_user['role_id_fk']) || $this->role_lib->is_manager_l1($safe_user['role_id_fk'])): ?>
                    <div class="subscription-card inactive">
                        <div class="subscription-header">
                            <h4 class="subscription-plan">No Active Subscription</h4>
                            <span class="subscription-badge inactive">Inactive</span>
                        </div>
                        
                        <div class="subscription-actions">
                            <p class="subscription-message">
                                This user can subscribe to one of our available monthly plans.
                            </p>
                            <a href="<?php echo site_url('admin/subscribe/' . $safe_user['user_id_pk']); ?>" 
                               class="btn btn-primary subscription-btn">
                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                Set Up Subscription
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </section>
                <?php endif; ?>
            </main>
        </div>
    </section>
</div>

<!-- Profile Image Upload Modal -->
<div class="modal" id="image-upload-modal" aria-hidden="true" role="dialog" aria-labelledby="image-upload-title">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <header class="modal-header">
                <h2 class="modal-title" id="image-upload-title">Change Profile Picture</h2>
                <button type="button" 
                        class="close" 
                        data-modal-close
                        aria-label="Close modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </header>
            
            <form method="post" 
                  action="<?php echo site_url('admin/update_profile_image/' . $safe_user['user_id_pk']); ?>" 
                  enctype="multipart/form-data"
                  class="image-upload-form"
                  data-validate="true">
                
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="profile_image" class="form-label">Select Image</label>
                        <input type="file" 
                               id="profile_image" 
                               name="profile_image" 
                               class="form-input"
                               accept="image/jpeg,image/png,image/gif,image/webp"
                               required
                               aria-describedby="image-help">
                        <div id="image-help" class="form-help">
                            Maximum file size: 2MB. Supported formats: JPEG, PNG, GIF, WebP
                        </div>
                    </div>
                    
                    <div class="image-preview" id="image-preview" style="display: none;">
                        <img src="" alt="Preview" class="preview-img">
                    </div>
                </div>
                
                <footer class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-modal-close>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        Upload Image
                    </button>
                </footer>
            </form>
        </div>
    </div>
</div>

<?php
$template_data['content'] = ob_get_clean();

// Add inline JavaScript for profile functionality
$template_data['inline_js'] = '
// Profile page functionality
(function() {
    "use strict";
    
    const ProfileManager = {
        init: function() {
            this.bindEvents();
            this.setupImageUpload();
        },
        
        bindEvents: function() {
            // Avatar edit button
            document.addEventListener("click", function(e) {
                if (e.target.closest(".avatar-edit-btn")) {
                    e.preventDefault();
                    ProfileManager.openImageUpload();
                }
            });
            
            // Copy referral code
            document.addEventListener("click", function(e) {
                if (e.target.closest(".copy-btn")) {
                    e.preventDefault();
                    const button = e.target.closest(".copy-btn");
                    const text = button.getAttribute("data-copy-text");
                    ProfileManager.copyToClipboard(text);
                }
            });
        },
        
        setupImageUpload: function() {
            const fileInput = document.getElementById("profile_image");
            const preview = document.getElementById("image-preview");
            
            if (fileInput) {
                fileInput.addEventListener("change", function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        // Validate file
                        if (!ProfileManager.validateImageFile(file)) {
                            return;
                        }
                        
                        // Show preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = preview.querySelector(".preview-img");
                            img.src = e.target.result;
                            preview.style.display = "block";
                        };
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = "none";
                    }
                });
            }
        },
        
        validateImageFile: function(file) {
            const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
            const maxSize = 2 * 1024 * 1024; // 2MB
            
            if (!allowedTypes.includes(file.type)) {
                ModernAgentSecurity.showAlert("Please select a valid image file (JPEG, PNG, GIF, or WebP).", "danger");
                return false;
            }
            
            if (file.size > maxSize) {
                ModernAgentSecurity.showAlert("File size must be less than 2MB.", "danger");
                return false;
            }
            
            return true;
        },
        
        openImageUpload: function() {
            const modal = document.getElementById("image-upload-modal");
            if (modal) {
                ModernAgentModal.openModal({ target: modal });
            }
        },
        
        copyToClipboard: function(text) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(function() {
                    ModernAgentSecurity.showAlert("Referral code copied to clipboard!", "success");
                }).catch(function(err) {
                    console.error("Could not copy text: ", err);
                    ProfileManager.fallbackCopyToClipboard(text);
                });
            } else {
                ProfileManager.fallbackCopyToClipboard(text);
            }
        },
        
        fallbackCopyToClipboard: function(text) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.left = "-999999px";
            textArea.style.top = "-999999px";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            
            try {
                const successful = document.execCommand("copy");
                if (successful) {
                    ModernAgentSecurity.showAlert("Referral code copied to clipboard!", "success");
                } else {
                    ModernAgentSecurity.showAlert("Unable to copy referral code. Please copy manually.", "warning");
                }
            } catch (err) {
                console.error("Fallback copy failed:", err);
                ModernAgentSecurity.showAlert("Unable to copy referral code. Please copy manually.", "warning");
            }
            
            document.body.removeChild(textArea);
        }
    };
    
    // Initialize when DOM is ready
    document.addEventListener("DOMContentLoaded", function() {
        ProfileManager.init();
    });
    
    // Expose for manual use
    window.ProfileManager = ProfileManager;
})();
';

// Load the admin base template
$this->load->view('templates/admin_base', $template_data);
?>
