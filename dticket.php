<?php
session_start();
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
	if(form.quant.value=="")
	{
		alert("Please enter the quantity!");
		form.quant.focus();
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
function cUpper(cObj) 
{
cObj.value=cObj.value.toUpperCase();
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
<li><a href="operations.php">Home</a></li>
<li>|</li>
<li><a href="entry.php">Stock Entry</a></li>
<li>|</li>
<li><a href="exit.php">Stock Exit</a></li>
<li>|</li>
<li><a href="ticket.php">Ticket</a></li>
<li>|</li>
<li><a href="sreport.php">Report</a></li>
<li>|</li>
<li><a href="distroysession.php">Log out</a>&nbsp;&nbsp;&nbsp;&nbsp;
<FONT COLOR="#66CC33"><?php
print("Welcome ".$_SESSION['name']);
?></FONT>&nbsp;&nbsp;</li>
</ul>
</div>

<div id="contents">
<FORM ACTION="dticket.php" onsubmit="return checkform(this);" METHOD="post">
<CENTER><TABLE WIDTH="90%"><TR><TD WIDTH="50%">
<FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS"><BR><br><CENTER><U>TICKET DISTRIBUTION</U></FONT><BR><BR>
<TABLE><TR><TD>
            Ticket No</TD><TD>: <input type="text" name="tno"></TD></TR>
    <TR><TD>Starting No</TD><TD>: <input type="text" name="snum"></TD></TR>
	<TR><TD>Ending No</TD><TD>: <input type="text" name="enum"></TD></TR>
	<TR><TD>Saler</TD><TD>: <input type="text" name="saler" OnKeyup="return cUpper(this);"></TD></TR>
	<TR><TD COLSPAN="2"><br><CENTER><input type="submit" name="dticke" value="SEND" style='height:1.6em; width:6em;' />
	 <input type="reset" value="CANCEL" style='height:1.6em; width:6em;' /></TD></TR></TABLE></FORM>
	
	</TD><FORM ACTION="dticket.php" onsubmit="return checkform(this);" METHOD="post">
<TD><FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS"><BR><CENTER><U>TICKET CONTROL</U></FONT><BR><BR>
<TABLE><TR><TD>Ticket Number</TD><TD> : <SELECT NAME="tnume">
	<OPTION VALUE="" SELECTED> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php
include'connect.php';
$des=mysqli_query($conn,"SELECT Tnum FROM ticke WHERE Sold='0' AND Send='0' ORDER BY Tnum ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $no=$res['Tnum'];
	  print("<OPTION VALUE=$no>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$no");
  }
?>	
</SELECT></TD></TR>
<TR><TD>Ending No</TD><TD>: <input type="text" name="eno"></TD></TR>
<TR><TD COLSPAN="2"><br><CENTER><input type="submit" name="dticket" value="SEND" style='height:1.6em; width:6em;' />
	 <input type="reset" value="CANCEL" style='height:1.6em; width:6em;' /></TD></TR></TABLE>
</TD>
	</TR>
	</TABLE><br><br>
	<HR WIDTH="80%" style="border : none;
                      border-top : dashed 1px cyan;
                      color : #FFFFFF ;
                      background-color : #FFFFFF ;
                      height : 1px;"><br>
	 <?php
if(isset($_POST['dticke']))
	{
        $snum=$_POST['snum'];
		$enum=$_POST['enum'];
		$tno=$_POST['tno'];
        $op=$_SESSION['name'];
		$saler=$_POST['saler'];
		$tot=$enum-$snum+1;
       include'connect.php';
	   $look=mysqli_query($conn,"SELECT *FROM ticket WHERE Number='$tno'");
	   $sook=mysqli_num_rows($look);
	   if(!$sook)
           print("<CENTER><FONT SIZE=4 COLOR=#FF0000 FACE=COMIC SANS MS><br><br>Ticket number does not exist ...</FONT>");
	   else{
	   $see=mysqli_query($conn,"SELECT *FROM ticke WHERE Tnum='$tno' AND Sold='0' AND Send='0'");
	   $seen=mysqli_num_rows($see);
	   if($seen)
		   print("<CENTER><FONT SIZE=4 COLOR=#FF0000 FACE=COMIC SANS MS><br><br>The number is already registered...</FONT>");
	   else{
	$do=mysqli_query($conn,"INSERT INTO ticke (Tnum,Start,End,Total,Saler,Date,Operator) VALUES ('$tno','$snum','$enum','$tot','$saler','$Date','$op')");
	$nc=0;
	 $count=mysqli_query($conn,"SELECT *FROM ticke WHERE Saler='$saler' AND Sold='0' AND Send='0'");
	 while($rc=mysqli_fetch_assoc($count))
		   {
		 $nc=$rc['Total'];
		 $nt=$nt+$nc;
		   }
	print("<TABLE WIDTH=70%><TR><TD><CENTER>
	<FIELDSET>Starting from : $snum<br>Ending to : $enum<br><br><B>
	<FONT SIZE=4 COLOR=#3090C7>Total number of tickets : $nt</FONT></B><br><br></FIELDSET></TD></TR></TABLE>");
	   }
	   }
	}
if(isset($_POST['dticket']))
{
$tnume=$_POST['tnume'];
$eno=$_POST['eno'];
 include'connect.php';
	   $see=mysqli_query($conn,"SELECT *FROM ticke WHERE Tnum='$tnume' AND Sold='0' AND Send='0'");
	   $seen=mysqli_num_rows($see);
	   if(!$seen)
		   print("<CENTER><FONT SIZE=4 COLOR=#FF0000 FACE=COMIC SANS MS><br><br>The number is not already registered...</FONT>");
	   else{
		   $row=mysqli_fetch_assoc($see);
		   {
			   $sno=$row['Start'];
			   $saler=$row['Saler'];
		   }
		   if($eno==$sno){
			   $sold=0;
		   }
		   else{
			   $sold=$eno-$sno+1;
		   }
		   $then=mysqli_query($conn,"UPDATE ticke SET Date='$Date',Send='$eno',Sold=$sold WHERE Tnum='$tnume'");
		   $nc=0;
	 $count=mysqli_query($conn,"SELECT *FROM ticke WHERE Saler='$saler' AND Date='$Date'");
	 while($rc=mysqli_fetch_assoc($count))
		   {
		 $nc=$rc['Sold'];
		 $nt=$nt+$nc;
		   }
	print("<TABLE WIDTH=70%><TR><TD><CENTER>
	<FIELDSET>Starting from : $sno<br>Ending to : $eno<br><br><B>
	<FONT SIZE=4 COLOR=#3090C7>Total number of tickets : $nt</FONT></B><br><br></FIELDSET></TD></TR></TABLE>");
	   }
}
	?>				  
					  

</div>

</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>