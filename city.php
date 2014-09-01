<?php 
session_start();
include 'includes/header.php'; 
include 'main.php'; 
include 'classes/class.country.php';
include 'classes/class.city.php';
$country=new Country($db);
$city=new City($db);

$val='';$result='';$list='';$field='';$valid='';$listCity='';
$list=$country->getCountryList();
$listCity=$city->getCityCountryList();
$field=$listCity->fetch_fields();

if(isset($_POST['countryId']) && !empty($_POST['city']))
{
    $val=trim($_POST['city']);
    $valid=trim($_POST['countryId']);
    $result=$city->insertCity($valid,$val);
    header ('Location: city.php');
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
        <select id="countryId" name="countryId">
            <option value="-1">ALL Countries</option>
            <?php while($row=$list->fetch_assoc()){?>
            <option value="<?php echo $row['countryId']; ?>"><?php echo $row['countryname']; ?></option>
            <?php } ?>           
        </select>
        </div>
        <div style="width:20%; float:left;">
        <label for="city">City :</label><br />
        <input type="text" name="city" id="city" />         
        <input type="submit" value="Add City" />       
        </div> 
        </div>
    </form>   
    <?php if($result){ echo "<hr />City : <u>".$val. '</u> added successully';}?>
      <div style="width:50%; float:left;">
          <table class="table">
                 <tr>
                <?php foreach($field as $val){ ?>
                     <th><?php echo ucfirst($val->name);?> </th>     
              <?php } ?>                     
                 </tr>
                 <?php while($row=$listCity->fetch_assoc()){?>
                 <tr>                  
                     <td><?php echo ucfirst($row['countryname']); ?></td> 
                     <td><?php echo ucfirst($row['cityname']); ?></td>                                       
                 </tr>
                 <?php } ?>
             </table>
           
         </div>
</fieldset>
</div>

<?php include 'includes/footer.php'; ?>