<?php
include 'dbconnect.php';
session_start();
$sql = "UPDATE admins SET loggedin = 0";
$db_connect->query($sql);
if ($db_connect)
{
	session_destroy();
	header('location: login.php');
	exit;
}

?>