<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Name:  DOMPDF
* 
* Author: Jd Fiscus
* 	 	  jdfiscus@gmail.com
*         @iamfiscus
*          
*
* Origin API Class: http://code.google.com/p/dompdf/
* 
* Location: http://github.com/iamfiscus/Codeigniter-DOMPDF/
*          
* Created:  06.22.2010 
* 
* Description:  This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
* 
*/

class Dompdf_gen {
		
	public function __construct() {
		
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		
		$pdf = new DOMPDF();
		
		// Performance and security optimizations
		$pdf->set_option('isHtml5ParserEnabled', true);
		$pdf->set_option('isPhpEnabled', false); // Security: disable PHP execution in PDFs
		$pdf->set_option('isRemoteEnabled', false); // Security: disable remote content loading  
		$pdf->set_option('defaultMediaType', 'print'); // Optimize for print media
		$pdf->set_option('debugPng', false); // Disable debug output for performance
		$pdf->set_option('debugKeepTemp', false); // Clean up temp files
		$pdf->set_option('debugCss', false); // Disable CSS debugging for performance
		
		$CI =& get_instance();
		$CI->dompdf = $pdf;
		
	}
	
}