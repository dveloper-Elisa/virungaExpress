<?php
session_start();
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
<script language="JavaScript" type="text/javascript">

function checkform (form)
{
	if(form.item.value=="")
	{
		alert("Please select a spare part!");
		form.item.focus();
		return false;
	}
	if(form.spec.value=="")
	{
		alert("Please select a specification!");
		form.spec.focus();
		return false;
	}
	if(form.trans.value=="")
	{
		alert("Please specify more!");
		form.trans.focus();
		return false;
	}
	if(form.quant.value=="")
	{
		alert("Please enter the quantity!");
		form.quant.focus();
		return false;
	}
	if(form.amount.value=="")
	{
		alert("Please enter an amount!");
		form.amount.focus();
		return false;
	}
	if(form.plaque.value=="")
	{
		alert("Please select a consumer!");
		form.plaque.focus();
		return false;
	}
	if(form.paswd.value=="")
	{
		alert("Please enter your confirmation key!");
		form.paswd.focus();
		return false;
	}
	return true;
}

function checkforme (form)
{
	if(form.expe.value=="")
	{
		alert("Please specify the expenses made!");
		form.expe.focus();
		return false;
	}
	if(form.spece.value=="")
	{
		alert("Please select a specification!");
		form.spece.focus();
		return false;
	}
	if(form.consu.value=="")
	{
		alert("Please select a consumer!");
		form.consu.focus();
		return false;
	}
	if(form.am.value=="")
	{
		alert("Please enter the total amount!");
		form.am.focus();
		return false;
	}
	
	if(form.pasword.value=="")
	{
		alert("Please enter your confirmation key!");
		form.pasword.focus();
		return false;
	}
	return true;
}

</script>
<script language="JavaScript" type="text/javascript">
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
<li><a href="entry.php">Stock Entry</a></li>
<li>|</li>
<li><a href="exit.php">Stock Exit</a></li>
<li>|</li>
<li><a href="expense.php">Expenses</a></li>
<li>|</li>
<li><a href="sreport.php">Report</a></li>
<li>|</li>
<li><a href="distroysession.php">Log out</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<FONT COLOR="#66CC33"><?php
print("Welcome ".$_SESSION['name']);
?></FONT>&nbsp;&nbsp;</li>
</ul>
</div>
<div id="contents">

<FORM ACTION="expense.php">
<CENTER><FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS"><BR>
<U>EXPENSES ON A VEHICULE</U> :

 <?php
if(isset($_POST['save']))
	{
        $item=$_POST['item'];
		$spec=$_POST['spec'];
		$quant=$_POST['quant'];
		$amount=$_POST['amount'];
		$plaque=$_POST['plaque'];
		$piece=$_POST['piece'];
		$dat=$_POST['dat'];
		$paswd=$_POST['paswd'];
		$amoun=number_format($amount);

include'connect.php';
$pass=mysqli_query($conn,"SELECT *FROM users WHERE ((Passwo='$paswd' AND Access='2') OR (Passwo='$paswd' AND Location='ADMIN'))");
$nu=mysqli_num_rows($pass);
if($nu)
		{
	$row=mysqli_fetch_assoc($pass);
			{
				$loc=$row['Location'];
				if($loc=='ADMIN')
					$loc='KIGALI';
				$name=$row['Lname'];
			}
$d01=mysqli_query($conn,"INSERT INTO store (DDate,Item,Spec,Trans,Quantity,Price,Plaque,Status,Document,Location,Operator) VALUES ('$dat','$item','$spec','$trans','$quant','$amount','$plaque',2,'$piece','$loc','$name')");


print("<U>MATERIAL CONSUMPTION</U></FONT>
       <BR><BR><CENTER><TABLE WIDTH=38%><TR>
		<TR><TD>Spare Part</TD><TD>:&nbsp;$item</TD></TR>
		<TR><TD>Specification &nbsp;&nbsp;</TD><TD>:&nbsp;$spec</TD></TR>
		<TR><TD>Quantity</TD><TD>:&nbsp;$quant</TD></TR>
		<TR><TD>Unit Price</TD><TD>:&nbsp;$amoun Rwf</TD></TR>
		<TR><TD>Consumer</TD><TD>:&nbsp;$plaque</TD></TR>
		<TR><TD>Document</TD><TD>:&nbsp;$piece</TD></TR>
		<TR><TD>Due Date</TD><TD>:&nbsp;$dat</TD></TR></TABLE><BR>
		<HR WIDTH=60% COLOR=#3090C7>
		<INPUT TYPE=submit VALUE=&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>");
		}
		else
		{
			print("<B><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		           <FONT COLOR=#FF0000>Invalid confirmation key! <FONT=#9999CC>
				   <A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></B>");
		}
	}


	if(isset($_POST['saver']))
	{
        $expe=$_POST['expe'];
		$spece=$_POST['spece'];
		$consu=$_POST['consu'];
		$am=$_POST['am'];
		$doc=$_POST['doc'];
		$dato=$_POST['dato'];
		$pasword=$_POST['pasword'];
		$amt=number_format($am);

include'connect.php';
$pass=mysqli_query($conn,"SELECT *FROM users WHERE ((Passwo='$pasword' AND Access='2') OR (Passwo='$pasword' AND Location='ADMIN'))");
$nu=mysqli_num_rows($pass);
if($nu)
		{
	$row=mysqli_fetch_assoc($pass);
			{
				$loc=$row['Location'];
				if($loc=='ADMIN')
					$loc='ADMIN';
				$name=$row['Lname'];
			}
$d01=mysqli_query("INSERT INTO store (DDate,Item,Spec,Quantity,Price,Plaque,Status,Document,Location,Operator) VALUES ('$dato','$expe','$spece','1','$am','$consu',2,'$doc','$loc','$name')");


print("<U>EXPENSES MADE</U></FONT>
       <BR><BR><CENTER><TABLE WIDTH=38%><TR>
		<TR><TD>Expenses</TD><TD>:&nbsp;$expe</TD></TR>
		<TR><TD>Specification &nbsp;&nbsp;</TD><TD>:&nbsp;$spece</TD></TR>
		<TR><TD>Amount</TD><TD>:&nbsp;$amt Rwf</TD></TR>
		<TR><TD>Consumer</TD><TD>:&nbsp;$consu</TD></TR>
		<TR><TD>Document</TD><TD>:&nbsp;$doc</TD></TR>
		<TR><TD>Due Date</TD><TD>:&nbsp;$dato</TD></TR></TABLE><BR>
		<HR WIDTH=60% COLOR=#3090C7>
		<INPUT TYPE=submit VALUE=&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>");
		}
		else
		{
			print("<B><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		           <FONT COLOR=#FF0000>Invalid confirmation key! <FONT=#9999CC>
				   <A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></B>");
		}
	}

?>
</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>