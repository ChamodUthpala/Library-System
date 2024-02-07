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


</body>

</html>
