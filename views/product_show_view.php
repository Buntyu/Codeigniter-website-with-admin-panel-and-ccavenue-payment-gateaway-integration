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

				    <ul class="thumbnails">
			  <?php			
			 // 	echo "<pre>";print_r($latestproducts);die;
			 if(!$more_products){
			echo "<h4 style='text-align:center;color:#608408;'>NO PPRODUCTS FOUND</h4>";
				}
			  	foreach($more_products as $products)
				{	
				$prName = $products['product_name'];

					$len = strlen($prName);
					if($len > 40)
					{$prName = substr($prName,0,40)."...";} 
									
					echo '
						<li class="span3">
						  <div class="thumbnail">
							<a  href="'.base_url().'product/'.addhyphens($products['product_name']).'">';
				/*	if($products['is_new'] == '1')
					{
						echo '<i class="tag"></i>'; 
					}	*/	
					if($products['product_image'])	
					echo '<img src="'.$products['product_image'].'" alt="" class="mytnail"/>';
					
					echo '	
							<div class="caption">
							  <h5 class="proname">'.$prName.'</h5></a>
							  
						<div class = "price-dp">';
					
					$nn = $products['variationsData'];
               		$dec = json_decode($nn, TRUE);
                	

                    $CountryCode = $this->session->userdata('sessiontest');
                    
                     // PRICE WITH FAKE/DISCOUNTED PRICE
                     
					/*	if($CountryCode == 'EUR')
						{
                        echo '<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">€&nbsp'.$dec[1]['F_EURO_price'].'</strike>&nbsp<span class="mPrice">€&nbsp'.$dec[1]['EURO_price'].'/-</span>';
						}
						elseif($CountryCode == 'AUS')
						{
                        echo '<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">AU$&nbsp'.$dec[1]['F_AUD_price'].'</strike>&nbsp<span class="mPrice">AU$&nbsp'.$dec[1]['AUD_price'].'/-</span>';
						}
						elseif($CountryCode == 'USA')
						{
                        echo '<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">US$&nbsp'.$dec[1]['F_USD_price'].'</strike>&nbsp<span class="mPrice">US$&nbsp'.$dec[1]['USD_price'].'/-</span>';
						}
						elseif($CountryCode == 'OTHER')
						{
                        echo '<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">US$&nbsp'.$dec[1]['F_USD_price'].'</strike>&nbsp<span class="mPrice">US$&nbsp'.$dec[1]['USD_price'].'/-</span>';
						}
						elseif($CountryCode == 'UK')
						{
                        echo '<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">£&nbsp'.$dec[1]['F_UK_price'].'</strike>&nbsp<span class="mPrice">£&nbsp'.$dec[1]['UK_price'].'/-</span>';
						}
						else 
						{
						echo '<strong>Price&nbsp;:</strong>&nbsp;<strike style="color:#f89406;">Rs.'.$dec[1]['Fprice'].'</strike>&nbsp<span class="mPrice">Rs.'.$dec[1]['Vprice'].'/-</span>';
						}   */
						
						if($CountryCode == 'EUR')
						{
                        echo '<strong>Price&nbsp;:</strong>&nbsp<span class="mPrice">€&nbsp'.$dec[1]['EURO_price'].'/-</span>';
						}
						elseif($CountryCode == 'AUS')
						{
                        echo '<strong>Price&nbsp;:</strong>&nbsp<span class="mPrice">AU$&nbsp'.$dec[1]['AUD_price'].'/-</span>';
						}
						elseif($CountryCode == 'USA')
						{
                        echo '<strong>Price&nbsp;:</strong>&nbsp<span class="mPrice">US$&nbsp'.$dec[1]['USD_price'].'/-</span>';
						}
						elseif($CountryCode == 'OTHER')
						{
                        echo '<strong>Price&nbsp;:</strong>&nbsp<span class="mPrice">US$&nbsp'.$dec[1]['USD_price'].'/-</span>';
						}
						elseif($CountryCode == 'UK')
						{
                        echo '<strong>Price&nbsp;:</strong>&nbsp<span class="mPrice">£&nbsp'.$dec[1]['UK_price'].'/-</span>';
						}
						else 
						{
						echo '<strong>Price&nbsp;:</strong>&nbsp<span class="mPrice">Rs.'.$dec[1]['Vprice'].'/-</span>';
						} 
						


					echo '		</div>	'; ?>
					
					<div class="thumb-product-buttons">
                    <form class="form-horizontal qtyFrm product-btnform" onsubmit = "addtocartwithquantity($(this).attr('action')+'/'+1,this,event,'1');" action = "<?php echo base_url().'cart/addtocart/'.$products['product_id'];?>" >
    <?php {
          echo'<button type="submit" class="btn btn-success"> Add To <i class=" icon-shopping-cart"></i></button>';
       }  ?>

       </form>
        </div> 
        
					<?php   echo '</div>
						  </div>
						</li>
					';
				}	  	
			  ?>
			  </ul>
</div>
</div>
</div>
</div>
</div>
			  	