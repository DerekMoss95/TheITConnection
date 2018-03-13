<?php
include 'dbconnect.php';
session_start();

      //$username = $_SESSION['username'];
      $loggedin = $_SESSION['loggedin'];

if ($db_select)
{
      if ($db_connect)
      {
            if ($loggedin)
            {
                  echo("Welcome, this is the admin page.");
                  ?> <a href="logout.php">Logout</a> <?php
            }
            else 
            {
                  echo "Need to be logged in as an admin to see this page. Do you want to log in?";
                  ?> <a href="login.php"> Login </a> <?php
            }
      } 
      else echo "Couldn't connect to the database";
}
else echo "Database NOT Found";
//header('location: admin.php');
?>
