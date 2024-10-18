<?php
date_default_timezone_set('Africa/Kigali');    
    $Date=date("Y-m-d");
	$Time=date("H:i:s");
    $server="localhost";
	// $user="zerzlete_courier_rwanda";
	$user="root";
	// $pass="Fz193mnIsY";
	$pass="";
	$db="zerzlete_courier";
	//$link=mysql_connect($server,$user,$pass)or die ("Connection Failed");
        //$condb=mysql_select_db($db,$link) or die ("connection to the data base failed");
         $conn = new mysqli($server,$user,$pass,$db);
 
// check connection
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}    
?>
