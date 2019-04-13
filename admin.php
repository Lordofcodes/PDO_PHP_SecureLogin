<?php
require 'data.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
        header("location: home.php?error=" . 'Unathorized acces!');
        session_destroy();
        exit();
    }
$conn = DB::getInstance()->getDB();
$stmt = $conn->prepare('SELECT * FROM users');
$stmt->execute();
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
    <?= '<h1> Welcome ' . $_GET['username'] . '!</h1>'; ?>
    <form action="home.php" method='POST'>
        <button type='submi' name='logout'> Logout</button>
    </form>
    <a href="_createuser.php" target="_blank">Create User</a>
    <h2>User Summary</h2>
    <table>
        <tr>
            <th> ID </td>
            <th> Username </td>
            <th> Email </td>
        </tr>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo "<td> <form action='_createuser.php' method='POST'>";
            echo "<button type='submit' value='Edit' name='edit'>Edit</td>";
            echo "<td> <form action='_createuser.php' method='POST'>";
            echo "<button type='submit' value='delete' name='delete'>Delete</td>";
            echo '</tr>';
        }
        ?>

</body>

</html>