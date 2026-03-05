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
($con = mysqli_connect($dbserver, $dbusername, $dbpassword))  or die(mysqli_error($con));
mysqli_select_db($con, $dbname) or die  (mysqli_error($con));
?>