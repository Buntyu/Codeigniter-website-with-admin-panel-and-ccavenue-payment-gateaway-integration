<?php
	$editurl = base_url()."admin/subcategories/editedsubcategories";		
	$createurl = base_url()."admin/subcategories/createsubcategories";		
?>
<div>
	<a href = "" class = "btn btn-large btn-info addcategories" onclick="$('#subcategorymodal').modal('show');return false;">Create Sub Categories</a>
</div>
<div class="modal hide fade" id="subcategorymodal">
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
			+'<label class="control-label" for="focusedInput">Sub Category Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused subcategory_name" id="focusedInput" name="category_name_'+count+'" type="text" value="" placeholder="Enter Sub Category name">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Sub Category Title</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused subcategory_title" id="focusedInput" name="category_title_'+count+'" type="text" value="" placeholder="Enter Sub Category title">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Sub Category Description</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused subcategory_description" id="focusedInput" name="category_description_'+count+'" type="text" value="" placeholder="Enter Sub Category description">'
			+'</div>'
			+'</div>';
			
	strHtml += '<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Parent Category</label>'
			+'<div class="controls">';			
	<?php 
		if($parentCategories)
		{
	?>
	strHtml += '<select name = "parent_category_id_'+count+'[]" class = "parent_category">';
	<?php
			foreach($parentCategories as $parent)
			{
				echo "strHtml += \"<option value = '".$parent['category_id']."'>".$parent['category_name']."</option>\";";
			}
	?>
	strHtml	+='</select>';
	<?php
		}
		else
		{
			echo  'strHtml += "<span style = \'color:red;\'>No Category found.</span>Please <a href = \''.base_url().'admin/categories\'>Add Category</a>";';
		}
	?>
	
			
	strHtml +='</div>'
			+'</div>';		
			
	strHtml	+='<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Sub Category Image</label>'
			+'<div class="controls">';
	if(isedit != undefined)
	{
		strHtml	+='<img src = "" class="catImg" style = "width:50px;height:50px;"/>';		
	}
	strHtml	+='<input class="input-large focused subcategory_image" id="focusedInput" name="category_image_'+count+'" type="file" >'
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
		strHtml	+= '<input type = "hidden" value = "" name = "subcategory_id_'+count+'" class = "subcategory_id"/>';
	}			
		
	strHtml += "</span>";
	return strHtml;
}//category_name  category_image display_status



function validate(oDiv,event)
{
	$(".category_count").val(g_count);
	var check = false;//,[type=file]
	$(oDiv).find("[type=text],[type=radio],select").each
	(
		function()
		{
			if(check == false && ($(this).val() == null || $(this).val() == "" || $(this).val().trim() == ""))
			{
				check = true;
				alert("All fields are compulsory");
				event.preventDefault();
				$(this).focus();				
			}			
		}
	);
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
				$("#subcategorymodal form").attr("action","<?php echo $createurl; ?>");
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
	/*
	$(".custom-table-rows").live
	(
		"click",
		function()
		{
			if($(this).hasClass("rowsel"))
			{
				$(this).removeClass("rowsel");	
			}			
			else
			{
				$(this).addClass("rowsel");
			}			
		}	
	);*/
	$(".editbtn").live("click",function()
	{
		g_count = 0;
		$("#subcategorymodal form").attr("action","<?php echo $editurl; ?>");
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
						$(".subcategory_name").val(ob_data.category_name);
						$(".subcategory_title").val(ob_data.category_title);
						$(".subcategory_description").val(ob_data.category_description);
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
						$(".subcategory_id").val(ob_data.category_id);
						var arrParentIds = ob_data.parent_category_id.split(","); 
						$(".parent_category").find("option").each
						(
							function()
							{
								if(arrParentIds.indexOf($(this).val()) != -1)
								{
									$(this).attr("selected","selected");
								}
							}
						);
						
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