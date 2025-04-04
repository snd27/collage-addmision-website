<?php
// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST["student_name"];
    $caste = $_POST["caste"];
    $amount = $_POST["amount"];
    $payment_method = $_POST["payment_method"];
    $card_number = $_POST["card_number"];
    $expiry_date = $_POST["expiry_date"];
    $cvv = $_POST["cvv"];

    // Insert into database
    $sql = "INSERT INTO payments (student_name, caste, amount, payment_method, card_number, expiry_date, cvv)
            VALUES ('$student_name', '$caste', '$amount', '$payment_method', '$card_number', '$expiry_date', '$cvv')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Payment Successful!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>