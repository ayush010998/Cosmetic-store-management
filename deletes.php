<?php
include('conn.php');
if(isset($_POST["submit"]))
{
    $dsid=$_POST['id_to_delete'];
    $nsid=$_POST['new_id'];
    $sql="DELETE FROM salesman WHERE salesman_id='$dsid'";
    if(mysqli_query($conn,$sql))
    {
        $sql1="UPDATE customer SET salesman_id='$nsid' WHERE salesman_id IS NULL";
        if(mysqli_query($conn,$sql1))
        {
            echo 'updated';
        }
        else
        {
          echo  'error'.mysqli_error();
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
<form action="deletes.php" method="POST">
    <label>Salesman_id to delete:</label>
    <input type="text" name="id_to_delete" required>
    <label>Assign new salesman:</label>
    <input type="text" name="new_id" required>
    <input type="submit" name="submit">
    </form>
</body>
</html>