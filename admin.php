<html>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> 

<?php
include 'dbconnect.php';
session_start();

      $loggedin = $_SESSION['loggedin'];

if ($db_select)
{
      if ($db_connect)
      {
            if ($loggedin)
            {
                  ?>
                  <div class="Title">Welcome, this is the admin page.</div>
                  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	            <label for='formtables[]'>Select the table you want to display:</label><br>
	            <select name="formtables[]"/>
                  <?php 
                        $sql = "SHOW TABLES FROM theitconnection";
                        $result = mysqli_query($db_connect, $sql);
                        while($row = mysqli_fetch_assoc($result))
                        {
                              $tables = $row['Tables_in_theitconnection'];
                              echo('<option value='.$tables.'>'.$tables.'</option>');
                        }

                  ?>
	            <input type="submit" name="formSubmit" value="Submit"/>
                  </form>
                  <?php
                  if(isset($_POST['formSubmit']))
                  {
                        $table = $_POST['formtables'];
                        $table = $table[0];
                        echo "<h1><u>".$table." Table</u></h1>";
                        {
                              echo "<table>";
                              $sql = "SELECT * FROM $table";
                              $result = mysqli_query($db_connect, $sql);
                              $j=0;
                              $i=0;
                              $k=0;
                              while($row = $result->fetch_assoc()) 
                              {
                                    $key = array();
                                    while (key($row))
                                    {
                                          $key[$j] = key($row);
                                          echo "<th>" . $key[$j] . "  </th>";
                                          next($row);
                                          $k++;
                                          $j++;
                                    }
                                    echo "<tr>";
                                    while ($i < $j)
                                    {
                                          echo "<td>" . $row[$key[$i]] . "</td>";
                                          $i++;
                                    }
                                    echo "</tr>";
                              }
                              echo "</table><br>";
                        }
                  }     

	            ?>

                  <form method="post">
	            <label for='formaddtables[]'><b>Select the table you want to insert to:</b></label><br>
	            <select name="formaddtables[]">
                  <?php 
                        $sql = "SHOW TABLES FROM theitconnection";
                        $result = mysqli_query($db_connect, $sql);
                        while($row = mysqli_fetch_assoc($result))
                        {
                              $tables = $row['Tables_in_theitconnection'];
                              echo('<option value='.$tables.'>'.$tables.'</option>');
                        }
                  ?>
	            <input type="submit" name="form2Submit" value="Submit" >
                  </form>
                  </p>
                  <table>
                  <?php

                  if(isset($_POST['form2Submit']))
                  {
                        $table = $_POST['formaddtables'];
                        $table = $table[0];
                        echo "<h3><u>Populate the following fileds to insert to the ".$table." table.</u></h3>";
                        
                        $sql = "SELECT * FROM $table";
                        $result = mysqli_query($db_connect, $sql);
                        $a=0;
                        $b=0;
                        $c=0;
                        $d=0;
                        $e=0;
                        $input = array();
                        $key = array();
                        $row = $result->fetch_assoc();
                        
                              while (key($row))
                              {
                                    $key[$a] = key($row);
                                    next($row);
                                    $a++;
                              }
                  
                  
                         ?>
                        <form method="post" action="insert.php">
                        <label for='form2submit'></label><br>
                        <?php 
                        echo "<tr>";
                        $column = array();
                        while ($b < $a)
                        {
                              if ($key[$b] == "adminID" || $key[$b] == "customerID" || $key[$b] == "loggedin")
                              {
                                    $b++;
                              }
                              else
                              {
                                    $column[$c] = $key[$b];
                                    echo "<th>" . $column[$c] . "  </th>";
                                    if ($column[$c] == "passwordhash")
                                    {
                                          $inputtype = "password";
                                    }
                                    else
                                    {
                                          $inputtype = "text";
                                    }
                                    
                                    ?>
                                    <td><input type="<?php echo $inputtype; ?>" name="<?php echo $column[$c]; ?>"/></td>
                              <?php 
                              $b++;
                              $c++;
                              echo "<tr>";
                              }
                        }
                        ?>
                        </table>
                        <br>
                        <input id="form2Submit" type="submit" name="form2submit" value="<?php echo 'Submit new entry to '.$table.' table?'; ?>"></input> 
                       
                        </form>
                  <?php } ?>
                  <br>
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
?>
