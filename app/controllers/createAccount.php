<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\password,
\helpers\url;

class createAccount extends \core\controller {

    private $_model;

    public function __construct() {
        $this->_model = new \models\createAccount();
    }

    public function create(){
        Session::init();
        if(Session::get('username')){
            if(!Session::get('admin')){
                Url::redirect('welcome');
            }
        }else{
            Url::redirect('');
        }


        $data['title'] = 'Register Site Leader';

        View::rendertemplate('exec_header', $data);
        View::render('createAccount/createAccount', $data, $error);
        View::rendertemplate('footer', $data);
    }

}