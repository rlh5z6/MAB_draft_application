<header>
    <h2>Site Leaders</h2>
</header>
<hr />
<table class="table table-striped table-hover">
    <h4>2014-2015 Site Leaders</h4>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Trip</th>
            <th>Mizzou Email</th>
            <th>Phone Number</th>
        </tr>
    </thead>
    <tbody>
        
    <?php
    if ($data['site_leaders']) {
            foreach ($data['site_leaders'] as $site_leader_info) {
                echo '<tr>';
                echo '<td>'.$site_leader_info->firstName.'</td>';
                echo '<td>'.$site_leader_info->lastName.'</td>';
                echo '<td>'.$site_leader_info->nickname.'</td>';
                echo '<td>'.$site_leader_info->email.'</td>';
                echo '<td>'.$site_leader_info->phone.'</td>';
            }
        }
        echo '</tr>';
    
    ?>
            
        </tr>
    </tbody>