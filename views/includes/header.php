<?php
	$theme_url = base_url()."theme/";
	//echo "<pre>";print_r($this->cart->contents());
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<?php 
		if(!isset($title))
		{
			$title = "BISJ Exporters | Organic Bamboo Charcoal Products | Tea, Face pack, Hair care, Dental Care";
		}
		//echo '<title>BISJ Exporters | Organic Bamboo Charcoal Products | Tea, Face pack, Hair care, Dental Care</title>';
		echo '<title>'.$title.'</title>';
		
		if(!isset($description))
		{
			$description = "Buy Organic Bamboo Tea, Face pack, Hair care, Dental Care. BISJ Exporters One of the world’s Best BAMBOO activated carbon and bamboo tea manufacturing company";
		}
		//echo '<title>BISJ Exporters | Organic Bamboo Charcoal Products | Tea, Face pack, Hair care, Dental Care</title>';
	//	echo '<title>'.$description.'</title>';
		
	?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="author" content="BISJ Exporters">
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="keywords" content="bisj,bamboo,charcoal, <?php echo $title; ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">		
		<meta name="google-site-verification" content="8vipZNgvZjk5s8icAaeuzlEMsmyZkHoReDNz08ZvuAk" />
	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="<?php echo $theme_url; ?>themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="<?php echo $theme_url; ?>themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="<?php echo $theme_url; ?>themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="<?php echo $theme_url; ?>themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="<?php echo $theme_url; ?>themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url()."images/favicon.ico"; ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url()."images/favicon.png"; ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url()."images/favicon.png"; ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url()."images/favicon.png"; ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url()."images/favicon.png"; ?>">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="//fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
	<!--
	<link href="<?php echo base_url(); ?>theme_back/css/opa-icons.css?allowall=allow" rel="stylesheet">-->
	<style type="text/css" id="enject"></style>
	<script src="<?php echo $theme_url; ?>themes/js/jquery.js?allowall=allow" type="text/javascript"></script>
	<link href="<?php echo base_url(); ?>css/mystyles.css?allowall=allow" rel="stylesheet" type="text/css">
	
	<link rel="preload" href="mysprite.png" as="image">

	<script> var base_url = "<?php echo base_url(); ?>"; </script>
	
	<script type="text/javascript">
	$(window).load(function() {
    	$(".feecaraousel").fadeIn();
	});
	</script> 			

<script type="text/javascript">
$(document).ready(function() {
        if ( ! sessionStorage.getItem( 'doNotShow276' ) ) {
            sessionStorage.setItem( 'doNotShow276', true );
           //alert('yupp');
            Preloader();
        }
});
function Preloader() {
          //alert('gpp');
            //var preloader = $ ('.bisj-loader');
            $('.bisj-loader').css('display','block');
           // preloader.delay(1000) .fadeOut (3000);
           $('.bisj-loader').delay(2000).fadeOut(1000);
        }
</script>

<script>
function base_url()
{
	return "<?php echo base_url(); ?>";
}
$(document).ready(function()
	{ 
		<?php
			$alert = $this->session->flashdata("alert"); 						
			if(!empty($alert))
			{	
				$alert = (array)json_decode($alert);				
				echo 'displayalert'.$alert["type"].'("'.$alert["msg"].'");';
			}
			?>					
		
		$("#areas_covered_bar").bind("click",function() 
		{
			if($("#areas_covered").is(":visible"))
			{
				$("#areas_covered").hide("slow");
			}
			else
			{
				$("#areas_covered").show("slow");
			}			
		})
		$("#areas_covered").hide("slow");
	});

var g_product_names = new Array();
<?php 
	echo "g_product_names = '".addslashes(json_encode($obj->productsList))."';g_product_names = JSON.parse(g_product_names);";
?>
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113210241-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-113210241-1');
  gtag('config', 'AW-808067145');

</script>

<!-- Event snippet for Place an Order conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-808067145/B6GWCN6QzYEBEMnAqIED',
      'transaction_id': ''
  });
</script>

<!-- Event snippet for Order Complete conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-808067145/4ZNZCPP-0oIBEMnAqIED',
      'transaction_id': ''
  });
</script>

<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '210082446446658');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=210082446446658&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "BISJ",
  "url": "https://bisjexporters.com/",
  "sameAs": [
    "https://www.facebook.com/BISJExportersPvtLtd",
    "https://www.instagram.com/BISJ_EXPORTERS_Pvt_Ltd/",
    "https://plus.google.com/108245803408403191488",
    "https://www.pinterest.com/bisjexporterspvtltd/?autologin=true"
      ]
}
</script>

<script type='application/ld+json'> 
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "name": "BISJ Exporters Pvt. Ltd.",
  "alternateName": "BISJ Exporters Pvt. Ltd.	",
  "url": "https://bisjexporters.com/"
}
</script>

</head>
<body>

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="190080825118971"
  logged_in_greeting="Have questions regarding any product or your order?  Please message us here."
  logged_out_greeting="Have questions regarding any product or your order?  Please message us here.">
</div>

<div class="bisj-loader">
<div class="precontain">
<div class="pretext"><h3>WELCOME TO </h3></div>
<div class="prelogo"><img src="<?php echo base_url(); ?>images/BISJ-new.png"></div></div>
<div class="pretext"><h3>Loading...</h3></div></div>

<div id="mypopModal" class="mypop-modal">
  <div class="mypop-modal-content">
   <!-- <span class="mypop-close">&times;</span> -->
    
  <div class="popup-text">
    <img src="<?php echo base_url()."images/BISJ-new.png"; ?>" alt="BISJ LOGO"/>
    <h2 id="txt2">Get 10% Discount Coupon Code</h2>
  </div>
  
  <div class="popup-form">
  <form action="#" name="pop-form" method="POST" id='pform' >
  <input type="text" name="p-name" id="pname" placeholder="Name (required)">
   <div id="errorMsgDiv1" class="errorMessage" style="display:none;">Name must be filled out.</div>
  <input type="email" name="p-email" id="pemail" placeholder="Email (required)">
  <div id="errorMsgDiv2" class="errorMessage" style="display:none;">Email must be filled out</div>
  <input type="number" name="p-contact" id="pcon" placeholder="Phone Number (optional)">
  <input type="submit" value="Submit" id="pform-submit">
  </form><br>
  <span class="close-link"><u>No Thanks, I don't want 10% discount.</u></span>
  </div>

 </div>
</div> 

<div id="mypopModal2" class="mypop-modal2">
  <div class="mypop-modal-content2">
    <span class="mypop-close2">&times;</span>
    
  <div class="popup-text2">
    <h2 id="txt1">Thank you!</h2>
    <h4 id="txt2">Please check your email for the code</h4>
  </div>

 </div>
</div>
<div id="header">
<div class="topbar">
<div class="topbar-text marquee"><span>Cash on Delivery Available (Only for India) &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Free Shipping On All Orders Over Rs.200 (Only For India) </span></div>
<!--<div class="topbar-text"><marquee scrollamount="8"><b>Cash on Delivery Available (Only for India)<span> </span>Free Shipping On All Orders Over Rs.200 (Only for India)</b></marquee></div>-->
</div>
<div class="container header-top"> 
<div class="row" id="welcomeLine">

<div class="search-bar span4">
<form class="form-inline navbar-search" method="get" action="<?php echo base_url()."product/SearchResults"; ?>" >
    <input id="srchFld" name = "product_search" placeholder="Type Product Name" class="srchTxt" type="text" autocomplete="off" />
     <button type="submit" id="submitButton" class="my-gr-btn">Search</button>
</form>
</div>

<div class="logocontain span4">
<div class="logo">
<a class="brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url()."images/India-organic-logo.png"; ?>" alt="Organic-logo" class="other-logo" /></a>
<a class="brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url()."images/BISJ-new.png"; ?>" alt="BISJ LOGO"/></a>
<a class="brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url()."images/fssi.png"; ?>" alt="fssai-logo" class="other-logo"/></a>
</div>
<div class="logoTagline">
  <p>Natural Care With Nature</p>
</div>
</div> <!-- logocontain div closed -->

<div id="everything" class="span4">
<div class="conmenu">
<ul class="side-panel">
<li>
<?php 
    $querystring = "";
    if(isset($_SERVER["QUERY_STRING"]))$querystring = $_SERVER["QUERY_STRING"];
    if($obj->isloggedin)
    {
      ?><a href="<?php echo base_url()."home/useraccount"; ?>"><span class="mybtn my-gr-btn">My Account</span></a>
    <!--    <a href="<?php echo base_url()."home/logout"; ?>" role="button" style="padding-right:0"><input type = "submit" class="btn btn-medium btn-danger mybtn" value = "Logout"/></a>  -->
    
      <?php
    }
    else{
   ?>  
 <!--  <a href="<?php echo base_url().'register'; ?>" role="button" style="padding-right:0"><span class="btn btn-medium mybtn">Register</span></a>  -->
   <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="mybtn my-gr-btn">Login</span></a>
  <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Login</h3>
      </div>
      <div class="modal-body">
      <form class="form-horizontal loginFrm" method = "POST" action = "<?php echo base_url()."home/login"; ?>" >
        <div class="control-group cglogin">               
        <input type="text" id="inputEmail" name = "username" placeholder="Username or Email">
        </div>
        <div class="control-group cglogin">
        <input type="password" id="inputPassword" name = "password" placeholder="Password">
        </div>
        <input type = "hidden" name = "redirectlink" value="<?php echo urlencode(current_url()); ?>"/>
        <div class="control-group cglogin">
        <label class="checkbox">
     <!--   <input type="checkbox" name = "rememberme"><span> Remember me </span><br />   -->
        <a href="<?php echo base_url()."home/forgotpassword"; ?>">Forgot Password</a>
        </label>
        </div>  
      <input type="submit" class="btn btn-success" value="Sign in" />
      <span class="register-btn"><a href="<?php echo base_url()."register"; ?> ">Register</a></span>     
      </form> 
      </div>
  </div>
    <?php } ?>
</li> <!-- user panel div closed -->

<li>
<?php 
      if(!$obj->hidecartlist)
      {
    ?>    
    <div class="pull-right btn-group" id = "bt-it">
    <a href="#" id = "showcartbtn" class=" my-gr-btn dropdown-toggle" style="position: relative;" data-toggle="dropdown"><span><i class="icon-shopping-cart icon-white"></i> [ <span class = "item-cart-count"><?php echo $obj->carttotalitems; ?></span> ]</span> </a>     
    
    <a href="<?php echo base_url()."cart"; ?>" id = "hidecartbtn" class="my-gr-btn " style="position: relative;"><span><i class="icon-shopping-cart icon-white"></i> [ <span class = "item-cart-count"><?php echo $obj->carttotalitems; ?></span> ]</span> </a>
    
      <ul class="dropdown-menu span6" id = "show-cart-dropdown" style="position: absolute;right:-20px; background-color: #ffffff;border: 2px solid #005580;padding: 1px;">
        <li>
        <center>
          <div style="width : 95%;white-space: normal;color: #005580;font-weight: bolder;font-size: 14px;padding-top: 10px;">
            <span>Below is the list of products in your cart. You can increase the quantity and delete products during checkout.</span>
          </div>
        </center>
      </li>
      <li>
        <center style="padding : 10px;"><div style="width : 95%;border: 1px solid rgba(0, 85, 128, 0.31);"></div></center>
      </li>
      <li id = "productList-cart">
        <center>
          <table class = "cart-table" border = "0">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th></th>
                <th>Product Name</th>
                <th>Qty</th>
                <th></th>
                <th>Price</th>
              </tr>
              <tr><th colspan="100"><center><div style="width : 100%;border: 1px solid rgba(0, 85, 128, 0.31);"></div></center></th></tr>
            </thead>
            <tbody></tbody>
          </table>
        </center>       
      </li>
      <li>
        <center style="padding : 10px;"><div style="width : 95%;border: 1px solid rgba(0, 85, 128, 0.31);"></div></center>
      </li>
        <li>
        <div id = "cartloader">
          <center>
            <img src = "<?php echo  base_url()."images/preloader.gif"; ?>" />
          </center>
        </div>
      </li>     
      <li id = "cart-info">
        <center>          
          <table cellspacing="0" cellpadding="0">
          </table>
        </center>
      </li>
      <li>
        <center style="padding : 10px;"><div style="width : 95%;border: 1px solid rgba(0, 85, 128, 0.31);"></div></center>
      </li>
      <li>
        <center>
          <span class = "btn btn-danger" style="margin-right: 20px;" onclick='flushCart();'>Flush Cart</span>
          <a href="<?php echo base_url()."cart"; ?>">           
            <span class = "btn btn-success">Check Out and Pay</span>
          </a>
        </center>
      </li>
      <li style="padding:10px;"></li>     
        <!-- dropdown menu links -->
      </ul>
</div>
  <?php }  ?>
</li> <!-- cart-icon-div closed -->

<li class="sel-country">
  <select id="countryDrop" class="my-gr-btn">
   <option value="SEL">Select Country</option> 
    <option value="IND">INDIA</option>
    <option value="USA">USA</option>
    <option value="UK">UK</option>
    <option value="AUS">AUSTRALIA</option>
    <option value="EUR">EUROPE</option>
    <option value="OTHER">OTHER</option>
</select>
</li> <!-- sel-country div closed -->
</ul>
</div> <!-- conmenu div closed -->
</div> <!-- everything div closed -->
    
</div>
</div>

<div class="mymenudiv">
<div class="container bottom-header"> 
<div class="row">
<div class="topnav span12" id="myTopnav">
<a href="" class="soop"></a>
  <a href="<?php echo base_url(); ?>">Home</a>
  <a href="<?php echo base_url(); ?>product/latest-products">Products</a>
 <!-- <a href="<?php echo base_url(); ?>product/featured-products">Featured Products</a> -->
  <a href="<?php echo base_url(); ?>blog">Blog</a>
  <a href="<?php echo base_url(); ?>about-us">About Us</a>
  <a href="<?php echo base_url(); ?>contact-us">Contact Us</a>
  <a href="javascript:void(0);" style="font-size:23px;" class="icon myicon" onclick="myFunction()">&#9776;</a>
</div>

</div>
</div>
</div> <!-- mymenudiv closed -->

</div>
</div>
<!-- Header End====================================================================== -->
<?php if(TRUE) { ?>

<?php } ?>	
	 
<script>
$(document).ready(function()
{
   $('#countryDrop').change(function(){
  	localStorage.setItem('conData', this.value);
    getCountryHeader();
    setTimeout(function() {
      location.reload();//reload page
					}, 1000); 
});
    if(localStorage.getItem('conData')){
        $('#countryDrop').val(localStorage.getItem('conData'));
    } 
    getCountryHeader(); 
 /*    var cCode = $("span.cName").html();
     alert(cCode);
    $('#countryDrop option:selected').val(cCode);  */

function getCountryHeader()
{
	var countryKey1 = $('#countryDrop').val();
	var countryname = $('#countryDrop option:selected').html();

		$.ajax({
		url: "<?php echo base_url().'fetchdata/getCountryHeader/' ?>", 
		type: "post",
		//datatype: "json",
		data: { country1: countryKey1, country2: countryname}, 
		success:function(result) {
			//$("#resultDiv").html(result);
			//alert(result);
    								},
		error:function()
		{
		console.log("AJAX request was a failure");
		}   
		});
}
});
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
  var contact = document.getElementById('pcon').value;
  
  $.ajax({
  url: '<?php echo base_url().'fetchdata/getPopupData' ?>',
  data: {name:name,email:email,contact:contact},
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
</script>

<?php
$CountryCode = $this->session->userdata('sessiontest');
$CountryName = $this->session->userdata('sessioncon'); ?>
<span class="cName"><?php echo $CountryCode; ?></span>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

<script>
function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*0.34*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
var modal = document.getElementById('mypopModal');
var modal2 = document.getElementById('mypopModal2');
var span = document.getElementsByClassName("close-link")[0];
var span2 = document.getElementsByClassName("mypop-close2")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { modal.style.display = "none";}
span2.onclick = function() { modal2.style.display = "none";}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
   /* if (event.target == modal) { modal.style.display = "none";} */
    if (event.target == modal2) { modal2.style.display = "none";}
} 

// Load model when window gets loaded 
//window.onload = function() { modal2.style.display = "block";  };
function isTouchDevice() {
    return 'ontouchstart' in document.documentElement;
}
/* window.onload = function checkDevice(){
    if (isTouchDevice()) {
    var px1 = getCookie('popcookie');
    if (px1) {}
    else{
  modal2.style.display = "none";
  setTimeout(function showIt2() {
  document.getElementById("mypopModal").style.display = "block";
}, 10000); // after 10 secs
setCookie('popcookie','testcookie',1);

} }
else {
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
}
}; */
</script>
