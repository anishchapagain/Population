<?php
include 'main.php'; 
include 'classes/class.city.php';
$city=new City($db);
//$val='';$result='';$list='';$field='';$valid='';$listCity='';

$q=$_GET['q'];
$result=$city->getCityCountryListById($q);
//echo "<script>alert('".print_r($result)."')</script>";
$field='';
$field="<option value='-1'>Select City</option>";
if($result)
{
while($row=$result->fetch_assoc())
{
    $field .='<option value="'.$row['cityId'].'">'.$row['cityname'].'</option>';
}
  echo $field;
}
else
{
    $field .='<option value="-2">No City to Choose!</option>';
    echo $field;
}
?>