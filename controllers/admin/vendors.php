<?php include("secureaccess.php"); ?>
<?php
class Vendors extends SecureAccess 
{
	public $posteddata = "";
	public $areas = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");		
		$this->load->model("admin/vendors_model");
		$this->load->model("admin/areas_model");
		$this->areas = $this->areas_model->getAreas("","area_name,area_pin");			
	}
	public function index()
	{
		$this->listVendors();
	}
	
	private function listVendors()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->load->view("admin/vendors_view");
		
		
		$vendorsData =  $this->vendors_model->getVendors();
//		echo "<pre>"; print_r($vendorsData);die;
	//	$vendorsData = $this->createimageTag($vendorsData,"vendors_image");
				
		$headings = array(
			"vendor_name"=>"Name",
			"vendor_address"=> "Address",
			"vendor_pin"=> "PINCODE",
			"vendor_mobile"=> "Mobile Numbers",
			"vendor_phone"=> "Phone Numbers",
			"vendor_email"=>"Email Id",
			"vendor_area"=> "Areas",
			"name1"=>"Created By",
			"created_date"=>"Created On",
			"name2"=>"Updated By",
			"updated_date"=>"Updated On"
			);		
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("vendor_id","vendor_id"),
			"link"=>array(base_url()."admin/vendors/getvendors/%@$%",base_url()."admin/vendors/deletevendors/%@$%"),
			"clickable"=>array("#vendorsmodal","")
		);
		$label = "Vendors List";
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$vendorsData,"",$action);
		$this->load->view('helpers/members_table_view',$tableData);
		$this->load->view("admin/includes/admin_footer");	
	}
	
	
	public function createvendors()
	{
		if(!(empty($_POST)) && ($_POST['vendors_func'] == "create"))
		{
			$this->posteddata = $_POST;
			if($this->validatevendors($_POST))
			{
			//	$this->uploadvendorsFiles($_FILES);								
				$this->arrangePostData();
			//	echo "<pre>"; print_r($this->posteddata);die;
				$this->vendors_model->insertvendors($this->posteddata);		
				$this->session->set_flashdata("success","<strong>Vendors created successfully.</strong>");	
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function getvendors($vendor_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->vendors_model->getVendors($vendor_id)));
	}
	
	public function editedvendors()
	{
		if(!(empty($_POST)) && ($_POST['vendors_func'] == "edit"))
		{
			$this->posteddata = $_POST;
			if($this->validatevendors($_POST,TRUE))
			{				
				$vendor_id = $this->posteddata['vendor_id_1'];				
				$this->arrangePostData(TRUE);
				$this->vendors_model->updatevendors($vendor_id,$this->posteddata);	
				$this->session->set_flashdata("success","Vendors updated successfully.");			
			}			
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function deletevendors($vendor_id)
	{
		$deleteUser = array
		(
			"deleted_id"=>$this->userData[0]["admin_id"],
			"deleted_date"=>$this->cur_date_time
		);
		$this->vendors_model->deletevendors($vendor_id,$deleteUser);
		$this->session->set_flashdata("info", "Vendor deleted successfully.");			
		$this->RefreshListingPage();
	}
	
	private function RefreshListingPage()
	{
		redirect(base_url()."admin/vendors","refresh");
	}	
	
	private function validatevendors($data,$is_edit = "")
	{return TRUE;
		$chkuniq = "";
		if(!$is_edit){
			 $chkuniq = '|is_unique['.DBPREFIX.'_vendors.vendor_name]';
		}
		if($this->posteddata && isset($this->posteddata['vendors_count']))
		{
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['vendors_count']; $i++)			
			{
				$this->form_validation->set_rules('vendor_name_'.$i, 'vendors Name', 'xss_clean|trim|required'.$chkuniq);
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
	
	private function arrangePostData($isUpdate = FALSE)
	{		
		if($this->posteddata && isset($this->posteddata['vendors_count']))
		{//echo "<pre>";print_r($this->posteddata);die;
		$this->posteddata['vendors_count'] = 1;
			$arrRetval = array();
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['vendors_count']; $i++)			
			{
				$arrRetval[$cnt]['vendor_name'] = $this->posteddata["vendor_name_".$i];
				
				$arrRetval[$cnt]['vendor_address'] = $this->posteddata["vendor_address_".$i];
				$arrRetval[$cnt]['vendor_pin'] = $this->posteddata["vendor_pin_".$i];
				$arrRetval[$cnt]['vendor_mobile'] = $this->posteddata["vendor_mobile_".$i];
				$arrRetval[$cnt]['vendor_phone'] = $this->posteddata["vendor_phone_".$i];
				$arrRetval[$cnt]['vendor_area'] = implode(",",$this->posteddata["vendor_area_".$i]);
				$arrRetval[$cnt]['vendor_email'] = $this->posteddata["vendor_email_".$i];
								
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
	//		echo "<pre>";print_r($this->posteddata);die;
		}
		else
		{
			$this->backtologin();
		}
	}
}
?>