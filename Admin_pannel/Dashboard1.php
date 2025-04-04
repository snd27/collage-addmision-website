<?php
$servername = "localhost";  // MySQL server
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password (leave empty if not set)
$dbname = "collage_addmision"; // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ADD THIS: Fetch data from the database before checking $result->num_rows
$sql = "SELECT * FROM admissions1";  // Change to your actual table name
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admissions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #A5158C;
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .dashboard-table th, .dashboard-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .dashboard-table th {
            background-color: #410445;
            color: white;
        }

        .dashboard-table td {
            background-color: #f9f9f9;
        }

        .no-data {
            text-align: center;
            color: #f44336;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-table th, .dashboard-table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>1st Year Admissions Records</h2>

    <!-- Check if data is available -->
    <?php if ($result && $result->num_rows > 0): ?>  <!--  Add condition to prevent error -->
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['dob']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No records found in the database.</p>
    <?php endif; ?>
</div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
