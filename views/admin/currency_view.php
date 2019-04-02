<?php
	$editurl = base_url()."admin/currency/editedbrands";		
	$createurl = base_url()."admin/currency/createbrands";		
?>
<div>
	<a href = "" class = "btn btn-large btn-info addbrands" onclick="$('#brandsmodal').modal('show');return false;">Add Currency</a>
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
var strHtml = '<span class = "brand-addData">'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Currency Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused currency_name" id="focusedInput" name="currency_name_'+count+'" type="text" value="" placeholder="Enter Currency name">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Currency Symbol</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused currency_symbol" id="focusedInput" name="currency_symbol_'+count+'" type="text" value="" placeholder="Enter Currency Symbol">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Currency Amount</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused currency_amount" id="focusedInput" name="currency_amount_'+count+'" type="text" value="" placeholder="Enter Currency Amount">'
			+'</div>'
			+'</div>';
			
				
	if(isedit != undefined)
	{
		strHtml	+= '<input type = "hidden" value = "" name = "curr_id_'+count+'" class = "currency_id"/>';

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
				$(".modal-header h3").html("Add New Currency");		
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

						$(".modal-header h3").html(ob_data.curr_name);
						//brand_name  brand_image display_status
						$(".currency_name").val(ob_data.curr_name);
						$(".currency_symbol").val(ob_data.curr_symbol);
						$(".currency_amount").val(ob_data.curr_amount);
						$(".currency_id").val(ob_data.curr_id);		
									
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