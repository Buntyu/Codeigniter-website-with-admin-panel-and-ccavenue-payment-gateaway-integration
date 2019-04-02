<?php include("securearea.php"); ?>
<?php
class Affiliate_tac extends Securearea 
{ 
	function __construct()
	{		
		parent::__construct();
	}
	public function index()
	{
		$this->loadHeader($this,FALSE,"Affiliate Terms and Conditions");
		
		//load sidebar
		$this->loadSidebar($this);
		
		$this->load->view("afftac_view");
		
			//load footer
		$this->loadFooter($this);
	}
}
?>