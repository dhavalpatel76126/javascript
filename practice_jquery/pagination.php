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
}

$sql = "SELECT * FROM user $qrySearch ORDER BY $sortBy $sortType  LIMIT $start_from, $limit";

echo $sql . "<br>";

$rs_result = mysqli_query($conn, $sql);
$totalPage = "SELECT COUNT(*) FROM user";
$rs_result1 = mysqli_query($conn, $totalPage);
$row1 = mysqli_fetch_row($rs_result1);
$total_records1 = $row1[0];
echo "total records" . $total_records1 . "<br>";
$total_pages1 = ceil($total_records1 / $limit);
echo "total pages " . "$total_pages1";
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
	var pages='<?= $pn ?>';
	var sortb='<?= $sortBy ?>';
	var sorttpe='<?= $sortType ?>';
	var searchpage='<?= $search ?>';
	var limit='<?= $limit ?>';
	var totalPages = '<?= $total_pages1 ?>';

	function hreffunction()
	{
		window.location.href='pagination.php?page='+pages+'&limit='+limit+'&sortBy='+sortb+'&sortType='+sorttpe+'&search='+searchpage+'';
	}

	function searchelement(searchelememnt){
		searchpage = document.getElementById("search").value;
		hreffunction();
	}

	function onLimitChange(mylimitsel) {
		limit = mylimitsel.value;
		hreffunction();
	}

	function onPageClick(mypage) {
		pages = mypage;
		hreffunction();
	}

	function sort(Sortbb){
		sortb = Sortbb;
		sorttpe = (sortb == Sortbb && sorttpe == "ASC") ? "DESC" : (sorttpe == "DESC") ? "ASC": "DESC";
		hreffunction();
	}
	

	function myOnLoadFunction() {
		//ascending descending order arrow
		var myvar = document.getElementById(sortb+'href');
		
		if(sorttpe == "ASC") {
			myvar.insertAdjacentHTML('beforeend', "<i class='fa fa-arrow-up'>");
		} else if(sorttpe == "DESC") {
			myvar.insertAdjacentHTML('beforeend', "<i class='fa fa-arrow-down'>");
		}
		//select box 
		var mySelect = document.getElementById("sel1");
		for(var i=2;i<=10;i++){
			var selected = "";
			if(limit==i){
				var selected = "selected";
			}
			mySelect.insertAdjacentHTML('beforeend',"<option "+selected+">"+i+"</option>");
		}

	var page = $("#hrefPagination");
    for(var pagen=1;pagen<=totalPages;pagen++){
		var liTag=page.append('<li id="' + pagen + '">' + pagen + '</li>');
		liTag.on("click",function(){
			//onPageClick();
		});
		var Li=$("ul").find("li");
		Li.on("click",function(){
			onPageClick(this.id);

		});
    }
	
        
    }

	

</script>
<style>
li{
margin-right: 20px;
border-style: inset;
}
</style>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
</head>
<body onload="myOnLoadFunction()">
<div class="container">
	<br>
	<div>

	<div class="form-group col-sm-2">
  <label for="sel1">Select list:</label>
  <select class="form-control" id="sel1" name="limit" onchange="onLimitChange(this)">
  </select>
</div>
<input type="text" name="search" <?php if ($search == "") { ?>value=""<?
                                                                } else { ?>value=<?php echo $search;
                                                                                    } ?> id="search" />
    <input type="submit" value="Search" onclick="searchelement(this)"/>
	<table class="table table-striped table-condensed table-bordered" id="tableData">
		<thead>
		<tr>
		<th>
			<a href="#" onclick='sort("id")' id="idhref">ID
			</a>
		</th>

		<th><a href="#" onclick='sort("name")' id="namehref">NAME
		</a></th>

		<th><a href="#" onclick='sort("mail")' id="mailhref">MAIL
		</a></th>

		<th><a href="#" onclick='sort("contact")' id="contacthref">CONTACT
		</a></th>

		<th><a href="#" onclick='sort("technology")' id="technologyhref">TECHNOLOGY
		</a></th>
		<th><a href="#" onclick='sort("experience")' id="experiencehref">EXPERIENCE
		</a></th>
		</tr>
		</thead>
		<tbody id="myTable">
		<?php
    while ($row = mysqli_fetch_array($rs_result)) {
        ?>
		<tr>
		<td><?= $row['id'] ?></td>
		<td><?= $row['name'] ?></td>
		<td><?= $row['mail'] ?></td>
        <td><?= $row['contact'] ?></td>
        <td><?= $row['technology'] ?></td>
        <td><?= $row['experience'] ?></td>
		</tr>
		<?php

}
?>
	</tbody>
	</table>
	<ul class="pagination" id="hrefPagination">
	</ul>
	</div>
</div>
<script>

	</script>
</body>
</html>
