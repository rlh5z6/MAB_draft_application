<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\url;

class Locations extends \core\controller {

    private $_model;

    public function __construct() {
        $this->mab = new \models\Locations();
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

        $data['title'] = 'Trip Location';
        $data['states'] = $this->mab->get_all_states();
        $data['countries'] = $this->mab->get_all_countries();
        
       
        
        
        
        View::rendertemplate('header', $data);
        View::render('trip/locations', $data, $error);
        View::rendertemplate('footer', $data);
        
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $tripId = \helpers\Session::get("tripId");
        
        if (isset($_POST['submit_location'])) {
            $locationId = $this->mab->find_locationId($city, $state);
            if ($locationId == NULL) {
                
                $num_of_trips = $this->mab->count_locations($locationId);
                $num_of_trips = $num_of_trips + 1;
                $nickname = $city.' '.$num_of_trips;
                $this->mab->insert_location($city, $state, $country);   
                $locationId = $this->mab->find_locationId($city, $state);
                $this->mab->update_locationId($tripId, $locationId, $nickname);
                Session::set("nickname", $nickname);
                        
            }
            else {
                $num_of_trips = $this->mab->count_locations($locationId);
                $num_of_trips = $num_of_trips + 1;
                $nickname = $city.' '.$num_of_trips;
                $this->mab->update_locationId($tripId, $locationId, $nickname);
                
            }
        }
        
    

}
}