<?php

session_start();
$sid = $_SESSION['sid'];
include('conn.php');
$pid=$stock='';
$errors=array('pid'=>'');
if(isset($_POST['submit']))
{
$pid=$_POST['pid'];
$sql="SELECT * FROM stock WHERE pid = '$pid'";
$result=mysqli_query($conn,$sql);

if($unique=mysqli_fetch_assoc($result))
{
$errors['pid']='id has stock please update ';

}
$stock=$_POST['stock'];
if(array_filter($errors))
{
    echo 'errors in the form';
}
else
{
    $pid=mysqli_real_escape_string($conn,$_POST['pid']);
    $stock=mysqli_real_escape_string($conn,$_POST['stock']);
   
    $store_id=mysqli_real_escape_string($conn,$sid);
    $sql="INSERT INTO stock (pid,stock,store_id) VALUES ('$pid','$stock','$store_id')";
    if(mysqli_query($conn,$sql))
    {
        header('Location:sadmin.php');
    }
    else
    {
        echo 'query error'.mysqli_error();
    }

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
<main>
    <form action="addst.php" method="POST">
    
    <div>
    <label>Product Id:</label>
    <input type="text" name="pid" value="<?php echo htmlspecialchars($pid) ?>" required>
    <?php echo $errors['pid'] ?>
    </div>

    <div>
    <label>Stock:</label>
    <input type="text" name="stock" value="<?php echo htmlspecialchars($stock) ?>" required>
    </div>

    
    
    <input type="submit" name="submit" value="submit">
    
    
    
    </form>
    </main>
</body>
</html>