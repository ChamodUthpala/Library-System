<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #4caf50;
        }

        .container {
            max-inline-size: 750px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        form {
            margin-block-end: 20px;
        }

        label {
            display: block;
            margin-block-end: 8px;
        }

        input {
            inline-size: 98%;
            block-size: 25px;
            padding-inline-start: 8px;
            margin-block-end: 16px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        table {
            inline-size: 100%;
            border-collapse: collapse;
            margin-block-start: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4caf50;
            color: #fff;
        }

        .actions {
            display: flex;
            justify-content: space-between;
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
            max-inline-size: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 style="text-align: center;">Library member registration</h2>
        <form action="members_reg.php" method="post" onsubmit="return validateEmail() && validateMemberID()">
            <label for="member_id">Member ID:</label>
            <input type="text" id="member_id" name="member_id" pattern="M[0-9]{3}"
                title="Enter a valid Member ID (e.g., M001)" required>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                required title="Enter a valid email address">

            <br><br>

            <button type="submit">
               
            </button>
        </form>
    </div>

    <br>

    <div class="container-table">
        <h2>Member List</h2>
        <table>
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Email Address</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

</body>

</html>
