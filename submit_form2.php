<?php
// Include the database connection file
include 'db_connection.php';

// Debug: Log the contents of $_FILES to check what files are uploaded
echo "<pre>";
print_r($_FILES); // This will print the contents of $_FILES
echo "</pre>";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    // Check if files are uploaded and handle file upload
    if (isset($_FILES['marksheet_1st_sem']) && isset($_FILES['marksheet_2nd_sem']) && isset($_FILES['aadhaar'])) {
        $marksheet_1st_sem = $_FILES['marksheet_1st_sem']['name'];
        $marksheet_2nd_sem = $_FILES['marksheet_2nd_sem']['name'];
        $aadhaar = $_FILES['aadhaar']['name'];

        // Define the target directory for uploads
        $target_dir = "uploads/";

        // Check if the uploads directory exists, if not, create it
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Create the directory with proper permissions
        }

        // Generate unique names for uploaded files (to avoid overwriting)
        $marksheet_1st_sem_target = $target_dir . uniqid("marksheet1_") . basename($marksheet_1st_sem);
        $marksheet_2nd_sem_target = $target_dir . uniqid("marksheet2_") . basename($marksheet_2nd_sem);
        $aadhaar_target = $target_dir . uniqid("aadhaar_") . basename($aadhaar);

        // File upload validation (for simplicity, checking for images as an example)
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf']; // Allowed file extensions

        $mark_1_ext = pathinfo($marksheet_1st_sem, PATHINFO_EXTENSION);
        $mark_2_ext = pathinfo($marksheet_2nd_sem, PATHINFO_EXTENSION);
        $aadhaar_ext = pathinfo($aadhaar, PATHINFO_EXTENSION);

        // Check if files have valid extensions
        if (!in_array($mark_1_ext, $allowed_extensions) || !in_array($mark_2_ext, $allowed_extensions) || !in_array($aadhaar_ext, $allowed_extensions)) {
            echo "Only JPG, JPEG, PNG, and PDF files are allowed!";
        } else {
            // Move the uploaded files to the target directory
            if (move_uploaded_file($_FILES['marksheet_1st_sem']['tmp_name'], $marksheet_1st_sem_target) &&
                move_uploaded_file($_FILES['marksheet_2nd_sem']['tmp_name'], $marksheet_2nd_sem_target) &&
                move_uploaded_file($_FILES['aadhaar']['tmp_name'], $aadhaar_target)) {

                // Insert the data into the database
                $sql = "INSERT INTO admissions2 (full_name, dob, gender, contact, email, course, marksheet_1st_sem, marksheet_2nd_sem, aadhaar)
                        VALUES ('$full_name', '$dob', '$gender', '$contact', '$email', '$course', '$marksheet_1st_sem_target', '$marksheet_2nd_sem_target', '$aadhaar_target')";

                if ($conn->query($sql) === TRUE) {
                    // Redirect to the next page (e.g., a success page or next form)
                    header("Location: Upload_Doc.html");
                    exit; // Always use exit() after header redirect to stop further code execution.
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your files.";
            }
        }
    } else {
        echo "Please upload all required files!";
    }

    // Close the database connection
    $conn->close();
}
?>
