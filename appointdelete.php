<?php
$id = $_GET['id']; 

$conn = new mysqli('localhost', 'root', '', 'doctor');





$q = "DELETE FROM appoint WHERE id = '$id'";
if (mysqli_query($conn, $q)) {
    echo "<script>alert('Delete Success'); window.location.replace('servicelist.php');</script>";
} else {
    echo "<script>alert('Error deleting record'); window.location.replace('servicelist.php');</script>";
}


?>
