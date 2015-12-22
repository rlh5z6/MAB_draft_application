<?php namespace core;
class Config {

    public function __construct() {

        //turn on output buffering
        ob_start();

        //site address
        //define('DIR', 'http://ddrj-swemizzou.rhcloud.com/');
        define('DIR', 'http://localhost:8888/');

        //set default controller and method for legacy calls
        define('DEFAULT_CONTROLLER', 'welcome');
        define('DEFAULT_METHOD' , 'index');

        //set a default language
        define('LANGUAGE_CODE', 'en');

        //database details ONLY NEEDED IF USING A DATABASE
//        define('DB_TYPE', 'mysql');
//        define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
//        define('DB_PORT', getenv('OPENSHIFT_MYSQL_DB_PORT'));
//        define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
//        define('DB_PASS', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
//        define('DB_NAME', 'mab_draft');
//        define('PREFIX', '');

        //database details ONLY NEEDED IF USING A DATABASE
        define('DB_TYPE', 'mysql');
        define('DB_HOST', '127.0.0.1');
        define('DB_PORT', '3306');
        define('DB_USER', 'adminS9U7ebc');
        define('DB_PASS', 'tVEtF6PUBjXz');
        define('DB_NAME', 'mab_draft');
        define('PREFIX', '');


        //set prefix for sessions
        define('SESSION_PREFIX', 'dc_');

        //optionall create a constant for the name of the site
        define('SITETITLE', 'Mizzou Alternative Breaks');

        //turn on custom error handling
        set_exception_handler('core\logger::exception_handler');
        set_error_handler('core\logger::error_handler');

        //set timezone
        date_default_timezone_set('Europe/London');

        //start sessions
        \helpers\session::init();

        //set the default template
        \helpers\session::set('template', 'default');
    }

}


