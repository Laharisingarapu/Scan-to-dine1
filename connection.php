<?php
error_reporting(0);
$hostname='localhost';
$username='root';
$password='';
$dbname='users';

$conn=mysqli_connect($hostname,$username,$password,$dbname);
if($conn)
{
    //echo "connection ok";
}
else{
    echo "connection failed".mysqli_connect_error();
}
?>