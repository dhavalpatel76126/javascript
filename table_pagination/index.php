<?php
// Define needed credentials.
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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<?php


$limit=$_GET['limit'];
$pn = 1;
if (isset($_GET["page"])) {
    $pn = $_GET["page"];
    echo "page number===>" . $pn . "<br>";
}

$start_from = ($pn - 1) * $limit;
echo "start from ==>" . $start_from . "<br>";
$sql = "SELECT * FROM user LIMIT $start_from, $limit";
echo $sql;
$rs_result = mysqli_query($conn, $sql);

$totalPage = "SELECT COUNT(*) FROM user";
$rs_result1 = mysqli_query($conn, $totalPage);
$row1 = mysqli_fetch_row($rs_result1);
$total_records1 = $row1[0];
$total_pages1 = ceil($total_records1 / $limit);



?>
<div class="container">
	<br>
	<div>

	<div class="form-group col-sm-2">
  <label for="sel1">Select list:</label>
  <form method=get action=index.php>
	
  <select class="form-control" id="sel1" name="limit" onchange="handleSelect(this)" >
      <?php for ($k = 5; $k <= 10; $k++) {?>
  
	   <?php 
	   if($k>=5){ 
		   ?>
		    <option selected>
			
	   <?php 
	  echo $k;
	}
	   else{
		
	   }
	  
	   ?>
	   
	</option>
      <?php
}?>
	 <script type="text/javascript">
	//  var page = <?=$pn?>;
function handleSelect(elm)
{

//window.location = 'index.php?limit='+"<?php $k?>";
//console.log(page);
}
</script>
  </select>
  <input type=submit value=GO>
</div>
	<table class="table table-striped table-condensed table-bordered">
		<thead>
		<tr>
		<th width="10%">id</th>
		<th>Name</th>
		<th>mail</th>
        <th>contact</th>
        <th>technology</th>
        <th>experience</th>
		</tr>
		</thead>
		<tbody>
		<?php
while ($row = mysqli_fetch_array($rs_result)) {
	$limit = 10;
    ?>
		<tr>
		<td><?=$row['id']?></td>
		<td><?=$row['name']?></td>
		<td><?=$row['mail']?></td>
        <td><?=$row['contact']?></td>
        <td><?=$row['technology']?></td>
        <td><?=$row['experience']?></td>
		</tr>
		<?php
}
;
?>
		</tbody>
	</table>
	<ul class="pagination">
	<?php
$sql = "SELECT COUNT(*) FROM user";
$rs_result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
echo $total_records;
$total_pages = ceil($total_records / $limit);
$pagLink = "";
for ($i = 1; $i <= $total_pages; $i++) {
    ?>
    <li><a href='index.php?page=<?=$i?>&limit=<?=$limit?>'><?=$i?></a></li>
<?php

};
?>
	</ul>
	</div>
</div>
</body>
</html>
