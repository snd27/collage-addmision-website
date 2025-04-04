<?php
session_start();  // Start the session
session_destroy();  // Destroy the session to log out the user

// Redirect to the login page after a brief message
header("Refresh: 2; url=login1.html");  // 2 seconds delay before redirecting
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="message-container">
        <h1>You have been logged out</h1>
        <p>Redirecting to login page...</p>
    </div>
</body>
</html>