<?php  
session_start();
include("connect.php");

// Fetch user logs
$query = "SELECT user_email, login_time, logout_time FROM user_logs ORDER BY login_time DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Logs</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
            color: #333;
        }

        /* Back Button */
        .back-button {
            display: flex;
            justify-content: flex-start;
            padding: 10px 20px;
            margin-left: 260px;
        }

        .back-button a {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
        }

        .back-button a:hover {
            background-color: #0056b3;
        }

        /* Table Container */
        .table-container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            font-size: 0.9rem;
        }

        /* Highlight for "Still Logged In" */
        .highlight {
            color: #dc3545;
            font-weight: bold;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th, td {
                padding: 10px;
                text-align: right;
            }

            th::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                color: #007bff;
            }

            th, td {
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <h1>User Logs</h1>
    <div class="back-button">
        <a href="homepage.php">Back to Homepage</a>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="Email"><?php echo htmlspecialchars($row['user_email']); ?></td>
                        <td data-label="Login Time"><?php echo htmlspecialchars($row['login_time']); ?></td>
                        <td data-label="Logout Time">
                            <?php echo $row['logout_time'] ? htmlspecialchars($row['logout_time']) : '<span class="highlight">Still Logged In</span>'; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
