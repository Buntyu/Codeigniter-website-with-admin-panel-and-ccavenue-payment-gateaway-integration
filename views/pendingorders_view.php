  <?php
 // echo "<pre>";print_r($detail);echo"</pre>";die;

  $id = $this->session->userdata("affiliate_id");
  
   $custId = $this->session->userdata("id");
  //echo $id.'<br/>';
  
  //echo $custId;
   if($id){ echo"<h3 class='f-head'>SALES</h3>";} else {echo"<h3>ORDERS</h3>";}?>

   <?php
   
    $myArray=array();
	foreach($orders as $val){
	$highKey = $val['YEAR'];	
    $newKey=$val['MONTH'];
    $subKey=$val['WEEK'];
    $myArray[$highKey][$newKey][$subKey][]=$val;
}

//echo "<pre>";print_r($myArray);echo "</pre>";die;

	foreach($myArray as $hkey => $hvalue ):

     foreach($hvalue as $key => $value ):
     	//echo "<pre>";print_r($data);echo "</pre>";die;
     if($key =='1'){$month = "JANUARY";}elseif($key=='2'){$month="FEBRUARY";}elseif($key=='3'){$month="MARCH";}elseif($key=='4'){$month="APRIL";}elseif($key=='5'){$month="MAY";}elseif($key=='6'){$month="JUNE";}elseif($key=='7'){$month="JULY";}elseif($key=='8'){$month="AUGUST";}elseif($key=='9'){$month="SEPTEMBER";}elseif($key=='10'){$month="OCTOBER";}elseif($key=='11'){$month="NOVEMBER";}elseif($key=='12'){$month="DECEMBER";}else{$month="(error getting month)";}

     foreach($value as $skey => $svalue):
     	$megatotal = 0;
     	$month_num = $key;
     	$week = $skey;
     	$year = $svalue[0]['YEAR'];
     	
     	$week_start = new DateTime();
		$week_start->setISODate($year,$week);
		$week_st = $week_start->format('d-M-Y');
		$week_start->modify('+6 days');
		$week_en = $week_start->format('d-M-Y');

     	?>
     <div class="sale-summ">
    <h4><?php echo $month.'&nbsp('.$week_st.'&nbsp-&nbsp'.$week_en.')'; ?> </h4>
   	<table class="table table-bordered aff">
   	 <thead>	
   		<tr>
		
		<th>Order ID </th>
		<th>Customer Name </th>
		<th>Country</th>
		<th>Sale Amount </th>
		<th>Commission(20%) </th>
		<th>TDS on commission </th>
		<th>Total Commission (TDS Deducted)</th>
	</tr>
</thead>
	<?php

	if(isset($paymentData))
    {
    	$payarray = array();
    	foreach($paymentData as $paykey => $paydata)
    	{
    		$paym = $paydata['month'];
    		$payw = $paydata['week'];
    		$payarray[$paym][$payw] = $paydata;

    	} 
    	//echo "<pre>";print_r($payarray[$month_num][$week]);echo "</pre>";die;
    	if(isset($payarray[$month_num][$week]))
    	{
    		$found="yes";
    		$code = $payarray[$month_num][$week]['refference_code'];
    	}
    	else
    	{
    		$found="no";
    	}
    } 
      $orderid = "";
	 foreach($svalue as $fkey => $fvalue):
	  /*  $finetotal = $fvalue['sale_amount']-$fvalue['reff_discount'];*/
	   $finetotal = $fvalue['total_price']-$fvalue['total_shipping'];
	 	$comm = round(20/100*$finetotal,2);
	 	$tds = round($comm/10,2);
	 	$total = round($comm-$tds,2);
	 	$megatotal += $total; 
	 	if ($orderid) $orderid .= ',';
	 	$orderid .= $fvalue['order_id'];
	 	$date = date('Y-m-d');

	 	?>
	<tr>
	
		<td><?php echo $fvalue['order_uid']; ?></td>
	
		<td><?php if($fvalue['firstname'] != '') { echo $fvalue['firstname']; } else { echo $fvalue['ship_name']; } ?></td>
		<td><?php echo $fvalue['ship_country']; ?></td>
		<td><?php echo $finetotal; ?></td>
		<td><?php echo $comm; ?></td>
		<td><?php echo $tds; ?></td>
		<td><?php echo $total; ?></td>
	</tr>

	<?php endforeach; ?>
	
    <table class="table table-bordered sub-aff">
	<tr>
    <td><h5 style="text-align: right;color:green;">TOTAL COMMISSION :</h5></td>
    <td><span style="color:green;"><?php echo $megatotal; ?></span></td>
	</tr>
	<?php if ($found == "no") { ?>
	<tr>
    <td colspan="2"><h5 style="text-align: center;color:#ce0035;">COMMISSION DUE</h5></td>
	</tr>
	<?php } 
	elseif ($found == "yes") { ?>
    <tr>
    <td><h5 style="color:green;text-align: center;">COMMISSION PAID <i class="icon-check"></i></h5></td>
    <td><input type="text" value="<?php echo $code; ?>" readonly><br><small>Payment Refference Code</small></td>
	</tr>
    </table>

	<?php } ?>

	</table> 
</div><!-- sale-summ div closed -->
	
	<?php endforeach; 
 endforeach;
 endforeach; ?>
	 
	 
	
	<?php //customer order table
	  if($custId){  if(!empty($cust_orders))
	  //echo "<pre>";print_r($cust_orders);die;
	 {
	 
    ?>

    <table class=" table table-bordered cus">
<thead>
							  <tr role="row"><th>Order Id</th><th>Date</th><th>Product</th><th>Total Payment</th><th>tracking ID </th><th>Actions</th></tr>
						  </thead>
						  <?php
						  foreach($cust_orders as $newOrder)
						 {
						 $curr = $newOrder["currency"]; ?>
						  <tbody role="alert" aria-live="polite" aria-relevant="all">
   
    
	<tr class="custom-table-rows odd">
	<td class="center sorting_1"><?php echo $newOrder['order_uid']; ?></td>
	<td class="center "><?php echo $newOrder["date_time"]; ?></td>
	<td>
	
						 <?php if($newOrder['cart_data']){
						 
							foreach($newOrder['cart_data'] as $products)
				{   ?>
				
				<table class="cart"><tr>
						<td><?php echo $products["name"]."&nbsp(".$products["Vname"].")"; ?></td>
						<td><?php echo $products["qty"]; ?></td>
						
				</tr></table>
				
			<?php	 }	} ?>
				 </td>
				<td class="center "><?php echo $newOrder['total_price']; ?></td> 
				<td class="center "><?php echo $newOrder['manual_tracking_id']; ?></td> 
				<td class="center "><a href="<?php echo base_url()."home/UserOrder1/".$newOrder['order_id']; ?>" class="btn btn-success viewbtn" style="margin:5px;">view order</a></td></tr>
				</tbody>
					<?php	}      }     }    ?>	 
						  </table>
						 
						  
						  
		<?php if($custId && !empty($detail) ){
		//echo "<pre>";print_r($detail);die;
			?>
      
      
      <table class="table table-bordered det">
	<tbody>
		<tr>
			<th>
				Order ID 
			</th>
			<td>
				<?php echo $detail["order_uid"]; ?>
			</td>
			<?php if($detail['payment_type'] == 'COD'){ ?>
				<th>
				Payment Method 
			</th>
			<td>
				<?php echo "COD"; ?>
			</td>
		<?php	}  else { ?>
			<th>
				Bank Reff No. 
			</th>
			<td>
				<?php echo $detail["bank_ref_no"]; ?>
			</td>
		<?php } ?>
		</tr>


		<tr>
			<th>
				Order Date
			</th>
			<td>
				<?php echo $detail["date_time"]; ?>
			</td>
			<th>
				Tracking ID
			</th>
			<td>
				<?php echo $detail["manual_tracking_id"]; ?>
			</td>
		</tr>


		<tr>	
			<th>
				Customer Name
			</th>
			<td>
				<?php echo $detail["billing_name"]; ?>
			</td>
			<th>
				Total Amount
			</th>
			<td>
				<?php echo $detail["order_amount"]; ?>
			</td>
		</tr>

       <tr><td colspan="4">
        <h3>Shipping Details </h3>
       </td></tr>

       <tr>
            <th>
				Shipping Name
			</th>
			<td colspan="4">
				<?php echo $detail["shipping_name"]; ?>
			</td>
	    </tr>

		<tr>
			<th>
				Shipping Address
			</th>
			<td>
				
					<?php echo $detail["shippingaddress"]; ?>
				
			</td>
			<th>
				Shipping City
			</th>
			<td>
				<?php echo $detail["shipping_city"]; ?>
			</td>
		</tr>

		<tr>
			<th>
				Shipping State
			</th>
			<td>
				<?php echo $detail["shipping_state"]; ?>
			</td>
			<th>
				Shipping Country
			</th>
			<td>
				<?php echo $detail["shipping_country"]; ?>
			</td>
		</tr>

		<tr>
			<th>
				Shipping PIN
			</th>
			<td>
				<?php echo $detail["shipping_PIN"]; ?>
			</td>
			<th>
				Shipping Contact No.
			</th>
			<td>
				<?php echo $detail["shipping_mobile"]; ?>
			</td>
		</tr>
		
		
       


       <tr><td colspan="4">
        <h3>Order Details </h3>
       </td></tr>

          <tr>
		
			<td colspan="4">
				<table class="table table-bordered det_cart">
					<tbody>
					<thead>
						<tr class = 'prod_head'>
							<th>
								Product Name
							</th>
							<th>
								HSN/SAC
							</th>
							<th>
								GST %
							</th>
							<th>
								Qunatity
							</th>
							<th>
								Price
							</th>
							<th>
								Total
							</th>
						</tr></thead>
						<?php 
							$total = 0;
							$curr = $detail["currency"];
							//echo $curr;
							//print_r($user["cart_data"]);die;
							
							foreach($detail["cart_data"] as $order)
							{
							
							  if($curr == 'INR')
							    {
								$price = 'Rs.&nbsp'.$order["Vprice"];
								$subtotal = 'Rs.&nbsp'.$order["Vprice"]*$order["qty"];
								$subtotal_wo = $order["Vprice"]*$order["qty"];
								$total_wo += $subtotal_wo;
								$total = 'Rs.&nbsp'.$total_wo;
								$tax = 'Rs.&nbsp'.$detail["total_tax"];
								$reff = 'Rs.&nbsp'.$detail["reff_discount"];
								$ship = 'Rs.&nbsp'.$detail["total_shipping"];
								$finalprice = 'Rs.&nbsp'.$detail["total_price"];
							    }
							    elseif($curr == 'AUD') 
							    {
							    	$price = 'AU&nbsp$'.$order["AUD_price"];
							    	$subtotal = 'AU&nbsp$'.$order["AUD_price"]*$order["qty"];
							    	$subtotal_wo = $order["AUD_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = 'AU&nbsp$'.$total_wo;
							    	$tax = 'AU&nbsp$'.$detail["total_tax"];
							    	$reff = 'AU&nbsp$'.$detail["reff_discount"];
							    	$ship = 'AU&nbsp$'.$detail["total_shipping"];
							    	$finalprice = 'AU&nbsp$'.$detail["total_price"];
							    }
							    elseif($curr == 'USD') 
							    {
							    	$price = 'US&nbsp$'.$order["USD_price"];
							    	$subtotal = 'US&nbsp$'.$order["USD_price"]*$order["qty"];
							    	$subtotal_wo = $order["USD_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = 'US&nbsp$'.$total_wo;
							    	$tax = 'US&nbsp$'.$detail["total_tax"];
							    	$reff = 'US&nbsp$'.$detail["reff_discount"];
							    	$ship = 'US&nbsp$'.$detail["total_shipping"];
							    	$finalprice = 'US&nbsp$'.$detail["total_price"];
							    }
							    elseif($curr == 'GBP') 
							    {
							    	$price = '&pound;'.$order["UK_price"];
							    	$subtotal = '&pound;'.$order["UK_price"]*$order["qty"];
							    	$subtotal_wo = $order["UK_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = '&pound;'.$total_wo;
							    	$tax = '&pound;'.$detail["total_tax"];
							    	$reff = '&pound;'.$detail["reff_discount"];
							    	$ship = '&pound;'.$detail["total_shipping"];
							    	$finalprice = '&pound;'.$detail["total_price"];
					    		    
							    }
							    elseif($curr == 'EUR') 
							    {
							    	$price = '&euro;'.$order["EURO_price"];
							    	$subtotal = '&euro;'.$order["EURO_price"]*$order["qty"];
							    	$subtotal_wo = $order["EURO_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = '&euro;'.$total_wo;
							    	$tax = '&euro;'.$detail["total_tax"];
							    	$reff = '&euro;'.$detail["reff_discount"];
							    	$ship = '&euro;'.$detail["total_shipping"];
							    	$finalprice = '&euro;'.$detail["total_price"];
							    }
					    
					    
								echo "
								
								<tr>
									<input type = 'hidden' name = 'prod_id[]' value = '".$order['id']."' />
									<input type = 'hidden' name = 'sub_total[]' value = '".$subtotal."' />
									<td>".$order["name"]."&nbsp(".$order["Vname"].")</td>
									<td>".$order["producthsn"]."</td>
									<td>".$order["gstpercent"]."</td>
									<td>".$order["qty"]."</td>
									<td class = 'pri'>".$price."</td>
									<td class = 'total'>".$subtotal."</td>	

								</tr>
								
								";
								//$total += $order["subtotal"];	
							}
							echo "
							<!--        <tr>
									<td colspan = '3' style = ' font-size : 20px;'> Taxes (inc.GST) </td>
									<td class = 'sumtotal' colspan = '2' style = ' font-size : 20px;'>".$tax."</td>
								</tr> -->
								<tr>
									<td colspan = '5' style = ' font-size : 20px;'> Shipping Charges </td>
									<td class = 'sumtotal' colspan = '2' style = ' font-size : 20px;'>".$ship."</td>
								</tr>";
								if($detail["reff_discount"] > 0) { 
								echo"<tr>
									<td colspan = '5' style = ' font-size : 20px;'> Refferal Discount </td>
									<td class = 'sumtotal' colspan = '2' style = ' font-size : 20px;'>".$reff."</td>
								</tr>";
								}
								echo "<tr>
									<td colspan = '5' style = 'font-weight : bold; font-size : 20px;'> Total </td>
									<td class = 'sumtotal' colspan = '2' style = 'font-weight : bold; font-size : 20px;'>".$finalprice."</td>
								</tr>
								
							";
						?>
					</tbody>
				</table>
			</td>
		</tr>
		
	</tbody>
</table>
      
      
      
      
      
      
			<?php 
	  
		}	?>		
					  


</div></div></div></div></div>

<style>
		@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	.aff, .aff thead, .aff tbody, .aff th, .aff td, .aff tr { 
		display: block; 
	}
	
	/* Force table to not be like tables anymore */
	.cus, .cus thead, .cus tbody, .cus th, .cus td, .cus tr { 
		display: block; 
	}
	
	/* Force table to not be like tables anymore */
	.det, .det thead, .det tbody, .det th, .det td, .det tr { 
		display: block; 
	}
	
	/* Force table to not be like tables anymore */
	.det_cart, .det_cart thead, .det_cart tbody, .det_cart th, .det_cart td, .det_cart tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		/* Now like a table header */
		//position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
	*/
	.cus td:nth-of-type(1):before { content: "Order Id."; }
	.cus td:nth-of-type(2):before { content: "Date"; }
	
	.cart td:nth-of-type(1):before { content: ""; }
	.cart td:nth-of-type(2):before { content: "Quantity"; }
	
	.cus td:nth-of-type(4):before { content: "Total"; }
	.cus td:nth-of-type(5):before { content: "Tracking ID"; }
	.cus td:nth-of-type(6):before { content: "Actions"; }
	
	
	.aff td:nth-of-type(1):before { content: "Order ID"; }
	.aff td:nth-of-type(2):before { content: "Customer Name"; }
	.aff td:nth-of-type(3):before { content: "Country"; }
	.aff td:nth-of-type(4):before { content: "Sale amount"; }
	.aff td:nth-of-type(5):before { content: "Commission (10%)"; }
	.aff td:nth-of-type(6):before { content: "TDS on Commission"; }
	.aff td:nth-of-type(7):before { content: "Total Commission (TDS Deducted)"; }	
}
.f-head
{
	text-align: center;
	color: #578F18;
}
.sale-summ {
    margin-bottom: 5%;
}

</style>