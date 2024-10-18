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
<li><a href="distroysession.php">Log out</a>&nbsp;&nbsp;&nbsp;&nbsp;
<FONT COLOR="#66CC33"><?php
print("Welcome ".$_SESSION['name']);
?></FONT>&nbsp;&nbsp;</li>
</ul>
</div>
<div id="contents">
<CENTER><FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS"><BR>
<U>EXPENSES ON A VEHICULE</U></FONT><BR>

<TABLE WIDTH="98%" BORDER="1"><TR>
<TD WIDTH="50%">
 <CENTER><TABLE><TR><FORM ACTION="expens.php" onsubmit="return checkform(this);" METHOD="post">
		<TD colspan=2><FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS"><BR>
		<CENTER><U>MATERIAL CONSUMPTION</U></CENTER><BR></TD>
	</TR>
	<TR>
		<TD>Spare Part</TD>
			<TD>:&nbsp;<SELECT NAME="item">
	<OPTION VALUE="" SELECTED>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;
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
			<TD>Specification &nbsp;&nbsp;</TD>
			<TD>:&nbsp;<SELECT NAME="spec">
	<OPTION VALUE="" SELECTED>
	<?php
include'connect.php';
$des=mysqli_query($conn,"SELECT spec FROM spares WHERE Spec!='' order by Spec ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $spec=$res['spec'];
	  print("<OPTION VALUE=$spec>$spec");
  }
?>	
</SELECT> <SELECT NAME="trans">
	<OPTION VALUE="-">&nbsp;&nbsp;-
	<OPTION VALUE="AVANT">AVANT
	<OPTION VALUE="ARRIERE">ARRIERE
</SELECT></TR>
	<TR>
		<TD>Quantity</TD>
		<TD>:&nbsp;<INPUT TYPE="text" NAME="quant" SIZE="25" STYLE="border-color:#45E01F"></TD>
	</TR>
	 <TR><TD>Unit Price</TD>
	    <TD>:&nbsp;<INPUT TYPE="text" NAME="amount" SIZE="25" STYLE="border-color:#45E01F"></TD>
	  </TR>
	<TR>
		<TD>Consumer</TD>
		<TD>:&nbsp;<SELECT NAME="plaque">
<OPTION VALUE="" SELECTED> 

	<?php
include'connect.php';
$des=mysqli_query($conn,"SELECT Carid FROM cars order by Carid ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $loc=$res['Carid'];
	  print("<OPTION VALUE=$loc>&nbsp;&nbsp;&nbsp; $loc &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
  }
?>	
<OPTION VALUE="STOCK_MUSANZE">STOCK_MUSANZE
<OPTION VALUE="STOCK_RUBAVU">STOCK_RUBAVU
<OPTION VALUE="STOCK_GICUMBI">STOCK_GICUMBI
<OPTION VALUE="KIGALI_VMT_VCE">KIGALI_VMT&VCE
<OPTION VALUE="KIGALI_CASHPOWER">KIGALI_CASHPOWER
<OPTION VALUE="MUSANZE_VMT_VCE">MUSANZE_VMT&VCE
<OPTION VALUE="RUBAVU_VMT_VCE_CP">RUBAVU_VMT&VCE
<OPTION VALUE="GICUMBI_VMT_VCE_CP">GICUMBI_VMT&VCE
<OPTION VALUE="NYABUGOGO_VMT_VCE">NYABUGOGO_VMT
<OPTION VALUE="RWAMAGANA_VMT">RWAMAGANA_VMT
<OPTION VALUE="GOMA_VMT">GOMA_VMT
</SELECT></TD>
	</TR>
	<TR>
		<TD>Document</TD>
		<TD>:&nbsp;<INPUT TYPE="text" NAME="piece" SIZE="25" STYLE="border-color:#45E01F"></TD>
	</TR>
	<TR>
		<TD>Due Date</TD>
		<?php $Date=date("Y-m-d");
		PRINT("<TD>:&nbsp;<INPUT TYPE=text NAME=dat SIZE=25 id='SelectedDate' onClick='GetDate(this)' STYLE='border-color:#45E01F' VALUE=$Date></TD>");
		?>
	</TR>
	<TR>
		<TD>Confirmation</TD>		
		<TD>:&nbsp;<INPUT TYPE="password" NAME="paswd" style="background-color:#FFFFC0;border-color:Black" SIZE="25"></TD>		
	</TR></TABLE><BR>
	<HR WIDTH="88%" COLOR="#3090C7">
<CENTER><INPUT TYPE="submit" NAME="save" VALUE="&nbsp;&nbsp;&nbsp;SEND&nbsp;&nbsp;&nbsp;">&nbsp;&nbsp;<INPUT TYPE="reset" VALUE="CANCEL">

</TD></FORM>
<TD>

 <CENTER><TABLE><TR><FORM ACTION="expens.php" onsubmit="return checkforme(this);" METHOD="post">
		<TD colspan="2"><FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS"><BR>
		<CENTER><U>EXPENSES MADE</U></CENTER><BR></TD>
	</TR>
	<TR>
		<TD>Expenses</TD><TD>:&nbsp;<TEXTAREA NAME="expe" ROWS="2" COLS="19"></TEXTAREA></TD></TR>
		<TR><TD>Specification &nbsp;&nbsp;</TD><TD>:&nbsp;<SELECT NAME="spece">
			<OPTION VALUE="" SELECTED>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<OPTION VALUE="Reparation">Reparation
			<OPTION VALUE="Police_Fine">Police_Fine
			<OPTION VALUE="Washing">Washing
		</SELECT></TD></TR>
		<TR>
		<TD>Consumer</TD>
		<TD>:&nbsp;<SELECT NAME="consu">
<OPTION VALUE="" SELECTED> 

	<?php
include'connect.php';
$des=mysqli_query($conn,"SELECT Carid FROM cars order by Carid ASC");
while($res=mysqli_fetch_assoc($des))
  {
	  $loc=$res['Carid'];
	  print("<OPTION VALUE=$loc>&nbsp;&nbsp;&nbsp; $loc &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
  }
?>	
<OPTION VALUE="STOCK_MUSANZE">STOCK_MUSANZE
<OPTION VALUE="STOCK_RUBAVU">STOCK_RUBAVU
<OPTION VALUE="STOCK_GICUMBI">STOCK_GICUMBI
<OPTION VALUE="KIGALI_VMT_VCE">KIGALI_VMT&VCE
<OPTION VALUE="KIGALI_CASHPOWER">KIGALI_CASHPOWER
<OPTION VALUE="MUSANZE_VMT_VCE">MUSANZE_VMT&VCE
<OPTION VALUE="RUBAVU_VMT_VCE_CP">RUBAVU_VMT&VCE
<OPTION VALUE="GICUMBI_VMT_VCE_CP">GICUMBI_VMT&VCE
<OPTION VALUE="NYABUGOGO_VMT_VCE">NYABUGOGO_VMT
<OPTION VALUE="RWAMAGANA_VMT">RWAMAGANA_VMT
<OPTION VALUE="GOMA_VMT">GOMA_VMT
</SELECT></TD>
	</TR>
      <TR><TD>Amount</TD>
	    <TD>:&nbsp;<INPUT TYPE="text" NAME="am" SIZE="25" STYLE="border-color:#45E01F"></TD>
	  </TR>
      <TR>
		<TD>Document</TD>
		<TD>:&nbsp;<INPUT TYPE="text" NAME="doc" SIZE="25" STYLE="border-color:#45E01F"></TD>
	</TR>
	<TR>
		<TD>Due Date</TD>
		<?php $Date=date("Y-m-d");
		PRINT("<TD>:&nbsp;<INPUT TYPE=text NAME=dato SIZE=25 id='SelectedDate' onClick='GetDate(this)' STYLE='border-color:#45E01F' VALUE=$Date></TD>");
		?>
	</TR>
	<TR>
		<TD>Confirmation</TD>		
		<TD>:&nbsp;<INPUT TYPE="password" NAME="pasword" style="background-color:#FFFFC0;border-color:Black" SIZE="25"></TD>		
	</TR>
    </TR></TABLE><BR>
	<HR WIDTH="88%" COLOR="#3090C7">
   <CENTER><INPUT TYPE="submit" NAME="saver" VALUE="&nbsp;&nbsp;&nbsp;SEND&nbsp;&nbsp;&nbsp;">&nbsp;&nbsp;<INPUT TYPE="reset" VALUE="CANCEL">
<BR><BR>
</TD></FORM></TR></TABLE>
</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>