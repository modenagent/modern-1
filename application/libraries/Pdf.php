<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once dirname(__FILE__) . '/mpdf/mpdf.php';

class Pdf extends mPDF
{ 
	function Pdf()
    {
        $CI = & get_instance();
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($params == NULL)
        {
            $param = '"en-GB-x","Letter","","",0,-5,0,-5';         
        }
         
        return new mPDF($param);
    }
} 
/*Author:Tutsway.com */ /* End of file Pdf.php */ /* Location: ./application/libraries/Pdf.php */ 