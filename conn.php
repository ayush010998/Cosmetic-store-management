<?php
$conn=mysqli_connect('localhost','root','','cosmo_db');
if(!$conn)
{
    echo 'connection error'. sqli_connect_error();
}
?>