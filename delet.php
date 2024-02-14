<?php
include 'DB_config.php';

if (isset($_GET['delete_category_id'])) {
    $deleteCategoryId = $_GET['delete_category_id'];

    // Delete category record
    $deleteQuery = "DELETE FROM bookcategory WHERE category_id = '$deleteCategoryId'";

    $result = $conn->query($deleteQuery);

    if (!$result) {
        die('Error: ' . $conn->error);
    }
}

$conn->close();
header('Location: feature3.php');
