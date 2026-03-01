<?php
$id = $_GET['id']; 

$conn = new mysqli('localhost', 'root', '', 'doctor');
$q = "DELETE FROM drbooking WHERE id = '$id'";
if (mysqli_query($conn, $q)) {
    echo "<script>alert('Bookind Cancelled'); window.location.replace('bookdetais.php');</script>";
} else {
    echo "<script>alert('Error deleting record'); window.location.replace('bookdetais.php');</script>";
}


?>
