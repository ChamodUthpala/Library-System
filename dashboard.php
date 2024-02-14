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
            color: #AB5F2F;
        }

        .btn-container button {
            margin: 10px;
            width: 400px;
            height: 80px;
            font-size:24px;
        }
        .btn-container button:hover{
            background-color:#AB5F2F;
            color:white;
              
             
        }

    </style>

    </head>
<body>
<div class="container1">
    <div class="container">
        <h1 class="text-center">Library Management System </h1></br></br>

        <div class="btn-container">
            <button class="btn btn-primary btn-lg" onclick="window.location.href='login-reg.php'">Login and User Registration</button></br>
            <button class="btn btn-primary btn-lg" onclick="window.location.href='BooK_registration.php'">Book Registration</button></br>
            <button class="btn btn-primary btn-lg" onclick="window.location.href='feature3.php'">Book Category Registration</button></br>
            <button class="btn btn-primary btn-lg" onclick="window.location.href='member_reg.php'">Library Member Registration</button></br>
            <button class="btn btn-primary btn-lg" onclick="window.location.href='Feature_Book Borrow.php'">Book Borrow Details</button></br>
            <button class="btn btn-primary btn-lg" onclick="window.location.href='feature_6.php'">Assign Fine for a User</button>
        </div>
    </div>
</div>
</body>
</html>