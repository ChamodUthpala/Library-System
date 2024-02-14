<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body {
            background-image: url('image1.jfif');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #000000;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #4caf50;
            color: white;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }

        h2{
            text-align: center;
        }
        
        .container2{
            display : flex;
            justify-content: center;
        }

        .btnhome{
            width : 100px;
            height : 50px;
            padding : 10px;
        }

        td,th {
            text-align: center;
        }

    </style>

<script>
        function validateFineAmount() {
            var fineAmount = document.getElementById("fineAmount").value;
            var errorMessage = document.getElementById("fineAmountError");

            if (fineAmount < 2 || fineAmount > 500) {
                errorMessage.innerHTML = "Fine amount must be between 2 LKR and 500 LKR.";
                return false;
            } else {
                errorMessage.innerHTML = "";
                return true;
            }
        }

        function validateUpdateFineAmount() {
            var fineAmount = document.getElementById("updateFineAmount").value;
            var errorMessage = document.getElementById("updateFineAmountError");

            if (fineAmount < 2 || fineAmount > 500) {
                errorMessage.innerHTML = "Fine amount must be between 2 LKR and 500 LKR.";
                return false;
            } else {
                errorMessage.innerHTML = "";
                return true;
            }
        }

        
    </script>

</head>

<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["assignFineButton"])) {

    if (isset($_POST["fineID"], $_POST["memberID"], $_POST["bookID"], $_POST["fineAmount"])) {


        $fineID = $_POST["fineID"];
        $memberID = $_POST["memberID"];
        $bookID = $_POST["bookID"];
        $fineAmount = $_POST["fineAmount"];


        $checkBookQuery = "SELECT book_id FROM book WHERE book_id = '$bookID'";
        $resultCheckBook = $conn->query($checkBookQuery);

        if ($resultCheckBook->num_rows > 0) {
            if( 2 <= $fineAmount && $fineAmount <= 500){

            // Insert data into the fine table
            $sqlInsert = "INSERT INTO fine (fine_id, book_id, member_id, fine_amount, fine_date_modified) 
                          VALUES ('$fineID', '$bookID', '$memberID', '$fineAmount', NOW())";

                if ($conn->query($sqlInsert) === TRUE) {
                   // echo "Fine assigned successfully.";
                    echo " <script>window.alert(\"Fine assigned successfully.\") </script>";
                } else {
                    //echo "Error assigning fine: " . $conn->error;
                    echo " <script>window.alert(\"Error assigning fine:\") </script>";
                }
            }else{
                //echo " Assign Fine Ammount between 2 - 500";
                echo " <script>window.alert(\"Assign Fine Ammount between 2 - 500\") </script>";

            }
        } else {
            //echo "Error assigning fine: Book not found.";
            echo " <script>window.alert(\"Error assigning fine: Book not found.\") </script>";

        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["updateFineID"])) {

        $updateFineID = $_POST["updateFineID"];

        $sqlSelect = "SELECT * FROM fine WHERE fine_id = '$updateFineID'";
        $result = $conn->query($sqlSelect);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fineID = $row['fine_id'];
            $memberID = $row['member_id'];
            $bookID = $row['book_id'];
            $fineAmount = $row['fine_amount'];

            ?>
            <div class="container">
                <h2>Update Fine</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="fineID">Fine ID:</label>
                        <input type="text" class="form-control" id="fineID" name="fineID" value="<?= $fineID ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="memberID">Member ID:</label>
                        <input type="text" class="form-control" id="memberID" name="memberID" value="<?= $memberID ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="bookID">Book ID:</label>
                        <input type="text" class="form-control" id="bookID" name="bookID" value="<?= $bookID ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fineAmount">Fine Amount (LKR):</label>
                        <input type="number" class="form-control" id="updateFineAmount" name="fineAmount" value="<?= $fineAmount ?>" required oninput="validateUpdateFineAmount()">
                        <span class="error-message" id="updateFineAmountError"></span>
                    </div>
                    <button type="submit" class="btn btn-primary" name="updateFineButton">Update Fine</button>
                </form>
            </div>
            <?php
        } else {
            echo "Fine not found for updating.";
        }
    } elseif (isset($_POST["deleteFineID"])) {
        $deleteFineID = $_POST["deleteFineID"];

        
        // Delete record from the fine table
        $sqlDelete = "DELETE FROM fine WHERE fine_id = '$deleteFineID'";

        if ($conn->query($sqlDelete) === TRUE) {
           // echo "Fine deleted successfully.";
            echo " <script>window.alert(\"Fine deleted successfully.\") </script>";

        } else {
            echo " <script>window.alert(\"Error assigning fine: Book not found.\") </script>";
           // echo "Error deleting fine: " . $conn->error;
        }
    } else {

        $fineID = $_POST["fineID"];
        $memberID = $_POST["memberID"];
        $bookID = $_POST["bookID"];
        $fineAmount = $_POST["fineAmount"];

        $checkBookQuery = "SELECT book_id FROM book WHERE book_id = '$bookID'";
        $resultCheckBook = $conn->query($checkBookQuery);

        if ($resultCheckBook->num_rows > 0) {
            $checkFineQuery = "SELECT * FROM fine WHERE fine_id = '$fineID'";
            $resultCheckFine = $conn->query($checkFineQuery);

            if ($resultCheckFine->num_rows > 0) {

                if( 2 <= $fineAmount && $fineAmount <= 500){

                $sqlUpdate = "UPDATE fine SET member_id = '$memberID', book_id = '$bookID', fine_amount = '$fineAmount', fine_date_modified = NOW() WHERE fine_id = '$fineID'";
                
                if ($conn->query($sqlUpdate) === TRUE) {
                    //echo "Fine updated successfully.";
                    echo " <script>window.alert(\"Fine updated successfully.\") </script>";

                } else {
                    echo " <script>window.alert(\"Error updating fine: \") </script>";
                    //echo "Error updating fine: " . $conn->error;
                }
            }else{
                //echo " Assign Fine Ammount between 2 - 500";
                echo " <script>window.alert(\"Assign Fine Ammount between 2 - 500\") </script>";

            }
            } else {
               // echo "Error updating fine: Fine not found.";
                echo " <script>window.alert(\"Error updating fine: Fine not found.\") </script>";

            }
        } else {
           // echo "Error assigning fine: Book not found.";
            echo " <script>window.alert(\"Error assigning fine: Book not found.\") </script>";

        }
    }
}

$sqlSelect = "SELECT * FROM fine";
$result = $conn->query($sqlSelect);

$assignedFines = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $assignedFines[] = $row;
    }
}

?>

<div class="container">
    <h2>Assign Fine</h2>
    <form method="post" action="">
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
            <input type="number" class="form-control" id="fineAmount" name="fineAmount" required oninput="validateFineAmount()">
            <span class="error-message" id="fineAmountError"></span>
        </div>
        
        <button type="submit" class="btn btn-custom" name="assignFineButton">Assign Fine</button>
        <button type="reset" class="btn btn-custom" style="background-color: #888888">Clear Data</button>
        
    
        
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
                <th colspan = "2" >Action</th>
            </tr>
        </thead>
        <tbody id="fineTableBody">
            <?php
            foreach ($assignedFines as $fine) {
                echo "<tr>";
                echo "<td>{$fine['fine_id']}</td>";
                echo "<td>{$fine['member_id']}</td>";

                $memberID = $fine['member_id'];
                $sqlMember1 = "SELECT first_name FROM member WHERE member_id = '$memberID'";
                $sqlMember2 = "SELECT last_name FROM member WHERE member_id = '$memberID'";
                $resultMember1 = $conn->query($sqlMember1);
                $resultMember2 = $conn->query($sqlMember2);

                if ($resultMember1->num_rows > 0 && $resultMember2->num_rows > 0) {
                    $rowMember1 = $resultMember1->fetch_assoc();
                    $rowMember2 = $resultMember2->fetch_assoc();
                    $memberName1 = $rowMember1['first_name'];
                    $memberName2 = $rowMember2['last_name'];
                    echo "<td> {$memberName1} {$memberName2}</td>";
                } else {
                    echo "<td>Member Not Found</td>";
                }

                $bookID = $fine['book_id'];
                $sqlBook = "SELECT book_name FROM book WHERE book_id = '$bookID'";
                $resultBook = $conn->query($sqlBook);

                if ($resultBook->num_rows > 0) {
                    $rowBook = $resultBook->fetch_assoc();
                    $bookName = $rowBook['book_name'];
                    echo "<td> {$bookName}</td>";
                } else {
                    echo "<td>Book Not Found</td>";
                }

                echo "<td>{$fine['fine_amount']}</td>";
                echo "<td>{$fine['fine_date_modified']}</td>";

                // Edit button
                echo "<td>
                        <form action=\"\" method=\"post\" style=\"display:inline;\">
                            <input type=\"hidden\" name=\"updateFineID\" value=\"{$fine['fine_id']}\">
                            <button type=\"submit\" class=\"btn btn-primary\" name=\"editButton\">Edit</button>
                        </form>
                      </td>";

                // Delete button
                echo "<td>
                        <form method=\"post\" style=\"display:inline;\" onsubmit=\"return confirm('Are you sure you want to delete this fine?');\">
                            <input type=\"hidden\" name=\"deleteFineID\" value=\"{$fine['fine_id']}\">
                            <button type=\"submit\" class=\"btn btn-danger\" name=\"deleteButton\">Delete</button>
                        </form>
                    </td>";


                echo "</tr>";
            }
            ?>

                
        </tbody>
        
    </table>
    
</div>
&nbsp;&nbsp;

<div class = "container2"><a href = "dashboard.php" ><button type="reset" class="btn btn-primary btnhome" id ="return" onclick()="return" >Home</button></a></div>
</body>

</html>
