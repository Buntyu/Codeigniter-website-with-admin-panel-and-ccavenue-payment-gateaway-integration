<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">						
						<li class="mynavheader"><a class="ajax-link" href="<?php echo base_url()."admin/dashboard"; ?>"><i class="icon-home"></i><span class="">&nbsp;Dashboard</span></a></li>
						
						<!--
						<li class="mynavheader"><a class="ajax-link" href="<?php echo base_url()."admin/test/testtheme"; ?>"><i class="icon-wrench"></i><span class="">&nbsp;Theme Test</span></a></li>
						-->
						<?php
							$links = array
							(
							    0=>array
								(
									"heading" =>array("iconclass"=>"icon-camera","icontext"=>"Blogs"),
									"data"=>array
									(
										0=>array("url"=>base_url()."admin/blogs","text"=>"Blogs list","module"=>"blogs")
									)
								),
								1=>array
								(
									"heading" =>array("iconclass"=>"icon-film","icontext"=>"Certificates"),
									"data"=>array
									(
										0=>array("url"=>base_url()."admin/certificates","text"=>"Certificates List","module"=>"carousel")
									)
								),
								2=>array
								(
									"heading" =>array("iconclass"=>"icon-user","icontext"=>"Users"),
									"data"=>array
									(
										/*0=>array("url"=>base_url()."admin/useraccess","text"=>"User Access","module"=>"useraccess"),*/
										1=>array("url"=>base_url()."admin/adminusers","text"=>"Backend Users","module"=>"useraccess"),
										2=>array("url"=>base_url()."admin/users","text"=>"Frontend Users","module"=>"useraccess"),
									)
								),
								3=>array
								(
									"heading" =>array("iconclass"=>"icon-align-left","icontext"=>"Categories"),
									"data"=>array
									(
										0=>array("url"=>base_url()."admin/categories","text"=>"Categories List","module"=>"categories"),
										1=>array("url"=>base_url()."admin/subcategories","text"=>"Sub-Categories List","module"=>"subcategories")
									)
								),
							/*	3=>array
								(
									"heading" =>array("iconclass"=>"icon-star","icontext"=>"Brands"),
									"data"=>array
									(
										0=>array("url"=>base_url()."admin/brands","text"=>"Brands List","module"=>"brands")
									)
								), */
								4=>array
								(
									"heading" =>array("iconclass"=>"icon-briefcase","icontext"=>"Products"),
									"data"=>array
									(
									//	0=>array("url"=>base_url()."admin/product/quicksearchandadd","text"=>"Quick Search","module"=>"product"),
										1=>array("url"=>base_url()."admin/product","text"=>"Products List","module"=>"product")									
									)
								),
							
								7=>array
								(
									"heading" =>array("iconclass"=>"icon-user","icontext"=>"Orders"),
									"data"=>array
									(
										0=>array("url"=>base_url()."admin/sales/pendingOrders","text"=>"New Orders","module"=>"sales"),
										1=>array("url"=>base_url()."admin/sales/AllOrders","text"=>"All Orders","module"=>"sales"),
										2=>array("url"=>base_url()."admin/sales/abandoned_orders","text"=>"Abandoned Orders","module"=>"sales"),
										3=>array("url"=>base_url()."admin/sales/download_invoice","text"=>"Download Invoice","module"=>"sales"),
										4=>array("url"=>base_url()."admin/sales/manual_order","text"=>"Manual Orders","module"=>"sales")
									)
								),
                                                                8=>array
								(
									"heading" =>array("iconclass"=>"icon-user","icontext"=>"Invoice"),
									"data"=>array
									(
										0=>array("url"=>base_url()."admin/invoice","text"=>"Invoice list","module"=>"Invoice"),
										
									)
								),
						/*		8=>array
								(
									"heading" =>array("iconclass"=>"icon-user","icontext"=>"Coupons"),
									"data"=>array
									(
										0=>array("url"=>base_url()."admin/coupons","text"=>"Coupon List","module"=>"sales")
										
									)
								),  */
								9=>array
								(
									"heading" =>array("iconclass"=>"icon-user","icontext"=>"Affiliates"),
									"data"=>array
									(
										0=>array("url"=>base_url()."admin/personnel","text"=>"Affiliates List","module"=>"areas")
									)
								),
								10=>array
								(
									"heading" =>array("iconclass"=>"icon-cog","icontext"=>"Settings"),
									"data"=>array
									(
										0=>array("url"=>base_url()."admin/currency","text"=>"Currency","module"=>"Currency"),
										1=>array("url"=>base_url()."admin/shipping","text"=>"Shipping","module"=>"Shipping")
									)
								)
							);
							$allowedmodules = $this->session->userdata("allowedmodules");
							if($allowedmodules != "*")$allowedmodules = explode(",",$allowedmodules);
							if($allowedmodules)
							{
								foreach($links as $eachlink)
								{
									$isPresent = FALSE;
									$strsubmenus = "";
									foreach($eachlink["data"] as $pages)
									{
										if($allowedmodules == "*" || in_array($pages["module"],$allowedmodules))
										{
											$isPresent = TRUE;
											$strsubmenus .= '
											<li class = "sub-link"><a class="ajax-link" href="'.$pages["url"].'"><span class="">'.$pages["text"].'</span></a></li>';
										}
									}
									if($isPresent)
									{
										echo '
											<li class="mynavheader" style = "position:relative;"><a class="ajax-link" href="#"><i class="'.$eachlink['heading']['iconclass'].'"></i><span class="">&nbsp;'.$eachlink['heading']['icontext'].'</span><span style = "position:absolute;right:8px;">></span></a></li>
										';
										echo $strsubmenus;
									}
								}
							}
						?>
					</ul>
					<!--<label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>-->
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			
			
			<!-- 
				<li class="mynavheader"><a class="ajax-link" href="#"><i class="icon-user"></i><span class="">&nbsp;Users</span><span style = "float: right;">></span></a></li>
						<li class = "sub-link"><a class="ajax-link" href="<?php echo base_url()."admin/useraccess"; ?>"><span class="">&nbsp;User Access</span></a></li>
						
						<li class = "sub-link"><a class="ajax-link" href="<?php echo base_url()."admin/adminusers"; ?>"><span class="">&nbsp;Backend Users</span></a></li>	
						
						<li class = "sub-link"><a class="ajax-link" href="<?php echo base_url()."admin/users"; ?>"><span class="">&nbsp;Frontend Users</span></a></li>	
						
						
						<li class="mynavheader "><a class="ajax-link" href="#"><i class="icon-align-left"></i><span class="">&nbsp;Categories</span><span style = "float: right;">></span></a></li>
						
						<li class = "sub-link"><a class="ajax-link" href="<?php echo base_url()."admin/categories"; ?>"><span class="">&nbsp;Categories List</span></a></li>	
						
						<li class = "sub-link"><a class="ajax-link" href="<?php echo base_url()."admin/subcategories"; ?>"><span class="">&nbsp;Sub-Categories List</span></a></li>
						
						
						
						<li class="mynavheader "><a class="ajax-link" href="#"><i class="icon-star"></i><span class="">&nbsp;Brands</span><span style = "float: right;">></span></a></li>
															
						<li class = "sub-link"><a class="ajax-link" href="<?php echo base_url()."admin/brands"; ?>"><span class="">&nbsp;Brands List</span></a></li>
						
						
						<li class="mynavheader "><a class="ajax-link" href="#"><i class="icon-briefcase"></i><span class="">&nbsp;Products</span><span style = "float: right;">></span></a></li>
						<li class = "sub-link"><a class="ajax-link" href="<?php echo base_url()."admin/product"; ?>"><span class="">&nbsp;Products List</span></a></li>
						
						
						<li class="mynavheader "><a class="ajax-link" href="#"><i class="icon-user"></i><span class="">&nbsp;Vendors</span><span style = "float: right;">></span></a></li>
						<li class = "sub-link"><a class="ajax-link" href="<?php echo base_url()."admin/vendors"; ?>"><span class="">&nbsp;Vendors List</span></a></li>
						
						
						<li class="mynavheader "><a class="ajax-link" href="#"><i class="icon-user"></i><span class="" style="padding-right:5px;">&nbsp;Purchase Invoice</span><span style = "float: right;">></span></a></li>
						<li class = "sub-link"><a class="ajax-link" href="<?php echo base_url()."admin/purchaseinvoice/Invoice_list"; ?>"><span class="">&nbsp;Purchase Invoice List</span></a></li>	
			-->
<script>
$(document).ready
(
	function()
	{		
		if(navigator.userAgent.toLowerCase().indexOf("mobile") != "-1")
		{
			$(".navbar .btn-navbar").css("display","block");
			$(".main-menu-span").removeClass("span2");
			$(".main-menu-span").addClass("span12");
		}		
		minimizeAll();
		setTimeout(function()
		{
			var activeEle = $(".main-menu-span").find(".active");			
			var opar = activeEle.prevAll(".mynavheader");
			$(opar[0]).trigger("click");			
		},500);		
		$(".mynavheader").bind
		(
			"click",
			function()
			{
				minimizeAll($(this));
			}
		);
	}
);

function minimizeAll(selector)
{
	if(selector == undefined)
	selector = $(".mynavheader");
	selector.each
		(
			function()
			{
				var found = false;
				var g_parent = $(this);				
				$(this).parent().find("li").each
				(
					function()
					{
						if(found == true)
						{
							if($(this).hasClass("mynavheader"))
							{
								found = false;
								return "";
							}
							if($(this).is(":visible"))
							{
								$(this).slideUp();
							}
							else
							{
								$(this).slideDown();
							}
						}
						else if(!($(this).hasClass("mynavheader")))
						{
							$(this).slideUp();
						}						
						if($(this).html() == g_parent.html())
						{
							found = true;
						}
					}
				);
			}
		);
}
</script>		
<style>
.mynavheader
{
	margin-top: 0px!important;
	padding: 0px 0px!important;
	font-size: 11px;
	font-weight: bold;
	line-height: 18px;
	color: #999999;
	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
	text-transform: uppercase;
}
.sub-link
{	
	width: 95%!important;
	margin-left: 15%!important;
	-webkit-transition: margin-left 0.3s ease-out;
	-moz-transition-duration: margin-left 0.3s ease-out;
	-ms-transition-duration: margin-left 0.3s ease-out;
	-o-transition-duration: margin-left 0.3s ease-out;
}
.sub-link:hover
{
	margin-left: 20%!important;
}
.sub-link.active:hover
{
	margin-left: 15%!important;
}

</style>			
