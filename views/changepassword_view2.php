<?php
//echo $url;
?>
<h4>Change Password</h4>
<hr class="soft"/>

<div class="control-group">
			<label class="control-label" for="old_pass">Enter Old Password</label>
			<div class="controls">
			  <input type="password" id="old_pass" name = "old_pass" value="" placeholder="Old Password">
			  <span id = "username_status"></span>
			  <span class = "errormsg"><?php echo form_error('old_pass'); ?></span>
			</div>

 </div>	
 <form method="POST" action="<?php echo base_url().'home/saveNewPassword2';?>">
 <div class="control-group newPassClass">
			<label class="control-label" for="new_pass">Enter New Password</label>
			<div class="controls">
			  <input type="password" id="new_pass" name = "new_pass" value="" placeholder="New Password" readonly>
			</div>
			<input class="btn btn-success" type="submit" value="Submit" />
 </div>
 
</form><br>



</div></div></div></div></div>
<style>

</style>
<script src="<?php echo base_url()."theme_back/"; ?>js/jquery.autogrow-textarea.js"></script>
<script>
	$(document).ready(function(){			
		
	        $('textarea.autogrow').autogrow();	
			$("#old_pass").bind
			(
				"focusout",
				function()
				{
                   
					if($(this).val() != "")
					{
						$.ajax
						(
							{							
								url : "<?php echo base_url().'home/checkOldPassword2/';?>"+$(this).val(),
								success : function(data)
								{//debugger;
									//alert(data);
									try
									{
										var response = JSON.parse(data);
									}
									catch (exc)
									{
										return;
									}
									if(response.status == "present")
									{									
										$("#username_status").closest(".control-group")
															.removeClass("error")
															.addClass("sucess");
										$("#username_status").html("<span style = 'color :green;'><i class = 'icon-cross'></i>Password Matched</span>");
										$('#new_pass').removeAttr("readonly"); 
									}
									else
									{
										$("#username_status").closest(".control-group")
															.removeClass("success")
															.addClass("error");
										$("#username_status").html("<span style = 'color :red;'><i class = 'icon-check'></i>Password Does Not Match</span>");
										$('#new_pass').attr("readonly", "readonly");
									}
								}
							}
						);	
					}
					else
					{
						$("#username_status").html("")
											 .closest(".control-group")
												.removeClass("success")
												.removeClass("error");
						
					}											
			});

});			
</script>