<?php
	require 'dbconnect.php';
	session_start();

	//$loggedin = $_SESSION['loggedin'];

	if ($db_select)
	{
		if ($db_connect)
		{

			$username = $_POST['username']; 
			$passwd = $_POST['passwd']; 
			
			// To protect MySQL injection (more detail about MySQL injection)
			$passwd = sha1($_POST['passwd']);
			$username = stripslashes($username);
			$passwd = stripslashes($passwd);

			$stmt = $db_conn->prepare("SELECT * FROM admins WHERE adminUsername = ? AND passwordhash = ?");
			$stmt->bindValue(1, $username, PDO::PARAM_STR);
			$stmt->bindValue(2, $passwd, PDO::PARAM_STR);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_BOUND);

			//$stmt->execute(array('s' => $count));
			//$stmt->execute();
			//$stmt->close();
			//$db_connect->close();
			//echo $stmt;

			//echo $username;
			//echo $passwd;

			//$query = "SELECT * FROM admins WHERE adminUsername = '$username' AND passwordhash = '$passwd'" or die;
			//$result = mysqli_query($db_connect, $query);
			//$count = mysqli_num_rows($result);

			if($rows == true) 
			{ 
			session_start();
			$_SESSION['loggedin'] = 1;
			$sql = "UPDATE admins SET loggedin = 1 WHERE adminUsername = '$username'";
			mysqli_query($db_connect, $sql);
			echo "Successful login."; 
			header("location:admin.php");  // Redirect to the admin.php page
			exit();
			} 
			else
			{
				//echo $username;
				//echo $passwd;	
				echo "SORRY... YOU ENTERD WRONG USERNAME/PASSWORD... PLEASE RETRY...";
				?> <a href="login.php"> Login </a> <?php
			} 
		}
	}
	else echo "Database NOT Found";
?>
