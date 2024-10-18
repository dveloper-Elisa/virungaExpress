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

<CENTER><FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS"><BR><CENTER><U>USER MANAGEMENT</U></FONT><BR><BR>

 <?php
 if(isset($_POST['search']))
	{
        $name=$_POST['name'];
		if($name=='all' OR $name=='ALL')
		{
  include'connect.php';
  print("<div id=overi><TABLE WIDTH=98%><TR>
<TH WIDTH=21%>Control</TH><TH>First Name</TH><TH>Last Name</TH><TH>Telephone</TH><TH>Location</TH><TH>Access</TH><TH>Date</TH></TR>
<TR><TD COLSPAN=8><HR></TD></TR>");
  $nql=mysqli_query($conn,"SELECT *FROM users WHERE Location!='ADMIN' ORDER BY Location ASC");
  while($row=mysqli_fetch_assoc($nql))
  {
  $N0=$row['Number'];
  $N1=$row['Fname'];
  $N2=$row['Lname'];
  $N3=$row['Telephone'];
  $N5=$row['Location'];
  $N6=$row['Access'];
  $N7=$row['DDate'];
  if($n%2==0)
	 {
    print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'>
        <FORM ACTION=uchange.php METHOD=post><TD WIDTH=21%>
	<INPUT TYPE=hidden NAME=num VALUE=$N0><INPUT TYPE=hidden NAME=name VALUE=$N1>
	<INPUT TYPE=submit VALUE=&nbsp;&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;&nbsp; NAME=edit>
	<INPUT TYPE=submit VALUE=DELETE NAME=delete></FORM>
	</TD><TD>$N1</TD><TD>$N2</TD><TD>$N3</TD><TD>$N5</TD><TD>$N6</TD><TD>$N7</TD></TR>");
	 }
	 else
	  {
	print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'>
        <FORM ACTION=uchange.php METHOD=Post><TD WIDTH=21%>
	<INPUT TYPE=hidden NAME=num VALUE=$N0><INPUT TYPE=hidden NAME=name VALUE=$N1>
	<INPUT TYPE=submit VALUE=&nbsp;&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;&nbsp; NAME=edit>
	<INPUT TYPE=submit VALUE=DELETE NAME=delete></FORM>
	</TD><TD>$N1</TD><TD>$N2</TD><TD>$N3</TD><TD>$N5</TD><TD>$N6</TD><TD>$N7</TD></TR>");
	  }
	  $n++;
  }
  print("</TABLE></div>");
		}
		elseif($name)
		{
			include'connect.php';  
  $nql=mysqli_query($conn,"SELECT *FROM users WHERE (Fname LIKE '%$name%' AND Location!='ADMIN') OR (Lname LIKE '%$name%' AND Location!='ADMIN') ORDER BY Location ASC");
  $num=mysqli_num_rows($nql);
  if($num)
		{
	  print("<TABLE WIDTH=90%><TR>
  <TH COLSPAN=2>Control</TH><TH>First Name</TH><TH>Last Name</TH><TH>Telephone</TH><TH>Location</TH><TH>Access</TH><TH>Date</TH></TR>
  <TR><TD COLSPAN=8><HR></TD></TR>");
  while($row=mysqli_fetch_assoc($nql))
  {
  $N0=$row['Number'];
  $N1=$row['Fname'];
  $N2=$row['Lname'];
  $N3=$row['Telephone'];
  $N5=$row['Location'];
  $N6=$row['Access'];
  $N7=$row['DDate'];
  if($n%2==0)
	 {
    print("<TR BGCOLOR=#C0B4CF><TD COLSPAN=2><FORM ACTION=uchange.php METHOD=post>
	<INPUT TYPE=hidden NAME=num VALUE=$N0><INPUT TYPE=hidden NAME=name VALUE=$N1>
	<INPUT TYPE=submit VALUE=&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp; NAME=edit>
	<INPUT TYPE=submit VALUE=Delete NAME=delete></FORM>
	</TD><TD>$N1</TD><TD>$N2</TD><TD>$N3</TD><TD>$N5</TD><TD>$N6</TD><TD>$N7</TD></TR>");
	 }
	 else
	  {
	print("<TR BGCOLOR=#C0C4DE><TD COLSPAN=2><FORM ACTION=uchange.php METHOD=Post>
	<INPUT TYPE=hidden NAME=num VALUE=$N0><INPUT TYPE=hidden NAME=name VALUE=$N1>
	<INPUT TYPE=submit VALUE=&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp; NAME=edit>
	<INPUT TYPE=submit VALUE=Delete NAME=delete></FORM>
	</TD><TD>$N1</TD><TD>$N2</TD><TD>$N3</TD><TD>$N5</TD><TD>$N6</TD><TD>$N7</TD></TR>");
	  }
	  $n++;
	  }
	  print("</TABLE>");
		}
		else
			{
			print("<B><BR><BR><BR><BR><BR><FONT COLOR=#FF0000>No result to be displayed ...</FONT></B>");
			}     
		}
	}
  ?>

</TD></TR></TABLE>
</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>