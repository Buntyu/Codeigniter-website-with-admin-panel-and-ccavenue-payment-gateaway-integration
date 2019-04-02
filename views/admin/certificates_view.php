<?php	
	$editurl = base_url()."admin/certificates/editedcarousel";
	$createurl = base_url()."admin/certificates/createcarousel";
?>
<div>
	<a href = "" class = "btn btn-large btn-info addcarousel" onclick="$('#carouselmodal').modal('show');return false;">Upload certificate</a>
</div>
<div class="modal hide fade" id="carouselmodal">
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
		<input type ="hidden" name = "carousel_func" value = "" class = "carousel_func"/>
		<input type ="hidden" name = "carousel_count" value = "" class = "carousel_count"/>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content carouselmodal-body">
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
function getcarouselHtml(count,isedit)
{
var strHtml = '<span class = "carousel-addData"><div class="control-group">'			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">certificate Image</label>'
			+'<div class="controls">';
	if(isedit != undefined)
	{
		strHtml	+='<img src = "" class="catImg" style = "width:50px;height:50px;"/>';		
	}
	strHtml	+='<input class="input-large focused carousel_image" id="focusedInput" name="carousel_image_'+count+'" type="file" >'
			+'</div>'
			+'</div>'
		/*	+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Carousel Link</label>'
			+'<div class="controls">'
   		    +' <input class="input-xlarge focused carousel_link" id="focusedInput" name="carousel_link_'+count+'" type="text" value="" placeholder="Enter Carousel Link">'
			+'</div>'
			+'</div>'		*/	
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">certificate Caption</label>'
			+'<div class="controls">'
   		    +' <textarea class="cleditor input-large focused carousel_caption" id="focusedInput" name="carousel_caption_'+count+'" type="text" value="hidden" placeholder="Enter Caption"></textarea>'
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
		strHtml	+= '<input type = "hidden" value = "" name = "carousel_id_'+count+'" class = "carousel_id"/>';
	}			
		
	strHtml += "</span>";
	return strHtml;
}//carousel_name  carousel_image display_status



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
	$(".carousel_count").val(g_count);
	
}

function addField(isEdit)
{
	g_count++;
	$(".carouselmodal-body fieldset").append(getcarouselHtml(g_count,isEdit));				
	if(isEdit == undefined)
	{
		$(".carousel-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();	
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
				if($(".carousel-addData").length > 1)
				{
					$(".carousel-addData").last().remove();
					g_count--;					
				}				
			}
		);
		
		$(".addcarousel").bind
		(
			"click",
			function()
			{
				g_count = 0;
				$(".addrembtns").show();
				$("#carouselmodal form").attr("action","<?php echo $createurl; ?>");
				$(".carousel_func").val("create");
				$(".modal-header h3").html("Add new certificate");		
				$(".carouselmodal-body fieldset").html("");
				addField();
				$(".modal-loader").hide();
				$(".carouselmodal-body").show();
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
		$("#carouselmodal form").attr("action","<?php echo $editurl; ?>");
		$(".carouselmodal-body fieldset").html("");
		addField(true);
		$(".addrembtns").hide();
		$(".carouselmodal-body").hide();
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User Type...");
		$(".carousel_func").val("edit");
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
						$(".modal-header h3").html("Edit certificate");
						//carousel_name  carousel_image display_status
						
						$(".carousel_link").val(ob_data.carousel_link);
						$(".carousel_caption").val(ob_data.carousel_caption);
						$(".catImg").attr("src",ob_data.carousel_image);						
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
						$(".carousel_id").val(ob_data.carousel_id);
						$(".modal-loader").hide();
						$(".carouselmodal-body").show();
						$(".carousel-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
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