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

$search = "";
$qrySearch = "";
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    echo "search ===>" . $search . "<br>";

    $qrySearch = "WHERE
	`id` LIKE '%" . $search . "%'  OR
	`name` LIKE '%" . $search . "%' OR
	`mail` LIKE '%" . $search . "%' OR
	`contact` LIKE '%" . $search . "%' OR
	`technology` LIKE '%" . $search . "%' OR
	`experience` LIKE '%" . $search . "%'";

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
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
<script type="text/javascript">
	
	var pages='<?=$pn?>';

	var sortb='<?=$sortBy?>';
	var sorttpe='<?=$sortType?>';
	var searchpage='<?=$search?>';
	var limit='<?=$limit?>';

	function hreffunction()
	{
		window.location.href='?page='+pages+'&limit='+limit+'&sortBy='+sortb+'&sortType=+'sorttpe'+&search='+searchpage+'';
		
	}
	

	function onLimitChange(mylimitsel) {
			// alert();
			//window.location.href = "?page=8&limit=8&sortBy=id&sortType=ASC";
		window.location.href = '?page=<?=$pn?>&search=<?=$search?>&limit='+mylimitsel.value+'&sortBy=<?=$sortBy?>&sortType=<?=$sortType?>';
			//console.log(window.location.href);
	}
	function searchelement(){
	//var  = document.getElementById("search").value;
	//console.log(searchelememnt);
	//window.location.href='?page=<?=$pn?>&limit=<?=$limit?>&sortBy=<?=$sortBy?>&sortType=<?=$sortType?>&search='+searchelememnt+'';
	//hreffunction();
	alert("s");
	} 
</script>

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
    if ($limit == $k) {
        $selected = "selected";
    }
    ?>

   <option <?=$selected?>><?=$k?></option>
      <?php
}?>

  </select>
</div>

<input type="text" name="search" <?php if ($search == "") {?>value=""<?} else {?>value=<?php echo $search;} ?> id="search" />
    <input type="submit" value="Search" onclick="searchelement()"/>


	<table class="table table-striped table-condensed table-bordered" id="tableData">

		<thead>
		<tr>
		<th><a href="index.php?
		limit=<?php echo $limit ?>
		&page=<?php echo $pn ?>&search=<?=$search?>&sortBy=id&sortType=<?php if ($_GET["sortBy"] == "id" && $_GET["sortType"] == "ASC") {echo "DESC";?>


		<?} else {?>

		<?echo "ASC";} ?>">

		ID <?php if ($sortType == "ASC" && $sortBy == "id") {?>
			<i class='fa fa-arrow-up'>
			<?php } else if ($sortType == "DESC" && $sortBy == "id") {?>
			<i class='fa fa-arrow-down'>
			<?php }?></a></th>

		<th><a href="index.php?limit=<?=$limit?>&page=<?=$pn?>&search=<?=$search?>&sortBy=name&sortType=<?php if ($_GET["sortBy"] == "name" && $_GET["sortType"] == "ASC") {echo "DESC";} else {echo "ASC";}?>">NAME
		<?php if ($sortType == "ASC" && $sortBy == "name") {?>
			<i class='fa fa-arrow-up'>
			<?php } else if ($sortType == "DESC" && $sortBy == "name") {?>
			<i class='fa fa-arrow-down'>
			<?php }?></a></th>

		<th><a href="index.php?limit=<?=$limit?>&page=<?=$pn?>&search=<?=$search?>&sortBy=mail&sortType=<?php if ($_GET["sortBy"] == "mail" && $_GET["sortType"] == "ASC") {echo "DESC";} else {echo "ASC";}?>">MAIL
		<?php if ($sortType == "ASC" && $sortBy == "mail") {?>
			<i class='fa fa-arrow-up'>
			<?php } else if ($sortType == "DESC" && $sortBy == "mail") {?>
			<i class='fa fa-arrow-down'>
			<?php }?></a></th>

		<th><a href="index.php?limit=<?=$limit?>&page=<?=$pn?>&search=<?=$search?>&sortBy=contact&sortType=<?php if ($_GET["sortBy"] == "contact" && $_GET["sortType"] == "ASC") {echo "DESC";} else {echo "ASC";}?>">CONTACT
		<?php if ($sortType == "ASC" && $sortBy == "contact") {?>
			<i class='fa fa-arrow-up'>
			<?php } else if ($sortType == "DESC" && $sortBy == "contact") {?>
			<i class='fa fa-arrow-down'>
			<?php }?></a></th>

		<th><a href="index.php?limit=<?=$limit?>&page=<?=$pn?>&search=<?=$search?>&sortBy=technology&sortType=<?php if ($_GET["sortBy"] == "technology" && $_GET["sortType"] == "ASC") {echo "DESC";} else {echo "ASC";}?>">technology
		<?php if ($sortType == "ASC" && $sortBy == "technology") {?>
			<i class='fa fa-arrow-up'>
			<?php } else if ($sortType == "DESC" && $sortBy == "technology") {?>
			<i class='fa fa-arrow-down'>
			<?php }?></a></th>
		<th><a href="index.php?limit=<?=$limit?>&page=<?=$pn?>&search=<?=$search?>&sortBy=experience&sortType=<?php if ($_GET["sortBy"] == "experience" && $_GET["sortType"] == "ASC") {echo "DESC";} else {echo "ASC";}?>">experience
		<?php if ($sortType == "ASC" && $sortBy == "experience") {?>
			<i class='fa fa-arrow-up'>
			<?php } else if ($sortType == "DESC" && $sortBy == "id") {?>
			<i class='fa fa-arrow-down'>
			<?php }?></a></th>
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
}
;
?>
	</tbody>
	</table>
	<ul class="pagination">
	<?php
$sql = "SELECT COUNT(*) FROM user $qrySearch";
$rs_result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
echo "total record" . $total_records . "<br>";

$total_pages = ceil($total_records / $limit);
echo "total page" . $total_pages;
$pagLink = "";
for ($i = 1; $i <= $total_pages; $i++) {
    ?>
    <li><a href='index.php?search=<?=$search?>&page=<?=$i?>&limit=<?=$limit?>&sortBy=<?=$sortBy?>&sortType=<?=$sortType?>'><?=$i?></a></li>
<?php

};
?>
	</ul>
	</div>
</div>
</body>
</html>
