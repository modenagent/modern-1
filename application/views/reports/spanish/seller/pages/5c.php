<?php if (sizeof($areaSalesAnalysis['comparable']) > 0): ?>
<?php
$avaiProperty = 0;
$areaSalesAnalysisChunk = array_chunk($areaSalesAnalysis['comparable'], 4, true);

foreach ($areaSalesAnalysisChunk as $_key => $_areaSalesAnalysis) {
    if ($_key > 1) {
        break;
    }

    $this->load->view('reports/spanish/seller/pages/5d', array('_comparables' => $_areaSalesAnalysis));
}
?>
<?php endif;