<?php
session_start();
$operator=$_SESSION['name'];
if($_SESSION['name']==null or $_SESSION['passe']==null){
header('location: vce.php');
}
?>
<HTML>
 <HEAD>
  <TITLE> VIRUNGA EXPRESS - REPORTING SYSTEM </TITLE>
  <link rel="stylesheet" type="text/css" href="csspage.css" />
 </HEAD>

 <BODY BGCOLOR="#54C571"><CENTER>
  <div id="header">
  <img style="float:left;margin-left:5px;margin-top:5px;" src="virungalogo.png" alt="" height=100px /> 
  <h1>VIRUNGA EXPRESS</h1>
  <h2>Reporting System</h2>
  </div>
 
   <?php
  if(isset($_POST['sview']))
	{
        $dat=$_POST['dat'];
		$car=$_POST['car'];
			
		if($car=='All')
		{
		print("<BR><B><CENTER><U>CARS' LOCATION ON : $dat</U></B><BR><BR>
		<TABLE WIDTH=897><TR><TD>
		<TABLE WIDTH=100% ONCLICK=history.go(-1) TITLE='Click to go back'>
  <TR BGCOLOR=#33CCCC><TH>TIME</TH><TH>PLAQUE</TH><TH>ENGEN</TH><TH>DRIVER</TH><TH>SOURCE</TH><TH>LOCATION</TH></TR>");
    include'connect.php';
    $cd=mysqli_query($conn,"SELECT *FROM cars ORDER BY MOTEUR DESC");
	while($cdr=mysqli_fetch_assoc($cd))
		{
         $N1=$cdr['CARNO'];
		 $N2=$cdr['MOTEUR'];

		 $do=mysqli_query($conn,"SELECT *FROM operation WHERE Plaque='$N1' AND DDate='$dat' ORDER BY Time DESC");
		 $row=mysqli_fetch_assoc($do);
			{
				$F1=$row['Time'];
				$F2=$row['Plaque'];
				$F3=$row['Source'];
				$F4=$row['Destin'];
				$F5=$row['Driver'];
			}
			if($F2)
			{
			if($n%2)
			print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'>
			<TD>$F1</TD><TD>$F2</TD><TD>$N2</TD><TD>$F5</TD><TD>$F3</TD><TD>$F4</TD></TR>");
			else
			print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'>
			<TD>$F1</TD><TD>$F2</TD><TD>$N2</TD><TD>$F5</TD><TD>$F3</TD><TD>$F4</TD></TR>");
			$n++;
			}
		}
		print("</TABLE>");
	}
	else
		{
		print("<BR><B><CENTER><U>CARS' LOCATION ON : $dat</U></B><BR><BR>
		<TABLE WIDTH=897><TR><TD>
		<TABLE WIDTH=100% ONCLICK=history.go(-1) TITLE='Click to go back'>
  <TR BGCOLOR=#33CCCC><TH>TIME</TH><TH>PLAQUE</TH><TH>ENGEN</TH><TH>DRIVER</TH><TH>SOURCE</TH><TH>LOCATION</TH></TR>");
    include'connect.php';
    $cd=mysqli_query($conn,"SELECT *FROM cars WHERE CARNO='$car' ORDER BY MOTEUR DESC");
	$cdr=mysqli_fetch_assoc($cd);
		{
         $N1=$cdr['CARNO'];
		 $N2=$cdr['MOTEUR'];
		}
		 $do=mysqli_query($conn,"SELECT *FROM operation WHERE Plaque='$N1' AND DDate='$dat' ORDER BY Time DESC");
		 $row=mysqli_fetch_assoc($do);
			{
				$F1=$row['Time'];
				$F2=$row['Plaque'];
				$F3=$row['Source'];
				$F4=$row['Destin'];
				$F5=$row['Driver'];
			}
			if($F2)
			{		
			print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'>
			<TD>$F1</TD><TD>$F2</TD><TD>$N2</TD><TD>$F5</TD><TD>$F3</TD><TD>$F4</TD></TR>");
		    }
		print("</TABLE>");
		}	
	}
	if(isset($_POST['view']))
	{
        $dat1=$_POST['dat1'];
		$dat2=$_POST['dat2'];
		$car=$_POST['car'];
		$spas=$_SESSION['passe'];
		include'connect.php';
		$sps=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$spas'");
	    $rps=mysqli_fetch_assoc($sps);
		{
			$sloca=$rps['Location'];
		}
		if($sloca=='ADMIN'){

	print("<BR><B><CENTER><U>CAR'S REPORT FROM : $dat1 TO : $dat2</U> (<U>$car</U>)</B><BR><BR>
		<TABLE WIDTH=897><TR><TD>
		<TABLE WIDTH=100% ONCLICK=history.go(-1) TITLE='Click to go back'>
  <TR BGCOLOR=#33CCCC><TH>TIME</TH><TH>DRIVER</TH><TH>SOURCE</TH><TH>DESTINATION</TH><TH>TOTAL</TH><TH>AMOUNT</TH></TR>");
    include'connect.php';
    $cd=mysqli_query($conn,"SELECT *FROM operation WHERE Plaque='$car' AND DDate>='$dat1' AND DDate<='$dat2' ORDER BY Time ASC");
	while($cdr=mysqli_fetch_assoc($cd))
		{
         $N1=$cdr['Time'];
		 $N2=$cdr['Driver'];
		 $N3=$cdr['Source'];
		 $N4=$cdr['Destin'];
		 $N5=$cdr['Passe1'];
		 $N6=$cdr['Passe2'];
		 $N7=$N5+$N6;
		 $N8=$cdr['Amount1'];
		 $N9=$cdr['Amount2'];
		 $N10=$N8+$N9;
		 $N11=number_format($N10);

         if($n%2)
    print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'>
		 <TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD><TD>&nbsp;&nbsp;$N4</TD>
		 <TD><DIV ALIGN=RIGHT>$N7&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$N11&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");
		 else
    print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'>
		 <TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD><TD>&nbsp;&nbsp;$N4</TD>
		 <TD><DIV ALIGN=RIGHT>$N7&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$N11&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");
		 $n++;
		 $tot1=$tot1+$N7;$tot2=$tot2+$N10;$tot=number_format($tot2);
		}
	print("<TR BGCOLOR=#33CCCC><TH COLSPAN=4>TOTAL</TH><TH>$tot1</TH><TH>$tot&nbsp;&nbsp;Rwf</TH></TR></TABLE>");
	}
		else
			{
		print("<B><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		           <FONT COLOR=#FF0000>Invalid confirmation key! <A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></B>");
		}
	}
	?>
  </TD></TR></TABLE>
 </BODY>
</HTML>