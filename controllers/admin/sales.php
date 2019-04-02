<?php include("secureaccess.php"); ?>
<?php
class Sales extends SecureAccess 
{
	function __construct()
	{
		parent::__construct();	
		$this->load->library("customtable_lib");
		$this->load->library('excel');
		$this->load->library('session');
		$this->load->model("cart_model");
		$this->load->model("admin/Order_model");
		$this->load->model("admin/Vendors_model");
		$this->load->model("admin/areas_model");
		$this->load->model("admin/currency_model");
		$this->load->model("admin/sales_model");
		$this->load->model("affiliate_model");
	}
	public function index()
	{
		$this->PendingOrders();
	}
	
	public function PendingOrders()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$orderData = $this->Order_model->getOrders();
	        $total = count($orderData);
	 
		$orderData = $this->arrangeData($orderData);
		$headings = array
		( 
			"order_id" => "Order No",
			"order_uid" => "Order ID",
			"shipping_name"=>"Customer Name",
			"cart_table"=>"Cart Contents",	
			"payment_type" => "Payment Type",
		    "aff_namee" => "Affiliate",
			//"bin_country"=>"Country",
			"date_time"=>"Order Date",
			
		);
		$label = "Pending Orders";
		$action = array
		(
			"btns"=>array("tick","delete"),
			"text"=>array("Approve","Delete"),
			"dbcols"=>array("order_id","order_id"),
			"link"=>array(base_url()."admin/sales/finalizeorder/%@$%",base_url()."admin/sales/delorder/%@$%"),
			"clickable"=>array("","#deletemodal")
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$orderData,"",$action);
		$tableData["descFirst"] = TRUE;
		$this->load->view('helpers/members_table_view',$tableData);		
		$this->load->view('admin/pendingorders_view');			
		$this->load->view("admin/includes/admin_footer");
	}
	
	public function AllOrders()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$orderData = $this->Order_model->getOrdersAll();
		$orderData = $this->arrangeData($orderData);
		//echo "<pre>";print_r($orderData);die;
		$headings = array
		( 
			"order_id" => "Order No",
			"order_uid" => "Order ID",
			"shipping_name"=>"Customer Name",
			"cart_table"=>"Cart Contents",
			"payment_type" => "Payment Type",
			"aff_namee" => "Affiliate",
			//"bin_country"=>"Country",
			
			"date_time"=>"Recieving Date",
			
		);
		$label = "All Orders";
		$action = array
		(
			"btns"=>array("tick"),
			"text"=>array("View Order"),
			"dbcols"=>array("order_id"),
			"link"=>array(base_url()."admin/sales/finalorders/%@$%"),
			"clickable"=>array("","")
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$orderData,"",$action);
		$tableData["descFirst"] = TRUE;
		$this->load->view('helpers/members_table_view',$tableData);		
		$this->load->view('admin/allorders_view');			
		$this->load->view("admin/includes/admin_footer");
	}
	
	public function abandoned_orders()
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$orderData = $this->cart_model->getAbandonedCart();
		//echo "<pre>";print_r($orderData);die;
	    $total = count($orderData);
		$orderData = $this->arrangeAbdData($orderData);
		//echo "<pre>";print_r($orderData);die;
		$headings = array
		(
		    "abd_cartID"=> "ID",
			"date_time"=>"Order Date",
			"billing_name"=>"Customer Name",
			"contact_details" =>"Contact Details",
			"cart_table"=>"Cart Contents",
		//	"is_guest" => "Guest",	
			"address" =>"Address",	
		);
		$label = "Abandoned Orders";
		$action = array
		(
			"btns"=>array("delete"),
			"text"=>array("Delete"),
			"dbcols"=>array("abd_cartID"),
			"link"=>array(base_url()."admin/sales/delAbdorder/%@$%"),
			"clickable"=>array("#deletemodal")
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$orderData,"",$action);
		$tableData["descFirst"] = TRUE;
		$this->load->view('helpers/members_table_view',$tableData);		
		$this->load->view('admin/abandonedorder_view');			
		$this->load->view("admin/includes/admin_footer");
	}
	
	public function delorder($order_id)
	{
		echo json_encode(array("status"=>"success","data"=>$order_id));
	}
	
	public function delAbdorder($abd_cartID)
	{
		echo json_encode(array("status"=>"success","data"=>$abd_cartID));
	}

	public function deleteorder()
	{
		$order_id = $this->input->get('id');
		$this->Order_model->deleteOrder($order_id);
		$this->session->set_flashdata("info", "Order deleted successfully.");				
		$this->RefreshOrderPage();	
	}
	
	public function deleteAbdorder()
	{
		$abd_cartID = $this->input->get('id');
		$this->Order_model->deleteAbdOrder($abd_cartID);
		$this->session->set_flashdata("info", "Abandoned Order deleted successfully.");
		$this->RefreshAbdOrderPage();	
	}

	private function RefreshOrderPage($url="")
	{
		if($url){redirect($url,"refresh");}
		else{redirect(base_url()."admin/sales/pendingOrders","refresh");}		
	}
	
	private function RefreshAbdOrderPage($url="")
	{
		if($url){redirect($url,"refresh");}
		else{redirect(base_url()."admin/sales/abandoned_orders","refresh");}		
	}
	
	public function finalizeorder($order_id = "")
	{
		if(!$order_id)redirect(base_url()."admin/sales/pendingOrders","refresh");
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$this->load->model("product_model");
		$this->load->model("admin/user_model");
		$this->load->model("admin/vendors_model");
		$orderData = $this->Order_model->getOrders($order_id);
		$orderData = $orderData[0];
		$orderData['cart_data'] = $this->arrangeCartData($orderData['cart_data']);
		//echo "<pre>";print_r($orderData['cart_data']);die;
		$affiid = $orderData['affiliate_id'];
	    $fff = $this->sales_model->getAffiliateName($affiid);
	    //print_r($fff);die;
	    $pass['affname'] = $fff[0]['user_id'];
		$pass["orderData"] = $orderData;
		$pass["areas"] = $this->areas_model->getAreas("","area_name,area_pin");
		$pass["deliveryusers"] = $this->user_model->getuserbytype("delivery");
		$pass["vendors"] = $this->vendors_model->getVendors();
		$pass["product_list"]=$this->product_model->getProductData("",""," product_name ");
		$pass["currency_list"] = $this->currency_model->getallcurrency();
		$this->load->view('admin/finalizeorders_view',$pass);			
		$this->load->view("admin/includes/admin_footer");
		//echo "<pre>";print_r($orderData);die;
	}
	
	public function finalorders($order_id = "")
	{
		if(!$order_id)redirect(base_url()."admin/sales/pendingOrders","refresh");
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$this->load->model("product_model");
		$this->load->model("admin/user_model");
		$this->load->model("admin/vendors_model");
		$orderData = $this->Order_model->getOrdersAll($order_id);
		$mod_date = $this->Order_model->getCcDate($order_id);
		$orderData = $orderData[0];
		$orderData['cart_data'] = $this->arrangeCartData($orderData['cart_data']);
		//print_r($orderData);die;
		$affiid = $orderData['affiliate_id'];
	    $fff = $this->sales_model->getAffiliateName($affiid); 
	    $pass['affname'] = $fff[0]['user_id'];
	    
		$pass["orderData"] = $orderData;
		$pass["ccDate"] = $mod_date[0]['ccavenue_date'];
		$pass["areas"] = $this->areas_model->getAreas("","area_name,area_pin");
		$pass["deliveryusers"] = $this->user_model->getuserbytype("delivery");
		$pass["vendors"] = $this->vendors_model->getVendors();
		$pass["product_list"]=$this->product_model->getProductData("",""," product_name ");
		$this->load->view('admin/finalorders_view',$pass);			
		$this->load->view("admin/includes/admin_footer");
		//echo "<pre>";print_r($orderData);die;
	}
	
	
	
	private function arrangeData($orderData)
	{
		$retVal = array();
		if(!$orderData){return "";}		
	//	echo "<pre>";print_r($vendors);die;	
		$vendors = $this->Vendors_model->getVendors();	
		foreach($orderData as $order)
		{	
		    $curr = $order["currency"];
		    $manual = $order["is_manual"];
				
			$retVal[$order['order_id']] = $order;
			$retVal[$order['order_id']]['customer_name'] = $order['firstname']." ".$order['lastname'];
			$cartData = unserialize($order['cart_data']);
			//print_r($cartData);die;
			if($cartData)
			{
				$total = 0;
				$strTable =  "<table class = 'table table-bordered'>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Rate</th>
					<th>Total Price</th>
				";
				$total_wo = 0;
				foreach($cartData as $products)
				{
					if($manual == 'yes' && $curr == 'INR')
						{
						$price = 'Rs.&nbsp'.$products["price"];
						$subtotal = 'Rs.&nbsp'.$products["price"]*$products["qty"];
						$subtotal_wo = $products["price"]*$products["qty"];
						$total_wo += $subtotal_wo;
						$total = 'Rs.&nbsp'.$total_wo;
						$tax = 'Rs.&nbsp'.$order["total_tax"];
						$reff = 'Rs.&nbsp'.$order["reff_discount"];
						$ship = 'Rs.&nbsp'.$order["total_shipping"];
						//$finalprice = 'Rs.&nbsp'.$order["total_price"];
						$finalprice = 'Rs.&nbsp'.($total_wo+$order["total_shipping"]-$order["reff_discount"]);
					    }
					    elseif($manual == 'yes' && $curr == 'AUD') 
					    {
					    	$price = 'AU&nbsp$'.$products["price"];
					    	$subtotal = 'AU&nbsp$'.$products["price"]*$products["qty"];
					    	$subtotal_wo = $products["price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = 'AU&nbsp$'.$total_wo;
					    	$tax = 'AU&nbsp$'.$order["total_tax"];
					    	$reff = 'AU&nbsp$'.$order["reff_discount"];
					    	$ship = 'AU&nbsp$'.$order["total_shipping"];
					    	$finalprice = 'AU&nbsp$'.($subtotal_wo+$order["total_shipping"]-$order["reff_discount"]);
					    }
					    elseif($manual == 'yes' && $curr == 'USD') 
					    {
					    	$price = 'US&nbsp$'.$products["price"];
					    	$subtotal = 'US&nbsp$'.$products["price"]*$products["qty"];
					    	$subtotal_wo = $products["price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = 'US&nbsp$'.$total_wo;
					    	$tax = 'US&nbsp$'.$order["total_tax"];
					    	$reff = 'US&nbsp$'.$order["reff_discount"];
					    	$ship = 'US&nbsp$'.$order["total_shipping"];
					    	$finalprice = 'US&nbsp$'.($subtotal_wo+$order["total_shipping"]-$order["reff_discount"]);
					    }
					    elseif($manual == 'yes' && $curr == 'GBP') 
					    {
					    	$price = '&pound;'.$products["price"];
					    	$subtotal = '&pound;'.$products["price"]*$products["qty"];
					    	$subtotal_wo = $products["price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = '&pound;'.$total_wo;
					    	$tax = '&pound;'.$order["total_tax"];
					    	$reff = '&pound;'.$order["reff_discount"];
					    	$ship = '&pound;'.$order["total_shipping"];
					    	$finalprice = '&pound;'.($subtotal_wo+$order["total_shipping"]-$order["reff_discount"]);
					    }
					    elseif($manual == 'yes' && $curr == 'EUR') 
					    {
					    	$price = '&euro;'.$products["price"];
					    	$subtotal = '&euro;'.$products["price"]*$products["qty"];
					    	$subtotal_wo = $products["price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = '&euro;'.$total_wo;
					    	$tax = '&euro;'.$order["total_tax"];
					    	$reff = '&euro;'.$order["reff_discount"];
					    	$ship = '&euro;'.$order["total_shipping"];
					    	$finalprice = '&euro;'.($subtotal_wo+$order["total_shipping"]-$order["reff_discount"]);
					    }

					else{   
					if($curr == 'INR')
						{
						$price = 'Rs.&nbsp'.$products["Vprice"];
						$subtotal = 'Rs.&nbsp'.$products["Vprice"]*$products["qty"];
						$subtotal_wo = $products["Vprice"]*$products["qty"];
						$total_wo += $subtotal_wo;
						$total = 'Rs.&nbsp'.$total_wo;
						$tax = 'Rs.&nbsp'.$order["total_tax"];
						$reff = 'Rs.&nbsp'.$order["reff_discount"];
						$ship = 'Rs.&nbsp'.$order["total_shipping"];
						$finalprice = 'Rs.&nbsp'.$order["total_price"];
					    }
					    elseif($curr == 'AUD') 
					    {
					    	$price = 'AU&nbsp$'.$products["AUD_price"];
					    	$subtotal = 'AU&nbsp$'.$products["AUD_price"]*$products["qty"];
					    	$subtotal_wo = $products["AUD_price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = 'AU&nbsp$'.$total_wo;
					    	$tax = 'AU&nbsp$'.$order["total_tax"];
					    	$reff = 'AU&nbsp$'.$order["reff_discount"];
					    	$ship = 'AU&nbsp$'.$order["total_shipping"];
					    	$finalprice = 'AU&nbsp$'.$order["total_price"];
					    }
					    elseif($curr == 'USD') 
					    {
					    	$price = 'US&nbsp$'.$products["USD_price"];
					    	$subtotal = 'US&nbsp$'.$products["USD_price"]*$products["qty"];
					    	$subtotal_wo = $products["USD_price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = 'US&nbsp$'.$total_wo;
					    	$tax = 'US&nbsp$'.$order["total_tax"];
					    	$reff = 'US&nbsp$'.$order["reff_discount"];
					    	$ship = 'US&nbsp$'.$order["total_shipping"];
					    	$finalprice = 'US&nbsp$'.$order["total_price"];
					    }
					    elseif($curr == 'GBP') 
					    {
					    	$price = '&pound;'.$products["UK_price"];
					    	$subtotal = '&pound;'.$products["UK_price"]*$products["qty"];
					    	$subtotal_wo = $products["UK_price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = '&pound;'.$total_wo;
					    	$tax = '&pound;'.$order["total_tax"];
					    	$reff = '&pound;'.$order["reff_discount"];
					    	$ship = '&pound;'.$order["total_shipping"];
					    	$finalprice = '&pound;'.$order["total_price"];
					    }
					    elseif($curr == 'EUR') 
					    {
					    	$price = '&euro;'.$products["EURO_price"];
					    	$subtotal = '&euro;'.$products["EURO_price"]*$products["qty"];
					    	$subtotal_wo = $products["EURO_price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = '&euro;'.$total_wo;
					    	$tax = '&euro;'.$order["total_tax"];
					    	$reff = '&euro;'.$order["reff_discount"];
					    	$ship = '&euro;'.$order["total_shipping"];
					    	$finalprice = '&euro;'.$order["total_price"];
					    }
					}
					    
					
					$strTable .= "<tr>
						<td>".$products["name"]."&nbsp(".$products["Vname"].")</td>
						<td>".$products["qty"]."</td>
						
						<td>".$price."</td>
					    
						<td>".$subtotal."</td>
					</tr>";
					
				}
				$strTable .= "
			<tr>
					<td colspan = '3' style = 'text-align:right;padding-right : 10px; font-size : 16px;'><strong>Shipping</strong></td>
					<td>".$ship."</td></tr> ";

					if($order["reff_discount"] > 0) { 

					$strTable .= "<td colspan = '3' style = 'text-align:right;padding-right : 10px; font-size : 16px;'><strong>Refferal discount </strong></td>
					<td>".$reff."</td></tr>";
				}
					$strTable .= "<td colspan = '3' style = 'text-align:right;padding-right : 10px; font-size : 16px;'><strong>Total </strong></td>
					<td>".$finalprice."</td></tr>
				";
				$strTable .= "</table>";
			}
			$retVal[$order['order_id']]['cart_table'] = $strTable;			
			if($vendors)
			{
				$area = $order['shipping_area'];
				$strVendors = "";
				foreach($vendors as $vendor)
				{
					if(in_array($area,explode(",",$vendor['vendor_area'])))
					{
						$strVendors .= "
							<h5>".$vendor['vendor_name']."</h5>
							<p><strong> Address : </strong>".$vendor["vendor_address"]."<br /> 
							<strong>Phone : </strong>".$vendor["vendor_phone"]."<br /> 
							<strong>Mobile : </strong>".$vendor["vendor_mobile"]."<br /> 
							<strong>Email : </strong>".$vendor["vendor_email"]."<br /> 
							</p>
							<hr class = 'soft'>
						";
					}
				}
				$retVal[$order['order_id']]['vendors'] = $strVendors;
				$affiiid = $order['affiliate_id'];
				$outaffput = $this->affiliate_model->getUserByID1($affiiid);
				$retVal[$order['order_id']]['aff_namee'] = $outaffput[0]['first_name'];
			}			
		}
		return $retVal;
	}
	
	private function arrangeAbdData($orderData)
	{
		$retVal = array();
		if(!$orderData){return "";}		
	//	echo "<pre>";print_r($vendors);die;	
		$vendors = $this->Vendors_model->getVendors();	
		foreach($orderData as $order)
		{	
		    $curr = $order["currency"];		
			$retVal[$order['abd_cartID']] = $order;
			$retVal[$order['abd_cartID']]['customer_name'] = $order['firstname'];
			$cartData = unserialize($order['cart_data']);
			//print_r($cartData);die;
			if($cartData)
			{
				$total = 0;
				$strTable =  "<table class = 'table table-bordered'>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Rate</th>
					<th>Total Price</th>
				";
				foreach($cartData as $products)
				{
					if($curr == 'INR')
						{
						$price = 'Rs.&nbsp'.$products["Vprice"];
						$subtotal = 'Rs.&nbsp'.$products["Vprice"]*$products["qty"];
						$subtotal_wo = $products["Vprice"]*$products["qty"];
						$total_wo += $subtotal_wo;
						$total = 'Rs.&nbsp'.$total_wo;
						$finalprice = 'Rs.&nbsp'.$order["total_price"];
					    }
					    elseif($curr == 'AUD') 
					    {
					    	$price = 'AU&nbsp$'.$products["AUD_price"];
					    	$subtotal = 'AU&nbsp$'.$products["AUD_price"]*$products["qty"];
					    	$subtotal_wo = $products["AUD_price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = 'AU&nbsp$'.$total_wo;
					    	$finalprice = 'AU&nbsp$'.$order["total_price"];
					    }
					    elseif($curr == 'USD') 
					    {
					    	$price = 'US&nbsp$'.$products["USD_price"];
					    	$subtotal = 'US&nbsp$'.$products["USD_price"]*$products["qty"];
					    	$subtotal_wo = $products["USD_price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = 'US&nbsp$'.$total_wo;
					    	$finalprice = 'US&nbsp$'.$order["total_price"];
					    }
					    elseif($curr == 'GBP') 
					    {
					    	$price = '&pound;'.$products["UK_price"];
					    	$subtotal = '&pound;'.$products["UK_price"]*$products["qty"];
					    	$subtotal_wo = $products["UK_price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = '&pound;'.$total_wo;
					    	$finalprice = '&pound;'.$order["total_price"];
					    }
					    elseif($curr == 'EUR') 
					    {
					    	$price = '&euro;'.$products["EURO_price"];
					    	$subtotal = '&euro;'.$products["EURO_price"]*$products["qty"];
					    	$subtotal_wo = $products["EURO_price"]*$products["qty"];
					    	$total_wo += $subtotal_wo;
					    	$total = '&euro;'.$total_wo;
					    	$finalprice = '&euro;'.$order["total_price"];
					    }
					    
					
					$strTable .= "<tr>
						<td>".$products["name"]."&nbsp(".$products["Vname"].")</td>
						<td>".$products["qty"]."</td>
						
						<td>".$price."</td>
					    
						<td>".$subtotal."</td>
					</tr>";
					$megatotal += $subtotal_wo;		
				}	
					$strTable .= "<td colspan = '3' style = 'text-align:right;padding-right : 10px; font-size : 16px;'><strong>Total </strong></td>
					<td>".$megatotal."</td></tr>
				";
				$strTable .= "</table>";
			}
			$megatotal = 0;
			$retVal[$order['abd_cartID']]['cart_table'] = $strTable;
			$retVal[$order['abd_cartID']]['address'] = $order["shippingaddress"].'<br>'.$order["shipping_city"].','.$order["shipping_state"].'<br>'.$order["shipping_country"].','.$order["shipping_PIN"];	
			$retVal[$order['abd_cartID']]['contact_details'] = $order["billing_mobile"].'<br>'.$order["billing_mail"];				
		}
		return $retVal;
	}
	
	function finalizedOrder()
	{
		$this->load->model("admin/sales_model");
		$rcvdarr = $_POST;
		$insertArr = array
		(
			"order_id" => $rcvdarr["orderid"],
			"customer_id" => $rcvdarr["custid"],
			"affiliate_id" => $rcvdarr["affid"],
			"affiliate_comm" => $rcvdarr["aff_comm"],
			"affiliate_comm_status" => $rcvdarr["comm_status"],
			"payment_mode" => $rcvdarr["order_mode"],
			"card_name" => $rcvdarr["order_card"],
			"currency" => $rcvdarr["order_curr"],
			"ccavenue_date" => $rcvdarr["ccavenue_date"],
			"sale_month" => $rcvdarr["sale_month"],
			"sale_year" => $rcvdarr["sale_year"],
			"is_guest" => $rcvdarr["is_guest"],
			"payment_type" => $rcvdarr["payment_type"],
			"payment_ref_no" => $rcvdarr["payment_ref_no"],
			"guest_name" => $rcvdarr["gname"],
			
			"order_uid" => $rcvdarr["order_uid"],
			"bank_reff_no" => $rcvdarr["bank_ref_no"],
			"tracking_id" => $rcvdarr["tracking_id"],
			"order_date" => $rcvdarr["date_time"],
			"sale_amount" => $rcvdarr["sale_price"],
			
			"shipping_address" => $rcvdarr["shippingaddress"],
			"ship_city" => $rcvdarr["shipping_city"],
			"ship_state" => $rcvdarr["shipping_state"],
			"ship_country" => $rcvdarr["shipping_country"],
			"ship_name" => $rcvdarr["shipping_name"],
			"ship_mobile" => $rcvdarr["shipping_mobile"],
			"shipping_area" => $rcvdarr["area"],
			"shipping_pin" => $rcvdarr["shipping_PIN"],
			
			"total_tax" => $rcvdarr["order_tax"],
			"reff_discount" => $rcvdarr["order_discount"],
			"total_shipping" => $rcvdarr["order_ship"],
			"total_price" => $rcvdarr["order_finalprice"],
			"cart_data" => $rcvdarr["order_cartData"],
			
			"vendor_ids" => serialize($rcvdarr["vendors"]),
			"product_ids" => serialize($rcvdarr["prod_id"]),
			"product_quantities" => serialize($rcvdarr["quantity"]),
			"created_by" => $this->userData[0]["admin_id"],
			"created_date"=> Date("Y-m-d H:m:s")
		);
		
		
	//	echo "<pre>";print_r($insertArr);die;
		$this->sales_model->insertinvoice($insertArr);
	//	$this->sales_model->delete_pendingorder($rcvdarr["orderid"]);
	        $this->sales_model->addAppStatus($rcvdarr["orderid"]);
	        $this->sales_model->addtrackingId($rcvdarr["orderid"],$rcvdarr["tracking_id"]);
	        $this->sales_model->addpaymentreff($rcvdarr["orderid"],$rcvdarr["payment_ref_no"]);
		redirect(base_url()."admin/sales/AllOrders","refresh");
	}
	
	function updatefinalOrder()
	{
	    $this->load->model("admin/sales_model");
		$rcvdarr = $_POST;
		$insertArr = array
		(
			"order_id" => $rcvdarr["orderid"],
			"ccavenue_date" => $rcvdarr["ccavenue_date"],
			"tracking_id" => $rcvdarr["tracking_id"],
			"payment_ref_no" => $rcvdarr["payment_ref_no"],
			"or_status" => $rcvdarr["or_status"],
			
			"shipping_address" => $rcvdarr["shippingaddress"],
			"ship_city" => $rcvdarr["shipping_city"],
			"ship_state" => $rcvdarr["shipping_state"],
			"ship_country" => $rcvdarr["shipping_country"],
			"ship_name" => $rcvdarr["shipping_name"],
			"ship_mobile" => $rcvdarr["shipping_mobile"],
			"shipping_area" => $rcvdarr["area"],
			"shipping_pin" => $rcvdarr["shipping_PIN"],
			
		);
		
		$rcvdarr2 = $_POST;
		$insertArr2 = array
		(
			"order_id" => $rcvdarr2["orderid"],
			"ccavenue_date" => $rcvdarr2["ccavenue_date"],
			"manual_tracking_id" => $rcvdarr2["tracking_id"],
			"payment_ref_no" => $rcvdarr["payment_ref_no"],
			
			"shippingaddress" => $rcvdarr2["shippingaddress"],
			"shipping_city" => $rcvdarr2["shipping_city"],
			"shipping_state" => $rcvdarr2["shipping_state"],
			"shipping_country" => $rcvdarr2["shipping_country"],
			"shipping_name" => $rcvdarr2["shipping_name"],
			"shipping_mobile" => $rcvdarr2["shipping_mobile"],
			"shipping_area" => $rcvdarr2["area"],
			"shipping_pin" => $rcvdarr2["shipping_PIN"],
			
		);
		
		
	//	echo "<pre>";print_r($insertArr);die;
		$this->sales_model->updateinvoice($insertArr);
		$this->sales_model->updateorder($insertArr2);
		redirect(base_url()."admin/sales/AllOrders","refresh");
	}
	
	function sales_invoice()
	{
		$this->load->model("admin/sales_model");
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);			
		$orderData = $this->sales_model->getSalesInvoice();
		$headings = array
		( 
			"order_id"=>"Order No.",
			"order_uid"=>"Order ID",
		//	"customer_name"=>"Customer Name",
			"total_price" => "sales Amount",
			"tracking_id" => "Tracking Number",
			"ship_country"=>"Country",
			"currency"=>"Currency",
			//"order_date"=>"Order Date",
			//"created_date"=>"Created On"
		);
		$label = "Sales Invoice";
		$action = array
		(
			"btns"=>array("edit"),
			"text"=>array("View Sales Invoice"),
			"dbcols"=>array("order_id"),
			"link"=>array(base_url()."admin/sales/disp_invoice/%@$%"),
			"clickable"=>array()
		);
		
		$tableData = $this->customtable_lib->formatTableCells($label,$headings,$orderData,"",$action);
		$tableData["descFirst"] = TRUE;
		$this->load->view('helpers/members_table_view',$tableData);
		$this->load->view('admin/sales_inv_view');			
		$this->load->view("admin/includes/admin_footer");
	}
	
	public function disp_invoice($inv_id = "0")
	{
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);
		$data = array();
		$this->load->model("admin/sales_model");
		$this->load->model("admin/user_model");
		$this->load->model("admin/product_model");
		
		$inv= $this->sales_model->getSalesInvoice($inv_id);
		//$data["inv"] = $data["inv"][0]; 
		//print_r($data["inv"]);die;
		$inv= $inv[0];
		$amount = $inv['total_price'];
		$data['converted'] = $this->convertNum($amount);
		//print_r($inv);die;
		$inv['cart_data'] = $this->arrangeCartData($inv['cart_data']);
		//print_r($inv['cart_data']);die;
		$data["inv"] = $inv;
				
		//$data["inv"] = $this->sales_model->getSalesInvoice($inv_id);$data["inv"] = $data["inv"][0]; 
		$data["cust"] = $this->user_model->getAllUsers($data["inv"]["customer_id"]);$data["cust"] = $data["cust"][0];
		$productids = unserialize($data["inv"]["product_ids"]);
		
		$data["quantities"] = unserialize($data["inv"]["product_quantities"]);
		$data["products"] = $this->product_model->getProduct($productids," product_id, product_name, product_price, discount_price, discount_status, variationsData ");		
		$this->load->view("admin/disp_invoice_view2",$data);
		$this->load->view("admin/includes/admin_footer");		
	}
	
	private function arrangeCartData($cartData)
	{
		$cartData = unserialize($cartData);
		//print_r($cartData);die;
		$cart = array();
		foreach($cartData as $data)
		{
			if(array_key_exists('id', $data)){
			unset($data["rowid"]);
			$cart[$data["id"]] = $data;
			} else {
				$cart[$data["name"]] = $data;
			}
			//$cart[$data["subtotal"]] = $data;
		}
		return $cart;
	}
	
	public function download_invoice()
	{
	  	$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);
		$data['year'] = $this->sales_model->getyear();	
		$data['month'] = $this->sales_model->getmonth();	
		//echo "<pre>";print_r($data['month']);echo "</pre>";die;
	
		$this->load->view("admin/downloadInvoice_view",$data);
		$this->load->view("admin/includes/admin_footer");
	}
	
	public function get_down_date()
	{
	    $data['oObj'] = $this;		
	    $this->load->view("admin/includes/admin_header",$data);	
	 $month= $_POST['month'];
	    $year= $_POST['year'];
	
	    $this->load->model("admin/sales_model");
	    $down_data = $this->sales_model->getDownOrders($month, $year);
            $this->session->set_flashdata('down_sess',$down_data);
	    $invData = $this->sales_model->getDownOrders($month, $year);
	    $total = count($invData);
	    
	    $convarr = array();
	    for($i=0;$i<$total;$i++) {
	    	$gem = $this->convertNum($invData[$i]['total_price']);
	    	$convarr[$i] = $gem;
	    }
	    $data['converted'] = $convarr;
	    
	    for($i=0;$i<$total;$i++)
		{
		//$cust_orders= $cust_orders[$i];
		$invData[$i]['cart_data'] = $this->arrangeCartData($invData[$i]['cart_data']);
		$data["invData"] = $invData[$i];
		//echo "<pre>";print_r($cust_orders);
		}
	    $data["invData"] = $invData;
	    $data["year"] = $year;
	    $data["month"] = $month;
	    //print_r($data['invData']);
	    $this->load->view("admin/sale_reports_view",$data);
	    $this->load->view("admin/includes/admin_footer");

	}
	
public function excel()
    {
            $downData = $this->session->flashdata('down_sess');
            //echo"<pre>";print_r($downData);die;
           
            $options = array();
		foreach( $downData as $option => $options_value ){
		
		 if($option_value['sale_month'] == '11')
		 {
		 $month = "November";
		 }
		 $year = $options_value['sale_year'];
		  

       		 foreach( $options_value as $options_value_key => $each_value ){
       		     
       		     if($options_value['reff_discount'] != ""){
       		         $reff_val = $options_value['reff_discount']; 
       		     }else {
       		         $reff_val = 0;
       		     }

			if($options_value['currency'] == 'INR'){
            		$sale = 'Rs.'.$options_value['total_price'];
            		$reff = 'Rs.'.$reff_val;
            		$ship = 'Rs.'.$options_value['total_shipping'];
            		}
            		elseif($options_value['currency'] == 'USD'){
            		$sale = 'US$'.$options_value['total_price'];
            		$reff = 'US$'.$reff_val;
            		$ship = 'US$'.$options_value['total_shipping'];
            		}
            		elseif($options_value['currency'] == 'AUD'){
            		$sale= 'AU$'.$options_value['total_price'];
            		$reff = 'AU$'.$reff_val;
            		$ship = 'AU$'.$options_value['total_shipping'];
            		}
            		elseif($options_value['currency'] == 'GBP'){
            		$sale= '£ '.$options_value['total_price'];
            		$reff = '£ '.$reff_val;
            		$ship = '£ '.$options_value['total_shipping'];
            		}
            		elseif($options_value['currency'] == 'EUR'){
            		$sale= '€ '.$options_value['total_price'];
            		$reff = '€ '.$reff_val;
            		$ship = '€ '.$options_value['total_shipping'];
            		}
            		//Store each value by their collective key
            		
            		$options[$option]['order_id'] = $options_value['order_id'];
            		$options[$option]['order_uid'] = $options_value['order_uid'];
            		$options[$option]['ship_name'] = $options_value['ship_name'];
            		$options[$option]['order_date'] = $options_value['order_date'];
            		$options[$option]['payment_type'] = $options_value['payment_type'];
            		$options[$option]['ccavenue_date'] = $options_value['ccavenue_date'];
            		$options[$option]['tracking_id'] = $options_value['tracking_id'];
            		$options[$option]['bank_reff_no'] = $options_value['bank_reff_no'];
            		$options[$option]['ship_city'] = $options_value['ship_name'].','.$options_value['ship_mobile'].','.$options_value['shipping_address'].','.$options_value['ship_city'].','.$options_value['ship_state'].','.$options_value['ship_country'].','.$options_value['shipping_pin'];
            		$options[$option]['affiliate_id'] = $options_value['affiliate_id'];
            		$options[$option]['total_amount'] = $sale;
            		$options[$option]['reff_discount'] = $reff;
            		$options[$option]['total_shipping'] = $ship;
            		
            	
            		$cData = unserialize($options_value['cart_data']);
            		
            		$hj = count($cData);
            		$i=1;
            		while($i<=$hj)
            		{
            		foreach($cData as $cKeys => $cValues)
            		{
            		
            		if($options_value['currency'] == 'INR'){
            		$price = 'Rs.'.$cValues["Vprice"]*$cValues['qty'];
            		$ddp = $cValues["Vprice"]*$cValues['qty']/10;
            		$dprice = $cValues["Vprice"]*$cValues['qty']-$ddp;
            		$finaldp = 'Rs.'.round($dprice,2);
            		}
            		elseif($options_value['currency'] == 'USD'){
            		$price = 'US$'.$cValues["USD_price"]*$cValues['qty'];
            		$ddp = $cValues["USD_price"]*$cValues['qty']/10;
            		$dprice = $cValues["USD_price"]*$cValues['qty']-$ddp;
            		$finaldp = 'US$'.round($dprice,2);
            		}
            		elseif($options_value['currency'] == 'AUD'){
            		$price = 'AU$'.$cValues["AUD_price"]*$cValues['qty'];
            		$ddp = $cValues["AUD_price"]*$cValues['qty']/10;
            		$dprice = $cValues["AUD_price"]*$cValues['qty']-$ddp;
            		$finaldp = 'AU$'.round($dprice,2);
            		}
            		elseif($options_value['currency'] == 'GBP'){
            		$price = '£ '.$cValues["UK_price"]*$cValues['qty'];
            		$ddp = $cValues["UK_price"]*$cValues['qty']/10;
            		$dprice = $cValues["UK_price"]*$cValues['qty']-$ddp;
            		$finaldp = '£ '.round($dprice,2);
            		}
            		elseif($options_value['currency'] == 'EUR'){
            		$price = '€ '.$cValues["EURO_price"]*$cValues['qty'];
            		$ddp = $cValues["EURO_price"]*$cValues['qty']/10;
            		$dprice = $cValues["EURO_price"]*$cValues['qty']-$ddp;
            		$finaldp = '€ '.round($dprice,2);
            		}
            		$options[$option]['products_name_'.$i] = $cValues['name'].'('.$cValues['Vname'].')';
            		$options[$option]['products_hsn_'.$i] = $cValues['producthsn'];
            		$options[$option]['products_gst_'.$i] = $cValues['gstpercent'];
            		$options[$option]['products_qty_'.$i] = $cValues['qty'];
            		$options[$option]['products_price_'.$i] = $price;
            		$options[$option]['products_dprice_'.$i] = $finaldp;
            		$options[$option]['number'] = $i;
            		$i++;

                        }
                        } /* while loop closed */
                                
        		}
    			}
	  	//echo "<pre>".print_r($options, true)."</pre>";die;
	 
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Sales Report');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'SALES REPORT');
                
                $this->excel->getActiveSheet()->setCellValue('A4', 'Order ID');
                $this->excel->getActiveSheet()->setCellValue('B4', 'Order UID');
                $this->excel->getActiveSheet()->setCellValue('C4', 'Customer Name');
                $this->excel->getActiveSheet()->setCellValue('D4', 'Order Date');
                $this->excel->getActiveSheet()->setCellValue('E4', 'Payment Method');
                $this->excel->getActiveSheet()->setCellValue('F4', 'Payment Received Date');
                $this->excel->getActiveSheet()->setCellValue('G4', 'Tracking No.');
                $this->excel->getActiveSheet()->setCellValue('H4', 'Bank Reff No.');
                $this->excel->getActiveSheet()->setCellValue('I4', 'Shipping Address');
                $this->excel->getActiveSheet()->setCellValue('J4', 'Product Name');
                $this->excel->getActiveSheet()->setCellValue('K4', 'Product HSN');
                $this->excel->getActiveSheet()->setCellValue('L4', 'Product GST');
                $this->excel->getActiveSheet()->setCellValue('M4', 'Product Quantity');
                $this->excel->getActiveSheet()->setCellValue('N4', 'Product price');
                $this->excel->getActiveSheet()->setCellValue('O4', 'Discounted price');
                $this->excel->getActiveSheet()->setCellValue('P4', 'Shipping Charges');
                $this->excel->getActiveSheet()->setCellValue('Q4', 'Refferal Discount');
                $this->excel->getActiveSheet()->setCellValue('R4', 'Total Sale');
                               
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:C1');
                
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

               for($a=a;$a<=n;$a++)
               {
               	$this->excel->getActiveSheet()->getStyle($a.'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
               }
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);


       for($col = ord('A'); $col <= ord('Z'); $col++){ 
       //set column dimension 
       $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }

    $row = 6; // 1-based index
    $col = 0;
foreach ($options as $rows)
        {
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['order_id']);
         $col++; // Increment for each Cell
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['order_uid']);
         $col++; // Increment for each Cell
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['ship_name']);
         $col++; // Increment for each Cell
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['order_date']);
         $col++; // Increment for each Cell
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['payment_type']);
         $col++; // Increment for each Cell
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['ccavenue_date']);
         $col++; // Increment for each Cell
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['tracking_id']);
         $col++; // Increment for each Cell
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['bank_reff_no']);
         $col++; // Increment for each Cell
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['ship_city']);
         $col++; // Increment for each Cell
    for($f=1;$f<=$rows['number'];$f++)
    {
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['products_name_'.$f]);
    $col++;
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['products_hsn_'.$f]);
    $col++;
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['products_gst_'.$f]);
    $col++;
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['products_qty_'.$f]);
    $col++;
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['products_price_'.$f]);
    $col++;
    if($rows['affiliate_id'] != ''){
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['products_dprice_'.$f]);
    }
         $row++;
         $col = 9;
    }    
     $row--;
     $col = 15;
     
     $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['total_shipping']);
     $col++; // Increment for each Cell
     $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['reff_discount']);
     $col++; // Increment for each Cell
     $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rows['total_amount']);
     $this->excel->getActiveSheet()->getCellByColumnAndRow($col, $row)->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('#ffe842');
     $col++; // Increment for each Cell 
     $row++;

     $row++;
     $col = 0;
} 
               // $this->excel->getActiveSheet()->fromArray(array_map(function($value) { return [$value]; }, $exceldata), NULL, 'A6');
                 
                $this->excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='monthlySalesReport.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
               // header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                 
    }
    
/*    function for creating manual orders */
    function manual_order(){
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$this->load->view('admin/manual_order_view');			
		$this->load->view("admin/includes/admin_footer");
} 

/* 	   function for submitting manual order to the database */
    function submanualOrder(){ 
		$data['oObj'] = $this;		
		$this->load->view("admin/includes/admin_header",$data);	
		$this->load->model("admin/order_model");
		//echo "<pre>";print_r($_POST);
		$productarray = $_POST['products'];
		//echo "<pre>";print_r($productarray);die;
		$serializedArray = serialize($productarray);
		foreach ($productarray as $pkey => $pdata){	
    	$price_for_reff += $pdata['price']*$pdata['qty'];
		}
		
		if($_POST['affiliate_code'] == ''){
		$final_price = $price_for_reff+$_POST['shipping_charges'];	
		}else {
		$reff_discount = 10/100*$price_for_reff;
		$final_price = $price_for_reff-$reff_discount+$_POST['shipping_charges'];	
		}
		
		$ordDate = date('d/m/Y h:i:s ',gmt_to_local(time(),"UP45"));
		$orderUID = random_string('numeric','8');

		/* get affiliate id from affiliate code */
		$affiliate_code = $_POST['affiliate_code'];
		$afID = $this->sales_model->getaffiId($affiliate_code);
		$afName = $afID[0]['affiliate_id'];

		$pdata = array(
			"payment_type" => $_POST['payment_type'],
			"ccavenue_date" => $_POST['ccavenue_date'],
			"manual_tracking_id" => $_POST['tracking_id'],
			"payment_ref_no" => $_POST['payment_ref_no'],
			"bank_ref_no" => $_POST['payment_ref_no'],
			"affiliate_id" => $afName,
			"billing_name" => $_POST['billing_name'],
			"billing_email" => $_POST['billing_email'],
			"billing_address" => $_POST['billing_address'],
			"billing_city" => $_POST['billing_city'],
			"billing_state" => $_POST['billing_state'],
			"billing_country" => $_POST['billing_country'],
			"billing_zip" => $_POST['billing_zip'],
			"billing_tel" => $_POST['billing_tel'],
			"shipping_name" => $_POST['shipping_name'],
			"shippingaddress" => $_POST['shippingaddress'],
			"shipping_city" => $_POST['shipping_city'],
			"shipping_state" => $_POST['shipping_state'],
			"shipping_country" => $_POST['shipping_country'],
			"shipping_PIN" => $_POST['shipping_PIN'],
			"shipping_mobile" => $_POST['shipping_mobile'],
			"total_shipping" => $_POST['shipping_charges'],
			"total_price" => $final_price,
			"reff_discount" => $reff_discount,
			"order_status" => "Success",
			"is_manual" => "yes",
			"cart_data" => $serializedArray,
			"date_time" => $ordDate,
			"order_uid" => $orderUID,
			"currency"=> $_POST['currency'],
			);

		//echo "<pre>";print_r($pdata);die;
		$this->order_model->placeOrder($pdata);
		$this->session->set_flashdata("success", "Manual Order Added Successfully");			
		$this->RefreshInvoicePage();	
	} 

	/* function to refresh the page after submit button */
	private function RefreshInvoicePage()
	{
			redirect(base_url()."admin/sales/pendingOrders","refresh");		
	}  	    
	
	
}
?>