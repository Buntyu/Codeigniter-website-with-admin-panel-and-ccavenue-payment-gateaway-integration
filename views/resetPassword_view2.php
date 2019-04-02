<?php
//echo $uname;

?>

<div class="control-group">
			<label class="control-label" for="new_pass">Enter Your New Password</label>
			<div class="controls">
			  <input type="password" id="new_pass" name = "new_pass" value="" placeholder="New Password">
			  <span id = "username_status"></span>
			  <span class = "errormsg"><?php echo form_error('new_pass'); ?></span>
			</div>

 </div>	
 <form method="POST" id="resetPass" action="<?php echo base_url()."home/getresetpass2/"; ?>">
 <div class="control-group confPassClass">
			<label class="control-label" for="conf_pass">Enter Password Again</label>
			<div class="controls">
			  <input type="password" id="conf_pass" name = "conf_pass" value="" placeholder="Enter Password Again">
			</div>
			<input type="hidden" value="<?php echo $id; ?>" name="user_id"/>
			<input type="hidden" value="<?php echo $uname; ?>" name="user_name"/>
			<input class="btn btn-success" type="submit" value="Submit" onClick="validatePassword();" />
 </div>
 
</form><br>



</div></div></div></div></div>

    
    <script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery_validate.js"></script>

<script>
function validatePassword() {
        var validator = $("#resetPass").validate({
            rules: {
           
                new_pass: "required",
                conf_pass: {
                    equalTo: "#new_pass"
                }
            },
            messages: {
                new_pass: " Enter Password",
                conf_pass: " Enter Confirm Password Same as Password"
            }
        });
        if (validator.form()) {
            
        }
    }
    
    
   
 
    </script>

