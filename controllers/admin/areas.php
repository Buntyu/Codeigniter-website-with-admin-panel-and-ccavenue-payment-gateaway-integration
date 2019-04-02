<?php include("secureaccess.php"); ?>
<?php
class Areas extends SecureAccess 
{
	public $posteddata = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");		
		$this->load->model("admin/areas_model");		
	}
	public function index()
	{
		$this->listAreas();
	}
	
	private function listAreas() 
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->load->view("admin/areas_view");
		
		
		$areasData = $this->areas_model->getAreas();	
		
	//	echo "<pre>"; print_r($areasData);die;
		$headings = array(
			"area_name"=>"Area Name",
			"area_pin"=>"Area PIN",
			"name1"=>"Created By",
			"created_date"=>"Created Date",
			"name2"=>"Updated By",
			"updated_date"=>"Updated Date",
			);		
		$label = "Areas List";
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("area_id","area_id"),
			"link"=>array(base_url()."admin/areas/getareas/%@$%",base_url()."admin/areas/deleteareas/%@$%"),
			"clickable"=>array("#areasmodal","")
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$areasData,"",$action);		
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	
	public function createareas()
	{
		if(!(empty($_POST)) && ($_POST['areas_func'] == "create"))
		{
			$this->posteddata = $_POST;
			if($this->validateareas($_POST))
			{				
				$this->arrangePostData();
			//	echo "<pre>"; print_r($this->posteddata);die;
				$this->areas_model->insertareas($this->posteddata);		
				$this->session->set_flashdata("success","Areas created successfully.");	
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function getareas($areas_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->areas_model->getAreas($areas_id)));
	}
	
	public function editedareas()
	{		
		if(!(empty($_POST)) && ($_POST['areas_func'] == "edit"))
		{
			$this->posteddata = $_POST;
			if($this->validateareas($_POST,TRUE))
			{				
				$areas_id = $this->posteddata['areas_id_1'];
				$this->arrangePostData(TRUE);
				$this->areas_model->updateareas($areas_id,$this->posteddata);	
				$this->session->set_flashdata("success","Areas updated successfully.");			
			}			
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function deleteareas($area_id)
	{
		$deleteUser = array
		(
			"deleted_id"=>$this->userData[0]["admin_id"],
			"deleted_date"=>$this->cur_date_time
		);
		$this->areas_model->deletearea($area_id,$deleteUser);
		$this->RefreshListingPage();
	}
	
	private function RefreshListingPage()
	{
		redirect(base_url()."admin/areas","refresh");
	}	
	
	
	private function validateareas($data,$is_edit = "")
	{return TRUE;
		$chkuniq = "";
		if(!$is_edit){
			 $chkuniq = '|is_unique['.DBPREFIX.'_categories.areas_name]';
		}
		if($this->posteddata && isset($this->posteddata['areas_count']))
		{
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['areas_count']; $i++)			
			{
				$this->form_validation->set_rules('areas_name_'.$i, 'areas Name', 'xss_clean|trim|required'.$chkuniq);
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
		if($this->posteddata && isset($this->posteddata['areas_count']))
		{//echo "<pre>";print_r($this->posteddata);die;
			$arrRetval = array();
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['areas_count']; $i++)			
			{	
				$arrRetval[$cnt]['area_name'] = $this->posteddata["areas_name_".$i];
				$arrRetval[$cnt]['area_pin'] = $this->posteddata["areas_pin_".$i];
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
			//echo "<pre>";print_r($this->posteddata);die;
		}
		else
		{
			$this->backtologin();
		}
	}
}
?>