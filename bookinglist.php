<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        /* Button styling inside table cells */
        a {
            padding: 6px 10px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 14px;
            margin: 0 5px;
        }

        /* Specific styles for each button type */
        a[href*="dredit"] { background-color: #4CAF50; } /* Green */
        a[href*="drdelete"] { background-color: #f44336; } /* Red */
        a[href*="Approve"] { background-color: #008CBA; } /* Blue */
        a[href*="Reject"] { background-color: #ff9800; } /* Orange */

        a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Patient Name</th>
                <th>Age</th>
                <th>Appointment Date</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Description</th>
                <th>status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $con = new mysqli('localhost', 'root', '', 'doctor');

            // Check connection
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            $q = "SELECT * FROM drbooking";
            $res = mysqli_query($con, $q);

            while ($row = mysqli_fetch_array($res)) {
                $id = $row['id'];
                $doctorname = $row['doctorname'];
                $name = $row['name'];
                $age = $row['age'];
                $date = $row['date'];
                $phone = $row['phone'];
                $email = $row['email'];
                $description = $row['description'];
                $status = $row['status'];
            ?>
            <tr>
                
                <td><?php echo htmlspecialchars($doctorname); ?></td>
                <td><?php echo htmlspecialchars($name); ?></td>
                <td><?php echo htmlspecialchars($age); ?></td>
                <td><?php echo htmlspecialchars($date); ?></td>
                <td><?php echo htmlspecialchars($phone); ?></td>
                <td><?php echo htmlspecialchars($email); ?></td>
                <td><?php echo htmlspecialchars($description); ?></td>
                <td><?php echo htmlspecialchars($status); ?></td>
                <td>
                    <a href="dredit.php?id=<?php echo $id; ?>">Edit</a>
                    <a href="drdelete.php?id=<?php echo $id; ?>">Delete</a>
                    <a href="Approve.php?id=<?php echo $id; ?>">Approve</a>
                    <a href="Reject.php?id=<?php echo $id; ?>">Reject</a>
                </td>
            </tr>
            <?php
            }
            $con->close(); // Close the database connection
            ?>
        </tbody>
    </table>
</body>
</html>
