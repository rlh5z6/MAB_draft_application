<?php use \helpers\form, \core\error; ?>

<header>
    <h2>Trip Location</h2>
</header>
<hr />
<p>Please submit your location that you and your co-site leader have agreed upon.</p>


<form name="submit_location" method="post" action="#">
    
    <div id="city_div" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="city">City: </label>
                <input type="text" id="city" name="city" class="form-input text form-control">
            </div>
        </div>
    </div>  
    
   <div id="state_div" class="form-group">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
        <label for="state">State: </label>
            <select name='state' id='state' class='form-control'>
                <option value="">Select</option>
                <?php foreach($data['states'] as $key=>$value){
                echo '<option value="'.$key.'">'.$value.'</option>';
                } ?>
            </select>
        </div>
    </div>
    </div>
    
    <div id="country_div" class="form-group">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
        <label for="country">Country: </label>
            <select name='country' id='country' class='form-control'>
                <option value="">Select</option>
                <?php foreach($data['countries'] as $key=>$value){
                echo '<option value="'.$key.'">'.$value.'</option>';
                } ?>
            </select>
        </div>
    </div>
    </div>
    
    <div id="button_div" class="form-group">
        <div class="row">
            <div class="col-md-offset-5 col-md-4">
                <button type="submit" class="btn btn-primary" name="submit_location">Submit Location</button> 
            </div>
        </div>
    </div>
</form>