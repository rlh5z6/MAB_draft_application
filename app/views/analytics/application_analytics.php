<html>
    <header>
        <h2>Application Analytics</h2>
    </header>
    <hr>

 
    
  <head>
    

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      
    function drawChart() {
        
        
        
        var gender_data = google.visualization.arrayToDataTable([
            ['Gender', 'Number of Applicants'],
            <?php
                $i = 1;
                foreach($data['gender'] as $gender_info){
                    echo "['".$gender_info->gender."',";
                    echo $gender_info->num_of_applicants."]";
                    if($i < count($data['gender'])){
                        echo",";
                    }
                    $i++;
                }
            ?>
        ]);
        
        var school_year_data = google.visualization.arrayToDataTable([
            ['Year In School', 'Number of Applicants'],
            <?php
                $i = 1;
                foreach($data['yearsInSchool'] as $app_info){
                    echo "['".$app_info->schoolYear."',";
                    echo $app_info->num_of_applicants."]";
                    if($i < count($data['yearsInSchool'])){
                        echo",";
                    }
                    $i++;
                }
            ?>
        ]);
        
        var apps_issues_data = google.visualization.arrayToDataTable([
            ['Issue', 'Number of Applicants'],
            <?php
                $i = 1;
                foreach($data['apps'] as $apps_info){
                    echo "['".addslashes($apps_info->issueName)."',";
                    echo $apps_info->num_of_applications."]";
                    if($i < count($data['apps'])){
                        echo",";
                    }
                    $i++;
                }
            ?>
        ]);
       
        var apps_issues_data1 = google.visualization.arrayToDataTable([
            ['Issue', 'Number of Applicants'],
            <?php
                $i = 1;
                foreach($data['apps1'] as $apps_info){
                    echo "['".addslashes($apps_info->issueName)."',";
                    echo $apps_info->num_of_applications."]";
                    if($i < count($data['apps1'])){
                        echo",";
                    }
                    $i++;
                }
            ?>
        ]);
        
        var apps_issues_data2 = google.visualization.arrayToDataTable([
            ['Issue', 'Number of Applicants'],
            <?php
                $i = 1;
                foreach($data['apps2'] as $apps_info){
                    echo "['".addslashes($apps_info->issueName)."',";
                    echo $apps_info->num_of_applications."]";
                    if($i < count($data['apps2'])){
                        echo",";
                    }
                    $i++;
                }
            ?>
        ]);
        
        var apps_issues_data3 = google.visualization.arrayToDataTable([
            ['Issue', 'Number of Applicants'],
            <?php
                $i = 1;
                foreach($data['apps3'] as $apps_info){
                    echo "['".addslashes($apps_info->issueName)."',";
                    echo $apps_info->num_of_applications."]";
                    if($i < count($data['apps3'])){
                        echo",";
                    }
                    $i++;
                }
            ?>
        ]);
        
       var apps_by_college = google.visualization.arrayToDataTable([
            ['College', 'Number of Applicants'],
            <?php
                $i = 1;
                foreach($data['apps_by_college'] as $apps_info){
                    echo "['".addslashes($apps_info->collegeName)."',";
                    echo $apps_info->num_of_applications."]";
                    if($i < count($data['apps_by_college'])){
                        echo",";
                    }
                    $i++;
                }
            ?>
        ]);
        
        var marketing_data = google.visualization.arrayToDataTable([
            ['Method of Marketing', 'Number of Applicants'],
            <?php
                $i = 1;
                foreach($data['marketing_data'] as $apps_info){
                    echo "['".addslashes($apps_info->answer)."',";
                    echo $apps_info->num_of_applications."]";
                    if($i < count($data['marketing_data'])){
                        echo",";
                    }
                    $i++;
                }
            ?>
        ]);

    
        
        var gender_options = {
          title: 'Applications by Gender'
        };
        
        var school_year_options = {
          title: 'Applications by Year in School'
        };
        
        var issue_options = {
          title: 'Applications by Issues Preffed - Overall'
        };
        
        var issue_options1 = {
          title: 'Applications by Issues Preffed - First'
        };
        var issue_options2 = {
          title: 'Applications by Issues Preffed - Second'
        };
        var issue_options3 = {
          title: 'Applications by Issues Preffed - Third'
        };
        
        var colleges_options = {
          title: 'Applications by Colleges'
        };
        
        var marketing_options = {
          title: 'Applications by How They Heard About MAB'
        };
        
         

       
        var gender_chart = new google.visualization.PieChart(document.getElementById('piechart1'));
        gender_chart.draw(gender_data, gender_options);
     
        var school_year_chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        school_year_chart.draw(school_year_data, school_year_options);
    
        var apps_by_issue_chart = new google.visualization.PieChart(document.getElementById('piechart3'));
        apps_by_issue_chart.draw(apps_issues_data, issue_options);
     
        var apps_by_issue_chart1 = new google.visualization.PieChart(document.getElementById('piechart4'));
        apps_by_issue_chart1.draw(apps_issues_data1, issue_options1);
        
        var apps_by_issue_chart2 = new google.visualization.PieChart(document.getElementById('piechart5'));
        apps_by_issue_chart2.draw(apps_issues_data2, issue_options2);
        
        var apps_by_issue_chart3 = new google.visualization.PieChart(document.getElementById('piechart6'));
        apps_by_issue_chart3.draw(apps_issues_data3, issue_options3);
        
        var apps_by_college_chart = new google.visualization.PieChart(document.getElementById('piechart7'));
        apps_by_college_chart.draw(apps_by_college, colleges_options);
        
        var apps_by_marketing = new google.visualization.PieChart(document.getElementById('piechart9'));
        apps_by_marketing.draw(marketing_data, marketing_options);
        
        <?php if (isset($_POST['submit'])) { ?>
                
            var issues_by_gender = google.visualization.arrayToDataTable([
                ['Gender', 'Number of Applicants'],
                <?php
                    $i = 1;
                    foreach($data['issues_by_gender'] as $apps_info){
                        echo "['".addslashes($apps_info->gender)."',";
                        echo $apps_info->num_of_applications."]";
                        if($i < count($data['issues_by_gender'])){
                            echo",";
                        }
                        $i++;
                    }
                ?>
            ]);
            
            var issues_by_gender_options = {
                
                <?php echo 'title: "Applications by Gender - '.$data['issues_by_gender'][0]->issueName.'"'; ?>
                
                    
            };
            
            var issue_by_gender_chart = new google.visualization.PieChart(document.getElementById('piechart8'));
            issue_by_gender_chart.draw(issues_by_gender, issues_by_gender_options);
        <?php } ?>
    }

</script>

</head>

    <body>

    <div class="row">
        <div class="col-md-3" id="piechart1" style="width: 470px; height: 280px;"></div>
        <div class="col-md-3" id="piechart2" style="width: 470px; height: 280px;"></div>
        <div class="col-md-3" id="piechart7" style="width: 470px; height: 280px;"></div>
    </div>
    <div class="row">
      
        <div class="col-md-3" id="piechart3" style="width: 650px; height: 350px;"></div>
        <div class="col-md-3" id="piechart4" style="width: 650px; height: 350px;"></div>
        <div class="col-md-3" id="piechart5" style="width: 650px; height: 350px;"></div>
        <div class="col-md-3" id="piechart6" style="width: 650px; height: 350px;"></div

      
    </div>
    <form name="submit_issue" method="post" action="#">
    <div class="row">
        <div class="col-md-4">
            <div class="col-md-3" id="piechart9" style="width: 650px; height: 350px;"></div>

        </div>        
            
    <div class="col-md-4 col-md-offset-2">
        <div class="row">
            <div class="form-group">
                <label>Please select an issue:</label>
                <select name="issues" id="issues" class="form-control">
                    <?php foreach($data['issues'] as $issue){ ?>
                        <option value="<?php echo $issue->issueId; ?>"><?php echo $issue->issueName; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button type="submit" value="Submit" name="submit" class="form-control btn btn-primary btn-sm">Submit</button>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3" id="piechart8" style="width: 650px; height: 350px;"></div>
        </div>
    </div>
    </div>
    </form>
  </body>

</html>