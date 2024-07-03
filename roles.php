<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="Role ID" placeholder="Role ID">
        <input type="text" name="Role Name" placeholder="Role Name">
        <input type="submit" value="Submit">
    </form>
    
    <table>
        <tr>
            <th>Role ID</th>
            <th>Role Name</th>
        </tr>
        <?php
        if(isset($_POST['Role ID']) && isset($_POST['Role Name'])){
            echo "<tr>";
            echo "<td>".$_POST['Role ID']."</td>";
            echo "<td>".$_POST['Role Name']."</td>";
            echo "</tr>";
        }
        ?>
    </table>
    
</body>
</html>