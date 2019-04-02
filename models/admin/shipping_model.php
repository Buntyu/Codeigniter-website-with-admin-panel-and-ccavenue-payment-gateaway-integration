<?php
class shipping_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- Shipping -----------------------------      ////////
	function getShips($ship_id = "",$select = "",$order = "")
	{
		
		$where = "";
		if($ship_id)
		{
			$where = " AND shipping.ship_id = '".$ship_id."'";
		}
		if(is_array($ship_id))
		{
			$where = " AND shipping.ship_id IN ('".implode("','",$ship_id)."')";
		}
		if($select == "")
		{
			$select = "shipping.*";
		}
		
		$sql = "SELECT ".$select." 
				FROM ".DBPREFIX."_shipping as shipping";
				
		$sql .= " ORDER BY ".$order."ship_id ASC";
		//		echo $sql;die;
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();			
		}
		
	}
	
	function insertshipping($data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$this->db->insert_batch(DBPREFIX."_shipping", $data); 
		return TRUE;
	}
	
	function deleteships($ship_id)
	{
		$arr = array('ship_id' => $ship_id);		
		$this->db->where($arr); 
		$this->db->delete(DBPREFIX."_shipping", $arr);

	//	echo "update".$ship_id;print_r($data);die;
		return TRUE;
	}
	
	
	function updateShips($ship_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('ship_id' => $ship_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_shipping", $data[0]);
	//	echo "update".$ship_id;print_r($data);die;
		return TRUE;
	}
	
	public function getShipsByID($ship_id)
	{
		$sql = "SELECT * FROM ".DBPREFIX."_shipping 
				WHERE ship_id = '".$ship_id."'				
				";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
	}
	
	function getShipping_aus()
	{
		$this->db->select('*');
		$this->db->from('_shipping');
		$this->db->where('country_name','AUSTRALIA');
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getShipping_usa()
	{
		$this->db->select('*');
		$this->db->from('_shipping');
		$this->db->where('country_name','USA');
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getShipping_uk()
	{
		$this->db->select('*');
		$this->db->from('_shipping');
		$this->db->where('country_name','UK');
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getShipping_eur()
	{
		$this->db->select('*');
		$this->db->from('_shipping');
		$this->db->where('country_name','EUROPE');
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getShipping_other()
	{
		$this->db->select('*');
		$this->db->from('_shipping');
		$this->db->where('country_name','All Other Countries');
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getShipping_india()
	{
		$this->db->select('*');
		$this->db->from('_shipping');
		$this->db->where('country_name','India');
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function GetCurrencyAud()
	{
		$this->db->select('curr_amount');
		$this->db->from('_currency');
		$this->db->where('curr_name','AUD');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	function GetCurrencyUsd()
	{
		$this->db->select('curr_amount');
		$this->db->from('_currency');
		$this->db->where('curr_name','USD');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	function GetCurrencyGbp()
	{
		$this->db->select('curr_amount');
		$this->db->from('_currency');
		$this->db->where('curr_name','GBP');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	function GetCurrencyEuro()
	{
		$this->db->select('curr_amount');
		$this->db->from('_currency');
		$this->db->where('curr_name','EURO');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	function GetCurrencyOther()
	{
		$this->db->select('curr_amount');
		$this->db->from('_currency');
		$this->db->where('curr_name','Other');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
		
}	
?>