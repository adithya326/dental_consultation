<?php
$username = $_POST['username'];
$password = $_POST['password'];

$conn = new mysqli('localhost', 'root', '', 'doctor');
$q = "SELECT * FROM adminlogin WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $q);
if ($row = mysqli_fetch_array($result)) {
    echo "<script>alert('login success');window.location.replace('admin.html');</script>";
} else {
    echo 'error';
}
?>
