<?php
include 'db_connect.php'; // your working connection

$username = $_POST['username'];
$password = $_POST['password'];

// Step 1: check if user exists
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Step 2: verify password
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        echo "✅ Login successful!";
    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "⚠️ Username not found.";
}

$stmt->close();
$conn->close();
?>
