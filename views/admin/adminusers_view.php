<?php
	$editurl = base_url()."admin/adminusers/editeduser";		
	$createurl = base_url()."admin/adminusers/createadminuser";		
?>
<div>
	<a href = "" class = "btn btn-large btn-info addusertype" onclick="$('#adminusers_modal').modal('show');return false;">Create new User</a>
</div>
<div class="modal hide fade" id="adminusers_modal">
	<form action = "" method = "POST" class="form-horizontal" onsubmit="validate(this,event);">
		<input type ="hidden" name = "admin_id" value = "" class = "admin_id"/>
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
									<label class="control-label" for="focusedInput">User Name *</label>
									<div class="controls">
									  <input class="input-large focused admin_username" id="focusedInput" name="admin_username" type="text" value="" placeholder="Enter User name">
									</div>
							</div>
							
							<div class="control-group">
									<label class="control-label" for="focusedInput">Password *</label>
									<div class="controls">
									  <input class="input-large focused admin_password" id="focusedInput" name="admin_password" type="text" value="" placeholder="Enter Password">
									</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Name *</label>
								<div class="controls">
								  <input class="input-large focused admin_name" id="focusedInput" name="admin_name" type="text" value="" placeholder="Enter Type name">
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">User Type *</label>
								<div class="controls">
								  <select name = "user_type" class = "user_type">
								  	<?php
										foreach($user_types as $usertype)
										{
											echo "<option value = '".$usertype['user_type_id']."'>".$usertype['user_type_dpname']."</option>";
										}
									?>
								  </select>
								</div> 
							</div>  
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Email ID</label>
								<div class="controls">
								  <input class="input-large focused admin_email" id="focusedInput" name="admin_email" type="text" value="" placeholder="Enter Type name">
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Mobile</label>
								<div class="controls">
								  <input class="input-large focused admin_mobile" id="focusedInput" name="admin_mobile" type="text" value="" placeholder="Enter Type name">
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
	$(oDiv).find('.admin_username, .admin_password, .admin_name').each
	(
		function()
		{
			if(check == false && ($(this).val() == "" || $(this).val().trim() == ""))
			{
				check = true;
				alert("You Have Missed Some Mandatory Fields");
				event.preventDefault();
				$(this).focus();				
			}			
		}
	);	
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
				$("#adminusers_modal form").attr("action","<?php echo $createurl; ?>");
				$(".user_type_id").val("create");
				$(".modal-header h3").html("Add new User Type");
					
				
				$(".admin_username").val("");
				$(".admin_password").val("");
				   
				$(".admin_name").val("");
				$(".usertype").val("");
				$(".admin_email").val("");
				$(".admin_mobile").val("");
				
				$(".admin_id").val("");
				
					
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
		$("#adminusers_modal form").attr("action","<?php echo $editurl; ?>");
		$(".usereditmodal-body").hide();
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User...");
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
						$(".modal-header h3").html(ob_data.admin_name);
						$(".admin_username").val(ob_data.admin_username);
						$(".admin_password").val(ob_data.admin_password);
						   
						$(".admin_name").val(ob_data.admin_name);
						$(".user_type").val(ob_data.user_type_name);
						$(".admin_email").val(ob_data.admin_email);
						$(".admin_mobile").val(ob_data.admin_mobile);
						
						$(".admin_id").val(ob_data.admin_id);
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
</script>