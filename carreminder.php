<?php
include("home.php");
?>

<div id="contents"><CENTER>
<!-- <FONT SIZE="2" COLOR="#3090C7" FACE="COMIC SANS MS">
		<U>FILL THE FORM TO SAVE VEHICULE FUEL CONSUMPTION</U></FONT><BR><BR>
		<FORM METHOD="POST" ACTION="expenses.php" onsubmit="return checkform(this);">
		<font face="verdana" size="2">Date / Price : </font><INPUT TYPE="text" NAME="date" SIZE="15" id='SelectedDate' onClick='GetDate(this)' STYLE='border-color:#45E01F'>&nbsp;<INPUT TYPE="text" NAME="price" SIZE="5">
		<INPUT TYPE="submit" name="submit" value="CONTINUE">
	</FORM>
	-->
	
	
	<h1>Car Reminder page</h1>
	
	
<?php
    print("<FORM METHOD=POST ACTION=carreminder.php NAME=Form onsubmit='return checkformes(this);'>

<CENTER><TABLE WIDTH=98%>
<TR>
	<TD><font face=verdana size=2>PLAQUE/Document: </TD>
	<TD><SELECT NAME=carid>
	<OPTION VALUE='' SELECTED>");

	include'connect.php';
    $query=mysqli_query($conn,"SELECT Carid FROM cars WHERE Carid is not null and Carid!='' ORDER BY Carid ASC"); 
	while($row=mysqli_fetch_assoc($query)){
	$car=$row['Carid'];
    print("<OPTION VALUE=$car>$car</OPTION>");		
	}
	//mysqli_close();	
	print("<OPTION VALUE='Transport_Authorization'>Authorization</OPTION></SELECT></TD>");


	print("<TD><font face=verdana size=2>Type: </TD>
	<TD><SELECT NAME=type>
	<OPTION VALUE='' SELECTED>");


    print("<OPTION VALUE='Insurance'>Insurance</option><OPTION VALUE='Control'>Control</option><OPTION VALUE='Speed_governor'>Speed governor</OPTION><OPTION VALUE='Authorization'>Authorization</OPTION>");		
	
	//mysqli_close();	
	print("</SELECT></TD>");	
	
	$enddate=date("Y-m-d");
	print("<TD><font face=verdana size=2>End Date: </TD>
	<TD><INPUT TYPE=text SIZE=8 NAME=enddate value='$enddate'></TD>
	
	<TD><INPUT TYPE=submit NAME='savereminder' VALUE=&nbsp;&nbsp;&nbsp;SAVE&nbsp;&nbsp;&nbsp;><INPUT TYPE=submit NAME='updatereminder' VALUE=&nbsp;&nbsp;&nbsp;UPDATE&nbsp;&nbsp;&nbsp;></TD>
</TR>
</TABLE>	
</FORM>

");


?>

<?php
if(isset($_POST['updatereminder'])) {	
	$carid=$_POST['carid'];
$type=$_POST['type'];
$enddate=$_POST['enddate'];
include('connect.php');
$query=mysqli_query($conn,"SELECT * FROM car_reminder where car='$carid' and type='$type'");
if($num=mysqli_num_rows($query)){
$updatereminder=mysqli_query($conn,"update car_reminder set notificationDate='$enddate' where car='$carid' and type='$type'");
mysqli_error($conn);
print("<script>
alert('Reminder is updated');
</script>");
}else {
print("<script>
alert('The reminder does not exist. Please create it.');
</script>");
}

}

?>



<?php
if(isset($_POST['savereminder'])) {	
	$carid=$_POST['carid'];
$type=$_POST['type'];
$enddate=$_POST['enddate'];
include('connect.php');
$query=mysqli_query($conn,"SELECT * FROM car_reminder where car='$carid' and type='$type'");
if(!$num=mysqli_num_rows($query)){
$reminder=mysqli_query($conn,"INSERT INTO car_reminder (car,type,notificationDate) VALUES('$carid','$type','$enddate')");
mysqli_error($conn);
print("<script>
alert('Reminder is saved');
</script>");
}else {
print("<script>
alert('The reminder Exist. Please update it.');
</script>");
}

}

?>
	
	
<?php
if(isset($_POST['del'])) {	
	$reminderid=$_POST['reminderid'];
include('connect.php');
$updatereminder=mysqli_query($conn,"delete from  car_reminder where reminderid='$reminderid'");
mysqli_error($conn);
print("<script>
alert('Reminder is deleted');
</script>");
}

?>	
	
	
	
<?php
print("<HR WIDTH=90% style=border : none;
                      border-top : 'dashed 1px cyan';
                      color : '#FFFFFF' ;
                      background-color : '#FFFFFF' ;
                      height : 2px;>");

include'connect.php';



$query=mysqli_query($conn,"SELECT * FROM car_reminder ORDER BY type,notificationDate");
if($num=mysqli_num_rows($query)){
print("<div id=show><TABLE WIDTH=100% class=imagetable>
	 <TR>
		<TH>PLAQUE</TH>
		<TH>Type</TH>
		<TH>End Date</TH>
		<TH>Remaining days</TH>
		<TH width='5%'>Delete</TH>
	</TR>");
$n=0;	
while($row=mysqli_fetch_assoc($query))
	{
		$reminderid=$row['reminderid'];
$car=$row['car'];
$type=$row['type'];
$notificationDate=$row['notificationDate'];
$today=date("Y-m-d");
$remainingDays=dateDifference($today , $notificationDate );

if($remainingDays>30){
print("<TR>
		<TD>$car</TD>
		<TD>$type</TD>
		<TD>$notificationDate</TD>
		<TD>$remainingDays</TD>
		<FORM ACTION=carreminder.php METHOD=post>
		<TD><div align=right><INPUT TYPE=hidden NAME=reminderid VALUE=$reminderid>
		<INPUT TYPE=submit NAME=del VALUE=DELETE style='height:1.6em'>&nbsp;&nbsp;</TD></FORM></TR>");
}else if($remainingDays<=30 && $remainingDays>=14){
print("<TR>
		<TD><font color=green>$car</font></TD>
		<TD><font color=green>$type</font></TD>
		<TD><font color=green>$notificationDate</font></TD>
		<TD><font color=green>$remainingDays</font></TD>
		<FORM ACTION=carreminder.php METHOD=post>
		<TD><div align=right><INPUT TYPE=hidden NAME=reminderid VALUE=$reminderid>
		<INPUT TYPE=submit NAME=del VALUE=DELETE style='height:1.6em'>&nbsp;&nbsp;</TD></FORM></TR>");
}else if($remainingDays<14 && $remainingDays>=4){
print("<TR>
		<TD><font color=orange>$car</font></TD>
		<TD><font color=orange>$type</font></TD>
		<TD><font color=orange>$notificationDate</font></TD>
		<TD><font color=orange>$remainingDays</font></TD>
		<FORM ACTION=carreminder.php METHOD=post>
		<TD><div align=right><INPUT TYPE=hidden NAME=reminderid VALUE=$reminderid>
		<INPUT TYPE=submit NAME=del VALUE=DELETE style='height:1.6em'>&nbsp;&nbsp;</TD></FORM></TR>");
}else if($remainingDays<=3){
print("<TR>
		<TD><font color=red>$car</font></TD>
		<TD><font color=red>$type</font></TD>
		<TD><font color=red>$notificationDate</font></TD>
		<TD><font color=red>$remainingDays</font></TD>
		<FORM ACTION=carreminder.php METHOD=post>
		<TD><div align=right><INPUT TYPE=hidden NAME=reminderid VALUE=$reminderid>
		<INPUT TYPE=submit NAME=del VALUE=DELETE style='height:1.6em'>&nbsp;&nbsp;</TD></FORM></TR>");
}
$n++;
}

print("<TR></table></CENTER>

<center><font color='green'>GREEN</font>(Between 30 and 14 days),<font color='orange'>ORANGE</font>(Between 13 and 4 days), <font color='red'>RED</font>(Less or equal 3 days)</center>

</div>");	
	}
	else{
		 //$dat=$_SESSION['date'];
	print("<FONT SIZE=2 COLOR=#3090C7 FACE='COMIC SANS MS'>
		<BR><BR><BR><BR><BR><BR><BR><CENTER><U>No Reminder Recorded</U></CENTER></FONT>");
	}
	
function dateDifference($date_1 , $date_2 )
{
    $differenceFormat = '%R%a';
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
   
}	
	
?>	
	

</div>

</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>