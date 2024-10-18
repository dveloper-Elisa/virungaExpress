<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>VIRUNGA EXPRESS-Reporting System</title>
<script language="JavaScript" type="text/javascript">
function cUpper(cObj) 
{
cObj.value=cObj.value.toUpperCase();
}

function checkform (form)
{
	if(form.par.value=="")
	{
		alert("Please enter a spare part!");
		form.par.focus();
		return false;
	}
	if(form.spec.value=="")
	{
		alert("Please enter a specification!");
		form.spec.focus();
		return false;
	}
	if(form.pas.value=="")
	{
		alert("Please enter your confirmation key!");
		form.pas.focus();
		return false;
	}
	return true;
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
<FORM ACTION="stoset.php" onsubmit="return checkform(this);" METHOD="Post">
<BR><CENTER><BR><BR><TABLE WIDTH="90%" BORDER="1"><TR>
<TD WIDTH="50%"><CENTER>
<BR><BR><U><FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS">ENTER NEW SPARE PART</FONT></U><BR><BR><BR>
<TABLE WIDTH="80%"><TR>
<TD>Spare Part :</TD>
<TD><INPUT TYPE="text" NAME="par" SIZE="25" OnKeyup="return cUpper(this);"></TD></TR>
<TR>
<TD>Specification :</TD>
<TD><INPUT TYPE="text" NAME="spec" SIZE="25" OnKeyup="return cUpper(this);"></TD></TR>
<TR>
<TD>Confirmation :</TD>
<TD><INPUT TYPE="password" NAME="pas" style="background-color:#FFFFC0;border-color:Black" SIZE="25"></TD></TR>
</TABLE><BR><HR WIDTH="90%">
<DIV ALIGN="RIGHT"><INPUT TYPE="submit" NAME="save" VALUE="&nbsp;&nbsp;&nbsp;SAVE&nbsp;&nbsp;&nbsp;">&nbsp;&nbsp;<INPUT TYPE="reset" VALUE="CANCEL">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</DIV><BR><BR></FORM>

</TD>

<TD><CENTER>
<BR><BR><U><FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS">DELETE EXISTING SPARE PART</FONT></U><BR><BR><BR>
<TABLE WIDTH="82%"><TR>
<TD>Spare Part :</TD>
		<TD><SELECT NAME="item">
	<OPTION VALUE="" SELECTED>
			<?php
include'connect.php';
$des=mysqli_query($conn,"SELECT item FROM spares WHERE Item!='' order by Item ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $item=$res['item'];
	  print("<OPTION VALUE=$item>$item");
  }
?>	
</SELECT></TD></TR>
<TR>
			<TD>Specification :</TD>
			<TD><SELECT NAME="speci">
	<OPTION VALUE="" SELECTED>
	<?php
include'connect.php';
$des=mysqli_query($conn,"SELECT spec FROM spares WHERE spec!='' order by Spec ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $spec=$res['spec'];
	  print("<OPTION VALUE=$spec>$spec");
  }
?>	
</SELECT></TD></TR>

<TR>
		<TD>Confirmation :</TD>
		<TD><INPUT TYPE="password" NAME="paswd" style="background-color:#FFFFC0;border-color:Black" SIZE="25"></TD>
	</TR>
</TABLE><BR><HR WIDTH="90%">
<DIV ALIGN="RIGHT"><INPUT TYPE="submit" NAME="delete" VALUE="DELETE">&nbsp;&nbsp;<INPUT TYPE="reset" VALUE="CANCEL">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</DIV><BR><BR>
</TD></TR></TABLE>


<?php
if(isset($_POST['save']))
	{
        $par=$_POST['par'];
		$spec=$_POST['spec'];
		$pas=$_POST['pas'];

include'connect.php';

$pass=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$pas'");
$nu=mysqli_num_rows($pass);
if($nu)
		{
$check=mysqli_query($conn,"SELECT *FROM spares WHERE Item='$par' AND Spec='$spec'");
$num=mysqli_num_rows($check);
	if($num)
		{
print("<B><BR><BR><FONT COLOR=#FF0000>Item already exist in database ...</FONT></B>");
		}
		else
		{
		 $do=mysqli_query($conn,"INSERT INTO spares (Item,Spec,Date) VALUES ('$par','$spec','$Date')");

print("<BR><TABLE WIDTH=88% BORDER=1>
<TR>
	<TH>Due Date</TH>
	<TH>Spare Part</TH>
	<TH>Specification</TH>
</TR>
<TR>
	<TD>&nbsp;&nbsp;$Date</TD>
	<TD>&nbsp;&nbsp;$par</TD>
	<TD>&nbsp;&nbsp;$spec</TD>
</TR>
</TABLE>");

		}
		}
		else
		{
print("<B><BR><BR><FONT COLOR=#FF0000>Invalid confirmation key ...</FONT></B>");
		}
	}
	?>

</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>