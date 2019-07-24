<?php
class Invoice 
{
    public function __construct() 
    {

    }

    public function _getInvoice($invoiceNumber, $userId)
    {
        $CI = & get_instance();

        $invoiceSql = "SELECT inv.*, user.first_name, user.last_name, user.email, listing.property_address FROM lp_invoices inv 
            INNER JOIN lp_user_mst user ON inv.user_id_fk = user.user_id_pk 
            INNER JOIN lp_my_cart cart ON inv.cart_id_fk = cart.cart_id_pk 
            INNER JOIN lp_my_listing listing ON cart.project_id_fk = listing.project_id_pk 
            WHERE inv.invoice_num = ? AND inv.user_id_fk = ?";
        $result = $CI->db->query($invoiceSql, [$invoiceNumber, $userId]);
        if ($result->num_rows()>0) {
            $data = $result->row();

            $user_name = $data->first_name . ' ' . $data->last_name;
            $user_email = $data->email;
            $order_num = $data->invoice_num;
            $lp_details['property_address'] = $data->property_address;
            $baseOrderAmount = $data->order_amount;
            $couponDiscountAmount = $data->coupon_amount;
            $finalInvoiceAmount = $data->invoice_amount;

            $invoice_data = [];
            $invoice_data['user_name'] = $user_name;
            $invoice_data['order_num'] = $order_num;
            $invoice_data['lp_details'] = $lp_details;
            $invoice_data['total_amount'] = $baseOrderAmount;
            $invoice_data['discount_amount'] = $couponDiscountAmount;
            $invoice_data['total'] = $finalInvoiceAmount;

            ob_start();
            $CI->load->view('invoice', $invoice_data);
            $content = ob_get_contents();
            ob_clean();
            
            $pdfName = $order_num.'.pdf';

            $CI->load->library('mpdf'); 
            $mpdf=new mPDF(); 
            $mpdf=new mPDF('','A4','','',10,10,7);
            $mpdf->WriteHTML($content);
            $mpdf->Output($pdfName, 'D');
        } else {
            echo "No Record Found.";
            exit();
        }
    }


}