<?php include("secureaccess.php"); ?>
<?php

class Invoice extends SecureAccess 
{

        function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");
		$this->load->library('excel');
		$this->load->library('session');
		$this->load->model("admin/Order_model");
		$this->load->model("admin/Vendors_model");
		$this->load->model("admin/areas_model");
		$this->load->model("admin/currency_model");
	}
	public function index()
	{
		$this->sales_invoice();
	}
	
	function sales_invoice()
	{
		$this->load->model("admin/sales_model");
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);			
		$orderData = $this->sales_model->getSalesInvoice();
		//echo "<pre>";print_r($orderData);die;
		
		$headings = array
		( 
			"sales_id"=>"Invoice No.",
			"order_uid"=>"Order ID",
			"ship_name"=>"Customer Name",
			"payment_type" => "Payment Type",
		//	"customer_name" =>"Customer Name",
			"total_price" => "sales Amount",
			"tracking_id" => "Tracking Number",
			"ship_country"=>"Country",
			"currency"=>"Currency",
			"or_status"=>"Status",
		//	"created_date"=>"Created On"
		);
		
		$statusval = array(
							'' => array(
								"value" =>"active",
								"text" => "Completed"
								),
							'cancelled' =>array(
								"value" =>"inactive",
								"text" => "Cancelled"
								)
					);
		$this->customtable_lib->createStatus("or_status",$statusval);
		
		$label = "Sales Invoice";
		$action = array
		(
			"btns"=>array("edit"),
			"text"=>array("View Sales Invoice"),
			"dbcols"=>array("order_id"),
			"link"=>array(base_url()."admin/sales/disp_invoice/%@$%"),
			"clickable"=>array()
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$orderData,"",$action);
		$tableData["descFirst"] = TRUE;
		$this->load->view('helpers/members_table_view',$tableData);
		$this->load->view('admin/sales_inv_view');			
		$this->load->view("admin/includes/admin_footer");
	}

}
?>