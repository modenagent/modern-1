CREATE INDEX invoices_invoice_date_index ON lp_invoices(invoice_date);
CREATE INDEX invoices_cart_id_fk_index ON lp_invoices(cart_id_fk);
CREATE INDEX invoices_user_id_fk_index ON lp_invoices(user_id_fk);
CREATE INDEX invoices_invoice_amount_index ON lp_invoices(invoice_amount);
CREATE INDEX invoices_invoice_to_index ON lp_invoices(invoice_to);

CREATE INDEX user_mst_first_name_index ON lp_user_mst(first_name);
CREATE INDEX user_mst_last_name_index ON lp_user_mst(last_name);
CREATE INDEX user_mst_middle_name_index ON lp_user_mst(middle_name);
CREATE INDEX user_mst_email_index ON lp_user_mst(email);
CREATE INDEX user_mst_is_active_index ON lp_user_mst(is_active);
CREATE INDEX user_mst_parent_id_index ON lp_user_mst(parent_id);
CREATE INDEX user_mst_role_id_fk_index ON lp_user_mst(role_id_fk);
CREATE INDEX user_mst_ref_code_index ON lp_user_mst(ref_code);
CREATE INDEX user_mst_company_name_index ON lp_user_mst(company_name);

CREATE INDEX my_cart_project_id_fk_index ON lp_my_cart(project_id_fk);
CREATE INDEX my_cart_paid_on_index ON lp_my_cart(paid_on);
CREATE INDEX my_cart_txn_id_index ON lp_my_cart(txn_id);
CREATE INDEX my_cart_is_success_index ON lp_my_cart(is_success);          

CREATE INDEX my_listing_is_active_index ON lp_my_listing(is_active);
CREATE INDEX my_listing_project_name_index ON lp_my_listing(project_name);
CREATE INDEX my_listing_property_owner_index ON lp_my_listing(property_owner);
CREATE INDEX my_listing_project_date_index ON lp_my_listing(project_date);
CREATE INDEX my_listing_report_type_index ON lp_my_listing(report_type);


CREATE INDEX invoices_coupon_code_index ON lp_coupon_mst(coupon_code);
CREATE INDEX invoices_coupon_name_index ON lp_coupon_mst(coupon_name);
CREATE INDEX invoices_start_date_index ON lp_coupon_mst(start_date);
CREATE INDEX invoices_end_date_index ON lp_coupon_mst(end_date);
CREATE INDEX invoices_coupon_amt_index ON lp_coupon_mst(coupon_amt);