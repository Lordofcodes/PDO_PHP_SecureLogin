<?php
session_start();
require 'data.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    //validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: home.php?error=Pleaes enter correct email!");
    }
    //authorization 

    // fetching DATA
    $conn = DB::getInstance()->getDB();
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $_POST ['email']);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        if ($email == $row['email'] && $password == $row['password'] && $row['role']=='admin'){

            $_SESSION['role'] = $row['role'];
            header("Location: admin.php?username=".$row['username']);
        }
        else if($email == $row['email'] && $password == $row['password'] && $row['role'] == 'user'){

            $_SESSION['role'] = $row['role'];
            header ("Location: user.php?username=".$row['username']);
            } 
    }
    else {
        header("Location: home.php?error=User not found!&email=" . $email);
    }
}