<?php
	$editurl = base_url()."admin/blogs/editedproduct";		
	$createurl = base_url()."admin/blogs/createblog";		
	if(isset($redirect))
	{
		$editurl = base_url()."admin/blogs/editedproduct".$redirect;
		$createurl = base_url()."admin/blogs/createblog".$redirect;		
	}
	
	
?>
<div>
	<a href = "" class = "btn btn-large btn-info addproduct" onclick="$('#productmodal').show('slow');$(this).hide('slow');return false;">Add Blog</a>

</div>
<div class="" style = "display: none;" id="productmodal">
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
		<input type ="hidden" name = "product_func" value = "" class = "product_func"/>
		<input type ="hidden" name = "product_count" value = "" class = "product_count"/>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&mdash; hide</button>
				<h3></h3>
			</div>
			<div class="">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content productmodal-body">
							<fieldset>
							
							</fieldset>
				</div>				
			</div>
			<div class="modal-footer">
				<a href="#" class="btn closebtn" data-dismiss="modal">Close</a>
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
					<form class="delfrom2" action="<?php echo base_url();?>admin/blogs/deleteproduct/" name="delform" method="GET">
					<input type="hidden" name="id" class = "category_idd" value="">
						<input type="submit" id="delbtn" class="btn btn-large btn-danger" value="Delete">
						<button type="button" id="canbtn" class="btn btn-large" data-dismiss="modal">Cancel</button>
					</form>
					
							</fieldset>
				
				</div>				
			</div>
			
</div>

<style>
#productmodal
{
	-webkit-transition: opacity .3s linear, top .3s ease-out;
	-moz-transition: opacity .3s linear, top .3s ease-out;
	-ms-transition: opacity .3s linear, top .3s ease-out;
	-o-transition: opacity .3s linear, top .3s ease-out;
	transition: opacity .3s linear, top .3s ease-out;
}
#selectError1_chzn
{
	width: 220px !important;
}
.btn-setting
{
	display: none !important;
}
.hideIt
{
	display:none;
}
.my-label {
    text-align: left !important;
    width:112px !important;
}
.variaDiv {
    background-color: #d3d3d3;
    border: 1px solid black;
    margin: 33px 0px;
    padding: 24px 9px;
}
.opPanel {
    text-align: center;
}
.add-row {
    margin-right: 7px;
}
.variation-table {
    margin: auto;
}
.hidefake
{
	display: none;
}

</style>
<script>

var g_count = 0;
function getproductHtml(count,isedit)
{
var strHtml = '<span class = "product-addData"><div class="control-group">'
			+'<label class="control-label" for="focusedInput">Blog Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused blog_name" id="focusedInput" name="blog_name_'+count+'" type="text" value="" placeholder="Enter Blog name">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Blog Title (SEO)</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused blog_title" id="focusedInput" name="blog_title_'+count+'" type="text" value="" placeholder="Enter Blog Title">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Blog Description (SEO)</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused blog_description" id="focusedInput" name="blog_description_'+count+'" type="text" value="" placeholder="Enter Blog Description">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Featured Image</label>'
			+'<div class="controls">';
	if(isedit != undefined)
	{
		strHtml	+='<img src = "" class="prodImg" style = "width:50px;height:50px;"/>';		
	}
	strHtml	+='<input class="input-large focused featured_image" id="focusedInput" name="featured_image_'+count+'" type="file" >'
			+'</div>'
			+'</div>'
		
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Blog Content</label>'
			+'<div class="controls">'
   		    +' <textarea class="cleditor input-large focused blog_content" id="focusedInput" name="blog_content_'+count+'" type="text" value="" placeholder="Enter Blog Content"></textarea>'
			+'</div>'
			+'</div>'  
            
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Display Status</label>'
			+'<div class="controls">'
			+'<label><input type = "radio" class = "display_status" name = "display_status_'+count+'" checked value = "1"/>Enable</label>'
			+'<label><input type = "radio" class = "display_status" name = "display_status_'+count+'" value = "0"/>Disable</label>'
			+'</div>'
			+'</div>';
				
	
	if(isedit != undefined)
	{
		strHtml	+= '<input type = "hidden" value = "" name = "blog_id_'+count+'" class = "blog_id"/>';
	}			
	
	strHtml += "<center style = 'width : 100%'>"
				+"<div style = 'width: 90%;border-top: 1px solid #B3B3B3;padding-bottom: 20px;padding-top: 20px;'></div></center>";
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
	$(".product_count").val(g_count);
	
}
function addField(isEdit)
{
	g_count++;
	$(".productmodal-body fieldset").append(getproductHtml(g_count,isEdit));				
	if(isEdit == undefined)
	{
		$(".product-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();	
		setTimeout(function(){$(".cleditor").cleditor();},300);
	}
}
$(document).ready
(

	function()
	{
	
		$.cleditor.defaultOptions.width = 800;
		$.cleditor.defaultOptions.height = 500;
		$(".close,.closebtn").bind("click",function(){$("#productmodal").hide("slow");$(".addproduct").show("slow");})
		$(".discount_price, .discount_percent,.product_price").live
		(
			"keyup",function()
			{
				var oParent = $(this).closest(".product-addData");
				var prod_price = (isNaN(oParent.find(".product_price").val())) ? 0 : oParent.find(".product_price").val();
				if(prod_price == 0)
				{
					//alert("Please Enter Product Price first.");
					oParent.find(".product_price").focus();
					return false;
				}
				var disc_price = (isNaN(oParent.find(".discount_price").val())) ? 0 : oParent.find(".discount_price").val();
				var disc_per = (isNaN(oParent.find(".discount_percent").val())) ? 0 :oParent.find(".discount_percent").val();			
				if($(this).hasClass("discount_price"))
				{
					oParent.find(".discount_percent").val(100-((disc_price/prod_price)*100));
				}
				else if($(this).hasClass("discount_percent"))
				{
					oParent.find(".discount_price").val(prod_price-((disc_per/100)*prod_price));
				}
				else
				{
					if(disc_per != 0)
					{
						oParent.find(".discount_price").val(prod_price-((disc_per/100)*prod_price));
					}									
				}
			}
		)

		
		$(".addproduct").bind
		(
			"click",
			function()
			{
				g_count = 0;
				$(".addrembtns").show();
				$("#productmodal form").attr("action","<?php echo $createurl; ?>");
				$(".product_func").val("create");
				$(".modal-header h3").html("Add new Blog");		
				$(".productmodal-body fieldset").html("");
				addField();
				$(".modal-loader").hide();
				$(".productmodal-body").show();
				return false;
			}
		);
		var chk = setInterval(function(){$(".editbtn").attr("onclick","window.scrollTo(0,0);$('.addproduct').show('slow');$('#productmodal').show('slow');return false;");},1000);
	}
);		


function customTableEvent()
{	
	$(".editbtn").live("click",function()
	{
		g_count = 0;
		$("#productmodal form").attr("action","<?php echo $editurl; ?>");
		$(".productmodal-body fieldset").html("");
		addField(true);
		$(".addrembtns").hide();
		$(".productmodal-body").hide();
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User Type...");
		$(".product_func").val("edit");
		$.ajax
		(
			{
				url : $(this).attr("href"),
				//console.log(url);
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
						$(".modal-header h3").html(ob_data.blog_name);
						$(".blog_name").val(ob_data.blog_name);
						$(".featured_image").attr("src",ob_data.featured_image);
						$(".blog_content").val(ob_data.blog_content);
						$(".blog_description").val(ob_data.blog_description);
						$(".blog_title").val(ob_data.blog_title);
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
						
						$(".blog_id").val(ob_data.blog_id);
						$(".modal-loader").hide();
						$(".productmodal-body").show();
						$(".product-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
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