<?php include('crypto.php'); ?>

<html>
<head>
<title> BISJ Exporters</title>
</head>
<body>
<center>


<?php 

	error_reporting(0);
	
	$merchant_data='';
	$working_key='691360D8E3A8EE7D2A5660237A028BF1';//Shared by CCAVENUES
	$access_code='AVFP73EI38CG87PFGC';//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

