<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "todo";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);


  $itemid  = intval($_POST['itemid']);
  
 
 
  $sql = "update listitems set is_completed = 'yes' where id = $itemid";

  mysqli_query($conn, $sql);



  ?>