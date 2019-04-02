<?php
class Starrating_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function insertStarRating($data)
	{
		if($this->db->insert(DBPREFIX."_products_ratings",$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}




	
}
?>