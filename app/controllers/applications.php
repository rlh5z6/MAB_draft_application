<?php namespace controllers;

use \core\view,
    \helpers\session,
    \helpers\url;

class Applications extends \core\controller {

    private $_model;

    public function __construct() {
        $this->mab = new \models\applications();
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


        $data['title'] = 'Applications';
        $tripId = \helpers\Session::get("tripId");
        
        
        
        $data['applicants'] = $this->mab->get_all_applications(Session::get('tripId'));
        $data['applicants1'] = array();
        $data['applicants2'] = array();
        $data['applicants3'] = array();
        foreach($data['applicants'] as $applicants_info) {
            $applicants_info->age = $this->mab->get_age_at_time($applicants_info->dateOfBirth, date('Y-m-d', time()));
            if($applicants_info->iid1 == Session::get('issueId')){
                $data['applicants1'][] = $applicants_info;
            } else if($applicants_info->iid2 == Session::get('issueId')) {
                $data['applicants2'][] = $applicants_info;
            } else if($applicants_info->iid3 == Session::get('issueId')) {
                $data['applicants3'][] = $applicants_info;
            }
        }
        
        $data['question'] = $this->mab->application_questions();
        

        if (isset($_POST['add_application'])) {
            $applicationId = $_POST['aid'];
            $rating = $_POST['rating'];
            $notes = $_POST['notes'];
            
            $this->mab->add_to_wishlist($applicationId, $rating, $notes, $tripId);
            
        }
        
        
        

        $data['question'] = $this->mab->application_questions();

        View::rendertemplate('header', $data);
        View::render('applications/applications', $data, $error);
        View::rendertemplate('footer', $data);
    }

}