<?php
session_start();
include('conn.php');
$username=$email=$address=$phone=$password_1=$password_2=$store1=$smid='';
$errors=array('username'=>'','email'=>'','address'=>'','phone'=>'','password_1'=>'','password_2'=>'','store1'=>'');




if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    
    
    $email=$_POST['email'];
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
      $errors['email'] = 'enter a valid email'.'<br/>';
    }
    $address=$_POST['address'];
    $phone=$_POST['phone'];
    $store1=$_POST['store1'];
    $fkcheck="SELECT * FROM store WHERE store_id ='$store1'";
    $result1=mysqli_query($conn,$fkcheck);
    $match=mysqli_fetch_assoc($result1);
    if(!$match)
    {
        $errors['store1']='please enter a valid store id check the capital letters';
        echo 'error  fk';
    }

    $password_1=$_POST['password_1'];
    $password_2=$_POST['password_2'];
    if($password_1 != $password_2)
    {
        $errors['password_1']='passwords do not match';
    }
    $user_check_query = "SELECT * FROM customer WHERE username = '$username' or email = '$email' LIMIT 1";
$result = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($result);

if($user){
    $errors['username']='username already exists';
    $errors['email']='email id already exists';
}
if(array_filter($errors))
{
    echo 'errors in the form';
}
else
{

    $sale_query="SELECT s.salesman_id
    FROM salesman s
    WHERE s.store_id='$store1'
    GROUP BY s.salesman_id
    HAVING COUNT(*)<=1
    ORDER BY s.sname";
    $results=mysqli_query($conn,$sale_query);
    $assign=mysqli_fetch_assoc($results);
    if(!empty($assign))
    {
    $smid=$assign['salesman_id'];
    
    }
    
    $spid=mysqli_real_escape_string($conn,$smid);
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $store1=mysqli_real_escape_string($conn,$_POST['store1']);
    $password_1=mysqli_real_escape_string($conn,$_POST['password_1']);
    $password_1 = md5($password_1);
    


    $sql= "INSERT INTO customer(username,email,address,phone,store_id,salesman_id,password_1) VALUES ('$username','$email','$address','$phone','$store1','$spid','$password_1')";

    if(mysqli_query($conn,$sql))
    {
        
        header('Location:login.php');
    }
    else
    {
        echo 'query error'.mysqli_error();
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
    <title>BEAUTIFY ME</title>
    <link rel="stylesheet" href="style.css">
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
            <a href="login.php">LOG IN</a>
            <a href="mailto:sahanamanjunath1999@gmail.com"?Subject=Queries>CONTACT US</a>
            
    
        </nav>
<main>

<div class="container">
        <div class="header">
<h2>REGISTER</h2>
</div>
<section class="container grey-text">
<form class="white " action="registration.php" method="POST">
   

  <div>
      <label for="username">Username         :</label>
      <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" required>
      <div class="red-text"><?php echo $errors['username']; ?></div>
  </div>

  <div>
    <label for="email">Email            :</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email) ?>"  required>
    <div class="red-text"><?php echo $errors['email']; ?></div>
</div>
<div>
    <label for="address">Address         :</label>
    <input type="address" name="address" value="<?php echo htmlspecialchars($address) ?>"  required>
</div>
<div>
    <label for="phone">Contact number   :</label>
    <input type="phone" name="phone" value="<?php echo htmlspecialchars($phone) ?>" required>
</div>

<div>
    <label for="password">Password         :</label>
    <input type="password" name="password_1" value="<?php echo htmlspecialchars($username) ?>"  required>
</div>


<div>
    <label for="password">Confirm Password :</label>
    <input type="password" name="password_2" value="<?php echo htmlspecialchars($username) ?>" required>
<?php echo $errors['password_1']; ?>
<div>
<label for="store">Type your nearest store_id:</label>
<input type="store" name="store1" value="<?php echo htmlspecialchars($store1);?>">
<div class="red-text"><?php echo $errors['store1']; ?></div>

</div>


<div class="center">
<label> Submit:</label>`
<input type="submit" name="submit" class="btn brand z-depth-0">

</div>


</form>
</section>
</div>
<div>
<table>
<thead>
<tr>
<th>Store_id</th>
<th>Store name</th>
<th>Address</th>



</tr>


</thead>
<?php
 include('conn.php');
                $sql="SELECT store_id,storename,address FROM store";
                $result=mysqli_query($conn,$sql);
                
                while($stores=mysqli_fetch_array($result))
                {?>
                <tr>
                   <td><?php echo $stores['store_id']; ?></td> 
                   <td><?php echo $stores['storename']; ?></td> 
                   <td><?php echo $stores['address']; ?></td>
                 


                   </tr> 
                    
              <?php  }
                ?>
</table>

</div>



</main>


        <footer>
    <p>Copyright 2019 Eva</p>
        </footer>
    </div>
</body>

</html>