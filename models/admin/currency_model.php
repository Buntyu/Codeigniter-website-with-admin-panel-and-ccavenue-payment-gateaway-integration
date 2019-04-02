<?php
class currency_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- brands -----------------------------      ////////
	function getBrands($curr_id = "",$select = "",$order = "")
	{
		//echo "pipo";
		$where = "";
		if($curr_id)
		{
			$where = " AND currency.curr_id = '".$curr_id."'";
		}
		if(is_array($curr_id))
		{
			$where = " AND currency.curr_id IN ('".implode("','",$curr_id)."')";
		}
		if($select == "")
		{
			$select = "currency.*";
		}
		
		$sql = "SELECT ".$select." 
				FROM ".DBPREFIX."_currency as currency";
				
		$sql .= " ORDER BY ".$order."curr_id ASC";
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
		$this->db->insert_batch(DBPREFIX."_currency", $data); 
		return TRUE;
	}
	
	function deletebrands($curr_id)
	{
		$arr = array('curr_id' => $curr_id);		
		$this->db->where($arr); 
		$this->db->delete(DBPREFIX."_currency", $arr);

	//	echo "update".$brand_id;print_r($data);die;
		return TRUE;
	}
	
	
	function updatebrands($curr_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('curr_id' => $curr_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_currency", $data[0]);
	//	echo "update".$brand_id;print_r($data);die;
		return TRUE;
	}
	
	public function getBrandsByID($curr_id)
	{
		$sql = "SELECT * FROM ".DBPREFIX."_currency 
				WHERE curr_id = '".$curr_id."'				
				";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
	}
	
	public function getallcurrency()
	{
	    $this->db->select("*");
	    $this->db->from("_currency");
	    
	    $query = $this->db->get();
	    $result = $query->result_array();
	    return $result;
	
	}	
}	
?>