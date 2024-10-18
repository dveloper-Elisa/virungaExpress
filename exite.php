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

   <CENTER><BR><TABLE><TR><FORM ACTION="exit.php" onsubmit="return checkform(this);" METHOD="post">
		<TD colspan=2><FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS"><BR>
		<CENTER><U>QUANTITY TO BE MOVED OUT FROM STOCK</U></CENTER><BR></TD>
	</TR></TABLE>

	<?php
if(isset($_POST['save']))
	{
        $item=$_POST['item'];
		$spec=$_POST['spec'];
		//$quant=$_POST['quant'];
		$trans=$_POST['trans'];
		$plaque=$_POST['plaque'];
		$piece=$_POST['piece'];
		$dat=$_POST['dat'];
		$paswd=$_POST['paswd'];

include'connect.php';
	$Q1=0;
	$Q2=0;
	$Q3=0;
	$P1=0;
	$P2=0;
	$P3=0;
$pass=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$paswd' AND Access='1'");
$nu=mysqli_num_rows($pass);
if($nu)
		{
	$row=mysqli_fetch_assoc($pass);
			{
				$loc=$row['Location'];
				$name=$row['Lname'];
			}
$sto1=mysqli_query($conn,"SELECT *FROM mystore WHERE Item='$item' AND Spec='$spec' AND Location='$loc' AND Quantity!=0 ORDER BY Price ASC");

		$res1=mysqli_fetch_assoc($sto1);
		{
		$N1=$res1['Number'];
		$P1=$res1['Price'];
		$P10=number_format($P1);
		$Q1=$res1['Quantity'];
		}

$sto2=mysqli_query($conn,"SELECT *FROM mystore WHERE Item='$item' AND Spec='$spec' AND Location='$loc' AND Number!='$N1' AND Quantity!=0 ORDER BY Price ASC");

		$res2=mysqli_fetch_assoc($sto2);
		{
		$N2=$res2['Number'];
		$P2=$res2['Price'];
		$P20=number_format($P2);
		$Q2=$res2['Quantity'];
		}

$sto3=mysqli_query($conn,"SELECT *FROM mystore WHERE Item='$item' AND Spec='$spec' AND Location='$loc' AND Number!='$N1' AND Number!='$N2' AND Quantity!=0 ORDER BY Price ASC");

		$res3=mysqli_fetch_assoc($sto3);
		{
		$N3=$res3['Number'];
		$P3=$res3['Price'];
		$P30=number_format($P3);
		$Q3=$res3['Quantity'];
		}
	
	print("<br>$plaque &nbsp;&nbsp; : &nbsp;&nbsp; $item &nbsp;&nbsp; - &nbsp;&nbsp; $spec <br><br>
	<TABLE WIDTH=86% BORDER=1>
	<TR BGCOLOR=#669999><TH COLSPAN=2><br>STOCK - I</TH><TH COLSPAN=2><br>STOCK - II</TH><TH COLSPAN=2><br>STOCK - III</TH>			
	</TR>
	<TR>
	<TH WIDTH=20%><br>TOTAL</TH><TH><br>QUANTITY</TH>
	<TH WIDTH=20%><br>TOTAL</TH><TH><br>QUANTITY</TH>
	<TH WIDTH=20%><br>TOTAL</TH><TH><br>QUANTITY</TH>
	</TR>
	<TR>
	<TD><DIV ALIGN=RIGHT>$Q1&nbsp;&nbsp;</TD><TD ROWSPAN=2>
	<input type=text name=qty1 size=12 value=0 onclick=this.value='';></TD>
	<TD><DIV ALIGN=RIGHT>$Q2&nbsp;&nbsp;</TD><TD ROWSPAN=2>
	<input type=text name=qty2 size=12 value=0 onclick=this.value='';></TD>
	<TD><DIV ALIGN=RIGHT>$Q3&nbsp;&nbsp;</TD><TD ROWSPAN=2>
	<input type=text name=qty3 size=12 value=0 onclick=this.value='';></TD>
	</TR>
	<TR>
	<TD BGCOLOR=#669999><DIV ALIGN=RIGHT>$P10 Rwf&nbsp;&nbsp;</TD>
	<TD BGCOLOR=#669999><DIV ALIGN=RIGHT>$P20 Rwf&nbsp;&nbsp;</TD>
	<TD BGCOLOR=#669999><DIV ALIGN=RIGHT>$P30 Rwf&nbsp;&nbsp;</TD>
	</TR></TABLE><BR><BR>");
		
print("<input type=hidden name='item' value='$item'><input type=hidden name='spec' value='$spec'>
<input type=hidden name='trans' value='$trans'><input type=hidden name='plaque' value='$plaque'>
<input type=hidden name='piece' value='$piece'><input type=hidden name='Q1' value='$Q1'>
<input type=hidden name='Q2' value='$Q2'><input type=hidden name='Q3' value='$Q3'>
<input type=hidden name='N1' value='$N1'><input type=hidden name='N2' value='$N2'>
<input type=hidden name='N3' value='$N3'><input type=hidden name='P1' value='$P1'>
<input type=hidden name='P2' value='$P2'><input type=hidden name='P3' value='$P3'>
<input type=hidden name='dat' value='$dat'><input type=hidden name='loc' value='$loc'>
<input type=hidden name='name' value='$name'>

	<HR WIDTH=88% COLOR=#3090C7>
<DIV ALIGN=RIGHT><INPUT TYPE=submit NAME=send VALUE=&nbsp;&nbsp;&nbsp;SAVE&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
 <INPUT TYPE=button VALUE=&nbsp;&nbsp;&nbsp;BACK&nbsp;&nbsp;&nbsp; ONCLICK=javascript:history.go(-1);>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</DIV>
	</FORM><BR>");
}
		else
		{
			print("<BR><BR><BR><BR><B><FONT COLOR=#FF0000>Invalid confirmation key ...</FONT></B><BR><BR>
			Please, click on the button below to try again<BR><BR><BR>
			 <INPUT TYPE=button VALUE=&nbsp;&nbsp;&nbsp;BACK&nbsp;&nbsp;&nbsp; ONCLICK=javascript:history.go(-1);>");
		}
		}
?>








<?php
if(isset($_GET['act']))
	{

if($_GET['act']=="valid")
	{

                $pendId=$_GET['pendId'];
                $item=$_GET['item'];
		$spec=$_GET['spec'];
		$quant=$_GET['quant'];
		$stockid=$_GET['stockid'];
		$trans=$_GET['trans'];
		$plaque=$_GET['plaque'];
		$piece=$_GET['piece'];
		$dat=$_GET['dat'];
                $loc=$_GET['location'];
                $name=$_GET['operator'];
		$paswd=$_SESSION['passe'];

include'connect.php';
	$Q1=0;
	$Q2=0;
	$Q3=0;
	$P1=0;
	$P2=0;
	$P3=0;
$pass=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$paswd' AND (Access='0' or Access='5')");
$nu=mysqli_num_rows($pass);
if($nu)
		{
	$row=mysqli_fetch_assoc($pass);
			{
				//$loc=$row[Location];
				//$name=$row[Lname];
			}
$sto1=mysqli_query($conn,"SELECT *FROM mystore WHERE Item='$item' AND Spec='$spec' AND Location='$loc' AND Number='$stockid' AND Quantity!=0 ORDER BY Price ASC");

		$res1=mysqli_fetch_assoc($sto1);
		{
		$N1=$res1['Number'];
		$P1=$res1['Price'];
		$P10=number_format($P1);
		$Q1=$res1['Quantity'];
		}

//$sto2=mysqli_query($conn,"SELECT *FROM mystorepending WHERE Item='$item' AND Spec='$spec' AND Location='$loc' AND Number!='$N1' AND Quantity!=0 ORDER BY Price ASC");
$sto2=mysqli_query($conn,"SELECT *FROM mystore WHERE Item='$item' AND Spec='$spec' AND Location='$loc' AND Number!='$N1' AND Quantity!=0 ORDER BY Price ASC");

		$res2=mysqli_fetch_assoc($sto2);
		{
		$N2=$res2['Number'];
		$P2=$res2['Price'];
		$P20=number_format($P2);
		$Q2=$res2['Quantity'];
		}

//$sto3=mysqli_query("SELECT *FROM mystorepending WHERE Item='$item' AND Spec='$spec' AND Location='$loc' AND Number!='$N1' AND Number!='$N2' AND Quantity!=0 ORDER BY Price ASC");
$sto3=mysqli_query($conn,"SELECT *FROM mystore WHERE Item='$item' AND Spec='$spec' AND Location='$loc' AND Number!='$N1' AND Number!='$N2' AND Quantity!=0 ORDER BY Price ASC");

		$res3=mysqli_fetch_assoc($sto3);
		{
		$N3=$res3['Number'];
		$P3=$res3['Price'];
		$P30=number_format($P3);
		$Q3=$res3['Quantity'];
		}
	
	print("<br>$plaque &nbsp;&nbsp; : &nbsp;&nbsp; $item &nbsp;&nbsp; - &nbsp;&nbsp; $spec <br><br>
	<TABLE WIDTH=86% BORDER=1>
	<TR BGCOLOR=#669999><TH COLSPAN=2><br>STOCK - I</TH><TH COLSPAN=2><br>STOCK - II</TH><TH COLSPAN=2><br>STOCK - III</TH>			
	</TR>
	<TR>
	<TH WIDTH=20%><br>TOTAL</TH><TH><br>QUANTITY</TH>
	<TH WIDTH=20%><br>TOTAL</TH><TH><br>QUANTITY</TH>
	<TH WIDTH=20%><br>TOTAL</TH><TH><br>QUANTITY</TH>
	</TR>
	<TR>
	<TD><DIV ALIGN=RIGHT>$Q1&nbsp;&nbsp;</TD><TD ROWSPAN=2>
	<input type=text name=qty1 size=12 value=$quant onclick=this.value='';></TD>
	<TD><DIV ALIGN=RIGHT>$Q2&nbsp;&nbsp;</TD><TD ROWSPAN=2>
	<input type=text name=qty2 size=12 value=0 onclick=this.value='';></TD>
	<TD><DIV ALIGN=RIGHT>$Q3&nbsp;&nbsp;</TD><TD ROWSPAN=2>
	<input type=text name=qty3 size=12 value=0 onclick=this.value='';></TD>
	</TR>
	<TR>
	<TD BGCOLOR=#669999><DIV ALIGN=RIGHT>$P10 Rwf&nbsp;&nbsp;</TD>
	<TD BGCOLOR=#669999><DIV ALIGN=RIGHT>$P20 Rwf&nbsp;&nbsp;</TD>
	<TD BGCOLOR=#669999><DIV ALIGN=RIGHT>$P30 Rwf&nbsp;&nbsp;</TD>
	</TR></TABLE><BR><BR>");
		
print("<input type=hidden name='pendId' value='$pendId'>
<input type=hidden name='item' value='$item'><input type=hidden name='spec' value='$spec'>
<input type=hidden name='trans' value='$trans'><input type=hidden name='plaque' value='$plaque'>
<input type=hidden name='piece' value='$piece'><input type=hidden name='Q1' value='$Q1'>
<input type=hidden name='Q2' value='$Q2'><input type=hidden name='Q3' value='$Q3'>
<input type=hidden name='N1' value='$N1'><input type=hidden name='N2' value='$N2'>
<input type=hidden name='N3' value='$N3'><input type=hidden name='P1' value='$P1'>
<input type=hidden name='P2' value='$P2'><input type=hidden name='P3' value='$P3'>
<input type=hidden name='dat' value='$dat'><input type=hidden name='loc' value='$loc'>
<input type=hidden name='name' value='$name'>

	<HR WIDTH=88% COLOR=#3090C7>
<DIV ALIGN=RIGHT><INPUT TYPE=submit NAME=sendpending VALUE=&nbsp;&nbsp;&nbsp;SAVE&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
 <INPUT TYPE=button VALUE=&nbsp;&nbsp;&nbsp;BACK&nbsp;&nbsp;&nbsp; ONCLICK=javascript:history.go(-1);>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</DIV>
	</FORM><BR>");
}
		else
		{
			print("<BR><BR><BR><BR><B><FONT COLOR=#FF0000>Invalid confirmation key ...</FONT></B><BR><BR>
			Please, click on the button below to try again<BR><BR><BR>
			 <INPUT TYPE=button VALUE=&nbsp;&nbsp;&nbsp;BACK&nbsp;&nbsp;&nbsp; ONCLICK=javascript:history.go(-1);>");
		}
		}
		}
?>



</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>
