<?php

session_start();
$sid = $_SESSION['sid'];
include('conn.php');
$salesman_id=$sname=$phone=$salary='';
$errors=array('salesman_id'=>'');
if(isset($_POST['submit']))
{
$salesman_id=$_POST['salesman_id'];
$sql="SELECT salesman_id FROM salesman WHERE salesman_id = '$salesman_id'";
$result=mysqli_query($conn,$sql);

if($unique=mysqli_fetch_assoc($result))
{
$errors['salesman_id']='id already exists';

}
$sname=$_POST['sname'];
$phone=$_POST['phone'];
$salary=$_POST['salary'];
if(array_filter($errors))
{
    echo 'errors in the form';
}
else
{
    $salesman_id=mysqli_real_escape_string($conn,$_POST['salesman_id']);
    $sname=mysqli_real_escape_string($conn,$_POST['sname']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $salary=mysqli_real_escape_string($conn,$_POST['salary']);
    $store_id=mysqli_real_escape_string($conn,$sid);
    $sql="INSERT INTO salesman (salesman_id,sname,phone,salary,store_id) VALUES ('$salesman_id','$sname','$phone','$salary','$store_id')";
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
    <form action="adds.php" method="POST">
    
    <div>
    <label>Salesman Id:</label>
    <input type="text" name="salesman_id" value="<?php echo htmlspecialchars($salesman_id) ?>" required>
    <?php echo $errors['salesman_id']; ?>
    </div>

    <div>
    <label>Name:</label>
    <input type="text" name="sname" value="<?php echo htmlspecialchars($sname) ?>" required>
    </div>

    <div>
    <label>Phone:</label>
    <input type="text"  name="phone" value="<?php echo htmlspecialchars($phone) ?>" required> 
    </div>
    
    <div>
    <label>Salary:</label>
    <input type="text" name="salary" value="<?php echo htmlspecialchars($salary) ?>"  required> 
    </div>
    
    <input type="submit" name="submit" value="submit">
    
    
    
    </form>
    </main>
</body>
</html>