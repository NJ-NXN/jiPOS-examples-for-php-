<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="first_name" placeholder="First Name">
        <input type="text" name="second_name" placeholder="Second Name">
        <input type="text" name="email" placeholder="E-Mail">
        <input type="text" name="phone" placeholder="Phone Number">
        <input type="text" name="password" placeholder="Password">
        <input type="text" name="role_id" placeholder="Role ID">
        <input type="submit" value="Submit">
    </form>

    <?php
    $conn = mysqli_connect("localhost","root","","jipos");

    // Check connection
    if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }

    if(isset($_POST['first_name']) &&isset($_POST['second_name']) &&isset($_POST['email']) &&isset($_POST['phone']) &&isset($_POST['password']) &&isset($_POST['role_id'])){
        $firstname = $_POST['first_name'];
        $secondname = $_POST['second_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $roleid = $_POST['role_id'];

        $sql = "INSERT INTO users (first_name, second_name, email, phone, password, role_id)
        VALUES ('$firstname', '$secondname', '$email', '$phone', '$password', '$roleid')";


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
            <th>User ID</th>
            <th>First Name</th>
            <th>Second Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Password</th>
            <th>Role ID</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $sql_query = "SELECT user_id, first_name, second_name, email, phone, password, role_id FROM users";
                $result = $conn->query($sql_query);
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                            echo '<td>' . $row["user_id"] . '</td>';
                            echo '<td>' . $row["first_name"] . '</td>';
                            echo '<td>' . $row["second_name"] . '</td>';
                            echo '<td>' . $row["email"] . '</td>';
                            echo '<td>' . $row["phone"] . '</td>';
                            echo '<td>' . $row["password"] . '</td>';
                            echo '<td>' . $row["role_id"] . '</td>';
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