<?php
session_start();
date_default_timezone_set('Africa/Kigali'); 

if (!isset($_SESSION['name']) || !isset($_SESSION['passe'])) {
  header('Location: vce.php');
  exit(); // Always use exit() after a header redirect
}

if (empty($_SESSION['datef'])) {
  $_SESSION['datef'] = date("Y-m-d");
}

// if($_SESSION['datef'] === null) {
//     $_SESSION['datef'] = date("Y-m-d");
// }

// $operator = $_SESSION['name'];
// if($_SESSION['name'] == null || $_SESSION['passe'] == null){
//     header('location: vce.php');
// }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>VIRUNGA EXPRESS-Reporting System</title>
<link rel="stylesheet" type="text/css" href="csspage.css" /><!-- Bootstrap CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Bootstrap Datepicker CSS -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"> -->

    <!-- jQuery (required for Bootstrap Datepicker) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap Datepicker JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="./css/csspage.css" />

       
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include the date picker CSS and JS here -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>




 

<script language="JavaScript" type="text/javascript">
function checkform (form)
{
	if(form.date.value=="")
	{
		alert("Please enter the date!");
		form.date.focus();
		return false;
	}
	if(form.price.value=="")
	{
		alert("Please enter unity price!");
		form.price.focus();
		return false;
	}
	
	return true;
}
function checkformes (form)
{
	if(form.heure.value=="")
	{
		alert("Please enter the time!");
		form.heure.focus();
		return false;
	}
	if(form.carid.value=="")
	{
		alert("Please select the plate!");
		form.carid.focus();
		return false;
	}
	if(form.kmarr.value=="")
	{
		alert("Please enter the Kilometer!");
		form.kmarr.focus();
		return false;
	}
	if(form.frais.value=="")
	{
		alert("Please enter the total amount!");
		form.frais.focus();
		return false;
	}
	
	return true;
}
function cUpper(cObj) 
{
cObj.value=cObj.value.toUpperCase();
}
var mymessage = "Sorry, you are not allowed to use right click!";

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
}

function rtclickcheck(keyp){

  if (document.layers && keyp.which != 1) {
    alert(mymessage);
    return false;
  }


  if (document.all && event.button != 1) { 
    alert(mymessage);
    return false;
  }
}
document.onmousedown = rtclickcheck
 
function goToURL() { window.location = "freport.php"; }

var HighlightToday  = true;    // use true or false to have the current day highlighted
var DisablePast    = false;    // use true or false to allow past dates to be selectable
// The month names in your native language can be substituted below
var MonthNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");

// Global Vars
var now = new Date();
var dest = null;
var ny = now.getFullYear(); // Today's Date
var nm = now.getMonth();
var nd = now.getDate();
var sy = 0; // currently Selected date
var sm = 0;
var sd = 0;
var y = now.getFullYear(); // Working Date
var m = now.getMonth();
var d = now.getDate();
var l = 0;
var t = 0;
var MonthLengths = new Array(31,28,31,30,31,30,31,31,30,31,30,31);

/*
  Function: GetDate(control)

  Arguments:
    control = ID of destination control
*/
function GetDate() {
  EnsureCalendarExists();
  DestroyCalendar();
  // One arguments is required, the rest are optional
  // First arguments must be the ID of the destination control
  if(arguments[0] == null || arguments[0] == "") {
    // arguments not defined, so display error and quit
    alert("ERROR: Destination control required in funciton call GetDate()");
    return;
  } else {
    // copy argument
    dest = arguments[0];
  }
  y = now.getFullYear();
  m = now.getMonth();
  d = now.getDate();
  sm = 0;
  sd = 0;
  sy = 0;
  var cdval = dest.value;
  if(/\d{1,2}.\d{1,2}.\d{4}/.test(dest.value)) {
    // element contains a date, so set the shown date
    var vParts = cdval.split("-"); // assume YYYY/mm/dd
    sm = vParts[1] - 1;
    sd = vParts[2];
    sy = vParts[0];
    m=sm;
    d=sd;
    y=sy;
  }
  
//  l = dest.offsetLeft; // + dest.offsetWidth;
//  t = dest.offsetTop - 125;   // Calendar is displayed 125 pixels above the destination element
//  if(t<0) { t=0; }      // or (somewhat) over top of it. ;)

  /* Calendar is displayed 125 pixels above the destination element
  or (somewhat) over top of it. ;)*/ 
  l = dest.offsetLeft + dest.offsetLeft
  //l = dest.offsetLeft + dest.offsetParent.offsetLeft;
  t = dest.offsetTop - 125;
  if(t < 0) t = 280; // >
  DrawCalendar();
}

/*
  function DestoryCalendar()
  
  Purpose: Destory any already drawn calendar so a new one can be drawn
*/
function DestroyCalendar() {
  var cal = document.getElementById("dpCalendar");
  if(cal != null) {
    cal.innerHTML = null;
    cal.style.display = "none";
  }
  return
}

function DrawCalendar() {
  DestroyCalendar();
  cal = document.getElementById("dpCalendar");
  cal.style.left = 570;
  cal.style.top = 280 + "px";
  
  var sCal = "<table><tr><td class=\"cellButton\"><a href=\"javascript: PrevMonth();\" title=\"Previous Month\">&lt;&lt;</a></td>"+
    "<td class=\"cellMonth\" width=\"80%\" colspan=\"5\">"+MonthNames[m]+" "+y+"</td>"+
    "<td class=\"cellButton\"><a href=\"javascript: NextMonth();\" title=\"Next Month\">&gt;&gt;</a></td></tr>"+
    "<tr><td>S</td><td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td></tr>";
  var wDay = 1;
  var wDate = new Date(y,m,wDay);
  if(isLeapYear(wDate)) {
    MonthLengths[1] = 29;
  } else {
    MonthLengths[1] = 28;
  }
  var dayclass = "";
  var isToday = false;
  for(var r=1; r<7; r++) {
    sCal = sCal + "<tr>";
    for(var c=0; c<7; c++) {
      var wDate = new Date(y,m,wDay);
      if(wDate.getDay() == c && wDay<=MonthLengths[m]) {
        if(wDate.getDate()==sd && wDate.getMonth()==sm && wDate.getFullYear()==sy) {
          dayclass = "cellSelected";
          isToday = true;  // only matters if the selected day IS today, otherwise ignored.
        } else if(wDate.getDate()==nd && wDate.getMonth()==nm && wDate.getFullYear()==ny && HighlightToday) {
          dayclass = "cellToday";
          isToday = true;
        } else {
          dayclass = "cellDay";
          isToday = false;
        }
        if(((now > wDate) && !DisablePast) || (now <= wDate) || isToday) { // >
          // user wants past dates selectable
          sCal = sCal + "<td class=\""+dayclass+"\"><a href=\"javascript: ReturnDay("+wDay+");\">"+wDay+"</a></td>";
        } else {
          // user wants past dates to be read only
          sCal = sCal + "<td class=\""+dayclass+"\">"+wDay+"</td>";
        }
        wDay++;
      } else {
        sCal = sCal + "<td class=\"unused\"></td>";
      }
    }
    sCal = sCal + "</tr>";
  }
  sCal = sCal + "<tr><td colspan=\"4\" class=\"unused\"></td><td colspan=\"3\" class=\"cellCancel\"><a href=\"javascript: DestroyCalendar();\">Cancel</a></td></tr></table>"
  cal.innerHTML = sCal; // works in FireFox, opera
  cal.style.display = "inline";
}

function PrevMonth() {
  m--;
  if(m==-1) {
    m = 11;
    y--;
  }
  DrawCalendar();
}

function NextMonth() {
  m++;
  if(m==12) {
    m = 0;
    y++;
  }
  DrawCalendar();
}

function ReturnDay(day) {
  cDest = document.getElementById(dest);
  dest.value = y+"-"+(m+1)+"-"+day;
  DestroyCalendar();
}

function EnsureCalendarExists() {
  if(document.getElementById("dpCalendar") == null) {
    var eCalendar = document.createElement("div");
    eCalendar.setAttribute("id", "dpCalendar");
    document.body.appendChild(eCalendar);
  }
}

function isLeapYear(dTest) {
  var y = dTest.getYear();
  var bReturn = false;
  
  if(y % 4 == 0) {
    if(y % 100 != 0) {
      bReturn = true;
    } else {
      if (y % 400 == 0) {
        bReturn = true;
      }
    }
  }
  
  return bReturn;
}  
function btnback_click()
{
window.location.href="receiver.php";
}
  var statusmsg=""

function hidestatus(){
window.status=statusmsg;
return true
}
  </script>
  
<!-- <style>
  tr { background-color: }
  .initial { background-color: #DDDDDD; color:#000000 }
  .normal { background-color: #CCCCCC }
  .highlight { background-color: #8888FF }

  #centered{
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
  }
  #subHeader{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
 
  #wrapper{
    min-width: fit-content;
    border-radius: 16px;
    padding: 1.5rem;
  }
 #bodyContainer{
  display: flex;
  width: 100%;
  align-items: center;
  justify-content: center;
 }
</style> -->

</head>	

<body onLoad="document.forms.Form.heure.focus()">
<div id="header">
<div id="image">
<img style="float:left;margin-left:5px;margin-top:5px;" src="virungalogo.png" alt="" width="50%"/> 
</div>
<div id="Headercontent">
<h3>VIRUNGA EXPRESS</h3>
<h5>Reporting System</h5>
</div>
</div>

<!-- HEADER MENU -->
<div id="horizMenu">
<ul class="ullisthorizMenu">
<li><a href="./cardep.php">Car Departure</a></li>
<li><a href="./expenses.php">Fuel</a></li>
<li><a href="./greport.php">Report</a></li>
<li><a href="./sreport.php">Stock</a></li>
<li><a href="./settings.php">Settings</a></li>
<li><a href="./distroysession.php">Log out</a> </li>
</ul>
<div COLOR="white"> 
  <p class="welcome-text">
    <?php print("Welcome ".$_SESSION['name']); ?>
  </p>
</div>
</div>


<!-- <FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS">
		<U>FILL THE FORM TO SAVE VEHICULE FUEL CONSUMPTION</U></FONT><BR><BR>
		<FORM METHOD="POST" ACTION="expenses.php" onsubmit="return checkform(this);">
		<font face="verdana" size="2">Date / Price : </font><INPUT TYPE="text" NAME="date" SIZE="15" id='SelectedDate' onClick='GetDate(this)' STYLE='border-color:#45E01F'>&nbsp;<INPUT TYPE="text" NAME="price" SIZE="5">
		<INPUT TYPE="submit" name="submit" value="CONTINUE">
	</FORM>
	-->
<div id="bodyContainer">
<div id="contents">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">	
<?php
	if(isset($_POST['setPrevDate'])){
		$date=$_POST['prevDate']; 
		$_SESSION['datef']=$date; 
	}elseif($_SESSION['datef']!=null || $_SESSION['datef']!="") {
	$dat=$_SESSION['datef'];
	}
	 else{
				$_SESSION['datef']=date("Y-m-d");
	}
	
	?>	
<?php
include 'connect.php';

$Branch=$_SESSION['local'];
$query=mysqli_query($conn,"SELECT * FROM fuel_price where Branch='$Branch' ORDER BY fuel_price_id DESC limit 1");
if($num=mysqli_num_rows($query)){
$row=mysqli_fetch_assoc($query);

$fromDate=$row['date'];
//$dat=date("Y-m-d");
$dat=$_SESSION['datef'];
$pric=$row['price'];
$currDate=$_SESSION['datef'];
print("<div id='subHeader'> <p>Current price from <b>$fromDate</b> is <b>$pric /L at $Branch</b> </p>");
print("<p>Current Date:<font color=red> <b>$currDate </b></font> </p></div>");
print("<HR WIDTH=90% style=border : none;
                      border-top : 'dashed 1px cyan';
                      color : '#FFFFFF' ;
                      background-color : '#FFFFFF' ;
                      height : 2px;>");
}
?>	
	
<form action="expenses.php" method="post">
  <div id="centered">

    <div> Set Date for Previous fuel entries: </div>
   <div> <input type="text" name="prevDate" value="<?php echo $_SESSION['datef']; ?>"  class='datepicker' id='dateprice' ></div>
    <div><input type="submit" name="setPrevDate" value="Set Date" class="btn btn-outline-success"> </div>
  </div>
</form>	

<?php

	print("<HR WIDTH=90% style=border : none;
                      border-top : 'dashed 1px cyan';
                      color : '#FFFFFF' ;
                      background-color : '#FFFFFF' ;
                      height : 2px;>");

  if(isset($_POST['save'])){
	
//$dat=$_POST['datef']; 
$carid=$_POST['carid'];
$heure=$_POST['heure'];
$kmarr=$_POST['kmarr'];
$frais=$_POST['frais'];
$driver=$_POST['driver'];
$dat=$_SESSION['datef'];
//$pric=$_SESSION['price'];

$operator=$_SESSION['name'];
$local=$_SESSION['local'];

include('connect.php');

$qntphy=$frais/$pric;
$qntphy=round($qntphy,2);
$kmdep=0;
$q2=mysqli_query($conn,"SELECT * FROM fuel WHERE PLAQUE='$carid'  ORDER BY `N` DESC LIMIT 1");
while($row=mysqli_fetch_assoc($q2))
	{
$Previouskmarrival=$row['KMARR'];
	}
if($Previouskmarrival <= $kmarr){
//$q3=mysqli_query($conn,"update fuel SET KMARR='$kmarr',KMPARC='$kmarr'-KMDEP,MONTANT100KM=MONTANT/KMPARC*100,MONTANT1KM=MONTANT/KMPARC,LITERS100KM=ROUND((QTEPHYS/('$kmarr'-KMDEP)*100),1) WHERE KMDEP=$kmdep AND PLAQUE='$carid' AND KMPARC='O'");

$q5=mysqli_query($conn,"SELECT Engine FROM cars WHERE Carid='$carid'");
$ro2=mysqli_fetch_assoc($q5);	
$moteur=$ro2['Engine'];
$dat=$_SESSION['datef'];	
$distance=$kmarr-$Previouskmarrival; // displacement in km
$amount100km=$frais*100/$distance; // amount used on 100km of distance
$amount1km=$frais/$distance;
$litas100=$qntphy*100/$distance;   //liters used over 100km
$kmperone_liter=$distance/$qntphy; // how long distance in km covered using one liter of fuel

 $user=$_SESSION['userid'];
           $station_id=$_SESSION['BRANCH'];
             
$query4=mysqli_query($conn,"INSERT INTO fuel (created_date,DATE,HEURE,PLAQUE,driver,MOTEUR,KMDEP,KMARR,KMPARC,QTEPHYS,PRIXUNIT,MONTANT,MONTANT100KM, MONTANT1KM, LITERS100KM,kmsper_one_liter,station_id,user_id) VALUES(now(),'$dat','$heure','$carid','$driver','$moteur','$Previouskmarrival','$kmarr','$distance','$qntphy','$pric','$frais','$amount100km','$amount1km','$litas100','$kmperone_liter','$station_id','$user')");
mysqli_error($conn);
$dat=$_SESSION['datef'];
$query5=mysqli_query($conn,"INSERT INTO store (created_date,DDate,Item,Spec,Quantity,Price,Plaque,Status,Document,Location,Operator) VALUES(now(),'$dat','fuel','$heure','$qntphy','$frais','$carid','2','Facture','$local','$operator')");
mysqli_error($conn);
echo "<script>
    alert('Successfully saved');
    window.location.href = 'expenses.php';  // Redirect to another page after alert
</script>";

}else{
print("<FORM ACTION=expenses.php>
<FONT SIZE=4 COLOR=BLUE>
<CENTER>KM DE DEPART: $kmdep SUPERIEUR AU KM D ARRIVE: $kmarr.!</CENTER></B></FONT>
<INPUT TYPE=submit VALUE= TABINDEX=1></FORM>
	</div>
    </div>
<p class=copyright>&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>");
}
exit;
  }
 if(isset($_POST['del'])){
	
$hiden=$_POST['hide'];
include('connect.php');


$do1=mysqli_query($conn,"SELECT *FROM fuel WHERE N='$hiden'");
$ro1=mysqli_fetch_assoc($do1);
	 {
		 $N1=$ro1['DATE'];
		 $N2=$ro1['PLAQUE'];
		 $N3=$ro1['HEURE'];
	 }
	 $do=mysqli_query($conn,"SELECT * FROM fuel WHERE N!='$hiden' and PLAQUE='$N2' ORDER BY N DESC LIMIT 1");
$ro=mysqli_fetch_assoc($do);
	 {
		 $hido=$ro['N'];
	 }
$do2=mysqli_query($conn,"DELETE FROM store WHERE DDate='$N1' AND Plaque='$N2' AND Spec='$N3'");
$do3=mysqli_query($conn,"DELETE FROM fuel WHERE N='$hiden'");



 echo "<script>alert('Successfully Deleted   !');</script>";
 }

if($dat && $pric){
    $time = date('H:i');
    
  

echo "<FORM METHOD='POST' ACTION='expenses.php' NAME='Form' onsubmit='return checkformes(this);' class='container'>
    <div class='container' style='width: 100%; margin: 0 auto;'>

        <div class='col-lg-12 col-sm-12 col-md-6'>
            <div class='form-group'>
                <label for='heure' class='text-left'>TIME:</label>
                <input type='text' id='heure' name='heure' value='$time' class='form-control'>
            </div>

            <div class='form-group '>
                <label for='carid'>PLAQUE:</label>
                <select name='carid'  id='carid' class='form-control select2'>
                    <option value='' selected></option>";
                    
                    include 'connect.php';
                    $query = mysqli_query($conn, "SELECT Carid FROM cars WHERE Carid is not null and Carid!='' ORDER BY Carid ASC"); 
                    while($row = mysqli_fetch_assoc($query)){
                        $car = $row['Carid'];
                        echo "<option value='$car'>$car</option>";      
                    }
                    
                echo "</select>
            </div>

            <div class='form-group'>
                <label for='driver'>DRIVER:</label>
                <select name='driver' class='form-control' id='driver' class='form-control select2'>
                    <option value='' selected></option>";
                    
                    $dquery = mysqli_query($conn, "SELECT Name FROM driver GROUP BY Name ORDER BY Name ASC"); 
                    while($drow = mysqli_fetch_assoc($dquery)){
                        $name = $drow['Name'];
                        echo "<option value='$name'>$name</option>";        
                    }
                    
                echo "</select>
            </div>

            <div class='form-group '>
                <label for='kmarr'>KM/ARRIVE:</label>
                <input type='text' id='kmarr' name='kmarr' class='form-control' oninput='validateNumberInput(this)'>
            </div>

            <div class='form-group '>
                <label for='frais'>AMOUNT:</label>
                <input type='text' id='frais' name='frais' class='form-control' oninput='validateNumberInput(this)'>
            </div>

            <div class='form-group '>
                <label>&nbsp;</label> <!-- Empty label for spacing -->
                <input type='submit' name='save' value='SAVE' class='btn btn-primary btn-block'>
               
            </div>
        </div>
        
    </div>
</FORM>

<HR WIDTH='90%' style='border: none; border-top: dashed 1px cyan; color: #FFFFFF; background-color: #FFFFFF; height: 2px;'>";



}


include'connect.php';
$dat=$_SESSION['datef'];
$user=$_SESSION['userid'];
           $station_id=$_SESSION['BRANCH'];
$query=mysqli_query($conn,"SELECT * FROM fuel WHERE DATE='$dat' and  `station_id`='$station_id' and `user_id`='$user' ORDER BY N DESC");
if($num=mysqli_num_rows($query)){
print("
<div id='table-container'>
    <table width='100%' class='imagetable'>
        <tr>
            <th>DATE</th>
            <th>TIME</th>
            <th>PLAQUE</th>
            <th>ENGINE</th>
            <th>KM DE DEPART</th>
            <th>KM D' ARRIVE</th>
            <th>QUANTITY</th>
            <th>AMOUNT</th>
            
        </tr>
");

$n = 0;
$ft = 0;
$totfuel=0;
while ($row = mysqli_fetch_assoc($query)) {
    $hid = $row['N'];
    $d = $row['DATE'];
    $h = $row['HEURE'];
    $p = $row['PLAQUE'];
    $m = $row['MOTEUR'];
    $kmDEP = $row['KMDEP'];
     $kma = $row['KMARR'];
    
    $q = $row['QTEPHYS'];
    $f = $row['MONTANT'];
    $ff = $f;
	$totfuel+=$q;
    $ft += $f;
    $n++;

    print("
        <tr>
            <td>$d</td>
            <td>$h</td>
            <td>$p</td>
            <td>$m</td>
            <td align='right'> $kmDEP KM</td>
            <td align='right'>$kma KM</td>
            <td align='right'>$q L</td>
            <td align='right'>$ff <span align='right'> <form action='expenses.php' method='post'>
                    <input type='hidden' name='hide' value='$hid'>
                    <input type='submit' name='del' value='DEL'  class='delete-btn' style='height:1.6em'>
                </form><span></td>
            
        </tr>
    ");
}
$ft=$ft;
$totfuel=$totfuel;
print("<TR><TH COLSPAN=6>TOTALS</th>
<TH>$totfuel</TH><TH >$ft Rwf</TH><tr>");
print("</table>");	
	}
	else{
		 //$dat=$_SESSION['date'];
	print("<FONT SIZE=2 COLOR=#3090C7 FACE='COMIC SANS MS'>
		<CENTER><U>NO RECORD FOR $dat</U></CENTER></FONT>");
	}
	

    ?>



<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</div>
</div>
<!-- Include jQuery and Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
    
</script>
<script>
    function validateNumberInput(input) {
        // Remove any non-digit characters
        input.value = input.value.replace(/[^0-9]/g, '');
    }
</script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('#carid').select2({
            placeholder: 'Select a plaque',
            allowClear: true
        });

        $('#driver').select2({
            placeholder: 'Select a driver',
            allowClear: true
        });

        // Initialize the date picker and disable future dates
        $('#dateprice').datepicker({
            dateFormat: 'yy-mm-dd',
            maxDate: new Date(),  // Disables future dates
            changeMonth: true,
            changeYear: true
        }).attr('readonly', 'readonly');  // Prevent typing in the input field
    });
</script>
</body>
</html>
