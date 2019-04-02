<?php 
class Coupons_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- coupons -----------------------------      ////////
	function getCoupons($coupon_id = "",$select = "")
	{
		$where = "";
		if($coupon_id)
		{
			$where .= " AND coupon_id = '".$coupon_id."'";
		}
		if($select == "")
		{
			$select = "coupons.*";
		}
			$sql = "SELECT  ".$select."
				FROM ".DBPREFIX."_coupons as coupons
				
				
				ORDER BY coupon_code ASC
				";	
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();	

		}
	}
	
	function insertcoupons($data)
	{
		
		if(!(isset($data[0])))$data[0] = $data;		
		$this->db->insert_batch(DBPREFIX."_coupons", $data); 
	//	echo "<pre>";print_r($data);die;
		return TRUE;
	}
	
	/**
	* @param undefined $category_id
	* @param undefined $data
	* 
	*/
	function updatecoupons($coupon_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('coupon_id' => $coupon_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_coupons", $data[0]);		
	//	echo "update".$coupon_id;print_r($data);die;
		return TRUE;
	}
	
	public function deletecoupon($coupon_id,$data)	
	{
		$arr = array('coupon_id' => $coupon_id);	
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_coupons", $data);	
		$this->db->delete(DBPREFIX."_coupons", $arr);  	
	}

	public function getCouponsByID($coupon_id)
	{
		$sql = "SELECT * FROM ".DBPREFIX."_coupons 
				WHERE coupon_id = '".$coupon_id."'				
				";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
	}	
}	
?>