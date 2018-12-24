<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_details";

// Create connection


$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$limit = 5;
$start = ($pageno-1) * $limit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  a
  {
      margin: :20px;
  }
  </style>
</head>
<body>

<div class="container col-sm-8">
    <br>
  <table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th>name</th>
        <th>Email</th>
        <th>contact</th>
        <th>technology</th>
        <th>experience</th>
      </tr>
    </thead>
    
        <?php
        $sql = "SELECT * FROM user LIMIT $start,$limit";
$result = mysqli_query($conn, $sql);
        while($row=mysqli_fetch_array($result))
        {?>
           <tbody>
      <tr>
          <td><?= $row['id'] ?></td>
     <td><?= $row['name'] ?></td>
       <td><?=$row['mail']?></td>
       <td><?=$row['contact']?></td>
       <td><?=$row['technology']?></td>
       <td><?=$row['experience']?></td>
    <?php echo "</tr>";
      echo "<tbody>";
      
      }?>
    
  </table>
  <?php
$sql="SELECT count(id) from user";
$id_result = mysqli_query($conn, $sql);
$row_id=mysqli_fetch_array($id_result);
$total_records=$row_id[0];
$total_pages=ceil($total_records/$limit);
$pagLink = "<div class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<a href='index.php?page=".$i."'>".$i."</a>";  
};  
echo $pagLink . "</div>";  

  ?>
</div>

</body>
</html>
