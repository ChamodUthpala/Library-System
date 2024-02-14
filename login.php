<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "library_test";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $login_username = mysqli_real_escape_string($conn, $_POST['login_username']);
    $login_password = mysqli_real_escape_string($conn, $_POST['login_password']);

    // Validate login credentials
    $query = "SELECT * FROM user WHERE username='$login_username' AND password='$login_password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Login successful, set session variables or perform any other actions
        $_SESSION['username'] = $login_username;
        // Redirect to the dashboard after successful login
        header("Location: dashboard.php");
        exit();
    } else {
        // Login failed, display an error message or redirect to the login page
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #4caf50;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('image1.jfif');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #000000;  
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
        hr.new5 {
  border: 5px solid green;
  border-radius: 3px;
}
    </style>
    </head>
<body>
    <form method="POST" action="login.php" id="login">
        <h1><b>Library Management System</b></h1>
        <h3>User Login</h3>
        <hr class="new5">
        <label for="login_username">Username:</label>
        <input type="text" name="login_username" class="form-control" required>

        <label for="login_password">Password:</label>
        <input type="password" name="login_password" class="form-control" required minlength="8">

        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
