<?php
	$theme_url = base_url()."theme/";	
?>

<script>
/*	$(document).ready(function(){$(".subMenu").first().addClass("open");$(".subMenu").first().find("ul").css("display","block")})

$(document).ready(function(){$(".subMenuTwo").addClass("open");$(".subMenuTwo").find("ul").css("display","block")})
$(document).ready(function(){$(".subMenu").addClass("open");$(".subMenu").find("ul").css("display","block")})

    $(document).ready(function()
	{
		$(".subMenu").unbind("click").bind
		(
			"hover",
			function()
			{debugger;
				$(".subMenu").removeClass("open");
				$(".subMenu").find("ul").css("display","none");
				$(this).addClass("open");
				$(this).find("ul").css("display","block")
			},
			function()
			{
				$(this).removeClass("open");
				$(this).find("ul").css("display","none");
			}
		);

		$(".subMenuTwo").unbind("click").bind
		(
			"hover",
			function()
			{debugger;
				$(".subMenu").removeClass("open");
				$(".subMenu").find("ul").css("display","none");
				$(this).addClass("open");
				$(this).find("ul").css("display","block")
			},
			function()
			{
				$(this).removeClass("open");
				$(this).find("ul").css("display","none");
			}
		);   */
        $(document).ready(function()
	   {
		$(".catTwo").click(function()
         {
         	$("#sideManuTwo").toggle();
         	
         }

			);

	});
</script>

<!-- Sidebar ================================================== -->
<div id="mainBody">


	<div class="container">
	
		<div class="row">
		   <div class="row-below">
		   <div class = "span12" id = "disp-alert"></div>
<div id="sidebar" class="span3">
		<?php
		  
			if(!$obj->hidecartlist)
			{
				
		?>
<!--		<div class="well well-small">
		<img src="<?php echo $theme_url; ?>themes/images/ico-cart.png" alt="cart">
		<a id="myCart" href="<?php echo base_url()."checkout"; ?>" >
			<span title="Checkout" class="show-tooltip" data-rel="tooltip" style="margin-right: 5px;"><span class = "item-cart-count"><?php echo $obj->carttotalitems; ?></span> Item(s) in your cart  </span><span class="badge badge-warning "><span class = "cart-price"> <?php echo $sign.number_format($obj->carttotalprice);?></span> /-</span>
			</a>
		</div>  -->
		<?php
		}	
	?> 
	<div class="cat-desktop">	
	<h4 style="color:#608408;"> Categories </h4>	
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
			<?php 

				if($categoryData)
				{

					//echo "<pre>";print_r($categoryData);die;
					
					foreach($categoryData as $category)
					{
						$submenu = (empty($category["sub_categories"])) ? "":"subMenu";
						$CatName = $category['category_name'];
						$newCatName = addhyphens(urldecode($CatName));
						echo 
						'
							<li class="'.$submenu.'"><a href = "'.base_url().'categories/'.$newCatName.'"> '.$category['category_name'].'</a>	
							<ul style = "display:block;">
						';
						if(!empty($category["sub_categories"])) 
						{
							//print_r($category["sub_categories"]);
							foreach($category["sub_categories"] as $subcats)
							{
								$subCatName = $subcats['category_name'];
								$newSubCatName = addhyphens(urldecode($subCatName));
								echo '<li>
										<a href="'.base_url().'subcategories/'.$newCatName.'/'.$newSubCatName.'">
											<i class="icon-chevron-right"></i>'.$subcats['category_name'].'
										</a>
									</li>';
							}	
						}						
						echo '</ul></li>';
					}
				}
			?>			 
		</ul>

</div>
		 
		<br/>
		<div class="cat-mobile">
		<h4 style="color:#608408;" class="catTwo"> Categories <img src="<?php echo $theme_url; ?>themes/images/dropdown-arrow.png" class="drop-img"></h4>	
		<ul id="sideManuTwo" class="nav nav-tabs nav-stacked">
			<?php 

				if($categoryData)
				{

					//echo "<pre>";print_r($categoryData);die;
					
					foreach($categoryData as $category)
					{
						$submenu = (empty($category["sub_categories"])) ? "":"subMenu";
						$CatName = $category['category_name'];
						$newCatName = addhyphens(urldecode($CatName));
						echo 
						'
							<li class="'.$submenu.'"><a href = "'.base_url().'categories/'.$newCatName.'"> '.$category['category_name'].'</a>	
							<ul style = "display:block;">
						';
						if(!empty($category["sub_categories"])) 
						{
							//print_r($category["sub_categories"]);
							foreach($category["sub_categories"] as $subcats)
							{
								$subCatName = $subcats['category_name'];
								$newSubCatName = addhyphens(urldecode($subCatName));
								echo '<li>
										<a href="'.base_url().'subcategories/'.$newCatName.'/'.$newSubCatName.'">
											<i class="icon-chevron-right"></i>'.$subcats['category_name'].'
										</a>
									</li>';
							}	
						}						
						echo '</ul></li>';
					}
				}
			?>			 
		</ul>
		</div>
	<!--	<div class="thumbnail" >
			<a href="http://mywebadmin.in/" target="_blank"><img style = "width:100%;" src="http://www.mywebadmin.in/images/adver.gif"></a>
		</div> -->
	</div>
	<style>
#sideManuTwo
{
display:none;
	
}
</style>
<!-- Sidebar end=============================================== -->
<div class="span9">	
