<?php
include('conn.php');
$smanager=$password='';
$errors=array('smanager'=>'','password'=>'');

if(isset($_POST['submit']))
{
    $smanager = mysqli_real_escape_string($conn, $_POST['smanager']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(empty($smanager))
    {
        $errors['smanager']='manager name is required';
    }
    else
    {
    $smanager=$_POST['smanager'];
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
    
    $log_query = "SELECT * FROM store WHERE smanager ='$smanager' AND password ='$password'";
    $result=mysqli_query($conn,$log_query);
    
    if($row=mysqli_fetch_assoc($result))
    {
        session_start();
        $_SESSION['sid']=$row['store_id'];
        header('Location:sadmin.php');
    }
    else
    {
        $errors['smanager']='invalid credentials';
    
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
<form action="storelogin.php" method="POST">
<div>
<label>Manager name :</label>
<input type="text" name="smanager" value="<?php echo htmlspecialchars($smanager); ?>" required>
</div>
<div>
<label>Password :</label>
<input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
</div>

<div>
<label>Log in :</label>
<input type="submit" name="submit">
</div>
<?php echo $errors['smanager']; ?>
</form>

</main>




        <footer>
    <p>Copyright 2019 Eva</p>
        </footer>
    </div>
</body>

</html>