<input type="text" id="searchTerm">
<input type="button" id="search" value="Search all Applicants">
<br/>
<div>
    <table id="searchResultsTable" class="tablesorter">
        <thead>
            <tr>
                <th width="130"></th>
                <th width="70">App #</th>
                <th>Hometown</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Issue #1</th>
                <th>Issue #2</th>
                <th>Issue #3</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="searchResults">

        </tbody>
    </table>
    <img src="/app/images/ajax-loader.gif" id="loading">
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#search").click(function(){
            $("#loading").show();
            $("#searchResults").html('');
            $.ajax({
                url: 'ajax/applicantSearch?searchTerm=' + $("#searchTerm").val()
            }).done(function(results){
                results = JSON.parse(results);
                var tableString = "";
                for(var i = 0; i < results.length; i++){
                    tableString = tableString + "<tr>";
                    tableString = tableString + "<td><input type='button' disabled class='btn btn-primary btn-sm draft' id='draft_" + results[i].applicationId + "' onclick='draft(" + results[i].applicationId + ")' value='Draft'></td>";
                    tableString = tableString + "<td>"+ results[i].applicationId +"</td>";
                    tableString = tableString + "<td>"+ results[i].hometown +"</td>";
                    tableString = tableString + "<td>"+ results[i].age +"</td>";
                    tableString = tableString + "<td>"+ results[i].gender +"</td>";
                    tableString = tableString + "<td>"+ results[i].issue1 +"</td>";
                    tableString = tableString + "<td>"+ results[i].issue2 +"</td>";
                    tableString = tableString + "<td>"+ results[i].issue3 +"</td>";
                    tableString = tableString + "<td><input type='button' class='btn btn-primary btn-sm' onclick='answers("+results[i].applicationId+")' value='View Answers'></td>";
                    tableString = tableString + "</tr>";
                }
                $("#loading").hide();
                $("#searchResults").html(tableString);
                $("#searchResultsTable").trigger("update");
            });
        });
        $("#search").click();
        $("#searchResultsTable").tablesorter({
            headers: {
                0: {
                    sorter: false
                },
                8: {
                    sorter: false
                }
            }
        });
    });

    function draft(applicationId){
        alert(applicationId);
    }

    function answers(applicationId){
        $.ajax({
            url: 'ajax/applicantAnswers?applicationId=' + applicationId
        }).done(function(results){
            results = JSON.parse(results);
            var outputString = "";
            for(var i = 0; i < results.length; i++){
                outputString = outputString + (i+1) + ": " + results[i].questionText + "\n\n";
                outputString = outputString + results[i].answer + "\n\n";
            }
            alert(outputString);
        });
    }
</script>