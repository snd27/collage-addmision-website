<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "collage_addmision";  

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch uploaded documents from the database
$sql = "SELECT * FROM uploaded_documents";  
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Admission Dashboard</title>
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
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #A5158C;
        }
        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        .no-data {
            text-align: center;
            color: #f44336;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Uploaded Documents Records</h2>
    <table class="dashboard-table">
        <tr>
            <th>ID</th>
            <th>Full Name</th> <!-- Fixed extra '>' -->
            <th>CAP Round Form</th>
            <th>Living Certificate</th>
            <th>S.S.C Marksheet</th>
            <th>H.S.C Marksheet</th>
            <th>Caste Certificate</th>
            <th>Domicile Certificate</th>
            <th>Gap Certificate</th>
            <th>Photo</th>
            <th>Signature</th>
        </tr>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td> <!-- Fixed column name -->
                    <td><a href="<?php echo htmlspecialchars($row['cap_round_form']); ?>" target="_blank">View</a></td>
                    <td><a href="<?php echo htmlspecialchars($row['living_certificate']); ?>" target="_blank">View</a></td>
                    <td><a href="<?php echo htmlspecialchars($row['ssc_marksheet']); ?>" target="_blank">View</a></td>
                    <td><a href="<?php echo htmlspecialchars($row['hsc_marksheet']); ?>" target="_blank">View</a></td>
                    <td><a href="<?php echo htmlspecialchars($row['caste_certificate']); ?>" target="_blank">View</a></td>
                    <td><a href="<?php echo htmlspecialchars($row['domicile_certificate']); ?>" target="_blank">View</a></td>
                    <td><a href="<?php echo htmlspecialchars($row['gap_certificate']); ?>" target="_blank">View</a></td>
                    <td><a href="<?php echo htmlspecialchars($row['photo']); ?>" target="_blank">View</a></td>
                    <td><a href="<?php echo htmlspecialchars($row['signature']); ?>" target="_blank">View</a></td>
                    <td><a href="<?php echo htmlspecialchars($row['uploaded_at	']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="11" class="no-data">No records found in the database.</td>  <!-- Fixed colspan value -->
            </tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>
