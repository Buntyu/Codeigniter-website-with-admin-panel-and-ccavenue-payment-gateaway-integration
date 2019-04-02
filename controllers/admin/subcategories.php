<?php include("secureaccess.php"); ?>
<?php
class Subcategories extends SecureAccess 
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
		$this->listsubCategories();
	}
	
	private function listsubCategories()
	{		
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$view['parentCategories'] = $this->category_model->getParentCategories();
		
		$this->load->view("admin/subcategory_view",$view);
		
		
		$categoryData =  $this->category_model->getChildCategories();
		$categoryData = $this->createimageTag($categoryData,"category_image");
		
	//	echo "<pre>"; print_r($categoryData);die;
		$headings = array( 
			"category_name"=>"Name",
			"category_title"=>"Title (SEO)",
			"category_parent"=>"Parent Category",
			"category_image"=>"Sub-Category Image",
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
			"link"=>array(base_url()."admin/subcategories/getsubcategory/%@$%",base_url()."admin/subcategories/deletesubcategories/%@$%"),
			"clickable"=>array("#subcategorymodal","")
		);
		$label = "Sub-Categories List";
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$categoryData,"",$action);
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	
	public function createsubcategories()
	{
		if(!(empty($_POST)) && ($_POST['category_func'] == "create"))
		{
			$this->posteddata = $_POST;
			if($this->validatesubcategory($_POST))
			{			
				$this->uploadsubCategoryFiles($_FILES);		
				$this->arrangePostData();			
				$this->category_model->insertCategory($this->posteddata);
				$this->session->set_flashdata("success","Sub-Category created successfully.");	
			}
		//	echo "<pre>"; print_r($this->posteddata);die;
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function getsubcategory($subcategory_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->category_model->getChildCategories($subcategory_id)));
	}
	
	public function editedsubcategories($subcategory="")
	{
		if(!(empty($_POST)) && ($_POST['category_func'] == "edit"))
		{
			$this->posteddata = $_POST;
			if($this->validatesubcategory($_POST,TRUE))
			{
				$subcategory_id = $this->posteddata['subcategory_id_1'];
				$this->uploadsubCategoryFiles($_FILES);
				$this->arrangePostData(TRUE);
				$this->category_model->updateCategory($subcategory_id,$this->posteddata);
				$this->session->set_flashdata("success","Sub-Category updated successfully.");
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function deletesubcategories($subcategory_id)
	{
		$deleteUser = array
		(
			"deleted_id"=>$this->userData[0]["admin_id"],
			"deleted_date"=>$this->cur_date_time
		);
		$this->category_model->deleteCategory($subcategory_id,$deleteUser);
		$this->session->set_flashdata("info", "Sub-Category deleted successfully.");			
		$this->RefreshListingPage();
	}
	
	private function RefreshListingPage()
	{
		redirect(base_url()."admin/subcategories","refresh");
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
	
	private function validatesubcategory($data,$is_edit="")
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
				$this->form_validation->set_rules('category_name_'.$i, 'Sub-Category Name', 'xss_clean|trim|required'.$chkuniq);
				$this->form_validation->set_rules('parent_category_id_'.$i, 'Parent Category', 'required');				
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
	
	private function uploadsubCategoryFiles($files)
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
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata("info", $this->upload->display_errors());			
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
			{//if(!$isUpdate)
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
				$arrRetval[$cnt]['parent_category_id'] = implode(",",$this->posteddata["parent_category_id_".$i]); 
				
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