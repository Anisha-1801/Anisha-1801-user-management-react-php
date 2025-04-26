<?php
$host = "localhost"; // database host
$user = "root";      // database username
$pass = "";          // database password
$dbname = "user_api_db"; // your database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
