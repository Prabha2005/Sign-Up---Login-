<?php
include 'db_connect.php'; // working connection

$username = $_POST['username'];
$password = $_POST['password'];

// Step 1: check if user exists
$sql = "SELECT * FROM user WHERE username = ?"; // if not work, change from username to name
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Step 2: verify password
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        echo "Login successful!";
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "Username not found.";
}

$stmt->close();
$conn->close();
?>
