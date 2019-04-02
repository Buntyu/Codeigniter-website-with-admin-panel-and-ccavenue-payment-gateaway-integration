<div id="mainBody">

	<div class="container">
	
		<div class="row">
		   <div class="row-below">
		   <div class = "span12" id = "disp-alert"></div>
<ul class="breadcrumb">
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

<div class="span12">
<div class="blog-title"><h1 style="color:#608408;text-align:center;font-size:24px;"><?php echo $obj->product["blog_name"];?></h1></div><br>

<div class="blog-fimage"><img src="<?php echo $obj->product["featured_image"]."&width=700&height=500"; ?>" alt="<?php echo $obj->product["blog_name"]; ?>"/><span style="text-align:center;">posted on <?php echo $obj->product["date"]; ?></span></div><br><br>
</div>

<div class="blog-content"><span style="font-size:14px;"><?php echo $obj->product["blog_content"];?></h2></div><br>


</div>
</div>
</div>
</div>

