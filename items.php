<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="item_name" placeholder="Item Name">
        <input type="text" name="barcode" placeholder="Barcode">
        <input type="text" name="buying_price" placeholder="Buying Price">
        <input type="text" name="selling_price" placeholder="Selling Price">
        <input type="text" name="stock_balance" placeholder="Stock Balance">
        <input type="text" name="cat_id" placeholder="Category ID">
        <input type="submit" value="Submit">
    </form>

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
   
    ?>
    
    <table>
        <thead>
        <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Barcode</th>
            <th>Buying Price</th>
            <th>Selling Price</th>
            <th>Stock Balance</th>
            <th>Category ID</th>
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