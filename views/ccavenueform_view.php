<html>
<head>
<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
		 document.forms['customerData'].submit();
	};
</script>
</head>
<body>

<div id="mainBody">
<div class = "span12" id = "disp-alert"></div>

	<div class="container">
		<div class="row">
		   <div class="row-below">
		   
	<form method="post" name="customerData" action="<?php echo base_url()."request/sendRequest"; ?>" accept-charset="ISO-8859-1">
		
				
				<input type="hidden" name="tid" id="tid" readonly />
				<input type="hidden" name="merchant_id" value="598" readonly />
				<input type="hidden" name="order_id" value="<?php echo $order_UID; ?>"/>
				<input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>"/>
				<input type="hidden" name="affiliate_id" value="<?php echo $affiliate_id; ?>"/>
				<input type="hidden" name="amount" value="<?php echo $order_amount; ?>"/>
			<!--	<input type="hidden" name="amount" value="<?php echo "1"; ?>"/>-->
				<input type="hidden" name="currency" value="<?php echo $currency; ?>"/>
				<input type="hidden" name="redirect_url" value="<?php echo base_url()."request/getResponse"; ?>"/>
				<input type="hidden" name="cancel_url" value="<?php echo base_url()."request/getResponse"; ?>"/>
				<input type="hidden" name="billing_name" value="<?php echo $customer_name; ?>"/>
				<input type="hidden" name="billing_address" value="<?php echo $customer_address; ?>"/>
				<input type="hidden" name="billing_city" value="<?php echo $customer_city; ?>"/>
				<input type="hidden" name="billing_state" value="<?php echo $customer_state; ?>"/>
				<input type="hidden" name="billing_zip" value="<?php echo $customer_pin; ?>"/>
				<input type="hidden" name="billing_country" value="<?php echo $customer_country; ?>"/>
				<input type="hidden" name="billing_tel" value="<?php echo $customer_mobile; ?>"/>
				
				<input type="hidden" name="delivery_name" value="<?php echo $shipping_name; ?>"/>
				<input type="hidden" name="delivery_address" value="<?php echo $shipping_address; ?>"/>
				<input type="hidden" name="delivery_city" value="<?php echo $shipping_city; ?>"/>
				<input type="hidden" name="delivery_state" value="<?php echo $shipping_state; ?>"/>
				<input type="hidden" name="delivery_zip" value="<?php echo $shipping_pin; ?>"/>
				<input type="hidden" name="delivery_country" value="<?php echo $shipping_country; ?>"/>
				<input type="hidden" name="delivery_tel" value="<?php echo $shipping_mobile; ?>"/>
				
				<input type="hidden" name="billing_email" value="<?php echo $customer_email; ?>"/>
				<input type="hidden" name="merchant_param2" value="<?php echo $customer_id; ?>"/>
				<input type="hidden" name="merchant_param3" value="<?php echo $affiliate_id; ?>"/>
				
				
				
		        <!--    <?php echo $cart_data; ?>
		        <INPUT TYPE="submit" value="CheckOut">  -->
	      	
	      </form>
	      </div>
		</div>
		</div>
		</div>
	</body>
</html>


