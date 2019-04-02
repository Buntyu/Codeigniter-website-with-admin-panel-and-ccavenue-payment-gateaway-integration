<?php include("securearea.php"); ?>
<?php

session_start();
class StoreRating extends Securearea
{
	
	 //$dat = $this->input->post('country');

   // $this->session->set_userdata('abcd',$dat);


public function getStoreRating()
{
	
$star1 = $this->input->post('star');
$p1 = $this->input->post('product_id');
$review = $this->input->post('rev');
$uid = $this->input->post('id');
$uname = $this->input->post('name');
$udate = $this->input->post('da');


//echo "heelooo";die;

//
if(isset($star1)){  
        $star = htmlentities($star1);
        //valid star id array
        $valid_star = array('1','2','3','4','5');
 
        //show a error message if some hacker (Noobs) try to change the star id
        if(!in_array($star, $valid_star)){
            echo "<b class='r'>Thanks! You rated this product {$star} Stars.</b> Product ID :".$p1;
            exit();
        }
 
        // STORE THE RATING INTO DATABASE
 
        // Display the result
     //   echo "<b class='g'>Thanks! You rated this product {$star} Stars.</b>Product ID: ".$p1;
        echo "<b class='g'>THANKS! For Your Review</b>";
        $data = array(
        'product_id' => $p1,
        'ratings_score' => $star,
        'review_comment' => $review,
        'user_id' => $uid,
        'user_name' => $uname,
        'date' => $udate
                        );
        $this->load->model("starrating_model");
		$wadup = $this->starrating_model->insertStarRating($data);
        //echo $wadup;
    }

}

public function sendaddressdata() {

 $bname = $this->input->post('bname');
 $address = $this->input->post('address');
 $city = $this->input->post('city');
 $state = $this->input->post('state');
 $PIN = $this->input->post('PIN');
 $countryID = $this->input->post('countryID');
 $bmobile = $this->input->post('bmobile');
 $bmail = $this->input->post('bmail');

 $shippingaddress = $this->input->post('shippingaddress');
 $ship_name = $this->input->post('ship_name');
 $shipping_city = $this->input->post('shipping_city');
 $shipping_state = $this->input->post('shipping_state');
 $shipping_PIN = $this->input->post('shipping_PIN');
 $shipping_countryID = $this->input->post('shipping_countryID');
 $ship_mobile = $this->input->post('ship_mobile');
 $ship_mail = $this->input->post('ship_mail');

 
 $adddata = array(
 'bname' => $bname,
 'address' => $address,
 'city' => $city,
 'state' => $state,
 'PIN' => $PIN,
 'country' => $countryID,
 'bmobile' => $bmobile,
 'bmail' => $bmail,

 'shippingaddress' => $shippingaddress,
 'ship_name' => $ship_name,
 'shipping_city' => $shipping_city,
 'shipping_state' => $shipping_state,
 'shipping_PIN' => $shipping_PIN,
 'shipping_country' => $shipping_countryID,
 'ship_mobile' => $ship_mobile,
 'ship_mail' => $ship_mail
 
 ); 
 
//echo($countryID);
  $user_id = $this->session->userdata("id");
  $this->load->model("login_model"); 
  $nope = $this->login_model->EditUserAccount($adddata,$user_id);
 // echo $nope;


}

 
}
?>