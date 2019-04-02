<?php
class brands_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- brands -----------------------------      ////////
	function getBrands($brand_id = "",$select = "",$status="",$noname = "",$order = "")
	{
		$where = "";
		if($brand_id)
		{
			$where = " AND brands.brand_id = '".$brand_id."'";
		}
		if(is_array($brand_id))
		{
			$where = " AND brands.brand_id IN ('".implode("','",$brand_id)."')";
		}
		if($select == "")
		{
			$select = "brands.*, users1.admin_id as userid1, users2.admin_id as userid2, users1.admin_name as creator, users2.admin_name as updater";
		}
		if($status != "")
		{
			$where .= " AND brands.display_status = '".$status."'";
		}
		$sql = "SELECT ".$select." 
				FROM ".DBPREFIX."_brands as brands";
		if($noname == "")
		{
			$sql .= " LEFT JOIN ".DBPREFIX."_backend_users as users1 ON brands.created_id = users1.admin_id
				 LEFT JOIN ".DBPREFIX."_backend_users as users2 ON brands.updated_id = users2.admin_id";
		}		
		$sql .= " WHERE deleted_id is NULL ".$where."  ORDER BY ".$order." brand_id ASC";
		//		echo $sql;die;
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();			
		}
		
	}
	
	function insertbrands($data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$this->db->insert_batch(DBPREFIX."_brands", $data); 
		return TRUE;
	}
	
	function deletebrands($brand_id,$data)
	{
		$arr = array('brand_id' => $brand_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_brands", $data);
	//	echo "update".$brand_id;print_r($data);die;
		return TRUE;
	}
	
	
	function updatebrands($brand_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('brand_id' => $brand_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_brands", $data[0]);
	//	echo "update".$brand_id;print_r($data);die;
		return TRUE;
	}
	
	public function getBrandsByID($brand_id)
	{
		$sql = "SELECT * FROM ".DBPREFIX."_brands 
				WHERE brand_id = '".$brand_id."'				
				";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
	}	
}	
?>