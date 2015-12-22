<?php namespace models;

class RegisterTrip extends \core\model {

    public function list_of_site_leaders() {
        $site_leaders = $this->_db->select('SELECT sl.personId, p.firstName, p.lastName FROM is_a_site_leader sl JOIN person p USING (personId)');
        return $site_leaders;
    }
   
    public function create_trip_account($issueId, $userName, $seasonId) {  
        if ($this->find_by_username($userName) == NULL) {

            $postdata = array ( 
                'issueId' => $issueId,
                'userName' => $userName,
                'seasonId' =>$seasonId
            );

            $this->_db->insert('trip', $postdata);
            $tripId = $this->find_by_username($userName);
            return $tripId;
        }
        else {
            return 0;
        }
    }
    
    public function find_by_username($userName) {
        $trip = $this->_db->select('SELECT * FROM trip WHERE userName = :userName', array(':userName' => $userName));
        return $trip[0]->tripId;
        
        
    }
    
    public function update_site_leaders($tripId, $personId) {
        
        $postdata = array (

			'tripId' => $tripId
		);

		$this->_db->update('is_a_site_leader', $postdata, array('personId' => $personId));
    
    }
    
    public function insert_into_auth($tripId, $password, $salt) {  

            $postdata = array ( 
                'tripId' => $tripId,
                'password' => $password,
                'salt' => $salt
            );

            $this->_db->insert('trip_authentication', $postdata);
    
    }
    
    public function get_seasons() {
        return $this->_db->select('SELECT * FROM season');
    }

    public function get_issues() {
        return $this->_db->select('SELECT * FROM issue');
    }
    
    public function get_site_leaders() {
        $site_leaders_info = $this->_db->select('SELECT * FROM is_a_site_leader WHERE tripId IS NULL');
        foreach ($site_leaders_info as $roster) {
            $site_leader = $this->get_application_information($roster->personId);
            $roster->firstName = $site_leader[0]->firstName;
            $roster->lastName = $site_leader[0]->lastName;
        }
        return $site_leaders_info;
        
    }
    
    public function get_application_information($personId) {
        return $this->_db->select('SELECT * FROM person WHERE personId = :personId', array(':personId' => $personId));
    }
    
}