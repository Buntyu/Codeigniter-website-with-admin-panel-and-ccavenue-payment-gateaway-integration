<?php
	$theme_url = base_url()."theme/";
	//print_r($featuredCategory);die;	  
?>

<div id="mainBody" class="homebody">

<div id="carouselBlk" class = "">
  <div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
        
    <div class="item active">
      <img src="images/BISJ Slider_Banner_V4.jpg" alt="Free Shipping Banner">
    </div>    
      
    <div class="item">
      <img src="images/BISJ Slider 2-min.jpg" alt="Activated Bamboo Charcoal">
    </div>

    <div class="item">
      <img src="images/BISJ Slider 5-min.jpg" alt="Bamboo Tea">
    </div>
    
    <div class="item">
      <img src="images/BISJ-Slider-3.jpg" alt="Activated Bamboo Charcoal Pack">
    </div>
<!--    <div class="item">
      <img src="images/BISJ Slider 9-min.jpg" alt="Super Seeds">
    </div>
    <div class="item">
      <img src="images/BISJ Slider 8-min.jpg" alt="Herbs">
    </div> 
    <div class="item">
      <a href="<?php echo base_url(); ?>affiliate-terms-and-conditions" target="_blank"><div class="imglink"><img src="images/Be Your Boss-min.jpg" alt="Be Your Boss"></div></a>
    </div> -->
    <div class="item">
      <a href="<?php echo base_url(); ?>International-shipping-charges" target="_blank"><div class="imglink"><img src="images/BISJ-slide-ship.jpg" alt="Shipping"></div></a>
    </div>
      
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div> 
</div> 

 <div class="container">
		<div class="row my-row">
		   <div class="row-below">
		  <div class = "span12 home-alert" id = "disp-alert"></div> 

<?php  
if($featuredproducts)
{
?>
<div class="feecaraousel span12">
<h1 class="latest_pro">Best Selling Products</h1>
  <ul id="featuredSlider2">
<?php
foreach ($featuredproducts as $fproducts)
{
	        $pro_name = $fproducts['product_name'];
			$len = strlen($pro_name);
					if($len > 35)
					{$pro_name = substr($pro_name,0,35)."...";}  

	echo '<li><div class="thumbnail my-thumbnail"><a href="'.base_url().'product/'.urlencode(addhyphens($fproducts['product_name'])).'">';
					if($fproducts['product_image'])
					echo '<div class="nothing"><img src="'.$fproducts['product_image'].'" alt="" class="mytnail"></div>';
					echo '<div class="caption my-cap"><h5>'.$pro_name.'</h5></a>';

					echo '<div class = "price-dp">';
			
					$nn = $fproducts['variationsData'];
               		$dec = json_decode($nn, TRUE);
                	
                    $CountryCode = $this->session->userdata('sessiontest');

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
					
					echo '		</div>';

						echo 	  '<br /><br />
							
							  </div>
						  </div>
						</li>	
					';	
}
?>  
  </ul>
  </div> <!-- div class feecaraousel closed -->
<?php } ?>

<?php  
if($featuredCategory)
{
?>
<div class="feecaraousel span12">
<h1 class="latest_pro">Browse Our Categories</h1>
  <ul id="featuredSlider">
<?php
foreach ($featuredCategory as $category)
{
	$cat_name = $category['category_name'];
				/*	$len = strlen($prd_name);
					if($len > 35)
					{$prd_name = substr($prd_name,0,35)."...";}  */

	echo '<li><div class="thumbnail my-thumbnail"><a href="'.base_url().'categories/'.urlencode(addhyphens($category['category_name'])).'">';
					if($category['category_image'])
					echo '<div class="nothing"><img src="'.$category['category_image'].'&width=250&height=250" alt="" class="mytnail"></div>';
					echo '<div class="caption my-cap"><h5>'.$cat_name.'</h5></a>';

						echo 	  '<br /><br />
							
							  </div>
						  </div>
						</li>	
					';
	
}
?>  
  </ul>
  </div> <!-- div class feecaraousel closed -->
<?php
}
?>  




<div class="clearout"></div>
					
			
		<?php   if($latestproducts)
			  {?>
			  <div style = "clear: both;"></div>
		<h1 class="latest_pro">Latest Products  (<a href = "<?php echo base_url(),"product/latest_products" ?>">View All</a>)</h1> 
			  <ul class="thumbnails">
			  <?php			
			 // 	echo "<pre>";print_r($latestproducts);die;
			  	foreach($latestproducts as $products)
				{	
				$prName = $products['product_name'];

					$len = strlen($prName);
					if($len > 40)
					{$prName = substr($prName,0,40)."...";} 
									
					echo '
						<li class="span3">
						  <div class="thumbnail">
							<a  href="'.base_url().'product/'.urlencode(addhyphens($products['product_name'])).'">';
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
		/*	
		<h4 style="text-align:center"><a class="btn btn-warning" href="'.base_url().'product/'.urlencode(addunderscores($products['product_name'])).'"> <i class="icon-zoom-in"></i></a> <a class="btn btn-success addtocart" href="'.base_url().'cart/addtocart/'.urlencode(addunderscores($products['product_id'])).'">Add to <i class="icon-shopping-cart"></i></a>  </h4> 
				if($products['discount_status'] == '1')			  
					{
						echo '
						<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "text-decoration:line-through;color : red;">Rs.'.number_format($products['product_price']).'/-</span>
							<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "">Rs.'.number_format($products['discount_price']).'/- </span>	
						';		  
					}
					else
					{
						echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">Rs.'.number_format($products['product_price']).'/-</span>';		  
					}  */
					
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
						
					echo '		</div>'; ?>
					
					<div class="thumb-product-buttons">
                    <form class="form-horizontal qtyFrm product-btnform" onsubmit = "addtocartwithquantity($(this).attr('action')+'/'+1,this,event,'1');" action = "<?php echo base_url().'cart/addtocart/'.$products['product_id'];?>" >
    
                    <?php {
                    echo'<button type="submit" class="btn btn-success"> Add To <i class=" icon-shopping-cart"></i></button>';
                    }  ?>

                    </form>
                    </div> 
					
				<?php		echo	'</div>
						  </div>
						</li>
					';
				}	  	
			  ?>
			  </ul>	
			  <?php }?>
		
		</div>  <!-- row-below div closed -->
		</div>  <!-- row div closed -->
		</div> <!-- container div closed -->

</div> <!-- mainbody div closed -->


 <!--
 <div class="treebg">
    <div class="container">
    	<div class="row bottom55 ">
        <h1 class="text-center BROWSE">Why to Choose Us</h1>
        	<div class="span4 my-span4">
            	<h3>100% Organic Products</h3><br>
                <p>
                	Expound that actual teachings the great explorer of the truth, the master-builder of human happiness no one rejects, likes, or avoids pleasure itself rationally. 
                </p><br><br><br>
                <h3>Keeps Your Family Healthy</h3><br>
                <p>
                	Expound that actual teachings the great explorer of the truth, the master-builder of human happiness no one rejects, likes, or avoids pleasure itself rationally. 
                </p>
                
                
            </div><!-- col 4 closed-->
      <!--      <div class="span4 my-span4">
       	    <img class="img-responsive" src="images/tree.png" width="429" height="429" alt="tree"> 
            </div><!-- col 4 closed-->
      <!--      <div class="span4 my-span4">
            	<h3>Any Time, Anywhere Delivery</h3><br>
                <p>
                	Expound that actual teachings the great explorer of the truth, the master-builder of human happiness no one rejects, likes, or avoids pleasure itself rationally. 
                </p><br><br><br>
                <h3>100% Organic Products</h3><br>
                <p>
                	Expound that actual teachings the great explorer of the truth, the master-builder of human happiness no one rejects, likes, or avoids pleasure itself rationally. 
                </p>
            </div><!-- col 4 closed-->
  <!--      </div><!-- Row div closed-->
 <!--   </div><!-- Container div closed-->
  <!--  </div> <!-- tree dv-->

    
 <div class="container">
<div class="my-aff-banner">
    	<a href="//bisjexporters.com/contact-us"><img src="<?php echo $base_url; ?>images/Affiliate-min.jpg" class="aff-banner-img"></a>
    </div>
    </div>


    <div class="container">
    <div class="row">
    
    	<div class="span4 my-span4">
       	  <div class="greenbx">
            	<h1>Happy Customers</h1>
                <p>
                	We keep our customers happy by providing them quality products, great discounts and much more. 
                </p>
                <h3 class="shopnow"><a href="<?php echo base_url(); ?>product/latest-products">SHOP NOW</a></h3>
            </div><!-- box closed-->
        </div><!-- Col 1 closed-->
        <div class="span4 my-span4">
       	  <div class="greenbx">
            	<h1>Shipping Charges</h1>
                <p>
                	Click below to check local and international shipping charges. 
                </p>
                <h3 class="shopnow"><a href="<?php echo base_url(); ?>International-shipping-charges">CHECK NOW</a></h3>
            </div><!-- box closed-->
        </div><!-- Col 1 closed-->
        
        <div class="span4 my-span4">
       	  <div class="greenbx">
            	<h1>Need Help ?</h1>
                <p>
                	For any query you can visit our FAQ page for assistance. 
                </p>
                <h3 class="shopnow"><a href="<?php echo base_url(); ?>faq">READ NOW</a></h3>
            </div><!-- box closed-->
        </div><!-- Col 1 closed-->
        
    </div><!-- Row div closed-->
</div><!-- Container div closed-->




		
		
		
<style>.thumbnails>li{min-height: 300px;}.home-alert{margin-left:0px;}</style>

<script>
	$(document).ready(function(){setTimeout(function(){arrangeThumbnails()},3000)});
	function arrangeThumbnails()
	{return;
		var maxheight = 0;
		$(".thumbnails li").css("height","auto");
		$(".thumbnails li").each(function(){maxheight = Math.max($(this).height(),maxheight)});
		$(".thumbnails li").css("height",maxheight+"px")
	}
	$('.carousel-showmanymoveone').each(function(){
var itemToClone = $(this);

for (var i=1;i<4;i++) {
itemToClone = itemToClone.next();

if (!itemToClone.length) {
itemToClone = $(this).siblings(':first');
}

itemToClone.children(':first-child').clone()
.addClass("cloneditem-"+(i))
.appendTo($(this));
}
});
</script>

<script type="text/javascript">

$(window).load(function() {
    
    $("#featuredSlider").flexisel({
        visibleItems: 4,
        itemsToScroll: 1,         
        autoPlay: {
            enable: true,
            interval: 5000,
            pauseOnHover: true
        }        
    });
    $("#featuredSlider2").flexisel({
        visibleItems: 4,
        itemsToScroll: 1,         
        autoPlay: {
            enable: true,
            interval: 5000,
            pauseOnHover: true
        }        
    });        
});
</script>
