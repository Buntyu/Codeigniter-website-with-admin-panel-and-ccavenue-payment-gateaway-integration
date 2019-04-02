<?php
class Product_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
		
	public function getProductNames()
	{
		$sql = "SELECT product_name FROM ".DBPREFIX."_product
			WHERE 
			deleted_id IS NULL AND display_status = '1'
			ORDER BY product_name DESC
			";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			$retVal = array();
			$retVal[]="";
			foreach($result->result_array() as $rows)
			$retVal[]=$rows["product_name"];
			return $retVal;
		}
	}
		
	public function getProduct($product_name="",$brand_id = "",$where = "",$offset="0",$limit="",$order = "",$select = "*")
	{
		$wherestr = "";
		if($product_name)
		{
			$product_name = $this->db->escape_like_str($product_name);			
			$wherestr .= " AND (
				product_name = '".$product_name."' OR  
				product_name LIKE '%".$product_name."%' OR
				product_name LIKE '%".$product_name."' OR
				product_name LIKE '".$product_name."%'
			)";
		}
		if($brand_id)
		{
			$wherestr .= " AND (
				brands_id = '".$brand_id."' OR  
				brands_id LIKE '%,".$brand_id.",%' OR
				brands_id LIKE '%,".$brand_id."' OR
				brands_id LIKE '".$brand_id.",%'
			)";
		}

		$wherestr .= $where;
		if($limit)$limit = "LIMIT ".$offset.",".$limit;
		$sql = "SELECT ".$select." FROM ".DBPREFIX."_product
			WHERE 
			deleted_id IS NULL AND display_status = '1' 
			".$wherestr." ORDER BY ".$order." product_id DESC ".$limit;			
	//	echo $sql;die;
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
	}
	
	public function getFeaturedProducts($offset="0",$limit="",$order = "",$rand = "")
	{	
		if($rand)
		{
			$order .= " RAND(), ";
		}				
		return $this->getProduct("",""," AND is_featured = '1' ",$offset,$limit,$order);	
	}
	
	public function getLatestProducts($offset = "0", $limit = "9",$order = "",$rand = "")
	{
		if($rand)
		{
			$order .= " RAND(), ";
		}		
		return $this->getProduct("",""," AND is_new = '1' ",$offset,$limit,$order);				
	}
	
	public function getProductData($wherestr = "",$limit = "", $order = "")
	{
		$sql = "SELECT product_id, product_name, product_price, discount_price, discount_status, product_image FROM ".DBPREFIX."_product
			WHERE 
			deleted_id IS NULL AND display_status = '1' 
			".$wherestr." ORDER BY ".$order." ".$limit;	
		
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{			
			return $result->result_array();
		}
	}

	public function getAvgRating($proID)
	{
                 $where=array(
             "product_id"=>$proID,
             );
        $this->db->where($where);
        $this->db->select_avg('ratings_score');
        $query = $this->db->get('_products_ratings')->first_row('array');
        return round($query['ratings_score'], 1);
	}

	public function getRevCount($proID)
	{
		$this->db->select("*");
		$this->db->from("_products_ratings");
		$this->db->where('product_id',$proID);
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		//echo $rowcount;die;
		return $rowcount;
	}

	public function get_rev_data($proID)
	{
		$this->db->select("*");
		$this->db->from("_products_ratings");
		$this->db->where('product_id',$proID);
		$query = $this->db->get();
		//$gg = $query->result();
		return $query->result_array();


/*		$offset = 0;
		$limit = 2;
		$sql = "SELECT * FROM ".DBPREFIX."_products_ratings WHERE product_id = $proID LIMIT $offset ,$limit";
		$result = $this->db->query($sql)->result();
		//print_r($result);die;
		//return $result;  */
	} 

	public function getAjaxReview($page, $proId){
    
		$offset = 4*$page;
		$limit = 4;
			$sql = "SELECT * FROM ".DBPREFIX."_products_ratings WHERE product_id = $proId ORDER BY ratings_id DESC LIMIT $offset ,$limit";
		$result = $this->db->query($sql)->result();
		return $result;
		//print_r($result);die;
		}
		


}
?>