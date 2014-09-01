<?php 
session_start();
include 'includes/header.php'; 
include 'main.php'; 
$val='';$result='';$list='';$header='';

//Class Country
include 'classes/class.country.php';
$country=new Country($db);
$list=$country->getCountryList();
$field=$country->getCountryField();
if(isset($_POST['country']) && !empty($_POST['country'])){
    $val=trim($_POST['country']);
    $result=$country->insertCountry($val);
    header ('Location: country.php');
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
    <legend> Add Country </legend>
    <br />
    <div style="width:100%;">
        <div style="width:30%; float:left;">
            <form name="frmcountry" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post">
                <label for="country">Country: </label>
                <input type="text" name="country" id="country" />        
                <input type="submit" value="Add Country" />  
            </form>   
            <?php if($result){ echo "<hr />Country : <u>".$val. '</u> added successully';}
                    // else{ echo "<hr />Country : <u>".$val.'</u> already exist';}
            ?>
       </div>
         <div style="width:50%; float:left;">
             <table border="1">
                 <tr>
                <?php foreach($field as $val){ ?>
                     <th><?php echo ucfirst($val->name);?> </th>     
              <?php } ?>                     
                 </tr>
                 <?php while($row=$list->fetch_assoc()){?>
                 <tr>
                     <td><?php echo $row['countryId']; ?></td>
                     <td><?php echo $row['countryname']; ?></td>
                 </tr>
                 <?php } ?>
             </table>
           
         </div>
        </div>
    
       
        
</fieldset>
</div>

<?php include 'includes/footer.php'; ?>