<?php namespace models;

class ChangePassword extends \core\model {

    public function getAdminAuthByUsername($uname){
        return $this->_db->select("SELECT a.* FROM admin_authentication a JOIN is_a_board_member i USING (personId) WHERE i.userName = :uname", array(':uname' => $uname))[0];
    }

    public function getTripAuthByUsername($uname){
        return $this->_db->select("SELECT a.* FROM trip_authentication a JOIN trip t USING (tripId) WHERE t.userName = :uname", array(':uname' => $uname))[0];
    }

    public function updateAdminPassword($newpass, $uname){
        $pid = $this->_db->select("SELECT personId FROM is_a_board_member WHERE userName = :uname", array(':uname' => $uname))[0]->personId;
        $this->_db->update('admin_authentication', array('pass' => $newpass), array('personId' => $pid));
    }

    public function updateTripPassword($newpass, $uname){
        $tid = $this->_db->select("SELECT tripId FROM trip WHERE userName = :uname", array(':uname' => $uname))[0]->tripId;
        $this->_db->update('trip_authentication', array('password' => $newpass), array('tripId' => $tid));
    }
}
