<?php include ("fetchdata.php"); ?>
<?php
if(empty($cartData))
redirect(base_url(),"refresh");

?>
<script>
  fbq('track', 'AddToCart');
</script>
<div id="mainBody">


	<div class="container">
		<div class="row">
		   <div class="row-below">


    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
    <div class = "span12" id = "disp-alert"></div> 
    <div class="cart-head-container">
    <div class="cart-head span4">
	<h1 style="font-size:24px;">  SHOPPING CART [ <small><span class = "prodcnt"><?php echo count($cartData["productData"]); ?></span> Item(s) </small>]</h1></div>
	<div class="cart-image span8"><a href='<?php echo base_url(); ?>International_shipping_charges'><img src="<?php echo base_url(); ?>images/BISJ-Shipping-Rate-Banner.jpg"></a></div>
	</div> <!-- cart head container div closed -->	
	<hr class="soft"/>
<!--	<table class="table table-bordered">
		<tr>
			<th style="text-align: center;"> <span>I AM ALREADY REGISTERED  </span></th>
		</tr>	
		<tr>
			<td style="text-align: center;">
					<a href="#login" role="button" data-toggle="modal" class="btn">Sign in</a><br /> OR <br /><a href="<?php //echo base_url(); ?>register" class="btn">Register Now!</a>
		  </td>
		</tr>
	</table>-->		
	<?php 
//echo "<pre>";print_r($cartData);die;
//s	echo $postValue;die;
	

	?>
	<div class="span9">		
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Product Name</th>
				  <th>Rate</th>
           <!--       <th>Discount Price</th>
<td  class = "disc_price">';
						echo ($products['discount_status'] == "1")? $products['discount_price'] : "&ndash;";					
						echo	  '</td> 
            
                  <th>GST %</th>
                  <th>GST</th> 
                  <th>CST</th>    -->  
                  <th>Quantity/Update</th>

                  <th>Total</th>
				</tr>
              </thead>
              <tbody>
			  	<?php
					foreach($cartData["productData"] as $products)
					{
						$gst = $products['gst_amount'];
						$price = $products['totalprice']+$gst;
						 $CountryCode = $this->session->userdata('sessiontest');
						



						echo ' <tr prod = "'.$products["row_id"].'" style = "position:relative;">
				                  <td> <img width="70" src="'.$products['product_image'].'" alt=""/></td>
				                  <td><a  href="'.base_url().'product/'.addhyphens($products['product_name']).'">'.$products['product_name'].'&nbsp('.$products['Vname'].')'.'</a></td>
								  <td class = "prod_price">'.$products['product_price'].'</td>
							<!--	  <td class = "gst_percent">'.$products['gst_percent'].'%'.'</td>
								  <td class = "gst_amount">'.$gst.'</td>
								  <td class = "cst_amount">'.$gst.'</td>  -->

				                 

				                  <td>
									<center>
									<div class="input-append"><input class="span1 prod_qty" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text" value = "'.$products['quantity'].'" readonly>
										<button class="btn minusqty" type="button"><i class="icon-minus"></i></button>
										<button class="btn plusqty" type="button"><i class="icon-plus"></i></button>
									<!--	<button class="btn btn-info savechg show-tooltip" title = "Save Changes"  data-rel="tooltip" type="button"><i class="icon-ok"></i></button> -->
													</div>
										
									</center>
								  </td> ';
						
						echo	  '<td class = "prod_tot_price">'.$products['totalprice'].'</td>
						           <td><button class="btn btn-danger remove_prod show-tooltip" title = "Remove Product"  data-rel="tooltip" type="button"  link = "'.base_url().'checkout/removeItem/'.$products['row_id'].'"><i class="icon-remove icon-white"></i></button>	</td>
          

				                </tr>';
					}
				//	echo $cartData["prod_weight"];
				//	echo $cartData["productCount"];

				?>
                
				</tbody>
            </table>
             </div> <!-- first span9 closed -->
            
             <div class="span3">
	<div class="fine-details">
                <p><strong>Total Price:
                  <span class = "tot_price"> <?php echo $cartData["totalprice"]; ?></span></strong> </p>
               <!--   <p>Total Tax:
                  <span class = "tot_gst_price"> <?php echo $cartData["totalgst"]; ?></span> </p>  
                  <p><strong>TOTAL:
                  <span class = "gross_price"> <?php echo $cartData["totalprice"]; ?></span> </strong></p><br> -->

            </div>
    </div>
            
 <div class="span12 arroy-nav">
	<a href="<?php echo base_url()."product"; ?>" class="btn btn-medium btn-success"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<a href="<?php echo base_url()."login"; ?>" class="btn btn-medium btn-success pull-right">Checkout <i class="icon-arrow-right"></i></a>
	</div>
	<div id = "product-save">
		<center>
			<div id = "prod-save-text">
				<img src = "<?php echo base_url().'images/preloader.gif'; ?>" />
				<span>Please wait, while we save your changes.</span>
			</div>
		</center>
	</div>
	
	</div>
	</div>
	</div>
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
			padding : 15% 2%;
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
		
		@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
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
		position: absolute;
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
	td:nth-of-type(1):before { content: ""; }
	td:nth-of-type(2):before { content: ""; }
	td:nth-of-type(3):before { content: "Rate"; }
	
	td:nth-of-type(4):before { content: ""; }
	td:nth-of-type(5):before { content: "Total"; }
	
	
}
		
	</style>
<script>
	var g_trParent="";var g_rem_tr
	$(document).ready
	(
		function()
		{
			$(".remove_prod").live
			(
				"click",
				function()
				{
					var rem_link = $(this).attr("link");
					g_rem_tr = $(this).closest("tr");
					$("#product-save").show();
					$.ajax
					(
						{
							url : rem_link,
							success:function(data)
							{
								try
								{
									var response = JSON.parse(data);
								}
								catch(e)
								{
									window.location.href = window.location.href;
								}
								if(response.status == "success")
								{
									if(response.productData.length == 0)
									{
										window.location.href = base_url();
									}
									g_rem_tr.remove();
									$(".tot_price").html(response.totalprice);
									$(".tot_gst_price").html(response.totalgst);
									$(".tot_disc_price").html(response.totaldiscount);
									$(".gross_price").html(response.grossprice);
									$(".prodcnt").html(response.productData.length);
									$("#product-save").hide();									
								}								
							}
						}
					);
				}
			);
			// 
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

				}
			);
			$(".plusqty, .minusqty").live
			(
				"click",
				function()
				{
					g_trParent = $(this).closest("tr");	
					$("#product-save").show();
					var qty = g_trParent.find(".prod_qty").val();
					if(isNaN(qty))qty = 1;
					var update_url = base_url()+"cart/updateQuantity/"+g_trParent.attr("prod")+"/"+qty+"/1";
					$.ajax
					(
						{
							url : update_url,
							success : function(data)
							{
								try
								{
									var response = JSON.parse(data);
								}
								catch(e)
								{
									window.location.href = window.location.href;
								}
								var row = g_trParent.attr("prod");
								for (i in response.productData)
								{
									if(row == response.productData[i].row_id)
									{
										g_trParent.find(".product_price").html(response.productData[i].product_price);
										
										if(response.productData[i].discount_status == "1")
										{
											g_trParent.find(".disc_price").html(response.productData[i].discount_price);
										}
										else
										{
											g_trParent.find(".disc_price").html("&ndash;");
										}
                          

										g_trParent.find(".prod_tot_price").html(response.productData[i].totalprice);
									}
								}
								$(".tot_price").html(response.totalprice);
								$(".tot_gst_price").html(response.totalgst);
								$(".tot_disc_price").html(response.totaldiscount);
								
								
								$(".gross_price").html(response.grossprice);
								$("#product-save").hide();
							}
						}
					);
				}	
			);





		}
	);
</script>

