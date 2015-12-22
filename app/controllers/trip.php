<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\url;

class Trip extends \core\controller {

    public function __construct(){
		parent::__construct();
        $this->mab = new \models\trip();
        $this->analytics = new \models\analytics();
        $this->locations = new \models\Locations();
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

        $data['title'] = 'Trip Profile';
        
        $tripId = \helpers\Session::get("tripId");
        $data['location_info'] = $this->mab->location_info($tripId);
        
        $data['trip_profile'] = $this->mab->get_trip_information($tripId);
        $data['participant_roster'] = $this->mab->participant_information();
        
        
        $data['site_leader_roster'] = $this->mab->site_leader_information();
        $data['states'] = $this->locations->get_all_states();
        
        
        $housing_site = htmlspecialchars($_POST['housing_site']);
        $contact_name = htmlspecialchars($_POST['contact_name']);
        $address = htmlspecialchars($_POST['address']);
        $city = htmlspecialchars($_POST['city']);
        $state = htmlspecialchars($_POST['state']);
        $zip = htmlspecialchars($_POST['zip']);
        $phone = htmlspecialchars($_POST['phone']);
        $email = htmlspecialchars($_POST['email']);
        
        $is_housing_valid = \helpers\gump::is_valid($_POST, array(
            'housing_site' => 'required',
            'contact_name' => 'required|alpha',
            'address' => 'required',
            'city' => 'required|alpha',
            'state' => 'required|alpha',
            'email' => 'required|valid_email',
            'phone' => 'required'
        ));     
        
        if ($is_housing_valid == true) {
            if (isset($_POST['save_housing'])) {
                $this->mab->insert_housing($tripId, $housing_site, $address, $city, $state, $zip);
                $housingId = $this->mab->find_housingId($tripId, $housing_site);
                $this->mab->update_housingId($tripId, $housingId);
                $this->mab->insert_housing_contact($housingId, $contact_name, $email, $phone);
            }
            
            
            
        }
        
        $service_site = htmlspecialchars($_POST['service_site']);
        $website = htmlspecialchars($_POST['website']);
        $service_contact_name = htmlspecialchars($_POST['service_contact_name']);
        $service_address = htmlspecialchars($_POST['service_address']);
        $service_city = htmlspecialchars($_POST['service_city']);
        $service_state = htmlspecialchars($_POST['service_state']);
        $service_zip = htmlspecialchars($_POST['service_zip']);
        $service_phone = htmlspecialchars($_POST['service_phone']);
        $service_email = htmlspecialchars($_POST['service_email']);
        
        
        $is_service_valid = \helpers\gump::is_valid($_POST, array(
            'service_site' => 'required',
            'website' => 'required',
            'service_contact_name' => 'required|alpha',
            'service_address' => 'required',
            'service_city' => 'required|alpha',
            'service_state' => 'required|alpha',
            'service_email' => 'required|valid_email',
            'service_phone' => 'required'
        ));     
        
        if ($is_service_valid == true) {
            if (isset($_POST['save_service'])) {
                
                $this->mab->insert_service($tripId, $service_site, $service_address, $website, $service_city, $service_state, $service_zip);
                $serviceSiteId = $this->mab->find_serviceSiteId($tripId, $service_site);
                $this->mab->update_trip_sites($tripId, $serviceSiteId);
                $this->mab->insert_service_contact($serviceSiteId, $service_contact_name, $service_email, $service_phone);
            }
        }
       
        
        if (isset($_POST['delete_housing'])) {
            
            $this->mab->delete_housing($data['trip_profile']->housingId);
                
        }
        
        if (isset($_POST['deleteServiceSiteBtn'])) {
            $serviceSiteId = $_POST['deleteTrip'];
            $this->mab->delete_service_site($serviceSiteId);    
        }
        
            
        
        $data['apps_by_gender'] = $this->analytics->get_gender_by_trip($tripId);
        $data['apps_by_grade'] = $this->analytics->get_school_year_by_trip($tripId);
        
        
        View::rendertemplate('header', $data);
        View::render('trip/trip', $data, $error);
        View::rendertemplate('footer', $data);
    }

}