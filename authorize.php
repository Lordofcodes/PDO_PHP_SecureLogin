<?php
session_start();
require 'data.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    //validation 
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: home.php?error=Pleaes enter correct email!");

    }


    if($email == $admin['email'] && $password ==$admin['password']){
        $_SESSION['role'] = 'admin';
        header("Location: admin.php?role=".$_SESSION['role']);
    }
    else if($email == $user['email'] && $password ==$user['password']){
        $_SESSION['role'] = 'user';
        header("Location: user.php?role=".$_SESSION['role']);
    }
    else{       
        header("Location: home.php?error=User not found!&email=".$email);
    }
}

