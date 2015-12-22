<?php
use \core\view,
\helpers\session;
?>

<!DOCTYPE html>
<html class="full" lang="<?php echo LANGUAGE_CODE; ?>">

    <head>

        <!-- Site meta -->
        <meta charset="utf-8">
        <title><?php echo $data['title'].' - '.SITETITLE; //SITETITLE defined in app/core/config.php ?></title>

        <!-- CSS -->
        <?php
        helpers\assets::js(array(
            helpers\url::template_path() . 'js/jquery.js',
            helpers\url::template_path() . 'js/inputmask/dist/jquery.inputmask.bundle.min.js',
            helpers\url::template_path() . 'js/jquery-ui-1.11.4.custom/jquery-ui.min.js'
        ));

        helpers\assets::css(array(
            helpers\url::template_path() . 'css/bootstrap.min.css',
            helpers\url::template_path() . 'js/jquery-ui-1.11.4.custom/jquery-ui.min.css',
            helpers\url::template_path() . 'css/jquery-ui-fix.css'
        ));

        ?>

    </head>
    <body data-twttr-rendered="true">

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        Mizzou Alternative Breaks
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a ><?php echo $data['title']; ?><span class="sr-only">(current)</span></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                       <?php if(Session::get('username')){
                           echo '<li><a href="/trip">Trip Profile</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Participants <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/applications">Applications</a></li>    
                                    <li><a href="/wishlist">Wish List</a></li>    
                                    <li><a href="/draftBoard">Draft Board</a></li>     
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/locations">Update Trip Location</a></li>    
                                    <li><a href="/changepassword">Change Password</a></li>     
                                </ul>
                            </li>
                            <li><a href="/logout">Logout <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></span></a></li>';
                            }
                            else {

                                echo  '<li><a href="/apply">Apply</a></li>';


                            }
                        ?>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>


<div class="container-fluid">