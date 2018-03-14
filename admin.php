<html>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> 
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

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
                  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	            <label for='formtables[]'>Select the table you want to display:</label><br>
	            <select name="formtables[]">
                  <?php 
                        $sql = "SHOW TABLES FROM theitconnection";
                        $result = mysqli_query($db_connect, $sql);
                        while($row = mysqli_fetch_assoc($result))
                        {
                              $tables = $row['Tables_in_theitconnection'];
                              echo('<option value='.$tables.'>'.$tables.'</option>');
                        }

                  ?>
	            <input type="submit" name="formSubmit" value="Submit" >
                  </form>
	            </p>
                  <?php
                  if(isset($_POST['formSubmit']))
                  {
                        $table = $_POST['formtables'];
                        $table = $table[0];
                        {
                              // output data of each row
                              echo "<table>";
                              $sql = "SELECT * FROM $table";
                              $result = mysqli_query($db_connect, $sql);
                              $j=0;
                              while($row = $result->fetch_assoc()) 
                              {
                                    echo "<tr>";
                                    $i=0;
                                    $key = array();
                                    while (key($row))
                                    {
                                          $key[$i] = key($row);
                                          next($row);
                                          echo "<td>" . $key[$j] . "</td><td>" . $row[$key[$i]] . "</td>";
                                    }
                                    $j++;
                                    echo "</tr>";
                              }
                              echo "</table>";
                        }
                  }
                  else 
                  {
                        echo "0 results";
                  }
                        

	            ?>

                  <a href="logout.php">Logout</a> <?php
            }else 
            {
                  echo "Need to be logged in as an admin to see this page. Do you want to log in?";
                  ?> <a href="login.php"> Login </a> <?php
            }
      } 
      else echo "Couldn't connect to the database";
}
else echo "Database NOT Found";
?>
