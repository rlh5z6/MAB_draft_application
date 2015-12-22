</div>


<!-- JS -->
<?php

    use \core\view,
    \helpers\session;

	helpers\assets::js(array(
        helpers\url::template_path() . 'js/mab_scripts.js',
		'//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'
	)) 
?>

<nav class="navbar navbar-default navbar-fixed-bottom">
            <!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-7">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img alt="Brand" src="/app/images/college_logo.png" height="30">
            </a>

        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-7">
            <ul class="nav navbar-nav navbar-right">
                
                
                <?php if(Session::get('username') && !Session::get('admin')){
                    echo '<li class="active"><a><b>Trip:</b> ' . \helpers\Session::get("nickname") . '</a></li>' .
                    '<li class="active"><a><b>Issue:</b> ' . \helpers\Session::get("issue") . '</a></li>' .
                    '<li class="active"><a><b>User:</b> ' . \helpers\Session::get("username") . '</a></li>';
                } 
                else if(Session::get('username')){
                    echo '<li class="active"><a><b>User:</b> ' . \helpers\Session::get("username") . '</a></li>';
                } ?>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
