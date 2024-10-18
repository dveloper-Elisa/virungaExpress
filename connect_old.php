<?
    $Date=date("Y-m-d");
	$Time=date("H:i:s");
        $server="localhost";
	$user="virungae_virunga";
	$pass="berchmasgasore";
	$db="virungae_courier";
	$link=mysql_connect($server,$user,$pass)or die ("Connection Failed");
        $condb=mysql_select_db($db,$link) or die ("connection to the data base failed");
?>