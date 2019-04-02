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
	
	function getOrders($user_id)
	{
		$sql = "
			SELECT YEAR(ccavenue_date) AS YEAR, MONTH(ccavenue_date) AS MONTH, WEEK(ccavenue_date) AS WEEK,sales.*,user.firstname 
			FROM ".DBPREFIX."_sales as sales        
			LEFT JOIN ".DBPREFIX."_users as user 
			ON sales.customer_id = user.id 
			WHERE sales.affiliate_id = '$user_id' AND ccavenue_date != '0000-00-00'			
		ORDER BY YEAR DESC;";
		if($order_id)
		{
			$sql .= " AND order_id = '".$order_id."'";
		}
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
	function getOrders1($user_id)
	{
		
		
		$sql = "
			SELECT orders.*,user.firstname
			FROM ".DBPREFIX."_orders as orders        
			LEFT JOIN ".DBPREFIX."_users as user 
			ON orders.customer_id = user.id
			WHERE orders.customer_id = '$user_id' && orders.order_status = 'Success'			
		";
		if($order_id)
		{
			$sql .= " AND order_id = '".$order_id."'";
		}
	//	echo $sql;die;
		$result = $this->db->query($sql);
		//echo $result;die;
		if($result && $result->num_rows() > 0)
		{
			foreach ($result->result_array() as $row)
      {
        $data[] = $row;
      }
      return $data;
			
		}
	}
	function getOrders2($order_id)
	{
		
		$sql = "
			SELECT orders.*,user.email,user.mobile  
			FROM ".DBPREFIX."_orders as orders        
			LEFT JOIN ".DBPREFIX."_users as user 
			ON orders.customer_id = user.id
			WHERE orders.order_id = '$order_id'			
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
	 
	 
}
?>