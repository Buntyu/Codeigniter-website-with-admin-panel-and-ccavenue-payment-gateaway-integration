<?php include("secureaccess.php"); ?>
<?php
class Brands extends SecureAccess 
{
	public $posteddata = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");		
		$this->load->model("admin/brands_model");		
	}
	public function index()
	{
		$this->listBrands();
	}
	
	private function listBrands()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->load->view("admin/brands_view");
		
		
		$brandData =  $this->brands_model->getBrands();
		$brandData = $this->createimageTag($brandData,"brand_image");
		
//		echo "<pre>"; print_r($brandData);die;
		$headings = array(
			"brand_name"=>"Brand Name",
			"brand_image"=>"Brand Image",
			"brand_description"=>"Brand Description",
			"creator"=>"Created By",
			"created_date"=>"Created On",			
			"updater"=>"Updated By",
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
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("brand_id","brand_id"),
			"link"=>array(base_url()."admin/brands/getbrandsbyid/%@$%",base_url()."admin/brands/deletebrands/%@$%"),
			"clickable"=>array("#brandsmodal","")
		);
		$label = "Brands List";
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$brandData,"",$action);
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	
	public function createbrands()
	{//echo "<pre>";print_r($_POST);die;
		if(!(empty($_POST)) && ($_POST['brands_func'] == "create"))
		{
			$this->posteddata = $_POST;
			if($this->validatebrands($_POST)){
				$this->uploadBrandFiles($_FILES);
				$this->arrangePostData();
			//	echo "<pre>"; print_r($this->posteddata);die;
				$this->brands_model->insertbrands($this->posteddata);
				$this->session->set_flashdata("success","Brand created successfully.");
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function getbrandsbyid($brands_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->brands_model->getBrands($brands_id)));
	}
	
	public function editedbrands()
	{
		if(!(empty($_POST)) && ($_POST['brands_func'] == "edit"))
		{
			$this->posteddata = $_POST;
			if($this->validatebrands($_POST,TRUE)){
				$brands_id = $this->posteddata['brands_id_1'];
				$this->uploadBrandFiles($_FILES);
				$this->arrangePostData(TRUE);
			//	echo "<pre>";print_r($this->posteddata);die;
				$this->brands_model->updatebrands($brands_id,$this->posteddata);			
				$this->session->set_flashdata("success","Brand updated successfully.");
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function deletebrands($brands_id)
	{
		$deleteUser = array
		(
			"deleted_id"=>$this->userData[0]["admin_id"],
			"deleted_date"=>$this->cur_date_time
		);
		$this->brands_model->deletebrands($brands_id,$deleteUser);
		$this->session->set_flashdata("info", "Brand deleted successfully.");			
		$this->RefreshListingPage();
	}
	
	private function RefreshListingPage()
	{
		redirect(base_url()."admin/brands","refresh");
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
	
	private function validatebrands($data,$is_edit="")
	{
		$chkuniq = "";
		if(!$is_edit){
			 $chkuniq = '|is_unique['.DBPREFIX.'_brands.brand_name ]';
		}
		if($this->posteddata && isset($this->posteddata['brands_count']))
		{
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['brands_count']; $i++)			
			{
				$this->form_validation->set_rules('brands_name_'.$i, 'Brand Name', 'xss_clean|trim|required'.$chkuniq);
				$this->form_validation->set_rules('brands_description_'.$i, 'Brand Description', 'required');	
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
	
	private function uploadBrandFiles($files)
	{
		$config['upload_path'] = './images/uploads/brands/';
		$config['allowed_types'] = 'gif|jpg|png';
		for($i = 1; $i <= $this->posteddata['brands_count']; $i++)
		{
			if(isset($files["brands_image_".$i]))
			{				
				$config['file_name']  = "brands_".strtotime($this->cur_date_time).$this->userData[0]['admin_id'];	
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload("brands_image_".$i))
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata("info", $this->upload->display_errors());			
					$this->posteddata["brands_image_".$i] = "";
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
				//	echo "<pre>";print_r($data);die;
				//	base_url()."images/uploads/categories/".$data['upload_data']['file_name'];
					$arrImg = array
					(
						"base"=>"uploads",
						"type"=>"brands",
						"img"=>$data['upload_data']['file_name'],
						"width"=>100,
						"height"=>100
					);
					$img_url = base_url()."custom/images?img=".base64_encode(serialize($arrImg));
										
					$this->posteddata["brands_image_".$i] = $img_url;
				}				
			}
			else
			{
				$this->posteddata["brands_image_".$i] = "";
			}			
		}
	//	echo "<pre>";print_r($this->posteddata);die;
	}
	
	private function arrangePostData($isUpdate = FALSE)
	{		
		if($this->posteddata && isset($this->posteddata['brands_count']))
		{//echo "<pre>";print_r($this->posteddata);die;
			$arrRetval = array();
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['brands_count']; $i++)			
			{
				$arrRetval[$cnt]['brand_name'] = $this->posteddata["brands_name_".$i];
				if(isset($this->posteddata["brands_image_".$i]) && $this->posteddata["brands_image_".$i] != "")
				{
					$arrRetval[$cnt]['brand_image'] = $this->posteddata["brands_image_".$i];
				}
				$arrRetval[$cnt]['display_status'] = $this->posteddata["display_status_".$i];
				$arrRetval[$cnt]['brand_description'] = $this->posteddata["brands_description_".$i];
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