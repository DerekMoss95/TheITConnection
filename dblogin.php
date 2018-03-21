<?php
	require 'dbconnect.php';
	session_start();

	if ($db_select)
	{
		if ($db_connect)
		{

			$username = $_POST['username']; 
			$passwd = $_POST['passwd']; 
			
			$passwd = sha1($_POST['passwd']);
			$username = stripslashes($username);
			$passwd = stripslashes($passwd);

			$stmt = $db_conn->prepare("SELECT * FROM admins WHERE adminUsername = ? AND passwordhash = ?");
			$stmt->bindValue(1, $username, PDO::PARAM_STR);
			$stmt->bindValue(2, $passwd, PDO::PARAM_STR);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_BOUND);

			if($rows == true) 
			{ 
			session_start();
			$_SESSION['loggedin'] = 1;
			$sql = "UPDATE admins SET loggedin = 1 WHERE adminUsername = '$username'";
			mysqli_query($db_connect, $sql);
			echo "Successful login."; 
			header("location:admin.php"); 
			exit();
			} 
			else
			{
				echo "SORRY... YOU ENTERD WRONG USERNAME/PASSWORD... PLEASE RETRY...";
				?> <a href="login.php"> Login </a> <?php
			} 
		}
	}
	else echo "Database NOT Found";
?>
