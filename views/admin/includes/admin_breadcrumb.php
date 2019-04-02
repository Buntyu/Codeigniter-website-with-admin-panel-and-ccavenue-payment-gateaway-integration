<?php
//echo "<pre>";print_r($this->uri->segment_array());die;
$bread_crumbs = array
(
	"admin"=>"Admin",
	"dashboard"=>"Dashboard",
	"useraccess"=>"User Types",
	"adminusers"=>"Backend Users",
	"users"=>"Front-end Users (Customers)",
	"categories"=>"Categories",
	"subcategories"=>"Sub-Categories",
	"brands" =>"Brands",
	"product"=>"Products",
	"vendors"=>"Vendors",
	"purchaseinvoice"=>"Purchase Invoice",
	"Invoice_list" => "Invoices List",
	"carousel" => "Carousel",
	"areas" => "Areas",
	"quicksearchandadd" => "Quick Search And Create Products",
	"sales"=>"Sales",
	"pendingOrders" => "Pending Orders",
	"finalizeorder"=> "Finalize the Order",
	"sales_invoice" => "Sales Invoice"
);

$breadcrumb_link = $this->uri->segment_array();
$strlink = base_url();
foreach($breadcrumb_link as $links)
{
	$strlink = $strlink.$links."/";
	$links = (isset($bread_crumbs[$links]))? $bread_crumbs[$links] : $links;
	echo '
		<li>
			<a href="'.$strlink.'">'.$links.'</a> <span class="divider">/</span>
		</li>
	';	
}
?>
<!--<li>
	<a href="#">Home</a> <span class="divider">/</span>
</li>
<li>
	<a href="#">Dashboard</a><span class="divider">/</span>
</li>-->