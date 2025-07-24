<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * PDF Generation Performance Optimizations
 * - Increased memory limit from 32M to 512M for complex PDFs
 * - Added execution time limit of 300 seconds
 * - Enhanced error handling and performance monitoring
 */
ini_set("memory_limit", "512M");
ini_set("max_execution_time", "300");

if(!function_exists('pdf_create')){

    function pdf_create($html, $filename, $stream=TRUE, $orientation="portrait") {
        // Performance monitoring
        $start_time = microtime(true);
        $start_memory = memory_get_usage(true);
        
        try {
            require_once("dompdf/dompdf_config.inc.php");

            $dompdf = new DOMPDF();
            
            // Performance optimizations
            $dompdf->set_option('enable_php', false); // Disable PHP execution for security and speed
            $dompdf->set_option('enable_remote', false); // Disable remote content loading
            $dompdf->set_option('default_media_type', 'print'); // Optimize for print
            $dompdf->set_option('enable_css_float', true); // Better CSS support
            $dompdf->set_option('enable_html5_parser', true); // Better HTML parsing
            
            $dompdf->set_paper("a4", $orientation);
            $dompdf->load_html($html);
            $dompdf->render();
            
            if ($stream) { //open only
                $dompdf->stream($filename . ".pdf");
            } else { // save to file only, your going to load the file helper for this one
                write_file("pdf/$filename.pdf", $dompdf->output());
            }
            
            // Log performance metrics
            $end_time = microtime(true);
            $end_memory = memory_get_usage(true);
            $execution_time = round($end_time - $start_time, 2);
            $memory_used = round(($end_memory - $start_memory) / 1024 / 1024, 2);
            $peak_memory = round(memory_get_peak_usage(true) / 1024 / 1024, 2);
            
            error_log("PDF Generation - File: {$filename}, Time: {$execution_time}s, Memory: {$memory_used}MB, Peak: {$peak_memory}MB");
            
        } catch (Exception $e) {
            error_log("PDF Generation Error - File: {$filename}, Error: " . $e->getMessage());
            throw $e;
        }
    }
}

?>