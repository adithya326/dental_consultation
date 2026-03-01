<?php
$name=$_POST['name'];
$email=$_POST['email'];
$number=$_POST['number'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$place=$_POST['place'];
$password=$_POST['password'];

$con=new mysqli('localhost','root','','doctor');


$q0="select * from reg where email='$email'";
$res0=mysqli_query($con,$q0);
if($row=mysqli_fetch_array($res0))
{


    ?>

    <script language="javascript">alert('email id already exists');window.location.replace('register.html');</script>
    
    <?php
    //error
}

else
{
$q="INSERT INTO reg(name,email,number,gender,age,place,password)
VALUES('$name','$email','$number','$gender','$age','$place','$password')";

$result=mysqli_query($con,$q);
if($result){

    ?>

<script language="javascript">alert('Registration  added successfully');window.location.replace('login.php');</script>

<?php
}
else{

    echo "error";
}

}
?>