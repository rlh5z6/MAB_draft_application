<html>
    <header>
        <h2>Trip Analytics</h2>
    </header>
    <hr>

 
    
  <head>
    

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      
    function drawChart() {
        
        var state_data = google.visualization.arrayToDataTable([
            ['States', 'Number of Trips'],
            <?php
                $i = 1;
                foreach($data['states'] as $trip_info){
                    echo "['".$trip_info->region."',";
                    echo $trip_info->num_of_trips."]";
                    if($i < count($data['states'])){
                        echo",";
                    }
                    $i++;
                }
            ?>
        ]);
       
        
        var trip_data = google.visualization.arrayToDataTable([
            ['Issues', 'Number of Trips'],
            <?php
                $i = 1;
                foreach($data['trips'] as $trip_info){
                    echo "['".addslashes($trip_info->issueName)."',";
                    echo $trip_info->num_of_trips."]";
                    if($i < count($data['trips'])){
                        echo",";
                    }
                    $i++;
                }
            ?>
        ]);
    
        var trip_options = {
          title: 'Trip Breakdown by Issue'
        };
        
        var state_options = {
          title: 'Trip Breakdown by State'
        };
        
        
        

        var trip_chart = new google.visualization.PieChart(document.getElementById('piechart1'));
        trip_chart.draw(trip_data, trip_options);
        
        var states_chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        states_chart.draw(state_data, state_options);
    }
      
        
       

</script>
  
</head>
  <body>
    <div class="row">
        <div class="col-md-4 col-md-offset-2" id="piechart1" style="width: 900px; height: 500px;"></div>
    </div>
    <div class="row">
    
        <div class="col-md-4 col-md-offset-2" id="piechart2" style="width: 900px; height: 500px;"></div>
        
      
    </div> 
  </body>

</html>