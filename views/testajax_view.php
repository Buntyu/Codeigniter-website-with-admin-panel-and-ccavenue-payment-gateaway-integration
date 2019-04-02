<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
</head>
<body>
<div class="container" style="margin-top: 120px;">
<div id="ajax_table">
</div>
<div class="container" style="text-align: center"><button class="btn" id="load_more" data-val = "0">Load more..<img style="display: none" id="loader" src="<?php echo str_replace('index.php','',base_url()) ?>asset/loader.GIF"> </button></div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script>
$(document).ready(function(){
getcountry(0);
$("#load_more").click(function(e){
e.preventDefault();
var page = $(this).data('val');
getcountry(page);
});
});
var getcountry = function(page){
$("#loader").show();
$.ajax({
url:"<?php echo base_url() ?>reviewajax/getCountry",
type:'GET',
data: {page:page}
}).done(function(response){
alert(response);
$("#ajax_table").append(response);
$("#loader").hide();
$('#load_more').data('val', ($('#load_more').data('val')+1));
scroll();
});
};
var scroll  = function(){
$('html, body').animate({
scrollTop: $('#load_more').offset().top
}, 1000);
};
</script>
</body>
</html>

<style>
.rev
{
	background-color: #e8e8e8;
	    padding: 5px 12px;
}
</style>

