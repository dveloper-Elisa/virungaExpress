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
<BODY BGCOLOR="#54C571"><CENTER>
  <div id="header">
  <img style="float:left;margin-left:5px;margin-top:5px;" src="virungalogo.png" alt="" height="100px" /> 
  <h1>VIRUNGA EXPRESS</h1>
  <h2>Reporting System</h2>
  </div>
<?php
if(isset($_POST['view']))
	{
		$dat1=$_POST['dat1'];
		$dat2=$_POST['dat2'];
		include'connect.php';

print("<BR><U><B><CENTER>FUEL MONTHLY CONSUMPTION FROM : $dat1 TO : $dat2</CENTER></B></U><BR>");

$que=mysqli_query($conn,"SELECT DATE FROM fuel WHERE DATE BETWEEN '$dat1' AND '$dat2'");
//$re=mysqli_num_rows($que);

if(mysqli_num_rows($que)){
print("<CENTER><TABLE border=1 width=68% class=imagetable ONCLICK=history.go(-1) TITLE='Click to go back'>
<TR><TH width=20%>DATE</TH><TH>AMOUNT</TH></TR>");
$ques=mysqli_query($conn,"SELECT DATE FROM fuel WHERE DATE BETWEEN '$dat1' AND '$dat2' GROUP BY DATE ORDER BY DATE ASC");
while($ros=mysqli_fetch_assoc($ques)){
	$da=$ros['DATE'];
	$qued=mysqli_query($conn,"SELECT DATE,MONTANT FROM fuel WHERE DATE='$da'");
	$tot=0;
	$totgen=0;
while($rod=mysqli_fetch_array($qued)){
$montant=$rod['MONTANT'];
$tot+=$montant;
}
$totgen+=$tot;
$tot=number_format($tot);
print("<TR><TD> &nbsp;&nbsp; $da</TD><TD align=right>$tot &nbsp;&nbsp; </TD></TR>");
$tot=0;
}
$totgen=number_format($totgen);
print("<TR><TH>TOTAL</TH><TH>$totgen Rwf</TH></TR>");
print("</table></CENTER>");
print("<BR><BR>Done at KIGALI, On $Date ");
}
else{
	print("<BR><BR><BR><BR><BR><BR><BR><CENTER><FONT COLOR=#FF0000>Sorry, No result to be displayed! 
	<A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></FONT></CENTER>");
		}
	}
?>
  
 </BODY>
</HTML>
