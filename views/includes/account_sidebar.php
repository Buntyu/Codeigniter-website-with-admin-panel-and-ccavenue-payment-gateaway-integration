<?php
	$theme_url = base_url()."theme/";	
?>
<script>
//	$(document).ready(function(){$(".subMenu").first().addClass("open");$(".subMenu").first().find("ul").css("display","block")})
/*	$(document).ready(function()
	{
		$(".subMenu").unbind("click").bind
		(
			"hover",
			function()
			{debugger;
				$(".subMenu").removeClass("open");
				$(".subMenu").find("ul").css("display","none");
				$(this).addClass("open");
				$(this).find("ul").css("display","block")
			},
			function()
			{
				$(this).removeClass("open");
				$(this).find("ul").css("display","none");
			}
		);
	});*/
</script>
<!-- Sidebar ================================================== -->
<div id="mainBody">


	<div class="container">
		<div class="row">
		   <div class="row-below"> 
		   <div class = "span12" id = "disp-alert"></div>
		   
<div id="sidebar" class="span3">
		<h4 style="color:#608408;"> Account </h4>		
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
			<li><a href="<?php echo base_url()."home/useraccount"; ?>">MY ACCOUNT</a></li> 
			<?php if ($obj->userData["userid"]){?><li><a href="<?php echo base_url()."home/UserOrder/"; ?>">ORDERS</a></li> 
			<li><a href="<?php echo base_url()."UserLogin/user_address"; ?>">ADDRESS</a></li> 
			<li><a href="<?php echo base_url()."UserLogin/user_account"; ?>">ACCOUNT DETAILS</a></li>
			<li><a href="<?php echo base_url()."home/changepassword"; ?>">CHANGE PASSWORD</a></li>  <?php } else{?>
			<li><a href="<?php echo base_url()."home/order/"; ?>">SALES</a></li> 
			<li><a href="<?php echo base_url()."affiliate/affiliate_myuser/"; ?>">MY USERS</a></li> 
			<li><a href="<?php echo base_url()."affiliate/affiliate_account"; ?>">ACCOUNT DETAILS</a></li>
			<li><a href="<?php echo base_url()."broucher"; ?>">DOWNLAOD BROUCHER</a></li>
			<li><a href="<?php echo base_url()."home/changepassword2"; ?>">CHANGE PASSWORD</a></li>  <?php } ?>
			
			<li><a href="<?php echo base_url()."home/logout"; ?>">LOGOUT</a></li>
		</ul>
		 
		<br/>
		
	</div>
<!-- Sidebar end=============================================== -->
<div class="span9">	