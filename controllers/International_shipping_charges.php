<?php include("securearea.php"); ?>
<?php

class International_shipping_charges extends Securearea
{
    function __construct() {
        parent::__construct();
        $this->load->model('admin/certificates_model');
    }
    
    public function index() 
    {
    $this->loadHeader($this,FALSE,"International shipping charges");
    
   // $this->loadSidebar($this);
    
    $data['carausel_data'] = $this->certificates_model->getAllData();
    
    $this->load->view("certificates_view",$data);
    
    $this->loadFooter($this);
    }



}
?>