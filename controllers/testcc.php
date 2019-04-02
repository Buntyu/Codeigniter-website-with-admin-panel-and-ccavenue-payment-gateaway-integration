<?php include("securearea.php"); ?>
<?php

class Testcc extends Securearea
{

     public function index()
     {
         $this->load->view("ccavenueform_view");
     
     }


}
?>
