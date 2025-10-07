<?php
// Simple test connection script

$servername = "localhost";
$username   = "root";          
$password   = " "; // (I don't want to show my password here)              
$database   = "userdb";
$port       = 3306;            // working port

// Try connection
$conn = @new mysqli($servername, $username, $password, $database, $port);

// Check result
if ($conn->connect_error) {
    die("Connection failed on port $port: " . $conn->connect_error);
} else {
    echo "Connected successfully to MySQL on port $port!<br>";
    echo "Server info: " . $conn->server_info;
}

$conn->close();
?>
