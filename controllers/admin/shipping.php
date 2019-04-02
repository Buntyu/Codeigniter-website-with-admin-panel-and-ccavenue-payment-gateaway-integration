<?php include("secureaccess.php"); ?>
<?php
class Shipping extends SecureAccess 
{
	public $posteddata = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");		
		$this->load->model("admin/shipping_model");		
	}
	public function index()
	{
		$this->listshipping();
	}
	
	private function listshipping()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->load->view("admin/shipping_view");
		
		
		$brandData =  $this->shipping_model->getShips();
		
//		echo "<pre>"; print_r($brandData);die;
		$headings = array(
			"ship_id"=>"ID",
			"country_name"=>"Country",
			"upto1"=>"0.0 - 1.0 (KG)",
			"upto2"=>"1.1 - 2.0 (KG)",
			"upto3"=>"2.1 - 3.0 (KG)",
			"above3"=>"Above 3.0 (KG)",
			"freeship"=>"Free Shipping"	
						
			);	
			
		
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("ship_id","ship_id"),
			"link"=>array(base_url()."admin/shipping/getshipsbyid/%@$%",base_url()."admin/shipping/deleteships/%@$%"),
			"clickable"=>array("#brandsmodal","")
		);
		$label = "Shipping List";
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$brandData,"",$action);
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	
	public function createshipping()
	{//echo "<pre>";print_r($_POST);die;
		if(!(empty($_POST)) && ($_POST['brands_func'] == "create"))
		{
			$this->posteddata = $_POST;
			if($this->validateships($_POST)){
				$this->arrangePostData();
			//	echo "<pre>"; print_r($this->posteddata);die;
				$this->shipping_model->insertshipping($this->posteddata);
				$this->session->set_flashdata("success","Shipping created successfully.");
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function getshipsbyid($ship_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->shipping_model->getShipsByID($ship_id)));
	}
	
	public function editedships()
	{

		if(!(empty($_POST)) && ($_POST['brands_func'] == "edit"))
		{
			$this->posteddata = $_POST;
			if($this->validateships($_POST,TRUE)){
				$ship_id = $this->posteddata['ship_id_1'];
				$this->arrangePostData(TRUE);
				//echo "<pre>";print_r($this->posteddata);die;
				$this->shipping_model->updateShips($ship_id,$this->posteddata);			
				$this->session->set_flashdata("success","Shipping updated successfully.");
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function deleteships($ship_id)
	{
		
		$this->shipping_model->deleteships($ship_id);
		$this->session->set_flashdata("info", "shipping deleted successfully.");			
		$this->RefreshListingPage();
	}
	
	private function RefreshListingPage()
	{
		redirect(base_url()."admin/shipping","refresh");
	}
	
	private function validateships($data,$is_edit="")
	{
		$chkuniq = "";
		if(!$is_edit){
			 $chkuniq = '|is_unique['.DBPREFIX.'_shipping.country_name ]';
		}
		if($this->posteddata && isset($this->posteddata['ships_count']))
		{
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['ships_count']; $i++)			
			{
				$this->form_validation->set_rules('country_name_'.$i, 'Country Name', 'xss_clean|trim|required'.$chkuniq);
				//$this->form_validation->set_rules('currency_amount_'.$i, 'Currency Amount', 'required');	
			}
		}		
		if ($this->form_validation->run() == FALSE)
		{
			$errors = validation_errors();
			$this->session->set_flashdata("error", $errors);			
			return FALSE;
		}
		else			
		return TRUE;
	}
	
	
	private function arrangePostData($isUpdate = FALSE)
	{		
		if($this->posteddata && isset($this->posteddata['ships_count']))
		{//echo "<pre>";print_r($this->posteddata);die;
			$arrRetval = array();
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['ships_count']; $i++)			
			{
				$arrRetval[$cnt]['country_name'] = $this->posteddata["country_name_".$i];
				$arrRetval[$cnt]['upto1'] = $this->posteddata["upto1_".$i];
				$arrRetval[$cnt]['upto2'] = $this->posteddata["upto2_".$i];	
				$arrRetval[$cnt]['upto3'] = $this->posteddata["upto3_".$i];		
				$arrRetval[$cnt]['above3'] = $this->posteddata["above3_".$i];
				$arrRetval[$cnt]['freeship'] = $this->posteddata["freeship_".$i];
							
				$cnt++;
			}
			$this->posteddata = $arrRetval;			
		//	echo "<pre>";print_r($this->posteddata);die;
		}
		else
		{
			$this->backtologin();
		}
	}
}
?>