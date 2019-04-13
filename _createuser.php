<?php
require 'data.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
        header("location: home.php?error=" . 'Unathorized acces!');
        session_destroy();
        exit();
    }
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    if(!isset($username) || trim($username) == ''){
        header("Location: _createuser.php?error=Username required!");
        exit();
    }
    if(!isset($email) || trim($email) == ''){
        header("Location: _createuser.php?error=Email required!");
        exit();
    }
    else if(!isset($password) || trim($password) == ''){
        header("Location: _createuser.php?email=".$email."&error=Password required!");
        exit();
    } 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: _createuser.php?error=Pleaes enter correct email!");
        exit();
    }

    $conn = DB::getInstance()->getDB();
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :mail');
    $stmt->execute(['mail' => $_POST['email']]);
    if ($row = $stmt->fetch()) {
        header("Location: _createuser.php?error=User already exists!");
    } else {
        $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (:uname, :mail, :pwd)');
        $stmt->execute([
            'uname' => $_POST['username'],
            'mail' => $_POST['email'],
            'pwd' => $_POST['password'],
        ]);
    }
    header("Location: _createuser.php?success= User created successfuly!");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .error {
            text-weight: bold;
            color: red;
        }

        .success {
            text-weight: bold;
            color: green;
        }
    </style>
</head>

<body>
    <h1>Create User</h1>
    <div><?php if (isset($_GET['error'])) {
                echo '<p class="error">' . $_GET['error'] . '</p>';
            }
            if (isset($_GET['success'])) {
                echo '<p class="success">' . $_GET['success'] . '</p>';
            }

            ?></div>
    <form action="_createuser.php" method='POST'>
        Username:
        <input type="text" name="username">
        Email:
        <input type="text" name="email">
        Password:
        <input type="password" name="password">
        <button type='Submit' name='create'>Create User</button>
    </form>

</body>

</html>