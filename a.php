<?php
session_start();
$storeid=$_SESSION["stid"];
$cid=$_SESSION["cid"];
include('conn.php');




if(isset($_POST['add_to_cart']))
{
    if(isset($_SESSION["shopping_cart"]))
    {
       $item_array_id = array_column($_SESSION["shopping_cart"],"item_id");
       if(!in_array($_GET["pid"],$item_array_id))
       {
           $count=count($_SESSION["shopping_cart"]);
           $item_array=array('item_id'=> $_GET["pid"],'item_name'=> $_POST["hidden_name"],'item_price'=> $_POST["hidden_price"],'item_quantity'=> $_POST["quantity"]);
          $_SESSION["shopping_cart"][$count]=$item_array; 
       }
       else
       {
        echo '<script>alert("item already added")</script>';
        echo '<script>window.location="demo.php"</script>';  

       }
    }
    else
    {
        $item_array=array('item_id'=> $_GET["pid"],'item_name'=> $_POST["hidden_name"],'item_price'=> $_POST["hidden_price"],'item_quantity'=> $_POST["quantity"]);
        $_SESSION["shopping_cart"][0]=$item_array;
    }
   
}
if(isset($_GET["action"]))
{
    if($_GET["action"]=="delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"]==$_GET["pid"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("item removed")</script>';
                echo '<script>window.location="demo.php"</script>';  

                
                
                
            }
        }
    }
}
if(isset($_POST['confirm_order']))
{
    $total=mysqli_real_escape_string($conn,$total);
    $cid=mysqli_real_escape_string($conn,$cid);
    $sql="INSERT INTO order_total(purchase_amt,customer_id) VALUES ($total,$cid)";
   if( $result=mysqli_query($conn,$sql))
   {
       echo 'order confirmed';
   }
   else
   {
       echo 'error';
   }
    
}
if(isset($_POST['logout']))
{
    session_unset();
    header('Location:home.php');
}

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
           
            <a href="mailto:sahanamanjunath1999@gmail.com"?Subject=Queries>CONTACT US</a>
            
    
        </nav>
        <main>
       
      
      
       
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

$query="SELECT p.image,p.pname,p.brand,p.category,p.price,p.pid FROM products p,stock s WHERE p.pid=s.pid and s.stock!=0 and s.store_id='$storeid'";

$query_run = mysqli_query($conn,$query);

while($row = mysqli_fetch_array($query_run))
{
    ?>
 <form action="demo.php?action=add&pid=<?php echo $row['pid']; ?>" method="POST" enctype="multipart/form-data">

    <tr>
    <td><?php  echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="image" style="width: 100px; height: 100px;">'; ?></td>
    <td> <?php echo $row['pname'] ; ?></td>
    <td><?php echo $row['brand'] ; ?></td>
    <td><?php echo $row['category'] ; ?></td>
    <td> <?php echo $row['price'] ; ?></td>
    <td><input type="text" name="quantity" value="1"/></td>
    <input type="hidden" name="hidden_name" value="<?php echo $row['pname']; ?>"/>
    <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>"/>
    <td><input type="submit" name="add_to_cart" value="add to cart"></td>
    </tr>
   
</form>
 

</div> 

<?php
}
?>
</table>
  

       <h1>order details</h1>
       <table>
       <tr>
       <th width="40%">item name</th>
       <th width="10%">quantity</th>
       <th width="20%">price</th>
       <th width="15%">total</th>
       <th width="5%">action</th>
       
       
       </tr>
       
       <?php
          if(!empty($_SESSION["shopping_cart"]))
          {
              $total=0;
              foreach($_SESSION["shopping_cart"] as $keys => $values)
              {
                  ?>
                  <tr>
                  <td><?php echo $values["item_name"]; ?></td>
                  <td><?php echo $values["item_quantity"]; ?></td>
                  <td><?php echo $values["item_price"]; ?></td>
                  <td><?php echo number_format($values["item_quantity"]*$values["item_price"],2); ?></td>
                  <td><a href="demo.php?action=delete&pid=<?php echo $values["item_id"]; ?>"><span>remove</span></a></td>
                  </tr>
                  <?php

                  $total=$total+($values["item_quantity"]*$values["item_price"]);
              }
              ?>
              <tr>
              <td>total</td>
              <td><?php echo number_format($total,2); ?></td>
              
              <input type="submit" class="button" name="confirm_order" value="confirm order">
              
              </tr>
            
              <?php
          }
       ?>
       </table>
       <form action="demo.php" method="POST">
      
       <input type="submit" name="logout" value="log out">
       
       </form>

        <footer>
    <p>Copyright 2019 Eva</p>
        </footer>
    
</body>

</html>