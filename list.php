<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-btn {
            background-color: #4CAF50;
        }

        .edit-btn:hover {
            background-color: #45a049;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover {
            background-color: #e53935;
        }

        img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Doctor Name</th>
            <th>Experience (Years)</th>
            <th>Location</th>
            <th>Available Time</th>
            <th>Doctor Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $con = new mysqli('localhost', 'root', '', 'doctor');
    $q = "SELECT * FROM drs_form";
    $result = mysqli_query($con, $q);

    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $doctorname = $row['doctorname'];
        $experience = $row['experience'];
        $location = $row['location'];
        $available_time = $row['available_time'];
        $doctorimage = $row['doctorimage'];
    ?>

        <tr>
            <td><?php echo $doctorname; ?></td>
            <td><?php echo $experience; ?></td>
            <td><?php echo $location; ?></td>
            <td><?php echo $available_time; ?></td>
            <td><img src="<?php echo $doctorimage; ?>" alt="Doctor Image"></td>
            <td>
                <a href="edit.php?id=<?php echo $id; ?>" class="button edit-btn" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a>
                <a href="Delete.php?id=<?php echo $id; ?>" class="button delete-btn" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>

</body>
</html>
