<script>
window.onload = function ()
{
	<?php
		$nclks = "[";
		if(isset($nonclickable) && $nonclickable)
		{
			foreach($nonclickable as $nonclicks)
			{
				$nclks .= $nonclicks.",";
			}			
			$nclks = substr($nclks,0,strlen($nclks)-1);
		}		
		$nclks .= "]";
	?>	
	g_table = g_table.replace("/\/g","");
	$(".datatable tbody").html(g_table);
	$('.datatable').dataTable({
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs": [
          	{ 'bSortable': false, 'aTargets': <?php echo $nclks; ?> }]
		} );
		if(typeof(customTableEvent) == "function")customTableEvent();
		$('.btn-close').click(function(e){
			e.preventDefault();
			$(this).parent().parent().parent().fadeOut();
		});
		$('.btn-print').click(function(e){
			e.preventDefault();
			window.print();
		});

		$('.btn-minimize').click(function(e){
			e.preventDefault();
			var $target = $(this).parent().parent().next('.box-content');
			if($target.is(':visible')) $('i',$(this)).removeClass('icon-chevron-up').addClass('icon-chevron-down');
			else 					   $('i',$(this)).removeClass('icon-chevron-down').addClass('icon-chevron-up');
			$target.slideToggle();
		});
		$('.btn-setting').click(function(e){
			e.preventDefault();
			$('#myModal').modal('show');
		});

	$("#g-table-loader-custom").hide("slow");
	$(".dataTables_wrapper").show();
	setTimeout(function()
	{
		/*
		$(".dataTables_wrapper").css
		(
			{
				"overflow":"auto"		
			}
		);*/
		$(".table-box").each(function()
			{
				$(this).css({"width":$(this).find(".table").width()+50+"px"});
			}
		)
	},500);	
}
//var g_table_dnt_initialise = true;
</script>
<style>.dataTables_wrapper{overflow: suto !important;}.center {max-width: 500px;overflow: auto !important;}.dataTables_wrapper{display : none;}.dataTables_length select{width : auto !important;}.dataTable th{cursor: pointer;}.btn-print {width: 37px !important;}a.manualorder_link {line-height: 24px;padding-left: 30px;}
</style>
<?php 
	ob_start();
	function getActionHtml($btns)
	{		
		$strHtml = "";
		foreach($btns as $btn)
		{
			$onclick = "";
			if($btn['modal'])
			{
				$onclick = 'onclick = "$(\''.trim($btn['modal']).'\').modal(\'show\');return false;"';
				
			}
			if($btn['type'] == "view")
			{
				$strHtml.='<a href="'.$btn['link'].'" class="btn btn-success viewbtn" style = "margin:5px;" '.$onclick.'>
										<i class="icon-zoom-in icon-white"></i>  
										'.$btn['text'].'  
									</a>';
			}
			else if($btn['type'] == "edit")
			{
				$strHtml.='<a href="'.$btn['link'].'" class="btn btn-info editbtn" style = "margin:5px;" '.$onclick.'>
										<i class="icon-edit icon-white"></i>  
										'.$btn['text'].'                                        
									</a>';
			}
			else if($btn['type'] == "delete")
			{
				$strHtml.='<a href="'.$btn['link'].'" class="btn btn-danger deletebtn" style = "margin:5px;" '.$onclick.'>
										<i class="icon-trash icon-white"></i> 
										'.$btn['text'].'  
									</a>';
			}
			else if($btn['type'] == "tick")
			{
				$strHtml.='<a href="'.$btn['link'].'" class="btn btn-info tickbtn" style = "margin:5px;" '.$onclick.'>
										<i class="icon-check icon-white"></i>  
										'.$btn['text'].'                                        
									</a>';
			}			
		}
		return $strHtml;
	}
	function getStatusHtml($status)
	{
//		echo "<pre>"; print_r($status);
		$strHtml = '';
		if($status['type'] == "active")
		{			
			$strHtml.= '<span class="label label-success">'.$status['text'].'</span>';			
		}
		else if($status['type'] == "pending")
		{
			$strHtml.= '<span class="label label-warning">'.$status['text'].'</span>';
		}
		else if($status['type'] == "danger")
		{
			$strHtml.= '<span class="label label-important">'.$status['text'].'</span>';
		}
		else if($status['type'] == "inactive")
		{
			$strHtml.= '<span class="label label-inactive">'.$status['text'].'</span>';
		}
		return $strHtml;
	}		
?>
<div class="row-fluid sortable table-box">		
<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $tableLabel; ?></h2>
						<?php if ($tableLabel == 'Pending Orders' || $tableLabel == 'All Orders'){ ?>
						<a href="<?php echo base_url().'admin/sales/manual_order';?>" target="_blank" class="manualorder_link">Create Manual Order</a>
						<?php } ?>
						<div class="box-icon">
							<a href="#" class="btn btn-print btn-info">PRINT</a>
						</div>
					</div>
					<div class="box-content">
						<p><?php $sum = 0;
     $sum1=0;
     foreach($tableEntries as $rows)
         {
          $sum = $rows['affiliate_comm'];
          $paid = $rows['affiliate_comm_status'];
          
          foreach($paid as $ggg){
           foreach($sum as $ggg1){
           if($ggg == 'pay' && $ggg1 ){
           $sum1 += $ggg1;
           }
          }}
         }if ($sum1){echo "<span style='font-weight:bold; color:#49afcd;'>Totals Payable Commission = Rs.$sum1</span>"; } ?></p>
					<!--	<center style="margin:10px;" id = "g-table-loader-custom">
							<img title="img/ajax-loaders/ajax-loader-8.gif" src="<?php echo base_url()."theme_back/"; ?>img/ajax-loaders/ajax-loader-6.gif">
						</center>	-->					
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							  	<?php 									
									foreach($tableHeadings as $headings)
									{
										echo "<th>".$headings."</th>";
									}
								?>
							  </tr>
						  </thead>   
						  <tbody>
						  	<?php 
							//	echo "<pre>";print_r($tableEntries);die;
								$strTable = "";
								if($tableEntries)
								{
									foreach($tableEntries as $rows)
									{
										$geet=$rows['order_id'];
          								$gg='';
          
          						foreach($geet as $gg){
            							$gg;           
          							}
									//	echo "<pre>";print_r($rows["application_status"]);die;
										$strTable.= "<tr class = 'custom-table-rows'>";
										foreach($rows as $colname=>$entries)
										{
											$strTable.= '<td class="center">';
										//	echo "<pre>";print_r($rows[$colname]);continue;
											if($entries['type'] == 'status')
											{
											//	echo "<pre>";print_r($entries);
												$strTable.= getStatusHtml($entries["data"]);
											}
											else if($entries['type'] == 'actions')
											{
												$strTable.= getActionHtml($entries["data"]);
											}
											else
											{
												 if($entries["data"]=='pay'){
             									$strTable.= '<a href="'.base_url().'admin/personnel/disp_invoice1/'.$gg.'" class="btn btn-info tickbtn" style = "margin:5px;" '.$onclick.'>
          										<i class="icon-check icon-white"></i>  
          															pay                                       
         													</a>';
             
           														 }
            					else if($entries["data"]=='paid'){
            $strTable.= '<a href="'.base_url().'admin/personnel/disp_invoice1/'.$gg.'" class="btn btn-success tickbtn" style = "margin:5px;" '.$onclick.'>
          <i class="icon-check icon-white"></i>  
          paid                                  
         </a>';
         
         
            }
            else{
             
            $strTable.= $entries["data"];
            }
											}
											
											$strTable.= "</td>";
											
										}
										$strTable.= "</tr>";
									}
									$strTable = str_replace(PHP_EOL, '',$strTable);
									$strTable = str_replace(array("\n","\r\n"), '',$strTable);
									$strTable = str_replace('/\s\s+/', '',$strTable);
									echo '<script> var g_table = ""; g_table = "'.nl2br(addslashes($strTable)).'";</script>';	
									echo $strTable;
								}														
								else
								{
									echo '<script> var g_table = "";</script>';
								}
							?>
							<!--<tr>								
								<td>David R</td>
								<td class="center">2012/01/01</td>
								<td class="center">Member</td>
								<td class="center">
									<span class="label label-danger">Active</span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
									<a class="btn btn-info" href="#">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
								</td>
							</tr>-->							
						  </tbody>
					  </table>            
					</div>
				</div>
			</div>
<?php 
	if(isset($descFirst) && $descFirst == TRUE)
	{
		echo '<script>
			function customTableEvent()
			{
				$(".datatable th:first-child").trigger("click");
			}
			</script>';
	}
	ob_end_flush();	
?>