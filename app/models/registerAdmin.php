<?php namespace models;


class registerAdmin extends \core\model{

    function __construct(){
        parent::__construct();
    }

    public function createPerson($personArr){
        $retval = 0;
        if(!$this->getPersonByEmail($personArr['email'])) {
            $this->_db->insert('person', $personArr);
            $retval = $this->getPersonByEmail($personArr['email'])->personId;
        }
        return $retval;
    }

    public function getPersonByEmail($email){
        return $this->_db->select('SELECT * FROM person WHERE email = :email', array(':email' => $email))[0];
    }

    public function createAdmin($adminArr){
        $this->_db->insert('is_a_board_member', $adminArr);
    }

    public function createAdminAuth($authArr){
        $this->_db->insert('admin_authentication', $authArr);
    }

    public function getAdminByUserName($uname){
        return $this->_db->select('SELECT * FROM is_a_board_member WHERE username = :uname', array(':uname' => $uname))[0];
    }
}