<?php
include("home.php");
?>

<style>
.night{
	padding: 3px 10px;
	background-color: #333333;
	color: wheat;
	font-size: medium;
	font-weight: bold;
	border: 1px goldenrod solid;
	margin: 1em;
	border-radius: 5px;

}
.night:hover{
	background-color: wheat;
	color: black;
	transition: 30ms ease-in;
	border-radius: 5px;
	border: 1px goldenrod solid;
	cursor: pointer;
}
</style>

<div id="contents"><BR><BR>
<CENTER><TABLE WIDTH="80%"><TR>
<TD WIDTH="40%"><CENTER>
<FONT COLOR="#54C571" SIZE="2" FACE="COMIC SANS MS"><B>Daily Report</B></FONT><br>
<input type="button" onClick="parent.location='reportfuel.php'" 
value="Fuel Report" style="height:1.5em; width:10em;"><BR>
<input type="button" onClick="parent.location='dexpenses.php'" value="Daily Expenses" style="height:1.6em; width:10em;">
<br><br><br>
<TABLE WIDTH="100%" class="imagetable"><TR>
<TD COLSPAN="3"><b><center><br>Reporting System</TD></TR>
<TR><TH>&nbsp;&nbsp;Fuel Report&nbsp;&nbsp;</TD>
<TH>&nbsp;&nbsp;Stock report&nbsp;&nbsp;</TD>
<TH>&nbsp;&nbsp;Expenses&nbsp;&nbsp;</td>
</TR>
<?php
include 'connect.php';
$pofs=0;$poss=0;$poes=0;
$dof=mysqli_query($conn,"SELECT *FROM store WHERE Item='carburant' AND DDate='$Date'");
while($rof=mysqli_fetch_assoc($dof)){
$pof=$rof['Price'];
$pofs=$pofs+$pof;
}
$dos=mysqli_query($conn,"SELECT *FROM store WHERE Status=0 AND DDate='$Date'");
while($ros=mysqli_fetch_assoc($dos)){
$pos=$ros['Price'];
$poss=$poss+$pos;
}
$doe=mysqli_query($conn,"SELECT *FROM store WHERE Item!='carburant' AND DDate='$Date' AND Status=2");
while($roe=mysqli_fetch_assoc($doe)){
$poe=$roe['Price'];
$poes=$poes+$poe;
}
$TOT=$poes+$poss+$pofs;
$TOTE=number_format($TOT);
print("<TR><TD><CENTER>$pofs</TD>
<TD><CENTER>$poss</TD>
<TD><CENTER>$poes</td>
</TR>
<TR><TH COLSPAN=3>$TOTE Rwf</TH></TR></TABLE>");
?>
<BR>
</TD>
<TD WIDTH="30%"><CENTER>
<FONT COLOR="#54C571" SIZE="2" FACE="COMIC SANS MS"><B>Stock Report</B></FONT><br>
<input type="button" onClick="parent.location='sreport.php'" 
value="Stock Status" style="height:1.6em; width:8em;"><br><br>
<input type="button" onClick="parent.location='sreport.php'" 
value="Stock Report" style="height:1.6em; width:8em;"><br><br>
<input type="button" onClick="parent.location='pendingreport.php'" 
value="Stock Pending" style="height:1.6em; width:8em;"><br><br>
<FONT COLOR="#54C571" SIZE="2" FACE="COMIC SANS MS"><B>Express Report</B></FONT><BR>

<input type="button" onClick="parent.location='report.php'"
value="Agency Report" style="height:1.5em; width:10em;"><br>
</form>

<input type="submit" onClick="parent.location='creport.php'" value="Cashbox's Report" style="height:1.5em; width:10em;"><br><br>
<input type="submit" name="book" value="Click Here" style="height:1.5em; width:10em;">
</TD>
<TD WIDTH="30%"><CENTER><br>
<FONT COLOR="#54C571" SIZE="2" FACE="COMIC SANS MS"><B>Other Links</B></FONT><br>

<input type="button" onClick="parent.location='careport.php'" 
value="Car's Report" style="height:1.6em; width:8em;"><br>
<input type="button" onClick="parent.location='cars.php'" 
value="Car's Location" style="height:1.6em; width:8em;"><br><br><br>
<input type="button" onClick="parent.location='transaction.php'" 
value="Transactions" style="height:1.6em; width:8em;">
<!-- ADDED NAVIGATION TO NIGHTPARKING INFO -->
<input type="button" onclick="location='./night/nightParking.php'" value="Night Parking" class="night"/>

</TD>
</TR></TABLE>
</center><BR><BR><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<FONT COLOR="#54C571" SIZE="2" FACE="COMIC SANS MS"><B>Monthly report</B></FONT>
<HR WIDTH="80%" style='color : cyan'><CENTER>

<TABLE WIDTH="80%">
<TR>
	<TH><input type="button" onClick="parent.location='mfuel.php'" 
			value="Fuel Report" style="height:1.6em; width:10em;"></TH>
	<TH><input type="button" value="Express Report" style="height:1.6em; width:10em;"></TH>
	<TH><input type="button" value="Expenses Report" style="height:1.6em; width:10em;"></TH>
</TR>
</TABLE>
<BR>
<p class="MyLink">Click on a button according to the operation you want to perform.</p><BR>

</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>