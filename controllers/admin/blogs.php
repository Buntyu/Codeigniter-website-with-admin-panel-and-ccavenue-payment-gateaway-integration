<?php include("secureaccess.php"); ?>
<?php
class Blogs extends SecureAccess 
{
	public $posteddata = "";
	public $productData = "";	
	public $categorydata = "";	
	public $subCategoryData = "";	
		
	public $vendorsData = "";	
	public $product_name = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");
		$this->load->library("session");		
		$this->load->model("admin/product_model");		
		$this->load->model("admin/blogs_model");
		$this->load->model("admin/category_model");
		
		$this->load->model("admin/vendors_model");
	}
	public function index()
	{
		$this->listProduct();
	}
	
	private function listProduct()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->productData =  $this->blogs_model->getBlogs();
		$dfd = $this->createimageTag($this->productData,"featured_image");
		
		$this->processProduct();		
				
		$headings = array(
			"blog_name"=>"Name",
			"featured_image"=>"Featured Image",
			"display_status"=>"Blog Display Status",
			"date"=>"Created On"
			);
				
		$statusval = array(
							1 => array(
								"value" =>"active",
								"text" => "Enabled"
								),
							0 =>array(
								"value" =>"inactive",
								"text" => "Disabled"
								)
					);
		$this->customtable_lib->createStatus("display_status",$statusval);	
				
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("blog_id","blog_id"),
			"link"=>array(base_url()."admin/blogs/getproduct/%@$%",base_url()."admin/blogs/delproduct/%@$%"),
			"clickable"=>array("","#deletemodal")
		);
		$label = "Blog Posts List";
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$this->productData,"",$action);
		
		$passObj["obj"] = $this;
		$this->load->view("admin/blogs_view",$passObj);
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	public function quicksearchandadd()
	{		
		if(isset($_GET) && isset($_GET["q"]))
		{
			$query = $_GET;
			$where = "";
			if($query["product_name"])
			{
				$where .= " AND 	product.product_name LIKE '".mysql_real_escape_string($query["product_name"])."'";
			}
			if($query["category"])
			{
				$where .= " AND  
					find_in_set(".$query["category"].",product.category_id)" ;
			}
			if($query["subcategory"])
			{
				$where .= " AND 
				find_in_set(".$query["subcategory"].",product.subcategory_id)" ;
			}
			
			
		}
		else
		{
			$where = "product.product_id = '0'";
		}		
		if( isset($_GET['isexcel']) && $_GET['isexcel'] == '1')
		{
			$this->load->library("excel_lib");
			$this->productData =  $this->product_model->getProduct("","",$where);
			$headings = array(0=>array("product_id"=>"Product ID",
										"product_name"=>"Product Name",
										"product_price"=>"Product Price",
										//"discount_price"=>"Discount Price",
										//"discount_status"=>"Discount Status (0,1)",
										"display_status"=>"Display Status (0,1)",
										"is_new"=>"Is New(0,1)",
										"is_featured"=>"Is Featured(0,1)"));
		/*	$products = array();
			if($this->productData)
			{
				foreach($this->productData as $prods)
				{
					$prs['product_id'] = $prods['product_id'];
					$prs['product_name'] = $prods['product_name'];
					$prs['product_price'] = $prods['product_price'];
					$prs['discount_price'] = $prods['discount_price'];
					$prs['discount_status'] = $prods['discount_status'];
					$prs['display_status'] = $prods['display_status'];
					$prs['is_new'] = $prods['is_new'];
					$prs['is_featured'] = $prods['is_featured'];
					$products[] = $prs;
				}
			}*/
			//echo "<pre>";print_r($this->productData);die;
			$data = array($this->productData);
			$titles = array("BISJ Products");
			$filename = "BISJ - Products Excel Sheet";
			$pages = 1;
			$dates = array();
			$this->excel_lib->writeExcel($headings,$data,$filename,$pages,$titles,$dates);	
			die;
		}
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$this->product_name = $this->product_model->getProduct("","product.product_name");
		$this->productData =  $this->product_model->getProduct("","",$where);
		
		$this->processProduct();		
				
		$headings = array(
			"product_name"=>"Name",
			"product_image"=>"Product Image",
			
			"product_features"=>"Product Features",
			
			"is_new"=>"New",
			"is_featured"=>"Featured",
		//	"product_price"=>"Product Price",
		//	"discount_price"=>"Discount Price",
		//	"discount_percent"=>"Discount Percent",
		//	"discount_status"=>"Discount status",
			"display_status"=>"Product Display Status",
			"category_name"=>"Categories",
			"subcategory_name"=>"Sub-Categories",
			
			"manufacturer_id"=>"Manufacturer",
			"vendors_name"=>"Vendors",
			"name1"=>"Created By",
			"created_date"=>"Created On",
			"name2"=>"Updated By",
			"updated_date"=>"Updated On",
			"display_status"=>"Status"
			);
				
		$statusval = array(
							1 => array(
								"value" =>"active",
								"text" => "Enabled"
								),
							0 =>array(
								"value" =>"inactive",
								"text" => "Disabled"
								)
					);
		$this->customtable_lib->createStatus("display_status",$statusval);
		$this->customtable_lib->createStatus("discount_status",$statusval);		
		$statusval = array(
							1 => array(
								"value" =>"active",
								"text" => "Product is New"
								),
							0 =>array(
								"value" =>"inactive",
								"text" => "Regular"
								)
					);
		$this->customtable_lib->createStatus("is_new",$statusval);
		$statusval = array(
							1 => array(
								"value" =>"active",
								"text" => "Product is Featured"
								),
							0 =>array(
								"value" =>"inactive",
								"text" => "Regular"
								)
					);
		$this->customtable_lib->createStatus("is_featured",$statusval);
				
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("product_id","product_id"),
			"link"=>array(base_url()."admin/product/getproduct/%@$%",base_url()."admin/product/deleteproduct/%@$%?redirect=".base64_encode(htmlspecialchars(base_url()."admin/product/quicksearchandadd?".$_SERVER["QUERY_STRING"]))),
			"clickable"=>array("","")
		);
		$label = "Product List";
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$this->productData,"",$action);		
		
		$passObj["obj"] = $this;
		
		$this->load->view("admin/product_search_view",$passObj);	
		
		$passObj["redirect"] = "?redirect=".base64_encode(base_url()."admin/product/quicksearchandadd?".$_SERVER["QUERY_STRING"]);
		$this->load->view("admin/product_view",$passObj);
		
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	function uploadexcel()
	{
		if(!(isset($_FILES['product_file']["tmp_name"])) && stripos($_FILES['product_file']['type'],'application/vnd') < 0)
		{
			$this->session->set_flashdata("error","The file type is not supported.");
			redirect(base_url()."admin/product/quicksearchandadd","refresh");
		}
		$extension = explode(".",$_FILES['product_file']['name']);
		$extension = $extension[count($extension)-1];		
		$this->load->library("excel_lib");
		$required = array(0=>array());//(1,2,3,4,5,7,8,9,10,11,12));
		$unique = array(0=>array(1));
		$contains = array(0=>array());
		$sheetData = $this->excel_lib->readExcel($_FILES['product_file']["tmp_name"],$extension,$required,$unique,$contains);
		$uploadData = array();
		if($sheetData)
		{
		//	echo '<pre>';print_r($sheetData);die;
			$proData = $sheetData['data']['0'];
			for($i=1;$i<count($proData);$i++)
			{
				$prs['product_id'] = $proData[$i]['0'];
				$prs['product_name'] = $proData[$i]['1'];
				$prs['product_price'] = $proData[$i]['2'];
			//	$prs['discount_price'] = $proData[$i]['3'];
			//	$prs['discount_status'] = $proData[$i]['4'];
				$prs['display_status'] = $proData[$i]['5'];
				$prs['is_new'] = $proData[$i]['6'];
				$prs['is_featured'] = $proData[$i]['7'];
			//	$prs['discount_percent'] = (floatval($proData[$i]['3'])/floatval($proData[$i]['2']))*100;
				$uploadData[] = $prs;
			}
			$this->product_model->updateProducts($uploadData);
			$this->session->set_flashdata("success","Products uploaded and updated successfully.");
			redirect(base_url()."admin/product/quicksearchandadd","refresh");
		}
		else
		{
			$this->session->set_flashdata("error","No Product found in the excelsheet.");
			redirect(base_url()."admin/product/quicksearchandadd","refresh");
		}
	}
	
	public function getproductcsv()
	{
		$this->load->library("Createcsv");
		$headings = array(
			"product_id"=>"Product Id",
			"product_name"=>"Name",
			
			"product_price"=>"Product Price",
		//	"discount_price"=>"Discount Price",
		//	"discount_percent"=>"Discount Percent",
		//	"discount_status"=>"Discount status",
			"vendors_name"=>"Vendors",
			"category_name"=>"Categories",
			"subcategory_name"=>"Sub-Categories",
			"display_status"=>"Status",
			"is_new"=>"New",
			"is_featured"=>"Featured",
			);
		$this->productData =  $this->product_model->getProduct();
		
		$this->processProduct(TRUE);
		$prod = $this->productData;
		foreach($prod as $key=>$each)
		{
			if($each["is_new"] == "1")$this->productData[$key]["is_new"] = "New";
			else $this->productData[$key]["is_new"] = "";
			if($each["is_featured"] == "1")$this->productData[$key]["is_featured"] = "Featured";
			else $this->productData[$key]["is_featured"] = " ";
			if($each["discount_status"] == "1")$this->productData[$key]["discount_status"] = "Discounted";
			else $this->productData[$key]["discount_status"] = "No Discount";
			if($each["display_status"] == "1")$this->productData[$key]["display_status"] = "Is Displayed";
			else $this->productData[$key]["display_status"] = "Not Displayed";
		}
		$this->createcsv->create($headings,$this->productData,"ProductList_".date("H:m:s_d-m-Y").".csv");
	}
	
	
	public function createblog()
	{
		if(!(empty($_POST)) && ($_POST['product_func'] == "create"))
		{
			$this->posteddata = $_POST;
			if($this->validateproduct($_POST))
			{
				$this->uploadProductFiles($_FILES,TRUE);
				$this->arrangePostData();
			//	echo "<pre>"; print_r($this->posteddata);die;
				$this->blogs_model->insertBlog($this->posteddata);		
				$this->session->set_flashdata("success","Blog created successfully.");	
			//		echo "<pre>"; print_r($this->posteddata);die;
			}
			if(isset($_GET["redirect"]))
			{
				$this->RefreshListingPage(base64_decode($_GET["redirect"]));
			}
			else
			{
				$this->RefreshListingPage();
			}
		}
		else
		{
			$this->backtologin();
		}
	}

	
	public function getproduct($blog_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->blogs_model->getProductsByID($blog_id)));
	}
	
	public function editedproduct()
	{
		if(!(empty($_POST)) && ($_POST['product_func'] == "edit"))
		{
			$this->posteddata = $_POST;
	//		echo "<pre>";print_r($this->posteddata);
			if($this->validateproduct($_POST,TRUE))
			{
				$blog_id = $this->posteddata['blog_id_1'];
				$this->uploadProductFiles($_FILES);
				$this->arrangePostData(TRUE);
				$this->blogs_model->updateProduct($blog_id,$this->posteddata);	
				$this->session->set_flashdata("success","Blog updated successfully.");			
			}			
			if(isset($_GET["redirect"]))
			{
				$this->RefreshListingPage(base64_decode($_GET["redirect"]));
			}
			else
			{
				$this->RefreshListingPage();
			}
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function delproduct($product_id)
	{
		echo json_encode(array("status"=>"success","data"=>$product_id));
	}
	
	public function deleteproduct()
	{
		$product_id = $this->input->get('id');
		$this->blogs_model->deleteProduct($product_id);
		$this->session->set_flashdata("info", "Blog deleted successfully.");			
		$this->RefreshListingPage();	
	}
	
	private function RefreshListingPage($url="")
	{
		if($url)
		{
			redirect($url,"refresh");
		}
		else
		{
			redirect(base_url()."admin/blogs","refresh");
		}		
	}
	
	
	private function validateproduct($data,$is_edit = "")
	{
		$chkuniq = "";
		if(!$is_edit){
			 $chkuniq = '|is_unique['.DBPREFIX.'_blogs.blog_name]';
		}
		if($this->posteddata && isset($this->posteddata['product_count']))
		{
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['product_count']; $i++)			
			{
				$this->form_validation->set_rules('blog_name_'.$i, 'Blog Name', 'xss_clean|trim|required'.$chkuniq);
				$this->form_validation->set_rules('display_status_'.$i, 'Display Status', 'required');
			}
		}		
		if ($this->form_validation->run() == FALSE)
		{
			$errors = validation_errors();
			$this->session->set_flashdata("error", $errors);			
			return FALSE;
		}
		else			
		return TRUE;
	}
	
	private function uploadProductFiles($files)
	{
		$config['upload_path'] = './images/uploads/carousel/';
		$config['allowed_types'] = 'gif|jpg|png';
		for($i = 1; $i <= $this->posteddata['product_count']; $i++)
		{
			if(isset($files["featured_image_".$i]))
			{				
				$config['file_name']  = "carousel_".strtotime($this->cur_date_time).$this->userData[0]['admin_id'];	
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload("featured_image_".$i))
				{
					$error = array('info' => $this->upload->display_errors());
				//	$this->session->set_flashdata("error", $this->upload->display_errors());			
					$this->posteddata["featured_image_".$i] = "";
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
				//	echo "<pre>";print_r($data);die;
				//	base_url()."images/uploads/carousel/".$data['upload_data']['file_name'];
					$arrImg = array
					(
						"base"=>"uploads",
						"type"=>"carousel",
						"img"=>$data['upload_data']['file_name'],
						"width"=>100,
						"height"=>100
					);
					$img_url = base_url()."custom/images?img=".base64_encode(serialize($arrImg));
										
					$this->posteddata["featured_image_".$i] = $img_url;
				}				
			}
			else
			{
				$this->posteddata["featured_image_".$i] = "";
			}			
		}
//		echo "<pre>";print_r($this->posteddata);die;
	}
	
	private function arrangePostData($isUpdate = FALSE)
	{		
		if($this->posteddata && isset($this->posteddata['product_count']))
		{//echo "<pre>";print_r($this->posteddata);die;
			$arrRetval = array();
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['product_count']; $i++)			
			{
				$arrRetval[$cnt]['blog_name'] = $this->posteddata["blog_name_".$i];
				if(isset($this->posteddata["featured_image_".$i]) && $this->posteddata["featured_image_".$i] != "")
				{
					$arrRetval[$cnt]['featured_image'] = $this->posteddata["featured_image_".$i];
				}				
				$arrRetval[$cnt]['blog_content'] = $this->posteddata["blog_content_".$i];
				$arrRetval[$cnt]['blog_description'] = $this->posteddata["blog_description_".$i];
				$arrRetval[$cnt]['blog_title'] = $this->posteddata["blog_title_".$i];
				$arrRetval[$cnt]['display_status'] = $this->posteddata["display_status_".$i];
				$arrRetval[$cnt]['date'] = date("Y-m-d");
							
				$cnt++;
			}
			$this->posteddata = $arrRetval;			
		//	echo "<pre>";print_r($this->posteddata);die;
		}
		else
		{
			$this->backtologin();
		}
	}
	
	private function processProduct($is_csv = FALSE)
	{
		$this->createimageTag("featured_image");		
		$this->categorydata = $this->category_model->getParentCategories("","category_id, category_name",1);
		if($is_csv)
		$this->getNamefromIds($this->categorydata,"category_id","category_name","category_name","category_id",",");		
		else
		$this->getNamefromIds($this->categorydata,"category_id","category_name","category_name","category_id",",<br /><br />");		
		
		$this->subCategoryData =  $this->category_model->getChildCategories("","",1);			
		if($is_csv)
		$this->getNamefromIds($this->subCategoryData,"category_id","category_name","subcategory_name","subcategory_id",",");
		else
		$this->getNamefromIds($this->subCategoryData,"category_id","category_name","subcategory_name","subcategory_id",",<br /><br />");
		
		
		
		
		$this->vendorsData =  $this->vendors_model->getVendors();	
		if($is_csv)
		$this->getNamefromIds($this->vendorsData,"vendor_id","vendor_name","vendors_name","vendor_ids",",");		
		else
		$this->getNamefromIds($this->vendorsData,"vendor_id","vendor_name","vendors_name","vendor_ids",",<br /><br />");		
	
	}
	
	private function getNamefromIds($arrAll,$id,$name,$arrname,$dtname,$imploder = ",")
	{
		if($this->productData)
		{
			foreach($this->productData as $key=>$value)
			{
				$categories = explode(",",$value[$dtname]);
				$this->productData[$key][$arrname] = array();
				foreach($arrAll as $eachcat)
				{
					if(in_array($eachcat[$id],$categories))
					{
						$this->productData[$key][$arrname][] = $eachcat[$name];
					}
				}
				$this->productData[$key][$arrname] = implode($imploder,$this->productData[$key][$arrname]);
			}
		}
	}
	
	private function createimageTag($rowname,$width = "",$height = "")
	{
		if(!$width && !$height)
		{
			$width = 100;
		}
		if($this->productData)
		{
			//echo "<pre>";print_r($this->productData);die;
			foreach($this->productData as $key=>$arr)
			{
				//echo "<pre>"; print_r($key);print_r($arr);	
				$this->productData[$key][$rowname] = "
					<a href = '".$arr[$rowname]."&width=500&height=500&type=imgtag' class='cboxElement'>
					<img style = 'height : ".$height."px;width : ".$width."px;' src='".$arr[$rowname]."' class='' />
					</a>
					";
			}
		}		
	}

	public function getCurrencyData()
	{
		$another = $this->product_model->GetCurrData($data);
		//print_r($another[0]['curr_amount']);die;
		$currency['euro'] = $another[0]['curr_amount'];
		$currency['pound'] = $another[1]['curr_amount'];
		//echo $currency['euro'].$currency['pound'];
		$this->load->view("admin/product_view",$currency);

	}
	
	public function getArrayData()	
	{
    	$variations_array = isset($_POST['variations_array']) ? $_POST['variations_array'] : false;

	if ($variations_array) {
  	$variations_array = json_encode($variations_array);
  	print_r($variations_array);
 	$this->session->set_flashdata('vData',$variations_array);
	}

	}
	
}
?>