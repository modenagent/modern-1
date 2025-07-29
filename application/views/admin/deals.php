<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Generate CSRF token
$csrf_token = hash('sha256', uniqid() . time());

// Template data for admin base
$template_data = array(
    'title' => 'Manage Deals',
    'csrf_token' => $csrf_token,
    'breadcrumbs' => array(
        array('title' => 'Dashboard', 'url' => site_url('admin/dashboard')),
        array('title' => 'Manage Deals', 'url' => '')
    ),
    'additional_css' => array(),
    'additional_js' => array()
);

// Capture the deals content
ob_start();
?>

<div class="admin-page">
    <!-- Page Header -->
    <header class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">
                <i class="fa fa-handshake-o" aria-hidden="true"></i>
                Manage Deals
            </h1>
            <p class="page-description">Manage product deals and promotions</p>
        </div>
    </header>

    <!-- Alert Messages -->
    <?php if (isset($_GET['msg'])): ?>
        <?php if ($_GET['msg'] == 'removed'): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Success!</strong> Product has been removed from deals.
            </div>
        <?php elseif ($_GET['msg'] == 'deals_update'): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Success!</strong> Product has been updated.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Deals Table Section -->
    <section class="content-section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fa fa-table" aria-hidden="true"></i>
                    Current Deals
                </h2>
                <div class="card-actions">
                    <button type="button" class="btn btn-primary" id="add-deal-btn">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Add New Deal
                    </button>
                </div>
            </div>
            
            <div class="card-body">
                <?php if (!empty($deals)): ?>
                <div class="table-responsive">
                    <table class="table data-table" id="deals-table">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="25%">Product Name</th>
                                <th scope="col" width="20%">Store Name</th>
                                <th scope="col" width="25%">Pricing</th>
                                <th scope="col" width="25%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($deals as $deal): ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($deal->product_name ?? '', ENT_QUOTES, 'UTF-8'); ?></strong>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($deal->store_name ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td>
                                    <div class="pricing-info">
                                        <span class="actual-price">
                                            <del>$<?php echo number_format((float)($deal->selling_price ?? 0), 2); ?></del>
                                        </span>
                                        <span class="offer-price text-success">
                                            <strong>$<?php echo number_format((float)($deal->offer_price ?? 0), 2); ?></strong>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" 
                                                class="btn btn-sm btn-primary edit-deal-btn" 
                                                data-deal-id="<?php echo htmlspecialchars($deal->id ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                                data-modal-target="edit-deal-modal"
                                                aria-label="Edit deal">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                            Edit
                                        </button>
                                        
                                        <form method="post" 
                                              action="<?php echo site_url('admin/remove_deals/' . urlencode($deal->id ?? '')); ?>" 
                                              class="inline-form"
                                              onsubmit="return confirm('Are you sure you want to remove this deal?');">
                                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger confirm-action"
                                                    data-confirm-message="Are you sure you want to remove this deal?"
                                                    aria-label="Remove deal">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fa fa-handshake-o fa-4x text-muted" aria-hidden="true"></i>
                    </div>
                    <h3 class="empty-state-title">No Deals Found</h3>
                    <p class="empty-state-text">There are currently no deals available. Start by adding your first deal.</p>
                    <button type="button" class="btn btn-primary" id="add-first-deal-btn">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Add Your First Deal
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<!-- Edit Deal Modal -->
<div class="modal" id="edit-deal-modal" aria-hidden="true" role="dialog" aria-labelledby="edit-deal-title">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <header class="modal-header">
                <h2 class="modal-title" id="edit-deal-title">Edit Deal</h2>
                <button type="button" 
                        class="close" 
                        data-modal-close
                        aria-label="Close modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </header>
            
            <div class="modal-body" id="edit-deal-content">
                <!-- Content will be loaded via AJAX -->
                <div class="loading-state text-center">
                    <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
                    <p>Loading deal information...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product View Modal -->
<div class="modal" id="product-view-modal" aria-hidden="true" role="dialog" aria-labelledby="product-view-title">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <header class="modal-header">
                <h2 class="modal-title" id="product-view-title">Product Details</h2>
                <button type="button" 
                        class="close" 
                        data-modal-close
                        aria-label="Close modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </header>
            
            <div class="modal-body" id="product-view-content">
                <!-- Content will be loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

<?php
$template_data['content'] = ob_get_clean();

// Add inline JavaScript for deals functionality
$template_data['inline_js'] = '
// Deals management functionality
(function() {
    "use strict";
    
    const DealsManager = {
        init: function() {
            this.bindEvents();
            this.initializeDataTable();
        },
        
        bindEvents: function() {
            // Edit deal buttons
            document.addEventListener("click", function(e) {
                if (e.target.closest(".edit-deal-btn")) {
                    e.preventDefault();
                    const button = e.target.closest(".edit-deal-btn");
                    const dealId = button.getAttribute("data-deal-id");
                    DealsManager.loadEditDeal(dealId);
                }
            });
            
            // Add deal buttons
            document.addEventListener("click", function(e) {
                if (e.target.closest("#add-deal-btn, #add-first-deal-btn")) {
                    e.preventDefault();
                    DealsManager.showAddDealForm();
                }
            });
            
            // Form submissions with CSRF protection
            document.addEventListener("submit", function(e) {
                const form = e.target;
                if (form.classList.contains("inline-form")) {
                    // Let the form submit naturally for now
                    return true;
                }
            });
        },
        
        initializeDataTable: function() {
            // Initialize DataTable if available
            if (typeof $ !== "undefined" && $.fn.DataTable) {
                $("#deals-table").DataTable({
                    responsive: true,
                    pageLength: 25,
                    order: [[0, "asc"]],
                    columnDefs: [
                        { orderable: false, targets: [4] } // Disable sorting for actions column
                    ],
                    language: {
                        search: "Search deals:",
                        lengthMenu: "Show _MENU_ deals per page",
                        info: "Showing _START_ to _END_ of _TOTAL_ deals",
                        emptyTable: "No deals available",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "Next",
                            previous: "Previous"
                        }
                    }
                });
            }
        },
        
        loadEditDeal: function(dealId) {
            if (!dealId) {
                ModernAgentSecurity.showAlert("Invalid deal ID", "danger");
                return;
            }
            
            const modal = document.getElementById("edit-deal-modal");
            const content = document.getElementById("edit-deal-content");
            
            // Show loading state
            content.innerHTML = `
                <div class="loading-state text-center">
                    <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
                    <p>Loading deal information...</p>
                </div>
            `;
            
            // Open modal
            ModernAgentModal.openModal({ target: modal });
            
            // Load deal data via AJAX
            fetch(`${BASE_URL}admin/edit_deals/${encodeURIComponent(dealId)}`, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": CSRF_TOKEN
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                content.innerHTML = data;
                
                // Initialize form validation for the loaded form
                const form = content.querySelector("form");
                if (form) {
                    form.setAttribute("data-validate", "true");
                    ModernAgentSecurity.addCSRFToForms();
                }
            })
            .catch(error => {
                console.error("Error loading deal:", error);
                content.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        <strong>Error:</strong> Unable to load deal information. Please try again.
                    </div>
                `;
            });
        },
        
        showAddDealForm: function() {
            // For now, redirect to add deal page or show a message
            ModernAgentSecurity.showAlert("Add deal functionality will be available soon.", "info");
            // Could redirect to: window.location.href = BASE_URL + "admin/add_deal";
        },
        
        confirmRemoveDeal: function(dealId) {
            return confirm("Are you sure you want to remove this deal? This action cannot be undone.");
        }
    };
    
    // Initialize when DOM is ready
    document.addEventListener("DOMContentLoaded", function() {
        DealsManager.init();
    });
    
    // Expose for manual use
    window.DealsManager = DealsManager;
})();

// Legacy function support for any existing code
function edit_deals(id) {
    if (window.DealsManager) {
        window.DealsManager.loadEditDeal(id);
    }
}

function product_view(id) {
    if (!id) return;
    
    const modal = document.getElementById("product-view-modal");
    const content = document.getElementById("product-view-content");
    
    content.innerHTML = `
        <div class="loading-state text-center">
            <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
            <p>Loading product information...</p>
        </div>
    `;
    
    ModernAgentModal.openModal({ target: modal });
    
    fetch(`${BASE_URL}store/product_detail/${encodeURIComponent(id)}`, {
        method: "POST",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": CSRF_TOKEN
        }
    })
    .then(response => response.text())
    .then(data => {
        content.innerHTML = data;
    })
    .catch(error => {
        console.error("Error loading product:", error);
        content.innerHTML = `
            <div class="alert alert-danger">
                <strong>Error:</strong> Unable to load product information.
            </div>
        `;
    });
}
';

// Load the admin base template
$this->load->view('templates/admin_base', $template_data);
?>