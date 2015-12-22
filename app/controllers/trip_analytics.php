<?php namespace controllers;

use \core\view,
    \helpers\session,
    \helpers\url;

    class Trip_Analytics extends \core\controller {


    public function __construct() {
        $this->mab = new \models\analytics();
    }
    
    public function create() {
        
        Session::init();
        if(Session::get('username')){
            if(!Session::get('admin')){
                Url::redirect('welcome');
            }
        }else{
            Url::redirect('');
        }

        $data['title'] = 'Trip Analytics';
        
        
        $data['trips'] = $this->mab->num_of_trips();
        $data['gender'] = $this->mab->get_gender();
        $data['yearsInSchool'] = $this->mab->get_years_in_school();
        
        $data['states'] = $this->mab->get_states();
       
        
        View::rendertemplate('exec_header', $data);
        View::render('analytics/trip_analytics', $data, $error);
        View::rendertemplate('footer', $data);
    }
}
?>