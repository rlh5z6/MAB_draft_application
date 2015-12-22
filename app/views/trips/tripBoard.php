

<header>
    <form name="view_profile" method="post" action="#">
        
        <div class="row">
        <div class="col-md-3">
            <h2>2014 - 15 Trips</h2>
        </div>
        <div class="col-md-offset-5 col-md-1">
                Season:
        </div>
        <div class="col-md-2">
            <div id="season" class="form-group">
                <select class="form-control"  name="seasonId">
                    <?php foreach($data['seasons'] as $seasons){ ?>
                        <option value="<?php echo $seasons->seasonId ?>">
                            <?php echo $seasons->name; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-1">
                <button type="submit" name="season_submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
            
        </div>
     
        
    </form>
<hr>  
</header>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th width="90"></th>
            <th>Trip Name</th>
            <th>City</th>
            <th>State</th>
            <th>Site Leader #1</th>
            <th>Site Leader #2</th>
            <th>Issue</th>
        </tr>
    </thead>
    <tbody>
        
    <?php
        if ($data['trips']) {
            foreach ($data['trips'] as $trip_info) {
                echo '<tr>';
                echo '<td><button type="submit" name="view_trip_profile" class="btn btn-primary btn-sm">Trip Profile</button></td>';
                echo '<td>'.$trip_info->nickname.'</td>';
                echo '<td>'.$trip_info->city.'</td>';
                echo '<td>'.$trip_info->state.'</td>';
                echo '<td>'.$trip_info->site_leader1.'</td>';
                echo '<td>'.$trip_info->site_leader2.'</td>';
                echo '<td>'.$trip_info->issue.'</td>';
            }
        }
        echo '</tr>';
    ?>
            
        </tr>
    </tbody>
</table>
