<?php
defined('BASEPATH') OR exit('No direct script access allowed');

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load security helper for CSRF token
$this->load->helper('security');
$csrf_token = $this->security->get_csrf_hash();

// Template data for admin base
$template_data = array(
    'title' => 'Manage Packages',
    'csrf_token' => $csrf_token,
    'breadcrumbs' => array(
        array('title' => 'Dashboard', 'url' => site_url('admin/dashboard')),
        array('title' => 'Manage Packages', 'url' => '')
    ),
    'additional_css' => array(),
    'additional_js' => array(
        'assets/js/jquery.validate.min.js',
        'assets/js/jquery-toastr/toastr.min.js',
        'assets/js/jquery-toastr/ui-toastr-notifications.js'
    )
);

// Capture the packages content
ob_start();
?>

<div class="admin-page">
    <!-- Page Header -->
    <header class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">
                <i class="fa fa-cube" aria-hidden="true"></i>
                Manage Packages
            </h1>
            <p class="page-description">Manage subscription packages and pricing plans</p>
        </div>
        <div class="page-actions">
            <a href="<?php echo site_url('admin/add_package'); ?>" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Add New Package
            </a>
        </div>
    </header>

    <!-- Packages Table Section -->
    <section class="content-section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    Packages List
                </h2>
                <div class="card-stats">
                    <span class="stat-item">
                        <strong><?php echo count($packages ?? []); ?></strong> Total Packages
                    </span>
                </div>
            </div>
            
            <div class="card-body">
                <?php if (!empty($packages)): ?>
                <div class="table-responsive">
                    <table class="table table-hover data-table" id="packages-table">
                        <thead>
                            <tr>
                                <th scope="col" class="no-sort" width="5%">#</th>
                                <th scope="col" width="25%">Package Name</th>
                                <th scope="col" width="15%">Price</th>
                                <th scope="col" width="15%">Monthly Price</th>
                                <th scope="col" width="12%">Status</th>
                                <th scope="col" width="13%">Referral Status</th>
                                <th scope="col" class="no-sort" width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($packages as $package_key => $package): ?>
                            <tr>
                                <td><?php echo ($package_key + 1); ?></td>
                                <td>
                                    <div class="package-info">
                                        <strong class="package-name">
                                            <?php echo htmlspecialchars($package->title ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                        </strong>
                                        <?php if (!empty($package->description)): ?>
                                        <div class="package-description text-muted">
                                            <?php echo htmlspecialchars($package->description ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="price-display">
                                        $<?php echo number_format((float)($package->price ?? 0), 2); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="price-display monthly-price">
                                        $<?php echo number_format((float)($package->price_per_month ?? 0), 2); ?>
                                        <small class="text-muted">/month</small>
                                    </span>
                                </td>
                                <td>
                                    <?php if (($package->is_active ?? 0) == 1): ?>
                                        <span class="label-primary badge" aria-label="Package is active">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            Active
                                        </span>
                                    <?php else: ?>
                                        <span class="label-danger badge" aria-label="Package is inactive">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            Inactive
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (($package->referral_status ?? 0) == 1): ?>
                                        <span class="label-primary badge" aria-label="Referral program is active">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            Active
                                        </span>
                                    <?php else: ?>
                                        <span class="label-danger badge" aria-label="Referral program is inactive">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            Inactive
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?php echo site_url('admin/edit_package/' . urlencode($package->id ?? '')); ?>" 
                                           class="btn btn-sm btn-warning admin-ml-5"
                                           data-toggle="tooltip"
                                           title="Edit package"
                                           aria-label="Edit package <?php echo htmlspecialchars($package->title ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                            <span class="sr-only">Edit</span>
                                        </a>
                                        <a href="<?php echo site_url('admin/view_package/' . urlencode($package->id ?? '')); ?>" 
                                           class="btn btn-sm btn-info"
                                           data-toggle="tooltip"
                                           title="View package details"
                                           aria-label="View package <?php echo htmlspecialchars($package->title ?? '', ENT_QUOTES, 'UTF-8'); ?> details">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            <span class="sr-only">View</span>
                                        </a>
                                        <?php if (($package->is_active ?? 0) == 1): ?>
                                        <form method="post" 
                                              action="<?php echo site_url('admin/deactivate_package/' . urlencode($package->id ?? '')); ?>" 
                                              class="inline-form"
                                              onsubmit="return confirm('Are you sure you want to deactivate this package?');">
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" 
                                                   value="<?php echo htmlspecialchars($this->security->get_csrf_hash(), ENT_QUOTES, 'UTF-8'); ?>">
                                            <button type="submit" 
                                                    class="btn btn-sm btn-secondary confirm-action"
                                                    data-confirm-message="Are you sure you want to deactivate this package?"
                                                    data-toggle="tooltip"
                                                    title="Deactivate package"
                                                    aria-label="Deactivate package <?php echo htmlspecialchars($package->title ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                                <i class="fa fa-pause" aria-hidden="true"></i>
                                                <span class="sr-only">Deactivate</span>
                                            </button>
                                        </form>
                                        <?php else: ?>
                                        <form method="post" 
                                              action="<?php echo site_url('admin/activate_package/' . urlencode($package->id ?? '')); ?>" 
                                              class="inline-form"
                                              onsubmit="return confirm('Are you sure you want to activate this package?');">
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" 
                                                   value="<?php echo htmlspecialchars($this->security->get_csrf_hash(), ENT_QUOTES, 'UTF-8'); ?>">
                                            <button type="submit" 
                                                    class="btn btn-sm btn-success confirm-action"
                                                    data-confirm-message="Are you sure you want to activate this package?"
                                                    data-toggle="tooltip"
                                                    title="Activate package"
                                                    aria-label="Activate package <?php echo htmlspecialchars($package->title ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                                <i class="fa fa-play" aria-hidden="true"></i>
                                                <span class="sr-only">Activate</span>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fa fa-cube fa-4x text-muted" aria-hidden="true"></i>
                    </div>
                    <h3 class="empty-state-title">No Packages Found</h3>
                    <p class="empty-state-text">There are currently no packages configured. Start by creating your first package.</p>
                    <a href="<?php echo site_url('admin/add_package'); ?>" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Create Your First Package
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<?php
$template_data['content'] = ob_get_clean();
$this->load->view('templates/admin_base', $template_data);
?>
</div>

<?php
$template_data['content'] = ob_get_clean();

// Add inline JavaScript for packages functionality
$template_data['inline_js'] = '
// Packages management functionality
(function() {
    "use strict";
    
    const PackagesManager = {
        init: function() {
            this.initializeDataTable();
            this.bindEvents();
        },
        
        initializeDataTable: function() {
            // Initialize DataTable with enhanced options
            if (typeof $ !== "undefined" && $.fn.DataTable) {
                $("#packages-table").DataTable({
                    responsive: true,
                    pageLength: 25,
                    order: [[1, "asc"]], // Sort by package name
                    columnDefs: [
                        { 
                            orderable: false, 
                            targets: [0, 6] // Disable sorting for # and Actions columns
                        },
                        {
                            targets: [2, 3], // Price columns
                            type: "currency"
                        }
                    ],
                    language: {
                        search: "Search packages:",
                        lengthMenu: "Show _MENU_ packages per page",
                        info: "Showing _START_ to _END_ of _TOTAL_ packages",
                        emptyTable: "No packages available",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "Next",
                            previous: "Previous"
                        }
                    },
                    dom: `<"d-flex justify-content-between align-items-center mb-3"<"d-flex align-items-center"l><"d-flex align-items-center"f>>
                          <"table-responsive"t>
                          <"d-flex justify-content-between align-items-center mt-3"<"text-muted"i><"pagination-wrapper"p>>`,
                    initComplete: function() {
                        // Add custom styling to search and length controls
                        $(".dataTables_filter input").addClass("form-input").attr("placeholder", "Search packages...");
                        $(".dataTables_length select").addClass("form-input");
                    }
                });
            }
        },
        
        bindEvents: function() {
            // Form submissions with CSRF protection
            document.addEventListener("submit", function(e) {
                const form = e.target;
                if (form.classList.contains("inline-form")) {
                    // Form already has CSRF token, let it submit naturally
                    return true;
                }
            });
            
            // Enhanced confirmation dialogs
            document.addEventListener("click", function(e) {
                if (e.target.closest(".confirm-action")) {
                    const button = e.target.closest(".confirm-action");
                    const message = button.getAttribute("data-confirm-message") || 
                                  "Are you sure you want to perform this action?";
                    
                    if (!confirm(message)) {
                        e.preventDefault();
                        return false;
                    }
                }
            });
            
            // Tooltip initialization
            if (typeof $ !== "undefined" && $.fn.tooltip) {
                $("[data-toggle=\"tooltip\"]").tooltip();
            }
        },
        
        refreshTable: function() {
            if (typeof $ !== "undefined" && $.fn.DataTable && $.fn.DataTable.isDataTable("#packages-table")) {
                $("#packages-table").DataTable().ajax.reload();
            }
        }
    };
    
    // Initialize when DOM is ready
    document.addEventListener("DOMContentLoaded", function() {
        PackagesManager.init();
    });
    
    // Expose for manual use
    window.PackagesManager = PackagesManager;
})();
';

// Load the admin base template
$this->load->view('templates/admin_base', $template_data);
?>