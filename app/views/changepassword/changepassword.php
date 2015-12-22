<header>
    <h2>Change Password</h2>
    <hr>
</header>

<div>
    <?php
        if(isset($_GET['success'])){
            echo"YAY";
        }else if(isset($_GET['error'])){
            echo"BOO";
        }
    ?>
    <form action="changepassword_submit" method="POST">
        <div id="old_pass_div" class="form-group">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <label for="first_name">Current Password: </label>
                    <input type="password" id="oldpass" name="oldpass" class="form-input text form-control">
                </div>
            </div>
        </div>  
        <div id="old_pass_div" class="form-group">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <label for="first_name">New Password: </label>
                    <input type="password" id="newpass" name="newpass" class="form-input text form-control">
                </div>
            </div>
        </div>  
        <div id="old_pass_div" class="form-group">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <label for="first_name">Confirm Password: </label>
                    <input type="password" id="confirmpass" name="confirmpass" class="form-input text form-control">
                </div>
            </div>
        </div>  
        
        <div class="form-group">
        <div class="row">
            <div class="col-md-offset-5 col-md-3">
                <input type="submit" name="submit" class="form-input text btn btn-default btn-primary btn-lg" value="Submit">
            </div>
        </div>
    </div>
    </form>
</div>