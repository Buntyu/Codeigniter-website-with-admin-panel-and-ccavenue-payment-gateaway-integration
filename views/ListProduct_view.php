<?php
	$theme_url = base_url()."theme/";
?>
					<ul class="breadcrumb">
						<!--<li><a href="index.html">Home</a> <span class="divider">/</span></li>
						<li class="active">Products Name</li>-->
						<?php 
							$breadCrumb = $obj->getBreadCrumb();
							foreach($breadCrumb as $breadcrumbs)
							{
								echo '<li>
										<a href="'.$breadcrumbs["link"].'">'.$breadcrumbs["name"].'</a><span class="divider">/</span>
									</li>';
							}
						?>
				    </ul>
				<!--	<h3> 
					<?php
						 
						if(isset($totalProducts))
						{
							echo '<small class="pull-right"> '.$totalProducts.' products are available </small>	';	
						}
					?>
					</h3>
						<hr class="soft"/>
					<?php 
						if(isset($heading_message))
						{
							echo '<p>						
								'.$heading_message.'
								 </p>';
						}
					?>    -->
					
					
						  <div class = "span6 filter" style="margin: 0px!important;">						  
						  	<div class = "span3" style="margin: 0px!important;">
								<span style="font-size: 13px">Product Name</span><br />
								<select name = 'product_name' onchange = "sortProducts('product_name',this);return false;">
								<option  value = "">Sort By Product Name</option>
					              <option value = "asc">A - Z</option>
					              <option value = "desc">Z - A</option>					              
					            </select>
							</div>	
							<div class = "span3" style="margin: 0px!important;">
								<span style="font-size: 13px">Product Price</span><br />
								<select name = 'product_price'  onchange = "sortProducts('product_price',this);return false;">
								  <option value = "">Sort By Price</option>
					              <option value = "asc">Lowest to Highest</option>
					              <option value = "desc">Highest to Lowest</option>					              
					            </select>
							</div>
							<!--
							<div class = "span3" style="margin: 0px!important;">
								<span style="font-size: 13px">Brands</span><br />
								<select name = 'product_brands' id = "product_brands"  onchange = "sortProducts('brands_id',this,true);return false;">	
									<option value = "">Sort By Brands</option>
								<?php 
									foreach($obj->brandsList as $brands)
									{
										echo "<option value = '".$brands['brand_id']."'>".$brands['brand_name']."</option>";
									}
								?>
							 </select>
							</div>						
							<div class = "span3" style="margin: 0px!important;">
								<span style="font-size: 13px">Enter Product Name</span><br />
								<input type = "text" id = "product_name"  class="x-large typeahead" data-provide="typeahead" data-items="4" data-source="g_product_names" placeholder="Enter Product Name"/>
							</div>-->
						</div>
					 
						<br class="clr"/>	<br class="clr"/>	<br class="clr"/>	
						<div class="tab-content">
							<div class="tab-pane" id="listView">	
					</div>
					<div class="tab-pane  active" id="blockView">
						<ul class="thumbnails" id = "blockView_ul" >					
						</ul>
						</div>
						</div>
						<div id = "loader" style="display: none;">
							<center>
								<img src = "<?php echo base_url(); ?>images/preloader.gif" />								
								<span style="color:#6ca2cc">Loading Products</span>
							</center>
						</div>
						<input type ="hidden" value = "0" id = "product_count"/>									
			</div>	
			</div></div></div></div>
<?php
     $CountryCode = $this->session->userdata('sessiontest');
     ?>
     <span class="getCode"><?php echo $CountryCode; ?></span>
     <style>
			.getCode{
				display:none;
			}
     </style>
	

<script>	
	var moreproducts ="";
	var isChanged = false;	
	$(document).ready
	(
		function()
		{			
			getMoreProducts();				
			<?php 
				if(isset($noautoload))echo "g_autoloading = true;";
				else
				echo "startProductAutoLoading();";
			?>
		}
	);
	function startProductAutoLoading()
	{
		stopProductAutoLoading();
		moreproducts = setInterval
			(
				function()
				{
					if(g_gettingmore == false && getScrollTop() >= $(".tab-content").height()-400)
					{
						if(isChanged)
						{
							getMoreProducts(false,isChanged);
						}
						else
						{
							getMoreProducts();
						}
					}
				},1000
			);
	}
	
	function stopProductAutoLoading()
	{
		clearInterval(moreproducts);
	}
	var g_gettingmore = false;
	function getMoreProducts(refresh,addwhere)
	{
		if(refresh != undefined && refresh != false)
		{
			$("#blockView_ul").html("");
			$("#listView").html("");
			$("#product_count").val(0);
		}
		if(addwhere == undefined){addwhere = "";}
		$("#loader").show();
		g_gettingmore = true;
		<?php 
			if(isset($addtourl))
			{
				echo "addwhere += '".$addtourl."';";
			}
		?>
		var url = "<?php if(isset($more_products_url))echo $more_products_url; ?>"+$("#product_count").val()+"?"+addwhere;
	//	console.log(url);
		$.ajax
		(
			{
				url : url,
				success : function(data)
						{	
						//	debugger;						
							try
							{
								var response = JSON.parse(data);
							}
							catch (exc)
							{								
								stopProductAutoLoading();
								$("#respmesg").remove();
									if($(".thumbnails li").length == 0)
									{
										$(".tab-content").after("<h6 id = 'respmesg'>"+data+"</h6>");
										$("#myTab").hide("slow");
									}	
								$("#loader").hide();
								return;
							}
							if(response.status == "success")
							{
								addGridView(response.data);
								addListView(response.data);
								//arrangeThumbnails();
								$("#product_count").val(parseInt($("#product_count").val())+9);
								g_gettingmore = false;
								$("#myTab").show("slow");
								bindaddcart();
							}
							else
							{
								stopProductAutoLoading();
								if(response.data != undefined)
								{
									$("#respmesg").remove();
									if($(".thumbnails li").length == 0)
									{
										$(".tab-content").after("<h6 id = 'respmesg'>"+response.data+"</h6>");
										$("#myTab").hide("slow");
									}									
								}
							}
							$("#loader").hide();
						},
				fail : function(data)
						{
							displayalertblock("Cannot Load More Products");
							$("#loader").hide();
						},
			}
		);
	}

	function addGridView(data)	
	{
		var CountryCodeVal = $("span.getCode").text();
		
		var strHtml = "";
		for(i in data)
		{
		var prName = data[i].product_name;
         	var len = prName.length;
					if(len > 40)
					{var prName = prName.substr(0,40)+'...'; } 
					
		var vardata = data[i].variationsData;
		var JSONObject = JSON.parse(vardata);
		console.log(JSONObject); 
	//		g_product_names[g_product_names.length] = data[i].product_name;
			strHtml+='<li class="span3">'
					+'		  <div class="thumbnail">'
					+'			<a  href="'+base_url()+'product/'+encodeURIComponent(addunderscores(data[i].product_name))+'">';
			if(data[i].is_new == '1')
			{
				strHtml+='<i class="tag"></i>';
			}		
			if(data[i].product_image)	
			strHtml+='<img src="'+data[i].product_image+'&width=250&height=250" alt="" class="mytnail"/>';
								
			strHtml+='	'
					+'<div class="caption">'
					+' <h5 class="proname">'+prName+'</h5></a>'
				/*	+' <h4 style="text-align:center">'
					+' <a class="btn btn-warning" href="'+base_url()+'product/'+encodeURIComponent(addunderscores(data[i].product_name))+'">'
					+' <i class="icon-zoom-in"></i>'
					+'</a>'
					+'&nbsp;&nbsp;&nbsp;<a class="btn btn-success addtocart" href="'+base_url()+'cart/addtocart/'+data[i].product_id+'">Add to <i class="icon-shopping-cart"></i>'
					+'</a>  </h4>'   */
					+'<div class = "price-dp">';
	/*		if(data[i].discount_status == '1')			  
			{
			/*	strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number'+hh+'" style = "text-decoration:line-through;color : red;">Rs.'+data[i].product_price+'/-</span>'
					+'<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number'+hh+'" style = "">Rs.'+data[i].discount_price+'/- </span>';   

					strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number'+hh+' price-number">'+data[i].product_price+'</span>';

			}
			else
			{   */
				if(CountryCodeVal == 'EUR')
					{
                    strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">€&nbsp'+JSONObject[1]['F_EURO_price']+'</strike>&nbsp<span class="mPrice">€&nbsp'+JSONObject[1]['EURO_price']+'</span>';

					}
					else if(CountryCodeVal == 'AUS')
					{
                    strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">AU$&nbsp'+JSONObject[1]['F_AUD_price']+'</strike>&nbsp<span class="mPrice">AU$&nbsp'+JSONObject[1]['AUD_price']+'</span>';
					}
					else if(CountryCodeVal == 'USA')
					{
                   strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">US$&nbsp'+JSONObject[1]['F_USD_price']+'</strike>&nbsp<span class="mPrice">US$&nbsp'+JSONObject[1]['USD_price']+'</span>';
					}
					else if(CountryCodeVal == 'OTHER')
					{
                   strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">US$&nbsp'+JSONObject[1]['F_USD_price']+'</strike>&nbsp<span class="mPrice">US$&nbsp'+JSONObject[1]['USD_price']+'</span>';
					}

					else if(CountryCodeVal == 'UK')
					{
                    strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">£&nbsp'+JSONObject[1]['F_UK_price']+'</strike>&nbsp<span class="mPrice">£&nbsp'+JSONObject[1]['UK_price']+'</span>';
					}
					else 
					{
				    strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">Rs.'+JSONObject[1]['Fprice']+'</strike>&nbsp<span class="mPrice">Rs.'+JSONObject[1]['Vprice']+'</span>';
					}		  
		//	}
		strHtml+='		</div>	'
				+'		</div>'
				+'	  </div>'
				+'	</li>';
		}
		$("#blockView_ul").append(strHtml);
	}
	function addListView(data)
	{
		var CountryCodeVal = $("span.getCode").text();
		var strHtml = "";
		for(i in data)
		{
			strHtml += '<div class="row">	  '
					+'		<div class="span2">'
					+'			<a  href="'+base_url()+'product/'+encodeURIComponent(addunderscores(data[i].product_name))+'">'
					+'			<img src="'+data[i].product_image+'" alt=""/>'
					+'	</a>'
					+'		</div>'
					+'		<div class="span4">'
					+'			<a  href="'+base_url()+'product/'+encodeURIComponent(addunderscores(data[i].product_name))+'">'
					+'			<h3>'+data[i].product_name+'</h3>				'
					+'	</a>'
					+'			<hr class="soft"/>';
		/*			if(data[i].discount_status == '1')			  
					{
				/*		strHtml += '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number'+hh+'" style = "text-decoration:line-through;color : red;">Rs.'+data[i].product_price+'/-</span><br />'
							+'<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number'+hh+'" style = "">Rs.'+data[i].discount_price+'/- </span>';   
							strHtml += '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">'+data[i].product_price+'</span>';
					}
					else
					{     */ 

         /*               if(CountryCodeVal == 'CAN')
					{
                    strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">CA$&nbsp'+data[i].product_price_can+'</span>';
					}
					else if(CountryCodeVal == 'EUR')
					{
                    strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">€&nbsp'+data[i].product_price_eur+'</span>';
					}
					else if(CountryCodeVal == 'AUS')
					{
                    strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">AU$&nbsp'+data[i].product_price_aus+'</span>';
					}
					else if(CountryCodeVal == 'USA')
					{
                    strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">US$&nbsp'+data[i].product_price_usa+'</span>';
					}
					else if(CountryCodeVal == 'UK')
					{
                    strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">£&nbsp'+data[i].product_price_uk+'</span>';
					}
					else 
					{
				    strHtml+='<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">Rs.'+data[i].product_price+'</span>';
					}
*/
				

			//		}					
					strHtml += '<br class="clr"/>'
							+'</div>'
							+'<div class="span3 alignR">';
					if(data[i].is_new == '1')
					{
						strHtml += '<center><i class="tag" style="position:relative;"></i></center>';
					}		
					strHtml += '<br/>'
							 +'<a href="'+base_url()+'cart/addtocart/'+encodeURIComponent(addunderscores(data[i].product_id))+'" class="btn btn-large btn-success addtocart"> Add to <i class=" icon-shopping-cart"></i></a>'
							 +'&nbsp;&nbsp;&nbsp;<a href="'+base_url()+'product/'+encodeURIComponent(addunderscores(data[i].product_name))+'" class="btn btn-warning btn-large"><i class="icon-zoom-in"></i></a>'
							+'</div>'
							+'</div>'
							+'<hr class="soft"/>';
							
		}
		$("#listView").append(strHtml);
	}		
	function arrangeThumbnails()
	{
		var maxheight = 0;
		$(".thumbnails li").css("height","auto");
		$(".thumbnails li").each(function(){maxheight = Math.max($(this).height(),maxheight)});
		$(".thumbnails li").css("height",maxheight+"px")
	}	
	var g_autoloading = false;
	function sortProducts(name,oObj,offautoloading)
	{
		if(g_autoloading == true)offautoloading = g_autoloading;
		if($(oObj).val() == '')
		{
			isChanged = "";
			getMoreProducts(true);
			return false;
		}
		isChanged = name+'='+$(oObj).val();
		getMoreProducts(true,isChanged);
		if(offautoloading == undefined)
		{
			startProductAutoLoading();		
		}
		else
		{
			stopProductAutoLoading();
		} 
	}
</script>
