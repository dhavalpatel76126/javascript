<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "todo";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);


  $itemid  = intval($_POST['itemid']);
  
 
 //SQL query to get results from database
 
  $sql = "update listitems set is_completed = 'no' where id = $itemid";

  mysqli_query($conn, $sql);
    
  

  ?>