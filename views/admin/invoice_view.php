<?php
//echo "<pre>";print_r($invoices);die;
?>
<?php  
	$theme_link =  base_url()."theme_back/";	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo isset($title)?$title: COMPANYNAME; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Ibad Gore">
	<link href="<?php echo $theme_link; ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<script src="<?php echo $theme_link; ?>js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo $theme_link; ?>js/jquery-ui-1.8.21.custom.min.js"></script>
<style>
body
{
	text-align: left;
	color : #3A3A3A;
	background-color: rgb(248, 248, 248);
}
table
{
	border-collapse: collapse;
}
#invoiceTable th, #invoiceTable td 
{
	vertical-align: top;
	font-size: 15px;
	padding : 0px 20px;
	text-align: left;
}
#invoiceTable th
{
	font-size: 17px;
}
#item-table
{
	
}

#item-table th
{
	text-align: center;
	padding : 5px;
}
#item-table td
{
	padding : 5px;
	text-align: center;
}
#each-item tbody tr:nth-child(even)
{
	background-color: #eee;
}
#each-item tbody tr:nth-child(odd)
{
	background-color: white;
}
#each-item th, #each-item td
{
	border-top-color: transparent;
	border-bottom-color: transparent;
	padding: 15px 5px; 
}
#each-item
{
	border-color: #FAFAFA;
}
#each-item thead
{
	background-color: #C7C7C7;
}
.normalText
{
	font-size: 16px;
	font-weight: 100;
}
#vendor-table td, #vendor-table th 
{
	padding: 10px 10px;
	text-align: center;
}
</style>
</head>
<body>
<center>
	<h1><u>Purchase Invoice</u></h1>
<table id = "invoiceTable" cellpadding="0" cellspacing="0" border="0" style="border-color: #CECECE;">
	<tr>
		<th>Purchased By :  <span class = "normalText"><?php echo $invoices["purchaser"]; ?></span></th>
		<th>Purchased&nbsp;Date  : <span class = "normalText"><?php echo $invoices["purchase_date"]; ?></span></th>		
	</tr>	
	<tr>
		<td colspan="10">
			<strong style = "text-align:left;font-weight: bold;font-size : 20px;">
				Invoice Items
			</strong>
			<table cellpadding="0" cellspacing="0" border = "0" id = "item-table" >
				<tr>
				<td colspan="2" style="padding: 0px;">
					<table cellpadding="0" cellspacing="0" border = "1"  id = "each-item">
						<thead>
						<tr>
							<th>Product Name </th>
							<th>Quantity </th>
							<th>Purchase Rate </th>
							<th>Total Cost of Purchase </th>
							<th>Date of Purchase </th>
							<th>MRP/Selling Price </th>
							<th>Item Margin </th>
							<th>Vendor Name </th>
						</tr>	
						</thead>
						<tbody>
					<?php
						foreach($invoices['invoiceitems'] as $items)
						{												
							echo "
								<tr>
								<td>
									".$products[$items["product_id"]]["product_name"]."
								</td>						
								<td>
									".$items["quantity"]."
								</td>
								<td>
									".number_format($items["purchase_rate"])."
								</td>
								<td>
									".number_format($items["total_purchase_rate"])."
								</td>
								<td>
									".$items["item_purchase_date"]."
								</td>
								<td>
									".number_format($items["mrp_item"])."
								</td>
								<td>
									".number_format($items["item_margin"])."
								</td>
							";
							foreach($invoices["vendor_name"] as $vendor)
							{
								if($vendor["vendor_id"] == $items["vendor_id"])
								{
									echo "<td>
									".$vendor["vendor_name"]."
								</td>";
								break;		
								}
							}
							echo "</tr>";
						}
					?>	
					</tbody>		
				</table>
			</td>
			</tr>	
			<tr>
				<th style="text-align: left;">
					Total Purchase Cost  : <span class = "normalText"><?php echo $invoices["total_purchase_cost"]."/-"; ?></span>
				</th>
			</tr>
			<tr>
				<th style="text-align: left;">
					Total Transportation Cost : <span class = "normalText"><?php echo $invoices["transportation_cost"]."/-"; ?></span>
				</th>
			</tr>
			<tr>
				<th style="text-align: left;">
					Total MRP/Selling Price : <span class = "normalText"><?php echo $invoices["total_mrp"]."/-"; ?></span>
				</th>
			</tr>
			<tr>
				<th style="text-align: left;">
					Total Estimated Margin : <span class = "normalText"><?php echo $invoices["total_margin"]."/-"; ?></span>
				</th>
			</tr>	
			</table>
			
			
			<tr>
				<td colspan="100" style="padding: 0px !important;">
					<div style = "height:0px;width : 100%;border : 1px dotted #464646;"></div>
				</td>
			</tr>
			
			<tr>
				<td colspan="100" style="height : 10px;"></td>
			</tr>	
		</td>
	</tr>
	<tr>
		<td colspan="100">
			<strong style = "text-align:left;font-weight: bold;font-size : 18px;">
				Vendor's Details : 
			</strong>
			<table  cellpadding="0" cellspacing="0" border="0" id = "vendor-table">
				<thead>
					<tr>
						<th>Vendor's Name</th>
						<th>Vendor's Area</th>
						<th>Vendor's PIN</th>
						<th>Vendor's Mobile</th>
						<th>Vendor's Phone</th>
						<th>Vendor's E-mail</th>
					</tr>
				</thead>
				<tbody>
			<?php
				$cnt = 1;
				foreach($invoices["vendor_name"] as $vendor)	
				{
					echo "<tr>";
					echo "
							<td>
								".$vendor["vendor_name"]."
							</td>
							<td>
								".$vendor["vendor_area"]."
							</td>
							<td>
								".$vendor["vendor_pin"]."
							</td>
							<td>
								".$vendor["vendor_mobile"]."
							</td>
							<td>
								".$vendor["vendor_phone"]."
							</td>
							<td>
								".$vendor["vendor_email"]."
							</td>
							";
					echo "</tr>";
					$cnt++;
				}
			?>
			</tbody>
			</table>
		</td>
	</tr>
</table>
</center>
<br /><br />
<center>
	<input type = "button" style="font-size: 16px;padding: 5px;" value="Print Invoice" onclick = "$(this).hide();window.print();$(this).show();"/>
</center>
</body>
</html>