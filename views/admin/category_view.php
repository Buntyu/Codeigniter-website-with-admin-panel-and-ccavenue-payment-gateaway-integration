<?php
	$editurl = base_url()."admin/categories/editedcategories";		
	$createurl = base_url()."admin/categories/createcategories";		
?>
<div>
	<a href = "" class = "btn btn-large btn-info addcategories" onclick="$('#categorymodal').modal('show');return false;">Create Categories</a>
</div>
<div class="modal hide fade" id="categorymodal">
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
		<input type ="hidden" name = "category_func" value = "" class = "category_func"/>
		<input type ="hidden" name = "category_count" value = "" class = "category_count"/>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content categoriesmodal-body">
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

<div class="modal hide fade" id="deletemodal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content deletemodal-body">
							<fieldset>
					<form class="delfrom2" action="<?php echo base_url();?>admin/categories/deletecategories/" name="delform" method="GET">
					<input type="hidden" name="id" class = "category_idd" value="">
						<input type="submit" id="delbtn" class="btn btn-large btn-danger" value="Delete">
						<button type="button" id="canbtn" class="btn btn-large" data-dismiss="modal">Cancel</button>
					</form>
					
							</fieldset>
				
				</div>				
			</div>
			
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

var g_count = 0;
function getcategoryHtml(count,isedit)
{
var strHtml = '<span class = "category-addData"><div class="control-group">'
			+'<label class="control-label" for="focusedInput">Category Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused category_name" id="focusedInput" name="category_name_'+count+'" type="text" value="" placeholder="Enter Category name">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Category Title (SEO)</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused category_title" id="focusedInput" name="category_title_'+count+'" type="text" value="" placeholder="Enter Category title">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Category Description (SEO)</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused category_description" id="focusedInput" name="category_description_'+count+'" type="text" value="" placeholder="Enter Category description">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Category Image</label>'
			+'<div class="controls">';
	if(isedit != undefined)
	{
		strHtml	+='<img src = "" class="catImg" style = "width:50px;height:50px;"/>';		
	}
	strHtml	+='<input class="input-large focused category_image" id="focusedInput" name="category_image_'+count+'" type="file" >'
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
		strHtml	+= '<input type = "hidden" value = "" name = "category_id_'+count+'" class = "category_id"/>';
	}			
		
	strHtml += "</span>";
	return strHtml;
}//category_name  category_image display_status



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
	$(".category_count").val(g_count);
	
}

function addField(isEdit)
{
	g_count++;
	$(".categoriesmodal-body fieldset").append(getcategoryHtml(g_count,isEdit));				
	if(isEdit == undefined)$(".category-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();	
}

$(document).ready
(
	function()
	{
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
				if($(".category-addData").length > 1)
				{
					$(".category-addData").last().remove();
					g_count--;					
				}				
			}
		);
		
		$(".addcategories").bind
		(
			"click",
			function()
			{
				g_count = 0;
				$(".addrembtns").show();
				$("#categorymodal form").attr("action","<?php echo $createurl; ?>");
				$(".category_func").val("create");
				$(".modal-header h3").html("Add new Categories");		
				$(".categoriesmodal-body fieldset").html("");
				addField();
				$(".modal-loader").hide();
				$(".categoriesmodal-body").show();
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
		$("#categorymodal form").attr("action","<?php echo $editurl; ?>");
		$(".categoriesmodal-body fieldset").html("");
		addField(true);
		$(".addrembtns").hide();
		$(".categoriesmodal-body").hide();
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User Type...");
		$(".category_func").val("edit");
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
						$(".modal-header h3").html(ob_data.category_name);
						//category_name  category_image display_status
						$(".category_name").val(ob_data.category_name);
						$(".category_title").val(ob_data.category_title);
						$(".category_description").val(ob_data.category_description);
						$(".catImg").attr("src",ob_data.category_image);						
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
						$(".category_id").val(ob_data.category_id);
						$(".modal-loader").hide();
						$(".categoriesmodal-body").show();
						$(".category-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
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
						$(".category_idd").val(ob_data);
						$(".modal-loader").hide();
						$(".categoriesmodal-body").show();
						$(".category-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
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