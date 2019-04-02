<?php
//echo "<pre>";print_r($year);echo "</pre>";die;
?>

<form class="form-horizontal" id = "down_date_form"  action="<?php echo base_url()."admin/sales/get_down_date"; ?>" method = "POST">
<div class="date-picker">
<div class="control-group dateP">
				<label class="control-label" for="month">Month</label>
				<div class="controls">
				  <select name = "month">
				  	<?php 
				  	foreach ($month as $mm):  
if($mm['sale_month'] =='1'){$month = "JANUARY";}elseif($mm['sale_month']=='2'){$month="FEBRUARY";}elseif($mm['sale_month']=='3'){$month="MARCH";}elseif($mm['sale_month']=='4'){$month="APRIL";}elseif($mm['sale_month']=='5'){$month="MAY";}elseif($mm['sale_month']=='6'){$month="JUNE";}elseif($mm['sale_month']=='7'){$month="JULY";}elseif($mm['sale_month']=='8'){$month="AUGUST";}elseif($mm['sale_month']=='9'){$month="SEPTEMBER";}elseif($mm['sale_month']=='10'){$month="OCTOBER";}elseif($mm['sale_month']=='11'){$month="NOVEMBER";}elseif($mm['sale_month']=='12'){$month="DECEMBER";}else{$month="unknown month";}
				  		?>

				  	<option value="<?php echo $mm['sale_month']; ?>"><?php echo $month; ?></option>

				  	<?php endforeach; ?>
				  </select>				  
				</div>
			</div> 
<div class="control-group dateP">
				<label class="control-label" for="year">Year</label>
				<div class="controls">
				  <select name = "year">
				  	<?php 
				  	foreach ($year as $yy):  ?>
				  	<option value="<?php echo $yy['sale_year']; ?>"><?php echo $yy['sale_year']; ?></option>
				  	<?php endforeach; ?>
				  </select>				  
				</div>
			</div> 
			
			<div class="control-group dateP">
			<div class="controls">
				<input class="btn btn-small btn-success" type="submit" value="GO" />
			</div>
		</div>
</div>	<!-- date picker div closed -->
</form>

<style>
.date-picker{
    display: -webkit-inline-box;
    background-color: #f5f5f5;
    padding: 2%;
    border:1px solid black;
}
small.btn-success {
    width: 80%;
}
.dateP {
    width: 30%;
}
</style>		