<?php
include 'db_connection.php';  // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists in the 'users' table (correct table name)
    $check_email = "SELECT * FROM users WHERE email = '$email'";

    // Execute the query
    $result = mysqli_query($conn, $check_email);

    if ($result === false) {
        // Query failed, output error message
        echo "Error: " . mysqli_error($conn);
    } else {
        // If email already exists in the database
        if (mysqli_num_rows($result) > 0) {
            echo "Email is already registered. Please <a href='login.html'>login</a>";
        } else {
            // Insert new user into the 'users' table
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

            if (mysqli_query($conn, $sql) === TRUE) {
                echo "Registration successful. <a href='login1.html'>Login here</a>";
            } else {
                echo "Error: " . mysqli_error($conn);  // Handle any errors during insertion
            }
        }
    }

    // Close the connection
    mysqli_close($conn);
}
?>
