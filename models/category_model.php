<?php
class Category_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function getCategoryData($where = "")
	{
		
		$sql = 
		"
			SELECT * FROM ".DBPREFIX."_categories
			WHERE deleted_id is NULL AND display_status = '1'.$where
		";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
		}	
	}
	
	public function getSidebarData()
	{
		$productcnts = $this->getproductIds();		
		$allCat = $this->getParentCategories($productcnts);
		$retData = $this->getChildCategories($allCat,$productcnts);
		if(count($retData)>=1) 
		{
            	return $retData;
		}
		else 
		{
		//print_r($retData);die;
		return $allCat;
		}
	}
	
	public function getParentCategories($productcnts)
	{
		$sql = 
		"
			SELECT cat.category_id, cat.category_name, cat.category_title, cat.category_description ,cat.category_image FROM ".DBPREFIX."_categories AS cat		
			WHERE cat.deleted_id is NULL AND cat.display_status = '1' AND cat.parent_category_id = '0'
			ORDER BY cat.category_id
		";
		$result = $this->db->query($sql);
		//echo $result;die;
		if($result && $result->num_rows()>0)
		{
			$categoryData = $result->result_array();
			$retVal = array();	
			$cnt = 0;
			foreach($categoryData as $category)
			{
				$retVal[$category["category_name"]] = $category;
				$retVal[$category["category_name"]]["prod_cnt"] = isset($productcnts['category'][$category["category_id"]]["cnt"]) ? $productcnts['category'][$category["category_id"]]["cnt"] : 0;
				
				if($retVal[$category["category_name"]]["prod_cnt"] == "0")
				unset($retVal[$category["category_name"]]);
				$cnt++;
			}
		//	echo "<pre>";print_r($retVal);die;
			return $retVal;
		}
	}
	
	public function getChildCategories($allCats,$productcnts)
	{
		$sql = "
			SELECT subcat.category_id, subcat.parent_category_id, subcat.category_name, subcat.category_title, subcat.category_description, subcat.category_image FROM ".DBPREFIX."_categories AS subcat										
			WHERE subcat.deleted_id is NULL AND subcat.display_status = '1' AND subcat.parent_category_id != '0'
			ORDER BY subcat.category_id
		";
		//echo "<pre>";print_r($productcnts);die;
		$result = $this->db->query($sql);
		//print_r($result);die;
		if($result && $result->num_rows()>0)
		{
			$subcategories = $result->result_array();
			$retVal = array();
			$cnt = 0;
			foreach($allCats as $categories)
			{
				$retVal[$categories["category_name"]] = $categories;
				$retVal[$categories["category_name"]]["sub_categories"] = array();
				$cntsub = 0;
				foreach($subcategories as $subcats)
				{
					$parents = explode(",",$subcats["parent_category_id"]);
					foreach($parents as $parent)
					{
						if($parent == $categories["category_id"])
						{
							$retVal[$categories["category_name"]]["sub_categories"][$subcats["category_name"]] = $subcats;
							$retVal[$categories["category_name"]]["sub_categories"][$subcats["category_name"]]["prod_cnt"] = isset($productcnts["category"][$parent]["subcategory"][$subcats["category_id"]]) ? $productcnts["category"][$parent]["subcategory"][$subcats["category_id"]] : 0;
							
					//		echo $productcnts["category"][$parent]["subcategory"][$subcats["category_id"]];
							
							if($retVal[$categories["category_name"]]["sub_categories"][$subcats["category_id"]]["prod_cnt"] == 0)
							{
								unset($retVal[$categories["category_name"]]["sub_categories"][$subcats["category_id"]]);
							}
							else
							$cntsub++;							
						}
					}
				}
				$cnt++;
			}			
			return $retVal;
		}
	}
	
	public function getproductIds()
	{
		$sql = "SELECT product_id,category_id,subcategory_id fROM ".DBPREFIX."_product
			WHERE deleted_id is NULL AND display_status = '1'
		";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			$retData = array();
			$retData["category"] = array();			
			$products = $result->result_array();			
			foreach($products as $prods)
			{
				$cats = explode(",",$prods['category_id']);
				foreach($cats as $each)
				{
					if(isset($retData["category"][$each]["cnt"]))
					{
						$retData["category"][$each]["cnt"]++;
					}
					else 
					{
						$retData["category"][$each]["cnt"] = 1;
					}
					$subcats = explode(",",$prods['subcategory_id']);
					foreach($subcats as $eachsub)
					{
						if(isset($retData["category"][$each]["subcategory"][$eachsub]))$retData["category"][$each]["subcategory"][$eachsub]++;
						else $retData["category"][$each]["subcategory"][$eachsub] = 1;
					}
				}				
			}
			return $retData;
			
		}
	}
}
?>