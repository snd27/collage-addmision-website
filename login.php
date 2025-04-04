<?php
session_start();  // Start the session
include 'db_connection.php';  // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";

    // Execute the query and check if it was successful
    $result = mysqli_query($conn, $sql);

    // Check for query success
    if ($result === false) {
        // If the query failed, display the error
        echo "Error: " . mysqli_error($conn);
    } else {
        // If the query succeeded, check the number of rows
        if (mysqli_num_rows($result) > 0) {
            // Fetch the user data
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store user information in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirect to the home page (or any page you choose)
                header("Location: home.php");
                exit();
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "No user found with that email. Please <a href='register.html'>register</a>.";
        }
    }

    // Close the connection
    $conn->close();
}
?>
