<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\url;

class RegisterTrip extends \core\controller {

    private $_model;

    public function __construct() {
        $this->mab = new \models\registerTrip();
        $this->password = new \models\password();
        $this->trip = new \models\Trip();
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


        $data['title'] = 'Register Trip';
        $data['site_leaders'] = $this->mab->list_of_site_leaders();
        $data['seasons'] = $this->mab->get_seasons();
        $data['issues'] = $this->mab->get_issues();
        $data['site_leaders'] = $this->mab->get_site_leaders();
        
        
        $data['site_leader_names'] = array();
        foreach($data['site_leaders'] as $site_leader) {
            //$site_leader->fullName = site_leader->firstName;
            
            array_push($data['site_leader_names'], $site_leader->firstName.' '.$site_leader->lastName);
        }    
                
        
        
        
        $data['issues_names'] = array();
        foreach($data['issues'] as $issue) {
            array_push($data['issues_names'], $issue->issueName);
        }
        
        $data['season_names'] = array();
        foreach($data['seasons'] as $season) {
            array_push($data['season_names'], $season->name);
        }
        
        $issue = $_POST['issue'];
        $site_leader1 = $_POST['site_leader1'];
        $site_leader2 = $_POST['site_leader2'];
        $userName = $_POST['user_name'];
        $seasonId = $_POST['season'];
        
        if (isset($_POST['create_trip_account'])) {
            $tripId = $this->mab->create_trip_account($issue, $userName, $seasonId);
            if ($tripId == 0) {
                echo 'YOU FUCKED UP';
            
            }
            else {
                $this->mab->update_site_leaders($tripId, $site_leader1);
                $this->mab->update_site_leaders($tripId, $site_leader2);
                
                $valid_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNIPQRSTUVWXYZ0123456789';
                
                $salt = $this->password->generate_salt();
                $random_password = $this->password->get_random_password($valid_chars, 10);
                $passhash = $this->password->get_hash($random_password, $salt);
                $this->mab->insert_into_auth($tripId, $passhash, $salt);
                echo $random_password;
                //burnnnedd
                //M7gho1LC1j
                //winter1 - hycocsvxGD
            }
        }
        
        
        View::rendertemplate('exec_header', $data);
        View::render('register/registerTrip', $data, $error);
        View::rendertemplate('footer', $data);
    }

}