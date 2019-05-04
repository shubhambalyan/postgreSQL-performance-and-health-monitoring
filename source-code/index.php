<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="headstyle.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0">
<title>PostgreSQL</title>
<link rel="stylesheet" href="style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
</head>
<body ontouchstart="">
<div id="header" align="center">
  <a id="logo">Postgresql</a>
</div>
<br />
<br />
<br />
<div align="center">
<input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">
<ul id="css3menu1" class="topmenu">
	<li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
	<li class="topfirst"><a href="#" style="height:24px;line-height:24px;"><span><img src="green-samples-32.png" alt=""/>Performance Indicators</span></a>
	<ul>
		<li><a href="Response.php">Response Time</a></li>
		<li><a href="Activeserver.php">Active Server Processes</a></li>
		<li><a href="Tcommit.php">Committed Transactions</a></li>
		<li><a href="Chit.php">Cache Hits</a></li>
	</ul></li>
	<li class="toplast"><a href="#" style="height:24px;line-height:24px;"><span><img src="blue-samples-32.png" alt=""/>Health Indicators</span></a>
	<ul>
		<li><a href="Locks.php">Lock Statistics</a></li>
		<li><a href="Tfetch.php">Tuples Fetched</a></li>
		<li><a href="Indexing.php">Indexing Status</a></li>
		<li><a href="Dsize.php">Database Size</a></li>
	</ul></li>
</ul>
</div>
<br />
<br />
<div align="center">
<table >
<tr>
<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=test";
   $credentials = "user=postgres";
   $db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db){
      echo "Error : Unable to open database";
   }
   $result = pg_exec($db, "select total_time from pg_stat_statements where dbid=18293 order by random() limit 1");
   $numrows = pg_numrows($result);
   $row=pg_fetch_array($result);   
   
   $servername = "localhost";
   $username = "root";
   $password = "shubham";
   $dbname = "test";
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
   $data = $row[0];
   $sql = mysqli_query($conn,"INSERT INTO response (response_time) values ('$data')"); 
   $q='SELECT time, response_time FROM response';
   $query=mysqli_query($conn,$q);
   $n=mysqli_num_rows($query); 
   mysqli_close($conn);   
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="headstyle.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0">
<link rel="stylesheet" href="style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>google.charts.load('current', {'packages':['corechart']});</script>
    <script type="text/javascript">
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['time', 'response_time'],
          <?php
		   for($i=0; $i<$n; $i++)
				{
				$f=mysqli_fetch_row($query);
				echo("['".$f[0]."', ".$f[1]."]");
                if ($i<$n-1)
                  echo (",");					
				}
			?>       
        ]);
        var options = {
          title: 'Response Time',
		  curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('response_chart'));
        chart.draw(data, options);
		
      }
    </script>
</head>
<body ontouchstart="">
<br />
<br />
<div  style = "margin-left:100px;" id="response_chart" style="width: 450px; height: 250px;" ></div>
</body>
</html>
</tr><tr>


<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=test";
   $credentials = "user=postgres";
   $db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db){
      echo "Error : Unable to open database";
   }
   $result = pg_exec($db, "select * from pg_stat_get_db_numbackends(18293)");
   $numrows = pg_numrows($result);
   $row=pg_fetch_array($result);   
   
   $servername = "localhost";
   $username = "root";
   $password = "shubham";
   $dbname = "test";
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
   $data = $row[0];
   $sql = mysqli_query($conn,"INSERT INTO activeserver (process) values ('$data')"); 
   $q='SELECT time, process FROM activeserver';
   $query=mysqli_query($conn,$q);
   $n=mysqli_num_rows($query); 
   mysqli_close($conn);   
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="headstyle.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0">

<link rel="stylesheet" href="style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>

    <script type="text/javascript">
    
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['time', 'process'],
          <?php
		   for($i=0; $i<$n; $i++)
				{
				$f=mysqli_fetch_row($query);
				echo("['".$f[0]."', ".$f[1]."]");
                if ($i<$n-1)
                  echo (",");					
				}
			?>       
        ]);
        var options = {
          title: 'Active Server Processes',
		  curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('response_cha'));
        chart.draw(data, options);
		
      }
    </script>
</head>
<body ontouchstart="">
<br />
<br />
<div  style = "margin-left:100px;" id="response_cha" style="width: 450px; height: 250px;" ></div> 

</body>
</html>
</tr>
<tr>


<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=test";
   $credentials = "user=postgres";
   $db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db){
      echo "Error : Unable to open database";
   }
   $result = pg_exec($db, "select * from pg_stat_get_db_xact_commit(18293)");
   $numrows = pg_numrows($result);
   $row=pg_fetch_array($result);   
   
   $servername = "localhost";
   $username = "root";
   $password = "shubham";
   $dbname = "test";
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
   $data = $row[0];
   $sql = mysqli_query($conn,"INSERT INTO tcommit (commit) values ('$data')"); 
   $q='SELECT time, commit FROM tcommit';
   $query=mysqli_query($conn,$q);
   $n=mysqli_num_rows($query); 
   mysqli_close($conn);   
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="headstyle.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0">

<link rel="stylesheet" href="style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>

    <script type="text/javascript">
      
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['time', 'commit'],
          <?php
		   for($i=0; $i<$n; $i++)
				{
				$f=mysqli_fetch_row($query);
				echo("['".$f[0]."', ".$f[1]."]");
                if ($i<$n-1)
                  echo (",");					
				}
			?>       
        ]);
        var options = {
          title: 'Committed Transactions',
		  curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('response_ch'));
        chart.draw(data, options);
		
      }
    </script>
</head>
<body ontouchstart="">
<br />
<div  style = "margin-left:100px;"  id="response_ch" style="width: 450px; height: 250px;" ></div> 
</body>
</html>
</tr>
<tr>


<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=test";
   $credentials = "user=postgres";
   $db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db){
      echo "Error : Unable to open database";
   }
   $result = pg_exec($db, "select * from pg_stat_get_db_blocks_hit(18293)");
   $numrows = pg_numrows($result);
   $row=pg_fetch_array($result);   
   
   $servername = "localhost";
   $username = "root";
   $password = "shubham";
   $dbname = "test";
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
   $data = $row[0];
   $sql = mysqli_query($conn,"INSERT INTO cachehit (hit) values ('$data')"); 
   $q='SELECT time, hit FROM cachehit';
   $query=mysqli_query($conn,$q);
   $n=mysqli_num_rows($query); 
   mysqli_close($conn);   
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="headstyle.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0">

<link rel="stylesheet" href="style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>

    <script type="text/javascript">
      
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['time', 'hit'],
          <?php
		   for($i=0; $i<$n; $i++)
				{
				$f=mysqli_fetch_row($query);
				echo("['".$f[0]."', ".$f[1]."]");
                if ($i<$n-1)
                  echo (",");					
				}
			?>       
        ]);
        var options = {
          title: 'Cache Hits',
		  curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('response_c'));
        chart.draw(data, options);
		
      }
    </script>
</head>
<body ontouchstart="">
<br />
<div  style = "margin-left:100px;" id="response_c" style="width: 450px; height: 250px;" ></div> 

</body>
</html>
</tr>
<tr>


<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=test";
   $credentials = "user=postgres";
   $db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db){
      echo "Error : Unable to open database";
   }
   $result = pg_exec($db, "select * from pg_stat_get_db_conflict_lock(18293)");
   $numrows = pg_numrows($result);
   $row=pg_fetch_array($result);   
   
   $servername = "localhost";
   $username = "root";
   $password = "shubham";
   $dbname = "test";
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
   $data = $row[0];
   $sql = mysqli_query($conn,"INSERT INTO locks (nolock) values ('$data')"); 
   $q='SELECT time, nolock FROM locks';
   $query=mysqli_query($conn,$q);
   $n=mysqli_num_rows($query); 
   mysqli_close($conn);   
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="headstyle.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0">
<link rel="stylesheet" href="style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
    <script type="text/javascript">
      
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['time', 'nolock'],
          <?php
		   for($i=0; $i<$n; $i++)
				{
				$f=mysqli_fetch_row($query);
				echo("['".$f[0]."', ".$f[1]."]");
                if ($i<$n-1)
                  echo (",");					
				}
			?>       
        ]);
        var options = {
          title: 'Lock Statistics',
		  curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('response_char'));
        chart.draw(data, options);
		
      }
    </script>
</head>
<body ontouchstart="">
<br />
<div  style = "margin-left:100px;" id="response_char" style="width: 450px; height: 250px;" ></div> 
</body>
</html>
</tr>

<tr>

<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=test";
   $credentials = "user=postgres";
   $db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db){
      echo "Error : Unable to open database";
   }
   $result = pg_exec($db, "select tup_fetched from pg_stat_database where datid=18293");
   $numrows = pg_numrows($result);
   $row=pg_fetch_array($result);   
   
   $servername = "localhost";
   $username = "root";
   $password = "shubham";
   $dbname = "test";
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
   $data = $row[0];
   $sql = mysqli_query($conn,"INSERT INTO tfetch (tfetched) values ('$data')"); 
   $q='SELECT time, tfetched FROM tfetch';
   $query=mysqli_query($conn,$q);
   $n=mysqli_num_rows($query); 
   mysqli_close($conn);   
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="headstyle.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0">

<link rel="stylesheet" href="style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>

    <script type="text/javascript">
    
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['time', 'tfetched'],
          <?php
		   for($i=0; $i<$n; $i++)
				{
				$f=mysqli_fetch_row($query);
				echo("['".$f[0]."', ".$f[1]."]");
                if ($i<$n-1)
                  echo (",");					
				}
			?>       
        ]);
        var options = {
          title: 'Tuples Fetched',
		  curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('response_'));
        chart.draw(data, options);
		
      }
    </script>
</head>
<body ontouchstart="">
<br />
<div style = "margin-left:100px;"  id="response_" style="width: 450px; height: 250px;" ></div> 

</body>
</html>
</tr>
<tr>


<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=test";
   $credentials = "user=postgres";
   $db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db){
      echo "Error : Unable to open database";
   }
   $result = pg_exec($db, "select seq_scan+idx_scan from pg_stat_all_tables where relid = 18634");
   $numrows = pg_numrows($result);
   $row=pg_fetch_array($result);   
   
   $servername = "localhost";
   $username = "root";
   $password = "shubham";
   $dbname = "test";
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
   $data = $row[0];
   $sql = mysqli_query($conn,"INSERT INTO indexing (indexes) values ('$data')"); 
   $q='SELECT time, indexes FROM indexing';
   $query=mysqli_query($conn,$q);
   $n=mysqli_num_rows($query); 
   mysqli_close($conn);   
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="headstyle.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0">

<link rel="stylesheet" href="style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>

    <script type="text/javascript">
      
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['time', 'indexes'],
          <?php
		   for($i=0; $i<$n; $i++)
				{
				$f=mysqli_fetch_row($query);
				echo("['".$f[0]."', ".$f[1]."]");
                if ($i<$n-1)
                  echo (",");					
				}
			?>       
        ]);
        var options = {
          title: 'Indexing Status',
		  curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('respons'));
        chart.draw(data, options);
		
      }
    </script>
</head>
<body ontouchstart="">
<br />
<div  style = "margin-left:100px;" id="respons" style="width: 450px; height: 250px;" ></div> 

</body>
</html>
</tr>

</table>
</div>
</body>
</html>
	