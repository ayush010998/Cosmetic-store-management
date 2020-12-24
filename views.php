<?php
session_start();
$sid=$_SESSION["sid"];



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
    <table>
    <tr>
    
    <th width="20%">Product Id:</th>
    <th width="20%">Stock:</th>
    </tr>
    <?php
    include('conn.php');
    $sid=mysqli_real_escape_string($conn,$sid);
    $sql="SELECT s.pid,s.stock-sum(o.quantity) as new_stock FROM stock s,order_detail o,order_total ot,customer c WHERE s.pid=o.pid AND c.store_id=s.store_id AND ot.customer_id=c.customer_id AND ot.order_id=o.order_id AND s.stock!=0 AND s.store_id='$sid' GROUP BY o.pid";
    $result=mysqli_query($conn,$sql);
    
    while($row=mysqli_fetch_array($result))
    { ?>
    <tr>
    
    <td width="20%"><?php echo $row['pid']; ?></td>
    <td width="20%"><?php echo $row['new_stock']; ?></td>
    </tr>
   


  <?php  } ?>

  </table>
  
    

</body>
</html>