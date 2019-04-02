<?php
class SecureAccess extends CI_Controller
{
	protected $userData = "";
	protected $cur_date_time = "";
	public $dateTimeFormat = "d-m-Y H:i:s a";
	public $dateFormat = "d-m-Y";
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');			
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->helper('date');		
		$this->load->model("admin/secure_model");		
		$this->cur_date_time = date("Y-m-d H:i:s",gmt_to_local(time(),"UP45"));	//	echo $this->cur_date_time;die;
		$this->userData = $this->checkLogin();
	}	
	protected function checkLogin()
	{
		$userData = $this->checkconditions();		
		if($userData)
		{
			return $userData;
		}
		if(isset($this->isLogin) && $this->isLogin)
		{
			return FALSE;
		}
		$this->backtologin();
	}
	
	/**
	* This function contains any operation when login fails
	*/
	protected function backtologin()
	{
		$this->session->sess_destroy();
		redirect(base_url()."admin/login","refresh");
	}
	
	protected function checkconditions()
	{
		$getData = $this->input->cookie("ecomm_adminData");		
		if($getData)
		{
			$this->session->set_userdata(unserialize(base64_decode($getData)));
		}		
		if($this->session->userdata("username") || isset($_POST['username']))
		{
			$userData = (isset($_POST['username']))? $_POST : $this->session->userdata;
			$username = $userData['username'];
			$password = $userData['password'];
			$remember = isset($userData['remember'])?$userData['remember'] : "off";
			$checkDB = $this->secure_model->checklogindetails($username,$password);			
			
			if($checkDB != FALSE)
			{
				if(isset($_POST['username']))
				{
					$_POST["remember"] = $remember;
					//session expires after 30 days if remember me is selected 30 * 3600 = 108000
					if($remember == "off")$this->session->sess_expiration = "7200";					
					else 
					{ 
						$cookie = array(
						    'name'   => 'adminData',
						    'value'  => base64_encode(serialize(array_merge($checkDB[0],$_POST))),
						    'expire' => '108000',
						    'domain' => '',
						    'path'   => '/',
						    'prefix' => 'ecomm_',
						    'secure' => FALSE
						);
						$this->input->set_cookie($cookie);					
					}
					$this->session->set_userdata($checkDB[0]);
					$this->session->set_userdata($_POST);
				/*	$this->load->model("admin/usertype_model");
					$usertypes["user_types"] = $this->usertype_model->getadminUsers();
					$this->session->set_userdata($usertypes); */
				}
				$usertypes = $this->secure_model->checkusertype($this->uri->segment_array(),$checkDB);
			//	echo "<pre>";print_r($usertypes);die;
				if(!(empty($usertypes)))
				{
					$this->session->set_userdata($usertypes);
					$checkDB[] = $usertypes;
					return $checkDB;
				}
			}			
		}		
		return FALSE;
	}
	
// recursive fn, converts three digits per pass
function convertTri($num, $tri) {
  global $ones, $tens, $triplets;

  //print_r($triplets);die;

  // chunk the number, ...rxyy
  $r = (int) ($num / 1000);
  $x = ($num / 100) % 10;
  $y = $num % 100;
 
  // init the output string
  $str = "";
 
  // do hundreds
  if ($x > 0)
   $str = $ones[$x] . " hundred";
 
  // do ones and tens
  if ($y < 20)
   $str .= $ones[$y];
  else
   $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];
  // add triplet modifier only if there
  // is some output to be modified...
  if ($str != "")
   $str .= $triplets[$tri];
 
  // continue recursing?
  if ($r > 0)

   return $this->convertTri($r, $tri+1).$str;
  else
  	//echo $str;die;
   return $str;
 }
 
// returns the number as an anglicized string
public function convertNum($num) {
	
 $num = (int) $num;    // make sure it's an integer
// echo $num;die;
 
 if ($num < 0)
  return "negative".$this->convertTri(-$num, 0);
 
 if ($num == 0)
  return "zero";
 
 return $this->convertTri($num, 0);
}
 
 // Returns an integer in -10^9 .. 10^9
 // with log distribution
 function makeLogRand() {
  $sign = mt_rand(0,1)*2 - 1;
  $val = randThousand() * 1000000
   + randThousand() * 1000
   + randThousand();
  $scale = mt_rand(-9,0);
 
  return $sign * (int) ($val * pow(10.0, $scale));
 }	
		
}
?>