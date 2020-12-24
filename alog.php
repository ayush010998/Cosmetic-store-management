<?php
include('conn.php');
$rmanager=$password='';
$errors=array('rmanager'=>'','password'=>'');

if(isset($_POST['submit']))
{
    $rmanager = mysqli_real_escape_string($conn, $_POST['rmanager']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(empty($rmanager))
    {
        $errors['rmanager']='manager name is required';
    }
    else
    {
    $rmanager=$_POST['rmanager'];
    }
    if(empty($password))
    {
        $errors['password']='password is needed';
    }
    else
    {
        $password=$_POST['password'];

    }
if(array_filter($errors))
{
    echo 'errors exist';
}
    else
    {
    
    $log_query = "SELECT * FROM region WHERE rmanager ='$rmanager' AND password ='$password'";
    $result=mysqli_query($conn,$log_query);
    
    if(mysqli_num_rows($result))
    {
        
        header('Location:radmin.php');
    }
    else
    {
        $errors['rmanager']='invalid credentials';
    
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
            <a href="adminadd.php">ADMIN</a>
            <a href="login.php">LOG IN</a>
            <a href="mailto:sahanamanjunath1999@gmail.com"?Subject=Queries>CONTACT US</a>
            
    
        </nav>
<main>
<form action="alog.php" method="POST">
<div>
<label>Manager name :</label>
<input type="text" name="rmanager" value="<?php echo htmlspecialchars($rmanager); ?>" required>
</div>
<div>
<label>Password :</label>
<input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
</div>

<div>
<label>Log in :</label>
<input type="submit" name="submit">
</div>
<?php echo $errors['rmanager']; ?>
</form>

</main>




        <footer>
    <p>Copyright 2019 Eva</p>
        </footer>
    </div>
</body>

</html>