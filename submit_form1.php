<?php
// Include the database connection file
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $full_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    
    // SQL query to insert data into the database
    $sql = "INSERT INTO admissions1 (full_name, dob, gender, contact, email, address, course) 
            VALUES ('$full_name', '$dob', '$gender', '$contact', '$email', '$address', '$course')";
    
    // Execute the query and check if the data is inserted successfully
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
        // Redirect to another page (like a success page or a next form)
        header("Location: Upload_Doc.html"); // Change this as per your next page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
