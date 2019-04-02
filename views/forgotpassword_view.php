<?php
//echo $url;
?>


<h4>Forgot Password? </h4>

<hr class="soft"/>
<form class="form-horizontal" id = "register_form" onsubmit = "validateuser(this,event)" action="<?php echo base_url()."home/mailtouser/"; ?>" method = "POST">
<input type="hidden" name = "redirect" value = "<?php echo $url; ?>" />
 <div class="control-group">
 <h5>For Customers </h5>	
	<div class="controls myform">
	  	<input type="text" class = "input-xlarge" id="email" name = "email" value="" placeholder="Your Email Address">  
		&nbsp;&nbsp;
		<input class="btn btn-success" type="submit" value="Submit" />
	</div>
  </div>
</form>

<hr class="soft"/>
<form class="form-horizontal" id = "register_form" onsubmit = "validateuser(this,event)" action="<?php echo base_url()."home/mailtoaffi/"; ?>" method = "POST">
<input type="hidden" name = "redirect" value = "<?php echo $url; ?>" />
 <div class="control-group">
 <h5>For Affiliates </h5>	
	<div class="controls myform">
	  	<input type="text" class = "input-xlarge" id="email" name = "email" value="" placeholder="Your Email Address">  
		&nbsp;&nbsp;
		<input class="btn btn-success" type="submit" value="Submit" />
	</div>
  </div>
</form>

</div></div></div></div></div>

