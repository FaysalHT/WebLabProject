<?php
$servername = "localhost";
$username = "root"; // Default username for MySQL
$password = "";     // Default password (blank for XAMPP)
$dbname = "unipass"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
