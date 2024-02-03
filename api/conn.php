<?php
// Perform database query to create a new user
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "neuaietutor";

$servername = "localhost";
$username = "aiiovdft_neuaietutor";
$password = "Marvelyiky";
$dbname = "aiiovdft_neuaietutor";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>