<style>
	.compulsory
	{
		color : red;
	}
	.errormsg
	{
		color : red;
	}	
</style>
<!--<link href="<?php echo base_url()."theme_back/"; ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
<script src="<?php echo base_url()."theme_back/"; ?>js/jquery-ui-1.8.21.custom.min.js"></script>-->
<script src="<?php echo base_url()."theme_back/"; ?>js/jquery.autogrow-textarea.js"></script>
 <ul class="breadcrumb">
		<?php 
			$breadCrumb = $obj->getBreadCrumb();
		//	echo "<pre>";print_r($formData);die;		
			if(isset($formData))
			{
				$vals["link"] = $breadCrumb[count($breadCrumb)-1]['link'].$formData['id'];
				$vals["name"] = $formData['firstname']." ".$formData["lastname"];
				$breadCrumb[] = $vals;
			}
			foreach($breadCrumb as $breadcrumbs)
			{
				echo '<li>
						<a href="'.$breadcrumbs["link"].'">'.$breadcrumbs["name"].'</a><span class="divider">/</span>
					</li>';
			}
		?>
    </ul>
	
	<h4>To Signup As An Affiliate Fill In Your Details Below and Click Register</h4>	
	
	<div class="well">	
	<h5 style="color:red;">Please Read All <a href="<?php echo base_url(); ?>affiliate_tac">Affiliate Terms And Conditions </a>Carefully before filling out the form below. </h5><br>
	
	 <form class="form-horizontal" id = "register_form" onsubmit = "validateuser(this,event)" action="<?php echo base_url()."affiliate/submitform/?redirect=".urlencode($obj->redirect); ?>" method = "POST">
	 <p><sup class = "compulsory">*</sup> Required Field	</p>
	 	
	<?php 
	 	if(isset($formData))
		{
			$formData = array
			(
				"id"=>$formData["id"],
				"username"=>($formData["userid"]) ? $formData["userid"] : "",
				"password"=>($formData["password"]) ? $formData["password"] : "",
				"confpassword"=>($formData["password"]) ? $formData["password"] : "",
				"first_name"=>($formData["firstname"]) ? $formData["firstname"] : "",
				//"last_name"=>($formData["lastname"]) ? $formData["lastname"] : "",
				"mobile"=>($formData["mobile"]) ? $formData["mobile"] : "",
				"email"=>($formData["email"]) ? $formData["email"] : "",
				"aadhar_number"=>($formData["aadhar_number"]) ? $formData["aadhar_number"] : "",
				"pan_number"=>($formData["pan_number"]) ? $formData["pan_number"] : "",
			);		
			echo '<input type="hidden" name="affiliate_user_id" value="'.$formData['id'].'">';
		}
		else
		{
			$formData = array
			(
				"username"=>(set_value('username')) ? set_value('username') : "",
				"password"=>(set_value('password')) ? set_value('password') : "",
				"confpassword"=>(set_value('confpassword')) ? set_value('confpassword') : "",
				"first_name"=>(set_value('first_name')) ? set_value('first_name') : "",
				//"last_name"=>(set_value('last_name')) ? set_value('last_name') : "",
				"mobile"=>(set_value('mobile')) ? set_value('mobile') : "",
				"email"=>(set_value('email')) ? set_value('email') : "",
				"pan_number"=>(set_value('pan_number')) ? set_value('pan_number') : "",
			);			
			if($edit == FALSE)
			{
				echo '<input type="hidden" name="is_new_customer" value="1">
					<div class="control-group">
						<label class="control-label" for="username">Username <sup class = "compulsory">*</sup></label>
						<div class="controls">
						  <input type="text" id="username" name = "username" value="'.$formData["username"].'" placeholder="Your username">
						  <span id = "username_status"></span>					   
						  <span class = "errormsg">'.form_error('username').'</span>
						  <br />
				  		  <small>6-12 characters<span style="color:green;"> (This Will Be Your Refferal Code)</span></small>
						</div>
					 </div>
				';
			}
			else
			{
				echo '<input type="hidden" name="affiliate_user_id" value="'.$user_id.'">';
			}
		}	 	
	 ?>	
		
		<div class="control-group">
			<label class="control-label" for="first_name">Name <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="first_name" name = "first_name" value="<?php echo $formData["first_name"]; ?>" placeholder="Enter Name">
			  <span class = "errormsg"><?php echo form_error('first_name'); ?></span>
			</div>
		 </div>
		 
	<!--	 <div class="control-group">
			<label class="control-label" for="last_name">Last name <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="last_name" name="last_name" value="<?php echo $formData["last_name"]; ?>" placeholder="Last Name">
			  <span class = "errormsg"><?php echo form_error('last_name'); ?></span>
			</div>
		 </div>   -->
	
		<div class="control-group">
			<label class="control-label" for="mobile">Mobile Phone <sup class = "compulsory">*</sup></label>
			<div class="controls">
					<input type="text"  name="mobile" id="mobile"  value="<?php echo $formData["mobile"]; ?>" placeholder="Mobile Phone"/>
				<span class = "errormsg"><?php echo form_error('mobile'); ?></span>
			</div>
		</div>
			
		<div class="control-group">
			<label class="control-label" for="input_email">Email </label>
			<div class="controls">
			  <input type="text" id="email" value="<?php echo $formData["email"]; ?>" name = "email" placeholder="Email">
			  <span class = "errormsg"><?php echo form_error('email'); ?></span>
			</div>
		  </div>



		  		
		
		<div class="control-group">
			<label class="control-label" for="password">Password <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <input type="password" id="password" name = "password" value="<?php echo $formData["password"]; ?>" placeholder="Password">
			  <span class = "errormsg"><?php echo form_error('password'); ?></span>
			  <br />
			  <small>Atleast six characters</small>
			</div>
		  </div>

		<div class="control-group">
			<label class="control-label" for="confpassword">Confirm Password <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <input type="password" id="confpassword" name = "confpassword" value="<?php echo $formData["confpassword"]; ?>" placeholder="Confirm Password">
			  <span class = "errormsg"><?php echo form_error('confpassword'); ?></span>
			</div>
		  </div>

		  <div class="control-group">
			<label class="control-label" for="aadhar_number">Aadhar Number <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="aadhar_number" name = "aadhar_number" value="<?php echo $formData["aadhar_number"]; ?>" placeholder="Enter Aadhar Number">
			  <span class = "errormsg"><?php echo form_error('aadhar_number'); ?></span>
			</div>
		 </div>

		 <div class="control-group">
			<label class="control-label" for="pan_number">Enter Pan Number <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="pan_number" name = "pan_number" value="<?php echo $formData["pan_number"]; ?>" placeholder="Enter Pan Number">
			  <span class = "errormsg"><?php echo form_error('pan_number'); ?></span>
			</div>
		 </div>
		 
		 <div class="control-group">
            		<div class="controls">
            	<sup class = "compulsory">
              <input name="billingtoo" type="checkbox" id="checkbox1" /> <span class="checktext">I Accept All The Affiliate Terms And Conditions.</span></sup>
              <p><a href="//bisjexporters.com/affiliate_tac" target="_blank">Read Affiliate Terms And Conditions</a></p>
            		</div>
        	</div>

<div class="control-group">
			<div class="controls">
				<input class="btn btn-large btn-success" type="submit" value="Register" />
			</div>
		</div>		
	</form>
</div>

</div>
</div>
</div>
</div>
<script>
	$(document).ready
	(
		function()
		{			
		//	$(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
			$('textarea.autogrow').autogrow();
			$("#registerBtn").remove();
			$("#username").bind
			(
				"focusout",
				function()
				{
					if($(this).val() != "")
					{
						$.ajax
						(
							{							
								url : "<?php echo base_url().'affiliate/checkUserID/';?>"+$(this).val(),
								success : function(data)
								{//debugger;
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
															.removeClass("success")
															.addClass("error");
										$("#username_status").html("<span style = 'color :red;'><i class = 'icon-cross'></i>"+response.data+" is already taken, please choose another one.</span>");
									}
									else
									{
										$("#username_status").closest(".control-group")
															.removeClass("error")
															.addClass("success");
										$("#username_status").html("<span style = 'color :green;'><i class = 'icon-check'></i>"+response.data+" is available.</span>");
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
				}
			);
		}
	);
function validateuser(oForm,event)
{
	oForm = $(oForm);
	$(".compulsory").closest(".control-group").find("input:text,input:checkbox,checkbox,textarea,select").each
	(
		function()
		{			
			if($(this).val() == "")
			{
				displayError(this,$(this).closest(".control-group").find("label").text().replace("*","")+" is compulsory.")				
				event.preventDefault();
				displayalertblock("Fields marked <strong>*</strong> are compulsory.");
			}
			else
			{
				displaySuccess(this);
			}
		}
	);
	if($("#password").val() != $("#confpassword").val())
	{
		$("#confpassword").val()		
		displayError($("#confpassword"),"Password does not match.");
		event.preventDefault();
	}
	if ($('#checkbox1').is(':not(:checked)')){
   	alert('Please Accept Affiliate Terms And Conditions');
   	event.preventDefault();
	}	
}

function displayError(oEle, msg)
{	
	oEle = $(oEle);
	oEle.closest(".control-group")
				.removeClass("success")
				.addClass("error")
				.find(".errormsg")
								.show()
								.html(msg);
}
function displaySuccess(oEle)
{
	oEle = $(oEle);
	oEle.closest(".control-group")
				.addClass("success")
				.find(".errormsg")
								.hide()
								.html("");
}
</script>