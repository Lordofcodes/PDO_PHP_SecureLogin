<h2>Welcome as an user</h2>
<?php
session_start();

 if(isset($_SESSION['role']) && $_SESSION['role'] == 'user')
 {
    echo "<form action='home.php' method='POST'>";
    echo "<button type='submit' name='logout'>Logout</button>";
    echo "</form>";
 }
else {
    header("location: home.php?error=" . 'Unathorized acces!');
    session_destroy();
    exit();
} 