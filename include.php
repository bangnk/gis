<?php
$conn = mysqli_connect("localhost", "root", "mypassword", "gis_k22");
mysqli_set_charset($conn, 'utf8');
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
}
?>