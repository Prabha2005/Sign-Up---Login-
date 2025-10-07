
<?php
// Final verified database connection file

$servername = "localhost";
$username   = "root";           // same as Workbench user
$password   = "sqlvlp@1";               // add your MySQL password here if you set one
$database   = "userdb";
$port       = 3306;             // confirmed working port

$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}
?>
