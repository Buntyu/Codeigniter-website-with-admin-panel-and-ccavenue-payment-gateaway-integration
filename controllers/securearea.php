<?php
if(!class_exists("Securearea"))
{
	class Securearea extends CI_Controller
	{
		public $isloggedin = FALSE;
		public $userData = array();
		protected $cur_date_time = "";
		public $dateTimeFormat = "d-m-Y H:i:s a";
		public $dateFormat = "d-m-Y";
		public $categoryData = "";
		public $brandsList = "";
		public $productsList = "";
		public $carttotalprice = 0;
		public $carttotalitems = 0;
		public $cart_id = "";
		public $hidecartlist = FALSE;
		public $areas = "";
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array("form","url","date","cookie"));
			$this->load->library('session');
			$this->load->library('cart');			
			$this->load->library('form_validation');		
			$this->load->model("admin/secure_model");
			$this->load->model("category_model");
			$this->load->model("product_model");
			$this->load->model("admin/brands_model");
			$this->load->model("Cart_model");
			$this->load->model("user_model");			
			$this->load->model("admin/areas_model");
			$this->cur_date_time = date("Y-m-d H:i:s",gmt_to_local(time(),"UP45"));
			$this->checkuser();
			$this->queryaff();
			$this->categoryData = $this->category_model->getSidebarData();		
			$this->brandsList = $this->getBrandsList(); 	
			$this->productsList = $this->product_model->getProductNames();
			$this->getcartTotal();			
			$this->areas = $this->areas_model->getAreas("","area_name,area_pin");
			date_default_timezone_set('Asia/Kolkata');
		}
		
		function queryaff() {
		$queryAff = $this->input->get('aff', TRUE);
		$uyer = $this->input->get('aff',TRUE);
		$coo = $this->input->cookie("bisj_queryaff"); 
		if($queryAff == "bamboo") {
		$cookie21 = array(
						    'name'   => 'queryaff',
						    'value'  => $queryAff,
						    'expire' => '31536000',
						    'domain' => '',
						    'path'   => '/',
						    'prefix' => 'bisj_',
						    'secure' => FALSE
						);
			$this->input->set_cookie($cookie21);	
		}

        //if($this->isloggedin && $coo != ""){
    /*    if($this->isloggedin){
			//echo "yess";die;
			$refCode = $this->input->cookie("bisj_queryaff");
			$userId = $this->userData['id'];
			if($refCode != "")
			{
				$rId = $this->user_model->getAffiliateId($refCode);
				$reffId = $rId[0]['affiliate_id'];
				$status = "eligible";

				$rData = array
				(			
					"refferal_code"=>$refCode,
					"refferal_status"=>$status,
					"aff_id"=>$reffId,
				);
				$this->user_model->updateUser($userId,$rData);
			}
		} */
		}
		
		function checkuser()
		{		
			$getData = $this->input->cookie("ecomm_userData");
		//	echo "<pre>";print_r($getData);die;
			if(isset($_POST["username"]) && isset($_POST["password"]))
			{		
				$userData = $this->checklogindetails($_POST["username"],$_POST["password"]);			
				if($userData)
				{
					if(isset($_POST["rememberme"]))
					{
						$cookie = array(
						    'name'   => 'userData',
						    'value'  => base64_encode(json_encode($userData[0])),
						    'expire' => '108000',
						    'domain' => '',
						    'path'   => '/',
						    'prefix' => 'ecomm_',
						    'secure' => FALSE
						);

						$this->input->set_cookie($cookie); 
$this->isloggedin = TRUE;
     $this->userData = $userData[0];
     return TRUE;						
					}
					else
					{ 
						$this->session->set_userdata($userData[0]);
					}				
					$this->isloggedin = TRUE;
					$this->userData = $userData[0];
					return TRUE;
				}
				else
				{
					$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"Please Check your username/Email Id and Password")));
				}
			}
			else if(isset($getData) && $getData != "")
			{			
				$getData = (array)json_decode(base64_decode($getData));				
				$userData1 = $this->checklogindetails($getData["user_id"],$getData["Affi-Password"]);
				$userData2 = $this->checklogindetails($getData["userid"],$getData["password"]);
				if($userData1==""){
						$userData=$userData2;
					}
					else{
						$userData=$userData1;
						
					}

				if($userData)
				{
					$this->isloggedin = TRUE;
					$this->userData = $userData[0];
					return TRUE;
				}
			}
			else if(($this->session->userdata("user_id") && $this->session->userdata("Affi-Password")) || ($this->session->userdata("userid") && $this->session->userdata("password")))
			{
				$userData1 = $this->checklogindetails($this->session->userdata("user_id"),$this->session->userdata("Affi-Password"));
     $userData2 = $this->checklogindetails1($this->session->userdata("userid"),$this->session->userdata("password"));
     
     if($userData1==""){
      $userData=$userData2;
     }
     else{
      $userData=$userData1;
      
     }
     
     //print_r($userData2);
     //die();
     
    if($userData)
    {
     $this->isloggedin = TRUE;
     $this->userData = $userData[0];
     return TRUE;
    }
			}
			$this->isloggedin = FALSE;
			$this->userData = array();
		}
		
		function checklogindetails($username,$password)
		{
			$userData = $this->secure_model->checkfrontendUser($username,$password);
			return $userData;
		}

		function checklogindetails1($username,$password)
  {
   $userData = $this->secure_model->checkfrontendUser($username,$password);
   return $userData;
   
  }
		
		/**
		* This function loads the header and all the required parameters
		* @param undefined $obj The object of the current class
		* @param $carousel is carousel or not
		*/
		function loadHeader($obj,$carousel = TRUE,$title = "",$description = "")
		{
			if($title)
			{
				$header["title"] = $title;
			}
			if($description)
			{
				$header["description"] = $description;
			}
			$header["obj"] = $obj;
			$header["isCarousel"] = $carousel;
			$header["areas"] = $this->areas;
			$header['categories'] = $obj->categoryData;
			$obj->load->view("includes/header",$header);
		}
		
		function loadSidebar($obj)
		{
			$sidebar["obj"] = $obj;
			$sidebar["categoryData"] = $obj->categoryData;
			$obj->load->view("includes/sidebar",$sidebar);
		}

		function loadSidebar1($obj)
  {
   $sidebar["obj"] = $obj;
   $sidebar["categoryData"] = $obj->categoryData;
   
   $obj->load->view("includes/account_sidebar",$sidebar);
  }
  
		
		function loadFooter($obj)
		{
			$footer["obj"] = $obj;
			$obj->load->view("includes/footer",$footer);
		}
		
		function checkifajax()
		{
			if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest")
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		
		function getBreadCrumb()
		{
			$name = array
			(
				"product"=>"Products",
				"viewLatestProducts"=>"Latest Products",
				"viewFeaturedProducts"=>"Featured Products",
				"categories"=>"displaynot",
				"subcategories"=>"displaynot",
				"register"=>"Registration Form",
				"useredit"=>"displaynot",
				"aboutus"=>"About Us",
				"tac"=>"Terms and Conditions",
				"faq"=>"Frequently Asked Questions",
				"contactus"=>"Contact Us",
			);
			$breadCrumb = array();
			$links = base_url();
			$val["link"] = $links;
			$val["name"] = "Home";
			$breadCrumb[] = $val;
			$uris = $this->uri->segment_array();
			$was_sub = FALSE;
			foreach($uris as $key=>$eachuri)
			{
				$links = $links.$eachuri."/";
				if(isset($name[$eachuri]) && $name[$eachuri] == "displaynot")
				{
					if($eachuri == "subcategories")
					{$was_sub = "subcategories";}
					continue;
				}
				$check = FALSE;			
				if(is_numeric($eachuri))
				{
					if($uris[1] == "categories" || $uris[1] == "subcategories")
					{
						$catname = "";
						foreach($this->categoryData as $data)
						{
							if($uris[1] == "subcategories" && $data["category_id"] == $eachuri)
							{
								$val["link"] = base_url()."categories/".$data["category_id"];								
								$val["name"] = $data["category_name"];
								$breadCrumb[] = $val;
								$check = TRUE;	
								break;
							}
							else if($data["category_id"] == $eachuri)
							{
								$catname = $data["category_name"];
								break;
							}
							else if(isset($data["sub_categories"]) && is_array($data["sub_categories"]))
							{
								foreach($data["sub_categories"] as $subs)
								{
									if($subs["category_id"] == $eachuri)
									{
										$catname = $subs["category_name"];
										break;
									}
								}
							}
						}
						$name[$eachuri] = $catname;
					}
					else 
					{
						continue;
					}
					//echo "<pre>";print_r($this->categoryData);die;
				}
				if($check == TRUE)continue;			
				$val["link"] = $links;
				if(isset($name[$eachuri]))$val["name"] = $name[$eachuri];
				else $val["name"] = ucfirst(urldecode(removeunderscores($eachuri)));
				$breadCrumb[] = $val;
			}
			return $breadCrumb;
			
		}
		private function getBrandsList()
		{
			$brands = $this->brands_model->getBrands("","brands.brand_name, brands.brand_id, brands.brand_image, brands.brand_description","1","1"," brand_name ASC, ");
			$retval = array();
			if($brands)
			{
				foreach($brands as $each)
				{
					$retval[$each["brand_id"]] = $each;
				}
			}			
			return $retval;
		}
		private function getcartTotal()
		{
			$cart_id = $this->input->cookie("cart_id");
			if($cart_id)
			{
				if($this->Cart_model->checkcartid($cart_id))
				{
					$this->cart_id = $cart_id;									
				}
			}
			if($this->cart_id)
			{
				$cart = $this->Cart_model->getCartContents($this->cart_id );					
				$totalPrice = 0;
				if(is_array($cart))
				{
					foreach($cart as $each)
					{
						$totalPrice += doubleval($each['price'] * $each['qty']);
					}
					$this->carttotalitems = count($cart);
					$this->carttotalprice = $totalPrice;	
					$this->cart->insert($cart);	
				}
			}
			else
			{
				$this->carttotalitems = 0;
				$this->carttotalprice = 0;		
			}			
		}
	}

	function addunderscores($str)
	{
		return str_replace(" ","_",$str);	
	}
	function removeunderscores($str)
	{
		return str_replace("_"," ",$str);	
	}
	
	function addhyphens($str)
	{
		$find = array("-"," ");
		$replace = array("_","-");
		return str_replace($find,$replace,$str);
		//return str_replace(" ","-",$str);	
	}

	function removehyphens($str)
	{
		$find = array("-","_");
		$replace = array(" ","-");
		return str_replace($find,$replace,$str);
		//return str_replace("-"," ",$str);	
	}
}
?>