<div id="mainBody">
  <div class="container">
    <div class="row">
       <div class="row-below">
<div class = "span12" id = "disp-alert"></div>
<?php 
	if($obj->isloggedin)
	{

		redirect(base_url().'order');
	}
	else { ?>
		
	<div class="ch-login-container span10">
	<h4 style="text-align: center; color:#608408;"> LOGIN/REGISTER</h4>	
	<hr class="soft"/>
	
	<div class="row">
		<br />		
		<div class="span5">
			<div class="well2">
			<h5 style="text-align: center;">CREATE YOUR ACCOUNT</h5><br/>
			 <a href = "<?php echo base_url().'register'; ?>" class="btn btn-success block checkout-login">Register</a>
		</div>
		</div>
		<!--<div class="span1"> &nbsp;</div>-->
		<div class="span5">
			<div class="well2">
				<h5 style="text-align: center;">ALREADY HAVE AN ACCOUNT ?</h5><br/>
				<a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-success checkout-login">Login</span></a>
			</div>
		</div>
		</div>
	<div class="row">
	<h4 style="text-align: center; color:#608408;">OR</h4>
	<hr>
			 <a href = "<?php echo base_url().'order'; ?>" class="btn btn-success block checkout-login checkout-login-guest">Continue as a Guest</a>
		</div>	
		</div> <!-- ch-login-container div closed -->

<?php	}
	?>

	</div>
		</div>	
		</div></div>