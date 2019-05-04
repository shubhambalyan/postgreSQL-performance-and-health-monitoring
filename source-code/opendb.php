<?php
//$page = $_SERVER['PHP_SELF'];
//$sec = "30";
?>

<!DOCTYPE html>
<html>
<head>
<title>PostgreSQL</title>
<!--meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'"-->
</head>
<body>
<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=test";
   $credentials = "user=postgres";

   $db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db){
      echo "Error : Unable to open database";
   } else {
      echo "Opened database successfully";
	  echo "<br />";
	  echo $db;
   }
   $result = pg_exec($db, "select * from events");
   $numrows = pg_numrows($result);
   echo "<br />";
   echo $numrows;
   
   
   echo "<br />";
   echo "<br />";
   $servername = "localhost";
   $username = "root";
   $password = "shubham";
   $dbname = "test";
// Create connection
   $conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
   echo "Connected successfully";
?>

  <table>
  <tr>
   <th>ID</th>
   <th>Event Key</th>
   <th>Publisher ID</th>
  </tr>  
  <?php
   for($ri = 0; $ri < $numrows; $ri++) {
    echo "<tr>";
    $row = pg_fetch_array($result, $ri);
    echo " <td>", $row["id"], "</td>
   <td>", $row["event_key"], "</td>
   <td>", $row["publisher_id"], "</td>
  </tr>";
   }
   pg_close($db);
  ?>
  </table>
</body>
</html>