<?php namespace controllers;

use \core\view,
    \helpers\session,
    \helpers\url;

class RegisterSiteLeader extends \core\controller {

    private $_model;

    public function __construct() {
        $this->mab = new \models\registerSiteLeader();
        $this->mabTrip = new \models\registerTrip();
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


        $data['title'] = 'Register Site Leader';

        $data['seasons'] = $this->mabTrip->get_seasons();



        $data['season_names'] = array();


        foreach($data['seasons'] as $season) {
            array_push($data['season_names'], $season->name);
        }




        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $gender = $_POST['gender'];
        $hometown = $_POST['hometown'];
        $schoolYear = $_POST['schoolYear'];
        $email = htmlspecialchars($_POST['email']);
        $phone_num = htmlspecialchars($_POST['phone_num']);
        $dob_arr = explode("/", $_POST['date_of_birth']);
        $birthday = $dob_arr[2] . "-" . $dob_arr[0] . "-" . $dob_arr[1];
        $seasonId = $_POST['seasonId'];

        $is_valid = \helpers\gump::is_valid($_POST, array(
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'gender' => 'required',
            'email' => 'required|valid_email',
            'phone_num' => 'required',
            'date_of_birth' => 'required',
            'seasonId' => 'required',
            'hometown' => 'required',
            'schoolYear' => 'required'
        ));
        
        $site_leader_insert_error = "";
        if($is_valid === true) {

            if (isset($_POST['insert_site_leader'])) {
                $personId = $this->mab->insert_person($first_name, $last_name, $gender, $email, $phone_num, $birthday, $hometown, $schoolYear);

                if ($personId == 0) {
                    $site_leader_insert_error = "Site leader's email address already exists.";

                }
                else {
                    $this->mab->insert_is_a_site_leader($personId, $seasonId);
                }
            }
        }

        else {
            $data['errors'] = $is_valid;

        }




        View::rendertemplate('exec_header', $data);
        View::render('register/registerSiteLeader', $data, $error);
        View::rendertemplate('footer', $data);
    }

}