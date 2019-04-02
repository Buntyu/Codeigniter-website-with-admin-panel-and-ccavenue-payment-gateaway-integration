<?php include("securearea.php"); ?>
<?php include("crypto.php"); ?>

<?php

class Request extends Securearea
{


	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");	
		$this->load->helper('string');			
		$this->load->model("admin/areas_model");
		$this->load->model("admin/order_model");
		
		$this->load->library('session');
	}

      public function sendRequest()
   {

   
   $this->load->view("request_view");


   }
   
     public function getResponse()
   {

   //echo "beep";
   $this->load->view("response_view");


   }
   
  




}
?>
