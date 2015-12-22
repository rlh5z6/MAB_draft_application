<?php namespace models;

class TripBoard extends \core\model {
   
    
	function __construct(){
		parent::__construct();
	}
    
    public function get_trip_information($seasonId){
        $trip_details = $this->_db->select('SELECT * FROM trip WHERE seasonId = :seasonId', array(':seasonId' => $seasonId));
        foreach($trip_details as $trip_info) {
            $location_info = $this->trip_location_information($trip_info->locationId);
            $issue_info = $this->trip_issue_information($trip_info->issueId);
            $trip_info->city = $location_info[0]->name;
            $trip_info->state = $location_info[0]->region;
            $trip_info->issue = $issue_info[0]->issueName;
            $site_leaders = $this->get_site_leader($trip_info->tripId);
            $trip_info->site_leader1 = $site_leaders[0];
            $trip_info->site_leader2 = $site_leaders[1];
        }
        return $trip_details;
    }

    
    
    public function trip_location_information($location_id){
        return $this->_db->select('SELECT name, region FROM location WHERE locationId = :location_id', array(':location_id' => $location_id));
    }

    
     public function trip_issue_information($issue_id) {
        return $this->_db->select('SELECT * FROM issue WHERE issueId = :issue_id', array(':issue_id' => $issue_id));
    }
    
    public function season_information($seasonId) {
        return $this->_db->select('SELECT * FROM season WHERE seasonId = :seasonId', array(':seasonId' => $seasonId));
    }
    
    public function get_site_leader($trip_id) {
        $trip_info = $this->_db->select('SELECT * FROM is_a_site_leader WHERE tripId = :trip_id', array(':trip_id' => $trip_id));
        $array = array();
        foreach ($trip_info as $site_leader) {
            $array[] = $this->get_name($site_leader->personId);
        }
        return $array; 
    }
        
        
    public function get_name($person_id) {
        $person_info = $this->_db->select('SELECT * FROM person WHERE personId = :person_id', array(':person_id' => $person_id));
        return $person_info[0]->firstName.' '.$person_info[0]->lastName;
        
    }
    
    

    
	
}
