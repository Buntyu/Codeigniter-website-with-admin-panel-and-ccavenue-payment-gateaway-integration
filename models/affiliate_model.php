<?php
class Affiliate_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	function checkUserId($user_id)
	{
		$this->db->where("user_id",$user_id);
		$result = $this->db->get(DBPREFIX."_affiliate_user"); 

		$this->db->where("userid",$user_id);
		$result1 = $this->db->get(DBPREFIX."_users"); 

		if($result && $result->num_rows()>0 || $result1 && $result1->num_rows()>0)
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

		//echo "<pre>";print_r($data);die;
		if($this->db->insert(DBPREFIX."_affiliate_user",$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
     

	}

	function addNewCoupon($data)
	{

		//echo "<pre>";print_r($data['user_id']);die;
		if($this->db->insert(DBPREFIX."_coupons",$data))
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
	
	function getUserByEmail($email_id)
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
		echo "<pre>";print_r($data);die;
		$this->db->where("id",$user_id);
		if($this->db->update(DBPREFIX."_affiliate_user",$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function getUserByID1($affiliate_id) {    
	$sql = "   SELECT *    FROM ".DBPREFIX."_affiliate_user           
	WHERE affiliate_id = '$affiliate_id'     ";   
	// echo $sql;die;   
	$result = $this->db->query($sql);    
	if($result && $result->num_rows() > 0)  
		{   
			foreach ($result->result_array() as $row)         {
			        $data[] = $row;        
			    }      
			    return $data;     
			} 
		}


		public function editaffiliateuser($postedData,$affiliate_id) 
		{  
			$this->db->where("affiliate_id",$affiliate_id);  
			if($this->db->update(DBPREFIX."_affiliate_user",$postedData))  
				{   
					return TRUE;   
					 
				}  else  
				{   
					return FALSE;  
				}   
		}
		
	function getAffiMyuser($affiliate_id)
	{
	     $this->db->select('*');
	     $this->db->from('_users');
	     $this->db->where('aff_id',$affiliate_id);
	    
	     $query = $this->db->get();  
	     $result = $query->result_array();
	    return $result;
	     
	     	}
			
	

}
?>