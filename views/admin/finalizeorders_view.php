<?php

	//echo "<pre>";print_r($orderData);die;
	//print_r($currency_list);die;
	$cur = $orderData['currency'];
	
	foreach ($currency_list as $key => $val) {
	       if ($val['curr_name'] == 'INR') {
	           $In = $key;    }
	       	   elseif($val['curr_name'] == 'AUD'){
	           $Au = $key;  }  
	           elseif($val['curr_name'] == 'USD'){
	           $Us = $key;  }  
	           elseif($val['curr_name'] == 'GBP'){
	           $Uk = $key;  }  
	           elseif($val['curr_name'] == 'EURO'){
	           $Eu = $key;  }  	
	           
	       
	   }
	 
	 if($cur == 'INR')
	 {
	 $comm1 = $orderData["total_price"]/100*10;
	 $comm2 = $comm1/100*10;
	 $tdscomm = $comm1-$comm2;
	 }
	 elseif($cur == 'AUD')
	 {
	 $InVal = $currency_list[$In]['curr_amount'];
	 $cVal = $currency_list[$Au]['curr_amount'];
	 $oVal = $orderData["total_price"];
	 $conversion_rate  = $cVal / $InVal;
	 $convert = round ($oVal/ $conversion_rate, 2);
	 $comm1 = $convert/100*10;
	 $comm2 = $comm1/100*10;
	 $tdscomm = $comm1-$comm2;
	 }
	 elseif($cur == 'USD')
	 {
	 $InVal = $currency_list[$In]['curr_amount'];
	 $cVal = $currency_list[$Us]['curr_amount'];
	 $oVal = $orderData["total_price"];
	 $conversion_rate  = $cVal / $InVal;
	 $convert = round ($oVal/ $conversion_rate, 2);
	 $comm1 = $convert/100*10;
	 $comm2 = $comm1/100*10;
	 $tdscomm = $comm1-$comm2;
	 }
	 elseif($cur == 'GBP')
	 {
	 $InVal = $currency_list[$In]['curr_amount'];
	 $cVal = $currency_list[$Uk]['curr_amount'];
	 $oVal = $orderData["total_price"];
	 $conversion_rate  = $cVal / $InVal;
	 $convert = round ($oVal/ $conversion_rate, 2);
	 $comm1 = $convert/100*10;
	 $comm2 = $comm1/100*10;
	 $tdscomm = $comm1-$comm2;
	 }
	 elseif($cur == 'EUR')
	 {
	 $InVal = $currency_list[$In]['curr_amount'];
	 $cVal = $currency_list[$Eu]['curr_amount'];
	 $oVal = $orderData["total_price"];
	 $conversion_rate  = $cVal / $InVal;
	 $convert = round ($oVal/ $conversion_rate, 2);
	 $comm1 = $convert/100*10;
	 $comm2 = $comm1/100*10;
	 $tdscomm = $comm1-$comm2;
	 }
	 



$jjk = serialize($orderData["cart_data"]);
$month = date("m");
$year = date("Y");

//print_r($jjk);die;
if($orderData["firstname"] == ""){
    $name = $orderData["billing_name"];
}else {
    $name = $orderData["firstname"];
}

if($orderData["is_guest"] == "Yes"){
    $gname = $orderData["billing_name"];
}else {
    $gname = "";
}

?>
<style>
#cartdata{display:none;}
.appbtn{float:right;margin-top:-5%;}
</style>
<form id = "final_order" action = "<?php echo base_url()."admin/sales/finalizedOrder" ?>" method="POST" >

<input type="hidden" name = "orderid" value = "<?php echo $orderData["order_id"]; ?>" />
<input type="hidden" name = "custid" value = "<?php echo $orderData["customer_id"]; ?>" />
<input type="hidden" name = "affid" value = "<?php echo $orderData["affiliate_id"]; ?>" />
<input type="hidden" name = "aff_comm" value = "<?php echo number_format((float)$tdscomm, 2, '.', ''); ?>" />
<input type="hidden" name = "comm_status" value = "pay" />
<input type="hidden" name = "order_mode" value = "<?php echo $orderData["payment_mode"]; ?>" />
<input type="hidden" name = "order_card" value = "<?php echo $orderData["card_name"]; ?>" />
<input type="hidden" name = "order_curr" value = "<?php echo $orderData["currency"]; ?>" />
<input type="hidden" name = "order_tax" value = "<?php echo $orderData["total_tax"]; ?>" />
<input type="hidden" name = "order_discount" value = "<?php echo $orderData["reff_discount"]; ?>" />
<input type="hidden" name = "order_ship" value = "<?php echo $orderData["total_shipping"]; ?>" />
<input type="hidden" name = "order_finalprice" value = "<?php echo $orderData["total_price"]; ?>" />
<input type="hidden" name = "sale_month" value = "<?php echo $month; ?>" />
<input type="hidden" name = "sale_year" value = "<?php echo $year; ?>" />
<input type="hidden" name = "sale_price" value = "<?php echo $orderData["sale_price"]; ?>" />
<input type="hidden" name = "is_guest" value = "<?php echo $orderData["is_guest"]; ?>" />
<input type="hidden" name = "payment_type" value = "<?php echo $orderData["payment_type"]; ?>" />
<input type="hidden" name = "gname" value = "<?php echo $gname; ?>" />


<textarea row="100" cols="100" name = "order_cartData" id ="cartdata"><?php print_r($jjk); ?></textarea>

<table class="table table-bordered">
	<tbody>
	    <tr>
			<th>
			<?php if($orderData['payment_type'] == 'COD'){ ?> COD payment Date <?php } else { ?>
				CCavenue payment Date <?php } ?>
			</th>
			<td colspan>
				<input type = "text" name="ccavenue_date" value = "<?php echo $orderData["ccavenue_date"]; ?>" placeholder=""/> <br>
				<small>DATE FORMAT: yyyy-mm-dd</small>
			</td>
			
			<th>
				Tracking ID
			</th>
			<td>
				<input type = "text"  name="tracking_id" value = "<?php echo $orderData["manual_tracking_id"]; ?>" /> 
			</td>
		</tr>
		
		<tr>
			<th>
				Order ID 
			</th>
			<td>
				<input type = "text"  disabled = "disabled" name="order_uid" value = "<?php echo $orderData["order_uid"]; ?>" /> 
			</td>
			
		<?php if($orderData['payment_type'] == 'COD'){ ?>

				<th>
				Payment Reff No. 
			</th>
			<td>
				<input type = "text" name="payment_ref_no" value = "<?php echo $orderData["payment_ref_no"]; ?>" /> 
			</td>

				<?php } else { ?>
			<th>
				Bank Reff No. 
			</th>
			<td>
				<input type = "text"  disabled = "disabled" name="bank_ref_no" value = "<?php echo $orderData["bank_ref_no"]; ?>" /> 
			</td>
		<?php } ?>
		</tr>


		<tr>
			<th>
				Order Date
			</th>
			<td>
				<input type = "text"  disabled = "disabled" name="date_time" value = "<?php echo $orderData["date_time"]; ?>" /> 
			</td>
			<th>
				Total Amount
			</th>
			<td>
				<input type = "text" disabled = "disabled" name = "order_amount" value = "<?php echo $orderData["total_price"]; ?>" />
			</td>
			
		</tr>


		<tr>	
			<th>
				Customer Name
			</th>
			<td colspan="3">
				<input type = "text" disabled = "disabled" name = "firstname" value = "<?php echo $name; ?>" />
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
				<input type = "text" name = "shipping_name" value = "<?php echo $orderData["shipping_name"]; ?>" />
			</td>
	    </tr>

		<tr>
			<th>
				Shipping Address
			</th>
			<td>
				<textarea name = "shippingaddress" id = "shippingaddress" style="width : 60%; height : 40px;">
					<?php echo $orderData["shippingaddress"]; ?>
				</textarea>
			</td>
			<th>
				Shipping City
			</th>
			<td>
				<input type = "text" name = "shipping_city" value = "<?php echo $orderData["shipping_city"]; ?>" />
			</td>
		</tr>

		<tr>
			<th>
				Shipping State
			</th>
			<td>
				<input type = "text" name = "shipping_state" value = "<?php echo $orderData["shipping_state"]; ?>" />
			</td>
			<th>
				Shipping Country
			</th>
			<td>
				<input type = "text" name = "shipping_country" value = "<?php echo $orderData["shipping_country"]; ?>" />
			</td>
		</tr>

		<tr>
			<th>
				Shipping PIN
			</th>
			<td>
				<input type = "text" name = "shipping_PIN" value = "<?php echo $orderData["shipping_PIN"]; ?>" />
			</td>
			<th>
				Shipping Contact No.
			</th>
			<td>
				<input type = "text" name = "shipping_mobile" value = "<?php echo $orderData["shipping_mobile"]; ?>" />
			</td>
		</tr>
		
		
       


       <tr><td colspan="4">
        <h3>Order Details </h3>
       </td></tr>

          <tr>
		<!--	<th>
				Orders
				<br /><br /><br /><br />
				<center>
					<a href="#" onclick="$('#addproductmodal').modal('show');return false;" class="btn btn-info btn-setting">Add Product</a>
				</center>
			</th>  -->
			<td colspan="4">
				<table class="table table-bordered">
					<tbody>
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
								Quantity
							</th>
							<th>
								Price
							</th>
							<th>
								Total
							</th>
						</tr>
						<?php 
							$total = 0;
							$curr = $orderData["currency"];
							//echo $curr;
							//print_r($orderData["cart_data"]);
							
							foreach($orderData["cart_data"] as $order)
							{
							
							  if($curr == 'INR')
							    {
								$price = 'Rs.&nbsp'.$order["Vprice"];
								$subtotal = 'Rs.&nbsp'.$order["Vprice"]*$order["qty"];
								$subtotal_wo = $order["Vprice"]*$order["qty"];
								$total_wo += $subtotal_wo;
								$total = 'Rs.&nbsp'.$total_wo;
								$tax = 'Rs.&nbsp'.$orderData["total_tax"];
								$reff = 'Rs.&nbsp'.$orderData["reff_discount"];
								$ship = 'Rs.&nbsp'.$orderData["total_shipping"];
								$finalprice = 'Rs.&nbsp'.$orderData["total_price"];
							    }
							    elseif($curr == 'AUD') 
							    {
							    	$price = 'AU&nbsp$'.$order["AUD_price"];
							    	$subtotal = 'AU&nbsp$'.$order["AUD_price"]*$order["qty"];
							    	$subtotal_wo = $order["AUD_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = 'AU&nbsp$'.$total_wo;
							    	$tax = 'AU&nbsp$'.$orderData["total_tax"];
							    	$reff = 'AU&nbsp$'.$orderData["reff_discount"];
							    	$ship = 'AU&nbsp$'.$orderData["total_shipping"];
							    	$finalprice = 'AU&nbsp$'.$orderData["total_price"];
							    }
							    elseif($curr == 'USD') 
							    {
							    	$price = 'US&nbsp$'.$order["USD_price"];
							    	$subtotal = 'US&nbsp$'.$order["USD_price"]*$order["qty"];
							    	$subtotal_wo = $order["USD_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = 'US&nbsp$'.$total_wo;
							    	$tax = 'US&nbsp$'.$orderData["total_tax"];
							    	$reff = 'US&nbsp$'.$orderData["reff_discount"];
							    	$ship = 'US&nbsp$'.$orderData["total_shipping"];
							    	$finalprice = 'US&nbsp$'.$orderData["total_price"];
							    }
							    elseif($curr == 'GBP') 
							    {
							    	$price = '&pound;'.$order["UK_price"];
							    	$subtotal = '&pound;'.$order["UK_price"]*$order["qty"];
							    	$subtotal_wo = $order["UK_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = '&pound;'.$total_wo;
							    	$tax = '&pound;'.$orderData["total_tax"];
							    	$reff = '&pound;'.$orderData["reff_discount"];
							    	$ship = '&pound;'.$orderData["total_shipping"];
							    	$finalprice = '&pound;'.$orderData["total_price"];
					    		    
							    }
							    elseif($curr == 'EUR') 
							    {
							    	$price = '&euro;'.$order["EURO_price"];
							    	$subtotal = '&euro;'.$order["EURO_price"]*$order["qty"];
							    	$subtotal_wo = $order["EURO_price"]*$order["qty"];
							    	$total_wo += $subtotal_wo;
							    	$total = '&euro;'.$total_wo;
							    	$tax = '&euro;'.$order["total_tax"];
							    	$reff = '&euro;'.$orderData["reff_discount"];
							    	$ship = '&euro;'.$orderData["total_shipping"];
							    	$finalprice = '&euro;'.$orderData["total_price"];
							    }
					    
					    
								echo "
								<tr>
									<input type = 'hidden' name = 'prod_id[]' value = '".$order['id']."' />
									<input type = 'hidden' name = 'sub_total[]' value = '".$subtotal."' />
									<td>".$order["name"]."&nbsp(".$order["Vname"].")</td>
									<td>".$order['producthsn']."</td>
									<td>".$order['gstpercent']."</td>
									<td>".$order["qty"]."</td>
									<td class = 'pri'>".$price."</td>
									<td class = 'total'>".$subtotal."</td>	

								</tr>
								
								";
								//$total += $order["subtotal"];	
							}
							echo "
							
								<tr>
									<td colspan = '5' style = ' font-size : 20px;'> Shipping Charges </td>
									<td class = 'sumtotal' colspan = '2' style = ' font-size : 20px;'>".$ship."</td>
								</tr>";
								if($orderData["reff_discount"] > 0) { 

							echo	"<tr>
									<td colspan = '5' style = ' font-size : 20px;'> Refferal Discount ( $affname ) </td>
									<td class = 'sumtotal' colspan = '2' style = ' font-size : 20px;'>".$reff."</td>
								</tr>";
							}

							echo	"<tr>
									<td colspan = '5' style = 'font-weight : bold; font-size : 20px;'> Total </td>
									<td class = 'sumtotal' colspan = '2' style = 'font-weight : bold; font-size : 20px;'>".$finalprice."</td>
								</tr>
								
							";
						?>
					</tbody>
				</table>
			</td>
		</tr>
<!--		<tr>
			<th>
				Delivered By
			</th>			
			<td>
				<select name = "delvby" id = "delvby">
					<option value = "">Select Delivery Boy</option>
					<?php 
						if($deliveryusers)
						{
							foreach($deliveryusers as $users)
							{
								echo "<option value = '".$users["admin_id"]."'>".$users["admin_name"]."</option>";
							}
						}
					?>
				</select>
			</td>   
		</tr>
		<tr>    
			<th>
				Vendors
			</th>			
			<td>
				<select name = "vendors[]" id = "vendors" multiple="multiple">					
					<?php 
						if($vendors)
						{
							foreach($vendors as $vendor)
							{
								echo "<option value = '".$vendor["vendor_id"]."'>".$vendor["vendor_name"]."</option>";
							}
						}
					?>
				</select>
				<p class="help-block">Press Ctrl to select multiple</p>
			</td>
		</tr>  -->
		
	</tbody>
</table>
</form>
<div>
    <form class="delfrom2" action="<?php echo base_url();?>admin/sales/deleteorder/" name="delform" method="GET">
	<input type="hidden" name="id" class = "product_idd" value="<?php echo $orderData["order_id"]; ?>">
	<input type="submit" id="delbtn" class="btn btn-large btn-danger" value="Delete Order">
	</form>
	<span class = 'btn btn-large btn-success appbtn' onclick = "submitOrder()" >Approve Order</span>
	<br /><br /><br />
	<!--<span class = 'btn btn-danger' onclick = "if(confirm('Are you sure you want to close this window? All your changes will be lost.'))window.close();">Close Window</span> -->
</div>

<div class="modal hide fade in" id="addproductmodal" style="display: none;">
	<!--<form action = "" method = "POST" class="form-horizontal" onsubmit="">-->	
		<input type="hidden" name="brands_count" value="" class="brands_count">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Add Product</h3>
			</div>
			<div class="modal-body form-horizontal">
				<div class="control-group">
							  <label class="control-label" for="typeahead">Product Name </label>
							  <div class="controls">
								<input type="text" class="typeahead input-large" id="product_name"  autocomplete="off" placeholder="Type Product Name" >
								<span class="btn btn-info" onclick = "viewprdDet()" >View Details</span>
							  </div>							  
				</div>								
				<div class="control-group">
					 <label class="control-label" for="typeahead">Quantity </label>
					  <div class="controls">
						<input type="text" class="input-small" style="width:20px;" id="quantity"  autocomplete="off" value = "1" >
					  </div>
				</div>
				<div class="control-group">
					<table class="table table-bordered" id = "prdfnd" style="display: none;">
						<tbody>
							<tr>
								<td colspan="2"><center><img id = "prdimg" src = "" /></center></td>
							</tr>
							<tr>								
								<th>
									Product Name
								</th>
								<td id = "prdnam">								
								</td>								
							</tr>
							<tr>
								<th>
									Product Price
								</th>
								<td id = "prdpri">								
								</td>
							</tr>
							<tr>
								<th>
									Discount Price
								</th>
								<td id = "discpri">								
								</td>
							</tr>
						</tbody>
					</table>
					<span id = "prdnfnd" style="color : red; text-align: center;display: none;">Product Not Found.</span>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<input type="button" id = "addtolist" value="Add to List" class="btn btn-primary">
			</div>
	</form>
</div>

<script>
	window.onclose = function(e)
	{
		alert("All your changes will be lost");
	}
	var g_products = new Array();
	var g_product_names = new Array();
	<?php 
		echo "g_products = '".addslashes(json_encode($product_list))."';g_products = JSON.parse(g_products);";
	?>	
	$(document).ready(function()
	{
		$("select").trigger("change");
		$(".minusqty,.plusqty,.prod_qty").live
			(
				"click keyup",
				function()
				{
					var oParent = $(this).closest("tr");
					var qty = oParent.find(".prod_qty").val();
					if($(this).hasClass("minusqty"))
					{
						qty--;
					}
					if($(this).hasClass("plusqty"))
					{
						qty++;
					}
					if(isNaN(qty) || qty <= 0 )qty = 1;
					oParent.find(".prod_qty").val(qty);		
					oParent.find(".total").html(parseInt(qty) * parseFloat(oParent.find('.pri').html()));
					calcTotal();
				}
			);
			for(i=0; i<g_products.length; i++)
			{
				g_product_names[i] = g_products[i].product_name;
			}
			$("#product_name").typeahead({source:g_product_names});	
			$("#addtolist").live("click",function(){additemtolist();})
					
	})
	
	function additemtolist()
	{
		var product_name = $("#product_name").val();
		var quantity = $("#quantity").val();
		if(product_name == "")
		{
			alert("Please enter Product Name");
			$("#product_name").focus();
			return false;
		}
		if(isNaN(quantity) || quantity < 1)
		{
			alert("Please enter correct Quantity");
			$("#quantity").val("1");
			$("#quantity").focus();
			return false;
		}
		var found = false;		
		for(i=0; i<g_products.length; i++)
		{
			if(g_products[i].product_name == product_name)
			{
				found = true;
				var price = (g_products[i].discount_status == "1") ? g_products[i].discount_price : g_products[i].product_price;
				var strHtml = '<tr>'
   							+'		<input type="hidden" name="prod_id[]" value="'+g_products[i].product_id+'">'
							+'		<td>'+g_products[i].product_name+'</td>'
							+'		<td class="pri">'+price+'</td>'
							+'		<td>'
							+'			<div class="input-append">'
							+'				<input class="span1 prod_qty" name = quantity[] style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text" value="'+quantity+'">'
							+'				<button class="btn minusqty" type="button"><i class="icon-minus"></i></button>'
							+'				<button class="btn plusqty" type="button"><i class="icon-plus"></i></button>'
							+'				<button class="btn btn-danger remove_prod show-tooltip" data-rel="tooltip" type="button" data-original-title="Remove Product" onclick="removeProduct(this)"><i class="icon-remove icon-white"></i></button>'
							+'			</div>'
							+'		</td>'
							+'		<td class="total">'+(quantity*parseFloat(price))+'</td>'
							+'	</tr>';
				$(".prod_head").after(strHtml);
				$("#addproductmodal").modal("hide");
				calcTotal();				
			}
		}
		if(found == false)
		{
			alert("Product Not Found");
			$("#product_name").val("");
			$("#product_name").focus();
			return false;
		}
	}
	
	
	function viewprdDet()
	{
	//	debugger;
		$("#prdnfnd").hide();
		$("#prdfnd").hide();		
		var name = $("#product_name").val();
		var fnd = false;
		for(i=0; i< g_products.length;i++)
		{
			if(g_products[i].product_name == name)
			{
				fnd = true;
				$("#prdfnd").show();				
				$("#prdimg").attr("src",g_products[i].product_image);
				$("#prdnam").html(g_products[i].product_name);
				$("#prdpri").html(g_products[i].product_price);
				if(g_products[i].discount_status == "1")
				{
					$("#discpri").html(g_products[i].discount_price);
				}
				else
				{
					$("#discpri").html("N/A");
				}
			}
		}
		if(fnd == false)
		{
			$("#prdnfnd").show();
		}
	}
	
	function submitOrder()
	{
		if($("#delvby").val() == "" || $("#shippingaddress").val() == "")
		{
			return false;
		}
		else
		{
			$("input").removeAttr("disabled");
			$("#final_order").submit();
		}				
	}
	
	function calcTotal()
	{
		var sum = 0;
		$(".total").each(function(){sum += parseInt($(this).html())});
		$(".sumtotal").html(sum);
	}
	
	function removeProduct(oDiv)
	{
		$(".tooltip").remove();
		$(oDiv).closest("tr").remove();
		calcTotal();
	}
</script>