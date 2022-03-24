<?php

session_start();
    
require_once('models/user.php');
require('controllers/userValidator.php');

$user = new User();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("location: dashboard.php");
    exit;
}

if (isset($_POST['login'])){
    $row = $user->select($_POST);
    if ($row != 0){
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $_POST['username'];                            
        $_SESSION["password"] = $_POST['password'];

        header("location: dashboard.php");
        exit;
    } else {
        echo "<div class='errors'>
                <p>Incorrect email/password.</p>
                <p>".$row."</p>
            </div>";
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('components/head.php'); ?>
    <title>Login</title>
</head>
<body>
<form action=""  method="POST" enctype="multipart/form-data">
    <div class="__container m-auto my-5 border shadow">
        <h3>Login</h3>
        <p>Please fill in your credentials to login.</p>
        <hr>
        
        
        <label for="username">Username</label>
        <input type="text" placeholder=" * Enter Username" name="username" id="username">

        <label for="psw">Password</label>
        <input type="password" placeholder=" * Enter Password" name="password" id="psw">
            
        <input type="submit" name="login" class="registerbtn" value="Login">
        <div class="signin">
            <p>Don't have an account? <a href="register.php">Sign up</a>.</p>
        </div>
    </div>
</form>
</body>
</html>