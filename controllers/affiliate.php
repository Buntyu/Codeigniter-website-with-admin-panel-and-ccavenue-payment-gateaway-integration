<?php include("securearea.php"); ?>
<?php
class Affiliate extends Securearea 
{
	public $redirect = "";
	function __construct()
	{		
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("affiliate_model");
		if(isset($_GET['redirect'])){$this->redirect = $_GET['redirect'];}
		else $this->redirect = base_url();
	}
	
	public function index()
	{
		$this->viewRegistrationForm();
	}
	
	public function viewRegistrationForm($edit = FALSE,$user_id = "")
	{
		if($this->isloggedin && $edit == FALSE)
		{
			redirect($this->redirect,"refresh");
		}
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar($this);
		
			
		$view["obj"] = $this;
		$view["edit"]=$edit;
		$view["user_id"]=$user_id;
		$this->load->view('affiliate_form_view',$view);	
	
		//load footer
		$this->loadFooter($this);		
	}
	
	public function submitform()
	{		
		if(empty($_POST))redirect(base_url()."affiliate","refresh");
		$edit = TRUE;
		$chkunique = "";
		if(isset($_POST["is_new_customer"]) && $_POST["is_new_customer"] == "1")
		{
			$edit = FALSE;
			$chkunique = '|is_unique['.DBPREFIX.'_affiliate_user.email]';
		}			
		$this->load->library('form_validation');		
		$config = array(               
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required|trim|min_length[6]|matches[confpassword]'
                  ),
			  array(
                 'field'   => 'confpassword', 
                 'label'   => 'Confirm Password', 
                 'rules'   => 'required'
              ),
	         array(
	                 'field'   => 'first_name', 
	                 'label'   => 'First Name', 
	                 'rules'   => 'trim|required|xss_clean'
	              ),   
		/*	 array(
                     'field'   => 'last_name', 
                     'label'   => 'Last Name', 
                     'rules'   => 'trim|required|xss_clean'
                  ),  */
			array(
                     'field'   => 'phone', 
                     'label'   => 'Phone Number', 
                     'rules'   => 'trim|xss_clean'
                  ),
             array(
                     'field'   => 'email', 
                     'label'   => 'Email', 
                     'rules'   => 'trim|valid_email'.$chkunique
                  )
            );
			if($edit == FALSE)
			{
				$config[] = array(
			                     'field'   => 'username', 
			                     'label'   => 'Username', 
			                     'rules'   => 'required|trim|min_length[6]|max_length[12]|is_unique['.DBPREFIX.'_affiliate_user.user_id]'
			                  );
			}					
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{			
			$this->viewRegistrationForm($edit,(isset($_POST["affiliate_user_id"])?$_POST["affiliate_user_id"]:""));
			$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"<strong>Please Re-Check your Form.</strong>")));
		}
		else
		{
			if($edit)
			{
				if(isset($_POST["affiliate_user_id"]))
				{
					$updateData = $this->formatInsertData($_POST);					
					if($this->affiliate_model->updateUser($_POST["affiliate_user_id"],$updateData) == TRUE)
					{						
						$this->session->set_flashdata("alert",json_encode(array("type"=>"success","msg"=>"Affiliate Updated Successfully")));

						/*
						delete_cookie("ecomm_userData");
						$array_items = array('userdata' => '', 'password' => '');
						$this->session->unset_userdata($array_items);*/

						redirect(base_url()."affiliate/useredit/".$_POST["affiliate_user_id"]);
					}
				}

				redirect($this->redirect,"refresh");
			}
			else
			{
                
				$insertData = $this->formatInsertData($_POST,TRUE);
				if($this->affiliate_model->addNewUser($insertData))
				{
					//$insertCouponData = $this->formatInsertCouponData($_POST,TRUE);
                   // $this->affiliate_model->addNewCoupon($insertCouponData);
                   
					$this->checkuser();
					$this->mailtoAffiliate($insertData);
					
					$this->session->set_flashdata("alert",json_encode(array("type"=>"success","msg"=>"Affiliate Account Created Successfully")));
					
					
				}
				else
				{
					$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"Affiliate Account cannot be created")));
				}
				$this->redirect = base_url().'home/useraccount';
				redirect($this->redirect,"refresh");
			}
		}
		//echo "<pre>";print_r($_POST);die;
	}
	
	public function mailtoAffiliate($insertData)
	{
	
	$affiliateName = $insertData['first_name'];
	$affiliateEmail = $insertData['email'];
			
		require("/home/bisjez6o/public_html/phpmailtesting/PHPMailer_5.2.0/class.phpmailer.php");

				$mail = new PHPMailer();
				
				$mail->IsSMTP();                                      // set mailer to use SMTP
				$mail->Host = "localhost";  // specify main and backup server
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = "admin@bisjexporters.com";  // SMTP username
				$mail->Password = "mQAe,TC!AQe~"; // SMTP password
				
				$mail->From = "admin@bisjexporters.com";
				$mail->FromName = "Bisj Exporters";
				$mail->AddAddress($affiliateEmail);                  // name is optional
				
				$mail->WordWrap = 50;                                 // set word wrap to 50 characters
				   
				$mail->IsHTML(true);                                  // set email format to HTML
				
				$mail->Subject = "Welcome !";
				$mail->Body    = 'Hi '.$affiliateName.',<br> Congratulations! On being part of BISJ , We are happy to have you.Please Fill in your bank account details by log in to your account and enjoy all the benefits of being a BISJ Affiliate. You will get 20% share of the sales made by your customers. Cheers !!!   <br><br><br><br><br> For any queries you can mail us at info@bisjexporters.com<br> or contact us at Contact No: +91 7009272362, +91 7011993301 ';
				$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
				
			
			       $mail->Send();
					}
	
	public function useredit($user_id)
	{
		if(!$this->isloggedin || $this->userData["id"] != $user_id)
		{
			redirect($this->redirect,"refresh");
		}
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		$this->loadSidebar($this);
		
		//load middle content
		$view["areas"] = $this->areas;
		$view["formData"] = $this->affiliate_model->getUserByID($user_id);
		$view["formData"] = $view["formData"][0];
		if(!($view["formData"]))redirect($this->redirect,"refresh");		
		$view["obj"] = $this;
		$this->load->view('affiliate_form_view',$view);		
		
		//load footer
		$this->loadFooter($this);
	}
	
	public function checkUserID($user_id)
	{
		if($this->affiliate_model->checkUserId($user_id))
		{
			echo json_encode(array("status"=>"present","data"=>$user_id));
		}
		else
		{
			echo json_encode(array("status"=>"notpresent","data"=>$user_id));
		}
	}
	
	private function formatInsertData($postData,$insert = FALSE)
	{		
		$retData = array
		(			
			"Affi-Password"=>$postData["password"],
			"first_name"=>$postData["first_name"],
		//	"last_name"=>$postData["last_name"],
			"email"=>$postData["email"],
			"mobile_phone"=>$postData["mobile"],
			"aadhar_number"=>$postData["aadhar_number"],
			"pan_number"=>$postData["pan_number"],
		);
		if($insert == TRUE)
		{
			$retData["user_id"]=$postData["username"];
			
		}
		return $retData;
	}


    private function formatInsertCouponData($postData,$insert = FALSE)
	{		
		$retData = array
		(			
			
			"name"=>$postData["first_name"].' '.$postData["last_name"],
			//"last_name"=>$postData["last_name"],
			"discount" => "100",
			
		);
		if($insert == TRUE)
		{
			$retData["coupon_code"]=$postData["username"];
			
		}
		return $retData;
	}

	public function affiliate_account() {    
	$this->loadHeader($this);    
	//load sidebar  
	$this->loadSidebar1($this);    
	//load middle content  
	$affiliate_id = $this->session->userdata("affiliate_id");  
	//$user_id = $this->session->userdata("id");    
	$data["affiliate_account"] = $this->affiliate_model->getUserByID1($affiliate_id);     
	 $this->load->view('affiliate_edit_view',$data);      
	 //load footer  
	 $this->loadFooter($this); 
	}
	
	public function affiliate_myuser() {    
	$this->loadHeader($this);    
	//load sidebar  
	$this->loadSidebar1($this);    
	//load middle content  
	$affiliate_id = $this->session->userdata("affiliate_id");  
	//$user_id = $this->session->userdata("id");    
	$data["affiliate_myuser"] = $this->affiliate_model->getAffiMyuser($affiliate_id);     
	$this->load->view('affiliateMyuser_view',$data);      
	 //load footer  
	 $this->loadFooter($this); 
	}

	public function affiliate_account_edit() 
	{  
	if(!(empty($_POST)))  
	{  
	//load middle content  
	$postedData = $_POST;  
	$affiliate_id = $this->session->userdata("affiliate_id");  
	//print_r($postedData);     
	$this->affiliate_model->editaffiliateuser($postedData,$affiliate_id);  
	//$view["url"] = urldecode($_GET['redirectlink']);  
	//$this->load->view('affiliate_edit_view',$view);      
	// $this->affiliate_account();     
	redirect(base_url()."affiliate/affiliate_account");    
} 
}



}
?>