<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\url;

class Draft extends \core\controller {

    private $_model;

    public function __construct() {
        $this->_model = new \models\draft();
    }

    public function create(){

        Session::init();
        if(Session::get('username')){
            if(Session::get('admin')){
                Url::redirect('exec');
            }
        }else{
            Url::redirect('');
        }

        $data['title'] = 'Draft Board';

        View::rendertemplate('header', $data);
        View::render('draft/draft', $data, $error);
        View::rendertemplate('footer', $data);
    }

}