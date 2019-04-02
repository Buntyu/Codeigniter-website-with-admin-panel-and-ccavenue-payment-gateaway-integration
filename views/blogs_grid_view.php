<?php // echo "<pre>";print_r($blogs_data);echo "</pre>";  ?>  

<div id="mainBody">

	<div class="container">
		<div class="row">
		   <div class="row-below">
		   <div class = "span12" id = "disp-alert"></div>
		   <div style = "clear: both;"></div> 
		   <h1 style="color:#608408;text-align:center;font-size:27px;">Our Latest Blogs</h1><hr>
		   
			  <?php			
			 // 	echo "<pre>";print_r($latestproducts);die;
			  	foreach($blogs_data as $blog)
				{ $str = strip_tags($blog["blog_content"]);
                 $string = substr($str,0,240).'...';	
				?>	
				
				<div id="blog-grid" class="span3">
				<a  href=<?php echo base_url().'blog/'.addhyphens($blog['blog_name']); ?>>
                <div class="blog-grid-image">    
				<img id = "prod-img" src="<?php echo $blog["featured_image"]."&width=270&height=270"; ?>" style="width:100%" alt="<?php echo $blog["blog_name"]; ?>"/>
                </div>
				<div class="blog-grid-name">
					<h4 style="color:#608408;text-align:center;"><?php echo $blog["blog_name"]; ?></h4></div>
				<div class="blog-grid-content"><?php echo $string; ?></div>
				</a>	

            	</div>			
			<?php		
				}	  	
			  ?>
			 
		   
</div>
</div>
</div>
</div>
</div>		   

			 