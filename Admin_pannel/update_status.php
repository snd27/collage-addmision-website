<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $status = ($_POST['action'] === 'approve') ? 'Approved' : 'Rejected';

    if ($id > 0) {
        $sql = "UPDATE applicants SET status='$status' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Invalid applicant ID.";
    }
}

$conn->close();
?>
