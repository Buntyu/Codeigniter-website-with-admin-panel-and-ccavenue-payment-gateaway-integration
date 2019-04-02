<?php
class Order_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	function placeOrder($orderData)
	{
		$this->db->insert(DBPREFIX."_orders",$orderData);
	//	echo $this->db->last_query();die;
	}
	function placeCodOrder($orderData)
	{
		$this->db->insert(DBPREFIX."_orders",$orderData);
	//	echo $this->db->last_query();die;
	}
	function finalOrder($secondOrder,$order_UID)
	{
		$this->db->where('order_uid',$order_UID);
		$this->db->update('_orders',$secondOrder);

	}
	function placeOrderTwo($orderData)
	{
		$this->db->insert(DBPREFIX."_tmp_orders",$orderData);
		 $insert_id = $this->db->insert_id();

           return  $insert_id;
		//echo $this->db->last_query();die;
	}
	function responseData($responseData)
	{
		$this->db->insert(DBPREFIX."_orders",$responseData);
	//	echo $this->db->last_query();die;
	}
	
	function getOrders($order_id = "")
	{
		$sql = "
			SELECT orders.*,user.firstname 
			FROM ".DBPREFIX."_orders as orders        
			LEFT JOIN ".DBPREFIX."_users as user 
			ON orders.customer_id = user.id 
			WHERE orders.is_viewed = '0' && orders.order_status = 'Success'	&& orders.approved = ''		
		";
		if($order_id)
		{
			$sql .= " AND order_id = '".$order_id."'";
		}
	//	echo $sql;die;
		$result = $this->db->query($sql);
		if($result && $result->num_rows() > 0)
		{
			return $result->result_array();
		}
	}
	
	function getOrdersAll($order_id = "")
	{
		$sql = "
			SELECT orders.*,user.firstname 
			FROM ".DBPREFIX."_orders as orders        
			LEFT JOIN ".DBPREFIX."_users as user 
			ON orders.customer_id = user.id 
			WHERE orders.is_viewed = '0' && orders.order_status = 'Success'	&& orders.approved = 'yes'		
		";
		if($order_id)
		{
			$sql .= " AND order_id = '".$order_id."'";
		}
	//	echo $sql;die;
		$result = $this->db->query($sql);
		if($result && $result->num_rows() > 0)
		{
			return $result->result_array();
		}
	}
	
	function getCcDate($order_id = "")
	{
	$this->db->select("ccavenue_date");
	$this->db->from("_sales");
	$this->db->where('order_id', $order_id);
	
	$query = $this->db->get();
	return $query->result_array();
	}
	
    function deleteOrder($order_id)
	{
		$arr = array('order_id' => $order_id);		
		$this->db->where($arr); 
		$this->db->delete(DBPREFIX."_orders", $arr);
		return TRUE;
	}
	
	function deleteAbdOrder($abd_cartID)
	{
		$arr = array('abd_cartID' => $abd_cartID);		
		$this->db->where($arr); 
		$this->db->delete(DBPREFIX."_abandoned_cart", $arr);
		return TRUE;
	}
	
}
?>