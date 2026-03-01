<?php
$id = $_GET['id']; 

$conn = new mysqli('localhost', 'root', '', 'doctor');





$q = "DELETE FROM drbooking WHERE id = '$id'";
if (mysqli_query($conn, $q)) {
    echo "<script>alert('Delete Success'); window.location.replace('bookinglist.php');</script>";
} else {
    echo "<script>alert('Error deleting record'); window.location.replace('bookinglist.php');</script>";
}


?>
