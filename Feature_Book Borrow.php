
<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "library_test";

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

    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified)
            VALUES ('$borrowID', '$bookID', '$memberID', '$borrowStatus', '$borrower_date_modified')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Borrow details added successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
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




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->

    <style>
        body {
            padding: 20px;
            background-color: #4caf50; /* Background color for the entire body */
            color: rgb(17, 17, 17); /* Text color for the entire body */
        }

        .container {
            background-color: white; /* Background color for containers */
            padding: 20px;
            border-radius: 8px;
        }

        .btn-custom {
            background-color: #4caf50;
            color: white;
        }

        /* Added a style for error messages */
        .error-message {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    
<!-- Add Borrow Details Form -->
<div class="container mt-4">

    <h2>Add Borrow Details</h2>

    <form id="addBorrowForm">

        <div class="form-group">
            <label for="borrowID">Borrow ID:</label>
            <input type="text" class="form-control" id="borrowID" required>
            <small class="error-message" id="borrowIDError"></small>
        </div>

        <div class="form-group">
            <label for="bookID">Book ID:</label>
            <input type="text" class="form-control" id="bookID" required>
            <small class="error-message" id="bookIDError"></small>
        </div>

        <div class="form-group">
            <label for="memberID">Member ID:</label>
            <input type="text" class="form-control" id="memberID" required>
            <small class="error-message" id="memberIDError"></small>
        </div>

        <div class="form-group">
            <label for="borrowStatus">Borrow Status:</label>

            <select class="form-control" id="borrowStatus">
                <option value="borrowed">Borrowed</option>
                <option value="available">Available</option>
            </select>

        </div>

        <button type="button" class="btn btn-custom" onclick="addBorrow()">Add Borrow Details</button>
    </form>

</div>

<!-- Display Borrow Records Table -->
<div class="container mt-4">
    <h2>Borrow Records</h2>
    <table class="table">
        <thead>
            <tr>
                <th>BookID</th>
                <th>Member who borrowed</th>
                <th>Book Name</th>
                <th>Borrow Status</th>
                <th>Date Modified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="borrowTableBody">
            <!-- Borrow records will be displayed here dynamically -->
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- JavaScript -->

<script>
    // Sample data (replace this with dynamic data from the server)
    const borrowRecords = [];

    // Function to add borrow details
    function addBorrow() {
        // Fetch input values
        const borrowID = document.getElementById('borrowID').value;
        const bookID = document.getElementById('bookID').value;
        const memberID = document.getElementById('memberID').value;
        const borrowStatus = document.getElementById('borrowStatus').value;

        // Validate IDs using regular expressions
        const idRegex = /^(BR|M|B)\d{3}$/;
        
        // Validate Borrow ID
        if (!idRegex.test(borrowID)) {
            document.getElementById('borrowIDError').innerText = 'Invalid Borrow ID format. Should be in the format BR001.';
            return;
        }

        // Validate Book ID
        if (!idRegex.test(bookID)) {
            document.getElementById('bookIDError').innerText = 'Invalid Book ID format. Should be in the format B001.';
            return;
        }

        // Validate Member ID
        if (!idRegex.test(memberID)) {
            document.getElementById('memberIDError').innerText = 'Invalid Member ID format. Should be in the format M001.';
            return;
        }

        // Clear error messages if validation passes
        document.getElementById('borrowIDError').innerText = '';
        document.getElementById('bookIDError').innerText = '';
        document.getElementById('memberIDError').innerText = '';

        // Sample: Add the new borrow record to the array (replace with server-side logic)
        borrowRecords.push({
            bookID: bookID,
            member: memberID,
            bookName: `Book ${bookID.substring(1)}`, // Replace with actual book name retrieval logic
            borrowStatus: borrowStatus,
            dateModified: new Date().toISOString().slice(0, 10)
        });

        // Call a function to update the table (replace with server-side logic)
        updateBorrowTable();
    }

    // Function to update the borrow records table
    function updateBorrowTable() {
        const tableBody = document.getElementById('borrowTableBody');
        tableBody.innerHTML = ''; // Clear existing rows

        // Iterate through borrow records and create table rows
        borrowRecords.forEach(record => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${record.bookID}</td>
                <td>${record.member}</td>
                <td>${record.bookName}</td>
                <td>${record.borrowStatus}</td>
                <td>${record.dateModified}</td>
                <td><button class="btn btn-danger" onclick="deleteBorrow('${record.bookID}')">Delete</button></td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Function to delete a borrow record
    function deleteBorrow(bookID) {
        // Sample: Remove the borrow record from the array (replace with server-side logic)
        const index = borrowRecords.findIndex(record => record.bookID === bookID);
        if (index !== -1) {
            borrowRecords.splice(index, 1);
            // Call a function to update the table (replace with server-side logic)
            updateBorrowTable();
        }
    }

    // Initial table update
    updateBorrowTable();
</script>
</body>

</html>
