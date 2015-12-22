<?php namespace models;

class Login extends \core\model{

    public function __construct(){
        parent::__construct();
    }

    public function get_admin_auth_by_uname($username){
        $admin_info = $this->_db->select("SELECT * FROM is_a_board_member WHERE userName = :username", array(':username'=>$username));
        if(count($admin_info) != 1){
            return null;
        }else {
            $admin_info = $admin_info[0];
            $auth = $this->get_admin_auth_by_id($admin_info->personId);
            $auth->userName = $admin_info->userName;
            return $auth;
        }
    }

    public function get_admin_auth_by_id($pid){
        $auth = $this->_db->select("SELECT * FROM admin_authentication WHERE personId = :pid", array(':pid'=>$pid));
        if(count($auth) != 1){
            return null;
        }else{
            return $auth[0];
        }
    }

    public function get_trip_auth_by_uname($username){
        $trip_info = $this->_db->select("SELECT * FROM trip WHERE userName = :username", array(':username'=>$username));
        if(count($trip_info) != 1){
            return null;
        }else {
            $trip_info = $trip_info[0];
            $auth = $this->get_trip_auth_by_id($trip_info->tripId);
            $auth->userName = $trip_info->userName;
            $auth->pass = $auth->password;
            return $auth;
        }
    }

    public function get_trip_auth_by_id($tid){
        $auth = $this->_db->select("SELECT * FROM trip_authentication WHERE tripId = :tid", array(':tid'=>$tid));
        if(count($auth) != 1){
            return null;
        }else{
            return $auth[0];
        }
    }
    


}