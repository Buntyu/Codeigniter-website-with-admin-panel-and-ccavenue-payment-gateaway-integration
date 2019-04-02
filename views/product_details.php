<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="<?php echo base_url(); ?>js/bootstrap-rating-input.min.js" type="text/javascript"></script>
</head>
<ul class="breadcrumb">
	<!--<li><a href="index.html">Home</a> <span class="divider">/</span></li>
	<li class="active">Products Name</li>-->
	<?php 
		$breadCrumb = $obj->getBreadCrumb();
		foreach($breadCrumb as $breadcrumbs)
		{
			echo '<li>
					<a href="'.$breadcrumbs["link"].'">'.$breadcrumbs["name"].'</a><span class="divider">/</span>
				</li>';
		}
	?>
</ul>
<span id="pro-id"><?php echo $obj->product['product_id'];?></span>
<style> 
#pro-id {display:none;}
.star{color: #ccc;cursor: pointer;transition: all 0.2s linear;}
.star-checked{color: gold;}
#result{display: block;}
b.r{color: red;}
b.g{color: green;}
.userid, .username, .r_date {display:none;}
.rev{background-color: #e8e8e8;padding: 5px 12px;}
.ystar{color:gold;font-size: 16px;}
.soft2 {margin: 0px;}
#load_more {margin-top: 2%;}
#cart-msg {display:none;}
</style>	

	<script>
	$(document).ready(function(){
		var star_index = "";
    /*STAR RATING*/
 
    $('.star').on("mouseover",function(){
        //get the id of star
        var star_id = $(this).attr('id');
        switch (star_id){
            case "star-1":
                $("#star-1").addClass('star-checked');
                break;
            case "star-2":
                $("#star-1").addClass('star-checked');
                $("#star-2").addClass('star-checked');
                break;
            case "star-3":
                $("#star-1").addClass('star-checked');
                $("#star-2").addClass('star-checked');
                $("#star-3").addClass('star-checked');
                break;
            case "star-4":
                $("#star-1").addClass('star-checked');
                $("#star-2").addClass('star-checked');
                $("#star-3").addClass('star-checked');
                $("#star-4").addClass('star-checked');
                break;
            case "star-5":
                $("#star-1").addClass('star-checked');
                $("#star-2").addClass('star-checked');
                $("#star-3").addClass('star-checked');
                $("#star-4").addClass('star-checked');
                $("#star-5").addClass('star-checked');
                break;
        }
    }).mouseout(function(){
        //remove the star checked class when mouseout
        $('.star').removeClass('star-checked');
    }).click(function(){
        //remove the star checked class when mouseout
          star_index = $(this).attr("id").split("-")[1];
          $('.star').unbind('mouseover');
          $('.star').unbind('mouseout');
          
    });
 
     
    $('#sub1').click(function(){
        //get the stars index from it id
       // var star_index = $(this).attr("id").split("-")[1],
       		//alert(star_index);
       		var star_index2 = star_index;
            product_id = $("#1").val(), //store the product id in variable
            star_container = $(this).parent(), //get the parent container of the stars
            result_div = $("#result"); //result div
            var review = $(".revClass").val();
            var userid = $("span.userid").html();
            var username = $("span.username").html();
            var date = $("span.r_date").html();
          
           
         
        $.ajax({
            url: "<?php echo base_url().'storerating/getStoreRating'; ?>",
            type: "post",
            data: {star:star_index2,product_id:<?php echo $obj->product['product_id']; ?>,rev:review,id:userid,name:username,da:date},
            beforeSend: function(){
				//alert("hello");
              //  star_container.hide(); //hide the star container
                result_div.show().html("Loading..."); //show the result div and display a loadin message
            },
            success: function(data){
				                result_div.html(data);
				                 $(".mega-review").hide();
								//alert("hello hello");
								//alert(data);
            }
        });
    });
 
});
	</script>
   
	<div class="row" itemscope itemtype="http://schema.org/Product">	  
			<div id="gallery" class="span3">
            <a href="<?php echo $obj->product["product_image"]; ?>" class="my-light-img" title="<?php echo $obj->product["product_name"]; ?>">
				<img id = "prod-img" itemprop="image" src="<?php echo $obj->product["product_image"]; ?>" alt="<?php echo $obj->product["product_name"]; ?>" class="mytnail"/>
            </a>
            
            <div class="gal_container">
            <div class="gal_images">
            <?php 
            $gal_array = unserialize($obj->product["gallery_images"]);
            foreach ($gal_array as $gal_images){ ?>
            	<div class="mygal_images">
            	<a href="<?php echo $gal_images."&width=500&height=500"; ?>" class="my-light-img" title="<?php echo $obj->product["product_name"]; ?>">
              <img id = "prod-img" src="<?php echo $gal_images."&width=80&height=70"; ?>" alt="<?php echo $obj->product["product_name"]; ?>" /></a>
            </div>

            <?php } ?>
        </div></div>
            
            <div class="rate_score" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                <h5 style="text-align:center;margin-bottom: 0px;">Average Rating:&nbsp <span style="color:#F75213; font-weight:bold;"><?php for($x=1;$x<=$new;$x++) {
        echo '<i class="fa fa-star" aria-hidden="true"></i>';
    }
    if (strpos($new,'.')) {
        echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
        $x++;
    }
    while ($x<=5) {
        echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
        $x++;
    }
     ?> </span>(<span itemprop="reviewCount"><?php echo $count; ?></span>)</h5>
     <p style="text-align: center;"><span itemprop="ratingValue"><?php echo $new ?></span> out of <span itemprop="bestRating">5</span> stars</p>
				</div>
				
			<!--
			<div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                  <div class="item active">
                   <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
                  </div>
                  <div class="item">
                   <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
                  </div>
                </div>              
			  <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> 
			  
              </div>-->
			  
			<!-- <div class="btn-toolbar">
			  <div class="btn-group">
				<span class="btn"><i class="icon-envelope"></i></span>
				<span class="btn" ><i class="icon-print"></i></span>
				<span class="btn" ><i class="icon-zoom-in"></i></span>
				<span class="btn" ><i class="icon-star"></i></span>
				<span class="btn" ><i class=" icon-thumbs-up"></i></span>
				<span class="btn" ><i class="icon-thumbs-down"></i></span>
			  </div>
			</div>-->
			</div>
			<div class="span6">
				<h1 class="p_title" itemprop="name"><?php echo $obj->product["product_name"]; ?></h1>
				<h5 class="key_features" itemprop="description"><?php echo $obj->product["key_features"];?></h5>
				<hr class="soft2 clr"/>
				<div class="my_variations" itemprop='offers' itemscope itemtype='http://schema.org/Offer'>
				
				<?php
               $nn = $obj->product['variationsData'];
               $dec = json_decode($nn, TRUE);
                $i=1;
               
               foreach ($dec as $varVal) {

          $CountryCode = $this->session->userdata('sessiontest');
								if($CountryCode == 'IND')
								{
                                     $price = 'Rs.&nbsp'.$varVal['Vprice'];
                                     $fprice = 'Rs.&nbsp'.$varVal['Fprice'];
                                     $pricevariable = $varVal['Vprice'];
                                     $currvariable = 'Rs.';
								}
								elseif($CountryCode == 'AUS')
								{
                                     $price = 'AU&nbsp$'.$varVal['AUD_price'];
                                      $fprice = 'AU&nbsp$'.$varVal['F_AUD_price'];
                                      $pricevariable = $varVal['AUD_price'];
                                      $currvariable = 'AU$';
								}
								elseif($CountryCode == 'USA')
								{
                                    $price = 'US&nbsp$'.$varVal['USD_price'];
                                    $fprice = 'US&nbsp$'.$varVal['F_USD_price'];
                                    $pricevariable = $varVal['USD_price'];
                                    $currvariable = 'US$';

								}
								elseif($CountryCode == 'OTHER')
								{
                                    $price = 'US&nbsp$'.$varVal['USD_price'];
                                    $fprice = 'US&nbsp$'.$varVal['F_USD_price'];
                                    $pricevariable = $varVal['USD_price'];
                                    $currvariable = 'US$';

								}
								elseif($CountryCode == 'UK')
								{
                                    $price = '&pound;'.$varVal['UK_price'];
                                    $fprice = '&pound;'.$varVal['F_UK_price'];
                                    $pricevariable = $varVal['UK_price'];
                                    $currvariable = '&pound;';
								}
								elseif($CountryCode == 'EUR')
								{
                                    $price = '&euro;'.$varVal['EURO_price'];
                                    $fprice = '&euro;'.$varVal['F_EURO_price'];
                                    $pricevariable = $varVal['EURO_price'];
                                    $currvariable = '&euro;';
								}
								else 
								{
								    $price = 'Rs.&nbsp'.$varVal['Vprice'];
								    $fprice = 'Rs.&nbsp'.$varVal['Fprice'];
								    $pricevariable = $varVal['Vprice'];
								    $currvariable = 'Rs.';
								}
            ?>  
            <span style="display:none;" itemprop="price" content="<?php echo $pricevariable; ?>"><?php echo $pricevariable; ?></span>
            <span style="display:none;" itemprop="priceCurrency" content="<?php echo $currvariable; ?>"><?php echo $currvariable; ?></span>

   <form class="form-horizontal qtyFrm" onsubmit = "addtocartwithquantity($(this).attr('action')+'/'+$('#qty<?php echo $i;?>').val(),this,event,'<?php echo $i; ?>');" action = "<?php echo base_url().'cart/addtocart/'.$obj->product['product_id'];?>" >
    
<?php
{
          echo '<table class="ind_var">';
           echo '<tr>';
          echo '<td class="varName"><h4>'.$varVal['Vname'].'&nbsp(<span style="color:#009900;"><strike style="color:#f89406;">'.$fprice.'</strike>&nbsp'.$price.'</span>)'.'</h4></td>';
          echo'<td class="varQty"><input type="number" id = "qty'.$i.'" class="span1 num_inc" value="1"/></td>';
          echo'<td class="varSubmit"><button type="submit" class="btn btn-small btn-success"> Add <i class=" icon-shopping-cart"></i></button></td>';
          echo'</tr>';
          echo'</table>';

       }  
       ?>
       </form>
       <?php
         
         $i++;
  		}
               ?>           
				</div>
				
				<div id='cart-msg'>
             <p id="cmsg">PRODUCT ADDED TO CART <i class="fa fa-check" aria-hidden="true"></i></p>
			</div>
				<!--<small>- (14MP, 18x Optical Zoom) 3-inch LCD</small>-->
				
		<!--		<form class="form-horizontal qtyFrm" onsubmit = "addtocartwithquantity($(this).attr('action')+'/'+$('#qty').val(),this,event);" action = "<?php echo  base_url().'cart/addtocart/'.$obj->product['product_id'];?>">
				  <div class="control-group">
					<label class="control-label">
						<?php 
						/*	if($obj->product["discount_status"] == "1")
							{
								echo '
									<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number" style = "text-decoration:line-through;color : red;">'.$obj->product["product_price"].'</span><br />
									<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number1" style = "">'.$obj->product["discount_price"].' </span>
								';

							//	echo '&nbsp;<span class = "price-hidden">'.$obj->product["product_price"].'</span>';
							}
							else
							{    */
								$CountryCode = $this->session->userdata('sessiontest');
								if($CountryCode == 'CAN')
								{
                               echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">'.'CA$&nbsp'.$obj->product["product_price_can"].'</span>';
								}
								elseif($CountryCode == 'EUR')
								{
                               echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">'.'€&nbsp'.$obj->product["product_price_eur"].'</span>';
								}
								elseif($CountryCode == 'AUS')
								{
                               echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">'.'AU$&nbsp'.$obj->product["product_price_aus"].'</span>';
								}
								elseif($CountryCode == 'USA')
								{
                               echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">'.'US$&nbsp'.$obj->product["product_price_usa"].'</span>';
								}
								elseif($CountryCode == 'UK')
								{
                               echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">'.'£&nbsp'.$obj->product["product_price_uk"].'</span>';
								}
								else 
								{
								echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number">'.'Rs.&nbsp'.$obj->product["product_price"].'</span>';
								}

							//	echo '&nbsp;<span class = "price-hidden">'.$obj->product["product_price"].'</span>';
					//		}
						?>
					</label>
					<div class="controls" style="clear: both;margin-left: 0px;">
						<input type="number" id = "qty" class="span1 num_inc" placeholder="Qty."/>
					  <button type="submit" class="btn btn-large btn-success pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
					</div>
					
				  </div>
				  
				</form>    -->


				<form id = "product_id" action="<?php echo base_url()."product/get_avg_rating/" ?>" method = "POST">

				<input type="hidden" name ="pro_id" value="<?php echo $obj->product['product_id']; ?>" id= "pid" >
				</form>

			

		<!--		<form action="thispage.php" method="post" accept-charset="utf-8">
    <fieldset><legend>Review This Product</legend>	
    <p><label for="rating">Rating</label><input type="radio" name="rating"
      value="5" /> 5 <input type="radio" name="rating" value="4" /> 4
      <input type="radio" name="rating" value="3" /> 3 <input type="radio"
      name="rating" value="2" /> 2 <input type="radio" name="rating" value="1" /> 1</p>
    <p><label for="review">Review</label><textarea name="review" rows="8" cols="40">
       </textarea></p>
    <p><input type="submit" value="Submit Review"></p>
    <input type="hidden" name="product_type" value="actual_product_type" id="product_type">
    <input type="hidden" name="product_id" value="actual_product_id" id="product_id">
</fieldset>
</form>     -->
				
				<!--<hr class="soft"/>
				<h4>100 items in stock</h4>
				<form class="form-horizontal qtyFrm pull-right">
				  <div class="control-group">
					<label class="control-label"><span>Color</span></label>
					<div class="controls">
					  <select class="span2">
						  <option>Black</option>
						  <option>Red</option>
						  <option>Blue</option>
						  <option>Brown</option>
						</select>
					</div>
				  </div>
				</form>-->
				
				
				</div> <!-- span6 div closed -->
			<div class="span9"><br>
				
				
			
			<hr class="soft2 clr"/>
				<?php 
					if($obj->product["product_features"])
					{
						echo '<p style="margin-top:10px;">'.$obj->product["product_features"].'</p>';
					}
				?>
		<!--		<a class="btn btn-small pull-right" href="#detail">More Details</a>  -->
				<br class="clr"/>
			<a href="#" name="detail"></a>
			<hr class="soft"/>
			</div>
			
			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
            <!--  <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li> -->
			  <li class="active"><a href="#review" data-toggle="tab">Product Reviews</a></li>              
            </ul>
            <div id="myTabContent" class="tab-content">
         <!--     <div class="tab-pane fade active in" id="home">
			  <h4>Product Information</h4>
                <table class="table table-bordered">
				<tbody>
				<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Product Name: </td><td class="techSpecTD2"><?php echo $obj->productname; ?></td></tr>
				<?php 
					
				/*	if($this->product['categories'])
					{
						echo '<tr class="techSpecRow"><td class="techSpecTD1">Categorised as: </td><td class="techSpecTD2">';
						foreach($this->product['categories'] as $category)
						{
							echo "<a href = '".base_url()."categories/".$category['category_id']."'>".$category['category_name']."</a><br />";
						}						
						echo '</td></tr>';
					}
					
					if($this->product['sub_categories'])
					{
					
						echo '<tr class="techSpecRow"><td class="techSpecTD1">Subcategorised as: </td><td class="techSpecTD2">';
						foreach($this->product['sub_categories'] as $subcategory)
						{
							echo "<a href = '".base_url()."subcategories/".$subcategory['parent_category_id']."/".$subcategory['category_id']."'>".$subcategory['category_name']."</a><br />";
						}						
						echo '</td></tr>';

					} */
				?>	
				</tbody>
				</table>
                </div> -->

              <div class="tab-pane fade active in" id="review">
              <h3>Product reviews </h3>
              <div class="rate_score">
                <h5>Average Rating:&nbsp <span style="color:#F75213; font-weight:bold;"><?php for($x=1;$x<=$new;$x++) {
        echo '<i class="fa fa-star" aria-hidden="true"></i>';
    }
    if (strpos($new,'.')) {
        echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
        $x++;
    }
    while ($x<=5) {
        echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
        $x++;
    }
     ?> </span>(<?php echo $count; ?>)</h5>
     <span><?php echo $new ?> out of 5 stars</span>
				</div><br>

         <div class="disp-review">
        
     <div class="all-rev"> 

     <?php //print_r($rev);
      foreach($rev as $newrev)
      {
      	$uname = $newrev['user_name'];
      	$date = $newrev['date'];
      	$revi = $newrev['review_comment'];
      	$rate = $newrev['ratings_score'];
      	
      	?>
      
        <div class="info">
    <h5>  Posted By <span style="color:#F75213; font-weight: bold;"><?php echo $uname; ?></span> on <span style="font-weight: bold;"><?php echo $date; ?></span></h5>
        </div>

        <div class="rev">
     <p><?php echo $revi; ?></p>
     <div class="rat">
     <?php 
     for($i=1;$i<=$rate;$i++)
     {
     	echo '<i class="fa fa-star ystar" aria-hidden="true"></i>';
     } 
     ?>
     </div>
     </div><br>

      	<?php
      }
       
      ?>
      </div>
      </div>


      <body>
<div class="my_container">
<div id="ajax_review">
</div>
<div class="my_container" style="text-align: center"><button class="btn btn-success" id="load_more" data-val = "0">LOAD MORE<img style="display: none" id="loader" src="<?php echo str_replace('index.php','',base_url()) ?>asset/loader.GIF"> </button></div>
</div>


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script>
$(document).ready(function(){
	 
getreviews(0);
$("#load_more").click(function(e){
e.preventDefault();
var page = $(this).data('val');
//alert(test);
getreviews(page);
});
});
var getreviews = function(page){
	var id = $("#pro-id").html();
//$("#loader").show();
$.ajax({
url:"<?php echo base_url() ?>reviewajax/getAjaxRev",
type:'GET',
data: {page:page, id:id}
}).done(function(response){
$("#ajax_review").append(response);
//$("#loader").hide();
$('#load_more').data('val', ($('#load_more').data('val')+1));
//scroll();
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




               <hr>
               <h3>Review Product</h3>
               <?php 
	if(!$obj->isloggedin)
	{ ?>
          <div class="not_login">
          <h5 style="color:green;">Please LOG IN to leave a review</h5>
          </div>

    <?php }
     else { ?>
               <div id="result"></div>
        
        <div class="mega-review">  

        <div id="star-container">
            <i class="fa fa-star fa-3x star" id="star-1"></i>
            <i class="fa fa-star fa-3x star" id="star-2"></i>
            <i class="fa fa-star fa-3x star" id="star-3"></i>
            <i class="fa fa-star fa-3x star" id="star-4"></i>
            <i class="fa fa-star fa-3x star" id="star-5"></i>
        </div>
         
        <div class="review">
        <h4>Leave A Comment </h4>
        <textarea rows="5" cols="5" name="review" class="revClass"></textarea></br>
        <span class="userid"><?php echo $userdata['id'];?></span>
        <span class="username"><?php echo $userdata['firstname'];?></span>
        <span class="r_date"><?php echo date("d-M-Y"); ?></span>
        <input type="submit" value = "SUBMIT" id="sub1">
        
        </div>

        </div>   

        

        <?php } ?>


              </div>

              
              

		<?php 
			if($this->product["related_Products"])
			{
		?>
		<div class="tab-pane fade" id="profile">
		<div id="myTab" class="pull-right">
		 <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
		 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
		</div>
		<br class="clr"/>
		<hr class="soft"/>
		<div class="tab-content">
			<div class="tab-pane" id="listView">
				<?php
					foreach($this->product["related_Products"] as $products)
					{
						echo '<div class="row">	  
								<div class="span2">
									<img src="'.$products['product_image'].'" alt=""/>
								</div>
								<div class="span4">
								<h3>'.$products['product_name'].'</h3>
								<hr class="soft"/>';
						if($products['discount_status'] == '1')			  
						{
							echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number1" style = "text-decoration:line-through;color : red;">Rs.'.$products['product_price'].'/-</span><br />
								<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number1" style = "">Rs.'.$products['discount_price'].'/- </span>';
						}
						else
						{
							echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number1">Rs.'.$products['product_price'].'/-</span>';
						}					
						echo '<br class="clr"/>
								</div>
								<div class="span3 alignR">';
						if($products['is_new'] == '1')
						{
							echo '<center><i class="tag" style="position:relative;"></i></center>';
						}		
						echo '<br/>
								 <a href="'.base_url().'cart/addtocart/'.$products['product_id'].'" class="btn btn-large btn-success"> Add to <i class=" icon-shopping-cart"></i></a>
								 &nbsp;&nbsp;&nbsp;
								 <a href="'.base_url().'product/'.urlencode(addunderscores($products["product_name"])).'" class="btn btn-warning btn-large"><i class="icon-zoom-in"></i></a>
								</div>
								</div>
								<hr class="soft"/>';
					}
				?>	
			</div>
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
					<?php 
						foreach($this->product["related_Products"] as $products)
						{
							echo '
								<li class="span3">
									 <div class="thumbnail">
									<a  href="'.base_url().'product/'.urlencode(addunderscores($products["product_name"])).'">
							';
							if($products['is_new'] == '1')
							{
								echo '<i class="tag"></i>';
							}
							if($products['product_image'])	
							{
								echo '<img src="'.$products['product_image'].'&width=260&height=160" alt=""/>';	
							}
							echo '</a>
									<div class="caption">
									<h5>'.$products['product_name'].'</h5>
									<h4 style="text-align:center">
									<a class="btn btn-warning" href="'.base_url().'product/'.urlencode(addunderscores($products["product_name"])).'">
										<i class="icon-zoom-in"></i>
										</a>
										&nbsp;&nbsp;&nbsp;
										<a class="btn btn-success addtocart" href="'.base_url().'cart/addtocart/'.$products['product_id'].'">Add to <i class="icon-shopping-cart"></i>
										</a>  </h4>
										<div class = "price-dp">';
							if($products['discount_status'] == '1')			  
							{
								echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number1" style = "text-decoration:line-through;color : red;">Rs.'.$products['product_price'].'/-</span>
									<strong>Discount&nbsp;Price&nbsp;:</strong>&nbsp;<span class = "price-number1" style = "">Rs.'.$products['discount_price'].'/- </span>';
							}
							else
							{
								echo '<strong>Price&nbsp;:</strong>&nbsp;<span class = "price-number1">Rs.'.$products['product_price'].'/-</span>';		  
							}
							echo '				</div>	
											</div>
										</div>
									</li>';
						}
					?>			
				  </ul>
			<hr class="soft"/>
			</div>
		</div>
				<br class="clr">
				
		</div>		
		<?php
			}
		?>

		

		</div>
          </div>

	</div>

</div>
</div>
</div>
</div>



<script>
	$(document).ready(function()
		{
			setInterval(function(){if(parseInt($(".num_inc").val()) < 1)$(".num_inc").val(1);})	

		});
</script>
