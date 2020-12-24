<?php


include('conn.php');
$store_id=$storename=$address=$smanager=$password='';
$errors=array('store_id'=>'','storename'=>'');
if(isset($_POST['submit']))
{
$store_id=$_POST['store_id'];
$sql="SELECT * FROM store WHERE store_id = '$store_id'";
$result=mysqli_query($conn,$sql);

if(!empty($unique=mysqli_fetch_assoc($result)))
{
$errors['store_id']='id already exists';

}
$storename=$_POST['storename'];
$sql="SELECT * FROM store WHERE storename = '$storename'";
$result=mysqli_query($conn,$sql);

if($unique=mysqli_fetch_assoc($result))
{
$errors['storename']='name already exists';

}

$address=$_POST['address'];
$smanager=$_POST['smanager'];
$password=$_POST['password'];
if(array_filter($errors))
{
    echo 'errors in the form';
}
else
{
    $store_id=mysqli_real_escape_string($conn,$_POST['store_id']);
    $storename=mysqli_real_escape_string($conn,$_POST['storename']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $smanager=mysqli_real_escape_string($conn,$_POST['smanager']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $sql="INSERT INTO store (store_id,storename,address,smanager,password) VALUES ('$store_id','$storename','$address','$smanager','$password')";
    if(mysqli_query($conn,$sql))
    {
        header('Location:radmin.php');
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
    <form action="astore.php" method="POST">
    
    <div>
    <label>Store Id:</label>
    <input type="text" name="store_id" value="<?php echo htmlspecialchars($store_id) ?>" required>
    <?php echo $errors['store_id']; ?>
    </div>

    <div>
    <label>Store name:</label>
    <input type="text" name="storename" value="<?php echo htmlspecialchars($storename) ?>" required>
    <?php echo $errors['storename']; ?>
    </div>

    <div>
    <label>Address:</label>
    <input type="text" name="address" value="<?php echo htmlspecialchars($address) ?>" required> 
    </div>
    
    <div>
    <label>Store Manager:</label>
    <input type="text" name="smanager" value="<?php echo htmlspecialchars($smanager) ?>"  required> 
    </div>
    
    <div>
    <label>Set Password:</label>
    <input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>"  required> 
    </div>
    
    <input type="submit" name="submit" value="submit">
    
    
    
    </form>
    </main>
</body>
</html>