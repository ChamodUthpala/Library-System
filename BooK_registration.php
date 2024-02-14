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


    // BOOKID FORMAT VALIDATE
    if (!preg_match('/^B\d{3}$/', $book_id)) {
        echo '<script>alert("Invalid Book ID format. Please use \'B\' followed by three digits (e.g., B001).");</script>';
        echo '<script>window.location.href = window.location.href;</script>';
        exit;
    }

    // Check if the book ID already exists in the database
    $check_query = "SELECT * FROM book WHERE book_id='$book_id'";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) > 0) {

        // If the book ID exist, update the existing record
        $update_query = "UPDATE book SET book_name='$book_name', category_id='$category_id' WHERE book_id='$book_id'";
        if (mysqli_query($connection, $update_query)) {
            echo '<script>alert("Book updated successfully!");</script>';
        } else {
            echo '<script>alert("Error updating book: ' . mysqli_error($connection) . '");</script>';
        }

    } else {
        // If the book ID doesn't exist, insert a new record
        $insert_query = "INSERT INTO book (book_id, book_name, category_id) VALUES ('$book_id', '$book_name', '$category_id')";
        if (mysqli_query($connection, $insert_query)) {
            echo '<script>alert("Book added successfully!");</script>';
        } else {
            echo '<script>alert("Error adding book: ' . mysqli_error($connection) . '");</script>';
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>Book Registration</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('image1.jfif');
            margin: 0;
            padding: 0;
            display: grid;
            align-items: center;
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
            margin: 0 auto;

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

        table {
            width: 800px;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;

        }

        .btn-custom {
            background-color: #4caf50;
            color: white;
        
        }


        th,
        td {
            text-align: center;
            ;
        }


        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .container2{
            display : flex;
            justify-content: center;
        }




        .action-buttons button {
            margin-right: 5px;
            color: black;
            background-color: #2196F3;

        }

     
    </style>

    <script>
        function registerBook() {
            var bookId = document.getElementById('book_id').value;
            var bookName = document.getElementById('book_name').value;
            var bookCategory = document.getElementById('book_category').value;


            // Add a new row to the table
            var table = document.getElementById('bookTable').getElementsByTagName('tbody')[0];
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);

            cell1.innerHTML = bookId;
            cell2.innerHTML = bookName;
            cell3.innerHTML = bookCategory;
            cell4.innerHTML = '<div class="action-buttons"><button onclick="editBook(this)">Edit</button><button onclick="deleteBook(this)">Delete</button></div>';

            // Clear form fields
            document.getElementById('book_id').value = '';
            document.getElementById('book_name').value = '';
            document.getElementById('book_category').value = 'Sci fi'; // Reset to default category

            document.getElementById('bookForm').submit();

        }


        function editBook(bookId, bookName, bookCategory) {
            document.getElementById('book_id').value = bookId;
            document.getElementById('book_name').value = bookName;
            document.getElementById('book_category').value = bookCategory;


        }

        function deleteBook(bookId) {
            var confirmDelete = confirm('Are you sure you want to delete this book?');
            if (confirmDelete) {
                window.location.href = 'delete_book.php?book_id=' + bookId;
            }
        }

    </script>



</head>

<body>
<div>
    <form id="bookForm" method="post" action="">
        <h2>Books Registration</h2>
        <label for="book_id">Book ID:</label>
        <input type="text" id="book_id" class="form-control" name="book_id" required>

        <label for="book_name">Book Name:</label>
        <input type="text" id="book_name"class="form-control"  name="book_name" required>

        <label for="book_category">Book Category:</label>
        <select name="book_category" class="form-control" required>

            <?php
            $category_query = "SELECT * FROM bookcategory";
            $category_query_run = mysqli_query($connection, $category_query);
            while ($category_row = mysqli_fetch_assoc($category_query_run)) {
                echo '<option value="' . $category_row['category_id'] . '">' . $category_row['category_Name'] . '</option>';
            }
            ?>

        </select>

        <button type="submit" name="add_book" class="btn btn-custom" onclick="registerBook()">Register Book</button>
    </form>
    </div>

<div class="container" >
    <table id="bookTable"  class="table" >
        <thead>
            <h2>Book Details</h2>
            <tr>

                <th>Book ID</th>
                <th>Book Name</th>
                <th>Book Category</th>
                <th  colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
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


            $sql = "SELECT b.book_id, b.book_name, bc.category_Name FROM book b
            INNER JOIN bookcategory bc ON b.category_id = bc.category_id";


            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["book_id"] . "</td>";
                    echo "<td>" . $row["book_name"] . "</td>";
                    echo "<td>" . $row["category_Name"] . "</td>";
                    echo "<td>";
                    echo '<button class="btn btn-primary" onclick="editBook(\'' . $row['book_id'] . '\', \'' . $row['book_name'] . '\', \'' . (isset($row['book_category']) ? $row['book_category'] : '') . '\')">Edit</button>&nbsp;&nbsp;';
                    echo "</td>";
                    echo "<td>";
                    echo '<button class="btn btn-danger" onclick="deleteBook(\'' . $row['book_id'] . '\')">Delete</button>';
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();

            ?>
        </tbody>
    </table>
        </div>
        &nbsp;&nbsp;

<div class = "container2"><a href = "dashboard.php" ><button type="reset" class="btn btn-primary btnhome" id ="return" onclick()="return" >Home</button></a></div>





</body>

</html>