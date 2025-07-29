<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Generate CSRF token using CodeIgniter's security helper
$this->load->helper('security');
$csrf_token = $this->security->get_csrf_hash();

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

// Load the header template (assuming a template system is in use)
$this->load->view('admin/templates/header', $template_data);
?>

<div class="content">
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>">Dashboard</a> <span class="divider">&gt;</span></li>
            <li class="active">Manage Deals</li>
        </ul>
    </div>

    <div class="workplace">
        <?php
        // Handle success messages
        if (isset($_GET['msg'])) {
            $msg = html_escape($_GET['msg']);
            $message = '';
            if ($msg === 'removed') {
                $message = 'Product has been removed from deals.';
            } elseif ($msg === 'deals_update') {
                $message = 'Product has been updated.';
            }
            if ($message) {
                ?>
                <div class="alert alert-success fade-in span4" role="alert">
                    <button data-dismiss="alert" class="close" type="button" aria-label="Close alert">&times;</button>
                    <strong id="success"><?= $message ?></strong>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<?php
// Load the footer template (assuming a template system is in use)
$this->load->view('admin/templates/footer');
?>

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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load security helper for CSRF token
$this->load->helper('security');
$csrf_token = $this->security->get_csrf_hash();

// Template data for admin base
$template_data = array(
    'title' => 'Manage Deals',
    'csrf_token' => $csrf_token,
    'breadcrumbs' => array(
        array('title' => 'Dashboard', 'url' => site_url('admin/dashboard')),
        array('title' => 'Manage Deals', 'url' => '')
    ),
    'additional_css' => array(),
    'additional_js' => array(
        'assets/js/jquery.min.js',
        'assets/js/jquery.dataTables.min.js',
        'assets/js/jquery.validate.min.js',
        'assets/js/jquery-toastr/toastr.min.js',
        'assets/js/jquery-toastr/ui-toastr-notifications.js'
    )
);

// Capture the deals content
ob_start();
?>

<section class="content-section">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fa fa-table" aria-hidden="true"></i>
                Current Deals
            </h2>
            <div class="card-actions">
                <a href="<?php echo site_url('admin/add_deal'); ?>" class="btn btn-primary" id="add-deal-btn">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Add New Deal
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Search/Filter Bar -->
            <div class="admin-table-search">
                <form method="get" action="<?php echo site_url('admin/manage_deals'); ?>" class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="deals-search" class="sr-only">Search deals</label>
                            <input type="text" id="deals-search" name="search" class="form-control" 
                                   placeholder="Search deals by product name, store name, or price..." 
                                   aria-label="Search deals" 
                                   value="<?php echo htmlspecialchars($this->input->get('search', TRUE) ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search" aria-hidden="true"></i> Search
                        </button>
                        <a href="<?php echo site_url('admin/manage_deals'); ?>" class="btn btn-default">
                            <i class="fa fa-times" aria-hidden="true"></i> Clear
                        </a>
                    </div>
                </form>
            </div>

            <?php if (!empty($deals)): ?>
            <div class="table-responsive">
                <table class="table table-hover data-table" id="deals-table" role="table" aria-label="Deals management table">
                    <thead>
                        <tr role="row">
                            <th scope="col" class="no-sort" width="5%" tabindex="0" role="columnheader" aria-sort="none">
                                <span class="sr-only">Serial number column</span>
                                Sr. no.
                            </th>
                            <th scope="col" width="25%" tabindex="0" role="columnheader" aria-sort="none">Product Name</th>
                            <th scope="col" width="20%" tabindex="0" role="columnheader" aria-sort="none">Store Name</th>
                            <th scope="col" width="25%" tabindex="0" role="columnheader" aria-sort="none">Pricing</th>
                            <th scope="col" class="no-sort" width="25%" role="columnheader">
                                <span class="sr-only">Actions for each deal</span>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($deals as $deal): ?>
                        <tr role="row">
                            <td data-label="Sr. no."><?php echo $i; ?></td>
                            <td data-label="Product Name">
                                <strong><?php echo htmlspecialchars($deal->product_name ?? '', ENT_QUOTES, 'UTF-8'); ?></strong>
                            </td>
                            <td data-label="Store Name">
                                <?php echo htmlspecialchars($deal->store_name ?? '', ENT_QUOTES, 'UTF-8'); ?>
                            </td>
                            <td data-label="Pricing">
                                <div class="pricing-info">
                                    <span class="actual-price">
                                        <del>$<?php echo number_format((float)($deal->selling_price ?? 0), 2); ?></del>
                                    </span>
                                    <span class="offer-price text-success">
                                        <strong>$<?php echo number_format((float)($deal->offer_price ?? 0), 2); ?></strong>
                                    </span>
                                </div>
                            </td>
                            <td data-label="Actions">
                                <div class="action-buttons">
                                    <button type="button" 
                                            class="btn btn-sm btn-primary edit-deal-btn" 
                                            data-deal-id="<?php echo htmlspecialchars($deal->id ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                            data-toggle="modal"
                                            data-target="#edit-deal-modal"
                                            aria-label="Edit deal for <?php echo htmlspecialchars($deal->product_name ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        Edit
                                    </button>
                                    <form method="post" 
                                          action="<?php echo site_url('admin/remove_deals/' . urlencode($deal->id ?? '')); ?>" 
                                          class="inline-form"
                                          onsubmit="return confirm('Are you sure you want to remove this deal?');">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" 
                                               value="<?php echo htmlspecialchars($this->security->get_csrf_hash(), ENT_QUOTES, 'UTF-8'); ?>">
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger confirm-action"
                                                data-confirm-message="Are you sure you want to remove this deal?"
                                                aria-label="Remove deal for <?php echo htmlspecialchars($deal->product_name ?? '', ENT_QUOTES, 'UTF-8'); ?>">
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
                <p class="empty-state-text">There are currently no deals configured. Start by creating your first deal.</p>
                <a href="<?php echo site_url('admin/add_deal'); ?>" class="btn btn-primary">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Create Your First Deal
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
$template_data['content'] = ob_get_clean();
$this->load->view('templates/admin_base', $template_data);
?>
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

<?php
// Add inline JavaScript for deals functionality
$template_data['inline_js'] = '
(function() {
    "use strict";
    
    const DealsManager = {
        init: function() {
            this.bindEvents();
            this.initializeDataTable();
        },
        
        bindEvents: function() {
            // Search input keypress
            const searchInput = document.getElementById("deals-search");
            if (searchInput) {
                searchInput.addEventListener("keypress", function(e) {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        DealsManager.searchDeals();
                    }
                });
            }
            
            // Edit deal buttons
            document.addEventListener("click", function(e) {
                if (e.target.closest(".edit-deal-btn")) {
                    e.preventDefault();
                    const button = e.target.closest(".edit-deal-btn");
                    const dealId = button.getAttribute("data-deal-id");
                    DealsManager.loadEditDeal(dealId);
                }
            });
            
            // Add deal button
            document.addEventListener("click", function(e) {
                if (e.target.closest("#add-deal-btn")) {
                    e.preventDefault();
                    DealsManager.showAddDealForm();
                }
            });
            
            // Form submissions with CSRF protection
            document.addEventListener("submit", function(e) {
                const form = e.target;
                if (form.classList.contains("inline-form")) {
                    return true; // Let form submit naturally
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
        
        searchDeals: function() {
            const searchTerm = document.getElementById("deals-search").value;
            if (typeof $ !== "undefined" && $.fn.DataTable && $("#deals-table").DataTable()) {
                $("#deals-table").DataTable().search(searchTerm).draw();
            } else {
                toastr.warning("Search functionality is not available. Please ensure DataTables is loaded.");
            }
        },
        
        clearSearch: function() {
            const searchInput = document.getElementById("deals-search");
            if (searchInput) {
                searchInput.value = "";
                if (typeof $ !== "undefined" && $.fn.DataTable && $("#deals-table").DataTable()) {
                    $("#deals-table").DataTable().search("").draw();
                }
            }
        },
        
        loadEditDeal: function(dealId) {
            if (!dealId) {
                toastr.error("Invalid deal ID");
                return;
            }
            
            const modal = $("#edit-deal-modal");
            const content = $("#edit-deal-content");
            
            if (!modal.length || !content.length) {
                toastr.error("Edit modal not found. Please contact support.");
                return;
            }
            
            // Show loading state
            content.html(`
                <div class="loading-state text-center">
                    <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
                    <p>Loading deal information...</p>
                </div>
            `);
            
            // Open modal
            modal.modal("show");
            
            // Load deal data via AJAX
            $.ajax({
                url: `' . base_url('admin/edit_deals/') . '` + encodeURIComponent(dealId),
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": `' . htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8') . '`
                },
                success: function(data) {
                    content.html(data);
                    const form = content.find("form");
                    if (form.length) {
                        form.validate({
                            rules: {
                                product_name: { required: true, minlength: 3 },
                                store_name: { required: true, minlength: 3 },
                                selling_price: { required: true, number: true, min: 0 },
                                offer_price: { required: true, number: true, min: 0 }
                            },
                            messages: {
                                product_name: {
                                    required: "Please enter a product name",
                                    minlength: "Product name must be at least 3 characters"
                                },
                                store_name: {
                                    required: "Please enter a store name",
                                    minlength: "Store name must be at least 3 characters"
                                },
                                selling_price: {
                                    required: "Please enter the selling price",
                                    number: "Please enter a valid number",
                                    min: "Price cannot be negative"
                                },
                                offer_price: {
                                    required: "Please enter the offer price",
                                    number: "Please enter a valid number",
                                    min: "Price cannot be negative"
                                }
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error loading deal:", error);
                    content.html(`
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <strong>Error:</strong> Unable to load deal information. Please try again.
                        </div>
                    `);
                }
            });
        },
        
        showAddDealForm: function() {
            window.location.href = `' . site_url('admin/add_deal') . '`;
        }
    };
    
    // Initialize when DOM is ready
    document.addEventListener("DOMContentLoaded", function() {
        DealsManager.init();
    });
})();
';
?>

<?php
$template_data['content'] = ob_get_clean();
$this->load->view('templates/admin_base', $template_data);
?>
    
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