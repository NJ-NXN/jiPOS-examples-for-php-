<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles Update</title>
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

    
    $roleid = 0;
    if(isset($_GET['id'])){
        $roleid = $_GET['id'];  
    }
    $query_string = "SELECT role_id, role_name FROM roles WHERE role_id = ".$roleid;
    $result = mysqli_query($conn, $query_string);
    $row   = mysqli_fetch_assoc($result);
        
?>

<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
    <form action="" method="post" class="d-flex flex-column align-items-center" style="width: 50%;">
    <div class="input-group">
        <input class="form-control" type="text" name="role_name" value="<?= $row['role_name']?>" placeholder="Role Name">
        <button class="btn btn-primary" type="submit">Update</button>
    </div>
    </form>
</div>

<?php
 if(isset($_POST['role_name'])){
    $rolename = $_POST['role_name'];


    $update_query = "UPDATE roles SET role_name = '$rolename' WHERE role_id = ".$roleid;

    if ($conn->query($update_query) === TRUE) {
         
         header("Location: roles.php");
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