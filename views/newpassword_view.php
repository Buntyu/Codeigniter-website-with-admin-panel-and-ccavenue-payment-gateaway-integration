<?php
//echo $url;
?>
<h4>Change Password</h4>
<hr class="soft"/>

<div class="control-group">
			<label class="control-label" for="old_pass">Enter Old Password</label>
			<div class="controls">
			  <input type="text" id="old_pass" name = "old_pass" value="" placeholder="Old Password">
			  <span id = "username_status"></span>
			  <span class = "errormsg"><?php echo form_error('old_pass'); ?></span>
			</div>

 </div>	
 <form method="POST" action="<?php echo base_url().'home/saveNewPassword';?>">
 <div class="control-group newPassClass">
			<label class="control-label" for="new_pass">Enter New Password</label>
			<div class="controls">
			  <input type="text" id="new_pass" name = "new_pass" value="" placeholder="New Password" readonly>
			</div>
			<input class="btn btn-success" type="submit" value="Submit" />
 </div>
 
</form><br>



</div></div></div></div></div>

