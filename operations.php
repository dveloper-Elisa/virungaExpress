<?php
session_start();
if($_SESSION['name']==null or $_SESSION['passe']==null){
header('location: vce.php');
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>VIRUNGA EXPRESS-Reporting System</title>
<link rel="stylesheet" type="text/css" href="csspage.css" />
</head>
<body>
<div id="wrapper">
<div id="header">

<img style="float:left;margin-left:5px;margin-top:5px;" src="virungalogo.png" alt="" height=100px /> 

<h1>VIRUNGA EXPRESS</h1>
<h2>Reporting System</h2>
</div>
<div id="horizMenu">
<ul class="ullisthorizMenu">
<li><a href="operations.php">Home</a></li>
<li>|</li>
<li><a href="cardep.php">Car Departure</a></li>
<li>|</li>
<li><a href="expenses.php">Fuel</a></li>
<li>|</li>
<li><a href="greport.php">Report</a></li>
<li>|</li>
<li><a href="sreport.php">Stock</a></li>
<li>|</li>
<li><a href="settings.php">Settings</a></li>
<li>|</li>
<li><a href="distroysession.php">Log out</a>&nbsp;&nbsp;&nbsp;&nbsp;
<FONT COLOR="#66CC33"><?php
print("Welcome ".$_SESSION['name']);
?></FONT>&nbsp;&nbsp;</li>
</ul>
</div>

<div id="contents">

</div>
</div>
<p class="copyright">&copy; Copyright VIRUNGA EXPRESS: All rights reserved.</p>
</body>
</html>