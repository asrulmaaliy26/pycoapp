<?php
$dbserver="localhost";
$dbusername="root";
$dbpassword="";
$dbname="psikologi";
($con = mysqli_connect($dbserver, $dbusername, $dbpassword))  or die(mysqli_error($con));
mysqli_select_db($con, $dbname) or die  (mysqli_error($con));
?>