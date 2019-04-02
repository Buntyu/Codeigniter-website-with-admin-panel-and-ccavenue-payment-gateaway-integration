<?php
class Cart_model extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	} 
	
	function getLastcartid()
	{
		$sql = "SELECT MAX(  `cart_id` ) as max
				FROM  `".DBPREFIX."_tmpcart`";
		$result = $this->db->query($sql);
		if($result && $result->num_rows())
		{
			$retdata = $result->result_array();				
			return intval($retdata[0]["max"]) + 1;
		}
		return 1;
	}
	
	function checkcartid($cart_id = "")
	{
		$this->db->where("cart_id",$cart_id);
		$result = $this->db->get(DBPREFIX."_tmpcart");
		if($result && $result->num_rows())
		{
			return true;		
		}
		return false;
	}
	
	function addtoCart($cartData)
	{
		$cartData = array("cart_data"=>serialize($cartData));
		$this->db->insert(DBPREFIX."_tmpcart",$cartData);			
		return $this->db->insert_id();
	}
	
	function updateCart($cart_id,$cartData)
	{
		if($cart_id == "")return;
		if($cartData != "")
		{
			$cartData = serialize($cartData);
		}
		$updateData = array("cart_data"=>$cartData);
		$this->db->where("cart_id",$cart_id);		
		$this->db->update(DBPREFIX."_tmpcart",$updateData);						
	}
	function getCartContents($cart_id)
	{
		$this->db->where("cart_id",$cart_id);
		$result = $this->db->get(DBPREFIX."_tmpcart");
		if($result && $result->num_rows())
		{
			$retdata = $result->result_array();		
		//	echo "<pre>";print_r($retdata);die;							
			if($retdata[0]['cart_data'] != "1" && $retdata[0]['cart_data'] != "")
			{
				return @unserialize($retdata[0]["cart_data"]);
			}			
		}
		return "";
	}

   function do_something($data=array())
    {
        print_r($data);
    }

    function getCode($data) {
    	//echo $data;
    //	$where = "coupon_code"== $data;
    //	$this->db->select('discount');
    //	$this->db->from('_coupons');
    //	$this->db->where('coupon_code',$data);
    //    $query = $this->db->get();
    //     echo $query;				

         $sql = "SELECT discount FROM ".DBPREFIX."_coupons 
				WHERE coupon_code = '".$data."'				
				";
		$result = $this->db->query($sql);
		if($result && $result->num_rows()>0)
		{
			return $result->result_array();
			//echo "congo";
		}
        else
        {
        	//echo "try again";
        }


    }
    
    public function getImageIndia() {
    	$query = $this->db->select('carousel_image')
    	                  ->from('_carousel')
    	                  ->like('carousel_caption','india','after')
    	                  ->get();
    	$result = $query->result_array();
    	return $result;
    }

    public function getImageUsa() {
    	$query = $this->db->select('carousel_image')
    	                  ->from('_carousel')
    	                  ->like('carousel_caption','usa','after')
    	                  ->get();
    	$result = $query->result_array();
    	return $result;
    }

    public function getImageUk() {
    	$query = $this->db->select('carousel_image')
    	                  ->from('_carousel')
    	                  ->like('carousel_caption','uk','after')
    	                  ->get();
    	$result = $query->result_array();
    	return $result;
    }

    public function getImageEurope() {
    	$query = $this->db->select('carousel_image')
    	                  ->from('_carousel')
    	                  ->like('carousel_caption','europe','after')
    	                  ->get();
    	$result = $query->result_array();
    	return $result;
    }

    public function getImageAus() {
    	$query = $this->db->select('carousel_image')
    	                  ->from('_carousel')
    	                  ->like('carousel_caption','australia','after')
    	                  ->get();
    	$result = $query->result_array();
    	return $result;
    }
    public function getImageRest() {
    	$query = $this->db->select('carousel_image')
    	                  ->from('_carousel')
    	                  ->like('carousel_caption','rest','after')
    	                  ->get();
    	$result = $query->result_array();
    	return $result;
    }

    public function getImageBulk() {
    	$query = $this->db->select('carousel_image')
    	                  ->from('_carousel')
    	                  ->like('carousel_caption','bulk','after')
    	                  ->get();
    	$result = $query->result_array();
    	return $result;
    }

    public function getImageCourier() {
    	$query = $this->db->select('carousel_image')
    	                  ->from('_carousel')
    	                  ->like('carousel_caption','courier','after')
    	                  ->get();
    	$result = $query->result_array();
    	return $result;
    }
    
    function addAbandonedCartData($post){
    $this->db->insert(DBPREFIX."_abandoned_cart",$post);
    }

    function getAbandonedCart(){
    $this->db->select('*');
    $this->db->from("_abandoned_cart");
    $this->db->order_by("abd_cartID","DESC");
    $query = $this->db->get();
    return $query->result_array();
    }

}
?>