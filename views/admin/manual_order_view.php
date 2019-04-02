<form action="<?php echo base_url().'admin/sales/submanualOrder' ?>" name="manual_save" method="post">
<table class="table table-bordered">
<tr>
	<th>Payment Type</th><td><select name="payment_type"><option value="COD">COD</option><option value="ccavenue">CcAvenue</option></select></td>

	<th>Payment Date</th><td><input type = "text" name="ccavenue_date" value = ""/> <br><small>DATE FORMAT: yyyy-mm-dd</small></td>
</tr>
<tr>
	<th>Tracking ID</th><td><input type = "text" name="tracking_id" value = ""/></td>
	<th>Payment Reff No.</th><td><input type = "text" name="payment_ref_no" value = "" /></td> 
</tr>
<tr>
	<th>Currency</th><td><select name="currency">
		<option value="INR">INR</option>
	<!--	<option value="AUD">AUD</option>
		<option value="USD">USD</option>
		<option value="Pound">Pound</option>
		<option value="Euro">Euro</option>   -->
	</select></td>
	<th>Affiliate code</th><td><input type ="text" name="affiliate_code" value = "" /></td>
</tr>

<tr><td colspan="4"><h3 style="color: green;">Billing Details </h3></td></tr>

       <tr>
            <th>Billing Name</th>
			<td>
				<input type = "text" name = "billing_name" id="billing_name" value = "" />
			</td>
			<th>Billing Email</th>
			<td>
				<input type = "text" name = "billing_email" id="billing_email" value = "" />
			</td>
	    </tr>

		<tr>
			<th>Billing Address</th>
			<td>
				<textarea name = "billing_address" id = "billing_address" style="width : 60%; height : 40px;">
				</textarea>
			</td>
			<th>Billing City</th>
			<td>
				<input type = "text" name = "billing_city" id="billing_city" value = "" />
			</td>
		</tr>

		<tr>
			<th>Billing State</th>
			<td>
				<input type = "text" name = "billing_state" id="billing_state" value = "" />
			</td>
			<th>Billing Country</th>
			<td>
				<input type = "text" name = "billing_country" id="billing_country" value = "" />
			</td>
		</tr>

		<tr>
			<th>Billing PIN</th>
			<td>
				<input type = "text" name = "billing_zip" id="billing_zip" value = "" />
			</td>
			<th>Billing Contact No.</th>
			<td>
				<input type = "text" name = "billing_tel" id="billing_tel" value = "" />
			</td>
		</tr>

<tr><td><h3 style="color: green;">Shipping Details </h3></td>
<td colspan="3"><input type="checkbox" id="ship-checkbox">Same as Billing Address</td></tr>

       <tr>
            <th>Shipping Name</th>
			<td colspan="4">
				<input type = "text" name = "shipping_name" id="shipping_name" value = "" />
			</td>
	    </tr>

		<tr>
			<th>Shipping Address</th>
			<td>
				<textarea name = "shippingaddress" id = "shippingaddress" style="width : 60%; height : 40px;">
				</textarea>
			</td>
			<th>Shipping City</th>
			<td>
				<input type = "text" name = "shipping_city" id="shipping_city" value = "" />
			</td>
		</tr>

		<tr>
			<th>Shipping State</th>
			<td>
				<input type = "text" name = "shipping_state" id="shipping_state" value = "" />
			</td>
			<th>Shipping Country</th>
			<td>
				<input type = "text" name = "shipping_country" id="shipping_country" value = "" />
			</td>
		</tr>

		<tr>
			<th>Shipping PIN</th>
			<td>
				<input type = "text" name = "shipping_PIN" id="shipping_PIN" value = "" />
			</td>
			<th>Shipping Contact No.</th>
			<td>
				<input type = "text" name = "shipping_mobile" id="shipping_mobile" value = "" />
			</td>
		</tr>

<tr><td colspan="4"><h3 style="color: green;">Order Details </h3></td></tr>

		<tr>
			<th>Shipping Charges</th>
			<td>
				<input type = "text" name = "shipping_charges" class="shipping_charges" value="0"/>
			</td>
			<th></th>
			<td>
				
			</td>
		</tr>

<tr><td colspan="4"><h3 style="color: green;">Product Details </h3></td></tr>	

	<table class="table table-bordered" id="subtable">
	<tr><th>Product Name </th><th>Variation Name </th><th>HSN </th><th>GST % </th>
	<!--	<th>Discount % </th> --><th>Quantity</th>	<th>Price</th><th>Delete</th></tr>
	<tr>
	<td><input type="text" name="products[0][name]"></td>	
	<td><input type="text" name="products[0][Vname]"></td>	
	<td><input type="text" name="products[0][producthsn]" id="inp70"></td>
	<td><input type="text" name="products[0][gstpercent]" id="inp40"></td>
<!--	<td><input type="text" name="products[0][reffpercent]" id="inp40"></td>	 -->
	<td><input type="number" name="products[0][qty]" id="inp40"></td>
	<td><input type="text" name="products[0][price]" id="inp40" class="n-price"></td>
	<td class="hide-td"><input type="hidden" name="products[0][Vprice]" id="inp40" class="v-price"></td>
	<td><button type="button" class="btn btn-danger delete-row">X</button></td>
	</tr>

	</table>

	<tr><td colspan="4"><button type="button" class="btn btn-success add-row">ADD PRODUCT</button></td></tr>

</table>

<input type="submit" value="SUBMIT">
</form>

<style>input#inp40 {width: 40px;}input#inp70 {width: 70px;}.hide-td{display: none;}</style>

<script>
$(document).ready(function(){
var j = 0;
$('.add-row').click(function(){
	j++;
	new_row="<tr><td><input type='text' name='products["+j+"][name]'></td><td><input type='text' name='products["+j+"][Vname]'></td><td><input type='text' name='products["+j+"][producthsn]' id='inp70'></td><td><input type='text' name='products["+j+"][gstpercent]' id='inp40'></td><td><input type='number' name='products["+j+"][qty]' id='inp40'></td><td><input type='text' name='products["+j+"][price]' id='inp40' class='n-price'></td><td class='hide-td'><input type='hidden' name='products["+j+"][Vprice]' id='inp40' class='v-price'></td><td><button type='button' class='btn btn-danger delete-row'>X</button></td></tr>";
     
    $("#subtable").append(new_row);
    //alert("success");
    return false;
});

$( ".delete-row" ).live( "click", function() {
		$(this).closest('tr').remove();
});

/*     Code to set shipping details as billing details when checkbox is checked */

$('#ship-checkbox').click(function(){
if ($('#ship-checkbox').is(":checked")){
  $('#shipping_name').val($('#billing_name').val());
  $('#shippingaddress').val($('#billing_address').val());
  $('#shipping_city').val($('#billing_city').val());
  $('#shipping_state').val($('#billing_state').val());
  $('#shipping_country').val($('#billing_country').val());
  $('#shipping_PIN').val($('#billing_zip').val());
  $('#shipping_mobile').val($('#billing_tel').val());
}
else {
  $('#shipping_name').val('');
  $('#shippingaddress').val('');
  $('#shipping_city').val('');
  $('#shipping_state').val('');
  $('#shipping_country').val('');
  $('#shipping_PIN').val('');
  $('#shipping_mobile').val('');
}
});	
/*   End of the code    */

/* 	 code to set price and vprice fields the same      */
$(".n-price").live("keyup", function(){
$(this).closest('tr').find('input.v-price').val($(this).val());
});
/*   End of the code   */

});
</script>