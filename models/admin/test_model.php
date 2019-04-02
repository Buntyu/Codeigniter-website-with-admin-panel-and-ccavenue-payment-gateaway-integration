<?php
class Test_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	function insertdummyentries($count="")
	{			
		if($count == "")$count = 10;
		$insertData = array();
		$name = array("Ibad","Sam","Raju","Sushant","Sammy","Zak","Jimmy","Aakash","Sameer");
		$pstatus = array("0","1");
		$astatus = array("1","2","3","4");
		$ncount = 0;$acnt = 0; $pcnt = 0;
		for($i = 0; $i< $count; $i++)
		{		
			if($ncount > count($name)-1)$ncount = 0;
			if($pcnt > count($pstatus)-1)$pcnt = 0;
			if($acnt > count($astatus)-1)$acnt= 0;
			$insertData[] = array
			(
				"name" => $name[$ncount],
				"dob" => date("Y-d-m",(strtotime(date("Y-d-m"))-(360000*$i))),
				"mobile" => $i,
				"description" => "sadf sdfsdfsdfs sdfsadfsd".$name[$ncount],
				"present_status" => $pstatus[$pcnt],
				"application_status" => $astatus[$acnt],
				"date_created" => date("Y-d-m",(strtotime(date("Y-d-m"))-(36000*$i))),
				"image_url" => "some url"
			);
			$ncount++;
			$pcnt++;
			$acnt++;
		}
//		echo "<pre>";print_r($insertData);die;
		$this->db->insert_batch(DBPREFIX."_test",$insertData);
	}
	
	function getdummyentries()
	{
		$query = $this->db->get(DBPREFIX."_test");
		if($query->num_rows() > 0)
		{
			return $query->result_array();			
		}
	}
}
?>