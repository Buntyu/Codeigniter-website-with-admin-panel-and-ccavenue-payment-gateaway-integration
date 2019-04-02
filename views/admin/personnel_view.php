<?php	
	$editurl = base_url()."admin/personnel/editedareas";
	$createurl = base_url()."admin/personnel/createareas";
?>
<!--
<div>
	<a href = "" class = "btn btn-large btn-info addareas" onclick="$('#areasmodal').modal('show');return false;">Add Affiliate</a>
</div>
-->
<div class="modal hide fade" id="areasmodal">
	<!--<form action = "" method = "POST" class="form-horizontal" onsubmit="">-->
	<?php 
		$attr = array
		(
			"method"=>"POST",
			"class"=>"form-horizontal",
			"onsubmit"=>"validate(this,event);"
		);
		echo form_open_multipart("",$attr);
	?>
		<input type ="hidden" name = "areas_func" value = "" class = "areas_func"/>
		<input type ="hidden" name = "areas_count" value = "" class = "areas_count"/>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content areasmodal-body">
							<fieldset>
							
							</fieldset>
				<span class = "addrembtns">
					<span class = "btn btn-success addmorebtn">Add more</span>
					<span class = "btn btn-danger removemorebtn">Remove</span>
				</span>
				</div>				
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<input type = "submit" value = "Save changes" class="btn btn-primary" />
			</div>
	</form>
</div>
<div class="modal hide fade" id="deleteareasmodal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content deleteareasmodal-body">
							<fieldset>
					<form class="delfrom2" action="<?php echo base_url();?>admin/personnel/deleteareas/" name="delform" method="GET">
					<input type="hidden" name="id" class = "affiliate_idd" value="">
						<input type="submit" id="delbtn" class="btn btn-large btn-danger" value="Delete">
						<button type="button" id="canbtn" class="btn btn-large" data-dismiss="modal">Cancel</button>
					</form>
					
							</fieldset>
				
				</div>				
			</div>
			
</div>
<style>
.modal-body
{
	max-height: 350px!important;
}
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

var g_count = 0;
function getareasHtml(count,isedit)
{
var strHtml = '<span class = "areas-addData">'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused first_name" id="focusedInput" name="first_name_'+count+'" type="text" value="" placeholder="Enter Name">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Mobile Number</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused mobile_number" id="focusedInput" name="mobile_number_'+count+'" type="text" value="" placeholder="Enter Mobile Number">'
			+'</div>'
			+'</div>'

     /*       +'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Last Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused last_name" id="focusedInput" name="last_name_'+count+'" type="text" value="" placeholder="Enter Last Name">'
			+'</div>'
			+'</div>'  */

			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Email</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused person_email" id="focusedInput" name="person_email_'+count+'" type="text" value="" placeholder="Enter Email">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Aadhar Number</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused aadhar_number" id="focusedInput" name="aadhar_number_'+count+'" type="text" value="" placeholder="Enter Aadhar Number">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Pan Number</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused pan_number" id="focusedInput" name="pan_number_'+count+'" type="text" value="" placeholder="Enter Pan Number">'
			+'</div>'
			+'</div>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Refferal Code</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused reff_code" id="focusedInput" name="reff_code_'+count+'" type="text" value="" placeholder="Enter Refferal Code" readonly>'
			+'</div>'
			+'</div>'
			+'<h4>Bank Account Details</h4><br>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Bank Account Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused account_name" id="focusedInput" name="account_name_'+count+'" type="text" value="" placeholder="Enter Bank Account Name">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Account Number</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused account_number" id="focusedInput" name="account_number_'+count+'" type="text" value="" placeholder="Enter Account Number">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Bank Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused bank_name" id="focusedInput" name="bank_name_'+count+'" type="text" value="" placeholder="Enter Bank Name">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">IFSC Code</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused ifsc_code" id="focusedInput" name="ifsc_code_'+count+'" type="text" value="" placeholder="Enter IFSC Code">'
			+'</div>'
			+'</div>';
				
	if(isedit != undefined)
	{
		strHtml	+= '<input type = "hidden" value = "" name = "affiliate_id_'+count+'" class = "person_id"/>';
	}			
		
	strHtml += "</span>";
	return strHtml;
}//person_name  person_image display_status



function validate(oDiv,event)
{
	var check = false;//,[type=file]
	$(oDiv).find("[type=text],[type=radio]").each
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
	$(".areas_count").val(g_count);
	
}

function addField(isEdit)
{
	g_count++;
	$(".areasmodal-body fieldset").append(getareasHtml(g_count,isEdit));				
	if(isEdit == undefined)
	{
		$(".areas-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();	
	setTimeout(function(){$(".cleditor").cleditor();},300);
	}	
}

$(document).ready
(
	function()
	{
		$.cleditor.defaultOptions.width = 300;
		$.cleditor.defaultOptions.height = 300;
		$(".addmorebtn").bind
		(
			"click",
			function()
			{
				addField();
				//docReady();
			}
		);
		
		$(".removemorebtn").bind
		(
			"click",
			function()
			{
				if($(".areas-addData").length > 1)
				{
					$(".areas-addData").last().remove();
					g_count--;					
				}				
			}
		);
		
		$(".addareas").bind
		(
			"click",
			function()
			{
				g_count = 0;
				$(".addrembtns").show();
				$("#areasmodal form").attr("action","<?php echo $createurl; ?>");
				$(".areas_func").val("create");
				$(".modal-header h3").html("Add new Affiliate");		
				$(".areasmodal-body fieldset").html("");
				addField();
				$(".modal-loader").hide();
				$(".areasmodal-body").show();
				return false;
			}
		);
	}
);		
function customTableEvent()
{
	
	$(".editbtn").live("click",function()
	{
		g_count = 0;
		$("#areasmodal form").attr("action","<?php echo $editurl; ?>");
		$(".areasmodal-body fieldset").html("");
		addField(true);
		$(".addrembtns").hide();
		$(".areasmodal-body").hide();
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User Type...");
		$(".areas_func").val("edit");
		$.ajax
		(
			{
				url : $(this).attr("href"),
				success : function(data)
				{	
					try
					{
						var response = JSON.parse(data);
					}
					catch(e)
					{
						alert("REQUEST FAILED!!! Reloading this page...");
						window.location.href = window.location.href;
					}	
					if(response.status == "success")
					{
						var ob_data = response.data[0];
						$(".modal-header h3").html("Edit Affiliate");
						//person_name  person_image display_status						
						$(".first_name").val(ob_data.first_name);
						$(".mobile_number").val(ob_data.mobile_phone);
						$(".person_email").val(ob_data.email);
						$(".aadhar_number").val(ob_data.aadhar_number);
						$(".pan_number").val(ob_data.pan_number);
						$(".account_name").val(ob_data.account_name);
						$(".account_number").val(ob_data.account_number);
						$(".bank_name").val(ob_data.bank_name);
						$(".ifsc_code").val(ob_data.ifsc_code);						
						$(".person_id").val(ob_data.affiliate_id);
						$(".reff_code").val(ob_data.user_id);
						$(".modal-loader").hide();
						$(".areasmodal-body").show();
						$(".areas-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
						setTimeout(function(){$(".cleditor").cleditor();},300);
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
	
	$(".deletebtn").live("click",function()
	{
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User Type...");
		$.ajax
		(
			{
				url : $(this).attr("href"),
				success : function(data)
				{	
					try
					{
						var response = JSON.parse(data);	
					}
					catch(e)
					{
						alert("REQUEST FAILED!!! Reloading this page...");
						window.location.href = window.location.href;
					}	
					if(response.status == "success")
					{
						var ob_data = response.data;
						$(".modal-header h3").html('Are You Sure You Want to Delete?');
						$(".affiliate_idd").val(ob_data);
						$(".modal-loader").hide();
						
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