<?php include("secureaccess.php"); ?>
<?php 

class Coupons extends SecureAccess 
{
	public $posteddata = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");		
		$this->load->model("admin/coupons_model");		
	}
	public function index()
	{
		$this->listCoupons();
	}
	
	private function listCoupons()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->load->view("admin/coupons_view");
		
		
		$couponsData = $this->coupons_model->getCoupons();	
		
	//	echo "<pre>"; print_r($couponsData);die;
		$headings = array(
			
			"coupon_code"=>"Coupon CODE",
			"description"=>"Description",
			"discount" => "Coupon Discount (%)",
			
			);			
		$label = "Coupons List";
		$action = array
		(
			"btns"=>array("edit","delete"),
			"text"=>array("Edit","Delete"),
			"dbcols"=>array("coupon_id","coupon_id"),
			"link"=>array(base_url()."admin/coupons/getcoupons/%@$%",base_url()."admin/coupons/deletecoupons/%@$%"),
			"clickable"=>array("#areasmodal","")
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$couponsData,"",$action);	
	//	echo "<pre>"; print_r($tableData);die;	
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	
	public function createcoupons()
	{
		if(!(empty($_POST)) && ($_POST['coupons_func'] == "create"))
		{
			$this->posteddata = $_POST;
		
			if($this->validatecoupons($_POST))
			{				
				$this->arrangePostData();
				//echo "<pre>"; print_r($this->posteddata);die;
				$this->coupons_model->insertcoupons($this->posteddata);		
				$this->session->set_flashdata("success","Coupon created successfully.");	
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function getcoupons($coupons_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->coupons_model->getCouponsByID($coupons_id)));
	}
	
	public function editedcoupons()
	{		
		if(!(empty($_POST)) && ($_POST['coupons_func'] == "edit"))
		{
			$this->posteddata = $_POST;
			if($this->validatecoupons($_POST,TRUE))
			{				
				$coupons_id = $this->posteddata['coupons_id_1'];
				$this->arrangePostData(TRUE);
				$this->coupons_model->updatecoupons($coupons_id,$this->posteddata);	
				$this->session->set_flashdata("success","Coupons updated successfully.");			
			}			
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function deletecoupons($coupon_id)
	{
		$deleteUser = array
		(
			"deleted_id"=>$this->userData[0]["admin_id"],
			"deleted_date"=>$this->cur_date_time
		);
		$this->coupons_model->deletecoupon($coupon_id,$deleteUser);
		$this->RefreshListingPage();
	}
	
	private function RefreshListingPage()
	{
		redirect(base_url()."admin/coupons","refresh");
	}	
	
	
	private function validatecoupons($data,$is_edit = "")
	{return TRUE;
		$chkuniq = "";
		if(!$is_edit){
			 $chkuniq = '|is_unique['.DBPREFIX.'_categories.coupon_code]';
		}
		if($this->posteddata && isset($this->posteddata['coupons_count']))
		{
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['coupons_count']; $i++)			
			{
				$this->form_validation->set_rules('coupon_code_'.$i, 'coupon Code', 'xss_clean|trim|required'.$chkuniq);
				$this->form_validation->set_rules('display_status_'.$i, 'Display Status', 'required');
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
		if($this->posteddata && isset($this->posteddata['coupons_count']))
		{//echo "<pre>";print_r($this->posteddata);die;
			$arrRetval = array();
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['coupons_count']; $i++)			
			{	
				
				$arrRetval[$cnt]['coupon_code'] = $this->posteddata["coupon_code_".$i];
				$arrRetval[$cnt]['description'] = $this->posteddata["description_".$i];
				$arrRetval[$cnt]['discount'] = $this->posteddata["coupon_discount_".$i];
				if($isUpdate)
				{
					$arrRetval[$cnt]['updated_id'] = $this->userData[0]["admin_id"];
					$arrRetval[$cnt]['updated_date'] = $this->cur_date_time;
				}
				else
				{
					$arrRetval[$cnt]['created_id'] = $this->userData[0]["admin_id"];
					$arrRetval[$cnt]['created_date'] = $this->cur_date_time;
				}		
				$cnt++;   
			}			
			$this->posteddata = $arrRetval;			
			//echo "<pre>";print_r($this->posteddata);die;
		}
		else
		{
			$this->backtologin();
		}
	}
}
?>