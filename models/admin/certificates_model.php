<?php
class Certificates_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- carousel -----------------------------      ////////
	function getCarousel($carousel_id = "",$arrwhere = "")
	{
		if($carousel_id || $arrwhere)
		{
			if($carousel_id && $arrwhere)
			{
				$arrwhere["carousel_id"] = $carousel_id;
			}
			else if($carousel_id)$arrwhere = array("carousel_id"=>$carousel_id);
			$this->db->where($arrwhere);
		}
		$result = $this->db->get(DBPREFIX."_carousel");
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();			
		}
	}
	
	function insertcarousel($data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$this->db->insert_batch(DBPREFIX."_carousel", $data); 
		return TRUE;
	}
	
	function deletecarousel($carousel_id)
	{
		$arr = array('carousel_id' => $carousel_id);		
		$this->db->where($arr); 
		$this->db->delete(DBPREFIX."_carousel", $arr);
		
	//	echo "update".$product_id;print_r($data);die;
		return TRUE;
	}
	
	
	
	/**
	* this function is common for carousel and subcarousel
	* @param undefined $category_id
	* @param undefined $data
	* 
	*/
	function updatecarousel($carousel_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('carousel_id' => $carousel_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_carousel", $data[0]);		
	//	echo "update".$carousel_id;print_r($data);die;
		return TRUE;
	}	
	
	function getAllData()
	{
	  
	  $this->db->select('*');
	  $this->db->from('_carousel');
	  $query = $this->db->get();
	  $result = $query->result_array();
	  
	  
	  return $result;
	}
}	
?>