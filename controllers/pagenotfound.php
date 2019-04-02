<?php
class Pagenotfound extends CI_Controller 
{
	public function index()
	{
		$this->load->helper(array('url'));
		$this->load->view('helpers/pagenotfound_view');
	}
}
?>