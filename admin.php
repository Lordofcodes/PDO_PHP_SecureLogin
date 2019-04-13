
<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    header("location: home.php?error=" . 'Unathorized acces!');
    session_destroy();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?= '<h1> Welcome '.$_GET['username'].'!</h1>';?>
    <form action="home.php" method = 'POST'>
    <button type = 'submi' name='logout'> Logout</button>
    </form>
</body>
</html>