<?php
class check extends CI_Controller
{
	public $allData = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library(array("session","form_validation"));		
		$this->load->helper(array('form', 'url'));
	//	echo '<pre>';print_r($_SESSION);die;
		$this->allData = unserialize($_SESSION['org_data']);
	}
	
	function index()
	{
		$data['theme_url'] = base_url()."mywebadmin/"; 
		$data['title'] = "Test Page - My Web Admin.In";
		$this->load->library("geolocation");
		$data['geo'] = $this->geolocation->getlocation($this);		
		
		echo "<pre>";print_r($data['geo']);die;
	}
} 
?>