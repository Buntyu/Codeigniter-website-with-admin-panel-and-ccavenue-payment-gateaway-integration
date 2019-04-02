<?php
class Areas_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- areas -----------------------------      ////////
	function getAreas($area_id = "",$select = "")
	{
		$where = "";
		if($area_id) 
		{
			$where .= " AND area_id = '".$area_id."'";
		}
		if($select == "")
		{
			$select = "areas.*, users1.admin_name as name1, users2.admin_name as name2";
		}
			$sql = "SELECT  ".$select."
				FROM ".DBPREFIX."_areas_covered as areas
				LEFT JOIN ".DBPREFIX."_backend_users as users1 ON areas.created_id = users1.admin_id
				LEFT JOIN ".DBPREFIX."_backend_users as users2 ON areas.updated_id = users2.admin_id
				WHERE deleted_id is NULL ".$where. "
				ORDER BY area_name ASC
				";	
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();			
		}
	}
	
	function insertareas($data)
	{
		
		if(!(isset($data[0])))$data[0] = $data;		
		$this->db->insert_batch(DBPREFIX."_areas_covered", $data); 
	//	echo "<pre>";print_r($data);die;
		return TRUE;
	}
	
	
	
	/**
	
	* this function is common for areas and subareas
	* @param undefined $category_id
	* @param undefined $data
	* 
	*/
	function updateareas($area_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('area_id' => $area_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_areas_covered", $data[0]);		
	//	echo "update".$area_id;print_r($data);die;
		return TRUE;
	}
	
	public function deletearea($area_id,$data)	
	{
		$arr = array('area_id' => $area_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_areas_covered", $data);		
	}
}	
?>