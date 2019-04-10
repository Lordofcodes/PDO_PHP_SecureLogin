<h2>Welcome as an user</h2>
<?php
session_start();
require 'data.php';
if($_GET['role']!=$user['role'] || !isset($_SESSION['role'])){
    header("location: home.php?error=".'Unathorized acces!');
    session_destroy();
}
else{
  echo "<form action='home.php' method='POST'>";
  echo "<button type='submit' name='logout'>Logout</button>";
  echo "</form>";
}


?>