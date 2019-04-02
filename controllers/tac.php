<?php include("securearea.php"); ?>
<?php
class Tac extends Securearea 
{ 
	function __construct()
	{		
		parent::__construct();
	}
	public function index()
	{
		$this->loadHeader($this,FALSE,"Terms and Conditions");
		
		//load sidebar
		$this->loadSidebar($this);
		
		$this->load->view("tac_view");
		
			//load footer
		$this->loadFooter($this);
	}
}
?>