<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Name:  DOMPDF
 * 
 * Author: Jd Fiscus
 *         jdfiscus@gmail.com
 *         @iamfiscus
 *
 * Origin API Class: http://code.google.com/p/dompdf/
 * 
 * Location: http://github.com/iamfiscus/Codeigniter-DOMPDF/
 * 
 * Created: 06.22.2010 
 * 
 * Description: This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
 * 
 * Enhanced with performance optimizations for Modern-1 application
 */

class Dompdf_gen {
    
    public function __construct() {
        
        // Set optimal memory and execution limits for PDF generation
        ini_set("memory_limit", "512M");
        ini_set("max_execution_time", "300");
        
        require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
        
        $pdf = new DOMPDF();
        
        // Performance and security optimizations (modern dompdf syntax)
        $pdf->set_option('enable_php', false);                  // Disable PHP execution
        $pdf->set_option('enable_remote', false);               // Disable remote content loading
        $pdf->set_option('enable_css_float', true);             // Better CSS float support
        $pdf->set_option('enable_html5_parser', true);          // Better HTML5 parsing
        $pdf->set_option('default_media_type', 'print');        // Optimize for print media
        $pdf->set_option('default_paper_size', 'a4');           // Set default paper size
        $pdf->set_option('default_font', 'serif');              // Set default font for better rendering
        
        // Optional: disable debugging features for performance
        $pdf->set_option('debugPng', false);
        $pdf->set_option('debugKeepTemp', false);
        $pdf->set_option('debugCss', false);

        $CI =& get_instance();
        $CI->dompdf = $pdf;
    }
}