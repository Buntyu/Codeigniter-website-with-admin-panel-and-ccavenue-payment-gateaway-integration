<?php
	$editurl = base_url()."admin/shipping/editedships";		
	$createurl = base_url()."admin/shipping/createshipping";		
?>
<div>
<!--	<a href = "" class = "btn btn-large btn-info addbrands" onclick="$('#brandsmodal').modal('show');return false;">Add Shipping</a> -->
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
		<input type ="hidden" name = "ships_count" value = "" class = "ships_count"/>
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
var strHtml = '<span class = "brand-addData">'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Country</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused country_name" id="focusedInput" name="country_name_'+count+'" type="text" value="" placeholder="Enter Country Name">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">0.0-1.0 (KG)</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused upto1" id="focusedInput" name="upto1_'+count+'" type="text" value="" placeholder="Enter charges for weight upto 1 KG">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">1.1-2.0 (KG)</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused upto2" id="focusedInput" name="upto2_'+count+'" type="text" value="" placeholder="Enter charges for weight upto 2 KG">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">2.1-3.0 (KG)</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused upto3" id="focusedInput" name="upto3_'+count+'" type="text" value="" placeholder="Enter charges for weight upto 3 KG">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">above 3.0 (KG)</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused above3" id="focusedInput" name="above3_'+count+'" type="text" value="" placeholder="Enter charges for weight above 3 KG">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Free Shipping</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused freeship" id="focusedInput" name="freeship_'+count+'" type="text" value="" placeholder="Enter charges for Free Shipping">'
			+'</div>'
			+'</div>';
			
				
	if(isedit != undefined)
	{
		strHtml	+= '<input type = "hidden" value = "" name = "ship_id_'+count+'" class = "ship_id"/>';

	}			
		
	strHtml += "</span>";
	return strHtml;
}



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
	$(".ships_count").val(g_count);
	
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
				$(".modal-header h3").html("Add New Shipping");		
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
                $(".country_name").attr("readonly","readonly");
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

						$(".modal-header h3").html(ob_data.country_name);
						$(".country_name").val(ob_data.country_name);
						$(".upto1").val(ob_data.upto1);
						$(".upto2").val(ob_data.upto2);
						$(".upto3").val(ob_data.upto3);
						$(".above3").val(ob_data.above3);
						$(".freeship").val(ob_data.freeship);
						$(".ship_id").val(ob_data.ship_id);		
									
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

