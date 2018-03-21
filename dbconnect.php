<?php
 
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

$hostname = 'localhost';
$dbname = 'theitconnection';
$Username = 'theitconnectionadmin';
$Password = 'it350giboney';
$customers = 'customers';
$admins = 'admins';

$db_conn = new PDO('mysql:host=localhost;dbname=theitconnection', 'theitconnectionadmin', 'it350giboney');
$db_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db_connect = mysqli_connect($hostname, $Username, $Password, $dbname) or die("Failed to connect to Database.");
$db_select = mysqli_select_db($db_connect, $dbname) or die("Failed to select the Database.");

?>