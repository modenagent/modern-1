ALTER TABLE `lp_invoices` 
ADD `order_amount` FLOAT( 9, 2 ) NOT NULL DEFAULT '0.00' COMMENT 'Total Order amount without coupon discount' AFTER  `user_id_fk`,
ADD `coupon_amount` FLOAT( 9, 2 ) NOT NULL DEFAULT '0.00' COMMENT 'Coupon Discount amount' AFTER `order_amount`;

UPDATE lp_invoices SET order_amount = invoice_amount;