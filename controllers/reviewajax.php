<?php include("securearea.php"); ?>
<?php

class Reviewajax extends Securearea 
{
public function index()
{
$this->load->view('testajax_view');
}
public function getAjaxRev(){
$page =  $_GET['page'];
$proId = $_GET['id'];
$this->load->model('product_model');
$countries = $this->product_model->getAjaxReview($page, $proId);
foreach($countries as $country){

echo "<div class='info'><h5> Posted By<span style='color:#F75213; font-weight: bold;'>&nbsp".$country->user_name."</span>&nbspon <span style='font-weight: bold;'>".$country->date."</span></h5></div>";

echo "<div class='rev'>";
echo "<p>".$country->review_comment."</p>";
echo "<div class='rat'>";
for($i=1;$i<=$country->ratings_score;$i++)
     {
     	echo "<span style='font-size:150%;color:gold;'>&starf;</span>";
     } 
 echo "</div>";
  echo "</div>";

}
exit;
}
}

/*
foreach($countries as $country){
echo "<div><div><h5> Posted By<span style='color:#F75213; font-weight: bold;'>&nbsp".$country->user_name."</span>&nbspon <span style='font-weight: bold;'>".$country->date."</span></h5></div><div><p>".$country->review_comment."</p><div>"for($i=1;$i<=$country->ratings_score;$i++){"<i class="fa fa-star ystar" aria-hidden="true"></i>"}"</div></div></div>";
}

<span style='font-size:150%;color:gold;'>&starf;</span>
*/
