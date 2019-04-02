<?php
class User_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	function checkUserId($user_id)
	{
		$this->db->where("userid",$user_id);
		$result = $this->db->get(DBPREFIX."_users");

		$this->db->where("user_id",$user_id);
		$result1 = $this->db->get(DBPREFIX."_affiliate_user");
		
		if($result && $result->num_rows()>0 || $result1 && $result1->num_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;			
		}
	}
	
	function checkOldPass($old_pass)
	{
		$this->db->where("password",$old_pass);
		$result = $this->db->get(DBPREFIX."_users");
		if($result && $result->num_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;			
		}
	}
	
	function checkOldPass2($old_pass)
	{
		$this->db->where("Affi-Password",$old_pass);
		$result = $this->db->get(DBPREFIX."_affiliate_user");
		if($result && $result->num_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;			
		}
	}
	
	function addNewUser($data)
	{
		if($this->db->insert(DBPREFIX."_users",$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function getUserByID($user_id)
	{
		$this->db->where("id",$user_id);
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
	
	function getUserByEmail($email_id)
	{
	
		$this->db->where("email",$email_id);
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
	
	function getAffiByEmail($email_id)
	{
	
		$this->db->where("email",$email_id);
		$result = $this->db->get(DBPREFIX."_affiliate_user");
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return FALSE;			
		}
	}
	
	public function updateUser($user_id,$data)
	{
	//	echo "<pre>";print_r($data);die;
		$this->db->where("id",$user_id);
		if($this->db->update(DBPREFIX."_users",$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	public function checkReffCode($reff_code)
	{
		$this->db->where("user_id",$reff_code);
		$result = $this->db->get(DBPREFIX."_affiliate_user");
		if($result && $result->num_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;			
		}
	}

	public function getAffiliateId($reff_code)
 {

      $sql = "
   SELECT affiliate_id FROM ".DBPREFIX."_affiliate_user
   WHERE (
      `user_id` = '".$reff_code."'
      OR
      `email` = '".$reff_code."'
      )
      
  ";  
  $result = $this->db->query($sql);
  if ($result->num_rows() > 0)
  {
   return $result->result_array();
  }  
  return FALSE;
 
 }
 
 
 public function EditUserPassword($postedData,$user_id)
	{
		
		$this->db->where("id",$user_id);
		if($this->db->update(DBPREFIX."_users",$postedData))
		{
			return TRUE;
			
		}
		else
		{
			return FALSE;
		}		
	}
	
	public function EditUserPassword2($postedData,$user_id)
	{
		
		$this->db->where("affiliate_id",$user_id);
		if($this->db->update(DBPREFIX."_affiliate_user",$postedData))
		{
			return TRUE;
			
		}
		else
		{
			return FALSE;
		}		
	}
	
	
	//funtion to get email of user to send password
 public function ForgotPassword($email)
 {
        $this->db->select('email');
        $this->db->from('_users'); 
        $this->db->where('email', $email); 
        $query=$this->db->get();
        return $query->row_array();
 }

  public function updatePassword($id,$uname, $data)
  {
  $array = array('id' => $id, 'userid' => $uname);
   $this->db->where($array);
   $this->db->update('_users',$data);
  
  }
  
  public function updatePassword2($id,$uname, $data)
  {
  $array = array('affiliate_id' => $id, 'user_id' => $uname);
   $this->db->where($array);
   $this->db->update('_affiliate_user',$data);
  
  }
  
  public function getAffEmail($AffId)
  {
       $this->db->select('email,first_name');
       $this->db->from('_affiliate_user');
       $this->db->where('affiliate_id',$AffId);
       
      $query = $this->db->get();
      $result = $query->result_array();
     return $result;
       
  }

 public function insertPopupData($popupData){
	$this->db->insert("_popup_optin",$popupData);
}






}
?>