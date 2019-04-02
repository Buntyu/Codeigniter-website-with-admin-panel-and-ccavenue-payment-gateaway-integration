<?php 
		if($obj->isloggedin)
		{
			?>

<div class="woocommerce-MyAccount-content">
	
<h4>Hello, <strong><?php echo $obj->userData["firstname"].''.$obj->userData["first_name"]; ?></strong></h4>

<p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>

<ul class="dashboard-links">
  <li class="menu-item "><a href="">My account</a></li>
<?php if ($obj->userData["userid"]){?>
<li class="menu-item"><a href="<?php echo base_url()."home/UserOrder/"; ?>">Orders</a></li>
<li class="menu-item"><a href="<?php echo base_url()."UserLogin/user_address"; ?>">Addresses</a></li>
<li class="menu-item"><a href="<?php echo base_url()."UserLogin/user_account"; ?>">Account details</a></li>
<?php } else { ?>
<li class="menu-item"><a href="<?php echo base_url()."home/order/"; ?>">Sales</a></li> 
<li class="menu-item"><a href="<?php echo base_url()."affiliate/affiliate_account"; ?>">Account Details</a></li> <?php } ?>
<li class="menu-item"><a href="<?php echo base_url()."home/forgotpassword1"; ?>">Lost password</a></li>
<li class="menu-item"><a href="<?php echo base_url()."home/logout?redirectlink=".urlencode($querystring); ?>">Logout</a></li>

</ul></div>
		<?php }
		else 
		{
			echo '<div>';				
		}
	?>	

</div></div></div></div></div>