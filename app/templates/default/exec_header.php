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
                    <a class="navbar-brand" href="/">Mizzou Alternative Breaks</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a ><?php echo $data['title']; ?><span class="sr-only">(current)</span></a></li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Register <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/registerSiteLeader">Site Leader</a></li>    
                                <li><a href="/registerTrip">Trip</a></li>     
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Members <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/board">Board of Directors</a></li>    
                                <li><a href="/siteLeader">Site Leaders</a></li>           
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Trips <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <!--<li><a href="/tripBoard">2014-15 Trips</a></li>-->  
                                <li><a href="/draftBoard">Draft Board</a></li>     
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Analytics <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/trip_analytics">Trips</a></li>    
                                <li><a href="/application_analytics">Applications</a></li>     
                            </ul>
                        </li>
                        <li><a href="/logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
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
                       <li class="active"><a><b>Trip:</b> New Orleans</a></li>
                        <li class="active"><a><b>Issue:</b> Environment</a></li>
                        <li class="active"><a><b>User:</b> Devin Clark</a></li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
<div class="container-fluid">