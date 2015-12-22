<?php namespace controllers;

use \core\view,
    \helpers\session,
    \helpers\url;

class registerAdmin extends \core\controller{

    public function __construct(){
        $this->regAdmin = new \models\registerAdmin();
        $this->mabTrip = new \models\registerTrip();
        $this->password = new \models\Password();
    }

    public function index($password = NULL){

        Session::init();
        if(Session::get('username')){
            if(!Session::get('admin')){
                Url::redirect('welcome');
            }
        }else{
            Url::redirect('');
        }

        $data['title'] = "Register Board Member";
        $data['seasons'] = $this->mabTrip->get_seasons();
        $data['season_names'] = array();
        $data['password'] = $password;

        foreach($data['seasons'] as $season) {
            $data['season_names'][] = $season->name;
        }

        View::rendertemplate('exec_header', $data);
        View::render('register/registerAdmin', $data, $error);
        View::rendertemplate('footer', $data);
    }

    public function submit(){
        if(!isset($_POST['submit'])){
            Url::redirect('registerBoardMember');
        }
        $dobarr = explode("/", $_POST['date_of_birth']);
        $person = array(
            'firstName' => $_POST['first_name'],
            'lastName' => $_POST['last_name'],
            'dateOfBirth' => $dobarr['2'].'-'.$dobarr['0'].'-'.$dobarr['1'],
            'gender' => $_POST['gender'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone_num'],
            'hometown' => $_POST['hometown'],
            'schoolYear' => $_POST['schoolYear']
        );
        if($this->regAdmin->getAdminByUserName($_POST['user_name'])){
            Url::redirect('registerBoardMember?error');
        }
        $newpid = $this->regAdmin->createPerson($person);
        if($newpid == 0){
            Url::redirect('registerBoardMember?error');
        }
        $admin = array(
            'personId' => $newpid,
            'username' => $_POST['user_name'],
            'title' => $_POST['title'],
            'seasonId' => $_POST['seasonId']
        );
        $this->regAdmin->createAdmin($admin);
        $salt = $this->password->generate_salt();
        $valid_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNIPQRSTUVWXYZ0123456789';
        $password = $this->password->get_random_password($valid_chars, 10);
        $passhash = $this->password->get_hash($password, $salt);
        $auth = array(
            'personId' => $newpid,
            'pass' => $passhash,
            'salt' => $salt
        );
        $this->regAdmin->createAdminAuth($auth);
        $this->index($password);
    }
}