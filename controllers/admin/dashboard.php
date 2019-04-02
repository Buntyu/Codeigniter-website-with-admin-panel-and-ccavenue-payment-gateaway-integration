<?php include("secureaccess.php"); ?>
<?php
class Dashboard extends SecureAccess 
{
	function __construct()
	{
		parent::__construct();	
	}
	public function index()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->load->view("admin/includes/admin_footer");
	}
}
?>