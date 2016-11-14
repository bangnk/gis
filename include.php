<?php
$conn = mysqli_connect("localhost", "root", "mypassword", "gis_k22");
mysqli_set_charset($conn, 'utf8');
if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}
?>