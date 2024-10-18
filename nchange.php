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
<li><a href="operations.php">Home</a></li>
<li>|</li>
<li><a href="cardep.php">Car Departure</a></li>
<li>|</li>
<li><a href="expenses.php">Expenses</a></li>
<li>|</li>
<li><a href="report.php">Report</a></li>
<li>|</li>
<li><a href="sreport.php">Stock</a></li>
<li>|</li>
<li><a href="settings.php">Settings</a></li>
<li>|&nbsp;&nbsp;&nbsp;&nbsp;<a href="distroysession.php">Log out</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<FONT COLOR="#66CC33"><?php
print("Welcome ".$_SESSION['name']);
?></FONT>&nbsp;&nbsp;</li>
</ul>
</div>

<div id="contents">

 <?php
 if(isset($_POST['delete']))
	{
        $num=$_POST['num'];

include'connect.php';
$do=mysqli_query($conn,"SELECT *FROM operation WHERE Number='$num'");
$row=mysqli_fetch_assoc($do);
  {
  $N20=$row['Number'];
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
  }	
print("<FORM ACTION=nchange.php METHOD=post onsubmit='return checkforme(this);'><INPUT TYPE=hidden NAME=hid VALUE=$N20><INPUT TYPE=hidden NAME=loc VALUE=$N5>
<BR><BR><CENTER><FONT SIZE=2 COLOR=#3090C7 FACE=COMIC SANS MS><BR><CENTER><U>DO YOU WANT TO DELETE THIS?</U></FONT><BR><BR>
Time : <B>$N0 &nbsp;&nbsp;$N1</B><BR>Plaque : <B>$N2</B><BR>Driver : <B>$N3</B><BR>Destination : <B>$N2&nbsp;-&nbsp;$N6</B><BR>
Total : <B>$N10 Passengers<BR>Amount :<B>$N14 Rwf<BR><BR>
Enter your confirmation : <INPUT TYPE=password SIZE=15 NAME=confi style='background-color:#FFFFC0;border-color:Black'><BR><BR><HR WIDTH=40% COLOR=#3090C7><BR>
<INPUT TYPE=button VALUE=&nbsp;&nbsp;&nbsp;BACK&nbsp;&nbsp;&nbsp; onClick='javascript:history.go(-1);return true;'>&nbsp;
<INPUT TYPE=submit NAME=del VALUE=DELETE></FORM>");		

	}
if(isset($_POST['del']))
{
	$hid=$_POST['hid'];
	$confi=$_POST['confi'];
	$loc=$_POST['loc'];

include'connect.php';
$pass=mysqli_query($conn,"SELECT *FROM users WHERE ((Passwo='$confi' AND Location='$loc') OR (Passwo='$confi' AND Location='ADMIN'))");
$nu=mysqli_num_rows($pass);
	if($nu)
		{
            $nql=mysqli_query($conn,"DELETE FROM operation WHERE Number='$hid'");		
		    print("<B><BR><BR><BR><BR><BR><BR><BR><BR><FONT COLOR=#FF0000><CENTER>Operation successfull ...</A></FONT></B>");
		}
	else
		{
	print("<B><BR><BR><BR><BR><BR><BR><BR><BR><FONT COLOR=#FF0000><CENTER>Invalid confirmation key! 
	<A HREF=javascript:history.go(-1)><FONT COLOR=#9999CC> Please click here to try again ...</FONT></CENTER>");
		}
}
?>
</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>