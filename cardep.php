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
<script language="JavaScript" type="text/javascript">

function checkform (form)
{
	if(form.depart.value=="")
	{
		alert("Please select the date!");
		form.depart.focus();
		return false;
	}
	if(form.hour.value=="")
	{
		alert("Please select the time!");
		form.hour.focus();
		return false;
	}
	if(form.min.value=="")
	{
		alert("Please select the time!");
		form.min.focus();
		return false;
	}
	if(form.plaque.value=="")
	{
		alert("Please select the plaque!");
		form.plaque.focus();
		return false;
	}
	if(form.driver.value=="")
	{
		alert("Please enter driver's name!");
		form.driver.focus();
		return false;
	}
	if(form.source.value=="")
	{
		alert("Please select the source!");
		form.source.focus();
		return false;
	}
	if(form.destin.value=="")
	{
		alert("Please select the destination!");
		form.destin.focus();
		return false;
	}
	if(form.loc1.value=="")
	{
		alert("Please select any location!");
		form.loc1.focus();
		return false;
	}
	if(form.passe1.value=="")
	{
		alert("Please enter number of passengers!");
		form.passe1.focus();
		return false;
	}
	return true;
}

</script>
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
<li><a href="distroysession.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;
<FONT COLOR="#66CC33"><?php
print("Welcome ".$_SESSION['name']);
?></FONT>&nbsp;&nbsp;</li>
</ul>
</div>
<div id="contents">
<FORM ACTION="cardep.php" METHOD="post" onsubmit="return checkform(this);">
<BR><CENTER><U><FONT COLOR="#3090C7" SIZE="2" FACE="COMIC SANS MS">CAR DEPARTURE</U></FONT><BR><BR>
 <CENTER><TABLE WIDTH="85%"><TR>

<?php $Date=date("Y-m-d"); 
print("<TD>Due Date:</TD><TD><INPUT TYPE=text SIZE=16 NAME=depart id='SelectedDate' onClick='GetDate(this)' STYLE='border-color:#45E01F' VALUE='$Date'>"); ?></TD>
<TD>Driver :</TD><TD><INPUT TYPE="text" NAME="driver" SIZE="18"></TD>
<TD>Location :</TD><TD><SELECT NAME="loc1" style="width:4em">
<OPTION VALUE="" SELECTED> 

	<?php
include'connect.php';
$des=mysqli_query($conn,"SELECT Source FROM destination GROUP BY Source ORDER BY Source ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $loc=$res['Source'];
	  print("<OPTION VALUE=$loc>$loc");
  }
print("</SELECT>&nbsp;&nbsp;<SELECT NAME=loc2 style='width:4em'>
<OPTION VALUE='' SELECTED>");
$des=mysqli_query($conn,"SELECT Source FROM destination GROUP BY Source ORDER BY Source ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $loc=$res['Source'];
	  print("<OPTION VALUE=$loc>$loc");
  }
?>	
</SELECT></TD></TR>
<TR><TD>Dep. Time :</TD>
<TD><SELECT NAME="hour"><OPTION VALUE=""> Hour <OPTION VALUE=05> 05<OPTION VALUE=06> 06<OPTION VALUE=07> 07<OPTION VALUE=08> 08
<OPTION VALUE=09> 09<OPTION VALUE=10> 10<OPTION VALUE=11> 11<OPTION VALUE=12> 12<OPTION VALUE=13> 13<OPTION VALUE=14> 14<OPTION VALUE=15> 15
<OPTION VALUE=16> 16<OPTION VALUE=17> 17<OPTION VALUE=18> 18 <OPTION VALUE=19> 19 <OPTION VALUE=20> 20 <OPTION VALUE=21> 21</SELECT>&nbsp;<B>:</B> 
<SELECT NAME="min"><OPTION VALUE=""> Min &nbsp;<OPTION VALUE=00> 00<OPTION VALUE=15> 15<OPTION VALUE=30> 30
<OPTION VALUE=45> 45</SELECT></TD>
<TD>Source :</TD><TD>
<SELECT NAME="source" style="width:10em">
<OPTION VALUE="" SELECTED>
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
<TD>Passenger :</TD><TD><INPUT TYPE="text" NAME="passe1" SIZE="5" STYLE='border-color:#FF0000'>
<INPUT TYPE="text" NAME="passe2" SIZE="5" STYLE='border-color:#FF0000'></TD></TR>

<TR><TD>Plaque :</TD><TD><SELECT NAME="plaque">
<OPTION VALUE="" SELECTED> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php
include'connect.php';
$des=mysqli_query($conn,"SELECT Carid FROM cars ORDER BY Carid ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $loc=$res['Carid'];
	  print("<OPTION VALUE=$loc>$loc");
  }
?>	
</SELECT></TD>
<TD>Destination :</TD><TD><SELECT NAME="destin" style="width:10em">
<OPTION VALUE="" SELECTED>
<?php
include'connect.php';
$des=mysqli_query($conn,"SELECT Destin FROM destination GROUP BY Destin ORDER BY Destin ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $loc=$res['Destin'];
	  print("<OPTION VALUE=$loc>$loc");
  }
  ?>
</SELECT></TD>
<TD>Promation :</TD><TD><INPUT TYPE="text" NAME="prom1" SIZE="5" STYLE='border-color:#FF0000'>
<INPUT TYPE="text" NAME="prom2" SIZE="5" STYLE='border-color:#FF0000'></TD></TR></TABLE><BR>
<HR WIDTH="88%">
<DIV ALIGN="RIGHT"><INPUT TYPE="submit" NAME="save" VALUE="&nbsp;&nbsp;&nbsp;SAVE&nbsp;&nbsp;&nbsp;">&nbsp;&nbsp;<INPUT TYPE="reset" VALUE="CANCEL">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</DIV>

</FORM>
<BR>
<DIV id="over">
<?php
if(isset($_POST['save']))
	{
        $depart=$_POST['depart'];
		$hour=$_POST['hour'];
		$min=$_POST['min'];
		$plaque=$_POST['plaque'];
		$driver=$_POST['driver'];
		$source=$_POST['source'];
		$destin=$_POST['destin'];
		$loc1=$_POST['loc1'];
		$loc2=$_POST['loc2'];
		$pase1=$_POST['passe1'];
		$pase2=$_POST['passe2'];
		$prom1=$_POST['prom1'];
		$prom2=$_POST['prom2'];
		$passe1=$pase1+$prom1;
		$passe2=$pase2+$prom2;
		$tim="$hour:$min";
		$sps=$_SESSION['passe'];

include'connect.php';
$spro=mysqli_query($conn,"SELECT Location FROM users WHERE Passwo='$sps'");
$sro=mysqli_fetch_assoc($spro);
		{
			$slo=$sro['Location'];
		}
	
	if($slo==$source OR $slo=='ADMIN'){
$mt=mysqli_query("SELECT Place FROM cars WHERE CARNO='$plaque'");
$rt=mysqli_fetch_assoc($mt);
		{
			$nt=$rt['Place'];
		}
$op=mysqli_query($conn,"SELECT *FROM operation WHERE DDate='$depart' AND Time='$tim' AND Plaque='$plaque'");
$rto=mysqli_fetch_assoc($op);
		{
			$ps1=$rto['Passe1'];
			$ps2=$rto['Passe2'];
			$tp=$ps1+$ps2;
		}
		$fr=$nt-($tp+$passe1+$passe2);
		$av=$nt-$tp;
		if($fr<0){
			print("<BR><BR><BR><BR><CENTER><FONT COLOR=#FF0000><B>Places not avalaible, total number of avalaible places : $av</B></FONT></CENTER>");
		}
		else{
$check=mysqli_query($conn,"SELECT *FROM operation WHERE DDate='$depart' AND Time='$tim' AND Plaque='$plaque' AND Source='$source'");
$num=mysqli_num_rows($check);
if(!$num)
		{
	$cd1=mysqli_query($conn,"SELECT *FROM location WHERE Code='$loc1'");
	$cdr1=mysqli_fetch_assoc($cd1);
			{
	        $location1=$cdr1['Location'];
			}
	$cd2=mysqli_query($conn,"SELECT *FROM location WHERE Code='$loc2'");
	$cdr2=mysqli_fetch_assoc($cd2);
			{
	        $location2=$cdr2['Location'];
			}
	$pr1=mysqli_query($conn,"SELECT *FROM destination WHERE Source='$source' AND Destin='$location1'");
	$prr1=mysqli_fetch_assoc($pr1);
			{
	        $price1=$prr1['Price'];
			}
	$pr2=mysqli_query($conn,"SELECT *FROM destination WHERE Source='$source' AND Destin='$location2'");
	$prr2=mysqli_fetch_assoc($pr2);
			{
	        $price2=$prr2['Price'];
			}
	$amount1=$pase1*$price1;
	$amount2=$pase2*$price2;
	
$do=mysqli_query($conn,"INSERT INTO operation (DDate,Time,Plaque,Driver,Source,Destin,Loc1,Passe1,Amount1,Loc2,Passe2,Amount2,Operator) VALUES ('$depart','$tim','$plaque','$driver','$source','$destin','$loc1','$passe1','$amount1','$loc2','$passe2','$amount2','$operator')");
print("<CENTER><TABLE WIDTH=98%>
<TR><TH>DATE</TH><TH>TIME</TH><TH>PLAQUE</TH><TH>DRIVER</TH><TH>SOURCE</TH><TH>DESTINATION</TH><TH>TOTAL</TH><TH>OPERATOR</TH></TR>
<TR><TD COLSPAN=8><HR></TH></TR>");
$dis=mysqli_query($conn,"SELECT *FROM operation WHERE DDate='$depart' AND Source='$source' ORDER BY Time DESC");
while($resi=mysqli_fetch_assoc($dis))
			{
	$N1=$resi['DDate'];
	$N2=$resi['Time'];
	$N3=$resi['Plaque'];
	$N4=$resi['Driver'];
	$N5=$resi['Source'];
	$N6=$resi['Destin'];
	$N7=$resi['Passe1'];
	$N8=$resi['Passe2'];
	$N9=$resi['Operator'];
	$N10=$N7+$N8;
	if($n%2==0)
	 {
print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'>
<TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD><TD>&nbsp;&nbsp;$N4</TD><TD>&nbsp;&nbsp;$N5</TD>
<TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N10</TD><TD>&nbsp;&nbsp;$N9</TD></TR>");
	 }
	 else
	  {
print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'>
<TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD><TD>&nbsp;&nbsp;$N4</TD><TD>&nbsp;&nbsp;$N5</TD>
<TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N10</TD><TD>&nbsp;&nbsp;$N9</TD></TR>");
	  }
	  $n++;
			}
print("</TABLE></CENTER>");

		}
		else
		{
			print("<BR><BR><BR><BR><BR><CENTER><FONT COLOR=#FF0000>Transaction already exist ...</FONT></CENTER>");
		}
		}
		}
		else
		{
			print("<BR><BR><BR><BR><BR><CENTER><FONT COLOR=#FF0000>You are not allowed to do that operation ...</FONT></CENTER>");
		}
	}
?>
</DIV>
</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>