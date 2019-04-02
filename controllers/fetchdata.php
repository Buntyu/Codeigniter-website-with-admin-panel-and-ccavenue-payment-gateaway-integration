<?php include("securearea.php"); ?>
<?php
session_start();
class FetchData extends Securearea
{
	public $dff = array();
	public function getCountry()
{
    $dat = $this->input->post('country');

    $this->session->set_userdata('abcd',$dat);
    

}

public function getCountryHeader()
{
if(isset($_POST["country1"])){
  // $_SESSION['country1'] = $_POST["country1"];
	$con = $this->input->post('country1');
		$con2 = $this->input->post('country2');
		
	//echo $con;
   $this->session->set_userdata('sessiontest',$con);
      $this->session->set_userdata('sessioncon',$con2);
    
}
}

public function getPopupData(){
$d =  date("Y-m-d");
$popData = array(  
"name" => $this->input->post('name'),
"email" => $this->input->post('email'),
"contact" => $this->input->post('contact'),
"date" => $d
);
//print_r($popData);
$this->load->model('user_model');
$this->user_model->insertPopupData($popData);

$this->mailPopupData($popData);
$this->mailPopupUser($popData);
}

public function mailPopupData($popData)
	{
	require("/home/bisjez6o/public_html/phpmailtesting/PHPMailer_5.2.0/class.phpmailer.php");

		$mail = new PHPMailer();
		$mail->IsSMTP();                                      // set mailer to use SMTP
		$mail->Host = "localhost";  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = "admin@bisjexporters.com";  // SMTP username
		$mail->Password = "mQAe,TC!AQe~"; // SMTP password
		
		$mail->From = "admin@bisjexporters.com";
		$mail->FromName = "bisjexporters";
	//	$mail->AddAddress("gagandeep.uniyal24@gmail.com"); 
	//	$mail->AddAddress("uniyalas2017@gmail.com");
		$mail->AddAddress("naureenuniyalas@gmail.com");
		
		$mail->WordWrap = 50;                                 // set word wrap to 50 characters
		$mail->IsHTML(true);                                  // set email format to HTML
		
		$mail->Subject = "Popup Opt In mail";
		$mail->Body    = "There is a new entry in your BISJ exporters Popup Opt In. Details are:<br><br><b>Name: </b>".$popData["name"]."<br><b>Email: </b>".$popData["email"]."<br><b>Contact: </b>".$popData["contact"];
		$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
		
		$mail->Send();
	}
	
	public function mailPopupUser($popData)
	{
	//require("/home/bisjez6o/public_html/phpmailtesting/PHPMailer_5.2.0/class.phpmailer.php");

		$mail = new PHPMailer();
		$mail->IsSMTP();                                      // set mailer to use SMTP
		$mail->Host = "localhost";  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = "admin@bisjexporters.com";  // SMTP username
		$mail->Password = "mQAe,TC!AQe~"; // SMTP password
		
		$mail->From = "admin@bisjexporters.com";
		$mail->FromName = "bisjexporters";
		$mail->AddAddress($popData["email"]);
		$mail->AddAddress("naureenuniyalas@gmail.com");
		
		$mail->WordWrap = 50;                                 // set word wrap to 50 characters
		$mail->IsHTML(true);                                  // set email format to HTML
		
		$mail->Subject = "Code For 10% Discount";
		$mail->Body    = "Hi ".$popData['name'].",<br> Please type 'bamboo' while checking out under referral code to get 10% discount.<br><br>Thank You!";
		$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
		
		$mail->Send();
	}


} 
?>