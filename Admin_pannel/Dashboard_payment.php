<?php
$servername = "localhost";  // MySQL server
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password (leave empty if not set)
$dbname = "collage_addmision";    // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .dashboard-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #410445;
            color: white;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h2>Payment Dashboard</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Caste</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Card Number</th>
            <th>Expiry Date</th>
            <th>Transaction Time</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['student_name']; ?></td>
            <td><?php echo $row['caste']; ?></td>
            <td>$<?php echo $row['amount']; ?></td>
            <td><?php echo $row['payment_method']; ?></td>
            <td><?php echo str_repeat('*', 12) . substr($row['card_number'], -4); ?></td>
            <td><?php echo $row['expiry_date']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>

<?php $conn->close(); ?>
