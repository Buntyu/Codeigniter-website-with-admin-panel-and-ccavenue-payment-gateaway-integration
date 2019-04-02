<?php  if(!empty($affiliate_account) && $obj->isloggedin)
    {
		
		  foreach($affiliate_account as $user) // user is an object.
      {
		  
		 ?>
<div class="well">	
	 <form class="form-horizontal" id = "register_form"  action="<?php echo base_url()."affiliate/affiliate_account_edit/?redirect=".urlencode($obj->redirect); ?>" method = "POST">
	
	 	
	
<h4 class="acc-heading">Personal Details</h4><br>		
		<div class="control-group">
			<label class="control-label" for="first_name">First name <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="first_name" name = "first_name" value="<?php  echo $user['first_name']; ?>" placeholder="First Name">
			  <span class = "errormsg"><?php echo form_error('first_name'); ?></span>
			</div>
		 </div>
		 
		 
	
		<div class="control-group">
			<label class="control-label" for="mobile">Mobile Phone <sup class = "compulsory">*</sup></label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">+91</span>
<input type="text"  name="mobile_phone" id="mobile"  value="<?php echo $user["mobile_phone"];?>" placeholder="Mobile Phone"/>
				 </div>
				<span class = "errormsg"><?php echo form_error('mobile'); ?></span>
			</div>
		</div>
			
		<div class="control-group">
			<label class="control-label" for="input_email">Email </label>
			<div class="controls">
			  <input type="text" id="email" value="<?php echo $user["email"];?>" name = "email" placeholder="Email">
			  <span class = "errormsg"><?php echo form_error('email'); ?></span>
			</div>
		  </div>	
		  <!--	  <div class="control-group">
						<label class="control-label" for="username">Username <sup class = "compulsory">*</sup></label>
						<div class="controls">
						  <input type="text" id="username" name = "user_id" value="<?php echo $user["user_id"]; ?>" placeholder="Your username" readonly>
						  <span id = "username_status"></span>					   
						  <span class = "errormsg"></span>
						  <br />
				  		
						</div>
					 </div>      -->

		<div class="control-group">
			<label class="control-label" for="input_aadhar">Aadhar Number </label>
			<div class="controls">
			  <input type="text" id="aadhar_number" value="<?php echo $user["aadhar_number"];?>" name = "aadhar_number" placeholder="Aadhar Number">
			  <span class = "errormsg"><?php echo form_error('aadhar_number'); ?></span>
			</div>
		  </div>

		  <div class="control-group">
			<label class="control-label" for="input_pan">Pan Number </label>
			<div class="controls">
			  <input type="text" id="pan_number" value="<?php echo $user["pan_number"];?>" name = "pan_number" placeholder="Pan Number">
			  <span class = "errormsg"><?php echo form_error('pan_number'); ?></span>
			</div>
		  </div><br>
		  
		  <h4 class="acc-heading">Bank Account Details</h4><br>
		  
		  <div class="control-group">
			<label class="control-label" for="input_pan">Name (as per bank account) </label>
			<div class="controls">
			  <input type="text" id="account_name" value="<?php echo $user["account_name"]; ?>" name = "account_name" placeholder="Enter Account Name">
			  <span class = "errormsg"><?php echo form_error('account_name'); ?></span>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="input_pan">Account Number </label>
			<div class="controls">
			  <input type="text" id="account_number" value="<?php echo $user["account_number"]; ?>" name = "account_number" placeholder="Enter Account Number">
			  <span class = "errormsg"><?php echo form_error('account_number'); ?></span>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="input_pan">Bank Name </label>
			<div class="controls">
			  <input type="text" id="bank_name" value="<?php echo $user["bank_name"]; ?>" name = "bank_name" placeholder="Enter Your Bank Name">
			  <span class = "errormsg"><?php echo form_error('bank_name'); ?></span>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="input_pan">IFSC Code </label>
			<div class="controls">
			  <input type="text" id="ifsc_code" value="<?php echo $user["ifsc_code"]; ?>" name = "ifsc_code" placeholder="Enter Your IFSC Code">
			  <span class = "errormsg"><?php echo form_error('ifsc_code'); ?></span>
			</div>
		  </div>
		  
		  
		<div class="control-group">
			<div class="controls">
				<input class="btn btn-medium btn-success" type="submit" value="UPDATE" />
			</div>
		</div>		
	</form>
</div>
	<?php }  }?>
	 </div></div></div></div></div>
	 
<style>
.well
{
	width:87%;
}
</style>