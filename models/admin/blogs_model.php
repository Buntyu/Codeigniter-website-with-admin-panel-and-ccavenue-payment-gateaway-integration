<?php
class Blogs_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- Product -----------------------------      ////////
	function getBlogs($blog_id = "",$select = "",$where = "")
	{
		if(is_array($blog_id))
		{
			$where = " AND blog.blog_id IN ('".implode("','",$blog_id)."')";
		}
		else if($blog_id)
		{
			$where = " AND blog.blog_id = '".$blog_id."'";
		}		
		if($select == "")
		{
			$select = "blog.*";
		}
		$sql = "SELECT ".$select." 
				FROM ".DBPREFIX."_blogs as blog";	
	//	echo $sql;
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();			
		}
		
	}
	
	function insertBlog($data)
	{
		if(!(isset($data[0])))$data[0] = $data;
	//	echo "<pre>";print_r($data);die;
		$this->db->insert_batch(DBPREFIX."_blogs", $data); 
		return TRUE;
	}
	
	function deleteProduct($blog_id)
	{
		$arr = array('blog_id' => $blog_id);		
		$this->db->where($arr); 
		$this->db->delete(DBPREFIX."_blogs", $arr);
		
	//	echo "update".$product_id;print_r($data);die;
		return TRUE;
	}
	
	function updateProduct($blog_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('blog_id' => $blog_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_blogs", $data[0]);
	//	echo "update".$product_id;print_r($data);die;
		return TRUE;
	}
	
	function updateProducts($data)
	{
		$this->db->update_batch(DBPREFIX."_product", $data, 'product_id'); 
		return TRUE;
	}

	public function getProductsByID($blog_id)
	{
		$sql = "SELECT * FROM ".DBPREFIX."_blogs 
				WHERE blog_id = '".$blog_id."'				
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

	function getAllData()
	{
	  
	  $this->db->select('*');
	  $this->db->order_by('blog_id','DESC');
	  $this->db->from('_blogs');
	  $query = $this->db->get();
	  $result = $query->result_array();
	  
	  
	  return $result;
	}

	public function getProduct($product_name="",$brand_id = "",$where = "",$offset="0",$limit="",$order = "",$select = "*")
	{
		$wherestr = "";
		if($product_name)
		{
			$product_name = $this->db->escape_like_str($product_name);			
			$wherestr .= " AND (
				blog_name = '".$product_name."' OR  
				blog_name LIKE '%".$product_name."%' OR
				blog_name LIKE '%".$product_name."' OR
				blog_name LIKE '".$product_name."%'
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
		$sql = "SELECT ".$select." FROM ".DBPREFIX."_blogs
			WHERE 
			display_status = '1' 
			".$wherestr." ORDER BY ".$order." blog_id DESC ".$limit;			
	//	echo $sql;die;
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}
	}
}	
?>