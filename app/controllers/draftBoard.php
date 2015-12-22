<?php namespace controllers;

use \core\view,
    \helpers\session,
    \helpers\url;

class draftBoard extends \core\controller {

    public function __construct(){
        $this->draftBoardModel = new \models\draftBoard();
        $this->wishListModel = new \models\wishlist();
    }

    public function index(){
        Session::init();
        if(!Session::get('username')){
            Url::redirect('');
        }

        $data['title'] = "Draft Board";
        if(Session::get('admin')){
            View::rendertemplate('exec_header', $data);
            View::render('draftBoard/container_admin', $data, $error);
        }else{
            View::rendertemplate('header', $data);
            View::render('draftBoard/container', $data, $error);
        }
        View::rendertemplate('footer', $data);
    }

    public function wishlist(){
        $tripId = \helpers\Session::get("tripId");
        $data['applicants'] = $this->wishListModel->get_wishlist($tripId);
        foreach($data['applicants'] as $applicants_info) {
            $applicants_info->age = $this->wishListModel->get_age_at_time($applicants_info->dateOfBirth, date('Y-m-d', time()));
        }
        
        
        
        View::rendertemplate('iframe_header', $data);
        View::render('draftBoard/wishlist', $data, $error);
    }

    public function draftBoard(){
        $data['draftOrder'] = $this->draftBoardModel->getDraftOrder();
        View::rendertemplate('iframe_header', $data);
        View::render('draftBoard/draftBoard', $data, $error);
    }

    public function search(){
        View::rendertemplate('iframe_header', $data);
        View::render('draftBoard/search', $data, $error);
    }
}
