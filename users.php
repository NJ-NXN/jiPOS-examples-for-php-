<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous">
    </script>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
    <form action="" method="post" class="d-flex flex-column align-items-center" style="width: 100%;">
        <div class="input-group">
        <input class="form-control" type="text" name="first_name" placeholder="First Name">
        <input class="form-control" type="text" name="second_name" placeholder="Second Name">
        <input class="form-control" type="text" name="email" placeholder="E-Mail">
        <input class="form-control" type="text" name="phone" placeholder="Phone Number">
        <input class="form-control" type="text" name="password" placeholder="Password">
        <input class="form-control" type="text" name="role_id" placeholder="Role ID">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
    </form>
</div>


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
   
    if(isset($_GET['id'])){
        $userid = $_GET['id'];
    
        // sql to delete a record
        $delete_query = "DELETE FROM users WHERE user_id=$userid";
    
        if ($conn->query($delete_query) === TRUE) {
        echo "Record deleted successfully";
    
        } else {
        echo "Error deleting record: " . $conn->error;
        }
    }

    ?>
    
    <table class="table">
        <thead>
        <tr>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Second Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Password</th>
            <th scope="col">Role ID</th>
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
                            echo '<td>
                                    <a href="users update.php?id=' . $row["user_id"] . '" class="btn btn-primary">Update</a>
                                    <a href="users.php?id=' . $row["user_id"] . '" class="btn btn-danger">Delete</a>
                                    </td>';
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