<?php include("secureaccess.php"); ?>
<?php
class Currency extends SecureAccess 
{
	public $posteddata = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");		
		$this->load->model("admin/currency_model");		
	}
	public function index()
	{
		$this->listBrands();
	}
	
	private function listBrands()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->load->view("admin/currency_view");
		
		
		$brandData =  $this->currency_model->getBrands();
		
//		echo "<pre>"; print_r($brandData);die;
		$headings = array(
			"curr_id"=>"ID",
			"curr_name"=>"Currency Name",
			"curr_symbol"=>"Symbol",
			"curr_amount"=>"Amount"
						
			);	
			
		
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("curr_id","curr_id"),
			"link"=>array(base_url()."admin/currency/getbrandsbyid/%@$%",base_url()."admin/currency/deletebrands/%@$%"),
			"clickable"=>array("#brandsmodal","")
		);
		$label = "Currency List";
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$brandData,"",$action);
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	
	public function createbrands()
	{//echo "<pre>";print_r($_POST);die;
		if(!(empty($_POST)) && ($_POST['brands_func'] == "create"))
		{
			$this->posteddata = $_POST;
			if($this->validatebrands($_POST)){
				$this->arrangePostData();
			//	echo "<pre>"; print_r($this->posteddata);die;
				$this->currency_model->insertbrands($this->posteddata);
				$this->session->set_flashdata("success","Currency created successfully.");
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function getbrandsbyid($curr_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->currency_model->getBrandsByID($curr_id)));
	}
	
	public function editedbrands()
	{

		if(!(empty($_POST)) && ($_POST['brands_func'] == "edit"))
		{
			$this->posteddata = $_POST;
			if($this->validatebrands($_POST,TRUE)){
				$curr_id = $this->posteddata['curr_id_1'];
				$this->arrangePostData(TRUE);
				//echo "<pre>";print_r($this->posteddata);die;
				$this->currency_model->updatebrands($curr_id,$this->posteddata);			
				$this->session->set_flashdata("success","Currency updated successfully.");
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function deletebrands($curr_id)
	{
		
		$this->currency_model->deletebrands($curr_id);
		$this->session->set_flashdata("info", "Currency deleted successfully.");			
		$this->RefreshListingPage();
	}
	
	private function RefreshListingPage()
	{
		redirect(base_url()."admin/currency","refresh");
	}
	
	private function validatebrands($data,$is_edit="")
	{
		$chkuniq = "";
		if(!$is_edit){
			 $chkuniq = '|is_unique['.DBPREFIX.'_currency.curr_name ]';
		}
		if($this->posteddata && isset($this->posteddata['brands_count']))
		{
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['brands_count']; $i++)			
			{
				$this->form_validation->set_rules('currency_name_'.$i, 'Currency Name', 'xss_clean|trim|required'.$chkuniq);
				$this->form_validation->set_rules('currency_amount_'.$i, 'Currency Amount', 'required');	
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
		if($this->posteddata && isset($this->posteddata['brands_count']))
		{//echo "<pre>";print_r($this->posteddata);die;
			$arrRetval = array();
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['brands_count']; $i++)			
			{
				$arrRetval[$cnt]['curr_name'] = $this->posteddata["currency_name_".$i];
				$arrRetval[$cnt]['curr_symbol'] = $this->posteddata["currency_symbol_".$i];
				$arrRetval[$cnt]['curr_amount'] = $this->posteddata["currency_amount_".$i];	
							
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