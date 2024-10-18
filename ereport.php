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
if(isset($_POST['view']))
	{
        $dat1=$_POST['dat1'];
		$dat2=$_POST['dat2'];
		$location1=$_POST['loc1'];
		$location2=$_POST['loc2'];		
		$total=0;
		$spas=$_SESSION['passe'];		
        $n=1;
    include'connect.php';	
    
    $sps=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$spas'");
	    $rps=mysqli_fetch_assoc($sps);
		{
			$sloca=$rps['Location'];
			$sacc=$rps['Access'];
		}
		if($sloca=='ADMIN' OR $sloca==$location1){
	print("<TABLE WIDTH=897><TR><TD>
  <BR><B><CENTER><U>REPORT BY CASHBOX FROM: $dat1 TO: $dat2 ($location1 - $location2)</U><B><BR><BR>
  <CENTER><TABLE WIDTH=100% ONCLICK=history.go(-1) TITLE='Click to go back'>
  <TR BGCOLOR=#33CCCC>
    <TH>No</TH>
	<TH>TIME</TH>
	<TH>PLAQUE</TH>
	<TH>DRIVER</TH>
	<TH>TOTAL</TH>
	<TH>AMOUNT</TH>
  </TR>");
	$do=mysqli_query($conn,"SELECT *FROM operation WHERE ((Source='$location1' AND Loc1='$loc2' AND DDate>='$dat1' AND DDate<='$dat2') OR (Source='$location1' AND Loc2='$loc2' AND DDate>='$dat1' AND DDate<='$dat2'))");
	while($resi=mysqli_fetch_assoc($do))
		{
		$N1=$resi['Time'];
		$N2=$resi['Plaque'];
		$N3=$resi['Driver'];
		$L1=$resi['Loc1'];
		$L2=$resi['Loc2'];
		$N4=$resi['Passe1'];
		$N5=$resi['Passe2'];
		$N6=$resi['Amount1'];
		$N7=$resi['Amount2'];
		if($L1==$L2)
			{
				$N8=$N4+$N5;
				$N90=$N6+$N7;
			}
			elseif($L1==$loc2)
			{
				$N8=$N4;
				$N90=$N6;
			}
			elseif($L2==$loc2)
			{
				$N8=$N5;
		        $N90=$N7;
			}
		$N9=number_format($N90);
		$tot=$tot+$N90;
		$total=number_format($tot);
		$ptot=$ptot+$N8;
		    if($n%2==0)
			{
 print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'>
    <TD>&nbsp;&nbsp;&nbsp;&nbsp;$n</TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;$N1</TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;$N2</TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;$N3</TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;$N8</TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;$N9</TD>
  </TR>");
			}
			else
			{
 print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'>
    <TD>&nbsp;&nbsp;&nbsp;&nbsp;$n</TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;$N1</TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;$N2</TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;$N3</TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;$N8</TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;$N9</TD>
  </TR>");
			}
			$n++;
		}
 print("<TR BGCOLOR=#33CCCC><TH COLSPAN=3><BR>TOTAL</TH><TH COLSPAN=2><BR>$ptot</TH><TH><BR>$total&nbsp;&nbsp;Rwf</TH></TR></TABLE></TD></TR></TABLE>");
	}
		else{
			print("<BR><BR><BR><BR><BR><BR><BR><CENTER><FONT COLOR=#FF0000>Sorry, you are not allowed to do that operation! 
			<A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></FONT></CENTER>");
		}
	}
	
	if(isset($_POST['sview']))
	{
        $dat1=$_POST['dat1'];
		$dat2=$_POST['dat1'];
		$loc=$_POST['loc'];
		$spas=$_SESSION['passe'];
		$n=1;
		include'connect.php';
		$sps=mysqli_query($conn,"SELECT *FROM users WHERE Passwo='$spas'");
	    $rps=mysqli_fetch_assoc($sps);
		{
			$sloca=$rps['Location'];
			$sacc=$rps['Access'];
		}
		if($sloca=='ADMIN' OR $sloca==$loc){
	   if($loc=='KIGALI' OR $loc=='NYABUGOGO' OR $loc=='KALISIMBI')
		{
		print("<TABLE WIDTH=897><TR><TD>
        <BR><B><CENTER><U>$loc REPORT ON: $dat1 </U><B><BR><BR>
        <CENTER><TABLE WIDTH=100% ONCLICK=history.go(-1) TITLE='Click to go back'>
        <TR BGCOLOR=#33CCCC>
	<TH>TIME</TH><TH>PLAQUE</TH><TH>DRIVER</TH><TH COLSPAN=2>MUSANZE</TH><TH COLSPAN=2>RUBAVU</TH><TH COLSPAN=2>GICUMBI</TH></TR>
	<TR BGCOLOR=#33CCCC><TH COLSPAN=3></TH><TH>TOTAL</TH><TH>AMOUNT</TH><TH>TOTAL</TH><TH>AMOUNT</TH><TH>TOTAL</TH><TH>AMOUNT</TH></TR>");
    
	include'connect.php';
	$tze=0;$tce=0;$tve=0;
	$tz=0;$tv=0;$tc=0;
	$ts=mysqli_query($conn,"SELECT *FROM operation WHERE Source='$loc' AND DDate>='$dat1' AND DDate<='$dat2' ORDER BY Time ASC");
	while($rs=mysqli_fetch_assoc($ts))
		{
		$tn=$rs['Number'];
        	$Gz=0;$Gze=0;$Gv=0;$Gve=0;$Gc=0;$Gce=0;
		$do=mysqli_query($conn,"SELECT *FROM operation WHERE Number='$tn'");
		$res=mysqli_fetch_assoc($do);
				{
			$G0=$res['Time'];
			$G1=$res['Passe1'];
			$G2=$res['Passe2'];
			$G3=$res['Amount1'];
			$G4=$res['Amount2'];
			$L1=$res['Loc1'];
			$L2=$res['Loc2'];
			if($L1=='MSZ' AND ($L2=='RBV' OR $L2=='')){
			$Gz=$G1;$Gze=$G3;$Gv=$G2;$Gve=$G4;}
			elseif($L1=='RBV' AND ($L2=='MSZ' OR $L2=='')){
			$Gv=$G1;$Gve=$G3;$Gz=$G2;$Gze=$G4;}
			elseif($L1=='GCB'){
			$Gc=$G1;$Gce=$G3;}
			elseif($L2=='GCB'){
			$Gc=$G2;$Gce=$G4;}
            $P=$res['Plaque'];
			$D=$res['Driver'];
				}
				if($n%2==0)
			{
        print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'><TD>&nbsp;&nbsp;&nbsp;&nbsp;$G0</TD>
		<TD>&nbsp;&nbsp;&nbsp;&nbsp;$P</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$D</TD><TD><DIV ALIGN=RIGHT>$Gz&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		<TD><DIV ALIGN=RIGHT>$Gze&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$Gv&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		<TD><DIV ALIGN=RIGHT>$Gve&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$Gc&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		<TD><DIV ALIGN=RIGHT>$Gce&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");
		$tv=$tv+$Gv;$tve=$tve+$Gve;$tz=$tz+$Gz;$tze=$tze+$Gze;$tc=$tc+$Gc;$tce=$tce+$Gce;
			}
			else
				{
        print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'><TD>&nbsp;&nbsp;&nbsp;&nbsp;$G0</TD>
		<TD>&nbsp;&nbsp;&nbsp;&nbsp;$P</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$D</TD><TD><DIV ALIGN=RIGHT>$Gz&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		<TD><DIV ALIGN=RIGHT>$Gze&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$Gv&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		<TD><DIV ALIGN=RIGHT>$Gve&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$Gc&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		<TD><DIV ALIGN=RIGHT>$Gce&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");
		$tv=$tv+$Gv;$tve=$tve+$Gve;$tz=$tz+$Gz;$tze=$tze+$Gze;$tc=$tc+$Gc;$tce=$tce+$Gce;
				}
			$n++;			
		}
	    print("<TR BGCOLOR=#33CCCC><TH COLSPAN=3><BR>TOTAL</TH><TH>$tz</TH><TH><BR>$tze&nbsp;&nbsp;Rwf</TH>
		<TH>$tv</TH><TH><BR>$tve&nbsp;&nbsp;Rwf</TH><TH>$tc</TH><TH><BR>$tce&nbsp;&nbsp;Rwf</TH>");
			}
	
	elseif($loc=='MUSANZE')
	{
        print("<TABLE WIDTH=897><TR><TD>
        <BR><B><CENTER><U>$loc REPORT ON: $dat1 </U><B><BR><BR>
        <CENTER><TABLE WIDTH=100% ONCLICK=history.go(-1) TITLE='Click to go back'>
        <TR BGCOLOR=#33CCCC>
	    <TH>TIME</TH><TH>PLAQUE</TH><TH>DRIVER</TH><TH COLSPAN=2>KIGALI</TH><TH COLSPAN=2>RUBAVU</TH></TR>
	    <TR BGCOLOR=#33CCCC><TH COLSPAN=3></TH><TH>TOTAL</TH><TH>AMOUNT</TH><TH>TOTAL</TH><TH>AMOUNT</TH></TR>");
    
	include'connect.php';
	$ts=mysqli_query($conn,"SELECT *FROM operation WHERE Source='$loc' AND DDate>='$dat1' AND DDate<='$dat2' ORDER BY Time ASC");
	$tot1n=0;$tot2n=0;
	while($rs=mysqli_fetch_assoc($ts))
		{
				$tn=$rs['Number'];	
		$do=mysqli_query($conn,"SELECT *FROM operation WHERE Number='$tn'");
		$res=mysqli_fetch_assoc($do);
				{
			$G0=$res['Time'];
			$G1=$res['Passe1'];
			$G2=$res['Passe2'];
			$G3=$res['Amount1'];
			$G4=$res['Amount2'];
			$L1=$res['Loc1'];
			$L2=$res['Loc2'];
			if($L1=='KGL'){
			    $G5=$G1;$A5=$G3;$A5n=number_format($A5);}
			else{
				$G5=$G2;$A5=$G4;$A5n=number_format($A5);}
			if($L1=='RBV'){
			    $G5e=$G1;$A5e=$G3;$A5ne=number_format($A5e);}
			else{
				$G5e=$G2;$A5e=$G4;$A5ne=number_format($A5e);}
			$P=$res['Plaque'];
			$D=$res['Driver'];
				}
				if($n%2==0)
			{
        print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'>
		<TD>&nbsp;&nbsp;&nbsp;&nbsp;$G0</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$P</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$D</TD>
		<TD><DIV ALIGN=RIGHT>$G5&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$A5n&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		<TD><DIV ALIGN=RIGHT>$G5e&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$A5ne&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");
				$tot1=$tot1+$A5;$tot3=$tot3+$G5;
				$tot2=$tot2+$A5e;$tot4=$tot4+$G5e;
			}
			else
			{
          print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'>
		  <TD>&nbsp;&nbsp;&nbsp;&nbsp;$G0</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$P</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$D</TD>
		  <TD><DIV ALIGN=RIGHT>$G5&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$A5n&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		  <TD><DIV ALIGN=RIGHT>$G5e&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$A5ne&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");
				$tot1=$tot1+$A5;$tot3=$tot3+$G5;
				$tot2=$tot2+$A5e;$tot4=$tot4+$G5e;
				$tot1n=number_format($tot1);$tot2n=number_format($tot2);
			}
			$n++;
				}
		print("<TR BGCOLOR=#33CCCC><TH COLSPAN=3><BR>TOTAL</TH><TH>$tot3</TH><TH><BR>$tot1n&nbsp;&nbsp;Rwf</TH><TH>$tot4</TH>
		<TH><BR>$tot2n&nbsp;&nbsp;Rwf</TH></TR>");
			}
			elseif($loc=='RUBAVU')
	{
        print("<TABLE WIDTH=897><TR><TD>
        <BR><B><CENTER><U>$loc REPORT ON: $dat1 </U><B><BR><BR>
        <CENTER><TABLE WIDTH=100% ONCLICK=history.go(-1) TITLE='Click to go back'>
        <TR BGCOLOR=#33CCCC>
	    <TH>TIME</TH><TH>PLAQUE</TH><TH>DRIVER</TH><TH COLSPAN=2>KIGALI</TH><TH COLSPAN=2>MUSANZE</TH></TR>
	    <TR BGCOLOR=#33CCCC><TH COLSPAN=3>&nbsp;</TH><TH>TOTAL</TH><TH>AMOUNT</TH><TH>TOTAL</TH><TH>AMOUNT</TH></TR>");
     $G2n=0;$G4n=0;
	include'connect.php';
	$ts=mysqli_query($conn,"SELECT *FROM operation WHERE Source='$loc' AND DDate>='$dat1' AND DDate<='$dat2' ORDER BY Time ASC");
	while($rs=mysqli_fetch_assoc($ts))
		{
		$tn=$rs['Number'];
	    $do=mysqli_query($conn,"SELECT *FROM operation WHERE Number='$tn'");
	    $res=mysqli_fetch_assoc($do);
			{		   
		    $T=$res['Time'];
			$L1=$res['Loc1'];
			$L2=$res['Loc2'];
			$G1=$res['Passe1'];
			$G2=$res['Passe2'];
			$G3=$res['Amount1'];
			$G4=$res['Amount2'];
			$G3n=number_format($G3);
			$G4n=number_format($G4);
			$P=$res['Plaque'];
			$D=$res['Driver'];
			}
			if($n%2==0)
			{
			if($L1=='KGL' AND ($L2='MSZ' OR $L2==''))
			{
		  print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'><TD>&nbsp;&nbsp;&nbsp;&nbsp;$T</TD>
		  <TD>&nbsp;&nbsp;&nbsp;&nbsp;$P</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$D</TD><TD><DIV ALIGN=RIGHT>$G1&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		  <TD><DIV ALIGN=RIGHT>$G3n&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$G2&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		  <TD><DIV ALIGN=RIGHT>$G4n&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");	
		   $G20=$G20+$G1;
		   $G40=$G40+$G3;
		   $G50=$G50+$G2;
		   $G60=$G60+$G4;
			}
			elseif($L1=='MSZ' AND ($L2=='KGL' OR $L2==''))
			{
				print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'><TD>&nbsp;&nbsp;&nbsp;&nbsp;$T</TD>
		  <TD>&nbsp;&nbsp;&nbsp;&nbsp;$P</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$D</TD><TD><DIV ALIGN=RIGHT>$G2&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		  <TD><DIV ALIGN=RIGHT>$G4n&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$G1&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		   <TD><DIV ALIGN=RIGHT>$G3n&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");	
		   $G20e=$G20e+$G1;
		   $G40e=$G40e+$G3;
		   $G50e=$G50e+$G2;
		   $G60e=$G60e+$G4;
			}
			}
			else
				{
          if($L1=='KGL' AND ($L2='MSZ' OR $L2==''))
			{
		  print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'><TD>&nbsp;&nbsp;&nbsp;&nbsp;$T</TD>
		  <TD>&nbsp;&nbsp;&nbsp;&nbsp;$P</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$D</TD><TD><DIV ALIGN=RIGHT>$G1&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		  <TD><DIV ALIGN=RIGHT>$G3n&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$G2&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		  <TD><DIV ALIGN=RIGHT>$G4n&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");	
		   $G20=$G20+$G1;
		   $G40=$G40+$G3;
		   $G50=$G50+$G2;
		   $G60=$G60+$G4;
			}
			elseif($L1=='MSZ' AND ($L2=='KGL' OR $L2==''))
			{
				print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'><TD>&nbsp;&nbsp;&nbsp;&nbsp;$T</TD>
		  <TD>&nbsp;&nbsp;&nbsp;&nbsp;$P</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$D</TD><TD><DIV ALIGN=RIGHT>$G2&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		  <TD><DIV ALIGN=RIGHT>$G4n&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$G1&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		   <TD><DIV ALIGN=RIGHT>$G3n&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");	
		   $G20e=$G20e+$G1;
		   $G40e=$G40e+$G3;
		   $G50e=$G50e+$G2;
		   $G60e=$G60e+$G4;
				}
				}
				$n++;
		$GT1=$G20+$G50e;$GT2=$G40+$G60e;$GT3=$G50+$G20e;$GT4=$G60+$G40e;
		}
		$GT2n=number_format($GT2);$GT4n=number_format($GT4);
		print("<TR BGCOLOR=#33CCCC><TH COLSPAN=3><BR>TOTAL</TH><TH><BR>$GT1</TH><TH><BR>$GT2n&nbsp;&nbsp;Rwf</TH>
		<TH><BR>$GT3</TH><TH><BR>$GT4n&nbsp;&nbsp;Rwf</TH></TR>");
	}
			elseif($loc=='GICUMBI')
	{
        print("<TABLE WIDTH=897><TR><TD>
        <BR><B><CENTER><U>$loc REPORT ON: $dat1 </U><B><BR><BR>
        <CENTER><TABLE WIDTH=100% ONCLICK=history.go(-1) TITLE='Click to go back'>
        <TR BGCOLOR=#33CCCC><TH>No</TH>
	    <TH>TIME</TH><TH>PLAQUE</TH><TH>DRIVER</TH><TH COLSPAN=2>KIGALI</TH></TR><TR BGCOLOR=#33CCCC><TH COLSPAN=4>&nbsp;</TH><TH>TOTAL</TH><TH>AMOUNT</TH></TR>");
    
	include'connect.php';
	$ts=mysqli_query($conn,"SELECT *FROM operation WHERE Source='$loc' AND DDate>='$dat1' AND DDate<='$dat2' ORDER BY Time ASC");
	while($rs=mysqli_fetch_assoc($ts))
		{
		$G6=0;$G5=0;
		$tn=$rs['Number'];
		$do=mysqli_query($conn,"SELECT *FROM operation WHERE Number='$tn'");
		while($res=mysqli_fetch_assoc($do))
				{
			$G0=$res['Time'];
			$G1=$res['Passe1'];
			$G2=$res['Passe2'];
			$G3=$res['Amount1'];
			$G4=$res['Amount2'];
			$G5=$G5+$G1+$G2;
			$G6=$G6+$G3+$G4;
			$G6n=number_format($G6);
			$G7=$res['Plaque'];
			$G8=$res['Driver'];
				}
				if($n%2==0)
			{
         print("<TR BGCOLOR=#F2F2F2 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2F2'><TD>&nbsp;&nbsp;&nbsp;&nbsp;$n</TD>
		 <TD>&nbsp;&nbsp;&nbsp;&nbsp;$G0</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$G7</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$G8</TD>
		 <TD><DIV ALIGN=RIGHT>$G5&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$G6n&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");
			}
			else
			{
          print("<TR BGCOLOR=#F2F2C1 onMouseover=this.bgColor='#EEE1E1' onMouseout=this.bgColor='#F2F2C1'><TD>&nbsp;&nbsp;&nbsp;&nbsp;$n</TD>
		 <TD>&nbsp;&nbsp;&nbsp;&nbsp;$G0</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$G7</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;$G8</TD>
		 <TD><DIV ALIGN=RIGHT>$G5&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><DIV ALIGN=RIGHT>$G6n&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>");
			}
			$n++;
		 	$tot1=$tot1+$G6;
			$tot2=$tot2+$G5;
			}		   
			$tot1n=number_format($tot1);			
		 print("<TR BGCOLOR=#33CCCC><TH COLSPAN=4><BR>TOTAL</TD><TH><BR>$tot2</TH><TH><BR>$tot1n&nbsp;&nbsp;Rwf</TH></TR>");			
	}
		}
		else{
			print("<BR><BR><BR><BR><BR><BR><BR><CENTER><FONT COLOR=#FF0000>Sorry, you are not allowed to do that operation! 
			<A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></FONT></CENTER>");
		}
	}
			?>
  </TABLE>
  </TD></TR></TABLE>
 </BODY>
</HTML>