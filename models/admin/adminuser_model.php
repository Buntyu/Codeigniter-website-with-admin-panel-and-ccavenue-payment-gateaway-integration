<?php
class Adminuser_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	function getbackendUsers($admin_id = "")
	{
		$where = "";
		if($admin_id != "")$where = " AND buser.admin_id = '".$admin_id."'";
		$sql = "SELECT buser.*, buser2.admin_name as creator,user_type.user_type_dpname as user_type_dpname , user_type.user_type_name as user_type_name 
			FROM ".DBPREFIX."_backend_users as buser
			LEFT JOIN  ".DBPREFIX."_backend_usertype as user_type
			ON user_type.user_type_id = buser.user_type
			LEFT JOIN  ".DBPREFIX."_backend_users as buser2
			ON buser2.admin_id = buser.creator_id
			WHERE buser.admin_id != 0 ".$where."
			ORDER BY buser.admin_id ASC";		
		//	echo $sql;die;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}		
		return FALSE;
	}
	function delete_admin($admin_id)
	{
		$this->db->where('admin_id', $admin_id);
		$this->db->delete(DBPREFIX."_backend_users");
	}
	 
	function getuserbyid($adminid)
	{
		$this->db->where('admin_id', $typeid);		
		$query = $this->db->get(DBPREFIX."_backend_users");
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}		
		return FALSE;
	}
	
	public function createadminuser($data)
	{
		$sql = "INSERT INTO ".DBPREFIX."_backend_users 
			(admin_username,admin_password,admin_name,user_type,admin_email,admin_mobile,creator_id,created_date)
			VALUES 
			('".$data['admin_username']."','".$data['admin_password']."','".$data['admin_name']."','".$data['user_type']."','".$data['admin_email']."','".$data['admin_mobile']."','".$data['creator_id']."','".$data['created_date']."')
		";			
//		echo $sql;die;	
		$this->db->query($sql);
	}
	
	public function editadminuser($data)
	{
		$sql = "UPDATE ".DBPREFIX."_backend_users 
			SET 
			admin_username = '".$data['admin_username']."',
			admin_password = '".$data['admin_password']."',
			admin_name = '".$data['admin_name']."',
			user_type = '".$data['user_type']."',
			admin_email = '".$data['admin_email']."',
			admin_mobile = '".$data['admin_mobile']."'
			WHERE 
			admin_id = '".$data['admin_id']."'		
			";
		$this->db->query($sql);		
	}
}
?>