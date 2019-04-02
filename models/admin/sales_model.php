<?php
class Sales_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function insertinvoice($insertArr = array())
	{		
		$this->db->insert(DBPREFIX."_sales",$insertArr);
	}
	public function updateinvoice($insertArr = array())
	{
	        $id = $insertArr['order_id'];
	        $this->db->where('order_id',$id);		
		$this->db->update(DBPREFIX."_sales",$insertArr);
	}
	public function updateorder($insertArr2 = array())
	{
	        $id = $insertArr2['order_id'];
	        $this->db->where('order_id',$id);		
		$this->db->update(DBPREFIX."_orders",$insertArr2);
	}	
	
	public function delete_pendingorder($order_id = "")
	{
		$this->db->where('order_id', $order_id);
		$this->db->delete(DBPREFIX."_orders");
	}
	
	public function addAppStatus($order_id = "")
	{
	        $this->db->set('approved','yes');
		$this->db->where('order_id', $order_id);
		$this->db->update(DBPREFIX."_orders");
	}
	
	public function addtrackingId($order_id,$tracking_id)
	{
	        $this->db->set('manual_tracking_id',$tracking_id);
		$this->db->where('order_id', $order_id);
		$this->db->update(DBPREFIX."_orders");
	}
	
	public function addpaymentreff($order_id,$payreff_code)
	{
	        $this->db->set('payment_ref_no',$payreff_code);
		$this->db->where('order_id', $order_id);
		$this->db->update(DBPREFIX."_orders");
	}
	
	public function getSalesInvoice($inv_id = "")
	{		
		$sql = "SELECT * FROM ".DBPREFIX."_sales";
		if($inv_id != "")
		{
			$sql = "SELECT * FROM ".DBPREFIX."_sales WHERE order_id = '".$inv_id."'";
		}
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{			
			$sales = array();
			$sales = $result->result_array();
			$dataArr = array();
			$dataArr["customer"] = $dataArr["backend"] = $dataArr["vendors"] = "";
			foreach ($sales as $sale)
			{
				$dataArr["customer"] .= "'".$sale["customer_id"]."',";
				$dataArr["backend"] .= "'".$sale["delivered_by"]."',";
				$dataArr["backend"] .= "'".$sale["created_by"]."',";
				$vendors =  unserialize($sale["vendor_ids"]);
			//	echo "<pre>";print_r($vendors);die;
				for($i =0; $i<count($vendors); $i++)
				{
					$dataArr["vendors"] .= "'".$vendors[$i]."',";
				}				
			}			
			$dataArr["customer"] = substr($dataArr["customer"],0,strlen($dataArr["customer"])-1);
			$dataArr["backend"] = substr($dataArr["backend"],0,strlen($dataArr["backend"])-1);
			$dataArr["vendors"] = substr($dataArr["vendors"],0,strlen($dataArr["vendors"])-1);
		//	echo "<pre>";print_r($dataArr);die;
			$resArr = array();
			$customer = array();
			$backend = array();
			$vendors = array();
			$sql = "SELECT id,firstname as name FROM ".DBPREFIX."_users
					WHERE id IN (".$dataArr["customer"].")
				";
			$result = $this->db->query($sql);
			if($result && $result->num_rows()>0)
			{				
				$resArr = $result->result_array();
				foreach($resArr as $arr)	
				{
					$customer[$arr["id"]] = $arr["name"];
				}
			}
			$sql = "SELECT admin_id, admin_name AS name FROM ".DBPREFIX."_backend_users
					WHERE admin_id IN (".$dataArr["backend"].")
				";
			$result = $this->db->query($sql);
			if($result && $result->num_rows()>0)
			{				
				$resArr = $result->result_array();
				foreach($resArr as $arr)	
				{
					$backend[$arr["admin_id"]] = $arr["name"];
				}
			}
	/*		$sql = "SELECT vendor_id, CONCAT('<b>',vendor_name,'</b><br />',vendor_address,'<br /> Mobile : ',vendor_mobile,'<br /> Phone :',vendor_phone,'<br /><br />') AS vendor_det FROM ".DBPREFIX."_vendors
					WHERE vendor_id IN (".$dataArr["vendors"].")
				";
			$result = $this->db->query($sql);
			if($result && $result->num_rows()>0)
			{				
				$resArr = $result->result_array();
				foreach($resArr as $arr)	
				{
					$vendors[$arr["vendor_id"]] = $arr["vendor_det"];
				}
			}   */
			$retArr = array();
			foreach ($sales as $sale)
			{				
				$sale["customer_name"] = $customer[$sale["customer_id"]];
				$sale["delivery_name"] = $backend[$sale["delivered_by"]];
				$sale["creator_name"] = $backend[$sale["created_by"]];
				$vendor = unserialize($sale["vendor_ids"]);
				$sale["vendor_details"] = ""; 
				for($i=0; $i<count($vendor);$i++)
				{
					$sale["vendor_details"] .= $vendors[$vendor[$i]];
				}
				$retArr[] = $sale;
			}
		//	echo "<pre>";print_r($retArr);die;
			return $retArr;
		}
	}




	public function update_commission_status($inv_id = NULL)
 {
  
  $sql = "SELECT affiliate_comm_status FROM ".DBPREFIX."_sales WHERE order_id ='".$inv_id."'";
  $result = $this->db->query($sql);
  
  if($result && $result->num_rows()>0)
  {
   foreach ($result->result_array() as $row)
   {
   if ($row['affiliate_comm_status'] == pay)
   {
   
    $data = array(  
'affiliate_comm_status' => paid  
);  

  $this->db->where('order_id', $inv_id);
  $this->db->update(DBPREFIX."_sales" , $data);
    }
    else{
     
    $data = array(  
'affiliate_comm_status' => pay  
);  

  $this->db->where('order_id', $inv_id);
  $this->db->update(DBPREFIX."_sales" , $data);
    }
   }
  }
  
 }
 
 
 	public function getDownOrders($month= "",$year= "")
	{
		
		
		$this->db->select('*');
		$this->db->from('_sales');
		$array = array('sale_month' => $month , 'sale_year' => $year);
		$this->db->where($array);
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
		
		
	}
	
	public function getyear()
	{
		$this->db->select('sale_year');
		$this->db->from('_sales');
		$this->db->group_by('sale_year');
		$this->db->order_by('sale_year',ASC);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function getmonth()
	{
		$this->db->select('sale_month');
		$this->db->from('_sales');
		$this->db->group_by('sale_month');
		$this->db->order_by('sale_month',ASC);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

  public function getAffiliateName($affId)
 {

      $sql = "
   SELECT user_id FROM ".DBPREFIX."_affiliate_user
   WHERE (
      `affiliate_id` = '".$affId."'
      )
      
  ";  
  $result = $this->db->query($sql);
  if ($result->num_rows() > 0)
  {
   return $result->result_array();
  }  
  return FALSE;
 }
 
 function getaffiId($affiliate_code)
	{
	$this->db->select("affiliate_id");
	$this->db->from("_affiliate_user");
	$this->db->where('user_id', $affiliate_code);
	$query = $this->db->get();
	return $query->result_array();
	}
 
}
?>