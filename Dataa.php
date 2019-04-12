<?php


$con = mysqli_connect("localhost", "root", "", "slogin");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
      echo "connected";
  }
   
  $data = [];
  $sql = "SELECT * FROM users";
  $result=mysqli_query($con, $sql);

  while ($row=mysqli_fetch_object($result)) {
      array_push($data, $row);
  }

   var_dump($data[0]);

?>



