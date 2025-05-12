<?php

$fullname=$_POST['fullname'];
$email=$_POST['email'];
$password=$_POST['password'];

$conn = new mysqli('localhost','root','','users');
if ($conn->connect_error){
    die('Connection Failed: '.$conn->connect_error);
}
else{
    $stmt = $conn->prepare("insert into details(fullname, email, password) values(?,?,?)");
    $stmt->bind_param("sss",$fullname,$email,$password);
    if($stmt->execute())
    {
        header("location:login.php");
    }
    else{
        echo "Registration failed";

    }
    
    
    $stmt->close();
    $conn->close();
}

?>
