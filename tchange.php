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
<li><a href="entry.php">Stock Entry</a></li>
<li>|</li>
<li><a href="exit.php">Stock Exit</a></li>
<li>|</li>
<li><a href="expenses.php">Expenses</a></li>
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

 <?php
 if(isset($_POST['delete']))
	{
        $hide=$_POST['hide'];

include'connect.php';
$do=mysqli_query($conn,"SELECT *FROM store WHERE Number='$hide'");
$row=mysqli_fetch_assoc($do);
  {
  $N0=$row['Number'];
  $N1=$row['DDate'];
  $N2=$row['Item'];
  $N3=$row['Spec'];
  $N4=$row['Quantity'];
  $N12=$row[Price];
  $N120=number_format($N12);
  $N6=$row['Document'];
  $N7=$row['Operator'];
  }	
print("<FORM ACTION=tchange.php METHOD=post onsubmit='return checkforme(this);'><INPUT TYPE=hidden NAME=hid VALUE=$N0>
<BR><BR><CENTER><FONT SIZE=2 COLOR=#3090C7 FACE=COMIC SANS MS><BR><CENTER><U>DO YOU WANT TO DELETE</U></FONT><BR><BR>
Spare Part : <B>$N2</B><BR>Specification : <B>$N3</B><BR>Document : <B>$N6</B><BR>Quantity : <B>$N4</B>
<BR>Unity Price : <B>$N120 Rwf</B><BR><BR>
Enter your confirmation : <INPUT TYPE=password NAME=confi style='background-color:#FFFFC0;border-color:Black'><BR><BR><HR WIDTH=40% COLOR=#3090C7><BR>
<INPUT TYPE=button VALUE=&nbsp;&nbsp;&nbsp;BACK&nbsp;&nbsp;&nbsp; onClick='javascript:history.go(-1);return true;'>&nbsp;
<INPUT TYPE=submit NAME=del VALUE=DELETE></FORM>");		

	}
if(isset($_POST['del']))
{
	$hid=$_POST['hid'];
	$confi=$_POST['confi'];

include'connect.php';
$pass=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$confi' AND Access='1'");
$nu=mysqli_num_rows($pass);
	if($nu)
		{
            $do=mysqli_query($conn,"SELECT *FROM store WHERE Number='$hid'");
            $row=mysqli_fetch_assoc($do);
                {
                      $N0=$row['Number'];
                      $N1=$row['Status'];
                      $N2=$row['Item'];
                      $N3=$row['Spec'];
                      $N4=$row['Quantity'];
					  $N12=$row['Price'];
                      $N7=$row['Location'];
                }	
		$check=mysqli_query($conn,"SELECT *FROM mystore WHERE Item='$N2' AND Spec='$N3' AND Location='$N7' AND Price='$N12'");
		$res=mysqli_fetch_assoc($check);
			{
			$qty=$res['Quantity'];	
			}
				if($N1==2){
					$nql=mysqli_query($conn,"DELETE FROM store WHERE Number='$hid'");		
		        print("<B><BR><BR><BR><BR><BR><BR><BR><BR><FONT COLOR=#FF0000><CENTER>Transaction number : $hid is deleted successfull ...</A></FONT></B>");
							}
			elseif($N1==0)
				{	
				$quantity=$qty+$N4;
				$do=mysqli_query($conn,"UPDATE mystore SET Quantity='$quantity' WHERE Item='$N2' AND Spec='$N3' AND Location='$N7' AND Price='$N12'");		
	            $nql=mysqli_query($conn,"DELETE FROM store WHERE Number='$hid'");		
		        print("<B><BR><BR><BR><BR><BR><BR><BR><BR><FONT COLOR=#FF0000><CENTER>Transaction number : $hid is deleted successfull ...</A></FONT></B>");
			}
			
			elseif($N1==1)
			{
				 if($qty<$N4)
			{
			print("<FONT COLOR=#FF0000><CENTER>Quantity not available in stock, Quantity in stock is $qty</CENTER></FONT>");
			}
			else
				{
		    $quantity=$qty-$N4;
		    $do=mysqli_query($conn,"UPDATE mystore SET Quantity='$quantity' WHERE Item='$N2' AND Spec='$N3' AND Location='$N7' AND Price='$N12'");		
	        $nql=mysqli_query($conn,"DELETE FROM store WHERE Number='$hid'");		
		    print("<B><BR><BR><BR><BR><BR><BR><BR><BR><FONT COLOR=#FF0000><CENTER>Transaction number : $hid is deleted successfull ...</A></FONT></B>");
		    }
			}
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