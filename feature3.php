<!DOCTYPE html>
<html lang="en">
<?php
include 'DB_config.php';
?>


<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Category Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

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
            background-color: lightseagreen;
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
        .container2{
            text-align:center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Book Category registration</h2>
        <form action="process_form.php" method="post">
            <label for="category_id">Category ID:</label>
            <input type="text" id="category_id" class="form-control" name="category_id" pattern="C[0-9]{3}" title="Enter a valid Category ID (e.g., C001)" required value="<?php echo isset($_GET['book_category_id']) ? $_GET['book_category_id'] : ''; ?>">

            <label for="category_Name">Category Name:</label>
            <input type="text" id="category_Name" class="form-control" name="category_Name" required value="<?php echo isset($_GET['category_Name']) ? $_GET['category_Name'] : ''; ?>">

            <label for="date_modified">Date modified:</label>
            <input type="date" id="date_modified"  class="form-control" name="date_modified" required value="<?php echo isset($_GET['date_modified']) ? $_GET['date_modified'] : ''; ?>">

            <br><br>
            
            <div>
            <button type="submit" name="submit">SUBMIT</button>
            </div>
            
        </form>

        <br>

        <h2>Book Category List</h2>
        <table>
            <thead>
                <tr>
                    <th>
                        <centre>Category ID</centre>
                    </th>
                    <th>
                        <centre>Category Name</centre>
                    </th>
                    <th>
                        <centre>Date Modified</centre>
                    </th>
                    <th>
                        <centre>Action</centre>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the PHP code for fetching and displaying data
                include('display_book_category.php');
                ?>
            </tbody>
        </table>
    </div>

    <!-- Additional script for handling delete and update -->
    <script>
        function editBookCategory(category_id, category_Name, date_modified) {
            document.getElementById("category_id").value = category_id;
            document.getElementById("category_Name").value = category_Name;
            document.getElementById("date_modified").value = date_modified;
            document.getElementById("category_id").scrollIntoView({
                behavior: "smooth"
            });
        }

        function deleteBookCategory(category_id) {
            var confirmDelete = confirm("Are you sure you want to delete this record?");
            if (confirmDelete) {
                window.location.href = "delet.php?category_id=" + category_id;
            }
        }
    </script>

</body>

</html>
