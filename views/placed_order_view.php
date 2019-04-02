<h2 style="color : #5bb75b;">
	Your order is placed successfully. 	
</h2>
<p>
	Below are the details of your order.	
</p>
  <table class="table table-bordered">
		<tbody>
			<tr class="techSpecRow"><th colspan="100">Order Details</th></tr>
			<tr>
				<td>Shipping Address</td>
				<td colspan="10"><?php echo $shippingaddress; ?></td>
			</tr>
			<tr>
				<td>Shipping Area</td>
				<td colspan="10"><?php echo $shipping_area; ?></td>
			</tr>
			<tr>
				<td>Shipping PIN</td>
				<td colspan="10"><?php echo $shipping_PIN; ?></td>
			</tr>
			<tr>
				<td>Payment Method</td>
				<td colspan="10"><?php echo $payment_method; ?></td>
			</tr>
			<tr class="techSpecRow"><th colspan="100">Product Details</th></tr>
			<tr class="techSpecRow">
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Rate</th>
				<th>Total Price</th>
			</tr>
			<?php 
				$cart_data = unserialize($cart_data);
				$total = 0;
				foreach($cart_data as $items)
				{
					echo "<tr  class='techSpecRow'>";
					echo '<td class="techSpecTD1">'.$items["name"].'</td>';
					echo '<td class="techSpecTD2">'.$items["qty"].'</td>';
					echo '<td class="techSpecTD3">'.$items["price"].'</td>';
					echo '<td class="techSpecTD4">'.number_format($items["subtotal"]).'</td>';
					echo "</tr>";
					$total += floatval($items["subtotal"]);
				}
				echo "<tr  class='techSpecRow' style = 'font-size:22px;'>
					<td colspan = '3'><b style = 'float:right;'>Total</b></td>
					<td><b style = 'color : rgb(231,109,36);'>Rs. ".number_format($total)."/-</b></td>
					</tr>
				";
			?>
		</tbody>
	</table>
	<center>
		<a href="<?php echo COMPANYURL; ?>" role="button" style="padding-right:0">
			<input type="buttton" class="btn btn-large btn-success" value="Go Back">
		</a>
	</center>