<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'DB_config.php';

    $result = $conn->query("SELECT * FROM bookcategory");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["category_id"] . "</td>";
            echo "<td>" . $row["category_Name"] . "</td>";
            echo "<td>" . $row["date_modified"] . "</td>";
            echo "<td>";
            echo "<a href='edit.php?edit_category_id=" . $row['category_id'] . "'> <button class='btn btn-primary'>  EDIT </button></a>";
            echo "  ";
            echo "<a href='delet.php?delete_category_id=" . $row['category_id'] . "'><button class='btn btn-danger'>  DELETE </button></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
    }



    $conn->close();
    ?>


</body>

</html>
