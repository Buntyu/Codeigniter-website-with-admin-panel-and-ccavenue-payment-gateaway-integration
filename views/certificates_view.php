<?php

  // echo "<pre>";print_r($carausel_data);echo "</pre>";
   
?>  
<style>
	.thumbnails>li
	{
		min-height: 300px;
	}
	

</style>

<div id="mainBody">

	<div class="container">
		<div class="row">
		   <div class="row-below">
		   <div class = "span12" id = "disp-alert"></div>
		   <div style = "clear: both;"></div> 
		   
		   
			  <?php			
			 // 	echo "<pre>";print_r($latestproducts);die;
			  	foreach($carausel_data as $certificates)
				{	?>	
				
				<div id="gallery" class="span3">
            			<a href="<?php echo $certificates["carousel_image"]."&width=500&height=500"; ?>" title="<?php echo $certificates["carousel_caption"]; ?>">
				<img id = "prod-img" src="<?php echo $certificates["carousel_image"]."&width=270&height=270"; ?>" style="width:100%" alt="<?php echo $certificates["carousel_caption"]; ?>"/>
            			</a></div>			
			<?php		
				}	  	
			  ?>
			 
		   
		   
		   
		   
		   
		   
		   
		   
</div>
</div>
</div>
</div>
</div>		   
		   
			 