<?php
//echo "<pre>";print_r($obj);die;
?>
<form class="form-horizontal">
						  <fieldset>
						  <legend>Quick Search Products</legend>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Product Name</label>
							  <div class="controls">
			
								<input type="text" autocomplete="off" name = "product_name" class="span6 typeahead" id="typeahead" data-provide="typeahead" data-items="10" data-source= '[<?php  foreach($obj->product_name as $product){echo "\"".str_replace('"','&quot;',str_replace("'",'&apos;',htmlspecialchars($product["product_name"]))) ."\",";}echo '""' ?>]' />
							
								<p class="help-block">Enter the name of the product</p>
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError3">Select Category</label>
								<div class="controls">
								  <select name = "category">
								  	<option value = "" >Select</option>
									<?php 
										foreach($obj->categorydata as $category)
										{
											echo "<option value = '".$category['category_id']."'>".$category['category_name']."</option>";
										}
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">Select Sub-Category</label>
								<div class="controls">
								  <select name = "subcategory">
								  <option value = "" >Select</option>
								  <?php
									foreach($obj->subCategoryData as $subcategory)
									{
										echo "<option value = '".$subcategory['category_id']."'>".$subcategory['category_name']."</option>";
									}
									?>
								  </select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="selectError3">Select Brand</label>
								<div class="controls">
								  <select name = "brand">
								  <option value = "" >Select</option>
								  <?php
									foreach($obj->brandsData as $brand)
									{
										echo "<option value = '".$brand['brand_id']."'>".$brand['brand_name']."</option>";
									}
									?>
								  </select>
								</div>
							  </div>					
							  <input type ="hidden" name = "q" value = "1"/>
							  <input type = "hidden" name = "isexcel" value = "0" class = "isexcel" />
							  <div class="form-actions">
								<button type="submit" onclick = "$('.isexcel').val('0');" class="btn btn-primary">Search Products</button>	
								<button type="submit" onclick = "$('.isexcel').val('1');" class="btn btn-primary">Download ExcelSheet</button>	
							  </div>
							  
						  </fieldset>
						</form>
						<form class = "form-horizontal" enctype="multipart/form-data" accept-charset="utf-8" method="POST" action = "<?php echo base_url()."admin/product/uploadexcel"; ?>">
							<fieldset>
						  <legend>Upload Product Excel Sheet</legend>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Upload File</label>
							  <div class="controls">
			
								<input type="file" name = "product_file" />
							
								<p class="help-block">Upload the file after making changes in the excelsheet.</p>
							  </div>
							</div>
							 <div class="form-actions">
								<button type="submit" onclick = "$('.isexcel').val('0');" class="btn btn-primary">Upload File</button>
							  </div>
						</form>
						