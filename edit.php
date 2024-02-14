<?php
include 'DB_config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category_id = $_POST['category_id'];
    $new_category_id = $_POST['new_category_id'];
    $category_Name = $_POST['category_Name'];
    $date_modified = $_POST['date_modified'];

    // Check if the new_category_id already exists
    $checkDuplicateQuery = "SELECT * FROM bookcategory WHERE category_id = '$new_category_id' AND category_id != '$category_id'";
    $duplicateResult = $conn->query($checkDuplicateQuery);

    if ($duplicateResult->num_rows > 0) {
        // Duplicate Category ID found
        echo "Error: Category ID already exists. Please choose a different one.";
    } else {
        // Perform update operation
        $updateQuery = "UPDATE bookcategory SET category_id = '$new_category_id', category_Name = '$category_Name', date_modified = '$date_modified' WHERE category_id = '$category_id'";

        if ($conn->query($updateQuery) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Redirect back to index.php
    header('Location: feature3.php');
    exit;
}

// Check if the edit_category_id is set in the URL
if (isset($_GET['edit_category_id'])) {
    $editCategoryId = $_GET['edit_category_id'];

    // Retrieve existing data for the selected category
    $selectQuery = "SELECT * FROM bookcategory WHERE category_id = '$editCategoryId'";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $category_id = $row['category_id'];
        $category_Name = $row['category_Name'];
        $date_modified = $row['date_modified'];
    } else {
        // Handle case where category_id is not found
        echo "Category not found";
        exit;
    }
} else {
    // Handle case where edit_category_id is not set
    echo "Edit category ID not provided";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-inline-size: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-block-end: 20px;
        }

        label {
            display: block;
            margin-block-end: 8px;
        }

        input {
            inline-size: 98%;
            block-size: 25px;
            padding-inline-start: 8px;
            margin-block-end: 16px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        table {
            inline-size: 100%;
            border-collapse: collapse;
            margin-block-start: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: start;
        }

        th {
            background-color: #4caf50;
            color: #fff;
        }

        .actions {
            display: flex;
            justify-content: space-between;
        }

        .edit,
        .delete {
            background-color: #2196F3;
            color: #fff;
            padding: 8px;
            border: none;
            /* Remove borders */
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Book Category</h2>
        <form action="" method="post">
            <input type="hidden"  name="category_id" value="<?php echo $category_id; ?>">

            <label for="new_category_id">New Category ID:</label>
            <input type="text" class="form-control" id="new_category_id" name="new_category_id" pattern="C[0-9]{3}" title="Enter a valid Category ID (e.g., C001)" required value="<?php echo $category_id; ?>">

            <label for="category_Name">Category Name:</label>
            <input type="text" class="form-control" id="category_Name" name="category_Name" required value="<?php echo $category_Name; ?>">

            <label for="date_modified">Date modified:</label>
            <input type="date" class="form-control" id="date_modified" name="date_modified" required value="<?php echo $date_modified; ?>">

            <br><br>

            <button type="submit" name="submit">Update</button>
        </form>
    </div>
</body>

</html>
