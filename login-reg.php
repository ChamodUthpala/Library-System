<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Staff Registration</title>
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #4caf50;
            margin: 0;
            padding: 0;
            display: grid;
            align-items: center;
            justify-content: center;
            block-size: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            inline-size: 700px;
            margin-inline-start: 200px;
            margin-left: 50px;

        }

        label {
            display: block;
            margin-block-end: 8px;
        }

        input {
            inline-size: 100%;
            padding: 8px;
            margin-block-end: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            inline-size: 100%;
            block-size: 40px;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            margin-block-start: 20px;
            text-align: center;
            color: #333;
            text-decoration: none;
        }

        table {
            inline-size: 100%;
            border-collapse: collapse;
            margin-block-start: 10px;
            background-color: white;

        }

        th,
        td {
            padding: 30px;
            text-align: start;
            border-block-end: 1px solid black;
            height:8px;

        }

        th {
            background-color: black;
            color: white;
            font-size: 15px;
            height:8px;
            text-align:center;
        }

        th:hover {
            background-color: white;
            color: black;
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

        .container-table {
            max-inline-size: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        hr.new {
            border: 2px solid green;
            border-radius: 5px;
}

       
    </style>

</head>

<body>
    <form id="staffForm" action="loginreg.php" method="post">
        <h1 style="text-align:center;">UOK LIBRARY MANAGEMENT SYSTEM</h1>
         
        <hr>
        <h2 style="text-align:center;">Login and User Registration</h2>
         
        <label for="user_id">user_id:</label>
        <input type="text" name="user_id" id="user_id" required>

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>

        <label for="username">username:</label>
        <input type="text" name="username" id="username" required value="">

        <label for="password">password:</label>
        <input type="password" name="password" id="password" required value="">


        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>

        <button type="submit" name="submit">Register Staff</button>

        <a href="login.php">Already have an account? <b>Login here</b></a><br><hr class="new">
       
    </form>

    <br>
    <br>
    <br>


    <div class="container-table">
    <h2 style="text-align: center">Registered Staff List</h2>
    <table>
        <thead>

            <tr>

                <th>
                    <centre>User ID</centre>
                </th>
                <th>
                    <centre>First Name</centre>
                </th>
                <th>
                    <centre>Last Name</centre>
                </th>
                <th>
                    <centre>Username</centre>
                </th>
                <th>
                    <centre>Password</centre>
                </th>
                <th>
                    <centre>Email</centre>
                </th>
                <th>
                    <centre>Action</centre>
                </th>
            </tr>
        </thead>

        <tbody>

        </tbody>
    </table>
    
  </div>
</body>
</html>
