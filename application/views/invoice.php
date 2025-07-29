<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Invoice from Modern Agent - Thank you for your order">
    <meta name="author" content="Modern Agent">
    <title>Invoice - Modern Agent</title>
    
    <!-- Email client compatibility -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta name="format-detection" content="telephone=no">
    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/optimized-styles.css'); ?>">
    
    <style>
        /* Email-specific styles for better client compatibility */
        @media screen and (max-width: 600px) {
            .invoice-container {
                padding: 20px !important;
            }
            .invoice-content {
                grid-template-columns: 1fr !important;
            }
            .invoice-title {
                font-size: 24px !important;
            }
        }
        
        /* Print styles */
        @media print {
            body {
                background: white !important;
            }
            .invoice-email {
                box-shadow: none !important;
            }
        }
    </style>
</head>
<body class="invoice-email-body">
    <!-- Main Invoice Container -->
    <main class="invoice-email" role="main">
        <article class="invoice-container">
            <!-- Invoice Header -->
            <header class="invoice-header">
                <!-- Logo placeholder - uncomment when needed -->
                <!-- <img src="<?php echo base_url('assets/images-2/logo.png'); ?>" alt="Modern Agent Logo" class="invoice-logo"> -->
                
                <h1 class="invoice-title">Thank you for your order!</h1>
                <p class="invoice-subtitle">Your Report Has Been Created.</p>
            </header>

            <!-- Invoice Content Section -->
            <section class="invoice-content">
                <div class="invoice-message">
                    <p>Thank you for your order. Below you can find the details of your order. We wish you luck on your real estate appointment.</p>
                </div>
                
                <aside class="invoice-action">
                    <a href="<?php echo site_url(); ?>" class="invoice-button" aria-label="Login to your account">
                        Account Login
                    </a>
                </aside>
            </section>

            <!-- Order Details Section -->
            <section class="invoice-order-details">
                <header class="invoice-section-header">
                    Order &amp; Payment Details
                </header>
                
                <div class="invoice-details">
                    <div class="invoice-content">
                        <div class="property-details">
                            <h2 class="invoice-detail-label">Presentation Address:</h2>
                            <address class="property-address">
                                <?php echo htmlspecialchars($lp_details['property_address'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                            </address>
                        </div>
                        
                        <div class="price-summary">
                            <table class="invoice-table">
                                <tbody>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="text-right">
                                            $<?php echo number_format((float)($total_amount ?? 0), 2); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td class="text-right">
                                            -$<?php echo number_format((float)($discount_amount ?? 0), 2); ?>
                                        </td>
                                    </tr>
                                    <tr style="border-top: 1px solid #ccc;">
                                        <td><strong>Total</strong></td>
                                        <td class="text-right">
                                            <strong>$<?php echo number_format((float)($total ?? 0), 2); ?></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Support Information -->
            <section class="invoice-support">
                <p>If you have any questions please email us at 
                    <a href="mailto:info@modernagent.io">info@modernagent.io</a>
                </p>
            </section>

            <!-- Invoice Footer -->
            <footer class="invoice-footer">
                &copy; <?php echo date('Y'); ?> Modern Agent All rights Reserved
            </footer>
        </article>
    </main>
</body>
</html>
