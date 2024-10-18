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
<script language="JavaScript" type="text/javascript">

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
<div id="contents">
<FORM ACTION="transaction.php" onsubmit="return checkforme(this);" METHOD="Post">
<DIV ALIGN="RIGHT"><TABLE><TR><TD><FIELDSET BORDERCOLOR="#3090C7">
<TABLE BORDER="0" BGCOLOR="GREEN"><TR>
<TD><FONT COLOR="FFFFFF"><B>Select Transaction&nbsp;&nbsp;</FONT></TD><TD><SELECT NAME="nloc">
<OPTION VALUE="" SELECTED>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
include'connect.php';
$des=mysqli_query($conn,"SELECT Source FROM destination GROUP BY Source ORDER BY Source ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $loc=$res['Source'];
	  print("<OPTION VALUE=$loc>$loc");
  }
  ?>
</SELECT></TD>        
 <TD><?php $Date=date("Y-m-d");
 print("&nbsp;&nbsp;<INPUT TYPE=text SIZE=25 NAME=dat1 id='SelectedDate' onClick='GetDate(this)' STYLE='border-color:#45E01F' VALUE='$Date'>&nbsp;");
 ?>
 </TD>
 <TD><INPUT TYPE="submit" NAME="search" VALUE="&nbsp;&nbsp;&nbsp;&nbsp;DISPLAY&nbsp;&nbsp;&nbsp;&nbsp;">
 </TD></TR></FORM></TABLE></FIELDSET></TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR></TABLE></DIV></FORM>
<CENTER><BR><DIV id="overi">
<?php
 if(isset($_POST['search']))
	{
        $dat1=$_POST['dat1'];
		$nloc=$_POST['nloc'];
        $spas=$_SESSION['passe'];
		include'connect.php';
		$sps=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$spas'");
	    $rps=mysqli_fetch_assoc($sps);
		{
			$sloca=$rps['Location'];
			$sacc=$rps['Access'];
		}
		if($sloca=='ADMIN' OR $sloca==$nloc){
  include'connect.php';
  $nql=mysqli_query($conn,"SELECT *FROM operation WHERE DDate='$dat1' AND Source='$nloc' ORDER BY Time ASC");
  $cout=mysqli_num_rows($nql);
  if($cout)
		{
  print("<CENTER><U><FONT COLOR=#3090C7 SIZE=3 FACE=COMIC SANS MS>CAR DEPARTURE TRANSACTIONS ON $dat1</U></FONT><BR>
   <BR><TABLE WIDTH=98%><TR>
  <TH></TH><TH>DATE</TH><TH>TIME</TH><TH>PLAQUE</TH><TH>DRIVER</TH><TH>SOURCE</TH><TH>DESTINATION</TH><TH>TOTAL</TH><TH>AMOUNT</TH></TR>
  <TR><TD COLSPAN=9><HR></TD></TR>");
  
  while($row=mysqli_fetch_assoc($nql))
  {
  $N0=$row['DDate'];
  $N1=$row['Time'];
  $N2=$row['Plaque'];
  $N3=$row['Driver'];
  $N5=$row['Source'];
  $N6=$row['Destin'];
  $N7=$row['Number'];
  $N8=$row['Passe1'];
  $N9=$row['Passe2'];
  $N10=$N9+$N8;
  $N11=$row['Amount1'];
  $N12=$row['Amount2'];
  $N13=$N11+$N12;
  $N14=number_format($N13);
  if($n%2==0)
	 {
    print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'><FORM ACTION=nchange.php METHOD=post>
           <TD WIDTH=5%><INPUT TYPE=hidden NAME=num VALUE=$N7><button form=delete name=delete>Delete</button>
	</TD><TD>&nbsp;&nbsp;$N0</TD><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD>
	<TD>&nbsp;&nbsp;$N5</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N10</TD><TD>&nbsp;&nbsp;$N14</TD></FORM></TR>");
	 }
	 else
	  {
	print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'><FORM ACTION=nchange.php METHOD=Post>
               <TD WIDTH=5%><INPUT TYPE=hidden NAME=num VALUE=$N7><button form=delete name=delete>Delete</button>
	</TD><TD>&nbsp;&nbsp;$N0</TD><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD>
	<TD>&nbsp;&nbsp;$N5</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N10</TD><TD>&nbsp;&nbsp;$N14</TD></FORM></TR>");
	  }
	  $n++;
  }
  print("</TABLE></div>");
		}
		else
		{
			print("<BR><BR><BR><BR><BR><BR><BR><BR><FONT COLOR=#FF0000>No result to be displayed ...</FONT>");
		}
		}
		else{
			print("<BR><BR><BR><BR><BR><BR><BR><CENTER><FONT COLOR=#FF0000>Sorry! You are not allowed to do that operation ...</FONT></FONT></CENTER>");
		}
		}
  ?>

</TD></TR></TABLE>
</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>