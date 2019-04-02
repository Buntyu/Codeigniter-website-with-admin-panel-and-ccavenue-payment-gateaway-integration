<script>
	setTimeout(function(){$(".viewbtn").attr("target","_blank");},1000);
	
//	setTimeout(function(){window.location.href = window.location.href;},(1000*60*2));
</script>

<div class="modal hide fade" id="deletemodal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
				<center class = 'modal-loader'>
					<img src="<?php echo base_url(); ?>images/preloader.gif">			
				</center>
				<div class="box-content deletemodal-body">
							<fieldset>
					<form class="delfrom2" action="<?php echo base_url();?>admin/sales/deleteorder/" name="delform" method="GET">
					<input type="hidden" name="id" class = "product_idd" value="">
						<input type="submit" id="delbtn" class="btn btn-large btn-danger" value="Delete">
						<button type="button" id="canbtn" class="btn btn-large" data-dismiss="modal">Cancel</button>
					</form>
					
							</fieldset>
				
				</div>				
			</div>
			
</div>

<script>
$(".deletebtn").live("click",function()
	{
		$(".modal-loader").show();	
		$(".modal-header h3").html("Loading User Type...");
		$.ajax
		(
			{
				url : $(this).attr("href"),
				success : function(data)
				{	
					try
					{
						var response = JSON.parse(data);	
					}
					catch(e)
					{
						alert("REQUEST FAILED!!! Reloading this page...");
						window.location.href = window.location.href;
					}	
					if(response.status == "success")
					{
						var ob_data = response.data;
						$(".modal-header h3").html('Are You Sure You Want to Delete?');
						$(".product_idd").val(ob_data);
						$(".modal-loader").hide();
						$(".productmodal-body").show();
						$(".product-addData:last").find("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
					}
				},
				fail : function()
				{
					alert("There is some problem with your request...");
					window.location.href = window.location.href;
				}
			}
		);						
	});
</script>