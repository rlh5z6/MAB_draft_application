<head>

    <!-- Site meta -->
    <meta charset="utf-8">
    <title><?php echo $data['title'].' - '.SITETITLE; //SITETITLE defined in app/core/config.php ?></title>

    <!-- CSS -->
    <?php
    helpers\assets::js(array(
        helpers\url::template_path() . 'js/jquery.js',
        helpers\url::template_path() . 'js/inputmask/dist/jquery.inputmask.bundle.min.js',
        helpers\url::template_path() . 'js/jquery-ui-1.11.4.custom/jquery-ui.min.js',
        helpers\url::template_path() . 'js\tablesorter\jquery.tablesorter.min.js'
    ));

    helpers\assets::css(array(
        helpers\url::template_path() . 'css/bootstrap.min.css',
        helpers\url::template_path() . 'js/jquery-ui-1.11.4.custom/jquery-ui.min.css',
        helpers\url::template_path() . 'css/jquery-ui-fix.css',
        helpers\url::template_path() . 'js\tablesorter\themes\blue\style.css',
        helpers\url::template_path() . 'css/iframe.css'
    ));
    ?>

</head>
