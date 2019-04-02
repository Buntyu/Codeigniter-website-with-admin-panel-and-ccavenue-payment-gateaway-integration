<?php
class Category_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	///////     ----------------------- Categories -----------------------------      ////////
	function getParentCategories($category_id = "",$select = "",$status = "")
	{
		$where = "";
		if(is_array($category_id))
		{
			$where = " AND categories.category_id IN ('".implode("','",$category_id)."')";
		}
		else if($category_id)
		{
			$where = " AND categories.category_id = '".$category_id."'";
		}		
		if($select == "")
		{
			$select = "categories.*, users1.admin_id as userid1, users2.admin_id as userid2, users1.admin_name as name1, users2.admin_name as name2";
		}
		
		if($status != "")
		{
			$where .= " AND categories.display_status = '".$status."'";
		}
		
		$sql = "SELECT ".$select." 
				FROM ".DBPREFIX."_categories as categories
				LEFT JOIN ".DBPREFIX."_backend_users as users1 ON categories.created_id = users1.admin_id
				LEFT JOIN ".DBPREFIX."_backend_users as users2 ON categories.updated_id = users2.admin_id
				WHERE parent_category_id = '0' AND deleted_id is NULL ".$where;	
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();			
		}
		
	}
	
	function insertCategory($data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$this->db->insert_batch(DBPREFIX."_categories", $data); 
		return TRUE;
	}
	
	function deleteCategory($category_id)
	{

		$arr = array('category_id' => $category_id);
	//	$arr1 = array('parent_category_id' => $category_id);		
		$this->db->where($arr); 
	//	$this->db->or_where($arr1);
		$this->db->delete(DBPREFIX."_categories", $arr);
	//	$this->db->delete(DBPREFIX."_categories", $arr1);
		
	//	echo "update".$product_id;print_r($data);die;
		return TRUE;
	}
	
	
	/**
	* this function is common for categories and subcategories
	* @param undefined $category_id
	* @param undefined $data
	* 
	*/
	function updateCategory($category_id,$data)
	{
		if(!(isset($data[0])))$data[0] = $data;
		$arr = array('category_id' => $category_id);		
		$this->db->where($arr); 
		$this->db->update(DBPREFIX."_categories", $data[0]);		
	//	echo "update".$category_id;print_r($data);die;
		return TRUE;
	}
	
	
	
	///////     ----------------------- Sub Categories -----------------------------      ////////
	function getChildCategories($subcategory_id = "",$parentcategory_id = "",$status = "")
	{
		$where = "";
		if($subcategory_id)
		{
			$where = " AND c1.category_id = '".$subcategory_id."'";
		}
		else if(is_array($subcategory_id))
		{
			$where = " AND c1.category_id IN ('".implode("','",$subcategory_id)."')";
		}
		
		if($parentcategory_id)
		{
			$where = " AND c1.parent_category_id = '".$parentcategory_id."'";
		}
		else if(is_array($parentcategory_id))
		{
			$where = " AND c1.parent_category_id IN ('".implode("','",$parentcategory_id)."')";
		}
		
		if($status != "")
		{
			$where .= " AND c1.display_status = '".$status."'";
		}
		
		$sql = "SELECT c1.*, users1.admin_id as userid1, users2.admin_id as userid2, users1.admin_name as name1, users2.admin_name as name2
			FROM ".DBPREFIX."_categories  as c1
			LEFT JOIN ".DBPREFIX."_backend_users as users1 
			ON c1.created_id = users1.admin_id
			LEFT JOIN ".DBPREFIX."_backend_users as users2 
			ON c1.updated_id = users2.admin_id
			WHERE c1.parent_category_id != '0'  AND c1.deleted_id is NULL".$where;
		$result = $this->db->query($sql);		
		if($result && $result->num_rows()>0)
		{
			$categoryData = $result->result_array();			
			$parentCategories = array();
			foreach($categoryData as $key=>$category)
			{
				$parentCategories = $this->getParentCategories(explode(",",$category['parent_category_id']),"categories.category_name");
				$arrParent = array();				
				foreach($parentCategories as $parents)
				{
					 $arrParent[] = $parents["category_name"];
				}
				$categoryData[$key]['category_parent'] = implode(", ",$arrParent);
				
			}
		//	echo "<pre>";print_r($categoryData);die;
			return $categoryData;
		}
	}
}	
?>