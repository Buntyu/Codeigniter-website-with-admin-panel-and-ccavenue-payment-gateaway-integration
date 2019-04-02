<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Upload_image_lib 
{
    function __construct()
    {		
		
    }
	
	function getImages($oObj)
	{
		$oObj->load->model("admin/image_model");
		$images = $oObj->image_model->getImages();
		if($images)
		{
			return $images;			
		}		
		return FALSE;
	}
}
?>