<?php
include 'main.php'; 
include 'classes/class.city.php';
$city=new City($db);
//$val='';$result='';$list='';$field='';$valid='';$listCity='';

$q=$_GET['q'];
$result=$city->getCityAgeGroupById($q);

//echo "<script>alert('".print_r($result)."')</script>";
$field='';
$field="<option value='-1'>Select Group</option>";
if($result)
{
while($row=$result->fetch_assoc())
{
    $field .='<option value="'.$row['ageId'].'">'.$row['agegroup'].'</option>';
}
  echo $field;
}
else
{
    $field .='<option value="-2">No group to Choose!</option>';
    echo $field;
}
?>
