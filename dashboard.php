<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System Dashboard</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <style>
        body {
            background-image: url('dashboard.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #000000;        
        }
        h1 {
            color: #ffffff;
            font-size: 60px;
            text-align: center;
        }

        .container {
            margin-top: 50px;
        }
        /*
        .container1{
            background-color: #ffffff;
            background-attachment: fixed;           
            width: 600px;
            height: 800px;

        }*/

        .btn-container {
            text-align: center;
            color: green;
        }

        .btn-container button {
            margin: 10px;
            width: 400px;
            height: 80px;
            font-size:24px;
        }
    </style>

    </head>
<body>
<div class="container1">
    <div class="container">
        <h1 class="text-center">Library Management System </h1></br></br>

        <div class="btn-container">
            <button class="btn btn-primary btn-lg" onclick="window.location.href='login-reg.php'">Login and User Registration</button></br>
            <button class="btn btn-primary btn-lg" onclick="window.location.href='book_registration.php'">Book Registration</button></br>
            <button class="btn btn-primary btn-lg" onclick="window.location.href='book_category_registration.php'">Book Category Registration</button></br>
            <button class="btn btn-primary btn-lg" onclick="window.location.href='library_member_registration.php'">Library Member Registration</button></br>
            <button class="btn btn-primary btn-lg" onclick="window.location.href='book_borrow_details.php'">Book Borrow Details</button></br>
            <button class="btn btn-primary btn-lg" onclick="window.location.href='feature6.php'">Assign Fine for a User</button>
        </div>
    </div>
</div>
</body>
</html>