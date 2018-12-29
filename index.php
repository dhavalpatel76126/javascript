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
$limit = 10;
if (isset($_GET['limit'])) {
    $limit = $_GET["limit"];
    echo "limit number===>" . $limit . "<br>";
}
$pn = 1;
if (isset($_GET["page"])) {
    $pn = $_GET["page"];
    echo "page number===>" . $pn . "<br>";
}

$start_from = ($pn - 1) * $limit;
echo "start from ==>" . $start_from . "<br>";

$sortBy = "id";
if (isset($_GET["sortBy"])) {
    $sortBy = $_GET["sortBy"];
    echo "sortBy ===>" . $sortBy . "<br>";
}
$sortType = "ASC";
if (isset($_GET["sortType"])) {
    $sortType = $_GET["sortType"];
    echo "sortType ===>" . $sortType . "<br>";
}

$search="";
$qrySearch = "";
if (isset($_GET["search"])) {
    $search = $_GET["search"];
	echo "search ===>" . $search . "<br>";
	
	$qrySearch = "WHERE 
	`id` LIKE '%".$search."%'  OR 
	`name` LIKE '%".$search."%' OR 
	`mail` LIKE '%".$search."%' OR 
	`contact` LIKE '%".$search."%' OR 
	`technology` LIKE '%".$search."%' OR 
	`experience` LIKE '%".$search."%'";


	/*$qrySearch = "WHERE 
	`name` LIKE '%vls%' OR `mail` LIKE '%v@gmail.com%'";*/
}


$sql = "SELECT * FROM user $qrySearch 
ORDER BY $sortBy $sortType  LIMIT $start_from, $limit";

echo $sql;
$rs_result = mysqli_query($conn, $sql);
$totalPage = "SELECT COUNT(*) FROM user";
$rs_result1 = mysqli_query($conn, $totalPage);
$row1 = mysqli_fetch_row($rs_result1);
$total_records1 = $row1[0];
$total_pages1 = ceil($total_records1 / $limit);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<script type="text/javascript">
		function onLimitChange(mylimitsel) {
			// alert();
			//window.location.href = "?page=8&limit=8&sortBy=id&sortType=ASC";
		window.location.href = '?page=<?=$pn?>&limit='+mylimitsel.value+'&sortBy=<?=$sortBy?>&sortType=<?=$sortType?>';
			//console.log(window.location.href);
	}

	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<div class="container">
	<br>
	<div>

	<div class="form-group col-sm-2">
  <label for="sel1">Select list:</label>
  <select class="form-control" id="sel1" name="limit" onchange="onLimitChange(this)">
	  <?php 
	  for ($k = 2; $k <= 10; $k++) {
		  $selected = "";
		  if($limit == $k) {
			$selected = "selected";
		  }
	  ?>
		
   <option <?=$selected?>><?=$k?></option>
      <?php
}?>

  </select>


</div>
<form action="index.php" method="GET">
    <input type="text" name="search" />
    <input type="submit" value="Search" />
</form>
<!--<input type="text" name="search" id="myInput" />
<input type="submit" onclick="searchFunction(this)">
<script type="text/javascript">
function searchFunction(searchValue)
{
//alert("dd");
var href1=window.location.href='?page=<?=$pn?>&sortBy=<?=$sortBy?>&search='+searchValue.value+'';
//var href1=window.location.href='?search=<?=$search?>';
console.log(href1);
}
</script>-->

	<table class="table table-striped table-condensed table-bordered" id="tableData">

		<thead>
		<tr>
		<th><a href="index.php?sortBy=id&sortType=<?php if($_GET["sortBy"] == "id" && $_GET["sortType"] == "ASC"){echo "DESC";}	else{ echo "ASC";}?>">ID</th>
		<th><a href="index.php?sortBy=name&sortType=<?php if($_GET["sortBy"] == "name" && $_GET["sortType"] == "ASC"){echo "DESC";}	else{ echo "ASC";}?>">NAME</th>
		<th><a href="index.php?sortBy=mail&sortType=<?php if($_GET["sortBy"] == "mail" && $_GET["sortType"] == "ASC"){echo "DESC";}	else{ echo "ASC";}?>">MAIL</th>
		<th><a href="index.php?sortBy=contact&sortType=<?php if($_GET["sortBy"] == "contact" && $_GET["sortType"] == "ASC"){echo "DESC";}	else{ echo "ASC";}?>">CONTACT</th>
		<th><a href="index.php?sortBy=technology&sortType=<?php if($_GET["sortBy"] == "technology" && $_GET["sortType"] == "ASC"){echo "DESC";}	else{ echo "ASC";}?>">technology</th>
		<th><a href="index.php?sortBy=experience&sortType=<?php if($_GET["sortBy"] == "experience" && $_GET["sortType"] == "ASC"){echo "DESC";}	else{ echo "ASC";}?>">experience</th>
		</tr>
		</thead>
		<tbody id="myTable">
		<?php
		while ($row = mysqli_fetch_array($rs_result)) {
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
};
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
    <li><a href='index.php?page=<?=$i?>&limit=<?=$limit?>&sortBy=<?=$sortBy?>&sortType=<?=$sortType?>'><?=$i?></a></li>
<?php

}
;
?>
	</ul>
	</div>
</div>
</body>
</html>
