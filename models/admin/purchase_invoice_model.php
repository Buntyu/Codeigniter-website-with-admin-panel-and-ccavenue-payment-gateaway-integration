<?php
class Purchase_invoice_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	function getPurchaseInvoice($masterId = "",$select = "",$where = "")
	{
		$wherestr = "";
		if($masterId)
		{
			if(is_array($masterId))$masterId = implode("','",$masterId);
			$wherestr .= "AND invoice_id IN ('".$masterId."') ";
		}
		if($select == "")
		{
			$select = " * ";
		}
		if($where)$wherestr .= $where;
		$sql = "
			SELECT ".$select." FROM ".DBPREFIX."_purchase_invoice
			WHERE invoice_id != '0' ".$wherestr."
		";
		$result = $this->db->query($sql);
		$masters = array();
		if($result && $result->num_rows()>0)
		{
			 $masters = $result->result_array();	
			 $masterIds = array();		
			 foreach($masters as $invoices)
			 {
			 	$masterIds[]=$invoices["invoice_id"];
			 }
			 
			 $invoiceitems = $this->getInvoiceItems($masterIds);
			 foreach($masters as $key=>$invoices)
			 {
			 	$masters[$key]["invoiceitems"] = array();
			 	foreach($invoiceitems as $items)
				{
					if($items["purchase_master_id"] == $invoices["invoice_id"])
					{
						$masters[$key]["invoiceitems"][] = $items;
					}
				}
			 }
			 return $masters;			 
		}
		else return FALSE;
	}
	
	public function getInvoiceItems($masterIds)
	{
		if(is_array($masterIds))$masterIds = implode("','",$masterIds);
		$sql = "
			SELECT * FROM ".DBPREFIX."_purchase_invoice_items 
			WHERE purchase_master_id IN ('".$masterIds."')
			";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
	}
	
	public function insertInvoice($data)
	{		
		foreach($data as $invoices)
		{
			$items = $invoices["items"];
			unset($invoices["items"]);			
			$this->db->insert(DBPREFIX."_purchase_invoice",$invoices);
			$master_id = $this->db->insert_id();
			foreach($items as $key=>$value)
			{
				$items[$key]["purchase_master_id"] = $master_id;
			}
			$this->db->insert_batch(DBPREFIX."_purchase_invoice_items", $items);			
		}
	}
	
	public function updateInvoice($data)
	{
		foreach($data as $invoices)
		{
			$items = $invoices["items"];
			unset($invoices["items"]);	
			$this->db->where(array("invoice_id"=>$invoices["invoice_id"]));		
			unset($invoices["invoice_id"]);
			$this->db->update(DBPREFIX."_purchase_invoice",$invoices);
			$master_id = $this->db->insert_id();
			foreach($items as $key=>$value)
			{
				$this->db->where(array("purchase_invoice_item_id"=>$value["purchase_invoice_item_id"]));		
				unset($value["purchase_invoice_item_id"]);
				$this->db->update(DBPREFIX."_purchase_invoice_items", $value);
			}
		}
	}
	
	
	public function deleteInvoice($master_id)
	{
		$this->db->delete(DBPREFIX.'_purchase_invoice', array('invoice_id' => $master_id));
		$this->db->delete(DBPREFIX.'_purchase_invoice_items', array('purchase_master_id' => $master_id));
	}
}
?>