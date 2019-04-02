<?php	
	$editurl = base_url()."admin/coupons/editedcoupons";
	$createurl = base_url()."admin/coupons/createcoupons";
?>
<div>
	<a href = "" class = "btn btn-large btn-info addcoupons" onclick="$('#areasmodal').modal('show');return false;">Add Coupons</a>
	
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
		<input type ="hidden" name = "coupons_func" value = "" class = "coupons_func"/>
		<input type ="hidden" name = "coupons_count" value = "" class = "coupons_count"/>
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
			+'<label class="control-label" for="focusedInput">Coupon Code</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused coupon_code" id="focusedInput" name="coupon_code_'+count+'" type="text" value="" placeholder="Enter Coupon Code">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Description</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused description" id="focusedInput" name="description_'+count+'" type="text" value="" placeholder="Enter Coupon Description">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Coupon Discount</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused coupon_discount" id="focusedInput" name="coupon_discount_'+count+'" type="text" value="" placeholder="Enter Coupon Discount Percent">'
			+'</div>'
			+'</div>';	
			
	if(isedit != undefined)
	{
		strHtml	+= '<input type = "hidden" value = "" name = "coupons_id_'+count+'" class = "coupons_id"/>';
	}			
		
	strHtml += "</span>";
	return strHtml;
}//coupons_name  coupons_image display_status



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
	$(".coupons_count").val(g_count);
	
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
		
		$(".addcoupons").bind
		(
			"click",
			function()
			{
				g_count = 0;
				$(".addrembtns").show();
				$("#areasmodal form").attr("action","<?php echo $createurl; ?>");
				$(".coupons_func").val("create");
				$(".modal-header h3").html("Add new Coupon");		
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
		$(".coupons_func").val("edit");
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
						$(".modal-header h3").html("Edit Coupons");
						//coupons_name  coupons_image display_status						
						$(".coupon_code").val(ob_data.coupon_code);
						$(".description").val(ob_data.description);						
						$(".coupon_discount").val(ob_data.discount);
						$(".coupons_id").val(ob_data.coupon_id);
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