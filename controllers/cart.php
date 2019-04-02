<?php include("securearea.php"); ?>
<?php
class Cart extends Securearea 
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Product_model");
		//$this->load->library('session');

	}
	
	public function addtocart($product_id = "",$quantity = "1",$is_ajax = 1)
	{
		
		if($product_id == "")redirect(base_url(),"refresh");
		if(is_array($product_id))
		{
			$where = "AND product_id IN ('".implode("','",$product_id)."')";			
		}
		else $where = "AND product_id = '".$product_id."'";
		$products = $this->product_model->getProduct("","",$where);
	
		$cProduct = array();
	
		$serial = $this->input->post('txt');

		foreach($products as $key=>$product)
		{
			$id = $product["product_id"];
			$qty = $quantity;
			/* if($product['discount_status'] != 0)$price = $product["discount_price"];
			else */
			$price = $product["product_price"];
			$name = $product["product_name"];
			$gstper = $product["gst_percent"];
			$gstamt = $product["gst_amount"];
			$prohsn = $product["product_hsn"];
			
			$ss = json_decode($product["variationsData"], TRUE);
			$jj = $ss[$serial];
			

			$cProduct[] = array
			(
               'id'      => $id,
               'qty'     => $qty,
               'price'   => $price,
               'name'    => $name,
               'gstpercent' => $gstper,
               'producthsn' => $prohsn,
              // 'gstamount' => $gstamt,
               'Vname' => $ss[$serial]['Vname'],
               'Vprice' => $ss[$serial]['Vprice'],
               'AUD_price' => $ss[$serial]['AUD_price'],
               'USD_price' => $ss[$serial]['USD_price'],
               'UK_price' => $ss[$serial]['UK_price'],
               'EURO_price' => $ss[$serial]['EURO_price'],
               'options' => $jj
            );	
		}	

		$this->cart->insert($cProduct);
		if($this->cart_id)
		{
			//print_r($this->cart->contents());
			$this->updatecarttodb($this->cart->contents());						
		}
		else
		{			
			$this->addcarttodb($this->cart->contents());
		}		
		if($is_ajax)
		{
			//print_r($cProduct);
			echo "success";

		}
		else
		{
			redirect(base_url(),"refresh");
		}		
	}


	
	public function getcurrentcart($getValues = FALSE)
	{	
		

	//echo $this->cart_id;die;
		if(intval($this->carttotalitems) == 0){if($getValues == TRUE){return "";}echo "";die;} //Kill it when there is no item in the cart
		//echo "calle";
		
		$cartprodids = $this->getCartProductIds();
		$Products = $this->getProductsData($cartprodids);
		$cartProducts = array();
		$totalprice = 0;	
		$rff_sts =  $this->userData['refferal_status'];
		
		//$discount = 0;
		
		$myVar = $this->session->userdata('discount_percent');
		
		foreach($this->Cart_model->getCartContents($this->cart_id) as $key=>$cartitems)	
		{
			$val = array();	
			$CountryCode = $this->session->userdata('sessiontest');		
			foreach($Products as $product)
			{
				if($cartitems["id"] == $product["product_id"])
				{
					if($CountryCode == "CAN")
					{
					$product["product_price"] = $cartitems["Vprice"];
					$product["gst_amount"] = 0;
					$product["gst_percent"] = 0;
					}
					elseif($CountryCode == "EUR")
					{
					$product["product_price"] = $cartitems["EURO_price"];
					$product["gst_amount"] = 0;
					$product["gst_percent"] = 0;
					}
					elseif($CountryCode == "AUS")
					{
					$product["product_price"] = $cartitems["AUD_price"];
					$product["gst_amount"] = 0;
					$product["gst_percent"] = 0;
					}
					elseif($CountryCode == "USA")
					{
					$product["product_price"] = $cartitems["USD_price"];
					$product["gst_amount"] = 0;
					$product["gst_percent"] = 0;
					}
					elseif($CountryCode == "OTHER")
					{
					$product["product_price"] = $cartitems["USD_price"];
					$product["gst_amount"] = 0;
					$product["gst_percent"] = 0;
					}
					elseif($CountryCode == "UK")
					{
					$product["product_price"] = $cartitems["UK_price"];
					$product["gst_amount"] = 0;
					$product["gst_percent"] = 0;
					}
					else
					{
					$product["product_price"] = $cartitems["Vprice"];
					}
					
					$val['product_id'] = $product["product_id"];
					$val['product_name'] = $product["product_name"];
					$val['gst_percent'] = $product["gst_percent"];
					$val['product_weight'] = $product["product_weight"];
					$product_weight += doubleval($product['product_weight'] * $cartitems["qty"]);
					$val['gst_amount'] = $product["gst_amount"];	
					$val['product_image'] = $product["product_image"];
				//	$val['discount_price'] = number_format($product["discount_price"]);
                   			$val['product_price'] = $product["product_price"];
				//	$val['discount_status'] = $product["discount_status"];
					$val['Vname'] = $cartitems["Vname"];
					$val['quantity'] = $cartitems["qty"];
					$quantity += $cartitems["qty"];
					$val['row_id'] = $key;					
					$val['totalprice'] = /*($product['discount_status'] == "1") ? number_format($product["discount_price"] * $cartitems["qty"] ) : */$product["product_price"] * $cartitems["qty"];
					$totalprice += $product['product_price'] * $cartitems["qty"];					
				//	$discount += ($product['discount_status'] == "1") ? doubleval(($product['product_price'] - $product["discount_price"]) * $cartitems["qty"]) : 0;
					$totgst += doubleval($product['gst_amount'] * $cartitems["qty"]*2);
					
                    $couponDisc = doubleval($totalprice)/100*($myVar);
                    $afficoo = $this->input->cookie("biaffiliate");

                    if($rff_sts == 'eligible' || $afficoo != "" )
                    {
                    $reffDisc = doubleval($totalprice)/100*10;
                	}
                	else {
                		$reffDisc = 0;
                	}
				}				
			}
			$cartProducts[] = $val;
		}
		$retArr = array
		(
			"status"=>"success",
			"productData"=>$cartProducts,
			"productCount"=>$quantity,
			"grosspriceCart"=>"Rs. ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc)),
			"grossprice"=>"Rs. ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc)-doubleval($reffDisc)+doubleval($ship_amt)),
			"grossprice2"=>doubleval($totalprice)-doubleval($couponDisc),
			"totalprice"=>"Rs. ".number_format($totalprice),
			"totalprice1"=>$totalprice,
		//	"totaldiscount"=>"Rs. ".number_format($discount),
			"totalgst"=>"Rs. ".number_format($totgst),
			"totalgst2"=>number_format($totgst),
			"prod_weight"=>$product_weight,
			"totalCoup" =>"Rs. ".number_format(doubleval($totalprice)/100*($myVar)),
			"reffDisc" =>"Rs. ".$totalprice/100*10,
			"reffDisc2" =>$totalprice/100*10,
			"grdtotal" =>$totalprice-$reffDisc,
			//"couponCode" =>"Rs. ".number_format(doubleval($totalprice)/100*10),
		);
		//print_r($retArr['couponCode']);

		$test = "Rs. ".number_format(doubleval($totalprice)/100*10);
		//echo $test;
		if($CountryCode == "CAN")
		{
               $retArr['grosspriceCart'] = "CA$ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc));
               $retArr['grossprice'] = "CA$ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc)-doubleval($reffDisc));
               $retArr['totalprice'] = "CA$ ".$totalprice;
               $retArr['totalgst'] = "CA$ ".number_format($totgst);
               $retArr['totalCoup'] = "CA$ ".number_format(doubleval($totalprice)/100*($myVar));
               $retArr['reffDisc'] = "CA$ ".round($totalprice/100*10,2);
               $retArr['grdtotal'] = "CA$ ".round($totalprice-$reffDisc,2);
		}
		elseif($CountryCode == "AUS")
		{
			$retArr['grosspriceCart'] = "AU$ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc));
			$retArr['grossprice'] = "AU$ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc)-doubleval($reffDisc));
			$retArr['totalprice'] = "AU$ ".$totalprice;
			$retArr['totalgst'] = "AU$ ".number_format($totgst);
			$retArr['totalCoup'] = "AU$ ".number_format(doubleval($totalprice)/100*($myVar));
			$retArr['reffDisc'] = "AU$ ".round($totalprice/100*10,2);
			$retArr['grdtotal'] = "AU$ ".round($totalprice-$reffDisc,2);
		}
		elseif($CountryCode == "USA")
		{
			$retArr['grosspriceCart'] = "US$ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc));
			$retArr['grossprice'] = "US$ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc)-doubleval($reffDisc));
			$retArr['totalprice'] = "US$ ".$totalprice;
			$retArr['totalgst'] = "US$ ".number_format($totgst);
			$retArr['totalCoup'] = "US$ ".number_format(doubleval($totalprice)/100*($myVar));
			$retArr['reffDisc'] = "US$ ".round($totalprice/100*10,2);
			$retArr['grdtotal'] = "US$ ".round($totalprice-$reffDisc,2);
		}
		elseif($CountryCode == "OTHER")
		{
			$retArr['grosspriceCart'] = "US$ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc));
			$retArr['grossprice'] = "US$ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc)-doubleval($reffDisc));
			$retArr['totalprice'] = "US$ ".$totalprice;
			$retArr['totalgst'] = "US$ ".number_format($totgst);
			$retArr['totalCoup'] = "US$ ".number_format(doubleval($totalprice)/100*($myVar));
			$retArr['reffDisc'] = "US$ ".round($totalprice/100*10,2);
			$retArr['grdtotal'] = "US$ ".round($totalprice-$reffDisc,2);
		}
		elseif($CountryCode == "UK")
		{
			$retArr['grosspriceCart'] = "£ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc));
			$retArr['grossprice'] = "£ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc)-doubleval($reffDisc));
			$retArr['totalprice'] = "£ ".$totalprice;
			$retArr['totalgst'] = "£ ".number_format($totgst);
			$retArr['totalCoup'] = "£ ".number_format(doubleval($totalprice)/100*($myVar));
			$retArr['reffDisc'] = "£ ".round($totalprice/100*10,2);
			$retArr['grdtotal'] = "£ ".round($totalprice-$reffDisc,2);
		}
		elseif($CountryCode == "EUR")
		{
			$retArr['grosspriceCart'] = "€ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc));
			$retArr['grossprice'] = "€ ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc)-doubleval($reffDisc));
			$retArr['totalprice'] = "€ ".$totalprice;
			$retArr['totalgst'] = "€ ".number_format($totgst);
			$retArr['totalCoup'] = "€ ".number_format(doubleval($totalprice)/100*($myVar));
			$retArr['reffDisc'] = "€ ".round($totalprice/100*10,2);
			$retArr['grdtotal'] = "€ ".round($totalprice-$reffDisc,2);
		}
		else
		{
			$retArr['grosspriceCart'] = "Rs. ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc));
			$retArr['grossprice'] = "Rs. ".number_format(doubleval($totalprice)+doubleval($totgst)-doubleval($couponDisc)-doubleval($reffDisc));
			$retArr['totalprice'] = "Rs. ".$totalprice;
			$retArr['totalgst'] = "Rs. ".number_format($totgst);
			$retArr['totalCoup'] = "Rs. ".number_format(doubleval($totalprice)/100*($myVar));
			$retArr['reffDisc'] = "Rs. ".round($totalprice/100*10,2);
			$retArr['grdtotal'] = "Rs. ".round($totalprice-$reffDisc,2);
		}

		if($getValues == TRUE)		
		{
			return $retArr;
		}
		else
		{
			echo json_encode($retArr);
		}
		//echo "<pre>";print_r($retArr);die;
	}
	


	public function removeCartItem($row_id)
	{
		$data = array(
               'rowid' => $row_id,
               'qty'   => 0
            );	
		$this->cart->update($data);		
		if($this->cart_id)
		{
			$this->updatecarttodb($this->cart->contents());
		} 
	}
	
	public function updateQuantity($row_id,$qty = "1",$getResp = FALSE)
	{
		$data = array(
               'rowid' => $row_id,
               'qty'   => $qty
            );
		$this->cart->update($data); 
		if($this->cart_id)
		{
			$this->updatecarttodb($this->cart->contents());
		}
		if($getResp)
		{
			$this->getcurrentcart();
		}
	}
	
	public function removeCart($redirect_url = "")
	{
		$this->cart->destroy();
		if($this->cart_id)
		{
			$this->updatecarttodb($this->cart_id,"");
		}
		if($redirect_url)redirect(base_url(),"refresh");
	}
	
	private function getProductsData($prod_ids)
	{
		$where = " AND product_id IN ('".implode("','",$prod_ids)."')";
		$products = $this->product_model->getProduct("","",$where);
		return $products;
	}
	
	private function getCartProductIds()
	{
		$id_array = array();
		foreach($this->cart->contents() as $cartitems)
		{
			$id_array[] = $cartitems["id"];
		}
		return $id_array;
	}
	
	private function addcarttodb($cartdata)
	{
		$cart_id = $this->Cart_model->addtoCart($cartdata);
		$cookie = array(
						    'name'   => 'cart_id',
						    'value'  => $cart_id,
						    'expire' => (365*60*60*24),
						    'domain' => '',
						    'path'   => '/',
						    'prefix' => '',
						    'secure' => FALSE
						);
		$this->input->set_cookie($cookie);
	}
	private function updatecarttodb($cartdata)
	{
		$this->Cart_model->updateCart($this->cart_id,$cartdata);		
	}


    
}
?>