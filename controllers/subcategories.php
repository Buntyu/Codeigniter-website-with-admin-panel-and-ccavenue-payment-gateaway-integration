<?php include("securearea.php"); ?>
<?php
class Subcategories extends Securearea 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");				
	}	
	public function viewSubcategoryProducts($category_name,$subcategory)
	{			
		//load header
		$catName = removehyphens(urldecode($category_name));
		$subCatName = removehyphens(urldecode($subcategory));

		$this->loadHeader($this,"",$this->categoryData[$catName]["sub_categories"][$subCatName]["category_name"]);
		//load sidebar
		$this->loadSidebar($this);
		
		//load middle content
		$view["totalProducts"]	= $this->categoryData[$catName]["sub_categories"][$subCatName]["prod_cnt"];
		//echo $view["totalProducts"];die;
		/*$view["more_products_url"] = base_url()."subcategories/ajax_Subca6tr'9pio[itegoriesProducts/";
		foreach($this->categoryData as $categories)
		{
			if(isset($categories["sub_categories"][$category_id]))
			{
				$view["totalProducts"]	= $categories["sub_categories"][$category_id]["prod_cnt"];
			}
		}	*/	
		if($view["totalProducts"] == "0" || !$view["totalProducts"])redirect(base_url(),"refresh");
		$viewp['obj'] = $this;
		//$view["addtourl"] = "&category_id=".$subcategory."&parent_category=".$category_id;
		$category_id = $this->categoryData[$catName]["sub_categories"][$subCatName]["category_id"];
		$parent_category_id	= $this->categoryData[$catName]["category_id"];
		//echo $category_id;die;
		$where = " AND 
						( 
							subcategory_id ='".$category_id."' OR 
							subcategory_id	LIKE '".$category_id.",%' OR
							subcategory_id	LIKE '%,".$category_id.",%' OR
							subcategory_id	LIKE '%,".$category_id."'
						)
					";
		if($parent_category_id)
		{			
			$where .= " AND 
						( 
							category_id ='".$parent_category_id."' OR 
							category_id	LIKE '".$parent_category_id.",%' OR
							category_id	LIKE '%,".$parent_category_id.",%' OR
							category_id	LIKE '%,".$parent_category_id."'
						)
					";
		}
			
		$view['more_products'] = $this->product_model->getProduct("","",$where,$offset,$order);

		$this->load->view('product_show_view',$view);
		
		//load footer
		$this->loadFooter($this);
	}
	public function ajax_SubcategoriesProducts($offset = "9")
	{
		if(!$this->checkifajax())redirect(base_url(),"refresh");		
		if(isset($_GET["category_id"]))
		{
			$category_id = $_GET["category_id"];
			$parent_category_id = isset($_GET['parent_category']) ? $_GET['parent_category'] : "";
			unset($_GET["parent_category"]);
			unset($_GET["category_id"]);
			$order = "";
			foreach($_GET as $cols=>$orders){$order .= $cols." ".$orders.", ";}
			
			$where = " AND 
						( 
							subcategory_id ='".$category_id."' OR 
							subcategory_id	LIKE '".$category_id.",%' OR
							subcategory_id	LIKE '%,".$category_id.",%' OR
							subcategory_id	LIKE '%,".$category_id."'
						)
					";
		if($parent_category_id)
		{			
			$where .= " AND 
						( 
							category_id ='".$parent_category_id."' OR 
							category_id	LIKE '".$parent_category_id.",%' OR
							category_id	LIKE '%,".$parent_category_id.",%' OR
							category_id	LIKE '%,".$parent_category_id."'
						)
					";
		}
			
			$more_products = $this->product_model->getProduct("","",$where,$offset,"9",$order);
			if($more_products)
			{
				echo json_encode(array("status"=>"success","data"=>$more_products));						
				die;
			}			
		}
		echo json_encode(array("status"=>"fail","last"=>$offset));
	}
}	
?>