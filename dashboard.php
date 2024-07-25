<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: dashboard.php"); // Redirect to login page if not logged in
    exit();
}

$email = $_SESSION['email'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <p>Email: <?php echo $email; ?></p>

    
    <a href="website.html" class="btn">Click here </a>
</body>
</html>
