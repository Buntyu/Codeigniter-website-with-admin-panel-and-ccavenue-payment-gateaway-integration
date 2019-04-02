<?php include("securearea.php"); ?>
<?php
class Categories extends Securearea 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");				
	}	
	public function viewCategoryProducts($category_name)
	{
		//load header
		//echo "<pre>";print_r($this->categoryData);die;
		$catName = removehyphens(urldecode($category_name));
		$catdisc = $this->categoryData[$catName]["category_description"];
		$this->loadHeader($this,"",$this->categoryData[$catName]["category_title"],$catdisc);
		
		//load sidebar
		$this->loadSidebar($this);
		
		//load middle content		
		$view["totalProducts"]	= $this->categoryData[$catName]["prod_cnt"];
		if(!$view["totalProducts"])
		{
			$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"<strong>Category Not Found.</strong>")));
			redirect(base_url(),"refresh");
		}
		//echo $view['totalProducts'];die;
		//$view["more_products_url"] = base_url()."categories/ajax_CategoriesProducts/";
		$category_id = $this->categoryData[$catName]["category_id"];
		$where = " AND 
						( 
							category_id ='".$category_id."' OR 
							category_id	LIKE '".$category_id.",%' OR
							category_id	LIKE '%,".$category_id.",%' OR
							category_id	LIKE '%,".$category_id."'
						)
					";
			
		$view['more_products'] = $this->product_model->getProduct("","",$where,$offset,$order);
		$viewp['obj'] = $this;
		//$view["addtourl"] = "&category_id=".$category_id;
		$this->load->view('product_show_view',$view);
		
		//load footer
		$this->loadFooter($this);
	}
	public function ajax_CategoriesProducts($offset = "9")
	{
		if(!$this->checkifajax())redirect(base_url(),"refresh");		
		if(isset($_GET["category_id"]))
		{
			$category_id = $_GET["category_id"];
			unset($_GET["category_id"]);
			$order = "";
			foreach($_GET as $cols=>$orders){$order .= $cols." ".$orders.", ";}
			
			$where = " AND 
						( 
							category_id ='".$category_id."' OR 
							category_id	LIKE '".$category_id.",%' OR
							category_id	LIKE '%,".$category_id.",%' OR
							category_id	LIKE '%,".$category_id."'
						)
					";
			
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