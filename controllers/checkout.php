<?php include("securearea.php"); ?>
<?php include("cart.php"); ?>
<?php
class Checkout extends Securearea 
{
	public $oCart;
	function __construct()
	{		
		parent::__construct();
		$this->load->helper("url");	
		$this->oCart = new Cart();	
		$this->load->library('session');
	}

	function index()
	{
		$this->viewCartDetails();
	}
	public function viewCartDetails()
	{

		$this->hidecartlist = TRUE;
		//load header
		$this->loadHeader($this);
		
		//load sidebar
		//$this->loadSidebar($this);
		
		//load middle content		
		$view['obj'] = $this;
		$view['cartData'] = $this->oCart->getcurrentcart(TRUE);

		$code = $this->input->post('coupon_box');
		//echo $code;
		$this->load->model("Cart_model");
		$heep = $this->Cart_model->getCode($code); 
		$dis_percent = $heep[0]['discount'];
		//echo $dis_percent;

		$this->session->set_userdata('discount_percent',$dis_percent);
		//if (!isset($_GET['r'])) { echo '<meta http-equiv="refresh" content= "0;URL=?r=1" />'; }

		$this->load->view('cart_view',$view);
		//print_r($view['cartData']);die;
		
		$this->loadFooter($this);
	}


/*	public function getPostValue() {
     $view['cartData'] = $this->oCart->getcurrentcart(TRUE);
     $view['postValue'] = $view['cartData']['couponCode'];
     print_r($view['postValue']);

     $this->load->view('cart_view',$view);

	}   */

	 function printCouponCode($data)
    {
    $this->db->select('discount');
    $this->db->from('_coupons');
    $this->db->where('coupon_code',$data);
    $query = $this->db->get();
    $result = $query->result_array(); 
   // echo "<pre>"; print_r($result[0]['discount']);die;
    $coup = $result[0]['discount'];
    return $coup;
    }
	
	function justatest($data)
	{
      $this->load->model("order_model");
      if($this->order_model->gettestingdata())
      {
      	return TRUE;
      }
      else
      {
      	return FALSE;
      }
	}

	public function removeItem($row_id)
	{
		$this->oCart->removeCartItem($row_id);	
		$this->oCart->getcurrentcart();
	//	redirect(base_url()."checkout","refresh");
	}

function couponCode() {
	
	$couponCode = $this->getCouponCode($_POST);
	if($this->oCart->printCouponCode($couponCode))
	{
		//echo "hello";
		$data = $this->oCart->printCouponCode($couponCode);
		
		//echo $data;
		//$this->load->view('cart_view', $data);
     }
	else {
		echo "sorry";
	}
	$this->RefreshCheckoutPage();
}

private function getCouponCode($postData)
{
    $couparray = array 
    (
    	"coupon" => $postData["coupon_box"],
    	);
    return $couparray;

}



private function RefreshCheckoutPage()
	{
		redirect(base_url()."checkout","refresh");

	}





      }
?>