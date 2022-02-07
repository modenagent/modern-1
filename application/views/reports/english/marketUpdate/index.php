<?php
$default_theme = 1;
if($this->input->post('mu_theme') >= 1 && $this->input->post('mu_theme') <= 3) {
	$default_theme = (int)$this->input->post('mu_theme');
}
$this->load->view('reports/english/marketUpdate/'.$default_theme .'/index');
if($this->input->post('show_html') == 1) {
 die;
}
?>
