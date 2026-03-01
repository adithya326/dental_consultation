<?php
 $id=$_GET['id'];


$con=new mysqli('localhost','root','','doctor');
$q="UPDATE drbooking SET status='Approve' WHERE id='$id'";
$result=mysqli_query($con,$q);

if($result){
    ?>
    <script>alert(' Update Succes');window.location.replace('bookinglist.php');</script>
    <?php
    }
    else{
        ?>
      <script>alert('error');window.location.replace('bookinglist.php');</script>
      <?php
    }