<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
