<?php
include('conn.php');
if(isset($_POST['upload']))
{
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $query = "INSERT INTO `products`(`image`,`pid`,`pname`,`brand`,`category`,`price`) VALUES ('$file','$pid','$pname','$brand','$category','$price')";
    $query_run=mysqli_query($conn,$query);
    if($query_run)
    {
        echo '<script type="text/javascript"> alert("image prof uploaded") </script>';
    }
    else
    {
        echo '<script type="text/javascript"> alert("image prof not uploaded") </script>';
    }
}
?>
<html>
<head>
<title>upload image</title>
</head>
<body>

<center>

<h1>ADD AN ITEM</h1>
<form action="adminadd.php" method="POST" enctype="multipart/form-data">

<label>Insert image:</label>
<input type="file" name="image" id="image" /><br>

<label>Product id:</label>
<input type="text" name="pid" placeholder="enter your product id" /><br>

<label>Product name:</label>
<input type="text" name="pname" placeholder="enter your product name" /><br>

<label>Brand:</label>
<input type="text" name="brand" placeholder="enter brand" /><br>

<label>Category:</label>
<input type="text" name="category" placeholder="enter category" /><br>

<label>Price</label>
<input type="number" name="price" placeholder="enter price" /><br>

<input type="submit" name="upload" value="Upload image/data" /><br>

</form>

</center>    

</body>

</html>