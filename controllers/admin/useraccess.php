<?php include("secureaccess.php"); 
class Useraccess extends SecureAccess 
{
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");
		$this->load->model("admin/usertype_model");
	}
	public function index()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);		
		
		//The page view to be added
		$mod_data['modules'] = $this->usertype_model->getAllmodules();
		$this->load->view('admin/useraccess_view',$mod_data);
		
		
		//The datatable creation
		$userData = $this->usertype_model->getadminUsers();
//		echo "<pre>";print_r($userData);
		
		$headings = array
		(
			"user_type_name"=>"User Name",
			"user_type_dpname"=>"Display Name",
			"allowed_links"=>"Allowed Modules"
		);		
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("user_type_id","user_type_id"),
			"link"=>array(base_url()."admin/useraccess/editusertype/%@$%",base_url()."admin/useraccess/deleteusertype/%@$%"),
			"clickable"=>array("#useredit_modal","")
		);
		$label = "User Type and Module Access";
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$userData,"",$action);
		$this->load->view('helpers/members_table_view',$tableData);
		
		$this->load->view("admin/includes/admin_footer");
	}
	
	function createusertype()
	{
		if(!(empty($_POST)) && $this->validate_usertype($_POST))
		{
			$postedData = $_POST;
			$postedData ['allowed_modules'] = implode(",",$postedData ['allowed_modules']);
			$this->usertype_model->createusertype($postedData);
			redirect(base_url()."admin/useraccess","refresh");
		}
		else
		{
			$this->backtologin();
		}
	}
	
	
	function deleteusertype($user_type_id = "")
	{
		if($user_type_id)
		{
			$this->usertype_model->delete_usertype($user_type_id);
			redirect(base_url()."admin/useraccess","refresh");
		}
		else
		{
			$this->backtologin();
		}
	}
	
	function editusertype($type_id)
	{
		$data = $this->usertype_model->getusertype($type_id);
		echo json_encode(array("status"=>"success","data"=>$data));
	}
	
	
	function editeduser()
	{
		if(!(empty($_POST)) && $this->validate_usertype($_POST))
		{
			$postedData = $_POST;
			$postedData ['allowed_modules'] = implode(",",$postedData ['allowed_modules']);
			
		//	echo "<pre>";print_r($postedData);die;
		
			$this->usertype_model->editusertype($postedData);
			redirect(base_url()."admin/useraccess","refresh");
		}
		else
		{
			$this->backtologin();
		}
	}
	
	private function validate_usertype($postData)
	{
		return TRUE;
	}
	
}
?>