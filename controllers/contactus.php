<?php include("securearea.php"); ?>
<?php
class Contactus extends Securearea 
{ 
	function __construct()
	{		
		parent::__construct();
	}
	public function index()
	{
		$this->loadHeader($this,FALSE,"Contact Us");
		
		//load sidebar
		//$this->loadSidebar($this);
		
		$this->load->view("contactus_view");
		
			//load footer
		$this->loadFooter($this);
	}
	
	public function mailtoAdminOfContactus()
	{
	$data = $_POST;
	$formmail = $data["your-email"];
		
	require("/home/bisjez6o/public_html/phpmailtesting/PHPMailer_5.2.0/class.phpmailer.php");

		$mail = new PHPMailer();
		
		$mail->IsSMTP();                                      // set mailer to use SMTP
		$mail->Host = "localhost";  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = "admin@bisjexporters.com";  // SMTP username
		$mail->Password = "mQAe,TC!AQe~"; // SMTP password
		
		$mail->From = "admin@bisjexporters.com";
		$mail->FromName = "bisj exporters";
		$mail->AddAddress("info@bisjexporters.com");                  // name is optional
		
		$mail->WordWrap = 50;                                 // set word wrap to 50 characters
		   
		$mail->IsHTML(true);                                  // set email format to HTML
		
		$mail->Subject = "Contact us mail";
		$mail->Body    = "<b>Name:</b>".$data["your-name"]."<br><b>Email:</b>".$data["your-email"]."<br><b>Subject:</b>".$data["your-subject"]."<br><b>Message:</b>".$data["your-message"];
		$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
		
		if(!$mail->Send())
		{
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   exit;
		}
		
		$this->session->set_flashdata("alert",json_encode(array("type"=>"info","msg"=>"Your Mail has been send.")));
					redirect(base_url()."contactus");	
					}
}
?>