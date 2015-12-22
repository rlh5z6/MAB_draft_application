<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\url;

class TripBoard extends \core\controller {

    public function __construct() {
        $this->mab = new \models\TripBoard();
        $this->registerTrip = new \models\registerTrip();
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

        $data['title'] = 'Trip Board';
        $data['seasons'] = $this->registerTrip->get_seasons();
        
        
        $data['trips'] = $this->mab->get_trip_information($_POST['seasonId']);
        
        View::rendertemplate('exec_header', $data);
        View::render('trips/tripBoard', $data, $error);
        View::rendertemplate('footer', $data);
    }

}
