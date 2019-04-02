<?php
	$editurl = base_url()."admin/product/editedproduct";		
	$createurl = base_url()."admin/product/createproduct";		
	if(isset($redirect))
	{
		$editurl = base_url()."admin/product/editedproduct".$redirect;
		$createurl = base_url()."admin/product/createproduct".$redirect;		
	}
	
	
?>
<div>
	<a href = "" class = "btn btn-large btn-info addproduct" onclick="$('#productmodal').show('slow');$(this).hide('slow');return false;">Create Product</a>

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
	<!--			<span class = "addrembtns">
					<span class = "btn btn-success addmorebtn">Add more</span>
					<span class = "btn btn-danger removemorebtn">Remove</span>

				</span>  -->
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
					<form class="delfrom2" action="<?php echo base_url();?>admin/product/deleteproduct/" name="delform" method="GET">
					<input type="hidden" name="id" class = "product_idd" value="">
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

<span class="inr-curr hideIt"><?php echo $inr; ?> </span>
<span class="aud-curr hideIt"><?php echo $aud; ?> </span>
<span class="usd-curr hideIt"><?php echo $usd; ?></span>
<span class="gbp-curr hideIt"><?php echo $gbp; ?> </span>
<span class="euro-curr hideIt"><?php echo $euro; ?></span>
<span class="cad-curr hideIt"><?php echo $cad; ?></span>

<script>

var g_count = 0;
function getproductHtml(count,isedit)
{
var strHtml = '<span class = "product-addData"><div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Name</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused product_name" id="focusedInput" name="product_name_'+count+'" type="text" value="" placeholder="Enter Product name">'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Image</label>'
			+'<div class="controls">';
	if(isedit != undefined)
	{
		strHtml	+='<img src = "" class="prodImg" style = "width:50px;height:50px;"/>';		
	}
	strHtml	+='<input class="input-large focused product_image" id="focusedInput" name="product_image_'+count+'" type="file" >'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Gallery Images</label>'
			+'<div class="controls">';
	if(isedit != undefined)
	{
		strHtml	+='<img src = "" class="galImg" style = "width:50px;height:50px;"/>';		
	}
	strHtml	+='<input class="input-large focused gallery_images" id="focusedInput" name="gallery_images_'+count+'[]" type="file" multiple>'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Title (SEO)</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused product_title" id="focusedInput" name="product_title_'+count+'" type="text" value="" placeholder="Enter Product Title">'
			+'</div>'
			+'</div>'

			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Description (SEO)</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused product_deseo" id="focusedInput" name="product_deseo_'+count+'" type="text" value="" placeholder="Enter Product Description">'
			+'</div>'
			+'</div>'

			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Amazon Link</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused product_amazon" id="focusedInput" name="product_amazon_'+count+'" type="text" value="" placeholder="Enter Amazon link">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product HSN/SAC</label>'
			+'<div class="controls">'
   		    +' <input class="input-large focused product_hsn" id="focusedInput" name="product_hsn_'+count+'" type="text" value="" placeholder="Enter Product HSN/SAC">'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">New</label>'
			+'<div class="controls">'
			+'<label><input type = "radio" class = "is_new" name = "is_new_'+count+'" checked value = "1"/>Product is New</label>'
			+'<label><input type = "radio" class = "is_new" name = "is_new_'+count+'" value = "0"/>Regular</label>'
			+'</div>'
			+'</div>'
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Featured</label>'
			+'<div class="controls">'
			+'<label><input type = "radio" class = "is_featured" name = "is_featured_'+count+'" checked value = "1"/>Product is Featured</label>'
			+'<label><input type = "radio" class = "is_featured" name = "is_featured_'+count+'" value = "0"/>Regular</label>'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Key Features</label>'
			+'<div class="controls">'
   		    +' <textarea class="cleditor input-large focused key_features" id="focusedInput" name="key_features_'+count+'" type="text" value="" placeholder="Enter Product Key Features"></textarea>'
			+'</div>'
			+'</div>'
			
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Description</label>'
			+'<div class="controls">'
   		    +' <textarea class="cleditor input-large focused product_features" id="focusedInput" name="product_features_'+count+'" type="text" value="" placeholder="Enter Product Features"></textarea>'
			+'</div>'
			+'</div>'
			
			+'<div class="variaDiv">'
			+'<table class="variation-table" cellspacing="0" style="border-spacing: 0;">'
			+'<tbody>'
			+'<tr>'
			+'<td>'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput">Variation Name</label>'
			+'</div>'
			+'</td>'
			+'<td>'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput">Fake Price</label>'
			+'</div>'
			+'</td>'
			+'<td>'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput">Variation Price</label>'
			+'</div>'
			+'</td>'
			+'<td>'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput"> Price(AUD)</label>'
			+'</div>'
			+'</td>'
			+'<td>'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput"> Price(USD)</label>'
			+'</div>'
			+'</td>'
			+'<td>'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput"> Price(UK)</label>'
			+'</div>'
			+'</td>'
			+'<td>'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput"> Price(EURO)</label>'
			+'</div>'
			+'</td>'
			
			+'<td class="hidefake">'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput"> Fake(AUD)</label>'
			+'</div>'
			+'</td>'
			+'<td class="hidefake">'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput"> Fake(USD)</label>'
			+'</div>'
			+'</td>'
			+'<td class="hidefake">'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput"> Fake(UK)</label>'
			+'</div>'
			+'</td>'
			+'<td class="hidefake">'
			+'<div class="control-group">'
			+'<label class="control-label my-label" for="focusedInput"> Fake(EURO)</label>'
			+'</div>'
			+'</td>'
			
			+'</tr>'

			+'<tr>'
			
            +'<td>'
            +'<div class="control-group">'
   		    +' <input class="input-large focused product_variation" id="focusedInput" name="product_variation_'+count+'" type="text" value="" placeholder="Enter Variation Details">'
			+'</div>'
			+'</td>'
			+'<td>'
            +'<div class="control-group">'
   		    +' <input class="input-small focused fake_price" id="focusedInput" name="fake_price" type="text" value="">'
			+'</div>'
			+'</td>'
			+'<td>'
            +'<div class="control-group">'
   		    +' <input class="input-small focused product_price" id="focusedInput" name="product_price" type="text" value="">'
			+'</div>'
			+'</td>'
			+'<td>'
            +'<div class="control-group">'
   		    +' <input class="input-small focused product_price_aud" id="focusedInput" name="product_price_aud'+count+'" type="text" value="">'
			+'</div>'
			+'</td>'
			+'<td>'
            +'<div class="control-group">'
   		   +' <input class="input-small focused product_price_usd" id="focusedInput" name="product_price_usd'+count+'" type="text" value="">'
			+'</div>'
			+'</td>'
			+'<td>'
            +'<div class="control-group">'
   		   +' <input class="input-small focused product_price_uk" id="focusedInput" name="product_price_uk'+count+'" type="text" value="">'
			+'</div>'
			+'</td>'
			+'<td>'
            +'<div class="control-group">'
   		    +' <input class="input-small focused product_price_euro" id="focusedInput" name="product_price_euro'+count+'" type="text" value="">'
			+'</div>'
			+'</td>'
			
			+'<td class="hidefake">'
            +'<div class="control-group">'
   		    +' <input class="input-small focused fake_price_aud" id="focusedInput" name="fake_price_aud'+count+'" type="text" value="">'
			+'</div>'
			+'</td>'
			+'<td class="hidefake">'
            +'<div class="control-group">'
   		   +' <input class="input-small focused fake_price_usd" id="focusedInput" name="fake_price_usd'+count+'" type="text" value="">'
			+'</div>'
			+'</td>'
			+'<td class="hidefake">'
            +'<div class="control-group">'
   		   +' <input class="input-small focused fake_price_uk" id="focusedInput" name="fake_price_uk'+count+'" type="text" value="">'
			+'</div>'
			+'</td>'
			+'<td class="hidefake">'
            +'<div class="control-group">'
   		    +' <input class="input-small focused fake_price_euro" id="focusedInput" name="fake_price_euro'+count+'" type="text" value="">'
			+'</div>'
			+'</td>'
			
			+'<td>'
            +'<div class="control-group">'
   		    +'<button type="button" class="btn btn-danger delete-row">Delete</button>'
			+'</div>'
			+'</td>'
			+'</tr>'
			

            +'</tbody>'
			+'</table>'
            +'<br>'
            +'<div class="opPanel">'
   		    +'<span class = "btn btn-info add-row">Add Variation</span>'
   		    +'<button type="button" class="btn btn-success" id="save_vari" onclick="storeTblValues();" >Save Variations</button>'
   		    +'</div>'
   		    +'</div>'
             
		/*	+'<div class="control-group">'
			+'<div class="controls">'
   		    +' <input class="input-medium focused gst_amount" id="focusedInput" name="gst_amount_'+count+'" type="hidden" value="" placeholder="Enter GST amount">'
			+'</div>'
			+'</div>'   */

			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">GST Percentage</label>'
			+'<div class="controls">'
   		    +' <input class="input-medium focused gst_percent" id="focusedInput" name="gst_percent_'+count+'" type="text" value="" placeholder="Ex. 5">'
			+'</div>'
			+'</div>'   
            
			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Display Status</label>'
			+'<div class="controls">'
			+'<label><input type = "radio" class = "display_status" name = "display_status_'+count+'" checked value = "1"/>Enable</label>'
			+'<label><input type = "radio" class = "display_status" name = "display_status_'+count+'" value = "0"/>Disable</label>'
			+'</div>'
			+'</div>'

			+'<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Weight</label>'
			+'<div class="controls">'
   		    +' <input class="input-small focused prod_weight" id="focusedInput" name="prod_weight_'+count+'" type="text" value="" placeholder="ex. 2">'
			+'</div>'
			+'</div>';
			
			
	strHtml += '<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Categories</label>'
			+'<div class="controls">';			
	<?php 
		if($oObj->categorydata)
		{
	?>
	strHtml += '<select name = "category_id_'+count+'[]" multiple class = "category_id">';
	<?php
			foreach($oObj->categorydata as $parent)
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
		
		
		strHtml += '<div class="control-group">'
			+'<label class="control-label" for="focusedInput">Product Sub-Categories</label>'
			+'<div class="controls">';			
	<?php 

		if($oObj->subCategoryData)
		{
	?>
	strHtml += '<select name = "subcategory_id_'+count+'[]" multiple class = "subcategory_id">';
	<?php
			foreach($oObj->subCategoryData as $parent)
			{
				echo "strHtml += \"<option value = '".$parent['category_id']."' pcat = '".$parent['parent_category_id']."'>".$parent['category_name']."</option>\";";
			}
	?>
	strHtml	+='</select>';
	<?php
		}
		else
		{
			echo  'strHtml += "<span style = \'color:red;\'>No Sub-Category found.</span>Please <a href = \''.base_url().'admin/subcategories\'>Add Sub-Category</a>";';
		}
	?>
	strHtml +='</div>'
			+'</div>';
	
	
	
	if(isedit != undefined)
	{
		strHtml	+= '<input type = "hidden" value = "" name = "product_id_'+count+'" class = "product_id"/>';
	}			
	
	strHtml += "<center style = 'width : 100%'>"
				+"<div style = 'width: 90%;border-top: 1px solid #B3B3B3;padding-bottom: 20px;padding-top: 20px;'></div></center>";
	strHtml += "</span>";
	return strHtml;
}//product_name  product_image display_status



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
	assignSubCategoryEvent();
}

function addField2()
  {
  	new_row="<tr><td><input type='text' class='product_variation' value='' /></td><td><input type='text' class='fake_price' value='' style='width:90px;' /></td><td><input type='text' class='product_price' value='' style='width:90px;' /></td><td><input type='text' class='product_price_aud' value='' style='width:90px;' /></td><td><input type='text' class='product_price_usd' value='' style='width:90px;' /></td><td><input type='text' class='product_price_uk' value='' style='width:90px;' /></td><td><input type='text' class='product_price_euro' value='' style='width:90px;' /></td><td class='hidefake'><input type='text' class='fake_price_aud' value='' style='width:90px;' /></td><td class='hidefake'><input type='text' class='fake_price_usd' value='' style='width:90px;' /></td><td class='hidefake'><input type='text' class='fake_price_uk' value='' style='width:90px;' /></td><td class='hidefake'><input type='text' class='fake_price_euro' value='' style='width:90px;' /></td><td><button type='button' class='btn btn-danger delete-row'>Delete</button></td></tr>";
     
    $(".variation-table").append(new_row);
    return false;

  }

function storeTblValues()
        {
            var TableData = new Array();
    
            $('.variation-table tr').each(function(row, tr){
                TableData[row]={
                    "Vname" :$(tr).find('td:eq(0)').find('input').val(),
                    "Fprice" :$(tr).find('td:eq(1)').find('input').val(),
                     "Vprice" :$(tr).find('td:eq(2)').find('input').val(),
                     "AUD_price" : $(tr).find('td:eq(3)').find('input').val(),
                     "USD_price" : $(tr).find('td:eq(4)').find('input').val(),
                     "UK_price" : $(tr).find('td:eq(5)').find('input').val(),
                     "EURO_price" : $(tr).find('td:eq(6)').find('input').val(),
                     "F_AUD_price" : $(tr).find('td:eq(7)').find('input').val(),
                     "F_USD_price" : $(tr).find('td:eq(8)').find('input').val(),
                     "F_UK_price" : $(tr).find('td:eq(9)').find('input').val(),
                     "F_EURO_price" : $(tr).find('td:eq(10)').find('input').val()
                }
            }); 
          //  TableData.shift();  // first row will be empty - so remove
           // return TableData;
          // alert(TableData[1]['date']);

  $.ajax({
   type: 'post',
   url: "<?php echo base_url().'admin/product/getArrayData/' ?>",
   data: { variations_array : TableData },
   success: function(result) {
  // 	alert(result);
     //ur success handler OPTIONAL
   //  alert("Variations Updated");
   }
});  

 }  



$(document).ready
(

	function()
	{

	
		$.cleditor.defaultOptions.width = 300;
		$.cleditor.defaultOptions.height = 300;
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

$(".gst_amount, .gst_percent,.product_price").live
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
				var gst_amt = (isNaN(oParent.find(".gst_amount").val())) ? 0 : oParent.find(".gst_amount").val();
				var gst_per = (isNaN(oParent.find(".gst_percent").val())) ? 0 :oParent.find(".gst_percent").val();			
				if($(this).hasClass("gst_amount"))
				{
					oParent.find(".gst_percent").val(((gst_amt/prod_price)*100));
				}
				else if($(this).hasClass("gst_percent"))
				{
					oParent.find(".gst_amount").val(((gst_per/100)*prod_price));
				} 
				else
				{
					if(gst_per != 0)
					{
						oParent.find(".gst_amount").val(((gst_per/100)*prod_price));
					}									
				}
			}
		)



		$(".product_price_cad,.product_price").live
		(

			"keyup",function()
			{
				
			    var inr = $("span.inr-curr").text();
				var cad = $("span.cad-curr").text();
				var aud = $("span.aud-curr").text();
				var usd = $("span.usd-curr").text();
				var gbp = $("span.gbp-curr").text();
				var euro = $("span.euro-curr").text();

				$(".variation-table").find("tr").each(function() { //get all rows in table
    			var ratingTd = $(this).find('td:eq(2)').find('input').val();//Refers to TD element

    			var p_aud = parseFloat(ratingTd/aud).toFixed(2);
    			var p_usd = parseFloat(ratingTd/usd).toFixed(2);
    			var p_gbp = parseFloat(ratingTd/gbp).toFixed(2);
    			var p_euro = parseFloat(ratingTd/euro).toFixed(2);

    			$(this).find('td:eq(3)').find('input').val(p_aud);
    			$(this).find('td:eq(4)').find('input').val(p_usd);
    			$(this).find('td:eq(5)').find('input').val(p_gbp);
    			$(this).find('td:eq(6)').find('input').val(p_euro);
				});   			
                 
 
			}
		)

		$(".fake_price").live
		(

			"keyup",function()
			{
				
			    var inr = $("span.inr-curr").text();
				var cad = $("span.cad-curr").text();
				var aud = $("span.aud-curr").text();
				var usd = $("span.usd-curr").text();
				var gbp = $("span.gbp-curr").text();
				var euro = $("span.euro-curr").text();

				$(".variation-table").find("tr").each(function() { //get all rows in table
    			var ratingTd = $(this).find('td:eq(1)').find('input').val();//Refers to TD element

    			var p_aud = parseFloat(ratingTd/aud).toFixed(2);
    			var p_usd = parseFloat(ratingTd/usd).toFixed(2);
    			var p_gbp = parseFloat(ratingTd/gbp).toFixed(2);
    			var p_euro = parseFloat(ratingTd/euro).toFixed(2);

    			$(this).find('td:eq(7)').find('input').val(p_aud);
    			$(this).find('td:eq(8)').find('input').val(p_usd);
    			$(this).find('td:eq(9)').find('input').val(p_gbp);
    			$(this).find('td:eq(10)').find('input').val(p_euro);
				});   			
                 
 
			}
		)

	


		
		
		
		
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
				if($(".product-addData").length > 1)
				{
					$(".product-addData").last().remove();
					g_count--;					
				}				
			}
		);
		
		$(".add-row").live
		(
			"click",
			function()
			{
				addField2();				
				//docReady();

			}
		);

		$('.delete-row').live
		(
			"click",
			function()
			{
				$(this).closest('tr').remove();
			}
			);
		
		$(".addproduct").bind
		(
			"click",
			function()
			{
				g_count = 0;
				$(".addrembtns").show();
				$("#productmodal form").attr("action","<?php echo $createurl; ?>");
				$(".product_func").val("create");
				$(".modal-header h3").html("Add new Product");		
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

function assignSubCategoryEvent()
{
	$(".subcategory_id").unbind("change").bind
		(
			"change",
			function()
			{
			//	$(this).closest(".product-addData").find(".category_id").find("option").removeAttr("selected");
				var allVals = $(this).val();
				if(allVals == null)return "";
				$(this).find("option").each
				(
					function()
					{
					
						if(allVals.indexOf($(this).attr("value"))!=-1)
						{
							var categorySel = $(this).closest(".product-addData").find(".category_id");
							var arrPcats = $(this).attr("pcat").split(",");
							categorySel.find("option").each
							(
								function()
								{
									if(arrPcats.indexOf($(this).attr("value")) != -1)
									{
										$(this).attr("selected","selected");
									}
								}
							);
						}
					}
				);
			}
		);
}

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
		setTimeout(function() {
		$("#save_vari").trigger("click");
			}, 2000);
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
						$(".modal-header h3").html(ob_data.product_name);
						//product_name  product_image display_status
						$(".product_name").val(ob_data.product_name);
						$(".product_hsn").val(ob_data.product_hsn);
						$(".product_title").val(ob_data.product_title);
						$(".product_deseo").val(ob_data.product_deseo);
						$(".product_amazon").val(ob_data.product_amazon);
						$(".prodImg").attr("src",ob_data.product_image);
						
						$(".product_features").val(ob_data.product_features);
						$(".key_features").val(ob_data.key_features);
						
						$(".product_price").val(ob_data.product_price);
						$(".product_price_cad").val(ob_data.product_price_can);
						$(".product_price_aud").val(ob_data.product_price_aus);
						$(".product_price_usd").val(ob_data.product_price_usa);
						$(".product_price_gbp").val(ob_data.product_price_uk);
						$(".product_price_euro").val(ob_data.product_price_eur);
					//	$(".discount_price").val(ob_data.discount_price);
					//	$(".discount_percent").val(ob_data.discount_percent);
						$(".gst_amount").val(ob_data.gst_amount);
						$(".gst_percent").val(ob_data.gst_percent);
						$(".prod_weight").val(ob_data.product_weight);
						
						var klo = JSON.parse(ob_data.variationsData);
						kloLen = Object.keys(klo).length;
						//alert(kloLen);
						$(function () {
							if(kloLen == 0)
							{
		$('.variation-table').html('<tr><td style="font-weight:bold;">Variation Name</td><td style="font-weight:bold;">Fake price</td><td style="font-weight:bold;">Variation price</td><td style="font-weight:bold;">Price(AUD)</td><td style="font-weight:bold;">Price(USD)</td><td style="font-weight:bold;">Price(UK)</td><td style="font-weight:bold;">Price(EURO)</td><td class="hidefake" style="font-weight:bold;">Fake(AUD)</td><td class="hidefake" style="font-weight:bold;">Fake(USD)</td><td class="hidefake" style="font-weight:bold;">Fake(UK)</td><td class="hidefake" style="font-weight:bold;">Fake(EURO)</td></tr><tr><td><input type="text" class="product_variation" value="" /></td><td><input type="text" name ="fake_price" class="fake_price" value="" style="width:90px;" /></td><td><input type="text" name ="product_price" class="product_price" value="" style="width:90px;" /></td><td><input type="text" class="product_price_aud" value="" style="width:90px;" /></td><td><input type="text" class="product_price_usd" value="" style="width:90px;" /></td><td><input type="text" class="product_price_uk" value="" style="width:90px;" /></td><td><input type="text" class="product_price_euro" value="" style="width:90px;" /></td><td class="hidefake"><input type="text" class="fake_price_aud" value="" style="width:90px;" /></td><td class="hidefake"><input type="text" class="fake_price_usd" value="" style="width:90px;" /></td><td class="hidefake"><input type="text" class="fake_price_uk" value="" style="width:90px;" /></td><td class="hidefake"><input type="text" class="fake_price_euro" value="" style="width:90px;" /></td><td><button type="button" class="btn btn-danger delete-row">Delete</button></td></tr>');
    
    }
    else {

    	$('.variation-table').html('<tr><td style="font-weight:bold;">Variation Name</td><td style="font-weight:bold;">Fake price</td><td style="font-weight:bold;">Variation price</td><td style="font-weight:bold;">Price(AUD)</td><td style="font-weight:bold;">Price(USD)</td><td style="font-weight:bold;">Price(UK)</td><td style="font-weight:bold;">Price(EURO)</td><td class="hidefake" style="font-weight:bold;">Fake(AUD)</td><td class="hidefake" style="font-weight:bold;">Fake(USD)</td><td class="hidefake" style="font-weight:bold;">Fake(UK)</td><td class="hidefake" style="font-weight:bold;">Fake(EURO)</td></tr>');
    			$.each(klo, function (i, item) {
       				$('<tr>').append(
        			$('<td>').html("<input type='text' class='product_variation' value='" + item.Vname + "' />"),
        			$('<td>').html("<input type='text' name='fake_price' class='fake_price' value='" + item.Fprice + "' style='width:90px' />"),
        			$('<td>').html("<input type='text' name='product_price' class='product_price' value='" + item.Vprice + "' style='width:90px' />"),
        			$('<td>').html("<input type='text' class='product_price_aud' value='" + item.AUD_price + "' style='width:90px' />"),
        			$('<td>').html("<input type='text' class='product_price_usd' value='" + item.USD_price + "' style='width:90px' />"),
        			$('<td>').html("<input type='text' class='product_price_uk' value='" + item.UK_price + "' style='width:90px' />"),
        			$('<td>').html("<input type='text' class='product_price_euro' value='" + item.EURO_price + "' style='width:90px' />"),
        			$('<td class="hidefake">').html("<input type='text' class='fake_price_aud' value='" + item.F_AUD_price + "' style='width:90px' />"),
        			$('<td class="hidefake">').html("<input type='text' class='fake_price_usd' value='" + item.F_USD_price + "' style='width:90px' />"),
        			$('<td class="hidefake">').html("<input type='text' class='fake_price_uk' value='" + item.F_UK_price + "' style='width:90px' />"),
        			$('<td class="hidefake">').html("<input type='text' class='fake_price_euro' value='" + item.F_EURO_price + "' style='width:90px' />"),
        			$('<td>').html("<button type='button' class='btn btn-danger delete-row'>Delete</button>")).appendTo('.variation-table');
        							// $('#records_table').append($tr);
        							//console.log($tr.wrap('<p>').html());
    								});

    }			
							}); 
						

						
						$(".category_id").find("option").removeAttr("selected");
						$(".subcategory_id").find("option").removeAttr("selected");
						
						$(".vendor_ids").find("option").removeAttr("selected");
						var arrCategory = ob_data.category_id.split(",");
						$(".category_id").find("option").each
						(
							function()
							{
								if(arrCategory.indexOf($(this).val()) != -1)
								{
									$(this).attr("selected","selected");
								}
							}
						);
						
						var arrSubcat = ob_data.subcategory_id.split(",");
						$(".subcategory_id").find("option").each
						(
							function()
							{
								if(arrSubcat.indexOf($(this).val()) != -1)
								{
									$(this).attr("selected","selected");
								}
							}
						);
						
						
						
						
						var arrVendors = ob_data.vendor_ids.split(",");
						$(".vendor_ids").find("option").each
						(
							function()
							{
								if(arrVendors.indexOf($(this).val()) != -1)
								{
									$(this).attr("selected","selected");
								}
							}
						);
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
												
					/*	$(".discount_status").each
						(
							function()
							{
								if($(this).val() == ob_data.discount_status)
								{
									$(".discount_status").removeAttr("checked");
									$(this).attr("checked","checked");
								}
							}
						);    */
						$(".is_new").each
						(
							function()
							{
								if($(this).val() == ob_data.is_new)
								{
									$(".is_new").removeAttr("checked");
									$(this).attr("checked","checked");
								}
							}
						);
						
						$(".is_featured").each
						(
							function()
							{
								if($(this).val() == ob_data.is_featured)
								{
									$(".is_featured").removeAttr("checked");
									$(this).attr("checked","checked");
								}
							}
						);
						
						$(".product_id").val(ob_data.product_id);
						$(".modal-loader").hide();
						$(".productmodal-body").show();
						$(".product-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
						assignSubCategoryEvent();
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
						$(".product_idd").val(ob_data);
						$(".modal-loader").hide();
						$(".productmodal-body").show();
						$(".product-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
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