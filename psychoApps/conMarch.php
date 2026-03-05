<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$dbserver="localhost";
$dbusername="root";
$dbpassword="";
$dbname="psikologi";
error_reporting(E_ALL ^ E_DEPRECATED);
($con = mysqli_connect($dbserver, $dbusername, $dbpassword))  or die(mysqli_error($con));
mysqli_select_db($con, $dbname) or die  (mysqli_error($con));

if(!isset($_SESSION['id'])) {
    header("location:../index.php");
}
if($_SESSION['status']!="1"){
    header("location:../index.php");
}
?>