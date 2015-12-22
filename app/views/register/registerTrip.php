<?php use \helpers\form, \core\error; ?>

<div class="page-header">
    <h2>Register Trip</h2>
</div>


<form name="register" method="post" action="#">

<div id="issues_div" class="form-group">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
        <label for="issueId">Issue: </label>
                <?php echo Form::select(array( 'name'=> 'issue', 'id' => 'issue', 'class' => 'form-control', 'data' => $data['issues_names']));?>
            
        </div>
    </div>
</div>
<div id="site_leader1_div" class="form-group">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
        <label for="issueId">Site Leader #1: </label>
            <select name='site_leader1' id='site_leader1' class='form-control'>
            <option value="">Select</option>
            <?php foreach($data['site_leaders'] as $key => $site_leader){ ?>
            <option value='<?php echo $site_leader->personId; ?>'><?php echo $site_leader->firstName . " " . $site_leader->lastName; ?></option>
            <?php } ?>
            </select>
        </div>
    </div>
</div>
        
<div id="site_leader2_div" class="form-group">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
        <label for="issueId">Site Leader #2: </label>
            <select name='site_leader2' id='site_leader1' class='form-control'>
                <option value="">Select</option>
                <?php foreach($data['site_leaders'] as $key => $site_leader){ ?>
                <option value='<?php echo $site_leader->personId; ?>'><?php echo $site_leader->firstName . " " . $site_leader->lastName; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
    
<div id="seasons_div" class="form-group">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
        <label for="issueId">Season: </label>
                <?php echo Form::select(array( 'name'=> 'season', 'id' => 'season', 'class' => 'form-control', 'data' => $data['season_names']));?>
            
        </div>
    </div>
</div>

<div id="username_div" class="form-group">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <label for="username">Username: </label>
            <?php echo Form::input(array('name'=> 'user_name', 'id' => 'user_name', 'class' => 'form-control'));?>
        </div>
    </div>
</div> 

    
<div class="form-group">
    <div class="row">
        <div class="col-md-offset-5 col-md-4">
            <br><input type="submit" name="create_trip_account" class="form-input text btn btn-default btn-primary btn-lg" value="Register Trip">
        </div>
    </div>
</div>
    
</form>   