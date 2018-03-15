<?php
include 'dbconnect.php';
session_start();
$sql = "UPDATE admins SET loggedin = 0";
$db_connect->query($sql);
if ($db_connect)
{
	// $result2 = mysqli_query($db_handle, $sql) or die;
	session_destroy();
	header('location: login.php');
	exit;
}

?>