<?php include("securearea.php"); ?>
<?php
class UserLogin extends Securearea 
{
	public $redirect = "";
	function __construct()
	{		
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("login_model");
		if(isset($_GET['redirect'])){$this->redirect = $_GET['redirect'];}
		else $this->redirect = base_url();
	}
	
	public function index()
	{
		$this->user_account();
	}
	
	
		public function user_account()
	{
		
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar1($this);
		
		//load middle content
		$user_id = $this->session->userdata("id");
		//$user_id = $this->session->userdata("id");
		
		$data["user_account"] = $this->login_model->getUserByID1($user_id);
		
		
		$this->load->view('user_detail_view',$data);		
		
		//load footer
		$this->loadFooter($this);
	}
		public function user_address()
	{
		
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar1($this);
		
		//load middle content
		$user_id = $this->session->userdata("id");
		//$user_id = $this->session->userdata("id");
		
		$data["user_address1"] = $this->login_model->getUserByID1($user_id);
		
		
		$this->load->view('user_detail_view',$data);		
		
		//load footer
		$this->loadFooter($this);
	}
	public function user_account_edit()
	{
		if(!(empty($_POST)))
		{
		//load middle content
		$postedData = $_POST;
		$user_id = $this->session->userdata("id");
		//print_r($postedData);
		//die();
		
		$this->login_model->EditUserAccount($postedData,$user_id);
		//$view["url"] = urldecode($_GET['redirectlink']);
		//$this->load->view('affiliate_edit_view',$view);
      // $this->affiliate_account();	
	   redirect(base_url()."UserLogin/user_account");
		
		}
	}
	public function user_address_edit()
	{
		if(!(empty($_POST)))
		{
		//load middle content
		$postedData = $_POST;
		$user_id = $this->session->userdata("id");
		//print_r($postedData);
		//die();
		
		$this->login_model->EditUserAccount($postedData,$user_id);
		//$view["url"] = urldecode($_GET['redirectlink']);
		//$this->load->view('affiliate_edit_view',$view);
      // $this->affiliate_account();	
	   redirect(base_url()."UserLogin/user_address");
		
		}
	}



}
?>