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
  </SCRIPT>
<script language="JavaScript" type="text/javascript"> 
function checkform (form) 
{ 
if (form.fname.value=="")
{ 
alert("Please enter first name!"); 
form.fname.focus();
return false;
}
if (form.lname.value=="")
{ 
alert("Please enter last name!"); 
form.lname.focus();
return false;
}
if (form.tel.value=="")
{ 
alert("Please enter telephone number!"); 
form.tel.focus();
return false;
}
if (form.psword.value=="")
{ 
alert("Please enter a password!"); 
form.psword.focus();
return false;
}
if (form.loc.value=="")
{ 
alert("Please enter a location!"); 
form.loc.focus();
return false;
}
if (form.paswd.value=="")
{ 
alert("Please enter your confirmation key!"); 
form.paswd.focus();
return false;
}
return true;
}
function checkforme (form) 
{ 
if (form.name.value=="")
{ 
alert("Please enter your search!"); 
form.name.focus();
return false;
}
return true;
}
function cUpper(cObj) 
{
cObj.value=cObj.value.toUpperCase();
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
<li><a href="greport.php">Home</a></li>
<li>|</li>
<li><a href="reguser.php">Users Settings</a></li>
<li>|</li>
<li><a href="regcars.php">Cars Settings</a></li>
<li>|</li>
<li><a href="stoset.php">Stock Settings</a></li>
<li>|</li>
<li><a href="regdestination.php">Destinations Settings</a></li>
<li>|&nbsp;&nbsp;&nbsp;&nbsp;<a href="distroysession.php">Log out</a>&nbsp;&nbsp;&nbsp;&nbsp;<FONT COLOR="#66CC33"><?php
print("Welcome ".$_SESSION['name']);
?></FONT>&nbsp;&nbsp;</li>
</ul>
</div>

<div id="contents">
<FORM ACTION="search.php" onsubmit="return checkforme(this);" METHOD="Post">
<BR><DIV ALIGN="RIGHT"><TABLE><TR><TD><FIELDSET BORDERCOLOR="#3090C7">
<TABLE BORDER="0" BGCOLOR="GREEN"><TR>
<TD><FONT COLOR="FFFFFF"><B>&nbsp;&nbsp;Search for user&nbsp;&nbsp;</FONT></TD>        
 <TD><INPUT TYPE="text" SIZE="30" NAME="name">&nbsp;</TD>
 <TD><INPUT TYPE="submit" NAME="search" VALUE="&nbsp;&nbsp;&nbsp;&nbsp;SEARCH&nbsp;&nbsp;&nbsp;&nbsp;">
 </TD></TR></FORM></TABLE></FIELDSET></TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR></TABLE></DIV></FORM><BR>
 <CENTER><U><FONT COLOR="#3090C7" SIZE="2" FACE="COMIC SANS MS">FILL THIS FORM TO REGISTER A NEW USER</FONT></U><BR><BR>
 <FORM ACTION="reguser.php" onsubmit="return checkform(this);" METHOD="Post">
 <TABLE><TR><TD>First Name</TD><TD>:&nbsp;&nbsp;<INPUT TYPE="text" NAME="fname" OnKeyup="return cUpper(this);"></TD></TR><TR><TD>
	Last Name</TD><TD>:&nbsp;&nbsp;<INPUT TYPE="text" NAME="lname"></TD></TR><TR><TD>
	Telephone &nbsp;&nbsp;</TD><TD>:&nbsp;&nbsp;<INPUT TYPE="text" NAME="tel"></TD></TR><TR><TD>
	Password </TD><TD>:&nbsp;&nbsp;<INPUT TYPE="password" NAME="psword"></TD></TR><TR><TD>
	Location</TD><TD>:&nbsp;&nbsp;<INPUT TYPE="text" NAME="loc" OnKeyup="return cUpper(this);"></TD></TR>
	<TR><TD>Access</TD><TD>:&nbsp;&nbsp;<SELECT NAME="radio">
	    <OPTION VALUE="0">Admin
		<OPTION VALUE="1" SELECTED>Stock
		<OPTION VALUE="2">Expenses
		<OPTION VALUE="3">Express
		<OPTION VALUE="4">Carburant
		<OPTION VALUE=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</SELECT></TD></TR>
	<TR><TD>
	Confirmation&nbsp;&nbsp;</TD><TD>:&nbsp;&nbsp;<INPUT TYPE="password" NAME="paswd" style="background-color:#FFFFC0;border-color:Black"></TD></TR>
	</TABLE><BR><HR WIDTH="88%" COLOR="#3090C7"><DIV ALIGN="RIGHT">
	<INPUT TYPE="submit" NAME="save" VALUE="&nbsp;&nbsp;&nbsp;SAVE&nbsp;&nbsp;&nbsp;">&nbsp;&nbsp;<INPUT TYPE="reset" VALUE="CANCEL">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</DIV>
	</FORM>

	<?php
if(isset($_POST['save']))
	{
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$tel=$_POST['tel'];
		$psword=$_POST['psword'];
		$loc=$_POST['loc'];
		$radio=$_POST['radio'];
		$paswd=$_POST['paswd'];
         if($radio==0)
			 $loc='ADMIN';

include'connect.php';
$pass=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$paswd' AND Location='ADMIN'");
$nu=mysqli_num_rows($pass);
if($nu)
		{
$check=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$psword'");
$num=mysqli_num_rows($check);
if($num)
		print("<B><FONT COLOR=#FF0000>Password alread exist, please select another one ...</FONT></B>");
		else
		{
$do=mysqli_query($conn,"INSERT INTO users (Fname,Lname,Telephone,Passwo,Location,Access,DDate) VALUES ('$fname','$lname','$tel','$psword','$loc','$radio','$Date')");
print("<B><FONT COLOR=#FF0000>User saved successfull ...</FONT></B>");
		}
		}
		else
			{
print("<B><FONT COLOR=#FF0000><CENTER>Invalid confirmation key ...</A></FONT></B>");
			}
	}
?>
</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>