<?php
//echo "hey this is received >>".$_GET['x']."<<";
//exit();

#include database configuration file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "location";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$region_id = $_GET['y'];
$regions_data = mysqli_query($conn, "SELECT * FROM city where region_id = $region_id ORDER BY city");
$regions = array();
while ($region = mysqli_fetch_array($regions_data)) {
    array_push($regions, $region);
}
print_r(json_encode($regions));

?>