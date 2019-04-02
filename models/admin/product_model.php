<?php
class Product_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- Product -----------------------------      ////////
	function getProduct($product_id = "",$select = "",$where = "")
	{
		if(is_array($product_id))
		{
			$where = " AND product.product_id IN ('".implode("','",$product_id)."')";
		}
		else if($product_id)
		{
			$where = " AND product.product_id = '".$product_id."'";
		}		
		if($select == "")
		{
			$select = "product.*, users1.admin_id as userid1, users2.admin_id as userid2, users1.admin_name as name1, users2.admin_name as name2";
		}
		$sql = "SELECT ".$select." 
				FROM ".DBPREFIX."_product as product
				LEFT JOIN ".DBPREFIX."_backend_users as users1 ON product.created_id = users1.admin_id
				LEFT JOIN ".DBPREFIX."_backend_users as users2 ON product.updated_id = users2.admin_id
				WHERE deleted_id is NULL ".$where;	
	//	echo $sql;
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();			
		}
		
	}
	
	function insertProduct($data)
	{
		if(!(isset($data[0])))$data[0] = $data;
	//	echo "<pre>";print_r($data);die;
		$this->db->insert_batch(DBPREFIX."_product", $data); 
		return TRUE;
	}
	
	function deleteProduct($product_id)
	{
		$arr = array('product_id' => $product_id);		
		$this->db->where($arr); 
		$this->db->delete(DBPREFIX."_product", $arr);
		
	//	echo "update".$product_id;print_r($data);die;
		return TRUE;
	}
	
	
	/**
	* this function is common for product and subproduct
	* @param undefined $product_id
	* @param undefined $data
	* 
	*/
	function updateProduct($product_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('product_id' => $product_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_product", $data[0]);
	//	echo "update".$product_id;print_r($data);die;
		return TRUE;
	}
	
	function updateProducts($data)
	{
		$this->db->update_batch(DBPREFIX."_product", $data, 'product_id'); 
		return TRUE;
	}

	public function getProductsByID($product_id)
	{
		$sql = "SELECT * FROM ".DBPREFIX."_product 
				WHERE product_id = '".$product_id."'				
				";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
	}
	public function GetCurrData()
	{
		$sql = "SELECT * FROM ".DBPREFIX."_currency";
		$result = $this->db->query($sql);
		return $result->result_array();

		//print_r($test[0]['curr_amount']);die;
	}	
}	
?>