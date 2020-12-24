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
    $sql="SELECT pid,stock FROM stock WHERE store_id='$sid'";
    $result=mysqli_query($conn,$sql);
    
    while($row=mysqli_fetch_array($result))
    { ?>
    <tr>
    
    <td width="20%"><?php echo $row['pid']; ?></td>
    <td width="20%"><?php echo $row['stock']; ?></td>
    </tr>
   


  <?php  } ?>

  </table>
  
    

</body>
</html>