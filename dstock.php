<?php
include('conn.php');
if(isset($_POST["submit"]))
{
    $ds=$_POST['ds'];
    $ps=$_POST['ps'];
    $sql3="DELETE FROM stock WHERE store_id='$ds' AND pid='$ps'";
    if(mysqli_query($conn,$sql3))
    {
        echo 'stock deleted';

    }
    else
    {
        echo'error'.mysqli_error();
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
    <form action="dstock.php" method="POST">
    <label>Store_id:</label>
    <input type="text" name="ds" required>
    </div>
    <div>
    <label>Product_id:</label>
    <input type="text" name="ps" required>
    </div>
    <input type="submit" name="submit">
    </form>
    
    </div>
</body>
</html>