<?php
session_start();
$email=$_SESSION['logged'];
$doctorname=$_GET['doctorname'];

$con = new mysqli('localhost', 'root', '', 'doctor');


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$q = "SELECT * FROM drs_form where doctorname='$doctorname'"; 
$result = mysqli_query($con, $q);
$doctorname = ''; 
if ($row = mysqli_fetch_array($result)) {
    $doctorname = $row['doctorname'];
}

mysqli_close($con); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Book Doctor</title>
    <style>
        /* CSS styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef; /* Light background color */
            margin: 0;
            padding: 0;
        }
        .form-section {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff; /* White background for the form */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Enhanced shadow effect */
            border-top: 5px solid #007bff; /* Colorful top border */
        }
        .form-heading {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px; /* Increased font size */
            color: #333;
        }
        .doctor-name {
            margin: 10px 0;
            padding: 10px;
            font-size: 20px;
            text-align: center;
            color: #555;
            border: 2px dashed #007bff; /* Dashed border for the doctor's name */
            border-radius: 4px;
            background-color: #f0f8ff; /* Light background color */
        }
        .form-group {
            margin-bottom: 20px; /* Increased spacing */
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555; /* Darker color for labels */
        }
        input[type="text"],
        input[type="int"],
        input[type="tel"],
        input[type="email"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 12px; /* Increased padding for a more spacious look */
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s; /* Smooth transition effect */
        }
        input[type="text"]:focus,
        input[type="int"]:focus,
        input[type="tel"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        textarea:focus {
            border-color: #007bff; /* Change border color on focus */
            outline: none; /* Remove outline */
        }
        textarea {
            resize: vertical;
            height: 120px; /* Increased height for better visibility */
        }
        .submit-btn {
            background-color: #007bff; /* Blue background for the button */
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 18px; /* Increased font size */
            transition: background-color 0.3s; /* Smooth transition */
        }
        .submit-btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        /* Responsive design */
        @media (max-width: 600px) {
            .form-section {
                padding: 15px; /* Adjust padding for smaller screens */
            }
            .form-heading {
                font-size: 24px; /* Adjust heading size */
            }
            .doctor-name {
                font-size: 18px; /* Adjust doctor's name size */
            }
            .submit-btn {
                font-size: 16px; /* Adjust button size */
            }
        }
    </style>
</head>
<body>
<section class="form-section">
    <h1 class="form-heading">Book Doctor</h1>

    <div class="doctor-name">
        Booking for Dr. <?php echo $doctorname; ?> 
    </div>

    <form class="appointment-form" action="drbooking.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="doctorname">Doctor's Name:</label>
            <input type="text" id="doctorname" name="doctorname" value="<?php echo $doctorname; ?>" readonly required>
        </div>

        <div class="form-group">
            <label for="name">Patient Name:</label>
            <input type="text" id="name" name="name" required pattern="[A-Za-z\s]+" title="Text only (no numbers)">
        </div>

        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required pattern="\d{10}" title="Enter a 10-digit phone number" maxlength="10">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" required pattern="[A-Za-z\s]+" title="Letters only (no numbers)"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="submit-btn">Book Now</button>
        </div>
    </form>
</section>

<script>
    // Set minimum date to today
    document.getElementById('date').setAttribute('min', new Date().toISOString().split('T')[0]);

    // Event listener to validate the form before submission
    document.querySelector(".appointment-form").addEventListener("submit", function(e) {
        // Ensure the phone field contains exactly 10 digits
        const phoneInput = document.getElementById('phone');
        if (!/^\d{10}$/.test(phoneInput.value)) {
            alert("Please enter a valid 10-digit phone number.");
            e.preventDefault(); // Prevent form submission
        }

        // Ensure the description field contains only letters and spaces
        const descriptionInput = document.getElementById('description');
        if (!/^[A-Za-z\s]+$/.test(descriptionInput.value)) {
            alert("Please enter letters only in the description.");
            e.preventDefault(); // Prevent form submission
        }
    });
</script>



</body>
</html>
