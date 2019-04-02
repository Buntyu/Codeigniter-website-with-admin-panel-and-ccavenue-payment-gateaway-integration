			<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Product Name</th>
				  <th>Rate</th>
                  <th>GST %</th>
                  <th>GST</th> 
                  <th>CST</th>      
                  <th>Quantity</th>

                  <th>Total</th>
				</tr>
              </thead>
              <tbody>
			  	<?php
					foreach($cartData["productData"] as $products)
					{
						$gst = $products['gst_amount'];
						$price = $products['totalprice']+$gst;
						
                         echo ' <tr prod = "'.$products["row_id"].'" style = "position:relative;">
				                  <td> <img width="60" src="'.$products['product_image'].'" alt=""/></td>
				                  <td>'.$products['product_name'].'</td>
								  <td class = "prod_price">'.$products['product_price'].'</td>
								  <td class = "gst_percent">'.$products['gst_percent'].'%'.'</td>
								  <td class = "gst_amount">'.$gst.'</td>
								  <td class = "cst_amount">'.$gst.'</td>
                                  <td class="prod_quantity">'.$products['quantity'].' </td>';
						
						echo	  '<td class = "prod_tot_price">'.$products['totalprice'].'</td>
                             </tr>';
					}

				?>
                <tr>
                  <td colspan="7" style="text-align:right">Total Price:	</td>
                  <td class = "tot_price"> <?php echo $cartData["totalprice"]; ?></td>
                </tr>

                <tr>
                  <td colspan="7" style="text-align:right">Total Tax:	</td>
                  <td class = "tot_gst_price"> <?php echo $cartData["totalgst"]; ?></td>
                </tr>

                <tr>
               
                  <td colspan="7" style="text-align:right">Coupon Discount:	</td>
                  <td class = "tot_coup_disc"> <?php echo $cartData["totalCoup"]; ?></td>

                </tr>
         <!--       <tr>
               
                  <td colspan="7" style="text-align:right">Shipping Amount:	</td>
                  <td class = "shipp_amt"> <?php echo $cartData["prod_weight"]; ?></td>

                </tr>   -->
				 <tr>
                  <td colspan="7" style="text-align:right"><strong>TOTAL (<span  class = "tot_price"><?php echo $cartData["totalprice"]; ?></span> + <span class = "tot_gst_price"><?php echo $cartData["totalgst"]; ?></span> - <span class = "tot_coup_disc"><?php echo $cartData["totalCoup"]; ?></span>) =</strong></td>
                  <td class="label label-important" style="display:block"> <strong  class = "gross_price" style="font-size: 20px;">  <?php echo $cartData["grossprice"]; ?></strong></td>
                </tr>
				</tbody>
            </table>

	<div id = "product-save">
		<center>
			<div id = "prod-save-text">
				<img src = "<?php echo base_url().'images/preloader.gif'; ?>" />
				<span>Please wait, while we save your changes.</span>
			</div>
		</center>
	</div>
	<style>
	.table.table-bordered * 
	{
		text-align: center;
	}
		#product-save
		{
			position : fixed;
			top : 0px;
			left : 0px;
			width : 100%;
			height : 100%;
			background-color : rgba(121, 121, 121, 0.53);			
			display: none;
			z-index: 100000;
			padding : 15px;
		}
		#prod-save-text
		{
			background-color : white;
			font-weight: bold;
			font-size:14px;	
			width : 30%;
			padding: 20px;
			border-radius: 15px;
			-webkit-box-shadow:0px 2px 18px rgba(70, 73, 87, 1);
			-moz-box-shadow:0px 2px 18px rgba(70, 73, 87, 1);
			box-shadow:0px 2px 18px rgba(70, 73, 87, 1);			
		}
		.shipping_rates
		{
			display:none;
		}
	</style>


