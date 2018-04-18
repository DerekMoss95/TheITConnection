<?php
	require 'dbconnect.php';
    session_start();
?> 
				<form method="POST" action="dblogin.php">
								Username: <br><input type="text" required name="username"/><br>
								Password: <br><input type="password" required name="passwd"/><br>
							<input id ="button" type="submit" name="submit"/>
				</form>