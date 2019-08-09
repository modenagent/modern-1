<?php if(isset($is_pdf_preview) && $is_pdf_preview == false) { ?>
<style>
.page5 {
    padding: 5% 0%;
}

.avg-text-box {
	margin-top: 0;
}

.most-buyers3 {
	padding: 0 15px;
}
</style>
<?php 
}
	$this->load->view('reports/english/seller/pages/5k');
?>