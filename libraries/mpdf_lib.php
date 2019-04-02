<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class mpdf_lib
{
    function __construct()
    {		
		require_once("extras/mPDF/mpdf.php");		
    }
	function createPDF($html = "<h1>No File Found</h1>",$name = "error.pdf") 
	{
	   $mpdf=new mPDF(); 		
		$mpdf->WriteHTML($html);
		$mpdf->Output($name,"D");		
		exit;
	}	
}
?>