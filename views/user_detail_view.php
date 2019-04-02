<style>
.border{ border:1px solid;padding:10px;}
.well {
    display: inline-flex;
    width: 87%;}
 #PersonalAddress1 {
    margin: 0% 1%;
    }  
#shippingAddress1 {
    margin: 0% 1%;
    }  
</style>
<h4 style="color:#009900;"> Address </h4>
<?php 
 if(!empty($user_account) && $obj->isloggedin) 
    {
		
		  foreach($user_account as $user) // user is an object.
      {
		  
		 ?>
<div class="well">	
	 <form class="form-horizontal" id = "register_form"  action="<?php echo base_url()."UserLogin/user_account_edit/?redirect=".urlencode($obj->redirect); ?>" method = "POST">
	 <p><sup class = "compulsory">*</sup> Required Field	</p>
	 	
	
		
		<div class="control-group">
			<label class="control-label" for="first_name">Name <sup class = "compulsory">*</sup></label>
			<div class="controls">
			<input type="text" id="first_name" name = "firstname" value="<?php  echo $user['firstname']; ?>" placeholder="First Name">
			  <span class = "errormsg"><?php echo form_error('first_name'); ?></span>
			</div>
		 </div>
		 
	<!--	 <div class="control-group">
			<label class="control-label" for="last_name">Last name <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="last_name" name="lastname" value="<?php echo $user["lastname"]; ?>" placeholder="Last Name">
			  <span class = "errormsg"><?php echo form_error('last_name'); ?></span>
			</div>
		 </div>  -->
	
		<div class="control-group">
			<label class="control-label" for="mobile">Mobile Phone <sup class = "compulsory">*</sup></label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">+91</span>
<input type="text"  name="mobile" id="mobile"  value="<?php echo $user["mobile"];?>" placeholder="Mobile Phone"/>
				 </div>
				<span class = "errormsg"><?php echo form_error('mobile'); ?></span>
			</div>
		</div>
			
		<div class="control-group">
			<label class="control-label" for="input_email">Email </label>
			<div class="controls">
			  <input type="text" id="email" value="<?php echo $user["email"];?>" name = "email" placeholder="Email">
			  <span class = "errormsg"><?php echo form_error('email'); ?></span>
			</div>
		  </div>	
		  <div class="control-group">
						<label class="control-label" for="username">Username <sup class = "compulsory">*</sup></label>
						<div class="controls">
				 <input type="text" id="username" name = "userid" value="<?php echo $user["userid"]; ?>" placeholder="Your username" readonly><br>
                 <span>username cannot be changed </span>
						  <span id = "username_status"></span>					   
						  <span class = "errormsg"></span>
						  <br />
				  		
						</div>
					 </div>
<div class="control-group">
			<div class="controls">
				<input class="btn btn-medium btn-success" type="submit" value="UPDATE" />
			</div>
		</div>		
	</form>
</div>
	<?php }  }
	//Address Form 
	
	
 if(!empty($user_address1) && $obj->isloggedin)
    {   foreach($user_address1 as $user) // user is an object.
      {?>
	 
	  <script>
function myFunction() {
    var x = document.getElementById('PersonalAddress');
	 var y = document.getElementById('PersonalAddress1');
	  var m = document.getElementById('shippingAddress1');
	 
    if (x.style.display === 'none' && y.style.display === 'block') {
        x.style.display = 'block';
		y.style.display = 'none';
		m.style.display = 'none';
    } else {
         x.style.display = 'none';
		y.style.display = 'block';
		m.style.display = 'block';
    }
    var cco = $('#bCountry').text();
    $('#countryID').val(cco);
}
function myFunction1() {
    var x = document.getElementById('PersonalAddress1');
	 var y = document.getElementById('shippingAddress');
	  var m = document.getElementById('shippingAddress1');
	 
    if (y.style.display === 'none' && m.style.display === 'block') {
        m.style.display = 'none';
		y.style.display = 'block';
		x.style.display = 'none';
    } else {
         m.style.display = 'block';
		y.style.display = 'none';
		x.style.display = 'block';
    }
    var sco = $('#ship_countr').text();
    $('#shipcountryID').val(sco);
}
function FillBilling(f) {
  if(f.billingtoo.checked == true) {
    f.shippingaddress.value = $('#bAdd').text();
    f.shipping_city.value = $('#bCity').text();
    f.shipping_state.value = $('#bState').text();
    f.shipping_PIN.value = $('#bPin').text();
    f.ship_name.value = $('#bname').text();
    f.ship_mobile.value = $('#bmobile').text();
    f.ship_mail.value = $('#bmail').text();
    f.shipping_country.value = $('#bCountry').text();
    
    //alert('worked');
  }
    if(f.billingtoo.checked == false) {
    f.shippingaddress.value = '';
    f.shipping_city.value = '';
    f.shipping_state.value = '';
    f.shipping_PIN.value = '';
    f.ship_name.value = '';
    f.ship_mobile.value = '';
    f.ship_mail.value = '';
    f.shipping_country.value = '';
  }
}
</script>

		<div class="well">	
		 <div id="PersonalAddress1" style="display:block;">
<span style="font-weight:bold;"> Name </span><span id="bname"><?php echo $user["bname"]; ?></span><br>
<span style="font-weight:bold;"> Address </span><span id="bAdd"><?php echo $user["address"]; ?></span><br>
<span style="font-weight:bold;">City </span> <span id="bCity"><?php echo $user["city"]; ?></span><br>
<span style="font-weight:bold;">State </span><span id="bState"><?php echo $user["state"];?></span><br>
<span style="font-weight:bold;">Country </span><span id="bCountry"><?php echo $user["country"];?></span><br>
<span style="font-weight:bold;">Zip / Postal Code </span><span id="bPin"><?php echo $user["PIN"];?></span><br>
<span style="font-weight:bold;">Phone </span><span id="bmobile"><?php echo $user["bmobile"];?></span><br>
<span style="font-weight:bold;">Email </span><span id="bmail"><?php echo $user["bmail"];?></span><br>
<br><button onclick="myFunction()" style="color:#608408;">Update Address</button></div>
	  
	  <div id="shippingAddress1" style="display:none;"><h4 style="color:#009900;">Shipping address</h4>
	  <span style="font-weight:bold;"> Name </span><span><?php echo $user["ship_name"]; ?></span><br>
	<span style="font-weight:bold;"> Address </span><span><?php echo $user["shippingaddress"]; ?></span><br>
    <span style="font-weight:bold;"> City </span><span><?php echo $user["shipping_city"]; ?></span><br>
    <span style="font-weight:bold;"> State </span><span><?php echo $user["shipping_state"]; ?></span><br>
    <span style="font-weight:bold;"> Country </span><span id="ship_countr"><?php echo $user["shipping_country"]; ?></span><br>
    <span style="font-weight:bold;">Shipping Zip / Postal Code </span><span><?php echo $user["shipping_PIN"];?></span><br>
    <span style="font-weight:bold;"> Phone </span><span><?php echo $user["ship_mobile"]; ?></span><br>
    <span style="font-weight:bold;"> Email </span><span><?php echo $user["ship_mail"]; ?></span><br>
    <br>
    <button onclick="myFunction1()" style="color:#009900;">Update Shipping Address</button></div>
	  
	 <div id="PersonalAddress" style="display:none;"><form class="form-horizontal" id = "register_form" onsubmit = "validateuser(this,event)" action="<?php echo base_url()."UserLogin/user_address_edit/?redirect=".urlencode($obj->redirect); ?>" method = "POST">
	 <p><sup class = "compulsory">*</sup> Required Field	</p>	
		<h4 style="color:#608408;">Your address</h4>
		
		<div class="control-group">
            <label class="control-label" for="bname">Name <sup class="compulsory">*</sup></label>
            <div class="controls">
              <input type="text" id="bname" name = "bname" value="<?php echo $user["bname"]; ?>" placeholder="Enter Name"/> 
              <span class = "errormsg"><?php echo form_error('bname'); ?></span>
            </div>
        	</div>
        		
		<div class="control-group">
			<label class="control-label" for="address">Address <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <textarea name="address" id="address" class = "input-xlarge autogrow" placeholder="Enter Your Address"><?php echo $user["address"]; ?></textarea>
			  <span class = "errormsg"><?php echo form_error('address'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="city">City <sup class="compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="city" name = "city" value="<?php echo $user["city"]; ?>" placeholder="Enter City"/> 
			  <span class = "errormsg"><?php echo form_error('city'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="city">State <sup class="compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="state" name = "state" value="<?php echo $user["state"]; ?>" placeholder="Enter state"/> 
			  <span class = "errormsg"><?php echo form_error('state'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
				<label class="control-label" for="country">Country <sup class="compulsory">*</sup></label>
				<div class="controls">
				  <select name = "country" id="countryID">
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
				</div>
			</div> 


		<div class="control-group">
			<label class="control-label" for="postcode">Zip / Postal Code <sup class="compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="PIN" name = "PIN" value="<?php echo $user["PIN"]; ?>" placeholder="Zip / Postal Code"/> 
			  <span class = "errormsg"><?php echo form_error('PIN'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
            <label class="control-label" for="bmobile">Mobile <sup class="compulsory">*</sup></label>
            <div class="controls">
              <input type="text" id="bmobile" name = "bmobile" value="<?php echo $user["bmobile"]; ?>" placeholder="Enter Mobile Number"/> 
              <span class = "errormsg"><?php echo form_error('bmobile'); ?></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="bmail">Email <sup class="compulsory">*</sup></label>
            <div class="controls">
              <input type="text" id="bmail" name = "bmail" value="<?php echo $user["bmail"]; ?>" placeholder="Enter Email Address"/> 
              <span class = "errormsg"><?php echo form_error('bmail'); ?></span>
            </div>
        </div>
							
	
	<div class="control-group">
			<div class="controls">
				<input class="btn btn-medium btn-success" type="submit" value="Update" />
			</div>
		</div>
	</form>
	</div>
	<?php //shipping form ?>
	 <div id="shippingAddress" style="display:none;"><form class="form-horizontal" id = "register_form" onsubmit = "validateuser(this,event)" action="<?php echo base_url()."UserLogin/user_address_edit/?redirect=".urlencode($obj->redirect); ?>" method = "POST">
	 <p><sup class = "compulsory">*</sup> Required Field	</p>	
		<h4 style="color:#009900;">Your Shipping Address</h4>
		
		<div class="control-group">
            <div class="controls">
              <input name="billingtoo" onclick="FillBilling(this.form)" type="checkbox" id="checkbox" />Same As Billing Address
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="ship_name">Name<sup class="compulsory">*</sup></label>
            <div class="controls">
              <input type="text" id="ship_name" name = "ship_name" value="<?php echo $user["ship_name"]; ?>" placeholder="Enter Name"/> 
              <span class = "errormsg"><?php echo form_error('ship_name'); ?></span>
            </div>
        </div>
        		
		<div class="control-group">
			<label class="control-label" for="address"> Shipping Address <sup class = "compulsory">*</sup></label>
			<div class="controls">
			  <textarea name="shippingaddress" id="address" class = "input-xlarge autogrow" placeholder="Enter Your Address"><?php echo $user["shippingaddress"]; ?></textarea>
			  <span class = "errormsg"><?php echo form_error('address'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="ship-city">City <sup class="compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="ship-city" name = "shipping_city" value="<?php echo $user["shipping_city"]; ?>" placeholder="Enter shipping City"/> 
			  <span class = "errormsg"><?php echo form_error('shipping_city'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="ship-city">State <sup class="compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="ship-state" name = "shipping_state" value="<?php echo $user["shipping_state"]; ?>" placeholder="Enter state"/> 
			  <span class = "errormsg"><?php echo form_error('shipping_state'); ?></span>
			</div>
		</div>

		<div class="control-group">
				<label class="control-label" for="ship-country">Country <sup class="compulsory">*</sup></label>
				<div class="controls">
				  <select name = "shipping_country" id="shipcountryID">
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
				</div>
			</div> 
			
		<div class="control-group">
			<label class="control-label" for="postcode"> Shipping Zip / Postal Code <sup class="compulsory">*</sup></label>
			<div class="controls">
			  <input type="text" id="PIN" name = "shipping_PIN" value="<?php echo $user["shipping_PIN"]; ?>" placeholder="Zip / Postal Code"/> 
			  <span class = "errormsg"><?php echo form_error('PIN'); ?></span>
			</div>
		</div>	
		
		<div class="control-group">
            <label class="control-label" for="ship_mobile">Mobile<sup class="compulsory">*</sup></label>
            <div class="controls">
              <input type="text" id="ship_mobile" name = "ship_mobile" value="<?php echo $user["ship_mobile"]; ?>" placeholder="Enter Mobile Number"/> 
              <span class = "errormsg"><?php echo form_error('ship_mobile'); ?></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_mail">Email<sup class="compulsory">*</sup></label>
            <div class="controls">
              <input type="text" id="ship_mail" name = "ship_mail" value="<?php echo $user["ship_mail"]; ?>" placeholder="Enter Email Address"/> 
              <span class = "errormsg"><?php echo form_error('ship_mail'); ?></span>
            </div>
        </div>
        				
	
	<div class="control-group">
			<div class="controls">
				<input class="btn btn-medium btn-success" type="submit" value="Update" />
			</div>
		</div>
	</form>
	</div>
</div>		
	<?php }}?>
	
	</div></div></div></div></div>