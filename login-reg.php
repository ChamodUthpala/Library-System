<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Staff Registration</title>

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
