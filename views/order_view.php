<link href="<?php echo base_url()."theme_back/"; ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
<script src="<?php echo base_url()."theme_back/"; ?>js/jquery-ui-1.8.21.custom.min.js"></script>
<script>
  fbq('track', 'AddPaymentInfo');
</script>
<div id="mainBody">

  <div class="container">
    <div class="row">
       <div class="row-below">
           <div class = "span12" id = "disp-alert"></div>
<ul class="breadcrumb">
    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
    <li class="active">Place Order</li>
    </ul>
  <?php 
     $getStatus = $userdata['refferal_status'];
       
                 if($getStatus == 'eligible')
                 {$refD = $cartData['reffDisc'];
                  $refD2 = $cartData['reffDisc2'];}
                 else
                 {$refD = 0;}
                                      
  $CountryCode = $this->session->userdata('sessiontest');     

  //$ship_amt = $cartData["prod_weight"] * $ship_charges;
  $refstat =  $userdata['refferal_status'];
        if ($refstat == 'eligible') {
          $finalprice = round($cartData["grossprice2"]+$ship_amt2-$cartData["reffDisc2"],2);
        } 
        else {
          $finalprice = round($cartData["grossprice2"]+$ship_amt2,2);
        }
    
       if($CountryCode == "SEL")
       {
       $finalprice2 = "Rs. ".$finalprice;
        $currency = "INR";
        $rfAfterPrice = "Rs. ".round($cartData['totalprice1']-$cartData['reffDisc2'],2);
       }
       elseif($CountryCode == "AUS") 
       {
        $finalprice2 = "AU$ ".$finalprice;
         $currency = "AUD";
         $rfAfterPrice = "AU$ ".round($cartData['totalprice1']-$cartData['reffDisc2'],2);
       }
       elseif($CountryCode == "USA") 
       {
        $finalprice2 = "US$ ".$finalprice;
         $currency = "USD";
         $rfAfterPrice = "US$ ".round($cartData['totalprice1']-$cartData['reffDisc2'],2);
       }
       elseif($CountryCode == "OTHER") 
       {
        $finalprice2 = "US$ ".$finalprice;
         $currency = "USD";
         $rfAfterPrice = "US$ ".round($cartData['totalprice1']-$cartData['reffDisc2'],2);
       }
       elseif($CountryCode == "UK") 
       {
        $finalprice2 = "£ ".$finalprice;
         $currency = "GBP";
         $rfAfterPrice = "£ ".round($cartData['totalprice1']-$cartData['reffDisc2'],2);
       }
       elseif($CountryCode == "EUR") 
       {
        $finalprice2 = "€ ".$finalprice;
         $currency = "EUR";
         $rfAfterPrice = "€ ".round($cartData['totalprice1']-$cartData['reffDisc2'],2);
       }
       elseif($CountryCode == "IND") 
       {
        $finalprice2 = "Rs. ".$finalprice;
        $currency = "INR";
        $rfAfterPrice = "Rs. ".round($cartData['totalprice1']-$cartData['reffDisc2'],2);
       }
?>        
                                  <!--  cart starts here  -->
<div class="span9">
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Product Name</th>
                  <th>Rate</th>
                  <th>Quantity/Update</th>
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
                          <td> <img width="70" src="'.$products['product_image'].'" alt=""/></td>
                          <td><a  href="'.base_url().'product/'.addhyphens($products['product_name']).'">'.$products['product_name'].'&nbsp('.$products['Vname'].')'.'</a></td>
                  <td class = "prod_price">'.$products['product_price'].'</td>
              <!--    <td class = "gst_percent">'.$products['gst_percent'].'%'.'</td>
                  <td class = "gst_amount">'.$gst.'</td>
                  <td class = "cst_amount">'.$gst.'</td>  -->

                          <td>
                  <center>
                  <div class="input-append"><input class="span1 prod_qty" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text" value = "'.$products['quantity'].'" readonly>
                    <button class="btn minusqty" type="button"><i class="icon-minus"></i></button>
                    <button class="btn plusqty" type="button"><i class="icon-plus"></i></button>
                  <!--  <button class="btn btn-info savechg show-tooltip" title = "Save Changes"  data-rel="tooltip" type="button"><i class="icon-ok"></i></button> -->
                          </div>
                    
                  </center>
                  </td> ';
            
            echo    '<td class = "prod_tot_price">'.$products['totalprice'].'</td>
                       <td><button class="btn btn-danger remove_prod show-tooltip" title = "Remove Product"  data-rel="tooltip" type="button"  link = "'.base_url().'checkout/removeItem/'.$products['row_id'].'"><i class="icon-remove icon-white"></i></button> </td>
          

                        </tr>';
          }

        ?>
                
        </tbody>
            </table>
            </div> <!-- first span12 closed -->
            
     <div class="span3">
 <div class="fine-details">
                <p><strong>Price:
                  <span class = "tot_price"> <?php echo $cartData["totalprice"]; ?></span></strong> </p>
                
         <span class="reffdisc-class" style="display:none;"><?php echo $cartData['reffDisc']; ?></span>
        <span class="reffdisc-class2" style="display:none;" ><?php echo $cartData['reffDisc2']; ?></span>
        <span class="grandtotal-class" style="display:none;" ><?php echo $rfAfterPrice; ?></span>

      <p class="reffdisc-div">
                 <?php  if($getStatus == 'eligible' || $affcooid != "")
                 { ?><strong>Refferal Discount: <span class = 'reff_price'><?php echo $cartData['reffDisc']; ?></span></strong> <?php   }  ?></p><hr>
        <p class="grandtotal-div">
                <?php  if($getStatus == 'eligible' || $affcooid != "")
                 { ?><strong>Total Price: <span class = 'grand_price'><?php echo $cartData['grdtotal']; ?></span></strong> <?php   }  ?></p>
         
</div>

    </div><br><br><br>
    
    <?php 
$coo = $this->input->cookie("bisj_queryaff");
$aid = $userdata["aff_id"]; 
//echo $coo;die;

if($aid == ""){
?>
    <div class="span9 affi-in-form">
    <div class="span2"><h5>GOT A REFEERAL CODE?</h5></div>
    <div class="span3 smt"><input type="text" id ="affi-code1" placeholder="Enter Refferal Code"><br><span id = "refferal_status"></span></div>
    
    <div class="span3"><button id ="affi-code" class="btn btn-success">CHECK REFFERAL CODE</button></div> 
    </div><br><br><br>  
    <?php
 }
$india = $india.'&width=200&height=200';
$usa = $usa.'&width=200&height=200';
$uk = $uk.'&width=200&height=200';
$europe = $europe.'&width=200&height=200';
$australia = $australia.'&width=200&height=200';
$rest = $rest.'&width=200&height=200';

$indiaLink = $india.'&width=500&height=500';
$usaLink = $usa.'&width=500&height=500';
$ukLink = $uk.'&width=500&height=500';
$europeLink = $europe.'&width=500&height=500';
$australiaLink = $australia.'&width=500&height=500';
$restLink = $rest.'&width=500&height=500';

$countryName = $userdata['country'];

?>    

 <div style="display:none;">
 <span class="india-url"><?php echo $india; ?></span>
 <span class="usa-url"><?php echo $usa; ?></span>
 <span class="uk-url"><?php echo $uk; ?></span>
 <span class="europe-url"><?php echo $europe; ?></span>
 <span class="australia-url"><?php echo $australia; ?></span>
 <span class="rest-url"><?php echo $rest; ?></span>

<span class="india-link"><?php echo $indiaLink; ?></span>
 <span class="usa-link"><?php echo $usaLink; ?></span>
 <span class="uk-link"><?php echo $ukLink; ?></span>
 <span class="europe-link"><?php echo $europeLink; ?></span>
 <span class="australia-link"><?php echo $australiaLink; ?></span>
 <span class="rest-link"><?php echo $restLink; ?></span>
</div>   

    
     <div class="address-ship-container">
    <div class="span9 maha-container">
    
    <?php if ($obj->isloggedin && $userdata["affiliate_id"] == "" ) { ?>
    <form id = "address_form1"  action="<?php echo base_url(); ?>order/checkout" method = "POST" onsubmit = "validateuser(this,event)"> 
      <?php } else { ?>
    <form id = "address_form1"  action="<?php echo base_url(); ?>order/guest_checkout" method = "POST" onsubmit = "validateuser(this,event)">
  <?php    }  ?>
    <div class="add-container">
<div class="bill-div">

    <h4 class="check-form-heading">Enter Billing Address</h4>  

    <div class="control-group namer">
      
      <div class="controls">
        <label class="control-label" for="bname">Name<sup class="compulsory">*</sup></label>
        <input type="text" id="bname" class="full-input" name = "bname" value="<?php echo $userdata["bname"]; ?>" placeholder="Enter Billing Name"/> 
        <span class = "errormsg"><?php echo form_error('bname'); ?></span>
      </div>

    </div>

    <div class="control-group">
      <label class="control-label" for="address">Address <sup class = "compulsory">*</sup></label>
      <div class="controls">
        <textarea name="address" id="address" class = "input-xlarge autogrow full-input" placeholder="Enter Your Address"><?php echo $userdata["address"]; ?></textarea>
        <span class = "errormsg"><?php echo form_error('address'); ?></span>
      </div>
    </div>

    <div class="disp-inline-form">
      <div class="control-group">
      <div class="controls full-input">
        <label class="control-label" for="city">City <sup class="compulsory">*</sup></label>
        <input type="text" id="city" name = "city" class="full-input1" value="<?php echo $userdata['city']; ?>" placeholder="Enter City"/> 
        <span class = "errormsg"><?php echo form_error('city'); ?></span>
      </div>
      </div>
     
     <div class="control-group">
      <div class="controls full-input">
        <label class="control-label" for="city">State <sup class="compulsory">*</sup></label>
        <input type="text" id="state" class="full-input1" name = "state" value="<?php echo $userdata["state"]; ?>" placeholder="Enter state"/> 
        <span class = "errormsg"><?php echo form_error('state'); ?></span>
      </div>
      </div>

    </div>
    
    <div class="disp-inline-form">
      <div class="control-group">
      <div class="controls full-input">
        <label class="control-label" for="postcode">Zip / Postal Code <sup class="compulsory">*</sup></label>
        <input type="text" id="PIN" class="full-input1" name = "PIN" value="<?php echo $userdata["PIN"]; ?>" placeholder="Zip / Postal Code"/> 
        <span class = "errormsg"><?php echo form_error('PIN'); ?></span>
      </div>
      </div>
        
      <div class="control-group">
      <div class="controls full-input">
          <label class="control-label" for="country">Country <sup class="compulsory">*</sup></label>
          <select name = "country" id="countryID" class="full-input2">
            <option value="">Select Country --</option>
            <option value="Afghanistan">Afghanistan</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="American Samoa">American Samoa</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Anguilla">Anguilla</option>
    <option value="Antartica">Antarctica</option>
    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
    <option value="Aruba">Aruba</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas">Bahamas</option>
    <option value="Bahrain">Bahrain</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Barbados">Barbados</option>
    <option value="Belarus">Belarus</option>
    <option value="Belgium">Belgium</option>
    <option value="Belize">Belize</option>
    <option value="Benin">Benin</option>
    <option value="Bermuda">Bermuda</option>
    <option value="Bhutan">Bhutan</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
    <option value="Botswana">Botswana</option>
    <option value="Bouvet Island">Bouvet Island</option>
    <option value="Brazil">Brazil</option>
    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
    <option value="Brunei Darussalam">Brunei Darussalam</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso">Burkina Faso</option>
    <option value="Burundi">Burundi</option>
    <option value="Cambodia">Cambodia</option>
    <option value="Cameroon">Cameroon</option>
    <option value="Canada">Canada</option>
    <option value="Cape Verde">Cape Verde</option>
    <option value="Cayman Islands">Cayman Islands</option>
    <option value="Central African Republic">Central African Republic</option>
    <option value="Chad">Chad</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Christmas Island">Christmas Island</option>
    <option value="Cocos Islands">Cocos (Keeling) Islands</option>
    <option value="Colombia">Colombia</option>
    <option value="Comoros">Comoros</option>
    <option value="Congo">Congo</option>
    <option value="Congo">Congo, the Democratic Republic of the</option>
    <option value="Cook Islands">Cook Islands</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Cota D'Ivoire">Cote d'Ivoire</option>
    <option value="Croatia">Croatia (Hrvatska)</option>
    <option value="Cuba">Cuba</option>
    <option value="Cyprus">Cyprus</option>
    <option value="Czech Republic">Czech Republic</option>
    <option value="Denmark">Denmark</option>
    <option value="Djibouti">Djibouti</option>
    <option value="Dominica">Dominica</option>
    <option value="Dominican Republic">Dominican Republic</option>
    <option value="East Timor">East Timor</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Egypt">Egypt</option>
    <option value="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea">Eritrea</option>
    <option value="Estonia">Estonia</option>
    <option value="Ethiopia">Ethiopia</option>
    <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
    <option value="Faroe Islands">Faroe Islands</option>
    <option value="Fiji">Fiji</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="France Metropolitan">France, Metropolitan</option>
    <option value="French Guiana">French Guiana</option>
    <option value="French Polynesia">French Polynesia</option>
    <option value="French Southern Territories">French Southern Territories</option>
    <option value="Gabon">Gabon</option>
    <option value="Gambia">Gambia</option>
    <option value="Georgia">Georgia</option>
    <option value="Germany">Germany</option>
    <option value="Ghana">Ghana</option>
    <option value="Gibraltar">Gibraltar</option>
    <option value="Greece">Greece</option>
    <option value="Greenland">Greenland</option>
    <option value="Grenada">Grenada</option>
    <option value="Guadeloupe">Guadeloupe</option>
    <option value="Guam">Guam</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Guinea">Guinea</option>
    <option value="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana">Guyana</option>
    <option value="Haiti">Haiti</option>
    <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
    <option value="Holy See">Holy See (Vatican City State)</option>
    <option value="Honduras">Honduras</option>
    <option value="Hong Kong">Hong Kong</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India" selected>India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Iran">Iran (Islamic Republic of)</option>
    <option value="Iraq">Iraq</option>
    <option value="Ireland">Ireland</option>
    <option value="Israel">Israel</option>
    <option value="Italy">Italy</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Japan">Japan</option>
    <option value="Jordan">Jordan</option>
    <option value="Kazakhstan">Kazakhstan</option>
    <option value="Kenya">Kenya</option>
    <option value="Kiribati">Kiribati</option>
    <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
    <option value="Korea">Korea, Republic of</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Lao">Lao People's Democratic Republic</option>
    <option value="Latvia">Latvia</option>
    <option value="Lebanon">Lebanon</option>
    <option value="Lesotho">Lesotho</option>
    <option value="Liberia">Liberia</option>
    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Macau">Macau</option>
    <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malawi">Malawi</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Maldives">Maldives</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Marshall Islands">Marshall Islands</option>
    <option value="Martinique">Martinique</option>
    <option value="Mauritania">Mauritania</option>
    <option value="Mauritius">Mauritius</option>
    <option value="Mayotte">Mayotte</option>
    <option value="Mexico">Mexico</option>
    <option value="Micronesia">Micronesia, Federated States of</option>
    <option value="Moldova">Moldova, Republic of</option>
    <option value="Monaco">Monaco</option>
    <option value="Mongolia">Mongolia</option>
    <option value="Montserrat">Montserrat</option>
    <option value="Morocco">Morocco</option>
    <option value="Mozambique">Mozambique</option>
    <option value="Myanmar">Myanmar</option>
    <option value="Namibia">Namibia</option>
    <option value="Nauru">Nauru</option>
    <option value="Nepal">Nepal</option>
    <option value="Netherlands">Netherlands</option>
    <option value="Netherlands Antilles">Netherlands Antilles</option>
    <option value="New Caledonia">New Caledonia</option>
    <option value="New Zealand">New Zealand</option>
    <option value="Nicaragua">Nicaragua</option>
    <option value="Niger">Niger</option>
    <option value="Nigeria">Nigeria</option>
    <option value="Niue">Niue</option>
    <option value="Norfolk Island">Norfolk Island</option>
    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Palau">Palau</option>
    <option value="Panama">Panama</option>
    <option value="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Philippines">Philippines</option>
    <option value="Pitcairn">Pitcairn</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Puerto Rico">Puerto Rico</option>
    <option value="Qatar">Qatar</option>
    <option value="Reunion">Reunion</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russian Federation</option>
    <option value="Rwanda">Rwanda</option>
    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
    <option value="Saint LUCIA">Saint LUCIA</option>
    <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
    <option value="Samoa">Samoa</option>
    <option value="San Marino">San Marino</option>
    <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal">Senegal</option>
    <option value="Seychelles">Seychelles</option>
    <option value="Sierra">Sierra Leone</option>
    <option value="Singapore">Singapore</option>
    <option value="Slovakia">Slovakia (Slovak Republic)</option>
    <option value="Slovenia">Slovenia</option>
    <option value="Solomon Islands">Solomon Islands</option>
    <option value="Somalia">Somalia</option>
    <option value="South Africa">South Africa</option>
    <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
    <option value="Span">Spain</option>
    <option value="SriLanka">Sri Lanka</option>
    <option value="St. Helena">St. Helena</option>
    <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
    <option value="Sudan">Sudan</option>
    <option value="Suriname">Suriname</option>
    <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
    <option value="Swaziland">Swaziland</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Syria">Syrian Arab Republic</option>
    <option value="Taiwan">Taiwan, Province of China</option>
    <option value="Tajikistan">Tajikistan</option>
    <option value="Tanzania">Tanzania, United Republic of</option>
    <option value="Thailand">Thailand</option>
    <option value="Togo">Togo</option>
    <option value="Tokelau">Tokelau</option>
    <option value="Tonga">Tonga</option>
    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia">Tunisia</option>
    <option value="Turkey">Turkey</option>
    <option value="Turkmenistan">Turkmenistan</option>
    <option value="Turks and Caicos">Turks and Caicos Islands</option>
    <option value="Tuvalu">Tuvalu</option>
    <option value="Uganda">Uganda</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="United States">United States</option>
    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
    <option value="Uruguay">Uruguay</option>
    <option value="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu">Vanuatu</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Viet Nam</option>
    <option value="Virgin Islands (British)">Virgin Islands (British)</option>
    <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
    <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
    <option value="Western Sahara">Western Sahara</option>
    <option value="Yemen">Yemen</option>
    <option value="Yugoslavia">Yugoslavia</option>
    <option value="Zambia">Zambia</option>
    <option value="Zimbabwe">Zimbabwe</option>          
          </select>         
          <span class = "errormsg"><?php echo form_error('countryID'); ?></span>    
        </div>
        </div>

      </div> 

      <div class="disp-inline-form">
      <div class="control-group">
      <div class="controls full-input">
        <label class="control-label" for="bmobile">Phone Number<sup class="compulsory">*</sup></label>
        <input type="text" id="bmobile" name = "bmobile" class="full-input1" value="<?php echo $userdata["bmobile"]; ?>" placeholder="Enter Phone Number"/> 
        <span class = "errormsg"><?php echo form_error('bmobile'); ?></span>
      </div>
      </div>
     
     <div class="control-group">
      <div class="controls full-input">
        <label class="control-label" for="bmail">Email <sup class="compulsory">*</sup></label>
        <input type="text" id="bmail" name = "bmail" class="full-input1" value="<?php echo $userdata["bmail"]; ?>" placeholder="Enter Email Address"/> 
        <span class = "errormsg"><?php echo form_error('bmail'); ?></span>
      </div>
      </div>

    </div>

    <br><br><br> 
</div>
<div class="ship-div">
    <h4 class="check-form-heading">Shipping Address</h4>

    <div class="control-group">
            <div class="controls" style="text-align:center;">
            <span style="font-size:16px;">Ship to a different address</span>
              <input name="billingtoo" onclick="FillBilling1()" type="checkbox" id="checkbox" />
            </div>
        </div>  
<div id="hidden-shipaddress">
    <div class="control-group">
      
      <div class="controls">
        <label class="control-label" for="ship_name">Name<sup class="compulsory">*</sup></label>
        <input type="text" id="ship_name" name = "ship_name" class="full-input" value="<?php echo $userdata["ship_name"]; ?>" placeholder="Enter Shipping Name"/> 
        <span class = "errormsg"><?php echo form_error('ship_name'); ?></span>
      </div>

    </div>

    <div class="control-group">
      <label class="control-label" for="address">Address <sup class = "compulsory">*</sup></label>
      <div class="controls">
        <textarea name="shippingaddress" id="shippingaddress" class = "input-xlarge autogrow full-input" placeholder="Enter Your Address"><?php echo $userdata["shippingaddress"]; ?></textarea>
        <span class = "errormsg"><?php echo form_error('shippingaddress'); ?></span>
      </div>
    </div>

    <div class="disp-inline-form">
      <div class="control-group">
      <div class="controls full-input">
        <label class="control-label" for="city">City <sup class="compulsory">*</sup></label>
        <input type="text" id="shipping_city" class="full-input1" name = "shipping_city" value="<?php echo $userdata['shipping_city']; ?>" placeholder="Enter City"/> 
        <span class = "errormsg"><?php echo form_error('shipping_city'); ?></span>
      </div>
      </div>
     
     <div class="control-group">
      <div class="controls full-input">
        <label class="control-label" for="city">State <sup class="compulsory">*</sup></label>
        <input type="text" id="shipping_state" class="full-input1" name = "shipping_state" value="<?php echo $userdata["shipping_state"]; ?>" placeholder="Enter state"/> 
        <span class = "errormsg"><?php echo form_error('shipping_state'); ?></span>
      </div>
      </div>

    </div>
    
    <div class="disp-inline-form">
      <div class="control-group">
      <div class="controls full-input">
        <label class="control-label" for="postcode">Zip / Postal Code <sup class="compulsory">*</sup></label>
        <input type="text" id="shipping_PIN" class="full-input1" name = "shipping_PIN" value="<?php echo $userdata["shipping_PIN"]; ?>" placeholder="Zip / Postal Code"/> 
        <span class = "errormsg"><?php echo form_error('shipping_PIN'); ?></span>
      </div>
      </div>
      
      <div class="control-group">
      <div class="controls full-input">
          <label class="control-label" for="country">Country <sup class="compulsory">*</sup></label>
          <select name = "shipping_country" id="shipping_countryID" class="full-input2">
           <option value="">Select Country --</option>
            <option value="Afghanistan">Afghanistan</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="American Samoa">American Samoa</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Anguilla">Anguilla</option>
    <option value="Antartica">Antarctica</option>
    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
    <option value="Aruba">Aruba</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas">Bahamas</option>
    <option value="Bahrain">Bahrain</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Barbados">Barbados</option>
    <option value="Belarus">Belarus</option>
    <option value="Belgium">Belgium</option>
    <option value="Belize">Belize</option>
    <option value="Benin">Benin</option>
    <option value="Bermuda">Bermuda</option>
    <option value="Bhutan">Bhutan</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
    <option value="Botswana">Botswana</option>
    <option value="Bouvet Island">Bouvet Island</option>
    <option value="Brazil">Brazil</option>
    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
    <option value="Brunei Darussalam">Brunei Darussalam</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso">Burkina Faso</option>
    <option value="Burundi">Burundi</option>
    <option value="Cambodia">Cambodia</option>
    <option value="Cameroon">Cameroon</option>
    <option value="Canada">Canada</option>
    <option value="Cape Verde">Cape Verde</option>
    <option value="Cayman Islands">Cayman Islands</option>
    <option value="Central African Republic">Central African Republic</option>
    <option value="Chad">Chad</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Christmas Island">Christmas Island</option>
    <option value="Cocos Islands">Cocos (Keeling) Islands</option>
    <option value="Colombia">Colombia</option>
    <option value="Comoros">Comoros</option>
    <option value="Congo">Congo</option>
    <option value="Congo">Congo, the Democratic Republic of the</option>
    <option value="Cook Islands">Cook Islands</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Cota D'Ivoire">Cote d'Ivoire</option>
    <option value="Croatia">Croatia (Hrvatska)</option>
    <option value="Cuba">Cuba</option>
    <option value="Cyprus">Cyprus</option>
    <option value="Czech Republic">Czech Republic</option>
    <option value="Denmark">Denmark</option>
    <option value="Djibouti">Djibouti</option>
    <option value="Dominica">Dominica</option>
    <option value="Dominican Republic">Dominican Republic</option>
    <option value="East Timor">East Timor</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Egypt">Egypt</option>
    <option value="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea">Eritrea</option>
    <option value="Estonia">Estonia</option>
    <option value="Ethiopia">Ethiopia</option>
    <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
    <option value="Faroe Islands">Faroe Islands</option>
    <option value="Fiji">Fiji</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="France Metropolitan">France, Metropolitan</option>
    <option value="French Guiana">French Guiana</option>
    <option value="French Polynesia">French Polynesia</option>
    <option value="French Southern Territories">French Southern Territories</option>
    <option value="Gabon">Gabon</option>
    <option value="Gambia">Gambia</option>
    <option value="Georgia">Georgia</option>
    <option value="Germany">Germany</option>
    <option value="Ghana">Ghana</option>
    <option value="Gibraltar">Gibraltar</option>
    <option value="Greece">Greece</option>
    <option value="Greenland">Greenland</option>
    <option value="Grenada">Grenada</option>
    <option value="Guadeloupe">Guadeloupe</option>
    <option value="Guam">Guam</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Guinea">Guinea</option>
    <option value="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana">Guyana</option>
    <option value="Haiti">Haiti</option>
    <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
    <option value="Holy See">Holy See (Vatican City State)</option>
    <option value="Honduras">Honduras</option>
    <option value="Hong Kong">Hong Kong</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India" selected>India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Iran">Iran (Islamic Republic of)</option>
    <option value="Iraq">Iraq</option>
    <option value="Ireland">Ireland</option>
    <option value="Israel">Israel</option>
    <option value="Italy">Italy</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Japan">Japan</option>
    <option value="Jordan">Jordan</option>
    <option value="Kazakhstan">Kazakhstan</option>
    <option value="Kenya">Kenya</option>
    <option value="Kiribati">Kiribati</option>
    <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
    <option value="Korea">Korea, Republic of</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Lao">Lao People's Democratic Republic</option>
    <option value="Latvia">Latvia</option>
    <option value="Lebanon">Lebanon</option>
    <option value="Lesotho">Lesotho</option>
    <option value="Liberia">Liberia</option>
    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Macau">Macau</option>
    <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malawi">Malawi</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Maldives">Maldives</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Marshall Islands">Marshall Islands</option>
    <option value="Martinique">Martinique</option>
    <option value="Mauritania">Mauritania</option>
    <option value="Mauritius">Mauritius</option>
    <option value="Mayotte">Mayotte</option>
    <option value="Mexico">Mexico</option>
    <option value="Micronesia">Micronesia, Federated States of</option>
    <option value="Moldova">Moldova, Republic of</option>
    <option value="Monaco">Monaco</option>
    <option value="Mongolia">Mongolia</option>
    <option value="Montserrat">Montserrat</option>
    <option value="Morocco">Morocco</option>
    <option value="Mozambique">Mozambique</option>
    <option value="Myanmar">Myanmar</option>
    <option value="Namibia">Namibia</option>
    <option value="Nauru">Nauru</option>
    <option value="Nepal">Nepal</option>
    <option value="Netherlands">Netherlands</option>
    <option value="Netherlands Antilles">Netherlands Antilles</option>
    <option value="New Caledonia">New Caledonia</option>
    <option value="New Zealand">New Zealand</option>
    <option value="Nicaragua">Nicaragua</option>
    <option value="Niger">Niger</option>
    <option value="Nigeria">Nigeria</option>
    <option value="Niue">Niue</option>
    <option value="Norfolk Island">Norfolk Island</option>
    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Palau">Palau</option>
    <option value="Panama">Panama</option>
    <option value="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Philippines">Philippines</option>
    <option value="Pitcairn">Pitcairn</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Puerto Rico">Puerto Rico</option>
    <option value="Qatar">Qatar</option>
    <option value="Reunion">Reunion</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russian Federation</option>
    <option value="Rwanda">Rwanda</option>
    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
    <option value="Saint LUCIA">Saint LUCIA</option>
    <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
    <option value="Samoa">Samoa</option>
    <option value="San Marino">San Marino</option>
    <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal">Senegal</option>
    <option value="Seychelles">Seychelles</option>
    <option value="Sierra">Sierra Leone</option>
    <option value="Singapore">Singapore</option>
    <option value="Slovakia">Slovakia (Slovak Republic)</option>
    <option value="Slovenia">Slovenia</option>
    <option value="Solomon Islands">Solomon Islands</option>
    <option value="Somalia">Somalia</option>
    <option value="South Africa">South Africa</option>
    <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
    <option value="Span">Spain</option>
    <option value="SriLanka">Sri Lanka</option>
    <option value="St. Helena">St. Helena</option>
    <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
    <option value="Sudan">Sudan</option>
    <option value="Suriname">Suriname</option>
    <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
    <option value="Swaziland">Swaziland</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Syria">Syrian Arab Republic</option>
    <option value="Taiwan">Taiwan, Province of China</option>
    <option value="Tajikistan">Tajikistan</option>
    <option value="Tanzania">Tanzania, United Republic of</option>
    <option value="Thailand">Thailand</option>
    <option value="Togo">Togo</option>
    <option value="Tokelau">Tokelau</option>
    <option value="Tonga">Tonga</option>
    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia">Tunisia</option>
    <option value="Turkey">Turkey</option>
    <option value="Turkmenistan">Turkmenistan</option>
    <option value="Turks and Caicos">Turks and Caicos Islands</option>
    <option value="Tuvalu">Tuvalu</option>
    <option value="Uganda">Uganda</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="United States">United States</option>
    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
    <option value="Uruguay">Uruguay</option>
    <option value="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu">Vanuatu</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Viet Nam</option>
    <option value="Virgin Islands (British)">Virgin Islands (British)</option>
    <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
    <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
    <option value="Western Sahara">Western Sahara</option>
    <option value="Yemen">Yemen</option>
    <option value="Yugoslavia">Yugoslavia</option>
    <option value="Zambia">Zambia</option>
    <option value="Zimbabwe">Zimbabwe</option>          
          </select> 
          <span class = "errormsg"><?php echo form_error('shipping_countryID'); ?></span>        
        </div>
        </div>

      </div> 

      <div class="disp-inline-form">
      <div class="control-group">
      <div class="controls full-input">
        <label class="control-label" for="ship_mobile">Phone Number<sup class="compulsory">*</sup></label>
        <input type="text" id="ship_mobile" class="full-input1" name = "ship_mobile" value="<?php echo $userdata["ship_mobile"]; ?>" placeholder="Enter Phone Number"/> 
        <span class = "errormsg"><?php echo form_error('ship_mobile'); ?></span>
      </div>
      </div>
     
     <div class="control-group">
      <div class="controls full-input">
        <label class="control-label" for="ship_mail">Email <sup class="compulsory">*</sup></label>
        <input type="text" id="ship_mail" class="full-input1" name = "ship_mail" value="<?php echo $userdata["ship_mail"]; ?>" placeholder="Enter Email Address"/> 
        <span class = "errormsg"><?php echo form_error('ship_mail'); ?></span>
      </div>
      </div>

    </div>
  </div>
   </div> 
    <span id="bill-country"><?php echo $userdata["country"]; ?></span>
    <span id="ship-country"><?php echo $userdata["shipping_country"]; ?></span>
    
    <input type="hidden" name="reffdisc2" value="<?php echo $refD2; ?>">
    <input type="hidden" name="reffdisc" value="<?php echo $refD; ?>">
    <input type="hidden" name="currs" value="<?php echo $currency; ?>">
    
    </div> <!-- div class add-container closed -->

<div class="control-group">
      <div class="controls">
        <input class="btn btn-medium btn-success" id="addsubmit" type="submit" value="SUBMIT" />
      </div>
    </div> 
    
</form>

    </div> <!-- maha-container div closed -->  


<div class="add-ship-banner span3 desktop-shipflags"> 


<?php if($countryName == 'India') {
echo "<div id='gallery'><a class='dynamlink' href=".$indiaLink."><img id = 'prod-img' class='dynam' src=".$india."></a></div>";} 
else if($countryName == 'Australia') {
echo "<div id='gallery'><a class='dynamlink' href=".$australiaLink."><img id = 'prod-img' class='dynam' src=".$australia."></a></div>";}
else if($countryName == 'United Kingdom') {
echo "<div id='gallery'><a class='dynamlink' href=".$ukLink."><img id = 'prod-img' class='dynam' src=".$uk."></a></div>";}
else if($countryName == 'United States') {
echo "<div id='gallery'><a class='dynamlink' href=".$usaLink."><img id = 'prod-img' class='dynam' src=".$usa."></a></div>";}

else if($countryName == "Albania" || $countryName == "Andorra" || $countryName == "Armenia" || $countryName == "Austria" || $countryName == "Azerbaijan" || $countryName == "Belarus" || $countryName == "Belgium" || $countryName == "Bosnia and Herzegowina" || $countryName == "Bulgaria" || $countryName == "Croatia" || $countryName == "Cyprus" || $countryName == "Czech Republic" || $countryName == "Denmark" || $countryName == "Estonia" || $countryName == "Finland" || $countryName == "France" || $countryName == "Georgia" || $countryName == "Germany" || $countryName == "Greece" || $countryName == "Hungary" || $countryName == "Iceland" || $countryName == "Ireland" || $countryName == "Italy" || $countryName == "Kazakhstan" || $countryName == "Latvia" || $countryName == "Liechtenstein" || $countryName == "Lithuania" || $countryName == "Luxembourg" || $countryName == "Macedonia" || $countryName == "Malta" || $countryName == "Moldova" || $countryName == "Monaco" || $countryName == "Montenegro" || $countryName == "Netherlands" || $countryName == "Norway" || $countryName == "Poland" || $countryName == "Portugal" || $countryName == "Romania" || $countryName == "Russia" || $countryName == "San Marino" || $countryName == "Slovakia" || $countryName == "Slovenia" || $countryName == "Spain" || $countryName == "Sweden" || $countryName == "Switzerland" || $countryName == "Turkey" || $countryName == "Ukraine" || $countryName == "Holy See") {
echo "<div id='gallery'><a class='dynamlink' href=".$europeLink."><img id = 'prod-img' class='dynam' src=".$europe."></a></div>";}

else if($countryName == '') {
echo "<div id='gallery'><a class='dynamlink' href=".$indiaLink."><img id = 'prod-img' class='dynam' src=".$india."></a></div>";}
else{
echo "<div id='gallery'><a class='dynamlink' href=".$restLink."><img id = 'prod-img' class='dynam' src=".$rest."></a></div>";}

?>
<div id="gallery"><a href="<?php echo $bulk."&width=500&height=500"; ?>"><img id = "prod-img" src="<?php echo $bulk."&width=200&height=200"; ?>"></a></div>
<div id="gallery"><a href="<?php echo $courier."&width=500&height=500"; ?>"><img id = "prod-img" src="<?php echo $courier."&width=200&height=200"; ?>"></a></div>
</div>

  </div> <!-- address-ship-container div closed -->         


  <div id = "product-save">
    <center>
      <div id = "prod-save-text">
        <img src = "<?php echo base_url().'images/preloader.gif'; ?>" />
        <span>Please wait, while we save your changes.</span>
      </div>
    </center>
  </div> 
           
                                     <!-- cart ends here -->
<script>
  $(function() {
    $("#shipping_countryID").change(function() {
        var country = $('option:selected', this).text();
        //alert(country);
        if(country == 'Australia'){
        var src = $('.australia-url').text();
        var href = $('.australia-link').text();
        }
        else if(country == 'India'){
        var src = $('.india-url').text();
        var href = $('.india-link').text();
        }
        else if(country == 'United Kingdom'){
        var src = $('.uk-url').text();
        var href = $('.uk-link').text();
        }
        else if(country == 'United States'){
        var src = $('.usa-url').text();
        var href = $('.usa-link').text();
        }
        else if(country == "Albania" || country == "Andorra" || country == "Armenia" || country == "Austria" || country == "Azerbaijan" || country == "Belarus" || country == "Belgium" || country == "Bosnia and Herzegowina" || country == "Bulgaria" || country == "Croatia" || country == "Cyprus" || country == "Czech Republic" || country == "Denmark" || country == "Estonia" || country == "Finland" || country == "France" || country == "Georgia" || country == "Germany" || country == "Greece" || country == "Hungary" || country == "Iceland" || country == "Ireland" || country == "Italy" || country == "Kazakhstan" || country == "Latvia" || country == "Liechtenstein" || country == "Lithuania" || country == "Luxembourg" || country == "Macedonia" || country == "Malta" || country == "Moldova" || country == "Monaco" || country == "Montenegro" || country == "Netherlands" || country == "Norway" || country == "Poland" || country == "Portugal" || country == "Romania" || country == "Russia" || country == "San Marino" || country == "Slovakia" || country == "Slovenia" || country == "Spain" || country == "Sweden" || country == "Switzerland" || country == "Turkey" || country == "Ukraine" || country == "Holy See"){
        var src = $('.europe-url').text();
        var href = $('.europe-link').text();
        }
        else{
        var src = $('.rest-url').text();
        var href = $('.rest-link').text();
        }
        //alert(src);
        $('.dynam').attr('src',src);
        $('.dynamlink').attr('href',href);
    });
   });
   
   $(function() {
    $("#countryID").change(function() {
      var checkBox2 = document.getElementById("checkbox");     
  if (checkBox2.checked == false){
        var country = $('option:selected', this).text();
        //alert(country);
        if(country == 'Australia'){
        var src = $('.australia-url').text();
        var href = $('.australia-link').text();
        }
        else if(country == 'India'){
        var src = $('.india-url').text();
        var href = $('.india-link').text();
        }
        else if(country == 'United Kingdom'){
        var src = $('.uk-url').text();
        var href = $('.uk-link').text();
        }
        else if(country == 'United States'){
        var src = $('.usa-url').text();
        var href = $('.usa-link').text();
        }
        else if(country == "Albania" || country == "Andorra" || country == "Armenia" || country == "Austria" || country == "Azerbaijan" || country == "Belarus" || country == "Belgium" || country == "Bosnia and Herzegowina" || country == "Bulgaria" || country == "Croatia" || country == "Cyprus" || country == "Czech Republic" || country == "Denmark" || country == "Estonia" || country == "Finland" || country == "France" || country == "Georgia" || country == "Germany" || country == "Greece" || country == "Hungary" || country == "Iceland" || country == "Ireland" || country == "Italy" || country == "Kazakhstan" || country == "Latvia" || country == "Liechtenstein" || country == "Lithuania" || country == "Luxembourg" || country == "Macedonia" || country == "Malta" || country == "Moldova" || country == "Monaco" || country == "Montenegro" || country == "Netherlands" || country == "Norway" || country == "Poland" || country == "Portugal" || country == "Romania" || country == "Russia" || country == "San Marino" || country == "Slovakia" || country == "Slovenia" || country == "Spain" || country == "Sweden" || country == "Switzerland" || country == "Turkey" || country == "Ukraine" || country == "Holy See"){
        var src = $('.europe-url').text();
        var href = $('.europe-link').text();
        }
        else{
        var src = $('.rest-url').text();
        var href = $('.rest-link').text();
        }
        //alert(src);
        $('.dynam').attr('src',src);
        $('.dynamlink').attr('href',href);
      }
    });
   });
   
  </script>
                                            
    <style>
  .ordermsg{display:none;color:red;}
  .reffdisc-div{color:#f99a15;}
  .table.table-bordered * 
  {
    text-align: center;
  }
    #product-save
    {
      position : fixed;
      top : 0px;
      left : 0px;
      width : 100%;
      height : 100%;
      background-color : rgba(121, 121, 121, 0.53);     
      display: none;
      z-index: 100000;
      padding: 20% 0%;
    }
    #prod-save-text
    {
      background-color : white;
      font-weight: bold;
      font-size:14px; 
      width : 30%;
      padding: 20px;
      border-radius: 15px;
      -webkit-box-shadow:0px 2px 18px rgba(70, 73, 87, 1);
      -moz-box-shadow:0px 2px 18px rgba(70, 73, 87, 1);
      box-shadow:0px 2px 18px rgba(70, 73, 87, 1);      
    }
    .shipping_rates
    {
      display:none;
    }
    .my-order 
    {
    margin-top:1%;
    }
    
    @media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

  /* Force table to not be like tables anymore */
  table, thead, tbody, th, td, tr { 
    display: block; 
  }
  
  /* Hide table headers (but not display: none;, for accessibility) */
  thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
  
  tr { border: 1px solid #ccc; }
  
  td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
  }
  
  td:before { 
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%; 
    padding-right: 10px; 
    white-space: nowrap;
  }
  
  /*
  Label the data
  */
  td:nth-of-type(1):before { content: ""; }
  td:nth-of-type(2):before { content: ""; }
  td:nth-of-type(3):before { content: "Rate"; }
 
  td:nth-of-type(4):before { content: "Quantity"; }
  td:nth-of-type(5):before { content: "Total"; }
  
  
}
  </style>
      
    <script>
    /*  $(document).ready
      (
        function()
        {
          displayalertinfo("<strong style = 'font-size : 20px;'>Currently, We support offline orders only.</strong>");
          $('textarea.autogrow').autogrow();
          $(".datepickerele").datepicker({ dateFormat: "dd/mm/yy" });
        }
      );   */
      
      function validateuser(oForm,event)
      {
        oForm = $(oForm);
        $(".compulsory").closest(".control-group").find("input:text,input:checkbox,checkbox,textarea,select").each
        (
          function()
          {     
            if($(this).val() == "")
            {
              displayError(this,$(this).closest(".control-group").find("label").text().replace("*","")+" is compulsory.")       
              event.preventDefault();
              displayalertblock("Fields marked <strong>*</strong> are compulsory.");
            }
            else
            {
              displaySuccess(this);
            }
          }
        );
      }
      function displayError(oEle, msg)
      { 
        oEle = $(oEle);
        oEle.closest(".control-group")
              .removeClass("success")
              .addClass("error")
              .find(".errormsg")
                      .show()
                      .html(msg);
      }
      function displaySuccess(oEle)
      {
        oEle = $(oEle);
        oEle.closest(".control-group")
              .addClass("success")
              .find(".errormsg")
                      .hide()
                      .html("");
      }
    </script>
        
        <script>
        $(document).ready(function()
        {
      
        if(performance.navigation.type == 2){
     location.reload(true); 
  } 
            reffDisc();
            orderdisabled();
            FillBilling1();
         function reffDisc()
         {
            var getdiv = $(".tot_reff_disc").html();
              if(getdiv == 0)
              {
                $(".reff-disc").hide();
              }
         }
         
         function orderdisabled() {
          var bu = $('.shipCoun').html();
          if (bu == '')
          {
          $('.my-order').attr('disabled',true);
          $(".ordermsg").show();
          }
         }
         
         var cco = $('#bill-country').text();
          $('#countryID').val(cco);
          var sco = $('#ship-country').text();
          $('#shipping_countryID').val(sco); 
         });
         
         function FillBilling1() {  
  var checkBox = document.getElementById("checkbox");     
if (checkBox.checked == false){
    $('#hidden-shipaddress').hide();
    var bname = $('#bname').val();$('#ship_name').val(bname);
    var address = $('#address').val();$('#shippingaddress').val(address);
    var city = $('#city').val();$('#shipping_city').val(city);    
    var state = $('#state').val();$('#shipping_state').val(state);
    var PIN = $('#PIN').val();$('#shipping_PIN').val(PIN);
    var bmobile = $('#bmobile').val();$('#ship_mobile').val(bmobile);
    var bmail = $('#bmail').val();$('#ship_mail').val(bmail);
    var countryID = $('#countryID').val();$('#shipping_countryID').val(countryID);
  }
     if(checkBox.checked == true) {
    $('#hidden-shipaddress').fadeIn('slow');
    $('#ship_name').val('');
    $('#shippingaddress').val('');
    $('#shipping_city').val('');   
    $('#shipping_state').val('');
    $('#shipping_PIN').val('');
    $('#ship_mobile').val('');
    $('#ship_mail').val('');
    $('#shipping_countryID').val('');
  } 
}
        </script>
        
<script>
    var g_trParent="";var g_rem_tr
    $(document).ready
    (
        function()
        {
            $(".remove_prod").live
            (
                "click",
                function()
                {
                    var rem_link = $(this).attr("link");
                    g_rem_tr = $(this).closest("tr");
                    $("#product-save").show();
                    $.ajax
                    (
                        {
                            url : rem_link,
                            success:function(data)
                            {
                                try
                                {
                                    var response = JSON.parse(data);
                                }
                                catch(e)
                                {
                                    window.location.href = window.location.href;
                                }
                                if(response.status == "success")
                                {
                                    if(response.productData.length == 0)
                                    {
                                        window.location.href = base_url();
                                    }
                                    g_rem_tr.remove();
                                    $(".tot_price").html(response.totalprice);
                                    $(".tot_gst_price").html(response.totalgst);
                                    $(".tot_disc_price").html(response.totaldiscount);
                                    $(".gross_price").html(response.grossprice);
                                    $(".prodcnt").html(response.productData.length);
                                    $("#product-save").hide();                                  
                                }                               
                            }
                        }
                    );
                }
            );
            // 
            $(".minusqty,.plusqty,.prod_qty").live
            (
                "click keyup",
                function()
                {
                    var oParent = $(this).closest("tr");
                    var qty = oParent.find(".prod_qty").val();
                    if($(this).hasClass("minusqty"))
                    {
                        qty--;
                    }
                    if($(this).hasClass("plusqty"))
                    {
                        qty++;
                    }
                    if(isNaN(qty) || qty <= 0 )qty = 1;
                    oParent.find(".prod_qty").val(qty); 

                }
            );
            $(".plusqty, .minusqty").live
            (
                "click",
                function()
                {
                    g_trParent = $(this).closest("tr"); 
                    $("#product-save").show();
                    var qty = g_trParent.find(".prod_qty").val();
                    if(isNaN(qty))qty = 1;
                    var update_url = base_url()+"cart/updateQuantity/"+g_trParent.attr("prod")+"/"+qty+"/1";
                    $.ajax
                    (
                        {
                            url : update_url,
                            success : function(data)
                            {
                                try
                                {
                                    var response = JSON.parse(data);
                                }
                                catch(e)
                                {
                                    window.location.href = window.location.href;
                                }
                                var row = g_trParent.attr("prod");
                                for (i in response.productData)
                                {
                                    if(row == response.productData[i].row_id)
                                    {
                                        g_trParent.find(".product_price").html(response.productData[i].product_price);
                                        
                                        if(response.productData[i].discount_status == "1")
                                        {
                                            g_trParent.find(".disc_price").html(response.productData[i].discount_price);
                                        }
                                        else
                                        {
                                            g_trParent.find(".disc_price").html("&ndash;");
                                        }
                          

                                        g_trParent.find(".prod_tot_price").html(response.productData[i].totalprice);
                                    }
                                }
                                $(".tot_price").html(response.totalprice);
                                $(".tot_gst_price").html(response.totalgst);
                                $(".tot_disc_price").html(response.totaldiscount);
                                
                                
                                $(".gross_price").html(response.grossprice);
                                $("#product-save").hide();
                            }
                        }
                    );
                }   
            );

$("#affi-code").live
      (
        "click",
        function()
        {
          //alert("working");
          if($('#affi-code1').val() != "")
          {
            $.ajax
            (
              {             
                url : "<?php echo base_url().'register/checkReffCode/';?>"+$('#affi-code1').val(),
                success : function(data)
                {//debugger;
                  try
                  {
                    var response = JSON.parse(data);
                  }
                  catch (exc)
                  {
                    return;
                  }
                  if(response.status == "present")
                  {  
                  //alert(response.data);
                  var affData = response.data;
                  document.cookie = "biaffiliate="+affData;             
                    $("#refferal_status").closest(".smt")
                              .removeClass("success")
                              .addClass("error");
                    $("#refferal_status").html("<span style = 'color :green;'>Refferal Code Successfully Added.</span>");
                    var rfd1 = $('.reffdisc-class').html();
                    $(".reffdisc-div").html("<strong>Refferal Discount:<span class = 'reff_price'> "+rfd1+"</span></strong>");
                    $(".reffdisc-div").animate({color: "#f99a15" });
                    var gtot = $('.grandtotal-class').html();
                    $(".grandtotal-div").html("<strong>Total Price:<span class = 'grand_price'> "+gtot+"</span></strong>");
                  }
                  else
                  {
                    $("#refferal_status").closest(".smt")
                              .removeClass("error")
                              .addClass("success");
                    $("#refferal_status").html("<span style = 'color :red;'>Please Check Your Refferal Code</span>");
                  }
                }
              }
            );  
          }
          else
          {
            $("#refferal_status").html("")
                       .closest(".control-group")
                        .removeClass("success")
                        .removeClass("error");
            
          }                     
        }
      );

$("#bname").live("keyup",function(){ var checkBox2 = document.getElementById("checkbox");     
if (checkBox2.checked == false){var bname = $('#bname').val(); $('#ship_name').val(bname);}})

$("#address").live("keyup",function(){ var checkBox2 = document.getElementById("checkbox");     
if (checkBox2.checked == false){ var address = $('#address').val(); $('#shippingaddress').val(address);}})
$("#city").live("keyup",function(){ var checkBox2 = document.getElementById("checkbox");     
if (checkBox2.checked == false){ var city = $('#city').val(); $('#shipping_city').val(city);}})

$("#state").live("keyup",function(){ var checkBox2 = document.getElementById("checkbox");     
if (checkBox2.checked == false){ var state = $('#city').val(); $('#shipping_state').val(state);}})

$("#PIN").live("keyup",function(){ var checkBox2 = document.getElementById("checkbox");     
if (checkBox2.checked == false){var PIN = $('#PIN').val(); $('#shipping_PIN').val(PIN);}})

$("#bmobile").live("keyup",function(){ var checkBox2 = document.getElementById("checkbox");     
if (checkBox2.checked == false){ var bmobile = $('#bmobile').val(); $('#ship_mobile').val(bmobile);}})

$("#bmail").live("keyup",function(){ var checkBox2 = document.getElementById("checkbox");     
if (checkBox2.checked == false){ var bmail = $('#bmail').val(); $('#ship_mail').val(bmail);}})

$("#countryID").on("change",function(){ var checkBox2 = document.getElementById("checkbox");     
if (checkBox2.checked == false){ var countryID = $('#countryID').val(); $('#shipping_countryID').val(countryID);}})


        }
    );
</script>
  </div>
    </div>  
    </div></div>
    
<script type="text/javascript">
    $("#pform").submit(function(e) {
        e.preventDefault();
  var name = document.getElementById('pname').value;
  if(name == ""){
     document.getElementById('errorMsgDiv1').style.display = 'block';
    return false;
  }
  var email = document.getElementById('pemail').value;
  if(email == ""){
     document.getElementById('errorMsgDiv2').style.display = 'block';
    return false;
  }
  var location = document.getElementById('ploc').value;
  var contact = document.getElementById('pcon').value;
  
  $.ajax({
  url: '<?php echo base_url().'fetchdata/getPopupData' ?>',
  data: {name:name,email:email,location:location,contact:contact},
  type:'post',
  success:function(result){
    //alert(result);
    $("#mypopModal").hide();
    $("#mypopModal2").show();
  },
  error:function(){
    console.log("AJAX request was a failure");
  }
  });
  
});

var modal = document.getElementById('mypopModal');
var modal2 = document.getElementById('mypopModal2');
var span = document.getElementsByClassName("close-link")[0];
var span2 = document.getElementsByClassName("mypop-close2")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { modal.style.display = "none";}
span2.onclick = function() { modal2.style.display = "none";}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal2) { modal2.style.display = "none";}
} 

/* window.onload = function checkDevice(){    
  modal2.style.display = "none";
  setTimeout(function showIt2() {
  document.getElementById("mypopModal").style.display = "block";
}, 20000); // after 20 secs

$(document).on('mouseleave', leaveFromTop);
function leaveFromTop(e){
    if( e.clientY < 0 ){ 
     var px = getCookie('popcookie');
     if (px) {}
    else{
  modal.style.display = "block";
  modal2.style.display = "none";
    setCookie('popcookie','testcookie',1);

} } } 
};    */
</script>       
  