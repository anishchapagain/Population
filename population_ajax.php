<script type="text/javascript">
function showCity(str) {
if (window.XMLHttpRequest)  {
  xmlhttp=new XMLHttpRequest();
  }
else  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 xmlhttp.onreadystatechange=function()  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)   {        
      var s = xmlhttp.responseText;    
      $('#cityId').html(s);      
    }
  } 
  xmlhttp.open("GET","ajax_popuCity.php?q="+str,true);
  xmlhttp.send();
}
</script>
<?php 
session_start();

include 'includes/header.php'; 
include 'main.php'; 
include 'classes/class.country.php';
include 'classes/class.city.php';
include 'classes/class.age.php';
include 'classes/class.population.php';

$country=new Country($db);
$city=new City($db);
$age=new Age($db);
$population=new Population($db);

$val='';$result='';$list='';$field='';$valid='';$listCity='';
$countrylist=$country->getCountryList();
$citylist=$city->getCityList();
$agelist=$age->getAgeList();
$populationlist=$population->getPopulationLists();
$fields=$population->getPopulationFields();


if(isset($_POST['cityId']) && isset($_POST['ageId']) && !empty($_POST['male']) && !empty($_POST['female']) )
{
    $result=$population->insertPopulation($_POST['cityId'],$_POST['ageId'],$_POST['male'],$_POST['female']);
    header ('Location: population_ajax.php');
}
?>



<div style="border:1px solid grey; height:auto; width:60%;">
<?php    
include_once 'includes/menu.php'; 
if(isset($_SESSION['user']))
    {
    echo 'Welcome :'.$_SESSION['user'];
    echo "<a href='logout.php'> Logout </a>";
    }
?>
<hr />
<fieldset>
    <legend> Add City </legend>
    <br />
    <form name="frmcity" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post">
        <div style="width:100%;">
        <div style="width:30%; float:left;">
        <label for="countryId">Country: </label><br />
        <select class="countryId" id="countryId" name="countryId" onChange="showCity(this.value)">
            <option selected="selected">Select Countries</option>
            <?php while($row=$countrylist->fetch_assoc()){?>
            <option value="<?php echo $row['countryId']; ?>"><?php echo $row['countryname']; ?></option>
            <?php } ?>           
        </select>
        </div>
        <div style="width:20%; float:left;">
        <label for="cityId">City :</label><br />
        <select class="cityId" id="cityId" name="cityId">
        <option values="-1" selected="selected">Select Cities</option>                     
        </select>
        </div> 
        <div style="width:20%; float:left;">
        <label for="age">Age :</label><br />
        <select id="ageId" name="ageId">
            <option value="-1">Age Group</option>
            <?php while($row=$agelist->fetch_assoc()){?>
            <option value="<?php echo $row['ageId']; ?>"><?php echo $row['agegroup']; ?></option>
            <?php } ?>           
        </select>
        </div>
        <input type="text" name="male" id="male" placeholder="male population" />
        <input type="text" name="female" id="female" placeholder="female population" />
        <input type="submit" value="Add Population" />       
        </div> 
        </div>
    </form>   
    
        <?php if($result){ echo "<hr />City : <u>".$val. '</u> added successully';}?>
      <div style="width:50%; float:left;">
             <table border="1">
                 <tr>
                <?php foreach($fields as $val){ ?>
                     <th><?php echo ucfirst($val->name);?> </th>     
              <?php } ?>                     
                 </tr>
                 <?php while($row=$populationlist->fetch_assoc()){?>
                 <tr>
                     <td><?php echo $row['countryname']; ?></td> 
                     <td><?php echo $row['cityname']; ?></td>
                     <td><?php echo $row['agegroup']; ?></td>
                     <td><?php echo $row['male']; ?></td>
                     <td><?php echo $row['female']; ?></td>
                 </tr>
                 <?php } ?>
             </table>
           
         </div>
</fieldset>
</div>

<?php include 'includes/footer.php'; ?>
