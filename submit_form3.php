<?php
// Include the database connection file
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    // Handle file uploads (Correct the names)
    $marksheet_1st_sem = $_FILES['marksheet_1st_sem']['name'];
    $marksheet_2nd_sem = $_FILES['marksheet_2nd_sem']['name'];
    $marksheet_3rd_sem = $_FILES['marksheet_3rd_sem']['name'];
    $marksheet_4th_sem = $_FILES['marksheet_4th_sem']['name'];
    $aadhaar = $_FILES['aadhaar']['name'];

    // Define the target directory for uploads
    $target_dir = "uploads/";

    // Generate unique names for uploaded files to avoid overwriting
    $marksheet_1st_sem_target = $target_dir . uniqid("marksheet1_") . basename($marksheet_1st_sem);
    $marksheet_2nd_sem_target = $target_dir . uniqid("marksheet2_") . basename($marksheet_2nd_sem);
    $marksheet_3rd_sem_target = $target_dir . uniqid("marksheet3_") . basename($marksheet_3rd_sem);
    $marksheet_4th_sem_target = $target_dir . uniqid("marksheet4_") . basename($marksheet_4th_sem);
    $aadhaar_target = $target_dir . uniqid("aadhaar_") . basename($aadhaar);

    // Check if all files are uploaded successfully
    if (
        isset($_FILES['marksheet_1st_sem']) && isset($_FILES['marksheet_2nd_sem']) && 
        isset($_FILES['marksheet_3rd_sem']) && isset($_FILES['marksheet_4th_sem']) && 
        isset($_FILES['aadhaar'])
    ) {

        // Check if target directory exists, create it if not
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move the uploaded files to the target directory
        if (
            move_uploaded_file($_FILES['marksheet_1st_sem']['tmp_name'], $marksheet_1st_sem_target) &&
            move_uploaded_file($_FILES['marksheet_2nd_sem']['tmp_name'], $marksheet_2nd_sem_target) &&
            move_uploaded_file($_FILES['marksheet_3rd_sem']['tmp_name'], $marksheet_3rd_sem_target) &&
            move_uploaded_file($_FILES['marksheet_4th_sem']['tmp_name'], $marksheet_4th_sem_target) &&
            move_uploaded_file($_FILES['aadhaar']['tmp_name'], $aadhaar_target)
        ) {

            // Prepare SQL query with placeholders (to avoid SQL injection)
            $stmt = $conn->prepare("INSERT INTO admissions3 (full_name, dob, gender, contact, email, course, marksheet_1st_sem, marksheet_2nd_sem, marksheet_3rd_sem, marksheet_4th_sem, aadhaar)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssss", $full_name, $dob, $gender, $contact, $email, $course, $marksheet_1st_sem_target, $marksheet_2nd_sem_target, $marksheet_3rd_sem_target, $marksheet_4th_sem_target, $aadhaar_target);

            // Execute the statement
            if ($stmt->execute()) {
                // Success
                echo "New record created successfully!";
                // Redirect to the next page (e.g., Payment.html)
                header("Location: Payment.html");
                exit(); // Stop further code execution after redirect
            } else {
                // Error executing query
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            // File upload failed
            echo "Sorry, there was an error uploading your files. Please check the file permissions.";
        }
    } else {
        echo "Please upload all required files!";
    }

    // Close the database connection
    $conn->close();
}
?>
