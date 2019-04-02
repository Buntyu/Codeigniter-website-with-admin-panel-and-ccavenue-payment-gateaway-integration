<?php
class Vendors_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- Vendors -----------------------------      ////////
	function getVendors($vendor_id = "",$select = "")
	{
		$where = "";
		if($vendor_id)
		{
			$where = " AND vendors.vendor_id = '".$vendor_id."'";
		}
		if(is_array($vendor_id))
		{
			$where = " AND vendors.vendor_id IN ('".implode("','",$vendor_id)."')";
		}
		if($select == "")
		{
			$select = "vendors.*, users1.admin_id as userid1, users2.admin_id as userid2, users1.admin_name as name1, users2.admin_name as name2";
		}
		$sql = "SELECT ".$select." 
				FROM ".DBPREFIX."_vendors as vendors
				LEFT JOIN ".DBPREFIX."_backend_users as users1 ON vendors.created_id = users1.admin_id
				LEFT JOIN ".DBPREFIX."_backend_users as users2 ON vendors.updated_id = users2.admin_id
				WHERE deleted_id is NULL ".$where;			
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();			
		}
		
	}
	
	function insertVendors($data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$this->db->insert_batch(DBPREFIX."_vendors", $data); 
		return TRUE;
	}
	
	function getVendorsAreas()
	{
		$sql = "SELECT vendor_area FROM ".DBPREFIX."_vendors
			WHERE deleted_id is NULL
		";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			$areas = $result->result_array();			
			$retVal = array();
			foreach($areas as $area)
			{
				foreach(explode(",",$area["vendor_area"]) as $each)
				{
					$retVal[$each] = $each;
				}
			}
			return $retVal;
		}
	}
	
	function deleteVendors($vendor_id,$data)
	{
		$arr = array('vendor_id' => $vendor_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_vendors", $data);
	//	echo "update".$vendor_id;print_r($data);die;
		return TRUE;
	}
	
	
	/**
	* this function is common for vendors and subvendors
	* @param undefined $vendor_id
	* @param undefined $data
	* 
	*/
	function updateVendors($vendor_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('vendor_id' => $vendor_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_vendors", $data[0]);
	//	echo "update".$vendor_id;print_r($data);die;
		return TRUE;
	}
	
	
	
	///////     ----------------------- Sub Vendors -----------------------------      ////////
	function getChildVendors($subvendor_id = "",$parentvendor_id = "")
	{
		$where = "";
		if($subvendor_id)
		{
			$where = " AND c1.vendor_id = '".$subvendor_id."'";
		}
		else if(is_array($subvendor_id))
		{
			$where = " AND c1.vendor_id IN ('".implode("','",$subvendor_id)."')";
		}
		
		if($parentvendor_id)
		{
			$where = " AND c1.parent_vendor_id = '".$parentvendor_id."'";
		}
		else if(is_array($parentvendor_id))
		{
			$where = " AND c1.parent_vendor_id IN ('".implode("','",$parentvendor_id)."')";
		}
		
		$sql = "SELECT c1.*, users1.admin_id as userid1, users2.admin_id as userid2, users1.admin_name as name1, users2.admin_name as name2
			FROM ".DBPREFIX."_vendors  as c1
			LEFT JOIN ".DBPREFIX."_backend_users as users1 
			ON c1.created_id = users1.admin_id
			LEFT JOIN ".DBPREFIX."_backend_users as users2 
			ON c1.updated_id = users2.admin_id
			WHERE c1.parent_vendor_id != '0'  AND c1.deleted_id is NULL".$where;
		$result = $this->db->query($sql);		
		if($result && $result->num_rows()>0)
		{
			$vendorsData = $result->result_array();			
			$parentVendors = array();
			foreach($vendorsData as $key=>$vendors)
			{
				$parentVendors = $this->getVendors(explode(",",$vendors['parent_vendor_id']),"vendors.vendors_name");
				$arrParent = array();				
				foreach($parentVendors as $parents)
				{
					 $arrParent[] = $parents["vendors_name"];
				}
				$vendorsData[$key]['vendors_parent'] = implode(", ",$arrParent);
				
			}
		//	echo "<pre>";print_r($vendorsData);die;
			return $vendorsData;
		}
	}
}	
?>