<?php include("secureaccess.php"); 
class Adminusers extends SecureAccess 
{
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");
		$this->load->model("admin/adminuser_model");		
	}
	public function index()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);		
		
		//The page view to be added
		$this->load->model("admin/usertype_model");
		$usertypes["user_types"] = $this->usertype_model->getadminUsers();
		$this->load->view('admin/adminusers_view',$usertypes);
		
		
		//The datatable creation
		$userData = $this->adminuser_model->getbackendUsers();
	//	echo "<pre>";print_r($userData);die;
		
		
		
		$headings = array
		(
			"admin_username"=>"User Name",
			"admin_password"=>"Password",			
			"admin_name"=>"Name",
			//"user_type_dpname"=>"User Type",
			"admin_email"=>"Email ID",
			"admin_mobile"=>"Mobile",
			//"creator"=>"Created By",
			//"created_date"=>"Created On"
		);		
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("admin_id","admin_id"),
			"link"=>array(base_url()."admin/adminusers/getuserbyid/%@$%",base_url()."admin/adminusers/deleteuser/%@$%"),
			"clickable"=>array("#adminusers_modal","")
		);
		$label = "Backend Users Data";
		 
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$userData,"",$action);
		$this->load->view('helpers/members_table_view',$tableData);
		
		$this->load->view("admin/includes/admin_footer");
	}
	
	function createadminuser()
	{
		if(!(empty($_POST)) && $this->validate_admin_user($_POST))
		{
			$postedData = $_POST;
			$postedData['creator_id'] = $this->userData[0]['admin_id'];
			$postedData['created_date'] = "".$this->cur_date_time;
	//		echo "<pre>";print_r($postedData);die;
			$this->adminuser_model->createadminuser($postedData);
			$this->listPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	
	function deleteuser($admin_id = "")
	{
		if($admin_id)
		{
			$this->adminuser_model->delete_admin($admin_id);
			$this->listPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	function getuserbyid($user_id)
	{
		$data = $this->adminuser_model->getbackendUsers($user_id);
		echo json_encode(array("status"=>"success","data"=>$data));
	}
	
	
	function editeduser()
	{
		if(!(empty($_POST)) && $this->validate_admin_user($_POST))
		{
			$postedData = $_POST;
		//	$postedData ['allowed_modules'] = implode(",",$postedData ['allowed_modules']);
			
		//	echo "<pre>";print_r($postedData);die;			
			$this->adminuser_model->editadminuser($postedData);
			$this->listPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	private function listPage()
	{
		redirect(base_url()."admin/adminusers","refresh");
	}
	
	private function validate_admin_user($postData)
	{
		return TRUE;
	}
	
}
?>