<?php
class Personnel_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	///////     ----------------------- areas -----------------------------      //////// 
	function getAreas($affiliate_id = "",$select = "")
	{
		$where = "";
		if($affiliate_id) 
		{
			$where .= " AND affiliate_id = '".$affiliate_id."'";
		}
		if($select == "")
		{
			$select = "personnel.*";
		}
			$sql = "SELECT  ".$select."
				FROM ".DBPREFIX."_affiliate_user as personnel
				
				
				ORDER BY first_name ASC
				";	
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();			
		}
	}
	
	function insertareas($data)
	{
		
		if(!(isset($data[0])))$data[0] = $data;		
		$this->db->insert_batch(DBPREFIX."_affiliate_user", $data); 
		//echo "<pre>";print_r($data);die;
		return TRUE;
	}

	function updateareas($affiliate_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('affiliate_id' => $affiliate_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_affiliate_user", $data[0]);		
	//	echo "update".$area_id;print_r($data);die;
		return TRUE;
	}
	
	public function deletearea($affiliate_id)	
	{
		$arr = array('affiliate_id' => $affiliate_id);		
		$this->db->where($arr);	
		$this->db->delete(DBPREFIX."_affiliate_user", $arr);  

	}

  public function getSalesInvoice($affiliate_id = "")
	{		
//sql = "SELECT * FROM ".DBPREFIX."_sales";
		if($affiliate_id != "")
		{
		$sql = "SELECT YEAR(ccavenue_date) AS YEAR, MONTH(ccavenue_date) AS MONTH, WEEK(ccavenue_date,1) AS WEEK, DATE_FORMAT(ccavenue_date, '%Y-%m-%d') AS created_date, order_id,order_uid,customer_id,affiliate_id,cart_data,tracking_id,order_date,ccavenue_date,sale_amount,bank_reff_no,payment_mode,card_name,currency,total_tax,reff_discount,total_shipping,total_price,affiliate_comm,affiliate_comm_status,shipping_address,ship_city,ship_state,ship_country,ship_mobile,ship_name,shipping_area,shipping_pin,product_ids,product_quantities,created_by,created_date,sale_month,sale_year,is_guest,guest_name FROM ".DBPREFIX."_sales WHERE affiliate_id = '".$affiliate_id."' AND ccavenue_date != '0000-00-00' ORDER BY YEAR (ccavenue_date) DESC, MONTH(ccavenue_date) DESC, WEEK(ccavenue_date) DESC;";
		}
		$result = $this->db->query($sql);
		//$sales = $result->result_array();
		//return $sales;
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
			$sql = "SELECT id, firstname as name FROM ".DBPREFIX."_users
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

	public function getPersonnelByID($affiliate_id)
	{
		$sql = "SELECT * FROM ".DBPREFIX."_affiliate_user 
				WHERE affiliate_id = '".$affiliate_id."'				
				";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
	}
	
	public function getAffiPayments($affiliate_id)
	{
         $this->db->select("*");
         $this->db->from("_affiliate_payment");
         $this->db->where('affiliate_id',$affiliate_id);

         $query = $this->db->get();
         $result = $query->result_array();
         return $result;
	}	
	
		
 function demo()
	{
	$query = $this->db->query("SELECT _sales.affiliate_id as Name,Count(affiliate_comm_status) as SuccessfullTransaction  FROM _affiliate_user join _sales ON _sales.affiliate_id=_affiliate_user.affiliate_id WHERE _sales.affiliate_comm_status='pay' GROUP BY _affiliate_user.affiliate_id ORDER BY _affiliate_user.affiliate_id");

if($query && $query->num_rows()>0)
		{
			return $query->result_array();
		}	
	}
 function demo1()
	{
	$query = $this->db->query("SELECT _sales.affiliate_id as Name,Count(affiliate_comm_status) as SuccessfullTransaction  FROM _affiliate_user join _sales ON _sales.affiliate_id=_affiliate_user.affiliate_id WHERE _sales.affiliate_comm_status='paid' GROUP BY _affiliate_user.affiliate_id ORDER BY _affiliate_user.affiliate_id");

if($query && $query->num_rows()>0)
		{
			return $query->result_array();
		}	
	}
	
	public function insertPayment($posted = array())
	{
		$this->db->insert(DBPREFIX."_affiliate_payment",$posted);
	}


}	
?>