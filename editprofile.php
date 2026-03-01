<?php


$con = new mysqli('localhost', 'root', '', 'doctor');
$name=$_POST['name'];
$email=$_POST['email'];
$number=$_POST['number'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$place=$_POST['place'];
$password=$_POST['password'];



$query="update reg set name='$name',email='$email',number='$number',gender='$gender', age='$age',place='$place',password='$password' where email='$email'";
mysqli_query($con,$query);
?>
<script language="javascript">alert('profile updated');window.location.replace('home.php');</script>

