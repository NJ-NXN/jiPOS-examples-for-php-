<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Categories</title>
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
    <form action="" method="post" class="d-flex flex-column align-items-center" style="width: 50%;">
    <div class="input-group">
        <input type="text" name="cat_name" placeholder="Category Name" class="form-control">
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

    if(isset($_POST['cat_name'])){
        $catname = $_POST['cat_name'];

        $sql = "INSERT INTO item_categories (cat_name) VALUES ('$catname')";

        if ($conn->query($sql) === TRUE) {
         echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }

    if(isset($_GET['id'])){
        $itemcategories = $_GET['id'];
    
        // sql to delete a record
        $delete_query = "DELETE FROM item_categories WHERE cat_id=$itemcategories";
    
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
            <th scope="col">Category ID</th>
            <th scope="col">Category Name</th>
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
                            echo '<td>
                            <a href="item categories update.php?id=' . $row["cat_id"] . '" class="btn btn-primary">Update</a>
                            <a href="item categories.php?id=' . $row["cat_id"] . '" class="btn btn-danger">Delete</a>
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