<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
</head>
<body>

<div class="container">
    <h2>Assign Fine</h2>
    <form id="assignFineForm" method="post">
    <div class="form-group">
            <label for="fineID">Fine ID:</label>
            <input type="text" class="form-control" id="fineID" name="fineID" required>
        </div>
        <div class="form-group">
            <label for="memberID">Member ID:</label>
            <input type="text" class="form-control" id="memberID" name="memberID" required>
        </div>
        <div class="form-group">
            <label for="bookID">Book ID:</label>
            <input type="text" class="form-control" id="bookID" name="bookID" required>
        </div>
        <div class="form-group">
            <label for="fineAmount">Fine Amount (LKR):</label>
            <input type="number" class="form-control" id="fineAmount" name="fineAmount" required>
           
        </div>
        <button type="submit" class="btn btn-custom">Assign Fine</button>
        <button type="reset" class="btn btn-custom" >Clear Data</button>
    </form>
</div>

<div class="container mt-4">
    <h2>Assigned Fines</h2>
    <table class="table">
        <thead>
            <tr>
            <th>Fine ID</th>
                <th>Member ID</th>
                <th>Member Name</th>
                <th>Book Name</th>
                <th>Fine Amount (LKR)</th>
                <th>Date Modified</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

</body>
</html>