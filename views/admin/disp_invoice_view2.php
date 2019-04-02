<?php 
//	echo "<pre>";print_r($inv);die;
	$theme_link =  base_url()."theme_back/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo isset($title)?$title: COMPANYNAME; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<link href="<?php echo $theme_link; ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<script src="<?php echo $theme_link; ?>js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo $theme_link; ?>js/jquery-ui-1.8.21.custom.min.js"></script>
	<style>body{color: #424341;}.item-name {width: 25%;}.btn{font-size: 16px;padding: 5px;}.invoice-logo {display: block; margin: auto;}table.detTab{width:70%;}	@media print {@page { margin: 0; }body { margin: 1.6cm; }.navbar, .breadcrumb, .main-menu-span, .well, .nav-collapse, .sidebar-nav, .bk-footer {display:none;}#content, table.detTab {width: 100%;}}.canClass {color: #d40000;font-size: 45px;font-family: "Times New Roman", Times, serif;border: 4px solid #d40000;border-radius: 13px;padding: 4%;-webkit-transform: rotate(-25deg);-moz-transform: rotate(-25deg);-ms-transform: rotate(-25deg);-o-transform: rotate(-25deg);/* Internet Explorer */filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);}</style>
</head>
<body>
	<img src="<?php echo base_url() ?>images/BISJ-new.png" class="invoice-logo">
	<h4 style="text-align: center;">Natural Care, From Nature</h4><br><br>
      <p style="text-align: center;">Invoice</p> 
	<center>
		<table class="detTab table table-bordered">
			<tr>
                <td colspan="4">
                	<center><strong>BISJ Exporters Pvt Ltd<br>Address :- 3128, sector- 40 D<br> Chandigarh, India<br>160036<br>GST/UIN :- 04AADCB3939K1ZN</strong></center>
                </td>
                <td colspan="4">
                	<center><strong>
                		Customer name :- <?php echo $inv['ship_name']; ?><br>
                		Shipping Address :- <?php echo $inv["shipping_address"].'<br>'.$inv["ship_city"].','.$inv["ship_state"]; ?><br>
                		Shipping Pin :- <?php echo $inv["shipping_pin"]; ?> <br>
                		Shipping Country :- <?php echo $inv["ship_country"]; ?> <br>
                		Mobile :- <?php echo $inv["ship_mobile"]; ?></strong></center>
                </td>
			</tr>
			<tr>
				<td colspan="2"><strong>Invoice No:</strong><br><?php echo $inv["sales_id"];?></td>
				
				<?php if($inv['affiliate_id'] == '' && $inv['or_status'] == "cancelled") { ?>
				<td colspan="3" rowspan="3"><h1 class="canClass">CANCELLED</h1></td>
				<?php } else if($inv['affiliate_id'] == '47' && $inv['is_guest'] == 'yes' && $inv['or_status'] == "cancelled") { ?>
				<td colspan="3" rowspan="3"><h1 class="canClass">CANCELLED</h1></td>
				<?php } else { if ($inv['affiliate_id'] != '' && $inv['or_status'] == "cancelled") { ?>
				<td colspan="3" rowspan="3"><center><strong><h2>10% Refferal Discount</h2></strong></center><h1 class="canClass">CANCELLED</h1></td>
				<?php }
				else if ($inv['affiliate_id'] == '') { ?>
				<td colspan="3" rowspan="3"></td>
				<?php }
				else { ?>
				<td colspan="3" rowspan="3"><center><strong><h2>10% Refferal Discount</h2></strong></center></td>
				<?php } } ?>
				
				<td colspan="3"><strong>Order ID:</strong><br><?php echo $inv["order_uid"];?></td>
			</tr>

			<tr><?php if($inv['payment_type'] == 'COD'){ ?>
			<td colspan="2"><strong>Payment Reference Number:</strong><br><?php echo $inv["payment_ref_no"];?></td>
			<?php } else  { ?>
			<td colspan="2"><strong>Bank Reference Number:</strong><br><?php echo $inv["bank_reff_no"];?></td>
			<?php } ?>
				
				<td colspan="3"><strong>Tracking ID:</strong><br><?php echo $inv["tracking_id"];?></td>
				
			</tr>

			<tr>
				<td colspan="2"><strong>Order Date:</strong><br><?php echo $inv["order_date"];?></td>
				<td colspan="3"><strong>Payment Received Date:</strong><br><?php echo $inv["ccavenue_date"];?></td>
			</tr>

			<tr>
            <th>S No.</th>
            <th>Description of goods</th>
            <th>HSN/SAC</th>
            <th>GST %</th>
            <th>Quanity</th>
            <th>Rate</th>
            <th>Amount</th>
         <!--   <?php if($inv['affiliate_id'] != '' ) { 
            if($inv['affiliate_id'] != '47' && $inv['is_guest'] != 'yes') { ?>
             <th>Discounted Price</th>   
            <?php } } ?>    -->
			</tr>

			<?php 
							$total = 0;
							$curr = $inv["currency"];
							//echo $curr;
							$ssm = $inv["cart_data"];
							
							$c = count($inv["cart_data"]);
							for($i=1;$i<=$c;)
							    {
							foreach($inv["cart_data"] as $order)
							{
							
							  if($curr == 'INR')
							    {
								$price = 'Rs.&nbsp'.$order["Vprice"];
								$subtotal = 'Rs.&nbsp'.$order["Vprice"]*$order["qty"];
								$subtotal_wo = $order["Vprice"]*$order["qty"];
								$total_wo += $subtotal_wo;
								$total = 'Rs.&nbsp'.$total_wo;
								$tax = 'Rs.&nbsp'.$inv["total_tax"];
								$reff = 'Rs.&nbsp'.$inv["reff_discount"];
								$ship = 'Rs.&nbsp'.$inv["total_shipping"];
								$finalprice = 'Rs.&nbsp'.$inv["total_price"];
								$spp = 10/100*$subtotal_wo;
							  	$dis_price = 'Rs.&nbsp'.round($subtotal_wo-$spp,2);
							    }
							    elseif($curr == 'AUD') 
							    {
							    	$price = 'AU&nbsp$'.$order["AUD_price"];
							    	$subtotal = 'AU&nbsp$'.$order["AUD_price"]*$order["qty"];
							    	$subtotal_wo = $order["AUD_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = 'AU&nbsp$'.$total_wo;
							    	$tax = 'AU&nbsp$'.$inv["total_tax"];
							    	$reff = 'AU&nbsp$'.$inv["reff_discount"];
							    	$ship = 'AU&nbsp$'.$inv["total_shipping"];
							    	$finalprice = 'AU&nbsp$'.$inv["total_price"];
							    	$spp = 10/100*$subtotal_wo;
							  	$dis_price = 'AU&nbsp$'.round($subtotal_wo-$spp,2);
							    }
							    elseif($curr == 'USD') 
							    {
							    	$price = 'US&nbsp$'.$order["USD_price"];
							    	$subtotal = 'US&nbsp$'.$order["USD_price"]*$order["qty"];
							    	$subtotal_wo = $order["USD_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = 'US&nbsp$'.$total_wo;
							    	$tax = 'US&nbsp$'.$inv["total_tax"];
							    	$reff = 'US&nbsp$'.$inv["reff_discount"];
							    	$ship = 'US&nbsp$'.$inv["total_shipping"];
							    	$finalprice = 'US&nbsp$'.$inv["total_price"];
							    	$spp = 10/100*$subtotal_wo;
							  	$dis_price = 'US&nbsp$'.round($subtotal_wo-$spp,2);
							    }
							    elseif($curr == 'GBP') 
							    {
							    	$price = '&pound;'.$order["UK_price"];
							    	$subtotal = '&pound;'.$order["UK_price"]*$order["qty"];
							    	$subtotal_wo = $order["UK_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = '&pound;'.$total_wo;
							    	$tax = '&pound;'.$inv["total_tax"];
							    	$reff = '&pound;'.$inv["reff_discount"];
							    	$ship = '&pound;'.$inv["total_shipping"];
							    	$finalprice = '&pound;'.$inv["total_price"];
							    	$spp = 10/100*$subtotal_wo;
							  	$dis_price = '&pound;'.round($subtotal_wo-$spp,2);
					    		    
							    }
							    elseif($curr == 'EUR') 
							    {
							    	$price = '&euro;'.$order["EURO_price"];
							    	$subtotal = '&euro;'.$order["EURO_price"]*$order["qty"];
							    	$subtotal_wo = $order["EURO_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = '&euro;'.$total_wo;
							    	$tax = '&euro;'.$inv["total_tax"];
							    	$reff = '&euro;'.$inv["reff_discount"];
							    	$ship = '&euro;'.$inv["total_shipping"];
							    	$finalprice = '&euro;'.$inv["total_price"];
							    	$spp = 10/100*$subtotal_wo;
							  	$dis_price = '&euro;'.round($subtotal_wo-$spp,2);
							    }

							    $sum_quantity += $order['qty'];
							   
								echo "
								<tr>
									<input type = 'hidden' name = 'prod_id[]' value = '".$order['id']."' />
									<input type = 'hidden' name = 'sub_total[]' value = '".$subtotal."' />
                                   
									<td>".$i."</td>
								<td class='item-name'>".$order["name"]."&nbsp(".$order["Vname"].")</td>
									<td>".$order["producthsn"]."</td>
						            <td>".$order["gstpercent"]."</td>
									<td>".$order["qty"]."</td>
									<td class = 'pri'>".$price."</td>
									<td class = 'total'>".$subtotal."</td>";
								/*	 if($inv['affiliate_id'] != '' ) { 
									     if($inv['affiliate_id'] != '47' && $inv['is_guest'] != 'yes') {
									echo "<td>".$dis_price."</td>";
									 } }    */

								echo "</tr>
								
								";
								$i++;
								}
							}
						?>
						
						<tr>
                            <td colspan="4"><strong>Shipping Charges</strong></td>
                            <td colspan="4" style="text-align:right;"><strong><?php echo $ship; ?></strong></td>
						</tr>
						<?php if($inv['reff_discount'] != ""){ ?>
						<tr>
                            <td colspan="4"><strong>Refferal Discount</strong></td>
                            <td colspan="4" style="text-align:right;"><strong><?php echo $reff; ?></strong></td>
						</tr>
						<?php } ?>

						<tr>
                            <td colspan="4"><strong>Total</strong></td>
                            <td><strong><?php echo $sum_quantity; ?> Pc</strong></td>
                            <td colspan="3" style="text-align:right;"><strong><?php echo $finalprice; ?></strong></td>
						</tr>

						<tr>
                          <td colspan="9">Amount Chargeable (in words)<br><strong><?php echo $curr .$converted.' only';?></strong></td>
						</tr>

						<tr>
                           <td colspan="4"><strong>Declaration:- <br><br>We declare that invoice shows the actual price of the goods described and that all partculars are true and correct. Total price is included all taxes.</strong></td>
                           <td></td>
                           <td colspan="3"><strong>For BISJ Exporters Pvt. Ltd.<br><br><br><br>Authorised Signatory</strong></td>
						</tr>
		</table>
		<p>This is a computer generated invoice</p>		
	</center>
	<br /><br /><br /><br />
	<center>
		<!--<button class="btn btn-success"></button>-->
		<button class="btn" onclick = "$('.btn').hide();window.print();$('.btn').show();">Print</button>
	</center>
	
</body>
</html>