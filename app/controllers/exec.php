<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\url;

class Exec extends \core\controller {

    private $_model;

    public function __construct() {
        $this->_model = new \models\exec();
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

        $data['title'] = 'Home';

        View::rendertemplate('exec_header', $data);
        View::render('exec/exec', $data, $error);
        View::rendertemplate('footer', $data);
    }

}