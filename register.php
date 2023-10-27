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

    // Check if the username meets the requirements
    $usernameRegex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    if (!preg_match($usernameRegex, $username)) {
        echo "Invalid username. It must contain at least one letter, one number, and one special character.";
        exit();
    }

    // Check if the password has at least 5 characters
    if (strlen($password) < 5) {
        echo "Password must have at least 5 characters.";
        exit();
    }

    // Proceed with registration
    $sql = "INSERT INTO Users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        echo "success";
        exit();
    } else {
        echo " " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
