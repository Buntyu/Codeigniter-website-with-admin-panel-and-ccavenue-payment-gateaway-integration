<?php include("securearea.php");
class Fb_products extends Securearea 
{
	function __construct()
	{		
		parent::__construct();
	}
	public function index()
	{		
		$this->loadHeader($this,FALSE,"BISJ Exporters");
		
		//load sidebar
		$this->loadSidebar($this);
		
		$data['pid'] = $this->input->get('id', TRUE);
		$this->load->view("fb_products_view",$data);
		
		//load footer
		$this->loadFooter($this);
	}
}
?>