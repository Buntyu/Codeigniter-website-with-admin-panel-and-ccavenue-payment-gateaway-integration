<?php include("secureaccess.php"); ?>
<?php 
class Login extends SecureAccess 
{	
	public $isLogin = TRUE;
	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->load->library('session');
	}
	public function index()
	{	
//	echo "<pre>";print_r($this->userData);die;
		if($this->userData != FALSE)
		{
			$this->user_login();
		}
		else
		$this->load->view('admin/login_view');
	}
	public function user_login()
	{
		if($this->userData != FALSE)
		{
			redirect(base_url()."admin/dashboard","refresh");
			$userdata = $this->userData;
		//	echo "<pre>"; print_r($userdata);die;			
		}
		$this->backtologin();
	}	
	
	
	
}
?>