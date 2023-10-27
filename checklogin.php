<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform back-end authentication
    $sql = "SELECT * FROM Users WHERE (username='$username' OR email='$email') AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        echo "success";
    } else {
        // Authentication failed
        echo "Invalid credentials";
    }
}

$conn->close();
?>
