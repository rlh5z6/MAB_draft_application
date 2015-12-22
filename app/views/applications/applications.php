<script src="http://localhost:8888/app/templates/default/js/mab_scripts.js"></script>
<header>
    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Applications</h2>
    <h5>Issue: <?php echo \helpers\Session::get("issue"); ?></h5>
</header>

<hr />
<table class="table table-striped table-hover">
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
            <th width="130"></th>

        </tr>
    </thead>
    <tbody>
        <form name="Applications" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <?php


if ($data['applicants1']) {
    $i = 0;
    foreach ($data['applicants1'] as $applicants_info) {

        echo '<tr id="' . $i . '">';
        if ($applicants_info->rating == NULL) {

            echo '<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="openModal('.$applicants_info->applicationId.', '. "'". $applicants_info->gender."'".', '.$applicants_info->age.')"> Add to Wishlist </button></td>';
        }
        else {
            echo '<td><button type="button" disabled class="btn btn-primary btn-sm" data-toggle="modal" onclick="openModal('.$applicants_info->applicationId.', '. "'". $applicants_info->gender."'".', '.$applicants_info->age.')"> Add to Wishlist </button></td>';   

        }
        echo '<td>'.$applicants_info->applicationId.'</td>';
        echo '<td>'.$applicants_info->hometown.'</td>';
        echo '<td>'.$applicants_info->age.'</td>';
        echo '<td>'.$applicants_info->gender.'</td>';
        echo '<td>'.$applicants_info->issue1.'</td>';
        echo '<td>'.$applicants_info->issue2.'</td>';
        echo '<td>'.$applicants_info->issue3.'</td>';
        echo '<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="openAppModal('.$applicants_info->applicationId.')"> View Application </button></td>';


        $i++;
    }

}
echo '</tr>';


if ($data['applicants2']) {
    $i = 0;
    foreach ($data['applicants2'] as $applicants_info) {

        echo '<tr id="' . $i . '">';
        if ($applicants_info->rating == NULL) {

            echo '<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="openModal('.$applicants_info->applicationId.', '. "'". $applicants_info->gender."'".', '.$applicants_info->age.')"> Add to Wishlist </button></td>';
        }
        else {
            echo '<td><button type="button" disabled class="btn btn-primary btn-sm" data-toggle="modal" onclick="openModal('.$applicants_info->applicationId.', '. "'". $applicants_info->gender."'".', '.$applicants_info->age.')"> Add to Wishlist </button></td>';   

        }
        echo '<td>'.$applicants_info->applicationId.'</td>';
        echo '<td>'.$applicants_info->hometown.'</td>';
        echo '<td>'.$applicants_info->age.'</td>';
        echo '<td>'.$applicants_info->gender.'</td>';
        echo '<td>'.$applicants_info->issue1.'</td>';
        echo '<td>'.$applicants_info->issue2.'</td>';
        echo '<td>'.$applicants_info->issue3.'</td>';
        echo '<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="openAppModal('.$applicants_info->applicationId.')"> View Application </button></td>';

        $i++;


    }
}
echo '</tr>';


if ($data['applicants3']) {
    $i = 0;
    foreach ($data['applicants3'] as $applicants_info) {

        echo '<tr id="' . $i . '">';
        if ($applicants_info->rating == NULL) {

            echo '<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="openModal('.$applicants_info->applicationId.', '. "'". $applicants_info->gender."'".', '.$applicants_info->age.')"> Add to Wishlist </button></td>';
        }
        else {
            echo '<td><button type="button" disabled class="btn btn-primary btn-sm" data-toggle="modal" onclick="openModal('.$applicants_info->applicationId.', '. "'". $applicants_info->gender."'".', '.$applicants_info->age.')"> Add to Wishlist </button></td>';   

        }
        echo '<td>'.$applicants_info->applicationId.'</td>';
        echo '<td>'.$applicants_info->hometown.'</td>';
        echo '<td>'.$applicants_info->age.'</td>';
        echo '<td>'.$applicants_info->gender.'</td>';
        echo '<td>'.$applicants_info->issue1.'</td>';
        echo '<td>'.$applicants_info->issue2.'</td>';
        echo '<td>'.$applicants_info->issue3.'</td>';
        echo '<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="openAppModal('.$applicants_info->applicationId.')"> View Application </button></td>';

        $i++;


    }
}
echo '</tr>';






            ?>
        </form>

    </tbody>


    <form name="full_app" method="post" action="#">
        <div class="modal fade bs-example-modal-lg" id="fullApp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Application</h4>
                    </div>
                    <div class="modal-body">
                        <b>Application Question and Answers</b><textarea name="answer" readonly placeholder="" width="10" rows="25" id="answerAppModal1" class="form-control"></textarea><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <form name="add_to_wishlist" method="post" action="#">
        <div class="modal fade bs-example-modal-sm" id="addToWishList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Applicant to Wishlist</h4>
                    </div>
                    <div class="modal-body">
                        <b>Application #</b><input type="text" name="aid" readonly placeholder="" width="10" id="aidModal" class="form-control"/><br>
                        <b>Gender: </b><input type="text" name="gender" readonly placeholder="" width="10" id="genderModal" class="form-control"/><br>
                        <b>Age: </b><input type="text" name="age" readonly placeholder="" width="10" id="ageModal" class="form-control"/><br>
                        <b>Rating: </b><input type="text" name="rating" placeholder="1-10" width="10" class="form-control"/><br>
                        <b>Notes: </b><br><textarea name="notes" class="form-control"></textarea><br>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add_application">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>