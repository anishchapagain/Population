<script type="text/javascript">
    /*Load City*/
    function showCity(str) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }
        else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var s = xmlhttp.responseText;
                $('#cityId').html(s);
            }
        }
        xmlhttp.open("GET", "ajax_popuCity.php?q=" + str, true);
        xmlhttp.send();
    }

    /*Age Group Listing*/
    function showAgeGroup(str) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }
        else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var s = xmlhttp.responseText;
                $('#ageId').html(s);
            }
        }
        xmlhttp.open("GET", "ajax_getAgeGroup.php?q=" + str, true);
        xmlhttp.send();
    }

    /*Filter data: Home Page*/
    function showFilterData() {
        var city = document.getElementById('cityId').value;
        var age = document.getElementById('ageId').value;
        var str = "ajax_getFilterData.php?age=" + age + "&city=" + city;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }
        else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var s = xmlhttp.responseText;
                $('#ajaxDiv').html(s);
            }
        }
        xmlhttp.open("GET", str, true);
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

$country = new Country($db);
$city = new City($db);
$age = new Age($db);
$population = new Population($db);

$val = '';
$result = '';
$list = '';
$field = '';
$valid = '';
$listCity = '';
$countrylist = $country->getCountryList();
//total population
$totalP=$population->totalPopulation();
$total_fieldP=$totalP->fetch_fields();
//total country population
$total=$population->totalCountryPopulation();
$total_field=$total->fetch_fields();
//top 3
$top_populationlist = $population->filterTop3();
$fields_top = $top_populationlist->fetch_fields();
//bottom 3
$btm_populationlist = $population->filterBottom3();
$fields_btm = $btm_populationlist->fetch_fields();
//male high 3
$top_3malelist = $population->maleHigh3();
$fields_top3male = $top_3malelist->fetch_fields();
//female high 3
$top_3femalelist = $population->femaleHigh3();
$fields_top3female = $top_3femalelist->fetch_fields();
$error_message = '';
?>

<div style="border:1px solid grey; height:auto; width:60%;">
    <?php
    include_once 'includes/menu.php';
    if (isset($_SESSION['user'])) {
        echo 'Welcome :' . $_SESSION['user'];
        echo "<a href='logout.php'> Logout </a>";
    }
    ?>
    <hr />
    <fieldset>
        <legend> Filter Options </legend>
        <form name="frmfilter" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post">
            <div style="width:100%;">
                <div style="width:30%; float:left;">
                    <label for="countryId">Country: </label><br />
                    <select class="countryId" id="countryId" name="countryId" onChange="showCity(this.value)">
                        <option selected="selected">Select Countries</option>
                        <?php while ($row = $countrylist->fetch_assoc()) { ?>
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

    <div style="width:50%; float:left;">
        <fieldset>
            <legend> Top 3 Most Population Details </legend>
            <table class="table">
                <tr><?php foreach ($fields_top as $val) { ?> <th><?php echo ucfirst($val->name); ?> </th><?php } ?></tr>
                <?php while ($row = $top_populationlist->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo ucfirst($row['countryname']); ?></td> 
                        <td><?php echo ucfirst($row['cityname']); ?></td>
                        <td><?php echo ucfirst($row['agegroup']); ?></td>
                        <td><?php echo $row['male']; ?></td>
                        <td><?php echo $row['female']; ?></td>
                        <td><b><?php echo $row['total']; ?></b></td>
                    </tr>
                <?php } ?>
            </table> 
        </fieldset>
    </div>
    <div style="width:50%; float:left;">
        <fieldset>
            <legend> Fewer 3 Population Details </legend>
            <table class="table">
                <tr><?php foreach ($fields_btm as $val) { ?> <th><?php echo ucfirst($val->name); ?> </th><?php } ?></tr>
                <?php while ($row = $btm_populationlist->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo ucfirst($row['countryname']); ?></td> 
                        <td><?php echo ucfirst($row['cityname']); ?></td>
                        <td><?php echo ucfirst($row['agegroup']); ?></td>
                        <td><?php echo $row['male']; ?></td>
                        <td><?php echo $row['female']; ?></td>
                        <td><b><?php echo $row['total']; ?></b></td>
                    </tr>
                <?php } ?>
            </table>  
        </fieldset>
    </div>
    <div style="width:50%; float:left;">
        <fieldset>
            <legend> 3, Highest Male Population Details </legend>
            <table class="table">
                <tr><?php foreach ($fields_top3male as $val) { ?> <th><?php echo ucfirst($val->name); ?> </th><?php } ?></tr>
                <?php while ($row = $top_3malelist->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo ucfirst($row['countryname']); ?></td> 
                        <td><?php echo ucfirst($row['cityname']); ?></td>
                        <td><?php echo ucfirst($row['agegroup']); ?></td>
                        <td><?php echo $row['male']; ?></td>                       
                    </tr>
                <?php } ?>
            </table>  
        </fieldset>
    </div>
    <div style="width:50%; float:left;">
        <fieldset>
            <legend> 3, Highest Female Population Details </legend>
            <table class="table">
                <tr><?php foreach ($fields_top3female as $val) { ?> <th><?php echo ucfirst($val->name); ?> </th><?php } ?></tr>
                <?php while ($row = $top_3femalelist->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo ucfirst($row['countryname']); ?></td> 
                        <td><?php echo ucfirst($row['cityname']); ?></td>
                        <td><?php echo ucfirst($row['agegroup']); ?></td>                        
                        <td><?php echo $row['female']; ?></td>                   
                    </tr>
                <?php } ?>
            </table> 
        </fieldset>
    </div>
    <div style="width:50%; float:left;">
        <fieldset>
            <legend> Total Population Details </legend>
            <table class="table">
                <tr><?php foreach ($total_fieldP as $val) { ?> <th><?php echo ucfirst($val->name); ?> </th><?php } ?></tr>
                <?php while ($row = $totalP->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo ucfirst($row['countryname']); ?></td> 
                        <td><?php echo $row['total']; ?></td>
                        <td><?php echo $row['male']; ?></td>
                        <td><?php echo $row['female']; ?></td>                   
                    </tr>
                <?php } ?>
                    <?php while ($row = $total->fetch_assoc()) { ?>
                    <tr>
                        <td></td>
                        <td><b><?php echo $row['total']; ?></b></td>
                        <td><b><?php echo $row['male']; ?></b></td>
                        <td><b><?php echo $row['female']; ?></b></td>                   
                    </tr>
                <?php } ?>
            </table> 
        </fieldset>
    </div>

</div>

<?php include 'includes/footer.php'; ?>