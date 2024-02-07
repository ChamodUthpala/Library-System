<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "library_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    
    // SQL to delete record
    $sql = "DELETE FROM book WHERE book_id='$book_id'";

    if ($conn->query($sql) === TRUE) {

        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();

    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
 ?>
