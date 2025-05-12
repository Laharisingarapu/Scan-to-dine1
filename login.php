<?php
session_start();
require 'config.php';
include("connection.php");
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    $query = "SELECT * FROM details WHERE email='$email' && password='$pwd'";
    $data = mysqli_query($conn,$query);
    $total = mysqli_num_rows($data);

    if($total == 1) {
        $_SESSION['email'] = $email;
        header('location:menu3.php');
    } else {
        echo "<script>alert('Login Failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>HTML Login Form</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="main">
        
        <?php if (isset($login_error)): ?>
            <div class="alert alert-danger"><?= $login_error ?></div>
        <?php endif; ?>

        
        
        <h3>User Login</h3>
        <form action="#" method="POST">
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" 
                placeholder="Enter your Password" required>
            <div class="forgetpass">
                <a href="#" class="link" onclick="message()">Forgot password?</a>
            </div>

            <div class="wrap">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </div>
        </form>
        
        <p>Don't have an Account?
            <a href="signup.php" style="text-decoration: none;">Register Now</a>
        </p>
    </div>
    
    <script>
    function message() {
        alert("Please contact admin for password reset");
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


