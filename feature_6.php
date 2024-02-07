<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <style>
        body {
            padding: 20px;
            background-color: #4caf50; 
            color: rgb(17, 17, 17);
        }

        .container {
            background-color: white; 
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #4caf50;
            color: white;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }
    </style>


</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connection successful";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required keys are present in the $_POST array
    if (isset($_POST["fineID"], $_POST["memberID"], $_POST["bookID"], $_POST["fineAmount"])) {
        // Process the form data and insert into the database
        $fineID = $_POST["fineID"];
        $memberID = $_POST["memberID"];
        $bookID = $_POST["bookID"];
        $fineAmount = $_POST["fineAmount"];

    // Insert data into the fine table
    $sqlInsert = "INSERT INTO fine (fine_id, book_id, member_id, fine_amount, fine_date_modified) 
                  VALUES ('$fineID', '$bookID', '$memberID', '$fineAmount', NOW())";

    if ($conn->query($sqlInsert) === TRUE) {
        echo "Fine assigned successfully.";
    } else {
        echo "Error assigning fine: " . $conn->error;
    }
}
}

$conn->close();
?>

<div class="container">
    <h2>Assign Fine</h2>
    <form id="assignFineForm" method="post">
    <div class="form-group">
            <label for="fineID">Fine ID:</label>
            <input type="text" class="form-control" id="fineID" name="fineID" required>
        </div>
        <div class="form-group">
            <label for="memberID">Member ID:</label>
            <input type="text" class="form-control" id="memberID" name="memberID" required>
        </div>
        <div class="form-group">
            <label for="bookID">Book ID:</label>
            <input type="text" class="form-control" id="bookID" name="bookID" required>
        </div>
        <div class="form-group">
            <label for="fineAmount">Fine Amount (LKR):</label>
            <input type="number" class="form-control" id="fineAmount" name="fineAmount" required>
           
        </div>
        <button type="submit" class="btn btn-custom">Assign Fine</button>
        <button type="reset" class="btn btn-custom" >Clear Data</button>
    </form>
</div>

<div class="container mt-4">
    <h2>Assigned Fines</h2>
    <table class="table">
        <thead>
            <tr>
            <th>Fine ID</th>
                <th>Member ID</th>
                <th>Member Name</th>
                <th>Book Name</th>
                <th>Fine Amount (LKR)</th>
                <th>Date Modified</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

</body>
</html>