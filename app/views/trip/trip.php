<header>
    <h2>Trip Profile</h2>
    <h5>Issue: <b><?php echo \helpers\Session::get("issue"); ?></b></h5>
    <h5>Location: <b><?php echo $data['location_info'][0]->city.', '.$data['location_info'][0]->region; ?></b></h5>
</header>
<hr>
<head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);

        function drawChart() {



            var gender_data = google.visualization.arrayToDataTable([
                ['Gender', 'Number of Members'],
                <?php
$i = 1;
foreach($data['apps_by_gender'] as $gender_info){
    echo "['".$gender_info->gender."',";
    echo $gender_info->num_of_members."]";
    if($i < count($data['apps_by_gender'])){
        echo",";
    }
    $i++;
}
                ?>
            ]);

            var age_data = google.visualization.arrayToDataTable([
                ['Year in School', 'Number of Members'],
                <?php
$i = 1;
foreach($data['apps_by_grade'] as $app_info){
    echo "['".$app_info->schoolYear."',";
    echo $app_info->num_of_members."]";
    if($i < count($data['apps_by_grade'])){
        echo",";
    }
    $i++;
}
                ?>
            ]);

            var gender_options = {
                title: 'Trip Breakdown by Gender'
            };

            var age_options = {
                title: 'Trip Breakdown by Year in School'
            };




            var trip_gender_chart = new google.visualization.PieChart(document.getElementById('piechart1'));
            trip_gender_chart.draw(gender_data, gender_options);

            var trip_age_chart = new google.visualization.PieChart(document.getElementById('piechart2'));
            trip_age_chart.draw(age_data, age_options);
        }
    </script>



</head>
<body>
    <table class="table table-striped table-hover">
        <h4>Official Trip Roster</h4>
        <?php 
$trip_info = $data['trip_profile'];
        ?>
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mizzou Email</th>
                <th>Phone Number</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Hometown</th>
                <th>Year in School</th>
            </tr>
        </thead>
        <tbody>
            <?php
if ($data['site_leader_roster']) {
    foreach ($data['site_leader_roster'] as $site_leader) {

        echo '<tr>';
        echo '<td>SL</td>';
        echo '<td>'.$site_leader->firstName.'</td>';
        echo '<td>'.$site_leader->lastName.'</td>';
        echo '<td>'.$site_leader->email.'</td>';
        echo '<td>'.$site_leader->phone.'</td>';
        echo '<td>'.$site_leader->age.'</td>';
        echo '<td>'.$site_leader->gender.'</td>';
        echo '<td>'.$site_leader->hometown.'</td>';
        echo '<td>'.$site_leader->schoolYear.'</td>';
        echo '</tr>';
        $i++;

    }
}

if ($data['participant_roster']) {
    $i = 1;

    foreach ($data['participant_roster'] as $participant) {

        echo '<tr>';
        echo '<td>'.$i.'</td>';
        echo '<td>'.$participant->firstName.'</td>';
        echo '<td>'.$participant->lastName.'</td>';
        echo '<td>'.$participant->email.'</td>';
        echo '<td>'.$participant->phone.'</td>';
        echo '<td>'.$participant->age.'</td>';
        echo '<td>'.$participant->gender.'</td>';
        echo '<td>'.$participant->hometown.'</td>';
        echo '<td>'.$participant->schoolYear.'</td>';
        echo '</tr>';
        $i++;

    }
}

            ?>
        </tbody>
    </table>


    <div class="row" id="additionInfo">
        <div class="col-md-6">
            <table class="table table-bordered">

                <h4>Housing Information</h4>
                <tbody>
                    <tr>
                        <th scope="row"><b>Housing Site</b></th>
                        <td><?php echo $trip_info->housing_information->name; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><b>Contact</b></th>
                        <td><?php echo $trip_info->housing_contact->contactName; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><b>Address</b></th>
                        <td><?php echo $trip_info->housing_information->address.'<br>'.$trip_info->housing_information->city.', '.$trip_info->housing_information->region.' '.$trip_info->housing_information->zip.' '.$trip_info->housing_information->country; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><b>Phone Number</b></th>
                        <td><?php echo $trip_info->housing_contact->phoneNumber; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><b>Email</b></th>
                        <td><?php echo $trip_info->housing_contact->email; ?></td>
                    </tr>
                </tbody>
            </table>
            <?php if ($trip_info->locationId != NULL) { ?>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#housingModal">Add Housing</button>


            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#deleteHousingModal">Delete Housing</button>
            <?php }
else { ?>
            <a href="/locations">
                <button type="button" class="btn btn-primary btn-sm">Select Location</button>
            </a>

            <?php } ?>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <h4>Service Site Information</h4>
                <tbody>
                    <tr>
                        <th scope="row"><b>Service Site</b></th>
                        <?php foreach($trip_info->service_sites as $site){ ?>
                        <td><?php echo $site->siteName;?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th scope="row"><b>Website</b></th>
                        <?php foreach($trip_info->service_sites as $site){ ?>
                        <td><?php echo $site->orgWebSite;?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th scope="row"><b>Contact</b></th>
                        <?php foreach($trip_info->service_sites as $site){ ?>
                        <td><?php echo $site->contact->contactName;?></td>
                        <?php } ?>

                    </tr>
                    <tr>
                        <th scope="row"><b>Address</b></th>
                        <?php foreach($trip_info->service_sites as $site){ ?>
                        <td><?php echo $site->address.'<br>'.$site->city.', '.$site->region.' '.$site->zip.' '.$site->country; ?></td>
                        <?php } ?>

                    </tr> 
                    <tr>
                        <th scope="row"><b>Phone Number</b></th>
                        <?php foreach($trip_info->service_sites as $site){ ?>
                        <td><?php echo $site->contact->phoneNumber;?></td>
                        <?php } ?>

                    </tr> 
                    <tr>
                        <th scope="row"><b>Email</b></th>
                        <?php foreach($trip_info->service_sites as $site){ ?>
                        <td><?php echo $site->contact->email;?></td>
                        <?php } ?>

                    </tr>
                </tbody>

            </table>

            <?php if ($trip_info->locationId != NULL) { ?>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#serviceModal">
                Add Service Site
            </button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#deleteServiceModal">
                Delete Service Site
            </button>
            <?php } ?>
        </div>
    </div>

    <h4>Trip Breakdown</h4>
    <div class="row" id="analytics_info">
        <div class="col-md-3" id="piechart1" style="width: 500px; height: 300px;"></div>
        <div class="col-md-3" id="piechart2" style="width: 500px; height: 300px;"></div>
    </div>

</body>

<form name="add_housing" method="post" action="#">
    <!-- Modal -->
    <div class="modal fade bs-example-modal-md" id="housingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Housing Information</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="housing_site">Housing Site: </label>
                        <input type="text" id="housing_site" name="housing_site" class="form-input text form-control"><br>
                    </div>
                    <div class="form-group">  
                        <label for="contact_name">Contact Name: </label>
                        <input type="text" id="contact_name" name="contact_name" class="form-input text form-control"><br>
                    </div>
                    <div class="form-group">
                        <label for="address">Address: </label>
                        <input type="text" id="address" name="address" class="form-input text form-control"><br>
                    </div>
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <label for="city">City: </label>
                            <input type="text" id="city" name="city" class="form-input text form-control">
                        </div>
                        <div class="form-group">

                            <label for="state">State: </label>
                            <select name='state' id='state' class='form-control'>
                                <option value="">Select</option>
                                <?php foreach($data['states'] as $key=>$value){
    echo '<option value="'.$key.'">'.$value.'</option>';
} ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="zip">Zip: </label>
                            <input type="text" id="zip" name="zip" maxlength="5" class="form-input text form-control">
                        </div>
                    </form>
                    <div class="form-group">
                        <label for="phone">Phone Number: </label>
                        <input type="text" id="phone" name="phone" maxlength="10" class="form-input text form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" id="email" name="email" class="form-input text form-control">
                    </div>







                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="save_housing">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- Modal -->
<form name="delete_service_site" method="post" action="#">
<div class="modal fade bs-example-modal-sm" id="deleteServiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Service Site</h4>
            </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="deleteTrip"> 
                            Please select the service site to remove:
                        </label>
                        <select name="deleteTrip" id="deleteTrip" class="form-control">
                            
                            
                            <?php foreach($trip_info->service_sites as $site){ ?>
                            <option value=<?php echo $site->serviceSiteId; ?>><?php echo $site->siteName;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="deleteServiceSiteBtn">Save changes</button>
                </div>
        </div>
    </div>
</div>
</form>

<form name="delete_housing" method="post" action="#">
    <div class="modal fade bs-example-modal-sm" id="deleteHousingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Housing</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove your housing information?</p>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" name="delete_housing">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form name="add_service" method="post" action="#">
    <!-- Modal -->
    <div class="modal fade bs-example-modal-md" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Service Site Information</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="service_site">Service Site: </label>
                        <input type="text" id="service_site" name="service_site" class="form-input text form-control"><br>
                    </div>
                    <div class="form-group">
                        <label for="website">Website: </label>
                        <input type="text" id="website" name="website" class="form-input text form-control"><br>
                    </div>
                    <div class="form-group">  
                        <label for="service_contact_name">Contact Name: </label>
                        <input type="text" id="service_contact_name" name="service_contact_name" class="form-input text form-control"><br>
                    </div>
                    <div class="form-group">
                        <label for="service_address">Address: </label>
                        <input type="text" id="service_address" name="service_address" class="form-input text form-control"><br>
                    </div>
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <label for="service_city">City: </label>
                            <input type="text" id="service_city" name="service_city" class="form-input text form-control">
                        </div>
                        <div class="form-group">

                            <label for="service_state">State: </label>
                            <select name='service_state' id='state' class='form-control'>
                                <option value="">Select</option>
                                <?php foreach($data['states'] as $key=>$value){
    echo '<option value="'.$key.'">'.$value.'</option>';
} ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="service_zip">Zip: </label>
                            <input type="text" id="service_zip" name="service_zip" maxlength="5" class="form-input text form-control">
                        </div>
                    </form>
                    <div class="form-group">
                        <label for="service_phone">Phone Number: </label>
                        <input type="text" id="service_phone" name="service_phone" maxlength="10" class="form-input text form-control">
                    </div>
                    <div class="form-group">
                        <label for="service_email">Email: </label>
                        <input type="text" id="service_email" name="service_email" class="form-input text form-control">
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="save_service">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>







<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />