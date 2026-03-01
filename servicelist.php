<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-buttons button {
            padding: 8px 12px;
            margin: 2px;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .edit-btn { background-color: #007bff; }
        .delete-btn { background-color: #dc3545; }
        .approve-btn { background-color: #28a745; }
        .reject-btn { background-color: #ffc107; }
        .action-buttons button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Service</th>
                <th>Doctor</th>
                <th>Name</th>
                <th>Email</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
               $conn = new mysqli('localhost', 'root', '', 'doctor');

               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               }

               $q = "SELECT * FROM appoint";
               $result = mysqli_query($conn, $q);

               if (!$result) {
                   die("Query failed: " . mysqli_error($conn));
               }

               while ($row = mysqli_fetch_assoc($result)) {
                   $id = $row['id'];
                   $select_a_service = $row['select_a_service'];
                   $select_doctor = $row['select_doctor'];
                   $name = $row['name'];
                   $email = $row['email'];
                   $appointment_date = $row['appointment_date'];
                   $appointment_time = $row['appointment_time'];
                   $location = $row['location'];
                   $status = $row['status'];
            ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $select_a_service; ?></td>
                    <td><?php echo $select_doctor; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $appointment_date; ?></td>
                    <td><?php echo $appointment_time; ?></td>
                    <td><?php echo $location; ?></td>
                    <td><?php echo $status; ?></td>
                    <td class="action-buttons">
                        <button class="edit-btn" onclick="window.location.href='appointedit.php?id=<?php echo $id; ?>'">Edit</button>
                        <button class="delete-btn" onclick="window.location.href='appointdelete.php?id=<?php echo $id; ?>'">Delete</button>
                        <button class="approve-btn" onclick="window.location.href='appointapprove.php?id=<?php echo $id; ?>'">Approve</button>
                        <button class="reject-btn" onclick="window.location.href='appointreject.php?id=<?php echo $id; ?>'">Reject</button>
                    </td>
                </tr>
            <?php
               }

               $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
