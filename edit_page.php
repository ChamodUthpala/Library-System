<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted for updating
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateFineID"])) {
    $updateFineID = $_POST["updateFineID"];

    // Retrieve existing fine information for the selected fine ID
    $sqlSelect = "SELECT * FROM fine WHERE fine_id = '$updateFineID'";
    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fineID = $row['fine_id'];
        $memberID = $row['member_id'];
        $bookID = $row['book_id'];
        $fineAmount = $row['fine_amount'];
        // You can retrieve more fields as needed

        // Display a form with pre-filled data for updating
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Fine</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        </head>
        <body>

        <div class="container">
            <h2>Update Fine</h2>
            <form method="post" action="process_update.php" action ="feature6.2hlml.php">
                <div class="form-group">
                    <label for="fineID">Fine ID:</label>
                    <input type="text" class="form-control" id="fineID" name="fineID" value="<?= $fineID ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="memberID">Member ID:</label>
                    <input type="text" class="form-control" id="memberID" name="memberID" value="<?= $memberID ?>" required>
                </div>
                <div class="form-group">
                    <label for="bookID">Book ID:</label>
                    <input type="text" class="form-control" id="bookID" name="bookID" value="<?= $bookID ?>" required>
                </div>
                <div class="form-group">
                    <label for="fineAmount">Fine Amount (LKR):</label>
                    <input type="number" class="form-control" id="fineAmount" name="fineAmount" value="<?= $fineAmount ?>" required>
                </div>
                <!-- Add more fields as needed -->
                <a href="feature6.2hlml.php">
                <button type="submit" class="btn btn-primary" id="updateFineButton">Update Fine</button></a>
            </form>
        </div>
        <script>
            document.getElementById('updateFineButton').addEventListener('click', function() {
            // Use window.location.href to navigate to feature6.2html.php
            window.location.href = 'feature6.2html.php';
            });
        </script>
        </body>
        </html>
        <?php
    } else {
        echo "Fine not found for updating.";
    }
} else {
    echo "Invalid request for updating.";
}

$conn->close();
?>
