<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Update</title>
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

    
    $itemid = 0;
    if(isset($_GET['id'])){
        $itemid = $_GET['id'];  
    }
    $query_string = "SELECT item_id, item_name, barcode, buying_price, selling_price, stock_balance, cat_id FROM items WHERE item_id = ".$itemid;
    $result = mysqli_query($conn, $query_string);
    $row   = mysqli_fetch_assoc($result);
        
?>

<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
    <form action="" method="post" class="d-flex flex-column align-items-center" style="width: 100%;">
    <div class="input-group">
        <input class="form-control" type="text" name="item_name" value="<?= $row['item_name']?>" placeholder="Item Name">
        <input class="form-control" type="text" name="barcode" value="<?= $row['barcode']?>" placeholder="Barcode">
        <input class="form-control" type="text" name="buying_price" value="<?= $row['buying_price']?>" placeholder="Buying Price">
        <input class="form-control" type="text" name="selling_price" value="<?= $row['selling_price']?>" placeholder="Selling Price">
        <input class="form-control" type="text" name="stock_balance" value="<?= $row['stock_balance']?>" placeholder="Stock Balance">
        <input class="form-control" type="text" name="cat_id" value="<?= $row['cat_id']?>" placeholder="Category ID">
        <button class="btn btn-primary" type="submit">Update</button>
    </div>
    </form>
</div>


<?php
 if(isset($_POST['item_name']) &&isset($_POST['barcode']) &&isset($_POST['buying_price']) &&isset($_POST['selling_price']) &&isset($_POST['stock_balance']) &&isset($_POST['cat_id'])){
    $itemname = $_POST['item_name'];
    $barcode = $_POST['barcode'];
    $buyingprice = $_POST['buying_price'];
    $sellingprice = $_POST['selling_price'];
    $stockbalance = $_POST['stock_balance'];
    $catid = $_POST['cat_id'];

    $update_query = "UPDATE items SET item_name = '$itemname', barcode = '$barcode', buying_price = '$buyingprice', selling_price = '$sellingprice', stock_balance = '$stockbalance', cat_id = '$catid' WHERE item_id = ".$itemid;

    if ($conn->query($update_query) === TRUE) {
         
         header("Location: items.php");
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