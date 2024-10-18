<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>VIRUNGA EXPRESS-Reporting System</title>
<link rel="stylesheet" type="text/css" href="csspage.css" />
<script language="JavaScript" type="text/javascript"> 
function checkform (form)
{
	if(form.fname.value=="")
	{
		alert("Please enter the first name!");
		form.fname.focus();
		return false;
	}
	if(form.lname.value=="")
	{
		alert("Please enter the last name!");
		form.lname.focus();
		return false;
	}
	if(form.tel.value=="")
	{
		alert("Please enter telephone number!");
		form.tel.focus();
		return false;
	}
	if(form.psword.value=="")
	{
		alert("Please enter the password!");
		form.psword.focus();
		return false;
	}
	if(form.loc.value=="")
	{
		alert("Please enter the location!");
		form.loc.focus();
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
	if(form.confi.value=="")
	{
		alert("Please enter your confirmation");
		form.confi.focus();
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
<li><a href="operations.php">Home</a></li>
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
 if(isset($_POST['delete']))
	{
        $num=$_POST['num'];
include'connect.php';
$nql=mysqli_query($conn,"SELECT *FROM users WHERE Number='$num'");
$row=mysqli_fetch_assoc($nql);
  {
  $N0=$row['Number'];
  $N1=$row['Fname'];
  $N2=$row['Lname'];
  $N3=$row['Telephone'];
  $N5=$row['Location'];
  $N6=$row['Access'];
  }	
print("<FORM ACTION=uchange.php METHOD=post onsubmit='return checkforme(this);'><INPUT TYPE=hidden NAME=hid VALUE=$N0>
<BR><BR><CENTER><FONT SIZE=2 COLOR=#3090C7 FACE=COMIC SANS MS><BR><CENTER><U>DO YOU WANT TO DELETE</U></FONT><BR><BR>
Full Name : $N1 $N2<BR>Telephone : $N3<BR>Location : $N5<BR>Access : $N6<BR><BR>
Enter your confirmation : <INPUT TYPE=password NAME=confi style='background-color:#FFFFC0;border-color:Black'><BR><BR><HR WIDTH=40% COLOR=#3090C7><BR>
<INPUT TYPE=submit NAME=del VALUE=DELETE>&nbsp;&nbsp;<INPUT TYPE=button VALUE=&nbsp;&nbsp;BACK&nbsp;&nbsp; onClick='javascript:history.go(-1);return true;'></FORM>");		

	}
if(isset($_POST['del']))
{
	$hid=$_POST['hid'];
	$confi=$_POST['confi'];

include'connect.php';
$pass=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$confi' AND Location='ADMIN'");
$nu=mysqli_num_rows($pass);
if($nu)
		{
	$nql=mysqli_query($conn,"DELETE FROM users WHERE Number='$hid'");		
		print("User dleted ...$hid $confi");
		}
		else
	{
print("<B><BR><BR><BR><BR><BR><BR><BR><BR><FONT COLOR=#FF0000><CENTER>Invalid confirmation key! 
<A HREF=javascript:history.go(-1)><FONT COLOR=#9999CC> Please click here to try again ...</A></FONT></B>");
	}
}
if(isset($_POST['edit']))
	{
        $num=$_POST['num'];
include'connect.php';
$nql=mysqli_query($conn,"SELECT *FROM users WHERE Number='$num'");
$row=mysqli_fetch_assoc($nql);
  {
  $N0=$row['Number'];
  $N1=$row['Fname'];
  $N2=$row['Lname'];
  $N3=$row['Telephone'];
  $N5=$row['Location'];
  $N6=$row['Access'];
  }	
print("<BR><BR><CENTER><U><FONT COLOR=#3090C7 SIZE=2 FACE=COMIC SANS MS>FILL THIS FORM TO UPDATE EXISTING USER</FONT></U><BR><BR>
       <FORM ACTION=uchange.php onsubmit='return checkform(this);' METHOD=Post>
       <INPUT TYPE=hidden NAME=num VALUE=$N0><TABLE><TR><TD>
	First Name</TD><TD>:&nbsp;&nbsp;<INPUT TYPE=text NAME=fname VALUE=$N1 onfocus=this.value='' OnKeyup='return cUpper(this);'></TD></TR><TR><TD>
	Last Name</TD><TD>:&nbsp;&nbsp;<INPUT TYPE=text NAME=lname VALUE=$N2 onfocus=this.value=''></TD></TR><TR><TD>
	Telephone &nbsp;&nbsp;</TD><TD>:&nbsp;&nbsp;<INPUT TYPE=text NAME=tel VALUE=$N3 onfocus=this.value=''></TD></TR><TR><TD>
	Password </TD><TD>:&nbsp;&nbsp;<INPUT TYPE=password NAME=psword></TD></TR><TR><TD>
	Location</TD><TD>:&nbsp;&nbsp;<INPUT TYPE=text NAME=loc VALUE=$N5 OnKeyup='return cUpper(this);' onfocus=this.value=''></TD></TR><TR><TD>
	Confirmation&nbsp;&nbsp;</TD><TD>:&nbsp;&nbsp;<INPUT TYPE=password NAME=paswd style=background-color:#FFFFC0;border-color:Black></TD></TR>
	<TR><TD>Access</TD><TD>:&nbsp;&nbsp;");
	if($N6=='stock')
		{
	print("<input type=radio name=radio value=express>Express
	<input type=radio name=radio value=stock CHECKED>Stock");
		}
		else
		{
    print("<input type=radio name=radio value=express CHECKED>Express
	<input type=radio name=radio value=stock>Stock");
		}
	print("</TD></TR></TABLE><BR><HR WIDTH=88% COLOR=#3090C7><DIV ALIGN=RIGHT>
	<INPUT TYPE=submit NAME=save VALUE=&nbsp;&nbsp;&nbsp;SAVE&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
	<INPUT TYPE=reset VALUE=&nbsp;&nbsp;&nbsp;BACK&nbsp;&nbsp;&nbsp; onClick='javascript:history.go(-1);return true;'>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</DIV>
	</FORM>");
	}

	if(isset($_POST['save']))
	{
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$tel=$_POST['tel'];
		$psword=$_POST['psword'];
		$loc=$_POST['loc'];
		$radio=$_POST['radio'];
		$paswd=$_POST['paswd'];
		$num=$_POST['num'];

include'connect.php';

$pass=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$paswd' AND Location='ADMIN'");
$nu=mysqli_num_rows($pass);
if($nu)
		{
$check=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$psword'");
$nus=mysqli_num_rows($check);
if($nus)
		print("<B><CENTER><FONT COLOR=#FF0000><B><BR><BR><BR><BR><BR><BR><BR><BR>Password alread exist!
        <A HREF=javascript:history.go(-1)><FONT COLOR=#9999CC> Please click here to select another ...</FONT></FONT></B>");
		else
		{
$do=mysqli_query($conn,"UPDATE users SET Fname='$fname',Lname='$lname',Telephone='$tel',Passwo='$psword',Location='$loc',Access='$radio',DDate='$Date' WHERE Number='$num'");
print("<B><CENTER><BR><BR><BR><BR><BR><BR><BR><BR><BR><FONT COLOR=#FF0000>User saved successfull! 
<A HREF=javascript:history.go(-1)><FONT COLOR=#9999CC> Please click here to try again ...</FONT></FONT></B>");
		}
		}
		else
			{
print("<B><BR><BR><BR><BR><BR><BR><BR><BR><FONT COLOR=#FF0000><CENTER>Invalid confirmation key! 
<A HREF=javascript:history.go(-1)><FONT COLOR=#9999CC> Please click here to try again ...</A></FONT></FONT></B>");
			}
	}
?>
</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>