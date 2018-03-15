<html>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> 
<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->

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
                        echo "<h1><u>".$table." Table</u></h1>";
                        {
                              // output data of each row
                              echo "<table>";
                              $sql = "SELECT * FROM $table";
                              $result = mysqli_query($db_connect, $sql);
                              $j=0;
                              $i=0;
                              $k=0;
                              while($row = $result->fetch_assoc()) 
                              {
                                    //echo "<tr>";
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
                                    echo "<br>";
                              }
                              echo "</table>";
                        }
                  }
                  else 
                  {
                        
                  }
                        

	            ?>


                  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	            <label for='formaddtables[]'>Select the table you want to insert to:</label><br>
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
                        echo "<h1><u>".$table." Table</u></h1>";
                        
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
                        <form method="post">
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
                                    else if ($column[$c] == "phonenum")
                                    {
                                          $inputtype = "number";
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
                              }
                              echo $a;
                              echo $b;
                              echo $c;
                              echo $d;
                        }
                        $key1 = $column[$d];
                        $key2 = $column[$d+1];
                        $key3 = $column[$d+2];
                        $key4 = $column[$d+3];
                        $key5 = $column[$d+4];

                        echo $_POST[$column[$d]];
                        $val1 = $_POST[$column[$d]];
                        $val2 = $_POST[$column[$d+1]];
                        $val3 = $_POST[$column[$d+2]];
                        $val4 = $_POST[$column[$d+3]];
                        $val5 = $_POST[$column[$d+4]];
                         
                         ?>
                        <?php echo "</tr>"; echo "hello";?>
                        </table>
                  <?php 
                  
                              //$sql = "INSERT INTO customers (firstName, lastName, email, phonenum, passwordhash) VALUES ('$b', 'qwdqw', 'wevwe', '2345', 'askuhuishc')"; 
                              //$db_connect->query($sql);
                        if (isset($_POST['form2submit']))
                        {

                              if ($val1 == "passwordhash" || $val2 == "passwordhash" || $val3 == "passwordhash" || $val4 == "passwordhash" || $val5 == "passwordhash")
                              {
                                    echo "is password";
                              }

                              $sql = "INSERT INTO $table ($key1, $key2, $key3, $key4, $key5) VALUES ('$val1', '$val2', '$val3', '$val4', '$val5')"; 
                              $db_connect->query($sql);

                        
                        } 
                        }?>
                        <input id="submit" type="submit" name="form2submit" value="Submit">save</input> 
                       
                        </form>
                  <?php
                  
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
?>
