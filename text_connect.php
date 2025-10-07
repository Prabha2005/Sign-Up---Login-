<?php
// Simple test connection script

$servername = "localhost";
$username   = "root";          
$password   = "sqlvlp@1";              
$database   = "user_auth";
$port       = 3306;            // use 3306 confirmed from your test

// Try connection
$conn = @new mysqli($servername, $username, $password, $database, $port);

// Check result
if ($conn->connect_error) {
    die("❌ Connection failed on port $port: " . $conn->connect_error);
} else {
    echo "✅ Connected successfully to MySQL on port $port!<br>";
    echo "Server info: " . $conn->server_info;
}

$conn->close();
?>
