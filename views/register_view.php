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
    
	<!--	<a href="<?php echo base_url().'affiliate'; ?>" role="button" style="padding-right:0"><span class="btn btn-warning"><i class = "icon-share"></i> Sign Up As An Affiliate</span></a>  -->
	
	<h4>Fill in your details below and Click Register</h4>	
	
	<div class="well">	
	 <form class="form-horizontal" id = "register_form" onsubmit = "validateuser(this,event)" action="<?php echo base_url()."register/submitform/"; ?>" method = "POST">
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
				"reff-code"=>($formData["refferal_code"]) ? $formData["refferal_code"] : "",
			);		
			echo '<input type="hidden" name="customer_id" value="'.$formData['id'].'">';
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
				"reff-code"=>(set_value('reff-code')) ? set_value('reff-code') : "",
				
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
				  		  <small>Atleast six characters</small>
						</div>
					 </div>
				';
			}
			else
			{
				echo '<input type="hidden" name="customer_id" value="'.$user_id.'">';
			}
		}	 	
	 ?>		
	 <div class="control-group">
			<label class="control-label" for="first_name">Name <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="first_name" name = "first_name" value="<?php echo $formData["first_name"]; ?>" placeholder="Name">
			  <span class = "errormsg"><?php echo form_error('first_name'); ?></span>
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
			<label class="control-label" for="input_email">Email </label>
			<div class="controls">
			  <input type="text" id="email" value="<?php echo $formData["email"]; ?>" name = "email" placeholder="Email">
			  <span class = "errormsg"><?php echo form_error('email'); ?></span>
			</div>
		  </div>
		  
		  <?php $coo = $this->input->cookie("bisj_queryaff"); 
      		if($coo == "") { ?>
      
		  <div class="control-group">
			<label class="control-label" for="reff-code">Refferal Code</label>
			<div class="controls">
					<input type="text"  name="reff-code" id="reff-code"  value="<?php echo $formData["reff-code"]; ?>" placeholder="Enter Refferal Code"/>
					<span id = "refferal_status"></span>
				<span class = "errormsg"><?php echo form_error('reff-code'); ?></span>
				<br />
			  <small>You will get 10% lifetime discount by entering a refferal code above</small>
			</div>
		</div>
		<?php	}
		else { ?>
          	<input type="hidden" name="reff-code" id="reff-code"  value="gagan24" />
		<?php } ?>

		  <div class="control-group">
			<label class="control-label" for="mobile">Mobile Phone <sup class = "compulsory">*</sup></label>
			<div class="controls">
				<div class="input-prepend">
					<!--<span class="add-on">+91</span>-->
					<input type="text"  name="mobile" id="mobile"  value="<?php echo $formData["mobile"]; ?>" placeholder="Mobile Phone"/>
				 </div>
				<span class = "errormsg"><?php echo form_error('mobile'); ?></span>
			</div>
		</div>
				 
	<!--	  <div class="control-group">
			<label class="control-label" for="middle_name">Middle name </label>
			<div class="controls">
			  <input type="text" id="middle_name" name = "middle_name" value="<?php echo $formData["middle_name"]; ?>" placeholder="Last Name">
			  <span class = "errormsg"><?php echo form_error('middle_name'); ?></span>
			</div>
		 </div>
		 
		 <div class="control-group">
			<label class="control-label" for="last_name">Last name <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="last_name" name="last_name" value="<?php echo $formData["last_name"]; ?>" placeholder="Last Name">
			  <span class = "errormsg"><?php echo form_error('last_name'); ?></span>
			</div>
		 </div>		  
		
		<div class="control-group">
			<label class="control-label" for="gender">Gender <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <select name = "gender" id = "gender" class="span2">
				<option value = "">Select Gender</option>
				<?php 
					$gender = array("Male","Female");
					for($i=0; $i<=1; $i++)
					{						
						if($formData["gender"] == $gender[$i])
						{
							echo '<option value = "'.$gender[$i].'" selected>'.$gender[$i].'</option>';
						}
						else
						echo '<option value = "'.$gender[$i].'">'.$gender[$i].'</option>';
						
					}
				?>
			</select>
			 <span class = "errormsg"><?php echo form_error('gender'); ?></span>
			</div>
		 </div>  
			 
		<div class="control-group">
		<label class="control-label">Date of Birth <sup class = "compulsory">*</sup></label>
		<div class="controls">
		  	<select name = "date" id = "date" class="span1">
				<option value = "">dd</option>
				<?php 
					for($i=1; $i<=31; $i++)
					{
						if($formData["date"] == $i)
						{
							echo '<option value = "'.$i.'" selected>'.$i.'</option>';
						}
						else
						echo '<option value = "'.$i.'">'.$i.'</option>';
						
					}
				?>
			</select>
			
			<select name = "month" id = "month" class="span1">
				<option value = "">mm</option>
				<?php 
					$arrmonths = array( "","Jan","Feb","Mar","Apr","May","June","July","Aug","Sept","Oct","Nov","Dec");
					for($i = 1; $i<=12; $i++)
					{
						if($formData["month"] == $i)
						{
							echo '<option value = "'.$i.'" selected>'.$arrmonths[$i].'</option>';
						}
						else
						echo '<option value = "'.$i.'">'.$arrmonths[$i].'</option>';
					}
				?>			
			</select>
			<select name = "year" id = "year" class="span1">
				<option value = "">yyyy</option>
				<?php 
					for($i="1950";$i<=date("Y"); $i++)
					{
						if($formData["year"] == $i)
						{
							echo '<option value = "'.$i.'" selected>'.$i.'</option>';
						}
						else
						echo '<option value = "'.$i.'">'.$i.'</option>';
					}
				?>
			</select>
			<span class = "errormsg"><?php echo form_error('date')." ". form_error('month')." ".form_error('year'); ?></span>
		</div>
	  </div>  -->
	
	<!--	<div class="control-group">
			<label class="control-label" for="phone">Home phone </label>
			<div class="controls">
			  <input type="text"  name="phone"  value="<?php echo $formData["phone"]; ?>" id="phone" placeholder="Phone"/> 
			  <span class = "errormsg"><?php echo form_error('phone'); ?></span>
			</div>
		</div>   -->		  
		
<!--		<h4>Your address</h4>		
		<div class="control-group">
			<label class="control-label" for="address">Address <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <textarea name="address" id="address" class = "input-xlarge autogrow" placeholder="Enter Your Address"><?php echo $formData["address"]; ?></textarea>
			  <span class = "errormsg"><?php echo form_error('address'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="city">Area <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <select name = "area" id = "area" onchange="$('#PIN').val($(this).find('option:selected').attr('data'));">
			  		<option value = "">Select Area</option>
					<?php 						
						foreach($areas as $area)
						{
							if($formData["area"] == $area["area_name"])
							{
								echo '<option data = "'.$area["area_pin"].'" value = "'.$area["area_name"].'" selected>'.$area["area_name"].'</option>';
							}
							else
							echo '<option data = "'.$area["area_pin"].'" value = "'.$area["area_name"].'">'.$area["area_name"].'</option>';							
						}
					?>
			  </select>
			  <span class = "errormsg"><?php echo form_error('address'); ?></span>
			</div>
		</div>		
		<div class="control-group">
			<label class="control-label" for="postcode">Zip / Postal Code <sup class="compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="PIN" name = "PIN" value="<?php echo $formData["PIN"]; ?>" placeholder="Zip / Postal Code"/> 
			  <span class = "errormsg"><?php echo form_error('PIN'); ?></span>
			</div>
		</div>	 -->				
	
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
								url : "<?php echo base_url().'register/checkUserID/';?>"+$(this).val(),
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
										$("#username_status").html("<span style = 'color :red;'><i class = 'icon-cross'></i>"+response.data+" is already present.</span>");
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


$("#reff-code").bind
			(
				"focusout",
				function()
				{
					if($(this).val() != "")
					{
						$.ajax
						(
							{							
								url : "<?php echo base_url().'register/checkReffCode/';?>"+$(this).val(),
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
										$("#refferal_status").closest(".control-group")
															.removeClass("success")
															.addClass("error");
										$("#refferal_status").html("<span style = 'color :green;'><i class = 'icon-check'></i>Refferal Code Matched.</span>");
									}
									else
									{
										$("#refferal_status").closest(".control-group")
															.removeClass("error")
															.addClass("success");
										$("#refferal_status").html("<span style = 'color :red;'><i class = 'icon-cross'></i>No refferal found with this Code.TRY AGAIN</span>");
									}
								}
							}
						);	
					}
					else
					{
						$("#refferal_status").html("")
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