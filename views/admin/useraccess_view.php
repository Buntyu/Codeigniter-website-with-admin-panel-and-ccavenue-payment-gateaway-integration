<?php
	$editurl = base_url()."admin/useraccess/editeduser";		
	$createurl = base_url()."admin/useraccess/createusertype";		
?>
<div>
	<a href = "" class = "btn btn-large btn-info addusertype" onclick="$('#useredit_modal').modal('show');return false;">Create User Type</a>
</div>
<div class="modal hide fade" id="useredit_modal">
	<form action = "" method = "POST" class="form-horizontal" onsubmit="validate(this,event);">
		<input type ="hidden" name = "user_type_id" value = "" class = "user_type_id"/>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content usereditmodal-body">
							<fieldset>
							<div class="control-group">
									<label class="control-label" for="focusedInput">Type Name</label>
									<div class="controls">
									  <input class="input-large focused typename" id="focusedInput" name="typename" type="text" value="" placeholder="Enter Type name">
									</div>
							</div>
							<div class="control-group">
									<label class="control-label" for="focusedInput">Display Name</label>
									<div class="controls">
									  <input class="input-large focused displayname" id="focusedInput" name="displayname" type="text" value="" placeholder="Enter display name">
									</div>
							</div>
							<div class="control-group">
									<label class="control-label" for="selectError1">Select Modules</label>
									<div class="controls">
									  <select id="selectError1" class = "selmodules" multiple name = "allowed_modules[]" >
										<?php 
											if($modules)
											{
												foreach($modules as $module)
												{
													echo "<option value = '".$module['module_name']."'>".$module['module_name']."</option>";
												}
											}
										?>
									  </select>
									</div> 	
							</div>
							</fieldset>
					
					</div>				
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<input type = "submit" value = "Save changes" class="btn btn-primary" />
			</div>
	</form>
</div>
<style>
#selectError1_chzn
{
	width: 220px !important;
}
.btn-setting
{
	display: none !important;
}
</style>
<script>
function validate(oDiv,event)
{
	var check = false;
	$(oDiv).find("input").each
	(
		function()
		{
			if(check == false && ($(this).val() == "" || $(this).val().trim() == ""))
			{
				check = true;
				alert("All fields are compulsory");
				event.preventDefault();
				$(this).focus();				
			}			
		}
	);
	if(check == false && ($(".selmodules").val() == "" || $(".selmodules").val() == null))
	{
		alert("All fields are compulsory");
		event.preventDefault();
		$(this).focus();				
	}
}

$(document).ready
(
	function()
	{
		$(".addusertype").bind
		(
			"click",
			function()
			{
				$("#useredit_modal form").attr("action","<?php echo $createurl; ?>");
				$(".user_type_id").val("create");
				$(".modal-header h3").html("Add new User Type");
				$(".typename").val("");
				$(".displayname").val("");
				$(".selmodules").find("option").removeAttr("selected");				
				$(".modal-loader").hide();
				$(".usereditmodal-body").show();
				return false;
			}
		);
	}
);		
function customTableEvent()
{
	$(".editbtn").live("click",function()
	{
		$("#useredit_modal form").attr("action","<?php echo $editurl; ?>");
		$(".usereditmodal-body").hide();
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User Type...");
		$.ajax
		(
			{
				url : $(this).attr("href"),
				success : function(data)
				{
					var response = JSON.parse(data);							
					if(response.status == "success")
					{
						var ob_data = response.data[0];
						$(".modal-header h3").html(ob_data.user_type_name);
						$(".typename").val(ob_data.user_type_name);
						$(".displayname").val(ob_data.user_type_dpname);
						if(ob_data.allowed_links != "")
						{
							$(".selmodules").find("option").removeAttr("selected");
							if(ob_data.allowed_links == "*")
							{
								$(".selmodules").find("option").each
								(
									function()
									{
										$(this).attr("selected","selected");
									}
								);
							}
							else
							{
								var splitter = ob_data.allowed_links.split(",");								
								for(i in splitter)
								{
									$(".selmodules").find("option").each
															(
																function()
																{
																	if($(this).attr("value").trim() == splitter[i].trim())
																	{
																		$(this).attr("selected","selected");
																	}
																}
															);
								}
							}																		
						}
						$(".user_type_id").val(ob_data.user_type_id);
						$(".modal-loader").hide();
						$(".usereditmodal-body").show();
					}
				},
				fail : function()
				{
					alert("There is some problem with your request...");
					window.location.href = window.location.href;
				}
			}
		);				
	});
}
		/**
* allowed_links: "test"
user_type_dpname: "UserA"
user_type_id: "2"
user_type_name: "usera"
*/
</script>

<!-- 
							<div class="control-group">
								<label class="control-label" for="focusedInput">Focused input</label>
								<div class="controls">
								  <input class="input-large focused" id="focusedInput" type="text" value="This is focused…">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Uneditable input</label>
								<div class="controls">
								  <span class="input-large uneditable-input">Some value here</span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="disabledInput">Disabled input</label>
								<div class="controls">
								  <input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="Disabled input here…" disabled="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="optionsCheckbox2">Disabled checkbox</label>
								<div class="controls">
								  <label class="checkbox">
									<input type="checkbox" id="optionsCheckbox2" value="option1" disabled="">
									This is a disabled checkbox
								  </label>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Input with warning</label>
								<div class="controls">
								  <input type="text" id="inputWarning">
								  <span class="help-inline">Something may have gone wrong</span>
								</div>
							  </div>
							  <div class="control-group error">
								<label class="control-label" for="inputError">Input with error</label>
								<div class="controls">
								  <input type="text" id="inputError">
								  <span class="help-inline">Please correct the error</span>
								</div>
							  </div>
							  <div class="control-group success">
								<label class="control-label" for="inputSuccess">Input with success</label>
								<div class="controls">
								  <input type="text" id="inputSuccess">
								  <span class="help-inline">Woohoo!</span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">Plain Select</label>
								<div class="controls">
								  <select id="selectError3">
									<option>Option 1</option>
									<option>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError">Modern Select</label>
								<div class="controls">
								  <select id="selectError" data-rel="chosen">
									<option>Option 1</option>
									<option>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError1">Multiple Select / Tags</label>
								<div class="controls">
								  <select id="selectError1" multiple data-rel="chosen">
									<option>Option 1</option>
									<option selected>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError2">Group Select</label>
								<div class="controls">
									<select data-placeholder="Your Favorite Football Team" id="selectError2" data-rel="chosen">
										<option value=""></option>
										<optgroup label="NFC EAST">
										  <option>Dallas Cowboys</option>
										  <option>New York Giants</option>
										  <option>Philadelphia Eagles</option>
										  <option>Washington Redskins</option>
										</optgroup>
										<optgroup label="NFC NORTH">
										  <option>Chicago Bears</option>
										  <option>Detroit Lions</option>
										  <option>Green Bay Packers</option>
										  <option>Minnesota Vikings</option>
										</optgroup>
										<optgroup label="NFC SOUTH">
										  <option>Atlanta Falcons</option>
										  <option>Carolina Panthers</option>
										  <option>New Orleans Saints</option>
										  <option>Tampa Bay Buccaneers</option>
										</optgroup>
										<optgroup label="NFC WEST">
										  <option>Arizona Cardinals</option>
										  <option>St. Louis Rams</option>
										  <option>San Francisco 49ers</option>
										  <option>Seattle Seahawks</option>
										</optgroup>
										<optgroup label="AFC EAST">
										  <option>Buffalo Bills</option>
										  <option>Miami Dolphins</option>
										  <option>New England Patriots</option>
										  <option>New York Jets</option>
										</optgroup>
										<optgroup label="AFC NORTH">
										  <option>Baltimore Ravens</option>
										  <option>Cincinnati Bengals</option>
										  <option>Cleveland Browns</option>
										  <option>Pittsburgh Steelers</option>
										</optgroup>
										<optgroup label="AFC SOUTH">
										  <option>Houston Texans</option>
										  <option>Indianapolis Colts</option>
										  <option>Jacksonville Jaguars</option>
										  <option>Tennessee Titans</option>
										</optgroup>
										<optgroup label="AFC WEST">
										  <option>Denver Broncos</option>
										  <option>Kansas City Chiefs</option>
										  <option>Oakland Raiders</option>
										  <option>San Diego Chargers</option>
										</optgroup>
								  </select>
								</div>
							  </div>
-->