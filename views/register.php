<?php

require_once('models/user.php');
require('controllers/userValidator.php');

$user = new User();

if (isset($_POST['register'])){
    $validForm = new UserValidator($_POST); 
    $err = $validForm->validation();
}

if($_POST){
    if ($_POST['password'] === $_POST['psw_conf']){
        $user->insert($_POST);

        header("Location: login.php"); 
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('components/head.php'); ?>
    <title>Register</title>
</head>
<body>
<form action=""  method="POST" enctype="multipart/form-data">
    <div class="__container m-auto my-5 border shadow">
        <h3>Register</h3>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="username">User Name</label>
        <input type="text" placeholder=" * Enter Name" name="username" id="username">
            <div class="errors">
                <?php 
                    if(isset($_POST['username'])) {
                        echo $err['username'] ?? '';
                    }
                ?>
            </div>
        
        <label for="email">Email</label>
        <input type="text" placeholder=" * Enter Email" name="email" id="email">
            <div class="errors">
                <?php 
                    if(isset($_POST['email'])){
                        echo $err['email'] ?? '';
                    }
                ?>
            </div>

        <label for="psw">Password</label>
        <input type="password" placeholder=" * Enter Password" name="password" id="psw">
            <div class="errors">
                <?php 
                    if(isset($_POST['password'])){
                        echo $err['password'] ?? '';
                    }
                ?>
            </div>

        <label for="psw_conf">Confirm Password</label>
        <input type="password" placeholder=" * Confirm Password" name="psw_conf" id="psw_conf">
            <div class="errors">
            <?php
                if (isset($_POST['psw_conf']) && !empty($_POST['psw_conf'])){
                    if($_POST['psw_conf'] !== $_POST['password']){
                        echo "Does not match password !";
                    }
                }
            ?>
            </div>
        <hr>

        <p>By creating an account you agree to our <a href="">Terms & Privacy</a>.</p>
        <input type="submit" name="register" class="registerbtn" value="Register">
        
        <div class="signin">
            <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
    </div>
</form>

</body>
</html>