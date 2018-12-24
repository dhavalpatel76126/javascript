
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
<script>

    function myFunction(str) {
        var x = document.getElementById("country").value;
        console.log(x);
        var y=document.getElementsByTagName("option")[0].remove;
        console.log(y);
        var xmlhttp = new XMLHttpRequest();
        console.log(xmlhttp);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             console.log("this.responseText ", this.responseText);
              var region = JSON.parse(this.responseText);
              console.log("region : ", region);
              for(var i=0; i<region.length;i++){
                var option = document.createElement("option");
                option.text = region[i].region;
                option.value = region[i].id;
                var z=document.getElementById("region");
                z.appendChild(option);
                console.log(option);
              }
            }
        };
        console.log(xmlhttp.open("GET","state.php?x=" + str,true));
        xmlhttp.send();
    }

    function myFunction1(str1) {
        var x = document.getElementById("region").value;
        console.log(x);
        var y=document.getElementsByTagName("option")[1].remove;
        console.log(y);
        var xmlhttp = new XMLHttpRequest();
        console.log(xmlhttp);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             console.log("this.responseText ", this.responseText);
              var city = JSON.parse(this.responseText);
              console.log("city : ", city);
              for(var i=0; i<region.length;i++){
                var option = document.createElement("option");
                option.text = city[i].city;
                option.value = city[i].id;
                var z=document.getElementById("city");
                z.appendChild(option);
                console.log(option);
              }
            }
        };
        console.log(xmlhttp.open("GET","city.php?y=" + str1,true));
        xmlhttp.send();
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
	        	<option value="0">Select State</option>
</select>
</div>

<div id="txtHint" style="width:100px; border:0px solid gray;">
<select class="form-control" id="city">
	        	<option value="0">Select city</option>
</select>
</div>
</body>
</html>