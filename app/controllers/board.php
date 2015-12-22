<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\password,
\helpers\url;

class board extends \core\controller {

    private $_model;

    public function __construct() {
        $this->mab = new \models\board();
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


        $data['title'] = 'Board of Directors';

        $data['board_of_directors'] = $this->mab->get_board_of_directors();
        
        
        View::rendertemplate('exec_header', $data);
        View::render('board/board', $data, $error);
        View::rendertemplate('footer', $data);
    }

}