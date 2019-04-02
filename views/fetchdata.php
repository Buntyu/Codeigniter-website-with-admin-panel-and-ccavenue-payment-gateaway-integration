<?php 
$valArray = explode('@',$_GET['val']); 
foreach($valArray as $val){
echo $val."<br/>";
}
?>