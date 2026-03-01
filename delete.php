<?php
$kl=$_GET['id'];
$con = new mysqli('localhost', 'root', '', 'doctor');
$query="DELETE FROM drs_form WHERE id='$kl'";
mysqli_query($con,$query);
?>

<script>alert('delete successful');window.location.replace('list.php');</script>