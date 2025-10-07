<?php
include 'db_connect.php'; // make sure $conn is your mysqli connection

$users = [
    ['karthick06@gmail.com', 'Karthick V', 'Karthi@1'],
    ['poovi@gmail.com', 'Poovi R', 'Poovi@1'],
    ['keerth14@gmail.com', 'Keerthana R', 'Keerth@1'],
    ['nive23@gmail.com', 'Nivetha S', 'Nive@1'],
    ['nandhu15@gmail.com', 'Nandhu K', 'Nandhu@1'],
    ['mohi14@gmail.com', 'Mohi I', 'Mohi@1'],
    ['navitha10@gmail.com', 'Navitha M', 'navitha#1'],
    ['lakshmipriya@gmail.com', 'Lakshmi Priya R', 'Priya#1'],
    ['arthi80@gmail.com', 'Arthi R', 'arthi$1'],
    ['ajay27@gmail.com', 'Ajay R', 'ajay#1'],
    ['ganesh29@gmail.com', 'Ganesh S', 'ganesH#1']
];

$stmt = $conn->prepare("INSERT INTO user (email, username, password) VALUES (?, ?, ?)");

foreach ($users as $u) {
    [$email, $username, $password] = $u;
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("sss", $email, $username, $hashed);
    $stmt->execute();
}

echo "✅ All users inserted securely with hashed passwords!";
?>
