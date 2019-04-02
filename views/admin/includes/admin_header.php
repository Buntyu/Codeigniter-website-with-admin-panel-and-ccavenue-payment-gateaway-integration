<?php  
	$theme_link =  base_url()."theme_back/";
	if(!(isset($oObj)))
	{
		echo "Please pass an object of the controller to admin_header.php as variable 'oObj'";die;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo isset($title)?$title: COMPANYNAME; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Ibad Gore">

	<!-- The styles -->
	
	<style type="text/css">
	  body {
		padding-bottom: 40px;
		cursor: default;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	  .form-horizontal .control-label
	  {
	  	font-weight: bold;
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
	  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo $theme_link; ?>img/favicon.ico">
	<?php echo "<script>var g_base_link = '".$theme_link."'</script>";	?>
	<script>
		$("document").ready(function()
		{
			setTimeout(function(){$("#preloadView").fadeOut(500);},100);	
		});
	</script>
</head> 
<body>
	<table id = "preloadView">
		<tr>
			<td></td>
			<td>
				<center><img src="<?php echo base_url(); ?>images/loading-main1.gif">
				<br><br><br>
				<div style="color: #60697E;font-size: 30px;"><b>Hold On</b> while we are loading your content...</div>
				</center>			
			</td>
			<td></td>
		</tr>		
	</table>	
	<?php 
	//	echo "<pre>";print_r($this->session->userdata("display_name"));die;
		include("admin_navbar.php");
	?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php include("admin_leftmenu.php");?>
		
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="//en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<?php include("admin_breadcrumb.php");?>
				</ul>
			</div>
			<?php 						
				$error = $oObj->session->flashdata("error");				
				$success = $oObj->session->flashdata("success");
				$info = $oObj->session->flashdata("info");
				$notify = $oObj->session->flashdata("notify");				
				if(isset($error) && $error!="")
				{
					echo '
						<div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">&times;</button>
							'.$error.'
						</div>
					';
				}
				if(isset($success) && $success!="")
				{
					echo '
						<div class="alert alert-success">
							<button data-dismiss="alert" class="close" type="button">×</button>
							'.$success.'
						</div>
					';
				}
				if(isset($info) && $info!="")
				{
					echo '
						<div class="alert alert-info">
							<button data-dismiss="alert" class="close" type="button">×</button>
							'.$info.'
						</div>
					';
				}
				if(isset($notify) && $notify!="")
				{
					echo '
						<div class="alert alert-block">
							<button data-dismiss="alert" class="close" type="button">×</button>
							'.$notify.'
						</div>
					';
				}
				
			?>	