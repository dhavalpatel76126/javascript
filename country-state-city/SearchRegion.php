<?php
/** Search city based on country
* @author : Prem Tiwair <www.freewebmentor.com>
*/

#include database configuration file
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "location";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$country_id = $_GET['country_id'];
$regions_data=mysqli_query($conn,"SELECT * FROM region where country_id = $country_id ORDER BY region");
$regions = array();
while($region = mysqli_fetch_assoc($regions_data)){
	array_push($regions, $region);
}
print_r(json_encode($regions));

?>