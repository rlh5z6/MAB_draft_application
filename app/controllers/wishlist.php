<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\url;

class wishList extends \core\controller {

    private $_model;

    public function __construct() {
        $this->mab = new \models\wishlist();
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


        $data['title'] = 'Wishlist';
            
        
        $tripId = \helpers\Session::get("tripId");
        $data['applicants'] = $this->mab->get_wishlist($tripId);
        $data['roster'] = $this->mab->get_official_roster($tripId);
        
        
        foreach($data['applicants'] as $applicants_info) {
            $applicants_info->age = $this->mab->get_age_at_time($applicants_info->dateOfBirth, date('Y-m-d', time()));
        }
        if (isset($_POST['draft'])) {
            $trip_id = $this->mab->verify_applicant($_POST['applicationId']);
            if ($trip_id == NULL) {
                $this->mab->add_to_trip($_POST['applicationId'], $tripId);
                $this->mab->applicant_becomes_person($_POST['applicationId']);
                $this->mab->person_becomes_trip_member($_POST['applicationId'], $tripId);
            }
            else if ($trip_id == $tripId) {
                echo 'This is your participant';
            }
            else {   
                echo 'Application has already been drafted.';
            }
        }
        
        
        
        View::rendertemplate('header', $data);
        View::render('wishlist/wishlist', $data, $error);
        View::rendertemplate('footer', $data);
    }

    

    
    public function validateAppId() {
        $appId = $_POST['appId'];
        $response = $this->_model->verifyAppNum($appId);

        echo $response;
    }
}
