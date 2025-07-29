<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * PDF Generation Performance Optimizations
 * - Increased memory limit from 32M to 512M for complex PDFs
 * - Added execution time limit of 300 seconds
 * - Enhanced error handling and performance monitoring
 * - Added optional caching capabilities
 */
ini_set("memory_limit", "512M");
ini_set("max_execution_time", 300);

if (!function_exists('pdf_create')) {

    function pdf_create($html, $filename, $stream = TRUE, $orientation = "portrait") {
        // Performance monitoring
        $start_time = microtime(true);
        $start_memory = memory_get_usage(true);

        try {
            // Ensure cache directory exists
            $cache_dir = APPPATH . '../cache/pdf_cache';
            if (!is_dir($cache_dir)) {
                mkdir($cache_dir, 0755, true);
            }

            require_once("dompdf/dompdf_config.inc.php");

            $dompdf = new DOMPDF();

            // Performance optimizations
            $dompdf->set_option('enable_php', false); // Disable PHP execution for security
            $dompdf->set_option('enable_remote', false); // Disable remote content loading
            $dompdf->set_option('default_media_type', 'print'); // Optimize for print
            $dompdf->set_option('enable_css_float', true); // Better CSS support
            $dompdf->set_option('enable_html5_parser', true); // Better HTML parsing
            $dompdf->set_option('temp_dir', $cache_dir); // Use cache directory

            $dompdf->set_paper("a4", $orientation);
            $dompdf->load_html($html);
            $dompdf->render();

            if ($stream) {
                $dompdf->stream($filename . ".pdf");
            } else {
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

if (!function_exists('pdf_cleanup_cache')) {
    /**
     * Clean up old cache files (optional utility function)
     */
    function pdf_cleanup_cache($hours = 24) {
        $cache_dir = APPPATH . '../cache/pdf_cache';
        if (!is_dir($cache_dir)) {
            return;
        }

        $cutoff_time = time() - ($hours * 3600);
        $files = glob($cache_dir . '/*');
        $cleaned = 0;

        foreach ($files as $file) {
            if (is_file($file) && filemtime($file) < $cutoff_time) {
                unlink($file);
                $cleaned++;
            }
        }

        if ($cleaned > 0) {
            error_log("PDF Cache Cleanup: Removed {$cleaned} old files");
        }
    }
}
?>