<?php	
	$editurl = base_url()."admin/areas/editedareas";
	$createurl = base_url()."admin/areas/createareas";
?>
<div>
	<a href = "" class = "btn btn-large btn-info addareas" onclick="$('#areasmodal').modal('show');return false;">Add Areas</a>
</div>
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
			+'<label class="control-label" for="focusedInput">Area Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused areas_name" id="focusedInput" name="areas_name_'+count+'" type="text" value="" placeholder="Enter Areas Link">'
			+'</div>'
			+'</div>'			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Area PIN</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused areas_pin" id="focusedInput" name="areas_pin_'+count+'" type="text" value="" placeholder="Enter Areas Link">'
			+'</div>'
			+'</div>';	
	if(isedit != undefined)
	{
		strHtml	+= '<input type = "hidden" value = "" name = "areas_id_'+count+'" class = "areas_id"/>';
	}			
		
	strHtml += "</span>";
	return strHtml;
}//areas_name  areas_image display_status



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
				$(".modal-header h3").html("Add new areas");		
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
						$(".modal-header h3").html("Edit Areas");
						//areas_name  areas_image display_status						
						$(".areas_name").val(ob_data.area_name);
						$(".areas_pin").val(ob_data.area_pin);						
						$(".areas_id").val(ob_data.area_id);
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
}
</script>