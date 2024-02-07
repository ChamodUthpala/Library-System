<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "library_system");

$book_id = "";
$book_name = "";
$book_category = "";

if (isset($_POST['add_book'])) {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $category_id = $_POST['book_category'];

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>Book Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #4caf50;
            margin: 0;
            padding: 0;
            display: grid;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            margin-left: 150px;
            ;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
        </style>

    

</head>

<body>
    
        <form id="bookForm" method="post" action="">
            <h2>Books Registration</h2>
            <label for="book_id">Book ID:</label>
            <input type="text" id="book_id" name="book_id" required>
    
            <label for="book_name">Book Name:</label>
            <input type="text" id="book_name" name="book_name" required>
    
            <label for="book_category">Book Category:</label>
            <select name="book_category" required>
    
            <?php
            $category_query = "SELECT * FROM bookcategory";
            $category_query_run = mysqli_query($connection, $category_query);
            while ($category_row = mysqli_fetch_assoc($category_query_run)) {
                echo '<option value="' . $category_row['category_id'] . '">' . $category_row['category_Name'] . '</option>';
            }
            ?>

        </select>

        <button type="submit" name="add_book" onclick="registerBook()">Register Book</button>
    </form>
</body>
</html>