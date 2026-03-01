<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
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
                <th>Service Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Available Appointment</th>
                <th>Special Requirement</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
               
               $conn = new mysqli('localhost', 'root', '', 'doctor');

               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               }

              
               $query = "SELECT * FROM service";
               $result = $conn->query($query);

               if ($result->num_rows > 0) {
                   while ($row = $result->fetch_assoc()) {
                       echo "<tr>";
                       echo "<td>" . $row['id'] . "</td>";
                       echo "<td>" . $row['service_name'] . "</td>";
                       echo "<td>" . $row['description'] . "</td>";
                       echo "<td>" . $row['category'] . "</td>";
                       echo "<td>" . $row['price'] . "</td>";
                       echo "<td>" . $row['duration'] . "</td>";
                       echo "<td>" . $row['available_appointment'] . "</td>";
                       echo "<td>" . $row['special_requirement'] . "</td>";
                       echo "<td><img src='" . $row['image'] . "' alt='Service Image' style='width:50px;height:auto;'></td>";
                       echo "<td class='action-buttons'>
                                <button class='edit-btn' onclick=\"window.location.href='serviceedit.php?id=" . $row['id'] . "'\">Edit</button>
                                <button class='delete-btn' onclick=\"window.location.href='servicedelete.php?id=" . $row['id'] . "'\">Delete</button>
                            </td>";
                       echo "</tr>";
                   }
               } else {
                   echo "<tr><td colspan='10'>No services found</td></tr>";
               }

               
               $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>  
