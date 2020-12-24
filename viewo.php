<?php

session_start();
$sid = $_SESSION['sid'];

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
    <th width="5%">Order Id:</th>
    <th width="20%">Order date:</th>
    <th width="20%">Purchase amount:</th>
    <th width=25%>Customer name:</th>
    <th width="10%">Salesman Id:</th>
    </tr>
 <?php include('conn.php');
    $sid=mysqli_real_escape_string($conn,$sid);
    $sql="SELECT o.order_id,o.order_date,o.purchase_amt,c.username,c.salesman_id FROM order_total o,customer c WHERE o.customer_id=c.customer_id AND c.store_id='$sid'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result))
    
    {
        ?>
        <tr>
        <td width="10%"><?php echo $row['order_id']; ?></td>
        <td width="20%"><?php echo $row['order_date']; ?></td>
        <td width="20%"><?php echo $row['purchase_amt']; ?></td>
        <td width="25%"><?php echo $row['username']; ?></td>
        <td width="10%"><?php echo $row['salesman_id']; ?></td>
        </tr>
 <?php  } ?>
    
    
    
    
    </table>
</body>
</html>