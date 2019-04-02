<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
		<!--	<p class="pull-left">&copy; <a href="<?php echo COMPANYURL; ?>" target="_blank"><?php echo COMPANYNAME; ?></a> 2018</p>
			<p class="pull-right">Powered by: <a href="//usman.it/free-responsive-admin-template">Charisma</a></p>  -->
		</footer>
		
	</div><!--/.fluid-container-->
<script>/*
var g_cbox_ele;
	$(document).ready
	(
		function()
		{
			$(".cboxElement").live
			(
				"click",
				function()
				{
					g_cbox_ele = $(this);
					setTimeout
					(
						function()
						{
							$.ajax
							(
								{
									url : g_cbox_ele.attr("href"),
									success : function(data)
												{
													$("#cboxMiddleRight").html(data);
												}
								}
							);
						},1000
					);															
				}
			);
		}
	);*/
</script>	
<?php  $theme_link =  base_url()."/theme_back/";?>
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