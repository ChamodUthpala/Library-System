<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    </head>
<body>
    <form method="POST" action="login.php" id="login">
        <h2>User Login</h2>
        <label for="login_username">Username:</label>
        <input type="text" name="login_username" required>

        <label for="login_password">Password:</label>
        <input type="password" name="login_password" required minlength="8">

        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
