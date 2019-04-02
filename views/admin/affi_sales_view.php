<?php
//echo "<pre>";print_r($salesData);echo "</pre>";die;
//echo "<pre>";print_r($paymentData);echo "</pre>";die;
//echo "<pre>";print_r($affiliateData);echo "</pre>";die;
$aff_id = $affiliateData[0]['affiliate_id'];
$aff_name = $affiliateData[0]['first_name'];
$aff_email = $affiliateData[0]['email'];
?>
<h2 style="text-align: center;">SALES REPORT</h2><br>

   <?php
   
   $newArray=array();
	foreach($salesData as $val){
	$highKey = $val['YEAR'];	
    $newKey=$val['MONTH'];
    $subKey=$val['WEEK'];
    $newArray[$highKey][$newKey][$subKey][]=$val;
}

//echo "<pre>";print_r($newArray);echo "</pre>";die;

     foreach($newArray as $hkey => $hvalue ):

     foreach($hvalue as $key => $value ):
     	//echo "<pre>";print_r($data);echo "</pre>";die;
     if($key =='1'){$month = "JANUARY";}elseif($key=='2'){$month="FEBRUARY";}elseif($key=='3'){$month="MARCH";}elseif($key=='4'){$month="APRIL";}elseif($key=='5'){$month="MAY";}elseif($key=='6'){$month="JUNE";}elseif($key=='7'){$month="JULY";}elseif($key=='8'){$month="AUGUST";}elseif($key=='9'){$month="SEPTEMBER";}elseif($key=='10'){$month="OCTOBER";}elseif($key=='11'){$month="NOVEMBER";}elseif($key=='12'){$month="DECEMBER";}else{$month="(error getting month)";}

     foreach($value as $skey => $svalue):
     	$megatotal = 0;
     	$month_num = $key;
     	$week = $skey;
     	$year = $svalue[0]['YEAR'];
     	
     	$week_start = new DateTime();
		$week_start->setISODate($year,$week);
		$week_st = $week_start->format('d-M-Y');
		$week_start->modify('+6 days');
		$week_en = $week_start->format('d-M-Y');

     	?>
     <div class="sale-summ">
    <h3><?php echo $month.'&nbsp('.$week_st.'&nbsp-&nbsp'.$week_en.')'; ?> </h3>
   	<table class="table table-bordered">	
   		<tr>
		<th>Order ID </th>
		<th>Customer Name </th>
		<th>Country</th>
		<th>Sale Amount </th>
		<th>Commission(20%) </th>
		<th>TDS on commission </th>
		<th>Total Commission (TDS Deducted)</th>
		<th>Action </th>
	</tr>
	<?php

	if(isset($paymentData))
    {
    	$payarray = array();
    	foreach($paymentData as $paykey => $paydata)
    	{
    		$paym = $paydata['month'];
    		$payw = $paydata['week'];
    		$payarray[$paym][$payw] = $paydata;

    	} 
    	//echo "<pre>";print_r($payarray[$month_num][$week]);echo "</pre>";die;
    	if(isset($payarray[$month_num][$week]))
    	{
    		$found="yes";
    		$code = $payarray[$month_num][$week]['refference_code'];
    	}
    	else
    	{
    		$found="no";
    	}
    } 
      $orderid = "";
	 foreach($svalue as $fkey => $fvalue):
	  /*  $finetotal = $fvalue['total_price']-$fvalue['reff_discount'];*/
	   $finetotal = $fvalue['total_price']-$fvalue['total_shipping'];
	 	$comm = round(20/100*$finetotal, 2);
        	$tds = round($comm/10, 2);
        	$total = round($comm-$tds, 2);
	 	$megatotal += $total; 
	 	if ($orderid) $orderid .= ',';
	 	$orderid .= $fvalue['order_id'];
	 	$date = date('Y-m-d');

	 	?>
	<tr>

	
		<td><?php echo $fvalue['order_uid']; ?></td>
		<td><?php if($fvalue['customer_name'] != '') { echo $fvalue['customer_name']; } else { echo $fvalue['ship_name']; } ?></td>
		<td><?php echo $fvalue['ship_country']; ?></td>
		<td><?php echo $finetotal; ?></td>
		<td><?php echo $comm; ?></td>
		<td><?php echo $tds; ?></td>
		<td><?php echo $total; ?></td>
		<td><a href="<?php echo base_url();?>admin/personnel/disp_invoice/<?php echo $fvalue['order_id']; ?>"><button class="btn-info">View Order</button></a></td>
	</tr>

	<?php endforeach; ?>

	<tr>
    <td colspan="6"><h4 style="text-align: right;color:green;">TOTAL COMMISSION :</h4></td>
    <td colspan="2"><span style="color:green;"><?php echo $megatotal; ?></span></td>
	</tr>
	<?php if ($found == "no") { ?>
	<tr>
    <td colspan="6"><h4 style="text-align: right;color:green">ADD REFFRENCE CODE :</h4></td>
    <form method="POST" id="affiPay" action="<?php echo base_url(); ?>admin/personnel/insertPayment" >
    	<input type="hidden" name="pay_amt" value="<?php echo $megatotal; ?>">
    	<input type="hidden" name="order_id" value="<?php echo $orderid; ?>">
    	<input type="hidden" name="pay_date" value="<?php echo $date; ?>">
    	<input type="hidden" name="reff_status" value="PAID">
    	<input type="hidden" name="month" value="<?php echo $month_num; ?>">
        <input type="hidden" name="month_full" value="<?php echo $month; ?>">
    	<input type="hidden" name="week" value="<?php echo $week; ?>">
    	<input type="hidden" name="aff_id" value="<?php echo $aff_id; ?>">
        <input type="hidden" name="aff_name" value="<?php echo $aff_name; ?>">
        <input type="hidden" name="aff_email" value="<?php echo $aff_email; ?>">
        <input type="hidden" name="week_st" value="<?php echo $week_st; ?>">
        <input type="hidden" name="week_en" value="<?php echo $week_en; ?>">
    <td><span style="color:green;"><input type="text" name="pay-reff" value=""></span></td>
    <td><button class="btn btn-success"  style="text-align: right;" onclick = "submitPayment()" >PAY</button></td>
    </form>
	</tr>
	<?php } 
	elseif ($found == "yes") { ?>
    <tr>
    <td colspan="7"><h4 style="color:#D24842;text-align: center;">THIS WEEK'S COMMISSION IS PAID</h4></td>
    <td colspan="2"><input type="text" value="<?php echo $code; ?>" readonly><br><small>Payment Refference Code</small></td>
	</tr>
	<?php } ?>

	</table> 
</div><!-- sale-summ div closed -->
	
	<?php endforeach; 
 endforeach;
 endforeach; ?>


<style>
.sale-summ {
    margin-bottom: 5%;
}
</style>	

<script>
	function submitPayment()
	{
			$("#affiPay").submit();				
	}
</script>
		