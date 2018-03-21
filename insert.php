<?php
	require 'dbconnect.php';
	session_start();

	if ($db_select)
	{
		if ($db_connect)
		{
            if (isset($_POST['adminUsername']))
            {
                $adminusername = $_POST['adminUsername'];
            }

            if (isset($_POST['firstName']))
            {
                $firstname = $_POST['firstName'];
            }

            if (isset($_POST['lastName']))
            {
                $lastname = $_POST['lastName'];
            }

            if (isset($_POST['email']))
            {
                $email = $_POST['email'];
            }

            if (isset($_POST['phonenum']))
            {
                $phonenum = $_POST['phonenum'];
            }

            if (isset($_POST['passwordhash']))
            {
                $password = sha1($_POST['passwordhash']);
            }

            if ($_POST['form2submit'] == "admins")
            {
                $sql = "INSERT INTO admins (adminUsername, firstName, lastName, email, passwordhash, loggedin) VALUES ('$adminusername', '$firstname', '$lastname', '$email', '$password', 0)";
                $db_connect->query($sql);
                $db_connect->close();
            }
            else if ($_POST['form2submit'] == "customers")
            {
                $sql = "INSERT INTO customers (firstName, lastName, email, phonenum, passwordhash) VALUES ('$firstname', '$lastname', '$email', '$phonenum', '$password')";
                $db_connect->query($sql);
                $db_connect->close(); 
            }            

            header('location: admin.php');
		}
    }

?>