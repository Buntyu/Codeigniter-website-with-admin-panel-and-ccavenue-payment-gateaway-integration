<?php
class Subcription_model extends CI_model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
		$this->load->library('session');
	}
	
	function addsubscription($email)
	{
		$data['email'] = $email;
		$data['date'] = date('Y-m-d H:i:s');
		if($this->db->insert(DBPREFIX."_subscriptions",$data))
		return TRUE;
		return FALSE;
	}
	
	function unsubscribe($email)
	{
		$this->db->where("email",$email);
		if($this->db->delete(DBPREFIX."_subscriptions"))
		return TRUE;
		return FALSE;
	}
	
	function getallsubscribed()
	{
		$result = $this->db->get(DBPREFIX."_subscriptions");
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
	}
}
?>