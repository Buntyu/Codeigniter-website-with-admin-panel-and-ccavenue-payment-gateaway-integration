<style>#mainBody, #header {display: none;}</style>

<form class="form-horizontal qtyFrm" onsubmit = "addtocartwithquantity($(this).attr('action')+'/'+1,this,event,'1');" action = "<?php echo base_url().'cart/addtocart/'.$pid;?>" >
    
<?php
{
          echo '<table class="ind_var">';
           echo '<tr>';
          echo '<td class="varName"><h4>'.$varVal['Vname'].'&nbsp(<span style="color:#009900;"><strike style="color:#f89406;">'.$fprice.'</strike>&nbsp'.$price.'</span>)'.'</h4></td>';
          echo'<td class="varQty"><input type="number" id = "qty'.$i.'" class="span1 num_inc" value="1"/></td>';
          echo'<td class="varSubmit"><button type="submit" class="btn btn-small btn-success" id="fb-submit"> Add <i class=" icon-shopping-cart"></i></button></td>';
          echo'</tr>';
          echo'</table>';

       }  
       ?>
</form>

<script>
$( document ).ready(function() {
   $( "#fb-submit" ).trigger( "click" );
    window.setTimeout(function(){
       
        window.location.href = "//www.bisjexporters.com/order/?aff=bamboo";

    }, 2000); 
});
</script>



