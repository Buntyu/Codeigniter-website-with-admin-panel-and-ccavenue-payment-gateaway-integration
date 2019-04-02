<?php include("secureaccess.php"); ?>
<?php
class Categories extends SecureAccess 
{
	public $posteddata = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");		
		$this->load->model("admin/category_model");		
	}
	public function index()
	{
		$this->listCategories();
	}
	
	private function listCategories()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->load->view("admin/category_view");
		
		
		$categoryData =  $this->category_model->getParentCategories();
		$categoryData = $this->createimageTag($categoryData,"category_image");
		
	//	echo "<pre>"; print_r($categoryData);die;
		$headings = array(
			"category_name"=>"Name",
			"category_title"=>"Title (SEO)",
			//"category_description"=>"Description (SEO)",
			"category_image"=>"Category Image",
			//"name1"=>"Created By",
			//"created_date"=>"Created On",
			//"name2"=>"Updated By",
			//"updated_date"=>"Updated On",
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
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("category_id","category_id"),
			"link"=>array(base_url()."admin/categories/getcategory/%@$%",base_url()."admin/categories/delcategory/%@$%"),
			"clickable"=>array("#categorymodal","#deletemodal")
		);
		$label = "Categories List";
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$categoryData,"",$action);
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	
	public function createcategories()
	{
		if(!(empty($_POST)) && ($_POST['category_func'] == "create"))
		{
			$this->posteddata = $_POST;
			if($this->validatecategory($_POST))
			{
				$this->uploadCategoryFiles($_FILES);
				$this->arrangePostData();
			//	echo "<pre>"; print_r($this->posteddata);die;
				$this->category_model->insertCategory($this->posteddata);		
				$this->session->set_flashdata("success","Category created successfully.");	
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function getcategory($category_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->category_model->getParentCategories($category_id)));
	}
	public function delcategory($category_id)
	{
		echo json_encode(array("status"=>"success","data"=>$category_id));
	}
	
	public function editedcategories()
	{
		if(!(empty($_POST)) && ($_POST['category_func'] == "edit"))
		{
			$this->posteddata = $_POST;
			if($this->validatecategory($_POST,TRUE))
			{
				$category_id = $this->posteddata['category_id_1'];
				$this->uploadCategoryFiles($_FILES);
				$this->arrangePostData(TRUE);
				$this->category_model->updateCategory($category_id,$this->posteddata);	
				$this->session->set_flashdata("success","Category updated successfully.");			
			}			
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function deletecategories()
	{
	    $category_id = $this->input->get('id');
		$this->category_model->deleteCategory($category_id);
		$this->session->set_flashdata("info", "Category deleted successfully.");			
		$this->RefreshListingPage(); 
	}
	
	private function RefreshListingPage()
	{
		redirect(base_url()."admin/categories","refresh");
	}
	
	private function createimageTag($arrData,$rowname,$width = "",$height = "")
	{
		if(!$width && !$height)
		{
			$width = 100;
		}
		if($arrData)
		{
			foreach($arrData as $key=>$arr)
			{
			//	echo "<pre>"; print_r($key);print_r($arr);			
				$arrData[$key][$rowname] = "
					<a href = '".$arr[$rowname]."&width=500&height=500&type=imgtag' class='cboxElement'>
					<img style = 'height : ".$height."px;width : ".$width."px;' src='".$arr[$rowname]."' class='' />
					</a>
					";
			}
		}		
		return $arrData;
	}
	
	private function validatecategory($data,$is_edit = "")
	{
		$chkuniq = "";
		if(!$is_edit){
			 $chkuniq = '|is_unique['.DBPREFIX.'_categories.category_name]';
		}
		if($this->posteddata && isset($this->posteddata['category_count']))
		{
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['category_count']; $i++)			
			{
				$this->form_validation->set_rules('category_name_'.$i, 'Category Name', 'xss_clean|trim|required'.$chkuniq);
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
	
	private function uploadCategoryFiles($files)
	{
		$config['upload_path'] = './images/uploads/categories/';
		$config['allowed_types'] = 'gif|jpg|png';
		for($i = 1; $i <= $this->posteddata['category_count']; $i++)
		{
			if(isset($files["category_image_".$i]))
			{				
				$config['file_name']  = "category_".strtotime($this->cur_date_time).$this->userData[0]['admin_id'];	
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload("category_image_".$i))
				{
					$error = array('info' => $this->upload->display_errors());
				//	$this->session->set_flashdata("error", $this->upload->display_errors());			
					$this->posteddata["category_image_".$i] = "";
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
				//	echo "<pre>";print_r($data);die;
				//	base_url()."images/uploads/categories/".$data['upload_data']['file_name'];
					$arrImg = array
					(
						"base"=>"uploads",
						"type"=>"categories",
						"img"=>$data['upload_data']['file_name'],
						"width"=>100,
						"height"=>100
					);
					$img_url = base_url()."custom/images?img=".base64_encode(serialize($arrImg));
										
					$this->posteddata["category_image_".$i] = $img_url;
				}				
			}
			else
			{
				$this->posteddata["category_image_".$i] = "";
			}			
		}
//		echo "<pre>";print_r($this->posteddata);die;
	}
	
	private function arrangePostData($isUpdate = FALSE)
	{		
		if($this->posteddata && isset($this->posteddata['category_count']))
		{//echo "<pre>";print_r($this->posteddata);die;
			$arrRetval = array();
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['category_count']; $i++)			
			{
				$arrRetval[$cnt]['category_name'] = $this->posteddata["category_name_".$i];
				$arrRetval[$cnt]['category_title'] = $this->posteddata["category_title_".$i];
				$arrRetval[$cnt]['category_description'] = $this->posteddata["category_description_".$i];
				if(isset($this->posteddata["category_image_".$i]) && $this->posteddata["category_image_".$i] != "")
				{
					$arrRetval[$cnt]['category_image'] = $this->posteddata["category_image_".$i];
				}
				$arrRetval[$cnt]['display_status'] = $this->posteddata["display_status_".$i];
				if($isUpdate)
				{
					$arrRetval[$cnt]['updated_id'] = $this->userData[0]["admin_id"];
					$arrRetval[$cnt]['updated_date'] = $this->cur_date_time;
				}
				else
				{
					$arrRetval[$cnt]['created_id'] = $this->userData[0]["admin_id"];
					$arrRetval[$cnt]['created_date'] = $this->cur_date_time;
				}				
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
}
?>