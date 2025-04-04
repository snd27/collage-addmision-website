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

// Add an SQL query to fetch admissions data
$sql = "SELECT * FROM admissions3"; // Change `admissions3` to your actual table name
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - 3rd Year Admissions</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
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
    </style>
</head>
<body>

<div class="container">
    <h2>3rd Year Admissions Records</h2>

    <!-- Check if data is available -->
    <?php if ($result && $result->num_rows > 0): ?>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Marksheet 1st Sem</th>
                    <th>Marksheet 2nd Sem</th>
                    <th>Marksheet 3rd Sem</th>
                    <th>Marksheet 4th Sem</th>
                    <th>Aadhaar</th>
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
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($row['marksheet_1st_sem']); ?>" target="_blank">View File</a></td>
                        <td><a href="<?php echo htmlspecialchars($row['marksheet_2nd_sem']); ?>" target="_blank">View File</a></td>
                        <td><a href="<?php echo htmlspecialchars($row['marksheet_3rd_sem']); ?>" target="_blank">View File</a></td>
                        <td><a href="<?php echo htmlspecialchars($row['marksheet_4th_sem']); ?>" target="_blank">View File</a></td>
                        <td><a href="<?php echo htmlspecialchars($row['aadhaar']); ?>" target="_blank">View File</a></td>
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
