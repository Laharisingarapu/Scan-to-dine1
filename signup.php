<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <link rel="stylesheet" href="login.css">
    <script src="validate.js"></script>
</head>

<body>
    <div class="main">
        <h1 style="color:black">Sign Up</h1>
        

        <form action="insert.php" method="POST" onsubmit="return validateForm();">
            <p>Please fill in this form to create an account.</p>
            <hr>
            
            <label for="fullname"><b>Name</b></label>
            <input type="text" placeholder="Enter Fullname" id="fullname" name="fullname" required>
            <span id="fullnameError" class="error"></span>
      
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" id="email" name="email" required>
            <span id="emailError" class="error"></span>
      
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" id="password" name="password" required>
            <span id="passwordError" class="error" ></span>
            
            <label for="psw"><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm-password" id="confirm-password" name="confirm-password" required>
      
            <p>Already have an account? <a href="login.php" style="color:dodgerblue">Login</a>.</p>
      
      
              
              <button type="submit" class="btn btn-primary">Sign Up</button>
            
        
        </form>
        
    </div>
    
</body>

</html>