<?php
include('conn.php');
$msg="";
if(isset($_POST['upload'])){

$target="images/".basename($_FILES['image']['name']);

$image= $_FILES['image']['name'];
$pname= $_POST['pname'];

$sql="INSERT INTO products (pname,image) VALUES ($pname,$image)";
mysqli_query($conn,$sql);
if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
    header('Location:home.php');
}
else{
    $msg="some problem exists".sqli_query_error();
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
    <link rel="stylesheet" href="bea.css">
</head>
<body>
    <div id="content">
    <form action="admin.php" method="POST" enctype="multipart/form-data">
    
    <input type="hidden" name="size" value="1000000">
    <div>
    <input type="file" name="image">
    </div>
    <div>
    <textarea name="pname" cols="40" rows="4" placeholder="name ur product"></textarea>
    </div>
    
    
    
    <div>
    <input type="submit" name="upload" value="Upload image">
    </div>
    
    
    
    </form>
    
    
    
    
    
    </div>
</body>
</html>