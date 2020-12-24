<?php

session_start();
include('conn.php');

if(isset($_POST['add_to_cart']))
{
    if(isset($_SESSION['shopping_cart']))
    {
      $item_array_id= array_column($_SESSION['shopping_cart'],'item_id');
      if(!in_array($_GET['pid'],$item_array_id))
      {
          $count = count($_SESSION['shopping_cart']);
          $item_array = array(
            'item_id' => $_GET['pid'],
            'item_name' => $_POST['hidden_name'],
            'item_price' => $_POST['hidden_price'],
            'item_quantity' => $_POST['quantity],
        );
        $_SESSION['shopping_cart'][$count] = $item_array;



      }
      else
      {
          echo '<script>alert("item already added")</script>';
          echo '<script>window.location="products.php"</script>';
      }
    }
    else
    {
        $item_array = array(
            'item_id' => $_GET['pid'],
            'item_name' => $_POST['hidden_name'];
            'item_price' => $_POST['hidden_price'];
            'item_quantity' => $_POST['quantity];
        );
        $_SESSION['shopping_cart'][0]=$item_array;
    }
}
if(isset($_GET['action']))
{
    if($_GET["action"]=="delete")
    {
        foreach($_SESSION['shopping_cart'] as $keys => $values)
        {
            if($values["item_id"]==$_GET['pid'])
            {
                unset($_SESSION['shopping_cart'][$keys]);
                echo '<script>alert("item already added")</script>';
          echo '<script>window.location="products.php"</script>';
      
            }
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
    <h1>order details</h1>
    <div>
    <table>
    <tr>
    <th width="40%">Item name</th>
    <th width="10%">Quantity</th>
    <th width="20%">Price</th>
    <th width="15%">Total</th>
    <th width="5%">Action</th>
     </tr>
    <?php
    if(!empty($_SESSION['shopping_cart']))
    {
        $total = 0;
        foreach($_SESSION['shopping_cart'] as $keys => $values)
        {
            ?>
            <tr>
            <td><?php echo $values['item_name']; ?></td>
            <td><?php echo $values['quantity']; ?></td>
            <td>Rs. <?php echo $values['item_price']; ?></td>
            <td><?php echo number_format($values["item_quantity"] * $values["item_price"],2); ?></td>
            <td><a href="products.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span>Remove</span></a></td>
            </tr>
            <?php
            $total = $total + ($values["item_quantity"] * $values["item_price"]);
    }
    ?>
    
    

    </table>
    </div>
<?php
    }
    ?>




</body>
</html>