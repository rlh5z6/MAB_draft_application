<table id="wishlist" class="tablesorter">
    <thead>
    <tr>
        <th width="70"></th>
        <th width="70">Rating</th>
        <th width="70">App #</th>
        <th width="90">Gender</th>
        <th width="70">Age</th>
        <th>Notes</th>

    </tr>
    </thead>
    <tbody>

    <?php
    if ($data['applicants']) {
        foreach ($data['applicants'] as $applicants_info) {
            echo '<tr>';
            echo "<td><input type='button' disabled id='draft_".$applicants_info->applicationId."' class='btn btn-primary btn-sm draft' onclick='draft(" . $applicants_info->applicationId . ")' value='Draft'></td>";
            echo '<td>'.$applicants_info->rating.'</td>';
            echo '<td>'.$applicants_info->applicationId.'</td>';
            echo '<td>'.$applicants_info->gender.'</td>';
            echo '<td>'.$applicants_info->age.'</td>';
            echo '<td>'.$applicants_info->notes.'</td>';
            echo '</tr>';
        }
    }
    ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
        $("#wishlist").tablesorter({
            headers: {
                0: {
                    sorter: false
                }
            }
        });
    });

    function draft(applicationId){
        $.ajax({
            url: 'ajax/draft?applicationId=' + applicationId + '&tripId=<?php echo \helpers\session::get('tripId'); ?>'
        }).done(function(results){
            results = JSON.parse(results);
            if(results){
                alert("Success!");
                $.ajax({
                    url: 'ajax/updateTurn?tripId=<?php echo \helpers\session::get('tripId'); ?>'
                });
            }else{
                alert("Failure!");
            }
        });
    }
</script>