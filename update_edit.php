<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fineID"], $_POST["memberID"], $_POST["bookID"], $_POST["fineAmount"])) {
    $fineID = $_POST["fineID"];
    $memberID = $_POST["memberID"];
    $bookID = $_POST["bookID"];
    $fineAmount = $_POST["fineAmount"];

    // Update data in the fine table
    $sqlUpdate = "UPDATE fine 
                  SET member_id = '$memberID', book_id = '$bookID', fine_amount = '$fineAmount', fine_date_modified = NOW()
                  WHERE fine_id = '$fineID'";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Fine updated successfully.";
    } else {
        echo "Error updating fine: " . $conn->error;
    }
} else {
    echo "Invalid request for updating.";
}

$conn->close();
?>
