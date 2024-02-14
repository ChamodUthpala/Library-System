<?php
include 'DB_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category_id = $_POST['category_id'];
    $category_Name = $_POST['category_Name'];
    $date_modified = $_POST['date_modified'];

    // Check if category_id already exists to determine whether to insert or update
    $checkQuery = "SELECT * FROM bookcategory WHERE category_id = '$category_id'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // Update existing record
        $updateQuery = "UPDATE bookcategory SET category_Name = '$category_Name', date_modified = '$date_modified' WHERE category_id = '$category_id'";
        if ($conn->query($updateQuery) === TRUE) {
            include 'index.php';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Insert new record
        $insertQuery = "INSERT INTO bookcategory (category_id, category_Name, date_modified) VALUES ('$category_id', '$category_Name', '$date_modified')";
        if ($conn->query($insertQuery) === TRUE) {
            include 'index.php';
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}


