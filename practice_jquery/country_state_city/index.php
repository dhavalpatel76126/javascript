
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "location";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

echo "Connesssted successfully";

?>
<!DOCTYPE html>
<html>
<body>
  <head>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  </head>
<script>
function myFunction(val) {
	$.ajax({
	type: "GET",
	url: "state.php",
	data:'x='+val,
	success: function(data){
					var region = jQuery.parseJSON(data);
					for (var i = 0; i < region.length; i++) {
						$('#region').append('<option value="' + region[i].id + '">' + region[i].region + '</option>');
					}

	}
	});
}
function myFunction1(val) {
	$.ajax({
	type: "GET",
	url: "city.php",
	data:'y='+val,
	success: function(data){  
					var city = jQuery.parseJSON(data);
					for (var i = 0; i < city.length; i++) {
						$('#city').append('<option value="' + city[i].id + '">' + city[i].city + '</option>');
					}

	}
	});
}
   
</script>
<select onchange="myFunction(this.value)" id="country">
<option value="0">Select Country</option>
<?php
$sql = "SELECT * FROM country";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    // output data of each row

  while ($row = mysqli_fetch_assoc($result)) {

    $id = $row['id'];

    echo "<option value='$id'>" . $row['country'] . "</option>";
  }
} else {
  echo "0 results";
}

?>
</select>
<div id="txtHint" style="width:100px; border:0px solid gray;">
<select class="form-control" id="region" onchange="myFunction1(this.value)">
	        	<option  value="0">Select State</option>
</select>
</div>

<div id="txtHint" style="width:100px; border:0px solid gray;">
<select class="form-control" id="city">
	        	<option value="0">Select city</option>
</select>
</div>
</body>
</html>