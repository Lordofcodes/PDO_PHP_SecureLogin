
<?php
session_start();
echo "<h1> Welcome ".$_GET['username']."</h1>";

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