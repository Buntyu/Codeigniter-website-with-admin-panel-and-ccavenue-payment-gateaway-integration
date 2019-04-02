<?php include("securearea.php"); ?>
<?php include("cart.php"); ?>
<?php 

  


class Order extends Securearea 
{
	public $oCart;
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->helper('string');				
		$this->load->model("admin/areas_model");
		$this->load->model("admin/order_model");
		$this->load->model("admin/shipping_model");
		$this->load->model("login_model");
		$this->load->model("cart_model");
		$this->oCart = new Cart();
		$this->load->library('session');
	}
	
	function index()
	{
		$this->showOrder();
	}	

	function showOrder()
	{		
	        $this->hidecartlist = TRUE;
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		//$this->loadSidebar($this);
		
		//load middle content

		$view['obj'] = $this;
		$view["areas"] = $this->areas_model->getAreas("","area_name,area_pin");	
		$view['cartData'] = $this->oCart->getcurrentcart(TRUE);
		if(empty($view['cartData']))
		redirect(base_url(),"refresh");
		$view['userdata'] = $this->userData;
        
        	$code = $this->input->post('coupon_box');
        	$this->load->model("Cart_model");
		$heep = $this->Cart_model->getCode($code); 
		$dis_percent = $heep[0]['discount'];
		
		$afficoo = $this->input->cookie("biaffiliate");
		if($afficoo != ""){
			$rId = $this->user_model->getAffiliateId($afficoo);
			$affId = $rId[0]['affiliate_id'];
		}
		$view['affcooid'] = $affId;
		
		$this->session->set_userdata('discount_percent',$dis_percent);
		//if (!isset($_GET['r'])) { echo '<meta http-equiv="refresh" content= "0;URL=?r=1" />'; }
		$imagedataIndia = $this->Cart_model->getImageIndia();
		$view['india'] = $imagedataIndia[0]['carousel_image'];

		$imagedataUsa = $this->Cart_model->getImageUsa();
		$view['usa'] = $imagedataUsa[0]['carousel_image'];

		$imagedataUk = $this->Cart_model->getImageUk();
		$view['uk'] = $imagedataUk[0]['carousel_image'];

		$imagedataEurope = $this->Cart_model->getImageEurope();
		$view['europe'] = $imagedataEurope[0]['carousel_image'];

		$imagedataAus = $this->Cart_model->getImageAus();
		$view['australia'] = $imagedataAus[0]['carousel_image'];

		$imagedataRest = $this->Cart_model->getImageRest();
		$view['rest'] = $imagedataRest[0]['carousel_image'];

		$imagedataBulk = $this->Cart_model->getImageBulk();
		$view['bulk'] = $imagedataBulk[0]['carousel_image'];

		$imagedataCourier = $this->Cart_model->getImageCourier();
		$view['courier'] = $imagedataCourier[0]['carousel_image'];
		
		$this->load->view('order_view',$view);
       // $this->load->view('cart_order_view');	
         
		
		//load footer
		$this->loadFooter($this);
	}
	function placeOrder()
	{
		if(empty($_POST))redirect(base_url()."order","refresh");
		$this->load->library('form_validation');		
		$config = array(
             array(
                     'field'   => 'shippingaddress', 
                     'label'   => 'Shipping Address', 
                     'rules'   => 'trim|required'
                  ),
      /*       array(
                     'field'   => 'shipping_area', 
                     'label'   => 'Shipping Area', 
                     'rules'   => 'trim|required'
                  ),  */
             array(
                     'field'   => 'shipping_PIN', 
                     'label'   => 'Shipping Postal Code', 
                     'rules'   => 'trim|required|min_length[6]'
                  ),
			  array(
	                 'field'   => 'customer_id', 
	                 'label'   => 'Customer ID', 
	                 'rules'   => 'trim|required'
	              ),
			   
		/*	array(
	                 'field'   => 'recieving_date', 
	                 'label'   => 'Recieving Date', 
	                 'rules'   => 'trim|required'
	              ),			*/	    
            );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{	
			$this->showOrder();
			$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"<strong>Please Re-Check your Form.</strong>")));
		}
		else
		{
			$orderData = $_POST;
		//	$this->session->set_userdata('orderdata',$orderData);


			$orderData["recieving_date"] = str_replace("/","-",$orderData["recieving_date"]);			
			$mer = (intval($orderData["recieving_time"]) >= 10 && intval($orderData["recieving_time"]) <= 12)?"AM" : "PM";			
			//$orderData["order_date_time"] = $orderData["recieving_time"]." ".$mer." ".$orderData["recieving_date"];
			unset($orderData["recieving_time"]);unset($orderData["recieving_date"]);
			$orderData["date_time"] =  $_POST['date_time'];
			
			$orderData["order_amount"] =  $_POST['order_amount'];
			$orderData["shipping_country"] = $_POST['shipping_country'];
			$orderData["shipping_state"] = $_POST['shipping_state'];
			$orderData["shipping_city"] = $_POST['shipping_city'];
			$orderData["affiliate_id"] = $_POST['affiliate_id'];
			//$orderData["affiliate_id"] = $_POST['affiliate_id'];
			//$testtt = $_POST['order_amount'];
			//$orderData["receipt_number"] =  $receiptNo;
			
			$cartcontent = $this->cart->contents();
			if(empty($cartcontent))redirect(base_url());
			$orderData["cart_data"] = serialize($cartcontent);

            		$this->order_model->placeOrder($orderData);			
			$this->session->set_flashdata("alert",json_encode(array("type"=>"success","msg"=>"<strong>Your Order is placed Successfully.</strong>")));	
			$this->loadHeader($this);
			$this->loadSidebar($this);	
			$view['obj'] = $this;
			$this->load->view("placed_order_view",$orderData);	
			$this->loadFooter($this);	
			$this->oCart->removeCart();

				
				
			//	$tmpId = $this->order_model->placeOrderTwo($orderData);	
			//	$this->load->view("test_view",$orderData);

		}
	}
	
	function ccForm()
	{
	        
			$this->loadHeader($this);
			$view['obj'] = $this;

			$codDate = date('d/m/Y h:i:s ', time());
			
			//echo "<pre>";print_r($_POST);die;
	        if (isset($_POST['cod'])) {
	         //   echo "cod";die;
	        $cartcontent = $this->cart->contents();
		    $codOrder["cart_data"] = serialize($cartcontent); 
		    $codOrder["order_uid"] =  $_POST['order_UID'];
		    $codOrder["sale_price"] =  $_POST['sale_price'];
		    $codOrder["reff_discount"] =  $_POST['reff_discount'];
		    $codOrder["total_shipping"] =  $_POST['total_shipping'];
		    $codOrder["total_price"] =  $_POST['total_price'];
		    $codOrder["status"] =  $_POST['order_status'];
		    $codOrder["customer_id"] =  $_POST['customer_id'];
		    $codOrder["is_guest"] =  $_POST['is_guest'];	
		    $codOrder["order_amount"] =  $_POST['order_amount'];
		    $codOrder["affiliate_id"] =  $_POST['affiliate_id'];
		    $codOrder["currency"] =  $_POST['currency']; 
		    $codOrder["payment_type"] =  'COD';  
		    $codOrder["order_status"] =  'Success'; 
		    $codOrder["date_time"] =  $codDate; 
		    
		    $codOrder["billing_name"] =  $_POST['customer_name'];
		    $codOrder["billing_zip"] =  $_POST['customer_pin'];
		    $codOrder["billing_address"] =  $_POST['customer_address'];
		    $codOrder["billing_city"] =  $_POST['customer_city'];
		    $codOrder["billing_email"] =  $_POST['customer_email'];
		    $codOrder["billing_tel"] =  $_POST['customer_mobile'];
		    $codOrder["billing_state"] =  $_POST['customer_state'];
		    $codOrder["billing_country"] =  $_POST['customer_country'];
		    
		    $codOrder["shipping_name"] =  $_POST['shipping_name'];
		    $codOrder["shipping_pin"] =  $_POST['shipping_pin'];
		    $codOrder["shippingaddress"] =  $_POST['shipping_address'];
		    $codOrder["shipping_city"] =  $_POST['shipping_city'];
		    $codOrder["shipping_mobile"] =  $_POST['shipping_mobile'];
		    $codOrder["shipping_state"] =  $_POST['shipping_state'];
		    $codOrder["shipping_country"] =  $_POST['shipping_country'];   
		    
		    $this->order_model->placeCodOrder($codOrder);
		    $this->cod_mail_to_user($codOrder);
		    $this->cod_mail_to_admin();
		    redirect('/order/cod');
		    
	            
	        } else if (isset($_POST['ccavenue'])) {
	        $cartcontent = $this->cart->contents();
		    $firstOrder["cart_data"] = serialize($cartcontent);
		    $firstOrder["order_UID"] =  $_POST['order_UID'];
		    $firstOrder["sale_price"] =  $_POST['sale_price'];
		    $firstOrder["reff_discount"] =  $_POST['reff_discount'];
		    $firstOrder["total_shipping"] =  $_POST['total_shipping'];
		    $firstOrder["total_price"] =  $_POST['total_price'];
		    $firstOrder["status"] =  $_POST['order_status'];
		    $firstOrder["customer_id"] =  $_POST['customer_id'];
		    $firstOrder["is_guest"] =  $_POST['is_guest'];
		    $firstOrder["payment_type"] =  "ccavenue";


		    $this->order_model->placeOrder($firstOrder);
	            
		    $orderData["order_amount"] =  $_POST['order_amount'];
		    $orderData["customer_id"] =  $_POST['customer_id'];
		    $orderData["affiliate_id"] =  $_POST['affiliate_id'];
		    $orderData["order_UID"] =  $_POST['order_UID'];
		    $orderData["customer_name"] =  $_POST['customer_name'];
		    $orderData["customer_pin"] =  $_POST['customer_pin'];
		    $orderData["customer_address"] =  $_POST['customer_address'];
		    $orderData["customer_city"] =  $_POST['customer_city'];
		    $orderData["customer_email"] =  $_POST['customer_email'];
		    $orderData["customer_mobile"] =  $_POST['customer_mobile'];
		    $orderData["customer_state"] =  $_POST['customer_state'];
		    $orderData["customer_country"] =  $_POST['customer_country'];
		    
		    $orderData["shipping_name"] =  $_POST['shipping_name'];
		    $orderData["shipping_pin"] =  $_POST['shipping_pin'];
		    $orderData["shipping_address"] =  $_POST['shipping_address'];
		    $orderData["shipping_city"] =  $_POST['shipping_city'];
		    $orderData["shipping_mobile"] =  $_POST['shipping_mobile'];
		    $orderData["shipping_state"] =  $_POST['shipping_state'];
		    $orderData["shipping_country"] =  $_POST['shipping_country'];
		    
		    $orderData["currency"] =  $_POST['currency'];
			
			$this->load->view("ccavenueform_view",$orderData);	
			$this->loadFooter($this);
	        }
			
	}
	
	public function cod()
	{
	$this->loadHeader($this);
	$this->oCart->removeCart();
	$this->load->view("transaction_view");
	}
	
	public function cod_mail_to_user($codData)
	{
	
	$userName = $codData['billing_name'];
	$userEmail = $codData['billing_email'];
		
		require("/home/bisjez6o/public_html/phpmailtesting/PHPMailer_5.2.0/class.phpmailer.php");

				$mail = new PHPMailer();
				
				$mail->IsSMTP();                                      // set mailer to use SMTP
				$mail->Host = "localhost";  // specify main and backup server
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = "admin@bisjexporters.com";  // SMTP username
				$mail->Password = "mQAe,TC!AQe~"; // SMTP password
				
				$mail->From = "admin@bisjexporters.com";
				$mail->FromName = "bisj";
				$mail->AddAddress($userEmail);                  // name is optional
				
				$mail->WordWrap = 50;                                 // set word wrap to 50 characters
				   
				$mail->IsHTML(true);                                  // set email format to HTML
				
				$mail->Subject = "Order Successful !";
				$mail->Body    = 'Hi '.$userName.',<br>Thank you for your order from bisjexporters.com<br>Your Order number is '.$codData['order_uid'].'. We will get back to you soon. 
 <br><br><br><br><br> For any queries you can mail us at info@bisjexporters.com<br> or contact us at Contact No: +91 7009272362, +91 7011993301 ';
				$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
				
			 $mail->Send();
				
	}
					
	public function cod_mail_to_admin()
	{
	
	$adminName = "admin";
	$adminEmail = "admin@bisjexporters.com";
		
	//	require("/home/bisjez6o/public_html/phpmailtesting/PHPMailer_5.2.0/class.phpmailer.php");

				$mail = new PHPMailer();
				
				$mail->IsSMTP();                                      // set mailer to use SMTP
				$mail->Host = "localhost";  // specify main and backup server
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = "admin@bisjexporters.com";  // SMTP username
				$mail->Password = "mQAe,TC!AQe~"; // SMTP password
				
				$mail->From = "admin@bisjexporters.com";
				$mail->FromName = "bisj";
				$mail->AddAddress($adminEmail);                  // name is optional
				$mail->AddAddress("gagandeep.uniyal24@gmail.com");   
				
				$mail->WordWrap = 50;                                 // set word wrap to 50 characters
				   
				$mail->IsHTML(true);                                  // set email format to HTML
				
				$mail->Subject = "New Order !";
				$mail->Body    = 'Hi '.$adminName.',<br>There has been a new Cash on Delivery (COD) order on bisjexporters.com ';
				$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
				
			 $mail->Send();
				
	}
	
	 public function transaction()
   {
       $this->loadHeader($this);
           $responseData = $this->formatResponseData($_POST,TRUE);
           $order_UID = $this->input->post('order_id');
	$this->order_model->finalOrder($responseData, $order_UID);
	$this->oCart->removeCart();
	$this->ccmailToAdmin();
	$this->load->view("transaction_view");
	
   }
   
   	public function ccmailToAdmin()
	{
		
	//	require("/home/bisjez6o/public_html/phpmailtesting/PHPMailer_5.2.0/class.phpmailer.php");

				$mail = new PHPMailer();
				
				$mail->IsSMTP();                                      // set mailer to use SMTP
				$mail->Host = "localhost";  // specify main and backup server
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = "admin@bisjexporters.com";  // SMTP username
				$mail->Password = "mQAe,TC!AQe~"; // SMTP password
				
				$mail->From = "admin@bisjexporters.com";
				$mail->FromName = "bisj";                
				$mail->AddAddress("gagandeep.uniyal24@gmail.com");   
				
				$mail->WordWrap = 50;                                 // set word wrap to 50 characters
				$mail->IsHTML(true);                                  // set email format to HTML
				
				$mail->Subject = "New Order !";
				$mail->Body    = 'Hi Gagandeep,<br>There has been a new CcAvenue order on bisjexporters.com ';
				$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
				
			 $mail->Send();
				
	}
   
   
   public function formatResponseData($postData,$insert = FALSE)
{
	$retData = array
  (
    
	  // "order_uid" =>  $postData['order_id'],
           "tracking_id" =>  $postData['tracking_id'],
           "bank_ref_no" =>  $postData['bank_ref_no'],
           "payment_mode" =>  $postData['payment_mode'],
           "card_name" =>  $postData['card_name'],
           "currency" =>  $postData['currency'],
           "order_amount" =>  $postData['amount'],
           "billing_name" =>  $postData['billing_name'],
           "billing_address" =>  $postData['billing_address'],
           "billing_city" =>  $postData['billing_city'],
           "billing_state" =>  $postData['billing_state'],
           "billing_zip" =>  $postData['billing_zip'],
           "billing_country" =>  $postData['billing_country'],
           "billing_tel" =>  $postData['billing_tel'],
           "billing_email" =>  $postData['billing_email'],
           "shipping_name" =>  $postData['delivery_name'],
           "shippingaddress" =>  $postData['delivery_address'],
           "shipping_city" =>  $postData['delivery_city'],
           "shipping_state" =>  $postData['delivery_state'],
           "shipping_PIN" =>  $postData['delivery_zip'],
           "shipping_country" =>  $postData['delivery_country'],
           "shipping_mobile" =>  $postData['delivery_tel'],
           "customer_id" =>  $postData['merchant_param2'],
           "affiliate_id" =>  $postData['merchant_param3'],
        
           "date_time" =>  $postData['trans_date'],
           
           "order_status" =>  $postData['order_status'],
           "failure_message" =>  $postData['failure_message'],
           "status_code" =>  $postData['status_code'],
           "status_message" =>  $postData['status_message'],
           "status_message" =>  $postData['status_message'],
           "merchant_param5" =>  $postData['merchant_param5'],
           "vault" =>  $postData['vault'],
           "offer_type" =>  $postData['offer_type'],
           "offer_code" =>  $postData['offer_code'],
           "discount_value" =>  $postData['discount_value'],
           "mer_amount" =>  $postData['mer_amount'],
           "eci_value" =>  $postData['eci_value'],
           "retry" =>  $postData['retry'],
           "response_code" =>  $postData['response_code'],
           "billing_notes" =>  $postData['billing_notes'],
           "bin_country" =>  $postData['bin_country'],
           );

  return $retData;

}

public function set_all_address()
	{
		if(!(empty($_POST)))
		{
		//load middle content
		$postedData = $_POST;
		$user_id = $this->session->userdata("id");
		$this->login_model->EditUserAccount($postedData,$user_id);
		//$view["url"] = urldecode($_GET['redirectlink']);
		//$this->load->view('affiliate_edit_view',$view);
      // $this->affiliate_account();	
	   redirect(base_url()."order");
		
		}
	}
	
	public function checkout()
	{
		$this->loadHeader($this);
		
		//$view['reff1'] = $_POST['reffdisc'];
		//$view['reff2'] = $_POST['reffdisc2'];
		$view['curr'] = $_POST['currs'];
		
		$data = array();

		$afficoo = $this->input->cookie("biaffiliate");
		if($afficoo != ""){
			$rId = $this->user_model->getAffiliateId($afficoo);
			$affId = $rId[0]['affiliate_id'];
			$status = "eligible";

			$data += array
				(			
					"refferal_code"=>$afficoo,
					"refferal_status"=>$status,
					"aff_id"=>$affId,
				);
				
		}
		$view['affcooid'] = $affId;
		
		$coo = $this->input->cookie("bisj_queryaff");
		$useraffid = $this->session->userdata("aff_id");
		if($coo != "" && $useraffid == ""){
			$rId = "bamboo";
			$affId = 47;
			$status = "eligible";

			$data += array
				(			
					"refferal_code"=>$rId,
					"refferal_status"=>$status,
					"aff_id"=>$affId,
				);
			
		}
		
		
		$data += array(
	        'bname' => $_POST['bname'],
	        'address' => $_POST['address'],
	        'city' => $_POST['city'],
	        'state' => $_POST['state'],
	        'PIN' => $_POST['PIN'],
	        'country' => $_POST['country'],
	        'bmobile' => $_POST['bmobile'],
	        'bmail' => $_POST['bmail'],
	
	        'ship_name' => $_POST['ship_name'],
	        'shippingaddress' => $_POST['shippingaddress'],
	        'shipping_city' => $_POST['shipping_city'],
	        'shipping_state' => $_POST['shipping_state'],
	        'shipping_PIN' => $_POST['shipping_PIN'],
	        'shipping_country' => $_POST['shipping_country'],
	        'ship_mobile' => $_POST['ship_mobile'],
	        'ship_mail' => $_POST['ship_mail']
	
		);
		
		$cartcontent = $this->cart->contents();
		$abd_cartdata = array(
			'billing_name' => $_POST['bname'],
	        'billing_address' => $_POST['address'],
	        'billing_city' => $_POST['city'],
	        'billing_state' => $_POST['state'],
	        'billing_PIN' => $_POST['PIN'],
	        'billing_country' => $_POST['country'],
	        'billing_mobile' => $_POST['bmobile'],
	        'billing_mail' => $_POST['bmail'],	
	        'ship_name' => $_POST['ship_name'],
	        'shippingaddress' => $_POST['shippingaddress'],
	        'shipping_city' => $_POST['shipping_city'],
	        'shipping_state' => $_POST['shipping_state'],
	        'shipping_PIN' => $_POST['shipping_PIN'],
	        'shipping_country' => $_POST['shipping_country'],
	        'ship_mobile' => $_POST['ship_mobile'],
	        'ship_mail' => $_POST['ship_mail'],
	        'firstname' => $_POST['bname'],
	        'reff_disc' => $_POST['reffdisc'],
			'currency' => $_POST['currs'],
			'is_guest' => 'no',
		    'cart_data' => serialize($cartcontent), 
			'affiliate_id' => $affId,
			'date_time' => date('d/m/Y h:i:s ', time()), 
			);

		$this->cart_model->addAbandonedCartData($abd_cartdata);
		
		$user_id = $this->session->userdata("id");
		$this->login_model->EditUserAccount($data,$user_id);
		
		$data = $this->login_model->getUserByID1($user_id);
		$view['userdata'] =  $data[0];
		$view['cartData'] = $this->oCart->getcurrentcart(TRUE);
		
		$view['shipdata_aus'] = $this->shipping_model->getShipping_aus();
	        $view['shipdata_usa'] = $this->shipping_model->getShipping_usa();
	        $view['shipdata_uk'] = $this->shipping_model->getShipping_uk();
	        $view['shipdata_eur'] = $this->shipping_model->getShipping_eur();
	        $view['shipdata_other'] = $this->shipping_model->getShipping_other();
	        $view['shipdata_india'] = $this->shipping_model->getShipping_india();
	        
	        $another = $this->shipping_model->GetCurrencyAud();
		$view['aud'] = $another[0]['curr_amount'];

		$another = $this->shipping_model->GetCurrencyUsd();
		$view['usd'] = $another[0]['curr_amount'];

		$another = $this->shipping_model->GetCurrencyGbp();
		$view['gbp'] = $another[0]['curr_amount'];

		$another = $this->shipping_model->GetCurrencyEuro();
		$view['euro'] = $another[0]['curr_amount'];

		$another = $this->shipping_model->GetCurrencyOther();
		$view['other'] = $another[0]['curr_amount'];
		
		$name = 'biaffiliate';
		
		delete_cookie($name);

		$this->load->view('final_checkout_view',$view);

		$this->loadFooter($this);
	}
	
	public function guest_checkout(){

		$this->loadHeader($this);
		
		$view['reff1'] = $_POST['reffdisc'];
		$view['reff2'] = $_POST['reffdisc2'];
		$view['curr'] = $_POST['currs'];
		
		$afficoo = $this->input->cookie("biaffiliate");
		if($afficoo != ""){
			$rId = $this->user_model->getAffiliateId($afficoo);
			$affId = $rId[0]['affiliate_id'];
		}
		$view['affcooid'] = $affId;
		
		$data = array(
			'firstname' => $_POST['bname'],
			'email' => $_POST['bmail'],
			'mobile' => $_POST['bmobile'],

	        'bname' => $_POST['bname'],
	        'address' => $_POST['address'],
	        'city' => $_POST['city'],
	        'state' => $_POST['state'],
	        'PIN' => $_POST['PIN'],
	        'country' => $_POST['country'],
	        'bmobile' => $_POST['bmobile'],
	        'bmail' => $_POST['bmail'],
	
	        'ship_name' => $_POST['ship_name'],
	        'shippingaddress' => $_POST['shippingaddress'],
	        'shipping_city' => $_POST['shipping_city'],
	        'shipping_state' => $_POST['shipping_state'],
	        'shipping_PIN' => $_POST['shipping_PIN'],
	        'shipping_country' => $_POST['shipping_country'],
	        'ship_mobile' => $_POST['ship_mobile'],
	        'ship_mail' => $_POST['ship_mail']
	
			);
			
			$cartcontent = $this->cart->contents();

			$abd_cartdata = array(
			'billing_name' => $_POST['bname'],
	        'billing_address' => $_POST['address'],
	        'billing_city' => $_POST['city'],
	        'billing_state' => $_POST['state'],
	        'billing_PIN' => $_POST['PIN'],
	        'billing_country' => $_POST['country'],
	        'billing_mobile' => $_POST['bmobile'],
	        'billing_mail' => $_POST['bmail'],	
	        'ship_name' => $_POST['ship_name'],
	        'shippingaddress' => $_POST['shippingaddress'],
	        'shipping_city' => $_POST['shipping_city'],
	        'shipping_state' => $_POST['shipping_state'],
	        'shipping_PIN' => $_POST['shipping_PIN'],
	        'shipping_country' => $_POST['shipping_country'],
	        'ship_mobile' => $_POST['ship_mobile'],
	        'ship_mail' => $_POST['ship_mail'],
	        'firstname' => $_POST['bname'],
	        'reff_disc' => $_POST['reffdisc'],
			'currency' => $_POST['currs'],
			'is_guest' => 'yes',
		    'cart_data' => serialize($cartcontent), 
			'affiliate_id' => $affId,
			'date_time' => date('d/m/Y h:i:s ', time()), 
			);

			$this->cart_model->addAbandonedCartData($abd_cartdata);
			
			//$user_id = $this->session->userdata("id");
			$gid = $this->login_model->AddGuestAccount($data);
			//print_r($gid);die;
			$data = $this->login_model->getGuestUserByID1($gid[0]);
			//print_r($data);die;
			$view['userdata'] =  $data[0];
			
			$view['cartData'] = $this->oCart->getcurrentcart(TRUE); 
		
			$view['shipdata_aus'] = $this->shipping_model->getShipping_aus();
	        $view['shipdata_usa'] = $this->shipping_model->getShipping_usa();
	        $view['shipdata_uk'] = $this->shipping_model->getShipping_uk();
	        $view['shipdata_eur'] = $this->shipping_model->getShipping_eur();
	        $view['shipdata_other'] = $this->shipping_model->getShipping_other();
	        $view['shipdata_india'] = $this->shipping_model->getShipping_india();
	        
	    $another = $this->shipping_model->GetCurrencyAud();
		$view['aud'] = $another[0]['curr_amount'];

		$another = $this->shipping_model->GetCurrencyUsd();
		$view['usd'] = $another[0]['curr_amount'];

		$another = $this->shipping_model->GetCurrencyGbp();
		$view['gbp'] = $another[0]['curr_amount'];

		$another = $this->shipping_model->GetCurrencyEuro();
		$view['euro'] = $another[0]['curr_amount'];

		$another = $this->shipping_model->GetCurrencyOther();
		$view['other'] = $another[0]['curr_amount'];
		
	//	$name = 'biaffiliate';
		
	//	delete_cookie($name);
		
		$this->load->view('final_checkout_view',$view);

		$this->loadFooter($this);
	}


}
?>