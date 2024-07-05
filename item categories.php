<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Categories</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="cat_name" placeholder="Category Name">
        <input type="submit" value="Submit">
    </form>

    <?php
    $conn = mysqli_connect("localhost","root","","jipos");

    // Check connection
    if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }

    if(isset($_POST['cat_name'])){
        $catname = $_POST['cat_name'];

        $sql = "INSERT INTO item_categories (cat_name) VALUES ('$catname')";

        if ($conn->query($sql) === TRUE) {
         echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
    ?>
    
    <table>
        <thead>
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $sql_query = "SELECT cat_id, cat_name FROM item_categories";
                $result = $conn->query($sql_query);
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                            echo '<td>' . $row["cat_id"] . '</td>';
                            echo '<td>' . $row["cat_name"] . '</td>';
                        echo '</tr>';
                    }
                } else {
                echo "0 results";
                }
            ?>
        </tbody>
    </table>

    <?php 
    $conn->close();
    ?>
    
</body>
</html>