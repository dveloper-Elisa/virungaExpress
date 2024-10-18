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
if(isset($_POST['status']))
	{
        $pword1=$_POST['pword1'];
	    $sto=$_POST['sto'];
		
include'connect.php';
$pass=mysqli_query($conn,"SELECT *FROM users WHERE ((Passwo='$pword1' AND Access='1') OR (Passwo='$pword1' AND Location='ADMIN'))");
$nu=mysqli_num_rows($pass);
$row=mysqli_fetch_assoc($pass);
			{
				$loc=$row['Location'];
			if($loc=='ADMIN')
         $loc=$sto;
		}
if($nu AND $loc==$sto)
		{
	$do=mysqli_query($conn,"SELECT *, SUM(Quantity) AS Quantity FROM mystore WHERE Quantity!=0 AND Location='$loc' GROUP BY Item,Spec ORDER BY Item ASC");
	$nd=mysqli_num_rows($do);
	if($nd){

print("<CENTER><TABLE WIDTH=897><TR><TD><CENTER>       
<FONT SIZE=4 FACE='COMIC SANS MS'><BR><U>$loc Stock Status Report on $Date</U><BR><BR></FONT>
<TABLE WIDTH=100% class=imagetable ONCLICK=history.go(-1) TITLE='Click to go back'>
<TR BGCOLOR=#33CCCC><TH WIDTH=7%>No</TH><TH WIDTH=31%>SPATRE PART</TH><TH WIDTH=31%>SPECIFICATION</TH><TH WIDTH=15%>QUANTITY</TH></TR>");
$n=1;

while($res=mysqli_fetch_assoc($do))
		{
			$N2=$res['Item'];
			$N3=$res['Spec'];		
			$N4=$res['Quantity'];
	
		    if($n%2==0)
print("<TR>
<TD><CENTER>$n</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD><TD><CENTER>$N4</TD></TR>");
			else 
print("<TR>
<TD><CENTER>$n</TD><TD>&nbsp;&nbsp;$N2</TD><TD>&nbsp;&nbsp;$N3</TD><TD><CENTER>$N4</TD></TR>");

            $n++;
		}
print("</TABLE>");
		}
		else{
        print("<B><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		           <FONT COLOR=#FF0000>No result found for your seacrh! <A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></B>");
		}
		}
		else
			{
		print("<B><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		           <FONT COLOR=#FF0000>Invalid confirmation key! <A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></B>");
		}
	}
	?>
  
 </BODY>
</HTML>
