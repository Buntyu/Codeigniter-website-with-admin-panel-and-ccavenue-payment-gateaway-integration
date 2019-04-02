<?php include("securearea.php"); ?>
<?php
class Product extends Securearea 
{
	public $productname = "";
	public $product = "";

	
	function __construct()
	{		
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('session');
	}
	public function index()
	{
		$this->viewLatestProducts();
		
  
    
	}
	
	public function viewProduct($prod_name = "",$second = "",$prod_id = "")
	{
		// This is added because routes.php was not working
		//This will transfer to the specified function if given	
		

		if(is_numeric($second))
		{
			$this->$prod_name($second);die;
		}
		
		$this->productname = removehyphens(urldecode($prod_name));
		
		$this->product = $this->product_model->getProduct("","","AND product_name = '".$this->productname."'");
		if($this->product)
		{
			
			$this->product = $this->product[0];
			//$gfg = $this->product['product_id'];
			$this->product["brand_details"] = $this->brandsList[$this->product['brands_id']];
			$where = ' AND product_name != "'.$this->productname.'" AND (';
			$is_first = TRUE;			
			$category_ids = $this->product['category_id'];			
			$this->product['categories'] = array();
			
			foreach(explode(",",$this->product['category_id']) as $category_ids)
			{
				$storCat = $this->categoryData[$category_ids];
				$this->product['categories'][$category_ids]["category_name"] = $storCat["category_name"];
				$this->product['categories'][$category_ids]["category_id"] = $category_ids;
				
				
			}			
				
		//	echo "<pre>";print_r($this->product);die;
			
			//load header
		/*	$this->loadHeader($this,"",removehyphens($prod_name)); */
		$this->loadHeader($this,"",$this->product['product_title'],$this->product['product_deseo']);
			
			//load sidebar
			$this->loadSidebar($this);
			
			//load middle content

					
			$view["obj"] = $this;
			$view["new"] = $this->get_avg_rating();
			$view["count"] = $this->get_rev_count();
			//$view["rev"] = $this->get_review_data();
			//print_r($view['rev']);die;
			//$view["test"] = $this->getCountry();
			$view['userdata'] = $this->userData;
			


			$this->load->view('product_details',$view);		
			
			//load footer
			$this->loadFooter($this);		
		}
		else
		{
			redirect(base_url(),"refresh");
		}			
	}
	
	public function viewLatestProducts()
	{
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar($this);
		
		//load middle content
		$view["totalProducts"]	= $this->product_model->getProduct("",""," AND is_new = '1'","","",""," COUNT(product_id) AS prodcnt");
		$view["totalProducts"] = $view["totalProducts"][0]["prodcnt"];
		$view["heading"] = "Latest Products";
		$view["heading_message"] = "Here are the list of Latest Products available with us.";
		//$view["more_products_url"] = base_url()."product/ajax_Latest/";
		$view['more_products'] = $this->product_model->getLatestProducts($offset,$order);
		$viewp['obj'] = $this;
		$this->load->view('product_show_view',$view);
		
		//load footer
		$this->loadFooter($this);
	}
	
	public function ajax_Latest($offset = "0")
	{
		if(!$this->checkifajax())redirect(base_url(),"refresh");
		$order = "";
		if(isset($_GET))
		{
			if(isset($_GET["product_name_typeahead"]))
			{
				$more_products = $this->product_model->getProduct($_GET["product_name_typeahead"]);
			}
			else if(isset($_GET["brands_id"]))
			{
				$more_products = $this->product_model->getProduct("",$_GET["brands_id"]);
			}
			else
			{
				foreach($_GET as $cols=>$orders){$order .= $cols." ".$orders.", ";}
				$more_products = $this->product_model->getLatestProducts($offset,"9",$order);
			}
		}				
		if($more_products)
		echo json_encode(array("status"=>"success","data"=>$more_products));
		else
		echo json_encode(array("status"=>"fail","last"=>$offset));
	}
	
	public function viewFeaturedProducts()
	{
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar($this);
		
		//load middle content	
		$view["totalProducts"]	= $this->product_model->getProduct("",""," AND is_featured = '1'","","",""," COUNT(product_id) AS prodcnt");
		$view["totalProducts"] = $view["totalProducts"][0]["prodcnt"];
		$view["heading"] = "Featured Products";
		$view["heading_message"] = "Here are the list of Featured Products available with us.";
		//$view["more_products_url"] = base_url()."product/ajax_Featured/";
		$view['more_products'] = $this->product_model->getFeaturedProducts($offset,$order);
		$viewp['obj'] = $this;
		$this->load->view('product_show_view',$view);
		
		//load footer
		$this->loadFooter($this);
	}
	
	public function ajax_Featured($offset = "0")
	{
		if(!$this->checkifajax())redirect(base_url(),"refresh");
		$order = "";
		if(isset($_GET))
		{
			if(isset($_GET["product_name_typeahead"]))
			{
				$more_products = $this->product_model->getProduct($_GET["product_name_typeahead"]);
			}
			else if(isset($_GET["brands_id"]))
			{
				$more_products = $this->product_model->getProduct("",$_GET["brands_id"]);
			}
			else
			{
				foreach($_GET as $cols=>$orders){$order .= $cols." ".$orders.", ";}
				$more_products = $this->product_model->getFeaturedProducts($offset,"9",$order);
			}
		}				
		if($more_products)
		echo json_encode(array("status"=>"success","data"=>$more_products));
		else
		echo json_encode(array("status"=>"fail","last"=>$offset));
	}
	
	public function viewDiscountProducts()
	{
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar($this);
		
		//load middle content	
		$view["totalProducts"]	= $this->product_model->getProduct("",""," AND discount_status = '1'","","",""," COUNT(product_id) AS prodcnt");
		$view["totalProducts"] = $view["totalProducts"][0]["prodcnt"];
		$view["heading"] = "Discounted Products";
		$view["heading_message"] = "Here are the list of Discounted Products available with us.";
		$view["more_products_url"] = base_url()."product/ajax_Discount/";
		$viewp['obj'] = $this;
		$this->load->view('ListProduct_view',$view);
		
		//load footer
		$this->loadFooter($this);
	}
	
	public function ajax_Discount($offset = "0")
	{
		if(!$this->checkifajax())redirect(base_url(),"refresh");
		$order = "";
		if(isset($_GET))
		{
			if(isset($_GET["product_name_typeahead"]))
			{
				$more_products = $this->product_model->getProduct($_GET["product_name_typeahead"]);
			}
			else if(isset($_GET["brands_id"]))
			{
				$more_products = $this->product_model->getProduct("",$_GET["brands_id"]);
			}
			else
			{
				foreach($_GET as $cols=>$orders){$order .= $cols." ".$orders.", ";}
				$more_products = $this->product_model->getProduct("",""," AND discount_status = '1'",$offset,"9",$order," *");
			}
		}				
		if($more_products)
		echo json_encode(array("status"=>"success","data"=>$more_products));
		else
		echo json_encode(array("status"=>"fail","last"=>$offset));
	}
	
	public function SearchResults()
	{
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar($this);
		
		$link = "";
		$prod_search = "";
		$brand_search = "";
		if(isset($_GET["product_search"]))
		{
			$link .="&product_search=".$_GET["product_search"];
			$prod_search = $_GET["product_search"];
		}
		if(isset($_GET["brands_search"]))
		{
			$link .="&brands_search=".$_GET["brands_search"];
			if($_GET["brands_search"] == "All")
			$_GET["brands_search"] = "";
			$brand_search = $_GET["brands_search"];
		}		
		//load middle content	
		$view["totalProducts"]	= $this->product_model->getProduct($prod_search,$brand_search,"","","",""," COUNT(product_id) AS prodcnt");
		$view["totalProducts"] = $view["totalProducts"][0]["prodcnt"];
		$view["heading"] = "Search Results";
		//$view["more_products_url"] = base_url()."product/ajax_SearchResults/";
		$product_name = (isset($_GET["product_search"]))? $_GET["product_search"]:"";
		$view['more_products'] = $this->product_model->getProduct($product_name,$brand_id,"",$offset,$order);			
		$view["addtourl"] = $link;
		$viewp['obj'] = $this;
		$this->load->view('product_show_view',$view);
		
		//load footer
		$this->loadFooter($this); 
	}
	
	public function ajax_SearchResults($offset)
	{
		$product_name = (isset($_GET["product_search"]))? $_GET["product_search"]:"";
		$brand_id = (!(isset($_GET["brands_search"])) || $_GET["brands_search"] == "All") ? "" : $_GET["brands_search"];
		
		unset($_GET["product_search"]);unset($_GET["brands_search"]);
		$order = "";
		
		foreach($_GET as $cols=>$orders){$order .= $cols." ".$orders.", ";}
		$searchResult = $this->product_model->getProduct($product_name,$brand_id,"",$offset,"9",$order);		
		if($searchResult)
		{
			echo json_encode(array("status"=>"success","data"=>$searchResult));
		}
		else
		{
			echo json_encode(array("status"=>"fail","data"=>"No Product Found matching your search"));
		}		
	}
	public function get_avg_rating()
	{
		$proID = $this->product['product_id'];
        $rate = $this->product_model->getAvgRating($proID);
		return $rate;

	}

	public function get_rev_count()
	{
      $proID = $this->product['product_id'];
      $rcount = $this->product_model->getRevCount($proID);
      return $rcount;
	}

	public function get_review_data()
	{
		$proID = $this->product['product_id'];
        $rate = $this->product_model->get_rev_data($proID);
		return $rate;
	}  
	
}
?>