<?php
$servername = "localhost";  // MySQL server
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password (leave empty if not set)
$dbname = "collage_addmision";    // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
