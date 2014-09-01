<?php 
session_start();
include 'includes/header.php'; 
include 'main.php'; 
$val='';$result='';$list='';$header='';$field='';

//Class Age
include 'classes/class.age.php';
$age=new Age($db);
$list=$age->getAgeList();
$field=$age->getAgeField();
if(isset($_POST['agegroup']) && !empty($_POST['agegroup'])){
    $val=trim($_POST['agegroup']);
    $result=$age->insertAge($val);
    header ('Location: age.php');
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
    <legend> Add Age </legend>
    <br />
    <div style="width:100%;">
        <div style="width:30%; float:left;">
            <form name="frmage" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post">
                <label for="agegroup">Age: </label>
                <input type="text" name="agegroup" id="agegroup" />        
                <input type="submit" value="Add Age Group" />  
            </form>   
            <?php if($result){ echo "<hr />Age : <u>".$val. '</u> added successully';}
                    // else{ echo "<hr />Age : <u>".$val.'</u> already exist';}
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
                     <td><?php echo $row['ageId']; ?></td>
                     <td><?php echo $row['agegroup']; ?></td>
                 </tr>
                 <?php } ?>
             </table>
           
         </div>
        </div>
    
       
        
</fieldset>
</div>

<?php include 'includes/footer.php'; ?>