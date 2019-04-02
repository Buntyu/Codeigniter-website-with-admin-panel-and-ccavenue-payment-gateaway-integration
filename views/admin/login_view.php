<?php  
$theme_link =  base_url()."theme_back/";?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo "Admin Login | ".COMPANYNAME; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- The styles -->
	
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	  #preloadView
	  {
	  	width: 100%;
		height: 100%;
		position: fixed;
		top: 0%;
		left: 0%;
		background-color: #FDFDFD;
		z-index: 1000000;
	  }	  
	</style> 
	<link href="<?php echo $theme_link; ?>css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo $theme_link; ?>css/charisma-app.css" rel="stylesheet">
	<link href="<?php echo $theme_link; ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo $theme_link; ?>css/fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo $theme_link; ?>css/chosen.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/uniform.default.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/colorbox.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/opa-icons.css' rel='stylesheet'>
	<link href='<?php echo $theme_link; ?>css/uploadify.css' rel='stylesheet'>
	
	<!-- jQuery -->
	<script src="<?php echo $theme_link; ?>js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo $theme_link; ?>js/jquery-ui-1.8.21.custom.min.js"></script>	
	
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo $theme_link; ?>img/favicon.ico">
	<?php echo "<script>var g_base_link = '".$theme_link."'</script>";	?>
	<script>
		$("document").ready(function()
		{
			setTimeout(function(){$("#preloadView").fadeOut(500);},100);	
			/*
			alert($(".login-box").width());
			alert($("input").width());*/
			if($(".login-box").width() < $("input").width())
			{
				$(".login-box").css("width",$("input").width()+100+"px");
			}
		}); 
	</script>
</head>

<body>
<table id = "preloadView">
		<tr>
			<td></td>
			<td>				
				<center>
					<div style="color: #60697E;font-size: 50px;">Welcome to <b><?php echo COMPANYNAME; ?></b></div>
					<br><br><br>
					<img src="<?php echo base_url(); ?>images/loading-main1.gif">
					<br><br><br>
					<div style="color: #60697E;font-size: 30px;"><b>Hold On</b> while we are loading your content...</div>
				</center>			
			</td>
			<td></td>
		</tr>		
	</table>
		<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2><?php echo COMPANYNAME; ?></h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						Please login with your Username and Password.
					</div>
					<form class="form-horizontal" action="<?php echo base_url()."admin/login/user_login"; ?>" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span>
								<input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span>
								<input class="input-large span10" name="password" id="password" type="password" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" name = "remember" id="remember" />Remember me</label>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Login</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
				</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->

	
<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- transition / effect library -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="<?php echo $theme_link; ?>js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="<?php echo $theme_link; ?>js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='<?php echo $theme_link; ?>js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<?php echo $theme_link; ?>js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="<?php echo $theme_link; ?>js/excanvas.js"></script>
	<script src="<?php echo $theme_link; ?>js/jquery.flot.min.js"></script>
	<script src="<?php echo $theme_link; ?>js/jquery.flot.pie.min.js"></script>
	<script src="<?php echo $theme_link; ?>js/jquery.flot.stack.js"></script>
	<script src="<?php echo $theme_link; ?>js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="<?php echo $theme_link; ?>js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<?php echo $theme_link; ?>js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="<?php echo $theme_link; ?>js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="<?php echo $theme_link; ?>js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="<?php echo $theme_link; ?>js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="<?php echo $theme_link; ?>js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="<?php echo $theme_link; ?>js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="<?php echo $theme_link; ?>js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<?php echo $theme_link; ?>js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="<?php echo $theme_link; ?>js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?php echo $theme_link; ?>js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="<?php echo $theme_link; ?>js/charisma.js"></script>
	
	<link id="bs-css" href="<?php echo $theme_link;?>css/bootstrap-cerulean.css" rel="stylesheet">
		
</body>
</html>