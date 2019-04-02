<?php include("securearea.php");

class Broucher extends Securearea
{
     function __construct()
     {
     	parent::__construct();
     	$this->load->helper('pdf_helper');
     }

public function index()
{
	 
	$this->loadHeader($this,FALSE,"Download Broucher");
		$this->loadSidebar1($this);
		$mmm = $this->userData;
		$uname =  $mmm['user_id'];
		$this->load->view("down_broucher_view");
		
			//load footer
		$this->loadFooter($this);
}

public function pdf()
{
	$mmm = $this->userData;
	$uname =  $mmm['user_id'];
	$image1 = base_url().'images/ban8.png';
	//echo $image1;die;
	//echo $uname;die;

	tcpdf();
$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
/*$title = "Broucher";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER); */

$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFont('helvetica', '', 14);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetMargins(0, 0, 0);
$obj_pdf->SetAutoPageBreak(TRUE, 0);
$obj_pdf->AddPage();

ob_start();

    // we can have any view part here like HTML, PHP etc
  //  $content = "<h1>Use Your Code ".$uname." To avail affiliates benefits</h1>";
$content = '<span color="#FFFFFF">Refferal Code : '.$uname.'</span>';
$content2 = '<span color="#FFFFFF">Refferal Code : '.$uname.'</span>';


ob_end_clean();

/*$obj_pdf->Image('images/ban8.png', $x, $y, $w, $h, 'PNG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)*/

$obj_pdf->Image('images/A4Sheetnew.jpg', '', '', '', '', 'JPG', '', '', false, 150, '', false, false, 1, false, false, true);

/* writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='') */
/* writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true) */

//$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->writeHTMLCell('','',56,67,$content,'0','0','0',true,'');
$obj_pdf->writeHTMLCell('','',202,68.5,$content2,'0','0','0',true,'');
$obj_pdf->writeHTMLCell('','',60,100,$content3,'0','0','0',true,'');
/*$obj_pdf->SetTextColor(100, 0, 0, 0);
$obj_pdf->Text(15, 90, $content); */


$obj_pdf->Output('broucher.pdf', 'I');
}

public function pdf2()
{
	tcpdf();
$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
/*$title = "Broucher";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER); */
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFont('helvetica', '', 12);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetMargins(0, 0, 0);
$obj_pdf->SetAutoPageBreak(TRUE, 0);
$obj_pdf->AddPage();


ob_start();

ob_end_clean();

$obj_pdf->Image('images/A4broucher2.jpg', '', '', '', '', 'JPG', '', '', false, 150, '', false, false, 1, false, false, true);

$obj_pdf->Output('broucher.pdf', 'I');
}

}
 ?>