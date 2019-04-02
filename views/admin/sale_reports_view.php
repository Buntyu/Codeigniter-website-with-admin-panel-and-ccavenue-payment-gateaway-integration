<?php 
//print_r($converted); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create simple website using codeigniter</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <!-- Latest compiled and minified Jquery library -->
        <script src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
 
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <style>
		body
		{
			color: #424341;
		}
		.item-name {
    	width: 25%;
		}
		.btn
		{
			font-size: 16px;
			padding: 5px;
		}
		.prt-btn
		{
		float:right;
		color: #0088cc !important;
		font-weight: 900;
		border: 1px solid !important;
		}
		.download-btn {
    		margin: 2% 0%;
		}
		.my-head {
		    text-align: center;
		    margin: 1%;
		}
		.invoice-logo {
    	 display: block; 
    		margin: auto;
			}
		table.detTab{
			width:70%;
		}

		@media print
		{    
		   @page { margin: 0; }
  body { margin: 1.6cm; }
		    .navbar, .breadcrumb, .main-menu-span, .well, .nav-collapse, .sidebar-nav, .bk-footer, .download-btn {
				display:none;
			}
		    .sales-report
		    {
		    width:100% !important;
		    }
		    #content, table.detTab {
    		width: 100%;
			}
		}
		
		.canClass {
color: #d40000;
font-size: 45px;
font-family: "Times New Roman", Times, serif;
border: 4px solid #d40000;
border-radius: 13px;
padding: 4%;
-webkit-transform: rotate(-25deg);
-moz-transform: rotate(-25deg);
-ms-transform: rotate(-25deg);
-o-transform: rotate(-25deg);
/* Internet Explorer */
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);
}
		
		@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
}
		
	</style>
</head>
     
<body>
<div class="download-btn">
<!--<button class="btn down-btn">--><a href="<?php echo base_url()?>admin/sales/excel"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Download Excel</a><!--</button>-->
<button class="btn prt-btn" onclick = "$('.btn').hide();window.print();$('.btn').show();">Print</button>
	
</div>
<?php
     if($month == '01'){ $m = "January"; } elseif($month == '02'){ $m = "February"; } elseif($month == '03'){ $m = "March"; } elseif($month == '04'){ $m = "April"; } elseif($month == '05'){ $m = "May"; } elseif($month == '06'){ $m = "June"; } elseif($month == '07'){ $m = "July"; } elseif($month == '08'){ $m = "August"; } elseif($month == '09'){ $m = "September"; } elseif($month == '10'){ $m = "October"; } elseif($month == '11'){ $m = "November"; } elseif($month == '12'){ $m = "December"; }
     
  ?>   
  <div class="sales-report">
<h2 class="my-head">Sales Report (<?php echo $m.'&nbsp'.$year; ?>)</h2>
	
     <?php for ($k=0;$k<count($converted);) { ?>
        <?php foreach ($invData as $row): ?>
        <div class="indv-report">
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
                		Customer name :- <?php echo $row['ship_name']; ?><br>
                		Shipping Address :- <?php echo $row["shipping_address"].'<br>'.$row["ship_city"].','.$row["ship_state"]; ?><br>
                		Shipping Pin :- <?php echo $row["shipping_pin"]; ?> <br>
                		Shipping Country :- <?php echo $row["ship_country"]; ?> <br>
                		Mobile :- <?php echo $row["ship_mobile"]; ?></strong></center>
                </td>
			</tr>

			<tr>
				<td colspan="2"><strong>Invoice No:</strong><br><?php echo $row["sales_id"];?></td>
				
				<!--<?php if($row['affiliate_id'] == '' ) { ?>
				<td colspan="3" rowspan="3"></td>
				<?php } else { ?>
				<td colspan="3" rowspan="3"><center><strong><h2>10% Refferal Discount</h2></strong></center></td>
				<?php } ?> -->
				
				<?php if($row['affiliate_id'] == '' && $row['or_status'] == "cancelled") { ?>
				<td colspan="3" rowspan="3"><h1 class="canClass">CANCELLED</h1></td>
				<?php } else if($row['affiliate_id'] == '47' && $row['is_guest'] == 'yes' && $row['or_status'] == "cancelled") { ?>
				<td colspan="3" rowspan="3"><h1 class="canClass">CANCELLED</h1></td>
				<?php } else { if ($row['or_status'] == "cancelled") { ?>
				<td colspan="3" rowspan="3"><center><strong><h2>10% Refferal Discount</h2></strong></center><h1 class="canClass">CANCELLED</h1></td>
				<?php } else { ?>
				<td colspan="3" rowspan="3"><center><strong><h2>10% Refferal Discount</h2></strong></center></td>
				<?php } } ?>
				<td colspan="3"><strong>Order ID:</strong><br><?php echo $row["order_uid"];?></td>
			</tr>

			<tr><?php if($row['payment_type'] == 'COD'){ ?>
			<td colspan="2"><strong>Payment Reference Number:</strong><br><?php echo $row["payment_ref_no"];?></td>
			<?php } else  { ?>
			<td colspan="2"><strong>Bank Reference Number:</strong><br><?php echo $row["bank_reff_no"];?></td>
			<?php } ?>
				
				<td colspan="3"><strong>Tracking ID:</strong><br><?php echo $row["tracking_id"];?></td>
				
			</tr>

			<tr>
				<td colspan="2"><strong>Order Date:</strong><br><?php echo $row["order_date"];?></td>
				<td colspan="3"><strong>Payment Received Date:</strong><br><?php echo $row["ccavenue_date"];?></td>
			</tr>

			<tr>
            <th>S No.</th>
            <th>Description of goods</th>
            <th>HSN/SAC</th>
            <th>GST %</th>
            <th>Quanity</th>
            <th>Rate</th>
            <th>Amount</th>
          <!--  <?php if($row['affiliate_id'] != '' ) { ?>
            <th>Dicounted Price</th>
             <?php } ?> -->
			</tr>

			<?php 
							$total = 0;
							$curr = $row["currency"];
							//echo $curr;
							$ssm = $row["cart_data"];
							
							//print_r($ssm);
							//$decoded = unserialize($row['cart_data']);
							//print_r($decoded);
							$c = count($row["cart_data"]);
							$sum_quantity = 0;
							for($i=1;$i<=$c;)
							    {
							foreach($row["cart_data"] as $order)
							{
							
							  if($curr == 'INR')
							    {
								$price = 'Rs.&nbsp'.$order["Vprice"];
								$subtotal = 'Rs.&nbsp'.$order["Vprice"]*$order["qty"];
								$subtotal_wo = $order["Vprice"]*$order["qty"];
								$total_wo += $subtotal_wo;
								$total = 'Rs.&nbsp'.$total_wo;
								$tax = 'Rs.&nbsp'.$row["total_tax"];
								$reff = 'Rs.&nbsp'.$row["reff_discount"];
								$ship = 'Rs.&nbsp'.$row["total_shipping"];
								$finalprice = 'Rs.&nbsp'.$row["total_price"];
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
							    	$tax = 'AU&nbsp$'.$row["total_tax"];
							    	$reff = 'AU&nbsp$'.$row["reff_discount"];
							    	$ship = 'AU&nbsp$'.$row["total_shipping"];
							    	$finalprice = 'AU&nbsp$'.$row["total_price"];
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
							    	$tax = 'US&nbsp$'.$row["total_tax"];
							    	$reff = 'US&nbsp$'.$row["reff_discount"];
							    	$ship = 'US&nbsp$'.$row["total_shipping"];
							    	$finalprice = 'US&nbsp$'.$row["total_price"];
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
							    	$tax = '&pound;'.$row["total_tax"];
							    	$reff = '&pound;'.$row["reff_discount"];
							    	$ship = '&pound;'.$row["total_shipping"];
							    	$finalprice = '&pound;'.$row["total_price"];
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
							    	$tax = '&euro;'.$row["total_tax"];
							    	$reff = '&euro;'.$row["reff_discount"];
							    	$ship = '&euro;'.$row["total_shipping"];
							    	$finalprice = '&euro;'.$row["total_price"];
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
								/*	if($row['affiliate_id'] != '' ) { 
									echo "<td>".$dis_price."</td>";	
									}  */

								echo "</tr>
								
								";
								$i++;
								}
								
							}

							//$wordformat = new NumberFormatter("en", NumberFormatter::SPELLOUT);
							//$inwords =  $wordformat->format($finalprice);
						?>
						
						<tr>
                            <td colspan="4"><strong>Shipping Charges</strong></td>
                            <td colspan="4" style="text-align:right;"><strong><?php echo $ship; ?></strong></td>
						</tr>
						<?php if($row['reff_discount'] != ""){ ?>
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
                          <td colspan="9">Amount Chargeable (in words)<br><strong><?php echo $curr .$converted[$k].' only';?></strong></td>
						</tr>

						<tr>
                           <td colspan="4"><strong>Declaration:- <br><br>We declare that invoice shows the actual price of the goods described and that all partculars are true and correct. Total price is included all taxes.</strong></td>
                           <td></td>
                           <td colspan="3"><strong>For BISJ Exporters Pvt. Ltd.<br><br><br><br>Authorised Signatory</strong></td>
						</tr>



			
		</table>
		<p>This is a computer generated invoice</p>		
	</center>
	
	
	</div> <!-- indv-report div closed -->
	<div class="page-break"></div>
	<?php 
	$k++;
	endforeach; 
	} ?>
	</div> <!-- sales-report div closed -->
	
</body>
</html>



