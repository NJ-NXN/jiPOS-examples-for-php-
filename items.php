<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
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
        <input class="form-control" type="text" name="item_name" placeholder="Item Name">
        <input class="form-control" type="text" name="barcode" placeholder="Barcode">
        <input class="form-control" type="text" name="buying_price" placeholder="Buying Price">
        <input class="form-control" type="text" name="selling_price" placeholder="Selling Price">
        <input class="form-control" type="text" name="stock_balance" placeholder="Stock Balance">
        <input class="form-control" type="text" name="cat_id" placeholder="Category ID">
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

    if(isset($_POST['item_name']) &&isset($_POST['barcode']) &&isset($_POST['buying_price']) &&isset($_POST['selling_price']) &&isset($_POST['stock_balance']) &&isset($_POST['cat_id'])){
        $itemname = $_POST['item_name'];
        $barcode = $_POST['barcode'];
        $buyingprice = $_POST['buying_price'];
        $sellingprice = $_POST['selling_price'];
        $stockbalance = $_POST['stock_balance'];
        $catid = $_POST['cat_id'];

        $sql = "INSERT INTO items (item_name, barcode, buying_price, selling_price, stock_balance, cat_id)
        VALUES ('$itemname', '$barcode', '$buyingprice', '$sellingprice', '$stockbalance', '$catid')";


        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
           } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
           }

    }

    if(isset($_GET['id'])){
        $itemid = $_GET['id'];
    
        // sql to delete a record
        $delete_query = "DELETE FROM items WHERE item_id=$itemid";
    
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
            <th scope="col">Item ID</th>
            <th scope="col">Item Name</th>
            <th scope="col">Barcode</th>
            <th scope="col">Buying Price</th>
            <th scope="col">Selling Price</th>
            <th scope="col">Stock Balance</th>
            <th scope="col">Category ID</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $sql_query = "SELECT item_id, item_name, barcode, buying_price, selling_price, stock_balance, cat_id FROM items";
                $result = $conn->query($sql_query);
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                            echo '<td>' . $row["item_id"] . '</td>';
                            echo '<td>' . $row["item_name"] . '</td>';
                            echo '<td>' . $row["barcode"] . '</td>';
                            echo '<td>' . $row["buying_price"] . '</td>';
                            echo '<td>' . $row["selling_price"] . '</td>';
                            echo '<td>' . $row["stock_balance"] . '</td>';
                            echo '<td>' . $row["cat_id"] . '</td>';
                            echo '<td>
                                    <a href="item update.php?id=' . $row["item_id"] . '" class="btn btn-primary">Update</a>
                                    <a href="items.php?id=' . $row["item_id"] . '" class="btn btn-danger">Delete</a>
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