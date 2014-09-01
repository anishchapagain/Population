<script type="text/javascript">
function showCity(str) {   
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();  }
else {  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");    }
 xmlhttp.onreadystatechange=function(){
  if (xmlhttp.readyState==4 && xmlhttp.status==200){        
      var s = xmlhttp.responseText;    
      $('#cityId').html(s);      
    }
  } 
  xmlhttp.open("GET","ajax_popuCity.php?q="+str,true);
  xmlhttp.send();
}
function showAgeGroup(str) {
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();  }
else {  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");    }
 xmlhttp.onreadystatechange=function(){
  if (xmlhttp.readyState==4 && xmlhttp.status==200){        
      var s = xmlhttp.responseText;    
      $('#ageId').html(s);      
    }
  } 
  xmlhttp.open("GET","ajax_getAgeGroup.php?q="+str,true);
  xmlhttp.send();
}
function showFilterData() { 
    //var country = document.getElementById('countryId').value;
 var city = document.getElementById('cityId').value;
 var age = document.getElementById('ageId').value; 
 var str = "ajax_getFilterData.php?age=" + age +"&city=" + city;// + "&country=" + country;
 
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();  }
else {  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");    }
 xmlhttp.onreadystatechange=function(){
  if (xmlhttp.readyState==4 && xmlhttp.status==200){        
      var s = xmlhttp.responseText;    
      $('#ajaxDiv').html(s);      
    }
  }  
  xmlhttp.open("GET",str,true);
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
$error_message='';
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
    <legend> Filter Options </legend>
    <br />
    <form name="frmfilter" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post">
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
        <select class="cityId" id="cityId" name="cityId" onChange="showAgeGroup(this.value)">
        <option values="-1" selected="selected">Select Cities</option>                     
        </select>
        </div> 
        <div style="width:20%; float:left;">
        <label for="ageId">Age Group:</label><br />
        <select class="ageId" id="ageId" name="ageId" onChange="showFilterData()">
            <option value="-1" selected="selected">Select Group</option>                     
        </select>
        </div>         
        </div>
    </form>   
</fieldset>
<fieldset>
    <legend> Filter Values </legend>
    <br />
    <div id='ajaxDiv'>Your result will display here</div>
</fieldset>
<fieldset>
    <legend> Database Records </legend>
    
    <br />
</fieldset>
</div>

<?php include 'includes/footer.php'; ?>