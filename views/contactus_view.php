<div id="mainBody">

<img src="<?php echo base_url(); ?>/images/pagebanner3.jpg" class="contact-banner">
	<div class="container">
		<div class="row">
		   <div class="row-below">
<div class = "span12" id = "disp-alert"></div>		   
<!-- <ul class="breadcrumb">
	<!--<li><a href="index.html">Home</a> <span class="divider">/</span></li>
	<li class="active">Products Name</li>--> 
<!--	<?php 
		$breadCrumb = $obj->getBreadCrumb();
		foreach($breadCrumb as $breadcrumbs)
		{
			echo '<li>
					<a href="'.$breadcrumbs["link"].'">'.$breadcrumbs["name"].'</a><span class="divider">/</span>
				</li>';
		}
	?>
</ul><br> -->

<h1 style="text-align: center;font-size:24px;">GET IN TOUCH WITH US</h1><br>
<div class="span6">
<h4 style="text-align: left;">Feel Free to contact us anytime</h4><br>
<h5>BISJ Exporters Pvt Ltd.</h5>
<h5>Place : Chandigarh </h5>
<h5>Contact Person : Baljeet Singh</h5>
<h5>Contact No : +91 7009272362</h5><br>
<h5>Contact Person: Amardeep Singh</h5>
<h5>Contact No: +91 7011993301 </h5>
<h5>Email: info@bisjexporters.com</h5>
</div>
<div class="span6">
<h4 style="text-align: left;">Contact Us</h4>
<div class="con-form">
<form action="<?php echo base_url()."contactus/mailtoAdminOfContactus/"; ?>" method="post">
<p><label> Your Name<br />
<input type="text" name="your-name" value="" size="40"/></label></p>
<p><label> Your Email<br />
<input type="email" name="your-email" value="" size="40"/></label></p>
<p><label> Subject<br />
<input type="text" name="your-subject" value="" size="40"/></label></p>
<p><label> Your Message<br />
<textarea name="your-message" cols="40" rows="10"></textarea></label></p>
<p><input type="submit" value="Send" class="btn-success btn-large"/></p>
</form>
</div>
</div>	<!-- span6 div closed -->

<br>

</div>
</div>
</div>
</div>
</div>

<style>
.con-form input[type="text"], .con-form input[type="email"], .con-form textarea {
    width: 75%;
}

</style>