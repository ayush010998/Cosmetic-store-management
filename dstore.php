<?php
include('conn.php');
if(isset($_POST["submit"]))
{
    $did=$_POST['id_to_delete'];
    $nid=$_POST['new_id'];
    $sql="DELETE FROM store WHERE store_id='$did'";
    if(mysqli_query($conn,$sql))
    {

      $sql1="UPDATE salesman SET store_id='$nid' WHERE store_id IS NULL";
      if(mysqli_query($conn,$sql1))
      {
       
      }
      $sql2="UPDATE customer SET store_id='$nid' WHERE store_id IS NULL";
      if(mysqli_query($conn,$sql2))
      {


      }

    }
    else
    {
        echo 'error'.mysqli_error();
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
<form action="dstore.php" method="POST">
    <label>Store_id to delete:</label>
    <input type="text" name="id_to_delete" required>
    <label>Assign new store:</label>
    <input type="text" name="new_id" required>
    <input type="submit" name="submit">
    </form>
</body>
</html>