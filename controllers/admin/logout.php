<?php
class Logout extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','cookie'));	
		$this->load->library('session');		
	}
	function index()
	{
		$this->session->sess_destroy();
		delete_cookie("ecomm_adminData");
		redirect(base_url()."admin/login","refresh");
	}
}
?>