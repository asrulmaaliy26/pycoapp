<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$dbserver="localhost";
$dbusername="db_apps-psi";
$dbpassword="A%sJTgw6lm9&8wtv";
$dbname="db_apps-psi";
error_reporting(E_ALL ^ E_DEPRECATED);
($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver, $dbusername, $dbpassword))  or die(mysqli_error($GLOBALS["___mysqli_ston"]));
mysqli_select_db($GLOBALS["___mysqli_ston"], $dbname) or die  (mysqli_error($GLOBALS["___mysqli_ston"]));

if(!isset($_SESSION['username'])) {
    header("location:admin.php");
}
if($_SESSION['status']!="1"){
    header("location:admin.php");
}
?>