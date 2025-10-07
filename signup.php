
<?php
// signup.php - improved version
session_start();
include 'db_connect.php'; // expects $conn

$message = "";

// Helper: safe output
function e($s){ return htmlspecialchars($s, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    // Basic validation
    if ($username === '' || $email === '' || $password === '' || $confirm === '') {
        $message = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format!";
    } elseif ($password !== $confirm) {
        $message = "Passwords do not match!";
    } elseif (strlen($password) < 8) {
        $message = "Password must be at least 8 characters.";
    } else {
        // Check duplicates (efficiently)
        $checkSql = "SELECT id FROM user WHERE email = ? OR name = ?";
        if ($checkStmt = $conn->prepare($checkSql)) {
            $checkStmt->bind_param("ss", $email, $username);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                $message = "Username or Email already exists!";
            } else {
                // Insert with hashed password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insertSql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
                if ($insertStmt = $conn->prepare($insertSql)) {
                    $insertStmt->bind_param("sss", $username, $email, $hashed_password);
                    if ($insertStmt->execute()) {
                        // Success: redirect to login (prevents form resubmission)
                        header("Location: index.php?signup=success");
                        exit;
                    } else {
                        $message = "Signup failed. Please try again later.";
                        error_log("Signup insert error: " . $insertStmt->error);
                    }
                    $insertStmt->close();
                } else {
                    $message = "Server error (insert prepare).";
                    error_log("Prepare insert failed: " . $conn->error);
                }
            }
            $checkStmt->close();
        } else {
            $message = "Server error (check prepare).";
            error_log("Prepare check failed: " . $conn->error);
        }
    }
}

// HTML form (simple)
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Signup</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>User Signup</h2>

    <?php if ($message): ?>
        <div class="msg"><?= e($message) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required value="<?= e($_POST['username'] ?? '') ?>"><br>
        <input type="email" name="email" placeholder="Email" required value="<?= e($_POST['email'] ?? '') ?>"><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="confirm" placeholder="Confirm Password" required><br>
        <button type="submit">Signup</button>
    </form>

    <p><a href="index.php">Already have an account? Login</a></p>
</div>
</body>
</html>
