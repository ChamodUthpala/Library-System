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