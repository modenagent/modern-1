<?php
$valid_pages = range(1,6);
if(in_array($pdf_page, $valid_pages) === false) {
    $pdf_page = 1;
}
$this->load->view("reports/english/registry/pages/$pdf_page");
?>