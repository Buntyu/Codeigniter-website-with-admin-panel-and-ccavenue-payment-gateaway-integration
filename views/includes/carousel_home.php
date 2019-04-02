<?php
	$theme_url = base_url()."theme/";
?>
<style>
	#myCarousel .carousel-caption	
	{
		display:block!important;
		color : white;
	}
</style>
<div id="carouselBlk" class = "">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			<?php 
			//	echo "<pre>";print_r($carouselData);die;
			if($carouselData)
			{				
				foreach($carouselData as $carousel)
				{//style="height: 400px;"
					echo '
						<div class="item">
						  <div class="" >
							<a href="'.$carousel["carousel_link"].'"><img style="" src="'.$carousel["carousel_image"].'&width=870&height=301" alt="special offers"/></a>	';
					if($carousel["carousel_caption"] != "hidden")
					{
						echo '	<div class="carousel-caption">									
										'.$carousel["carousel_caption"].'
										</div>								 
							';	
					}					
					echo ' </div>
								  </div>';
				}
			}
			//	echo "<pre>";print_r($carouselData);die;
			?>		  
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  </div> 
</div>
