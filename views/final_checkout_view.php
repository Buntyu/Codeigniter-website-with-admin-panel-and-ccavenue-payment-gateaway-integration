<div id="mainBody">
<div class = "span12" id = "disp-alert"></div>

  <div class="container">
    <div class="row">
       <div class="row-below">
<ul class="breadcrumb">
    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
    <li class="active">Place Order</li>
    </ul>
    <div class="place-order-top">
    <div class="span3 order-revtext">ORDER REVIEW</div>
    <dic class="span9 order-revbanner"><a href='<?php echo base_url(); ?>International_shipping_charges'><img src="<?php echo base_url(); ?>images/Purchase-Protection.jpg"></a></div>

    </div>
    <hr class="soft"/>
             
    
                            <!-- SHIPPING CALCULATOR -->

<?php
          // print_r($shipdata);die;
          //echo $aud.'<br>'.$usd.'<br>'.$gbp.'<br>'.$euro.'<br>'.$other;
			
        $CountryCode = $this->session->userdata('sessiontest');
       
        echo '<input type="hidden" name="product_weight" value="'.$cartData["prod_weight"].'">';
        echo '<input type="hidden" name="total_prod" value="'.$cartData['productCount'].'">';

        $grand_total =  $cartData["grossprice2"] + $ship_amt;


        $ship_prod = $cartData['productCount'];
        
        $tot_weight = $cartData["prod_weight"];
        
        
        $shipCoun = $userdata['shipping_country'];
        echo '<span class="shipCoun">'.$shipCoun.'</span>';
        //echo $shipCoun;
        
         $coo = $this->input->cookie("bisj_queryaff");
       $getStatus = $userdata['refferal_status']; 
             
                 if($getStatus == 'eligible' || $affcooid != "")
                 {
                    $refD = $cartData['reffDisc'];
                    $refD2 = $cartData['reffDisc2'];
                    //echo $refD2;
                 }
                 else
                 {
                    $refD = 0;
                 }
                 
                 $prizze = $cartData['totalprice1'] - $refD2;

        if($shipCoun == "Australia")
        {  
            if ($prizze >= $shipdata_aus[0]['freeship'] ){
                $ship_charges = 0;
            } else {
            if($ship_prod == 1)
            {
                $ship_charges = $shipdata_aus[0]['upto1']*$ship_prod;
            }
            else if($ship_prod == 2 )
            {
                $ship_charges = $shipdata_aus[0]['upto2']*$ship_prod;
            }
            else if($ship_prod == 3 )
            {
                $ship_charges = $shipdata_aus[0]['upto3']*$ship_prod;
            }
            else
            {
                $ship_charges = $shipdata_aus[0]['above3']*$ship_prod;
            }
            }
            
            if( $CountryCode == 'IND' || $CountryCode == 'SEL')
            {
             $ship_amt2 = round($ship_charges*$aud,2);
             $ship_amt = "Rs. ".$ship_amt2;
            }
            elseif( $CountryCode == 'AUS')
            {
             $ship_amt2 = round($ship_charges,2);
             $ship_amt = "AU$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'USA')
            {
             $ship_amt2 = round($aud/$usd*$ship_charges,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'UK')
            {
             $ship_amt2 = round($aud/$gbp*$ship_charges,2);
             $ship_amt = "£ ".$ship_amt2;
            }
            elseif( $CountryCode == 'EUR')
            {
             $ship_amt2 = round($aud/$euro*$ship_charges,2);
             $ship_amt = "€ ".$ship_amt2;
            }
            elseif( $CountryCode == 'OTHER')
            {
             $ship_amt2 = round($aud/$other*$ship_charges,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
            

        }

        else if($shipCoun == "United States")
        {
            if ($prizze >= $shipdata_usa[0]['freeship'] ){
                $ship_charges = 0;
            } else {
            if($ship_prod == 1)
            {
                $ship_charges = $shipdata_usa[0]['upto1']*$ship_prod;
            }
            else if($ship_prod == 2 )
            {
                $ship_charges = $shipdata_usa[0]['upto2']*$ship_prod;
            }
            else if($ship_prod == 3 )
            {
                $ship_charges = $shipdata_usa[0]['upto3']*$ship_prod;
            }
            else
            {
                $ship_charges = $shipdata_usa[0]['above3']*$ship_prod;
            }
            }
            
             if( $CountryCode == 'IND' || $CountryCode == 'SEL')
            {
             $ship_amt2 = round($ship_charges*$usd,2);
             $ship_amt = "Rs. ".$ship_amt2;
            }
            elseif( $CountryCode == 'USA')
            {
             $ship_amt2 = round($ship_charges,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'AUS')
            {
             $ship_amt2 = round($usd/$aud*$ship_charges,2);
             $ship_amt = "AU$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'UK')
            {
             $ship_amt2 = round($usd/$gbp*$ship_charges,2);
             $ship_amt = "£ ".$ship_amt2;
            }
            elseif( $CountryCode == 'EUR')
            {
             $ship_amt2 = round($usd/$euro*$ship_charges,2);
             $ship_amt = "€ ".$ship_amt2;
            }
            elseif( $CountryCode == 'OTHER')
            {
             $ship_amt2 = round($usd/$other*$ship_charges,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
            

        }

        else if($shipCoun == "United Kingdom")
        {
            if ($prizze >= $shipdata_uk[0]['freeship'] ){
                $ship_charges = 0;
            } else {
            if($ship_prod == 1)
            {
                $ship_charges = $shipdata_uk[0]['upto1']*$ship_prod;
            }
            else if($ship_prod == 2 )
            {
                $ship_charges = $shipdata_uk[0]['upto2']*$ship_prod;
            }
            else if($ship_prod == 3 )
            {
                $ship_charges = $shipdata_uk[0]['upto3']*$ship_prod;
            }
            else
            {
                $ship_charges = $shipdata_uk[0]['above3']*$ship_prod;
            }
            }
             
             if( $CountryCode == 'IND' || $CountryCode == 'SEL')
            {
             $ship_amt2 = round($ship_charges*$gbp,2);
             $ship_amt = "Rs. ".$ship_amt2;
            }
            elseif( $CountryCode == 'UK')
            {
             $ship_amt2 = round($ship_charges,2);
             $ship_amt = "£ ".$ship_amt2;
            }
            elseif( $CountryCode == 'USA')
            {
             $ship_amt2 = round($gbp/$usd*$ship_charges,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'AUS')
            {
             $ship_amt2 = round($gbp/$aud*$ship_charges,2);
             $ship_amt = "AU$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'EUR')
            {
             $ship_amt2 = round($gbp/$euro*$ship_charges,2);
             $ship_amt = "€ ".$ship_amt2;
            }
            elseif( $CountryCode == 'OTHER')
            {
             $ship_amt2 = round($gbp/$other*$ship_charges,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
            

        }

        else if($shipCoun == "Albania" || $shipCoun == "Andorra" || $shipCoun == "Armenia" || $shipCoun == "Austria" || $shipCoun == "Azerbaijan" || $shipCoun == "Belarus" || $shipCoun == "Belgium" || $shipCoun == "Bosnia and Herzegowina" || $shipCoun == "Bulgaria" || $shipCoun == "Croatia" || $shipCoun == "Cyprus" || $shipCoun == "Czech Republic" || $shipCoun == "Denmark" || $shipCoun == "Estonia" || $shipCoun == "Finland" || $shipCoun == "France" || $shipCoun == "Georgia" || $shipCoun == "Germany" || $shipCoun == "Greece" || $shipCoun == "Hungary" || $shipCoun == "Iceland" || $shipCoun == "Ireland" || $shipCoun == "Italy" || $shipCoun == "Kazakhstan" || $shipCoun == "Latvia" || $shipCoun == "Liechtenstein" || $shipCoun == "Lithuania" || $shipCoun == "Luxembourg" || $shipCoun == "Macedonia" || $shipCoun == "Malta" || $shipCoun == "Moldova" || $shipCoun == "Monaco" || $shipCoun == "Montenegro" || $shipCoun == "Netherlands" || $shipCoun == "Norway" || $shipCoun == "Poland" || $shipCoun == "Portugal" || $shipCoun == "Romania" || $shipCoun == "Russia" || $shipCoun == "San Marino" || $shipCoun == "Slovakia" || $shipCoun == "Slovenia" || $shipCoun == "Spain" || $shipCoun == "Sweden" || $shipCoun == "Switzerland" || $shipCoun == "Turkey" || $shipCoun == "Ukraine" || $shipCoun == "Holy See")
        {
            if ($prizze >= $shipdata_eur[0]['freeship'] ){
                $ship_charges = 0;
            } else {
            if($ship_prod == 1)
            {
                $ship_charges = $shipdata_eur[0]['upto1']*$ship_prod;
            }
            else if($ship_prod == 2 )
            {
                $ship_charges = $shipdata_eur[0]['upto2']*$ship_prod;
            }
            else if($ship_prod == 3 )
            {
                $ship_charges = $shipdata_eur[0]['upto3']*$ship_prod;
            }
            else
            {
                $ship_charges = $shipdata_eur[0]['above3']*$ship_prod;
            }
            }
             
             if( $CountryCode == 'IND' || $CountryCode == 'SEL')
            {
             $ship_amt2 = round($ship_charges*$euro,2);
             $ship_amt = "Rs. ".$ship_amt2;
            }
            elseif( $CountryCode == 'EUR')
            {
             $ship_amt2 = round($ship_charges,2);
             $ship_amt = "€ ".$ship_amt2;
            }
            elseif( $CountryCode == 'USA')
            {
             $ship_amt2 = round($euro/$usd*$ship_charges,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'AUS')
            {
             $ship_amt2 = round($euro/$aud*$ship_charges,2);
             $ship_amt = "AU$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'UK')
            {
             $ship_amt2 = round($euro/$gbp*$ship_charges,2);
             $ship_amt = "£ ".$ship_amt2;
            }
            elseif( $CountryCode == 'OTHER')
            {
             $ship_amt2 = round($euro/$other*$ship_charges,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
            

        }

        else if($shipCoun == "India")
        {
            if ($prizze >= $shipdata_india[0]['freeship'] ){
                $ship_charges = 0;
            } else {
            if($ship_prod == 1)
            {
                $ship_charges = $shipdata_india[0]['upto1']*$ship_prod;
            }
            else if($ship_prod == 2 )
            {
                $ship_charges = $shipdata_india[0]['upto2']*$ship_prod;
            }
            else if($ship_prod == 3 )
            {
                $ship_charges = $shipdata_india[0]['upto3']*$ship_prod;
            }
            else
            {
                $ship_charges = $shipdata_india[0]['above3']*$ship_prod;
            }
            }
            
            if( $CountryCode == 'IND' || $CountryCode == 'SEL')
            {
             $ship_amt2 = $ship_charges;
             $ship_amt = "Rs. ".$ship_amt2;
            }
            elseif( $CountryCode == 'EUR')
            {
             $ship_amt2 = round($ship_charges/$euro,2);
             $ship_amt = "€ ".$ship_amt2;
            }
            elseif( $CountryCode == 'USA')
            {
             $ship_amt2 = round($ship_charges/$usd,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'AUS')
            {
             $ship_amt2 = round($ship_charges/$aud,2);
             $ship_amt = "AU$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'UK')
            {
             $ship_amt2 = round($ship_charges/$gbp,2);
             $ship_amt = "£ ".$ship_amt2;
            }
            elseif( $CountryCode == 'OTHER')
            {
             $ship_amt2 = round($ship_charges/$other,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
        }
     
        else if($shipCoun == "")
        {   
      
            $ship_charges = 0;
            $ship_amt = "-";
            $ship_amt2 = $ship_charges;          
        }
        
        else
        {
            if ($prizze >= $shipdata_other[0]['freeship'] ){
                $ship_charges = 0;
            } else {
            if($ship_prod == 1)
            {
                $ship_charges = $shipdata_other[0]['upto1']*$ship_prod;
            }
            else if($ship_prod == 2 )
            {
                $ship_charges = $shipdata_other[0]['upto2']*$ship_prod;
            }
            else if($ship_prod == 3)
            {
                $ship_charges = $shipdata_other[0]['upto3']*$ship_prod;
            }
            else
            {
                $ship_charges = $shipdata_other[0]['above3']*$ship_prod;
            }
            }
            
             if( $CountryCode == 'IND' || $CountryCode == 'SEL')
            {
             $ship_amt2 = round($ship_charges*$other,2);
             $ship_amt = "Rs. ".$ship_amt2;
            }
            elseif( $CountryCode == 'OTHER')
            {
             $ship_amt2 = round($ship_charges,2);
             $ship_amt = "US$".$ship_amt2;
            }
            elseif( $CountryCode == 'USA')
            {
             $ship_amt2 = round($other/$usd*$ship_charges,2);
             $ship_amt = "US$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'AUS')
            {
             $ship_amt2 = round($other/$aud*$ship_charges,2);
             $ship_amt = "AU$ ".$ship_amt2;
            }
            elseif( $CountryCode == 'UK')
            {
             $ship_amt2 = round($other/$gbp*$ship_charges,2);
             $ship_amt = "£ ".$ship_amt2;
            }
            elseif( $CountryCode == 'EUR')
            {
             $ship_amt2 = round($other/$euro*$ship_charges,2);
             $ship_amt = "€ ".$ship_amt2;
            }
            

        }
        
        
        $p_price = $cartData["totalprice1"];
        
        $mega_tot = $p_price + $ship_amt2 - $refD2;
        $mega_total = round($mega_tot,2);
        
        
        if($curr == "INR")
       {
       $mega_total2 = "Rs. ".$mega_total;
       }
       elseif($curr == "AUD") 
       {
        $mega_total2 = "AU$ ".$mega_total;
       }
       elseif($curr == "USD") 
       {
        $mega_total2 = "US$ ".$mega_total;
       }
       elseif($curr == "GBP") 
       {
        $mega_total2 = "£ ".$mega_total;
       }
       elseif($curr == "EUR") 
       {
        $mega_total2 = "€ ".$mega_total;
       }
       else
       {
        $mega_total2 = "Rs. ".$mega_total;
       }  
       
      
        
       ?>    
<div class="span9 place-order-container">     
    <table class="table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Product Name</th>
                  <th>Rate</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    foreach($cartData["productData"] as $products)
                    {
                        $gst = $products['gst_amount'];
                        $price = $products['totalprice']+$gst;
                         $CountryCode = $this->session->userdata('sessiontest');
                        
                        echo ' <tr prod = "'.$products["row_id"].'" style = "position:relative;">
                                  <td> <img width="60" src="'.$products['product_image'].'" alt=""/></td>
                                  <td>'.$products['product_name'].'&nbsp('.$products['Vname'].')'.'</td>
                                  <td class = "prod_price">'.$products['product_price'].'</td>
                    
                                  <td><center>'.$products['quantity'].'</center></td> ';
                        
                        echo      '<td class = "prod_tot_price">'.$products['totalprice'].'</td>
                                           

                                </tr>';   
                    }

                ?>

                </tbody>
            </table>
           <div class="address-fndiv span5">
<div id="PersonalAddress1" class="addfn"><h5>Billing Address</h5>
<span id="bname"><?php echo $userdata["bname"]; ?></span>,
<span id="bAdd"><?php echo $userdata["address"]; ?></span>,
<span id="bCity"><?php echo $userdata["city"]; ?></span>,
<span id="bState"><?php echo $userdata["state"];?></span>,
<span id="bPin"><?php echo $userdata["PIN"];?></span>,
<span id="bCountry"><?php echo $userdata["country"];?></span><br>
</div>
      
    <div id="shippingAddress1" class="addfn"><h5>Shipping address</h5>
    <span><?php echo $userdata["ship_name"]; ?></span>,
    <span><?php echo $userdata["shippingaddress"]; ?></span>,
    <span><?php echo $userdata["shipping_city"]; ?></span>,
    <span><?php echo $userdata["shipping_state"]; ?></span>,
    <span><?php echo $userdata["shipping_PIN"];?></span>,
    <span id="ship_countr"><?php echo $userdata["shipping_country"]; ?></span><br>
</div>
</div> <!-- address fn div closed -->

<div class="total-fndiv span3">
<div class="final-btmdata">
                <span>Total Price : <?php echo $cartData['totalprice']; ?></span><br>
                <span>Refferal Discount : <?php echo $refD; ?></span><br>
                <span>Shipping Charges : <?php echo $ship_amt; ?></span><br>
                <span>TOTAL: <?php echo $mega_total2; ?></span><br>
            </div> 
</div> 

<div class="place-order-fnbtn span9">
            <form class="form-horizontal" action = "<?php echo base_url()."order/ccForm" ?>" method = "POST" onsubmit = "validateuser(this,event)">
                
            <!--     <div class="pay-typediv">   
                <h4 class="paytype-heading">Choose Payment Method</h4>
               <div class="paytype-radio">
                <?php if($shipCoun == 'India'){ ?>    
                <h5><input type="radio" name="pmethod" value="cod" checked> Cash on Delivery</h5>
                 <?php } ?>
                <h5><input type="radio" name="pmethod" value="avenue"> Continue with CcAvenue</h5>
                </div>  
                </div>  -->
            
      <?php
      $userAffid = $userdata['aff_id'];
      
      if($userAffid == "" && $coo != "")
      {
        $affID = "47";
      }else if($affcooid != "")
      {
        $affID = $affcooid;
      }else{
        $affID = $userAffid;
      }
      if(!$obj->isloggedin){
          $guest = "Yes";
          $cusID = "G".$userdata['id'];
      }else {
          $guest = "No";
          $cusID = $userdata['id'];
      }
      $orderUID = random_string('numeric','8');
        echo '<input type="hidden" name="customer_id" value="'.$cusID.'">';
        echo '<input type="hidden" name="affiliate_id" value="'.$affID.'">';
        echo '<input type="hidden" name="order_amount" value="'.$mega_total.'">';
        echo '<input type="hidden" name="order_UID" value="'.$orderUID.'">';
              echo '<input type="hidden" name="customer_name" value="'.$userdata["bname"].'">';
              echo '<input type="hidden" name="customer_pin" value="'.$userdata["PIN"].'">';
              echo '<input type="hidden" name="customer_address" value="'.$userdata["address"].'">';
              echo '<input type="hidden" name="customer_city" value="'.$userdata["city"].'">';
              echo '<input type="hidden" name="customer_email" value="'.$userdata["bmail"].'">';
              echo '<input type="hidden" name="customer_mobile" value="'.$userdata["bmobile"].'">';
              echo '<input type="hidden" name="customer_state" value="'.$userdata["state"].'">';
              echo '<input type="hidden" name="customer_country" value="'.$userdata["country"].'">';
              
              echo '<input type="hidden" name="shipping_name" value="'.$userdata["ship_name"].'">';
              echo '<input type="hidden" name="shipping_pin" value="'.$userdata["shipping_PIN"].'">';
              echo '<input type="hidden" name="shipping_address" value="'.$userdata["shippingaddress"].'">';
              echo '<input type="hidden" name="shipping_city" value="'.$userdata["shipping_city"].'">';
              echo '<input type="hidden" name="shipping_mobile" value="'.$userdata["ship_mobile"].'">';
              echo '<input type="hidden" name="shipping_state" value="'.$userdata["shipping_state"].'">';
              echo '<input type="hidden" name="shipping_country" value="'.$userdata["shipping_country"].'">';
              
              echo '<input type="hidden" name="currency" value="'.$curr.'">';
              echo '<input type="hidden" name="sale_price" value="'.$cartData["totalprice1"].'">';
              //echo '<input type="text" name="total_tax" value="'.$cartData["totalgst2"].'">';
              echo '<input type="hidden" name="reff_discount" value="'.$refD2.'">';
              echo '<input type="hidden" name="total_shipping" value="'.$ship_amt2.'">';
              echo '<input type="hidden" name="total_price" value="'.$mega_total.'">';
              echo '<input type="hidden" name="order_status" value="PENDING">';
              echo '<input type="hidden" name="is_guest" value="'.$guest.'">';
               
      
      ?>
   <!--   <center>
          <?php if($shipCoun == 'India'){ 
          if ($ship_amt2 == ''){ ?>
       <input type = "submit" name="cod" class = "btn btn-medium btn-success my-order" value = "Cash on Delivery (COD)" disabled/> 
       <?php } else { ?>
       <input type = "submit" name="cod" class = "btn btn-medium btn-success my-order" value = "Cash on Delivery (COD)" /> 
       <?php  } } if($ship_amt2 == '') { ?>
       <input type = "submit" name="ccavenue" class = "btn btn-medium btn-success my-order" value = "Pay by Credit/Debit Card/Net Banking" disabled/> 
       <?php } else { ?>
        <input type = "submit" name="ccavenue" class = "btn btn-medium btn-success my-order" value = "Pay by Credit/Debit Card/Net Banking"/> 
       <?php } ?>
      </center> -->
      
      <center>
   <!--       <?php if($shipCoun == 'India'){ ?>
       <input type = "submit" name="cod" class = "btn btn-medium btn-success my-order" value = "Cash on Delivery (COD)" /> 
       <?php } ?> -->
        <input type = "submit" name="ccavenue" class = "btn btn-medium btn-success my-order" value = "Pay by Credit/Debit Card/Net Banking"/> 
       
      </center>
    </form>
</div> <!-- place-order-fnbtn cloased -->
    
             </div> <!-- first span9 closed -->

 <div class="span3 related-fnproducts">
          <h4 style="text-align: center;">Need Help?</h4>
          <h5 style="text-align: center;">Read our <a href="<?php echo base_url();?>faq" target="_blank">FAQs</a> or contact us :</h5><hr>
      <div class="contact-fn">
        <p>Email: info@bisjexporters.com</p>
        <p>Contact No: +91 7009272362, +91 7011993301</p>

      </div> 
      </div>  
      
</div>
    </div>  
    </div></div>
    
<style>
#bt-it, .sel-country {display: none;}
</style>  

