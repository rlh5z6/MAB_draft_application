<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\password,
\helpers\url;

class Auth extends \core\controller {

    private $_model;

    public function __construct() {
        $this->_model = new \models\auth();
    }

    public function login(){

        $data['title'] = 'Login';

        View::rendertemplate('header', $data);
        View::render('auth/login', $data, $error);
        View::rendertemplate('footer', $data);
    }

    public function logout(){
        Session::destroy();
        Url::redirect();
    }
}