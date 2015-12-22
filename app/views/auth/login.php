<?php use \helpers\form, \core\error; ?>

<?php echo Error::display($error); ?>
<div class="loginPage">
    <h5>To register, please login or <a href="/createAccount/"><strong>create an account</strong></a></h5>
    <?php echo Form::open(array( 'method'=> 'post', 'class' => 'form-group' ));?>
    <h3>Login</h3>
    <label for="usernameInput">Pawprint:
        <?php echo Form::input(array( 'name'=> 'username', 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'Pawprint' ));?>
    </label>

    <label for="passwordInput">Password:
        <?php echo Form::input(array( 'name'=> 'password', 'id' => 'password', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password' ));?>
    </label>

    <br />
    <br />

    <?php echo Form::input(array( 'type'=> 'submit', 'name' => 'submit', 'value' => 'Login', 'class' => 'btn btn-default btn-primary' )); ?>

    <?php echo Form::close();?>
</div>