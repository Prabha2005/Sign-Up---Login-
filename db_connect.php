
<?php
// database connection file

$servername = "localhost";
$username   = "root";           // same as Workbench user
$password   = " ";               // add your password here if you set one (I don't want to show my password here)
$database   = "userdb";
$port       = 3306;             // working port

$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
