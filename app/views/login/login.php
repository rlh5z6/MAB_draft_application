<?php if(isset($_GET['error'])){ ?>
<p>You did not enter a valid username and password combination.</p>
<?php } ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1>MAB Management Application</h1>
        </div>

    </div>
    <h3>To begin, please login or <a href="/apply">apply</a>.</h3>
</div>
<hr/>
<div class="container">
    <h3>Login</h3>
</div>

<form method="POST" action="/login" class="form-class">
    <div class="container">
        <div class="row">
            <div class="col-md-5 well">

                <div class="row">
                    <div class="col-md-12">
                        <label class="form-group">User Name: </label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-group">Password: </label>
                        <div class="form-group">
                            <input type="password" class="form-control" name="pass">
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-lg">Login <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></button>
    </div>
</form>