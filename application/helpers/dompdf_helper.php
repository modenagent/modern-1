<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Optimize memory and execution limits for PDF generation performance
 */
ini_set("memory_limit", "512M");
ini_set("max_execution_time", 300);

if(!function_exists('pdf_create')){

    function pdf_create($html, $filename, $stream=TRUE, $orientation="portrait") {
        // Performance monitoring start
        $start_time = microtime(true);
        $start_memory = memory_get_usage(true);
        
        try {
            require_once(dirname(__FILE__) . "/../third_party/dompdf/dompdf_config.inc.php");

            $dompdf = new DOMPDF();
            
            // Performance optimizations
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->set_option('isPhpEnabled', false); // Security: disable PHP execution
            $dompdf->set_option('isRemoteEnabled', false); // Security: disable remote content
            $dompdf->set_option('defaultMediaType', 'print'); // Optimize for print media
            
            $dompdf->set_paper("a4", $orientation);
            $dompdf->load_html($html);
            $dompdf->render();
            
            // Performance monitoring
            $end_time = microtime(true);
            $end_memory = memory_get_usage(true);
            $execution_time = round($end_time - $start_time, 2);
            $memory_used = round(($end_memory - $start_memory) / 1024 / 1024, 2);
            
            // Log performance metrics for monitoring
            error_log("PDF Generation Performance: {$filename} - Time: {$execution_time}s, Memory: {$memory_used}MB");
            
            if ($stream) { //open only
                $dompdf->stream($filename . ".pdf", array("compress" => 1));
            } else { // save to file only, your going to load the file helper for this one
                write_file("pdf/$filename.pdf", $dompdf->output(array("compress" => 1)));
            }
            
        } catch (Exception $e) {
            error_log("PDF Generation Error for {$filename}: " . $e->getMessage());
            throw new Exception("PDF generation failed: " . $e->getMessage());
        }
    }
}

?>