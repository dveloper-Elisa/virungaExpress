 <html>
<script language="JavaScript" type="text/javascript">
 function printpage()
  {  
window.print();
  } 
  </script>
  <link rel="stylesheet" type="text/css" href="newcss.css" />
  <?php
        $sname=$_POST['sname'];
		$phon=$_POST['phon'];
		$courier=$_POST['courier'];
		$qty=$_POST['qty'];
		$rname=$_POST['rname'];
		$rloc=$_POST['rloc'];
		$phon1=$_POST['phon1'];
		$hour=$_POST['hour'];
		$min=$_POST['min'];
		$dat=$_POST['dat'];
		$word=$_POST['word'];	
	    $tim="$hour:$min";
		$hour1=$hour+1;
		$tim1="$hour1:$min";
		$D=strtotime($dat);
		$D1=$D+1;
		$D2=strtotime($Date);

	 include'connect.php';
  $nql9=mysqli_query($conn,"SELECT *FROM user WHERE Passwo='$word'");
  $num=mysqli_num_rows($nql9);
  $row=mysqli_fetch_assoc($nql9);
	 {
		 $ag=$row['Agence'];
		 $op=$row['Name'];
	 }
  if($num)
  {
	if(($D1==$D2) AND ($tim1<$Time))
	  {
		 include'menu.php';
         print("<CENTER><TABLE WIDTH=90%><TR><TD><FIELDSET><CENTER><BR><BR><BR><BR><BR>
	          <BR><BR><BR><BR><FONT COLOR=#FF0000>Sorry, the time you entered is expired! </FONT><BR><BR>
			  <A HREF=javascript:javascript:history.go(-1) class=MyLink>Please, click here to try again</A>
			  <BR><BR><BR><BR><BR><BR><BR><BR><BR></CENTER>
	          </FIELDSET></TD></TR></TABLE>
              <p class=copyright>&copy;COPY RIGHT <B>VIRUNGA EXPRESS</B>: ALL RIGHTS RESERVED</p>");
		  }
		  else
	  {
      $nql8=mysqli_query($conn,"SELECT *FROM price WHERE Type='$courier'");
      $row=mysqli_fetch_assoc($nql8);
	   {
		   $pr=$row['Price'];
	   } 
	   $tot=$pr*$qty;
  $nql=mysqli_query($conn,"INSERT INTO courier (NDate,NTime,SName,SLoc,STel,CType,RName,RLoc,RTel,RDate,DTime,Oper,Amount,Quantity,Sms) VALUES ('$Date','$Time','$sname','$ag','$phon','$courier','$rname','$rloc','$phon1','$dat','$tim','$op','$tot','$qty','0')"); 

  $nql4=mysqli_query($conn,"SELECT *FROM trans WHERE (NDate='$Date' AND DTime='$tim' AND Location='$ag' AND OP='$op')");
  $num4=mysqli_num_rows($nql4);
		  if($num4)
		  {
      $row=mysqli_fetch_assoc($nql4);
			  {
				  $p=$row['Amount'];
			  }
			  $am=$p+$tot;
	  $nql3=mysqli_query($conn,"UPDATE trans SET Amount='$am' WHERE (NDate='$Date' AND DTime='$tim' AND Location='$ag' AND OP='$op')");
		  }
		  else
		  {
			  $nql3=mysqli_query($conn,"INSERT INTO trans (NDate,DTime,Amount,Location,OP) VALUES ('$Date','$tim','$tot','$ag','$op')");
		  }

  $nql1=mysqli_query("SELECT *FROM courier ORDER BY Number ASC");
  while($row=mysqli_fetch_assoc($nql1))
		  {
	  $N0=$row['Number'];
	  $N00=chunk_split($N0,3,"-");
	  $N1=$row['SName'];
	  $N2=$row['STel'];
	  $N3=$row['SLoc'];
	  $N4=$row['CType'];
	  $N5=$row['RName'];
	  $N6=$row['RLoc'];
	  $N7=$row['RTel'];
	  $N8=$row['DTime'];
	  $N09=$row['Oper'];
	  $N19 = explode(" ", $N09);
	  $N9=$N19[0]; 
	  $N10=$row['Amount'];
	  $N11=$row['Quantity'];
		  }

  print("<CENTER><TABLE><TR><TD><CENTER><BR>
       <A HREF=send.php onclick=printpage() class=Link><B><KBD>SEND COURIER INVOICE</A><BR><BR>
  <TABLE>
  <TR>
	<TD><KBD><FONT SIZE=1>&nbsp;DUE DATE</TD>
	<TD><KBD><FONT SIZE=1>:</TD><TD><FONT SIZE=1><KBD>$dat</TD>
  </TR>
  <TR>
	<TD><KBD><FONT SIZE=1>SENDER'S NAME</TD>
	<TD><KBD><FONT SIZE=1>:</TD><TD><FONT SIZE=1><KBD>$N1</TD>
  </TR>
 <TR>
	<TD><KBD><FONT SIZE=1>SENDER'S LOCATION</TD>
	<TD><KBD><FONT SIZE=1>:</TD><TD><FONT SIZE=1><KBD>$N3</TD>
  </TR>
  <TR>
	<TD><KBD><FONT SIZE=1>COURIER TYPE</TD>
	<TD><KBD><FONT SIZE=1>:</TD><TD><FONT SIZE=1><KBD>$N11 &nbsp;$N4</TD>
  </TR>
  <TR>
  <TD><KBD><FONT SIZE=1>AMOUNT PAYED</TD>
  <TD><KBD><FONT SIZE=1>:</TD><TD><FONT SIZE=1><KBD>$N10&nbsp;Rwf<TD>
  </TR>
  <TR>
	<TD><KBD><FONT SIZE=1>RECEIVER'S NAME</TD>
	<TD><KBD><FONT SIZE=1>:</TD><TD><FONT SIZE=1><KBD>$N5</TD>
  </TR>
  <TR>
	<TD><KBD><FONT SIZE=1>RECEIVER'S LOCATION</TD>
	<TD><KBD><FONT SIZE=1>:</TD><TD><FONT SIZE=1><KBD>$N6</TD>
  </TR>
  <TR>
	<TD><KBD><FONT SIZE=1>DELIVERY TIME</TD>
	<TD><KBD><FONT SIZE=1>:</TD><TD><FONT SIZE=1><KBD>$N8</TD>
  </TR>
  <TR>
	<TD><KBD><FONT SIZE=1>&nbsp;COURIER NUMBER</TD>
	<TD><KBD><FONT SIZE=1>:</TD><TD><KBD>-VCE-$N00</TD>
  </TR>
  <TR>
  <TD COLSPAN=3><CENTER><KBD><FONT SIZE=1>OPERATOR : <KBD>$N9<TD>
  </TR></TABLE></TD>

  </TR></TABLE>");
	  }		  
		  }
	
else
		  {
			  include'menu.php';	
			  
			  print("<CENTER><TABLE WIDTH=90%><TR><TD><FIELDSET><CENTER><BR><BR><BR><BR><BR>
	          <BR><BR><BR><BR><FONT COLOR=#FF0000>Sorry, incorrect confirmation key! </FONT><BR><BR>
			  <A HREF=javascript:javascript:history.go(-1) class=MyLink>Please, click here to try again</A>
			  <BR><BR><BR><BR><BR><BR><BR><BR><BR></CENTER>
	          </FIELDSET></TD></TR></TABLE>
         <p class=copyright>&copy;COPY RIGHT <B>VIRUNGA EXPRESS</B>: ALL RIGHTS RESERVED</p>");
		  }	  
  ?>
 </BODY>
</HTML>
