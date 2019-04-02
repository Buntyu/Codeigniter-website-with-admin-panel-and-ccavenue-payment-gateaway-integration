<?php include("securearea.php"); 
class Privacy extends Securearea 
{
	function __construct()
	{		
		parent::__construct();
	}
	public function index()
	{
		$this->loadHeader($this,FALSE,"Privacy Policy");
		
		//load sidebar
		$this->loadSidebar($this);
		
		$this->load->view("privacy_view");
		
			//load footer
		$this->loadFooter($this);
	}
}
?>