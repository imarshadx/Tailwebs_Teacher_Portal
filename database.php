<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailwebs";

$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>