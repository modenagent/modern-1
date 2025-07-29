<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>Invoice - ModernAgent</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/optimizations.css'); ?>">
<style>
@page {background:rgb(255,255,255);}
body {background:rgb(255,255,255); margin: 0; padding: 0; font-family: Arial, sans-serif;}
</style>
</head>
<body>
<div class="invoice-container">
	<div class="invoice-content">
		<header>
			<!-- <img src="<?php echo base_url("assets/images-2/logo.png"); ?>" alt="ModernAgent Logo"/> -->
		</header>
		
		<main>
			<h1 class="invoice-title">Thank you for your order!</h1>
			<p class="invoice-subtitle">Your Report Has Been Created.</p>
			
			<div class="modern-grid">
				<section class="invoice-details">
					<div class="invoice-body-text">
						<p>Thank you for your order. Below you can find the details of your order. We wish you luck on your real estate appointment.</p>
					</div>
				</section>
				<aside class="invoice-actions">
					<div class="action-button">
						<a href="<?php echo site_url(); ?>" class="login-button">ACCOUNT LOGIN</a>
					</div>
				</aside>
			</div>
			
			<section class="order-details">
				<header class="order-header">
					<h2>Order & Payment Details</h2>
				</header>
				
				<div class="order-content">
					<div class="order-info">
						<div class="address-section">
							<strong>Presentation Address:</strong><br>
							<span class="property-address"><?php echo html_escape($lp_details['property_address']); ?></span>
						</div>
					</div>
					
					<div class="order-summary">
						<table class="summary-table">
							<tr>
								<td>Subtotal</td>
								<td>$ <?php echo number_format($total_amount, 2); ?></td>
							</tr>
							<tr>
								<td>Discount</td>
								<td>- $ <?php echo number_format($discount_amount, 2); ?></td>
							</tr>
							<tr class="total-row">
								<td><strong>Total</strong></td>
								<td><strong>$ <?php echo number_format($total, 2); ?></strong></td>
							</tr>
						</table>
					</div>
				</div>
			</section>
			
			<div class="contact-info">
				<p>If you have any questions please email us @ info@modernagent.io</p>
			</div>
		</main>
		
		<footer class="invoice-footer">
			&copy; <?php echo date("Y") ?> Modern Agent All rights Reserved
		</footer>
	</div>
</div>
</body>
</html>
