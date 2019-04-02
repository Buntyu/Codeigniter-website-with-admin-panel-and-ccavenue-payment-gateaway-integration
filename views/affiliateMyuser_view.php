<?php
//print_r($affiliate_myuser);die;
$total = count($affiliate_myuser);
$i = 1;
?>
<div class="aff-users">
  <h4> MY USERS (<?php echo $total;?>)</h4>
 <table class="table table-bordered aff-users" style="background-color:#f5f5f5;">
 <thead>
    <th>Sr. No</th>
    <th>Name</th>
    <th>Email</th>
    <th>Location</th>
 </thead>
 
 <tbody>
     <?php  
      foreach ($affiliate_myuser as $affiMyuser)
{
    $addi = $affiMyuser['city'].' '.$affiMyuser['country'];
 ?>
 
 <tr>
 <td><?php echo $i; ?></td>
 <td><?php echo $affiMyuser['firstname'];?></td> 
 <td><?php echo $affiMyuser['email'];?></td>
 <td><?php if($addi != "") {echo $addi;}?></td>
 </tr>
 
<?php
$i++;
}
?>

  </tbody>
  </table>
</div> <!-- aff-user div closed -->
  
  </div></div></div></div></div>


<style>
    @media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

  /* Force table to not be like tables anymore */
  .aff-users, .aff-users thead, .aff-users tbody, .aff-users th, .aff-users td, .aff-users tr { 
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
    //position: absolute;
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
  .aff-users td:nth-of-type(1):before { content: "Sr No."; }
  .aff-users td:nth-of-type(2):before { content: "Name"; }
  .aff-users td:nth-of-type(3):before { content: "Email"; }
  .aff-users td:nth-of-type(4):before { content: "Loaction"; }
  
}
</style>