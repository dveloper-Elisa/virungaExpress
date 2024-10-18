<?php
session_start();
date_default_timezone_set('Africa/Kigali'); 
$operator=$_SESSION['name'];
if($_SESSION['name']==null or $_SESSION['passe']==null){
header('location: vce.php');
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>VIRUNGA EXPRESS-Reporting System</title>
<link rel="stylesheet" type="text/css" href="csspage.css" />





<link rel="stylesheet" type="text/css" href="csspage.css" />
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
  <style type="text/css">
/**************************************************************************************
  htmlDatePicker CSS file
  
  Feel Free to change the fonts, sizes, borders, and colours of any of these elements
***************************************************************************************/
/* The containing DIV element for the Calendar */
#dpCalendar {
  display: none;          /* Important, do not change */
  position: absolute;        /* Important, do not change */
  background-color: #eeeeee;
  color: black;
  font-size: xx-small;
  font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
  width: 150px;
}
/* The table of the Calendar */
#dpCalendar table {
  border: 1px solid black;
  background-color: #eeeeee;
  color: black;
  font-size: xx-small;
  font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
  width: 100%;
}
/* The Next/Previous buttons */
#dpCalendar .cellButton {
  background-color: #ddddff;
  color: black;
}
/* The Month/Year title cell */
#dpCalendar .cellMonth {
  background-color: #ddddff;
  color: black;
  text-align: center;
}
/* Any regular day of the month cell */
#dpCalendar .cellDay {
  background-color: #ddddff;
  color: black;
  text-align: center;
}
/* The day of the month cell that is selected */
#dpCalendar .cellSelected {
  border: 1px solid red;
  background-color: #ffdddd;
  color: black;
  text-align: center;
}
/* The day of the month cell that is Today */
#dpCalendar .cellToday {
  background-color: #ddffdd;
  color: black;
  text-align: center;
}
/* Any cell in a month that is unused (ie: Not a Day in that month) */
#dpCalendar .unused {
  background-color: transparent;
  color: black;
}
/* The cancel button */
#dpCalendar .cellCancel {
  background-color: #cccccc;
  color: black;
  border: 1px solid black;
  text-align: center;
}
/* The clickable text inside the calendar */
#dpCalendar a {
  text-decoration: none;
  background-color: transparent;
  color: blue;
} 
<STYLE>
  tr { background-color: #DDDDDD}
  .initial { background-color: #DDDDDD; color:#000000 }
  .normal { background-color: #CCCCCC }
  .highlight { background-color: #8888FF }
</style>




</head>
<body>
<div id="wrapper">
<div id="header">

<img style="float:left;margin-left:5px;margin-top:5px;" src="virungalogo.png" alt="" height=100px /> 
<!-- <img src="banner.png" alt="" />-->
<h1>VIRUNGA EXPRESS</h1>
<h2>Reporting System</h2>
</div>
<div id="horizMenu">
<ul class="ullisthorizMenu">
<li><a href="greport.php">Home</a></li>
<li>|</li>
<li><a href="reguser.php">Users Settings</a></li>
<li>|</li>
<li><a href="regcars.php">Cars Settings</a></li>
<li>|</li>
<li><a href="stoset.php">Stock Settings</a></li>
<li>|</li>
<li><a href="regdestination.php">Destinations Settings</a></li>
</ul>
</div>

<div id="contents">

<?php
include'connect.php';
$query=mysqli_query($conn,"SELECT * FROM fuel_price where Branch='KIGALI' ORDER BY fuel_price_id DESC limit 1");
if($num=mysqli_num_rows($query)){
$row=mysqli_fetch_assoc($query);

$fromDate=$row['date'];
$dat=date("Y-m-d");
$pric=$row['price'];
$Branch=$row['Branch'];
print("<font color='green'><b>Current price from $fromDate is $pric /L  at $Branch </b></font><br />");

}
$query=mysqli_query($conn,"SELECT * FROM fuel_price where Branch='RUBAVU' ORDER BY fuel_price_id DESC limit 1");
if($num=mysqli_num_rows($query)){
$row=mysqli_fetch_assoc($query);

$fromDate=$row['date'];
$dat=date("Y-m-d");
$pric=$row['price'];
$Branch=$row['Branch'];
print("<font color='green'><b>Current price from $fromDate is $pric /L  at $Branch </b></font><br />");


}
?>	




<CENTER>
<FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS">
		
<U>FILL THE FORM TO SAVE VEHICULE FUEL CONSUMPTION</U></FONT><BR><BR>
		<FORM METHOD="POST" ACTION="settings.php" onsubmit="return checkform(this);">
		<font face="verdana" size="2">
		Date / Price / Branch : </font><INPUT TYPE="text" NAME="date" SIZE="15" id='SelectedDate' onClick='GetDate(this)' STYLE='border-color:#45E01F'>&nbsp;<INPUT TYPE="text" NAME="price" SIZE="5">
<select name="branch"><option value="KIGALI">KIGALI</option><option value="RUBAVU">RUBAVU</option></select>		
		<INPUT TYPE="submit" name="save" value="CONTINUE">
	</FORM>
	
	
	<hr>
	
	
<U>FILL THE FORM TO SAVE DRIVE</U></FONT><BR><BR>
		<FORM METHOD="POST" ACTION="settings.php" onsubmit="return checkform(this);">
		<font face="verdana" size="2">
		Name: </font><INPUT TYPE="text" NAME="name" SIZE="15" STYLE='border-color:#45E01F'>&nbsp;Plate No.:<INPUT TYPE="text" NAME="plate" SIZE="5">
		<INPUT TYPE="submit" name="savedriver" value="CONTINUE">
	</FORM>
	
	<hr>	
	<?php
if(isset($_POST['save']))
	{
		$date=$_POST['date'];
		$price=$_POST['price'];
		$branch=$_POST['branch'];

include'connect.php';
$insertPrice=mysqli_query($conn,"insert into fuel_price(date,price,Branch) values ('$date','$price','$branch')");

print("<B><FONT COLOR=#FF0000><CENTER>$price is saved as fuel price at $branch</A></FONT></B>");
			
	}
?>

<?php
if(isset($_POST['savedriver']))
	{
		$name=$_POST['name'];
		$plate=$_POST['plate'];

include'connect.php';
$pass=mysqli_query($conn,"SELECT * FROM driver WHERE Name='$name' AND Plaque='$plate'");
$nu=mysqli_num_rows($pass);
if(!$nu)
		{
//$validpendquery=mysqli_query($conn,"update storepending set validated='YES' where Pendingid='$pendId' and Approved!='YES'");


$insertPrice=mysqli_query($conn,"insert into driver(Name,Plaque) values ('$name','$plate')");

print("<B><CENTER>$name is saved on $plate</A></B>");
			
	}else {
		
		print("<B><FONT COLOR=#FF0000><CENTER>$name exist on $plate</A></FONT></B>");
}
}
?>
</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>