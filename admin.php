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
                  ?>
                  <div class="Title">"Welcome, this is the admin page.</div><br><br>
                  <p> What table do you want to view?
	            <select name="table" id="table">
                  <?php 
                        //print_r($db_connect);
                        $sql = "SHOW TABLES FROM theitconnection";
                        $result = mysqli_query($db_connect, $sql);
                        while($row = mysqli_fetch_assoc($result))
                        {
                              $tables = $row['Tables_in_theitconnection'];
                              echo('<option value='.$tables.'>'.$tables.'</option>');
                              //mysqli_free_result($result);
                        }
                        //mysqli_close($result);
                  ?>
                  <!-- <option value="">Select...</option>
	            <option value="customers">Customers</option>
	            <option value="commercial">Commercial User Info</option>
                  <option value="mentor">Mentors</option>
	            <option value="student">Students</option>
	            <option value="languagesN">Languages Necessary</option>
	            <option value="softwareN">Software Necessary</option>
	            <option value="hardwareN">Hardware Necessary</option>
	            <option value="programmingP">Programming Projects</option>
	            <option value="softwareP">Software Projects</option>
	            <option value="hardwareP">Hardware Projects</option>-->
	            </select> 
	            </p>

                  <?php
                  	$table = "";
	                  if(isset($_POST['submit']) )
	                  {
	                        $table = $_POST['table'];
                        }
                        if ($table == "customers")
                        {
                              echo '<select name="table">';
                        }
	            ?>

                  <a href="logout.php">Logout</a> <?php
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
