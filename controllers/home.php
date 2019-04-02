<?php include("securearea.php"); ?>
<?php
class Home extends Securearea 
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Order_model");
		$this->load->model("Vendors_model");
		$this->load->model("user_model");
		$this->load->model("admin/personnel_model");
		$this->load->library("session");
		$this->load->library("email");
		
		
	}
	public function index()
	{
		$this->viewHomePage();
		
	}
	
	public function viewHomePage()
	{
		//$this->load->model("admin/Carousel_model");		
		
		//load header
		$this->loadHeader($this,FALSE);
		//$this->load->view("home_loader");
					
		//load sidebar 
		//	 
//load carousel
		//$carousel["carouselData"] = $this->Carousel_model->getCarousel("",array("display_status"=>"1"));
		//$this->load->view("includes/carousel_home",$carousel);
		
		//load middle content
		//$this->loadSidebar($this);
		$view["latestproducts"] = $this->product_model->getLatestProducts("0","20","",TRUE);		
		$view["featuredproducts"] = $this->product_model->getFeaturedProducts("0","28","",TRUE); 
		$view["featuredCategory"] = $this->category_model->getSidebarData();
		
		$this->load->view('home_view',$view);
		
		//load footer
		$this->loadFooter($this);
	}
	
	public function login()
	{
		if($_POST['redirectlink'])
		{
			redirect(urldecode($_POST['redirectlink']));
		}
		else
		{
			redirect(base_url());
		}		
	}
	
	public function forgotpassword()
	{

		//load header
		$this->loadHeader($this,FALSE);
					
		//load sidebar
		$this->loadSidebar($this);
		
		$view["url"] = urldecode($_GET['redirectlink']);
		$this->load->view('forgotpassword_view',$view);
		
		//$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"You password has been mailed at")));
		//load footer
		$this->loadFooter($this);
		
	}
	public function mailtouser()
	{
	$data = $_POST;
	
	$this->load->model("user_model");
	$user = $this->user_model->getUserByEmail($data["email"]);
	$user = $user[0];
	$useridu = $user[id];
	$username = $user[userid];
	
	if(isset($user))
		{	
			
		require("/home/bisjez6o/public_html/phpmailtesting/PHPMailer_5.2.0/class.phpmailer.php");

				$mail = new PHPMailer();
				
				$mail->IsSMTP();                                      // set mailer to use SMTP
				$mail->Host = "localhost";  // specify main and backup server
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = "admin@bisjexporters.com";  // SMTP username
				$mail->Password = "mQAe,TC!AQe~"; // SMTP password
				
				$mail->From = "admin@bisjexporters.com";
				$mail->FromName = "bisj";
				$mail->AddAddress($data["email"]);                  // name is optional
				
				$mail->WordWrap = 50;                                 // set word wrap to 50 characters
				   
				$mail->IsHTML(true);                                  // set email format to HTML
				
				$mail->Subject = "Password Reset";
				$mail->Body    = 'To reset your password please click the link below and follow the instructions:'. site_url('home/resetpassword?userid='. $useridu.'&username='.$username).' If you did not request to reset your password then please just ignore this email and no changes will occur.  <br><br><br><br><br> For any queries you can mail us at info@bisjexporters.com<br> or contact us at Contact No: +91 7009272362, +91 7011993301';
				$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
				
				if(!$mail->Send())
				{
				   echo "Message could not be sent. <p>";
				   echo "Mailer Error: " . $mail->ErrorInfo;
				   exit;
				}
				$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"You password has been mailed at ".$data["email"])));
					redirect(base_url()."home/forgotpassword");
					}
					else
						{
							$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"Your Email addresss is not registered with us. Please Register First.")));
							redirect(base_url()."home/forgotpassword");
						}		
						
					}
					
	public function mailtoaffi()
	{
	$data = $_POST;
	
	$this->load->model("user_model");
	$user = $this->user_model->getAffiByEmail($data["email"]);
	$user = $user[0];
	$useridu = $user[affiliate_id];
	$username = $user[user_id];
	
	if(isset($user))
		{	
			
		require("/home/bisjez6o/public_html/phpmailtesting/PHPMailer_5.2.0/class.phpmailer.php");

				$mail = new PHPMailer();
				
				$mail->IsSMTP();                                      // set mailer to use SMTP
				$mail->Host = "localhost";  // specify main and backup server
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = "admin@bisjexporters.com";  // SMTP username
				$mail->Password = "mQAe,TC!AQe~"; // SMTP password
				
				$mail->From = "admin@bisjexporters.com";
				$mail->FromName = "bisj";
				$mail->AddAddress($data["email"]);                  // name is optional
				
				$mail->WordWrap = 50;                                 // set word wrap to 50 characters
				   
				$mail->IsHTML(true);                                  // set email format to HTML
				
				$mail->Subject = "Password Reset";
				$mail->Body    = 'To reset your password please click the link below and follow the instructions:'. site_url('home/resetpassword2?userid='. $useridu.'&username='.$username).' If you did not request to reset your password then please just ignore this email and no changes will occur.   <br><br><br><br><br> For any queries you can mail us at info@bisjexporters.com<br> or contact us at Contact No: +91 7009272362, +91 7011993301';
				$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
				
				if(!$mail->Send())
				{
				   echo "Message could not be sent. <p>";
				   echo "Mailer Error: " . $mail->ErrorInfo;
				   exit;
				}
				$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"You password has been mailed at ".$data["email"])));
					redirect(base_url()."home/forgotpassword");
					}
					else
						{
							$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"Your Email addresss is not registered with us. Please <a href = '".base_url()."/register'>Register</a> here.")));
							redirect(base_url()."home/forgotpassword");
						}		
						
	}
	
	
	public function resetpassword()
	{
	//load header
		$this->loadHeader($this,FALSE);
				
		//load sidebar
		$this->loadSidebar($this);
		$data['id'] = $_GET['userid'];
		$data['uname'] = $_GET['username'];
		
		$this->load->view(resetPassword_view,$data);
	
	$this->loadFooter($this);
	}
	public function resetpassword2()
	{
	//load header
		$this->loadHeader($this,FALSE);
				
		//load sidebar
		$this->loadSidebar($this);
		$data['id'] = $_GET['userid'];
		$data['uname'] = $_GET['username'];
		
		$this->load->view(resetPassword_view2,$data);
	
	$this->loadFooter($this);
	}
	
	public function getresetpass()
	{
	$id = $_POST['user_id'];
	$uname = $_POST['user_name'];
	$data['password'] = $_POST['conf_pass'];
	$this->user_model->updatePassword($id,$uname,$data);
	
	$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"Password Changed Successfully")));
			redirect(base_url()."home/resetpassword");
			
	}
	
	public function getresetpass2()
	{
	$id = $_POST['user_id'];
	$uname = $_POST['user_name'];
	$data['Affi-Password'] = $_POST['conf_pass'];
	$this->user_model->updatePassword2($id,$uname,$data);
	
	$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"Password Changed Successfully")));
			redirect(base_url()."home/resetpassword");
			
	}
	
	public function changepassword()
	{
		//load header
		$this->loadHeader($this,FALSE);
					
		//load sidebar
		$this->loadSidebar1($this);
		
		//$this->load->view('changepassword_view',$view);
		
		$view["url"] = urldecode($_GET['redirectlink']);
		$view["old_pass"]=$old_pass;
		$this->load->view('changepassword_view',$view);
		
		//$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"You password has been mailed at")));
		//load footer
		$this->loadFooter($this);
		
	}
	
	public function changepassword2()
	{
		//load header
		$this->loadHeader($this,FALSE);
					
		//load sidebar
		$this->loadSidebar1($this);
		
		//$this->load->view('changepassword_view2',$view);
		
		$view["url"] = urldecode($_GET['redirectlink']);
		$view["old_pass"]=$old_pass;
		$this->load->view('changepassword_view2',$view);
		
		//$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"You password has been mailed at")));
		//load footer
		$this->loadFooter($this);
		
	}
	
	public function newpassword()
	{
		//load header
		$this->loadHeader($this,FALSE);
					
		//load sidebar
		$this->loadSidebar1($this);
		
		$this->load->view('newpassword_view',$view);
		
          
		$view["url"] = urldecode($_GET['redirectlink']);
		$view["old_pass"]=$old_pass;
		$this->load->view('changepassword_view',$view);
		
		//$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"You password has been mailed at")));
		//load footer
		$this->loadFooter($this);
		
	}
		
	
	public function passwordNew()
	{
	
         $email = $this->input->post('email'); 
         //echo $email;die;
         $findemail = $this->user_model->ForgotPassword($email);  
        // print_r($findemail);die; 
         if($findemail){
          $this->user_model->sendpassword($findemail);        
           }else{
          $this->session->set_flashdata('msg',' Email not found!');
          redirect(base_url().'home/forgotpassword1','refresh');
     		}
   
	}
	
	public function useraccount()
	{
		//load header
		$this->loadHeader($this,FALSE);
					
		//load sidebar
		$this->loadSidebar1($this);
		
		$view["url"] = urldecode($_GET['redirectlink']);
		$this->load->view('account_view',$view);
		
		//$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"You password has been mailed at")));
		//load footer
		$this->loadFooter($this);
		
	}
	public function order()
	{
		//load header
		$this->loadHeader($this,FALSE);
					
		//load sidebar
		$this->loadSidebar1($this);
		$user_id = $this->session->userdata("affiliate_id");
		
		$data["orders"] = $this->Order_model->getOrders($user_id);
		$data["paymentData"] = $this->personnel_model->getAffiPayments($user_id);
		
		
		//print_r($data);
		//die();
		$this->load->view('pendingorders_view',$data);
		
		//$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"You password has been mailed at")));
		//load footer
		$this->loadFooter($this);
		
	}
	public function UserOrder()
	{
		//load header
		$this->loadHeader($this,FALSE);
					
		//load sidebar
		$this->loadSidebar1($this);
		$user_id = $this->session->userdata("id");
		$cust_orders= $this->Order_model->getOrders1($user_id);
		$total = count($cust_orders);
		
		for($i=0;$i<$total;$i++)
		{
		//$cust_orders= $cust_orders[$i];
		$cust_orders[$i]['cart_data'] = $this->arrangeCartData($cust_orders[$i]['cart_data']);
		$data["cust_orders"] = $cust_orders[$i];
		//echo "<pre>";print_r($cust_orders);
		}
		//echo "<pre>";print_r($cust_orders);die;
		$data["cust_orders"] = $cust_orders;
		$this->load->view('pendingorders_view',$data);
		
		$this->loadFooter($this);
		
	}
	public function UserOrder1( $order_id = NULL)
	{
		
		//load header
		$this->loadHeader($this,FALSE);
					
		//load sidebar
		$this->loadSidebar1($this);
		$detail= $this->Order_model->getOrders2($order_id);
		$detail= $detail[0];
		
		$detail['cart_data'] = $this->arrangeCartData($detail['cart_data']);
		//print_r($detail['cart_data']);die;
		$data["detail"] = $detail;
		//$data["detail"] = $this->Order_model->getOrders2($order_id);
		$this->load->view('pendingorders_view',$data);
		
		//load footer
		$this->loadFooter($this);
		
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
	public function logout()
	{
		delete_cookie("ecomm_userData");
		$array_items = array('userdata' => '', 'password' => '', 'affiliate_id' => '', 'id' => '', 'Affi-Password' => '');
		$this->session->unset_userdata($array_items);
		if($_GET['redirectlink'])
			{
				redirect($_GET['redirectlink'],"refresh");
			}
			else
			{
				redirect(base_url(),"refresh");
			}
	}
	
	public function checkOldPassword($old_pass)
	{
		if($this->user_model->checkOldPass($old_pass))
		{
			echo json_encode(array("status"=>"present","data"=>$old_pass));
		}
		else
		{
			echo json_encode(array("status"=>"notpresent","data"=>$old_pass));
		}
	}  
	public function checkOldPassword2($old_pass)
	{
		if($this->user_model->checkOldPass2($old_pass))
		{
			echo json_encode(array("status"=>"present","data"=>$old_pass));
		}
		else
		{
			echo json_encode(array("status"=>"notpresent","data"=>$old_pass));
		}
	}  

	public function saveNewPassword()
	{ 
		if(!(empty($_POST)))
		{
		//load middle content
		$postedData['password'] = $_POST['new_pass'];
		$user_id = $this->session->userdata("id");
	
		$this->user_model->EditUserPassword($postedData,$user_id);
			
		$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"Your Password is Changed Successfully")));
	   redirect(base_url()."home/changepassword");

		
		}
	}
	
	public function saveNewPassword2()
	{ 
		if(!(empty($_POST)))
		{
		//load middle content
		$postedData['Affi-Password'] = $_POST['new_pass'];
		$user_id = $this->session->userdata("affiliate_id");
		
		$this->user_model->EditUserPassword2($postedData,$user_id);
			
		$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"Your Password is Changed Successfully")));
	   redirect(base_url()."home/changepassword2");

		
		}
	}
	
	
}
?>