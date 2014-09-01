<?php
include 'main.php'; 
include 'classes/class.population.php';
$population=new Population($db);

$ageid='';$cityid='';$result='';$display_string='';

$ageid=$_GET['age'];
$cityid=$_GET['city'];
//$countryid=$_GET['country'];
$result=$population->filterCityGroup($ageid,$cityid);

//Build Result String
$display_string = "<table border='1'>";
$display_string .= "<tr>";
//$display_string .= "<th>Country</th>";
$display_string .= "<th>City</th>";
$display_string .= "<th>Group</th>";
$display_string .= "<th>Total</th>";
$display_string .= "<th>Male</th>";
$display_string .= "<th>Female</th>";
$display_string .= "</tr>";

while($row = $result->fetch_assoc()){
	$display_string .= "<tr>";
	//$display_string .= "<td>$row[countryName]</td>";
	$display_string .= "<td>$row[cityname]</td>";
	$display_string .= "<td>$row[agegroup]</td>";
	$display_string .= "<td>$row[total]</td>";
        $display_string .= "<td>$row[male]</td>";
        $display_string .= "<td>$row[female]</td>";        
	$display_string .= "</tr>";
	
}
//echo "Query: " . $query . "<br />";
$display_string .= "</table>";
echo $display_string;
?>