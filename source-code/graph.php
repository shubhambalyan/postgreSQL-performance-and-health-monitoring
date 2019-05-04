<?php
pg_connect("host=127.0.0.1 port=5432 dbname=test user=postgres") or die('Could not connect: ' . pg_last_error());
    $q='SELECT "id", "league_id" FROM "seasons"';
	$query=pg_query($q);
	$n=pg_num_rows($query);					
?>		

<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['id', 'league_id'],
          <?php
		   for($i=0; $i<$n; $i++)
				{
				$f=pg_fetch_row($query);
				echo("['".$f[0]."', ".$f[1]."]");
                if ($i<$n-1)
                  echo (",");					
				}
			?>       
        ]);
        var options = {
          title: 'Seasons',
		  curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
		
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>