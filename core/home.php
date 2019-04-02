<?php include("securearea.php"); ?>
<?php
class Home extends Securearea 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
	}
	public function index()
	{
		$this->viewHomePage();
	}
	
	public function viewHomePage()
	{
		$this->load->model("admin/Carousel_model");		
		
		//load header
		$this->loadHeader($this,FALSE);
					
		//load sidebar
		$this->loadSidebar($this);
		
		//load carousel
		$carousel["carouselData"] = $this->Carousel_model->getCarousel("",array("display_status"=>"1"));
		$this->load->view("includes/carousel_home",$carousel);
		
		//load middle content
		$view["latestproducts"] = $this->product_model->getLatestProducts("0","9","",TRUE);		
		$view["featuredproducts"] = $this->product_model->getFeaturedProducts("0","9","",TRUE);
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
	
	public function password()
	{
		$this->load->model("user_model");
		$this->load->helper('email');
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);		
		$data = $_POST;
		if(!valid_email($data["email"]))
		{
			$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"The Email addresss you provided is not valid.")));
			redirect($data['redirectlink']);
		}		
		$user = $this->user_model->getUserByEmail($data["email"]);
		$user = $user[0];
		if(isset($user))
		{
			$this->email->from('no-reply@plumsberry.com', 'Plumsberry.com');
			$this->email->to($data["email"]); 
//			$this->email->cc('another@another-example.com'); 
//			$this->email->bcc('them@their-example.com'); 

			$this->email->subject('Plumsberry.com : Your request for password');
			$this->email->message('
				<p>	
					<strong>
						Dear '.$user["firstname"].' '.$user["lastname"].',
					</strong>
				</p>	
				<p>	
					&nbsp;&nbsp;&nbsp;
					Your userid is <strong>'.$user["userid"].'</strong> 
				<br />
								
					your password is <strong>'.$user["userid"].'</strong>
					
				<br />
				
					Login to <strong><a href = "http://plumsberry.com">Plumsberry.com</a></strong>
				</p>
				<p style = "text-align:left">
					Yours Faithfully,<br />
					Plumsberry Team.					
				</p>
				<br /><br /><br /><br /><br />
				<i>Please do not reply to this email. This is an auto-generated email.</i>
			');

			$this->email->send();			
			$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"You password has been mailed at ".$data["email"])));
			redirect($data['redirectlink']);
		}
		else
		{
			$this->session->set_flashdata("alert",json_encode(array("type"=>"block","msg"=>"Your Email addresss is not registered with us. Please <a href = '".base_url()."/register'>Register</a>")));
			redirect($data['redirectlink']);
		}		
	}
	
	public function logout()
	{
		delete_cookie("ecomm_userData");
		$array_items = array('userdata' => '', 'password' => '');
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
}
?>