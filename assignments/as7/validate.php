<?php
$config = require __DIR__ . '/../project/bootstrap.php';

$servername = $config['DB_HOST'];
$username = $config['DB_USER'];
$password = $config['DB_PASSWORD'];
$dbname = $config['DB_NAME'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $pass = $_POST['pass'];
}

$stmt = $conn->prepare("SELECT Pass, Clearance FROM User WHERE LOGIN = ?");
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dbPasswordHash = $row['Pass'];
    $clearance = $row['Clearance'];
    if (password_verify($password, $dbPasswordHash)) {
        session_start();
        $_SESSION['user_clearance'] = $clearance;
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $login;
        //add redirect to maintenance
    }
}
?>