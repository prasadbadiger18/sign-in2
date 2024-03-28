<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            background-image: url('https://png.pngtree.com/thumb_back/fw800/back_our/20190619/ourmid/pngtree-environmentally-friendly-album-background-material-image_135491.jpg'); /* Background image of environmental-friendly nature */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background for form */
            max-width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .back-button {
            text-align: center;
            margin-top: 10px;
        }
        .back-button a {
            color: #4CAF50;
            text-decoration: none;
        }
        .back-button a:hover {
            text-decoration: underline;
        }
        .success-message {
            display: none;
            color: #4CAF50;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Sign Up Form -->
        <form id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="showSuccessMessage()">
            <h2>Sign Up</h2>
            <input type="text" name="name" id="name" placeholder="Your Name" required>
            <input type="text" name="rfid_no" id="rfid_no" placeholder="RFID Number" required>
            <input type="submit" value="Submit" id="button">
        </form>
        
        <form id="Log-in" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="showSuccessMessage()">
            <h2>Log In</h2>
            <input type="text" name="rfid_no" id="rfid_no" placeholder="RFID Number" required>
            <input type="submit" value="Submit" id="button">
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection parameters
        $servername = "sql6.freesqldatabase.com";
        $username = "sql6693786"; // Replace with your MySQL username
        $password = "FMzffykna4"; // Replace with your MySQL password
        $database = "sql6693786"; // Replace with your MySQL database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get data from the form
        $firstName = isset($_POST['name']) ? $_POST['name'] : '';
        $rfidNumber = isset($_POST['rfid_no']) ? $_POST['rfid_no'] : '';

        // Define initial points value
        $points = 0;

        // Prepare SQL statement with placeholders for values
        $sql = "INSERT INTO RVM (FirstName, RFID_No, Points) VALUES (?, ?, ?)";

        // Create a prepared statement
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("ssi", $firstName, $rfidNumber, $points);

        if ($stmt->execute()) {
            // Data inserted successfully
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>

    <script>
        function showSuccessMessage() {
            alert("Data Inseted!")
        }
    </script>
</body>
</html>
