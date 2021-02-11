<?php 
echo "<pre>"; print_r($areaSalesAnalysis['comparable']);
?>
<?php if(sizeof($areaSalesAnalysis['comparable'])>0): ?>
<?php 
$avaiProperty = 0; //echo count($areaSalesAnalysis)."<br>";
$areaSalesAnalysisChunk = array_chunk($areaSalesAnalysis['comparable'], 4, true);
echo "<pre>"; print_r($areaSalesAnalysisChunk); 
foreach ($areaSalesAnalysisChunk as $_key=>$_areaSalesAnalysis){
    if($_key>1){
        break;
    }
    
    $this->load->view('reports/english/seller/pages/5d',array('_comparables'=>$_areaSalesAnalysis));
   
}
//die;
?>
<?php endif; ?>