<?php
$servername = "localhost";
$username = "root"; // default for XAMPP
$password = ""; // leave blank for XAMPP
$dbname = "washka_db"; // database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
