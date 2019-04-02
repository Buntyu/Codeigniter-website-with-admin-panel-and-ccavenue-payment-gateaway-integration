<?php include("secureaccess.php"); ?>
<?php
class Test extends SecureAccess 
{
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");
		$this->load->model("admin/Test_model");
	}
	public function index()
	{
		$this->load->view('admin/test_view');
	}
	
	public function testfunc($testvar)
	{		
		echo "Reached  ".$testvar;
	}
	public function testarr($var)
	{		
		print_r(unserialize(urldecode($var)));die;
		$arr = array("name"=>"ibad","lastname"=>"gore");
		echo urlencode(serialize($arr));
	}
	
	public function testtheme()
	{
	//	$this->Test_model->insertdummyentries(250);die;
		$tablecells =  $this->Test_model->getdummyentries();
	//	echo "<pre>"; print_r($tablecells);die;
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);		
		
		
		
		//Start working here
		//$tableLabel = "",$tableCols=array(),$tableVals=array(),$status=array(),$action=array()
		$headings = array(
			"name"=>"Name",
			"dob"=>"Date Of Birth",
			"mobile"=>"Mobile number",
			"description"=>"Description",
			"present_status"=>"Present Status",
			"application_status"=>"Application Status",			
			"date_created"=>"Created date",
			"image_url"=>"Image Url",
			);
			$statusval = array(
								1 => array(
									"value" =>"active",
									"text" => "Active"
									),
								0 =>array(
									"value" =>"inactive",
									"text" => "Inactive"
									)
						);
		$this->customtable_lib->createStatus("present_status",$statusval);
		$statusval = array(
								1 => array(
									"value" =>"active",
									"text" => "Active"
									),
								2 => array(
									"value" =>"pending",
									"text" => "Pending"
									),
								3 => array(
									"value" =>"inactive",
									"text" => "Inactive"
									),
								4 => array(
									"value" =>"danger",
									"text" => "Fraud"
									),
						);
		$this->customtable_lib->createStatus("application_status",$statusval);
		$status = "";
		/*
		 $status = array("0" => 
		 	array(
				"varname"=>"is_active",
				"statusvals"=>array(
					1 => array(
						"value" =>"active",
						"text" => "Active"),
					0 =>array(
						"value" =>"inactive",
						"text" => "Inactive")
						)
					)
			);
				$tablecells = array(
			"0"=>array
				(
					"uname"=>"ibad",
					"date"=>"Date registered",
					"role"=>"Role",
					"is_active"=>"0",
					"check"=>1
				),
				"1"=>array
				(
					"uname"=>"Username",
					"date"=>"Date registered",
					"role"=>"Role",
					"is_active"=>"0",
					"check"=>0
				),
				"2"=>array
				(
					"uname"=>"Username",
					"date"=>"Date registered",
					"role"=>"Role",
					"is_active"=>"0",
					"check"=>1
				),
				"3"=>array
				(
					"uname"=>"Username",
					"date"=>"Date registered",
					"role"=>"Role",
					"is_active"=>"0",
					"check"=>0
				),
				"4"=>array
				(
					"uname"=>"Ibad",
					"date"=>"Date registered",
					"role"=>"Role",
					"is_active"=>"1",
					"check"=>1
				),
				"5"=>array
				(
					"uname"=>"Username",
					"date"=>"Date registered",
					"role"=>"Role",
					"is_active"=>"1",
					"check"=>0
				),
				"6"=>array
				(
					"uname"=>"Username",
					"date"=>"Ibad",
					"role"=>"Role",
					"is_active"=>"0",
					"check"=>1
				),
				"7"=>array
				(
					"uname"=>"Username",
					"date"=>"Date registered",
					"role"=>"Role",
					"is_active"=>"1",
					"check"=>0
				),
				"8"=>array
				(
					"uname"=>"Username",
					"date"=>"Date registered",
					"role"=>"Ibad",
					"is_active"=>"1",
					"check"=>0
				),
				"9"=>array
				(
					"uname"=>"Username",
					"date"=>"Date registered",
					"role"=>"Role",
					"is_active"=>"1",
					"check"=>0
				),
				"10"=>array
				(
					"uname"=>"Username",
					"date"=>"Date registered",
					"role"=>"Role",
					"is_active"=>"1",
					"check"=>0
				)
		);
			*/		
		// View Edit Delete	
		$action = array
		(
			"btns"=>array("view","edit","delete"),
			"text"=>array("View","Edit","Delete"),
			"dbcols"=>array("id","id","id"),
			"link"=>array("","http://google.com?q=%@$%","http://google.com?q=%@$%"),
			"clickable"=>array("#myModal","#myModal")
		);
		$tableData = $this->customtable_lib->formatTableCells("test",$headings,$tablecells,$status,$action);		
	
	//	$tableData['nonclickable'] = array("5");
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");
	}
}
?>