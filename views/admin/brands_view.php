<?php
	$editurl = base_url()."admin/brands/editedbrands";		
	$createurl = base_url()."admin/brands/createbrands";		
?>
<div>
	<a href = "" class = "btn btn-large btn-info addbrands" onclick="$('#brandsmodal').modal('show');return false;">Create Brands</a>
</div>
<div class="modal hide fade" id="brandsmodal">
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
		<input type ="hidden" name = "brands_func" value = "" class = "brands_func"/>
		<input type ="hidden" name = "brands_count" value = "" class = "brands_count"/>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content brandsmodal-body">
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
.center
{
	overflow: auto !important;
}
</style>
<script>

var g_count = 0;
function getbrandHtml(count,isedit)
{
var strHtml = '<span class = "brand-addData"><div class="control-group">'
			+'<label class="control-label" for="focusedInput">Brand Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused brands_name" id="focusedInput" name="brands_name_'+count+'" type="text" value="" placeholder="Enter Brand name">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Brand Image</label>'
			+'<div class="controls">';
	if(isedit != undefined)
	{
		strHtml	+='<img src = "" class="brandImg" style = "width:50px;height:50px;"/>';		
	}
	strHtml	+='<input class="input-large focused brands_image" id="focusedInput" name="brands_image_'+count+'" type="file" >'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Brand Description</label>'
			+'<div class="controls">'
			+'<textarea class="cleditor brands_description" name = "brands_description_'+count+'" id="brands_description" rows="3"></textarea>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Status</label>'
			+'<div class="controls">'
			+'<label><input type = "radio" class = "display_status" name = "display_status_'+count+'" checked value = "1"/>Enable</label>'
			+'<label><input type = "radio" class = "display_status" name = "display_status_'+count+'" value = "0"/>Disable</label>'
			+'</div>'
			+'</div>';	
	if(isedit != undefined)
	{
		strHtml	+= '<input type = "text" value = "" name = "brands_id_'+count+'" class = "brands_id"/>';
	}			
		
	strHtml += "</span>";
	return strHtml;
	

}//brands_name  brands_image display_status



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
	$(".brands_count").val(g_count);
	
}

function addField(isEdit)
{
	g_count++;
	$(".brandsmodal-body fieldset").append(getbrandHtml(g_count,isEdit));				
	if(isEdit == undefined)
	{
		$(".brand-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();	
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
				if($(".brand-addData").length > 1)
				{
					$(".brand-addData").last().remove();
					g_count--;					
				}				
			}
		);
		
		$(".addbrands").bind
		(
			"click",
			function()
			{
				g_count = 0;
				$(".addrembtns").show();
				$("#brandsmodal form").attr("action","<?php echo $createurl; ?>");
				$(".brands_func").val("create");
				$(".modal-header h3").html("Add new Categories");		
				$(".brandsmodal-body fieldset").html("");
				addField();				
				$(".modal-loader").hide();
				$(".brandsmodal-body").show();
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

		$("#brandsmodal form").attr("action","<?php echo $editurl; ?>");
		$(".brandsmodal-body fieldset").html("");
		addField(true);
		$(".addrembtns").hide();
		$(".brandsmodal-body").hide();
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User Type...");
		$(".brands_func").val("edit");
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
						$(".modal-header h3").html(ob_data.brand_name);
						//brand_name  brand_image display_status
						$(".brands_name").val(ob_data.brand_name);
						$(".brandImg").attr("src",ob_data.brand_image);						
						$(".display_status").each
						(
							function()
							{
								if($(this).val() == ob_data.display_status)
								{
									$(".display_status").removeAttr("checked");
									$(this).attr("checked","checked");
								}
							}
						);
						$(".brands_id").val(ob_data.brand_id);
						$(".brands_description").val(ob_data.brand_description);						
						$(".modal-loader").hide();
						$(".brandsmodal-body").show();
						$(".brand-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
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