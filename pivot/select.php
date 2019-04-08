<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "todo";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
$category_id = $_GET['x'];

$sql="SELECT * FROM product 
WHERE id NOT IN (SELECT product_id FROM pivot)";


$regions_data = mysqli_query($conn,$sql);

$regions = array();

while ($region = mysqli_fetch_array($regions_data)) {
    array_push($regions, $region);
}
print_r(json_encode($regions));

?>