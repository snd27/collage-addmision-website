<?php
// Include database connection
include 'db_connection.php';

// Handle file uploads
$uploadDirectory = "uploads/"; // Directory to store uploaded files

// Function to handle file uploads and return the file path
function handleFileUpload($fileInputName) {
    global $uploadDirectory;

    // Get file details
    $file = $_FILES[$fileInputName];
    $fileName = basename($file["name"]);
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileDestination = $uploadDirectory . uniqid() . "_" . $fileName;

    // Allow specific file types
    $allowedFileTypes = ["pdf", "doc", "docx", "txt"];

    // Check file type
    if (!in_array($fileType, $allowedFileTypes)) {
        die("Only PDF, DOC, DOCX, and TXT files are allowed.");
    }

    // Check if file is uploaded
    if (move_uploaded_file($fileTmpName, $fileDestination)) {
        return $fileDestination; // Return the file path
    } else {
        die("Error uploading the file: " . $file["name"]);
    }
}

// Collect all form inputs and handle file uploads
$user_id = 1; // Assuming user ID is 1 for now. Modify as per your requirement

$cap_round_form = handleFileUpload("cap_round_form");
$living_certificate = handleFileUpload("living_certificate");
$ssc_marksheet = handleFileUpload("ssc_marksheet");
$hsc_marksheet = handleFileUpload("hsc_marksheet");
$caste_certificate = handleFileUpload("caste_certificate");
$domicile_certificate = handleFileUpload("domicile_certificate");
$non_creamy_layer_certificate = handleFileUpload("non_creamy_layer_certificate");
$gap_certificate = isset($_FILES["gap_certificate"]) ? handleFileUpload("gap_certificate") : null;
$photo = handleFileUpload("photo");
$signature = handleFileUpload("signature");

// SQL query to insert the form data into the database
$sql = "INSERT INTO uploaded_documents (user_id, cap_round_form, living_certificate, ssc_marksheet, hsc_marksheet, caste_certificate, domicile_certificate, non_creamy_layer_certificate, gap_certificate, photo, signature) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind the query
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssssssss", $user_id, $cap_round_form, $living_certificate, $ssc_marksheet, $hsc_marksheet, $caste_certificate, $domicile_certificate, $non_creamy_layer_certificate, $gap_certificate, $photo, $signature);

// Execute the query
if ($stmt->execute()) {
    echo "Documents uploaded successfully.";
} else {
    echo "Error uploading documents: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>