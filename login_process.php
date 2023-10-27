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

    // Check if the user exists
    $sql = "SELECT * FROM Users WHERE username='$username' AND email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $db_password = $row['password'];
        $failed_attempts = $row['failed_attempts'];

        // Check if the password is correct
        if ($password == $db_password) {
            // Reset failed attempts on successful login
            $failed_attempts = 0;

            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            header("Location: dashboard.php");
        } else {
            // Increment failed attempts
            $failed_attempts++;

            // Update failed attempts in the database
            $sql = "UPDATE Users SET failed_attempts=$failed_attempts WHERE username='$username'";
            $conn->query($sql);

            if ($failed_attempts >= 2) {
                // Send email notification
                $to = $email;
                $subject = "Unauthorized Access Attempt";
                $message = "Hello $username,\n\nSomeone is attempting to access your account. Please take necessary action.";
                $headers = "From: webmaster@example.com";

                mail($to, $subject, $message, $headers);

                echo "Email notification sent.";
            } else {
                echo "Invalid password. Attempts remaining: " . (2 - $failed_attempts);
            }
        }
    } else {
        echo "User not found.";
    }
}

$conn->close();
?>
