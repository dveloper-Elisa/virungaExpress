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
        $plate=$_POST['plate'];
	    $engine=$_POST['engine'];
	    $driver=$_POST['driver'];
		$dat1=$_POST['dat1'];
		$dat2=$_POST['dat2'];
		include'connect.php';
		
		
	if($plate==='ALL' AND $engine==='ALL' AND $driver==='ALL'){
		$que=mysqli_query($conn,"SELECT *FROM fuel WHERE DATE BETWEEN '$dat1' AND '$dat2' ORDER BY kmsper_one_liter DESC");
print("<BR><U>FUEL REPORT FROM : $dat1 TO : $dat2</U><BR><BR>");
	}
	elseif($plate!='ALL' AND $engine==='ALL' AND $driver==='ALL'){
		$que=mysqli_query($conn,"SELECT *FROM fuel WHERE PLAQUE='$plate' AND DATE BETWEEN '$dat1' AND '$dat2' ORDER BY kmsper_one_liter DESC");
print("<BR><U>FUEL REPORT FOR $plate FROM : $dat1 TO : $dat2</U><BR><BR>");
	}
	elseif($plate==='ALL' AND $engine==='ALL' AND $driver!='ALL'){
		$que=mysqli_query($conn,"SELECT *FROM fuel WHERE driver='$driver' and  DATE BETWEEN '$dat1' AND '$dat2' ORDER BY kmsper_one_liter DESC");
print("<BR><U>FUEL REPORT FOR $driver FROM : $dat1 TO : $dat2</U><BR><BR>");
	}
	elseif($plate==='ALL' AND $engine!='ALL' AND $driver==='ALL'){
		$que=mysqli_query($conn,"SELECT *FROM fuel WHERE MOTEUR='$engine' AND DATE BETWEEN '$dat1' AND '$dat2' ORDER kmsper_one_liter DESC");
print("<BR><U>FUEL REPORT FOR $engine FROM : $dat1 TO : $dat2</U><BR><BR>");
	}
	elseif($plate==='ALL' AND $engine!='ALL' AND $driver!='ALL'){
		$que=mysqli_query($conn,"SELECT *FROM fuel WHERE MOTEUR='$engine' and driver='$driver' AND DATE BETWEEN '$dat1' AND '$dat2' ORDER BY kmsper_one_liter DESC");
print("<BR><U>FUEL REPORT FOR $engine AND $driver FROM : $dat1 TO : $dat2</U><BR><BR>");
	}	
	elseif($plate!='ALL' AND $engine!='ALL' AND $driver!='ALL'){
				$que=mysqli_query($conn,"SELECT *FROM fuel WHERE MOTEUR='$engine' and driver='$driver' and PLAQUE='$plate' AND DATE BETWEEN '$dat1' AND '$dat2' ORDER BY kmsper_one_liter DESC");
print("<BR><U>FUEL REPORT FOR $plate ON $engine AND $driver  FROM : $dat1 TO : $dat2</U><BR><BR>");
	}	

/*if($plate!='ALL'){
$que=mysqli_query($conn,"SELECT *FROM fuel WHERE PLAQUE='$plate' AND DATE BETWEEN '$dat1' AND '$dat2' ORDER BY DATE,HEURE ASC");
print("<BR><U>FUEL REPORT FOR $plate FROM : $dat1 TO : $dat2</U><BR><BR>");
}

elseif($plate=='ALL' AND $engine!='ALL'){
$que=mysqli_query($conn,"SELECT *FROM fuel WHERE MOTEUR='$engine' AND DATE BETWEEN '$dat1' AND '$dat2' ORDER BY DATE,HEURE ASC");
print("<BR><U>FUEL REPORT FOR $engine FROM : $dat1 TO : $dat2</U><BR><BR>");
}

else{
$que=mysqli_query($conn,"SELECT *FROM fuel WHERE DATE BETWEEN '$dat1' AND '$dat2' ORDER BY DATE,HEURE ASC");
print("<BR><U>FUEL REPORT FROM : $dat1 TO : $dat2</U><BR><BR>");
}*/

$r=mysqli_num_rows($que);
if($r){
print("<TABLE WIDTH=68% class=imagetable ONCLICK=history.go(-1) TITLE='Click to go back'>
    <TR>
	<TH>DATE</TH>
	<TH>HEURE</TH>
	<TH>PLAQUE</TH>
	<TH>MOTEUR</TH>
	<TH>DRIVER</TH>
	<TH>KM/DEP.</TH>
	<TH>KM/ARR.</TH>
	<TH>KM/PARC.</TH>
	<TH>PHYS. QTY.</TH>
	<TH>U. PRICE</TH>
	<TH>AMOUNT</TH>
	<TH>AMOUNT<BR>/100KM</TH>
	<TH>AMOUNT<BR>/1KM</TH>
	<TH>KM<BR>/1L</TH>
    </TR>");
$i=0;
$montanttotal=0;
$montant100km=0;
$montant1km=0;
while($row=mysqli_fetch_assoc($que)){
$dir=$row['DATE'];             
$pp=$row['HEURE'];
$am=$row['PLAQUE'];
$moteur=$row['MOTEUR'];
$goods=$row['KMDEP'];
$car=$row['KMARR'];
$driname=$row['KMPARC'];
$deptime=$row['QTEPHYS'];
$date=$row['PRIXUNIT'];
$montant=$row['MONTANT'];
$montant100=$row['MONTANT100KM'];
$kml=$driname/$deptime;
$kml=round($kml,1);
$montant100=round($montant100,1);
$m100=number_format($montant100);
$montant1=$row['MONTANT1KM'];
$KMLiter=round($row['kmsper_one_liter'],2);
$driver=$row['driver'];
if($montant1>0){
$i+=1;
}
$montant1=round($montant1,1);
$m1=number_format($montant1);
$montanttotal+=$montant;
$m=number_format($montanttotal);
if($montant1>0){
$montant100km+=$montant100;
$montant1km+=$montant1;
}

print("
<TR>
	<TD>$dir</TD>
	<TD>$pp</TD>
	<TD>$am</TD>
	<TD>$moteur</TD>
	<TD>$driver</TD>
	<TD align=right>$goods</TD>
	<TD align=right>$car</TD>
	<TD align=right>$driname</TD>
	<TD align=right>$deptime</TD>
	<TD align=right>$date</TD>
	<TD align=right>$montant</TD>
	<TD align=right>$m100</TD>
	<TD align=right>$m1</TD>
	<TD align=right> $KMLiter</TD>

</TR>");
}
$mean100=$montant100km/$i;
$mean100=round($mean100,1);
$mean100=number_format($mean100);
$mean1=$montant1km/$i;
$mean1=round($mean1,1);
$mean1=number_format($mean1);

print("<TR>
	<TH colspan=10><BR>TOTAL AMOUNT</TH>
	<TH align=right><BR>$m Rwf</TH>
	<TH></TH>
	<TH></TH><TH></TH>
</TR>
<TR>
	<TH colspan=11><BR>AVERAGE FOR 100KM ET 1KM</TH>
	<TH align=right><BR>$mean100 Rwf</TH>
	<TH align=right><BR>$mean1 Rwf</TH>
	<TH></TH>
</TR>
</table>");

print("<BR>Done at KIGALI, On $Date");
}
else{
	print("<BR><BR><BR><BR><BR><BR><BR><CENTER><FONT COLOR=#FF0000>Sorry, No result to be displayed! 
	<A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></FONT></CENTER>");
		}
	}
	
	if(isset($_POST['dateranger']))
	{
        $plate=$_POST['plate'];
	    $engine=$_POST['engine'];
	    $driver=$_POST['driver'];
		$dat1=$_POST['dat1'];
		$dat2=$_POST['dat2'];
		include'connect.php';
		
		
	if($dat1!='' AND $dat2!='' AND $dat1<$dat2){
	   $rangerdates=mysqli_query($conn,"SELECT *, MIN(KMDEP) AS Odo_low_readings, 
       MAX(KMDEP) AS Odo_last_readings, 
       MAX(DATE) AS max_date, 
       SUM(`QTEPHYS`) AS maztu
FROM fuel 
WHERE `KMARR` != '' 
AND (PLAQUE, DATE) IN (
    SELECT PLAQUE, MIN(DATE) 
    FROM fuel 
    WHERE DATE BETWEEN '$dat1' AND '$dat2'
    GROUP BY PLAQUE
)
OR (PLAQUE, DATE) IN (
    SELECT PLAQUE, MAX(DATE) 
    FROM fuel
    WHERE DATE BETWEEN '$dat1' AND '$dat2'
    GROUP BY PLAQUE
)
GROUP BY PLAQUE 
ORDER BY ((MAX(KMDEP) - MIN(KMDEP)) / SUM(QTEPHYS)) DESC " );
		//$que=mysqli_query($conn,"SELECT *FROM fuel WHERE DATE BETWEEN '$dat1' AND '$dat2' ORDER BY DATE,HEURE ASC");
//print("<BR><U>FUEL REPORT FROM : $dat1 TO : $dat2</U><BR><BR>");
print("<h3 id='datatable-title' style='text-align: center; margin-top: 20px;'>RANGE FUEL REPORT FROM : $dat1 TO : $dat2</h3>");
	}
	


$rows=mysqli_num_rows($rangerdates);

if($rows){

print("<TABLE WIDTH=68% class=imagetable ONCLICK=history.go(-1) TITLE='Click to go back'>
    <thead>
    <TR> <TH>#</TH>
        <TH>DATES</TH>
       
        <TH>Plate Number</TH>
        <TH>Engine Type</TH>
        
        <TH>Odo First readings.</TH>
        <TH>Odo First readings</TH>
        <TH>Distance in km.</TH>
        <TH>Fuel used in L</TH>
        <TH>Fuel (l) <BR>/100KM</TH>
       
        <TH>Amount</TH>
        <TH>AMOUNT<BR>/100KM</TH>
        <TH>AMOUNT<BR>/1KM</TH>
        <TH>Km<BR>/L</TH>
        
    </TR>
    </thead>
    <tbody>");
$montanttotal=0;
$montant100km=0;
$montant1km=0;
$i=0;
while($row=mysqli_fetch_assoc($rangerdates)){
    $dir=$row['DATE'].'-'.$row['max_date'];             
    $pp=$row['HEURE'];
    $plate=$row['PLAQUE'];
    $moteur=$row['MOTEUR'];
    $odo_read1=$row['KMDEP'];
    $odo_read2=$row['Odo_last_readings'];
    $distanceInKm=$odo_read2-$odo_read1;
   
    
    
 
    
   
    $driver=$row['driver'];
    $summing=mysqli_query($conn,"SELECT SUM(`QTEPHYS`) AS maztu ,SUM(`MONTANT`) as amount  FROM `fuel` WHERE `PLAQUE`='$plate' and DATE BETWEEN '$dat1' AND '$dat2'
    GROUP BY PLAQUE ");
    $su=mysqli_fetch_assoc($summing);
    $tot_amount=$su['amount'];
    $tot_maztu=$su['maztu'];
    $tot_maztu=round($tot_maztu,2);
    if($distanceInKm>0){
        $distanceInKm;
         $maztu100km_in_litters=$tot_maztu*100/$distanceInKm;
    $maztu100km_in_litters=round($maztu100km_in_litters,2);
     $montant1=$tot_amount/$distanceInKm;
    
    $montant100= $tot_amount*100/$distanceInKm;
    $montant100=round($montant100,1);
    $m100=number_format($montant100);
    $kmterdPerLitter=$distanceInKm/$tot_maztu;
    $kmterdPerLitter=round($kmterdPerLitter,2);
        
    }else{
        $distanceInKm=0;
        
         $maztu100km_in_litters=0;
    $maztu100km_in_litters=round($maztu100km_in_litters,2);
     $montant1=0;
    
    $montant100= 0;
    $montant100=round($montant100,1);
    $m100=number_format($montant100);
    $kmterdPerLitter=$distanceInKm/$tot_maztu;
    }
   
    

    if($montant1>0){
        $i+=1;
    }

    $montant1=round($montant1,1);
    $m1=number_format($montant1);
    $montanttotal+=$tot_amount;
    $m=number_format($montanttotal);
    if($montant1>0){
        $montant100km+=$montant100;
        $montant1km+=$montant1;
    }

    print("
    <TR>
        <TD>$i</TD>
         <TD>$dir</TD>
        
        <TD>$plate</TD>
        <TD>$moteur</TD>
       
        <TD align=right>$odo_read1</TD>
        <TD align=right>$odo_read2</TD>
        <TD align=right>$distanceInKm</TD>
        
        <TD align=right> $tot_maztu</TD>
        <TD align=right>$maztu100km_in_litters</TD>
        <TD align=right>$tot_amount</TD>
        
        <TD align=right>$m100</TD>
        <TD align=right>$m1</TD>
        <td align=right>$kmterdPerLitter<td>
        
    </TR>");
}
if ($i != 0) {
$mean100=$montant100km/$i;
$mean100=round($mean100,1);
$mean100=number_format($mean100);
$mean1=$montant1km/$i;
$mean1=round($mean1,1);
$mean1=number_format($mean1);
} else {
    // Handle the case where division cannot occur
   $mean100=0;
$mean100=round($mean100,1);
$mean100=number_format($mean100);
$mean1=0;
$mean1=round($mean1,1);
$mean1=number_format($mean1);
}


print("<TR>
	<TH colspan=9><BR>TOTAL AMOUNT</TH>
	<TH align=right><BR>$m Rwf</TH>
	<TH></TH>
	<TH></TH><TH></TH>
</TR>
<TR>
	<TH colspan=10 ><BR>Average for  100Km & 1Km</TH>
	<TH align=right><BR>$mean100 Rwf</TH>
	<TH align=right><BR>$mean1 Rwf</TH><TH></TH>
</TR>
</table>");

}
else{
	print("<BR><BR><BR><BR><BR><BR><BR><CENTER><FONT COLOR=#FF0000>Sorry, No result to be displayed! 
	<A HREF=javascript:history.go(-1)>Please click here to try again ...</A></FONT></FONT></CENTER>");
		}
	}
?>
  
 </BODY>
</HTML>
