<?php
class Login_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	
	function getUserByID1($user_id)
	{ 
			$sql = "
			SELECT * 
			FROM ".DBPREFIX."_users        
			WHERE id = '$user_id'			
		";
		
	//	echo $sql;die;
	
		$result = $this->db->query($sql);
		
		if($result && $result->num_rows() > 0)
		{
			foreach ($result->result_array() as $row)
			
      {
        $data[] = $row;
		
      }
      return $data;
			
		}
	}
	
	function getGuestUserByID1($user_id)
	{ 
			$sql = "
			SELECT * 
			FROM ".DBPREFIX."_guest_user        
			WHERE id = '$user_id'			
		";
		
	//	echo $sql;die;
	
		$result = $this->db->query($sql);
		
		if($result && $result->num_rows() > 0)
		{
			foreach ($result->result_array() as $row)
			
      {
        $data[] = $row;
		
      }
      return $data;
			
		}
	}
	
		
	public function EditUserAccount($postedData,$user_id)
	{
		
$this->db->where("id",$user_id);
		if($this->db->update(DBPREFIX."_users",$postedData))
		{
			return TRUE;
			echo "hello";
		}
		else
		{
			return FALSE;
		}		
	}
	
	public function AddGuestAccount($data){
		if($this->db->insert(DBPREFIX."_guest_user",$data))
		{
			$id_arr[] = $this->db->insert_id();
			return $id_arr;
		}
		else
		{
			return FALSE;
		}
	}
	
	
}
?>