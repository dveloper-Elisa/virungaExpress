<?
if(isset($_POST['submit']))
	{
    $sloc=$_POST['sloc'];
    $passwo=$_POST['passwo'];
	$Date=date("Y-m-d");
    $server="localhost";
	$user="virungae_virunga";
	$pass="berchmasgasore";
	$db="virungae_courier";
	$link=mysql_connect($server,$user,$pass)or die ("Connection Failed");
	$condb=mysql_select_db($db,$link) or die ("connection to the data base failed");
  if($sloc=='ADMIN')
		{
		$nql=mysql_query("SELECT *FROM users WHERE Location='$sloc' AND Passwo='$passwo'");	
		$num=mysql_num_rows($nql);
		if($num)
                {
			$result=mysql_fetch_assoc($nql);
			{
				$name=$result[Lname];
                                $passe=$result[Passwo];
								        $loca=$result[Location];
										if($loca=='ADMIN')
											$loca='KIGALI';
			}
			session_start();{
                        $_SESSION['name']=$name;
                        $_SESSION['passe']=$passe;
						$_SESSION['local']=$loca;
                        }
                        Header("location:greport.php");
		}
		else
			Header("location:logini.php");
		}
  else
		{
        $nql=mysql_query("SELECT *FROM users WHERE Location='$sloc' AND Passwo='$passwo'");	
        $num=mysql_num_rows($nql);
        if($num)
        {
			$result=mysql_fetch_assoc($nql);
			{
				$name=$result[Lname];
				$passe=$result[Passwo];
			}
			session_start();{
                        $_SESSION['name']=$name;
                        $_SESSION['passe']=$passe;
                        }
                        Header("location:greport.php");
         }
	    else
		Header("location:logini.php");
		}
	 }
?>
<link rel="stylesheet" type="text/css" href="csspage.css" />
<script language="JavaScript" type="text/javascript">

var win = null;
function newWindow(mypage,myname,w,h,features) {
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  var settings = 'height=' + h + ',';
  settings += 'width=' + w + ',';
  settings += 'top=' + wint + ',';
  settings += 'left=' + winl + ',';
  settings += features;
  win = window.open(mypage,myname,settings);
  win.window.focus();
}

function NoConfirm ()
{
win = top;
win.opener = top;
setTimeout("self.close()", 10000);
}
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
<li><a href="vce.php">Log in</a></li>
<li>|</li>
<li><a href="help.html">Help</a></li>
</ul>
</div>

<div id="contents">
<div id="login">
<FORM NAME="form1" METHOD="POST" ACTION="login.php">
<center><h3>Login Form</h3>
<table>
<tr><td>Username&nbsp;&nbsp;</td><TD>:&nbsp;&nbsp;<SELECT NAME="sloc">
	<OPTION VALUE="" SELECTED>&nbsp;&nbsp; Select Location &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?
   include'connect.php';
  $nq=mysql_query("SELECT Location FROM users ORDER BY Location ASC");
  while($rw=mysql_fetch_assoc($nq))
  {
  $L1=$rw[Location];
  if($L1!=$C)
  print("<OPTION VALUE='$L1'>$L1");
  $C=$L1;
  }
  print("</SELECT>");
  
  ?><FONT SIZE="" COLOR="#CC0000">*</FONT></TD></tr>
<tr><td>Password</td><td>:&nbsp;&nbsp;<input type="password" name="passwo" title="Enter Password" /></td></tr>
<tr><th colspan="2"><br /><input type="submit" name="submit" value="LOGIN" onclick="pasuser(this.form1)" title="Click here to Login" /> 
<input type="reset" value="RESET" title="Click here to Reset" /> </th></tr>
</table>
</form>
</div>
</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>