<?php
include('conn.php');
$sql2="SELECT * FROM order_total WHERE customer_id='2' ORDER BY order_date DESC";
$result=mysqli_query($conn,$sql2);
$oid1=mysqli_fetch_assoc($result);
echo $oid1['order_id'];
?>
