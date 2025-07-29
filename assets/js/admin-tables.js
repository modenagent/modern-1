/**
 * Admin Tables DataTables Initialization
 * Shared configuration and functions for all admin data tables
 */

/**
 * Default DataTables configuration for admin tables
 * Includes sorting, pagination, search, and responsive features
 */
var AdminTables = {
    // Default configuration
    defaultConfig: {
        "processing": true,
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 25,
        "language": {
            "processing": "<div class='text-center'><i class='fa fa-spinner fa-spin admin-fa-spin ma-font-24'></i></div>",
            "emptyTable": "<div align='center'>No records found.</div>",
            "zeroRecords": "<div align='center'>No matching records found.</div>",
            "search": "Search:",
            "lengthMenu": "Show _MENU_ entries",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _TOTAL_ total entries)",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
        "columnDefs": [{
            "orderable": false,
            "targets": "no-sort"
        }],
        "drawCallback": function(settings) {
            $("[data-toggle='tooltip']").tooltip();
        }
    },

    /**
     * Initialize a basic DataTable with standard configuration
     * @param {string} tableId - The ID of the table element
     * @param {object} customConfig - Optional custom configuration to merge
     */
    initBasicTable: function(tableId, customConfig) {
        if (!$(tableId).length) {
            console.warn('Table not found: ' + tableId);
            return null;
        }

        var config = $.extend(true, {}, this.defaultConfig, customConfig || {});
        
        // Add search functionality enhancement
        config.initComplete = function() {
            var input = $('.dataTables_filter input').unbind(),
                self = this.api(),
                $searchButton = $('<button class="btn btn-primary admin-ml-5 admin-mt-5">')
                    .text('Search')
                    .click(function() {
                        self.search(input.val()).draw();
                    }),
                $clearButton = $('<button class="btn btn-default admin-ml-5 admin-mt-5">')
                    .text('Clear')
                    .click(function() {
                        input.val('');
                        $searchButton.click();
                    });
            $('.dataTables_filter').append($searchButton, $clearButton);
        };

        return $(tableId).DataTable(config);
    },

    /**
     * Initialize a server-side DataTable with AJAX processing
     * @param {string} tableId - The ID of the table element
     * @param {string} ajaxUrl - URL for server-side processing
     * @param {object} ajaxData - Additional data to send with AJAX requests
     * @param {object} customConfig - Optional custom configuration to merge
     */
    initServerSideTable: function(tableId, ajaxUrl, ajaxData, customConfig) {
        if (!$(tableId).length) {
            console.warn('Table not found: ' + tableId);
            return null;
        }

        var config = $.extend(true, {}, this.defaultConfig, {
            "serverSide": true,
            "ajax": {
                "url": ajaxUrl,
                "type": "POST",
                "data": ajaxData || {}
            }
        }, customConfig || {});

        // Add enhanced search functionality
        config.initComplete = function() {
            var input = $('.dataTables_filter input').unbind(),
                self = this.api(),
                $searchButton = $('<button class="btn btn-primary admin-ml-5 admin-mt-5">')
                    .text('Search')
                    .click(function() {
                        self.search(input.val()).draw();
                    }),
                $clearButton = $('<button class="btn btn-default admin-ml-5 admin-mt-5">')
                    .text('Clear')
                    .click(function() {
                        input.val('');
                        $searchButton.click();
                    });
            $('.dataTables_filter').append($searchButton, $clearButton);
        };

        return $(tableId).DataTable(config);
    },

    /**
     * Add bulk selection functionality to a table
     * @param {string} tableId - The ID of the table element
     * @param {function} onSelectionChange - Callback when selection changes
     */
    addBulkSelection: function(tableId, onSelectionChange) {
        var table = $(tableId).DataTable();
        
        // Add select all checkbox to header
        $(tableId + ' thead tr').prepend('<th><input type="checkbox" id="select-all" aria-label="Select all rows"></th>');
        
        // Add individual checkboxes to each row
        table.rows().every(function() {
            var rowNode = this.node();
            $(rowNode).find('td:first').before('<td><input type="checkbox" class="row-select" aria-label="Select this row"></td>');
        });

        // Handle select all
        $(document).on('change', '#select-all', function() {
            var isChecked = $(this).prop('checked');
            $(tableId + ' .row-select').prop('checked', isChecked);
            if (onSelectionChange) {
                onSelectionChange(AdminTables.getSelectedRows(tableId));
            }
        });

        // Handle individual row selection
        $(document).on('change', tableId + ' .row-select', function() {
            var totalRows = $(tableId + ' .row-select').length;
            var selectedRows = $(tableId + ' .row-select:checked').length;
            $('#select-all').prop('checked', totalRows === selectedRows);
            
            if (onSelectionChange) {
                onSelectionChange(AdminTables.getSelectedRows(tableId));
            }
        });
    },

    /**
     * Get selected rows from a table with bulk selection
     * @param {string} tableId - The ID of the table element
     * @returns {Array} Array of selected row data
     */
    getSelectedRows: function(tableId) {
        var selectedData = [];
        $(tableId + ' .row-select:checked').each(function() {
            var row = $(this).closest('tr');
            var data = $(tableId).DataTable().row(row).data();
            selectedData.push(data);
        });
        return selectedData;
    },

    /**
     * Add loading state to table
     * @param {string} tableId - The ID of the table element
     */
    showLoading: function(tableId) {
        $(tableId + '_wrapper').addClass('loading');
        $(tableId + '_wrapper').append('<div class="table-loading-overlay"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
    },

    /**
     * Remove loading state from table
     * @param {string} tableId - The ID of the table element
     */
    hideLoading: function(tableId) {
        $(tableId + '_wrapper').removeClass('loading');
        $(tableId + '_wrapper .table-loading-overlay').remove();
    },

    /**
     * Add error state to table
     * @param {string} tableId - The ID of the table element
     * @param {string} message - Error message to display
     */
    showError: function(tableId, message) {
        var errorHtml = '<div class="alert alert-danger table-error" role="alert">' +
                       '<i class="fa fa-exclamation-triangle"></i> ' +
                       (message || 'An error occurred while loading the data.') +
                       '</div>';
        $(tableId + '_wrapper').prepend(errorHtml);
    },

    /**
     * Clear error state from table
     * @param {string} tableId - The ID of the table element
     */
    clearError: function(tableId) {
        $(tableId + '_wrapper .table-error').remove();
    }
};

/**
 * Initialize tables when document is ready
 */
$(document).ready(function() {
    // Initialize deals table
    if ($('#deals-table').length) {
        AdminTables.initBasicTable('#deals-table', {
            "order": [[0, "asc"]]
        });
    }

    // Initialize status list table
    if ($('#status-table').length) {
        AdminTables.initBasicTable('#status-table', {
            "order": [[0, "asc"]]
        });
    }

    // Initialize store types table
    if ($('#store-types-table').length) {
        AdminTables.initBasicTable('#store-types-table', {
            "order": [[0, "asc"]]
        });
    }

    // Initialize orders table with server-side processing
    if ($('#orders-table').length) {
        // Stub for future server-side implementation
        // AdminTables.initServerSideTable('#orders-table', 
        //     site_url('admin/orders_ajax'), 
        //     { type: "orders" }
        // );
        AdminTables.initBasicTable('#orders-table');
    }
});