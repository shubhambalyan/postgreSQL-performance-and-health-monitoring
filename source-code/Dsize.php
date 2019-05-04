<?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>

<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=test";
   $credentials = "user=postgres";
   $db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db){
      echo "Error : Unable to open database";
   }
   $result = pg_exec($db, "select pg_database_size('test')");
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
   $sql = mysqli_query($conn,"INSERT INTO dsize (datasize) values ('$data')"); 
   $q='SELECT time, datasize FROM dsize';
   $query=mysqli_query($conn,$q);
   $n=mysqli_num_rows($query); 
   mysqli_close($conn);   
?>

<!DOCTYPE html>
<html>
<head>
<title>PostgreSQL</title>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<link rel="stylesheet" type="text/css" href="headstyle.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0">
<title>PostgreSQL</title>
<link rel="stylesheet" href="style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['time', 'datasize'],
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
          title: 'Database Size',
		  curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('response_chart'));
        chart.draw(data, options);
		
      }
    </script>
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
<br />
<div  id="response_chart" style="width: 900px; height: 500px;" ></div> 
<div id="footer" align="center">PostgreSQL Performance and Health Monitoring</div>
</body>
</html>