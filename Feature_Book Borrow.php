
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$borrowID = $bookID = $memberID = $borrowStatus = "";
$error_message = $success_message = "";

// Add Borrow Details
if(isset($_POST['add'])) {
    $borrowID = $_POST['borrowID'];
    $bookID = $_POST['bookID'];
    $memberID = $_POST['memberID'];
    $borrowStatus = $_POST['borrowStatus'];
    $borrower_date_modified = date("Y-m-d H:i:s");

    
// Validation for ID format
    

if (!preg_match("/^BR[0-9]{3}$/", $borrowID)) {
    $error_message .= "Borrow ID should be in the format BR001.<br>";
}

if (!preg_match("/^B[0-9]{3}$/", $bookID)) {
    $error_message .= "Book ID should be in the format B001.<br>";
}

if (!preg_match("/^M[0-9]{3}$/", $memberID)) {
    $error_message .= "Member ID should be in the format M001.<br>";
}

if (empty($error_message)) {
    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified)
            VALUES ('$borrowID', '$bookID', '$memberID', '$borrowStatus', '$borrower_date_modified')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Borrow details added successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
}

    
// Delete Borrow Record
if(isset($_POST['delete'])) {
    $borrowID = $_POST['delete'];
    
    $sql = "DELETE FROM bookborrower WHERE borrow_id='$borrowID'";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Borrow record deleted successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch Borrow Records
$sql = "SELECT bookborrower.borrow_id, bookborrower.book_id, bookborrower.borrow_status, bookborrower.borrower_date_modified, member.first_name, member.last_name, book.book_name 
        FROM bookborrower 
        INNER JOIN member ON bookborrower.member_id = member.member_id 
        INNER JOIN book ON bookborrower.book_id = book.book_id";

$result = $conn->query($sql);

// Update Borrow Details
if(isset($_POST['update'])) {
    $borrowID = $_POST['borrowID'];
    $bookID = $_POST['bookID'];
    $memberID = $_POST['memberID'];
    $borrowStatus = $_POST['borrowStatus'];
    $borrower_date_modified = date("Y-m-d H:i:s");

    $sql = "UPDATE bookborrower 
            SET book_id='$bookID', member_id='$memberID', borrow_status='$borrowStatus', borrower_date_modified='$borrower_date_modified' 
            WHERE borrow_id='$borrowID'";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Borrow details updated successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Add style to form -->

    <style>
          body {
            padding: 20px;
            background-image: url('image1.jfif');
            color: rgb(17, 17, 17); /* Text color for the entire body */
        }

        .container {
            background-color: white; /* Background color for containers */
            padding: 20px;
            border-radius: 8px;
        }



        h2
        {
            text-align:center;
        }

        .btn-custom {

            background-color: #4caf50;
            color: white;
            text-align: center;
        }




        .button-container {
        text-align: center; 
    }

        /* style for error messages */
        .error-message {
            color: red;
            margin-top: 5px;
        }

        /* style for login button  */
        .container2{
            display : flex;
            justify-content: center;
        }

        

    </style>

</head>

<body>
    
<!-- Add Borrow Details Form -->
<div class="container mt-4">

    <h2>Add Borrow Details</h2>

    <form id="addBorrowForm" method="post">

        <div class="form-group">
            <label for="borrowID">Borrow ID:</label>
            <input type="text" class="form-control" id="borrowID" class="form-control" name="borrowID" required>
            <small class="error-message" id="borrowIDError"></small>
        </div>

        <div class="form-group">
            <label for="bookID">Book ID:</label>
            <input type="text" class="form-control" id="bookID" class="form-control" name="bookID" required>
            <small class="error-message" id="bookIDError"></small>
        </div>

        <div class="form-group">
            <label for="memberID">Member ID:</label>
            <input type="text" class="form-control" id="memberID" class="form-control" name ="memberID" required>
            <small class="error-message" id="memberIDError"></small>
        </div>

        <div class="form-group">
            <label for="borrowStatus">Borrow Status:</label>

            <select class="form-control" id="borrowStatus" name="borrowStatus">
                <option value="borrowed">Borrowed</option>
                <option value="available">Available</option>
            </select>

        </div>
<div class= "button-container">

        <button type="submit" class="btn btn-custom" name="add">Add Borrow Details</button> </div>

    </form>

    <?php if(isset($error_message)) echo "<p class='error-message'>$error_message</p>"; 
    ?>
    <?php if(isset($success_message)) echo "<p class='text-success'>$success_message</p>"; 
    ?>

</div>

<!-- Display Borrow Records Table -->

<div class="container mt-4">
    <h2>Borrow Records</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Member who borrowed</th>
                <th>Book Name</th>
                <th>Borrow Status</th>
                <th>Date Modified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["book_id"]."</td>
                            <td>".$row["first_name"]." ".$row["last_name"]."</td>
                            <td>".$row["book_name"]."</td>
                            <td>".$row["borrow_status"]."</td>
                            <td>".$row["borrower_date_modified"]."</td>
                            <td>
                                <form method='post'>
                                <a href='?edit=".$row["book_id"]."' class='btn btn-primary'>Edit</a>
                                    <button type='submit' class='btn btn-danger' name='delete' value='".$row["borrow_id"]."'>Delete</button>
                                </form>
                                
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</div>


<!-- Update Borrow Details Form -->

<?php
if(isset($_GET['edit'])) {
    $bookID = $_GET['edit'];
    $sql = "SELECT * FROM bookborrower WHERE book_id='$bookID'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

    
        ?> 

<div class="container mt-4">
    <h2>Update Borrow Details</h2>
    <form method="post">
        <input type="hidden" name="borrowID" class="form-control"  value="<?php echo $row['borrow_id']; ?>">
        <div class="form-group">
            <label for="bookID">Book ID:</label>
            <input type="text" class="form-control" id="bookID" name="bookID" value="<?php echo $row['book_id']; ?>" required>
        </div>
        <div class="form-group">
            <label for="memberID">Member ID:</label>
            <input type="text" class="form-control" id="memberID" class="form-control" name="memberID" value="<?php echo $row['member_id']; ?>" required>
        </div>

        <div class="form-group">
            <label for="borrowStatus">Borrow Status:</label>
            <select class="form-control" id="borrowStatus" name="borrowStatus">
                <option value="borrowed" <?php if($row['borrow_status'] == 'borrowed') echo 'selected'; ?>>Borrowed</option>
                <option value="available" <?php if($row['borrow_status'] == 'available') echo 'selected'; ?>>Available</option>
            </select>
        </div>
        
        <div class= "button-container">

        <button type="submit" class="btn btn-primary" name="update">Update Borrow Details</button> </div>
    </form>
</div>
<?php
    }
}
?>

<!-- Bootstrap JS and Popper.js  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

&nbsp;&nbsp;

<div class = "container2"><a href = "dashboard.php" ><button type="reset" class="btn btn-primary btnhome" id ="return" onclick()="return" >Home</button></a></div>


</body>

</html>
