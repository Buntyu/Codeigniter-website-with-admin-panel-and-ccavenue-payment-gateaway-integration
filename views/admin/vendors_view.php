<?php
	$editurl = base_url()."admin/vendors/editedvendors";		
	$createurl = base_url()."admin/vendors/createvendors";		
?>
<div>
	<a href = "" class = "btn btn-large btn-info addvendors" onclick="$('#vendorsmodal').modal('show');return false;">Create Vendors</a>
</div>
<div class="modal hide fade" id="vendorsmodal">
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
		<input type ="hidden" name = "vendors_func" value = "" class = "vendors_func"/>
		<input type ="hidden" name = "vendors_count" value = "" class = "vendors_count"/>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content vendorsmodal-body">
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
<style>
#selectError1_chzn
{
	width: 220px !important;
}
.btn-setting
{
	display: none !important;
}
.control-group label small
{
	font-size: 10px;
	color: #A7A7A7;
}
</style>
<script>

var g_count = 0;
function getvendorsHtml(count,isedit)
{
var strHtml = '<span class = "vendors-addData"><div class="control-group">'
			+'<label class="control-label" for="focusedInput">Vendor Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused vendor_name" id="focusedInput" name="vendor_name_'+count+'" type="text" value="" placeholder="Enter Vendor name">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Vendor\'s Address</label>'
			+'<div class="controls">'
   		    +' <textarea class="cleditor input-large focused vendor_address" id="focusedInput" name="vendor_address_'+count+'" type="text" value="" placeholder="Enter Vendor\'s name"></textarea>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">PINCODE</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused vendor_pin" id="focusedInput" name="vendor_pin_'+count+'" type="text" value="" placeholder="Enter PINCODE">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Email Id</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused vendor_email" id="focusedInput" name="vendor_email_'+count+'" type="text" value="" placeholder="Enter Email ID">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Mobile Numbers<br /><small>(Enter Comma seperated for multiple values)</small></label>'
			+'<div class="controls">'
   		    +' <textarea class="input-xlarge focused vendor_mobile" id="focusedInput" name="vendor_mobile_'+count+'" type="text" value="" placeholder="Enter Mobile Numbers \n (Enter Comma seperated for multiple values)"></textarea>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Phone Numbers<br /><small>(Enter Comma seperated for multiple values)</small></label>'
			+'<div class="controls">'
   		    +' <textarea class="input-xlarge focused vendor_phone" id="focusedInput" name="vendor_phone_'+count+'" type="text" value="" placeholder="Enter Phone numbers \n (Enter Comma seperated for multiple values)"></textarea>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Areas<br /><small>(Enter Comma seperated for multiple values)</small></label>'
			+'<div class="controls">';
   	<?php 
		if($oObj->areas)
		{
	?>
	strHtml += '<select name = "vendor_area_'+count+'[]" multiple class = "vendor_area">';
	<?php
			foreach($oObj->areas as $parent)
			{
				echo "strHtml += \"<option value = '".$parent['area_name']."'>".$parent['area_name']."</option>\";";
			}
	?>
	strHtml	+='</select>';
	<?php
		}
		else
		{
			echo  'strHtml += "<span style = \'color:red;\'>No Areas found.</span>Please <a href = \''.base_url().'admin/areas\'>Add Area</a>";';
		}
	?>
	strHtml +='</div>'
			+'</div>';
	if(isedit != undefined)
	{
		strHtml	+= '<input type = "hidden" value = "" name = "vendor_id_'+count+'" class = "vendor_id"/>';
	}			
		
	strHtml += "</span><center style = 'width : 100%'>"
				+"<div style = 'width: 90%;border-top: 1px solid #B3B3B3;padding-bottom: 20px;'></div></center>";
	return strHtml;
}//vendor_name  vendors_image display_status



function validate(oDiv,event)
{
	var check = false;//,[type=file]
	$(oDiv).find("[type=text], .vendor_mobile, .vendor_area").each
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
	$(".vendors_count").val(g_count);
	
}

function addField(isEdit)
{
	g_count++;
	$(".vendorsmodal-body fieldset").append(getvendorsHtml(g_count,isEdit));				
	if(isEdit == undefined)
	{
		$(".vendors-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
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
				if($(".vendors-addData").length > 1)
				{
					$(".vendors-addData").last().remove();
					g_count--;					
				}				
			}
		);
		
		$(".addvendors").bind
		(
			"click",
			function()
			{
				g_count = 0;
				$(".addrembtns").show();
				$("#vendorsmodal form").attr("action","<?php echo $createurl; ?>");
				$(".vendors_func").val("create");
				$(".modal-header h3").html("Add new vendors");		
				$(".vendorsmodal-body fieldset").html("");
				addField();
				$(".modal-loader").hide();
				$(".vendorsmodal-body").show();
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
		$("#vendorsmodal form").attr("action","<?php echo $editurl; ?>");
		$(".vendorsmodal-body fieldset").html("");
		addField(true);
		$(".addrembtns").hide();
		$(".vendorsmodal-body").hide();
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User Type...");
		$(".vendors_func").val("edit");
		$.ajax
		(
			{
				url : $(this).attr("href"),
				success : function(data)
				{	debugger;
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
						$(".modal-header h3").html(ob_data.vendor_name);
						//vendor_name  vendors_image display_status
						$(".vendor_name").val(ob_data.vendor_name);							
						
						$(".vendor_address").val(ob_data.vendor_address);
						$(".vendor_pin").val(ob_data.vendor_pin);
						$(".vendor_email").val(ob_data.vendor_email);						
						$(".vendor_mobile").val(ob_data.vendor_mobile);
						$(".vendor_phone").val(ob_data.vendor_phone);
					//	$(".vendor_area").val(ob_data.vendor_area);
						
						var arrVendor_area = ob_data.vendor_area.split(",");
						$(".vendor_area").find("option").each
						(
							function()
							{
								if(arrVendor_area.indexOf($(this).val()) != -1)
								{
									$(this).attr("selected","selected");
								}
							}
						);
						
						$(".vendor_id").val(ob_data.vendor_id);
						$(".modal-loader").hide();
						$(".vendorsmodal-body").show();
						$(".vendors-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
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
}
</script>