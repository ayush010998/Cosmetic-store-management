<?php

include('conn.php');
$sql="CALL `viewcurrentstock`();";
$result=mysqli_query($conn,$sql);



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
    <th width="10%">Store Id:</th>
    <th width="20%">Product Id:</th>
    <th width="20%">New Stock:</th>
    </tr>
    <?php while($row=mysqli_fetch_array($result))
    { ?>
    <tr>
    <td width="10%"><?php echo $row['store_id']; ?></td>
    <td width="20%"><?php echo $row['pid']; ?></td>
    <td width="20%"><?php echo $row['new_stock']; ?></td>
    </tr>
   


  <?php  } ?>

  </table>
  
    

</body>
</html>