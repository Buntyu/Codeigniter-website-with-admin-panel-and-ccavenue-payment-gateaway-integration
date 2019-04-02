<?php include("securearea.php"); ?>
<?php include("cart.php"); ?>
<?php 
class Login extends Securearea 
{
   public $oCart;
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->helper('string');				
		$this->load->model("admin/areas_model");
		$this->load->model("admin/order_model");
		$this->load->model("admin/shipping_model");
		$this->load->model("login_model");
		//$this->oCart = new Cart();
		$this->load->library('session');
	}
	
	function index()
	{
		$this->OrderLogin();
	}

	function OrderLogin(){

     	$this->hidecartlist = TRUE;
		//load header
		$this->loadHeader($this);

		$this->load->view('login_view');
         	
		//load footer
		$this->loadFooter($this);
	}

}
?>