 <?php include("secureaccess.php"); ?>
<?php
class Personnel extends SecureAccess 
{
	public $posteddata = "";
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");		
		$this->load->model("admin/personnel_model");		
	}

	public function index()
	{
		$this->listAreas();
	}
	
	private function listAreas() 
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		
		$this->load->view("admin/personnel_view");
		

			
		$areas = $this->personnel_model->demo();
		$areas1 = $this->personnel_model->demo1();
		foreach($areas1 as $rows1){
			if ($rows1['SuccessfullTransaction'] != '')
			{
			$sucess = 0;
			}
			$id = $rows1['Name']; 
			$data = array(
  'no_of_pending_pay' =>$sucess
);

$this->db->where('affiliate_id', $id);
$this->db->update('_affiliate_user', $data); 
		}
		foreach($areas as $rows){
			if ($rows['SuccessfullTransaction'] == '')
			{
			$sucess = 0;
			}
			else {
				$sucess = $rows['SuccessfullTransaction'];
			}
			$id = $rows['Name']; 
			$data = array(
  'no_of_pending_pay' =>$sucess
);

$this->db->where('affiliate_id', $id);
$this->db->update('_affiliate_user', $data); 
		}
		
		$areasData = $this->personnel_model->getAreas();	
		
	//	echo "<pre>"; print_r($areasData);die;
		$headings = array(
			"first_name"=>"Name",
			//"last_name"=>"Last Name",
			"mobile_phone"=>"Mobile Number",
			"email"=>"Email",
			"user_id"=>"Refferal Code",
			//"aadhar_number"=>"Aadhar Number",
			//"pan_number"=>"Pan Number",
			//"account_name"=>"Bank Account Name",
			//"account_number"=>"Account Number",
			//"bank_name"=>"Bank Name",
			//"ifsc_code"=>"IFSC Code"
			
			//"no_of_pending_pay" => "Payments Pending", 
			//"created_date"=>"Created Date",
			
			);		
		$label = "Affiliates List";
		$action = array
		(
			"btns"=>array("edit","delete","view"),
			"text"=>array("Details","Delete","View Sales"),
			"dbcols"=>array("affiliate_id","affiliate_id","affiliate_id"),
			"link"=>array(base_url()."admin/personnel/getareas/%@$%",base_url()."admin/personnel/delareas/%@$%",base_url()."admin/personnel/sales_invoice/%@$%"),
			"clickable"=>array("#areasmodal","#deleteareasmodal","")
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$areasData,"",$action);		
		$this->load->view('helpers/members_table_view',$tableData);
		
		
		$this->load->view("admin/includes/admin_footer");	
	}
	
	
	public function createareas()
	{
		if(!(empty($_POST)) && ($_POST['areas_func'] == "create"))
		{
			$this->posteddata = $_POST;
			if($this->validateareas($_POST))
			{				
				$this->arrangePostData();
				//echo "<pre>"; print_r($this->posteddata);die;
				$this->personnel_model->insertareas($this->posteddata);		
				$this->session->set_flashdata("success","Affiliate created successfully.");	
			}
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function getareas($affiliate_id)
	{
		echo json_encode(array("status"=>"success","data"=>$this->personnel_model->getPersonnelByID($affiliate_id)));
	}
	public function delareas($affiliate_id)
	{
		echo json_encode(array("status"=>"success","data"=>$affiliate_id));
	}
	public function editedareas()
	{		
		if(!(empty($_POST)) && ($_POST['areas_func'] == "edit"))
		{
			$this->posteddata = $_POST;
			if($this->validateareas($_POST,TRUE))
			{				
				$affiliate_id = $this->posteddata['affiliate_id_1'];
				$this->arrangePostData(TRUE);
				$this->personnel_model->updateareas($affiliate_id,$this->posteddata);	
				$this->session->set_flashdata("success","Affiliate updated successfully.");			
			}			
			$this->RefreshListingPage();
		}
		else
		{
			$this->backtologin();
		}
	}
	
	public function deleteareas($affiliate_id)
	{
                $affiliate_id = $this->input->get('id');
		$this->personnel_model->deletearea($affiliate_id);
		$this->RefreshListingPage();
	}
	
	private function RefreshListingPage()
	{
		redirect(base_url()."admin/personnel","refresh");
	}	
	
	
	private function validateareas($data,$is_edit = "")
	{return TRUE;
		$chkuniq = "";
		if(!$is_edit){
			 $chkuniq = '|is_unique['.DBPREFIX.'_affiliate_user.first_name]';
		}
		if($this->posteddata && isset($this->posteddata['areas_count']))
		{
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['areas_count']; $i++)			
			{
				$this->form_validation->set_rules('first_name_'.$i, 'first Name', 'xss_clean|trim|required'.$chkuniq);
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
		if($this->posteddata && isset($this->posteddata['areas_count']))
		{//echo "<pre>";print_r($this->posteddata);die;
			$arrRetval = array();
			$cnt = 0;
			for($i=1; $i<=$this->posteddata['areas_count']; $i++)			
			{	
				$arrRetval[$cnt]['first_name'] = $this->posteddata["first_name_".$i];
				//$arrRetval[$cnt]['last_name'] = $this->posteddata["last_name_".$i];
				$arrRetval[$cnt]['email'] = $this->posteddata["person_email_".$i];
				$arrRetval[$cnt]['user_id'] = $this->posteddata["reff_code_".$i];
				$arrRetval[$cnt]['mobile_phone'] = $this->posteddata["mobile_number_".$i];
				$arrRetval[$cnt]['aadhar_number'] = $this->posteddata["aadhar_number_".$i];
				$arrRetval[$cnt]['pan_number'] = $this->posteddata["pan_number_".$i];
				$arrRetval[$cnt]['account_name'] = $this->posteddata["account_name_".$i];
				$arrRetval[$cnt]['account_number'] = $this->posteddata["account_number_".$i];
				$arrRetval[$cnt]['bank_name'] = $this->posteddata["bank_name_".$i];
				$arrRetval[$cnt]['ifsc_code'] = $this->posteddata["ifsc_code_".$i];

						
				$cnt++;
			}			
			$this->posteddata = $arrRetval;			
			//Echo "<pre>";print_r($this->posteddata);die;
		}
		else
		{
			$this->backtologin();
		}
	}

	function sales_invoice($affiliate_id)
	{
		$this->load->model("admin/personnel_model");
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);
				
		$orderData = $this->personnel_model->getSalesInvoice($affiliate_id);
		$data['paymentData'] = $this->personnel_model->getAffiPayments($affiliate_id);
		$data['affiliateData'] = $this->personnel_model->getPersonnelByID($affiliate_id);
		//echo "<pre>";print_r($paymentData);echo "</pre>";die;
		$data['salesData'] = $orderData;
		$this->load->view("admin/affi_sales_view",$data);
		$this->load->view("admin/includes/admin_footer");
	}


	public function disp_invoice($inv_id = "0")
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);
		$data = array();
		$this->load->model("admin/sales_model");
		$this->load->model("admin/user_model");
		$this->load->model("admin/product_model");
		
                $inv= $this->sales_model->getSalesInvoice($inv_id);
		//$data["inv"] = $data["inv"][0]; 
		//print_r($data["inv"]);die;
		$inv= $inv[0];
                $amount = $inv['total_price'];
		$data['converted'] = $this->convertNum($amount);
		//print_r($inv);die;
		$inv['cart_data'] = $this->arrangeCartData($inv['cart_data']);
		//print_r($inv['cart_data']);die;
		$data["inv"] = $inv;
		//$data["inv"] = $this->sales_model->getSalesInvoice($inv_id);$data["inv"] = $data["inv"][0]; 
		$data["cust"] = $this->user_model->getAllUsers($data["inv"]["customer_id"]);$data["cust"] = $data["cust"][0];
		$productids = unserialize($data["inv"]["product_ids"]);
		$data["quantities"] = unserialize($data["inv"]["product_quantities"]);
		$data["products"] = $this->product_model->getProduct($productids," product_id, product_name, product_price, discount_price, 
                 discount_status ");		
		$this->load->view("admin/disp_invoice_view",$data);
		$this->load->view("admin/includes/admin_footer");		
	}


	 public function disp_invoice1($inv_id = "0")
 {
  
  $data['oObj'] = $this;  
  $this->load->view("admin/includes/admin_header",$data);
  $data = array();
  $this->load->model("admin/sales_model");  
  $this->sales_model->update_commission_status($inv_id);
  redirect($_SERVER['HTTP_REFERER']);
  $this->load->view("admin/includes/admin_footer");  
 }

      private function arrangeCartData($cartData)
	{
		$cartData = unserialize($cartData);
		//print_r($cartData);die;
		$cart = array();
		foreach($cartData as $data)
		{
			unset($data["rowid"]);
			$cart[$data["id"]] = $data;
			//$cart[$data["subtotal"]] = $data;
		}
		return $cart;
	}


public function insertPayment()
{
	$posted = array();
	
	$posted['payment_status'] = $_POST['reff_status'];
	$posted['order_id'] = $_POST['order_id'];
	$posted['payment_amount'] = $_POST['pay_amt'];
	$posted['payment_date'] = $_POST['pay_date'];
	$posted['month'] = $_POST['month'];
	$posted['week'] = $_POST['week'];
	$posted['affiliate_id'] = $_POST['aff_id'];
	$posted['refference_code'] = $_POST['pay-reff'];

	$mail = array();
	$mail['month_full'] = $_POST['month_full'];
	$mail['week'] = $_POST['week'];
	$mail['aff_id'] = $_POST['aff_id'];
	$mail['aff_name'] = $_POST['aff_name'];
	$mail['aff_email'] = $_POST['aff_email'];
	$mail['refference_code'] = $_POST['pay-reff'];
	$mail['week_st'] = $_POST['week_st'];
	$mail['week_en'] = $_POST['week_en'];

	$this->personnel_model->insertPayment($posted);
	$this->mailtoAffiliate($mail);
	$this->session->set_flashdata("success","Payment details saved successfully");
	redirect(base_url()."admin/personnel/sales_invoice/".$posted['affiliate_id'],"refresh");
	
}

public function mailtoAffiliate($mail)
	{
	
	$affName = $mail['aff_name'];
	$affEmail = $mail['aff_email'];
	$affid = $mail['aff_id'];
	$reffCode = $mail['refference_code'];
	$month_full = $mail['month_full'];
	$week = $mail['week'];
	$week_st = $mail['week_st'];
	$week_en = $mail['week_en'];
		
		require("/home/bisjez6o/public_html/phpmailtesting/PHPMailer_5.2.0/class.phpmailer.php");

				$mail = new PHPMailer();
				
				$mail->IsSMTP();                                      // set mailer to use SMTP
				$mail->Host = "localhost";  // specify main and backup server
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = "info@bisjexporters.com";  // SMTP username
				$mail->Password = "%nuysqBiZ?6S"; // SMTP password
				
				$mail->From = "info@bisjexporters.com";
				$mail->FromName = "bisj";
				$mail->AddAddress($affEmail);                  // name is optional
				
				$mail->WordWrap = 50;                                 // set word wrap to 50 characters
				   
				$mail->IsHTML(true);                                  // set email format to HTML
				
				$mail->Subject = "Payment Received !";
				$mail->Body    = 'Hi '.$affName.',<br> Congratulations! Your payment for the month '.$month_full.' week ranging('.$week_st.'-'.$week_en.') has been made. Your bank refference number is <span style="color:green;">'.$reffCode.'</span> For further details LOG IN to your account Now. <br><br><br><br><br> For any queries you can mail us at info@bisjexporters.com<br> or contact us at Contact No: +91 7009272362, +91 7011993301 ';
				$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
				
			
			       $mail->Send();
					}


}
?>



