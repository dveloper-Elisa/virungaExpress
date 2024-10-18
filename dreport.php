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
  </SCRIPT>
<link rel="stylesheet" type="text/css" href="csspage.css" />
</head>
<body><CENTER>
 <?php 
if(isset($_POST['vehicule']))
	{
                $dat1=$_POST['dat1'];
		$dat2=$_POST['dat2'];
		$pword1=$_POST['pword1'];
		$plaque=$_POST['plaque'];
                $item=$_POST['item'];
include'connect.php';
$pass=mysqli_query($conn,"SELECT * FROM users WHERE ((Passwo='$pword1' AND Access='1') OR (Passwo='$pword1' AND Access='2') OR (Passwo='$pword1' AND Location='ADMIN') OR (Passwo='$pword2' AND Access='0') OR (Passwo='$pword2' AND Access='5'))");
$nu=mysqli_num_rows($pass);
if($nu){
if($item!=null or $item!=""){
	$do=mysqli_query($conn,"SELECT * FROM store WHERE DDate BETWEEN '$dat1' AND '$dat2' AND Status!='1' AND Plaque='$plaque' AND Item='$item' ORDER BY DDate ASC");
	$nd=mysqli_num_rows($do);
} else{
$do=mysqli_query($conn,"SELECT * FROM store WHERE DDate BETWEEN '$dat1' AND '$dat2' AND Status!='1' AND Plaque='$plaque' ORDER BY DDate ASC");
$nd=mysqli_num_rows($do);
}
if($nd){
	$ca=mysqli_query($conn,"SELECT *FROM cars WHERE Carid='$plaque'");
	$cr=mysqli_fetch_assoc($ca);{
		$mot=$cr['Engine'];
	}
print("<CENTER><TABLE WIDTH=70%><TR><TD WIDTH=70%>
       <TABLE  style='font-size:11px; color:#3090C7;' ONCLICK=history.go(-1) TITLE='Click to go back'><TR>
       <TD> &nbsp;&nbsp;&nbsp;&nbsp; Stock </TD><TD>:&nbsp;&nbsp;VIRUNGA EXPRESS</TD></TR>
	   <TR><TD> &nbsp;&nbsp;&nbsp;&nbsp; Consumer </TD><TD>:&nbsp;&nbsp;$plaque &nbsp;-&nbsp; $mot</TD></TR>
	   <TR><TD> &nbsp;&nbsp;&nbsp;&nbsp; Period </TD><TD>:&nbsp;&nbsp;$dat1 &nbsp;-&nbsp; $dat2</TD></TR></TABLE>
	   </TD><TD><DIV ALIN=LEFT><img style=float:left;margin-left:10px;margin-top:5px; src=virungalogo.png height=60px /></TD></TR></TABLE>

<CENTER><FONT SIZE=2 COLOR=#3090C7 FACE='COMIC SANS MS'><BR><U>Car Consumption</U><BR><BR></FONT>
<TABLE WIDTH=70% style='border-color:#3090C7; border-style:solid; border-width:1px; font-size:11px;' BGCOLOR=#FFFFFF ONCLICK=history.go(-1) TITLE='Click to go back'>
<TR BGCOLOR=#F8F8F8><TH>DATE</TH><TH>SPARE PART</TH><TH>SPECIFICATION</TH><TH>POSITION</TH><TH>QUANTITY</TH><TH>AMOUNT</TH><TH>DOCUMENT</TH><TH>OPERATOR</TH></TR>");

$n=1;
$amt=0;
while($res=mysqli_fetch_assoc($do))
		{
	                $N1=$res['DDate'];
			$N2=$res['Item'];
			$N3=$res['Spec'];
			$N4=$res['Quantity'];
			$N9=$res['Price'];
			$N8=$res['Trans'];
			$N6=$res['Document'];
			$N7=$res['Operator'];
                        if($N2=='fuel')
				$am=$N9;
			else
			$am=$N9*$N4;

           // $dim=$RES['dim'];
			$sam=number_format($am);
			$amt=$amt+$am;
			$samt=number_format($amt);
		    if($n%2==0)
print("<TR BGCOLOR=#F8F8F8><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD><TD>&nbsp;&nbsp;$N8</TD>
		<TD><CENTER>$N4</TD><TD>&nbsp;&nbsp;$sam</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
		else
print("<TR BGCOLOR=#FFFFCC><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD><TD>&nbsp;&nbsp;$N8</TD><TD><CENTER>$N4</TD>
		<TD>&nbsp;&nbsp;$sam</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
		$n++;
		}
		print("<TR><TH COLSPAN=3><BR>Total Amount</TH><TH COLSPAN=5><BR>$samt&nbsp;Rwf</TH></TABLE>");
		}
		else{
        print("<B><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		           <FONT COLOR=#FF0000>No result found for you search! <A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></B>");
		}
}
	else
		{
		print("<B><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		           <FONT COLOR=#FF0000>Invalid confirmation key! <A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></B>");
		}
	}

	if(isset($_POST['spare']))
	{
        $dat1=$_POST['dat1'];
		$dat2=$_POST['dat2'];
		$item=$_POST['item'];
		$spec=$_POST['spec'];
		$radio=$_POST['radio'];
		$pword2=$_POST['pword2'];
		//$plaque=$_POST['plaque'];
		$sto=$_POST['sto'];

include'connect.php';
$pass=mysqli_query($conn,"SELECT *FROM users WHERE ((Passwo='$pword2' AND Location='ADMIN') OR (Passwo='$pword2' AND Access='1') OR (Passwo='$pword2' AND Access='2') OR (Passwo='$pword2' AND Access='0') OR (Passwo='$pword2' AND Access='5'))");
$nd=mysqli_num_rows($pass);
$row=mysqli_fetch_assoc($pass);
			{
				$loc=$row['Location'];
			}
	if($loc=='ADMIN')
	$loc=$sto;

if($nd)
	{	
if($item=="all" AND $radio=="in")
			{
print("<CENTER><TABLE><TR><TD WIDTH=70%>
       <TABLE style='font-size:11px; color:#3090C7;' ONCLICK=history.go(-1) TITLE='Click to go back'><TR>
       <TD>Location </TD><TD>:&nbsp;&nbsp;$loc</TD></TR>
	   <TR><TD>Spare Part </TD><TD>:&nbsp;&nbsp;All incomes</TD></TR>
	   <TR><TD>Specification </TD><TD>:&nbsp;&nbsp;All incomes</TD></TR>
	   <TR><TD>Period </TD><TD>:&nbsp;&nbsp;$dat1 - $dat2</TD></TR>
	   <TR><TD COLSPAN=2>&nbsp;VIRUNGA EXPRESS</TD></TR></TABLE>
	   </TD><TD><DIV ALIN=LEFT><img style=float:left;margin-left:5px;margin-top:5px; src=virungalogo.png height=100px /></TD></TR></TABLE>

<CENTER><FONT SIZE=2 COLOR=#3090C7 FACE='COMIC SANS MS'><BR><U>Stock Report</U><BR><BR></FONT>
<TABLE style='border-color:#3090C7; border-style:solid; border-width:1px; font-size:11px;' BGCOLOR=#FFFFFF ONCLICK=history.go(-1) TITLE='Click to go back'>
<TR BGCOLOR=#FFFFCC><TH>DATE</TH><TH>SPARE PART</TH><TH>SPECIFICATION</TH><TH>QUANTITY</TH><TH>DOCUMENT</TH><TH>OPERATOR</TH></TR>");

	$N4=0;
	$n=0;
$do=mysqli_query($conn,"SELECT *FROM store WHERE DDate>='$dat1' AND DDate<='$dat2' AND Location='$loc' AND Status='1' ORDER BY DDate ASC");
while($res=mysqli_fetch_assoc($do))
		{
			$N2=$res['Item'];
			$N3=$res['Spec'];
			$N4=$res['Quantity'];
			$N5=$res['DDate'];
			$N6=$res['Document'];
			$N7=$res['Operator'];
		
		if($N4!=0 AND $n%2==0)
print("<TR BGCOLOR=#F8F8F8><TD>&nbsp;&nbsp;$N5</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD>
		<TD><CENTER>$N4</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
		elseif($N4!=0 AND $n%2!=0)
print("<TR BGCOLOR=#FFFFCC><TD>&nbsp;&nbsp;$N5</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD>
		<TD><CENTER>$N4</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
		$n++;
		}
		print("</TABLE>");
			}

elseif($item=="all" AND $radio=="")
			{
print("<CENTER><TABLE><TR><TD WIDTH=70%>
       <TABLE style='font-size:11px; color:#3090C7;' ONCLICK=history.go(-1) TITLE='Click to go back'>
	   <TR><TD>Location </TD><TD>:&nbsp;&nbsp;$loc</TD></TR>
	   <TR><TD>Spare Part </TD><TD>:&nbsp;&nbsp;All in stock</TD></TR>
	   <TR><TD>Specification </TD><TD>:&nbsp;&nbsp;All in stock</TD></TR>
	   <TR><TD>Period </TD><TD>:&nbsp;&nbsp;$dat1 - $dat2</TD></TR>
	   <TR><TD COLSPAN=2>&nbsp;VIRUNGA EXPRESS</TD></TR></TABLE>
	   </TD><TD><DIV ALIN=LEFT><img style=float:left;margin-left:5px;margin-top:5px; src=virungalogo.png height=100px /></TD></TR></TABLE>


<CENTER><FONT SIZE=2 COLOR=#3090C7 FACE='COMIC SANS MS'><BR><U>Stock Report</U><BR><BR></FONT>
<TABLE style='border-color:#3090C7; border-style:solid; border-width:1px; font-size:10px;' BGCOLOR=#FFFFFF ONCLICK=history.go(-1) TITLE='Click to go back'>
<TR BGCOLOR=#FFFFCC><TH>SPARE PART</TH><TH>INITIAL QUANTITY</TH><TH>INCOME QUANTITY</TH><TH>OUTGOING QUANTITY</TH><TH>TOTAL REST</TH></TR>");

$count=mysqli_query($conn,"SELECT *FROM mystore WHERE Location='$loc' group by Item,Spec ORDER BY Item ASC");
//$count=mysqli_query("SELECT Item,Spec, sum(Quantity) as quantityLeft FROM mystore WHERE Location='$loc' group by Item,Spec");

while($re=mysqli_fetch_assoc($count))
				{
	$spare=$re['Item'];
	$speci=$re['Spec'];
	//$quantityLeft=$re['quantityLeft'];
	$N4=0;
    $tinit=0;
	$tinite=0;
	$rest=0;
	$N14=0;
	$sinit=0;
$dox=mysqli_query($conn,"SELECT *FROM store WHERE DDate<'$dat1' AND Location='$loc' AND Status='1' AND Item='$spare' AND Spec='$speci' ORDER BY Item ASC");
while($reset=mysqli_fetch_assoc($dox))
					{
	$init=$reset['Quantity'];
	$tinit=$tinit+$init;
					}

$doy=mysqli_query($conn,"SELECT *FROM store WHERE DDate<'$dat1' AND Location='$loc' AND Status='0' AND Item='$spare' AND Spec='$speci' ORDER BY Item ASC");
while($rest=mysqli_fetch_assoc($doy))
					{
	$inite=$rest['Quantity'];
	$tinite=$tinite+$inite;
					}
$sinit=$tinit-$tinite;
$do=mysqli_query($conn,"SELECT *FROM store WHERE DDate>='$dat1' AND DDate<='$dat2' AND Location='$loc' AND Status='1' AND Item='$spare' AND Spec='$speci' ORDER BY Item ASC");
while($res=mysqli_fetch_assoc($do))
		{
			$N40=$res['Quantity'];
			$N4=$N4+$N40;
		
		}
$do=mysqli_query($conn,"SELECT *FROM store WHERE DDate>='$dat1' AND DDate<='$dat2' AND Location='$loc' AND Status='0' AND Item='$spare' AND Spec='$speci' ORDER BY Item ASC");
while($res=mysqli_fetch_assoc($do))
		{
			$N140=$res['Quantity'];
			$N14=$N14+$N140;
		}
		$rest=($sinit+$N4)-$N14;
		if($n%2==0)
print("<TR BGCOLOR=#F8F8F8><TD>&nbsp;&nbsp;$spare - $speci&nbsp;&nbsp;</TD><TD><CENTER>$sinit</TD><TD><CENTER>$N4</TD>
                   <TD><CENTER>$N14</TD><TD><CENTER>$rest</TD></TR>");
				   else
print("<TR BGCOLOR=#FFFFCC><TD>&nbsp;&nbsp;$spare - $speci&nbsp;&nbsp;</TD><TD><CENTER>$sinit</TD><TD><CENTER>$N4</TD>
                   <TD><CENTER>$N14</TD><TD><CENTER>$rest</TD></TR>");
				   $n++;
		}
		print("</TABLE>");
			}

			elseif($item=="all" AND $radio=="out")
			{
print("<CENTER><TABLE><TR><TD WIDTH=70%>
       <TABLE style='font-size:11px; color:#3090C7;' ONCLICK=history.go(-1) TITLE='Click to go back'>
	   <TR><TD>Location </TD><TD>:&nbsp;&nbsp;$loc</TD></TR>
	   <TR><TD>Spare Part </TD><TD>:&nbsp;&nbsp;All outgoing</TD></TR>
	   <TR><TD>Specification </TD><TD>:&nbsp;&nbsp;All outgoing</TD></TR>
	   <TR><TD>Period </TD><TD>:&nbsp;&nbsp;$dat1 - $dat2</TD></TR>
	   <TR><TD COLSPAN=2>&nbsp;VIRUNGA EXPRESS</TD></TR></TABLE>
	   </TD><TD><DIV ALIN=LEFT><img style=float:left;margin-left:5px;margin-top:5px; src=virungalogo.png height=100px /></TD></TR></TABLE>

<CENTER><FONT SIZE=2 COLOR=#3090C7 FACE='COMIC SANS MS'><BR><U>Stock Report</U><BR><BR></FONT>
<TABLE style='border-color:#3090C7; border-style:solid; border-width:1px; font-size:11px;' BGCOLOR=FFFFFF ONCLICK=history.go(-1) TITLE='Click to go back'>
<TR BGCOLOR=#FFFFCC><TH>NUMBER</TH><TH>DATE</TH><TH>SPARE PART</TH><TH>SPECIFICATION</TH><TH>QUANTITY</TH><TH>CONSUMER</TH><TH>DOCUMENT</TH><TH>OPERATOR</TH></TR>");

	$N4=0;
$do=mysqli_query($conn,"SELECT *FROM store WHERE DDate>='$dat1' AND DDate<='$dat2' AND Location='$loc' AND Status='0' ORDER BY DDate ASC");
while($res=mysqli_fetch_assoc($do))
		{
			$N1=$res['Number'];
			$N2=$res['Item'];
			$N3=$res['Spec'];
			$N4=$res['Quantity'];
			$N5=$res['DDate'];
			$N6=$res['Document'];
			$N7=$res['Operator'];
			$N8=$res['Plaque'];
		
		if($N4!=0 AND $n%2==0)
print("<TR BGCOLOR=#F8F8F8><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;$N5</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD><TD><CENTER>$N4</TD>
        <TD>&nbsp;&nbsp;$N8</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
		elseif($N4!=0 AND $n%2!=0)
print("<TR BGCOLOR=#FFFFCC><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;$N5</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD><TD><CENTER>$N4</TD>
        <TD>&nbsp;&nbsp;$N8</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
		$n++;
		}
		print("</TABLE>");
			}
			elseif($item!="all" AND $radio=="in")
			{
print("<CENTER><TABLE><TR><TD WIDTH=70%>
       <TABLE style='font-size:11px; color:#3090C7;' ONCLICK=history.go(-1) TITLE='Click to go back'>
	   <TR><TD>Location </TD><TD><B><FONT SIZE=3 COLOR=#3090C7 FACE=COMIC SANS MS>:&nbsp;&nbsp;$loc</TD></TR>
	   <TR><TD>Spare Part </TD><TD>:&nbsp;&nbsp;$item</TD></TR>
	   <TR><TD>Specification </TD><TD>:&nbsp;&nbsp;$spec</TD></TR>
	   <TR><TD>Period </TD><TD>:&nbsp;&nbsp;$dat1 - $dat2</TD></TR>
	   <TR><TD COLSPAN=2>&nbsp;VIRUNGA EXPRESS</TD></TR></TABLE>
	   </TD><TD><DIV ALIN=LEFT><img style=float:left;margin-left:5px;margin-top:5px; src=virungalogo.png height=100px /></TD></TR></TABLE>

<CENTER><FONT SIZE=2 COLOR=#3090C7 FACE='COMIC SANS MS'><U>Stock Report</U><BR><BR></FONT>
<TABLE style='border-color:#3090C7; border-style:solid; border-width:1px; font-size:11px;' BGCOLOR=FFFFFF ONCLICK=history.go(-1) TITLE='Click to go back'>
<TR BGCOLOR=#FFFFCC><TH>DATE</TH><TH>SPARE PART</TH><TH>QUANTITY</TH><TH>DOCUMENT</TH><TH>OPERATOR</TH></TR>");

$do=mysqli_query($conn,"SELECT *FROM store WHERE Item='$item' AND Spec='$spec' AND DDate>='$dat1' AND DDate<='$dat2' AND Location='$loc' AND Status='1' ORDER BY Item ASC");
$N10=0;
while($res=mysqli_fetch_assoc($do))
		{
	        $N1=$res['DDate'];
			$N2=$res['Item'];
			$N3=$res['Spec'];
			$N4=$res['Quantity'];
			$N6=$res['Document'];
			$N7=$res['Operator'];
		    if($n%2==0)
print("<TR BGCOLOR=#F8F8F8><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2 - $N3&nbsp;&nbsp;</TD>
			<TD><CENTER>$N4</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
			else
print("<TR BGCOLOR=#FFFFCC><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2 - $N3&nbsp;&nbsp;</TD>
			<TD><CENTER>$N4</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
            $n++;
            $N10=$N10+$N4;
		}
		print("<TR><TH COLSPAN=2><BR>TOTAL</TH><TH><BR>$N10</TD></TR></TABLE>");
			}
			elseif($item!="all" AND $radio=="out")
			{
print("<CENTER><TABLE><TR><TD WIDTH=70%>
       <TABLE style='font-size:11px; color:#3090C7;' ONCLICK=history.go(-1) TITLE='Click to go back'>
	   <TR><TD>Location </TD><TD>:&nbsp;&nbsp;$loc</TD></TR>
	   <TR><TD>Spare Part </TD><TD>:&nbsp;&nbsp;$item</TD></TR>
	   <TR><TD>Specification </TD><TD>:&nbsp;&nbsp;$spec</TD></TR>
	   <TR><TD>Period </TD><TD>:&nbsp;&nbsp;$dat1 - $dat2</TD></TR>
	   <TR><TD COLSPAN=2>&nbsp;VIRUNGA EXPRESS</TD></TR></TABLE>
	   </TD><TD><DIV ALIN=LEFT><img style=float:left;margin-left:5px;margin-top:5px; src=virungalogo.png height=100px /></TD></TR></TABLE>

<CENTER><FONT SIZE=2 COLOR=#3090C7 FACE='COMIC SANS MS'><U>Stock Report</U><BR><BR></FONT>
<TABLE style='border-color:#3090C7; border-style:solid; border-width:1px; font-size:11px;' BGCOLOR=FFFFFF ONCLICK=history.go(-1) TITLE='Click to go back'>
<TR BGCOLOR=#FFFFCC><TH>DATE</TH><TH>SPARE PART</TH><TH>QUANTITY</TH><TH>COMSUMER</TH><TH>DOCUMENT</TH><TH>OPERATOR</TH></TR>");

$do=mysqli_query($conn,"SELECT *FROM store WHERE Item='$item' AND Spec='$spec' AND DDate>='$dat1' AND DDate<='$dat2' AND Location='$loc' AND Status='0' ORDER BY Item ASC");
$N10=0;
while($res=mysqli_fetch_assoc($do))
		{
	        $N1=$res['DDate'];
			$N2=$res['Item'];
			$N3=$res['Spec'];
			$N4=$res['Quantity'];
			$N6=$res['Document'];
			$N7=$res['Operator'];
			$N8=$res['Plaque'];
		    if($n%2==0)
print("<TR BGCOLOR=#F8F8F8><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2 - $N3&nbsp;&nbsp;</TD>
        <TD><CENTER>$N4</TD><TD>&nbsp;&nbsp;$N8</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
		else
print("<TR BGCOLOR=#FFFFCC><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2 - $N3&nbsp;&nbsp;</TD>
        <TD><CENTER>$N4</TD><TD>&nbsp;&nbsp;$N8</TD><TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
            $n++;
            $N10=$N10+$N4;
		}
		print("<TR><TH COLSPAN=2><BR>TOTAL</TH><TH><BR>$N10</TD></TR></TABLE>");
			}
			elseif($item!="all" AND $radio=="")
			{
print("<CENTER><TABLE><TR><TD WIDTH=70%>
       <TABLE style='font-size:11px; color:#3090C7;' ONCLICK=history.go(-1) TITLE='Click to go back'>
	   <TR><TD>Location </TD><TD>:&nbsp;&nbsp;$loc</TD></TR>
	   <TR><TD>Spare Part </TD><TD>:&nbsp;&nbsp;$item</TD></TR>
	   <TR><TD>Specification </TD><TD>:&nbsp;&nbsp;$spec</TD></TR>
	   <TR><TD>Period </TD><TD>:&nbsp;&nbsp;$dat1 - $dat2</TD></TR>
	   <TR><TD COLSPAN=2>&nbsp;VIRUNGA EXPRESS</TD></TR></TABLE>
	   </TD><TD><DIV ALIN=LEFT><img style=float:left;margin-left:5px;margin-top:5px; src=virungalogo.png height=100px /></TD></TR></TABLE>

<CENTER><FONT SIZE=2 COLOR=#3090C7 FACE='COMIC SANS MS'><U>Stock Report</U><BR><BR></FONT>
<TABLE style='border-color:#3090C7; border-style:solid; border-width:1px; font-size:11px;' BGCOLOR=FFFFFF ONCLICK=history.go(-1) TITLE='Click to go back'>
<TR BGCOLOR=#FFFFCC><TH>DATE</TH><TH>SPARE PART</TH><TH>QUANTITY IN</TH><TH>QUANTITY OUT</TH><TH>DOCUMENT</TH><TH>OPERATOR</TH></TR>");

$do=mysqli_query($conn,"SELECT *FROM store WHERE Item='$item' AND Spec='$spec' AND DDate>='$dat1' AND DDate<='$dat2' AND Location='$loc' ORDER BY Item ASC");
$N10=0;
$N100=0;
while($res=mysqli_fetch_assoc($do))
		{
	        $N1=$res['DDate'];
			$N2=$res['Item'];
			$N3=$res['Spec'];
			$N6=$res['Document'];
			$N7=$res['Operator'];
			$N8=$res['Number'];			
			$N4=0;
			$N40=0;

$do1=mysqli_query($conn,"SELECT *FROM store WHERE Number='$N8' AND Status='1'");
$c=mysqli_num_rows($do1);
if($c)
			{
$ri=mysqli_fetch_assoc($do1);
			{
	$N4=$ri['Quantity'];
			}
			}
$do2=mysqli_query($conn,"SELECT *FROM store WHERE Number='$N8' AND Status='0'");
$s=mysqli_num_rows($do2);
if($s)
			{
$ris=mysqli_fetch_assoc($do2);
			{
	$N40=$ris['Quantity'];
			}
			}
		    if($n%2==0)
				
print("<TR BGCOLOR=#F8F8F8><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2 - $N3&nbsp;&nbsp;</TD><TD><CENTER>$N4</TD><TD><CENTER>$N40</TD>
			<TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
			 else
print("<TR BGCOLOR=#FFFFCC><TD>&nbsp;&nbsp;$N1</TD><TD>&nbsp;&nbsp;$N2 - $N3&nbsp;&nbsp;</TD><TD><CENTER>$N4</TD><TD><CENTER>$N40</TD>
             <TD>&nbsp;&nbsp;$N6</TD><TD>&nbsp;&nbsp;$N7</TD></TR>");
            $n++;
            $N10=$N10+$N4;
			$N100=$N100+$N40;
		}
		print("<TR><TH COLSPAN=2><BR>TOTAL</TH><TH><BR>$N10</TD><TH><BR>$N100</TD></TR></TABLE>");
			}
	}
	
		
	else
		{
		print("<B><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		           <FONT COLOR=#FF0000>Invalid confirmation key! <A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></B>");
		}
	}
?>
</TABLE>
  
 </BODY>
</HTML>
