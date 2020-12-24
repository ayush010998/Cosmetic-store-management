<?php
session_start();
include('conn.php');
$username=$password_1=$cid='';
$errors=array('username'=>'','password_1'=>'');

if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    if(empty($username))
    {
        $errors['username']='username is required';
    }
    else
    {
    $username=$_POST['username'];
    }
    if(empty($password_1))
    {
        $errors['password_1']='password is needed';
    }
    else
    {
        $password_1=$_POST['password_1'];

    }
if(array_filter($errors))
{
    echo 'errors exist';
}
    else
    {
        $password_1=md5($password_1);
    $login_query = "SELECT * FROM customer WHERE username ='$username' AND password_1 ='$password_1' ";
    $result=mysqli_query($conn,$login_query);
    
    if($row=mysqli_fetch_assoc($result))
    {
      session_start();
      $_SESSION['cid']=$row['customer_id'];
      $_SESSION['stid']=$row['store_id'];
      header('Location:demo.php');
        
    }
   else
    {
        $errors['username']='invalid credentials';
    
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
<form action="login.php" method="POST">
<div>
<label>Username :</label>
<input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
</div>
<div>
<label>Password :</label>
<input type="password" name="password_1" value="<?php echo htmlspecialchars($password_1); ?>" required>
</div>

<div>
<label>Log in :</label>
<input type="submit" name="submit">
</div>
<?php echo $errors['username']; ?>
</form>

</main>




        <footer>
    <p>Copyright 2019 Eva</p>
        </footer>
    </div>
</body>

</html>