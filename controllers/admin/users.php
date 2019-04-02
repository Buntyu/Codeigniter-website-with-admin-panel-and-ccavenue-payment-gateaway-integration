<?php include("secureaccess.php"); ?>
<?php
class Users extends SecureAccess 
{
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");
		$this->load->model("admin/User_model");
	}
	public function index()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$userData = $this->User_model->getAllUsers();
		$headings = array
		(
			"userid"=>"User ID",
		//	"password"=>"Password",
			"refferal_code"=>"Refferal Code",			
			"firstname"=>"Name",
			//"middlename"=>"Middle Name",
			//"lastname"=>"Last Name",
			//"gender"=>"Gender",
			//"dob"=>"Date Of Birth",
			"email"=>"Email Address",
			"mobile"=>"Mobile Number",
			//"telephone"=>"Phone Number",
			"address"=>"Address",
			"city"=>"City",
			"state"=>"State",
			"country"=>"Country",
			"PIN"=>"PIN",
			//"shippingaddress"=>"Shipping Address",
			//"shipping_area"=>"Shipping Area",			
			//"shipping_PIN"=>"Shipping PIN"
		);
		$label = "Users/Customers Data";
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$userData,"","");
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");
	}
}
?>