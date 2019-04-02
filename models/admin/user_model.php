<?php
class User_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function getAllUsers($cust_id = "")
	{
		if($cust_id == "")
		{
			$this->db->where("is_deleted","0");
		}
		else
		{
			$this->db->where(array("is_deleted"=>"0", "id"=>$cust_id));
		}				
		$result = $this->db->get(DBPREFIX."_users");		
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return FALSE;			
		}
	}
	
	public function getuserbytype($typename = "")
	{
		$this->db->where("user_type",$typename);
		$result = $this->db->get(DBPREFIX."_backend_users");
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return FALSE;			
		}
	}
}
?>