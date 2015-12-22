<?php namespace controllers;

use \core\view,
    \helpers\session,
    \helpers\url;

class login extends \core\controller{

    public function __construct(){
        parent::__construct();
        $this->login = new \models\Login();
        $this->password_model = new \models\Password();
        $this->trip = new \models\Trip();
        $this->tripBoard = new \models\TripBoard();
    }

    public function index(){
        
        \helpers\Session::init();
        if(\helpers\Session::get('username')){
            if(\helpers\Session::get('admin')){
                \helpers\url::redirect('exec');
            }else {
                \helpers\url::redirect('welcome');
            }
        }

        $data['title'] = "Login";

        
        View::rendertemplate('header', $data);
        View::render('login/login', $data);
        View::rendertemplate('footer', $data);
    }
    
    public function login(){
        \helpers\Session::init();

        if(!isset($_POST['submit'])){
            header("Location: .");
        }else{
            $pass = $_POST['pass'];
            $uname = htmlspecialchars($_POST['username']);
            $auth_data = $this->login->get_admin_auth_by_uname($uname);
            $admin = true;
            if(!$auth_data->userName){
                $auth_data = $this->login->get_trip_auth_by_uname($uname);
                $admin = false;
            }
            if($auth_data->userName){
                if($auth_data->pass == $this->password_model->get_hash($pass, $auth_data->salt)){
                    if (!$admin) {
                        \helpers\Session::set('tripId', $auth_data->tripId);
                        $trip_info = $this->trip->get_trip_information($auth_data->tripId);
                        
                        $issueId = $trip_info->issueId;
                        $seasonId = $trip_info->seasonId;
                        
                        
                        $issue = $this->tripBoard->trip_issue_information($issueId);
                        $season = $this->tripBoard->season_information($seasonId);
                        
                        \helpers\Session::set('season', $season[0]->name);
                        \helpers\Session::set('issue', $issue[0]->issueName);
                        \helpers\Session::set('issueId', $issue[0]->issueId);
                        \helpers\Session::set('nickname', $trip_info->nickname);
                        
                        
                        
                       //children - DHvix4j2bf
                    //RUSHGM - ww5oJeFtZz    
                    //mickeyds - mW56oQQ4eD
                        
                    }
                    \helpers\Session::set('username', $auth_data->userName);
                    \helpers\Session::set('admin', $admin);
                    
                    if($admin){
                        \helpers\url::redirect('exec');
                    }else {
                        \helpers\url::redirect('welcome');
                    }
                }else{
                    header('Location: .?error');
                }
            }else{
                header('Location: .?error');
            }
        }
    }

}   