<?php
session_start();
echo "Welcome";
echo $_SESSION['$username'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BEAUTIFY ME</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>

    <div class="container">
        <header>
    <img src = "images/las.jpg" alt="logo for royal orchid">
        </header>
        <nav>
            <a href="home.php">HOME</a>
            <a href="#">CATEGORY</a>
            <a href="alog.php">ADMIN</a>
            <a href="login.php">LOG OUT</a>
            <a href="mailto:sahanamanjunath1999@gmail.com"?Subject=Queries>CONTACT US</a>
            
    
        </nav>
        <main>
       
      
       <form action="products.php" method="POST" enctype="multipart/form-data">
       
<table>
<thead>
<tr>
<th>IMAGE</th>
<th>PRODUCT NAME</th>
<th>BRAND</th>
<th>CATEGORY</th>
<th>PRICE</th>
<th>QUANTITY</th>
<th>PLACE ORDER</th>



</tr>
</thead>

<?php

include("conn.php");
$query = "SELECT image,pname,brand,category,price,pid FROM `products` ";
$query_run = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($query_run))
{
    ?>
    <tr>
    <td><?php  echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="image" style="width: 100px; height: 100px;">'; ?></td>
    <td> <?php echo $row['pname'] ; ?></td>
    <td><?php echo $row['brand'] ; ?></td>
    <td><?php echo $row['category'] ; ?></td>
    <td> <?php echo $row['price'] ; ?></td>
    <td><input type="quantity" name="quantity" value="1"></td>
    <td><input type="submit" name="add_to_cart" value="add to cart"></td>
    </tr>


       


<?php
}
?>
</table>
</div> 
       </form>

        <footer>
    <p>Copyright 2019 Eva</p>
        </footer>
    
</body>

</html>