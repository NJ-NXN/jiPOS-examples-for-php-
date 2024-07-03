<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="role_name" placeholder="Role Name">
        <input type="submit" value="Submit">
    </form>

    <?php
    $conn = mysqli_connect("localhost","root","","jipos");

    // Check connection
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }

    if(isset($_POST['role_name'])){
        $rolename = $_POST['role_name'];

        $sql = "INSERT INTO roles (role_name) VALUES ('$rolename')";

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
            <th>Role ID</th>
            <th>Role Name</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $sql_query = "SELECT role_id, role_name FROM roles";
                $result = $conn->query($sql_query);
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                            echo '<td>' . $row["role_id"] . '</td>';
                            echo '<td>' . $row["role_name"] . '</td>';
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