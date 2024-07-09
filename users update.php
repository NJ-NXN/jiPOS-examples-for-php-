<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Update</title>
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


<?php

    $conn = mysqli_connect("localhost","root","","jipos");

    // Check connection
    if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }

    
    $userid = 0;
    if(isset($_GET['id'])){
        $userid = $_GET['id'];  
    }
    $query_string = "SELECT user_id, first_name, second_name, email, phone, password, role_id FROM users WHERE user_id = ".$userid;
    $result = mysqli_query($conn, $query_string);
    $row   = mysqli_fetch_assoc($result);
        
?>

<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
    <form action="" method="post" class="d-flex flex-column align-items-center" style="width: 100%;">
    <div class="input-group">
        <input class="form-control" type="text" name="first_name" value="<?= $row['first_name']?>" placeholder="First Name">
        <input class="form-control" type="text" name="second_name" value="<?= $row['second_name']?>" placeholder="Second Name">
        <input class="form-control" type="text" name="email" value="<?= $row['email']?>" placeholder="E-mail">
        <input class="form-control" type="text" name="phone" value="<?= $row['phone']?>" placeholder="Phone Number">
        <input class="form-control" type="text" name="password" value="<?= $row['password']?>" placeholder="Password">
        <input class="form-control" type="text" name="role_id" value="<?= $row['role_id']?>" placeholder="Role ID">
        <button class="btn btn-primary" type="submit">Update</button>
    </div>
    </form>
</div>


<?php
    if(isset($_POST['first_name']) &&isset($_POST['second_name']) &&isset($_POST['email']) &&isset($_POST['phone']) &&isset($_POST['password']) &&isset($_POST['role_id'])){
        $firstname = $_POST['first_name'];
        $secondname = $_POST['second_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $roleid = $_POST['role_id'];

    $update_query = "UPDATE users SET first_name = '$firstname', second_name = '$secondname', email = '$email', phone = '$phone', password = '$password', role_id = '$roleid' WHERE role_id = ".$roleid;

    if ($conn->query($update_query) === TRUE) {
         
         header("Location: users.php");
         echo "Record updated successfully";
exit();
    } else {
         echo "Error updating record: " . $conn->error;
    }

}
?>


<?php 
$conn->close();
?>

</body>
</html>